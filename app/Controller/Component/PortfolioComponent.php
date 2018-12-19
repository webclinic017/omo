<?php
App::uses('Component', 'Controller');
class PortfolioComponent extends Component
{
    public $components = array('StockBangladesh','Auth');
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

    public function addTransaction()
    {
        App::uses('PortfolioTransaction', 'Model');
        $PortfolioTransaction = new PortfolioTransaction();


    }

    public function getAllTransactions($portfolio_id=0)
    {
        App::uses('Portfolio', 'Model');
        $Portfolio = new Portfolio();

        if(!$portfolio_id)
            $loggeInUser=$this->Auth->user();

        if(isset($loggeInUser)) {

            $portfolio_id = $loggeInUser['portfolio_id'];
        }

        $Portfolio->contain('PortfolioTransaction');
        $allTransactions = $Portfolio->find('all',array(
                'conditions' => "Portfolio.id=$portfolio_id"
            )

        );

        return $allTransactions;
    }



    public function getUsedBalance($allOrdersInfo = array(), $broker_fee = 0, $uid = 0)
    {
        //Configure::write('debug', 2);
        if (empty($allOrdersInfo)) {
            App::uses('CakeTime', 'Utility');
            $tradeDateCondition = CakeTime::dayAsSql(date('d-m-Y'), 'Order.created');
            $uid = $this->Auth->user('id');


            App::uses('Order', 'Model');
            $Order = new Order();

            $allOrdersInfo = $Order->find('all', array(
                'conditions' => "Order.user_id=$uid and $tradeDateCondition",
                'recursive' => -1

            ));
        }

        $orderArr = array();
        foreach ($allOrdersInfo as $row) {
            $temp = $row['Order'];
            $orderStatus = trim($temp['order_status']);
            $orderArr[$orderStatus][] = $temp;

        }



        if (empty($orderArr['pending'])) {
            $orderArr['pending'] = array();
        }
        if (empty($orderArr['locked'])) {
            $orderArr['locked'] = array();
        }
        if (empty($orderArr['executed'])) {
            $orderArr['executed'] = array();
        }
        if (empty($orderArr['cancel'])) {
            $orderArr['cancel'] = array();
        }


        // Calculating Balance that a trader will pay for his buy order

        $balanceUsed = 0;
        $buyOrder = Hash::extract($orderArr['pending'], "{n}[order_type=1]");  //get all buy order
        foreach ($buyOrder as $border) {
            $money = $border['amount'] * $border['rate'];
            $totalCommission = (($broker_fee) / 100) * $money;
            $balanceUsed += $money + $totalCommission;
        }

        $buyOrder = Hash::extract($orderArr['executed'], "{n}[order_type=1]");  //get all buy order
        foreach ($buyOrder as $border) {
            $money = $border['amount'] * $border['rate'];
            $totalCommission = (($broker_fee) / 100) * $money;
            $balanceUsed += $money + $totalCommission;
        }

        $buyOrder = Hash::extract($orderArr['locked'], "{n}[order_type=1]");  //get all buy order
        foreach ($buyOrder as $border) {
            $money = $border['amount'] * $border['rate'];
            $totalCommission = (($broker_fee) / 100) * $money;
            $balanceUsed += $money + $totalCommission;
        }

        $buyOrder = Hash::extract($orderArr['cancel'], "{n}[order_type=1]");  //get all buy order
        foreach ($buyOrder as $border) {
            $money = $border['amount'] * $border['rate'];
            $totalCommission = (($broker_fee) / 100) * $money;
            $balanceUsed += $money + $totalCommission;
        }



        //Calculating Sold balance. Balance that a trader will get for selling his share


        $soldBalanceToAdd = 0;

        $buyOrder = Hash::extract($orderArr['executed'], "{n}[order_type=2]");  //get all sell order
        foreach ($buyOrder as $border) {
            $money = $border['amount'] * $border['rate'];
            $totalCommission = (($broker_fee) / 100) * $money;
            $soldBalanceToAdd += $money - $totalCommission;
        }


        // Total used amount for today order ( after adding purchase power for his executed sell order + deducting buy order )
        $remainingBalance=$balanceUsed-$soldBalanceToAdd;

        $remainingBalance = number_format($remainingBalance, 2, '.', '');
        return $remainingBalance; // this is the amount that he has used already. If it negative it will be added with his purchase power
    }


