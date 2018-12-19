<?php
App::uses('AppController', 'Controller');
/**
 * Orders Controller
 *
 * @property Order $Order
 * @property PaginatorComponent $Paginator
 */
class OrdersController extends AppController {

/**
 * Components
 *
 * @var array
 */
	public $components = array('Paginator');


    public function beforeFilter()

    {

        parent::beforeFilter();

        $this->Auth->allow('fetch_broker_order_test','orderHistory');


    }

    public function submitOrder()
    {
        Configure::write('debug', 2);
        App::uses('CakeEmail', 'Network/Email');
        $StockBangladesh = $this->Components->load('StockBangladesh');
        $instrumentList=$StockBangladesh->instrumentList(3);

        if($this->Auth->user('id')) {
            $uid = $this->Auth->user('id');
            $useremail = $this->Auth->user('email');
            $username = $this->Auth->user('username');
            $internal_ref_no = $this->Auth->user('internal_ref_no');
            $broker_id = $this->Auth->user('broker_id');
        }


        $data=array();


        $data['user_id']=$uid;
        if(isset($_POST['instrumentId']))
            $data['instrument_id'] = $_POST['instrumentId'];
        if(isset($_POST['orderType']))
            $data['order_type'] = $_POST['orderType'];
        if(isset($_POST['amount']))
            $data['amount'] = $_POST['amount'];
        if(isset($_POST['priceType']))
            $data['price_type'] = $_POST['priceType'];
        if(isset($_POST['spot_order']))
            $data['is_spot'] = $_POST['spot_order'];
        if(isset($_POST['rate']))
            $data['rate'] = $_POST['rate'];
        if(isset($_POST['rate_start_range']))
            $data['rate_start_range'] = $_POST['rate_start_range'];
        if(isset($_POST['rate_end_range']))
            $data['rate_end_range'] = $_POST['rate_end_range'];
        if(isset($_POST['execute_at_market_price']))
            $data['execute_at_market_price'] = $_POST['execute_at_market_price'];
        if(isset($_POST['drip_quantity']))
            $data['drip_quantity'] = $_POST['drip_quantity'];

        /*checking  advance order*/
        if(isset($_POST['order_date'])&& trim($_POST['order_date'])!='') {
            App::uses('CakeTime', 'Utility');
            if(!CakeTime::isToday($_POST['order_date']))
            {
                $data['created'] = $_POST['order_date'];
            }

        }

        $ip = $StockBangladesh->getIp();
        $data['order_ip'] = $ip;

        $balanceUsed=0;


        if($this->Order->save($data))
            if($data['order_type']==1) {
            $orderType='buy';
            $money = $data['amount'] * $data['rate'];
            $totalCommission = (($_POST['broker_fee']) / 100) * $money;
            $balanceUsed = $money + $totalCommission;
        }else
        {
            $orderType='sell';
        }

        $insid=$_POST['instrumentId'];
        $amount= $_POST['amount'];
        $rate= $_POST['rate'];
        $instrument_code=$instrumentList[$insid];
        $emailContent="Dear $username,<br/><br/> We have received your <b>$amount $orderType</b> order for <b>$instrument_code</b> placed at <b>$rate</b>. <br/>Your order is submitted from IP : <b>$ip</b><br/><br/> Thanks for trading with us";

        $email_content="Dear $username,We have received your $amount $orderType order for $instrument_code placed at $rate.Your order is submitted from IP :$ip Thanks for trading with us";

        CakeEmail::deliver($useremail, "Order at $internal_ref_no is well received by OMO PLUS with thanks", "$emailContent", array('from' => 'info@stockbangladesh.com','emailFormat' => 'html'));



        //for backup only

       /* App::uses('orders_backup', 'Model');
        $orders_backup = new orders_backup();
        $data['email_content'] = $email_content;
        $data['broker_id'] = $broker_id;
        $orders_backup->save($data);*/

        // new order backup/logs

        App::uses('OrderLog', 'Model');
        $OrderLog = new OrderLog();
        $data['email_sent'] = 0;
        $data['sms_sent'] = 0;
        $data['broker_id'] = $broker_id;
        $OrderLog->save($data);

       // CakeEmail::deliver('raihan.it@stockbangladesh.com', "Order at $internal_ref_no is well received by OMO PLUS with thanks", "$emailContent", array('from' => 'info@stockbangladesh.com','emailFormat' => 'html'));

        $jsonresult = json_encode($balanceUsed);
        echo $jsonresult;

        exit;
    }



