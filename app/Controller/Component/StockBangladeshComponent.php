<?php
App::uses('Component', 'Controller');
class StockBangladeshComponent extends Component
{
    public $lastTradeInfo = array();
    public $lastTradeInfoAllIns = array();
    public $yesterdayTradeInfo = array();
    public $lastIndexValues = array();
    public $yesterdayLastIndexValues = array();
    public $lastTradeStats = array();
    public $yesterdayLastTradeStats = array();


    /*
    * $returnToday=2 will return merge information with yesterday
    * $returnToday=1 will return today information
    * $returnToday=0 will return yesterday information
    * */
    public function prepareLastTradeInfo($trade_date = 0, $returnToday = 1)
    {


        if ($returnToday == 1) {
            $marketId = $this->getMarketInfo($trade_date);
            $lastTradeInfo = $this->getLastTradeInfo($marketId);
            $result = Hash::combine($lastTradeInfo, '{n}.{s}.trade_time', '{n}.{s}', '{n}.{s}.instrument_id');

            $DataBanksIntradayCombinedWithPrevMinute = $this->merge_last_two_minutes($result);

            return $DataBanksIntradayCombinedWithPrevMinute;
        } elseif ($returnToday == 0) {
            $lastTwoMarketInfoArr = $this->getMarketInfo($trade_date, 0);
            $yesterdayMarketId = $lastTwoMarketInfoArr[1]['Market']['id'];
            $yesterdayTradeInfo = $this->getYesterdayTradeInfo($yesterdayMarketId);
            $yresult = Hash::combine($yesterdayTradeInfo, '{n}.{s}.trade_time', '{n}.{s}', '{n}.{s}.instrument_id');

            $YDataBanksIntradayCombinedWithPrevMinute = $this->merge_last_two_minutes($yresult);
            return $YDataBanksIntradayCombinedWithPrevMinute;
        } elseif ($returnToday == 2) {

            $lastTwoMarketInfoArr = $this->getMarketInfo($trade_date, 0);
            $marketId = $lastTwoMarketInfoArr[0]['Market']['id'];
            $yesterdayMarketId = $lastTwoMarketInfoArr[1]['Market']['id'];
            $yesterdayTradeInfo = $this->getYesterdayTradeInfo($yesterdayMarketId);
            $yresult = Hash::combine($yesterdayTradeInfo, '{n}.{s}.trade_time', '{n}.{s}', '{n}.{s}.instrument_id');
            $YDataBanksIntradayCombinedWithPrevMinute = $this->merge_last_two_minutes($yresult);

            $lastTradeInfo = $this->getLastTradeInfo($marketId);
            $result = Hash::combine($lastTradeInfo, '{n}.{s}.trade_time', '{n}.{s}', '{n}.{s}.instrument_id');
            $DataBanksIntradayCombinedWithPrevMinute = $this->merge_last_two_minutes($result);

            $margeAll = $this->merge_with_yesterday($DataBanksIntradayCombinedWithPrevMinute, $YDataBanksIntradayCombinedWithPrevMinute);

            return $margeAll;
        }


    }

    /*
     * Return marketId of a trade date. Today is the default value of trade date
     * if $idOnly=1 it will return market_id (int) of trade date only
     * If $idOnly=0 it will return an array of last two day market information
     * */

   /* public function  getMarketInfo($tradeDate = 0, $idOnly = 1)
    {
      //  Configure::write('debug', 2);
        if (!$tradeDate) {
            $tradeDate = date('Y-m-d');
        }



        $exchangeId = Configure::read('EXCHANGE_ID');
        App::uses('Market', 'Model');
        $Market = new Market();
        $marketData = $Market->find('all', array(
            'conditions' => "Market.trade_date<='$tradeDate' and Market.exchange_id=$exchangeId",
            'contain' =>  array(
                'DataBanksIntraday' => array(
                    'limit' => '1'
                )),

            'order' => 'Market.trade_date DESC',
            'limit' => '5',
            'recursive' => 1
        ));
        $validTradeDays = array();
        foreach ($marketData as $day) {
            if (!empty($day['DataBanksIntraday'])) {
                $temp=$day;
                unset($temp['DataBanksIntraday']);
                $validTradeDays[] = $temp;
            }

        }

        if (!empty($validTradeDays)) {
            if ($idOnly) {
                return $validTradeDays[0]['Market']['id'];
            } else {
                return $validTradeDays;
            }
        } else {
            return 0;
        }
    }*/

    // VERSION NO -3

