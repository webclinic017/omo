<?php
App::uses('Component', 'Controller');
class PortfolioComponent extends Component
{
    public $components = array('StockBangladesh');
    public $ttypeArr = array();
    public $commission = 0;
    public $parentIdWiseTransaction = array();

    /*
     *
     * */
    public function getTransactionType()
    {
        App::uses('TransactionType', 'Model');
        $TransactionType = new TransactionType();

        $ttype = $TransactionType->find('all', array(

            'recursive' => -1
        ));

        return Hash::combine($ttype, '{n}.TransactionType.id', '{n}.TransactionType.multiplier');
    }

    public function getPortfolioBalance2($allTransactions, $ttypeArr = array())
    {

        $this->commission = $allTransactions[0]['Portfolio']['broker_fee'];

        if (!empty($ttypeArr)) {
            $this->ttypeArr = $ttypeArr;
        } else {
            $this->ttypeArr = $this->getTransactionType();
        }

        $transactionAmountArr = Hash::map($allTransactions[0], 'PortfolioTransaction.{n}', function ($arr) {

            if ($arr['commission'])
                $this->commission = $arr['commission'];
            $totalCommission = (($this->commission) / 100) * $arr['amount'] * $arr['rate'];

            if ($arr['transaction_type_id'] > 2) {
                $totalCommission = 0; // if it is not buy or sell transaction no commision will be applied
            }
            //$totalCommission=0;
            return ($this->ttypeArr[$arr['transaction_type_id']] * $arr['amount'] * $arr['rate']) - $totalCommission;
        });

        $balance = array_sum($transactionAmountArr);
//        pr($transactionAmountArr);
//        pr($allTransactions);
        //  pr($balance);
//        exit;
        return $balance;
    }


    public function getPortfolioBalance($allTransactions, $ttypeArr = array())
    {
//pr($this->getPortfolioHoldings($allTransactions,$ttypeArr));
        $this->commission = $allTransactions[0]['Portfolio']['broker_fee'];

        if (!empty($ttypeArr)) {
            $this->ttypeArr = $ttypeArr;
        } else {
            $this->ttypeArr = $this->getTransactionType();
        }

        $this->parentIdWiseTransaction = Hash::combine($allTransactions[0], 'PortfolioTransaction.{n}.id', 'PortfolioTransaction.{n}', 'PortfolioTransaction.{n}.parent_id');

        $transactionAmountArr=array();
        foreach($allTransactions[0]['PortfolioTransaction'] as $arr)
        {
            if (isset($this->parentIdWiseTransaction[$arr['id']])) {
                $actionListOnTransaction = Hash::sort($this->parentIdWiseTransaction[$arr['id']], '{n}.id', 'asc');
                // pr($actionListOnTransaction);

                foreach ($actionListOnTransaction as $row) {

                    if (isset($row['commission'])) {
                        $this->commission=$row['commission'];
                        //pr($this->commission);
                    }
                }

            }


            //$this->commission = $arr['commission'];
            $totalCommission = (($this->commission) / 100) * $arr['amount'] * $arr['rate'];

            if ($arr['transaction_type_id'] > 2) {
                $totalCommission = 0; // if it is not buy or sell transaction no commision will be applied
            }
            //$totalCommission=0;
            $transactionAmountArr2[]=($this->ttypeArr[$arr['transaction_type_id']] * $arr['amount'] * $arr['rate']) - $totalCommission;
        }

        // pr($transactionAmountArr2);
        //  exit;
        $balance = array_sum($transactionAmountArr);
//        pr($transactionAmountArr);
        //pr($allTransactions[0]);
        //  pr($balance);
        //exit;
        return $balance;
    }

