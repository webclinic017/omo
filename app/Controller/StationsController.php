<?php

App::uses('AppController', 'Controller');


/** * Instruments Controller * */
class StationsController extends AppController

{

    public $helpers = array('StockBangladesh');


    public function beforeFilter()

    {

        parent::beforeFilter();

        $this->Auth->allow('access_portfolio', 'runLedgerHac','emptyPortfolioHac'
            , 'runBalance','runMargin','runMargin2','runTradeInsHac'
            ,'runBalanceHac','emailReportHac'
            ,'runTradeInsSharp','runBalanceSharp','emailReportSharp'
            ,'runTradeInsSbsharp','runBalanceSbsharp','emailReportSbsharp'
            ,'runTradeInsFis','runBalanceFis','emailReportFis'
            ,'runTradeInsCommerce','runBalanceCommerce'
            ,'emailReportCommerce', 'runWithdraw', 'runTradeIns_new', 'runTotalRealizedGainLoss'
            , 'bgmea','runWithdrawDeposit','runTradeIns_test_xml','updateCircuitBreaker'
            ,'All_users','active_users','inactive_users','monthlyRegistration'
            ,'monthlyReg','panel','runMarginHac','runLoan','runLoanHac');


    }


    public function panel()

    {

        // Configure::write('debug', 2);

        if ($this->Auth->user('portfolio_id')) {

            $pid = $this->Auth->user('portfolio_id');

            $broker_fee = $this->Auth->user('broker_fee');
            $broker_id = $this->Auth->user('broker_id');

        }
        $Omo = $this->Components->load('Omo');
        $accepting_order = $Omo->checkAcceptOrder($broker_id);
        $circuit_breaker = $Omo->checkCircuitBreaker($broker_id);

        $this->set('broker_id', $broker_id);
        $this->set('pageTitleMain', 'Station dashboard');
        $this->set('pageTitleSmall', 'order processing panel');
        $this->set('accepting_order', $accepting_order);
        $this->set('circuit_breaker', $circuit_breaker);

    }

    public function updateAcceptOrder()
    {

        // Configure::write('debug', 2);

        App::uses('Broker', 'Model');
        $Broker = new Broker();

        if (isset($_POST['broker_id']))
            $data['id'] = $_POST['broker_id'];
        if (isset($_POST['flag']))
            $flag = $_POST['flag'];

        if ($flag) {
            $data['accept_order'] = 'yes';
        } else {
            $data['accept_order'] = 'no';
        }

        if ($Broker->save($data))
            echo "successful";
        exit;
    }

    public function updateCircuitBreaker()
    {

         Configure::write('debug', 2);


        App::uses('Broker', 'Model');
        $Broker = new Broker();
        //pr($_POST);
        if (isset($_POST['broker_id']))
            $data['id'] = $_POST['broker_id'];
        if (isset($_POST['flag']))
            $flag = $_POST['flag'];

        if ($flag) {
            $data['circuit_breaker'] = 'yes';
        } else {
            $data['circuit_breaker'] = 'no';
        }


        if ($Broker->save($data))
            echo "sucessfull";

        exit;
    }


    public function All_users()

    {
        $bro_id=$this->Auth->user('broker_id');
        $group_id=$this->Auth->user('group_id');
        require_once(APP . 'webroot' . DS . 'xcrud' . DS . 'xcrud.php');

        //error_reporting(E_ALL ^ E_WARNING);
        //Configure::write('debug', 2);


        $xcrud = Xcrud::get_instance();
        $xcrud->table('users');
        $xcrud->columns('users.first_name,users.username,users.email,users.mobile_no,users.bo_id,users.internal_ref_no,users.broker_id,users.broker_fee,users.created,users.active');
        $xcrud->fields('users.first_name,users.username,users.email,users.mobile_no,users.bo_id,users.internal_ref_no,users.active,users.broker_id,users.broker_fee,users.password');

        $xcrud->relation('broker_id', 'brokers', 'id', 'broker_name');
        $xcrud->where('broker_id', $bro_id);
        $xcrud->order_by('users.created',DESC);
        //$xcrud->relation('group_id', 'groups', 'id', 'name');
        $xcrud->before_update('update_broker_fee');
        if($group_id==3 && $bro_id !=6)
        {
            $xcrud->unset_edit();
            $xcrud->unset_view();
            $xcrud->unset_remove();
        }
        else{
            $xcrud->unset_view();
        }
        if($group_id==5)
            $xcrud->unset_view();

      //  $xcrud->alert('email', '', 'Your account is activated', 'Dear {username},<br />Congratulations ! Your account is active now. You can start your trading. <br /> Thanks <br />Online Market Order Team');

        $this->set('xcrud', $xcrud);
        $this->set('pageTitleMain','All Users');
        $this->set('pageTitleSmall','Users who are registered');

    }

    public function active_users()

    {
        $bro_id=$this->Auth->user('broker_id');
        $group_id=$this->Auth->user('group_id');
        require_once(APP . 'webroot' . DS . 'xcrud' . DS . 'xcrud.php');

      //  error_reporting(E_ALL ^ E_WARNING);
        //Configure::write('debug', 2);


        $xcrud = Xcrud::get_instance();
        $xcrud->table('users');
        $xcrud->columns('users.first_name,users.username,users.email,users.mobile_no,users.internal_ref_no,users.broker_id,users.broker_fee,users.created,users.active');
        $xcrud->fields('users.first_name,users.username,users.email,users.mobile_no,users.internal_ref_no,users.active,users.broker_id,users.broker_fee,users.password');

        $xcrud->relation('broker_id', 'brokers', 'id', 'broker_name');


        $xcrud->where("users.broker_id = $bro_id AND users.active = 1");
        $xcrud->order_by('users.created',DESC);
        //$xcrud->relation('group_id', 'groups', 'id', 'name');
        $xcrud->before_update('update_broker_fee');
        if($group_id==3 && $bro_id !=6)
        {
            $xcrud->unset_edit();
            $xcrud->unset_view();
            $xcrud->unset_remove();
        }
        else{
            $xcrud->unset_view();
        }
        if($group_id==5)
            $xcrud->unset_view();
      //  $xcrud->alert('email', '', 'Your account is activated', 'Dear {username},<br />Congratulations ! Your account is active now. You can start your trading. <br /> Thanks <br />Online Market Order Team');

        $this->set('xcrud', $xcrud);
        $this->set('pageTitleMain','Active Users');
        $this->set('pageTitleSmall','Users who are connected');

    }

    public function inactive_users()

    {
        $bro_id=$this->Auth->user('broker_id');
        $group_id=$this->Auth->user('group_id');
        require_once(APP . 'webroot' . DS . 'xcrud' . DS . 'xcrud.php');

       // error_reporting(E_ALL ^ E_WARNING);
        //Configure::write('debug', 2);


        $xcrud = Xcrud::get_instance();
        $xcrud->table('users');
        $xcrud->columns('users.first_name,users.username,users.email,users.mobile_no,users.internal_ref_no,users.broker_id,users.broker_fee,users.created,users.active');
        $xcrud->fields('users.first_name,users.username,users.email,users.mobile_no,users.internal_ref_no,users.active,users.broker_id,users.broker_fee,users.password');

        $xcrud->relation('broker_id', 'brokers', 'id', 'broker_name');

        $xcrud->where("users.broker_id = $bro_id AND users.active = '0'");
        $xcrud->order_by('users.created',DESC);

        //$xcrud->relation('group_id', 'groups', 'id', 'name');
        $xcrud->before_update('update_broker_fee');
        if($group_id==3 && $bro_id !=6)
        {
            $xcrud->unset_edit();
            $xcrud->unset_view();
            $xcrud->unset_remove();
        }
        else{
            $xcrud->unset_view();
        }
        if($group_id==5)
            $xcrud->unset_view();

      //  $xcrud->alert('email', '', 'Your account is activated', 'Dear {username},<br />Congratulations ! Your account is active now. You can start your trading. <br /> Thanks <br />Online Market Order Team');

        $this->set('xcrud', $xcrud);
        $this->set('pageTitleMain','Inactive Users');
        $this->set('pageTitleSmall','Users who are deactivated');

    }

    public function monthlyRegistration()
    {

        $bro_id=$this->Auth->user('broker_id');
        $brokerModel = ClassRegistry::init('Broker');

        $brokers = $brokerModel->find('all', array("conditions"=>array('Broker.id'=>$bro_id),'fields'=>array('broker_name','id'),'recursive' => -1) );

        $this->set('brokers',$brokers);
        $this->set('pageTitleMain','Monthly Registered Users');
        $this->set('pageTitleSmall','month wise registration');



    }


    function monthlyReg($paramData)    {
       // Configure::write('debug', 2);
        $bro_id=$this->Auth->user('broker_id');
        require_once(APP . 'webroot' . DS . 'xcrud' . DS . 'xcrud.php');


        $dateFrom=$_POST['dateFrom'];
        $dateTo=$_POST['dateTo'];

        App::uses('CakeTime', 'Utility');
        $dateRange= CakeTime::daysAsSql($dateFrom, $dateTo, 'users.created');


        $xcrud = Xcrud::get_instance();
        $xcrud->table('users');
        $xcrud->columns('users.first_name,users.username,users.email,users.mobile_no,users.internal_ref_no,users.broker_id,users.broker_fee,users.created,users.active');
        $xcrud->fields('users.first_name,users.username,users.email,users.mobile_no,users.internal_ref_no,users.broker_id,users.broker_fee,users.active,users.password');

        $xcrud->relation('broker_id', 'brokers', 'id', 'broker_name');

        $xcrud->order_by('users.created',DESC);

        $xcrud->where("users.broker_id = $bro_id AND $dateRange");

        //$xcrud->relation('group_id', 'groups', 'id', 'name');
        $xcrud->before_update('update_broker_fee');
        $xcrud->unset_view();

        //  $xcrud->alert('email', '', 'Your account is activated', 'Dear {username},<br />Congratulations ! Your account is active now. You can start your trading. <br /> Thanks <br />Online Market Order Team');

        $this->set('xcrud', $xcrud);
        $this->set('pageTitleMain','Monthly Registered Users');
        $this->set('pageTitleSmall','month wise registration');


    }



    function hash_password($postdata, $primary, $xcrud)
    {

        $postdata->set('password', 'xxxxxx');

    }


    public function runTotalRealizedGainLoss()
    {
        Configure::write('debug', 2);
        // checking if user is allowed to do so
        $brokerId = Configure::read('broker.apex.id');
        if ($this->Auth->user('group_id') > 1) {  // if not super admin
            if ($brokerId != $this->Auth->user('broker_id')) {
                echo "This is not your house";
                exit;
            }
        }

        $StockBangladesh = $this->Components->load('StockBangladesh');
        $tradeins_file_path = Configure::read('broker.apex.realized_file_path');
        $fileArr = $StockBangladesh->scan_dir($tradeins_file_path);
        $fullFilePath = "$tradeins_file_path/" . $fileArr[0];
        $Omo = $this->Components->load('Omo');
        $userList = $Omo->getUsersList(4, 1);
        $brokerUsers = array();
        foreach ($userList[$brokerId] as $irn => $arr) {
            $key = trim($irn);
            $key = str_pad($key, 5, "0", STR_PAD_LEFT);
            $key = strtoupper($key);            $brokerUsers[$key] = $arr;
        }

        $xldata = $Omo->xlsToArray($fullFilePath);
        // pr($xldata);
        //  exit;
        $dataToSave = array();
        foreach ($xldata as $row) {
            $temp = array();
            $internal_ref_no = trim($row[0]);
            $internal_ref_no = strtoupper($internal_ref_no);

            $total_deposit = trim($row[8]);
            $total_deposit = (float)str_replace(',', '', $total_deposit);
            $total_deposit = number_format($total_deposit, 2, '.', '');

            $total_withdraw = trim($row[9]);
            $total_withdraw = (float)str_replace(',', '', $total_withdraw);
            $total_withdraw = number_format($total_withdraw, 2, '.', '');

            $total_realized = trim($row[10]);
            $total_realized = (float)str_replace(',', '', $total_realized);
            $total_realized = number_format($total_realized, 2, '.', '');


            if (isset($brokerUsers[$internal_ref_no])) {
                $pid = $brokerUsers[$internal_ref_no]['portfolio_id'];
                $temp['id'] = $pid;
                //$temp['irn'] = $internal_ref_no;
                $temp['total_deposit'] = $total_deposit;
                $temp['total_withdraw'] = $total_withdraw;
                $temp['total_realized'] = $total_realized;
                $temp['total_stats_updated'] = date("Y-m-d H:i:s", strtotime("-2 day"));

                $dataToSave[$internal_ref_no] = $temp;

                //  pr($temp);
            }
        }
        $model = ClassRegistry::init('Portfolio');
        if (count($dataToSave)) {
            $model->saveMany($dataToSave, array('atomic' => true));
            pr($dataToSave);
        }

        exit;

    }

    public function runWithdraw()
    {
        Configure::write('debug', 2);
        // checking if user is allowed to do so
        $brokerId = Configure::read('broker.apex.id');
        if ($this->Auth->user('group_id') > 1) {  // if not super admin
            if ($brokerId != $this->Auth->user('broker_id')) {
                echo "This is not your house";
                exit;
            }
        }

        $StockBangladesh = $this->Components->load('StockBangladesh');
        $tradeins_file_path = Configure::read('broker.apex.withdraw_file_path');
        $fileArr = $StockBangladesh->scan_dir($tradeins_file_path);

        if(!isset($fileArr[0]))
        {
            echo "Upload withdraw file. Then run again<br/>";
            exit;
        }

        $fullFilePath = "$tradeins_file_path/" . $fileArr[0];
        $Omo = $this->Components->load('Omo');
        $userList = $Omo->getUsersList(4, 1);
        $brokerUsers = array();
        foreach ($userList[$brokerId] as $irn => $arr) {
            $key = trim($irn);
            $key = str_pad($key, 5, "0", STR_PAD_LEFT);
            $key = strtoupper($key);
            $brokerUsers[$key] = $arr;
        }

        $xldata = $Omo->xlsToArray($fullFilePath);
        pr($xldata);
        $dataToSave = array();
        foreach ($xldata as $row) {
            $temp = array();
            $rate = trim($row[19]);
            $rate = (float)str_replace(',', '', $rate);
            $internal_ref_no = trim($row[0]);
            $internal_ref_no = strtoupper($internal_ref_no);

            if (isset($brokerUsers[$internal_ref_no])) {
                $pid = $brokerUsers[$internal_ref_no]['portfolio_id'];
                $temp['portfolio_id'] = $pid;
                $temp['transaction_type_id'] = 5;  //withdraw
                $temp['amount'] = 1;
                $temp['rate'] = $rate;
                $temp['transaction_time'] = date("Y-m-d H:i:s");

                if ($temp['rate'])
                    $dataToSave[] = $temp;

                pr($temp);
            }

            if(!empty($internal_ref_noStr))
            {
                $tempForRaw['client_code']=$internal_ref_noStr;
                $tempForRaw['portfolio_id']=$pid;
                $tempForRaw['name']=trim($row[5]);
                $tempForRaw['ref']=trim($row[8]);
                $tempForRaw['mop']=trim($row[11]);
                $tempForRaw['bank_name']=trim($row[14]);
                $tempForRaw['branch_name']=trim($row[17]);
                $tempForRaw['cheque_no']=trim($row[19]);
                $tempForRaw['amount']=$rate;                $tempForRaw['portfolio_transaction_id']=0;
                $tempForRaw['broker_id']=$brokerId;

                $dataToSaveRaw[]=$tempForRaw;
            }
        }
        $model = ClassRegistry::init('PortfolioTransaction');
        $rawmodel = ClassRegistry::init('RawWithdraw');
        if (count($dataToSave)) {
            //  $model->saveMany($dataToSave, array('atomic' => true));
            pr($dataToSave);
        }
        if (count($dataToSaveRaw)) {
            //  $rawmodel->saveMany($dataToSaveRaw, array('atomic' => true));
            pr($dataToSaveRaw);
        }
        exit;

    }

    public function runDeposit()
    {
        Configure::write('debug', 2);
        // checking if user is allowed to do so
        $brokerId = Configure::read('broker.apex.id');
        if ($this->Auth->user('group_id') > 1) {  // if not super admin
            if ($brokerId != $this->Auth->user('broker_id')) {
                echo "This is not your house";
                exit;
            }
        }

        $StockBangladesh = $this->Components->load('StockBangladesh');
        $tradeins_file_path = Configure::read('broker.apex.deposit_file_path');
        $fileArr = $StockBangladesh->scan_dir($tradeins_file_path);
        $fullFilePath = "$tradeins_file_path/" . $fileArr[0];

        if(!isset($fileArr[0]))
        {
            echo "Upload Deposit file. Then run again<br/>";
            exit;
        }

        $Omo = $this->Components->load('Omo');
        $userList = $Omo->getUsersList(4, 1);
        $brokerUsers = array();
        foreach ($userList[$brokerId] as $irn => $arr) {
            $key = trim($irn);
            $key = str_pad($key, 5, "0", STR_PAD_LEFT);
            $key = strtoupper($key);
            // $key.='[D]';

            $brokerUsers[$key] = $arr;
        }


        $xldata = $Omo->xlsToArray($fullFilePath);
        //pr($xldata);
        $dataToSave = array();
        $dataToSaveRaw = array();
        foreach ($xldata as $row) {
            $temp = array();
            $tempForRaw = array();
            $rate = trim($row[21]);
            $rate = (float)str_replace(',', '', $rate);
            $internal_ref_noStr = trim($row[0]);
            $internal_ref_noArr = explode('[', $internal_ref_noStr);

            $internal_ref_no = $internal_ref_noArr[0];
            $internal_ref_no = strtoupper($internal_ref_no);

            $pid = 0;
            if (isset($brokerUsers[$internal_ref_no])) {
                $pid = $brokerUsers[$internal_ref_no]['portfolio_id'];
                $temp['portfolio_id'] = $pid;
                $temp['transaction_type_id'] = 5;  //withdraw
                $temp['amount'] = 1;
                $temp['rate'] = $rate;
                $temp['transaction_time'] = date("Y-m-d H:i:s");


                if ($temp['rate'])
                    $dataToSave[] = $temp;

            }

            if ($rate) {
                $tempForRaw['client_code'] = $internal_ref_noStr;
                $tempForRaw['portfolio_id'] = $pid;
                $tempForRaw['name'] = trim($row[5]);
                $tempForRaw['ref'] = trim($row[8]);
                $tempForRaw['mop'] = trim($row[11]);
                $tempForRaw['bank_name'] = trim($row[14]);
                $tempForRaw['branch_name'] = trim($row[17]);
                $tempForRaw['cheque_no'] = trim($row[19]);
                $tempForRaw['amount'] = $rate;
                $tempForRaw['portfolio_transaction_id'] = 0;
                $tempForRaw['broker_id'] = $brokerId;

                $dataToSaveRaw[] = $tempForRaw;
            }
        }

        $model = ClassRegistry::init('PortfolioTransaction');
        $rawmodel = ClassRegistry::init('RawDeposit');

        if (count($dataToSave)) {
            // $model->saveMany($dataToSave, array('atomic' => true));
            pr($dataToSave);
        }

        if (count($dataToSaveRaw)) {
            //  $rawmodel->saveMany($dataToSaveRaw, array('atomic' => true));
            pr($dataToSaveRaw);
        }

        exit;

    }


    ///////////////////////////////////////////////////////////////////for Apex broker House////////////////////////////////////////////////////////////////////
    public function runBalance()
    {
        Configure::write('debug', 2);

//pr($this->Auth->user('broker_id'));
       // pr(Configure::read('broker.hac.id'));
       // exit;

          $StockBangladesh = $this->Components->load('StockBangladesh');


          // checking if user is allowed to do so
           $brokerId = Configure::read('broker.apex.id');
          if ($this->Auth->user('group_id') > 1) {  // if not super admin
              if ($brokerId != $this->Auth->user('broker_id')) {
                  echo "This is not your house";
                  exit;
              }
          }

          // generating file path
          $balance_file_path = Configure::read('broker.apex.balance_file_path');
          $fileArr = $StockBangladesh->scan_dir($balance_file_path);
          $fullFilePath = "$balance_file_path/" . $fileArr[0];


        $fileDate='';
          // reading file
          $file = fopen($fullFilePath, "r");
          $powerArr = array();
            $pattern=array();
          while (!feof($file)) {
              $row = fgetcsv($file);

              if(strpos($row[0],'Cod'))
              {
                  $pattern=$row;
                  //pr($row);
              }

              if(strpos($row[0],'As')) {

                 // pr ("reached");
                  $fileDate=$row[0];
                  $fileDate = explode('On', $fileDate);
                  $fileDate = $fileDate[1];
                  $fileDate=date('d-m-Y',strtotime($fileDate));

              }
              $internal_ref_no = trim($row[0]);
              $internal_ref_no = strtoupper($internal_ref_no);
              $powerArr[$internal_ref_no]['purchase_power'] = $row[12];
              $deposit = $row[14];
              $withdraw = $row[16];
              $realized = $row[17];
              $powerArr[$internal_ref_no]['deposit'] = $deposit;
              $powerArr[$internal_ref_no]['withdraw'] = $withdraw;
              $powerArr[$internal_ref_no]['realized'] = $realized;


          }



        if($fileDate!= date('d-m-Y'))
        {
            echo "<br>";
            echo "<h2>this is not today's file.please recheck and upload the correct file again</h2>";
            exit;
        }



        $patternArray= array
        (
            0 => 'Client Cod',
            1 => '',
            2 => 'Name',
            3 => '',
            4 => '',
            5 => 'Um Sale(TK',
            6=> '',
            7 => 'Un Clr Chq(TK',
            8 => '',
            9=> '',
            10 => '',
            11 => 'Avai Bal(TK.',
            12 => '',
            13 => 'Led Bal(TK.',
            14 => 'Deposit(TK.',
            15 => '',
            16 => 'Withdraw(TK',
            17 => '',
            18 => '',
            19 => 'Gain-Los',
            20 => ''

        );




        if ($pattern !== $patternArray)//chk order
        {


            echo"File Column order is not in correct format.";
            echo "Expected File Order Is: Client Code => Name=> Um Sale(TK.) => Un Clr Chq(TK.) => Avai Bal(TK.) => Led Bal(TK.) => Deposit(TK.) => Withdraw(TK.) => Gain-Loss";

            exit;

        }

        fclose($file);
          // preparing inr according to apex format (pading leading zero)
          $Omo = $this->Components->load('Omo');
          $userList = $Omo->getUsersList(4, 1);
          $brokerUsers = array();
          foreach ($userList[$brokerId] as $irn => $arr) {
              $key = trim($irn);
              $key = str_pad($key, 5, "0", STR_PAD_LEFT);
              $key = strtoupper($key);
              $brokerUsers[$key] = $arr;
          }
          $dataToSave2 = array();
          foreach ($brokerUsers as $irn => $usr) {
              if (isset($powerArr[$irn])) {
                  $pid = $usr['portfolio_id'];
                  $id = $usr['id']; //userid
                  $balance = $usr['balance'];

                  $ppower = $powerArr[$irn]['purchase_power'];
                  $ppower = (float)str_replace(',', '', $ppower);

                  $deposit = $powerArr[$irn]['deposit'];
                  $deposit = (float)str_replace(',', '', $deposit);

                  $withdraw = $powerArr[$irn]['withdraw'];
                  $withdraw = (float)str_replace(',', '', $withdraw);

                  $realized = $powerArr[$irn]['realized'];
                  $realized = (float)str_replace(',', '', $realized);



                  // update portfolio table balance
                  $temp2 = array();
                  $temp2['id'] = $pid;
                  $temp2['total_deposit'] = $deposit;
                  $temp2['total_withdraw'] = $withdraw;
                  $temp2['total_realized'] = $realized;
                  $temp2['total_stats_updated'] = date('Y-m-d H:i:s');
                  $temp2['balance'] = $ppower;


                  /*  if ($amount > 5)  // difference less than 5 is overlooked
                    {*/

                  $dataToSave2[] = $temp2;
                  // }
              }

          }

          $model2 = ClassRegistry::init('Portfolio');
          if (count($dataToSave2)) {
              $model2->saveMany($dataToSave2, array('atomic' => true));
              echo count($dataToSave2) . ' balanace updated';


              $rt = Router::url('/', true) . "Stations/runMargin";

              echo "<br /><a target='_blank' href='$rt'><h3>Run Margin Script</h3></a> <br />";
          }


          // deleting all existing file

        /*  $dir = 'apex/balance/*';

          $files = glob($dir); // get all file names
          foreach ($files as $file) { // iterate files
              if (is_file($file))
                  unlink($file); // delete file
          }*/


          exit;






    }