    public function  getMarketInfo($tradeDate = 0, $idOnly = 1)
    {
        //   Configure::write('debug', 2);


        App::uses('DataBanksIntraday', 'Model');
        $DataBanksIntraday = new DataBanksIntraday();


        if ($tradeDate) {
            $dataBanksIntradayData = $DataBanksIntraday->find('all', array(
                'order' => 'DataBanksIntraday.trade_date DESC',
                'conditions' => "DataBanksIntraday.trade_date=$tradeDate",
                'limit' => '1',
                'fields' => array('DataBanksIntraday.market_id'),
                'recursive' => -1
            ));
        }else
        {
            $dataBanksIntradayData = $DataBanksIntraday->find('all', array(
                'order' => 'DataBanksIntraday.trade_date DESC',
                'limit' => '1',
                'fields' => array('DataBanksIntraday.market_id'),
                'recursive' => -1
            ));

        }
        $lastValidMarketId=$dataBanksIntradayData[0]['DataBanksIntraday']['market_id'];

        $exchangeId = Configure::read('EXCHANGE_ID');
        App::uses('Market', 'Model');
        $Market = new Market();
        $marketData = $Market->find('all', array(
            'conditions' => "Market.id<=$lastValidMarketId",
            'order' => 'Market.trade_date DESC',
            'limit' => '2',
            'recursive' => -1
        ));

        if (!empty($marketData)) {
            if ($idOnly) {
                return $marketData[0]['Market']['id'];
            } else {
                return $marketData;
            }
        } else {
            return 0;
        }
    }
    // This is previous version of market info. If market is closed more than 2 days it will return wrong information
/*    public function  getMarketInfo($tradeDate = '2014-07-14', $idOnly = 1)
    {
        if (!$tradeDate) {
            $tradeDate = date('Y-m-d');
        }

        $exchangeId = Configure::read('EXCHANGE_ID');
        App::uses('Market', 'Model');
        $Market = new Market();
        $marketData = $Market->find('all', array(
            'conditions' => "Market.trade_date<='$tradeDate' and Market.exchange_id=$exchangeId",
            'order' => 'Market.trade_date DESC',
            'limit' => '2',
            'recursive' => -1
        ));
        // pr($marketData);
        //  exit;
        if (!empty($marketData)) {
            if ($idOnly) {
                return $marketData[0]['Market']['id'];
            } else {
                return $marketData;
            }
        } else {
            return 0;
        }
    }*/

    public function isMarketOpen($tradeDate = null, $tradeTime = null)
    {
        /* if(is_null($tradeDate)) {
             $tradeDate = date('Y-m-d');
         }
         if(is_null($tradeTime)) {
             $tradeTime = date('H:i:s');
         }*/
        $tradeDate = date('Y-m-d');
        $tradeTime = date('H:i:s');

        // As we have allow run the corn even after 5 minutesof  dse close

        $tradeEndTime = date('H:i:s', strtotime("-5 min"));
        //  $tradeDate = "2014-07-13";
        //  $tradeTime = "10:30:01"; // uncomment for testing/development
        $exchangeId = Configure::read('EXCHANGE_ID');
        App::uses('CakeTime', 'Utility');
        App::uses('Market', 'Model');
        $Market = new Market();

        $marketData = $Market->find('all', array(
            'conditions' => "Market.trade_date='$tradeDate' and Market.exchange_id=$exchangeId and Market.market_started<'$tradeTime' and Market.market_closed>'$tradeEndTime'",
            'recursive' => -1
        ));

        $previousDaysMarketData = $Market->find('all', array(
            'conditions' => "Market.exchange_id=$exchangeId and Market.is_trading_day=1 and Market.trade_date<'$tradeDate'",
            'recursive' => -1,
            'order' => array('Market.trade_date DESC'),
            'limit' => 1
        ));

        // pr($previousDaysMarketData);

        if (empty($marketData)) {
            return 0;
        } else {
            $returnMarketIdArr = array();
            //$returnMarketIdArr[] = $marketData[0]['Market']['id'];
            $returnMarketIdArr[] = $marketData[0];
            //$returnMarketIdArr[] = $previousDaysMarketData[0]['Market']['id'];
            $returnMarketIdArr[] = $previousDaysMarketData[0];
            return $returnMarketIdArr;
        }

    }


    /*
     * Returns instrument those have been traded in last day
     * Return direct database info without merging
     * if $marketId=0 it will retrieve last trading day
     * if $instrumentId provided only data of that $instrumentId will be return otherwise it will return all
     * */
    public function getLastTradeInfo($marketId = 0, $instrumentId = 0)
    {
        //  Configure::write('debug', 2);
        if (!$marketId) {
            //$marketId=$this->getMarkeInfo('2014-07-13'); // activate to development
            $marketId = $this->getMarketInfo(); // activate in production
        }

        //$deletInfo = Cache::delete('lastTradeInfo');
        $lastTradeInfo = Cache::read('lastTradeInfo');

        if (!$lastTradeInfo) {
            $model = ClassRegistry::init('DataBanksIntraday');
            //pr("mem empty here");
            $limit=1200;
            /*
            if(!$this->isMarketOpen())
            {
                $limit=3500;  // as after market close (at 2.30PM ) additional,similar and redundant row inserted
            }*/

            $lastTradeInfo = $model->find('all', array(
                'conditions' => "DataBanksIntraday.market_id=$marketId and DataBanksIntraday.total_volume>0",
                'order' => 'DataBanksIntraday.id DESC',
                'limit' => $limit,
                //'group' => array('DataBanksIntraday.trade_time', 'DataBanksIntraday.instrument_id'),
                //'group' => "DataBanksIntraday.trade_time, DataBanksIntraday.instrument_id",
                //'group' => array('DataBanksIntraday.trade_time'),
                'recursive' => -1

            ));
            Cache::write('lastTradeInfo', $lastTradeInfo, 'minute');

        }
      //  pr(count($lastTradeInfo));
     //   pr($lastTradeInfo);
        $this->lastTradeInfo = Hash::combine(Hash::extract($lastTradeInfo, '{n}.DataBanksIntraday'), '{n}.trade_time', '{n}', '{n}.instrument_id');

    //    pr('=============='.count($this->lastTradeInfo));
    //    pr($this->lastTradeInfo);
        if ($instrumentId)
            return Hash::extract($this->lastTradeInfo, "{n}.{s}[instrument_id=$instrumentId]");
        else
            return $this->lastTradeInfo;

    }