    public function getPortfolioBalanceNew($allTransactions, $ttypeArr = array(),$balance=0)
    {
        //Configure::write('debug', 2);
//pr($this->getPortfolioHoldings($allTransactions,$ttypeArr));

        $broker_fee = $allTransactions[0]['Portfolio']['broker_fee'];
        $allOrdersInfo=array();  // all order will be fetched from component

        /*$balanceUsed=$this->getUsedBalance($allOrdersInfo,$broker_fee);
        $balance = $allTransactions[0]['Portfolio']['balance']-$balanceUsed;
        */
        $balance = $allTransactions[0]['Portfolio']['balance'];

        $balance=number_format($balance, 2, '.', '');
        return $balance;
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


    public function getPortfolioBalance($allTransactions, $ttypeArr = array(),$balance=0)
    {
        // Configure::write('debug', 2);
//pr($this->getPortfolioHoldings($allTransactions,$ttypeArr));
        $this->commission = $allTransactions[0]['Portfolio']['broker_fee'];

        if (!empty($ttypeArr)) {
            $this->ttypeArr = $ttypeArr;
        } else {
            $this->ttypeArr = $this->getTransactionType();
        }

        $this->parentIdWiseTransaction = Hash::combine($allTransactions[0], 'PortfolioTransaction.{n}.id', 'PortfolioTransaction.{n}', 'PortfolioTransaction.{n}.parent_id');


        $transactionAmountArr=array();
        $transactionAmountArr2=array();
        foreach($allTransactions[0]['PortfolioTransaction'] as $arr)
        {
            if (isset($this->parentIdWiseTransaction[$arr['id']])) {
                $actionListOnTransaction = Hash::sort($this->parentIdWiseTransaction[$arr['id']], '{n}.id', 'asc');
                //  pr($actionListOnTransaction);

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
                $totalCommission = 0; // if it is not buy or sell transaction no commission will be applied
            }
            //   pr($arr);
            //$totalCommission=0;
            $transactionAmountArr2[]=($this->ttypeArr[$arr['transaction_type_id']] * $arr['amount'] * $arr['rate']) - $totalCommission;
        }

        // pr($transactionAmountArr2);
        //  exit;
        $balance = array_sum($transactionAmountArr2);
//        pr($transactionAmountArr);
        //pr($allTransactions[0]);
        //  pr($balance);
        // exit;
        $balance=number_format($balance, 2, '.', '');
        return $balance;
    }

    /*
     * additionally it returns  dividendQty and receiveableDividendQuantity
     * */

    public function getPortfolioHoldings($allTransactions, $ttypeArr = array())
    {
        // Configure::write('debug', 2);

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

        //  pr("==========================transaction_type_id array=================");
        //      pr($this->ttypeArr);
        //  pr("==========================before instrumentWiseTransaction array=================");
        //  pr($instrumentWiseTransaction);
//exit;
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

        $lastTwoMarketInfoArr = $this->StockBangladesh->getMarketInfo(0, 0);
        $marketId = $lastTwoMarketInfoArr[0]['Market']['id'];

        $holdingDetails = array();
        App::uses('CakeTime', 'Utility');
        foreach ($instrumentWiseTransaction as $instrumentId => $transactionArr) {
            if (!$instrumentId)
                continue;

            $buyTransactionOnly = Hash::extract($transactionArr, '{n}[transaction_type_id=1]'); // extracting buy transaction only

            $instrumentHoldingDetails = Hash::extract($buyTransactionOnly, '{n}[amount>0]'); // extracting buy transaction only

            $dividendQuantity = 0;
            $receiveableDividendQuantity = 0;
            $totalQuantity = 0;
            $totalCost = 0;
            $saleableShare=0;
            foreach ($instrumentHoldingDetails as $row) {
                $totalQuantity += $row['amount'];
                $totalCost += $row['amount'] * $row['rate'];
                $transaction_time=$row['transaction_time'];

                if($row['rate']==0)
                {
                    $dividendQuantity+=$row['amount'];
                }
                if(CakeTime::isFuture($transaction_time))
                {
                    $receiveableDividendQuantity+=$row['amount'];
                }

            }

            if (!empty($instrumentHoldingDetails)) {
                $holdingDetails[$instrumentId]['transactions'] = $instrumentHoldingDetails;
                $holdingDetails[$instrumentId]['totalQuantity'] = $totalQuantity;
                $holdingDetails[$instrumentId]['dividendQuantity'] = $dividendQuantity;
                $holdingDetails[$instrumentId]['receiveableDividendQuantity'] = $receiveableDividendQuantity;
                $holdingDetails[$instrumentId]['avgCost'] = $totalCost / $totalQuantity;

                // $lastTradeInfo = $this->StockBangladesh->getLastTradeInfo($marketId, $instrumentId);
                $lastTradeInfo = $this->StockBangladesh->getAllInsLtp($marketId, $instrumentId);
                $holdingDetails[$instrumentId]['lastTradeInfo'] = $lastTradeInfo[0];


                /* here we are extracting category fromquote bases ex. 'A-EQ'  to reduce further database query*/
                $tradeData=$lastTradeInfo[0];
                $quote_bases=$tradeData['quote_bases'];
                $categoryArr=explode('-',$quote_bases);
                $category=trim($categoryArr[0]);
                $saleAbleShares=$this->calculateSaleableShares($instrumentHoldingDetails,$category);
                $holdingDetails[$instrumentId]['saleAbleShares'] = $saleAbleShares;
            }

        }


        //pr($holdingDetails);
        //   exit;
        return $holdingDetails;

    }

    public function getUsedSaleAbleQuantity($allOrdersInfo = array(), $uid = 0)
    {
        if (empty($allOrdersInfo)) {
            App::uses('CakeTime', 'Utility');
            $tradeDateCondition = CakeTime::dayAsSql(date('d-m-Y'), 'Order.created');

            if(!$uid) {
                $uid = $this->Auth->user('id');
            }


            App::uses('Order', 'Model');
            $Order = new Order();

            $allOrdersInfo = $Order->find('all', array(
                'conditions' => "Order.user_id=$uid and $tradeDateCondition",
                'recursive' => -1

            ));
        }
        $orderArr = array();
        foreach ($allOrdersInfo as $row) {
            $temp = $row['Order'];
            $orderStatus = trim($temp['order_status']);
            $orderArr[$orderStatus][] = $temp;

        }

        if (empty($orderArr['pending'])) {
            $orderArr['pending'] = array();
        }
        if (empty($orderArr['locked'])) {
            $orderArr['locked'] = array();
        }
        if (empty($orderArr['executed'])) {
            $orderArr['executed'] = array();
        }
        if (empty($orderArr['cancel'])) {
            $orderArr['cancel'] = array();
        }

        $usedSaleAbleQty = array();
        $sellOrder = Hash::extract($orderArr['pending'], "{n}[order_type=2]");  //get all sell order
        foreach ($sellOrder as $sorder) {
            $instrument_id = $sorder['instrument_id'];
            if (!isset($usedSaleAbleQty[$instrument_id])) {
                $usedSaleAbleQty[$instrument_id] = 0;
            }
            $usedSaleAbleQty[$instrument_id] += $sorder['amount'];
        }

        $sellOrder = Hash::extract($orderArr['locked'], "{n}[order_type=2]");  //get all sell order
        foreach ($sellOrder as $sorder) {
            $instrument_id = $sorder['instrument_id'];
            if (!isset($usedSaleAbleQty[$instrument_id])) {
                $usedSaleAbleQty[$instrument_id] = 0;
            }
            $usedSaleAbleQty[$instrument_id] += $sorder['amount'];
        }

        $sellOrder = Hash::extract($orderArr['cancel'], "{n}[order_type=2]");  //get all sell order
        foreach ($sellOrder as $sorder) {
            $instrument_id = $sorder['instrument_id'];
            if (!isset($usedSaleAbleQty[$instrument_id])) {
                $usedSaleAbleQty[$instrument_id] = 0;
            }
            $usedSaleAbleQty[$instrument_id] += $sorder['amount'];
        }

        return $usedSaleAbleQty;
    }

    function calculateSaleableShares($transactions, $category = 'A', $allOrdersInfo = array())
    {


        $instrumentList=$this->StockBangladesh->instrumentInfo();
        $instrumentList = Hash::combine($instrumentList, '{n}.Instrument.id', '{n}.Instrument.is_spot');

        $category_Z_mutured_day = 8;
        $category_Others_mutured_day = 1;


        $tradeDate = date('Y-m-d');


        $exchangeId = Configure::read('EXCHANGE_ID');
        App::uses('Market', 'Model');
        $Market = new Market();




        $saleableShares = 0;
        $instrument_id = 0;
        foreach ($transactions as $eachTransaction) {
            $amount = $eachTransaction['amount'];
            $transaction_time = $eachTransaction['transaction_time'];
            $instrument_id = $eachTransaction['instrument_id'];
            $isSpot=$instrumentList[$instrument_id];
            $isLocked=$eachTransaction['is_lock'];
            $transaction_type_id=$eachTransaction['transaction_type_id'];

            $marketData = $Market->find('all', array(
                'conditions' => "Market.trade_date<='$tradeDate' and Market.trade_date>'$transaction_time' and Market.exchange_id=$exchangeId and Market.is_trading_day=1",
                'recursive' => -1
            ));
            $tradeDatePassed = count($marketData);

            if ($isLocked) { // if it is locked do nothing

            } else {

                if ($isSpot) {
                    if ($tradeDatePassed>0) {  // checking if it is not same date of buying date. share should not be mature at same date
                        $saleableShares += $amount;
                    }
                } else {

                    if($transaction_type_id==4||$transaction_type_id==14) // if it is bonus /right/IPO share
                    {
                        $saleableShares += $amount;  // immediately matured.
                    }
                    else // normally bought share
                    {
                        if ($category == 'Z') {
                            if ($tradeDatePassed > $category_Z_mutured_day) {
                                $saleableShares += $amount;
                            }

                        } else {
                            if ($tradeDatePassed > $category_Others_mutured_day) {
                                $saleableShares += $amount;
                            }
                        }

                    }


                }

            }




        }



        return $saleableShares;
    }

    /*
     * We are using this function in omo portfolio
     * */
    function getPortfolioHoldings2($allTransactions, $ttypeArr = array(),$instrumentList=array())
    {
        //  Configure::write('debug', 2);
        App::uses('CakeTime', 'Utility');

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

            if ($qunatity>0) {

                /*$transactionArr = $instrumentWiseTransaction[$instrumentId];
                $transactionArr = Hash::extract($transactionArr, '{n}[transaction_type_id=1]'); // extracting buy transaction only
                // reversing to sort by transaction time desc (latest)) to keep last bought share unsold
                $transactionArr = array_reverse($transactionArr, true);*/


                $transactionArr=array();
                foreach($instrumentWiseTransaction[$instrumentId] as $transaction)
                {
                    if($transaction['transaction_type_id']==1 || $transaction['transaction_type_id']==4 || $transaction['transaction_type_id']==14) // buy or bonus/right or IPO
                    {
                        $transactionArr[strtotime($transaction['transaction_time'])][]=$transaction;  //keeping transaction time as key. So it will help us to sort the array
                    }
                }

                ksort($transactionArr); // it will sort  transaction time asc
                // reversing to sort by transaction time desc (latest)) to keep last bought share unsold
                $transactionArr=array_reverse($transactionArr, true);
                $transactionArr = Hash::combine($transactionArr, '{n}.{n}.id', '{n}.{n}');  // making it one dimensional array




                $totalCost = 0;
                $dividendQuantity=0;
                $receiveableDividendQuantity=0;
                $saleAbleShares=0;

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


                    $transaction_time=$row['transaction_time'];

                    if($row['rate']==0)
                    {
                        $dividendQuantity+=$row['amount'];
                    }
                    if(CakeTime::isFuture($transaction_time))
                    {
                        $receiveableDividendQuantity+=$row['amount'];
                    }


                    if (!$qunatity) {
                        break;
                    }
                }



                $lastTwoMarketInfoArr = $this->StockBangladesh->getMarketInfo(0, 0);
                $marketId = $lastTwoMarketInfoArr[0]['Market']['id'];

                $lastTradeInfo = $this->StockBangladesh->getAllInsLtp($marketId, $instrumentId);

                $holdingDetails[$instrumentId]['totalQuantity'] = $totalQuantity;
                $holdingDetails[$instrumentId]['avgCost'] = $totalCost / $totalQuantity;
                $holdingDetails[$instrumentId]['totalCost'] = $totalCost;
                $holdingDetails[$instrumentId]['lastTradeInfo'] = $lastTradeInfo[0];
                $holdingDetails[$instrumentId]['dividendQuantity'] = $dividendQuantity;
                $holdingDetails[$instrumentId]['receiveableDividendQuantity'] = $receiveableDividendQuantity;



                /* here we are extracting category fromquote bases ex. 'A-EQ'  to reduce further database query*/
                $tradeData=$lastTradeInfo[0];
                $quote_bases=$tradeData['quote_bases'];
                $categoryArr=explode('-',$quote_bases);
                $category=trim($categoryArr[0]);


                $saleAbleShares=$this->calculateSaleableShares($holdingDetails[$instrumentId]['transactions'],$category);

                $holdingDetails[$instrumentId]['saleAbleShares'] = $saleAbleShares;

                if(isset($instrumentList[$instrumentId])) {
                    $code = $instrumentList[$instrumentId];

                    $holdingDetails[$instrumentId]['instrument_code'] = $code;
                }



            }

        }