    public function runMargin()
    {
        Configure::write('debug', 2);


            $StockBangladesh = $this->Components->load('StockBangladesh');


            // checking if user is allowed to do so
            $brokerId = Configure::read('broker.apex.id');
            if ($this->Auth->user('group_id') > 1) {  // if not super admin
                if ($brokerId != $this->Auth->user('broker_id')) {
                    echo "This is not your house";
                    exit;
                }
            }

            // generating file path
            $balance_file_path = Configure::read('broker.apex.margin_file_path');
            $fileArr = $StockBangladesh->scan_dir($balance_file_path);
            $fullFilePath = "$balance_file_path/" . $fileArr[0];


            // reading file
            $file = fopen($fullFilePath, "r");
            $powerArr = array();
            while (!feof($file)) {
                $row = fgetcsv($file);
//pr($row);
                $internal_ref_no = trim($row[0]);
                $internal_ref_no = strtoupper($internal_ref_no);
                $powerArr[$internal_ref_no][] = $row[22];
            }
            fclose($file);


            // preparing inr according to apex format (pading leading zero)
            $Omo = $this->Components->load('Omo');
            $userList = $Omo->getUsersList(4, 1);
            $brokerUsers = array();
            foreach ($userList[$brokerId] as $irn => $arr) {
                $key = trim($irn);
                $key = str_pad($key, 5, "0", STR_PAD_LEFT);
                $key = strtoupper($key);
                $brokerUsers[$key] = $arr;
            }//pr($powerArr);
//exit;

            $dataToSave2 = array();
            foreach ($brokerUsers as $irn => $usr) {
                if (isset($powerArr[$irn])) {
                    $pid = $usr['portfolio_id'];
                    $id = $usr['id']; //userid
                    $balance = $usr['balance'];

                    $ppower = $powerArr[$irn][0];
                    $ppower = (float)str_replace(',', '', $ppower);


                    // update portfolio table balance
                    $temp2 = array();
                    $temp2['id'] = $pid;
                    $temp2['total_stats_updated'] = date('Y-m-d H:i:s');
                    $temp2['balance'] = $ppower;


                    if(is_float($ppower))
                    $dataToSave2[] = $temp2;

                }

            }

        $model2 = ClassRegistry::init('Portfolio');
        if (count($dataToSave2)) {
            $model2->saveMany($dataToSave2, array('atomic' => true));
            echo count($dataToSave2) . ' balanace updated';


        }


            exit;







    }

    public function runTradeIns($sent_email=0)
    {

        Configure::write('debug', 2);
        App::uses('CakeEmail', 'Network/Email');
        App::uses('CakeTime', 'Utility');

        $StockBangladesh = $this->Components->load('StockBangladesh');
        $ip = $StockBangladesh->getIp();
        $instrumentList = $StockBangladesh->instrumentList(2);

        $brokerId = Configure::read('broker.apex.id');
        if ($this->Auth->user('group_id') > 1) {  // if not super admin
            if ($brokerId != $this->Auth->user('broker_id')) {
                echo "This is not your house";
                exit;
            }
        }

        // generating file path

        $tradeins_file_path = Configure::read('broker.apex.tradeins_file_path');
        $fileArr = $StockBangladesh->scan_dir($tradeins_file_path);





        $today = CakeTime::nice(date ("F d Y"));
        $fullFilePath = "$tradeins_file_path/" . $fileArr[0];
        App::uses('CakeTime', 'Utility');
        $reportDate=CakeTime::nice(date ("F d Y", filemtime($fullFilePath)));

        if ($reportDate != $today) {
            echo $fileArr[0];
            echo "<br/>This is not today's file.<br/>";
            exit;
        }




        $Omo = $this->Components->load('Omo');
        $userList = $Omo->getUsersList(4, 1);

        $brokerUsers = array();
        foreach ($userList[11] as $irn => $arr) {
            $key = trim($irn);
            $key = str_pad($key, 5, "0", STR_PAD_LEFT);
            $key = strtoupper($key);
            $brokerUsers[$key] = $arr;
        }

        $tradeArr = array();        $xldata = $Omo->xlsToArray($fullFilePath, 8);

        $paternArray= array
        (
            '0' => 'Client A/C',
            '1' => 'Symbol',
            '2' => 'Side',
            '3' => 'OrderQty',
            '4' => 'OrdLimit',
            '5' => 'SubStatus',
            '6' => 'ExecQty',
            '7' => 'ExecPrice',
            '8' => 'ExecTime',
            '9' => 'ExecStat',
            '10' => 'OrdAvP',
            '11' => 'A/C CDS',
            '12' => 'ExecType',
            '13' => 'ExecID',
            '14' => 'TFOrderID'
        );

        if ($xldata[1] !== $paternArray)//chk order
        {


            echo"File Column order is not in correct format.";
            echo "Expected File Order Is: Client A/C => Symbol=> Side => OrderQty => OrdLimit => SubStatus => ExecQty => ExecPrice => ExecTime => ExecStat => OrdAvP => A/C CDS => ExecType => ExecID => TFOrderID";

            exit;

        }

        unset($xldata[0]);


        $dataToSaveForRaw = array();

        foreach ($xldata as $row) {
            $temp = array();
            $tempForRaw = array();
            $internal_ref_no = trim($row[0]);
            $internal_ref_no = strtoupper($internal_ref_no);
            $instrument_code = trim($row[1]);
            $transaction_type = trim($row[2]);

            $transaction_time = trim($row[8]);
            //$transaction_time = PHPExcel_Style_NumberFormat::toFormattedString($transaction_time, 'DD/MM/YYYY hh:mm');
            $transaction_time = PHPExcel_Style_NumberFormat::toFormattedString($transaction_time, 'hh:mm:ss');

           // $reportDate2 = '2015/09/15'; //for backdated tradeIns


            $reportDate2 = date('Y/m/d');


            $transaction_time="$reportDate2 $transaction_time";

            $transaction_time = date("Y-m-d H:i:s", strtotime($transaction_time));
            //pr($transaction_time);

            $amount = trim($row[6]);
            $rate = trim($row[7]);
            $rate = (float)str_replace(',', '', $rate);
            $order_id = trim($row[14]);
            $execution_id = trim($row[13]);
            $execution_arr = explode('_', $execution_id);
            $execution_id = $execution_arr[count($execution_arr) - 1];

            $temp['instrument_code'] = $instrument_code;
            $temp['transaction_time'] = $transaction_time;
            $temp['transaction_type'] = $transaction_type;
            $temp['amount'] = $amount;
            $temp['rate'] = $rate;
            $temp['order_id'] = $order_id;
            $temp['execution_id'] = $execution_id;
            $tradeArr[$internal_ref_no][] = $temp;

            $rate = (float)str_replace(',', '', $rate);
            $tempForRaw['client_ac'] = trim($row[0]);
            $tempForRaw['symbol'] = trim($row[1]);
            $tempForRaw['side'] = trim($row[2]);
            $tempForRaw['order_qty'] = trim($row[3]);
            $tempForRaw['order_limit_price'] = trim($row[4]);
            $tempForRaw['substatus'] = trim($row[5]);
            $tempForRaw['execute_qty'] = trim($row[6]);
            $tempForRaw['execute_price'] = $rate;
            $tempForRaw['execute_time'] = $transaction_time;
            $tempForRaw['execute_stat'] = trim($row[9]);
            $tempForRaw['order_avg_price'] = trim($row[10]);
            $tempForRaw['ac_cds'] = trim($row[11]);
            //  $tempForRaw['counter_trader_id'] = trim($row[13]);
            $tempForRaw['execute_type'] = trim($row[12]);
            $tempForRaw['execution_id'] = trim($row[13]);
            $tempForRaw['order_id'] = trim($row[14]);
            $tempForRaw['broker_id'] = $brokerId;
            if ($rate) {

                $dataToSaveForRaw[] = $tempForRaw;
            }

        }


        $model = ClassRegistry::init('PortfolioTransaction');
        $dataToSave = array();
        $updateCounter = 0;


        foreach ($brokerUsers as $irn => $usr) {
            if (isset($tradeArr[$irn])) {

                foreach ($tradeArr[$irn] as $eachRealTransaction) {

                    $pid = $usr['portfolio_id'];
                    $broker_fee = $usr['broker_fee'];

                    $instrument_code = $eachRealTransaction['instrument_code'];
                    if ($eachRealTransaction['transaction_type'] == 'Sell') {
                        $transaction_type_id = 2; // sell
                    } else {
                        $transaction_type_id = 1; // buy
                    }

                    $temp = array();
                    $temp['portfolio_id'] = $pid;
                    $temp['instrument_id'] = $instrumentList[$instrument_code];
                    $temp['transaction_type_id'] = $transaction_type_id;
                    $temp['amount'] = abs($eachRealTransaction['amount']);
                    $temp['rate'] = $eachRealTransaction['rate'];
                    $temp['commission'] = $broker_fee;
                    $transaction_time = $eachRealTransaction['transaction_time'];
                    $temp['transaction_time'] = $transaction_time;
                    $temp['dse_order_id'] = $eachRealTransaction['order_id'];
                    $temp['dse_execution_id'] = $eachRealTransaction['execution_id'];

                    $dse_order_id = $eachRealTransaction['order_id'];
                    $dse_execution_id = $eachRealTransaction['execution_id'];

                    $transaction = $model->find('all', array(
                            'conditions' => "PortfolioTransaction.portfolio_id=$pid and PortfolioTransaction.dse_order_id LIKE '$dse_order_id' and PortfolioTransaction.dse_execution_id LIKE '$dse_execution_id'"
                        , 'recursive' => -1
                        )

                    );

                    if (count($transaction))  // if already exist
                    {
                        $updateCounter++;
                        $temp['id'] = $transaction[0]['PortfolioTransaction']['id'];  // setting primary id. So it will update instead of creating new
                    }

                    $dataToSave[] = $temp;
                }

            }

        }



        if($sent_email) {  // by force sending email only
            if ($reportDate == $today) {  // if it is today tradeins we will sent email
                echo "email sending........<br />";
                $this->emailReport($dataToSave, $brokerUsers);

                echo ".................email sending finished<br />";
                exit;
            }
        }

        if (count($dataToSave)) {
            $model->deleteAll("Portfolio.broker=$brokerId and PortfolioTransaction.dse_execution_id  LIKE  'temp'", false);
            $model->saveMany($dataToSave, array('atomic' => true));
            $n = (count($dataToSave) - $updateCounter);
            echo $n . 'rows inserted in portfolio transaction table and ' . $updateCounter . ' rows updated';
            /* echo "<pre>";
             print_r($dataToSave);*/
           // CakeEmail::deliver('info@stockbangladesh.com', "Trade Ins of $reportDate2 Apex run sucessfuly", "$n rows inserted and $updateCounter rows updated in portfolio transaction table. Script run from $ip", array('from' => 'omo@stockbangladesh.net'));

            $email  = new CakeEmail('smtp');
            $email->to('info@stockbangladesh.com')
                ->subject("Trade Ins of $reportDate2 Apex run successfully")
                ->send("$n rows inserted and $updateCounter rows updated in portfolio transaction table. Script run from $ip");

        }
        $rawmodel = ClassRegistry::init('RawTradin');
        if (count($dataToSaveForRaw)) {

            $rawmodel->saveMany($dataToSaveForRaw, array('atomic' => true));
        }

        if($updateCounter==0) { // if this email was not sent previously
            if ($reportDate == $today) {  // if it is today tradeins we will sent email
                echo "email sending........<br />";
                $this->emailReport($dataToSave, $brokerUsers);

                echo ".................email sending finished<br />";
            }
        }
        else
        {
            echo "<br/>email previously sent <br />";

        }


        exit;


    }


    public function runLedgerHac($bo_irn=0)
    {

        if(!$bo_irn) {
            echo "enter bo code at the end of the url. example http://www.new.stockbangladesh.net/Stations/runLedgerHac/70415";
            exit;
        }

        Configure::write('debug', 2);
        App::uses('CakeEmail', 'Network/Email');
        App::uses('CakeTime', 'Utility');



        $StockBangladesh = $this->Components->load('StockBangladesh');
        $ip = $StockBangladesh->getIp();
        $instrumentList = $StockBangladesh->instrumentList(2);

        $brokerId = Configure::read('broker.hac.id');
        if ($this->Auth->user('group_id') > 1) {  // if not super admin
            if ($brokerId != $this->Auth->user('broker_id')) {
                echo "This is not your house";
                exit;
            }
        }

        $Omo = $this->Components->load('Omo');
        $userList = $Omo->getUsersList(4, 1);


        $brokerUsers = array();
        foreach ($userList[5] as $irn => $arr) {
            $key = trim($irn);
            $key = str_pad($key, 5, "0", STR_PAD_LEFT);
            $key = strtoupper($key);
            $brokerUsers[$key] = $arr;
        }

        // generating file path

        $fname="$bo_irn.csv";

        $tradeins_file_path = Configure::read('broker.hac.ledger_path');
        $fileArr = $StockBangladesh->scan_dir($tradeins_file_path);


        $today = CakeTime::nice(date ("F d Y"));
        $fullFilePath = "$tradeins_file_path/" . $fname;

        if(!file_exists($fullFilePath))
        {
            echo "$fname is not exist. Please upload ledger";
            exit;
        }
        App::uses('CakeTime', 'Utility');
        $reportDate=CakeTime::nice(date ("F d Y", filemtime($fullFilePath)));

        if ($reportDate != $today) {
            echo $fname;
            echo "<br/>This is not today's file.<br/>";
            exit;
        }



        $dataToSave = array();
        $xldata = $Omo->xlsToArray($fullFilePath, 8);

        unset($xldata[0]);


        $file_name = trim($fileArr[0]);
        $file_name_arr=explode('.',$file_name);
        $internal_ref_no = $file_name_arr[0];
        $pid=$brokerUsers[$internal_ref_no]['portfolio_id'];


        $dataToSaveForRaw = array();
        $reportDate = '';
        foreach ($xldata as $row) {
            $temp = array();
            $tempForRaw = array();


            $transaction_time = date("Y-m-d H:i:s", strtotime( trim($row[0])));
            //pr($transaction_time);

            $transaction_type = trim($row[1]);
            $transaction_type_id=0;

            $amount = trim($row[4]);

            $rate = trim($row[5]);
            $rate = (float)str_replace(',', '', $rate);
            $execution_id = 'from_ledger_'.date('d-m-Y') ;


            if ($transaction_type == 'Sale') {
                $transaction_type_id = 2; // sell
            }

            elseif($transaction_type=='Buy') {
                $transaction_type_id = 1; // buy
            } elseif($transaction_type=='IPO') {
                $transaction_type_id = 1; // IPO
                $rate=0;
            }elseif($transaction_type=='BONUS') {
                $transaction_type_id = 1; // BONUS
                $rate=0;
            }

            elseif($transaction_type=='Receive') {
                $transaction_type_id = 6;  //deposit
                $amount=1;
                $rate = trim($row[9]);
                $rate = (float)str_replace(',', '', $rate);

            }elseif($transaction_type=='Deduction') {
                $transaction_type_id = 6;  //Deduction is deposit like IPO REFUND-KDSALTD
                $amount=1;
                $rate = trim($row[9]);
                $rate = (float)str_replace(',', '', $rate);
            }

            elseif($transaction_type=='Payment') {
                $transaction_type_id = 5; // Withdraw
                $amount=1;
                $rate = trim($row[8]);
                $rate = (float)str_replace(',', '', $rate);

            }elseif($transaction_type=='Addition') {
                $transaction_type_id = 5; // Addition is withdraw like BO renewal fee
                $amount=1;
                $rate = trim($row[8]);
                $rate = (float)str_replace(',', '', $rate);
            }elseif($transaction_type=='CDBL Charges') {
                $transaction_type_id = 5; // CDBL Charges
                $amount=1;
                $rate = trim($row[8]);
                $rate = (float)str_replace(',', '', $rate);
            }else
            {
                echo "Unknown Transaction type found : $transaction_type <br />";
                continue;
            }


            $instrument_code = trim($row[2]);






            $temp['portfolio_id'] =$pid;
            if(isset($instrumentList[$instrument_code])) {
                $temp['instrument_id'] = $instrumentList[$instrument_code];
                $temp['instrument_code'] = $instrument_code;

            }else
            {
                $transaction_type="$instrument_code $transaction_type ";
            }



            $temp['transaction_time'] = $transaction_time;
            $temp['transaction_type_id'] = $transaction_type_id;
            $temp['amount'] = $amount;
            $temp['rate'] = $rate;
            $temp['dse_order_id'] = $transaction_type;   // we are preserving the transaction text here
            $temp['dse_execution_id'] = $execution_id;
            $dataToSave[] = $temp;


        }



        $model = ClassRegistry::init('PortfolioTransaction');


        /*if($sent_email) {  // by force sending email only
            if ($reportDate == $today) {  // if it is today tradeins we will sent email
                echo "email sending........<br />";
                $this->emailReportHac($dataToSave, $brokerUsers);

                echo ".................email sending finished<br />";
                exit;
            }
        }*/



        if (count($dataToSave)) {

            $model->deleteAll("Portfolio.broker=$brokerId and PortfolioTransaction.portfolio_id=$pid", false);
            $model->saveMany($dataToSave, array('atomic' => true));

        }



        pr($dataToSave);
        exit;


    }
    public function emptyPortfolioHac($bo_irn=0,$confirm=0)
    {

        if(!$bo_irn) {
            echo "enter bo code at the end of the url. example http://www.new.stockbangladesh.net/Stations/emptyPortfolioHac/70415";
            exit;
        }

        Configure::write('debug', 2);
        App::uses('CakeEmail', 'Network/Email');
        App::uses('CakeTime', 'Utility');



        $StockBangladesh = $this->Components->load('StockBangladesh');
        $ip = $StockBangladesh->getIp();
        $instrumentList = $StockBangladesh->instrumentList(2);

        $brokerId = Configure::read('broker.hac.id');
        if ($this->Auth->user('group_id') > 1) {  // if not super admin
            if ($brokerId != $this->Auth->user('broker_id')) {
                echo "This is not your house";
                exit;
            }
        }

        $Omo = $this->Components->load('Omo');
        $userList = $Omo->getUsersList(4, 1);


        $brokerUsers = array();
        foreach ($userList[5] as $irn => $arr) {
            $key = trim($irn);
            $key = str_pad($key, 5, "0", STR_PAD_LEFT);
            $key = strtoupper($key);
            $brokerUsers[$key] = $arr;
        }


        $pid=$brokerUsers[$bo_irn]['portfolio_id'];





        $model = ClassRegistry::init('PortfolioTransaction');


        /*if($sent_email) {  // by force sending email only
            if ($reportDate == $today) {  // if it is today tradeins we will sent email
                echo "email sending........<br />";
                $this->emailReportHac($dataToSave, $brokerUsers);

                echo ".................email sending finished<br />";
                exit;
            }
        }*/


        echo "<h1>Are you sure? Delete all share of $bo_irn ?</h1>";

        echo "<a href='http://www.new.stockbangladesh.net/Stations/emptyPortfolioHac/$bo_irn/1'>Confirm</a>";

        if($confirm) {
            $model->deleteAll("Portfolio.broker=$brokerId and PortfolioTransaction.portfolio_id=$pid", false);
            echo "All shares of $bo_irn are deleted : pid=$pid";
        }

        exit;


    }