    public function get_category($instrumentId)
    {
        $lastTradeInfo = $this->getAllInsLtp(0, $instrumentId);
        if(isset($lastTradeInfo[0]['quote_bases']))
       return $lastTradeInfo[0]['quote_bases'][0];
        else
            return 0;

    }


    public function send_sms($mobile_no, $msg_txt)
    {
        //$mobile_no = "8801929912870"; //Hosting Bangladesh

        //$sms_auth = "hostingbd:UmThGy69";  // mimsms
        $sms_auth = "bdhosting:$3rP[9OENB~A";  // infobip  https://portal.infobip.com/analyze/dashboard/
        $sms_auth = base64_encode($sms_auth);
        $curl = curl_init();

        curl_setopt_array($curl, array(
            CURLOPT_URL => "http://api.infobip.com/sms/1/text/single",
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => "",
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 30,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => "POST",
            CURLOPT_POSTFIELDS => "{ \"from\":\"InfoSMS\", \"to\":\"$mobile_no\", \"text\":\"$msg_txt.\" }",
            CURLOPT_HTTPHEADER => array(
                "accept: application/json",
                "authorization: Basic $sms_auth",
                "content-type: application/json"
            ),
        ));

        $response = curl_exec($curl);
        $err = curl_error($curl);

        curl_close($curl);

     /*   if ($err) {
            echo "cURL Error #:" . $err;
        } else {
            echo $response;
        }*/

    }
    /*
     *  Return all instruments ltp regardless trade date
     * */

    public function getAllInsLtp($marketId = 0, $instrumentId = 0)
    {
      //  Configure::write('debug', 2);
        //$deletInfo = Cache::delete('lastTradeInfo');
        $lastTradeInfoAllIns = Cache::read('lastTradeInfoAllIns');

        if (!$lastTradeInfoAllIns) {
            $model = ClassRegistry::init('Instrument');
//pr('from database');
            $model->unbindModel(
                array('hasMany' => array('CorporateAction','DataBanksEod','Fundamental'))
            );

            $model->bindModel(
                array('hasMany' => array(
                    'DataBanksIntraday' => array(
                        'className' => 'DataBanksIntraday',
                        'limit' => 1,
                        'order' => 'DataBanksIntraday.id desc'
                    )
                )
                )
            );


            $exchangeId = Configure::read('EXCHANGE_ID');
            $lastTradeInfoAllIns = $model->find('all', array(
                'conditions' => "Instrument.exchange_id=$exchangeId and SectorList.id!=22 and SectorList.id!=23",
            ));
            Cache::write('lastTradeInfoAllIns', $lastTradeInfoAllIns, 'minute');
        }
        //  pr(count($lastTradeInfo));
        //   pr($lastTradeInfoAllIns);
        $this->lastTradeInfoAllIns = Hash::combine(Hash::extract($lastTradeInfoAllIns, '{n}.DataBanksIntraday.0'), '{n}.trade_time', '{n}', '{n}.instrument_id');

        //    pr('=============='.count($this->lastTradeInfo));
         //   pr($this->lastTradeInfoAllIns);
        if ($instrumentId)
            return Hash::extract($this->lastTradeInfoAllIns, "{n}.{s}[instrument_id=$instrumentId]");
        else
            return $this->lastTradeInfoAllIns;

    }

    /*
     * if $marketId=0 it will retrieve last trading day
     * if $instrumentId provided only data of that $instrumentId will be return otherwise it will return all
     * */
    public function getYesterdayTradeInfo($marketId = 0, $instrumentId = 0)
    {
        if (!$marketId) {
            //$marketId=$this->getMarkeInfo('2014-07-13'); // activate to development
            $marketId = $this->getMarketInfo(); // activate in production
        }

        $yesterdayTradeInfo = Cache::read('yesterdayTradeInfo');
        //$lastTradeInfo = Cache::delete('lastTradeInfo');
        if (!$yesterdayTradeInfo) {
            $model = ClassRegistry::init('DataBanksIntraday');
            //pr("mem empty here");
            $yesterdayTradeInfo = $model->find('all', array(
                'conditions' => "DataBanksIntraday.market_id=$marketId and DataBanksIntraday.total_volume>0",
                'order' => 'DataBanksIntraday.trade_time DESC',
                'limit' => '700',
                'group' => array('DataBanksIntraday.trade_time', 'DataBanksIntraday.instrument_id'),
                //'group' => "DataBanksIntraday.trade_time, DataBanksIntraday.instrument_id",
                //'group' => array('DataBanksIntraday.trade_time'),
                'recursive' => -1

            ));
            Cache::write('yesterdayTradeInfo', $yesterdayTradeInfo, 'minute');

        }


        $this->yesterdayTradeInfo = Hash::combine(Hash::extract($yesterdayTradeInfo, '{n}.DataBanksIntraday'), '{n}.trade_time', '{n}', '{n}.instrument_id');

        if ($instrumentId)
            return Hash::extract($this->yesterdayTradeInfo, "{n}.{s}[instrument_id=$instrumentId]");
        else
            return $this->yesterdayTradeInfo;

    }

