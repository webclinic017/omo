<?php
App::uses('Component', 'Controller');

class OmoComponent extends Component
{
    public $components = array('StockBangladesh', 'Auth');

    /*
     *
     * */
    public function getUsedBalance($allOrdersInfo = array(), $broker_fee = 0, $uid = 0,$broker_id=0)
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
        $allow_z_category_purchase_power = Configure::read('broker.allow_z_category_purchase_power');
        $allowed = $allow_z_category_purchase_power[$broker_id];


        if($allowed) {
            //// we need data from data_banks_intradays to get the category. because we will not allow z category share balance
            // code not to allow Z category balance -Start \\

            $lastTwoMarketInfoArr = $this->StockBangladesh->getMarketInfo(0, 0);
            $marketId = $lastTwoMarketInfoArr[0]['Market']['id'];
            $lastTradeInfo = $this->StockBangladesh->getAllInsLtp($marketId);
            // code not to allow Z category balance -End \\
        }

        $buyOrder = Hash::extract($orderArr['executed'], "{n}[order_type=2]");  //get all sell order
        foreach ($buyOrder as $border) {

            if ($allowed)
            {
                // code not to allow Z category balance -Start \\
            $instrument_id = $border['instrument_id'];
            $tradeData = $lastTradeInfo[$instrument_id];
            $tradeData=array_values($tradeData)[0];

            $quote_bases = $tradeData['quote_bases'];
            $categoryArr = explode('-', $quote_bases);
            $category = trim($categoryArr[0]);
            /*    echo "<pre>";
                print_r($tradeData);
                echo "$category $instrument_id";
                exit;*/

            if ($category == 'Z') {
                continue;
            }
            // code not to allow Z category balance -End \\
            }

            $money = $border['amount'] * $border['rate'];
            $totalCommission = (($broker_fee) / 100) * $money;
            $soldBalanceToAdd += $money - $totalCommission;
        }


        // Total used amount for today order ( after adding purchase power for his executed sell order + deducting buy order )
        $remainingBalance=$balanceUsed-$soldBalanceToAdd;

