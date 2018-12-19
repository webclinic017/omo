<?php
App::uses('AppHelper', 'View/Helper');
App::uses('CakeNumber', 'Utility');

class PortfolioHelper extends AppHelper
{
    public $helpers = array('Text', 'StockBangladesh');

    /*
     * instrument array from array retrieved by component method $Portfolio->getPortfolioHoldings($allTransactions,$this->ttypeArr);
     * */
    public function getPurchaseDate($transactionArr)
    {
        App::uses('CakeTime', 'Utility');
        //pr($transactionArr);
        //exit;
        if (count($transactionArr['transactions']) > 1) {
            return "Multiple";
        } else {
            $pdate = CakeTime::format($transactionArr['transactions'][0]['transaction_time'], '%d/%m/%Y');
            return $pdate;
        }
    }

    public function getPriceChange($transactionArr)
    {
        $priceChange = $this->StockBangladesh->getPriceChange($transactionArr['lastTradeInfo']);
        $priceChangePer = $this->StockBangladesh->getPriceChangePer($transactionArr['lastTradeInfo']);

        if ($priceChange < 0) {
            $htmlCode = "<p class='text-danger'>$priceChange ($priceChangePer)</p>";

        } else {
            $htmlCode = "<p class='text-success'>$priceChange ($priceChangePer)</p>";
        }
        return $htmlCode;
    }
/*
 * @TODO We can remove use of portfolio $portfolioCommission as there is no way to skip commission entry so we can depend on transaction commission. During adding new transaction every transaction populated with defult portfolio transaction
 * */
    public function calculateCommission($transactionArr, $portfolioCommission)
    {
        App::uses('CakeTime', 'Utility');

        $totalCommission = 0;
        foreach ($transactionArr['transactions'] as $trans) {
            $cost = $trans['amount'] * $trans['rate'];
           /* if ($trans['commission']) {
                $totalCommission += $cost * (($trans['commission']) / 100);
            } else {
                $totalCommission += $cost * (($portfolioCommission) / 100);
            }*/

            $totalCommission += $cost * (($trans['commission']) / 100);  // as there is no way to skip commission entry so we can depend on transaction commission. During adding new transaction every transaction populated with defult portfolio transaction
        }

        return CakeNumber::format($totalCommission, array(
            'places' => 2,
            'before' => '',
            'escape' => false,
            'decimals' => '.',
            'thousands' => ','
        ));

        //pr($transactionArr);
        //exit;

    }

    public function getCommission($trans, $portfolioCommission)
    {

       /* if ($trans['commission']) {
            $commission = $trans['commission'];
        } else {
            $commission = $portfolioCommission;
        }*/

        $commission = $trans['commission'];

        return $commission;

    }

    public function calculateChildCommission($trans, $portfolioCommission)
    {
        App::uses('CakeTime', 'Utility');

        $totalCommission = 0;


        $cost = $trans['amount'] * $trans['rate'];
       /* if ($trans['commission']) {
            $totalCommission += $cost * (($trans['commission']) / 100);
        } else {
            $totalCommission += $cost * (($portfolioCommission) / 100);
        }*/

        $totalCommission += $cost * (($trans['commission']) / 100);


        return CakeNumber::format($totalCommission, array(
            'places' => 2,
            'before' => '',
            'escape' => false,
            'decimals' => '.',
            'thousands' => ','
        ));

        //pr($transactionArr);
        //exit;

    }


    public function calculateTodayGainLoss($transactionArr, $change, $format = 1)
    {

        $gainLoss = $change * $transactionArr['totalQuantity'];

        if ($format) {
            $formattedVal = CakeNumber::format($gainLoss, array(
                'places' => 2,
                'before' => '',
                'escape' => false,
                'decimals' => '.',
                'thousands' => ','
            ));
            if ($gainLoss < 0) {
                $htmlCode = "<p class='text-danger'>$formattedVal</p>";

            } else {
                $htmlCode = "<p class='text-success'>$formattedVal</p>";
            }
            return $htmlCode;

        } else {
            return $gainLoss;
        }

        //pr($transactionArr);
        //exit;

    }

