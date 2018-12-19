<?php
App::uses('AppController', 'Controller');
/**
 * Instruments Controller
 *
 */
class InstrumentsController extends AppController
{

    /**
     * Scaffold
     *
     * @var mixed
     */
    public $scaffold;
    public $helpers = array('StockBangladesh');
   // var $uses = array('Feedbacks');
    public function beforeFilter()
    {
        parent::beforeFilter();

        //$this->Auth->allow('test');
        $this->Auth->allow();

    }

    public function details($instrumentId = 12)
    {
        $this->layout = 'default_3_3';
        //ini_set('memory_limit', '512M');
        $Chart = $this->Components->load('Chart');
        $today = date("Y-m-d");

        $dateBefore52weeks = strtotime("$today -1 year");
        $dateBefore52weeks = date("Y-m-d", $dateBefore52weeks);

        $data52Weeks = $Chart->getDailyData($instrumentId, $dateBefore52weeks, $today);
        $maxs = array_keys($data52Weeks['close'], max($data52Weeks['close']));

        $adjustedData52Weeks = $Chart->getAdjustedDailyData($instrumentId, $dateBefore52weeks, $today);

       /* $this->loadModel('Feedbacks');
        $instrumentList = $this->Feedbacks->find('all', array(
            'recursive' => -1
        ));
        pr($instrumentList);
        exit;*/
        $StockBangladesh = $this->Components->load('StockBangladesh');

        $lastTwoMarketInfoArr = $StockBangladesh->getMarketInfo(0, 0);
        $marketId = $lastTwoMarketInfoArr[0]['Market']['id'];
        $yesterdayMarketId = $lastTwoMarketInfoArr[1]['Market']['id'];

        $yesterdayTradeInfo = $StockBangladesh->getYesterdayTradeInfo($yesterdayMarketId,$instrumentId);

        $lastTradeInfo = $StockBangladesh->getLastTradeInfo($marketId,$instrumentId);

        $prevMinuteTradeInfo = $StockBangladesh->getPrevMinuteInfo($lastTradeInfo);
//$tagsArr=array('uarte','eps','EGM','Q1');
        $tagsArr=array('q1'=>'(Q1)','h_y'=>'H/Y','eps'=>'EPS','agm'=>'AGM','q3'=>'(Q3)','rd'=>'record date','dividend'=>'Dividend');
        //$tagsCss=array('Q1','EPS','AGM','Q3','record_date');
        $newsList = $StockBangladesh->getInstrumentNewsWithTags($instrumentId,$tagsArr);

       /* $companyDataYesterday = Hash::extract($yesterdayTradeInfo, "{n}.{s}[instrument_id=$instrumentId]");
        $companyDataToday = Hash::extract($lastTradeInfo, "{n}[instrument_id=$instrumentId]");
        $companyDataPrevMinute = Hash::extract($prevMinuteTradeInfo, "{n}[instrument_id=$instrumentId]");*/



        /*$companyData = $companyData[0];

        $ltp = $companyData['close_price'] != 0 ? $companyData['close_price'] : ($companyData['pub_last_traded_price'] != 0 ? $companyData['pub_last_traded_price'] : $companyData['spot_last_traded_price']);
        $companyData['changePer'] = (($companyData['yday_close_price'] - $ltp) / $companyData['yday_close_price']) * 100;
        $companyData['change'] = $companyData['yday_close_price'] - $ltp;*/
        //  pr($adjustedData52Weeks);
         //exit;
        //pr($fundamentalDataAll = $this->Instrument->Fundamental->find('all', array('contain' => 'FundamentalMeta', 'conditions' => array('Fundamental.instrument_id' => $instrumentId), 'order' => array('Fundamental.meta_date ASC'))));
       // pr($fundamentalDataOrganized = Hash::combine($fundamentalDataAll, '{n}.FundamentalMeta.meta_key', '{n}.Fundamental'));
        $fundamentalDataOrganized = $StockBangladesh->getFundamentalInfo($instrumentId);
//pr($fundamentalDataOrganized);
//exit;
        $instrumentInfo=$StockBangladesh->instrumentInfo($instrumentId);




        $this->set("fundamentalDataOrganized", $fundamentalDataOrganized);
        $this->set("lastTradeInfo", $lastTradeInfo[0]);
        $this->set("yesterdayTradeInfo", $yesterdayTradeInfo[0]);
        $this->set("prevMinuteTradeInfo", $prevMinuteTradeInfo);
        $this->set("data52Weeks", $data52Weeks);
        $this->set("adjustedData52Weeks", $adjustedData52Weeks);
        $this->set("instrumentId", $instrumentId);
        $this->set("instrumentInfo", $instrumentInfo);
        $this->set("newsList", $newsList);
        $this->set("tagsArr", $tagsArr);

    }