    public function getLastIndexValues($marketId = 0)
    {
        if (!$marketId) {
            //$marketId=$this->getMarkeInfo('2014-07-13'); // activate to development
            $marketId = $this->getMarketInfo(); // activate in production
        }
        $lastIndexValues = Cache::read('lastIndexValues');
        //$lastTradeInfo = Cache::delete('lastTradeInfo');
        if (!$lastIndexValues) {
            $model = ClassRegistry::init('IndexValue');
            //pr("mem empty here");
            $lastIndexValues = $model->find('all', array(
                'conditions' => "IndexValue.market_id=$marketId",
                'order' => 'IndexValue.index_time DESC',
                'limit' => '1100',
                'group' => array('IndexValue.index_time', 'IndexValue.instrument_id'),
                //'group' => "DataBanksIntraday.trade_time, DataBanksIntraday.instrument_id",
                //'group' => array('DataBanksIntraday.trade_time'),
                'recursive' => -1

            ));
            Cache::write('lastIndexValues', $lastIndexValues, 'minute');

        }
        $this->lastIndexValues = Hash::combine(Hash::extract($lastIndexValues, '{n}.IndexValue'), '{n}.index_time', '{n}', '{n}.instrument_id');

        return $this->lastIndexValues;

    }

    public function getYesterdayLastIndexValues($marketId = 0)
    {
        if (!$marketId) {
            //$marketId=$this->getMarkeInfo('2014-07-13'); // activate to development
            $marketId = $this->getMarketInfo(); // activate in production
        }
        $yesterdayLastIndexValues = Cache::read('yesterdayLastIndexValues');
        //$lastTradeInfo = Cache::delete('lastTradeInfo');
        if (!$yesterdayLastIndexValues) {
            $model = ClassRegistry::init('IndexValue');
            //pr("mem empty here");
            $yesterdayLastIndexValues = $model->find('all', array(
                'conditions' => "IndexValue.market_id=$marketId",
                'order' => 'IndexValue.index_time DESC',
                'limit' => '1100',
                'group' => array('IndexValue.index_time', 'IndexValue.instrument_id'),
                //'group' => "DataBanksIntraday.trade_time, DataBanksIntraday.instrument_id",
                //'group' => array('DataBanksIntraday.trade_time'),
                'recursive' => -1

            ));
            Cache::write('yesterdayLastIndexValues', $yesterdayLastIndexValues, 'minute');

        }
        $this->yesterdayLastIndexValues = Hash::combine(Hash::extract($yesterdayLastIndexValues, '{n}.IndexValue'), '{n}.index_time', '{n}', '{n}.instrument_id');

        return $this->yesterdayLastIndexValues;

    }

    public function getLastTradeStats($marketId = 0)
    {
        if (!$marketId) {
            //$marketId=$this->getMarkeInfo('2014-07-13'); // activate to development
            $marketId = $this->getMarketInfo(); // activate in production
        }
        $lastTradeStats = Cache::read('lastTradeStats');
        //$lastTradeInfo = Cache::delete('lastTradeInfo');
        if (!$lastTradeStats) {
            $model = ClassRegistry::init('Trade');
            //pr("mem empty here");
            $lastTradeStats = $model->find('all', array(
                'conditions' => "Trade.market_id=$marketId",
                'order' => 'Trade.trade_time DESC',
                'limit' => '1100',
                'group' => array('Trade.trade_time'),
                //'group' => "DataBanksIntraday.trade_time, DataBanksIntraday.instrument_id",
                //'group' => array('DataBanksIntraday.trade_time'),
                'recursive' => -1

            ));
            Cache::write('lastTradeStats', $lastTradeStats, 'minute');

        }

        $this->lastTradeStats = Hash::combine(Hash::extract($lastTradeStats, '{n}.Trade'), '{n}.trade_time', '{n}');

        return $this->lastTradeStats;

    }

    public function getYesterdayLastTradeStats($marketId = 0)
    {
        if (!$marketId) {
            //$marketId=$this->getMarkeInfo('2014-07-13'); // activate to development
            $marketId = $this->getMarketInfo(); // activate in production
        }
        $yesterdayLastTradeStats = Cache::read('yesterdayLastTradeStats');
        //$lastTradeInfo = Cache::delete('lastTradeInfo');
        if (!$yesterdayLastTradeStats) {
            $model = ClassRegistry::init('Trade');
            //pr("mem empty here");
            $yesterdayLastTradeStats = $model->find('all', array(
                'conditions' => "Trade.market_id=$marketId",
                'order' => 'Trade.trade_time DESC',
                'limit' => '1100',
                'group' => array('Trade.trade_time'),
                //'group' => "DataBanksIntraday.trade_time, DataBanksIntraday.instrument_id",
                //'group' => array('DataBanksIntraday.trade_time'),
                'recursive' => -1

            ));
            Cache::write('yesterdayLastTradeStats', $yesterdayLastTradeStats, 'minute');

        }

        $this->yesterdayLastTradeStats = Hash::combine(Hash::extract($yesterdayLastTradeStats, '{n}.Trade'), '{n}.trade_time', '{n}');

        return $this->yesterdayLastTradeStats;

    }

    public function prLastTradeInfo()
    {
        pr($this->lastTradeInfo);
    }


    public function array_subtract($arr = array(), $limit = 0)
    {
        $arr2 = $arr;
        array_shift($arr2);
        array_push($arr2, 0);
        if (!$limit) {
            $limit = count($arr);
        }

        $result = array();
        for ($i = 0; $i < $limit; $i++) // for($i = 0; $i < 120; $i++)
        {
            $result[] = $arr[$i] - $arr2[$i];
        }
        return $result;
    }

