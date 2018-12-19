<?php
App::uses('AppHelper', 'View/Helper');
App::uses('CakeNumber', 'Utility');

class StockBangladeshHelper extends AppHelper
{
    public $helpers = array('Text');

    public function getInstrumentTreeHtml($data, $rootcss, $childcss)
    {
        // Logic to create specially formatted link goes here...
        $treeHtml = "<ul>";
        foreach ($data as $sectorName => $sectorList) {
            $sectorName = $this->Text->excerpt($sectorName, 'nothingsd', 19, '');
            $treeHtml .= '<li data-jstree="{&quot;icon&quot;:&quot; ' . $rootcss . ' &quot;}">' . $sectorName;
            $treeHtml .= '<ul>';
            foreach ($sectorList as $instrumentId => $instrumentName) {
                $treeHtml .= '<li data-jstree="{&quot;icon&quot;:&quot; ' . $childcss . ' &quot;}">' . $instrumentName . '</li>';
            }
            $treeHtml .= '</ul>';
            $treeHtml .= '</li>';
        }
        $treeHtml .= '</ul>';
        return $treeHtml;
    }

    public function getInstrumentBootstrapSelect($data, $id)
    {
        // Logic to create specially formatted link goes here...

        $selectHtml = '<select id="' . $id . '" class="bs-select form-control" data-live-search="true" name="'.$id.'">';
        foreach ($data as $sectorName => $sectorList) {

            // <optgroup label="Picnic">
            $selectHtml .= '<optgroup label="' . $sectorName . '">';
            //$treeHtml.='<ul>';
            foreach ($sectorList as $instrumentId => $instrumentName) {
                //<option value="AL">Alabama</option>
                $selectHtml .= '<option value="' . $instrumentName . '" >' . $instrumentName . '</option>';
            }
            $selectHtml .= '</optgroup>';

        }
        $selectHtml .= '</select>';
        return $selectHtml;
    }

    /*
     * Without sector grouping
     * */

    public function getInstrumentBootstrapSelect2($data, $id)
    {
        // Logic to create specially formatted link goes here...
//pr($data);
  //      exit;
        $selectHtml = '<select id="' . $id . '" class="bs-select form-control" data-live-search="true" title="Compare with">';
        foreach ($data as $instrumentId => $instrumentName) {
            //<option value="AL">Alabama</option>
            $selectHtml .= '<option value="' . $instrumentId . '" >' . $instrumentName . '</option>';
        }
        $selectHtml .= '</select>';
        return $selectHtml;
    }

    public function getInstrumentSelect2Html($data, $id)
    {
        // Logic to create specially formatted link goes here...
        $selectHtml = '<select id="' . $id . '" class="form-control select2"><option></option>';
        foreach ($data as $sectorName => $sectorList) {
            //<optgroup label="NFC EAST">

            $selectHtml .= '<optgroup label="' . $sectorName . '">';
            //$treeHtml.='<ul>';
            foreach ($sectorList as $instrumentId => $instrumentName) {
                //<option value="AL">Alabama</option>
                $selectHtml .= '<option value="' . $instrumentName . '">' . $instrumentName . '</option>';
            }
            $selectHtml .= '</optgroup>';

        }
        $selectHtml .= '</select>';
        return $selectHtml;
    }

    /*
     * Param: Array
    (
    [id] => 48650
    [market_id] => 17
    [instrument_id] => 12
    [instrument_code] => ABBANK
    [quote_bases] => A-EQ
    [open_price] => 26.2
    [pub_last_traded_price] => 25.7
    [spot_last_traded_price] => 0
    [high_price] => 26.2
    [low_price] => 25.5
    [close_price] => 25.7
    [yday_close_price] => 25.8
    [total_trades] => 473
    [total_volume] => 360300
    [total_value] => 0
    [public_total_trades] => 473
    [public_total_volume] => 0
    [public_total_value] => 9.2851
    [spot_total_trades] => 0
    [spot_total_volume] => 0
    [spot_total_value] => 0
    [lm_date_time] => 2013-12-19 14:29:59
    [trade_time] => 14:29:59
    [trade_date] => 2013-12-19
    )

     * return close price if close price exist
     * return public trade price if close price dont exist
     * return spot price if both of above not exist
     * used at instruments/details
     * */
    public function getLastTradePrice($companyData = array())
    {
        $ltp = $companyData['close_price'] != 0 ? $companyData['close_price'] : ($companyData['pub_last_traded_price'] != 0 ? $companyData['pub_last_traded_price'] : $companyData['spot_last_traded_price']);
        return $ltp;
    }