    public function runTradeIns_test_xml($sent_email=0)
    {

       Configure::write('debug', 2);
        App::uses('CakeEmail', 'Network/Email');
        App::uses('CakeTime', 'Utility');


        $StockBangladesh = $this->Components->load('StockBangladesh');
        $ip = $StockBangladesh->getIp();
        $instrumentList = $StockBangladesh->instrumentList(2);

        $brokerId = Configure::read('broker.apex.id');
        if ($this->Auth->user('group_id') > 1) {  // if not super admin
            if ($brokerId != $this->Auth->user('broker_id')) {
                echo "This is not your house";
                exit;
            }
        }

        // generating file path
        $backdate="";
        $today = date('Y-m-d');
        $tradeins_file_path = Configure::read('broker.apex.tradeins_file_path');
        $fileArr = $StockBangladesh->scan_dir($tradeins_file_path);


        /* FOR UPDATE BACKDATED TRADEINS
        1. UNCOMMENTS FOLLOWING LINE ($fileArr[0] and  $today)
        2. CHANGE FILE NAME ACCORDING TO DESIRED DATE HERE
        4. set  $today to desired date (2015-02-09 format);

        IMPORTANT NOTE: IF  BACKDATED FILE MODIFIED, DATE CHANGED AND IT BECOMES LATEST. REGULAR TRADEINS RUNNING WILL TAKE THAT BACKDATED FILE.
        SO CONFIRM THAT LATEST FILE RE UPLOADED.
        */

        //$fileArr[0]='29-03-2015.xlsx';
        //$today = "2015-03-29";

        $fullFilePath = "$tradeins_file_path/" . $fileArr[0];
        $filename_dateArr=explode('.',$fileArr[0]);
        $reportDate = date('Y-m-d',strtotime($filename_dateArr[0]));



        if ($reportDate == '1970-01-01') {
            echo $fileArr[0];
            echo "<br/><br/>Correct date is not found in file name<br /> please write appropriate date in tradins file name <br/><h3> Example: 2015-02-17.xlsx or 02-17-2015.xlsx</h3>";
            // CakeEmail::deliver('info@stockbangladesh.com', 'Trade Ins problem-Apex', 'Date string can not be found', array('from' => 'omo@stockbangladesh.net'));
            exit;
        }

        if ($reportDate != $today) {
            echo $fileArr[0];
            echo "<br/>This is not today's file.<br/>";
            exit;
        }




        $Omo = $this->Components->load('Omo');
        $userList = $Omo->getUsersList(4, 1);

        $brokerUsers = array();
        foreach ($userList[11] as $irn => $arr) {
            $key = trim($irn);
            $key = str_pad($key, 5, "0", STR_PAD_LEFT);
            $key = strtoupper($key);
            $brokerUsers[$key] = $arr;
        }

        pr($fullFilePath);

        $xml=Xml::toArray(Xml::build($fullFilePath));

        $tradeArr = array();
     //   $xldata = $Omo->xlsToArray($fullFilePath, 8);
      //  unset($xldata[0]);

        foreach($xml['Trades']['Detail'] as $row)
        {
            if($row['@Status']=="FILL"||$row['@Status']=="PF")
            {
                $arrayData[]=$row;
            }
        }

        $dataToSaveForRaw = array();

        foreach ($arrayData as $row) {
            $temp = array();
            $tempForRaw = array();
            $internal_ref_no = trim($row['@ClientCode']);
            $internal_ref_no = strtoupper($internal_ref_no);
            $instrument_code = trim($row['@SecurityCode']);
            if( trim($row['@Side'])=="B")
                $transaction_type ='Buy';
            if( trim($row['@Side'])=="S")
                $transaction_type ='Sell';

            $transaction_time = trim($row['@Time']);
            //$transaction_time = PHPExcel_Style_NumberFormat::toFormattedString($transaction_time, 'DD/MM/YYYY hh:mm');
          //  $transaction_time = PHPExcel_Style_NumberFormat::toFormattedString($transaction_time, 'hh:mm:ss');

             $reportDate2 = date('Y/m/d',strtotime($row['@Date']));
             $transaction_time="$reportDate2 $transaction_time";

            $transaction_time = date("Y-m-d H:i:s", strtotime($transaction_time));
         //   $tradeStartDate = date("Y-m-d", strtotime($transaction_time));
        //    $tradeStart = "$tradeStartDate 10:30:00";
         //   $tradeEnd = "$tradeStartDate 14:30:00";

            //Back dated tradins need 5 hours adjustment. But todays script dont need any adjustment
/*
            if (($transaction_time >= $tradeStart) && ($transaction_time <= $tradeEnd)) {
                //trade time is ok. No action required
                 // pr("here 1 $transaction_time | $tradeStart  | $tradeEnd ");
            } else {
                //   pr("here 2 $transaction_time | $tradeStart  | $tradeEnd ");
                $transaction_time = date("Y-m-d H:i:s", strtotime("$transaction_time -5 hours"));  // usually five hours adjustment needed


            }*/


            $amount = trim($row['@Quantity']);
            $rate = trim($row['@Price']);
            $rate = (float)str_replace(',', '', $rate);
            $order_id = trim($row['@OrderID']);
            $execution_id = trim($row['@ExecID']);
            $execution_arr = explode('_', $execution_id);
            $execution_id = $execution_arr[count($execution_arr) - 1];

            $temp['instrument_code'] = $instrument_code;
            $temp['transaction_time'] = $transaction_time;
            $temp['transaction_type'] = $transaction_type;
            $temp['amount'] = $amount;
            $temp['rate'] = $rate;
            $temp['order_id'] = $order_id;
            $temp['execution_id'] = $execution_id;
            $tradeArr[$internal_ref_no][] = $temp;

            $rate = (float)str_replace(',', '', $rate);
            $tempForRaw['client_ac'] = trim($row['@ClientCode']);
            $tempForRaw['symbol'] = trim($row['@SecurityCode']);
            if( trim($row['@Side'])=="B")
                $tempForRaw['side'] ='Buy';
            if( trim($row['@Side'])=="S")
                $tempForRaw['side'] ='Sell';

           // $tempForRaw['order_qty'] = trim($row[3]);
          //  $tempForRaw['order_limit_price'] = trim($row[4]);
            $tempForRaw['substatus'] = trim($row['@Status']);
            $tempForRaw['execute_qty'] = trim($row['@Quantity']);
            $tempForRaw['execute_price'] = $rate;
            $tempForRaw['execute_time'] = $transaction_time;
            //$tempForRaw['execute_stat'] = trim($row[9]);
           // $tempForRaw['order_avg_price'] = trim($row[10]);
          //  $tempForRaw['ac_cds'] = trim($row[11]);
          //  $tempForRaw['counter_trader_id'] = trim($row[13]);
           // $tempForRaw['execute_type'] = trim($row[12]);
            $tempForRaw['execution_id'] = trim($row['@ExecID']);
            $tempForRaw['order_id'] = trim($row['@OrderID']);
            $tempForRaw['broker_id'] = $brokerId;
            if ($rate) {

                $dataToSaveForRaw[] = $tempForRaw;
            }

        }

        pr($dataToSaveForRaw);

        exit;

        $model = ClassRegistry::init('PortfolioTransaction');
        $dataToSave = array();
        $updateCounter = 0;


        foreach ($brokerUsers as $irn => $usr) {
            if (isset($tradeArr[$irn])) {

                foreach ($tradeArr[$irn] as $eachRealTransaction) {

                    $pid = $usr['portfolio_id'];
                    $broker_fee = $usr['broker_fee'];

                    $instrument_code = $eachRealTransaction['instrument_code'];
                    if ($eachRealTransaction['transaction_type'] == 'Sell') {
                        $transaction_type_id = 2; // sell
                    } else {
                        $transaction_type_id = 1; // buy
                    }

                    $temp = array();
                    $temp['portfolio_id'] = $pid;
                    $temp['instrument_id'] = $instrumentList[$instrument_code];
                    $temp['transaction_type_id'] = $transaction_type_id;
                    $temp['amount'] = abs($eachRealTransaction['amount']);
                    $temp['rate'] = $eachRealTransaction['rate'];
                    $temp['commission'] = $broker_fee;
                    $transaction_time = $eachRealTransaction['transaction_time'];
                    $temp['transaction_time'] = $transaction_time;
                    $temp['dse_order_id'] = $eachRealTransaction['order_id'];
                    $temp['dse_execution_id'] = $eachRealTransaction['execution_id'];

                    $dse_order_id = $eachRealTransaction['order_id'];
                    $dse_execution_id = $eachRealTransaction['execution_id'];

                    $transaction = $model->find('all', array(
                            'conditions' => "PortfolioTransaction.portfolio_id=$pid and PortfolioTransaction.dse_order_id LIKE '$dse_order_id' and PortfolioTransaction.dse_execution_id LIKE '$dse_execution_id'"
                        , 'recursive' => -1
                        )

                    );

                    if (count($transaction))  // if already exist
                    {
                        $updateCounter++;
                        $temp['id'] = $transaction[0]['PortfolioTransaction']['id'];  // setting primary id. So it will update instead of creating new
                    }

                    $dataToSave[] = $temp;
                }

            }

        }


        if($sent_email) {  // by force sending email only
            if ($reportDate == $today) {  // if it is today tradeins we will sent email
                echo "email sending........<br />";
                $this->emailReport($dataToSave, $brokerUsers);

                echo ".................email sending finished<br />";
                exit;
            }
        }

      //     pr($dataToSave);
//exit;
        if (count($dataToSave)) {
            $model->deleteAll("Portfolio.broker=$brokerId and PortfolioTransaction.dse_execution_id  LIKE  'temp'", false);
            $model->saveMany($dataToSave, array('atomic' => true));
            $n = (count($dataToSave) - $updateCounter);
            echo $n . 'rows inserted in portfolio transaction table and ' . $updateCounter . ' rows updated';
            /* echo "<pre>";
             print_r($dataToSave);*/
            CakeEmail::deliver('info@stockbangladesh.com', 'Trade Ins run sucessfuly-Apex', "$n rows inserted and $updateCounter rows updated in portfolio transaction table. Script run from $ip", array('from' => 'omo@stockbangladesh.net'));

            // setting $prev_execute_report_str to null so that nextdtay its count =0 (so that pass validation)
            App::uses('Broker', 'Model');
            $Broker = new Broker();
            $broker_id = $this->Auth->user('broker_id');
            $Broker->id = $broker_id;
            $prev_execute_report_str = null;
            $Broker->saveField('execute_report', $prev_execute_report_str);
        }
        $rawmodel = ClassRegistry::init('RawTradin');
        if (count($dataToSaveForRaw)) {

            $rawmodel->saveMany($dataToSaveForRaw, array('atomic' => true));
        }

        if($updateCounter==0) { // if this email was not sent previously
            if ($reportDate == $today) {  // if it is today tradeins we will sent email
                echo "email sending........<br />";
                $this->emailReport($dataToSave, $brokerUsers);

                echo ".................email sending finished<br />";
            }
        }
        else
        {
            echo "<br/>email previously sent <br />";

        }


        exit;


    }

    public function emailReport($allExecutedTransaction)
    {
        App::uses('CakeTime', 'Utility');
        App::uses('CakeEmail', 'Network/Email');
        $email  = new CakeEmail('smtp');

        App::uses('HtmlHelper', 'View/Helper');
        $yourTmpHtmlHelper = new HtmlHelper(new View());

        /*   echo $yourTmpHtmlHelper->tableCells(array(
               array('Jul 7th, 2007', 'Best Brownies', 'Yes'),
               array('Jun 21st, 2007', 'Smart Cookies', 'Yes'),
               array('Aug 1st, 2006', 'Anti-Java Cake', 'No'),
           ));

           exit;*/
        $allExecutedTransactionGroupByPortfolioId = Hash::combine($allExecutedTransaction, '{n}.id', '{n}', '{n}.portfolio_id');

        $StockBangladesh = $this->Components->load('StockBangladesh');
        $instrumentList = $StockBangladesh->instrumentList(3);

        $Omo = $this->Components->load('Omo');
        $userList = $Omo->getUsersList(3, 1);

        foreach ($allExecutedTransactionGroupByPortfolioId as $oneUserTrans) {

            $todayGrandTotal = 0;
            $userReport = '';
            $emailSubject = '';

            $oneUserTransGroupByTid = Hash::combine($oneUserTrans, '{n}.id', '{n}', '{n}.transaction_type_id');

            foreach ($oneUserTransGroupByTid as $transByTid) {
                $grandTotal = 0;
                $oneUserTransGroupByIns = Hash::combine($transByTid, '{n}.id', '{n}', '{n}.instrument_id');
                // pr($oneUserTransGroupByIns);

                foreach ($oneUserTransGroupByIns as $oneInsAllTrans) {
                    $totalAmounOfThisInstrument = 0;
                    $totalCostOfThisInstrument = 0;
                    $userReport .= "<table>";
                    $userReport .= $yourTmpHtmlHelper->tableHeaders(array('Quantity', 'Instrument code', 'Order type', ' Rate / price ', '    OrderId   ', '     ExecId    ', '   Transaction Time   '));
                    foreach ($oneInsAllTrans as $eachTrans) {
                        //pr($eachTrans);
                        $pid = $eachTrans['portfolio_id'];

                        $transaction_type_id = $eachTrans['transaction_type_id'];
                        $irn = $userList[$pid]['internal_ref_no'];
                        $useremail = $userList[$pid]['email'];
                        $username = $userList[$pid]['username'];
                        $irn = strtoupper($irn);
                        $amount = $eachTrans['amount'];
                        $rate = $eachTrans['rate'];
                        $instrument_id = $eachTrans['instrument_id'];
                        $instrument_code = $instrumentList[$instrument_id];
                        $transaction_time = $eachTrans['transaction_time'];

                        $transaction_time = CakeTime::nice($transaction_time);
                        $dse_order_id = $eachTrans['dse_order_id'];
                        $dse_execution_id = $eachTrans['dse_execution_id'];

                        $order = '';
                        $order_present = '';
                        if ($transaction_type_id == 1) {
                            $order = 'bought';
                            $order_present = 'buy';
                        } else {
                            $order = 'sold';
                            $order_present = 'sell';
                        }
                        $rep = $yourTmpHtmlHelper->tableCells(array(array($amount, $instrument_code, $order, $rate, $dse_order_id, $dse_execution_id, $transaction_time)));
                        $userReport .= $rep;
                        //    $rep="$amount $instrument_code $order at $rate Tk. DSE order ID=$dse_order_id, DSE execution ID=$dse_execution_id and transaction=$transaction_time<br/>";
                        //  $userReport="$userReport $rep";

                        $totalAmounOfThisInstrument += $amount;
                        $cost = $amount * $rate;
                        $totalCostOfThisInstrument += $cost;
                    }
                    $userReport .= "</table>";
                    $avg = $totalCostOfThisInstrument / $totalAmounOfThisInstrument;
                    $avg = number_format($avg, 2, '.', '');
                    $rep = "<h4>$totalAmounOfThisInstrument $instrument_code $order . Money spent $totalCostOfThisInstrument Tk and Average Cost was $avg Tk.</h4>";
                    $userReport .= $rep;

                    $grandTotal += $totalCostOfThisInstrument;
                    $grandTotal = number_format($grandTotal, 2, '.', '');
                }
                $rep = "<h3>Total $order_present transaction was $grandTotal Taka </h3>";
                $userReport .= $rep;

                $todayGrandTotal += $grandTotal;
                $sub = "$order $grandTotal Tk. | ";
                $sub = strtoupper($sub);
                $emailSubject .= $sub;
            }

            $todayGrandTotal = number_format($todayGrandTotal, 2, '.', '');
            $rep = "<h3>CONGRATULATIONS! YOU HAVE MADE $todayGrandTotal Tk. TRANSACTION (buy+sell) IN TOTAL</h3>";
            $userReport .= $rep;

            $sub = "Total Transaction $todayGrandTotal Tk. | Account: $irn.";
            $sub = strtoupper($sub);
            $emailSubject .= $sub;
             pr($userReport);


            if ($userReport != '') {
                $fullbody = "Dear $username, <br/> <br/>Here are today's confirm transactions of $irn account<br/><br/> $userReport <br/><br/>Thanks for trading with us<br/>StockBangladesh OMO PLUS Team";
                echo "$emailSubject <br/>";
                //   pr($fullbody);
                //CakeEmail::deliver($useremail, "$emailSubject", "$fullbody", array('from' => 'info@stockbangladesh.com', 'emailFormat' => 'html'));
                $email->to("$useremail")
                    ->subject("$emailSubject")
                    ->emailFormat('html')
                    ->send("$fullbody");

            }


        }
        //    exit;

    }



    public function runMargin2(){
        // Configure::write('debug', 2);
        App::uses('CakeTime', 'Utility');
        $brokerId = Configure::read('broker.apex.id');
        if ($this->Auth->user('group_id') > 1) {  // if not super admin
            if ($brokerId != $this->Auth->user('broker_id')) {
                echo "This is not your house";
                exit;
            }
        }

        $StockBangladesh = $this->Components->load('StockBangladesh');
        $margin_file_path = Configure::read('broker.apex.margin2_file_path');
        $fileArr = $StockBangladesh->scan_dir($margin_file_path);



        $today = CakeTime::nice(date ("F d Y"));
        $fullFilePath = "$margin_file_path/" . $fileArr[0];
        App::uses('CakeTime', 'Utility');
        $reportDate=CakeTime::nice(date ("F d Y", filemtime($fullFilePath)));

        if ($reportDate != $today) {
            echo $fileArr[0];
            echo "<br/>This is not today's file.<br/>";
            exit;
        }

        $Omo = $this->Components->load('Omo');

        $column=array('A','E');
        $xldata = $Omo->xlsToArrayForSpecificColumn($fullFilePath, $column);

       /* if (($key = array_search('Trading Code', $xldata)) !== false) {
            unset($xldata[$key]);
        }*/

        unset($xldata['Trading Code   ']);
        unset($xldata['Strictly Prohibited (Sponsor Share)']);
        unset($xldata['Strictly Prohibited (Z Category Share)']);
        unset($xldata['Non Marginable']);



        $fundamentalModel = ClassRegistry::init('Fundamental');
        $metaModel = ClassRegistry::init('Meta');


        $StockBangladesh = $this->Components->load('StockBangladesh');
        $instrumentList = $StockBangladesh->instrumentList(2);


        $metaIdSearch= $metaModel->find('all', array('conditions' =>array('Meta.meta_group_id'=>1,'Meta.meta_key'=>'apex_margin'), 'recursive' => -1));
        $metaId=$metaIdSearch[0] ['Meta']['id'];


        $insInfoSearch = $fundamentalModel->find('all', array('conditions' => array('Fundamental.instrument_id' => $instrumentList, 'Fundamental.meta_id' => $metaId), 'recursive' => -1));
        $insInfoSearch = Hash::combine($insInfoSearch, '{n}.Fundamental.instrument_id', '{n}.Fundamental.id');

        $marginCount=0;
        $nonMarginCount=0;


        foreach($instrumentList as $insCode=>$instrumentId)
        {
            if(isset($insInfoSearch[$instrumentId]))
                $fId =$insInfoSearch[$instrumentId];
            else
                $fId = '';

            if(isset($xldata[$insCode]))
            {
                $metaValue=1;
                $nonMarginCount++;
            }

            else
            {
                $metaValue=0;
                $marginCount++;
            }


            $dataToSave['id']=$fId;
            $dataToSave['instrument_id']=$instrumentId;
            $dataToSave['meta_id']=$metaId;
            $dataToSave['meta_value']=$metaValue;
            $dataToSave['meta_date']= date('Y-m-d');
            $dataToSave['created']=date('Y-m-d H:i:s');
            $dataToSave['updated']=date('Y-m-d H:i:s');

            $finalDataSave[]=$dataToSave;


        }


        if( $fundamentalModel->savemany($finalDataSave))
        {
            echo "<b>$today</b> <br> Margin/Non-margin Shares are marked <b>successfully</b> <br>";
            echo "Margin Shares:$marginCount <br>";
            echo "Non margin Shares:$nonMarginCount";
        }

        exit;

    }

    public function runLoan()
    {
        //  Configure::write('debug', 2);
        App::uses('CakeTime', 'Utility');
        $brokerId = Configure::read('broker.apex.id');
        if ($this->Auth->user('group_id') > 1) {  // if not super admin
            if ($brokerId != $this->Auth->user('broker_id')) {
                echo "This is not your house";
                exit;
            }
        }

        $loanCodeCount=0;
        $codeCount=0;
        $StockBangladesh = $this->Components->load('StockBangladesh');
        $loan_file_path = Configure::read('broker.apex.margin_file_path');
        $loanFileArr = $StockBangladesh->scan_dir($loan_file_path);
        $fullLoanFilePath = "$loan_file_path/" . $loanFileArr[0];



        $today = CakeTime::nice(date ("F d Y"));
        $fullFilePath = "$loan_file_path/" . $loanFileArr[0];
        App::uses('CakeTime', 'Utility');
        $reportDate=CakeTime::nice(date ("F d Y", filemtime($fullFilePath)));

        if ($reportDate != $today) {
            echo $fileArr[0];
            echo "<br/>This is not today's file.<br/>";
            exit;
        }



        $userModel = ClassRegistry::init('User');

        $Omo = $this->Components->load('Omo');

        $column=array('A');
        $xldata = $Omo->xlsToArrayForSpecificColumn($fullLoanFilePath, $column);

        unset($xldata['Investor Code']);
        unset($xldata['Active']);
        unset($xldata['Total :']);

        $userList= $Omo->getUsersList(5,1,$brokerId);


        foreach($userList as $irn=>$brokerInfo )
        {
            $irnPadding = str_pad($irn, 5, "0", STR_PAD_LEFT);
            $irnPadding = strtoupper($irnPadding);


            if(isset($xldata[$irnPadding]))
            {
                $loanCodeCount++;
                $loan=1;
            }
            else
            {
                $codeCount++;
                $loan=0;
            }

            $userModel->updateAll(array('User.loanCode' =>$loan),array('User.internal_ref_no' =>$irn,'User.broker_id' =>$brokerInfo));

        }


        echo "<b>$today</b> <br> Loan Codes are marked <b>successfully</b> <br>";
        echo "Normal Codes:$codeCount <br>";
        echo "Loan Codes:$loanCodeCount";

        exit;




    }
    ///////////////////////////////////////////////////////////////////for Apex broker House END////////////////////////////////////////////////////////////////////