    public function getPortfolioHoldings($allTransactions, $ttypeArr = array())
    {


        $holdings = array();
        if (!empty($ttypeArr)) {
            $this->ttypeArr = $ttypeArr;
        } else {
            $this->ttypeArr = $this->getTransactionType();
        }

        //groupBy instrumentId
        $instrumentWiseTransaction = Hash::combine($allTransactions[0], 'PortfolioTransaction.{n}.id', 'PortfolioTransaction.{n}', 'PortfolioTransaction.{n}.instrument_id');

        // groupBy parent_id
        $parentIdWiseTransaction = Hash::combine($allTransactions[0], 'PortfolioTransaction.{n}.id', 'PortfolioTransaction.{n}', 'PortfolioTransaction.{n}.parent_id');

        // pr("==========================transaction_type_id array=================");
        //  pr($this->ttypeArr);
        //  pr("==========================before instrumentWiseTransaction array=================");
        //  pr($instrumentWiseTransaction);

        foreach ($instrumentWiseTransaction as $instrumentId => $transactionArr) {
            if ($instrumentId) {

                foreach ($transactionArr as $transactionId => $eachTransaction) {
                    if (isset($parentIdWiseTransaction[$transactionId])) {

                        // Sort by id so that we can apply the impact of action (sell,edit)  to each transaction FIFO basis
                        $parentIdWiseTransaction[$transactionId] = Hash::sort($parentIdWiseTransaction[$transactionId], '{n}.id', 'asc');

                        foreach ($parentIdWiseTransaction[$transactionId] as $row) {

                            if ($row['transaction_type_id'] == 2) // If transaction type was SELL
                            {
                                $adjustmentQantity = -1 * $this->ttypeArr[$row['transaction_type_id']] * $row['amount']; // in case of volume calculation multiplier will be reversed of buy sell

                                $instrumentWiseTransaction[$instrumentId][$transactionId]['amount'] += $adjustmentQantity;

                                // if volume is 0 remove it from main array
                                if (!$instrumentWiseTransaction[$instrumentId][$transactionId]['amount']) {
                                    unset($instrumentWiseTransaction[$instrumentId][$transactionId]);

                                }
                            }

                            if ($row['transaction_type_id'] == 8) // If transaction type was EDIT
                            {
                                // we will reset main Array ($instrumentWiseTransaction) with edited array
                                $instrumentWiseTransaction[$instrumentId][$transactionId]['amount'] = $row['amount'];
                                $instrumentWiseTransaction[$instrumentId][$transactionId]['rate'] = $row['rate'];
                                $instrumentWiseTransaction[$instrumentId][$transactionId]['transaction_time'] = $row['transaction_time'];
                                $instrumentWiseTransaction[$instrumentId][$transactionId]['commission'] = $row['commission'];
                            }

                            if ($row['transaction_type_id'] == 9) // If transaction type was DELETE
                            {
                                // we will reset current element of main Array ($instrumentWiseTransaction) with edited array
                                //pr($instrumentWiseTransaction);
                                unset($instrumentWiseTransaction[$instrumentId][$transactionId]);
                                //pr($instrumentWiseTransaction);
                                //exit;

                            }


                        }


                    }
                }


            }

        }

//pr($instrumentWiseTransaction);

        $lastTwoMarketInfoArr = $this->StockBangladesh->getMarketInfo('2014-07-13', 0);
        $marketId = $lastTwoMarketInfoArr[0]['Market']['id'];

        $holdingDetails = array();

        foreach ($instrumentWiseTransaction as $instrumentId => $transactionArr) {
            if (!$instrumentId)
                continue;

            $buyTransactionOnly = Hash::extract($transactionArr, '{n}[transaction_type_id=1]'); // extracting buy transaction only

            $instrumentHoldingDetails = Hash::extract($buyTransactionOnly, '{n}[amount>0]'); // extracting buy transaction only

            $totalQuantity = 0;
            $totalCost = 0;
            foreach ($instrumentHoldingDetails as $row) {
                $totalQuantity += $row['amount'];
                $totalCost += $row['amount'] * $row['rate'];

            }

            if (!empty($instrumentHoldingDetails)) {
                $holdingDetails[$instrumentId]['transactions'] = $instrumentHoldingDetails;
                $holdingDetails[$instrumentId]['totalQuantity'] = $totalQuantity;
                $holdingDetails[$instrumentId]['avgCost'] = $totalCost / $totalQuantity;

                $lastTradeInfo = $this->StockBangladesh->getLastTradeInfo($marketId, $instrumentId);
                $holdingDetails[$instrumentId]['lastTradeInfo'] = $lastTradeInfo[0];
            }

        }


        //pr($holdingDetails);
        //   exit;
        return $holdingDetails;

    }


