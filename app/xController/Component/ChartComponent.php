<?php
App::uses('Component', 'Controller');
class ChartComponent extends Component
{
    public $lastTradeInfo = array();
    public $components = array('StockBangladesh');

#/ <summary>
#/ Add an indicator chart to the FinanceChart object. In this demo example, the
#/ indicator parameters (such as the period used to compute RSI, colors of the lines,
#/ etc.) are hard coded to commonly used values. You are welcome to design a more
#/ complex user interface to allow users to set the parameters.
#/ </summary>
#/ <param name="m">The FinanceChart object to add the line to.</param>
#/ <param name="indicator">The selected indicator.</param>
#/ <param name="height">Height of the chart in pixels</param>
#/ <returns>The XYChart object representing indicator chart.</returns>
    public function addIndicator(&$m, $indicator, $height)
    {
        if ($indicator == "RSI") {
            return $m->addRSI($height, 14, 0x800080, 20, 0xff6666, 0x6666ff);
        } else if ($indicator == "StochRSI") {
            return $m->addStochRSI($height, 14, 0x800080, 30, 0xff6666, 0x6666ff);
        } else if ($indicator == "MACD") {
            return $m->addMACD($height, 26, 12, 9, 0x0000ff, 0xff00ff, 0x008000);
        } else if ($indicator == "FStoch") {
            return $m->addFastStochastic($height, 14, 3, 0x006060, 0x606000);
        } else if ($indicator == "SStoch") {
            return $m->addSlowStochastic($height, 14, 3, 0x006060, 0x606000);
        } else if ($indicator == "ATR") {
            return $m->addATR($height, 14, 0x808080, 0x0000ff);
        } else if ($indicator == "ADX") {
            return $m->addADX($height, 14, 0x008000, 0x800000, 0x000080);
        } else if ($indicator == "DCW") {
            return $m->addDonchianWidth($height, 20, 0x0000ff);
        } else if ($indicator == "BBW") {
            return $m->addBollingerWidth($height, 20, 2, 0x0000ff);
        } else if ($indicator == "DPO") {
            return $m->addDPO($height, 20, 0x0000ff);
        } else if ($indicator == "PVT") {
            return $m->addPVT($height, 0x0000ff);
        } else if ($indicator == "Momentum") {
            return $m->addMomentum($height, 12, 0x0000ff);
        } else if ($indicator == "Performance") {
            return $m->addPerformance($height, 0x0000ff);
        } else if ($indicator == "ROC") {
            return $m->addROC($height, 12, 0x0000ff);
        } else if ($indicator == "OBV") {
            return $m->addOBV($height, 0x0000ff);
        } else if ($indicator == "AccDist") {
            return $m->addAccDist($height, 0x0000ff);
        } else if ($indicator == "CLV") {
            return $m->addCLV($height, 0x0000ff);
        } else if ($indicator == "WilliamR") {
            return $m->addWilliamR($height, 14, 0x800080, 30, 0xff6666, 0x6666ff);
        } else if ($indicator == "Aroon") {
            return $m->addAroon($height, 14, 0x339933, 0x333399);
        } else if ($indicator == "AroonOsc") {
            return $m->addAroonOsc($height, 14, 0x0000ff);
        } else if ($indicator == "CCI") {
            return $m->addCCI($height, 20, 0x800080, 100, 0xff6666, 0x6666ff);
        } else if ($indicator == "EMV") {
            return $m->addEaseOfMovement($height, 9, 0x006060, 0x606000);
        } else if ($indicator == "MDX") {
            return $m->addMassIndex($height, 0x800080, 0xff6666, 0x6666ff);
        } else if ($indicator == "CVolatility") {
            return $m->addChaikinVolatility($height, 10, 10, 0x0000ff);
        } else if ($indicator == "COscillator") {
            return $m->addChaikinOscillator($height, 0x0000ff);
        } else if ($indicator == "CMF") {
            return $m->addChaikinMoneyFlow($height, 21, 0x008000);
        } else if ($indicator == "NVI") {
            return $m->addNVI($height, 255, 0x0000ff, 0x883333);
        } else if ($indicator == "PVI") {
            return $m->addPVI($height, 255, 0x0000ff, 0x883333);
        } else if ($indicator == "MFI") {
            return $m->addMFI($height, 14, 0x800080, 30, 0xff6666, 0x6666ff);
        } else if ($indicator == "PVO") {
            return $m->addPVO($height, 26, 12, 9, 0x0000ff, 0xff00ff, 0x008000);
        } else if ($indicator == "PPO") {
            return $m->addPPO($height, 26, 12, 9, 0x0000ff, 0xff00ff, 0x008000);
        } else if ($indicator == "UO") {
            return $m->addUltimateOscillator($height, 7, 14, 28, 0x800080, 20, 0xff6666,
                0x6666ff);
        } else if ($indicator == "Vol") {
            return $m->addVolIndicator($height, 0x99ff99, 0xff9999, 0xc0c0c0);
        } else if ($indicator == "TRIX") {
            return $m->addTRIX($height, 12, 0x0000ff);
        }
        return null;
    }


#/ <summary>
#/ Add a moving average line to the FinanceChart object.
#/ </summary>
#/ <param name="m">The FinanceChart object to add the line to.</param>
#/ <param name="avgType">The moving average type (SMA/EMA/TMA/WMA).</param>
#/ <param name="avgPeriod">The moving average period.</param>
#/ <param name="color">The color of the line.</param>
#/ <returns>The LineLayer object representing line layer created.</returns>
    public function addMovingAvg(&$m, $avgType, $avgPeriod, $color)
    {
        if ($avgPeriod < 1) {
            $avgPeriod = 1;
        } else if ($avgPeriod > 300) {
            $avgPeriod = 300;
        }


        if ($avgPeriod) {
            if ($avgType == "SMA") {
                return $m->addSimpleMovingAvg($avgPeriod, $color);
            } else if ($avgType == "EMA") {
                return $m->addExpMovingAvg($avgPeriod, $color);
            } else if ($avgType == "TMA") {
                return $m->addTriMovingAvg($avgPeriod, $color);
            } else if ($avgType == "WMA") {
                return $m->addWeightedMovingAvg($avgPeriod, $color);
            }
        }
        return null;
    }