    /*
     * Calculate differences between two adjacent elements and return array of differences
     * $data Param assumes that it is in descending order by time
     * */
    public function calculate_difference($data = array())
    {
        $shiftedData = $data;
        array_shift($shiftedData);
        array_push($shiftedData, 0);
        $sub = function ($a, $b) {
            return $a - $b;
        };
        $differenceArray = array_map($sub, $data, $shiftedData);
        /*  pr($data);
          pr($shiftedData);
          pr($differenceArray);
          exit;*/

        return $differenceArray;
    }

    public function merge_last_two_minutes($lastTradeInfo = array())
    {

        $result = array();
        $instrumentList = $this->instrumentList(3);


        foreach ($lastTradeInfo as $instrument_code => $minute_arr) {
            $temp = array();
            foreach ($minute_arr as $minute) {

                $temp[] = $minute;

            }


// SET SAME ARR AS PREVIOUS MINUTES DATA IF THERE IS NO PREVIOUS MINUTES IN TRADE
            if (!isset($temp[1])) {
                $temp[1] = $temp[0];
            }

            $ltp[0] =  $temp[0]['close_price'] != 0 ?  $temp[0]['close_price'] : ( $temp[0]['pub_last_traded_price'] != 0 ?  $temp[0]['pub_last_traded_price'] :  $temp[0]['spot_last_traded_price']);
            $ltp[1] =  $temp[1]['close_price'] != 0 ?  $temp[1]['close_price'] : ( $temp[1]['pub_last_traded_price'] != 0 ?  $temp[1]['pub_last_traded_price'] :  $temp[1]['spot_last_traded_price']);
            $temp[0]['close_price']=$ltp[0];
            $temp[1]['close_price']=$ltp[1];

            $temp[0]['p_pub_last_traded_price'] = $temp[1]['pub_last_traded_price'];
            $temp[0]['p_pub_last_traded_price_change'] = $temp[0]['pub_last_traded_price'] - $temp[1]['pub_last_traded_price'];

          /*  $temp[0]['p_pub_last_traded_price_change_per']=0;
            if($temp[1]['pub_last_traded_price'])*/
            $temp[0]['p_pub_last_traded_price_change_per'] = @($temp[0]['p_pub_last_traded_price_change'] / $temp[1]['pub_last_traded_price']) * 100; //@ will not show divide by zero error

            $temp[0]['p_lm_date_time'] = $temp[1]['lm_date_time'];
            $temp[0]['p_high_price'] = $temp[1]['high_price'];
            $temp[0]['p_low_price'] = $temp[1]['low_price'];
            $temp[0]['p_close_price'] = $temp[1]['close_price'];

            $temp[0]['p_total_trades'] = $temp[1]['total_trades'];
            $temp[0]['p_total_trades_change'] = $temp[0]['total_trades'] - $temp[1]['total_trades'];

        /*    $temp[0]['p_total_trades_change_per']=0;
            if($temp[1]['total_trades'])*/
            $temp[0]['p_total_trades_change_per'] = ($temp[0]['p_total_trades_change'] / $temp[1]['total_trades']) * 100;

            $temp[0]['p_total_volume'] = $temp[1]['total_volume'];
            $temp[0]['p_total_volume_change'] = $temp[0]['total_volume'] - $temp[1]['total_volume'];

           /* $temp[0]['p_total_volume_change_per']=0;
            if($temp[1]['total_volume'])*/
            $temp[0]['p_total_volume_change_per'] = ($temp[0]['p_total_volume_change'] / $temp[1]['total_volume']) * 100;

            $temp[0]['p_public_total_value'] = $temp[1]['public_total_value'];
            $temp[0]['p_public_total_value_change'] = $temp[0]['public_total_value'] - $temp[1]['public_total_value'];

           /* $temp[0]['p_public_total_value_change_per'] =0;
            if($temp[1]['public_total_value'])*/
            $temp[0]['p_public_total_value_change_per'] = @($temp[0]['p_public_total_value_change'] / $temp[1]['public_total_value']) * 100;

            $temp[0]['instrument_code'] = $instrumentList[$instrument_code];

            $ltp[0] =  $temp[0]['close_price'] != 0 ?  $temp[0]['close_price'] : ( $temp[0]['pub_last_traded_price'] != 0 ?  $temp[0]['pub_last_traded_price'] :  $temp[0]['spot_last_traded_price']);
            $ltp[1] =  $temp[1]['close_price'] != 0 ?  $temp[1]['close_price'] : ( $temp[1]['pub_last_traded_price'] != 0 ?  $temp[1]['pub_last_traded_price'] :  $temp[1]['spot_last_traded_price']);

            $result[$instrument_code] = $temp[0];
         //   pr($temp);
     //       pr($result);
     //       exit;
//pr($minute_arr);
//pr($temp);
//            exit;

        }

        return $result;
    }

    /*
     * Param $lastTradeInfo like merge_last_two_minutes
     * Return previous minutes info
     * */

    public function getPrevMinuteInfo($lastTradeInfo = array())
    {

        return $lastTradeInfo[1];
    }