    public function lockOrder()
    {
        Configure::write('debug', 2);
        if($this->Auth->user('id')) {
            $uid = $this->Auth->user('id');
        }


        $data=array();


        if(isset($_POST['orderId']))
            $data['id'] = $_POST['orderId'];
        if(isset($_POST['amount']))
            $data['amount'] = $_POST['amount'];
        if(isset($_POST['rate']))
            $data['rate'] = $_POST['rate'];

        $data['order_status'] = 'locked';
        $data['cancel_status'] = 0;

        if($this->Order->save($data))
        echo "sucessfull";

        exit;
    }
    public function pendingOrder()
    {
        Configure::write('debug', 2);
        if($this->Auth->user('id')) {
            $uid = $this->Auth->user('id');
        }


        $data=array();


        if(isset($_POST['orderId']))
            $data['id'] = $_POST['orderId'];
        if(isset($_POST['amount']))
            $data['amount'] = $_POST['amount'];
        if(isset($_POST['rate']))
            $data['rate'] = $_POST['rate'];

        $data['order_status'] = 'pending';
        $data['cancel_status'] = 0;

        if($this->Order->save($data))
        echo "sucessfull";

        exit;
    }
    public function deleteOrder()
    {
       // Configure::write('debug', 2);
        if($this->Auth->user('id')) {
            $uid = $this->Auth->user('id');
        }


        $data=array();
        /*created and updated field is auto filled by cakephp*/

        if(isset($_POST['orderId']))
            $data['id'] = $_POST['orderId'];

        $data['order_status'] = 'delete';


        if($this->Order->save($data))
        echo "sucessfull";

        exit;
    }
    public function deleteAdvanceOrder()
    {
       // Configure::write('debug', 2);
        if($this->Auth->user('id')) {
            $uid = $this->Auth->user('id');
        }


        $data=array();


        if(isset($_POST['orderId']))
            $data['id'] = $_POST['orderId'];

        if($this->Order->delete($data))
            echo "Your advance order removed";

        exit;
    }
    public function deleteOrderReq()
    {
       // Configure::write('debug', 2);
        if($this->Auth->user('id')) {
            $uid = $this->Auth->user('id');
        }


        $data=array();

        if(isset($_POST['orderId']))
            $data['id'] = $_POST['orderId'];

        $data['cancel_status'] = 1;

        if($this->Order->save($data))
        echo "Your delete request has been submitted successfuly";;

        exit;
    }
    public function withdrawOrderReq()
    {
        // Configure::write('debug', 2);
        if ($this->Auth->user('id')) {
            $uid = $this->Auth->user('id');
        }
        $orderId = $_POST['orderId'];


        $ordersInfo = $this->Order->find('all', array(
            'conditions' => "Order.id=$orderId",
            'recursive' => -1

        ));
     /*   if (!is_null($ordersInfo[0]['Order']['dse_order_id']))
        {
            echo "Your withdraw request has been submitted successfuly";
            exit;  // this locked order is placed from dse
        }*/

        $data=array();
        /*created and updated field is auto filled by cakephp*/

        if(isset($_POST['orderId']))
            $data['id'] = $_POST['orderId'];

        $data['order_status'] = 'cancel';

        if($this->Order->save($data))
        echo "Your withdraw request has been submitted successfuly";

        exit;
    }
    public function executeOrder()
    {
      //  Configure::write('debug', 2);
        if($this->Auth->user('id')) {
            $uid = $this->Auth->user('id');
            $broker_id = $this->Auth->user('broker_id');

        }

        $id=$_POST['orderId'];

        $data=array();
        /*created and updated field is auto filled by cakephp*/
        $orderId=$_POST['orderId'];


        $ordersInfo = $this->Order->find('all', array(
            'conditions' => "Order.id=$orderId",
            'recursive' => -1

        ));
        $existing_amount=$ordersInfo[0]['Order']['amount'];
        $remaining_amount= $existing_amount - $_POST['amount'];



        if($remaining_amount==0)  // all executed
        {
            $data['order_status'] = 'executed';
            $data['cancel_status'] = 0;

            if(isset($_POST['orderId']))
                $data['id'] = $_POST['orderId'];
            if(isset($_POST['amount'])) {
                $data['amount'] = $_POST['amount'];
            }
            if(isset($_POST['rate']))
                $data['rate'] = $_POST['rate'];

            $orderUpdateStatus=$this->Order->save($data);  //updating existing row
            $ref_order_id=$_POST['orderId'];
        }

        if($remaining_amount>0)
        {
            $dataToSave=array();
            if(isset($_POST['orderId']))
                $data['id'] = $_POST['orderId'];

            $data['amount'] = $remaining_amount;
            $data['cancel_status'] = 0;
            $dataToSave[]=$data;
            //$orderUpdateStatus=$this->Order->save($data);  // changing the amount of the existing row . Previous Status remain (ie: locked)



            $data=$ordersInfo[0]['Order']; // reinitialize data to add a new row as executed

            unset($data['id']);   // unseting id so that it creates new row

            if(isset($_POST['amount'])) {
                $data['amount'] = $_POST['amount'];
            }
            if(isset($_POST['rate']))
                $data['rate'] = $_POST['rate'];
            $data['cancel_status'] = 0;
            $data['order_status'] = 'executed';
            //$orderUpdateStatus=$this->Order->save($data);  // inserting executed data


            $dataToSave[]=$data;

            $this->Order->saveMany($dataToSave, array('atomic' => true));
            $ref_order_id=$this->Order->getLastInsertId();

            echo "successful";
            //pr($dataToSave);
        }




        $user_id=$ordersInfo[0]['Order']['user_id'];
        $Omo = $this->Components->load('Omo');
        $allUsers = $Omo->getUsersList(2);
        $portfolio_id=$allUsers[$user_id]['portfolio_id'];
        $broker_fee=$allUsers[$user_id]['broker_fee'];

        $portfolioTransactionData=array();
        App::uses('PortfolioTransaction', 'Model');
        $PortfolioTransaction = new PortfolioTransaction();

        $portfolioTransactionData['portfolio_id']=$portfolio_id;
        $portfolioTransactionData['instrument_id']=$ordersInfo[0]['Order']['instrument_id'];
        $portfolioTransactionData['transaction_type_id']=$ordersInfo[0]['Order']['order_type'];
        $portfolioTransactionData['amount']=$_POST['amount'];
        $portfolioTransactionData['rate']=$_POST['rate'];
        $portfolioTransactionData['transaction_time']=date('Y-m-d H:i:s');
        $portfolioTransactionData['is_spot']=$ordersInfo[0]['Order']['is_spot'];
        $portfolioTransactionData['commission']=$broker_fee;
        $portfolioTransactionData['parent_id']=0;
        $portfolioTransactionData['dse_execution_id']='temp';
        $portfolioTransactionData['omo_order_id']=$ref_order_id;

       /* // check whether already inserted
        $allTransactions = $PortfolioTransaction->find('all',array(
            'conditions' => "PortfolioTransaction.omo_order_id=$orderId",
            'recursive' => -1
        ));
        if(!count($allTransactions)) {
            if ($PortfolioTransaction->save($portfolioTransactionData))
               // pr($ordersInfo);
                pr($remaining_amount);
        }*/

        if ($PortfolioTransaction->save($portfolioTransactionData))
            pr($remaining_amount);

        exit;
    }