    ///////////////////////////////////////////////////////////////////for Hac broker House////////////////////////////////////////////////////////////////////
    public function runTradeInsHac($sent_email=0)
    {

        // Configure::write('debug', 2);
        App::uses('CakeEmail', 'Network/Email');
        App::uses('CakeTime', 'Utility');


        pr("Hac");

        $StockBangladesh = $this->Components->load('StockBangladesh');
        $ip = $StockBangladesh->getIp();
        $instrumentList = $StockBangladesh->instrumentList(2);

        $brokerId = Configure::read('broker.hac.id');
        if ($this->Auth->user('group_id') > 1) {  // if not super admin
            if ($brokerId != $this->Auth->user('broker_id')) {
                echo "This is not your house";
                exit;
            }
        }

        // generating file path

        $tradeins_file_path = Configure::read('broker.hac.tradeins_file_path');
        $fileArr = $StockBangladesh->scan_dir($tradeins_file_path);




        $today = CakeTime::nice(date ("F d Y"));
        $fullFilePath = "$tradeins_file_path/" . $fileArr[0];
        App::uses('CakeTime', 'Utility');
        $reportDate=CakeTime::nice(date ("F d Y", filemtime($fullFilePath)));

        if ($reportDate != $today) {
            echo $fileArr[0];
            echo "<br/>This is not today's file.<br/>";
            exit;
        }







        $Omo = $this->Components->load('Omo');
        $userList = $Omo->getUsersList(4, 1);


        $brokerUsers = array();
        foreach ($userList[5] as $irn => $arr) {
            $key = trim($irn);
            $key = str_pad($key, 5, "0", STR_PAD_LEFT);
            $key = strtoupper($key);
            $brokerUsers[$key] = $arr;
        }


        $tradeArr = array();
        $xldata = $Omo->xlsToArray($fullFilePath, 8);


        $paternArray= array
        (
            '0' => 'Client A/C',
            '1' => 'Symbol',
            '2' => 'Side',
            '3' => 'OrderQty',
            '4' => 'OrdLimit',
            '5' => 'SubStatus',
            '6' => 'ExecQty',
            '7' => 'ExecPrice',
            '8' => 'ExecTime',
            '9' => 'ExecStat',
            '10' => 'OrdAvP',
            '11' => 'A/C CDS',
            '12' => 'ExecType',
            '13' => 'ExecID',
            '14' => 'TFOrderID'
        );

        if ($xldata[1] !== $paternArray)//chk order
        {


            echo"File Column order is not in correct format.";
            echo "Expected File Order Is: Client A/C => Symbol=> Side => OrderQty => OrdLimit => SubStatus => ExecQty => ExecPrice => ExecTime => ExecStat => OrdAvP => A/C CDS => ExecType => ExecID => TFOrderID";

            exit;

        }

        unset($xldata[0]);

        $dataToSaveForRaw = array();
        $reportDate = '';
        foreach ($xldata as $row) {
            $temp = array();
            $tempForRaw = array();
            $internal_ref_no = trim($row[0]);
            $internal_ref_no = strtoupper($internal_ref_no);
            $instrument_code = trim($row[1]);
            $transaction_type = trim($row[2]);

             $transaction_time = trim($row[8]);

             $transaction_time = PHPExcel_Style_NumberFormat::toFormattedString($transaction_time, 'hh:mm:ss');

            //$reportDate2 = '2015/09/15'; //for backdated tradeIns
            $reportDate2 = date('Y/m/d');


            $transaction_time="$reportDate2 $transaction_time";

            $transaction_time = date("Y-m-d H:i:s", strtotime($transaction_time));
            //pr($transaction_time);

            $amount = trim($row[6]);
            $rate = trim($row[7]);
            $rate = (float)str_replace(',', '', $rate);
            $order_id = trim($row[14]);
            $execution_id = trim($row[13]);
            $execution_arr = explode('_', $execution_id);
            $execution_id = $execution_arr[count($execution_arr) - 1];

            $temp['instrument_code'] = $instrument_code;
            $temp['transaction_time'] = $transaction_time;
            $temp['transaction_type'] = $transaction_type;
            $temp['amount'] = $amount;
            $temp['rate'] = $rate;
            $temp['order_id'] = $order_id;
            $temp['execution_id'] = $execution_id;
            $tradeArr[$internal_ref_no][] = $temp;


            $rate = (float)str_replace(',', '', $rate);
            $tempForRaw['client_ac'] = trim($row[0]);
            $tempForRaw['symbol'] = trim($row[1]);
            $tempForRaw['side'] = trim($row[2]);
            $tempForRaw['order_qty'] = trim($row[3]);
            $tempForRaw['order_limit_price'] = trim($row[4]);
            $tempForRaw['substatus'] = trim($row[5]);
            $tempForRaw['execute_qty'] = trim($row[6]);
            $tempForRaw['execute_price'] = $rate;
            $tempForRaw['execute_time'] = $transaction_time;
            $tempForRaw['execute_stat'] = trim($row[9]);
            $tempForRaw['order_avg_price'] = trim($row[10]);
            $tempForRaw['ac_cds'] = trim($row[11]);
            // $tempForRaw['counter_trader_id'] = trim($row[13]);
            $tempForRaw['execute_type'] = trim($row[12]);
            $tempForRaw['execution_id'] = trim($row[13]);
            $tempForRaw['order_id'] = trim($row[14]);
            $tempForRaw['broker_id'] = $brokerId;
            if ($rate) {
                $reportDate = $transaction_time;
                $dataToSaveForRaw[] = $tempForRaw;
            }
        }

        $model = ClassRegistry::init('PortfolioTransaction');
        $model2 = ClassRegistry::init('PortfolioShare');
        $dataToSave = array();
        $updateCounter = 0;

        foreach ($brokerUsers as $irn => $usr) {

            if (isset($tradeArr[$irn])) {

                // pr("set");
                foreach ($tradeArr[$irn] as $eachRealTransaction) {

                    $pid = $usr['portfolio_id'];
                    $broker_fee = $usr['broker_fee'];

                    $instrument_code = $eachRealTransaction['instrument_code'];
                    if ($eachRealTransaction['transaction_type'] == 'Sell') {
                        $transaction_type_id = 2; // sell
                    } else {
                        $transaction_type_id = 1; // buy
                    }

                    $temp = array();
                    $temp['portfolio_id'] = $pid;
                    $temp['instrument_id'] = $instrumentList[$instrument_code];
                    $temp['transaction_type_id'] = $transaction_type_id;
                    $temp['amount'] = abs($eachRealTransaction['amount']);
                    $temp['rate'] = $eachRealTransaction['rate'];
                    $temp['commission'] = $broker_fee;
                    $transaction_time = $eachRealTransaction['transaction_time'];
                    $temp['transaction_time'] = $transaction_time;
                    $temp['dse_order_id'] = $eachRealTransaction['order_id'];
                    $temp['dse_execution_id'] = $eachRealTransaction['execution_id'];

                    $dse_order_id = $eachRealTransaction['order_id'];
                    $dse_execution_id = $eachRealTransaction['execution_id'];

                    $transaction = $model->find('all', array(
                            'conditions' => "PortfolioTransaction.portfolio_id=$pid and PortfolioTransaction.dse_order_id LIKE '$dse_order_id' and PortfolioTransaction.dse_execution_id LIKE '$dse_execution_id'"
                        , 'recursive' => -1
                        )

                    );

                    if (count($transaction))  // if already exist
                    {
                        $updateCounter++;
                        $temp['id'] = $transaction[0]['PortfolioTransaction']['id'];  // setting primary id. So it will update instead of creating new
                    }

                    $dataToSave[] = $temp;
                }

            }

        }


      if($sent_email) {  // by force sending email only
            if ($reportDate == $today) {  // if it is today tradeins we will sent email
                echo "email sending........<br />";
                $this->emailReportHac($dataToSave, $brokerUsers);

                echo ".................email sending finished<br />";
                exit;
            }
        }


        if (count($dataToSave)) {

            $model->deleteAll("Portfolio.broker=$brokerId and PortfolioTransaction.dse_execution_id  LIKE  'temp'", false);
            $model->saveMany($dataToSave, array('atomic' => true));
            $n = (count($dataToSave) - $updateCounter);
            echo $n . 'rows inserted in portfolio transaction table and ' . $updateCounter . ' rows updated';

            //CakeEmail::deliver('info@stockbangladesh.com', "Trade Ins of $reportDate2 HAC run successfully", "$n rows inserted and $updateCounter rows updated in portfolio transaction table. Script run from $ip", array('from' => 'omo@stockbangladesh.net'));

            $email  = new CakeEmail('smtp');
            $email->to('info@stockbangladesh.com')
                ->subject("Trade Ins of $reportDate2 HAC run successfully")
                ->send("$n rows inserted and $updateCounter rows updated in portfolio transaction table. Script run from $ip");



        }

        // for testing system portfolioshares

        if (count($dataToSave)) {

            App::uses('CakeTime', 'Utility');
            $processing_date=date('d-m-Y'); // processing date normally is today. In exceptional case it can be backdate
            $tradeDateCondition = CakeTime::dayAsSql($processing_date, 'PortfolioShare.transaction_time');
            $model2->deleteAll("Portfolio.broker=$brokerId and $tradeDateCondition", false); // deleting all previous entry of processing date

            $model2->saveMany($dataToSave, array('atomic' => true));
            $n = (count($dataToSave) - $updateCounter);
            echo $n . 'rows inserted in portfolio share table and ' . $updateCounter . ' rows updated';

            CakeEmail::deliver('info@stockbangladesh.com', "Portfolio Share Trade Ins of $reportDate2 HAC run successfully", "$n rows inserted and $updateCounter rows updated in portfolio share table. Script run from $ip", array('from' => 'omo@stockbangladesh.net'));
            // CakeEmail::deliver('raihan.it@stockbangladesh.com', "Trade Ins of $reportDate2 HAC run successfully", "$n rows inserted and $updateCounter rows updated in portfolio transaction table. Script run from $ip", array('from' => 'omo@stockbangladesh.net'));


        }


        $rawmodel = ClassRegistry::init('RawTradin');
        if (count($dataToSaveForRaw)) {

          if($rawmodel->saveMany($dataToSaveForRaw, array('atomic' => true)))
          {
              $count=count($dataToSaveForRaw);
              pr($fileArr[0]);
              echo"saved $count ";
          }
        }

        if($updateCounter==0) { // if this email was not sent previously
            if ($reportDate == $today) {  // if it is today tradeins we will sent email
                echo "email sending........<br />";
                $this->emailReportHac($dataToSave, $brokerUsers);

                echo ".................email sending finished<br />";
            }
        }
        else
        {
            echo "<br/>email previously sent <br />";

        }


         // deleting all existing file

       /* $dir = 'hac/tradeins/*';

        $files = glob($dir); // get all file names
        foreach ($files as $file) { // iterate files
            if (is_file($file))
                unlink($file); // delete file
        }*/


        exit;

    }
    public function emailReportHac($allExecutedTransaction)
    {
       // Configure::write('debug', 2);
        App::uses('CakeTime', 'Utility');
        App::uses('CakeEmail', 'Network/Email');

        App::uses('HtmlHelper', 'View/Helper');
        $yourTmpHtmlHelper = new HtmlHelper(new View());

        /*   echo $yourTmpHtmlHelper->tableCells(array(
               array('Jul 7th, 2007', 'Best Brownies', 'Yes'),
               array('Jun 21st, 2007', 'Smart Cookies', 'Yes'),
               array('Aug 1st, 2006', 'Anti-Java Cake', 'No'),
           ));

           exit;*/
        $allExecutedTransactionGroupByPortfolioId = Hash::combine($allExecutedTransaction, '{n}.id', '{n}', '{n}.portfolio_id');

        $StockBangladesh = $this->Components->load('StockBangladesh');
        $instrumentList = $StockBangladesh->instrumentList(3);

        $Omo = $this->Components->load('Omo');
        $userList = $Omo->getUsersList(3, 1);

        foreach ($allExecutedTransactionGroupByPortfolioId as $oneUserTrans) {

            $todayGrandTotal = 0;
            $userReport = '';
            $emailSubject = '';

            $oneUserTransGroupByTid = Hash::combine($oneUserTrans, '{n}.id', '{n}', '{n}.transaction_type_id');

            foreach ($oneUserTransGroupByTid as $transByTid) {
                $grandTotal = 0;
                $oneUserTransGroupByIns = Hash::combine($transByTid, '{n}.id', '{n}', '{n}.instrument_id');
                // pr($oneUserTransGroupByIns);

                foreach ($oneUserTransGroupByIns as $oneInsAllTrans) {
                    $totalAmounOfThisInstrument = 0;
                    $totalCostOfThisInstrument = 0;
                    $userReport .= "<table>";
                    $userReport .= $yourTmpHtmlHelper->tableHeaders(array('Quantity', 'Instrument code', 'Order type', ' Rate / price ', '    OrderId   ', '     ExecId    ', '   Transaction Time   '));
                    foreach ($oneInsAllTrans as $eachTrans) {
                        //pr($eachTrans);
                        $pid = $eachTrans['portfolio_id'];

                        $transaction_type_id = $eachTrans['transaction_type_id'];
                        $irn = $userList[$pid]['internal_ref_no'];
                        $useremail = $userList[$pid]['email'];
                        $username = $userList[$pid]['username'];
                        $irn = strtoupper($irn);
                        $amount = $eachTrans['amount'];
                        $rate = $eachTrans['rate'];
                        $instrument_id = $eachTrans['instrument_id'];
                        $instrument_code = $instrumentList[$instrument_id];
                        $transaction_time = $eachTrans['transaction_time'];

                        $transaction_time = CakeTime::nice($transaction_time);
                        $dse_order_id = $eachTrans['dse_order_id'];
                        $dse_execution_id = $eachTrans['dse_execution_id'];

                        $order = '';
                        $order_present = '';
                        if ($transaction_type_id == 1) {
                            $order = 'bought';
                            $order_present = 'buy';
                        } else {
                            $order = 'sold';
                            $order_present = 'sell';
                        }
                        $rep = $yourTmpHtmlHelper->tableCells(array(array($amount, $instrument_code, $order, $rate, $dse_order_id, $dse_execution_id, $transaction_time)));
                        $userReport .= $rep;
                        //    $rep="$amount $instrument_code $order at $rate Tk. DSE order ID=$dse_order_id, DSE execution ID=$dse_execution_id and transaction=$transaction_time<br/>";
                        //  $userReport="$userReport $rep";

                        $totalAmounOfThisInstrument += $amount;
                        $cost = $amount * $rate;
                        $totalCostOfThisInstrument += $cost;
                    }
                    $userReport .= "</table>";
                    $avg = $totalCostOfThisInstrument / $totalAmounOfThisInstrument;
                    $avg = number_format($avg, 2, '.', '');
                    $rep = "<h4>$totalAmounOfThisInstrument $instrument_code $order . Money spent $totalCostOfThisInstrument Tk and Average Cost was $avg Tk.</h4>";
                    $userReport .= $rep;

                    $grandTotal += $totalCostOfThisInstrument;
                    $grandTotal = number_format($grandTotal, 2, '.', '');
                }
                $rep = "<h3>Total $order_present transaction was $grandTotal Taka </h3>";
                $userReport .= $rep;

                $todayGrandTotal += $grandTotal;
                $sub = "$order $grandTotal Tk. | ";
                $sub = strtoupper($sub);
                $emailSubject .= $sub;
            }

            $todayGrandTotal = number_format($todayGrandTotal, 2, '.', '');
            $rep = "<h3>CONGRATULATIONS! YOU HAVE MADE $todayGrandTotal Tk. TRANSACTION (buy+sell) IN TOTAL</h3>";
            $userReport .= $rep;

            $sub = "Total Transaction $todayGrandTotal Tk. | Account: $irn.";
            $sub = strtoupper($sub);
            $emailSubject .= $sub;
           //  pr($userReport);


            if ($userReport != '') {
                $fullbody = "Dear $username, <br/> <br/>Here are today's confirm transactions of $irn account<br/><br/> $userReport <br/><br/>Thanks for trading with us<br/>StockBangladesh OMO PLUS Team";
                echo "$emailSubject <br/>";

               // CakeEmail::deliver($useremail, "$emailSubject", "$fullbody", array('from' => 'info@stockbangladesh.com', 'emailFormat' => 'html'));//info@stockbangladesh.com

                $email  = new CakeEmail('smtp');
                $email->to("$useremail")
                    ->subject("$emailSubject")
                    ->emailFormat('html')
                    ->send("$fullbody");

            }


        }

    }
    public function runBalanceHac()
    {

        $StockBangladesh = $this->Components->load('StockBangladesh');

     //   $StockBangladesh->send_sms('8801552573043', 'SMS Balance');
     //   exit;

        // checking if user is allowed to do so
        $brokerId = Configure::read('broker.hac.id');
        if ($this->Auth->user('group_id') > 1) {  // if not super admin
            if ($brokerId != $this->Auth->user('broker_id')) {
                echo "This is not your house";
                exit;
            }
        }

        // generating file path
        $balance_file_path = Configure::read('broker.hac.balance_file_path');
        $fileArr = $StockBangladesh->scan_dir($balance_file_path);
        pr("HAC");


        App::uses('CakeTime', 'Utility');

        $today = CakeTime::nice(date ("F d Y"));
        $fullFilePath = "$balance_file_path/" . $fileArr[0];

        $reportDate=CakeTime::nice(date ("F d Y", filemtime($fullFilePath)));

        if ($reportDate != $today) {
            echo $fileArr[0];
            echo "<br/>This is not today's file.<br/>";
            exit;
        }



        // reading file
        $file = fopen($fullFilePath, "r");
        $powerArr = array();


        while (!feof($file)) { //
            $row = fgetcsv($file);
            if(strpos($row[0],'Code'))
            {
                $pattern=$row;
               // pr($row);

            }
            $internal_ref_no = trim($row[0]);
            $internal_ref_no = strtoupper($internal_ref_no);
            $powerArr[$internal_ref_no]['purchase_power'] = $row[18];
        }

        //pr($pattern);

        $patternArray= array
        (
            0 => 'Investor Code',
            1 => 'Investor Name',
            2 => '',
            3 => '',
            4 => '',
            5 => 'Loan Ratio',
            6 => '',
            7 => '',
            8 => '',
            9 => 'Market Value of Securities',
            10 => '',
            11 => '',
            12 =>'' ,
            13 => 'Ledger Balance',
            14 => '',
            15 => '',
            16 => 'Purchase Power',
            17 => '',
            18 => '',
            19 => '',
            20 => 'Available Balance',
            21 => '',
            22 => '',
        );

      /*  pr($pattern);
        pr($patternArray);
        exit;*/

        if ($pattern !== $patternArray)//chk order
        {


            echo"File Column order is not in correct format.";
            echo "Expected File Order Is: Investor Code => Investor Name=> Loan Ratio => Market Value of Securities => Ledger Balance =>Purchase Power => Available Balance";

            exit;

        }


        // preparing inr according to hac format (pading leading zero)

        $Omo = $this->Components->load('Omo');
        $userList = $Omo->getUsersList(4, 1);
        $brokerUsers = array();
        foreach ($userList[$brokerId] as $irn => $arr) {
            $key = trim($irn);
            $key = str_pad($key, 5, "0", STR_PAD_LEFT);
            $key = strtoupper($key);
            $brokerUsers[$key] = $arr;
        }


        $dataToSave2 = array();
        foreach ($brokerUsers as $irn => $usr) {
            if (isset($powerArr[$irn])) {
                $pid = $usr['portfolio_id'];
                $id = $usr['id']; //userid
                $balance = $usr['balance'];

                $ppower = $powerArr[$irn]['purchase_power'];
                $ppower = (float)str_replace(',', '', $ppower);

                /*  $deposit = $powerArr[$irn]['deposit'];
                  $deposit = (float)str_replace(',', '', $deposit);

                  $withdraw = $powerArr[$irn]['withdraw'];
                  $withdraw = (float)str_replace(',', '', $withdraw);

                  $realized = $powerArr[$irn]['realized'];
                  $realized = (float)str_replace(',', '', $realized);*/



                // update portfolio table balance
                $temp2 = array();
                $temp2['id'] = $pid;
                /* $temp2['total_deposit'] = $deposit;
                 $temp2['total_withdraw'] = $withdraw;
                 $temp2['total_realized'] = $realized;*/
                $temp2['total_stats_updated'] = date('Y-m-d H:i:s');
                $temp2['balance'] = $ppower;

                $dataToSave2[] = $temp2;
                // }
            }

        }


        $model2 = ClassRegistry::init('Portfolio');


        if (count($dataToSave2)) {
            $model2->saveMany($dataToSave2, array('atomic' => true));
            echo count($dataToSave2) . ' balanace updated';


            $rt = Router::url('/', true) . "Stations/runWithdrawDeposit";

            echo "<br /><a target='_blank' href='$rt'><h3>Run Withdraw/Deposit Script</h3></a> <br />";
        }

        /*
                    // deleting all existing file

                      $dir = 'hac/balance/*';

                      $files = glob($dir); // get all file names
                      foreach ($files as $file) { // iterate files
                          if (is_file($file))
                              unlink($file); // delete file
                      }

        */



exit;


    }

    public function runMarginHac(){
        //Configure::write('debug', 2);
        App::uses('CakeTime', 'Utility');
        $brokerId = Configure::read('broker.hac.id');
        if ($this->Auth->user('group_id') > 1) {  // if not super admin
            if ($brokerId != $this->Auth->user('broker_id')) {
                echo "This is not your house";
                exit;
            }
        }

        $StockBangladesh = $this->Components->load('StockBangladesh');
        $margin_file_path = Configure::read('broker.hac.margin_file_path');
        $fileArr = $StockBangladesh->scan_dir($margin_file_path);



        $today = CakeTime::nice(date ("F d Y"));
        $fullFilePath = "$margin_file_path/" . $fileArr[0];
        App::uses('CakeTime', 'Utility');
        $reportDate=CakeTime::nice(date ("F d Y", filemtime($fullFilePath)));

      /*  if ($reportDate != $today) {
             echo $fileArr[0];
             echo "<br/>This is not today's file.<br/>";
             exit;
         }*/

        $Omo = $this->Components->load('Omo');

        $column=array('P','S','V');
        $xldata = $Omo->xlsToArrayForSpecificColumn($fullFilePath, $column);

        if (($key = array_search('Name', $xldata)) !== false) {
            unset($xldata[$key]);
        }



        $fundamentalModel = ClassRegistry::init('Fundamental');
        $metaModel = ClassRegistry::init('Meta');


        $StockBangladesh = $this->Components->load('StockBangladesh');
        $instrumentList = $StockBangladesh->instrumentList(2);


        $metaIdSearch= $metaModel->find('all', array('conditions' =>array('Meta.meta_group_id'=>1,'Meta.meta_key'=>'hac_margin'), 'recursive' => -1));
        $metaId=$metaIdSearch[0] ['Meta']['id'];


        $insInfoSearch = $fundamentalModel->find('all', array('conditions' => array('Fundamental.instrument_id' => $instrumentList, 'Fundamental.meta_id' => $metaId), 'recursive' => -1));
        $insInfoSearch = Hash::combine($insInfoSearch, '{n}.Fundamental.instrument_id', '{n}.Fundamental.id');

        $marginCount=0;
        $nonMarginCount=0;


        foreach($instrumentList as $insCode=>$instrumentId)
        {
            if(isset($insInfoSearch[$instrumentId]))
                $fId =$insInfoSearch[$instrumentId];
            else
                $fId = '';

            if(isset($xldata[$insCode]))
            {
                $metaValue=1;
                $nonMarginCount++;
            }

            else
            {
                $metaValue=0;
                $marginCount++;
            }


            $dataToSave['id']=$fId;
            $dataToSave['instrument_id']=$instrumentId;
            $dataToSave['meta_id']=$metaId;
            $dataToSave['meta_value']=$metaValue;
            $dataToSave['meta_date']= date('Y-m-d');
            $dataToSave['created']=date('Y-m-d H:i:s');
            $dataToSave['updated']=date('Y-m-d H:i:s');

            $finalDataSave[]=$dataToSave;


        }


       if( $fundamentalModel->savemany($finalDataSave))
       {
           echo "<b>$today</b> <br> Margin/Non-margin Shares are marked <b>successfully</b> <br>";
           echo "Margin Shares:$marginCount <br>";
           echo "Non margin Shares:$nonMarginCount";
       }

        exit;

    }