    /*
     * Param: company Array like getLastTradePrice
     * */
    public function getPriceChangePer($companyData = array())
    {
        $ltp = $companyData['close_price'] != 0 ? $companyData['close_price'] : ($companyData['pub_last_traded_price'] != 0 ? $companyData['pub_last_traded_price'] : $companyData['spot_last_traded_price']);
        $changePer = (($ltp-$companyData['yday_close_price']) / $companyData['yday_close_price']) * 100;
        return CakeNumber::toPercentage($changePer);
    }

    /*
     * Param: company Array like getLastTradePrice
     * */
    public function getPriceChange($companyData = array())
    {
        $ltp = $companyData['close_price'] != 0 ? $companyData['close_price'] : ($companyData['pub_last_traded_price'] != 0 ? $companyData['pub_last_traded_price'] : $companyData['spot_last_traded_price']);
        $change = $ltp-$companyData['yday_close_price'];
        return $change;
    }

    /*
     * Param 1: data52Weeks array read by $Chart->getDailyData($instrumentId,$dateBefore52weeks,$today);
     * Param 2: day index to retrieve 0-last day, 1- day before lastday ...
     * used at instruments/details
     * */
    public function getPrevVolume($data52Weeks = array(), $daybefore = 0)
    {
        $volumeArr = $data52Weeks['volume'];
        $volumeArr = array_reverse($volumeArr);
        return $volumeArr[$daybefore];
    }

    /*
    * Param 1: data52Weeks array read by $Chart->getDailyData($instrumentId,$dateBefore52weeks,$today);
    * used at instruments/details
    * */
    public function getVolumeChange($data52Weeks = array())
    {
        $volumeArr = $data52Weeks['volume'];
        $volumeArr = array_reverse($volumeArr);
        return $volumeArr[0] - $volumeArr[1];
    }

    /*
    * Param 1: data52Weeks array read by $Chart->getDailyData($instrumentId,$dateBefore52weeks,$today);
    * used at instruments/details
    * */
    public function getVolumeChangePer($data52Weeks = array())
    {
        $volumeArr = $data52Weeks['volume'];
        $volumeArr = array_reverse($volumeArr);
        $changePer = (($volumeArr[0] - $volumeArr[1]) / $volumeArr[1]) * 100;
        return CakeNumber::toPercentage($changePer);
    }

    /*
   * Param 1: data52Weeks array read by $Chart->getDailyData($instrumentId,$dateBefore52weeks,$today);
   * used at instruments/details
   * */
    public function getAvgVolume($data52Weeks = array(), $day = 5)
    {
        $volumeArr = $data52Weeks['volume'];
        $volumeArr = array_reverse($volumeArr);
        $last5daysVol = array_slice($volumeArr, 0, $day);
        return array_sum($last5daysVol) / $day;
    }

    /*
    * Param 1: data52Weeks array read by $Chart->getDailyData($instrumentId,$dateBefore52weeks,$today);
    * used at instruments/details
    * */
    public function getCmpWithAvgVolume($data52Weeks = array(), $day = 5)
    {
        $volumeArr = $data52Weeks['volume'];
        $volumeArr = array_reverse($volumeArr);
        $last5daysVol = array_slice($volumeArr, 0, $day);
        $lastVol = $volumeArr[0];
        $avgVol = array_sum($last5daysVol) / $day;

        $result = (($lastVol - $avgVol) / $avgVol) * 100;
        return CakeNumber::toPercentage($result);
    }

    /*
    * Param 1: data52Weeks array read by $Chart->getDailyData($instrumentId,$dateBefore52weeks,$today);
    * used at instruments/details
    * */
    public function get52WeekHigh($data52Weeks = array(), $field = 'close')
    {
        return CakeNumber::precision(max($data52Weeks[$field]), 2);

    }