    public function minute_chart($instrumentId=12)
    {
      //  Configure::write('debug', 2);
        App::uses('CakeTime', 'Utility');

        $chart = $this->Components->load('Chart');

        $StockBangladesh = $this->Components->load('StockBangladesh');
        $marketId = $StockBangladesh->getMarketInfo(0);

        $intradayData = $chart->getIntradayData($instrumentId,$marketId);
        $tradeTimeAll = $intradayData['t'];
        $dateTime = Hash::map($tradeTimeAll, '{n}', function ($newArr) {
            return "'" . CakeTime::format('h:i A', $newArr) . "'";
        });

        $instrumentInfo=$StockBangladesh->instrumentInfo($instrumentId);

     //   pr($intradayData);
     //   exit;

        $chartData['div'] = 'minute_chart_div'; // required
        $chartData['height'] = 300; // required
        $chartData['title'] = $instrumentInfo['Instrument']['name'];
        $chartData['xcat'] = $dateTime;
        $chartData['ydata'] = $intradayData['vc'];
        $chartData['xdata'] = $intradayData['c'];

        $this->set("chartData", $chartData);

    }

    public function market_monitor($instrumentId=12)
    {
        $StockBangladesh = $this->Components->load('StockBangladesh');
        $this->set('instrumentList', $StockBangladesh->instrumentList(3));

    }

    public function market_monitor_chart($instrumentId=12)
    {
       // Configure::write('debug', 2);
        $this->layout = 'ajax';
        App::uses('CakeTime', 'Utility');

        $chart = $this->Components->load('Chart');

        $StockBangladesh = $this->Components->load('StockBangladesh');
        $marketId = $StockBangladesh->getMarketInfo(0);
        $intradayData = $chart->getIntradayData($instrumentId,$marketId);

        $tradeTimeAll = $intradayData['t'];
        $dateTime = Hash::map($tradeTimeAll, '{n}', function ($newArr) {
            return "'" . CakeTime::format('h:i A', $newArr) . "'";
        });

        $instrumentInfo=$StockBangladesh->instrumentInfo($instrumentId);
//pr($instrumentInfo);
//        exit;

        $chartData['div'] = $instrumentInfo['Instrument']['instrument_code'].'_div_'.rand(1111,1111111); // required
        $chartData['height'] = 300; // required
        $chartData['title'] = $instrumentInfo['Instrument']['name'];
        $chartData['instrument_code'] = $instrumentInfo['Instrument']['instrument_code'];
        $chartData['xcat'] = $dateTime;
        $chartData['ydata'] = $intradayData['vc'];
        $chartData['xdata'] = $intradayData['c'];

        $this->set("chartData", $chartData);

    }

    public function sparkline_price($instrumentId=12,$change=0)
    {
        $this->layout = 'ajax';
        App::uses('CakeTime', 'Utility');

        $chart = $this->Components->load('Chart');

        $StockBangladesh = $this->Components->load('StockBangladesh');
        $marketId = $StockBangladesh->getMarketInfo(0);

        $intradayData = $chart->getIntradayData($instrumentId,$marketId);


        $chartData=array_slice($intradayData["c"], -15, 15,true);
        $chartDataV=array_slice($intradayData["vc"], -15, 15,true);
        $this->set("chartData", $chartData);
        $this->set("chartDataV", $chartDataV);
        $this->set("change", $change);

    }

    function pricescale($instrumentId = 12)
    {
        $StockBangladesh = $this->Components->load('StockBangladesh');
        $lastTradeInfo = $StockBangladesh->getLastTradeInfo();

        $companyData = Hash::extract($lastTradeInfo['DataBanksIntraday'], "{s}[instrument_id=$instrumentId]");

        $companyData = $companyData[0];
        $close = $companyData['close_price'];
        $high = $companyData['high_price'];
        $low = $companyData['low_price'];
        $code = $companyData['instrument_code'];
        $this->pricescalegenerator($high, $low, $close, $code);

    }