    public function runLoanHac()
    {
      //  Configure::write('debug', 2);
        App::uses('CakeTime', 'Utility');
        $brokerId = Configure::read('broker.hac.id');
        if ($this->Auth->user('group_id') > 1) {  // if not super admin
            if ($brokerId != $this->Auth->user('broker_id')) {
                echo "This is not your house";
                exit;
            }
        }

        $loanCodeCount=0;
        $codeCount=0;
        $StockBangladesh = $this->Components->load('StockBangladesh');
        $loan_file_path = Configure::read('broker.hac.loan_file_path');
        $loanFileArr = $StockBangladesh->scan_dir($loan_file_path);
        $fullLoanFilePath = "$loan_file_path/" . $loanFileArr[0];



        $today = CakeTime::nice(date ("F d Y"));
        $fullFilePath = "$loan_file_path/" . $loanFileArr[0];
        App::uses('CakeTime', 'Utility');
        $reportDate=CakeTime::nice(date ("F d Y", filemtime($fullFilePath)));


/*
          if ($reportDate != $today) {
              echo $fileArr[0];
              echo "<br/>This is not today's file.<br/>";
              exit;
          }*/



        $userModel = ClassRegistry::init('User');

        $Omo = $this->Components->load('Omo');

        $column=array('C');
        $xldata = $Omo->xlsToArrayForSpecificColumn($fullLoanFilePath, $column);

        unset($xldata['Code']);

        $userList= $Omo->getUsersList(5,1,$brokerId);


        foreach($userList as $irn=>$brokerInfo )
        {

            if(isset($xldata[$irn]))
            {
                $loanCodeCount++;
                $loan=1;
            }
            else
            {
                $codeCount++;
                $loan=0;
            }

            $userModel->updateAll(array('User.loanCode' =>$loan),array('User.internal_ref_no' =>$irn,'User.broker_id' =>$brokerInfo));

        }


        echo "<b>$today</b> <br> Loan Codes are marked <b>successfully</b> <br>";
        echo "Normal Codes:$codeCount <br>";
        echo "Loan Codes:$loanCodeCount";

        exit;




    }

    ///////////////////////////////////////////////////////////////////for Hac broker House END////////////////////////////////////////////////////////////////////

    ///////////////////////////////////////////////////////////////////for Sharp broker House////////////////////////////////////////////////////////////////////
    public function runTradeInsSharp($sent_email=0)
    {

        Configure::write('debug', 2);
        App::uses('CakeEmail', 'Network/Email');
        App::uses('CakeTime', 'Utility');


        pr("Sharp");

        $StockBangladesh = $this->Components->load('StockBangladesh');
        $ip = $StockBangladesh->getIp();
        $instrumentList = $StockBangladesh->instrumentList(2);

        $brokerId = Configure::read('broker.sharp.id');
        if ($this->Auth->user('group_id') > 1) {  // if not super admin
            if ($brokerId != $this->Auth->user('broker_id')) {
                echo "This is not your house";
                exit;
            }
        }

        // generating file path
        $tradeins_file_path = Configure::read('broker.sharp.tradeins_file_path');
        $fileArr = $StockBangladesh->scan_dir($tradeins_file_path);




        $today = CakeTime::nice(date ("F d Y"));
        $fullFilePath = "$tradeins_file_path/" . $fileArr[0];
        App::uses('CakeTime', 'Utility');
        $reportDate=CakeTime::nice(date ("F d Y", filemtime($fullFilePath)));

        if ($reportDate != $today) {
            echo $fileArr[0];
            echo "<br/>This is not today's file.<br/>";
            exit;
        }

        $Omo = $this->Components->load('Omo');
        $userList = $Omo->getUsersList(4, 1);


        $brokerUsers = array();
        foreach ($userList[$brokerId] as $irn => $arr) {
            $key = trim($irn);
            $key = str_pad($key, 5, "0", STR_PAD_LEFT);
            $key = strtoupper($key);
            $brokerUsers[$key] = $arr;
        }


        //  pr($fullFilePath);

        $tradeArr = array();
        $xldata = $Omo->xlsToArray($fullFilePath, 8);

        $paternArray= array
        (
            '0' => 'Client A/C',
            '1' => 'Symbol',
            '2' => 'Side',
            '3' => 'OrderQty',
            '4' => 'OrdLimit',
            '5' => 'SubStatus',
            '6' => 'ExecQty',
            '7' => 'ExecPrice',
            '8' => 'ExecTime',
            '9' => 'ExecStat',
            '10' => 'OrdAvP',
            '11' => 'A/C CDS',
            '12' => 'ExecType',
            '13' => 'ExecID',
            '14' => 'TFOrderID'
        );

        if ($xldata[1] !== $paternArray)//chk order
        {


            echo"File Column order is not in correct format.";
            echo "Expected File Order Is: Client A/C => Symbol=> Side => OrderQty => OrdLimit => SubStatus => ExecQty => ExecPrice => ExecTime => ExecStat => OrdAvP => A/C CDS => ExecType => ExecID => TFOrderID";

            exit;

        }

        unset($xldata[0]);

        $dataToSaveForRaw = array();
        $reportDate = '';
        foreach ($xldata as $row) {
            $temp = array();
            $tempForRaw = array();
            $internal_ref_no = trim($row[0]);
            $internal_ref_no = strtoupper($internal_ref_no);
            $internal_ref_no=str_pad($internal_ref_no, 5, "0", STR_PAD_LEFT);
            $instrument_code = strtoupper(trim($row[1]));
            $transaction_type = trim($row[2]);

            $transaction_time = trim($row[8]);

            $transaction_time = PHPExcel_Style_NumberFormat::toFormattedString($transaction_time, 'hh:mm:ss');

            // $reportDate2 = '2016/07/31'; //for backdated tradeIns


            $reportDate2 = date('Y/m/d');


            $transaction_time="$reportDate2 $transaction_time";

            $transaction_time = date("Y-m-d H:i:s", strtotime($transaction_time));
            //pr($transaction_time);

            $amount = trim($row[6]);
            $rate = trim($row[7]);
            $rate = (float)str_replace(',', '', $rate);
            $order_id = trim($row[14]);
            $execution_id = trim($row[13]);
            $execution_arr = explode('_', $execution_id);
            $execution_id = $execution_arr[count($execution_arr) - 1];


            $temp['instrument_code'] = $instrument_code;
            $temp['transaction_time'] = $transaction_time;
            $temp['transaction_type'] = $transaction_type;
            $temp['amount'] = $amount;
            $temp['rate'] = $rate;
            $temp['order_id'] = $order_id;
            $temp['execution_id'] = $execution_id;
            $tradeArr[$internal_ref_no][] = $temp;

            //$rate = (float)str_replace(',', '', $rate);
            $tempForRaw['client_ac'] = trim($row[0]);
            $tempForRaw['symbol'] = trim($row[1]);
            $tempForRaw['side'] = trim($row[2]);
            $tempForRaw['order_qty'] = trim($row[3]);
            $tempForRaw['order_limit_price'] = trim($row[4]);
            $tempForRaw['substatus'] = trim($row[5]);
            $tempForRaw['execute_qty'] = trim($row[6]);
            $tempForRaw['execute_price'] = $rate;
            $tempForRaw['execute_time'] = $transaction_time;
            $tempForRaw['execute_stat'] = trim($row[9]);
            $tempForRaw['order_avg_price'] = trim($row[10]);
            $tempForRaw['ac_cds'] = trim($row[11]);
            $tempForRaw['execute_type'] = trim($row[12]);
            $tempForRaw['execution_id'] = trim($row[13]);
            $tempForRaw['order_id'] = trim($row[14]);
            $tempForRaw['broker_id'] = $brokerId;
            if ($rate) {
                $reportDate = $transaction_time;
                $dataToSaveForRaw[] = $tempForRaw;
            }
        }



        $model = ClassRegistry::init('PortfolioTransaction');
        $dataToSave = array();
        $updateCounter = 0;


        foreach ($brokerUsers as $irn => $usr) {

            if (isset($tradeArr[$irn])) {

                // pr("set");
                foreach ($tradeArr[$irn] as $eachRealTransaction) {

                    $pid = $usr['portfolio_id'];
                    $broker_fee = $usr['broker_fee'];

                    $instrument_code = $eachRealTransaction['instrument_code'];
                    if ($eachRealTransaction['transaction_type'] == 'Sell') {
                        $transaction_type_id = 2; // sell
                    } else {
                        $transaction_type_id = 1; // buy
                    }

                    $temp = array();
                    $temp['portfolio_id'] = $pid;
                    $temp['instrument_id'] = $instrumentList[$instrument_code];
                    $temp['transaction_type_id'] = $transaction_type_id;
                    $temp['amount'] = abs($eachRealTransaction['amount']);
                    $temp['rate'] = $eachRealTransaction['rate'];
                    $temp['commission'] = $broker_fee;
                    $transaction_time = $eachRealTransaction['transaction_time'];
                    $temp['transaction_time'] = $transaction_time;
                    $temp['dse_order_id'] = $eachRealTransaction['order_id'];
                    $temp['dse_execution_id'] = $eachRealTransaction['execution_id'];

                    $dse_order_id = $eachRealTransaction['order_id'];
                    $dse_execution_id = $eachRealTransaction['execution_id'];

                    $transaction = $model->find('all', array(
                           // 'conditions' => "PortfolioTransaction.portfolio_id=$pid and PortfolioTransaction.dse_order_id LIKE '$dse_order_id'"
                            'conditions' => "PortfolioTransaction.portfolio_id=$pid and PortfolioTransaction.dse_order_id LIKE '$dse_order_id' and PortfolioTransaction.dse_execution_id LIKE '$dse_execution_id'"
                        , 'recursive' => -1
                        )

                    );

                    if (count($transaction))  // if already exist
                    {
                        $updateCounter++;
                        $temp['id'] = $transaction[0]['PortfolioTransaction']['id'];  // setting primary id. So it will update instead of creating new
                    }

                    $dataToSave[] = $temp;
                }

            }

        }

        if($sent_email) {  // by force sending email only
            if ($reportDate == $today) {  // if it is today tradeins we will sent email
                echo "email sending........<br />";
                $this->emailReportSharp($dataToSave, $brokerUsers);

                echo ".................email sending finished<br />";
                exit;
            }
        }



        if (count($dataToSave)) {
            $model->deleteAll("Portfolio.broker=$brokerId and PortfolioTransaction.dse_execution_id  LIKE  'temp'", false);
            $model->saveMany($dataToSave, array('atomic' => true));
            $n = (count($dataToSave) - $updateCounter);
            echo $n . 'rows inserted in portfolio transaction table and ' . $updateCounter . ' rows updated';
            /* echo "<pre>";
             print_r($dataToSave);*///
            //CakeEmail::deliver('info@stockbangladesh.com', "Trade Ins of $reportDate2 Sharp run successfully", "$n rows inserted and $updateCounter rows updated in portfolio transaction table. Script run from $ip", array('from' => 'omo@stockbangladesh.net'));

            $email  = new CakeEmail('smtp');
            $email->to('info@stockbangladesh.com')
                ->subject("Trade Ins of $reportDate2 Sharp run successfully")
                ->send("$n rows inserted and $updateCounter rows updated in portfolio transaction table. Script run from $ip");
            // CakeEmail::deliver('raihan.it@stockbangladesh.com', "Trade Ins of $reportDate2 Sharp run successfully", "$n rows inserted and $updateCounter rows updated in portfolio transaction table. Script run from $ip", array('from' => 'omo@stockbangladesh.net'));

        }
        $rawmodel = ClassRegistry::init('RawTradin');
        if (count($dataToSaveForRaw)) {

            $rawmodel->saveMany($dataToSaveForRaw, array('atomic' => true));
        }
        if($updateCounter==0) { // if this email was not sent previously
            if ($reportDate == $today) {  // if it is today tradeins we will sent email
                echo "email sending........<br />";
                $this->emailReportSharp($dataToSave, $brokerUsers);

                echo ".................email sending finished<br />";
            }
        }
        else
        {
            echo "<br/>email previously sent <br />";

        }


        // deleting all existing file

        /*  $dir = 'sharp/tradeins/*';

          $files = glob($dir); // get all file names
          foreach ($files as $file) { // iterate files
              if (is_file($file))
                  unlink($file); // delete file
          }

  */
        exit;

    }
    public function emailReportSharp($allExecutedTransaction)
    {
        // Configure::write('debug', 2);
        App::uses('CakeTime', 'Utility');
        App::uses('CakeEmail', 'Network/Email');

        App::uses('HtmlHelper', 'View/Helper');
        $yourTmpHtmlHelper = new HtmlHelper(new View());

        /*   echo $yourTmpHtmlHelper->tableCells(array(
               array('Jul 7th, 2007', 'Best Brownies', 'Yes'),
               array('Jun 21st, 2007', 'Smart Cookies', 'Yes'),
               array('Aug 1st, 2006', 'Anti-Java Cake', 'No'),
           ));

           exit;*/
        $allExecutedTransactionGroupByPortfolioId = Hash::combine($allExecutedTransaction, '{n}.id', '{n}', '{n}.portfolio_id');

        $StockBangladesh = $this->Components->load('StockBangladesh');
        $instrumentList = $StockBangladesh->instrumentList(3);

        $Omo = $this->Components->load('Omo');
        $userList = $Omo->getUsersList(3, 1);

        foreach ($allExecutedTransactionGroupByPortfolioId as $oneUserTrans) {

            $todayGrandTotal = 0;
            $userReport = '';
            $emailSubject = '';

            $oneUserTransGroupByTid = Hash::combine($oneUserTrans, '{n}.id', '{n}', '{n}.transaction_type_id');

            foreach ($oneUserTransGroupByTid as $transByTid) {
                $grandTotal = 0;
                $oneUserTransGroupByIns = Hash::combine($transByTid, '{n}.id', '{n}', '{n}.instrument_id');
                // pr($oneUserTransGroupByIns);

                foreach ($oneUserTransGroupByIns as $oneInsAllTrans) {
                    $totalAmounOfThisInstrument = 0;
                    $totalCostOfThisInstrument = 0;
                    $userReport .= "<table>";
                    $userReport .= $yourTmpHtmlHelper->tableHeaders(array('Quantity', 'Instrument code', 'Order type', ' Rate / price ', '    OrderId   ', '     ExecId    ', '   Transaction Time   '));
                    foreach ($oneInsAllTrans as $eachTrans) {
                        //pr($eachTrans);
                        $pid = $eachTrans['portfolio_id'];

                        $transaction_type_id = $eachTrans['transaction_type_id'];
                        $irn = $userList[$pid]['internal_ref_no'];
                        $useremail = $userList[$pid]['email'];
                        $username = $userList[$pid]['username'];
                        $irn = strtoupper($irn);
                        $amount = $eachTrans['amount'];
                        $rate = $eachTrans['rate'];
                        $instrument_id = $eachTrans['instrument_id'];
                        $instrument_code = $instrumentList[$instrument_id];
                        $transaction_time = $eachTrans['transaction_time'];

                        $transaction_time = CakeTime::nice($transaction_time);
                        $dse_order_id = $eachTrans['dse_order_id'];
                        $dse_execution_id = $eachTrans['dse_execution_id'];

                        $order = '';
                        $order_present = '';
                        if ($transaction_type_id == 1) {
                            $order = 'bought';
                            $order_present = 'buy';
                        } else {
                            $order = 'sold';
                            $order_present = 'sell';
                        }
                        $rep = $yourTmpHtmlHelper->tableCells(array(array($amount, $instrument_code, $order, $rate, $dse_order_id, $dse_execution_id, $transaction_time)));
                        $userReport .= $rep;
                        //    $rep="$amount $instrument_code $order at $rate Tk. DSE order ID=$dse_order_id, DSE execution ID=$dse_execution_id and transaction=$transaction_time<br/>";
                        //  $userReport="$userReport $rep";

                        $totalAmounOfThisInstrument += $amount;
                        $cost = $amount * $rate;
                        $totalCostOfThisInstrument += $cost;
                    }
                    $userReport .= "</table>";
                    $avg = $totalCostOfThisInstrument / $totalAmounOfThisInstrument;
                    $avg = number_format($avg, 2, '.', '');
                    $rep = "<h4>$totalAmounOfThisInstrument $instrument_code $order . Money spent $totalCostOfThisInstrument Tk and Average Cost was $avg Tk.</h4>";
                    $userReport .= $rep;

                    $grandTotal += $totalCostOfThisInstrument;
                    $grandTotal = number_format($grandTotal, 2, '.', '');
                }
                $rep = "<h3>Total $order_present transaction was $grandTotal Taka </h3>";
                $userReport .= $rep;

                $todayGrandTotal += $grandTotal;
                $sub = "$order $grandTotal Tk. | ";
                $sub = strtoupper($sub);
                $emailSubject .= $sub;
            }

            $todayGrandTotal = number_format($todayGrandTotal, 2, '.', '');
            $rep = "<h3>CONGRATULATIONS! YOU HAVE MADE $todayGrandTotal Tk. TRANSACTION (buy+sell) IN TOTAL</h3>";
            $userReport .= $rep;

            $sub = "Total Transaction $todayGrandTotal Tk. | Account: $irn.";
            $sub = strtoupper($sub);
            $emailSubject .= $sub;
            //  pr($userReport);


            if ($userReport != '') {
                $fullbody = "Dear $username, <br/> <br/>Here are today's confirm transactions of $irn account<br/><br/> $userReport <br/><br/>Thanks for trading with us<br/>StockBangladesh OMO PLUS Team";
                echo "$emailSubject <br/>";
                // pr($fullbody);
                // exit;

                $email  = new CakeEmail('smtp');
                //    CakeEmail::deliver($useremail, "$emailSubject", "$fullbody", array('from' => 'info@stockbangladesh.com', 'emailFormat' => 'html'));
                $email->to("$useremail")
                    ->subject("$emailSubject")
                    ->emailFormat('html')
                    ->send("$fullbody");

                // CakeEmail::deliver('info@stockbangladesh.com', "$emailSubject", "$fullbody", array('from' => 'info@stockbangladesh.com', 'emailFormat' => 'html'));

            }


        }
        exit;

    }
    public function runBalanceSharp()
    {
        Configure::write('debug', 2);

        $StockBangladesh = $this->Components->load('StockBangladesh');


        // checking if user is allowed to do so
        $brokerId = Configure::read('broker.sharp.id');
        if ($this->Auth->user('group_id') > 1) {  // if not super admin
            if ($brokerId != $this->Auth->user('broker_id')) {
                echo "This is not your house";
                exit;
            }
        }

        // generating file path
        $balance_file_path = Configure::read('broker.sharp.balance_file_path');
        $fileArr = $StockBangladesh->scan_dir($balance_file_path);
        pr("sharp");


        $fullFilePath = "$balance_file_path/" . $fileArr[0];


        // reading file
        $file = fopen($fullFilePath, "r");
        $powerArr = array();




        while (!feof($file)) { //
            $row = fgetcsv($file);

            if(strpos($row[0],' Date : '))
            {

                $fileDate=date('d-M-Y',strtotime($row[1]));
                //$pattern=$row;
                // pr($row);

            }


            if(strpos($row[0],'#'))            {
                $pattern=$row;
                // pr($row);

            }

            $internal_ref_no = trim($row[1]);
            $internal_ref_no=explode(')',$internal_ref_no);
            $internal_ref_no=$internal_ref_no[0];
            $internal_ref_no= substr($internal_ref_no, 1);
            $internal_ref_no = strtoupper($internal_ref_no);

            $debit=(float)str_replace(',', '', $row[2]);
            $credit=(float)str_replace(',', '', $row[3]);

            $purches_power=$debit+$credit;
            $powerArr[$internal_ref_no]['purchase_power'] = $purches_power;

            $show[$internal_ref_no][1]=$debit;
            $show[$internal_ref_no][2]=$credit;
            // $deposit = (float)str_replace(',', '', $deposit);

        }


        if($fileDate!= date('d-M-Y'))
        {
            echo "<br>";
            echo "<h2>this is not today's file.please recheck and upload the correct file again</h2>";
            exit;
        }

        $patternArray= array
        (
            0 => 'SL#',
            1 => 'Client',
            2 => 'Debit',
            3 => 'Credit',
            4 => 'Client',
            5 => 'Debit',
            6 => 'Credit',
            7 => '',
        );


        if ($pattern !== $patternArray)//chk order
        {


            echo"File Column order is not in correct format.";
            echo "Expected File Order Is: SL# => Client=> Debit => Credit => Client =>Debit => Credit";

            exit;

        }


        // preparing inr according to hac format (pading leading zero)

        $Omo = $this->Components->load('Omo');
        $userList = $Omo->getUsersList(4, 1);
        $brokerUsers = array();
        foreach ($userList[$brokerId] as $irn => $arr) {
            $key = trim($irn);
            $key = str_pad($key, 5, "0", STR_PAD_LEFT);
            $key = strtoupper($key);
            $brokerUsers[$key] = $arr;
        }

        $dataToSave2 = array();
        foreach ($brokerUsers as $irn => $usr) {
            if (isset($powerArr[$irn])) {
                $pid = $usr['portfolio_id'];
                $id = $usr['id']; //userid
                $balance = $usr['balance'];


                $ppower = $powerArr[$irn]['purchase_power'];
                $ppower = (float)str_replace(',', '', $ppower);

                /*  $deposit = $powerArr[$irn]['deposit'];
                  $deposit = (float)str_replace(',', '', $deposit);

                  $withdraw = $powerArr[$irn]['withdraw'];
                  $withdraw = (float)str_replace(',', '', $withdraw);

                  $realized = $powerArr[$irn]['realized'];
                  $realized = (float)str_replace(',', '', $realized);*/


                // update portfolio table balance
                $temp2 = array();
                $temp2['id'] = $pid;
                /* $temp2['total_deposit'] = $deposit;
                 $temp2['total_withdraw'] = $withdraw;
                 $temp2['total_realized'] = $realized;*/
                $temp2['total_stats_updated'] = date('Y-m-d H:i:s');
                $temp2['balance'] = $ppower;

                $dataToSave2[] = $temp2;
                // }
            }

        }


        $model2 = ClassRegistry::init('Portfolio');


        if (count($dataToSave2)) {

            $model2->saveMany($dataToSave2, array('atomic' => true));
            echo count($dataToSave2) . ' balanace updated';


            //  $rt = Router::url('/', true) . "Stations/runWithdrawDeposit";

            // echo "<br /><a target='_blank' href='$rt'><h3>Run Withdraw/Deposit Script</h3></a> <br />";
        }


        exit;



    }

    ///////////////////////////////////////////////////////////////////for Sharp broker House END////////////////////////////////////////////////////////////////////