    public function fetch_order()
    {
        //Configure::write('debug', 2);
        $uid= $broker_id=0;
        if($this->Auth->user('id')) {
            $uid = $this->Auth->user('id');
            $broker_fee = $this->Auth->user('broker_fee');
            $internal_ref_no = $this->Auth->user('internal_ref_no');
            $pid = $this->Auth->user('portfolio_id');
            $broker_id = $this->Auth->user('broker_id');
        }

    //    $uid=3;


        $StockBangladesh = $this->Components->load('StockBangladesh');

        $instrumentList=$StockBangladesh->instrumentList(3);

        App::uses('CakeTime', 'Utility');
        $tradeDateCondition= CakeTime::dayAsSql(date('d-m-Y'), 'Order.created');

        $today=date('Y-m-d');

        $allOrdersInfo = $this->Order->find('all', array(
            'conditions' => "Order.user_id=$uid and Order.created >= '$today'",
           // 'order' => 'DataBanksIntraday.id DESC',
          //  'limit' => $limit,
            'recursive' => -1

        ));
      //  pr($allOrdersInfo);
     //   exit;
        $orderArr=array();
        $todayOrder=array();
        foreach($allOrdersInfo as $row)
        {
            $temp=$row['Order'];

            if(CakeTime::isToday($temp['created'])) {
                $orderStatus = trim($temp['order_status']);
                $temp['instrument_id'] = $instrumentList[$temp['instrument_id']];
                $temp['internal_ref_no'] = $internal_ref_no;
                $orderArr[$orderStatus][] = $temp;
                $todayOrder[]=$temp;
            }else
            {
                $temp['order_status']='advance';
                $orderStatus = trim($temp['order_status']);
                $temp['instrument_id'] = $instrumentList[$temp['instrument_id']];
                $temp['internal_ref_no'] = $internal_ref_no;
                $orderArr[$orderStatus][] = $temp;
            }
        }
        if(empty($orderArr['pending']))
        {
            $orderArr['pending']=array();
        }
        if(empty($orderArr['locked']))
        {
            $orderArr['locked']=array();
        }
        if(empty($orderArr['executed']))
        {
            $orderArr['executed']=array();
        }
        if(empty($orderArr['advance']))
        {
            $orderArr['advance']=array();
        }
        if(empty($orderArr['cancel']))  //cancel=withdraw
        {
            $orderArr['cancel']=array();
        }
        if(empty($orderArr['delete']))
        {
            $orderArr['delete']=array();
        }


        /*$balanceUsed=0;
        $buyOrder=Hash::extract($orderArr['pending'], "{n}[order_type=1]");  //get all buy order
        foreach ($buyOrder as $border) {
            $money = $border['amount'] * $border['rate'];
            $totalCommission = (($broker_fee) / 100) * $money;
            $balanceUsed += $border['amount'] * $money + $totalCommission;
        }

        $buyOrder=Hash::extract($orderArr['locked'], "{n}[order_type=1]");  //get all buy order
        foreach ($buyOrder as $border) {
            $money = $border['amount'] * $border['rate'];
            $totalCommission = (($broker_fee) / 100) * $money;
            $balanceUsed += $border['amount'] * $money + $totalCommission;
        }
        */

        $Portfolio = $this->Components->load('Portfolio');
        $allTransactions=$Portfolio->getAllTransactions($pid);
        $this->ttypeArr=$Portfolio->getTransactionType();
        $balance=$Portfolio->getPortfolioBalanceNew($allTransactions,$this->ttypeArr);



        $Omo = $this->Components->load('Omo');
        $accepting_order=$Omo->checkAcceptOrder($broker_id);
        $circuit_breaker=$Omo->checkCircuitBreaker($broker_id);
        $orderArr['balanceUsed']=$Omo->getUsedBalance($allOrdersInfo,$broker_fee, $uid,$broker_id);
        $orderArr['ajaxBalance']=$balance;
        $orderArr['accepting_order']=$accepting_order;
        $orderArr['circuit_breaker']=$circuit_breaker;
        $orderArr['pid']=$pid;

        $jsonresult = json_encode($orderArr);
        echo $jsonresult;
        exit;
    }