    function pricescalegenerator($high, $low, $close, $code)
    {
        require_once(APP . 'Vendor' . DS . 'chartdir' . DS . 'FinanceChart.php');
        $timesbiPath = WWW_ROOT . 'font' . DS . 'arialbd.ttf';

        $scal = ($high - $low) / 3;
        // $scal=round($scal,0);
        //$value = 75.35;
        # Create an LinearMeter object of size 250 x 75 pixels, using silver background with
        # a 2 pixel black 3D depressed border.
        $m = new LinearMeter(300, 75, 0xffffff, 0, 0);

        # Set the scale region top-left corner at (15, 25), with size of 200 x 50 pixels. The
        # scale labels are located on the top (implies horizontal meter)
        $m->setMeter(15, 25, 270, 20, Top);

        # Set meter scale from 0 - 100, with a tick every 10 units
        $m->setScale($low, $high, $scal);

        # Set 0 - 50 as green (99ff99) zone, 50 - 80 as yellow (ffff66) zone, and 80 - 100 as
        # red (ffcccc) zone
        $colorgap = ($high - $low) / 3;


        $m->addZone($low, $low + $colorgap, 0xEDDE15);
        $m->addZone($low + $colorgap, $low + $colorgap + $colorgap, 0xF7BD00);
        $m->addZone($low + $colorgap + $colorgap, $high, 0xF79000);

        # Add a blue (0000cc) pointer at the specified value
        $m->addPointer($close, 0x0000cc);

        # Add a label at bottom-left (10, 68) using Arial Bold/8 pts/red (c00000)
        $m->addText(10, 68, "$code", $timesbiPath, 8, 0xc00000, BottomLeft);

        # Add a text box to show the value formatted to 2 decimal places at bottom right. Use
        # white text on black background with a 1 pixel depressed 3D border.
        $textBoxObj = $m->addText(238, 70, $m->formatValue($close, "2"), $timesbiPath, 8, 0xffffff, BottomRight);
        $textBoxObj->setBackground(0, 0, -1);

        # Output the chart
        header("Content-type: image/png");
        print($m->makeChart2(PNG));
        exit();
    }

    function data_matrix()
    {
        //$this->layout = 'ajax';

        $this->pageTitle = "DataMatrix-Easy Sorting & Searching DSE Share";
        $this->set('js_asset_compression_enable', false);
        $this->set("meta_description", "Flexible search,sorting and grouping option like desktop tool for dse");
        $this->set("meta_keywords", "Dse,data,price information,price list");

    }
    function temp()
    {
        Configure::write('debug', 2);
     /*   $this->Instrument->unbindModel(
            array('hasMany' => array('CorporateAction','DataBanksEod','Fundamental'))
        );

        $this->Instrument->bindModel(
            array('hasMany' => array(
                'DataBanksIntraday' => array(
                    'className' => 'DataBanksIntraday',
                    'limit' => 1
                )
            )
            )
        );

        $instrumentList = $this->Instrument->find('all', array(

        ));

        pr($instrumentList);*/

        $StockBangladesh = $this->Components->load('StockBangladesh');
      //  pr($StockBangladesh->getLastTradeInfo());
        pr($StockBangladesh->getAllInsLtp());

      //  $db =& ConnectionManager::getDataSource('mainsb');
       // $db->showLog();
exit;
    }
    function get_data()
    {
       // Configure::write('debug', 2);
        $maingrid=array();

        $StockBangladesh = $this->Components->load('StockBangladesh');

            $marketId = $StockBangladesh->getMarketInfo(0);
            $lastTradeInfo = $StockBangladesh->getLastTradeInfo($marketId);

            $result = Hash::combine($lastTradeInfo, '{n}.{s}.trade_time', '{n}.{s}', '{n}.{s}.instrument_id');
            $DataBanksIntradayCombinedWithPrevMinute = $StockBangladesh->merge_last_two_minutes($result);



        $metaKey=array("name","category","market_lot","face_value");



        $fundamentaInfo = $StockBangladesh->getFundamentalInfo(0,$metaKey);
        $sectorList=$StockBangladesh->instrumentList(4);

        $temp=array();
       foreach($DataBanksIntradayCombinedWithPrevMinute as $instrumentId=>$arr)
       {
           $temp['id']=$instrumentId;
           $temp['code']=$arr['instrument_code'];
           $temp['sector']=$sectorList[$instrumentId];
           $temp['category']=$fundamentaInfo[$instrumentId]['category'];
           $temp['market_lot']=$fundamentaInfo[$instrumentId]['market_lot'];
           $temp['face_value']=$fundamentaInfo[$instrumentId]['face_value'];
           $temp['nav']=0;
           $temp['lastprice']=$arr['pub_last_traded_price'];
           $temp['open']=$arr['open_price'];
           $temp['high']=$arr['high_price'];
           $temp['low']=$arr['low_price'];
           $temp['volume']=$arr['total_volume'];
           $temp['value']=$arr['total_value'];
           $temp['trade']=$arr['total_trades'];
           $temp['ycp']=$arr['yday_close_price'];
           $temp['pchange']=($arr['pub_last_traded_price']-$arr['yday_close_price'])/$arr['yday_close_price']*100;
           $temp['change']=$arr['pub_last_traded_price']-$arr['yday_close_price'];
           $temp['pe']=0;
           $temp['eps']=0;
           $maingrid[]=$temp;
       }
        $jsonArr=array();
        $firstgrid=array();
        $secondgrid=array();
        $thirdgrid=array();

        $jsonArr['maingrid'] = $maingrid;
        $jsonArr['firstgrid'] = $firstgrid;
        $jsonArr['secondgrid'] = $secondgrid;
        $jsonArr['thirdgrid'] = $thirdgrid;

        $jsonresult = json_encode($jsonArr);

        echo $jsonresult;

       /* $db =& ConnectionManager::getDataSource('default');
        $db->showLog();*/

        exit;
    }