    ///////////////////////////////////////////////////////////////////for SB Sharp broker House////////////////////////////////////////////////////////////////////
    public function runTradeInsSbsharp($sent_email=0)
    {

         Configure::write('debug', 2);
        App::uses('CakeEmail', 'Network/Email');
        App::uses('CakeTime', 'Utility');


        pr("Sharp-Kawran Bazar");

        $StockBangladesh = $this->Components->load('StockBangladesh');
        $ip = $StockBangladesh->getIp();
        $instrumentList = $StockBangladesh->instrumentList(2);

        $brokerId = Configure::read('broker.sbsharp.id');
        if ($this->Auth->user('group_id') > 1) {  // if not super admin
            if ($brokerId != $this->Auth->user('broker_id')) {
                echo "This is not your house";
                exit;
            }
        }

        // generating file path
        $tradeins_file_path = Configure::read('broker.sbsharp.tradeins_file_path');
        $fileArr = $StockBangladesh->scan_dir($tradeins_file_path);




        $today = CakeTime::nice(date ("F d Y"));
        $fullFilePath = "$tradeins_file_path/" . $fileArr[0];
        App::uses('CakeTime', 'Utility');
        $reportDate=CakeTime::nice(date ("F d Y", filemtime($fullFilePath)));

       if ($reportDate != $today) {
            echo $fileArr[0];
            echo "<br/>This is not today's file.<br/>";
            exit;
        }

        $Omo = $this->Components->load('Omo');
        $userList = $Omo->getUsersList(4, 1);


        $brokerUsers = array();
        foreach ($userList[$brokerId] as $irn => $arr) {
            $key = trim($irn);
            $key = str_pad($key, 5, "0", STR_PAD_LEFT);
            $key = strtoupper($key);
            $brokerUsers[$key] = $arr;
        }


      //  pr($fullFilePath);

        $tradeArr = array();
        $xldata = $Omo->xlsToArray($fullFilePath, 8);

        $paternArray= array
        (
            '0' => 'Client A/C',
            '1' => 'Symbol',
            '2' => 'Side',
            '3' => 'OrderQty',
            '4' => 'OrdLimit',
            '5' => 'SubStatus',
            '6' => 'ExecQty',
            '7' => 'ExecPrice',
            '8' => 'ExecTime',
            '9' => 'ExecStat',
            '10' => 'OrdAvP',
            '11' => 'A/C CDS',
            '12' => 'ExecType',
            '13' => 'ExecID',
            '14' => 'TFOrderID'
        );

        if ($xldata[1] !== $paternArray)//chk order
        {


            echo"File Column order is not in correct format.";
            echo "Expected File Order Is: Client A/C => Symbol=> Side => OrderQty => OrdLimit => SubStatus => ExecQty => ExecPrice => ExecTime => ExecStat => OrdAvP => A/C CDS => ExecType => ExecID => TFOrderID";

            exit;

        }

        unset($xldata[0]);

        $dataToSaveForRaw = array();
        $reportDate = '';
        foreach ($xldata as $row) {
            $temp = array();
            $tempForRaw = array();
            $internal_ref_no = trim($row[0]);
            $internal_ref_no = strtoupper($internal_ref_no);
            $internal_ref_no=str_pad($internal_ref_no, 5, "0", STR_PAD_LEFT);
            $instrument_code = strtoupper(trim($row[1]));
            $transaction_type = trim($row[2]);

            $transaction_time = trim($row[8]);

            $transaction_time = PHPExcel_Style_NumberFormat::toFormattedString($transaction_time, 'hh:mm:ss');

           // $reportDate2 = '2016/07/31'; //for backdated tradeIns


            $reportDate2 = date('Y/m/d');


            $transaction_time="$reportDate2 $transaction_time";

            $transaction_time = date("Y-m-d H:i:s", strtotime($transaction_time));
            //pr($transaction_time);

            $amount = trim($row[6]);
            $rate = trim($row[7]);
            $rate = (float)str_replace(',', '', $rate);
            $order_id = trim($row[14]);
            $execution_id = trim($row[13]);
            $execution_arr = explode('_', $execution_id);
            $execution_id = $execution_arr[count($execution_arr) - 1];


            $temp['instrument_code'] = $instrument_code;
            $temp['transaction_time'] = $transaction_time;
            $temp['transaction_type'] = $transaction_type;
            $temp['amount'] = $amount;
            $temp['rate'] = $rate;
            $temp['order_id'] = $order_id;
            $temp['execution_id'] = $execution_id;
            $tradeArr[$internal_ref_no][] = $temp;

            //$rate = (float)str_replace(',', '', $rate);
            $tempForRaw['client_ac'] = trim($row[0]);
            $tempForRaw['symbol'] = trim($row[1]);
            $tempForRaw['side'] = trim($row[2]);
            $tempForRaw['order_qty'] = trim($row[3]);
            $tempForRaw['order_limit_price'] = trim($row[4]);
            $tempForRaw['substatus'] = trim($row[5]);
            $tempForRaw['execute_qty'] = trim($row[6]);
            $tempForRaw['execute_price'] = $rate;
            $tempForRaw['execute_time'] = $transaction_time;
            $tempForRaw['execute_stat'] = trim($row[9]);
            $tempForRaw['order_avg_price'] = trim($row[10]);
            $tempForRaw['ac_cds'] = trim($row[11]);
            $tempForRaw['execute_type'] = trim($row[12]);
            $tempForRaw['execution_id'] = trim($row[13]);
            $tempForRaw['order_id'] = trim($row[14]);
            $tempForRaw['broker_id'] = $brokerId;
            if ($rate) {
                $reportDate = $transaction_time;
                $dataToSaveForRaw[] = $tempForRaw;
            }
        }



        $model = ClassRegistry::init('PortfolioTransaction');
        $dataToSave = array();
        $updateCounter = 0;


        foreach ($brokerUsers as $irn => $usr) {

            if (isset($tradeArr[$irn])) {

                // pr("set");
                foreach ($tradeArr[$irn] as $eachRealTransaction) {

                    $pid = $usr['portfolio_id'];
                    $broker_fee = $usr['broker_fee'];

                    $instrument_code = $eachRealTransaction['instrument_code'];
                    if ($eachRealTransaction['transaction_type'] == 'Sell') {
                        $transaction_type_id = 2; // sell
                    } else {
                        $transaction_type_id = 1; // buy
                    }

                    $temp = array();
                    $temp['portfolio_id'] = $pid;
                    $temp['instrument_id'] = $instrumentList[$instrument_code];
                    $temp['transaction_type_id'] = $transaction_type_id;
                    $temp['amount'] = abs($eachRealTransaction['amount']);
                    $temp['rate'] = $eachRealTransaction['rate'];
                    $temp['commission'] = $broker_fee;
                    $transaction_time = $eachRealTransaction['transaction_time'];
                    $temp['transaction_time'] = $transaction_time;
                    $temp['dse_order_id'] = $eachRealTransaction['order_id'];
                    $temp['dse_execution_id'] = $eachRealTransaction['execution_id'];

                    $dse_order_id = $eachRealTransaction['order_id'];
                   $dse_execution_id = $eachRealTransaction['execution_id'];

                    $transaction = $model->find('all', array(
                            //'conditions' => "PortfolioTransaction.portfolio_id=$pid and PortfolioTransaction.dse_order_id LIKE '$dse_order_id'"
                            'conditions' => "PortfolioTransaction.portfolio_id=$pid and PortfolioTransaction.dse_order_id LIKE '$dse_order_id' and PortfolioTransaction.dse_execution_id LIKE '$dse_execution_id'"
                        , 'recursive' => -1
                        )

                    );

                    if (count($transaction))  // if already exist
                    {
                        $updateCounter++;
                        $temp['id'] = $transaction[0]['PortfolioTransaction']['id'];  // setting primary id. So it will update instead of creating new
                    }

                    $dataToSave[] = $temp;
                }

            }

        }

        if($sent_email) {  // by force sending email only
            if ($reportDate == $today) {  // if it is today tradeins we will sent email
                echo "email sending........<br />";
                $this->emailReportSbsharp($dataToSave, $brokerUsers);

                echo ".................email sending finished<br />";
                exit;
            }
        }



        if (count($dataToSave)) {
            $model->deleteAll("Portfolio.broker=$brokerId and PortfolioTransaction.dse_execution_id  LIKE  'temp'", false);
            $model->saveMany($dataToSave, array('atomic' => true));
            $n = (count($dataToSave) - $updateCounter);
            echo $n . 'rows inserted in portfolio transaction table and ' . $updateCounter . ' rows updated';
            /* echo "<pre>";
             print_r($dataToSave);*///
            //CakeEmail::deliver('info@stockbangladesh.com', "Trade Ins of $reportDate2 Sharp run successfully", "$n rows inserted and $updateCounter rows updated in portfolio transaction table. Script run from $ip", array('from' => 'omo@stockbangladesh.net'));

            $email  = new CakeEmail('smtp');
            $email->to('info@stockbangladesh.com')
                ->subject("Trade Ins of $reportDate2 Sharp Kawran Bazar branch run successfully")
                ->send("$n rows inserted and $updateCounter rows updated in portfolio transaction table. Script run from $ip");
           // CakeEmail::deliver('raihan.it@stockbangladesh.com', "Trade Ins of $reportDate2 Sharp run successfully", "$n rows inserted and $updateCounter rows updated in portfolio transaction table. Script run from $ip", array('from' => 'omo@stockbangladesh.net'));

        }
        $rawmodel = ClassRegistry::init('RawTradin');
        if (count($dataToSaveForRaw)) {

            $rawmodel->saveMany($dataToSaveForRaw, array('atomic' => true));
        }
        if($updateCounter==0) { // if this email was not sent previously
            if ($reportDate == $today) {  // if it is today tradeins we will sent email
                echo "email sending........<br />";
                $this->emailReportSbsharp($dataToSave, $brokerUsers);

                echo ".................email sending finished<br />";
            }
        }
        else
        {
            echo "<br/>email previously sent <br />";

        }


        // deleting all existing file

      /*  $dir = 'sharp/tradeins/*';

        $files = glob($dir); // get all file names
        foreach ($files as $file) { // iterate files
            if (is_file($file))
                unlink($file); // delete file
        }

*/
        exit;

    }
    public function emailReportSbsharp($allExecutedTransaction)
    {
        // Configure::write('debug', 2);
        App::uses('CakeTime', 'Utility');
        App::uses('CakeEmail', 'Network/Email');

        App::uses('HtmlHelper', 'View/Helper');
        $yourTmpHtmlHelper = new HtmlHelper(new View());

        /*   echo $yourTmpHtmlHelper->tableCells(array(
               array('Jul 7th, 2007', 'Best Brownies', 'Yes'),
               array('Jun 21st, 2007', 'Smart Cookies', 'Yes'),
               array('Aug 1st, 2006', 'Anti-Java Cake', 'No'),
           ));

           exit;*/
        $allExecutedTransactionGroupByPortfolioId = Hash::combine($allExecutedTransaction, '{n}.id', '{n}', '{n}.portfolio_id');

        $StockBangladesh = $this->Components->load('StockBangladesh');
        $instrumentList = $StockBangladesh->instrumentList(3);

        $Omo = $this->Components->load('Omo');
        $userList = $Omo->getUsersList(3, 1);

        foreach ($allExecutedTransactionGroupByPortfolioId as $oneUserTrans) {

            $todayGrandTotal = 0;
            $userReport = '';
            $emailSubject = '';

            $oneUserTransGroupByTid = Hash::combine($oneUserTrans, '{n}.id', '{n}', '{n}.transaction_type_id');

            foreach ($oneUserTransGroupByTid as $transByTid) {
                $grandTotal = 0;
                $oneUserTransGroupByIns = Hash::combine($transByTid, '{n}.id', '{n}', '{n}.instrument_id');
                // pr($oneUserTransGroupByIns);

                foreach ($oneUserTransGroupByIns as $oneInsAllTrans) {
                    $totalAmounOfThisInstrument = 0;
                    $totalCostOfThisInstrument = 0;
                    $userReport .= "<table>";
                    $userReport .= $yourTmpHtmlHelper->tableHeaders(array('Quantity', 'Instrument code', 'Order type', ' Rate / price ', '    OrderId   ', '     ExecId    ', '   Transaction Time   '));
                    foreach ($oneInsAllTrans as $eachTrans) {
                        //pr($eachTrans);
                        $pid = $eachTrans['portfolio_id'];

                        $transaction_type_id = $eachTrans['transaction_type_id'];
                        $irn = $userList[$pid]['internal_ref_no'];
                        $useremail = $userList[$pid]['email'];
                        $username = $userList[$pid]['username'];
                        $irn = strtoupper($irn);
                        $amount = $eachTrans['amount'];
                        $rate = $eachTrans['rate'];
                        $instrument_id = $eachTrans['instrument_id'];
                        $instrument_code = $instrumentList[$instrument_id];
                        $transaction_time = $eachTrans['transaction_time'];

                        $transaction_time = CakeTime::nice($transaction_time);
                        $dse_order_id = $eachTrans['dse_order_id'];
                        $dse_execution_id = $eachTrans['dse_execution_id'];

                        $order = '';
                        $order_present = '';
                        if ($transaction_type_id == 1) {
                            $order = 'bought';
                            $order_present = 'buy';
                        } else {
                            $order = 'sold';
                            $order_present = 'sell';
                        }
                        $rep = $yourTmpHtmlHelper->tableCells(array(array($amount, $instrument_code, $order, $rate, $dse_order_id, $dse_execution_id, $transaction_time)));
                        $userReport .= $rep;
                        //    $rep="$amount $instrument_code $order at $rate Tk. DSE order ID=$dse_order_id, DSE execution ID=$dse_execution_id and transaction=$transaction_time<br/>";
                        //  $userReport="$userReport $rep";

                        $totalAmounOfThisInstrument += $amount;
                        $cost = $amount * $rate;
                        $totalCostOfThisInstrument += $cost;
                    }
                    $userReport .= "</table>";
                    $avg = $totalCostOfThisInstrument / $totalAmounOfThisInstrument;
                    $avg = number_format($avg, 2, '.', '');
                    $rep = "<h4>$totalAmounOfThisInstrument $instrument_code $order . Money spent $totalCostOfThisInstrument Tk and Average Cost was $avg Tk.</h4>";
                    $userReport .= $rep;

                    $grandTotal += $totalCostOfThisInstrument;
                    $grandTotal = number_format($grandTotal, 2, '.', '');
                }
                $rep = "<h3>Total $order_present transaction was $grandTotal Taka </h3>";
                $userReport .= $rep;

                $todayGrandTotal += $grandTotal;
                $sub = "$order $grandTotal Tk. | ";
                $sub = strtoupper($sub);
                $emailSubject .= $sub;
            }

            $todayGrandTotal = number_format($todayGrandTotal, 2, '.', '');
            $rep = "<h3>CONGRATULATIONS! YOU HAVE MADE $todayGrandTotal Tk. TRANSACTION (buy+sell) IN TOTAL</h3>";
            $userReport .= $rep;

            $sub = "Total Transaction $todayGrandTotal Tk. | Account: $irn.";
            $sub = strtoupper($sub);
            $emailSubject .= $sub;
            //  pr($userReport);


            if ($userReport != '') {
                $fullbody = "Dear $username, <br/> <br/>Here are today's confirm transactions of $irn account<br/><br/> $userReport <br/><br/>Thanks for trading with us<br/>StockBangladesh OMO PLUS Team";
                echo "$emailSubject <br/>";
                // pr($fullbody);
                // exit;

                $email  = new CakeEmail('smtp');
            //    CakeEmail::deliver($useremail, "$emailSubject", "$fullbody", array('from' => 'info@stockbangladesh.com', 'emailFormat' => 'html'));
                $email->to("$useremail")
                    ->subject("$emailSubject")
                    ->emailFormat('html')
                    ->send("$fullbody");

               // CakeEmail::deliver('info@stockbangladesh.com', "$emailSubject", "$fullbody", array('from' => 'info@stockbangladesh.com', 'emailFormat' => 'html'));

            }


        }
            exit;

    }
    public function runBalanceSbsharp()
    {
        Configure::write('debug', 2);

        $StockBangladesh = $this->Components->load('StockBangladesh');


        // checking if user is allowed to do so
        $brokerId = Configure::read('broker.sbsharp.id');
        if ($this->Auth->user('group_id') > 1) {  // if not super admin
            if ($brokerId != $this->Auth->user('broker_id')) {
                echo "This is not your house";
                exit;
            }
        }

        // generating file path
        $balance_file_path = Configure::read('broker.sbsharp.balance_file_path');
        $fileArr = $StockBangladesh->scan_dir($balance_file_path);
        pr("sharp");


        $fullFilePath = "$balance_file_path/" . $fileArr[0];


        // reading file
        $file = fopen($fullFilePath, "r");
        $powerArr = array();




        while (!feof($file)) { //
            $row = fgetcsv($file);

            if(strpos($row[0],' Date : '))
            {

                $fileDate=date('d-M-Y',strtotime($row[1]));
                //$pattern=$row;
                // pr($row);

            }


            if(strpos($row[0],'#'))            {
                $pattern=$row;
                // pr($row);

            }

            $internal_ref_no = trim($row[1]);
            $internal_ref_no=explode(')',$internal_ref_no);
            $internal_ref_no=$internal_ref_no[0];
            $internal_ref_no= substr($internal_ref_no, 1);
            $internal_ref_no = strtoupper($internal_ref_no);

            $debit=(float)str_replace(',', '', $row[2]);
            $credit=(float)str_replace(',', '', $row[3]);

            $purches_power=$debit+$credit;
            $powerArr[$internal_ref_no]['purchase_power'] = $purches_power;

            $show[$internal_ref_no][1]=$debit;
            $show[$internal_ref_no][2]=$credit;
           // $deposit = (float)str_replace(',', '', $deposit);

        }


        if($fileDate!= date('d-M-Y'))
        {
            echo "<br>";
            echo "<h2>this is not today's file.please recheck and upload the correct file again</h2>";
            exit;
        }

            $patternArray= array
            (
                0 => 'SL#',
                1 => 'Client',
                2 => 'Debit',
                3 => 'Credit',
                4 => 'Client',
                5 => 'Debit',
                6 => 'Credit',
                7 => '',
            );


            if ($pattern !== $patternArray)//chk order
            {


            echo"File Column order is not in correct format.";
            echo "Expected File Order Is: SL# => Client=> Debit => Credit => Client =>Debit => Credit";

            exit;

            }


        // preparing inr according to hac format (pading leading zero)

        $Omo = $this->Components->load('Omo');
        $userList = $Omo->getUsersList(4, 1);
        $brokerUsers = array();
        foreach ($userList[$brokerId] as $irn => $arr) {
            $key = trim($irn);
            $key = str_pad($key, 5, "0", STR_PAD_LEFT);
            $key = strtoupper($key);
            $brokerUsers[$key] = $arr;
        }

        $dataToSave2 = array();
        foreach ($brokerUsers as $irn => $usr) {
            if (isset($powerArr[$irn])) {
                $pid = $usr['portfolio_id'];
                $id = $usr['id']; //userid
                $balance = $usr['balance'];


                $ppower = $powerArr[$irn]['purchase_power'];
                $ppower = (float)str_replace(',', '', $ppower);

                /*  $deposit = $powerArr[$irn]['deposit'];
                  $deposit = (float)str_replace(',', '', $deposit);

                  $withdraw = $powerArr[$irn]['withdraw'];
                  $withdraw = (float)str_replace(',', '', $withdraw);

                  $realized = $powerArr[$irn]['realized'];
                  $realized = (float)str_replace(',', '', $realized);*/


                // update portfolio table balance
                $temp2 = array();
                $temp2['id'] = $pid;
                /* $temp2['total_deposit'] = $deposit;
                 $temp2['total_withdraw'] = $withdraw;
                 $temp2['total_realized'] = $realized;*/
                $temp2['total_stats_updated'] = date('Y-m-d H:i:s');
                $temp2['balance'] = $ppower;

                $dataToSave2[] = $temp2;
                // }
            }

        }


        $model2 = ClassRegistry::init('Portfolio');


        if (count($dataToSave2)) {

            $model2->saveMany($dataToSave2, array('atomic' => true));
            echo count($dataToSave2) . ' balanace updated';


          //  $rt = Router::url('/', true) . "Stations/runWithdrawDeposit";

           // echo "<br /><a target='_blank' href='$rt'><h3>Run Withdraw/Deposit Script</h3></a> <br />";
        }


        exit;



    }

    ///////////////////////////////////////////////////////////////////for SB Sharp broker House END////////////////////////////////////////////////////////////////////


    ///fis
    ///////////////////////////////////////////////////////////////////for Fakhrul Islam ////////////////////////////////////////////////////////////////////