    public function fetch_broker_order()
    {
      //  Configure::write('debug', 2);
        if($this->Auth->user('id')) {
            $uid = $this->Auth->user('id');
            $broker_id = $this->Auth->user('broker_id');
        }
    //    $uid=3;
        $Omo = $this->Components->load('Omo');
        $accepting_order=$Omo->checkAcceptOrder($broker_id);

        $StockBangladesh = $this->Components->load('StockBangladesh');

        $instrumentList=$StockBangladesh->instrumentList(3);

        App::uses('CakeTime', 'Utility');
        $tradeDateCondition= CakeTime::dayAsSql(date('d-m-Y'), 'Order.created');


        $allOrdersInfo = $this->Order->find('all', array(
            'conditions' => "User.broker_id=$broker_id and $tradeDateCondition",
            'contain' => 'User.broker_id',
            'recursive' => -1

        ));


        $allUsers = $Omo->getUsersList(1);
        $orderArr=array();
        $userIdWiseOrderArr=array();
        foreach($allOrdersInfo as $row)
        {
            $temp=$row['Order'];
            $user_id=$temp['user_id'];
            $userIdWiseOrderArr[$user_id][]=$row;
            $orderStatus=trim($temp['order_status']);
            $temp['ins_id']=$temp['instrument_id'];
            $temp['instrument_id']=$instrumentList[$temp['instrument_id']];
            $temp['internal_ref_no']=$allUsers[$broker_id][$user_id]['internal_ref_no'];

            //setting appropriate order rate
            if($temp['order_type']==1)
            {
                if($temp['rate_start_range']>$temp['rate_end_range'])  // in case of buy we will take highest rate
                {
                    $temp['rate_start_range']=$temp['rate_start_range'];
                }else{
                    $temp['rate_start_range']=$temp['rate_end_range'];
                }
            }else
            {
                if($temp['rate_start_range']<$temp['rate_end_range'])  // in case of sell we will take lowest rate
                {
                    $temp['rate_start_range']=$temp['rate_start_range'];
                }else{

                    $temp['rate_start_range']=$temp['rate_end_range'];
                }
            }


            $orderArr[$orderStatus][]=$temp;

        }



        // block to validate advance order


        if($accepting_order) {
            $allPendingOrder = array();
            foreach ($orderArr['pending'] as $porder) {
                $orderTimeToPlace = $porder['created'];  // In advance order, created an updated will not be same. In pending order (if it is not advance. that means it has submitted in trade hour) created==updated
                $orderTimeWhenUserSubmitted = $porder['updated'];
                $user_id = $pid = $porder['user_id'];  // as userid=pid
                $ins_id = $porder['ins_id'];
                $amount = $porder['amount'];
                $rate = $porder['rate'];
                $order_type = $porder['order_type'];

                // getPortfolioHoldings2 creating problem for apex. so I am disabling it here temporarily. Need to find a parmanent solutions
              /*  if (($orderTimeWhenUserSubmitted != $orderTimeToPlace) and $order_type == 2)  // if it is advance order and sell order
                {

                    $allOrdersByThisUser = $this->Order->find('all', array(
                        'conditions' => "Order.user_id=$user_id and $tradeDateCondition",
                        'recursive' => -1

                    ));


                    $Portfolio = $this->Components->load('Portfolio');

                    $allTransactions = $Portfolio->getAllTransactions($pid);

                    $this->ttypeArr = $Portfolio->getTransactionType();

                    $portfolioHoldingsTransaction = $Portfolio->getPortfolioHoldings2($allTransactions, $this->ttypeArr);
                    $totalSaleAbleSharesOfthisIns = $portfolioHoldingsTransaction[$ins_id]['saleAbleShares'];
                    //$allOrderTransactionOfThisUser=Hash::extract($allOrdersInfo, "{n}.Order[user_id=$user_id]");
                    $usedSaleAbleQuantity = $Omo->getUsedSaleAbleQuantity($allOrdersByThisUser, $user_id);
                    $usedSaleAbleQuantityOfThisIns = $usedSaleAbleQuantity[$ins_id] - $amount;  // exclude the  quantity of this order.;
                    $allowedToSell = $totalSaleAbleSharesOfthisIns - $usedSaleAbleQuantityOfThisIns;
                    if ($amount > $allowedToSell)  // have not enough mature share at order placing time/trade hour
                    {
                        $this->Order->id = $porder['id'];
                        $this->Order->saveField('order_status', 'delete');
                        continue; // skip this row
                    }
                //$porder['amount']=$usedSaleAbleQuantityOfThisIns;
                }*/

                if ($orderTimeWhenUserSubmitted != $orderTimeToPlace and $order_type == 1)  // if it is advance order and buy order
                {
                    $broker_fee = $allUsers[$broker_id][$user_id]['broker_fee'];

                    $Portfolio = $this->Components->load('Portfolio');

                    $allTransactions = $Portfolio->getAllTransactions($pid);
                    // pr($allTransactions);
                    $this->ttypeArr = $Portfolio->getTransactionType();
                    $balance = $Portfolio->getPortfolioBalanceNew($allTransactions, $this->ttypeArr);

                    $allOrdersByThisUser = $this->Order->find('all', array(
                        'conditions' => "Order.user_id=$user_id and $tradeDateCondition",
                        'recursive' => -1

                    ));
                    $neededBalance = ($amount * $rate);
                    $commission = $neededBalance * ($broker_fee / 100);
                    $neededBalance = $neededBalance + $commission;

                    $usedBalanace = $Omo->getUsedBalance($allOrdersByThisUser, $broker_fee, $user_id);
                    $usedBalanace = $usedBalanace - $neededBalance;  // exclude balance used for this order

                    $remainingBalance = $balance - $usedBalanace;

                    if ($neededBalance > $remainingBalance)  // have not enough mature balance at order placing time/trade hour
                    {
                        $this->Order->id = $porder['id'];
                        $this->Order->saveField('order_status', 'delete');
                        continue; // skip this row
                    }
                }

                $allPendingOrder[] = $porder;
            }
            $orderArr['pending'] = $allPendingOrder;
        }




        if(empty($orderArr['pending']))
        {
            $orderArr['pending']=array();
        }
        if(empty($orderArr['locked']))
        {
            $orderArr['locked']=array();
        }
        if(empty($orderArr['executed']))
        {
            $orderArr['executed']=array();
        }
        if(empty($orderArr['advance']))
        {
            $orderArr['advance']=array();
        }
        if(empty($orderArr['cancel']))  //cancel=withdraw
        {
            $orderArr['cancel']=array();
        }
        if(empty($orderArr['delete']))
        {
            $orderArr['delete']=array();
        }


        /*$balanceUsed=0;
        $buyOrder=Hash::extract($orderArr['pending'], "{n}[order_type=1]");  //get all buy order
        foreach ($buyOrder as $border) {
            $money = $border['amount'] * $border['rate'];
            $totalCommission = (($broker_fee) / 100) * $money;
            $balanceUsed += $border['amount'] * $money + $totalCommission;
        }

        $buyOrder=Hash::extract($orderArr['locked'], "{n}[order_type=1]");  //get all buy order
        foreach ($buyOrder as $border) {
            $money = $border['amount'] * $border['rate'];
            $totalCommission = (($broker_fee) / 100) * $money;
            $balanceUsed += $border['amount'] * $money + $totalCommission;
        }
        */

        $orderArr['accepting_order']=$accepting_order;
        $jsonresult = json_encode($orderArr);
        echo $jsonresult;
        exit;
    }