    function getPortfolioHoldings2($allTransactions, $ttypeArr = array())
    {
        $holdings = array();
        if (!empty($ttypeArr)) {
            $this->ttypeArr = $ttypeArr;
        } else {
            $this->ttypeArr = $this->getTransactionType();
        }
        $instrumentWiseTransaction = Hash::combine($allTransactions[0], 'PortfolioTransaction.{n}.id', 'PortfolioTransaction.{n}', 'PortfolioTransaction.{n}.instrument_id');

        foreach ($instrumentWiseTransaction as $instrumentId => $transactionArr) {
            if ($instrumentId) {
                $temp = array();
                foreach ($transactionArr as $transactionId => $eachTransaction) {
                    $temp[] = -1 * $this->ttypeArr[$eachTransaction['transaction_type_id']] * $eachTransaction['amount']; // in case of volume calculation multiplier will be reversed of buy sell
                }
                $holdings[$instrumentId] = array_sum($temp);
            }
        }

        $holdingDetails = array();
        foreach ($holdings as $instrumentId => $qunatity) {
            $totalQuantity = $qunatity;
            if ($qunatity) {
                $transactionArr = $instrumentWiseTransaction[$instrumentId];
                $transactionArr = Hash::extract($transactionArr, '{n}[transaction_type_id=1]'); // extracting buy transaction only

                // reversing to sort by transaction time desc (latest)) to keep last bought share unsold
                $transactionArr = array_reverse($transactionArr, true);
                $totalCost = 0;
                foreach ($transactionArr as $row) {
                    //if amount is 0 skip it
                    if (!$row['amount'])
                        continue;
                    //if this transaction ($row) has more than/equal share of our needed quantity we are adjusting
                    // no of share (amount) to our needed quantity (as more than our needed quantity means old shares
                    // that has all ready sold).
                    // If this transaction has less than our needed quantity we are taking all and keeping it unchanged

                    $row['amount'] = $row['amount'] >= $qunatity ? $qunatity : $row['amount'];

                    // after managing our share from above calculation we are deducting it from our needed quantity
                    $qunatity = $qunatity - $row['amount'];

                    $holdingDetails[$instrumentId]['transactions'][] = $row;
                    $totalCost = $totalCost + $row['amount'] * $row['rate'];
                    if (!$qunatity) {
                        break;
                    }
                }


                $lastTwoMarketInfoArr = $this->StockBangladesh->getMarketInfo('2014-07-13', 0);
                $marketId = $lastTwoMarketInfoArr[0]['Market']['id'];

                $lastTradeInfo = $this->StockBangladesh->getLastTradeInfo($marketId, $instrumentId);


                $holdingDetails[$instrumentId]['totalQuantity'] = $totalQuantity;
                $holdingDetails[$instrumentId]['avgCost'] = $totalCost / $totalQuantity;
                $holdingDetails[$instrumentId]['lastTradeInfo'] = $lastTradeInfo[0];

            }

        }

        //pr($holdingDetails);
        //exit;
        return $holdingDetails;
    }

    public
    function sellValidate($portfolioHoldingsTransaction, $postArr)
    {
        App::uses('CakeTime', 'Utility');
        $error = false;
        $instrumentId = $postArr['instrument_id'];

        $sellDate = CakeTime::toUnix($postArr['transaction_time']);

        $sellableQuantity = 0;
        foreach ($portfolioHoldingsTransaction[$instrumentId]['transactions'] as $transaction) {
            $pdate = CakeTime::toUnix($transaction['transaction_time']);
            if ($pdate < $sellDate) {
                $sellableQuantity += $transaction['amount'];
            }

        }

        if ($postArr['amount'] > $sellableQuantity) {
            // $amount=$postArr['amount'];
            $nice = CakeTime::niceShort($sellDate);
            $error = "You have total $sellableQuantity shares matured to sell at $nice , not more than that.";
        }

        return $error;
        //if()
    }

}