    public function runTradeInsFis($sent_email = 0)
    {

        // Configure::write('debug', 2);
        App::uses('CakeEmail', 'Network/Email');
        App::uses('CakeTime', 'Utility');


        pr("FIS");

        $StockBangladesh = $this->Components->load('StockBangladesh');
        $ip = $StockBangladesh->getIp();
        $instrumentList = $StockBangladesh->instrumentList(2);

        $brokerId = Configure::read('broker.fis.id');
        if ($this->Auth->user('group_id') > 1) {  // if not super admin
            if ($brokerId != $this->Auth->user('broker_id')) {
                echo "This is not your house";
                exit;
            }
        }

        // generating file path

        $tradeins_file_path = Configure::read('broker.fis.tradeins_file_path');
        $fileArr = $StockBangladesh->scan_dir($tradeins_file_path);


        $today = CakeTime::nice(date("F d Y"));
        $fullFilePath = "$tradeins_file_path/" . $fileArr[0];
        App::uses('CakeTime', 'Utility');
        $reportDate = CakeTime::nice(date("F d Y", filemtime($fullFilePath)));

        if ($reportDate != $today) {
            echo $fileArr[0];
            echo "<br/>This is not today's file.<br/>";
            exit;
        }


        $Omo = $this->Components->load('Omo');
        $userList = $Omo->getUsersList(4, 0);


        $brokerUsers = array();
        foreach ($userList[$brokerId] as $irn => $arr) {
            $key = trim($irn);
            $key = str_pad($key, 6, "0", STR_PAD_LEFT);
            $key = strtoupper($key);
            $brokerUsers[$key] = $arr;
        }


        $tradeArr = array();
        $xldata = $Omo->xlsToArray($fullFilePath, 8);


        $paternArray = array
        (
            '0' => 'Client A/C',
            '1' => 'Symbol',
            '2' => 'Side',
            '3' => 'ExecQty',
            '4' => 'SubStatus',
            '5' => 'ExecPrice',
            '6' => 'OrderQty',
            '7' => 'ExecType',
            '8' => 'ExecStat',
            '9' => 'OrdLimit',
            '10' => 'OrdAvP',
            '11' => 'A/C CDS',
            '12' => 'ExecID',
            '13' => 'TFOrderID',
            '14' => 'ExecTime',
            '15' => 'CumQty'

        );

        /*pr($xldata[1]);
        pr($paternArray);
        exit;*/

        if ($xldata[1] !== $paternArray)//chk order
        {


            echo "File Column order is not in correct format.";
            echo "Expected File Order Is: Client A/C => Symbol=> Side => OrderQty => OrdLimit => SubStatus => ExecQty => ExecPrice => ExecTime => ExecStat => OrdAvP => A/C CDS => ExecType => ExecID => TFOrderID";

            exit;

        }

        unset($xldata[0]);

        $dataToSaveForRaw = array();
        $reportDate = '';
        foreach ($xldata as $row) {
            $temp = array();
            $tempForRaw = array();
            $internal_ref_no = trim($row[0]);
            $internal_ref_no = strtoupper($internal_ref_no);
            $internal_ref_no = str_pad($internal_ref_no, 6, "0", STR_PAD_LEFT);

            $instrument_code = trim($row[1]);
            $transaction_type = trim($row[2]);

            $transaction_time = trim($row[14]);

            $transaction_time = PHPExcel_Style_NumberFormat::toFormattedString($transaction_time, 'hh:mm:ss');

            //$reportDate2 = '2015/09/15'; //for backdated tradeIns
            $reportDate2 = date('Y/m/d');


            $transaction_time = "$reportDate2 $transaction_time";

            $transaction_time = date("Y-m-d H:i:s", strtotime($transaction_time));
            //pr($transaction_time);

            $amount = trim($row[3]);
            $rate = trim($row[5]);
            $rate = (float)str_replace(',', '', $rate);
            $order_id = trim($row[13]);
            $execution_id = trim($row[12]);
            $execution_arr = explode('_', $execution_id);
            $execution_id = $execution_arr[count($execution_arr) - 1];

            $temp['instrument_code'] = $instrument_code;
            $temp['transaction_time'] = $transaction_time;
            $temp['transaction_type'] = $transaction_type;
            $temp['amount'] = $amount;
            $temp['rate'] = $rate;
            $temp['order_id'] = $order_id;
            $temp['execution_id'] = $execution_id;
            $tradeArr[$internal_ref_no][] = $temp;


            $rate = (float)str_replace(',', '', $rate);
            $tempForRaw['client_ac'] = trim($row[0]);
            $tempForRaw['symbol'] = trim($row[1]);
            $tempForRaw['side'] = trim($row[2]);
            $tempForRaw['order_qty'] = trim($row[3]);
            $tempForRaw['order_limit_price'] = trim($row[9]);
            $tempForRaw['substatus'] = trim($row[4]);
            $tempForRaw['execute_qty'] = trim($row[3]);
            $tempForRaw['execute_price'] = $rate;
            $tempForRaw['execute_time'] = $transaction_time;
            $tempForRaw['execute_stat'] = trim($row[8]);
            $tempForRaw['order_avg_price'] = trim($row[10]);
            $tempForRaw['ac_cds'] = trim($row[11]);
            // $tempForRaw['counter_trader_id'] = trim($row[13]);
            $tempForRaw['execute_type'] = trim($row[7]);
            $tempForRaw['execution_id'] = trim($row[12]);
            $tempForRaw['order_id'] = trim($row[13]);
            $tempForRaw['broker_id'] = $brokerId;
            if ($rate) {
                $reportDate = $transaction_time;
                $dataToSaveForRaw[] = $tempForRaw;
            }
        }


        $model = ClassRegistry::init('PortfolioTransaction');
        $model2 = ClassRegistry::init('PortfolioShare');
        $dataToSave = array();
        $updateCounter = 0;

        foreach ($brokerUsers as $irn => $usr) {

            if (isset($tradeArr[$irn])) {

                // pr("set");
                foreach ($tradeArr[$irn] as $eachRealTransaction) {

                    $pid = $usr['portfolio_id'];
                    $broker_fee = $usr['broker_fee'];

                    $instrument_code = $eachRealTransaction['instrument_code'];
                    if ($eachRealTransaction['transaction_type'] == 'Sell') {
                        $transaction_type_id = 2; // sell
                    } else {
                        $transaction_type_id = 1; // buy
                    }

                    $temp = array();
                    $temp['portfolio_id'] = $pid;
                    $temp['instrument_id'] = $instrumentList[$instrument_code];
                    $temp['transaction_type_id'] = $transaction_type_id;
                    $temp['amount'] = abs($eachRealTransaction['amount']);
                    $temp['rate'] = $eachRealTransaction['rate'];
                    $temp['commission'] = $broker_fee;
                    $transaction_time = $eachRealTransaction['transaction_time'];
                    $temp['transaction_time'] = $transaction_time;
                    $temp['dse_order_id'] = $eachRealTransaction['order_id'];
                    $temp['dse_execution_id'] = $eachRealTransaction['execution_id'];

                    $dse_order_id = $eachRealTransaction['order_id'];
                    $dse_execution_id = $eachRealTransaction['execution_id'];

                    $transaction = $model->find('all', array(
                            'conditions' => "PortfolioTransaction.portfolio_id=$pid and PortfolioTransaction.dse_order_id LIKE '$dse_order_id' and PortfolioTransaction.dse_execution_id LIKE '$dse_execution_id'"
                        , 'recursive' => -1
                        )

                    );

                    if (count($transaction))  // if already exist
                    {
                        $updateCounter++;
                        $temp['id'] = $transaction[0]['PortfolioTransaction']['id'];  // setting primary id. So it will update instead of creating new
                    }

                    $dataToSave[] = $temp;
                }

            }

        }


        if ($sent_email) {  // by force sending email only
            if ($reportDate == $today) {  // if it is today tradeins we will sent email
                echo "email sending........<br />";
                $this->emailReportFis($dataToSave, $brokerUsers);

                echo ".................email sending finished<br />";
                exit;
            }
        }


        if (count($dataToSave)) {

            $model->deleteAll("Portfolio.broker=$brokerId and PortfolioTransaction.dse_execution_id  LIKE  'temp'", false);
            $model->saveMany($dataToSave, array('atomic' => true));
            $n = (count($dataToSave) - $updateCounter);
            echo $n . 'rows inserted in portfolio transaction table and ' . $updateCounter . ' rows updated';

            //CakeEmail::deliver('info@stockbangladesh.com', "Trade Ins of $reportDate2 HAC run successfully", "$n rows inserted and $updateCounter rows updated in portfolio transaction table. Script run from $ip", array('from' => 'omo@stockbangladesh.net'));

            $email = new CakeEmail('smtp');
            $email->to('info@stockbangladesh.com')
                ->subject("Trade Ins of $reportDate2 FIS run successfully")
                ->send("$n rows inserted and $updateCounter rows updated in portfolio transaction table. Script run from $ip");


        }

        // for testing system portfolioshares


        $rawmodel = ClassRegistry::init('RawTradin');
        if (count($dataToSaveForRaw)) {

            if ($rawmodel->saveMany($dataToSaveForRaw, array('atomic' => true))) {
                $count = count($dataToSaveForRaw);
                pr($fileArr[0]);
                echo "saved $count ";
            }
        }

        if ($updateCounter == 0) { // if this email was not sent previously
            if ($reportDate == $today) {  // if it is today tradeins we will sent email
                echo "email sending........<br />";
                $this->emailReportFis($dataToSave, $brokerUsers);

                echo ".................email sending finished<br />";
            }
        } else {
            echo "<br/>email previously sent <br />";

        }


        // deleting all existing file

        /* $dir = 'hac/tradeins/*';

         $files = glob($dir); // get all file names
         foreach ($files as $file) { // iterate files
             if (is_file($file))
                 unlink($file); // delete file
         }*/


        exit;

    }

    public function emailReportFis($allExecutedTransaction)
    {
        // Configure::write('debug', 2);
        App::uses('CakeTime', 'Utility');
        App::uses('CakeEmail', 'Network/Email');

        App::uses('HtmlHelper', 'View/Helper');
        $yourTmpHtmlHelper = new HtmlHelper(new View());

        /*   echo $yourTmpHtmlHelper->tableCells(array(
               array('Jul 7th, 2007', 'Best Brownies', 'Yes'),
               array('Jun 21st, 2007', 'Smart Cookies', 'Yes'),
               array('Aug 1st, 2006', 'Anti-Java Cake', 'No'),
           ));

           exit;*/
        $allExecutedTransactionGroupByPortfolioId = Hash::combine($allExecutedTransaction, '{n}.id', '{n}', '{n}.portfolio_id');

        $StockBangladesh = $this->Components->load('StockBangladesh');
        $instrumentList = $StockBangladesh->instrumentList(3);

        $Omo = $this->Components->load('Omo');
        $userList = $Omo->getUsersList(3, 1);

        foreach ($allExecutedTransactionGroupByPortfolioId as $oneUserTrans) {

            $todayGrandTotal = 0;
            $userReport = '';
            $emailSubject = '';

            $oneUserTransGroupByTid = Hash::combine($oneUserTrans, '{n}.id', '{n}', '{n}.transaction_type_id');

            foreach ($oneUserTransGroupByTid as $transByTid) {
                $grandTotal = 0;
                $oneUserTransGroupByIns = Hash::combine($transByTid, '{n}.id', '{n}', '{n}.instrument_id');
                // pr($oneUserTransGroupByIns);

                foreach ($oneUserTransGroupByIns as $oneInsAllTrans) {
                    $totalAmounOfThisInstrument = 0;
                    $totalCostOfThisInstrument = 0;
                    $userReport .= "<table>";
                    $userReport .= $yourTmpHtmlHelper->tableHeaders(array('Quantity', 'Instrument code', 'Order type', ' Rate / price ', '    OrderId   ', '     ExecId    ', '   Transaction Time   '));
                    foreach ($oneInsAllTrans as $eachTrans) {
                        //pr($eachTrans);
                        $pid = $eachTrans['portfolio_id'];

                        $transaction_type_id = $eachTrans['transaction_type_id'];
                        $irn = $userList[$pid]['internal_ref_no'];
                        $useremail = $userList[$pid]['email'];
                        $username = $userList[$pid]['username'];
                        $irn = strtoupper($irn);
                        $amount = $eachTrans['amount'];
                        $rate = $eachTrans['rate'];
                        $instrument_id = $eachTrans['instrument_id'];
                        $instrument_code = $instrumentList[$instrument_id];
                        $transaction_time = $eachTrans['transaction_time'];

                        $transaction_time = CakeTime::nice($transaction_time);
                        $dse_order_id = $eachTrans['dse_order_id'];
                        $dse_execution_id = $eachTrans['dse_execution_id'];

                        $order = '';
                        $order_present = '';
                        if ($transaction_type_id == 1) {
                            $order = 'bought';
                            $order_present = 'buy';
                        } else {
                            $order = 'sold';
                            $order_present = 'sell';
                        }
                        $rep = $yourTmpHtmlHelper->tableCells(array(array($amount, $instrument_code, $order, $rate, $dse_order_id, $dse_execution_id, $transaction_time)));
                        $userReport .= $rep;
                        //    $rep="$amount $instrument_code $order at $rate Tk. DSE order ID=$dse_order_id, DSE execution ID=$dse_execution_id and transaction=$transaction_time<br/>";
                        //  $userReport="$userReport $rep";

                        $totalAmounOfThisInstrument += $amount;
                        $cost = $amount * $rate;
                        $totalCostOfThisInstrument += $cost;
                    }
                    $userReport .= "</table>";
                    $avg = $totalCostOfThisInstrument / $totalAmounOfThisInstrument;
                    $avg = number_format($avg, 2, '.', '');
                    $rep = "<h4>$totalAmounOfThisInstrument $instrument_code $order . Money spent $totalCostOfThisInstrument Tk and Average Cost was $avg Tk.</h4>";
                    $userReport .= $rep;

                    $grandTotal += $totalCostOfThisInstrument;
                    $grandTotal = number_format($grandTotal, 2, '.', '');
                }
                $rep = "<h3>Total $order_present transaction was $grandTotal Taka </h3>";
                $userReport .= $rep;

                $todayGrandTotal += $grandTotal;
                $sub = "$order $grandTotal Tk. | ";
                $sub = strtoupper($sub);
                $emailSubject .= $sub;
            }

            $todayGrandTotal = number_format($todayGrandTotal, 2, '.', '');
            $rep = "<h3>CONGRATULATIONS! YOU HAVE MADE $todayGrandTotal Tk. TRANSACTION (buy+sell) IN TOTAL</h3>";
            $userReport .= $rep;

            $sub = "Total Transaction $todayGrandTotal Tk. | Account: $irn.";
            $sub = strtoupper($sub);
            $emailSubject .= $sub;
            //  pr($userReport);


            if ($userReport != '') {
                $fullbody = "Dear $username, <br/> <br/>Here are today's confirm transactions of $irn account<br/><br/> $userReport <br/><br/>Thanks for trading with us<br/>StockBangladesh OMO PLUS Team";
                echo "$emailSubject <br/>";

                // CakeEmail::deliver($useremail, "$emailSubject", "$fullbody", array('from' => 'info@stockbangladesh.com', 'emailFormat' => 'html'));//info@stockbangladesh.com

                $email = new CakeEmail('smtp');
                $email->to("$useremail")
                    ->subject("$emailSubject")
                    ->emailFormat('html')
                    ->send("$fullbody");

            }


        }

    }

    public function runBalanceFis()
    {

        //Configure::write('debug', 2);

        $StockBangladesh = $this->Components->load('StockBangladesh');
        $Omo = $this->Components->load('Omo');


        // checking if user is allowed to do so
        $brokerId = Configure::read('broker.fis.id');
        if ($this->Auth->user('group_id') > 1) {  // if not super admin
            if ($brokerId != $this->Auth->user('broker_id')) {
                echo "This is not your house";
                exit;
            }
        }

        // preparing inr according to hac format (pading leading zero)

        $userList = $Omo->getUsersList(4, 1);
        $brokerUsers = array();
        foreach ($userList[$brokerId] as $irn => $arr) {
            $key = trim($irn);
            $key = str_pad($key, 6, "0", STR_PAD_LEFT);
            $key = strtoupper($key);
            $brokerUsers[$key] = $arr;
        }

        // generating file path
        $balance_file_path = Configure::read('broker.fis.balance_file_path');
        $fileArr = $StockBangladesh->scan_dir($balance_file_path);

        $fullFilePath = "$balance_file_path/" . $fileArr[0];
       // $xldata = $Omo->xlsToArray($fullFilePath, 11);


        $file = fopen($fullFilePath, "r");
        $dataToSave2 = array();
        while (!feof($file)) {
            $row = fgetcsv($file);

            $internal_ref_no = trim($row[0]);
            $internal_ref_no = strtoupper($internal_ref_no);
            $internal_ref_no = str_pad($internal_ref_no, 6, "0", STR_PAD_LEFT);

            if (isset($brokerUsers[$internal_ref_no])) {
                $pid = $brokerUsers[$internal_ref_no]['portfolio_id'];

                $ppower = (float)str_replace(',', '', $row[4]);

                $temp2 = array();
                $temp2['id'] = $pid;
                /* $temp2['total_deposit'] = $deposit;
                 $temp2['total_withdraw'] = $withdraw;
                 $temp2['total_realized'] = $realized;*/
                $temp2['total_stats_updated'] = date('Y-m-d H:i:s');
                $temp2['balance'] = $ppower;

                $dataToSave2[] = $temp2;
            }

        }




        $model2 = ClassRegistry::init('Portfolio');


        if (count($dataToSave2)) {

            $model2->saveMany($dataToSave2, array('atomic' => true));
            echo count($dataToSave2) . ' balanace updated';


            //  $rt = Router::url('/', true) . "Stations/runWithdrawDeposit";

            // echo "<br /><a target='_blank' href='$rt'><h3>Run Withdraw/Deposit Script</h3></a> <br />";
        }


        exit;


    }

    ///////////////////////////////////////////////////////////////////for Fakhrul Islam House END////////////////////////////////////////////////////////////////////