        return $holdingDetails;
    }


    /*
   * We are using this function in share edit
   * */
    function getPortfolioHoldingsWithId($allTransactions, $ttypeArr = array(),$instrumentList=array())
    {
        //Configure::write('debug', 2);
        App::uses('CakeTime', 'Utility');

        $holdings = array();
        if (!empty($ttypeArr)) {
            $this->ttypeArr = $ttypeArr;
        } else {
            $this->ttypeArr = $this->getTransactionType();
        }
        $instrumentWiseTransaction = Hash::combine($allTransactions[0], 'PortfolioTransaction.{n}.id', 'PortfolioTransaction.{n}', 'PortfolioTransaction.{n}.instrument_id');

     //   pr("====================instrumentWiseTransaction====================");
    //    pr($instrumentWiseTransaction);

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
        pr("====================holdings====================");
        pr($holdings);
        foreach ($holdings as $instrumentId => $qunatity) {
            $totalQuantity = $qunatity;

            if ($qunatity) {

                $transactionArr=array();
                foreach($instrumentWiseTransaction[$instrumentId] as $transaction)
                {
                    if($transaction['transaction_type_id']==1 || $transaction['transaction_type_id']==4 || $transaction['transaction_type_id']==14) // buy or bonus/right or IPO
                    {
                        $transactionArr[strtotime($transaction['transaction_time'])][]=$transaction;  //keeping transaction time as key. So it will help us to sort the array
                    }
                }

                ksort($transactionArr); // it will sort  transaction time asc
                // reversing to sort by transaction time desc (latest)) to keep last bought share unsold
                $transactionArr=array_reverse($transactionArr, true);
                $transactionArr = Hash::combine($transactionArr, '{n}.{n}.id', '{n}.{n}');  // making it one dimensional array

//pr($transactionArr);
//                exit;

                $totalCost = 0;
                $dividendQuantity=0;
                $receiveableDividendQuantity=0;
                $saleAbleShares=0;

                pr("Total quantity==".$qunatity);

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


                    $transaction_time=$row['transaction_time'];

                    if($row['rate']==0)
                    {
                        $dividendQuantity+=$row['amount'];
                    }
                    if(CakeTime::isFuture($transaction_time))
                    {
                        $receiveableDividendQuantity+=$row['amount'];
                    }


                    if (!$qunatity) {
                        break;
                    }
                }



                $lastTwoMarketInfoArr = $this->StockBangladesh->getMarketInfo(0, 0);
                $marketId = $lastTwoMarketInfoArr[0]['Market']['id'];

                $lastTradeInfo = $this->StockBangladesh->getAllInsLtp($marketId, $instrumentId);

                $holdingDetails[$instrumentId]['totalQuantity'] = $totalQuantity;
                $holdingDetails[$instrumentId]['avgCost'] = $totalCost / $totalQuantity;
                $holdingDetails[$instrumentId]['totalCost'] = $totalCost;
                $holdingDetails[$instrumentId]['lastTradeInfo'] = $lastTradeInfo[0];
                $holdingDetails[$instrumentId]['dividendQuantity'] = $dividendQuantity;
                $holdingDetails[$instrumentId]['receiveableDividendQuantity'] = $receiveableDividendQuantity;



                /* here we are extracting category fromquote bases ex. 'A-EQ'  to reduce further database query*/
                $tradeData=$lastTradeInfo[0];
                $quote_bases=$tradeData['quote_bases'];
                $categoryArr=explode('-',$quote_bases);
                $category=trim($categoryArr[0]);



                $saleAbleShares=$this->calculateSaleableShares($holdingDetails[$instrumentId]['transactions'],$category);

                $holdingDetails[$instrumentId]['saleAbleShares'] = $saleAbleShares;

                if(isset($instrumentList[$instrumentId])) {
                    $code = $instrumentList[$instrumentId];

                    $holdingDetails[$instrumentId]['instrument_code'] = $code;
                }



            }

        }

        pr($holdingDetails);


        return $holdingDetails;
    }

    public function sellValidate($portfolioHoldingsTransaction, $postArr)
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
