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
    public function beforeFilter()
    {
        parent::beforeFilter();

        //$this->Auth->allow('test');
        $this->Auth->allow();


    }

    public $helpers = array('Js' => array('Jquery'), 'Facebook.Facebook','AssetCompress.AssetCompress');
    public $components = array('HighCharts.HighCharts', 'StockBangladesh', 'Cookie','Paginator');
    public $chartData = array(7.0, 6.9, 9.5, 14.5, 18.2, 21.5, 25.2, 26.5, 23.3, 18.3, 13.9, 9.6, 7.0, 6.9, 9.5, 14.5, 18.2, 21.5, 25.2, 26.5, 23.3, 18.3, 13.9, 9.6, 7.0, 6.9, 9.5, 14.5, 18.2, 21.5, 25.2, 26.5, 23.3, 18.3, 13.9, 9.6, 7.0, 6.9, 9.5, 14.5, 18.2, 21.5, 25.2, 26.5, 23.3, 18.3, 13.9, 9.6);
    public $lastTradeInfo = null, $yesterdayTradeInfo = null;



    /**
     * index method
     *
     * @return void
     */
    public function index() {
        $this->Market->recursive = 0;
        $this->set('markets', $this->Paginator->paginate());
    }

    /**
     * view method
     *
     * @throws NotFoundException
     * @param string $id
     * @return void
     */
    public function view($id = null) {
        if (!$this->Market->exists($id)) {
            throw new NotFoundException(__('Invalid market'));
        }
        $options = array('conditions' => array('Market.' . $this->Market->primaryKey => $id));
        $this->set('market', $this->Market->find('first', $options));
    }

    /**
     * add method
     *
     * @return void
     */
    public function add() {
        if ($this->request->is('post')) {
            $this->Market->create();
            if ($this->Market->save($this->request->data)) {
                $this->Session->setFlash(__('The market has been saved.'));
                return $this->redirect(array('action' => 'index'));
            } else {
                $this->Session->setFlash(__('The market could not be saved. Please, try again.'));
            }
        }
        $exchanges = $this->Market->Exchange->find('list');
        $this->set(compact('exchanges'));
    }

    /**
     * edit method
     *
     * @throws NotFoundException
     * @param string $id
     * @return void
     */
    public function edit($id = null) {
        if (!$this->Market->exists($id)) {
            throw new NotFoundException(__('Invalid market'));
        }
        if ($this->request->is(array('post', 'put'))) {
            if ($this->Market->save($this->request->data)) {
                $this->Session->setFlash(__('The market has been saved.'));
                return $this->redirect(array('action' => 'index'));
            } else {
                $this->Session->setFlash(__('The market could not be saved. Please, try again.'));
            }
        } else {
            $options = array('conditions' => array('Market.' . $this->Market->primaryKey => $id));
            $this->request->data = $this->Market->find('first', $options);
        }
        $exchanges = $this->Market->Exchange->find('list');
        $this->set(compact('exchanges'));
    }

    /**
     * delete method
     *
     * @throws NotFoundException
     * @param string $id
     * @return void
     */
    public function delete($id = null) {
        $this->Market->id = $id;
        if (!$this->Market->exists()) {
            throw new NotFoundException(__('Invalid market'));
        }
        $this->request->allowMethod('post', 'delete');
        if ($this->Market->delete()) {
            $this->Session->setFlash(__('The market has been deleted.'));
        } else {
            $this->Session->setFlash(__('The market could not be deleted. Please, try again.'));
        }
        return $this->redirect(array('action' => 'index'));
    }

    /**
     * admin_index method
     *
     * @return void
     */
    public function admin_index() {
        $this->Market->recursive = 0;
        $this->set('markets', $this->Paginator->paginate());
    }

    /**
     * admin_view method
     *
     * @throws NotFoundException
     * @param string $id
     * @return void
     */
    public function admin_view($id = null) {
        if (!$this->Market->exists($id)) {
            throw new NotFoundException(__('Invalid market'));
        }
        $options = array('conditions' => array('Market.' . $this->Market->primaryKey => $id));
        $this->set('market', $this->Market->find('first', $options));
    }

    /**
     * admin_add method
     *
     * @return void
     */
    public function admin_add() {
        if ($this->request->is('post')) {
            $this->Market->create();
            if ($this->Market->save($this->request->data)) {
                $this->Session->setFlash(__('The market has been saved.'));
                return $this->redirect(array('action' => 'index'));
            } else {
                $this->Session->setFlash(__('The market could not be saved. Please, try again.'));
            }
        }
        $exchanges = $this->Market->Exchange->find('list');
        $this->set(compact('exchanges'));
    }

    /**
     * admin_edit method
     *
     * @throws NotFoundException
     * @param string $id
     * @return void
     */
    public function admin_edit($id = null) {
        if (!$this->Market->exists($id)) {
            throw new NotFoundException(__('Invalid market'));
        }
        if ($this->request->is(array('post', 'put'))) {
            if ($this->Market->save($this->request->data)) {
                $this->Session->setFlash(__('The market has been saved.'));
                return $this->redirect(array('action' => 'index'));
            } else {
                $this->Session->setFlash(__('The market could not be saved. Please, try again.'));
            }
        } else {
            $options = array('conditions' => array('Market.' . $this->Market->primaryKey => $id));
            $this->request->data = $this->Market->find('first', $options);
        }
        $exchanges = $this->Market->Exchange->find('list');
        $this->set(compact('exchanges'));
    }

    /**
     * admin_delete method
     *
     * @throws NotFoundException
     * @param string $id
     * @return void
     */
    public function admin_delete($id = null) {
        $this->Market->id = $id;
        if (!$this->Market->exists()) {
            throw new NotFoundException(__('Invalid market'));
        }
        $this->request->allowMethod('post', 'delete');
        if ($this->Market->delete()) {
            $this->Session->setFlash(__('The market has been deleted.'));
        } else {
            $this->Session->setFlash(__('The market could not be deleted. Please, try again.'));
        }
        return $this->redirect(array('action' => 'index'));
    }


    /*
     * $returnToday=2 will return merge information with yesterday
     * $returnToday=1 will return today information
     * $returnToday=0 will return yesterday information
     * */
    public function _prepareLastTradeInfo($returnToday = 1)
    {
       // Configure::write('debug', 2);

        $StockBangladesh = $this->Components->load('StockBangladesh');

        if ($returnToday) {
            $marketId = $StockBangladesh->getMarketInfo(0);

            $lastTradeInfo = $StockBangladesh->getLastTradeInfo($marketId);

            unset($lastTradeInfo['10001']);
            unset($lastTradeInfo['10002']);
            unset($lastTradeInfo['10003']);
//pr($lastTradeInfo);
  //          exit;
            $result = Hash::combine($lastTradeInfo, '{n}.{s}.trade_time', '{n}.{s}', '{n}.{s}.instrument_id');
            $DataBanksIntradayCombinedWithPrevMinute = $StockBangladesh->merge_last_two_minutes($result);

       //     pr($DataBanksIntradayCombinedWithPrevMinute);
        //    exit;

            return $DataBanksIntradayCombinedWithPrevMinute;
        } else {
            $lastTwoMarketInfoArr = $StockBangladesh->getMarketInfo(0, 0);

            $yesterdayMarketId = $lastTwoMarketInfoArr[1]['Market']['id'];
            $yesterdayTradeInfo = $StockBangladesh->getYesterdayTradeInfo($yesterdayMarketId);

            unset($yesterdayTradeInfo['10001']);
            unset($yesterdayTradeInfo['10002']);
            unset($yesterdayTradeInfo['10003']);

            $yresult = Hash::combine($yesterdayTradeInfo, '{n}.{s}.trade_time', '{n}.{s}', '{n}.{s}.instrument_id');

            $YDataBanksIntradayCombinedWithPrevMinute = $StockBangladesh->merge_last_two_minutes($yresult);
            return $YDataBanksIntradayCombinedWithPrevMinute;
        }
        // We dont need it
        //$DataBanksIntradayCombinedWithYesterday=$StockBangladesh->merge_with_yesterday($DataBanksIntradayCombinedWithPrevMinute,$YDataBanksIntradayCombinedWithPrevMinute);


    }

    public function _getYesterdayTradeInfo()
    {
        if ($this->yesterdayTradeInfo) {

        } else {
            $exchangeId = Configure::read('EXCHANGE_ID');
            $yesterdayTradeInfo = Cache::read('yesterdayTradeInfo');
            //$yesterdayTradeInfo = Cache::delete('yesterdayTradeInfo');
            if (!$yesterdayTradeInfo) {
                //pr("mem empty here");
                $lastTwoMarketsInfo = $this->Market->find('all', array(
                    'conditions' => "Market.is_trading_day=1 and Market.exchange_id=$exchangeId",
                    'recursive' => 0,
                    'limit' => 2
                ));
                $yesterayMarketId = Hash::get($lastTwoMarketsInfo, '1.Market.id');

                $yesterdayTradeInfo = $this->Market->find('first', array(
                    'conditions' => "Market.id=$yesterayMarketId",
                    'recursive' => 1
                ));
                Cache::write('yesterdayTradeInfo', $yesterdayTradeInfo, 'day');

            }
            //pr(Hash::sort(Hash::extract($lastTradeInfo, 'DataBanksIntraday.{n}'), '{n}.id', 'asc'));

            $yesterdayTradeInfo['DataBanksIntraday'] = Hash::combine(Hash::sort(Hash::extract($yesterdayTradeInfo, 'DataBanksIntraday.{n}'), '{n}.id', 'asc'), '{n}.instrument_code', '{n}');

            //pr($lastTradeInfo);
            $this->yesterdayTradeInfo = $yesterdayTradeInfo;
        }
        return $this->yesterdayTradeInfo;

    }

    public function home()
    {

      //  Configure::write('debug', 2);

        App::uses('CakeTime', 'Utility');


        $adsArr=Configure::read('ads');
        $dsb = $this->Components->load('Dsb');
        $allnews=$dsb->getLatestNews(5);

        $this->set('allnews',$allnews['live']);
        $this->set('interviewArr',$allnews['interview']);
        $this->set('ipo',$allnews['ipo']);
        $this->set('agm',$allnews['agm']);
        $this->set('marketAnalysis',$allnews['marketAnalysis']);
       // pr($allnews);

//exit;

        //CakeResponse::compress()
        $StockBangladesh = $this->Components->load('StockBangladesh');



        /*
         * TRY TO MINIMUM USE MODEL IN COMPONENT. SO WE ARE USING _prepareLastTradeInfo INSTEAD OF $this->StockBangladesh->getLastTradeInfo();
         */
       // $lastTradeInfo=$this->StockBangladesh->getLastTradeInfo();
        $lastTradeInfoToday = $this->_prepareLastTradeInfo();
        $lastTradeInfoYesterday = $this->_prepareLastTradeInfo(1);
        $lastTradeInfo = $StockBangladesh->merge_with_yesterday($lastTradeInfoToday, $lastTradeInfoYesterday);
     //   pr($lastTradeInfo);
      //  exit;
        $this->set('lastTradeInfo', $lastTradeInfo);
   /*     echo "<pre>";
print_r($lastTradeInfoToday);
        exit;*/
//print_r($_SESSION);
        //$this->Session->write('Auth.User.uuid','test');
        /*  pr($this->Session->read('Auth.User'));
          pr($this->Auth->user());
          exit;*/
        //$this->set('lastTradeInfo', $lastTradeInfo);
        //pr($lastTradeInfo);

     /*   $nextTradeInfo = Cache::read('nextTradeInfo');
        $exchangeId = Configure::read('EXCHANGE_ID');
        //$nextTradeInfo = Cache::delete('nextTradeInfo');
        if (!$nextTradeInfo) {
            //pr("mem empty here");
            $nextTradeInfo = $this->Market->find('first', array(
                'order' => array('Market.id' => 'asc'),
                'conditions' => "Market.is_trading_day=2 and Market.exchange_id=$exchangeId",
                'recursive' => 0
            ));
            Cache::write('nextTradeInfo', $nextTradeInfo, 'minute');

        }*/


        /*
         * @TODO TIME SHOULD BE INTERNATIONALIZE. CONSIDER USER TIME ZONE
         */

//    pr(CakeTime::nice(CakeTime::fromString('Dec 19 2013 02:30:53:073PM')));

        /*
                $tradeDayTime = $lastTradeInfo['Market']['trade_date'] . " " . $lastTradeInfo['Market']['market_closed'];
                if (CakeTime::isPast($tradeDayTime)) {
                    $nextTradeDayTime = $nextTradeInfo['Market']['trade_date'] . " " . $nextTradeInfo['Market']['market_started'];
                    $remainingTime = CakeTime::fromString($nextTradeDayTime) - CakeTime::fromString('now');
                    $remainingText = "to open market";
                } else {
                    $remainingTime = CakeTime::fromString($tradeDayTime) - CakeTime::fromString('now');
                    $remainingText = "to close market";
                }
                $this->set('remainingTime', $remainingTime);
                $this->set('remainingText', $remainingText);*/

        // DSEX CHART





$this->set('table_row_display',5);
        //$this->market_summary(0);
     //   $this->index_chart(0);
     //   $this->trade_chart(0);
      //  $this->value_chart(0);

    }

    // No of trade chart
    public function trade_chart($ajax = 1)
    {
        App::uses('CakeTime', 'Utility');

        if ($ajax)
            $this->layout = 'ajax'; //WHEN THIS CALLED FROM AJAX CHANGE THE LAYOUT TO AJAX


        $StockBangladesh = $this->Components->load('StockBangladesh');
        $lastTwoMarketInfoArr = $StockBangladesh->getMarketInfo(0, 0);
        $marketId = $lastTwoMarketInfoArr[0]['Market']['id'];
        $yesterdayMarketId = $lastTwoMarketInfoArr[1]['Market']['id'];

        $lastTradeStats = $StockBangladesh->getLastTradeStats($marketId);
        $yesterdayTradeInfo = $StockBangladesh->getYesterdayLastTradeStats($yesterdayMarketId);

        $showBarLimit = 120;

        /*    $ld=$lastTradeInfo['DataBanksIntradayLast'];

            //$ld=Hash::insert($ld, '{s}.new', 'value');
            $yld=$yesterdayTradeInfo['DataBanksIntraday'];

            $rld=$StockBangladesh->merge_trade_info($lastTradeInfo['DataBanksIntradayLast'],$yesterdayTradeInfo['DataBanksIntraday']);
            //pr($rld);
            //$yld=Hash::insert($yld, '{s}.ynew', 'yvalue');
            //pr($lastTradeInfo['DataBanksIntradayLast']);
            //pr($yesterdayTradeInfo['DataBanksIntraday']);
            //pr(Hash::merge($yld,$ld));
        */

        // TRADE CHART---START
        $chartName = 'trade Chart';
        $tradeVal = Hash::extract($lastTradeStats, '{s}.TRD_TOTAL_TRADES');


        $tradeValYesterday = Hash::extract($yesterdayTradeInfo, '{s}.TRD_TOTAL_TRADES');


        $tradeTime = Hash::extract($lastTradeStats, '{s}.trade_time');
        $tradeTimeYesterday = Hash::extract($yesterdayTradeInfo, '{s}.trade_time');


        $tradeValDiff = $StockBangladesh->array_subtract($tradeVal);

        $totalPointToday = count($tradeValDiff);
        $tradeValDiffYesterday = $StockBangladesh->array_subtract($tradeValYesterday);

       // $tradeValDiffYesterday = array();  // to show only todays chart
     //   $totalPointToday = 120; // to show only todays chart
        $tradeValDiffAll = Hash::merge($tradeValDiff, $tradeValDiffYesterday);
        /*  pr($tradeValDiffYesterday);
          pr($tradeValDiff);

          exit;*/
        $tradeTimeAll = Hash::merge($tradeTime, $tradeTimeYesterday);


        $dateTime = Hash::map($tradeTimeAll, '{n}', function ($newArr) {
            return CakeTime::format('h:i A', $newArr);
            //return CakeTime::format('d h:i',$newArr);
        });

        $dateTime = array_slice($dateTime, 0, $showBarLimit);
        $tradeValDiffAll = array_slice($tradeValDiffAll, 0, $showBarLimit);

        $dateTime = Hash::sort($dateTime, ' ', 'desc');;
        $tradeValDiff = Hash::sort($tradeValDiffAll, ' ', 'desc');


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
                'creditsEnabled' => true,
                'creditsText' => 'StockBangladesh.com',
                'creditsURL' => 'http://stockbangladesh.com',
                //'tickInterval' => 'auto'
            )
        );
        $mychart->xAxis->tickInterval = 15;
        if ($showBarLimit > $totalPointToday) {
            $mychart->xAxis->plotBands->from = 0;
            $mychart->xAxis->plotBands->to = $showBarLimit - $totalPointToday;
            $mychart->xAxis->plotBands->color = 'rgba(68, 170, 213, .2)';
            $mychart->xAxis->plotBands->label->text = 'yesterday';
        }
        $mychart->yAxis->title->text = "No of trades";
        $mychart->chart->zoomType = 'x';
        $mychart->plotOptions->series->marker->radius = 2;
        $mychart->plotOptions->series->marker->symbol = 'triangle';
        $series = $this->HighCharts->addChartSeries();
        $series->addName('vol')->addData($tradeValDiff);
        $series->showInLegend = false;
        $mychart->addSeries($series);
        // TRADE CHART---END


    }

    public function market_summary($ajax = 1)
    {
        /* $this->request->addDetector('internalIp', array(
             'env' => 'CLIENT_IP',
             'options' => array('127.0.0.1')
         ));

         if($this->request->is('internalIp'))
            // echo "OK";
             $this->set('call', "Internal IP");
        else
            $this->set('call', "Browser IP");
       //  exit;*/

        App::uses('CakeTime', 'Utility');
        $StockBangladesh = $this->Components->load('StockBangladesh');
        if ($ajax)
            $this->layout = 'ajax'; //WHEN THIS CALLED FROM AJAX CHANGE THE LAYOUT TO AJAX

        $lastTradeInfo = $this->_prepareLastTradeInfo();
        $yesterdayLastTradeInfo = $this->_prepareLastTradeInfo(0);

        $lastTradeInfo = $StockBangladesh->merge_with_yesterday($lastTradeInfo, $yesterdayLastTradeInfo);

        $marketId = $StockBangladesh->getMarketInfo(0);
        $lastIndexValues = $StockBangladesh->getLastIndexValues($marketId);
        $lastTradeStats = $StockBangladesh->getLastTradeStats($marketId);

        //pr(Hash::extract($lastTradeInfo, '{n}[change>0]'));
        //pr(Hash::sort(Hash::extract($lastTradeInfo, '{n}[change>0]'), '{n}.change_per', 'desc'));
        //exit;
        $databank_change_up = Hash::sort(Hash::extract($lastTradeInfo, '{n}[change>0]'), '{n}.change_per', 'desc');
        $this->set('lastTradeInfo', $lastTradeInfo);
        $this->set('lastIndexValues', $lastIndexValues);
        $this->set('lastTradeStats', $lastTradeStats);

        // TRADE CHART---START

    }

    public function value_chart($ajax = 1)
    {
        App::uses('CakeTime', 'Utility');

        if ($ajax)
            $this->layout = 'ajax'; //WHEN THIS CALLED FROM AJAX CHANGE THE LAYOUT TO AJAX

        $StockBangladesh = $this->Components->load('StockBangladesh');
        $lastTwoMarketInfoArr = $StockBangladesh->getMarketInfo(0, 0);
        $marketId = $lastTwoMarketInfoArr[0]['Market']['id'];
        $yesterdayMarketId = $lastTwoMarketInfoArr[1]['Market']['id'];

        $lastTradeStats = $StockBangladesh->getLastTradeStats($marketId);
        $yesterdayTradeInfo = $StockBangladesh->getYesterdayLastTradeStats($yesterdayMarketId);


        // TRADE VALUE CHART---START

        $tradeVal = Hash::extract($lastTradeStats, '{s}.TRD_TOTAL_VALUE');
        $tradeValYesterday = Hash::extract($yesterdayTradeInfo, '{s}.TRD_TOTAL_VALUE');

        $tradeTime = Hash::extract($lastTradeStats, '{s}.trade_time');
        $tradeTimeYesterday = Hash::extract($yesterdayTradeInfo, '{s}.trade_time');

        $showBarLimit = 120;

        $tradeValDiff = $StockBangladesh->array_subtract($tradeVal);

        $totalPointToday = count($tradeValDiff);
        $tradeValDiffYesterday = $StockBangladesh->array_subtract($tradeValYesterday);

       // $tradeValDiffYesterday = array();  // to show only todays chart
     //   $totalPointToday = 120; // to show only todays chart
        $tradeValDiffAll = Hash::merge($tradeValDiff, $tradeValDiffYesterday);
        /*  pr($tradeValDiffYesterday);
          pr($tradeValDiff);

          exit;*/
        $tradeTimeAll = Hash::merge($tradeTime, $tradeTimeYesterday);


        $dateTime = Hash::map($tradeTimeAll, '{n}', function ($newArr) {
            return CakeTime::format('h:i A', $newArr);
            //return CakeTime::format('d h:i',$newArr);
        });

        $dateTime = array_slice($dateTime, 0, $showBarLimit);
        $tradeValDiffAll = array_slice($tradeValDiffAll, 0, $showBarLimit);

        $dateTime = Hash::sort($dateTime, ' ', 'desc');;
        $tradeValDiff = Hash::sort($tradeValDiffAll, ' ', 'desc');


        // $yMin=Hash::apply($ds30Data, '{n}', 'min');
        // $dateTime=Hash::sort($arrDate, ' ', 'desc');;
        $chartName = 'value Chart';

        $mychart = $this->HighCharts->create($chartName, 'column');

        $this->HighCharts->setChartParams(
            $chartName,
            array(
                'renderTo' => 'value_div', // div to display chart inside
                //'chartWidth'=> 400,
                'chartHeight' => 110,
                'xAxisCategories' => $dateTime,
                'enableAutoStep' => false,
                'creditsEnabled' => true,
                'creditsText' => 'StockBangladesh.com',
                'creditsURL' => 'http://stockbangladesh.com',
                //'tickInterval' => 'auto'
            )
        );
        $mychart->xAxis->tickInterval = 30;
        if ($showBarLimit > $totalPointToday) {
            $mychart->xAxis->plotBands->from = 0;
            $mychart->xAxis->plotBands->to = $showBarLimit - $totalPointToday;
            $mychart->xAxis->plotBands->color = 'rgba(68, 170, 213, .2)';
            $mychart->xAxis->plotBands->label->text = 'yesterday';
        }
        $mychart->yAxis->title->text = "Trade Value";
        $mychart->chart->zoomType = 'x';
        $mychart->plotOptions->series->marker->radius = 2;
        $mychart->plotOptions->series->marker->symbol = 'triangle';
        $series = $this->HighCharts->addChartSeries();
        $series->addName('vol')->addData($tradeValDiff);
        $series->showInLegend = false;
        $mychart->addSeries($series);
        // TRADE VALUE CHART---END

    }


    public function index_chart($ajax = 1)
    {
        App::uses('CakeTime', 'Utility');
        $StockBangladesh = $this->Components->load('StockBangladesh');
        if ($ajax)
            $this->layout = 'ajax'; //WHEN THIS CALLED FROM AJAX CHANGE THE LAYOUT TO AJAX

        // DSEX CHART---START
        $chartName = 'DSEX Chart';
        //$lastTradeInfo = $this->_prepareLastTradeInfo();

        $marketId = $StockBangladesh->getMarketInfo(0);
        $lastIndexValues = $StockBangladesh->getLastIndexValues($marketId);

        $dsExData = Hash::extract(Hash::extract($lastIndexValues, '{n}.{s}[instrument_id=10001]'), '{n}.capital_value');

        // pr(Hash::extract($lastIndexValues, '{n}.{s}[instrument_id=10002]'));
        // pr($dsExData);
        //  exit;


        $arr = Hash::map($dsExData, '{n}', function ($newArr) {
            return $newArr + 0;
        });

        $dsExData = Hash::sort($arr, ' ', 'desc');

        $dateTime = Hash::extract(Hash::extract($lastIndexValues, '{n}.{s}[instrument_id=10001]'), '{n}.index_time');
        $arrDate = Hash::map($dateTime, '{n}', function ($newArr) {
            return CakeTime::format('h:i A', $newArr);
        });
        $yMin = Hash::apply($dsExData, '{n}', 'min');
        $dateTime = Hash::sort($arrDate, ' ', 'desc');;

        $mychart = $this->HighCharts->create($chartName, 'areaspline');

        $this->HighCharts->setChartParams(
            $chartName,
            array(
                'renderTo' => 'dsex_div', // div to display chart inside
                'chartHeight' => 200,
                'xAxisCategories' => $dateTime,
                'yAxisMin' => $yMin,
                'enableAutoStep' => false,
                'creditsEnabled' => true,
                'creditsText' => 'StockBangladesh.com',
                'creditsURL' => 'http://stockbangladesh.com',
                //'tickInterval' => 'auto'
            )
        );
        $mychart->xAxis->tickInterval = 8;
        $series = $this->HighCharts->addChartSeries();
        $series->addName('DSEX')->addData($dsExData);
        $series->showInLegend = false;
        $mychart->plotOptions->series->marker->radius = 2;
        $mychart->plotOptions->series->marker->symbol = 'triangle';
        $mychart->addSeries($series);
        // DSEX CHART---END

        // DS30 CHART---START
        $chartName = 'DS30 Chart';
        $ds30Data = Hash::extract(Hash::extract($lastIndexValues, '{n}.{s}[instrument_id=10002]'), '{n}.capital_value');
        $arr = Hash::map($ds30Data, '{n}', function ($newArr) {
            return $newArr + 0;
        });

        $ds30Data = Hash::sort($arr, ' ', 'asc');
        $dateTime = Hash::extract(Hash::extract($lastIndexValues, '{n}.{s}[instrument_id=10001]'), '{n}.index_time');
        $arrDate = Hash::map($dateTime, '{n}', function ($newArr) {
            return CakeTime::format('h:i A', $newArr);
        });
        $yMin = Hash::apply($ds30Data, '{n}', 'min');
        $dateTime = Hash::sort($arrDate, ' ', 'desc');;

        $mychart = $this->HighCharts->create($chartName, 'areaspline');

        $this->HighCharts->setChartParams(
            $chartName,
            array(
                'renderTo' => 'ds30_div', // div to display chart inside
                'chartWidth' => 400,
                'chartHeight' => 200,
                'xAxisCategories' => $dateTime,
                'yAxisMin' => $yMin,
                'enableAutoStep' => false,
                'creditsEnabled' => true,
                'creditsText' => 'StockBangladesh.com',
                'creditsURL' => 'http://stockbangladesh.com',
                //'tickInterval' => 'auto'
            )
        );
        $mychart->xAxis->tickInterval = 8;
        $mychart->plotOptions->series->marker->radius = 2;
        $mychart->plotOptions->series->marker->symbol = 'triangle';
        $series = $this->HighCharts->addChartSeries();
        $series->addName('DS30')->addData($ds30Data);
        $series->showInLegend = false;
        $mychart->addSeries($series);
        // DS30 CHART---END


    }

    public function layout_test()
    {
        $this->layout = 'layout';
        $this->set('param', 100);
    }

    public function test()
    {
        $this->layout = 'default_3_3';


    }

    public function modal($type)
    {
        $this->layout = 'ajax';
        $this->set('type', $type);

    }

    public function send_feedback()
    {
        $this->layout = 'ajax';

    }

    public function search_result()
    {
        $this->layout = 'ajax';
        $StockBangladesh = $this->Components->load('StockBangladesh');
        //echo "here";
        //print_r($this->request->query['q']);
        $key = $this->request->query['q'];
        //$key='BANK';
        $key = strtoupper($key);
        $lastTradeInfo = $this->_prepareLastTradeInfo();
        $yesterdayLastTradeInfo = $this->_prepareLastTradeInfo(0);

        $lastTradeInfo = $StockBangladesh->merge_with_yesterday($lastTradeInfo, $yesterdayLastTradeInfo);
        // pr($lastTradeInfo);
        //pr(Hash::extract($lastTradeInfo['DataBanksIntraday'], "{s}[instrument_code=/.*$key.*/]"));
        $result = Hash::extract($lastTradeInfo, "{n}[instrument_code=/.*$key.*/]");
        echo json_encode($result);
        exit;
        //

    }

    function mail_test()
    {
        App::uses('CakeEmail', 'Network/Email');
        $Email = new CakeEmail('test');
        $Email->template('email2');
        $Email->emailFormat('html');
        $Email->viewVars(array('value' => 'This is me penetrating here :)'));
        $Email->from(array('info@stockbangladesh.com' => 'My Site'));
        $Email->to('afmsohail@gmail.com');
        $Email->subject('About');
        $Email->send();

        /* $Email->template('welcome', 'fancy')
             ->emailFormat('html')
             ->to('bob@example.com')
             ->from('app@domain.com')
             ->send();*/

        exit;
    }

    public function anychart()
    {
        $this->layout = 'default-anychart';

    }

    public function market_composition()
    {
       //  Configure::write('debug', 2);


        $colorArr = array('#7cb5ec', '#434348', '#90ed7d', '#f7a35c', '#8085e9',
            '#f15c80', '#e4d354', '#8085e8', '#8d4653', '#91e8e1', '#2f7ed8', '#0d233a', '#8bbc21', '#910000', '#1aadce',
            '#492970', '#f28f43', '#77a1e5', '#c42525', '#a6c96a', '#4572A7', '#AA4643', '#89A54E', '#80699B', '#3D96AE',
            '#DB843D', '#92A8CD', '#A47D7C', '#B5CA92');

        $lastTradeInfoToday = $this->_prepareLastTradeInfo();


        $lastTradeInfoYesterday = $this->_prepareLastTradeInfo(0);



        $StockBangladesh = $this->Components->load('StockBangladesh');
        $sectorWiseInstrumentList = $StockBangladesh->instrumentList(1);


        $outerCircle = array(); // Today
        $innerCircle = array(); // Yesterday
        $drillMainArr = array();
        $drillArr = array();
        $category = array();
        $barChartDataToday = array();
        $barChartDataYesterday = array();
        $gainerLoserArr = array();
        $i = 0;
        // pr($lastTradeInfoToday);
        //    exit;
        foreach ($sectorWiseInstrumentList as $sectorName => $InstrumentArr) {


            $sectorWiseTradeValueArrToday[$i] = 0;
            $gainerLoserArr[$sectorName]['up'] = 0;
            $gainerLoserArr[$sectorName]['down'] = 0;
            $gainerLoserArr[$sectorName]['eq'] = 0;

            $gainerLoserArr[$sectorName]['-2'] = 0;
            $gainerLoserArr[$sectorName]['-2_0'] = 0;
            $gainerLoserArr[$sectorName]['0_2'] = 0;
            $gainerLoserArr[$sectorName]['+2'] = 0;

            $drillSubArrToday = array();
            $drillSubArrToday['id'] = $i;

            $data = array();
            foreach ($InstrumentArr as $instrumentId => $instrumentCode) {
                $localTemp = array();
                if (isset($lastTradeInfoToday[$instrumentId]['total_value'])) {
                    $sectorWiseTradeValueArrToday[$i] += $lastTradeInfoToday[$instrumentId]['total_value'];

                    $localTemp[] = $instrumentCode;
                    $localTemp[] = $lastTradeInfoToday[$instrumentId]['total_value'] + 0;
                    $data[] = $localTemp;

                    if ($lastTradeInfoToday[$instrumentId]['pub_last_traded_price'] > $lastTradeInfoToday[$instrumentId]['yday_close_price']) {
                        ++$gainerLoserArr[$sectorName]['up'];
                    } elseif ($lastTradeInfoToday[$instrumentId]['pub_last_traded_price'] < $lastTradeInfoToday[$instrumentId]['yday_close_price']) {
                        ++$gainerLoserArr[$sectorName]['down'];
                    } elseif ($lastTradeInfoToday[$instrumentId]['pub_last_traded_price'] == $lastTradeInfoToday[$instrumentId]['yday_close_price']) {
                        ++$gainerLoserArr[$sectorName]['eq'];
                    }

                    $change = $lastTradeInfoToday[$instrumentId]['pub_last_traded_price'] - $lastTradeInfoToday[$instrumentId]['yday_close_price'];
                    $changePer = ($change / $lastTradeInfoToday[$instrumentId]['yday_close_price']) * 100;

                    if ($changePer < -2) {
                        ++$gainerLoserArr[$sectorName]['-2'];
                    } elseif (-2 <= $changePer and $changePer < 0) {
                        ++$gainerLoserArr[$sectorName]['-2_0'];
                    } elseif (0 <= $changePer and $changePer < 2) {
                        ++$gainerLoserArr[$sectorName]['0_2'];
                    } elseif (2 <= $changePer) {
                        ++$gainerLoserArr[$sectorName]['+2'];
                    }

                }

                if (isset($lastTradeInfoToday[$instrumentId]['lm_date_time'])) {
                    $outerDate = $lastTradeInfoToday[$instrumentId]['lm_date_time'];
                }

            }
            $drillSubArrToday['data'] = $data;

            $sectorWiseTradeValueArrPrevDay[$i] = 0;
            foreach ($InstrumentArr as $instrumentId => $instrumentCode) {
                if (isset($lastTradeInfoYesterday[$instrumentId]['total_value'])) {
                    $sectorWiseTradeValueArrPrevDay[$i] += $lastTradeInfoYesterday[$instrumentId]['total_value'];
                }
                if (isset($lastTradeInfoYesterday[$instrumentId]['lm_date_time'])) {
                    $innerDate = $lastTradeInfoYesterday[$instrumentId]['lm_date_time'];
                }
            }

            $color = $colorArr[$i % 10];

            // TODAY TRADE VALUE
            $temp = array();
            $temp['name'] = $sectorName;
            $temp['color'] = $color;
            $barChartDataToday[$sectorName] = $temp['y'] = number_format($sectorWiseTradeValueArrToday[$i], 2, '.', '') + 0;
            $outerCircle[] = $temp;

            // YESTERDAY TRADE VALUE
            $temp = array();
            $temp['name'] = $sectorName;
            $temp['color'] = $color;
            $barChartDataYesterday[$sectorName] = $temp['y'] = number_format($sectorWiseTradeValueArrPrevDay[$i], 2, '.', '') + 0;
            $innerCircle[] = $temp;

            // DRILL MAIN ARRAY
            $temp = array();
            $temp['name'] = $sectorName;
            $temp['drilldown'] = $i;
            $temp['y'] = number_format($sectorWiseTradeValueArrToday[$i], 2, '.', '') + 0;
            $drillMainArr[] = $temp;
            $drillArr[] = $drillSubArrToday;

            $i++;
        }


        $this->set('outerCircle', json_encode($outerCircle));
        $this->set('innerCircle', json_encode($innerCircle));
        $this->set('innerDate', $innerDate);
        $this->set('outerDate', $outerDate);

        $this->set('drillMainArr', json_encode($drillMainArr));
        $this->set('drillArr', json_encode($drillArr));

        arsort($barChartDataToday);
        $barChartDataTodaySorted = array();
        $barChartDataYesterdaySorted = array();
        $barChartDataTodayPer = array();
        $barChartDataYesterdayPer = array();
        $todayTotalTrade = array_sum($barChartDataToday);
        $yesTerdayTotalTrade = array_sum($barChartDataYesterday);

        foreach ($barChartDataToday as $eachSector => $totalTradeValue) {
            $category[] = $eachSector;
            $barChartDataTodaySorted[] = $totalTradeValue;
            $barChartDataYesterdaySorted[] = $barChartDataYesterday[$eachSector];

            $x = ($totalTradeValue / $todayTotalTrade) * 100;
            $barChartDataTodayPer[] = number_format($x, 2, '.', '') + 0;

            $x = ($barChartDataYesterday[$eachSector] / $yesTerdayTotalTrade) * 100;
            $barChartDataYesterdayPer[] = number_format($x, 2, '.', '') + 0;

        }

        $this->set('category', json_encode($category));
        $this->set('barChartDataToday', json_encode($barChartDataTodaySorted));
        $this->set('barChartDataYesterday', json_encode($barChartDataYesterdaySorted));
        $this->set('barChartDataTodayPer', json_encode($barChartDataTodayPer));
        $this->set('barChartDataYesterdayPer', json_encode($barChartDataYesterdayPer));

     //   pr($gainerLoserArr);
     //   exit;
        $gainerLoserCat = array();
        $up = array();
        $down = array();
        $eq = array();
        foreach ($gainerLoserArr as $sectorName => $stats) {
            $total = $stats['up'] + $stats['down'] + $stats['eq'];
            if(!$total)
                continue;

            $gainerLoserCat[] = $sectorName;
            $up[] = $stats['up'];
            $down[] = $stats['down'];
            $eq[] = $stats['eq'];
            $total = $stats['up'] + $stats['down'] + $stats['eq'];
            $range_2[] = ($stats['-2'] /$total)*100;
            $range_2_0[] = ($stats['-2_0'] /$total)*100;
            $range_0_2[] = ($stats['0_2'] /$total)*100;
            $range_plus_2[] = ($stats['+2'] /$total)*100;
        }
        $this->set('gainerLoserCat', json_encode($gainerLoserCat));
        $this->set('up', json_encode($up));
        $this->set('down', json_encode($down));
        $this->set('eq', json_encode($eq));

        $this->set('range_2', json_encode($range_2));
        $this->set('range_2_0', json_encode($range_2_0));
        $this->set('range_0_2', json_encode($range_0_2));
        $this->set('range_plus_2', json_encode($range_plus_2));



        App::uses('CakeTime', 'Utility');

        $lastTwoMarketInfoArr = $StockBangladesh->getMarketInfo(0, 0);
        $marketId = $lastTwoMarketInfoArr[0]['Market']['id'];
        $yesterdayMarketId = $lastTwoMarketInfoArr[1]['Market']['id'];

        $lastIndexValues = $StockBangladesh->getLastIndexValues($marketId);
        $prevIndexValues = $StockBangladesh->getYesterdayLastIndexValues($yesterdayMarketId);

        $dateTime = Hash::extract(Hash::extract($prevIndexValues, '{n}.{s}[instrument_id=10001]'), '{n}.index_time');
        $arrDate = Hash::map($dateTime, '{n}', function ($newArr) {
            return CakeTime::format('h:i A', $newArr);
        });

        $dsExData = Hash::extract(Hash::extract($lastIndexValues, '{n}.{s}[instrument_id=10001]'), '{n}.capital_value');
        $arrToday = Hash::map($dsExData, '{n}', function ($newArr) {
            return $newArr + 0;
        });
        $dsExData = Hash::extract(Hash::extract($prevIndexValues, '{n}.{s}[instrument_id=10001]'), '{n}.capital_value');
        $arrYesterday = Hash::map($dsExData, '{n}', function ($newArr) {
            return $newArr + 0;
        });
      /*  echo "<pre>";
        print_r($lastTwoMarketInfoArr);
        print_r($arrYesterday);
//pr($lastTwoMarketInfoArr);
        exit;*/

        $todayTradeDate=$lastTwoMarketInfoArr[0]['Market']['trade_date'];
        $yesterdayTradeDate=$lastTwoMarketInfoArr[1]['Market']['trade_date'];
        $arrToday=array_reverse($arrToday);
        $arrYesterday=array_reverse($arrYesterday);
        $arrDate=array_reverse($arrDate);
        $this->set('arrDate', json_encode($arrDate));
        $this->set('arrToday', json_encode($arrToday));
        $this->set('arrYesterday', json_encode($arrYesterday));
        $this->set('todayTradeDate', $todayTradeDate);
        $this->set('yesterdayTradeDate', $yesterdayTradeDate);


    }

    public function market_events()
    {
        App::uses('CakeTime', 'Utility');
        $chart = $this->Components->load('Chart');
        $ca=$chart->getCorporateAction();

        $recordDate=Hash::extract($ca, '{n}.CorporateAction.record_date');
        $newArr=array();
        $selectedDates=array();
        $selectedText=array();
        foreach($ca as $action)
        {
            $date=$action['CorporateAction']['record_date'];
            $d = CakeTime::format('m/d/Y', $date);
            $newArr[$d]=$action['CorporateAction']['action'];
           $selectedDates[$d]=$d;
            $selectedText[$d]=$action['CorporateAction']['action'];
        }
//pr($newArr);

        $this->set('eventDate',json_encode($newArr));
        $this->set('selectedDates',json_encode($selectedDates));
        $this->set('selectedText',json_encode($selectedText));

    }

    function get_web_page($url)
    {
        $options = array(
            CURLOPT_RETURNTRANSFER => true, // return web page
            CURLOPT_HEADER => false, // don't return headers
            CURLOPT_FOLLOWLOCATION => true, // follow redirects
            CURLOPT_ENCODING => "", // handle all encodings
            CURLOPT_USERAGENT => "spider", // who am i
            CURLOPT_AUTOREFERER => true, // set referer on redirect
            CURLOPT_REFERER => "http://www.dsebd.org/mkt_depth_3.php", // set referer on redirect
            CURLOPT_CONNECTTIMEOUT => 120, // timeout on connect
            CURLOPT_TIMEOUT => 120, // timeout on response
            CURLOPT_MAXREDIRS => 10, // stop after 10 redirects
        );

        $ch = curl_init($url);
        curl_setopt_array($ch, $options);
        $content = curl_exec($ch);
        $err = curl_errno($ch);
        $errmsg = curl_error($ch);
        $header = curl_getinfo($ch);
        curl_close($ch);

        $header['errno'] = $err;
        $header['errmsg'] = $errmsg;
        $header['content'] = $content;
        return $content; //$header;
    }
    public function temp()
    {

        require_once(APP . 'Vendor' . DS . 'simplehtmldom/simple_html_dom.php');

        $html = file_get_html('http://www.dsebd.org/Company_AGM.htm');

// find all link
    /*    foreach($html->find('a') as $e)
            echo $e->href . '<br>';

// find all image
        foreach($html->find('img') as $e)
            echo $e->src . '<br>';

// find all image with full tag
        foreach($html->find('img') as $e)
            echo $e->outertext . '<br>';

// find all div tags with id=gbar
        foreach($html->find('div#gbar') as $e)
            echo $e->innertext . '<br>';

// find all span tags with class=gb1
        foreach($html->find('span.gb1') as $e)
            echo $e->outertext . '<br>';

// find all td tags with attribite align=center
        foreach($html->find('td[align=center]') as $e)
            echo $e->innertext . '<br>';

// extract text from table
        echo $html->find('td[align="center"]', 1)->plaintext.'<br><hr>';*/

// extract text from HTML
       // echo $html->plaintext;
$i=1;
        foreach($html->find('td') as $e) {
            echo "$i=> " . $e->plaintext . '<br>';
            ++$i;
        }


        exit;
    }

}