    public function getDailyData($instrumentId = 12, $from = '2010-10-25', $to = '2013-04-25', $extraPoint = 0)
    {

        App::uses('DataBanksEod', 'Model');
        require_once(APP . 'Vendor' . DS . 'chartdir' . DS . 'FinanceChart.php');
        $DataBanksEod = new DataBanksEod();
        $dataBank = $DataBanksEod->find('all', array(
            'conditions' => "DataBanksEod.instrument_id=$instrumentId and date BETWEEN '$from' AND '$to'",
            'recursive' => -1
        ));
        if ($extraPoint) {
            $dataBankExtra = $DataBanksEod->find('all', array(
                'conditions' => "DataBanksEod.instrument_id=$instrumentId and date < '$from'",
                'recursive' => -1,
                'limit' => $extraPoint,
                'order' => 'DataBanksEod.id DESC',
            ));
//pr($dataBank);
//pr($dataBankExtra);
            $dataBankExtra = array_reverse($dataBankExtra);
            $dataBankall = array_merge($dataBankExtra, $dataBank);
        } else {
            $dataBankall = $dataBank;
        }
//        pr($dataBankall);
        //  SELECT *  FROM `data_banks_eods` WHERE `instrument_id` = 12 AND `date` BETWEEN '2010-01-30' AND '2011-09-29'

        foreach ($dataBankall as $data) {
            $strtotime = strtotime($data['DataBanksEod']['date']);
            $timeStamps[] = chartTime2($strtotime);
            $realtimeStamps[] = $strtotime+0;
            $closeData[] = $data['DataBanksEod']['close']+0;
            $openData[] = $data['DataBanksEod']['open']+0;
            $lowData[] = $data['DataBanksEod']['low']+0;
            $highData[] = $data['DataBanksEod']['high']+0;
            $volData[] = $data['DataBanksEod']['volume']+0;

        }

        $ohlcArr = array();

        $ohlcArr['date'] = $timeStamps;
        $ohlcArr['realtimeStamps'] = $realtimeStamps;
        $ohlcArr['open'] = $openData;
        $ohlcArr['high'] = $highData;
        $ohlcArr['low'] = $lowData;
        $ohlcArr['close'] = $closeData;
        $ohlcArr['volume'] = $volData;


        return $ohlcArr;

    }