    public function merge_with_yesterday($lastTradeInfo = array(), $yesterdayTradeInfo = array())
    {
      //  Configure::write('debug', 2);
        // $result=array();
        // pr($yesterdayTradeInfo);

        //Hash::combine(Hash::extract($yesterdayTradeInfo, '{n}.DataBanksIntraday'), '{n}.trade_time', '{n}', '{n}.instrument_id');
        //pr(Hash::extract($yesterdayTradeInfo, '{n}.{s}'));
        //exit;
        foreach ($lastTradeInfo as $instrument_code => $row) {
            if (!isset($yesterdayTradeInfo[$instrument_code])) {

                $yesterdayTradeInfo[$instrument_code] = $lastTradeInfo[$instrument_code];
            }

            $lastTradeInfo[$instrument_code]['y_pub_last_traded_price'] = $yesterdayTradeInfo[$instrument_code]['pub_last_traded_price'];
            $lastTradeInfo[$instrument_code]['y_pub_last_traded_price_change'] = $lastTradeInfo[$instrument_code]['pub_last_traded_price'] - $yesterdayTradeInfo[$instrument_code]['pub_last_traded_price'];

          /*  $lastTradeInfo[$instrument_code]['y_pub_last_traded_price_change_per']=0;
            if( $yesterdayTradeInfo[$instrument_code]['pub_last_traded_price'])*/
            $lastTradeInfo[$instrument_code]['y_pub_last_traded_price_change_per'] = @($lastTradeInfo[$instrument_code]['y_pub_last_traded_price_change'] / $yesterdayTradeInfo[$instrument_code]['pub_last_traded_price']) * 100;

            $lastTradeInfo[$instrument_code]['y_lm_date_time'] = $yesterdayTradeInfo[$instrument_code]['lm_date_time'];
            $lastTradeInfo[$instrument_code]['y_high_price'] = $yesterdayTradeInfo[$instrument_code]['high_price'];
            $lastTradeInfo[$instrument_code]['y_low_price'] = $yesterdayTradeInfo[$instrument_code]['low_price'];
            $lastTradeInfo[$instrument_code]['y_close_price'] = $yesterdayTradeInfo[$instrument_code]['close_price'];

            $lastTradeInfo[$instrument_code]['y_total_trades'] = $yesterdayTradeInfo[$instrument_code]['total_trades'];
            $lastTradeInfo[$instrument_code]['y_total_trades_change'] = $lastTradeInfo[$instrument_code]['total_trades'] - $yesterdayTradeInfo[$instrument_code]['total_trades'];

           /* if($yesterdayTradeInfo[$instrument_code]['total_trades'])
                $lastTradeInfo[$instrument_code]['y_total_trades_change_per'] =0;*/
            $lastTradeInfo[$instrument_code]['y_total_trades_change_per'] = ($lastTradeInfo[$instrument_code]['y_total_trades_change'] / $yesterdayTradeInfo[$instrument_code]['total_trades']) * 100;

            $lastTradeInfo[$instrument_code]['y_total_volume'] = $yesterdayTradeInfo[$instrument_code]['total_volume'];
            $lastTradeInfo[$instrument_code]['y_total_volume_change'] = $lastTradeInfo[$instrument_code]['total_volume'] - $yesterdayTradeInfo[$instrument_code]['total_volume'];


          /*  if($yesterdayTradeInfo[$instrument_code]['total_volume'])
                $lastTradeInfo[$instrument_code]['y_total_volume_change_per']=0;*/
            $lastTradeInfo[$instrument_code]['y_total_volume_change_per'] = ($lastTradeInfo[$instrument_code]['y_total_volume_change'] / $yesterdayTradeInfo[$instrument_code]['total_volume']) * 100;

            $lastTradeInfo[$instrument_code]['y_public_total_value'] = $yesterdayTradeInfo[$instrument_code]['public_total_value'];
            $lastTradeInfo[$instrument_code]['y_public_total_value_change'] = $lastTradeInfo[$instrument_code]['public_total_value'] - $yesterdayTradeInfo[$instrument_code]['public_total_value'];

           /* if($yesterdayTradeInfo[$instrument_code]['public_total_value'])
                $lastTradeInfo[$instrument_code]['y_public_total_value_change_per']=0;*/
            $lastTradeInfo[$instrument_code]['y_public_total_value_change_per'] = @($lastTradeInfo[$instrument_code]['y_public_total_value_change'] / $yesterdayTradeInfo[$instrument_code]['public_total_value']) * 100;



            $ltp =  $lastTradeInfo[$instrument_code]['close_price'] != 0 ?  $lastTradeInfo[$instrument_code]['close_price'] : ( $lastTradeInfo[$instrument_code]['pub_last_traded_price'] != 0 ?  $lastTradeInfo[$instrument_code]['pub_last_traded_price'] :  $lastTradeInfo[$instrument_code]['spot_last_traded_price']);
            $lastTradeInfo[$instrument_code]['change'] = $ltp-$lastTradeInfo[$instrument_code]['yday_close_price'];

           /*if($lastTradeInfo[$instrument_code]['yday_close_price'])
               $lastTradeInfo[$instrument_code]['change_per']=0;*/
            $lastTradeInfo[$instrument_code]['change_per'] = ($lastTradeInfo[$instrument_code]['change'] / $lastTradeInfo[$instrument_code]['yday_close_price']) * 100;
            $lastTradeInfo[$instrument_code]['change_per'] = number_format($lastTradeInfo[$instrument_code]['change_per'], 2, '.', '');
            $lastTradeInfo[$instrument_code]['close_price']=$ltp;


        }

        return $lastTradeInfo;
    }