    ///////////////////////////////////////////////////////////////////for Commerce broker House////////////////////////////////////////////////////////////////////
    public function runBalanceCommerce()
    {
        Configure::write('debug', 2);


        $StockBangladesh = $this->Components->load('StockBangladesh');


        // checking if user is allowed to do so
        $brokerId = Configure::read('broker.commerce.id');
        if ($this->Auth->user('group_id') > 1) {  // if not super admin
            if ($brokerId != $this->Auth->user('broker_id')) {
                echo "This is not your house";
                exit;
            }
        }

        // generating file path
        $balance_file_path = Configure::read('broker.commerce.balance_file_path');
        $fileArr = $StockBangladesh->scan_dir($balance_file_path);
        $fullFilePath = "$balance_file_path/" . $fileArr[0];


        $fileDate='';
        // reading file
        $file = fopen($fullFilePath, "r");
        $powerArr = array();
        $pattern=array();
        while (!feof($file)) {
            $row = fgetcsv($file);

            $internal_ref_no = trim($row[8]);
            $internal_ref_no = strtoupper($internal_ref_no);
            $powerArr[$internal_ref_no]['purchase_power'] = $row[10];
            $deposit = 0;
            $withdraw =0;
            $realized = 0;
            $powerArr[$internal_ref_no]['deposit'] = $deposit;
            $powerArr[$internal_ref_no]['withdraw'] = $withdraw;
            $powerArr[$internal_ref_no]['realized'] = $realized;


        }


        $Omo = $this->Components->load('Omo');
        $userList = $Omo->getUsersList(4, 1);
        $brokerUsers = array();
        foreach ($userList[$brokerId] as $irn => $arr) {
            $key = strtoupper($irn);
            $brokerUsers[$key] = $arr;
        }


        $dataToSave2 = array();
        foreach ($brokerUsers as $irn => $usr) {
            if (isset($powerArr[$irn])) {
                $pid = $usr['portfolio_id'];
                $id = $usr['id']; //userid
                $balance = $usr['balance'];

                $ppower = $powerArr[$irn]['purchase_power'];
                $ppower = (float)str_replace(',', '', $ppower);

                /*  $deposit = $powerArr[$irn]['deposit'];
                  $deposit = (float)str_replace(',', '', $deposit);

                  $withdraw = $powerArr[$irn]['withdraw'];
                  $withdraw = (float)str_replace(',', '', $withdraw);

                  $realized = $powerArr[$irn]['realized'];
                  $realized = (float)str_replace(',', '', $realized);*/



                // update portfolio table balance
                $temp2 = array();
                $temp2['id'] = $pid;
                /* $temp2['total_deposit'] = $deposit;
                 $temp2['total_withdraw'] = $withdraw;
                 $temp2['total_realized'] = $realized;*/
                $temp2['total_stats_updated'] = date('Y-m-d H:i:s');
                $temp2['balance'] = $ppower;

                $dataToSave2[] = $temp2;
                // }
            }

        }


        $model2 = ClassRegistry::init('Portfolio');


        if (count($dataToSave2)) {
            $model2->saveMany($dataToSave2, array('atomic' => true));
            echo count($dataToSave2) . ' balanace updated';

        }

        /*
                    // deleting all existing file

                      $dir = 'hac/balance/*';

                      $files = glob($dir); // get all file names
                      foreach ($files as $file) { // iterate files
                          if (is_file($file))
                              unlink($file); // delete file
                      }

        */
        exit;






    }
    public function runTradeInsCommerce($sent_email=0)
    {

         Configure::write('debug', 2);
        App::uses('CakeEmail', 'Network/Email');
        App::uses('CakeTime', 'Utility');


        pr("Commerce");

        $StockBangladesh = $this->Components->load('StockBangladesh');
        $ip = $StockBangladesh->getIp();
        $instrumentList = $StockBangladesh->instrumentList(2);

        $brokerId = Configure::read('broker.commerce.id');
        if ($this->Auth->user('group_id') > 1) {  // if not super admin
            if ($brokerId != $this->Auth->user('broker_id')) {
                echo "This is not your house";
                exit;
            }
        }

        // generating file path

        $tradeins_file_path = Configure::read('broker.commerce.tradeins_file_path');
        $fileArr = $StockBangladesh->scan_dir($tradeins_file_path);




        $today = CakeTime::nice(date ("F d Y"));
        $fullFilePath = "$tradeins_file_path/" . $fileArr[0];
        App::uses('CakeTime', 'Utility');
        $reportDate=CakeTime::nice(date ("F d Y", filemtime($fullFilePath)));

        if ($reportDate != $today) {
            echo $fileArr[0];
            echo "<br/>This is not today's file.<br/>";
            exit;
        }



        $Omo = $this->Components->load('Omo');
        $userList = $Omo->getUsersList(4, 1);


        $brokerUsers = array();
        foreach ($userList[$brokerId] as $irn => $arr) {
            $key = strtoupper($irn);
            $brokerUsers[$key] = $arr;
        }


        $tradeArr = array();
        $xldata = $Omo->xlsToArray($fullFilePath, 8);


        $paternArray= array
        (
            '0' => 'ExecTime',
            '1' => 'Symbol',
            '2' => 'Name',
            '3' => 'Side',
            '4' => 'ExecQty',
            '5' => 'ExecPrice',
            '6' => 'Client A/C',
            '7' => 'ExecType',
            '8' => 'ExecStat',
            '9' => 'OrderQty',
            '10' => 'CumQty',
            '11' => 'OrdLimit',
            '12' => 'OrdAvP',
            '13' => 'SubStatus',
            '14' => 'Trader',
            '15' => 'A/C CDS',
            '16' => 'Ccy',
            '17' => 'ExecID',
            '18' => 'TFOrderID',
            '19' => 'ExecRefID'
        );

        if ($xldata[1] !== $paternArray)//chk order
        {


            echo"File Column order is not in correct format.";
            echo "Expected File Order Is: <pre>";
            print_r($paternArray);

            exit;

        }

        unset($xldata[0]);

        $dataToSaveForRaw = array();
        $reportDate = '';
        foreach ($xldata as $row) {
            $temp = array();
            $internal_ref_no = trim($row[6]);
            $internal_ref_no = strtoupper($internal_ref_no);
            $instrument_code = trim($row[1]);
            $transaction_type = trim($row[3]);

            $transaction_time = trim($row[0]);

            $transaction_time = PHPExcel_Style_NumberFormat::toFormattedString($transaction_time, 'hh:mm:ss');

            //$reportDate2 = '2015/09/15'; //for backdated tradeIns
            $reportDate2 = date('Y/m/d');


            $transaction_time="$reportDate2 $transaction_time";

            $transaction_time = date("Y-m-d H:i:s", strtotime($transaction_time));
            //pr($transaction_time);

            $amount = trim($row[4]);
            $rate = trim($row[5]);
            $rate = (float)str_replace(',', '', $rate);
            $order_id = trim($row[18]);
            $execution_id = trim($row[17]);
            $execution_arr = explode('_', $execution_id);
            $execution_id = $execution_arr[count($execution_arr) - 1];

            $temp['instrument_code'] = $instrument_code;
            $temp['transaction_time'] = $transaction_time;
            $temp['transaction_type'] = $transaction_type;
            $temp['amount'] = $amount;
            $temp['rate'] = $rate;
            $temp['order_id'] = $order_id;
            $temp['execution_id'] = $execution_id;
            $tradeArr[$internal_ref_no][] = $temp;

        }

        $model = ClassRegistry::init('PortfolioTransaction');
        $dataToSave = array();
        $updateCounter = 0;



        foreach ($brokerUsers as $irn => $usr) {

            if (isset($tradeArr[$irn])) {

                // pr("set");
                foreach ($tradeArr[$irn] as $eachRealTransaction) {

                    $pid = $usr['portfolio_id'];
                    $broker_fee = $usr['broker_fee'];

                    $instrument_code = $eachRealTransaction['instrument_code'];
                    if ($eachRealTransaction['transaction_type'] == 'Sell') {
                        $transaction_type_id = 2; // sell
                    } else {
                        $transaction_type_id = 1; // buy
                    }

                    $temp = array();
                    $temp['portfolio_id'] = $pid;
                    $temp['instrument_id'] = $instrumentList[$instrument_code];
                    $temp['transaction_type_id'] = $transaction_type_id;
                    $temp['amount'] = abs($eachRealTransaction['amount']);
                    $temp['rate'] = $eachRealTransaction['rate'];
                    $temp['commission'] = $broker_fee;
                    $transaction_time = $eachRealTransaction['transaction_time'];
                    $temp['transaction_time'] = $transaction_time;
                    $temp['dse_order_id'] = $eachRealTransaction['order_id'];
                    $temp['dse_execution_id'] = $eachRealTransaction['execution_id'];

                    $dse_order_id = $eachRealTransaction['order_id'];
                    $dse_execution_id = $eachRealTransaction['execution_id'];

                    $transaction = $model->find('all', array(
                            'conditions' => "PortfolioTransaction.portfolio_id=$pid and PortfolioTransaction.dse_order_id LIKE '$dse_order_id' and PortfolioTransaction.dse_execution_id LIKE '$dse_execution_id'"
                        , 'recursive' => -1
                        )

                    );

                    if (count($transaction))  // if already exist
                    {
                        $updateCounter++;
                        $temp['id'] = $transaction[0]['PortfolioTransaction']['id'];  // setting primary id. So it will update instead of creating new
                    }

                    $dataToSave[] = $temp;
                    $paternArray= array
                    (
                        '0' => 'ExecTime',
                        '1' => 'Symbol',
                        '2' => 'Name',
                        '3' => 'Side',
                        '4' => 'ExecQty',
                        '5' => 'ExecPrice',
                        '6' => 'Client A/C',
                        '7' => 'ExecType',
                        '8' => 'ExecStat',
                        '9' => 'OrderQty',
                        '10' => 'CumQty',
                        '11' => 'OrdLimit',
                        '12' => 'OrdAvP',
                        '13' => 'SubStatus',
                        '14' => 'Trader',
                        '15' => 'A/C CDS',
                        '16' => 'Ccy',
                        '17' => 'ExecID',
                        '18' => 'TFOrderID',
                        '19' => 'ExecRefID'
                    );

                    //$rate = (float)str_replace(',', '', $rate);
                    $tempForRaw['client_ac'] = $internal_ref_no;
                    $tempForRaw['symbol'] = $instrument_code;
                    $tempForRaw['side'] = $transaction_type;
                    $tempForRaw['order_qty'] = abs($eachRealTransaction['amount']);
                    $tempForRaw['order_limit_price'] = trim($row[11]);
                    $tempForRaw['substatus'] = trim($row[13]);
                    $tempForRaw['execute_qty'] = trim($row[4]);
                    $tempForRaw['execute_price'] = $eachRealTransaction['rate'];
                    $tempForRaw['execute_time'] = $transaction_time;
                    $tempForRaw['execute_stat'] = trim($row[8]);
                    $tempForRaw['order_avg_price'] = trim($row[12]);
                    $tempForRaw['ac_cds'] = trim($row[15]);
                    $tempForRaw['execute_type'] = trim($row[7]);
                    $tempForRaw['execution_id'] = trim($row[17]);
                    $tempForRaw['order_id'] = trim($row[18]);
                    $tempForRaw['broker_id'] = $brokerId;
                    if ($eachRealTransaction['rate']) {
                        $reportDate = $transaction_time;
                        $dataToSaveForRaw[] = $tempForRaw;
                    }
                }

            }

        }



        if($sent_email) {  // by force sending email only
            if ($reportDate == $today) {  // if it is today tradeins we will sent email
                echo "email sending........<br />";
                $this->emailReportCommerce($dataToSave, $brokerUsers);

                echo ".................email sending finished<br />";
                exit;
            }
        }


        if (count($dataToSave)) {

            $model->deleteAll("Portfolio.broker=$brokerId and PortfolioTransaction.dse_execution_id  LIKE  'temp'", false);
            $model->saveMany($dataToSave, array('atomic' => true));
            $n = (count($dataToSave) - $updateCounter);
            echo $n . 'rows inserted in portfolio transaction table and ' . $updateCounter . ' rows updated';

            //CakeEmail::deliver('info@stockbangladesh.com', "Trade Ins of $reportDate2 HAC run successfully", "$n rows inserted and $updateCounter rows updated in portfolio transaction table. Script run from $ip", array('from' => 'omo@stockbangladesh.net'));

            $email  = new CakeEmail('smtp');
            $email->to('info@stockbangladesh.com')
                ->subject("Trade Ins of $reportDate2 Commerce run successfully")
                ->send("$n rows inserted and $updateCounter rows updated in portfolio transaction table. Script run from $ip");



        }


        $rawmodel = ClassRegistry::init('RawTradin');
        if (count($dataToSaveForRaw)) {

            if($rawmodel->saveMany($dataToSaveForRaw, array('atomic' => true)))
            {
                $count=count($dataToSaveForRaw);
                pr($fileArr[0]);
                echo"saved $count ";
            }
        }

        if($updateCounter==0) { // if this email was not sent previously
            if ($reportDate == $today) {  // if it is today tradeins we will sent email
                echo "email sending........<br />";
                $this->emailReportCommerce($dataToSave, $brokerUsers);

                echo ".................email sending finished<br />";
            }
        }
        else
        {
            echo "<br/>email previously sent <br />";

        }


        // deleting all existing file

        /* $dir = 'hac/tradeins/*';

         $files = glob($dir); // get all file names
         foreach ($files as $file) { // iterate files
             if (is_file($file))
                 unlink($file); // delete file
         }*/


        exit;

    }
    public function emailReportCommerce($allExecutedTransaction)
    {
        // Configure::write('debug', 2);
        App::uses('CakeTime', 'Utility');
        App::uses('CakeEmail', 'Network/Email');

        App::uses('HtmlHelper', 'View/Helper');
        $yourTmpHtmlHelper = new HtmlHelper(new View());

        /*   echo $yourTmpHtmlHelper->tableCells(array(
               array('Jul 7th, 2007', 'Best Brownies', 'Yes'),
               array('Jun 21st, 2007', 'Smart Cookies', 'Yes'),
               array('Aug 1st, 2006', 'Anti-Java Cake', 'No'),
           ));

           exit;*/
        $allExecutedTransactionGroupByPortfolioId = Hash::combine($allExecutedTransaction, '{n}.id', '{n}', '{n}.portfolio_id');

        $StockBangladesh = $this->Components->load('StockBangladesh');
        $instrumentList = $StockBangladesh->instrumentList(3);

        $Omo = $this->Components->load('Omo');
        $userList = $Omo->getUsersList(3, 1);

        foreach ($allExecutedTransactionGroupByPortfolioId as $oneUserTrans) {

            $todayGrandTotal = 0;
            $userReport = '';
            $emailSubject = '';

            $oneUserTransGroupByTid = Hash::combine($oneUserTrans, '{n}.id', '{n}', '{n}.transaction_type_id');

            foreach ($oneUserTransGroupByTid as $transByTid) {
                $grandTotal = 0;
                $oneUserTransGroupByIns = Hash::combine($transByTid, '{n}.id', '{n}', '{n}.instrument_id');
                // pr($oneUserTransGroupByIns);

                foreach ($oneUserTransGroupByIns as $oneInsAllTrans) {
                    $totalAmounOfThisInstrument = 0;
                    $totalCostOfThisInstrument = 0;
                    $userReport .= "<table>";
                    $userReport .= $yourTmpHtmlHelper->tableHeaders(array('Quantity', 'Instrument code', 'Order type', ' Rate / price ', '    OrderId   ', '     ExecId    ', '   Transaction Time   '));
                    foreach ($oneInsAllTrans as $eachTrans) {
                        //pr($eachTrans);
                        $pid = $eachTrans['portfolio_id'];

                        $transaction_type_id = $eachTrans['transaction_type_id'];
                        $irn = $userList[$pid]['internal_ref_no'];
                        $useremail = $userList[$pid]['email'];
                        $username = $userList[$pid]['username'];
                        $irn = strtoupper($irn);
                        $amount = $eachTrans['amount'];
                        $rate = $eachTrans['rate'];
                        $instrument_id = $eachTrans['instrument_id'];
                        $instrument_code = $instrumentList[$instrument_id];
                        $transaction_time = $eachTrans['transaction_time'];

                        $transaction_time = CakeTime::nice($transaction_time);
                        $dse_order_id = $eachTrans['dse_order_id'];
                        $dse_execution_id = $eachTrans['dse_execution_id'];

                        $order = '';
                        $order_present = '';
                        if ($transaction_type_id == 1) {
                            $order = 'bought';
                            $order_present = 'buy';
                        } else {
                            $order = 'sold';
                            $order_present = 'sell';
                        }
                        $rep = $yourTmpHtmlHelper->tableCells(array(array($amount, $instrument_code, $order, $rate, $dse_order_id, $dse_execution_id, $transaction_time)));
                        $userReport .= $rep;
                        //    $rep="$amount $instrument_code $order at $rate Tk. DSE order ID=$dse_order_id, DSE execution ID=$dse_execution_id and transaction=$transaction_time<br/>";
                        //  $userReport="$userReport $rep";

                        $totalAmounOfThisInstrument += $amount;
                        $cost = $amount * $rate;
                        $totalCostOfThisInstrument += $cost;
                    }
                    $userReport .= "</table>";
                    $avg = $totalCostOfThisInstrument / $totalAmounOfThisInstrument;
                    $avg = number_format($avg, 2, '.', '');
                    $rep = "<h4>$totalAmounOfThisInstrument $instrument_code $order . Money spent $totalCostOfThisInstrument Tk and Average Cost was $avg Tk.</h4>";
                    $userReport .= $rep;

                    $grandTotal += $totalCostOfThisInstrument;
                    $grandTotal = number_format($grandTotal, 2, '.', '');
                }
                $rep = "<h3>Total $order_present transaction was $grandTotal Taka </h3>";
                $userReport .= $rep;

                $todayGrandTotal += $grandTotal;
                $sub = "$order $grandTotal Tk. | ";
                $sub = strtoupper($sub);
                $emailSubject .= $sub;
            }

            $todayGrandTotal = number_format($todayGrandTotal, 2, '.', '');
            $rep = "<h3>CONGRATULATIONS! YOU HAVE MADE $todayGrandTotal Tk. TRANSACTION (buy+sell) IN TOTAL</h3>";
            $userReport .= $rep;

            $sub = "Total Transaction $todayGrandTotal Tk. | Account: $irn.";
            $sub = strtoupper($sub);
            $emailSubject .= $sub;
            //  pr($userReport);


            if ($userReport != '') {
                $fullbody = "Dear $username, <br/> <br/>Here are today's confirm transactions of $irn account<br/><br/> $userReport <br/><br/>Thanks for trading with us<br/>StockBangladesh OMO PLUS Team";
                echo "$emailSubject <br/>";

                // CakeEmail::deliver($useremail, "$emailSubject", "$fullbody", array('from' => 'info@stockbangladesh.com', 'emailFormat' => 'html'));//info@stockbangladesh.com

                $email  = new CakeEmail('smtp');
                $email->to("$useremail")
                    ->subject("$emailSubject")
                    ->emailFormat('html')
                    ->send("$fullbody");

            }


        }

    }

    ///////////////////////////////////////////////////////////////////for Apex broker House END////////////////////////////////////////////////////////////////////

    public function runTradeIns_old()
    {
     //   Configure::write('debug', 2);
        App::uses('CakeEmail', 'Network/Email');


        $StockBangladesh = $this->Components->load('StockBangladesh');
        $ip = $StockBangladesh->getIp();
        $instrumentList = $StockBangladesh->instrumentList(2);

        $brokerId = Configure::read('broker.apex.id');
        if ($this->Auth->user('group_id') > 1) {  // if not super admin
            if ($brokerId != $this->Auth->user('broker_id')) {
                echo "This is not your house";
                exit;
            }
        }

        // generating file path
        $tradeins_file_path = Configure::read('broker.apex.tradeins_file_path');
        $fileArr = $StockBangladesh->scan_dir($tradeins_file_path);
        $fullFilePath = "$tradeins_file_path/" . $fileArr[0];


        $Omo = $this->Components->load('Omo');
        $userList = $Omo->getUsersList(4, 1);


        $brokerUsers = array();
        foreach ($userList[11] as $irn => $arr) {
            $key = trim($irn);
            $key = str_pad($key, 5, "0", STR_PAD_LEFT);
            $key = strtoupper($key);
            $brokerUsers[$key] = $arr;
        }


        $tradeArr = array();
        $xldata = $Omo->xlsToArray($fullFilePath);

        // pr($xldata);
        // exit;
        $dataToSaveForRaw=array();
        foreach ($xldata as $row) {
            $temp = array();
            $tempForRaw = array();
            $internal_ref_no = trim($row[1]);
            $internal_ref_no = strtoupper($internal_ref_no);
            $instrument_code = trim($row[2]);
            $transaction_time = trim($row[4]);
            $amount = trim($row[5]);
            $rate = trim($row[6]);
            $order_id = trim($row[8]);
            $execution_id = trim($row[9]);

            $temp['instrument_code'] = $instrument_code;
            $temp['transaction_time'] = $transaction_time;
            $temp['amount'] = $amount;
            $temp['rate'] = $rate;
            $temp['order_id'] = $order_id;
            $temp['execution_id'] = $execution_id;
            $tradeArr[$internal_ref_no][] = $temp;

            $rate = (float)str_replace(',', '', $rate);
            $tempForRaw['dealer_id']=trim($row[0]);
            $tempForRaw['client_id']=trim($row[1]);
            $tempForRaw['instrument_code']=trim($row[2]);
            $tempForRaw['board']=trim($row[3]);
            $tempForRaw['execute_time']=trim($row[4]);
            $tempForRaw['execute_qty']=trim($row[5]);
            $tempForRaw['price']=$rate;
            $tempForRaw['order_id']=trim($row[8]);
            $tempForRaw['execution_id']=trim($row[9]);
            $tempForRaw['broker_id']=$brokerId;
            if($rate)
            {
                $dataToSaveForRaw[]=$tempForRaw;
            }
        }

        $dateRow = $xldata[1];

        $reportDate = $dateRow[13];
        $reportDate = date('Y-m-d', strtotime($reportDate));
        $today = date('Y-m-d');
        if ($reportDate == '1970-01-01') {
            echo "date not found";
            CakeEmail::deliver('info@stockbangladesh.com', 'Trade Ins problem-Apex', 'Date string can not be found', array('from' => 'omo@stockbangladesh.net'));
            exit;
        }
        if ($reportDate != $today) {
            echo "This is not today's script. We have found script date=$reportDate";
            exit;
        }

        //   pr($tradeArr);
        $model = ClassRegistry::init('PortfolioTransaction');
        $dataToSave = array();
        $updateCounter = 0;


        foreach ($brokerUsers as $irn => $usr) {
            if (isset($tradeArr[$irn])) {

                foreach ($tradeArr[$irn] as $eachRealTransaction) {

                    $pid = $usr['portfolio_id'];

                    $instrument_code = $eachRealTransaction['instrument_code'];
                    if ($eachRealTransaction['amount'] < 0) {
                        $transaction_type_id = 2; // sell
                    } else {
                        $transaction_type_id = 1; // buy
                    }

                    $temp = array();
                    $temp['portfolio_id'] = $pid;
                    $temp['instrument_id'] = $instrumentList[$instrument_code];
                    $temp['transaction_type_id'] = $transaction_type_id;
                    $temp['amount'] = abs($eachRealTransaction['amount']);
                    $temp['rate'] = $eachRealTransaction['rate'];

                    $transaction_time = $eachRealTransaction['transaction_time'];
                    $temp['transaction_time'] = "$reportDate $transaction_time";
                    $temp['dse_order_id'] = $eachRealTransaction['order_id'];
                    $temp['dse_execution_id'] = $eachRealTransaction['execution_id'];

                    $dse_order_id = $eachRealTransaction['order_id'];
                    $dse_execution_id = $eachRealTransaction['execution_id'];

                    $transaction = $model->find('all', array(
                            'conditions' => "PortfolioTransaction.portfolio_id=$pid and PortfolioTransaction.dse_order_id LIKE '$dse_order_id' and PortfolioTransaction.dse_execution_id LIKE '$dse_execution_id'"
                        , 'recursive' => -1
                        )

                    );

                    if (count($transaction))  // if already exist
                    {
                        $updateCounter++;
                        $temp['id'] = $transaction[0]['PortfolioTransaction']['id'];  // setting primary id. So it will update instead of creating new
                    }

                    $dataToSave[] = $temp;
                }

            }

        }

        $this->emailReport($dataToSave, $brokerUsers);
        //   pr($dataToSave);
//exit;
        if (count($dataToSave)) {
            $model->deleteAll("Portfolio.broker=$brokerId and PortfolioTransaction.dse_execution_id  LIKE  'temp'", false);
            $model->saveMany($dataToSave, array('atomic' => true));
            $n = (count($dataToSave) - $updateCounter);
            echo $n . 'rows inserted in portfolio transaction table and ' . $updateCounter . ' rows updated';
            /* echo "<pre>";
             print_r($dataToSave);*/
            CakeEmail::deliver('info@stockbangladesh.com', 'Trade Ins run sucessfuly-Apex', "$n rows inserted and $updateCounter rows updated in portfolio transaction table. Script run from $ip", array('from' => 'omo@stockbangladesh.net'));

            // setting $prev_execute_report_str to null so that nextdtay its count =0 (so that pass validation)
            App::uses('Broker', 'Model');
            $Broker = new Broker();
            $broker_id = $this->Auth->user('broker_id');
            $Broker->id = $broker_id;
            $prev_execute_report_str = null;
            $Broker->saveField('execute_report', $prev_execute_report_str);
        }
        $rawmodel = ClassRegistry::init('RawTradin');
        if (count($dataToSaveForRaw)) {

            $rawmodel->saveMany($dataToSaveForRaw, array('atomic' => true));
        }


        exit;
    }

    public function access_portfolio()
    {

      //  Configure::write('debug', 3);
      //  clearstatcache() ;
      //  error_reporting(0);
        $bro_id=$this->Auth->user('broker_id');

        //$this->layout = 'ajax';
        $user = $this->Auth->user();
        if (isset($user['id'])) {
            $user['requesting_user_id'] = $user['id'];
            $this->Auth->login($user);
        }


        require_once(APP . 'webroot' . DS . 'xcrud' . DS . 'xcrud.php');
        $xcrud = Xcrud::get_instance();
        $xcrud->table('users');
        $xcrud->columns('users.id,users.username,users.email,users.internal_ref_no,users.broker_fee,users.active,users.broker_id');
        $xcrud->fields('users.id,users.username,users.email,users.internal_ref_no,users.broker_fee,users.active,users.broker_id');
        $xcrud->where('broker_id',$bro_id);
        $xcrud->relation('broker_id', 'brokers', 'id', 'broker_name');
        $xcrud->unset_add();
        $xcrud->unset_edit();
        $xcrud->unset_view();
        $xcrud->unset_remove();
        $xcrud->button('http://www.new.stockbangladesh.net/Users/impersonalize/{id}/');

        $this->set('xcrud', $xcrud);

    }

    public function runWithdrawDeposit()
    {
        Configure::write('debug', 2);
        require_once(APP . 'Vendor' . DS . 'phpexcel' . DS . 'PHPExcel.php');

        $brokerId = Configure::read('broker.hac.id');
        if ($this->Auth->user('group_id') > 1) {  // if not super admin
            if ($brokerId != $this->Auth->user('broker_id')) {
                echo "This is not your house";
                exit;
            }
        }

        $StockBangladesh = $this->Components->load('StockBangladesh');
        $ip = $StockBangladesh->getIp();
        // $instrumentList = $StockBangladesh->instrumentList(2);
        // $metaKey = array("category");
        // $instrumentInfo = $StockBangladesh->getFundamentalInfo(0, $metaKey);





        $Omo = $this->Components->load('Omo');
        $userList = $Omo->getUsersList(4, 1);
        $brokerUsers = array();
        foreach ($userList[$brokerId] as $irn => $arr) {
            $key = trim($irn);
            $key = str_pad($key, 5, "0", STR_PAD_LEFT);
            $key = strtoupper($key);
            //  if ($key == '0H204')
            $brokerUsers[$key] = $arr;
        }


        //  $brokerUsers= Hash::sort($brokerUsers, '{s}internal_ref_no', 'asc');
        ksort($brokerUsers);

        $array_data = array();

        $portfolios_file_path = Configure::read('broker.hac.portfolios_file_path');
        $fileArr = $StockBangladesh->scan_dir($portfolios_file_path);
        $fullFilePath = "$portfolios_file_path/" . $fileArr[0];


        $file = fopen($fullFilePath, "r");

        // read each data row in the file

        while (!feof($file)) {
            $row = fgetcsv($file);
            if(strpos($row[0],'Date: ')==true)
            {
                $fileDate=$row[0];
                $fileDate = explode(':', $fileDate);
                $fileDate = $fileDate[1];
                $fileDate=date('d-m-Y',strtotime($fileDate));
            }
            $array_data[$row[1]]= $row;

        }


        if($fileDate!= date('d-m-Y'))
        {
            echo "<br>";
            echo "<h2>this is not today's portfolio file.please recheck and upload the correct file again</h2>";
            exit;
        }




        foreach($brokerUsers as $irn=>$user)
        {


            if(isset($array_data[$user['internal_ref_no']]))
            {
                $pid = $user['portfolio_id'];
                $deposit = $array_data[$user['internal_ref_no']][22];
                $deposit = (float)str_replace(',', '', $deposit);

                $withdraw = $array_data[$user['internal_ref_no']][24];
                $withdraw = (float)str_replace(',', '', $withdraw);

                $temp[$pid]['id']=$pid;
                $temp[$pid]['total_deposit'] = $deposit;
                $temp[$pid]['total_withdraw'] = $withdraw;

            }


        }

        $model = ClassRegistry::init('Portfolio');
        $model->saveMany($temp, array('atomic' => true));
        echo count($temp) . ' row updated';


        exit;


    }


}