    public function getAdjustedDailyData($instrumentId = 12, $from = '2010-10-25', $to = '2013-04-25', $extraPoint = 0)
    {

        App::uses('DataBanksEod', 'Model');
        require_once(APP . 'Vendor' . DS . 'chartdir' . DS . 'FinanceChart.php');
        $DataBanksEod = new DataBanksEod();
        $dataBank = $DataBanksEod->find('all', array(
            'conditions' => "DataBanksEod.instrument_id=$instrumentId and date BETWEEN '$from' AND '$to'",
            'recursive' => -1,
            'order' => 'DataBanksEod.date ASC'
        ));
        if ($extraPoint) {
            $dataBankExtra = $DataBanksEod->find('all', array(
                'conditions' => "DataBanksEod.instrument_id=$instrumentId and date < '$from'",
                'recursive' => -1,
                'limit' => $extraPoint,
                'order' => 'DataBanksEod.date DESC'
            ));
            $dataBankExtra = array_reverse($dataBankExtra);

            $dataBankall = array_merge($dataBankExtra, $dataBank);
        } else {
            $dataBankall = $dataBank;
        }

        $metaKey = array();
        $metaKey[] = 'face_value';
        $faceValueArr = $this->StockBangladesh->getFundamentalInfo($instrumentId, $metaKey);

        App::uses('CorporateAction', 'Model');
        $CorporateAction = new CorporateAction();

        $corporateActionData = $CorporateAction->find('all', array(
            'conditions' => "CorporateAction.instrument_id=$instrumentId and CorporateAction.active=1",
            'recursive' => -1,
            'order' => array('CorporateAction.record_date' => 'asc')
        ));


        $resultarr = $dataBankall;
        // pr($resultarr);
        //exit;
        foreach ($corporateActionData as $row) {
            $action = $row['CorporateAction']['action'];
            $adjustedArr = array();

            if ($action == 'stockdiv') {
                $adjustmentFactor = (100 + $row['CorporateAction']['value']) / 100;

                $day = $row['CorporateAction']['record_date'];
                //$daystamp= strtotime($day)-24*60*60;
                $daystamp = strtotime($day);

                foreach ($resultarr as $data) {

                    if (strtotime($data['DataBanksEod']['date']) < $daystamp) {
                        $data['DataBanksEod']['date'] = $data['DataBanksEod']['date'];
                        $data['DataBanksEod']['open'] = $data['DataBanksEod']['open'] / $adjustmentFactor;
                        $data['DataBanksEod']['high'] = $data['DataBanksEod']['high'] / $adjustmentFactor;
                        $data['DataBanksEod']['low'] = $data['DataBanksEod']['low'] / $adjustmentFactor;
                        $data['DataBanksEod']['close'] = $data['DataBanksEod']['close'] / $adjustmentFactor;
                        // Notes: In previous version volume is not adjustd
                        $data['DataBanksEod']['volume'] = $data['DataBanksEod']['volume'] * $adjustmentFactor;
                    }

                    $adjustedArr[] = $data;
                }

                $resultarr = array();
                $resultarr = $adjustedArr;

            } elseif ($action == 'cashdiv') {


                $facevalue = $faceValueArr['face_value']['meta_value'];


                $adjustmentFactor = $facevalue * $row['CorporateAction']['value'] / 100;

                $day = $row['CorporateAction']['record_date'];
                $daystamp = strtotime($day);
                foreach ($resultarr as $data) {
                    if (strtotime($data['DataBanksEod']['date']) < $daystamp) {
                        $data['DataBanksEod']['date'] = $data['DataBanksEod']['date'];
                        $data['DataBanksEod']['open'] = $data['DataBanksEod']['open'] - $adjustmentFactor;
                        $data['DataBanksEod']['high'] = $data['DataBanksEod']['high'] - $adjustmentFactor;
                        $data['DataBanksEod']['low'] = $data['DataBanksEod']['low'] - $adjustmentFactor;
                        $data['DataBanksEod']['close'] = $data['DataBanksEod']['close'] - $adjustmentFactor;
                    }

                    $adjustedArr[] = $data;
                }

                $resultarr = array();
                $resultarr = $adjustedArr;

            } elseif ($action == 'rightshare') {

                $facevalue = $faceValueArr['face_value']['meta_value'];

                $adjustmentFactor = (100 + $row['CorporateAction']['value']) / 100;
                $premium = $row['CorporateAction']['premium'];

                $day = $row['CorporateAction']['record_date'];
                //$daystamp= strtotime($day)-24*60*60;
                $daystamp = strtotime($day);

                foreach ($resultarr as $data) {
                    if (strtotime($data['DataBanksEod']['date']) < $daystamp) {
                        $data['DataBanksEod']['date'] = $data['DataBanksEod']['date'];
                        $data['DataBanksEod']['open'] = (($data['DataBanksEod']['open'] * 100) + (($premium + $facevalue) * $row['CorporateAction']['value'])) / (100 + $row['CorporateAction']['value']);
                        $data['DataBanksEod']['high'] = (($data['DataBanksEod']['high'] * 100) + (($premium + $facevalue) * $row['CorporateAction']['value'])) / (100 + $row['CorporateAction']['value']);
                        $data['DataBanksEod']['low'] = (($data['DataBanksEod']['low'] * 100) + (($premium + $facevalue) * $row['CorporateAction']['value'])) / (100 + $row['CorporateAction']['value']);
                        $data['DataBanksEod']['close'] = (($data['DataBanksEod']['close'] * 100) + (($premium + $facevalue) * $row['CorporateAction']['value'])) / (100 + $row['CorporateAction']['value']);
                        // Notes: In previous version volume is not adjustd
                        $data['DataBanksEod']['volume'] = $data['DataBanksEod']['volume'] * $adjustmentFactor;

                        /*$data['DataBanksEod']['open']=($data['DataBanksEod']['open']+$close_price_adjustment_factor)/$adjustmentFactor;
                        $data['DataBanksEod']['high']=($data['DataBanksEod']['high']+$close_price_adjustment_factor)/$adjustmentFactor;
                        $data['DataBanksEod']['low']=($data['DataBanksEod']['low']+$close_price_adjustment_factor)/$adjustmentFactor;
                        $data['DataBanksEod']['close']=($data['DataBanksEod']['close']+$close_price_adjustment_factor)/$adjustmentFactor;*/


                    }

                    $adjustedArr[] = $data;
                }

                $resultarr = array();
                $resultarr = $adjustedArr;

            } elseif ($action == 'split') {
                $adjustmentFactor = $row['CorporateAction']['value'];

                $day = $row['CorporateAction']['record_date'];
                //$daystamp= strtotime($day)-24*60*60;
                $daystamp = strtotime($day);

                foreach ($resultarr as $data) {
                    if (strtotime($data['DataBanksEod']['date']) < $daystamp) {
                        $data['DataBanksEod']['date'] = $data['DataBanksEod']['date'];
                        $data['DataBanksEod']['open'] = $data['DataBanksEod']['open'] / $adjustmentFactor;
                        $data['DataBanksEod']['high'] = $data['DataBanksEod']['high'] / $adjustmentFactor;
                        $data['DataBanksEod']['low'] = $data['DataBanksEod']['low'] / $adjustmentFactor;
                        $data['DataBanksEod']['close'] = $data['DataBanksEod']['close'] / $adjustmentFactor;
                        $data['DataBanksEod']['volume'] = $data['DataBanksEod']['volume'] * $adjustmentFactor;
                    }

                    $adjustedArr[] = $data;
                }
                $resultarr = array();
                $resultarr = $adjustedArr;

            }


            //print_r($adjustedArr);
        }

        $dataBankall = $resultarr;


        foreach ($dataBankall as $data) {
            $strtotime = strtotime($data['DataBanksEod']['date']);
            $timeStamps[] = chartTime2($strtotime);
            //$realtimeStamps[] = $data['DataBanksEod']['date'];
            $realtimeStamps[] = $strtotime+0;
            $closeData[] = $data['DataBanksEod']['close']+0;
            $openData[] = $data['DataBanksEod']['open']+0;
            $lowData[] = $data['DataBanksEod']['low']+0;
            $highData[] = $data['DataBanksEod']['high']+0;
            $volData[] = $data['DataBanksEod']['volume']+0;

        }


        $ohlcArr = array();

        $ohlcArr['date'] = $timeStamps;
        $ohlcArr['realtimeStamps'] = $realtimeStamps;
        $ohlcArr['open'] = $openData;
        $ohlcArr['high'] = $highData;
        $ohlcArr['low'] = $lowData;
        $ohlcArr['close'] = $closeData;
        $ohlcArr['volume'] = $volData;
        $ohlcArr['ca'] = $corporateActionData;

        return $ohlcArr;

    }