    /*
     * Type=1 returns sectorwise instrument. 2-dimensional array
     * Type-2 returns instrumentCode as key and instrumentId as val
     * Type-3 returns instrumentId as key and instrumentCode as val
     * Type-4 returns instrumentId as key and sector as val
     */
    public function instrumentList($type = 1)
    {
       // Configure::write('debug', 2);
        //$this->loadModel('Instrument');
      //  $del = Cache::delete('instrumentList');
        $exchangeId = Configure::read('EXCHANGE_ID');
        $instrumentList = Cache::read('instrumentList');
        if (!$instrumentList) {
            // pr("mem empty here");

            //$Instrument = ClassRegistry::init('Instrument');
            App::uses('Instrument', 'Model');
            $Instrument = new Instrument();
            $instrumentList = $Instrument->find('all', array(
              //  'conditions' => "Instrument.exchange_id=$exchangeId and SectorList.id!=22 and SectorList.id!=23",
                'conditions' => "Instrument.exchange_id=$exchangeId and SectorList.id!=22",
                'recursive' => 0
            ));

            Cache::write('instrumentList', $instrumentList, 'day');

        }

       // pr($instrumentList);
       // exit;
        //pr(Hash::extract($lastTradeInfo, 'DataBanksIntraday.{n}[instrument_code=/FDGDFG/]'));
        switch ($type) {
            case 1:
                return Hash::combine($instrumentList, '{n}.Instrument.id', '{n}.Instrument.instrument_code', '{n}.SectorList.name');
            case 2:
                return Hash::combine($instrumentList, '{n}.Instrument.instrument_code', '{n}.Instrument.id');
            case 3:
                return Hash::combine($instrumentList, '{n}.Instrument.id', '{n}.Instrument.instrument_code');
            case 4:
                return Hash::combine($instrumentList, '{n}.Instrument.id', '{n}.SectorList.name');
           
        }

    }

    /*
     * instrumentId=0 will return all instruments
     * */
    public function instrumentInfo($instrumentId = 0)
    {
        //$this->loadModel('Instrument');

        $exchangeId = Configure::read('EXCHANGE_ID');
        $instrumentInfo = Cache::read('instrumentInfo');
        if (!$instrumentInfo) {
            // pr("mem empty here");
            App::uses('Instrument', 'Model');
            $Instrument = new Instrument();
            $instrumentInfo = $Instrument->find('all', array(
                'conditions' => "Instrument.exchange_id=$exchangeId and SectorList.id!=22",
                'recursive' => 0
                ,'autocache'=>array('config'=>'day')
            ));

            Cache::write('instrumentInfo', $instrumentInfo, 'day');

        }

        $keywiseArr = Hash::combine($instrumentInfo, '{n}.Instrument.id', '{n}');
       // pr($keywiseArr);
       // exit;
        if ($instrumentId)
            return $keywiseArr[$instrumentId];
        else
            return $keywiseArr;


    }

    /*
     * instrumentId=0 will return all instruments
     * $metaKey array of metakey
     * example $metaKey=array("category","market_lot","face_value");
     * it will return array by overwriting old meta value by new meta value
     * */
    public function getFundamentalInfo($instrumentId=0, $metaKey = array())
    {
        App::uses('Instrument', 'Model');
        $Instrument = new Instrument();



        $conditionArr=array();
        foreach ($metaKey as $meta)
        {

            $conditionArr[]="Meta.meta_key like '$meta'";

        }

        App::uses('String', 'Utility');
        $condition= String::toList($conditionArr,$and=',');
        $condition=str_replace(",", " or ", $condition);

        //$condition = array('Fundamental.instrument_id' => $instrumentId, 'FundamentalMeta.meta_key' => $metaKey);
     //   $condition="Fundamental.instrument_id=$instrumentId and $subcondition";



        if ($instrumentId) {

            if(!empty($metaKey))
            {
            $condition = "Fundamental.instrument_id=$instrumentId and ($condition)";
            }else{
                $condition = "Fundamental.instrument_id=$instrumentId";
            }


            $fundamentalDataAll = $Instrument->Fundamental->find('all', array('contain' => 'Meta', 'conditions' => $condition, 'order' => array('Fundamental.meta_date ASC')));

            $fundamentalDataOrganized = Hash::combine($fundamentalDataAll, '{n}.Meta.meta_key', '{n}.Fundamental');


        } else {

            $fundamentalDataAll = $Instrument->Fundamental->find('all', array('contain' => 'Meta', 'conditions' => $condition, 'order' => array('Fundamental.meta_date ASC')));
            //$fundamentalDataOrganized=$fundamentalDataAll;
            $fundamentalDataOrganized = Hash::combine($fundamentalDataAll, '{n}.Meta.meta_key', '{n}.Fundamental', '{n}.Fundamental.instrument_id');
        }


        return $fundamentalDataOrganized;
    }

    public function getInstrumentNews($instrumentId)
    {
        App::uses('News', 'Model');
        $News = new News();

        $newsList = $News->find('all', array(
            'conditions' => "(News.instrument_id=$instrumentId Or News.prefix like 'DSE NEWS' Or News.prefix like 'BSEC NEWS') and News.is_active=1",
            'recursive' => -1
        ));
        $news = Hash::combine($newsList, '{n}.News.id', '{n}.News', '{n}.News.prefix');
        return $news;
        // pr($news);
        // exit;
    }

