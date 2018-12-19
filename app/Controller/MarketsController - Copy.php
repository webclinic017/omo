<?php
App::uses('AppController', 'Controller');
/**
 * Markets Controller
 *
 * @property Market $Market
 */
class MarketsController extends AppController
{

    /**
     * home method
     *
     * @return void
     */
    public function beforeFilter() {
        parent::beforeFilter();

        //$this->Auth->allow('test');
        $this->Auth->allow();

    }
    public $helpers = array('Js' => array('Jquery'));
    public $components = array('HighCharts.HighCharts','StockBangladesh');
    public $chartData = array(7.0, 6.9, 9.5, 14.5, 18.2, 21.5, 25.2, 26.5, 23.3, 18.3, 13.9, 9.6, 7.0, 6.9, 9.5, 14.5, 18.2, 21.5, 25.2, 26.5, 23.3, 18.3, 13.9, 9.6, 7.0, 6.9, 9.5, 14.5, 18.2, 21.5, 25.2, 26.5, 23.3, 18.3, 13.9, 9.6, 7.0, 6.9, 9.5, 14.5, 18.2, 21.5, 25.2, 26.5, 23.3, 18.3, 13.9, 9.6);
    public $lastTradeInfo,$yesterdayTradeInfo=array();

    public function _getLastTradeInfo()
    {
        $exchangeId=Configure::read('EXCHANGE_ID');
        $lastTradeInfo = Cache::read('lastTradeInfo');
        //$lastTradeInfo = Cache::delete('lastTradeInfo');
        if (!$lastTradeInfo) {
            //pr("mem empty here");
            $lastTradeInfo = $this->Market->find('first', array(
                'conditions' => "Market.is_trading_day=1 and Market.exchange_id=$exchangeId",
                'recursive' => 1
            ));
            Cache::write('lastTradeInfo', $lastTradeInfo, 'minute');

        }
        //pr(Hash::sort(Hash::extract($lastTradeInfo, 'DataBanksIntraday.{n}'), '{n}.id', 'asc'));
        $lastTradeInfo['DataBanksIntraday']=Hash::combine(Hash::sort(Hash::extract($lastTradeInfo, 'DataBanksIntraday.{n}'), '{n}.id', 'asc'), '{n}.instrument_code', '{n}');

        //pr($lastTradeInfo);
        $this->lastTradeInfo=$lastTradeInfo;
        return $lastTradeInfo;

    }public function _getYesterdayTradeInfo()
    {
        $exchangeId=Configure::read('EXCHANGE_ID');
        $yesterdayTradeInfo = Cache::read('yesterdayTradeInfo');
        //$yesterdayTradeInfo = Cache::delete('yesterdayTradeInfo');
        if (!$yesterdayTradeInfo) {
            //pr("mem empty here");
            $lastTwoMarketsInfo = $this->Market->find('all', array(
                'conditions' => "Market.is_trading_day=1 and Market.exchange_id=$exchangeId",
                'recursive' => 0,
                'limit' => 2
            ));
            $yesterayMarketId=Hash::get($lastTwoMarketsInfo, '1.Market.id');

            $yesterdayTradeInfo = $this->Market->find('first', array(
                'conditions' => "Market.id=$yesterayMarketId",
                'recursive' => 1
            ));
            Cache::write('yesterdayTradeInfo', $yesterdayTradeInfo, 'day');

        }
        //pr(Hash::sort(Hash::extract($lastTradeInfo, 'DataBanksIntraday.{n}'), '{n}.id', 'asc'));

        $yesterdayTradeInfo['DataBanksIntraday']=Hash::combine(Hash::sort(Hash::extract($yesterdayTradeInfo, 'DataBanksIntraday.{n}'), '{n}.id', 'asc'), '{n}.instrument_code', '{n}');

        //pr($lastTradeInfo);
        $this->yesterdayTradeInfo=$yesterdayTradeInfo;
        return $yesterdayTradeInfo;

    }
    public function home()
    {
        App::uses('CakeTime', 'Utility');
        $this->layout = 'default3';
        /*
         * TRY TO MINIMUM USE MODEL IN COMPONENT. SO WE ARE USING _getLastTradeInfo INSTEAD OF $this->StockBangladesh->getLastTradeInfo();
         */
        //$lastTradeInfo=$this->StockBangladesh->getLastTradeInfo();
        $lastTradeInfo=$this->_getLastTradeInfo();
        $yesterdayTradeInfo=$this->_getYesterdayTradeInfo();
        $this->set('lastTradeInfo', $lastTradeInfo);
             //pr($lastTradeInfo);

        $nextTradeInfo = Cache::read('nextTradeInfo');
        $exchangeId=Configure::read('EXCHANGE_ID');
        //$nextTradeInfo = Cache::delete('nextTradeInfo');
        if (!$nextTradeInfo) {
            //pr("mem empty here");
            $nextTradeInfo = $this->Market->find('first', array(
                'order' => array('Market.id' => 'asc'),
                'conditions' => "Market.is_trading_day=2 and Market.exchange_id=$exchangeId",
                'recursive' => 0
            ));
            Cache::write('nextTradeInfo', $nextTradeInfo, 'minute');

        }


/*
 * @TODO TIME SHOULD BE INTERNATIONALIZE. CONSIDER USER TIME ZONE
 */

//    pr(CakeTime::nice(CakeTime::fromString('Dec 19 2013 02:30:53:073PM')));


        $tradeDayTime = $lastTradeInfo['Market']['trade_date'] . " " . $lastTradeInfo['Market']['market_closed'];
        if (CakeTime::isPast($tradeDayTime)) {
            $nextTradeDayTime = $nextTradeInfo['Market']['trade_date'] . " " . $nextTradeInfo['Market']['market_started'];
            $remainingTime = CakeTime::fromString($nextTradeDayTime) - CakeTime::fromString('now');
            $remainingText="to open market";
        } else {
            $remainingTime = CakeTime::fromString($tradeDayTime) - CakeTime::fromString('now');
            $remainingText="to close market";
        }
        $this->set('remainingTime', $remainingTime);
        $this->set('remainingText', $remainingText);

        // DSEX CHART

        $this->index_chart(0);
    }
public function index_chart($ajax=1)
{
    App::uses('CakeTime', 'Utility');
    $StockBangladesh = $this->Components->load('StockBangladesh');
    if($ajax)
        $this->layout='ajax'; //WHEN THIS CALLED FROM AJAX CHANGE THE LAYOUT TO AJAX

    // DSEX CHART---START
    $chartName = 'DSEX Chart';
    $lastTradeInfo=$this->_getLastTradeInfo();

    $dsExData=Hash::extract(Hash::extract($lastTradeInfo, 'IndexValue.{n}[index_id=2]'), '{n}.capital_value');

    $arr = Hash::map($dsExData, '{n}', function($newArr) {
        return $newArr+0;
    });

    $dsExData=Hash::sort($arr, ' ', 'desc');

    $dateTime=Hash::extract(Hash::extract($lastTradeInfo, 'IndexValue.{n}[index_id=2]'), '{n}.date_time');
    $arrDate = Hash::map($dateTime, '{n}', function($newArr) {
        return CakeTime::format('h:i A',$newArr);
    });
    $yMin=Hash::apply($dsExData, '{n}', 'min');
    $dateTime=Hash::sort($arrDate, ' ', 'desc');;

    $mychart = $this->HighCharts->create($chartName, 'areaspline');

    $this->HighCharts->setChartParams(
        $chartName,
        array(
            'renderTo' => 'dsex_div', // div to display chart inside
            'chartHeight' => 200,
            'xAxisCategories' => $dateTime,
            'yAxisMin' 				=> $yMin,
            'enableAutoStep' => false,
            'creditsEnabled' 			=> true,
            'creditsText'  	 			=> 'StockBangladesh.com',
            'creditsURL'	 			=> 'http://stockbangladesh.com',
            //'tickInterval' => 'auto'
        )
    );
    $mychart->xAxis->tickInterval=8;
    $series = $this->HighCharts->addChartSeries();
    $series->addName('DSEX')->addData($dsExData);
    $series->showInLegend=false;
    $mychart->plotOptions->series->marker->radius=2;
    $mychart->plotOptions->series->marker->symbol='triangle';
    $mychart->addSeries($series);
    // DSEX CHART---END

    // DS30 CHART---START
    $chartName = 'DS30 Chart';
    $ds30Data=Hash::extract(Hash::extract($lastTradeInfo, 'IndexValue.{n}[index_id=1]'), '{n}.capital_value');
    $arr = Hash::map($ds30Data, '{n}', function($newArr) {
        return $newArr+0;
    });

    $ds30Data=Hash::sort($arr, ' ', 'asc');
    $dateTime=Hash::extract(Hash::extract($lastTradeInfo, 'IndexValue.{n}[index_id=1]'), '{n}.date_time');
    $arrDate = Hash::map($dateTime, '{n}', function($newArr) {
        return CakeTime::format('h:i A',$newArr);
    });
    $yMin=Hash::apply($ds30Data, '{n}', 'min');
    $dateTime=Hash::sort($arrDate, ' ', 'desc');;

    $mychart = $this->HighCharts->create($chartName, 'areaspline');

    $this->HighCharts->setChartParams(
        $chartName,
        array(
            'renderTo' => 'ds30_div', // div to display chart inside
            'chartWidth'=> 400,
            'chartHeight' => 200,
            'xAxisCategories' => $dateTime,
            'yAxisMin' 				=> $yMin,
            'enableAutoStep' => false,
            'creditsEnabled' 			=> true,
            'creditsText'  	 			=> 'StockBangladesh.com',
            'creditsURL'	 			=> 'http://stockbangladesh.com',
            //'tickInterval' => 'auto'
        )
    );
    $mychart->xAxis->tickInterval=8;
    $mychart->plotOptions->series->marker->radius=2;
    $mychart->plotOptions->series->marker->symbol='triangle';
    $series = $this->HighCharts->addChartSeries();
    $series->addName('DS30')->addData($ds30Data);
    $series->showInLegend=false;
    $mychart->addSeries($series);
    // DS30 CHART---END



   // VOLUME CHART---START

    $yesterdayTradeInfo=$this->_getYesterdayTradeInfo();
    $chartName = 'volume Chart';
    $tradeVal=Hash::extract(Hash::extract($lastTradeInfo, 'MarketStat.{n}[stat_id=3]'), '{n}.stats_value');
    $tradeValYesterday=Hash::extract(Hash::extract($yesterdayTradeInfo, 'MarketStat.{n}[stat_id=3]'), '{n}.stats_value');

    $tradeTime=Hash::extract(Hash::extract($lastTradeInfo, 'MarketStat.{n}[stat_id=3]'), '{n}.stats_time');
    $tradeTimeYesterday=Hash::extract(Hash::extract($yesterdayTradeInfo, 'MarketStat.{n}[stat_id=3]'), '{n}.stats_time');

    $tradeValDiff=$StockBangladesh->array_subtract($tradeVal);
    $tradeValDiffYesterday=$StockBangladesh->array_subtract($tradeValYesterday);

    $tradeValDiffAll=Hash::merge($tradeValDiff, $tradeValDiffYesterday);
    $tradeTimeAll=Hash::merge($tradeTime, $tradeTimeYesterday);


    $dateTime = Hash::map($tradeTimeAll, '{n}', function($newArr) {
        return CakeTime::format('h:i A',$newArr);
        //return CakeTime::format('d h:i',$newArr);
    });

    $dateTime = array_slice($dateTime, 0, 100);
    $tradeValDiffAll = array_slice($tradeValDiffAll, 0, 100);

    $dateTime=Hash::sort($dateTime, ' ', 'desc');;
    $tradeValDiff=Hash::sort($tradeValDiffAll, ' ', 'desc');;

    /*$dateTime = array_slice($dateTime, 0, 300);
    $tradeValDiff = array_slice($tradeValDiff, 0, 300);
    */
    // pr($tradeVal);
    //pr($tradeTime);

   // $yMin=Hash::apply($ds30Data, '{n}', 'min');
   // $dateTime=Hash::sort($arrDate, ' ', 'desc');;

    $mychart = $this->HighCharts->create($chartName, 'column');

    $this->HighCharts->setChartParams(
        $chartName,
        array(
            'renderTo' => 'volume_div', // div to display chart inside
            //'chartWidth'=> 400,
            'chartHeight' => 110,
            'xAxisCategories' => $dateTime,
            'enableAutoStep' => false,
            'creditsEnabled' 			=> true,
            'creditsText'  	 			=> 'StockBangladesh.com',
            'creditsURL'	 			=> 'http://stockbangladesh.com',
            //'tickInterval' => 'auto'
        )
    );
    $mychart->xAxis->tickInterval=30;
    $mychart->chart->zoomType='x';
    $mychart->plotOptions->series->marker->radius=2;
    $mychart->plotOptions->series->marker->symbol='triangle';
    $series = $this->HighCharts->addChartSeries();
    $series->addName('vol')->addData($tradeValDiff);
    $series->showInLegend=false;
    $mychart->addSeries($series);
    // VOLUME CHART---END


// TRADE CHART---START
    $chartName = 'trade Chart';
    $tradeVal=Hash::extract(Hash::extract($lastTradeInfo, 'MarketStat.{n}[stat_id=2]'), '{n}.stats_value');
    $tradeTime=Hash::extract(Hash::extract($lastTradeInfo, 'MarketStat.{n}[stat_id=2]'), '{n}.stats_time');
    $tradeValDiff=$StockBangladesh->array_subtract($tradeVal);

    $dateTime = Hash::map($tradeTime, '{n}', function($newArr) {
        return CakeTime::format('h:i A',$newArr);
    });
    $dateTime=Hash::sort($dateTime, ' ', 'desc');;
    $tradeValDiff=Hash::sort($tradeValDiff, ' ', 'desc');;

    // pr($tradeVal);
    //pr($tradeTime);

   // $yMin=Hash::apply($ds30Data, '{n}', 'min');
   // $dateTime=Hash::sort($arrDate, ' ', 'desc');;

    $mychart = $this->HighCharts->create($chartName, 'column');

    $this->HighCharts->setChartParams(
        $chartName,
        array(
            'renderTo' => 'trade_div', // div to display chart inside
            //'chartWidth'=> 400,
            'chartHeight' => 110,
            'xAxisCategories' => $dateTime,
            //'yAxisMax' 				=> 60,
            'enableAutoStep' => false,
            'creditsEnabled' 			=> true,
            'creditsText'  	 			=> 'StockBangladesh.com',
            'creditsURL'	 			=> 'http://stockbangladesh.com',
            //'tickInterval' => 'auto'
        )
    );
    $mychart->xAxis->tickInterval=15;
    $mychart->chart->zoomType='x';
    $mychart->plotOptions->series->marker->radius=2;
    $mychart->plotOptions->series->marker->symbol='triangle';
    $series = $this->HighCharts->addChartSeries();
    $series->addName('vol')->addData($tradeValDiff);
    $series->showInLegend=false;
    $mychart->addSeries($series);
    // TRADE CHART---END


}
    public function test()
    {
        $this->layout = 'default3';

        $data = array(
            array(
                'Person' => array(
                    'first_name' => 'Nate',
                    'last_name' => 'Abele',
                    'city' => 'Boston',
                    'state' => 5,
                    'something' => '42'
                )
            ),
            array(
                'Person' => array(
                    'first_name' => 'Larry',
                    'last_name' => 'Masters',
                    'city' => 'Boondock',
                    'state' => 10,
                    'something' => '{0}'
                )
            ),
            array(
                'Person' => array(
                    'first_name' => 'Garrett',
                    'last_name' => 'Woodworth',
                    'city' => 'Venice Beach',
                    'state' =>20,
                    'something' => '{1}'
                )
            )
        );
pr($data);
        $res = Hash::format($data, array('{n}.Person.something', '{n}.Person.last_name', '{n}.Person.last_name'), '%1$d,%1$s,%3$s');
        pr($res);
        /*
        Array
        (
            [0] => 42, Nate
            [1] => 0, Larry
            [2] => 0, Garrett
        )
        */

        $res = Hash::format($data, array('{n}.Person.first_name', '{n}.Person.something'), '%1$s, (%2$d-%2$d)');
        pr($res);
        /*
        Array
        (
            [0] => Nate, 42
            [1] => Larry, 0
            [2] => Garrett, 0
        )
        */


        $ratings = array(
            'Rating' => array(
                array(
                    'id' => 4,
                    'rating' => -1
                ),
                array(
                    'id' => 14,
                    'rating' => 9.7
                ),
                array(
                    'id' => 26,
                    'rating' => 9.55
                )
            )
        );
        pr( Hash::extract($ratings, 'Rating.{n}[rating>-1]') );
        exit;
    }
    public function modal($type)
    {
        $this->layout='ajax';
$this->set('type',$type);

    }
    public function send_feedback()
    {
        $this->layout='ajax';

    }

}