    public function getIntradayData($instrumentId = 12,$marketId=0)
    {
  //      Configure::write('debug', 2);
        $key = "intraday_$instrumentId";
  //      $ret = Cache::delete($key);
        $intradayData = Cache::read($key);
        // pr($intradayData);
        if (!$intradayData) {
         //   pr("From database");
            App::uses('DataBanksIntraday', 'Model');
            $DataBanksIntraday = new DataBanksIntraday();
//echo "DataBanksIntraday.market_id=$marketId and DataBanksIntraday.instrument_id=$instrumentId";
            $intradayData = $DataBanksIntraday->find('all', array(
                'conditions' => "DataBanksIntraday.market_id=$marketId and DataBanksIntraday.instrument_id=$instrumentId and DataBanksIntraday.total_volume>0",
                'group' => array('DataBanksIntraday.trade_time'),
                'order' => array('DataBanksIntraday.trade_time' => 'desc'),
                'recursive' => -1
            ));

            Cache::write($key, $intradayData, 'minute');

        }
      //  $intradayData=Hash::extract($intradayData, '{n}.DataBanksIntraday[total_volume>0]');
//pr($intradayData);
//        exit;

        $shiftedVolume=Hash::extract($intradayData, '{n}.DataBanksIntraday.total_volume');

        array_shift($shiftedVolume);
        array_push($shiftedVolume,0);

        $volume=Hash::extract($intradayData, '{n}.DataBanksIntraday.total_volume');

        $sub = function($a, $b) { return $a - $b; };
        $volumeChange = array_map($sub, $volume, $shiftedVolume);

        $returnArr = array();

/*        $returnArr['c'] = Hash::map(Hash::extract($intradayData, '{n}.DataBanksIntraday.close_price'), '{n}', function($newArr) {

            return $newArr+0;
        });*/

        foreach($intradayData as $row)
        {

            $ltp = $row['DataBanksIntraday']['close_price'] != 0 ? $row['DataBanksIntraday']['close_price'] : ($row['DataBanksIntraday']['pub_last_traded_price'] != 0 ? $row['DataBanksIntraday']['pub_last_traded_price'] : $row['DataBanksIntraday']['spot_last_traded_price']);
            $returnArr['c'][]=$ltp+0;
        }

        $returnArr['t'] =Hash::extract($intradayData, '{n}.DataBanksIntraday.lm_date_time');

        $returnArr['v'] = Hash::map(Hash::extract($intradayData, '{n}.DataBanksIntraday.total_volume'), '{n}', function($newArr) {
            return $newArr+0;
        });
        $returnArr['vc'] = $volumeChange;

        $returnArr['c']=array_reverse($returnArr['c']);
        $returnArr['t']=array_reverse($returnArr['t']);
        $returnArr['v']=array_reverse($returnArr['v']);
        $returnArr['vc']=array_reverse($returnArr['vc']);
       /* pr($shiftedVolume);
        pr($volume);
        pr($volumeChange);
        pr($returnArr);
        exit;*/

        return $returnArr;

    }

    public function getCorporateAction($record_date='1970-01-01')
    {
        App::uses('CorporateAction', 'Model');
        $CorporateAction = new CorporateAction();

        $corporateActionData = $CorporateAction->find('all', array(
            'conditions' => "CorporateAction.record_date>$record_date and CorporateAction.active=1",
            'recursive' => -1,
            'order' => array('CorporateAction.id' => 'desc')
        ));
return $corporateActionData;
    }


}