    public function getInstrumentNewsWithTags($instrumentId, $tagArray = array())
    {
        App::uses('News', 'Model');
        $News = new News();

        $newsList = $News->find('all', array(
            'conditions' => "News.instrument_id=$instrumentId and News.is_active=1",
            'recursive' => -1
        ));

        //return $news;
        $allNews = Hash::combine($newsList, '{n}.News.id', '{n}.News');
        // pr($news);
        // $result = Hash::insert($news, '{n}.files', array('name' => 'files'));
        foreach ($tagArray as $css => $tag) {
            // pr(Hash::extract($newsList, "{n}.News[details=/$tag/]"));
            $result = Hash::extract($newsList, "{n}.News[details=/$tag/]");
            foreach ($result as $news) {
                $newsId = $news['id'];
                $allNews[$newsId]['tags'][] = $css;
            }
        }
        return $allNews;
        //pr($allNews);
        //exit;
    }

    /*
     *   $key=0 returns sector id as key
     *   $key=1 return sector name as key
     *  Old site and new site sector name are different for Mutual Fund(Old), Mutual Funds (new)
     * */
    public function getSectorList($key = 0)
    {
        App::uses('SectorList', 'Model');
        $SectorList = new SectorList();

        $SectorListData = $SectorList->find('all', array(
            'recursive' => -1
        ));

        if ($key == 0)
            $sectorArr = Hash::combine($SectorListData, '{n}.SectorList.id', '{n}.SectorList');
        if ($key == 1)
            $sectorArr = Hash::combine($SectorListData, '{n}.SectorList.name', '{n}.SectorList');
        return $sectorArr;
        // pr($news);
        // exit;
    }

    /*
     *
     * */
    public function getMetaList()
    {
        App::uses('Meta', 'Model');
        $Meta = new Meta();

        $MetaData = $Meta->find('all', array(
            'recursive' => 0
        ));
        /*
         * ReFormattaing array with meta id as key. values are meta and metagroup array
         * */
        $metaWithGroupIdAsKey=Hash::combine($MetaData, '{n}.Meta.id', '{n}');
        return $metaWithGroupIdAsKey;
    }

    /*
     * Param: $metaWithGroupIdAsKey is an array return by getMetaList funtion
     * */
    public function getMetaKeyArr($metaWithGroupIdAsKey=array(),$metaKey='event_type')
    {
        $metaKeyArr=Hash::extract($metaWithGroupIdAsKey, "{n}.{s}[meta_key=/$metaKey/]");
        return $metaKeyArr;
    }
    /*
     * return  meta array direct from database
     *
     * Array
(
    [0] => Array
        (
            [Meta] => Array
                (
                    [id] => 85
                    [meta_group_id] => 5
                    [meta_key] => dsex_listed
                    [meta_description] => If it is included in dsex index
                    [meta_created] => 2014-10-28 10:27:00
                )

            [MetaGroup] => Array
                (
                    [id] => 5
                    [group_key] => index_list
                    [group_description] => Instrument list for dsex, dses, ds30
                    [group_created] => 2014-10-28 10:25:00
                )

        )

)

    if GroupId provided it will return metakey of that group

     * */
    public function getMetaKeyArrFromDB($metaKey='dsex_listed', $gid=0)
    {
        App::uses('Meta', 'Model');
        $Meta = new Meta();

        if ($gid)
            $condition = "Meta.meta_key like '$metaKey' and Meta.meta_group_id=$gid";
        else
            $condition = "Meta.meta_key like '$metaKey'";

        $MetaData = $Meta->find('all', array(
            'conditions' => $condition,
            'recursive' => 0
        ));

        return $MetaData;
    }

    /*
     * Return all meta key of a meta group
     *
     * */

    public function getMetaKeyByGroup($gid=0,$gname='')
    {
        App::uses('Meta', 'Model');
        $Meta = new Meta();

        /*
         * If a groupid exist it will use id to query otherwise it will use group name
         * */
        if($gid)
            $condition="MetaGroup.id = $gid";
        else
            $condition="MetaGroup.group_key like '$gname'";


        $MetaData = $Meta->find('all', array(
            'conditions' => "$condition",
            'recursive' => 0
        ));


        if(!empty($MetaData)) {

            return $MetaData;
        }
        else
            return false;
    }

    public function getIp() {
        $ip = $_SERVER['REMOTE_ADDR'];

        if (!empty($_SERVER['HTTP_CLIENT_IP'])) {
            $ip = $_SERVER['HTTP_CLIENT_IP'];
        } elseif (!empty($_SERVER['HTTP_X_FORWARDED_FOR'])) {
            $ip = $_SERVER['HTTP_X_FORWARDED_FOR'];
        }

        return $ip;
    }
    // return latest file first
    function scan_dir($dir)
    {
        Configure::write('debug', 2);
        $ignored = array('.', '..', '.svn', '.htaccess');

        $files = array();
       // $f=scandir($dir);
      //  pr($f);
       // exit;
        foreach (scandir($dir) as $file) {
            if (in_array($file, $ignored)) continue;
            $files[$file] = filemtime($dir . '/' . $file);
        }

        arsort($files);
        $files = array_keys($files);

        return ($files) ? $files : false;
    }


}
