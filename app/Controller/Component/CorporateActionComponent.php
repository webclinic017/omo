<?php
App::uses('Component', 'Controller');
class CorporateActionComponent extends Component
{
    public $lastTradeInfo = array();

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