    public function fetch_broker_order_test()
    {
        Configure::write('debug', 2);

        if($this->Auth->user('id')) {
            $uid = $this->Auth->user('id');
            $broker_id = $this->Auth->user('broker_id');
        }
    //    $uid=3;
        $Omo = $this->Components->load('Omo');
        $accepting_order=$Omo->checkAcceptOrder($broker_id);

        $StockBangladesh = $this->Components->load('StockBangladesh');

        $instrumentList=$StockBangladesh->instrumentList(3);

        App::uses('orders_backup', 'Model');
        $orders_backup = new orders_backup();

        App::uses('CakeTime', 'Utility');
        $tradeDateCondition= CakeTime::dayAsSql(date('d-m-Y'), 'Order.created');
        $orderDateCondition= CakeTime::daysAsSql(date('d-m-Y'), date('d-m-Y', strtotime('-2 months')), 'orders_backup.created');


        $allOrdersInfo = $this->Order->find('all', array(
            'conditions' => "User.broker_id=$broker_id and $tradeDateCondition",
            'contain' => 'User.broker_id',
            'recursive' => -1

        ));




        $allOrdersHistory = $orders_backup->find('all', array(
            'conditions' => "orders_backup.broker_id=$broker_id and $orderDateCondition",
            //'contain' => 'User.broker_id',
            'recursive' => -1

        ));


        $allUsers = $Omo->getUsersList(1);
        $orderArr=array();
        $userIdWiseOrderArr=array();
        foreach($allOrdersInfo as $row)
        {
            $temp=$row['Order'];
            $user_id=$temp['user_id'];
            $userIdWiseOrderArr[$user_id][]=$row;
            $orderStatus=trim($temp['order_status']);
            $temp['ins_id']=$temp['instrument_id'];
            $temp['instrument_id']=$instrumentList[$temp['instrument_id']];
            $temp['internal_ref_no']=$allUsers[$broker_id][$user_id]['internal_ref_no'];

            //setting appropriate order rate
            if($temp['order_type']==1)
            {
                if($temp['rate_start_range']>$temp['rate_end_range'])  // in case of buy we will take highest rate
                {
                    $temp['rate_start_range']=$temp['rate_start_range'];
                }else{
                    $temp['rate_start_range']=$temp['rate_end_range'];
                }
            }else
            {
                if($temp['rate_start_range']<$temp['rate_end_range'])  // in case of sell we will take lowest rate
                {
                    $temp['rate_start_range']=$temp['rate_start_range'];
                }else{

                    $temp['rate_start_range']=$temp['rate_end_range'];
                }
            }


            $orderArr[$orderStatus][]=$temp;

        }


        foreach($allOrdersHistory as $row) {
            $temp=$row['orders_backup'];
            $user_id=$temp['user_id'];
            $userIdWiseOrderArr[$user_id][]=$row;
            $orderStatus=trim($temp['order_status']);
            $temp['ins_id']=$temp['instrument_id'];
            $temp['instrument_id']=$instrumentList[$temp['instrument_id']];
            $temp['internal_ref_no']=$allUsers[$broker_id][$user_id]['internal_ref_no'];

            //setting appropriate order rate
            if($temp['order_type']==1)
            {
                if($temp['rate_start_range']>$temp['rate_end_range'])  // in case of buy we will take highest rate
                {
                    $temp['rate_start_range']=$temp['rate_start_range'];
                }else{
                    $temp['rate_start_range']=$temp['rate_end_range'];
                }
            }else
            {
                if($temp['rate_start_range']<$temp['rate_end_range'])  // in case of sell we will take lowest rate
                {
                    $temp['rate_start_range']=$temp['rate_start_range'];
                }else{

                    $temp['rate_start_range']=$temp['rate_end_range'];
                }
            }
            $orderArr['historyOrder'][] = $temp;
        }


        // block to validate advance order

        if($accepting_order) {
            $allPendingOrder = array();
            foreach ($orderArr['pending'] as $porder) {
                $orderTimeToPlace = $porder['created'];  // In advance order, created an updated will not be same. In pending order (if it is not advance. that means it has submitted in trade hour) created==updated
                $orderTimeWhenUserSubmitted = $porder['updated'];
                $user_id = $pid = $porder['user_id'];  // as userid=pid
                $ins_id = $porder['ins_id'];
                $amount = $porder['amount'];
                $rate = $porder['rate'];
                $order_type = $porder['order_type'];

              /*  if (($orderTimeWhenUserSubmitted != $orderTimeToPlace) and $order_type == 2)  // if it is advance order and sell order
                {

                    $allOrdersByThisUser = $this->Order->find('all', array(
                        'conditions' => "Order.user_id=$user_id and $tradeDateCondition",
                        'recursive' => -1

                    ));


                    $Portfolio = $this->Components->load('Portfolio');

                    $allTransactions = $Portfolio->getAllTransactions($pid);

                    $this->ttypeArr = $Portfolio->getTransactionType();

                    $portfolioHoldingsTransaction = $Portfolio->getPortfolioHoldings2($allTransactions, $this->ttypeArr);
                    $totalSaleAbleSharesOfthisIns = $portfolioHoldingsTransaction[$ins_id]['saleAbleShares'];
                    //$allOrderTransactionOfThisUser=Hash::extract($allOrdersInfo, "{n}.Order[user_id=$user_id]");
                    $usedSaleAbleQuantity = $Omo->getUsedSaleAbleQuantity($allOrdersByThisUser, $user_id);
                    $usedSaleAbleQuantityOfThisIns = $usedSaleAbleQuantity[$ins_id] - $amount;  // exclude the  quantity of this order.;
                    $allowedToSell = $totalSaleAbleSharesOfthisIns - $usedSaleAbleQuantityOfThisIns;
                    if ($amount > $allowedToSell)  // have not enough mature share at order placing time/trade hour
                    {
                        $this->Order->id = $porder['id'];
                        $this->Order->saveField('order_status', 'delete');
                        continue; // skip this row
                    }
                //$porder['amount']=$usedSaleAbleQuantityOfThisIns;
                }*/

                if ($orderTimeWhenUserSubmitted != $orderTimeToPlace and $order_type == 1)  // if it is advance order and buy order
                {
                    $broker_fee = $allUsers[$broker_id][$user_id]['broker_fee'];

                    $Portfolio = $this->Components->load('Portfolio');

                    $allTransactions = $Portfolio->getAllTransactions($pid);
                    // pr($allTransactions);
                    $this->ttypeArr = $Portfolio->getTransactionType();
                    $balance = $Portfolio->getPortfolioBalanceNew($allTransactions, $this->ttypeArr);

                    $allOrdersByThisUser = $this->Order->find('all', array(
                        'conditions' => "Order.user_id=$user_id and $tradeDateCondition",
                        'recursive' => -1

                    ));
                    $neededBalance = ($amount * $rate);
                    $commission = $neededBalance * ($broker_fee / 100);
                    $neededBalance = $neededBalance + $commission;

                    $usedBalanace = $Omo->getUsedBalance($allOrdersByThisUser, $broker_fee, $user_id);
                    $usedBalanace = $usedBalanace - $neededBalance;  // exclude balance used for this order

                    $remainingBalance = $balance - $usedBalanace;

                    if ($neededBalance > $remainingBalance)  // have not enough mature balance at order placing time/trade hour
                    {
                        $this->Order->id = $porder['id'];
                        $this->Order->saveField('order_status', 'delete');
                        continue; // skip this row
                    }
                }

                $allPendingOrder[] = $porder;
            }
            $orderArr['pending'] = $allPendingOrder;
        }




        if(empty($orderArr['pending']))
        {
            $orderArr['pending']=array();
        }
        if(empty($orderArr['locked']))
        {
            $orderArr['locked']=array();
        }
        if(empty($orderArr['executed']))
        {
            $orderArr['executed']=array();
        }
        if(empty($orderArr['advance']))
        {
            $orderArr['advance']=array();
        }
        if(empty($orderArr['cancel']))  //cancel=withdraw
        {
            $orderArr['cancel']=array();
        }
        if(empty($orderArr['delete']))
        {
            $orderArr['delete']=array();
        }


        /*$balanceUsed=0;
        $buyOrder=Hash::extract($orderArr['pending'], "{n}[order_type=1]");  //get all buy order
        foreach ($buyOrder as $border) {
            $money = $border['amount'] * $border['rate'];
            $totalCommission = (($broker_fee) / 100) * $money;
            $balanceUsed += $border['amount'] * $money + $totalCommission;
        }

        $buyOrder=Hash::extract($orderArr['locked'], "{n}[order_type=1]");  //get all buy order
        foreach ($buyOrder as $border) {
            $money = $border['amount'] * $border['rate'];
            $totalCommission = (($broker_fee) / 100) * $money;
            $balanceUsed += $border['amount'] * $money + $totalCommission;
        }
        */

        $orderArr['accepting_order']=$accepting_order;
        $jsonresult = json_encode($orderArr);
        echo $jsonresult;
        exit;
    }


    public function orderHistory()
    {
        Configure::write('debug', 2);
        $this->Auth->allow('all');
        if($this->Auth->user('id')) {
            $uid = $this->Auth->user('id');
        }



            echo "sucessfull";

        exit;
    }

   
}