    public function calculateChildRowTodayGainLoss($transactionArr, $change, $format = 1)
    {

        $gainLoss = $change * $transactionArr['amount'];

        if ($format) {
            $formattedVal = CakeNumber::format($gainLoss, array(
                'places' => 2,
                'before' => '',
                'escape' => false,
                'decimals' => '.',
                'thousands' => ','
            ));
            if ($gainLoss < 0) {
                $htmlCode = "<p class='text-danger'>$formattedVal</p>";

            } else {
                $htmlCode = "<p class='text-success'>$formattedVal</p>";
            }
            return $htmlCode;

        } else {
            return $gainLoss;
        }

        //pr($transactionArr);
        //exit;

    }


    public function calculateTodayTotalGainLoss($allHoldings)
    {
        $gainLossArr = array();
        foreach ($allHoldings as $instrumentId => $trans) {
            $gainLossArr[$instrumentId] = $this->StockBangladesh->getPriceChange($trans['lastTradeInfo']) * $trans['totalQuantity'];
        }
        $totalGainLoss = array_sum($gainLossArr);

        return CakeNumber::format($totalGainLoss, array(
            'places' => 2,
            'before' => '',
            'escape' => false,
            'decimals' => '.',
            'thousands' => ','
        ));

    }

    public function calculateTotalSaleValue($transactionArr, $portfolioCommission, $format = 1)
    {
        App::uses('CakeTime', 'Utility');

        $ltp = $this->StockBangladesh->getLastTradePrice($transactionArr['lastTradeInfo']);

        $totalCommission = 0;
        $totalSaleValue = 0;
        foreach ($transactionArr['transactions'] as $trans) {
            $saleValue = $trans['amount'] * $ltp;
            $totalSaleValue += $saleValue;
            /*if ($trans['commission']) {
                $totalCommission += $saleValue * (($trans['commission']) / 100);
            } else {
                $totalCommission += $saleValue * (($portfolioCommission) / 100);
            }*/
            $totalCommission += $saleValue * (($trans['commission']) / 100);
        }
        $totalSaleValueExcludingCommission = $totalSaleValue - $totalCommission;
        if ($format) {
            return CakeNumber::format($totalSaleValueExcludingCommission, array(
                'places' => 2,
                'before' => '',
                'escape' => false,
                'decimals' => '.',
                'thousands' => ','
            ));
        } else {
            return $totalSaleValueExcludingCommission;
        }
    }

    public function calculateGrandTotalSaleValue($allHoldings, $portfolioCommission, $balance, $format = 1)
    {
        $saleArr = array();
        foreach ($allHoldings as $instrumentId => $trans) {
            $saleArr[$instrumentId] = $this->calculateTotalSaleValue($trans, $portfolioCommission, 0);
        }
        $totalSale = array_sum($saleArr) + $balance;

        if ($format) {
            return CakeNumber::format($totalSale, array(
                'places' => 2,
                'before' => '',
                'escape' => false,
                'decimals' => '.',
                'thousands' => ','
            ));
        } else {
            return $totalSale;
        }

    }

    public function calculateTotalPurchase($transactionArr, $portfolioCommission, $format = 1)
    {
        App::uses('CakeTime', 'Utility');

        $totalCommission = 0;
        $totalCost = 0;
        foreach ($transactionArr['transactions'] as $trans) {
            $cost = $trans['amount'] * $trans['rate'];
            $totalCost += $cost;
           /* if ($trans['commission']) {
                $totalCommission += $cost * (($trans['commission']) / 100);
            } else {
                $totalCommission += $cost * (($portfolioCommission) / 100);
            }*/
            $totalCommission += $cost * (($trans['commission']) / 100);
        }
        $totalCostWithCommission = $totalCost + $totalCommission;
        if ($format) {
            return CakeNumber::format($totalCostWithCommission, array(
                'places' => 2,
                'before' => '',
                'escape' => false,
                'decimals' => '.',
                'thousands' => ','
            ));
        } else {
            return $totalCostWithCommission;
        }
    }