    /*
    * Param 1: data52Weeks array read by $Chart->getDailyData($instrumentId,$dateBefore52weeks,$today);
    * used at instruments/details
    * */
    public function get52WeekHighDate($data52Weeks = array(), $field = 'close')
    {
        $maxKeyArr = array_keys($data52Weeks[$field], max($data52Weeks[$field]));
        $highDateArr = array();

        foreach ($maxKeyArr as $key) {
            $highDateArr[] = date('d-m-Y', $data52Weeks['realtimeStamps'][$key]);
            //$highDateArr[] = CakeTime::niceShort( $data52Weeks['realtimeStamps'][$key]);
        }
        App::uses('String', 'Utility');
        return String::toList($highDateArr);
    }

    /*
    * Param 1: data52Weeks array read by $Chart->getDailyData($instrumentId,$dateBefore52weeks,$today);
    * used at instruments/details
    * */
    public function get52WeekLow($data52Weeks = array(), $field = 'close')
    {
        return CakeNumber::precision(min($data52Weeks[$field]), 2);
    }

    /*
    * Param 1: data52Weeks array read by $Chart->getDailyData($instrumentId,$dateBefore52weeks,$today);
    * used at instruments/details
    * */
    public function get52WeekLowDate($data52Weeks = array(), $field = 'close')
    {

        $maxKeyArr = array_keys($data52Weeks[$field], min($data52Weeks[$field]));
        $highDateArr = array();

        foreach ($maxKeyArr as $key) {
            $highDateArr[] = date('d-m-Y', $data52Weeks['realtimeStamps'][$key]);
        }
        App::uses('String', 'Utility');
        return String::toList($highDateArr);
    }

    /*
    * Param: company Array like getLastTradePrice
     * Return total trade including spot trade
    * */
    public function getTotalTrades($companyData = array())
    {

        return $companyData['total_trades'] + $companyData['spot_total_trades'];
    }

    /*
    * Param: company Array using $StockBangladesh->getPrevMinuteInfo($lastTradeInfo);
     * used in instruments/details
     * Return total trade including spot trade
    * */
    public function getTotalTradesChange($lastTradeInfo = array(), $prevTradeInfo = array())
    {

        return ($lastTradeInfo['total_trades'] + $lastTradeInfo['spot_total_trades']) - ($prevTradeInfo['total_trades'] + $prevTradeInfo['spot_total_trades']);
    }

    /*
    * Param:  Array using $StockBangladesh->getLastTradeInfo($marketId,$instrumentId); and $StockBangladesh->getPrevMinuteInfo($lastTradeInfo);
     * used in instruments/details
     * Return total trade including spot trade
    * */
    public function getTotalTradesChangePer($lastTradeInfo = array(), $prevTradeInfo = array())
    {
        $lastTotalTrade = $lastTradeInfo['total_trades'] + $lastTradeInfo['spot_total_trades'];
        $prevTotalTrade = $prevTradeInfo['total_trades'] + $prevTradeInfo['spot_total_trades'];
        $result = (($lastTotalTrade - $prevTotalTrade) / $prevTotalTrade) * 100;
        return CakeNumber::toPercentage($result);
    }


    /*
   * Param: company Array like getLastTradePrice

   * */
    public function getTotalVolume($companyData = array())
    {

        return $companyData['public_total_volume'] + $companyData['spot_total_volume'];
    }

    /*
    * Param: company Array using $StockBangladesh->getPrevMinuteInfo($lastTradeInfo);
     * used in instruments/details
     * Return total trade including spot trade
    * */
    public function getTotalVolumeChange($lastTradeInfo = array(), $prevTradeInfo = array())
    {

        return ($lastTradeInfo['public_total_volume'] + $lastTradeInfo['spot_total_volume']) - ($prevTradeInfo['public_total_volume'] + $prevTradeInfo['spot_total_volume']);
    }

