<?php
App::uses('Component', 'Controller');
class ChartComponent extends Component
{
    public $lastTradeInfo = array();


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
if($extraPoint)
{
        $dataBankExtra = $DataBanksEod->find('all', array(
            'conditions' => "DataBanksEod.instrument_id=$instrumentId and date < '$from'",
            'recursive' => -1,
            'limit' => $extraPoint,
            'order' => 'DataBanksEod.id DESC',
        ));
//pr($dataBank);
//pr($dataBankExtra);
        $dataBankall = array_merge($dataBankExtra,$dataBank);
}
        else
        {
            $dataBankall=$dataBank;
        }
//        pr($dataBankall);
        //  SELECT *  FROM `data_banks_eods` WHERE `instrument_id` = 12 AND `date` BETWEEN '2010-01-30' AND '2011-09-29'

        foreach ($dataBankall as $data) {
            $timeStamps[] = chartTime2(strtotime($data['DataBanksEod']['date']));
            $closeData[] = $data['DataBanksEod']['close'];
            $openData[] = $data['DataBanksEod']['open'];
            $lowData[] = $data['DataBanksEod']['low'];
            $highData[] = $data['DataBanksEod']['high'];
            $volData[] = $data['DataBanksEod']['volume'];

        }

        $ohlcArr = array();

        $ohlcArr['date'] = $timeStamps;
        $ohlcArr['open'] = $openData;
        $ohlcArr['high'] = $highData;
        $ohlcArr['low'] = $lowData;
        $ohlcArr['close'] = $closeData;
        $ohlcArr['volume'] = $volData;

        return $ohlcArr;

    }


}