    public function calculateGrandTotalPurchase($allHoldings, $portfolioCommission, $format = 1)
    {
        $purchaseArr = array();
        foreach ($allHoldings as $insId => $holding) {
            $purchaseArr[$insId] = $this->calculateTotalPurchase($holding, $portfolioCommission, 0);
        }

        $grandTotalPurchase = array_sum($purchaseArr);

        if ($format) {
            return CakeNumber::format($grandTotalPurchase, array(
                'places' => 2,
                'before' => '',
                'escape' => false,
                'decimals' => '.',
                'thousands' => ','
            ));
        } else {
            return $grandTotalPurchase;
        }
    }

    public function calculateGainLossSincePurchase($transactionArr, $portfolioCommission, $format = 1)
    {

        $totalPurchase = $this->calculateTotalPurchase($transactionArr, $portfolioCommission, 0);
        $totalSale = $this->calculateTotalSaleValue($transactionArr, $portfolioCommission, 0);

        $gainLoss = $totalSale - $totalPurchase;

        if ($format) {
            $formattedVal = CakeNumber::format($gainLoss, array(
                'places' => 2,
                'before' => '',
                'escape' => false,
                'decimals' => '.',
                'thousands' => ','
            ));

            if ($gainLoss < 0) {
                $htmlCode = "<p class='text-danger'>$formattedVal</p>";

            } else {
                $htmlCode = "<p class='text-success'>$formattedVal</p>";
            }
            return $htmlCode;
        } else {
            return $gainLoss;
        }


    }

    public function calculateChildGainLossSincePurchase($transactionArr, $portfolioCommission, $format = 1)
    {
        $totalPurchase = $this->calculateTotalPurchase($transactionArr, $portfolioCommission, 0);
        $totalSale = $this->calculateTotalSaleValue($transactionArr, $portfolioCommission, 0);

        $gainLoss = $totalSale - $totalPurchase;

        if ($format) {


            $formattedVal = CakeNumber::format($gainLoss, array(
                'places' => 2,
                'before' => '',
                'escape' => false,
                'decimals' => '.',
                'thousands' => ','
            ));

            if ($gainLoss < 0) {
                $htmlCode = "<p class='text-danger'>$formattedVal</p>";

            } else {
                $htmlCode = "<p class='text-success'>$formattedVal</p>";
            }
            return $htmlCode;
        } else {
            return $gainLoss;
        }
    }

    public function calculateTotalGainLossSincePurchase($allHoldings, $portfolioCommission, $format = 1)
    {
        $gainLossArr = array();
        foreach ($allHoldings as $instrumentId => $trans) {
            //$gainLossArr[$instrumentId] = ($this->StockBangladesh->getLastTradePrice($trans['lastTradeInfo']) - $trans['avgCost']) * $trans['totalQuantity'];
            $totalPurchase = $this->calculateTotalPurchase($trans, $portfolioCommission, 0);
            $saleValue = $this->calculateTotalSaleValue($trans, $portfolioCommission,0);
            $gainLossArr[$instrumentId] = ($saleValue-$totalPurchase);
        }
        $totalGainLoss = array_sum($gainLossArr);

        if ($format) {
            $formattedVal = CakeNumber::format($totalGainLoss, array(
                'places' => 2,
                'before' => '',
                'escape' => false,
                'decimals' => '.',
                'thousands' => ','
            ));

            if ($totalGainLoss < 0) {
                $htmlCode = "<p class='text-danger'>$formattedVal</p>";

            } else {
                $htmlCode = "<p class='text-success'>$formattedVal</p>";
            }
            return $htmlCode;
        } else {
            return $totalGainLoss;
        }

    }