    /*
    * Param:  Array using $StockBangladesh->getLastTradeInfo($marketId,$instrumentId); and $StockBangladesh->getPrevMinuteInfo($lastTradeInfo);
     * used in instruments/details
     * Return total trade including spot trade
    * */
    public function getTotalVolumeChangePer($lastTradeInfo = array(), $prevTradeInfo = array())
    {
        $lastTotalTrade = $lastTradeInfo['public_total_volume'] + $lastTradeInfo['spot_total_volume'];
        $prevTotalTrade = $prevTradeInfo['public_total_volume'] + $prevTradeInfo['spot_total_volume'];
        $result = (($lastTotalTrade - $prevTotalTrade) / $prevTotalTrade) * 100;
        return CakeNumber::toPercentage($result);
    }

    /*
    * Param: company Array like getLastTradePrice

    * */
    public function getTotalValue($companyData = array())
    {

        return $companyData['public_total_value'] + $companyData['spot_total_value'];
    }


    /*
    * Param: company Array using $StockBangladesh->getPrevMinuteInfo($lastTradeInfo);
     * used in instruments/details
     * Return total trade including spot trade
    * */
    public function getTotalValueChange($lastTradeInfo = array(), $prevTradeInfo = array())
    {

        return ($lastTradeInfo['public_total_value'] + $lastTradeInfo['spot_total_value']) - ($prevTradeInfo['public_total_value'] + $prevTradeInfo['spot_total_value']);
    }

    /*
    * Param:  Array using $StockBangladesh->getLastTradeInfo($marketId,$instrumentId); and $StockBangladesh->getPrevMinuteInfo($lastTradeInfo);
     * used in instruments/details
     * Return total trade including spot trade
    * */
    public function getTotalValueChangePer($lastTradeInfo = array(), $prevTradeInfo = array())
    {
        $lastTotalTrade = $lastTradeInfo['public_total_value'] + $lastTradeInfo['spot_total_value'];
        $prevTotalTrade = $prevTradeInfo['public_total_value'] + $prevTradeInfo['spot_total_value'];
        $result = (($lastTotalTrade - $prevTotalTrade) / $prevTotalTrade) * 100;
        return CakeNumber::toPercentage($result);
    }

    public function getPerTradesValue($lastTradeInfo)
    {
        $valuePerTrade = ($this->getTotalValue($lastTradeInfo) / $this->getTotalTrades($lastTradeInfo)) * 1000000;
        return CakeNumber::format($valuePerTrade, array(
            'places' => 2,
            'before' => 'Tk. ',
            'escape' => false,
            'decimals' => '.',
            'thousands' => ','
        ));

    }


    public function niceNumber($number)
    {

        return CakeNumber::format($number, array(
            'places' => 2,
            'before' => 'Tk. ',
            'escape' => false,
            'decimals' => '.',
            'thousands' => ','
        ));

    }


    public function getMarketCapital($lastTradeInfo = array(), $fundamentalDataOrganized = array())
    {
        $result= $this->getLastTradePrice($lastTradeInfo)*$fundamentalDataOrganized['outstanding_capital']['meta_value'];

        return CakeNumber::format($result, array(
            'places' => 2,
            'before' => 'Tk. ',
            'after' => ' M',
            'escape' => false,
            'decimals' => '.',
            'thousands' => ','
        ));
    }

    public function getTradePerOfMarketCapital($lastTradeInfo = array(), $fundamentalDataOrganized = array())
    {
        $totalTradeValue=$this->getTotalValue($lastTradeInfo);
        $mcap=$this->getMarketCapital($lastTradeInfo,$fundamentalDataOrganized);

        $per=($totalTradeValue/$mcap)*100;
        return $per." %";

    }

    public function getPublicSecurities( $fundamentalDataOrganized = array())
    {
        return (($fundamentalDataOrganized['share_percentage_public']['meta_value'])/100)*$fundamentalDataOrganized['no_of_securities']['meta_value'];
    }

    public function getPublicCapital($lastTradeInfo = array(), $fundamentalDataOrganized = array())
    {
        $result=($this->getPublicSecurities($fundamentalDataOrganized)*$this->getLastTradePrice($lastTradeInfo))/1000000;

        return CakeNumber::format($result, array(
            'places' => 2,
            'before' => 'Tk. ',
            'after' => ' M',
            'escape' => false,
            'decimals' => '.',
            'thousands' => ','
        ));

    }




}