        $remainingBalance = number_format($remainingBalance, 2, '.', '');
        return $remainingBalance; // this is the amount that he has used already. If it negative it will be added with his purchase power
    }
    public function getUsedBalance_prev($allOrdersInfo = array(), $broker_fee = 0, $uid = 0)
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
      //  pr($allOrdersInfo);
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

        $balanceUsed = 0;
        $buyOrder = Hash::extract($orderArr['pending'], "{n}[order_type=1]");  //get all buy order
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
        $balanceUsed = number_format($balanceUsed, 2, '.', '');
        return $balanceUsed;
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

    /*
     * $returnType=1 will return with group by broker_id and user_id as key of sub array
     * $returnType=2 will return without any group and user_id as key
     * $returnType=3 will return without any group and portfolio_id as key
     * $returnType=4 will return with group by broker_id and internal_ref_no as key of sub array
     *
     * */
  /* function getUsersList($returnType = 1, $allUser = 0)
    {
        //Configure::write('debug', 2);
        App::uses('User', 'Model');
        $User = new User();

        if ($allUser) {
            $con = "1=1";
        } else {
            $con = "User.active=1";
        }


        $userData = $User->find('all', array(
            'conditions' => $con,
            'fields' => array('User.id','User.username', 'User.broker_id', 'User.portfolio_id', 'User.internal_ref_no', 'User.broker_fee', 'User.balance', 'User.email'),
            'recursive' => -1
        ));

        if ($returnType == 1)
            $userData = Hash::combine($userData, '{n}.User.id', '{n}.User', '{n}.User.broker_id');
        if ($returnType == 2)
            $userData = Hash::combine($userData, '{n}.User.id', '{n}.User');
        if ($returnType == 3)
            $userData = Hash::combine($userData, '{n}.User.portfolio_id', '{n}.User');
        if ($returnType == 4)
            $userData = Hash::combine($userData, '{n}.User.internal_ref_no', '{n}.User', '{n}.User.broker_id');
        //pr($userData);
        //exit;
        return $userData;
    }*/



    function getUsersList($returnType = 1, $allUser = 0,$brokerHouse='')
    {
     //   Configure::write('debug', 2);
        App::uses('User', 'Model');
        $User = new User();
        $con='';
        if ($allUser && empty($brokerHouse)) {
            $con = "1=1";
        } elseif($allUser && !empty($brokerHouse)) {
            $con = "User.broker_id=".$brokerHouse;
        }elseif(!$allUser && empty($brokerHouse)) {
            $con = "User.active=1";

        }elseif(!$allUser && !empty($brokerHouse)) {
            $con = "User.active=1 AND User.broker_id=".$brokerHouse;

        }


        $userData = $User->find('all', array(
            'conditions' => $con,
            'fields' => array('User.id','User.username', 'User.broker_id', 'User.portfolio_id', 'User.internal_ref_no','User.bo_id', 'User.broker_fee', 'User.balance', 'User.email', 'User.mobile_no'),
            'recursive' => -1
        ));

        if ($returnType == 1)
            $userData = Hash::combine($userData, '{n}.User.id', '{n}.User', '{n}.User.broker_id');
        if ($returnType == 2)
            $userData = Hash::combine($userData, '{n}.User.id', '{n}.User');
        if ($returnType == 3)
            $userData = Hash::combine($userData, '{n}.User.portfolio_id', '{n}.User');
        if ($returnType == 4)
            $userData = Hash::combine($userData, '{n}.User.internal_ref_no', '{n}.User', '{n}.User.broker_id');
        if ($returnType == 5)
            $userData = Hash::combine($userData, '{n}.User.internal_ref_no', '{n}.User.broker_id');
        if ($returnType == 6)
            $userData = Hash::combine($userData, '{n}.User.internal_ref_no', '{n}.User.portfolio_id');


        //pr($userData);
        //exit;
        return $userData;
    }


    public function checkAcceptOrder($broker_id = 11)
    {
        //Configure::write('debug', 2);
        App::uses('Broker', 'Model');
        $Broker = new Broker();
        $brokerData = $Broker->find('all', array(
            'conditions' => "Broker.id=$broker_id",
            'fields' => array('Broker.accept_order'),
            'recursive' => -1
        ));
        if ($brokerData[0]['Broker']['accept_order'] == 'yes') {
            return 1;
        } else {
            return 0;
        }

        exit;
    }

    public function checkCircuitBreaker($broker_id = 11)
    {
        //Configure::write('debug', 2);
        App::uses('Broker', 'Model');
        $Broker = new Broker();
        $brokerData = $Broker->find('all', array(
            'conditions' => "Broker.id=$broker_id",
            'fields' => array('Broker.circuit_breaker'),
            'recursive' => -1
        ));
        if ($brokerData[0]['Broker']['circuit_breaker'] == 'yes') {
            return 1;
        } else {
            return 0;
        }

        exit;
    }

    function calculateSaleableShares($transactions, $category = 'A', $allOrdersInfo = array())
    {
        //Configure::write('debug', 2);
        $category_Z_mutured_day = 9;
        $category_Others_mutured_day = 1;


        $tradeDate = date('Y-m-d');


        $exchangeId = Configure::read('EXCHANGE_ID');
        App::uses('Market', 'Model');
        $Market = new Market();


        $usedSaleableQty = $this->getUsedSaleAbleQuantity();

        $saleableShares = 0;
        $instrument_id = 0;
        foreach ($transactions as $eachTransaction) {
            $amount = $eachTransaction['amount'];
            $transaction_time = $eachTransaction['transaction_time'];
            $instrument_id = $eachTransaction['instrument_id'];
            $isSpot=$eachTransaction['is_spot'];

            $marketData = $Market->find('all', array(
                'conditions' => "Market.trade_date<='$tradeDate' and Market.trade_date>'$transaction_time' and Market.exchange_id=$exchangeId and Market.is_trading_day=1",
                'recursive' => -1
            ));
            $tradeDatePassed = count($marketData);

            if($isSpot)
            {
                if ($tradeDatePassed > 1) {
                    $saleableShares += $amount;
                }
            }
            else
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

//pr($transactions);
//        exit;
        return $saleableShares - $usedSaleableQty[$instrument_id];
    }

    function createSellList($portfolioHoldingsTransaction, $instrumentList)
    {
        //Configure::write('debug', 2);
        //  pr(Hash::extract($portfolioHoldingsTransaction, "{n}.transactions.{n}"));
        $sellInstrumentsArr = array();
        foreach ($portfolioHoldingsTransaction as $row) {
            $instrumentId = $row['transactions'][0]['instrument_id'];
            $sellInstrumentsArr[$instrumentId] = $instrumentList[$instrumentId];
        }
        return $sellInstrumentsArr;
    }

    public function get_broker_orders($allOrdersInfo = array(), $broker_id = 11)
    {
        Configure::write('debug', 2);

        $instrumentList = $this->StockBangladesh->instrumentList(3);

        if (empty($allOrdersInfo)) {


            App::uses('CakeTime', 'Utility');
            $tradeDateCondition = CakeTime::dayAsSql(date('d-m-Y'), 'Order.created');

            App::uses('Order', 'Model');
            $Order = new Order();


            $allOrdersInfo = $Order->find('all', array(
                'conditions' => "User.broker_id=$broker_id and $tradeDateCondition",
                'contain' => 'User.broker_id',
                'recursive' => -1

            ));
        }

        $orderArr = array();
        foreach ($allOrdersInfo as $row) {
            $temp = $row['Order'];
            $orderStatus = trim($temp['order_status']);
            $temp['ins_id'] = $temp['instrument_id'];
            $temp['instrument_id'] = $instrumentList[$temp['instrument_id']];
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
        if (empty($orderArr['delete'])) {
            $orderArr['delete'] = array();
        }
        if (empty($orderArr['cancel'])) {
            $orderArr['cancel'] = array();
        }


        return $orderArr;
    }

    /*
     * return array index starts from 1 instead of 0
     * */
    public function xlsToArray($filePath='')
    {
        require_once(APP . 'Vendor' . DS . 'phpexcel' . DS . 'PHPExcel.php');

        $inputFileType = PHPExcel_IOFactory::identify($filePath);
        $objReader = PHPExcel_IOFactory::createReader($inputFileType);
        $objReader->setReadDataOnly(true);
        $objPHPExcel = $objReader->load($filePath);

        $rowIterator = $objPHPExcel->getActiveSheet()->getRowIterator();
        $array_data = array();
        foreach ($rowIterator as $row) {
            $cellIterator = $row->getCellIterator();
            $cellIterator->setIterateOnlyExistingCells(false); // Loop all cells, even if it is not set
        //    if (1 == $row->getRowIndex()) continue;//skip first row
            $rowIndex = $row->getRowIndex();
            foreach ($cellIterator as $cell) {

                $array_data[$rowIndex][] = $cell->getCalculatedValue();

            }


        }

        return $array_data;

    }

    public function xlsToArrayForSpecificColumn($filePath='',$column='')
    {
       // Configure::write('debug', 2);
        require_once(APP . 'Vendor' . DS . 'phpexcel' . DS . 'PHPExcel.php');

        $inputFileType = PHPExcel_IOFactory::identify($filePath);
        $objReader = PHPExcel_IOFactory::createReader($inputFileType);
        $objReader->setReadDataOnly(true);
        $objPHPExcel = $objReader->load($filePath);


        $array_data = array();

        $lastRow=$objPHPExcel->getActiveSheet()->getHighestRow();

       foreach($column as $colmn){

            for ($row = 1; $row <= $lastRow; $row++) {

                $q = $objPHPExcel->getActiveSheet()->getCell($colmn.$row)->getValue();
                if(!empty($q))
                    $array_data[]=$q;

            }
        }

        $array_data1 = Hash::combine($array_data, '{n}', '{n}');


        return $array_data1;

    }


}