    public function calculateChangeSincePurchase($allHoldings, $portfolioCommission, $balance)
    {
        $totalGainLoss = $this->calculateTotalGainLossSincePurchase($allHoldings, $portfolioCommission, 0);
        $totalPortfolio = $this->calculateGrandTotalPurchase($allHoldings, $portfolioCommission, 0) + $balance;
        $changePer = ($totalGainLoss / $totalPortfolio) * 100;

        $formattedVal = CakeNumber::toPercentage($changePer);

        if ($totalGainLoss < 0) {
            $htmlCode = "<p class='text-danger'>$formattedVal</p>";

        } else {
            $htmlCode = "<p class='text-success'>$formattedVal</p>";
        }
        return $htmlCode;

    }

    public function calculateTotalChangeSincePurchase($allHoldings)
    {
        $gainLossArr = array();
        foreach ($allHoldings as $instrumentId => $trans) {
            $gainLossArr[$instrumentId] = ($this->StockBangladesh->getLastTradePrice($trans['lastTradeInfo']) - $trans['avgCost']) * $trans['totalQuantity'];
        }
        $totalGainLoss = array_sum($gainLossArr);

        return CakeNumber::format($totalGainLoss, array(
            'places' => 2,
            'before' => '',
            'escape' => false,
            'decimals' => '.',
            'thousands' => ','
        ));

    }

    public function calculateGainLossChangeSincePurchase($transactionArr, $portfolioCommission)
    {

        $totalPurchased = $this->calculateTotalPurchase($transactionArr, $portfolioCommission, 0);
        $gainLoss = $this->calculateGainLossSincePurchase($transactionArr, $portfolioCommission, 0);

        $changePer = ($gainLoss / $totalPurchased) * 100;

        $formattedVal = CakeNumber::toPercentage($changePer);

        if ($changePer < 0) {
            $htmlCode = "<p class='text-danger'>$formattedVal</p>";

        } else {
            $htmlCode = "<p class='text-success'>$formattedVal</p>";
        }
        return $htmlCode;


    }

    public function calculateChildGainLossChangeSincePurchase($transactionArr, $portfolioCommission)
    {

        /*   $change = $lastTradePrice - $transactionArr['rate'];
           $gainLoss = $change * $transactionArr['amount'];
           $totalPurchased = $transactionArr['amount'] * $transactionArr['rate'];*/

        $gainLoss = $this->calculateChildGainLossSincePurchase($transactionArr, $portfolioCommission, 0);
        $totalPurchased = $this->calculateTotalPurchase($transactionArr, $portfolioCommission, 0);

        $changePer = ($gainLoss / $totalPurchased) * 100;

        $formattedVal = CakeNumber::toPercentage($changePer);

        if ($changePer < 0) {
            $htmlCode = "<p class='text-danger'>$formattedVal</p>";

        } else {
            $htmlCode = "<p class='text-success'>$formattedVal</p>";
        }
        return $htmlCode;


    }

    /*
     * istrumentId=0 will return portfolio per for balance
     * */
    public function calculatePortfolioPer($allHoldings, $balance, $portfolioCommission, $instrumentId = 0)
    {
        $purchaseArr = array();
        foreach ($allHoldings as $insId => $holding) {
            //$purchaseArr[$insId] = $this->calculateTotalPurchase($holding, $portfolioCommission, 0);
            $salesArr[$insId] = $this->calculateTotalSaleValue($holding, $portfolioCommission, 0);
        }
        $totalPortfolioSize = array_sum($purchaseArr) + $balance;

        $totalPortfolioSize = $this->calculateGrandTotalSaleValue($allHoldings, $portfolioCommission, $balance, 0);

        if ($instrumentId) {

            $totalPortfolioPer = ($salesArr[$instrumentId] / $totalPortfolioSize) * 100;
            return CakeNumber::toPercentage($totalPortfolioPer);
        } else {
            $totalPortfolioPer = ($balance / $totalPortfolioSize) * 100;
            return CakeNumber::toPercentage($totalPortfolioPer);
        }
    }