    public function get_market_depth($instrumentId=12)
    {
        $instrumentId = $_POST['instrumentId'];
       // $StockBangladesh = $this->Components->load('StockBangladesh');
       // $instrumentList=$StockBangladesh->instrumentList(3);


        //$code = $instrumentList[$instrumentId];
        $code="ABBANK";
        $getText = $this->get_web_page('http://www.dsebd.org/bshis_new1_old.php?w=' . $code);
        $getText = preg_replace('/Please click on the button to refresh/', ' ', $getText);
        $getText = preg_replace('/<INPUT\b[^>]*>(.*?)[^>]/', ' ', $getText);
        $getText = preg_replace('/<META\b[^>]*>(.*?)[^>]/', ' ', $getText);
echo $getText;
        exit;
      //  $this->set("getText",$getText);
      //  $this->set("code",$code);

    }

    public function market_depth_monitor($instrumentId=12)
    {
        $StockBangladesh = $this->Components->load('StockBangladesh');
        $instrumentList=$StockBangladesh->instrumentList(3);


        $code = $instrumentList[$instrumentId];
        $getText = $this->get_web_page('http://www.dsebd.org/bshis_new1_old.php?w=' . $code);
        $getText = preg_replace('/Please click on the button to refresh/', ' ', $getText);
        $getText = preg_replace('/<INPUT\b[^>]*>(.*?)[^>]/', ' ', $getText);
        $getText = preg_replace('/<META\b[^>]*>(.*?)[^>]/', ' ', $getText);

        $this->set("getText",$getText);
        $this->set("code",$code);
        $this->set("instrumentId",$instrumentId);

    }

    public function checkMarginShare($instrumentId=24)
    {
        //Configure::write('debug', 2);
        $brokerId=$this->Auth->user('broker_id');

        if($brokerId==Configure::read('broker.hac.id'))
            $metaKey='hac_margin';
        if($brokerId==Configure::read('broker.apex.id'))
            $metaKey='apex_margin';

        $metaModel = ClassRegistry::init('Meta');
        $fundamentalModel = ClassRegistry::init('Fundamental');

        $metaIdSearch= $metaModel->find('list', array('conditions' =>array('Meta.meta_group_id'=>1,'Meta.meta_key'=>$metaKey), 'recursive' => -1));
        $entrySearch= $fundamentalModel->find('all', array('conditions' =>array('Fundamental.instrument_id'=>$instrumentId,'Fundamental.meta_id'=>$metaIdSearch,'Fundamental.meta_value'=>1),'fields'=>'meta_value', 'recursive' => -1));

        if($entrySearch)
            echo 1;
        else
            echo 0;

        exit;
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


}

                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                               