    public function getCss($value)
    {
        if ($value < 0) {
            $htmlCode = "<p class='text-danger'>$value</p>";

        } else {
            $htmlCode = "<p class='text-success'>$value</p>";
        }
        return $htmlCode;
    }

    public function generateChildRowArr($allHoldings, $portfolioCommission, $balance, $instrumentInfo)
    {
        App::uses('CakeTime', 'Utility');

        $returnArr = array();
        foreach ($allHoldings as $instrumentId => $holding) {
            if (count($holding['transactions']) > 1) {
                $code = $instrumentInfo[$instrumentId]['Instrument']['instrument_code'];
                $sOut = '<table class="table table-striped table-condensed table-advance table-hover">';
                $sOut .= '<tr class="warning">' .
                    "<td>$code</td>" .
                    '<td>Gain/Loss</td>' .
                    '<td>Share</td>' .
                    '<td>Buy Price</td>' .
                    '<td>Purchase Date</td>' .
                    '<td>Buy Commission</td>' .
                    '<td>Total Purchase</td>' .
                    '<td> 	Gain/Loss </td>' .
                    '<td>%Change</td>' .
                    '<td>Sell Value</td>' .
                    '</tr>';
                foreach ($holding['transactions'] as $trans) {


                    $todayGain = $this->calculateChildRowTodayGainLoss($trans, $this->StockBangladesh->getPriceChange($holding['lastTradeInfo']));
                    $share = $trans['amount'];
                    $buyPrice = $trans['rate'];

                    $buyPrice = CakeNumber::format($buyPrice, array(
                        'places' => 2,
                        'before' => 'Tk ',
                        'escape' => false,
                        'decimals' => '.',
                        'thousands' => ','
                    ));
                    $pdate = $trans['transaction_time'];
                    $pdate = CakeTime::format($pdate, '%d/%m/%Y');

                    $scripArr = array();
                    $scripArr['transactions'][] = $trans;
                    $scripArr['lastTradeInfo'] = $holding['lastTradeInfo'];
                    $scripArr['totalQuantity'] = $holding['totalQuantity'];
                    $scripArr['avgCost'] = $holding['avgCost'];

                    $lastTradePrice = $this->StockBangladesh->getLastTradePrice($holding['lastTradeInfo']);
                    $comission = $this->calculateCommission($scripArr, $portfolioCommission);
                    $totalPurchase = $this->calculateTotalPurchase($scripArr, $portfolioCommission);
                    $gainLossSincePurchase = $this->calculateChildGainLossSincePurchase($scripArr, $portfolioCommission);
                    $gainLossChangeSincePurchase = $this->calculateChildGainLossChangeSincePurchase($scripArr, $portfolioCommission);
                    $salevalue = $this->calculateTotalSaleValue($scripArr, $portfolioCommission); //
                    $sOut .= '<tr>' .
                        "<td class='highlight'><div class='warning'></div><i class='fa fa-long-arrow-right'></i>$share @ $buyPrice <span class='icon-calendar'></span> $pdate</td>" .
                        "<td>$todayGain</td>" .
                        "<td>$share</td>" .
                        "<td>$buyPrice</td>" .
                        "<td>$pdate</td>" .
                        "<td>$comission</td>" .
                        "<td>$totalPurchase</td>" .
                        "<td>$gainLossSincePurchase</td>" .
                        "<td>$gainLossChangeSincePurchase</td>" .
                        "<td>$salevalue</td>" .
                        '</tr>';
                }
                $sOut .= '</table>';

                $returnArr[$code] = $sOut;
            }
        }
        $ret = json_encode($returnArr);
        // pr($returnArr);
        // exit;
        return $ret;
    }

    //pr($transactionArr);
    //exit;


}