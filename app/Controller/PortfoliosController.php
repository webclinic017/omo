<?php
App::uses('AppController', 'Controller');

/**
 * Portfolios Controller
 *
 * @property Portfolio $Portfolio
 * @property PaginatorComponent $Paginator
 */
class PortfoliosController extends AppController
{

    /**
     * Components
     *
     * @var array
     */
    public $helpers = array('StockBangladesh');
    public $components = array('Paginator');
    public $ttypeArr = array();

    public function beforeFilter()
    {
        parent::beforeFilter();

        $this->Auth->allow('p_power_edit');
        $this->Auth->allow();

    }

    function noop($array)
    {
        //do stuff to array and return the result
        return $array['transaction_type_id'];
    }

    /**
     * index method
     *
     * @return void
     */
    public function index()
    {
        /* Configure::write('debug', 2);
         pr($this->request->referer());
         exit;*/
        if ($this->request->referer() != '/') {
            $this->layout = 'ajax';
        }


//pr($portfolioHoldingsTransaction);
//pr($instrumentInfo);
//        exit;


//pr($portfolioHoldingsTransaction);

//pr($balance);

        //  exit;
    }
    public function index2()
    {
        /* Configure::write('debug', 2);
         pr($this->request->referer());
         exit;*/
        if ($this->request->referer() != '/') {
            $this->layout = 'ajax';
        }



    }


    /**
     * view method
     *
     * @throws NotFoundException
     * @param string $idsaveManyndex
     * @return void
     */
    public function view($id = null)
    {
        if (!$this->Portfolio->exists($id)) {
            throw new NotFoundException(__('Invalid portfolio'));
        }
        $options = array('conditions' => array('Portfolio.' . $this->Portfolio->primaryKey => $id));
        $this->set('portfolio', $this->Portfolio->find('first', $options));
    }





    /**
     * add method
     *
     * @return void
     */
    public function add()
    {
        if ($this->request->is('post')) {
            $this->Portfolio->create();
            if ($this->Portfolio->save($this->request->data)) {
                $this->Session->setFlash(__('The portfolio has been saved.'));
                return $this->redirect(array('action' => 'index'));
            } else {
                $this->Session->setFlash(__('The portfolio could not be saved. Please, try again.'));
            }
        }
        $users = $this->Portfolio->User->find('list');
        $this->set(compact('users'));
    }

    /**
     * edit method
     *
     * @throws NotFoundException
     * @param string $id
     * @return void
     */
    public function edit($id = null)
    {
        if (!$this->Portfolio->exists($id)) {
            throw new NotFoundException(__('Invalid portfolio'));
        }
        if ($this->request->is(array('post', 'put'))) {
            if ($this->Portfolio->save($this->request->data)) {
                $this->Session->setFlash(__('The portfolio has been saved.'));
                return $this->redirect(array('action' => 'index'));
            } else {
                $this->Session->setFlash(__('The portfolio could not be saved. Please, try again.'));
            }
        } else {
            $options = array('conditions' => array('Portfolio.' . $this->Portfolio->primaryKey => $id));
            $this->request->data = $this->Portfolio->find('first', $options);
        }
        $users = $this->Portfolio->User->find('list');
        $this->set(compact('users'));
    }

    /**
     * delete method
     *
     * @throws NotFoundException
     * @param string $id
     * @return void
     */
    public function delete($id = null)
    {
        $this->Portfolio->id = $id;
        if (!$this->Portfolio->exists()) {
            throw new NotFoundException(__('Invalid portfolio'));
        }
        $this->request->allowMethod('post', 'delete');
        if ($this->Portfolio->delete()) {
            $this->Session->setFlash(__('The portfolio has been deleted.'));
        } else {
            $this->Session->setFlash(__('The portfolio could not be deleted. Please, try again.'));
        }
        return $this->redirect(array('action' => 'index'));
    }

    public function edit_with_adjustment()
    {
        //  Configure::write('debug', 2);
        //$this->layout = 'ajax';

        require_once(APP . 'webroot' . DS . 'xcrud' . DS . 'xcrud.php');
        $xcrud = Xcrud::get_instance();
        $xcrud->table('users');
        $xcrud->columns('users.id,users.username,users.email,users.internal_ref_no,users.broker_id,users.portfolio_id,users.broker_fee,users.active,users.group_id');
        $xcrud->fields('users.id,users.username,users.email,users.internal_ref_no,users.broker_id,users.portfolio_id,users.broker_fee,users.active,users.group_id');
        $xcrud->relation('broker_id', 'brokers', 'id', 'broker_name');
        $xcrud->relation('group_id', 'groups', 'id', 'name');
        $xcrud->before_update('update_broker_fee');
        $xcrud->default_tab('users information');
        $portfolio_transactions = $xcrud->nested_table('Portfolio transaction', 'portfolio_id', 'portfolio_transactions', 'portfolio_id'); // 2nd level
        $portfolio_transactions->relation('portfolio_id', 'users', 'portfolio_id', 'username');
        $portfolio_transactions->relation('transaction_type_id', 'transaction_types', 'id', 'name');
        $portfolio_transactions->relation('instrument_id', 'instruments', 'id', 'instrument_code');
        $portfolio_transactions->before_insert('set_broker_fee');
        $portfolio_transactions->after_insert('adjust_purchase_power');

        $this->set('xcrud', $xcrud);

    }

    public function edit_no_adjustment()
    {
        //  Configure::write('debug', 2);
        //$this->layout = 'ajax';

        require_once(APP . 'webroot' . DS . 'xcrud' . DS . 'xcrud.php');
        $xcrud = Xcrud::get_instance();
        $xcrud->table('users');
        $xcrud->columns('users.id,users.username,users.email,users.internal_ref_no,users.broker_id,users.portfolio_id,users.broker_fee,users.active,users.group_id');
        $xcrud->fields('users.id,users.username,users.email,users.internal_ref_no,users.broker_id,users.portfolio_id,users.broker_fee,users.active,users.group_id');
        $xcrud->relation('broker_id', 'brokers', 'id', 'broker_name');
        $xcrud->relation('group_id', 'groups', 'id', 'name');
        $xcrud->before_update('update_broker_fee');
        $xcrud->default_tab('users information');
        $portfolio_transactions = $xcrud->nested_table('Portfolio transaction', 'portfolio_id', 'portfolio_transactions', 'portfolio_id'); // 2nd level
        $portfolio_transactions->relation('portfolio_id', 'users', 'portfolio_id', 'username');
        $portfolio_transactions->relation('transaction_type_id', 'transaction_types', 'id', 'name');
        $portfolio_transactions->relation('instrument_id', 'instruments', 'id', 'instrument_code');
        $portfolio_transactions->before_insert('set_broker_fee');

        $this->set('xcrud', $xcrud);

    }

    public function test()
    {
        //  Configure::write('debug', 2);
        //$this->layout = 'ajax';

        require_once(APP . 'webroot' . DS . 'xcrud' . DS . 'xcrud.php');
        $xcrud = Xcrud::get_instance();
        $xcrud->table('users');
        $xcrud->before_update('update_broker_fee');
        $xcrud->default_tab('users information');
        $portfolio_transactions = $xcrud->nested_table('Portfolio transaction', 'portfolio_id', 'portfolio_transactions', 'portfolio_id'); // 2nd level
        $portfolio_transactions->relation('portfolio_id', 'users', 'portfolio_id', 'username');
        $portfolio_transactions->relation('transaction_type_id', 'transaction_types', 'id', 'name');
        $portfolio_transactions->relation('instrument_id', 'instruments', 'id', 'instrument_code');
        $portfolio_transactions->before_insert('set_broker_fee');
        $portfolio_transactions->after_insert('adjust_purchase_power');

        $this->set('xcrud', $xcrud);

    }

    public function p_power_edit()
    {
        //Configure::write('debug', 2);
        //$this->layout = 'ajax';

        require_once(APP . 'webroot' . DS . 'xcrud' . DS . 'xcrud.php');
        $xcrud = Xcrud::get_instance();
        $xcrud->table('users');
        $xcrud->columns('users.id,users.username,users.email,users.internal_ref_no,users.broker_id,users.portfolio_id,users.broker_fee,users.active,users.group_id');
        $xcrud->fields('users.id,users.username,users.email,users.internal_ref_no,users.broker_id,users.portfolio_id,users.broker_fee,users.active,users.group_id');
        $xcrud->relation('broker_id', 'brokers', 'id', 'broker_name');
        $xcrud->relation('group_id', 'groups', 'id', 'name');
        $xcrud->before_update('update_broker_fee');
        $xcrud->default_tab('User list');
        $portfolio_transactions = $xcrud->nested_table('Purchase Power', 'portfolio_id', 'portfolio_transactions', 'portfolio_id'); // 2nd level
        $portfolio_transactions->where('portfolio_transactions.transaction_type_id =', 12);
        $portfolio_transactions->columns('portfolio_transactions.id,portfolio_transactions.rate');
        $portfolio_transactions->fields('portfolio_transactions.id,portfolio_transactions.rate');
        $portfolio_transactions->label('portfolio_transactions.rate', 'Purchase power');
        //$portfolio_transactions->set('portfolio_transactions.rate','100');

        //$portfolio_transactions->change_type('portfolio_transactions.rate','text','12122',20);
        $portfolio_transactions->column_callback('portfolio_transactions.rate', 'set_purchase_power');
        //$portfolio_transactions->field_callback('portfolio_transactions.rate','set_purchase_power');
        //$portfolio_transactions->relation('portfolio_id', 'users', 'portfolio_id', 'username');
        //$portfolio_transactions->relation('transaction_type_id', 'transaction_types', 'id', 'name');
        //$portfolio_transactions->relation('instrument_id', 'instruments', 'id', 'instrument_code');
        $portfolio_transactions->before_update('update_purchase_power');

        $this->set('xcrud', $xcrud);

    }

    public function performance()
    {
        //
        // die('Uc');
      //  Configure::write('debug', 2);
        $this->layout = 'ajax';

        if ($this->Auth->user('id')) {
            $pid = $this->Auth->user('portfolio_id');
        }

        //$id=3;  // for development testing only

        $this->Portfolio->contain('PortfolioTransaction');
        $allTransactions = $this->Portfolio->find('all', array(
                'conditions' => "Portfolio.id=$pid"
            )

        );
        // pr($allTransactions);
        $portfolioInfo = $allTransactions[0];
        $Portfolio = $this->Components->load('Portfolio');
        $broker_fee=$this->Auth->user('broker_fee');

        $this->ttypeArr = $Portfolio->getTransactionType();
        $balance = $Portfolio->getPortfolioBalanceNew($allTransactions, $this->ttypeArr);

        $Omo = $this->Components->load('Omo');
        $allOrdersInfo=array();
        $balanceUsed=$Omo->getUsedBalance($allOrdersInfo,$broker_fee);

        $balance=$balance-$balanceUsed;

        $portfolioHoldingsTransaction = $Portfolio->getPortfolioHoldings2($allTransactions, $this->ttypeArr);
        // pr($portfolioHoldingsTransaction);

        $StockBangladesh = $this->Components->load('StockBangladesh');
        $instrumentInfo = $StockBangladesh->instrumentInfo();
        $portfolioCommission = $allTransactions[0]['Portfolio']['broker_fee'];

        $this->set('instrumentList', json_encode($StockBangladesh->instrumentList(3)));

        $total_deposit = $allTransactions[0]['Portfolio']['total_deposit'];
        $total_withdraw = $allTransactions[0]['Portfolio']['total_withdraw'];
        $total_realized = $allTransactions[0]['Portfolio']['total_realized'];
        $total_stats_updated = $allTransactions[0]['Portfolio']['total_stats_updated'];



        $this->set("total_deposit", $total_deposit);
        $this->set("total_withdraw", $total_withdraw);
        $this->set("total_realized", $total_realized);
        $this->set("total_stats_updated", $total_stats_updated);
        $this->set("broker_fee", $broker_fee);

        $this->set("balance", $balance);
        $this->set("portfolioHoldingsTransaction", $portfolioHoldingsTransaction);
        $this->set("instrumentInfo", $instrumentInfo);
        $this->set("portfolioCommission", $portfolioCommission);
        $this->set("portfolioInfo", $portfolioInfo);
    }
    // for portfolio shares table
    public function performance2()
    {
        // Balance are tested. Its functioning fine. Test done on 9th jan,2017

       // Configure::write('debug', 2);
        $this->layout = 'ajax';

        if ($this->Auth->user('id')) {
            $pid = $this->Auth->user('portfolio_id');
        }

        //$id=3;  // for development testing only

        $this->Portfolio->contain('PortfolioShare');
        $allTransactions = $this->Portfolio->find('all', array(
                'conditions' => "Portfolio.id=$pid"
            )

        );
        // pr($allTransactions);
        $portfolioInfo = $allTransactions[0];
        $Portfolio = $this->Components->load('Portfolio2');

        $this->ttypeArr = $Portfolio->getTransactionType();
        $balance = $Portfolio->getPortfolioBalance($allTransactions, $this->ttypeArr);
        $portfolioHoldingsTransaction = $Portfolio->getPortfolioHoldings2($allTransactions, $this->ttypeArr);
        // pr($portfolioHoldingsTransaction);


        $StockBangladesh = $this->Components->load('StockBangladesh');
        $instrumentInfo = $StockBangladesh->instrumentInfo();
        $portfolioCommission = $allTransactions[0]['Portfolio']['broker_fee'];

        $this->set('instrumentList', json_encode($StockBangladesh->instrumentList(3)));

        $total_deposit = $allTransactions[0]['Portfolio']['total_deposit'];
        $total_withdraw = $allTransactions[0]['Portfolio']['total_withdraw'];
        $total_realized = $allTransactions[0]['Portfolio']['total_realized'];
        $total_stats_updated = $allTransactions[0]['Portfolio']['total_stats_updated'];
        $broker_fee=$this->Auth->user('broker_fee');


        $this->set("total_deposit", $total_deposit);
        $this->set("total_withdraw", $total_withdraw);
        $this->set("total_realized", $total_realized);
        $this->set("total_stats_updated", $total_stats_updated);
        $this->set("broker_fee", $broker_fee);

        $this->set("balance", $balance);
        $this->set("portfolioHoldingsTransaction", $portfolioHoldingsTransaction);
        $this->set("instrumentInfo", $instrumentInfo);
        $this->set("portfolioCommission", $portfolioCommission);
        $this->set("portfolioInfo", $portfolioInfo);
    }

    public function performance_dev()
    {
        Configure::write('debug', 2);
        //
        //$this->layout = 'ajax';

        if ($this->Auth->user('id')) {
            $pid = $this->Auth->user('portfolio_id');
        }

        //$id=3;  // for development testing only

        $this->Portfolio->contain('PortfolioTransaction');
        $allTransactions = $this->Portfolio->find('all', array(
                'conditions' => "Portfolio.id=$pid"
            )

        );
        pr($allTransactions);
        exit;
        $portfolioInfo = $allTransactions[0];
        $Portfolio = $this->Components->load('Portfolio');

        $this->ttypeArr = $Portfolio->getTransactionType();
        $balance = $Portfolio->getPortfolioBalance($allTransactions, $this->ttypeArr);
        $portfolioHoldingsTransaction = $Portfolio->getPortfolioHoldings2($allTransactions, $this->ttypeArr);
        // pr($portfolioHoldingsTransaction);

        $StockBangladesh = $this->Components->load('StockBangladesh');
        $instrumentInfo = $StockBangladesh->instrumentInfo();
        $portfolioCommission = $allTransactions[0]['Portfolio']['broker_fee'];

        $this->set('instrumentList', json_encode($StockBangladesh->instrumentList(3)));


        $this->set("balance", $balance);
        $this->set("portfolioHoldingsTransaction", $portfolioHoldingsTransaction);
        $this->set("instrumentInfo", $instrumentInfo);
        $this->set("portfolioCommission", $portfolioCommission);
        $this->set("portfolioInfo", $portfolioInfo);
    }

    public function edit_portfolio()
    {
        $this->layout = 'ajax';
        $this->Portfolio->contain('PortfolioTransaction');
        $allTransactions = $this->Portfolio->find('all', array(
                'conditions' => "Portfolio.user_id=2"
            )

        );

        $portfolioInfo = $allTransactions[0];

        $Portfolio = $this->Components->load('Portfolio');

        $this->ttypeArr = $Portfolio->getTransactionType();
        $balance = $Portfolio->getPortfolioBalance($allTransactions, $this->ttypeArr);
        $portfolioHoldingsTransaction = $Portfolio->getPortfolioHoldings($allTransactions, $this->ttypeArr);

        $StockBangladesh = $this->Components->load('StockBangladesh');
        $instrumentInfo = $StockBangladesh->instrumentInfo();
        $portfolioCommission = $allTransactions[0]['Portfolio']['broker_fee'];

        $this->set('instrumentList', json_encode($StockBangladesh->instrumentList(3)));


        $this->set("portfolioHoldingsTransaction", $portfolioHoldingsTransaction);
        $this->set("instrumentInfo", $instrumentInfo);
        $this->set("portfolioCommission", $portfolioCommission);
        $this->set("portfolioInfo", $portfolioInfo);
    }


    /////////////////////////////////////////////////////////////////manual portfolio update for all house/////////////////////////////////////////////////////////////////////////

    public function portfolio_update_script_manually($userFrom = 0, $userTo = 15, $confirm = 0)
    {
        Configure::write('debug', 2);


     //   require_once(APP . 'Vendor' . DS . 'phpexcel' . DS . 'PHPExcel.php');

        $StockBangladesh = $this->Components->load('StockBangladesh');
        $ip = $StockBangladesh->getIp();
        $instrumentList = $StockBangladesh->instrumentList(2);
        $metaKey = array("category");
        $instrumentInfo = $StockBangladesh->getFundamentalInfo(0, $metaKey);

        $brokerId = $this->Auth->user('broker_id');
        $Omo = $this->Components->load('Omo');
        $userList = $Omo->getUsersList(4, 1);


        $today = date('Y-m-d');


        $array_data = $this->data['shareData'] ;


        $omoUsers= Hash::extract($array_data,'{n}.irn');
        $omoUsers=array_unique($omoUsers);
        $omoUsers = Hash::sort($omoUsers,'{n}','asc');

        $brokerUsers = array();
        foreach ($userList[$brokerId] as $irn => $arr) {
            $key = trim($irn);


            if(in_array($key,$omoUsers))
            {
                $brokerUsers[$key] = $arr;
            }
            else
                continue;
        }

        ksort($brokerUsers);



        $dataGroupByIrn = array();



        foreach ($array_data as $row) {
            $irn = $row['irn'];
            $totalQty = $row['totalQty'];
           // $row[1] = strtoupper(trim($row[1]));

           // if ($totalQty)
                $dataGroupByIrn[$irn][] = $row;
        }



        $model = ClassRegistry::init('Portfolio');
        $Portfolio = $this->Components->load('Portfolio');
        $this->ttypeArr = $Portfolio->getTransactionType();
        $dataToSave = array();

        $i = 0;
        foreach ($brokerUsers as $irn => $user) {
            $i++;
            //   pr($i);
          //  if ($i > $userFrom and $i <= $userTo) {

                $pid = $user['portfolio_id'];
                $broker_fee = $user['broker_fee'];
                // pr($dataGroupByIrn[$irn]);


                if (!isset($dataGroupByIrn[$irn])) {
                    echo "<h2>There is no share found for $irn in Apex excell</h2>";
                    continue;
                } else {

                    $actualHoldings = $dataGroupByIrn[$irn];
                }


                $model->contain('PortfolioTransaction');
                $allTransactions = $model->find('all', array(
                        'conditions' => "Portfolio.id=$pid"

                    )
                );

                $instrumentListKeyId = $StockBangladesh->instrumentList(3);

                $portfolioHoldingsTransaction = $Portfolio->getPortfolioHoldings2($allTransactions, $this->ttypeArr);


               /* // padding missing share of $portfolioHoldingsTransaction in $actualHoldings

                foreach ($portfolioHoldingsTransaction as $instrumentId => $arr)
                {
                    $temp = array();
                    $code = $instrumentListKeyId[$instrumentId];

                    $temp['irn'] = $irn;
                    $temp['itemCode'] = $code;
                    $temp['freeQty'] = 0;
                    $temp['UmQty'] = 0;
                    $temp['totalQty'] = 0;
                    $temp['avgPrice'] = 0;


                    $shareExist = Hash::extract($actualHoldings, "{n}[1=$code]");

                    if (empty($shareExist)) {

                        $actualHoldings[] = $temp;

                    }

                }*/

                echo "==================================================processing $irn is started=========================================<br />";
                foreach ($actualHoldings as $share) {

                      //  pr($share);
                    $instrumentCode = strtoupper(trim($share['itemCode']));

                    // $category = $instrumentInfo[$instrumentId]['category']['meta_value'];

                    if (!isset($instrumentList[$instrumentCode])) {
                        echo "<h3>$instrumentCode is not found</h3>";
                        continue;
                    } else {


                        $instrumentId = $instrumentList[$instrumentCode];

                        if(isset($instrumentInfo[$instrumentId]['category']['meta_value']))
                        {
                            $category = $instrumentInfo[$instrumentId]['category']['meta_value'];
                        }
                        else
                        {
                            echo "<h3>$instrumentCode category undefined</h3>";
                            continue;
                        }
                        $newEntryArr = $this->adjustPortfolio_manually($share, $portfolioHoldingsTransaction, $instrumentId, $category, $pid, $broker_fee);
                        $dataToSave = array_merge($dataToSave, $newEntryArr);
                    }

                }

                echo "==================================================processing $irn is finished=========================================<br />";

          //  }



        }





        if (count($dataToSave)) {
            $model = ClassRegistry::init('PortfolioTransaction');

                $model->saveMany($dataToSave, array('atomic' => true));
                $rep = count($dataToSave) . ' NEW ROW INSERTED';
                echo "<br/>****************$rep*********************<br/>";



        }
        exit;
    }

    public function adjustPortfolio_manually($share, $portfolioHoldingsTransaction, $instrumentId, $category, $pid, $broker_fee)
    {
        Configure::write('debug', 2);

        App::uses('CakeTime', 'Utility');

        $freeQty = $share['freeQty'];
        $tempAvgCostScript=$share['avgPrice'];
        $avgCostScript = ($tempAvgCostScript*100)/(100+$broker_fee); //substitution of commission or broker fee
        $totalQty = $share['totalQty'];
        $devQty = 0;                //devQty is not the immature qty
        $instrumentCode = strtoupper(trim($share['itemCode']));
        $bo_irn = trim($share['irn']);

        // remove lockin quantity
        if ($devQty > 0) {
            $totalQty = $totalQty - $devQty;
        }


        if (isset($portfolioHoldingsTransaction[$instrumentId])) {

            $existingPortfolioQty = $portfolioHoldingsTransaction[$instrumentId]['totalQuantity'];
            $existingPortfolioDividendQuantity = $portfolioHoldingsTransaction[$instrumentId]['dividendQuantity'];
            $receiveableDividendQuantity = $portfolioHoldingsTransaction[$instrumentId]['receiveableDividendQuantity'];
            $saleAbleShares = $portfolioHoldingsTransaction[$instrumentId]['saleAbleShares'];
            $avgCostPortfolio=$portfolioHoldingsTransaction[$instrumentId]['avgCost'];

        } else {
            $existingPortfolioQty = 0;
            $existingPortfolioDividendQuantity = 0;
            $receiveableDividendQuantity = 0;
            $saleAbleShares = 0;
        }
        $diff = $totalQty - $existingPortfolioQty;
        echo "<span style='color:green'>$instrumentCode excell totalQty =$totalQty portfolio existingPortfolioQty=$existingPortfolioQty  diff=$diff<br /></span>";




        $returnArr = array();
        $transaction_time_mature = date("Y-m-d H:i:s", strtotime("-30 days"));
        $transaction_time_immature =date("Y-m-d H:i:s");



        //for backdated portfolio Update change immature date...
        // $transaction_time_immature = date("Y-m-d H:i:s", strtotime("-1 days"));

        if ($existingPortfolioQty == 0)  // need a fresh entry
        {
            $adjustAbleQty = $totalQty;
            $avgCost=$avgCostScript;

            if ($freeQty >= $adjustAbleQty) {
                $temp = array();
                $amount = $adjustAbleQty;  // takes all

                $temp['portfolio_id'] = $pid;
                $temp['instrument_id'] = $instrumentId;
                $temp['transaction_type_id'] = 1;  // buy as adding share

                $temp['rate'] = $avgCost;
                // $new_transaction_time = date("Y-m-d H:i:s", strtotime("-30 days"));
                $temp['transaction_time'] = $transaction_time_mature;
                $temp['commission'] = $broker_fee;
                $today = date("Y-m-d");
                $temp['dse_order_id'] = "script-$today";
                $temp['amount'] = $amount;
             //   if ($temp['amount']) {
                    $returnArr[] = $temp;
                    echo "1=>" . $temp['amount'] . " $instrumentCode FRESH ENTRY to $bo_irn <br />";
             //   }


            } elseif ($freeQty < $adjustAbleQty) {
                $temp = array();
                $amount = $freeQty;  // takes all of free share. and some share will be still left

                $temp['portfolio_id'] = $pid;
                $temp['instrument_id'] = $instrumentId;
                $temp['transaction_type_id'] = 1;  // buy as adding share

                $temp['rate'] = $avgCost;
                //  $new_transaction_time = date("Y-m-d H:i:s", strtotime("-30 days"));
                $temp['transaction_time'] = $transaction_time_mature;
                $temp['commission'] = $broker_fee;
                $today = date("Y-m-d");
                $temp['dse_order_id'] = "script-$today";
                $temp['amount'] = $amount;
              //  if ($temp['amount']) {
                    $returnArr[] = $temp;
                    echo "2=>" . $temp['amount'] . " $instrumentCode FRESH ENTRY  to $bo_irn <br />";
             //   }

                // now add immature shares
                $temp = array();
                $amount = $adjustAbleQty - $freeQty;  // takes all of free share. and some share will be still left

                $temp['portfolio_id'] = $pid;
                $temp['instrument_id'] = $instrumentId;
                $temp['transaction_type_id'] = 1;  // buy as adding share

                $temp['rate'] = $avgCost;
                // $new_transaction_time = date("Y-m-d H:i:s");
                $temp['transaction_time'] = $transaction_time_immature;
                $temp['commission'] = $broker_fee;
                $today = date("Y-m-d");
                $temp['dse_order_id'] = "script-$today";

                if ($amount)
                {
                    $temp['amount'] = $amount;
                   // if ($temp['amount']) {
                        $returnArr[] = $temp;
                        echo "3=>" . $temp['amount'] . " $instrumentCode FRESH ENTRY(IMMATURE) to $bo_irn <br />";
                  //  }
                }

            } else  // adding remaining share as immature
            {
                //@ do nothing
            }


        }

        else  // already this share in portfolio. need adjustment
        {
            $totalCostScript=$totalQty*$avgCostScript;
            $totalCostPortfolio=$existingPortfolioQty*$avgCostPortfolio;
            $diffTotalCost=$totalCostScript-$totalCostPortfolio;


            if ($diff == 0)// portfolio for this item is ok/up to date. NO ACTION REQUIRED FOR NEW ENTRY
            {
                $avgCost=$avgCostPortfolio;

                if ($saleAbleShares < $freeQty) // we have some space to add share as mature
                {


                    //adding shortage of mature share

                    $allowedQty = $freeQty - $saleAbleShares;  // maximum allowed quantity to input as mature share

                    $temp = array();
                    $temp['portfolio_id'] = $pid;
                    $temp['instrument_id'] = $instrumentId;
                    $temp['transaction_type_id'] = 1;  // buy as adding share
                    $temp['rate'] = $avgCost;
                    // $new_transaction_time = date("Y-m-d H:i:s", strtotime("-30 days"));
                    $temp['transaction_time'] = $transaction_time_mature;
                    $temp['commission'] = $broker_fee;
                    $today = date("Y-m-d");
                    $temp['dse_order_id'] = "script-$today";
                    $temp['amount'] = $allowedQty;
                   // if ($temp['amount']) {
                        $returnArr[] = $temp;
                        echo "4=>" . $temp['amount'] . " $instrumentCode ADDED (as mature)  to $bo_irn <br />";
                  //  }

                    //removing excess of immature shares

                    // $allowedLockQty=($existingPortfolioQty-$saleAbleShares)-($totalQty-$freeQty);

                    $temp = array();
                    $temp['portfolio_id'] = $pid;
                    $temp['instrument_id'] = $instrumentId;
                    $temp['transaction_type_id'] = 2;  // SELL as REMOVE share
                    $temp['amount'] = $allowedQty;
                    $temp['rate'] = $avgCost;
                    // $new_transaction_time = date("Y-m-d H:i:s"); // setting today .So it will be shown as immature
                    $temp['transaction_time'] = $transaction_time_immature;
                    $temp['commission'] = $broker_fee;
                    $today = date("Y-m-d");
                    $temp['dse_order_id'] = "script-$today";
                  //  if ($temp['amount']) {
                        $returnArr[] = $temp;
                        echo "5=>" . $temp['amount'] . " $instrumentCode REMOVED (as immature) form $bo_irn <br />";
                  //  }

                }
                elseif ($saleAbleShares > $freeQty)
                {
                    //removing excess of mature shares
                    $allowedQty = $saleAbleShares - $freeQty;  // maximum allowed quantity to input as mature share

                    $temp = array();
                    $temp['portfolio_id'] = $pid;
                    $temp['instrument_id'] = $instrumentId;
                    $temp['transaction_type_id'] = 2;  // buy as adding share
                    $temp['rate'] = $avgCost;
                    // $new_transaction_time = date("Y-m-d H:i:s", strtotime("-30 days"));  // changing to past so it will be shown as Mature
                    $temp['transaction_time'] = $transaction_time_mature;
                    $temp['commission'] = $broker_fee;
                    $today = date("Y-m-d");
                    $temp['dse_order_id'] = "script-$today";
                    $temp['amount'] = $allowedQty;
                   // if ($temp['amount']) {
                        $returnArr[] = $temp;
                        echo "6=>" . $temp['amount'] . " $instrumentCode REMOVED (as mature) form $bo_irn <br />";
                  //  }



                    //adding shortage of immature share

                    //$allowedLockQty=($totalQty-$freeQty)-($existingPortfolioQty-$saleAbleShares);

                    $temp = array();
                    $temp['portfolio_id'] = $pid;
                    $temp['instrument_id'] = $instrumentId;
                    $temp['transaction_type_id'] = 1;  // SELL as REMOVE share
                    $temp['amount'] = $allowedQty;
                    $temp['rate'] = $avgCost;
                    //  $new_transaction_time = date("Y-m-d H:i:s"); // setting today .So it will be shown as immature
                    $temp['transaction_time'] = $transaction_time_immature;
                    $temp['commission'] = $broker_fee;
                    $today = date("Y-m-d");
                    $temp['dse_order_id'] = "script-$today";
                  //  if ($temp['amount']) {
                        $returnArr[] = $temp;
                        echo "7=>" . $temp['amount'] . " $instrumentCode ADDED (as immature) to $bo_irn <br />";
                 //   }

                }



            } elseif ($diff < 0)// portfolio has more quantity than it should be. So we have to remove them
            {
                $avgCost=$diffTotalCost/-($diff);

                $adjustAbleQty = abs($diff);




                /* =========free share  adjustment start=================*/

                if ($saleAbleShares < $freeQty) // we have some space to add share as mature
                {
                    //@todo manual action required

                    //adding shortage of mature share

                    $allowedQty = $freeQty - $saleAbleShares;  // maximum allowed quantity to input as mature share

                    $temp = array();
                    $temp['portfolio_id'] = $pid;
                    $temp['instrument_id'] = $instrumentId;
                    $temp['transaction_type_id'] = 1;  // buy as adding share
                    $temp['rate'] = $avgCost;
                    // $new_transaction_time = date("Y-m-d H:i:s", strtotime("-30 days"));
                    $temp['transaction_time'] = $transaction_time_mature;
                    $temp['commission'] = $broker_fee;
                    $today = date("Y-m-d");
                    $temp['dse_order_id'] = "script-$today";
                    $temp['amount'] = $allowedQty;
                  //  if ($temp['amount']) {
                        $returnArr[] = $temp;
                        echo "8=>" . $temp['amount'] . " $instrumentCode ADDED (as mature)  to $bo_irn <br />";
                 //   }

                    //removing excess of immature shares

                    $allowedLockQty=($existingPortfolioQty-$saleAbleShares)-($totalQty-$freeQty);

                    $temp = array();
                    $temp['portfolio_id'] = $pid;
                    $temp['instrument_id'] = $instrumentId;
                    $temp['transaction_type_id'] = 2;  // SELL as REMOVE share
                    $temp['amount'] = $allowedLockQty;
                    $temp['rate'] = $avgCost;
                    // $new_transaction_time = date("Y-m-d H:i:s"); // setting today .So it will be shown as immature
                    $temp['transaction_time'] = $transaction_time_immature;
                    $temp['commission'] = $broker_fee;
                    $today = date("Y-m-d");
                    $temp['dse_order_id'] = "script-$today";
                 //   if ($temp['amount']) {
                        $returnArr[] = $temp;
                        echo "9=>" . $temp['amount'] . " $instrumentCode REMOVED (as immature) form $bo_irn <br />";
                 //   }

                }

                elseif ($saleAbleShares == $freeQty)
                {

                    //removing excess of immature shares
                    $allowedLockQty=($existingPortfolioQty-$saleAbleShares)-($totalQty-$freeQty);

                    $temp = array();
                    $temp['portfolio_id'] = $pid;
                    $temp['instrument_id'] = $instrumentId;
                    $temp['transaction_type_id'] = 2;  // SELL as REMOVE share
                    $temp['amount'] = $allowedLockQty;
                    $temp['rate'] = $avgCost;
                    // $new_transaction_time = date("Y-m-d H:i:s"); // setting today .So it will be shown as immature
                    $temp['transaction_time'] = $transaction_time_immature;
                    $temp['commission'] = $broker_fee;
                    $today = date("Y-m-d");
                    $temp['dse_order_id'] = "script-$today";
                   // if ($temp['amount']) {
                        $returnArr[] = $temp;
                        echo "10=>" . $temp['amount'] . " $instrumentCode REMOVED (as immature) form $bo_irn <br />";
                  //  }

                }

                elseif ($saleAbleShares > $freeQty)
                {
                    //removing excess of mature shares
                    $allowedQty = $saleAbleShares - $freeQty;  // maximum allowed quantity to input as mature share

                    $temp = array();
                    $temp['portfolio_id'] = $pid;
                    $temp['instrument_id'] = $instrumentId;
                    $temp['transaction_type_id'] = 2;  // buy as adding share
                    $temp['rate'] = $avgCost;
                    // $new_transaction_time = date("Y-m-d H:i:s", strtotime("-30 days"));  // changing to past so it will be shown as Mature
                    $temp['transaction_time'] = $transaction_time_mature;
                    $temp['commission'] = $broker_fee;
                    $today = date("Y-m-d");
                    $temp['dse_order_id'] = "script-$today";
                    $temp['amount'] = $allowedQty;
                  //  if ($temp['amount']) {
                        $returnArr[] = $temp;
                        echo "11=>" . $temp['amount'] . " $instrumentCode REMOVED (as mature) form $bo_irn <br />";
                  //  }





                    $allowedLockQty=($totalQty-$freeQty)-($existingPortfolioQty-$saleAbleShares);

                    if($allowedLockQty>0)
                    {
                        //adding shortage of immature share
                        $temp = array();
                        $temp['portfolio_id'] = $pid;
                        $temp['instrument_id'] = $instrumentId;
                        $temp['transaction_type_id'] = 1;
                        $temp['amount'] = $allowedLockQty;
                        $temp['rate'] = $avgCost;
                        // $new_transaction_time = date("Y-m-d H:i:s"); // setting today .So it will be shown as immature
                        $temp['transaction_time'] = $transaction_time_immature;
                        $temp['commission'] = $broker_fee;
                        $today = date("Y-m-d");
                        $temp['dse_order_id'] = "script-$today";
                     //   if ($temp['amount']) {
                            $returnArr[] = $temp;
                            echo "12=>" . $temp['amount'] . " $instrumentCode ADDED (as immature) to $bo_irn <br />";
                      //  }
                    }
                    elseif($allowedLockQty<0)
                    {  //removing excess of immature shares
                        $temp = array();
                        $temp['portfolio_id'] = $pid;
                        $temp['instrument_id'] = $instrumentId;
                        $temp['transaction_type_id'] = 2;  // SELL as REMOVE share
                        $temp['amount'] = -($allowedLockQty);
                        $temp['rate'] = $avgCost;
                        // $new_transaction_time = date("Y-m-d H:i:s"); // setting today .So it will be shown as immature
                        $temp['transaction_time'] = $transaction_time_immature;
                        $temp['commission'] = $broker_fee;
                        $today = date("Y-m-d");
                        $temp['dse_order_id'] = "script-$today";
                    //    if ($temp['amount']) {
                            $returnArr[] = $temp;
                            echo "13=>" . $temp['amount'] . " $instrumentCode REMOVED (as mature) to $bo_irn <br />";
                    //    }
                    }



                }


            }

            elseif ($diff > 0)// portfolio has less quantity than it should be. So we have to add them
            {

                $avgCost=$diffTotalCost/$diff;

                /* =========free share  adjustment start=================*/

                if ($saleAbleShares < $freeQty) // we have some space to add share as mature
                {
                    //adding shortage of mature share
                    $allowedQty = $freeQty - $saleAbleShares;  // maximum allowed quantity to input as mature share


                    $temp = array();
                    $temp['portfolio_id'] = $pid;
                    $temp['instrument_id'] = $instrumentId;
                    $temp['transaction_type_id'] = 1;  // buy as adding share
                    $temp['rate'] = $avgCost;
                    // $new_transaction_time = date("Y-m-d H:i:s", strtotime("-30 days"));  // changing to past so it will be shown as Mature
                    $temp['transaction_time'] = $transaction_time_mature;
                    $temp['commission'] = $broker_fee;
                    $today = date("Y-m-d");
                    $temp['dse_order_id'] = "script-$today";
                    $temp['amount'] = $allowedQty;
                   // if ($temp['amount']) {
                        $returnArr[] = $temp;
                        echo "14=>" . $temp['amount'] . " $instrumentCode ADDED (as mature) to $bo_irn <br />";
                  //  }

                    //removing excess of immature share
                    $allowedLockQty=($existingPortfolioQty-$saleAbleShares)-($totalQty-$freeQty);

                    $temp = array();
                    $temp['portfolio_id'] = $pid;
                    $temp['instrument_id'] = $instrumentId;
                    $temp['transaction_type_id'] = 2;  // SELL as REMOVE share
                    $temp['amount'] = $allowedLockQty;
                    $temp['rate'] = $avgCost;
                    //  $new_transaction_time = date("Y-m-d H:i:s"); // setting today .So it will be shown as immature
                    $temp['transaction_time'] = $transaction_time_immature;
                    $temp['commission'] = $broker_fee;
                    $today = date("Y-m-d");
                    $temp['dse_order_id'] = "script-$today";
                  //  if ($temp['amount']) {
                        $returnArr[] = $temp;
                        echo "15=>" . $temp['amount'] . " $instrumentCode REMOVED (as immature) form $bo_irn <br />";
                //    }


                }
                elseif ($saleAbleShares == $freeQty) // we have to add left share as immature as we have already saleable share as free share
                {

                    //adding shortage of immature share
                    $allowedLockQty=($totalQty-$freeQty)-($existingPortfolioQty-$saleAbleShares);

                    $temp = array();
                    $temp['portfolio_id'] = $pid;
                    $temp['instrument_id'] = $instrumentId;
                    $temp['transaction_type_id'] = 1;  // buy as adding share
                    $temp['amount'] = $allowedLockQty;
                    $temp['rate'] = $avgCost;
                    // $new_transaction_time = date("Y-m-d H:i:s"); // setting today .So it will be shown as immature
                    $temp['transaction_time'] = $transaction_time_immature;
                    $temp['commission'] = $broker_fee;
                    $today = date("Y-m-d");
                    $temp['dse_order_id'] = "script-$today";
                  //  if ($temp['amount']) {
                        $returnArr[] = $temp;
                        echo "16=>" . $temp['amount'] . " $instrumentCode ADDED (as immature) to $bo_irn <br />";
                   // }

                }

                elseif ($saleAbleShares > $freeQty) // we have some share in the portfolio that have inputed by mistake
                {
                    // @todo treatment needed to remove share

                    //removing excess of mature share

                    $allowedQty =$saleAbleShares-$freeQty ;

                    $temp = array();
                    $temp['portfolio_id'] = $pid;
                    $temp['instrument_id'] = $instrumentId;
                    $temp['transaction_type_id'] = 2;  // SELL as REMOVE share
                    $temp['amount'] = $allowedQty;
                    $temp['rate'] = $avgCost;
                    $new_transaction_time =  date("Y-m-d H:i:s", strtotime("-30 days")); // setting today .So it will be shown as immature
                    $temp['transaction_time'] = $new_transaction_time;
                    $temp['commission'] = $broker_fee;
                    $today = date("Y-m-d");
                    $temp['dse_order_id'] = "script-$today";
                 //   if ($temp['amount']) {
                        $returnArr[] = $temp;
                        echo "17=>" . $temp['amount'] . " $instrumentCode REMOVED (as mature) from $bo_irn <br />";
                 //   }


                    //adding shortage of immature share

                    $allowedLockQty=($totalQty-$freeQty)-($existingPortfolioQty-$saleAbleShares);

                    $temp = array();
                    $temp['portfolio_id'] = $pid;
                    $temp['instrument_id'] = $instrumentId;
                    $temp['transaction_type_id'] = 1;  // buy as adding share
                    $temp['amount'] = $allowedLockQty; // taking all remaining quantity
                    $temp['rate'] = $avgCost;
                    // $new_transaction_time = date("Y-m-d H:i:s"); // setting today .So it will be shown as immature
                    $temp['transaction_time'] = $transaction_time_immature;
                    $temp['commission'] = $broker_fee;
                    $today = date("Y-m-d");
                    $temp['dse_order_id'] = "script-$today";

                 //   if ($temp['amount']) {
                        $returnArr[] = $temp;
                        echo "18=>" . $temp['amount'] . " $instrumentCode ADDED (as immature) to $bo_irn <br />";
                //    }

                }

            }
        }

        return $returnArr;

    }
//////////////////////////////////////////////////////////////manual portfolio update for all house END////////////////////////////////////////////////////////////////////

public function category()
{
    $StockBangladesh = $this->Components->load('StockBangladesh');
    $lastTwoMarketInfoArr = $StockBangladesh->getMarketInfo(0, 0);
    $marketId = $lastTwoMarketInfoArr[0]['Market']['id'];
    $lastTradeInfo = $StockBangladesh->getAllInsLtp($marketId);

    $category_arr=array();
    foreach($lastTradeInfo as $instrument_id=>$data_arr)
    {
        $data=array_values($data_arr);
        if(isset($data[0]))
        {
            $quote_bases = $data[0]['quote_bases'];
            $quote_bases_arr=explode('-',$quote_bases);
            $category= $quote_bases_arr[0];
            $category_arr[$instrument_id]= $category;
        }

    }

  return $category_arr;
}


/////////////////////////////////////////////////////////////////for APEX broker house/////////////////////////////////////////////////////////////////////////

    public function portfolio_update($userPerSlot = 15)
    {
        // Configure::write('debug', 2);

        $brokerId = Configure::read('broker.apex.id');
        $Omo = $this->Components->load('Omo');
        $StockBangladesh = $this->Components->load('StockBangladesh');
        $userList = $Omo->getUsersList(4, 1);

        $array_data = array();

        $portfolios_file_path = Configure::read('broker.apex.portfolios_file_path');
        $fileArr = $StockBangladesh->scan_dir($portfolios_file_path);
        $fullFilePath = "$portfolios_file_path/" . $fileArr[0];
        $file = fopen($fullFilePath, "r");
        $fileDate = 0;
        // read each data row in the file

        while (!feof($file)) {
            $row = fgetcsv($file);

            if (strpos($row[0], ': ') == true) {
                $fileDate = $row[0];
                $fileDate = explode(':', $fileDate);
                $fileDate = $fileDate[1];
                $fileDate = date('d-m-Y', strtotime($fileDate));
            } elseif ($row[0] == '') {
                continue;
            } else
                $array_data[] = $row[0];

        }


        if ($fileDate != date('d-m-Y')) {
            echo "<br>";
            echo "<h2>this is not today's file.please recheck and upload the correct file again</h2>";
            exit;
        }

        // unset($array_data[1]);


        //   $HacOmoUsers= Hash::extract($array_data,'{n}.1');
        $apexOmoUsers = array_unique($array_data);
        $apexOmoUsers = Hash::sort($apexOmoUsers, '{n}', 'asc');

        $brokerUsers = array();
        foreach ($userList[$brokerId] as $irn => $arr) {
            $key = trim($irn);
            $key = str_pad($key, 5, "0", STR_PAD_LEFT);
            $key = strtoupper($key);
            //  if ($key == '0H204')
            if (in_array($key, $apexOmoUsers))
                $brokerUsers[$key] = $arr;
            else
                continue;
        }


        $totalUser = count($brokerUsers) + 15;
        ksort($brokerUsers);
        $this->set('totalUser', $totalUser);
        $this->set('userPerSlot', $userPerSlot);
        $this->set('brokerUsers', $brokerUsers);
        $this->set('pageTitleMain', 'Portfolio Update');
        $this->set('pageTitleSmall', 'update process of user portfolios ');
    }


    public function portfolio_update_x($userPerSlot = 15)
    {
         Configure::write('debug', 2);
        require_once(APP . 'Vendor' . DS . 'phpexcel' . DS . 'PHPExcel.php');
        $portfolio_file_path = Configure::read('broker.apex.portfolios_file_path');
        $StockBangladesh = $this->Components->load('StockBangladesh');
        $Omo = $this->Components->load('Omo');
        $fileArr = $StockBangladesh->scan_dir($portfolio_file_path);
      
        $fullFilePath = "$portfolio_file_path/" . $fileArr[0];


        $today=date('d_m_Y');
        if(strpos($fileArr[0],$today) == false)
        {
            echo "<br>";
            echo "<h2>this is not today's file.please recheck and upload the correct file again</h2>";
            exit;
        }








        $array_data = $Omo->xlsToArray($fullFilePath);
        unset($array_data[1]);

        $apexOmoUsers= Hash::extract($array_data,'{n}.0');
        $apexOmoUsers=array_unique($apexOmoUsers);
        $apexOmoUsers = Hash::sort($apexOmoUsers,'{n}','asc');

       // pr($array_data);

        $brokerId = Configure::read('broker.apex.id');

        $userList = $Omo->getUsersList(4, 1);
        $brokerUsers = array();

        foreach ($userList[$brokerId] as $irn => $arr) {
            $key = trim($irn);
            $key = str_pad($key, 5, "0", STR_PAD_LEFT);
            $key = strtoupper($key);
            //  if ($key == '0H204')
            if(in_array($key,$apexOmoUsers))
                    $brokerUsers[$key] = $arr;
            else
                continue;
        }


        $totalUser = count($brokerUsers) + 15;
        ksort($brokerUsers);
        $this->set('totalUser', $totalUser);
        $this->set('userPerSlot', $userPerSlot);
        $this->set('brokerUsers', $brokerUsers);
        $this->set('pageTitleMain','Portfolio Update');
        $this->set('pageTitleSmall','update process of user portfolios ');
    }

    public function portfolio_update_script($userFrom = 0, $userTo = 15, $confirm = 0)
    {
        Configure::write('debug', 2);
        require_once(APP . 'Vendor' . DS . 'phpexcel' . DS . 'PHPExcel.php');

        $StockBangladesh = $this->Components->load('StockBangladesh');
        $ip = $StockBangladesh->getIp();
        $instrumentList = $StockBangladesh->instrumentList(2);
        $metaKey = array("category");
        $instrumentInfo = $StockBangladesh->getFundamentalInfo(0, $metaKey);

        $brokerId = Configure::read('broker.apex.id');
        $Omo = $this->Components->load('Omo');
        $userList = $Omo->getUsersList(4, 1);


        $array_data = array();

        $portfolios_file_path = Configure::read('broker.apex.portfolios_file_path');
        $fileArr = $StockBangladesh->scan_dir($portfolios_file_path);
        $fullFilePath = "$portfolios_file_path/" . $fileArr[0];
        $file = fopen($fullFilePath, "r");

        // read each data row in the file

        while (!feof($file)) {
            $row = fgetcsv($file);
            if ($row[1] == '') {
                continue;
            } else
                $array_data[] = $row;

        }
        // unset($array_data[1]);


        $apexOmoUsers= Hash::extract($array_data,'{n}.0');

        $apexOmoUsers=array_unique($apexOmoUsers);
        $apexOmoUsers = Hash::sort($apexOmoUsers,'{n}','asc');

        $brokerUsers = array();
        foreach ($userList[$brokerId] as $irn => $arr) {
            $key = trim($irn);
            $key = str_pad($key, 5, "0", STR_PAD_LEFT);
            $key = strtoupper($key);
            //  if ($key == '0H204')

            if(in_array($key,$apexOmoUsers))
            {
                $brokerUsers[$key] = $arr;
            }
           else
               continue;
        }

        ksort($brokerUsers);


        $dataGroupByIrn = array();

        foreach ($array_data as $row) {
            $irn = $row[0];
            $totalQty = $row[7];
            $row[1] = strtoupper(trim($row[1]));

            if ($totalQty)
                $dataGroupByIrn[$irn][] = $row;
        }

        $model = ClassRegistry::init('Portfolio');
        $Portfolio = $this->Components->load('Portfolio');
        $this->ttypeArr = $Portfolio->getTransactionType();
        $dataToSave = array();

        $i = 0;
        foreach ($brokerUsers as $irn => $user) {
            $i++;
            //   pr($i);
            if ($i > $userFrom and $i <= $userTo) {

                $pid = $user['portfolio_id'];
                $broker_fee = $user['broker_fee'];
                // pr($dataGroupByIrn[$irn]);


                if (!isset($dataGroupByIrn[$irn])) {
                    echo "<h2>There is no share found for $irn in Apex excell</h2>";
                    continue;
                } else {

                    $actualHoldings = $dataGroupByIrn[$irn];
                }


                $model->contain('PortfolioTransaction');
                $allTransactions = $model->find('all', array(
                        'conditions' => "Portfolio.id=$pid"

                    )
                );

                $instrumentListKeyId = $StockBangladesh->instrumentList(3);

                $portfolioHoldingsTransaction = $Portfolio->getPortfolioHoldings2($allTransactions, $this->ttypeArr);


                // padding missing share of $portfolioHoldingsTransaction in $actualHoldings

                foreach ($portfolioHoldingsTransaction as $instrumentId => $arr)
                {
                    $temp = array();
                    $code = $instrumentListKeyId[$instrumentId];

                    $temp[] = $irn;
                    $temp[] = $code;
                    $temp[] = 0;
                    $temp[] = 0;
                    $temp[] = 0;
                    $temp[] = 0;
                    $temp[] = 0;
                    $temp[] = 0;
                    $temp[] = 'NULL';
                    $temp[] = 0;
                    $temp[] = 0;
                    $temp[] = 0;
                    $temp[] = 0;
                    $temp[] = 0;
                    $temp[] = 0;
                    $temp[] = 0;


                    $shareExist = Hash::extract($actualHoldings, "{n}[1=$code]");

                    if (empty($shareExist)) {

                        $actualHoldings[] = $temp;

                    }

                }

                echo "==================================================processing $irn is started=========================================<br />";
                foreach ($actualHoldings as $share) {

                        $instrumentCode = strtoupper(trim($share[1]));

                       // $category = $instrumentInfo[$instrumentId]['category']['meta_value'];

                        if (!isset($instrumentList[$instrumentCode])) {
                            echo "<h3>$instrumentCode is not found</h3>";
                            continue;
                        } else {
                            $instrumentId = $instrumentList[$instrumentCode];
                            $category = $StockBangladesh->get_category($instrumentId);


                            $newEntryArr = $this->adjustPortfolio($share, $portfolioHoldingsTransaction, $instrumentId, $category, $pid, $broker_fee);
                            $dataToSave = array_merge($dataToSave, $newEntryArr);
                        }

                }

                echo "==================================================processing $irn is finished=========================================<br />";

            }



        }


        if (count($dataToSave)) {
            //$confirm=0; // temporarily disabled as new system is running
            $model = ClassRegistry::init('PortfolioTransaction');
            if ($confirm) {
                $model->saveMany($dataToSave, array('atomic' => true));
                $rep = count($dataToSave) . ' NEW ROW INSERTED';
                echo "<br/>****************$rep*********************<br/>";
            } else {
                $rep = count($dataToSave) . ' new transaction will be insert. Please confirm to save it';
                $rt = Router::url('/', true) . "Portfolios/portfolio_update_script/$userFrom/$userTo/1";
                //     echo $rt;
                echo "<br /><a href='$rt'>$rep</a> <br />";

            }


        }
        exit;
    }

    public function adjustPortfolio($share, $portfolioHoldingsTransaction, $instrumentId, $category, $pid, $broker_fee)
    {
        Configure::write('debug', 2);

        App::uses('CakeTime', 'Utility');
        $freeQty = $share[2];
        $freeQty=str_replace(',','',$freeQty);

        $tempAvgCostScript=$share[4];
        $tempAvgCostScript = str_replace(',', '', $tempAvgCostScript);
        
        $avgCostScript = ($tempAvgCostScript*100)/(100+$broker_fee); //substitution of commission or broker fee
        $totalQty = $share[7];
        $totalQty = str_replace(',', '', $totalQty);

        $devQty = $share[8];
        $devQty = str_replace(',', '', $devQty);

        $instrumentCode = strtoupper(trim($share[1]));
        $bo_irn = trim($share[0]);

        // remove lockin quantity
        if ($devQty > 0) {
            $totalQty = $totalQty - $devQty;
        }


        if (isset($portfolioHoldingsTransaction[$instrumentId])) {

            $existingPortfolioQty = $portfolioHoldingsTransaction[$instrumentId]['totalQuantity'];
            $existingPortfolioDividendQuantity = $portfolioHoldingsTransaction[$instrumentId]['dividendQuantity'];
            $receiveableDividendQuantity = $portfolioHoldingsTransaction[$instrumentId]['receiveableDividendQuantity'];
            $saleAbleShares = $portfolioHoldingsTransaction[$instrumentId]['saleAbleShares'];
            $avgCostPortfolio=$portfolioHoldingsTransaction[$instrumentId]['avgCost'];

        } else {
            $existingPortfolioQty = 0;
            $existingPortfolioDividendQuantity = 0;
            $receiveableDividendQuantity = 0;
            $saleAbleShares = 0;
        }
        $diff = $totalQty - $existingPortfolioQty;
        echo "<span style='color:green'>$instrumentCode excell totalQty =$totalQty portfolio existingPortfolioQty=$existingPortfolioQty  diff=$diff<br /></span>";




        $returnArr = array();
        $transaction_time_mature = date("Y-m-d H:i:s", strtotime("-30 days"));
        $transaction_time_immature =date("Y-m-d H:i:s");



        //for backdated portfolio Update change immature date...
       // $transaction_time_immature = date("Y-m-d H:i:s", strtotime("-1 days"));

        if ($existingPortfolioQty == 0)  // need a fresh entry
        {
            $adjustAbleQty = $totalQty;
            $avgCost=$avgCostScript;

            if ($freeQty >= $adjustAbleQty) {
                $temp = array();
                $amount = $adjustAbleQty;  // takes all

                $temp['portfolio_id'] = $pid;
                $temp['instrument_id'] = $instrumentId;
                $temp['transaction_type_id'] = 1;  // buy as adding share

                $temp['rate'] = $avgCost;
               // $new_transaction_time = date("Y-m-d H:i:s", strtotime("-30 days"));
                $temp['transaction_time'] = $transaction_time_mature;
                $temp['commission'] = $broker_fee;
                $today = date("Y-m-d");
                $temp['dse_order_id'] = "script-$today";
                $temp['amount'] = $amount;
                if ($temp['amount']) {
                    $returnArr[] = $temp;
                    echo "1=>" . $temp['amount'] . " $instrumentCode FRESH ENTRY to $bo_irn <br />";
                }


            } elseif ($freeQty < $adjustAbleQty) {
                $temp = array();
                $amount = $freeQty;  // takes all of free share. and some share will be still left

                $temp['portfolio_id'] = $pid;
                $temp['instrument_id'] = $instrumentId;
                $temp['transaction_type_id'] = 1;  // buy as adding share

                $temp['rate'] = $avgCost;
              //  $new_transaction_time = date("Y-m-d H:i:s", strtotime("-30 days"));
                $temp['transaction_time'] = $transaction_time_mature;
                $temp['commission'] = $broker_fee;
                $today = date("Y-m-d");
                $temp['dse_order_id'] = "script-$today";
                $temp['amount'] = $amount;
                if ($temp['amount']) {
                    $returnArr[] = $temp;
                    echo "2=>" . $temp['amount'] . " $instrumentCode FRESH ENTRY  to $bo_irn <br />";
                }

                // now add immature shares
                $temp = array();
                $amount = $adjustAbleQty - $freeQty;  // takes all of free share. and some share will be still left

                $temp['portfolio_id'] = $pid;
                $temp['instrument_id'] = $instrumentId;
                $temp['transaction_type_id'] = 1;  // buy as adding share

                $temp['rate'] = $avgCost;
               // $new_transaction_time = date("Y-m-d H:i:s");
                $temp['transaction_time'] = $transaction_time_immature;
                $temp['commission'] = $broker_fee;
                $today = date("Y-m-d");
                $temp['dse_order_id'] = "script-$today";

                if ($amount)
                {
                    $temp['amount'] = $amount;
                    if ($temp['amount']) {
                        $returnArr[] = $temp;
                        echo "3=>" . $temp['amount'] . " $instrumentCode FRESH ENTRY(IMMATURE) to $bo_irn <br />";
                    }
                }

            } else  // adding remaining share as immature
            {
                //@ do nothing
            }


        }

        else  // already this share in portfolio. need adjustment
        {
            $totalCostScript=$totalQty*$avgCostScript;
            $totalCostPortfolio=$existingPortfolioQty*$avgCostPortfolio;
            $diffTotalCost=$totalCostScript-$totalCostPortfolio;


            if ($diff == 0)// portfolio for this item is ok/up to date. NO ACTION REQUIRED FOR NEW ENTRY
            {
                $avgCost=$avgCostPortfolio;

                if ($saleAbleShares < $freeQty) // we have some space to add share as mature
                {


                    //adding shortage of mature share

                    $allowedQty = $freeQty - $saleAbleShares;  // maximum allowed quantity to input as mature share

                    $temp = array();
                    $temp['portfolio_id'] = $pid;
                    $temp['instrument_id'] = $instrumentId;
                    $temp['transaction_type_id'] = 1;  // buy as adding share
                    $temp['rate'] = $avgCost;
                   // $new_transaction_time = date("Y-m-d H:i:s", strtotime("-30 days"));
                    $temp['transaction_time'] = $transaction_time_mature;
                    $temp['commission'] = $broker_fee;
                    $today = date("Y-m-d");
                    $temp['dse_order_id'] = "script-$today";
                    $temp['amount'] = $allowedQty;
                    if ($temp['amount']) {
                        $returnArr[] = $temp;
                        echo "4=>" . $temp['amount'] . " $instrumentCode ADDED (as mature)  to $bo_irn <br />";
                    }

                    //removing excess of immature shares

                   // $allowedLockQty=($existingPortfolioQty-$saleAbleShares)-($totalQty-$freeQty);

                    $temp = array();
                    $temp['portfolio_id'] = $pid;
                    $temp['instrument_id'] = $instrumentId;
                    $temp['transaction_type_id'] = 2;  // SELL as REMOVE share
                    $temp['amount'] = $allowedQty;
                    $temp['rate'] = $avgCost;
                  // $new_transaction_time = date("Y-m-d H:i:s"); // setting today .So it will be shown as immature
                    $temp['transaction_time'] = $transaction_time_immature;
                    $temp['commission'] = $broker_fee;
                    $today = date("Y-m-d");
                    $temp['dse_order_id'] = "script-$today";
                    if ($temp['amount']) {
                        $returnArr[] = $temp;
                        echo "5=>" . $temp['amount'] . " $instrumentCode REMOVED (as immature) form $bo_irn <br />";
                    }

                }
            elseif ($saleAbleShares > $freeQty)
                {
                    //removing excess of mature shares
                    $allowedQty = $saleAbleShares - $freeQty;  // maximum allowed quantity to input as mature share

                    $temp = array();
                    $temp['portfolio_id'] = $pid;
                    $temp['instrument_id'] = $instrumentId;
                    $temp['transaction_type_id'] = 2;  // buy as adding share
                    $temp['rate'] = $avgCost;
                   // $new_transaction_time = date("Y-m-d H:i:s", strtotime("-30 days"));  // changing to past so it will be shown as Mature
                    $temp['transaction_time'] = $transaction_time_mature;
                    $temp['commission'] = $broker_fee;
                    $today = date("Y-m-d");
                    $temp['dse_order_id'] = "script-$today";
                    $temp['amount'] = $allowedQty;
                    if ($temp['amount']) {
                        $returnArr[] = $temp;
                        echo "6=>" . $temp['amount'] . " $instrumentCode REMOVED (as mature) form $bo_irn <br />";
                    }



                    //adding shortage of immature share

                    //$allowedLockQty=($totalQty-$freeQty)-($existingPortfolioQty-$saleAbleShares);

                    $temp = array();
                    $temp['portfolio_id'] = $pid;
                    $temp['instrument_id'] = $instrumentId;
                    $temp['transaction_type_id'] = 1;  // SELL as REMOVE share
                    $temp['amount'] = $allowedQty;
                    $temp['rate'] = $avgCost;
                  //  $new_transaction_time = date("Y-m-d H:i:s"); // setting today .So it will be shown as immature
                    $temp['transaction_time'] = $transaction_time_immature;
                    $temp['commission'] = $broker_fee;
                    $today = date("Y-m-d");
                    $temp['dse_order_id'] = "script-$today";
                    if ($temp['amount']) {
                        $returnArr[] = $temp;
                        echo "7=>" . $temp['amount'] . " $instrumentCode ADDED (as immature) to $bo_irn <br />";
                    }

                }



            } elseif ($diff < 0)// portfolio has more quantity than it should be. So we have to remove them
            {
                $avgCost=$diffTotalCost/-($diff);

                $adjustAbleQty = abs($diff);




                /* =========free share  adjustment start=================*/

                if ($saleAbleShares < $freeQty) // we have some space to add share as mature
                {
                    //@todo manual action required

                    //adding shortage of mature share

                    $allowedQty = $freeQty - $saleAbleShares;  // maximum allowed quantity to input as mature share

                    $temp = array();
                    $temp['portfolio_id'] = $pid;
                    $temp['instrument_id'] = $instrumentId;
                    $temp['transaction_type_id'] = 1;  // buy as adding share
                    $temp['rate'] = $avgCost;
                   // $new_transaction_time = date("Y-m-d H:i:s", strtotime("-30 days"));
                    $temp['transaction_time'] = $transaction_time_mature;
                    $temp['commission'] = $broker_fee;
                    $today = date("Y-m-d");
                    $temp['dse_order_id'] = "script-$today";
                    $temp['amount'] = $allowedQty;
                    if ($temp['amount']) {
                        $returnArr[] = $temp;
                        echo "8=>" . $temp['amount'] . " $instrumentCode ADDED (as mature)  to $bo_irn <br />";
                    }

                    //removing excess of immature shares

                    $allowedLockQty=($existingPortfolioQty-$saleAbleShares)-($totalQty-$freeQty);

                    $temp = array();
                    $temp['portfolio_id'] = $pid;
                    $temp['instrument_id'] = $instrumentId;
                    $temp['transaction_type_id'] = 2;  // SELL as REMOVE share
                    $temp['amount'] = $allowedLockQty;
                    $temp['rate'] = $avgCost;
                   // $new_transaction_time = date("Y-m-d H:i:s"); // setting today .So it will be shown as immature
                    $temp['transaction_time'] = $transaction_time_immature;
                    $temp['commission'] = $broker_fee;
                    $today = date("Y-m-d");
                    $temp['dse_order_id'] = "script-$today";
                    if ($temp['amount']) {
                        $returnArr[] = $temp;
                        echo "9=>" . $temp['amount'] . " $instrumentCode REMOVED (as immature) form $bo_irn <br />";
                    }

                }

                elseif ($saleAbleShares == $freeQty)
                {

                    //removing excess of immature shares
                    $allowedLockQty=($existingPortfolioQty-$saleAbleShares)-($totalQty-$freeQty);

                    $temp = array();
                    $temp['portfolio_id'] = $pid;
                    $temp['instrument_id'] = $instrumentId;
                    $temp['transaction_type_id'] = 2;  // SELL as REMOVE share
                    $temp['amount'] = $allowedLockQty;
                    $temp['rate'] = $avgCost;
                   // $new_transaction_time = date("Y-m-d H:i:s"); // setting today .So it will be shown as immature
                    $temp['transaction_time'] = $transaction_time_immature;
                    $temp['commission'] = $broker_fee;
                    $today = date("Y-m-d");
                    $temp['dse_order_id'] = "script-$today";
                    if ($temp['amount']) {
                        $returnArr[] = $temp;
                        echo "10=>" . $temp['amount'] . " $instrumentCode REMOVED (as immature) form $bo_irn <br />";
                    }

                }

                elseif ($saleAbleShares > $freeQty)
                {
                    //removing excess of mature shares
                    $allowedQty = $saleAbleShares - $freeQty;  // maximum allowed quantity to input as mature share

                    $temp = array();
                    $temp['portfolio_id'] = $pid;
                    $temp['instrument_id'] = $instrumentId;
                    $temp['transaction_type_id'] = 2;  // buy as adding share
                    $temp['rate'] = $avgCost;
                   // $new_transaction_time = date("Y-m-d H:i:s", strtotime("-30 days"));  // changing to past so it will be shown as Mature
                    $temp['transaction_time'] = $transaction_time_mature;
                    $temp['commission'] = $broker_fee;
                    $today = date("Y-m-d");
                    $temp['dse_order_id'] = "script-$today";
                    $temp['amount'] = $allowedQty;
                    if ($temp['amount']) {
                        $returnArr[] = $temp;
                        echo "11=>" . $temp['amount'] . " $instrumentCode REMOVED (as mature) form $bo_irn <br />";
                    }





                    $allowedLockQty=($totalQty-$freeQty)-($existingPortfolioQty-$saleAbleShares);

                    if($allowedLockQty>0)
                    {
                        //adding shortage of immature share
                        $temp = array();
                        $temp['portfolio_id'] = $pid;
                        $temp['instrument_id'] = $instrumentId;
                        $temp['transaction_type_id'] = 1;
                        $temp['amount'] = $allowedLockQty;
                        $temp['rate'] = $avgCost;
                       // $new_transaction_time = date("Y-m-d H:i:s"); // setting today .So it will be shown as immature
                        $temp['transaction_time'] = $transaction_time_immature;
                        $temp['commission'] = $broker_fee;
                        $today = date("Y-m-d");
                        $temp['dse_order_id'] = "script-$today";
                        if ($temp['amount']) {
                            $returnArr[] = $temp;
                            echo "12=>" . $temp['amount'] . " $instrumentCode ADDED (as immature) to $bo_irn <br />";
                        }
                    }
                    elseif($allowedLockQty<0)
                    {  //removing excess of immature shares
                        $temp = array();
                        $temp['portfolio_id'] = $pid;
                        $temp['instrument_id'] = $instrumentId;
                        $temp['transaction_type_id'] = 2;  // SELL as REMOVE share
                        $temp['amount'] = -($allowedLockQty);
                        $temp['rate'] = $avgCost;
                        // $new_transaction_time = date("Y-m-d H:i:s"); // setting today .So it will be shown as immature
                        $temp['transaction_time'] = $transaction_time_immature;
                        $temp['commission'] = $broker_fee;
                        $today = date("Y-m-d");
                        $temp['dse_order_id'] = "script-$today";
                        if ($temp['amount']) {
                            $returnArr[] = $temp;
                            echo "13=>" . $temp['amount'] . " $instrumentCode REMOVED (as mature) to $bo_irn <br />";
                        }
                    }



                }


            }

            elseif ($diff > 0)// portfolio has less quantity than it should be. So we have to add them
            {

                $avgCost=$diffTotalCost/$diff;

                /* =========free share  adjustment start=================*/

                if ($saleAbleShares < $freeQty) // we have some space to add share as mature
                {
                    //adding shortage of mature share
                    $allowedQty = $freeQty - $saleAbleShares;  // maximum allowed quantity to input as mature share


                    $temp = array();
                    $temp['portfolio_id'] = $pid;
                    $temp['instrument_id'] = $instrumentId;
                    $temp['transaction_type_id'] = 1;  // buy as adding share
                    $temp['rate'] = $avgCost;
                   // $new_transaction_time = date("Y-m-d H:i:s", strtotime("-30 days"));  // changing to past so it will be shown as Mature
                    $temp['transaction_time'] = $transaction_time_mature;
                    $temp['commission'] = $broker_fee;
                    $today = date("Y-m-d");
                    $temp['dse_order_id'] = "script-$today";
                    $temp['amount'] = $allowedQty;
                    if ($temp['amount'])
                    {
                        $returnArr[] = $temp;
                        echo "14=>" . $temp['amount'] . " $instrumentCode ADDED (as mature) to $bo_irn <br />";
                    }

                    //removing excess of immature share
                    $allowedLockQty=($existingPortfolioQty-$saleAbleShares)-($totalQty-$freeQty);

                    $temp = array();
                    $temp['portfolio_id'] = $pid;
                    $temp['instrument_id'] = $instrumentId;
                    $temp['transaction_type_id'] = 2;  // SELL as REMOVE share
                    $temp['amount'] = $allowedLockQty;
                    $temp['rate'] = $avgCost;
                  //  $new_transaction_time = date("Y-m-d H:i:s"); // setting today .So it will be shown as immature
                    $temp['transaction_time'] = $transaction_time_immature;
                    $temp['commission'] = $broker_fee;
                    $today = date("Y-m-d");
                    $temp['dse_order_id'] = "script-$today";
                    if ($temp['amount']) {
                        $returnArr[] = $temp;
                        echo "15=>" . $temp['amount'] . " $instrumentCode REMOVED (as immature) form $bo_irn <br />";
                    }


                }
                elseif ($saleAbleShares == $freeQty) // we have to add left share as immature as we have already saleable share as free share
                {

                    //adding shortage of immature share
                    $allowedLockQty=($totalQty-$freeQty)-($existingPortfolioQty-$saleAbleShares);

                    $temp = array();
                    $temp['portfolio_id'] = $pid;
                    $temp['instrument_id'] = $instrumentId;
                    $temp['transaction_type_id'] = 1;  // buy as adding share
                    $temp['amount'] = $allowedLockQty;
                    $temp['rate'] = $avgCost;
                   // $new_transaction_time = date("Y-m-d H:i:s"); // setting today .So it will be shown as immature
                    $temp['transaction_time'] = $transaction_time_immature;
                    $temp['commission'] = $broker_fee;
                    $today = date("Y-m-d");
                    $temp['dse_order_id'] = "script-$today";
                    if ($temp['amount']) {
                        $returnArr[] = $temp;
                        echo "16=>" . $temp['amount'] . " $instrumentCode ADDED (as immature) to $bo_irn <br />";
                    }

                }

                elseif ($saleAbleShares > $freeQty) // we have some share in the portfolio that have inputed by mistake
                {
                    // @todo treatment needed to remove share

                    //removing excess of mature share

                    $allowedQty =$saleAbleShares-$freeQty ;

                    $temp = array();
                    $temp['portfolio_id'] = $pid;
                    $temp['instrument_id'] = $instrumentId;
                    $temp['transaction_type_id'] = 2;  // SELL as REMOVE share
                    $temp['amount'] = $allowedQty;
                    $temp['rate'] = $avgCost;
                    $new_transaction_time =  date("Y-m-d H:i:s", strtotime("-30 days")); // setting today .So it will be shown as immature
                    $temp['transaction_time'] = $new_transaction_time;
                    $temp['commission'] = $broker_fee;
                    $today = date("Y-m-d");
                    $temp['dse_order_id'] = "script-$today";
                    if ($temp['amount']) {
                        $returnArr[] = $temp;
                        echo "17=>" . $temp['amount'] . " $instrumentCode REMOVED (as mature) from $bo_irn <br />";
                    }


                    //adding shortage of immature share

                    $allowedLockQty=($totalQty-$freeQty)-($existingPortfolioQty-$saleAbleShares);

                    $temp = array();
                    $temp['portfolio_id'] = $pid;
                    $temp['instrument_id'] = $instrumentId;
                    $temp['transaction_type_id'] = 1;  // buy as adding share
                    $temp['amount'] = $allowedLockQty; // taking all remaining quantity
                    $temp['rate'] = $avgCost;
                   // $new_transaction_time = date("Y-m-d H:i:s"); // setting today .So it will be shown as immature
                    $temp['transaction_time'] = $transaction_time_immature;
                    $temp['commission'] = $broker_fee;
                    $today = date("Y-m-d");
                    $temp['dse_order_id'] = "script-$today";

                    if ($temp['amount']) {
                        $returnArr[] = $temp;
                        echo "18=>" . $temp['amount'] . " $instrumentCode ADDED (as immature) to $bo_irn <br />";
                    }

                }

            }
        }

        return $returnArr;

    }
//////////////////////////////////////////////////////////////for Apex broker house END////////////////////////////////////////////////////////////////////

/////////////////////////////////////////////////////////////for HAC broker house//////////////////////////////////////////////////////////////////////////
    public function portfolio_update_hac($userPerSlot = 15)
    {
        // Configure::write('debug', 2);

        $brokerId = Configure::read('broker.hac.id');
        $Omo = $this->Components->load('Omo');
        $StockBangladesh = $this->Components->load('StockBangladesh');
        $userList = $Omo->getUsersList(4, 1);

        $array_data = array();

        $portfolios_file_path = Configure::read('broker.hac.portfolios_file_path');
        $fileArr = $StockBangladesh->scan_dir($portfolios_file_path);
        $fullFilePath = "$portfolios_file_path/" . $fileArr[0];
        $file = fopen($fullFilePath, "r");
        $fileDate=0;
        // read each data row in the file

        while (!feof($file)) {
            $row = fgetcsv($file);

        if(strpos($row[0],': ')==true)
            {
                $fileDate=$row[0];
                $fileDate = explode(':', $fileDate);
                $fileDate = $fileDate[1];
                $fileDate=date('d-m-Y',strtotime($fileDate));
            }

            elseif ($row[1] == '') {
                continue;
            }

            else
                $array_data[] = $row[1];

        }


        if($fileDate!= date('d-m-Y'))
        {
            echo "<br>";
            echo "<h2>this is not today's file.please recheck and upload the correct file again</h2>";
            exit;
        }

       // unset($array_data[1]);


     //   $HacOmoUsers= Hash::extract($array_data,'{n}.1');
        $HacOmoUsers=array_unique($array_data);
        $HacOmoUsers = Hash::sort($HacOmoUsers,'{n}','asc');

        $brokerUsers = array();
        foreach ($userList[$brokerId] as $irn => $arr) {
            $key = trim($irn);
            $key = str_pad($key, 5, "0", STR_PAD_LEFT);
            $key = strtoupper($key);
            if (in_array($key,$HacOmoUsers))
                $brokerUsers[$key] = $arr;
            else
                continue;
        }


        $totalUser = count($brokerUsers) + 15;
        ksort($brokerUsers);
        $this->set('totalUser', $totalUser);
        $this->set('userPerSlot', $userPerSlot);
        $this->set('brokerUsers', $brokerUsers);
        $this->set('pageTitleMain','Portfolio Update');
        $this->set('pageTitleSmall','update process of user portfolios ');
    }
    public function portfolio_update_hac_new($userPerSlot = 15)
    {
        // Configure::write('debug', 2);

        $brokerId = Configure::read('broker.hac.id');
        $Omo = $this->Components->load('Omo');
        $StockBangladesh = $this->Components->load('StockBangladesh');
        $userList = $Omo->getUsersList(4, 1);

        $array_data = array();

        $portfolios_file_path = Configure::read('broker.hac.portfolios_file_path');
        $fileArr = $StockBangladesh->scan_dir($portfolios_file_path);
        $fullFilePath = "$portfolios_file_path/" . $fileArr[0];
        $file = fopen($fullFilePath, "r");
        $fileDate=0;
        // read each data row in the file

        while (!feof($file)) {
            $row = fgetcsv($file);

        if(strpos($row[0],': ')==true)
            {
                $fileDate=$row[0];
                $fileDate = explode(':', $fileDate);
                $fileDate = $fileDate[1];
                $fileDate=date('d-m-Y',strtotime($fileDate));
            }

            elseif ($row[1] == '') {
                continue;
            }

            else
                $array_data[] = $row[1];

        }


        if($fileDate!= date('d-m-Y'))
        {
            echo "<br>";
            echo "<h2>this is not today's file.please recheck and upload the correct file again</h2>";
            exit;
        }

       // unset($array_data[1]);


     //   $HacOmoUsers= Hash::extract($array_data,'{n}.1');
        $HacOmoUsers=array_unique($array_data);
        $HacOmoUsers = Hash::sort($HacOmoUsers,'{n}','asc');

        $brokerUsers = array();
        foreach ($userList[$brokerId] as $irn => $arr) {
            $key = trim($irn);
            $key = str_pad($key, 5, "0", STR_PAD_LEFT);
            $key = strtoupper($key);
            if (in_array($key,$HacOmoUsers))
                $brokerUsers[$key] = $arr;
            else
                continue;
        }


        $totalUser = count($brokerUsers) + 15;
        ksort($brokerUsers);
        $this->set('totalUser', $totalUser);
        $this->set('userPerSlot', $userPerSlot);
        $this->set('brokerUsers', $brokerUsers);
        $this->set('pageTitleMain','Portfolio Update');
        $this->set('pageTitleSmall','update process of user portfolios ');
    }


    public function portfolio_update_script_hac_new($userFrom = 0, $userTo = 15, $confirm = 0)
    {
        //Configure::write('debug', 2);
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
        $instrumentList = $StockBangladesh->instrumentList(2);
        $metaKey = array("category");
        $instrumentInfo = $StockBangladesh->getFundamentalInfo(0, $metaKey);


        $brokerId = Configure::read('broker.hac.id');
        $Omo = $this->Components->load('Omo');
        $userList = $Omo->getUsersList(4, 1);


        $array_data = array();

        $portfolios_file_path = Configure::read('broker.hac.portfolios_file_path');
        $fileArr = $StockBangladesh->scan_dir($portfolios_file_path);
        $fullFilePath = "$portfolios_file_path/" . $fileArr[0];
        $file = fopen($fullFilePath, "r");

        // read each data row in the file

        while (!feof($file)) {
            $row = fgetcsv($file);
            if ($row[1] == '') {
                continue;
            }
            else
                $array_data[] = $row;

        }
       // unset($array_data[1]);


        $HacOmoUsers= Hash::extract($array_data,'{n}.1');
        $HacOmoUsers=array_unique($HacOmoUsers);
        $HacOmoUsers = Hash::sort($HacOmoUsers,'{n}','asc');


        $brokerUsers = array();
        foreach ($userList[$brokerId] as $irn => $arr) {
            $key = trim($irn);
            $key = str_pad($key, 5, "0", STR_PAD_LEFT);
            $key = strtoupper($key);
            if (in_array($key,$HacOmoUsers))
                    $brokerUsers[$key] = $arr;
            else
                continue;
        }


        //  $brokerUsers= Hash::sort($brokerUsers, '{s}internal_ref_no', 'asc');
        ksort($brokerUsers);


        $dataGroupByIrn = array();
        foreach ($array_data as $row) {
            $irn = $row[1];
            $totalQty = $row[17];
            $row[7] = strtoupper(trim($row[7]));

            if ($totalQty)
                $dataGroupByIrn[$irn][] = $row;
        }


        $model = ClassRegistry::init('Portfolio');
        $Portfolio = $this->Components->load('Portfolio');
        $this->ttypeArr = $Portfolio->getTransactionType();
        $dataToSave = array();


        $i = 0;


        foreach ($brokerUsers as $irn => $user) {
            $i++;


            if ($i > $userFrom and $i <= $userTo) {


                $pid = $user['portfolio_id'];
                $broker_fee = $user['broker_fee'];

                //   pr($dataGroupByIrn[$irn]);

                if (!isset($dataGroupByIrn[$irn])) {
                    echo "<h2>There is no share found for $irn in Hac excell </h2>";

                    continue;
                } else {

                    $actualHoldings = $dataGroupByIrn[$irn];
                }


                $model->contain('PortfolioTransaction');
                $allTransactions = $model->find('all', array(
                        'conditions' => "Portfolio.id=$pid"

                    )
                );

                $instrumentListKeyId = $StockBangladesh->instrumentList(3);

                $portfolioHoldingsTransaction = $Portfolio->getPortfolioHoldings2($allTransactions, $this->ttypeArr);

                // padding missing share of $portfolioHoldingsTransaction in $actualHoldings
                foreach ($portfolioHoldingsTransaction as $instrumentId => $arr) {
                    $temp = array();
                    $code = $instrumentListKeyId[$instrumentId];


                    $temp[] = ''; //0
                    $temp[] = $irn;//1
                    $temp[] = '';//2
                    $temp[] = '';//3
                    $temp[] = '';//4
                    $temp[] = '';//5
                    $temp[] = '';//6
                    $temp[] = $code;//7
                    $temp[] = '';//8
                    $temp[] = '';//9
                    $temp[] = 0;//10
                    $temp[] = '';//11
                    $temp[] = '';//12
                    $temp[] = 0;//13
                    $temp[] = '';//14
                    $temp[] = 0;//15
                    $temp[] = '';//16
                    $temp[] = 0;//17
                    $temp[] = '';//18
                    $temp[] = 0;//19
                    $temp[] = '';//20
                    $temp[] = 0;//21
                    $temp[] = 0;//22
                    $temp[] = '';//23
                    $temp[] = 0;//24
                    $temp[] = '';//25
                    $temp[] = '';//26
                    $temp[] = '';//27


                    $shareExist = Hash::extract($actualHoldings, "{n}[7=$code]");


                    if (empty($shareExist)) {

                        $actualHoldings[] = $temp;
                    }

                }

               

                echo "==================================================processing $irn is started=========================================<br />";

                foreach ($actualHoldings as $share) {


                    $instrumentCode = strtoupper(trim($share[7]));



                    if (!isset($instrumentList[$instrumentCode])) {
                        echo "<h3>$instrumentCode is not found</h3>";
                        continue;


                    } else {
                        $instrumentId = $instrumentList[$instrumentCode];


                        if(isset($instrumentInfo[$instrumentId]['category']['meta_value']))
                        {
                            $category = $instrumentInfo[$instrumentId]['category']['meta_value'];
                        }
                        else
                        {
                            echo "<h3>$instrumentCode category undefined</h3>";
                            continue;
                        }

                        $newEntryArr = $this->adjustPortfolio_hac_new($share, $portfolioHoldingsTransaction, $instrumentId, $category, $pid, $broker_fee);


                        if(!empty($newEntryArr))
                            $dataToSave[$irn]=$newEntryArr[0]['portfolio_id']."Problem code=$irn";


                      //  $dataToSave = array_merge($dataToSave, $newEntryArr);

                    }

                    // pr($newEntryArr);



                }
                echo "==================================================processing $irn is finished=========================================<br />";


            }
            // else
            //  echo "'.$irn.' has no transaction";


        }


        foreach($dataToSave as $irn=>$row)
        {
                 echo "<h3>$irn has some problem <a href='http://www.new.stockbangladesh.net/Stations/runLedgerHac/$irn' target='_blank'>Reset portfolio using ledger</a></h3>";
        }


        exit;
    }

    public function adjustPortfolio_hac_new($share, $portfolioHoldingsTransaction, $instrumentId, $category, $pid, $broker_fee)
    {
     //   Configure::write('debug', 2);

        App::uses('CakeTime', 'Utility');
        $freeQty = $share[10];
        $tempAvgCostScript=$share[15];
        $avgCostScript = ($tempAvgCostScript*100)/(100+$broker_fee); //substitution of commission or broker fee
        $totalQty = $share[17];
        $lockinQty = $share[21];
        $instrumentCode = strtoupper(trim($share[7]));
        $bo_irn = trim($share[1]);



        // remove lockin quantity
        if ($lockinQty > 0) {
            $totalQty = $totalQty - $lockinQty;
        }


        if (isset($portfolioHoldingsTransaction[$instrumentId])) {

            $existingPortfolioQty = $portfolioHoldingsTransaction[$instrumentId]['totalQuantity'];
            $existingPortfolioDividendQuantity = $portfolioHoldingsTransaction[$instrumentId]['dividendQuantity'];
            $receiveableDividendQuantity = $portfolioHoldingsTransaction[$instrumentId]['receiveableDividendQuantity'];
            $saleAbleShares = $portfolioHoldingsTransaction[$instrumentId]['saleAbleShares'];
            $avgCostPortfolio=$portfolioHoldingsTransaction[$instrumentId]['avgCost'];

        } else {
            $existingPortfolioQty = 0;
            $existingPortfolioDividendQuantity = 0;
            $receiveableDividendQuantity = 0;
            $saleAbleShares = 0;
        }
        $diff = $totalQty - $existingPortfolioQty;
        echo "<span style='color:green'>$instrumentCode excell totalQty =$totalQty portfolio existingPortfolioQty=$existingPortfolioQty  diff=$diff<br /></span>";



        $returnArr = array();
        $transaction_time_mature = date("Y-m-d H:i:s", strtotime("-30 days"));
        $transaction_time_immature = date("Y-m-d H:i:s");

        //for backdated portfolio Update change immature date...
        // $transaction_time_immature = date("Y-m-d H:i:s", strtotime("-1 days"));

        if ($existingPortfolioQty == 0)  // need a fresh entry
        {
            $adjustAbleQty = $totalQty;
            $avgCost=$avgCostScript;

            if ($freeQty >= $adjustAbleQty) {
                $temp = array();
                $amount = $adjustAbleQty;  // takes all

                $temp['portfolio_id'] = $pid;
                $temp['instrument_id'] = $instrumentId;
                $temp['transaction_type_id'] = 1;  // buy as adding share

                $temp['rate'] = $avgCost;
                // $new_transaction_time = date("Y-m-d H:i:s", strtotime("-30 days"));
                $temp['transaction_time'] = $transaction_time_mature;
                $temp['commission'] = $broker_fee;
                $today = date("Y-m-d");
                $temp['dse_order_id'] = "script-$today";
                $temp['amount'] = $amount;
                if ($temp['amount']) {
                    $returnArr[] = $temp;
                    echo "1=>" . $temp['amount'] . " $instrumentCode FRESH ENTRY to $bo_irn <br />";
                }


            } elseif ($freeQty < $adjustAbleQty) {
                $temp = array();
                $amount = $freeQty;  // takes all of free share. and some share will be still left

                $temp['portfolio_id'] = $pid;
                $temp['instrument_id'] = $instrumentId;
                $temp['transaction_type_id'] = 1;  // buy as adding share

                $temp['rate'] = $avgCost;
                //  $new_transaction_time = date("Y-m-d H:i:s", strtotime("-30 days"));
                $temp['transaction_time'] = $transaction_time_mature;
                $temp['commission'] = $broker_fee;
                $today = date("Y-m-d");
                $temp['dse_order_id'] = "script-$today";
                $temp['amount'] = $amount;
                if ($temp['amount']) {
                    $returnArr[] = $temp;
                    echo "2=>" . $temp['amount'] . " $instrumentCode FRESH ENTRY  to $bo_irn <br />";
                }

                // now add immature shares
                $temp = array();
                $amount = $adjustAbleQty - $freeQty;  // takes all of free share. and some share will be still left

                $temp['portfolio_id'] = $pid;
                $temp['instrument_id'] = $instrumentId;
                $temp['transaction_type_id'] = 1;  // buy as adding share

                $temp['rate'] = $avgCost;
                // $new_transaction_time = date("Y-m-d H:i:s");
                $temp['transaction_time'] = $transaction_time_immature;
                $temp['commission'] = $broker_fee;
                $today = date("Y-m-d");
                $temp['dse_order_id'] = "script-$today";

                if ($amount)
                {
                    $temp['amount'] = $amount;
                    if ($temp['amount']) {
                        $returnArr[] = $temp;
                        echo "3=>" . $temp['amount'] . " $instrumentCode FRESH ENTRY(IMMATURE) to $bo_irn <br />";
                    }
                }

            } else  // adding remaining share as immature
            {
                //@ do nothing
            }


        }

        else  // already this share in portfolio. need adjustment
        {
            $totalCostScript=$totalQty*$avgCostScript;
            $totalCostPortfolio=$existingPortfolioQty*$avgCostPortfolio;
            $diffTotalCost=$totalCostScript-$totalCostPortfolio;


            if ($diff == 0)// portfolio for this item is ok/up to date. NO ACTION REQUIRED FOR NEW ENTRY
            {
                $avgCost=$avgCostPortfolio;

                if ($saleAbleShares < $freeQty) // we have some space to add share as mature
                {


                    //adding shortage of mature share

                    $allowedQty = $freeQty - $saleAbleShares;  // maximum allowed quantity to input as mature share

                    $temp = array();
                    $temp['portfolio_id'] = $pid;
                    $temp['instrument_id'] = $instrumentId;
                    $temp['transaction_type_id'] = 1;  // buy as adding share
                    $temp['rate'] = $avgCost;
                    // $new_transaction_time = date("Y-m-d H:i:s", strtotime("-30 days"));
                    $temp['transaction_time'] = $transaction_time_mature;
                    $temp['commission'] = $broker_fee;
                    $today = date("Y-m-d");
                    $temp['dse_order_id'] = "script-$today";
                    $temp['amount'] = $allowedQty;
                    if ($temp['amount']) {
                        $returnArr[] = $temp;
                        echo "4=>" . $temp['amount'] . " $instrumentCode ADDED (as mature)  to $bo_irn <br />";
                    }

                    //removing excess of immature shares

                    // $allowedLockQty=($existingPortfolioQty-$saleAbleShares)-($totalQty-$freeQty);

                    $temp = array();
                    $temp['portfolio_id'] = $pid;
                    $temp['instrument_id'] = $instrumentId;
                    $temp['transaction_type_id'] = 2;  // SELL as REMOVE share
                    $temp['amount'] = $allowedQty;
                    $temp['rate'] = $avgCost;
                    // $new_transaction_time = date("Y-m-d H:i:s"); // setting today .So it will be shown as immature
                    $temp['transaction_time'] = $transaction_time_immature;
                    $temp['commission'] = $broker_fee;
                    $today = date("Y-m-d");
                    $temp['dse_order_id'] = "script-$today";
                    if ($temp['amount']) {
                        $returnArr[] = $temp;
                        echo "5=>" . $temp['amount'] . " $instrumentCode REMOVED (as immature) form $bo_irn <br />";
                    }

                }
                elseif ($saleAbleShares > $freeQty)
                {
                    //removing excess of mature shares
                    $allowedQty = $saleAbleShares - $freeQty;  // maximum allowed quantity to input as mature share

                    $temp = array();
                    $temp['portfolio_id'] = $pid;
                    $temp['instrument_id'] = $instrumentId;
                    $temp['transaction_type_id'] = 2;  // buy as adding share
                    $temp['rate'] = $avgCost;
                    // $new_transaction_time = date("Y-m-d H:i:s", strtotime("-30 days"));  // changing to past so it will be shown as Mature
                    $temp['transaction_time'] = $transaction_time_mature;
                    $temp['commission'] = $broker_fee;
                    $today = date("Y-m-d");
                    $temp['dse_order_id'] = "script-$today";
                    $temp['amount'] = $allowedQty;
                    if ($temp['amount']) {
                        $returnArr[] = $temp;
                        echo "6=>" . $temp['amount'] . " $instrumentCode REMOVED (as mature) form $bo_irn <br />";
                    }



                    //adding shortage of immature share

                    //$allowedLockQty=($totalQty-$freeQty)-($existingPortfolioQty-$saleAbleShares);

                    $temp = array();
                    $temp['portfolio_id'] = $pid;
                    $temp['instrument_id'] = $instrumentId;
                    $temp['transaction_type_id'] = 1;  // SELL as REMOVE share
                    $temp['amount'] = $allowedQty;
                    $temp['rate'] = $avgCost;
                    //  $new_transaction_time = date("Y-m-d H:i:s"); // setting today .So it will be shown as immature
                    $temp['transaction_time'] = $transaction_time_immature;
                    $temp['commission'] = $broker_fee;
                    $today = date("Y-m-d");
                    $temp['dse_order_id'] = "script-$today";
                    if ($temp['amount']) {
                        $returnArr[] = $temp;
                        echo "7=>" . $temp['amount'] . " $instrumentCode ADDED (as immature) to $bo_irn <br />";
                    }

                }



            } elseif ($diff < 0)// portfolio has more quantity than it should be. So we have to remove them
            {

                $avgCost=$diffTotalCost/-($diff);
                $adjustAbleQty = abs($diff);




                /* =========free share  adjustment start=================*/

                if ($saleAbleShares < $freeQty) // we have some space to add share as mature
                {
                    //@todo manual action required

                    //adding shortage of mature share

                    $allowedQty = $freeQty - $saleAbleShares;  // maximum allowed quantity to input as mature share

                    $temp = array();
                    $temp['portfolio_id'] = $pid;
                    $temp['instrument_id'] = $instrumentId;
                    $temp['transaction_type_id'] = 1;  // buy as adding share
                    $temp['rate'] = $avgCost;
                    // $new_transaction_time = date("Y-m-d H:i:s", strtotime("-30 days"));
                    $temp['transaction_time'] = $transaction_time_mature;
                    $temp['commission'] = $broker_fee;
                    $today = date("Y-m-d");
                    $temp['dse_order_id'] = "script-$today";
                    $temp['amount'] = $allowedQty;
                    if ($temp['amount']) {
                        $returnArr[] = $temp;
                        echo "8=>" . $temp['amount'] . " $instrumentCode ADDED (as mature)  to $bo_irn <br />";
                    }

                    //removing excess of immature shares

                    $allowedLockQty=($existingPortfolioQty-$saleAbleShares)-($totalQty-$freeQty);

                    $temp = array();
                    $temp['portfolio_id'] = $pid;
                    $temp['instrument_id'] = $instrumentId;
                    $temp['transaction_type_id'] = 2;  // SELL as REMOVE share
                    $temp['amount'] = $allowedLockQty;
                    $temp['rate'] = $avgCost;
                    // $new_transaction_time = date("Y-m-d H:i:s"); // setting today .So it will be shown as immature
                    $temp['transaction_time'] = $transaction_time_immature;
                    $temp['commission'] = $broker_fee;
                    $today = date("Y-m-d");
                    $temp['dse_order_id'] = "script-$today";
                    if ($temp['amount']) {
                        $returnArr[] = $temp;
                        echo "9=>" . $temp['amount'] . " $instrumentCode REMOVED (as immature) form $bo_irn <br />";
                    }

                }

                elseif ($saleAbleShares == $freeQty)
                {

                    //removing excess of immature shares
                    $allowedLockQty=($existingPortfolioQty-$saleAbleShares)-($totalQty-$freeQty);

                    $temp = array();
                    $temp['portfolio_id'] = $pid;
                    $temp['instrument_id'] = $instrumentId;
                    $temp['transaction_type_id'] = 2;  // SELL as REMOVE share
                    $temp['amount'] = $allowedLockQty;
                    $temp['rate'] = $avgCost;
                    // $new_transaction_time = date("Y-m-d H:i:s"); // setting today .So it will be shown as immature
                    $temp['transaction_time'] = $transaction_time_immature;
                    $temp['commission'] = $broker_fee;
                    $today = date("Y-m-d");
                    $temp['dse_order_id'] = "script-$today";
                    if ($temp['amount']) {
                        $returnArr[] = $temp;
                        echo "10=>" . $temp['amount'] . " $instrumentCode REMOVED (as immature) form $bo_irn <br />";
                    }

                }

                elseif ($saleAbleShares > $freeQty)
                {
                    //removing excess of mature shares
                    $allowedQty = $saleAbleShares - $freeQty;  // maximum allowed quantity to input as mature share

                    $temp = array();
                    $temp['portfolio_id'] = $pid;
                    $temp['instrument_id'] = $instrumentId;
                    $temp['transaction_type_id'] = 2;  // buy as adding share
                    $temp['rate'] = $avgCost;
                    // $new_transaction_time = date("Y-m-d H:i:s", strtotime("-30 days"));  // changing to past so it will be shown as Mature
                    $temp['transaction_time'] = $transaction_time_mature;
                    $temp['commission'] = $broker_fee;
                    $today = date("Y-m-d");
                    $temp['dse_order_id'] = "script-$today";
                    $temp['amount'] = $allowedQty;
                    if ($temp['amount']) {
                        $returnArr[] = $temp;
                        echo "11=>" . $temp['amount'] . " $instrumentCode REMOVED (as mature) form $bo_irn <br />";
                    }





                    $allowedLockQty=($totalQty-$freeQty)-($existingPortfolioQty-$saleAbleShares);

                    if($allowedLockQty>0)
                    {
                        //adding shortage of immature share
                        $temp = array();
                        $temp['portfolio_id'] = $pid;
                        $temp['instrument_id'] = $instrumentId;
                        $temp['transaction_type_id'] = 1;
                        $temp['amount'] = $allowedLockQty;
                        $temp['rate'] = $avgCost;
                        // $new_transaction_time = date("Y-m-d H:i:s"); // setting today .So it will be shown as immature
                        $temp['transaction_time'] = $transaction_time_immature;
                        $temp['commission'] = $broker_fee;
                        $today = date("Y-m-d");
                        $temp['dse_order_id'] = "script-$today";
                        if ($temp['amount']) {
                            $returnArr[] = $temp;
                            echo "12=>" . $temp['amount'] . " $instrumentCode ADDED (as immature) to $bo_irn <br />";
                        }
                    }
                    elseif($allowedLockQty<0)
                    {  //removing excess of immature shares
                        $temp = array();
                        $temp['portfolio_id'] = $pid;
                        $temp['instrument_id'] = $instrumentId;
                        $temp['transaction_type_id'] = 2;  // SELL as REMOVE share
                        $temp['amount'] = -($allowedLockQty);
                        $temp['rate'] = $avgCost;
                        // $new_transaction_time = date("Y-m-d H:i:s"); // setting today .So it will be shown as immature
                        $temp['transaction_time'] = $transaction_time_immature;
                        $temp['commission'] = $broker_fee;
                        $today = date("Y-m-d");
                        $temp['dse_order_id'] = "script-$today";
                        if ($temp['amount']) {
                            $returnArr[] = $temp;
                            echo "13=>" . $temp['amount'] . " $instrumentCode REMOVED (as mature) to $bo_irn <br />";
                        }
                    }



                }


            }

            elseif ($diff > 0)// portfolio has less quantity than it should be. So we have to add them
            {
                $avgCost=$diffTotalCost/$diff;
                /* =========free share  adjustment start=================*/

                if ($saleAbleShares < $freeQty) // we have some space to add share as mature
                {
                    //adding shortage of mature share
                    $allowedQty = $freeQty - $saleAbleShares;  // maximum allowed quantity to input as mature share


                    $temp = array();
                    $temp['portfolio_id'] = $pid;
                    $temp['instrument_id'] = $instrumentId;
                    $temp['transaction_type_id'] = 1;  // buy as adding share
                    $temp['rate'] = $avgCost;
                    // $new_transaction_time = date("Y-m-d H:i:s", strtotime("-30 days"));  // changing to past so it will be shown as Mature
                    $temp['transaction_time'] = $transaction_time_mature;
                    $temp['commission'] = $broker_fee;
                    $today = date("Y-m-d");
                    $temp['dse_order_id'] = "script-$today";
                    $temp['amount'] = $allowedQty;
                    if ($temp['amount'])
                    {
                        $returnArr[] = $temp;
                        echo "14=>" . $temp['amount'] . " $instrumentCode ADDED (as mature) to $bo_irn <br />";
                    }

                    //removing excess of immature share
                    $allowedLockQty=($existingPortfolioQty-$saleAbleShares)-($totalQty-$freeQty);

                    $temp = array();
                    $temp['portfolio_id'] = $pid;
                    $temp['instrument_id'] = $instrumentId;
                    $temp['transaction_type_id'] = 2;  // SELL as REMOVE share
                    $temp['amount'] = $allowedLockQty;
                    $temp['rate'] = $avgCost;
                    //  $new_transaction_time = date("Y-m-d H:i:s"); // setting today .So it will be shown as immature
                    $temp['transaction_time'] = $transaction_time_immature;
                    $temp['commission'] = $broker_fee;
                    $today = date("Y-m-d");
                    $temp['dse_order_id'] = "script-$today";
                    if ($temp['amount']) {
                        $returnArr[] = $temp;
                        echo "15=>" . $temp['amount'] . " $instrumentCode REMOVED (as immature) form $bo_irn <br />";
                    }


                }
                elseif ($saleAbleShares == $freeQty) // we have to add left share as immature as we have already saleable share as free share
                {

                    //adding shortage of immature share
                    $allowedLockQty=($totalQty-$freeQty)-($existingPortfolioQty-$saleAbleShares);

                    $temp = array();
                    $temp['portfolio_id'] = $pid;
                    $temp['instrument_id'] = $instrumentId;
                    $temp['transaction_type_id'] = 1;  // buy as adding share
                    $temp['amount'] = $allowedLockQty;
                    $temp['rate'] = $avgCost;
                    // $new_transaction_time = date("Y-m-d H:i:s"); // setting today .So it will be shown as immature
                    $temp['transaction_time'] = $transaction_time_immature;
                    $temp['commission'] = $broker_fee;
                    $today = date("Y-m-d");
                    $temp['dse_order_id'] = "script-$today";
                    if ($temp['amount']) {
                        $returnArr[] = $temp;
                        echo "16=>" . $temp['amount'] . " $instrumentCode ADDED (as immature) to $bo_irn <br />";
                    }

                }

                elseif ($saleAbleShares > $freeQty) // we have some share in the portfolio that have inputed by mistake
                {
                    // @todo treatment needed to remove share

                    //removing excess of mature share

                    $allowedQty =$saleAbleShares-$freeQty ;

                    $temp = array();
                    $temp['portfolio_id'] = $pid;
                    $temp['instrument_id'] = $instrumentId;
                    $temp['transaction_type_id'] = 2;  // SELL as REMOVE share
                    $temp['amount'] = $allowedQty;
                    $temp['rate'] = $avgCost;
                    $new_transaction_time =  date("Y-m-d H:i:s", strtotime("-30 days")); // setting today .So it will be shown as immature
                    $temp['transaction_time'] = $new_transaction_time;
                    $temp['commission'] = $broker_fee;
                    $today = date("Y-m-d");
                    $temp['dse_order_id'] = "script-$today";
                    if ($temp['amount']) {
                        $returnArr[] = $temp;
                        echo "17=>" . $temp['amount'] . " $instrumentCode REMOVED (as mature) from $bo_irn <br />";
                    }


                    //adding shortage of immature share

                    $allowedLockQty=($totalQty-$freeQty)-($existingPortfolioQty-$saleAbleShares);

                    $temp = array();
                    $temp['portfolio_id'] = $pid;
                    $temp['instrument_id'] = $instrumentId;
                    $temp['transaction_type_id'] = 1;  // buy as adding share
                    $temp['amount'] = $allowedLockQty; // taking all remaining quantity
                    $temp['rate'] = $avgCost;
                    // $new_transaction_time = date("Y-m-d H:i:s"); // setting today .So it will be shown as immature
                    $temp['transaction_time'] = $transaction_time_immature;
                    $temp['commission'] = $broker_fee;
                    $today = date("Y-m-d");
                    $temp['dse_order_id'] = "script-$today";

                    if ($temp['amount']) {
                        $returnArr[] = $temp;
                        echo "18=>" . $temp['amount'] . " $instrumentCode ADDED (as immature) to $bo_irn <br />";
                    }

                }

            }
        }

        return $returnArr;

    }

    public function portfolio_update_script_hac($userFrom = 0, $userTo = 15, $confirm = 0)
    {
        //Configure::write('debug', 2);
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
        $instrumentList = $StockBangladesh->instrumentList(2);
        $metaKey = array("category");
        $instrumentInfo = $StockBangladesh->getFundamentalInfo(0, $metaKey);


        $brokerId = Configure::read('broker.hac.id');
        $Omo = $this->Components->load('Omo');
        $userList = $Omo->getUsersList(4, 1);


        $array_data = array();

        $portfolios_file_path = Configure::read('broker.hac.portfolios_file_path');
        $fileArr = $StockBangladesh->scan_dir($portfolios_file_path);
        $fullFilePath = "$portfolios_file_path/" . $fileArr[0];
        $file = fopen($fullFilePath, "r");

        // read each data row in the file

        while (!feof($file)) {
            $row = fgetcsv($file);
            if ($row[1] == '') {
                continue;
            }
            else
                $array_data[] = $row;

        }
        // unset($array_data[1]);


        $HacOmoUsers= Hash::extract($array_data,'{n}.1');
        $HacOmoUsers=array_unique($HacOmoUsers);
        $HacOmoUsers = Hash::sort($HacOmoUsers,'{n}','asc');


        $brokerUsers = array();
        foreach ($userList[$brokerId] as $irn => $arr) {
            $key = trim($irn);
            $key = str_pad($key, 5, "0", STR_PAD_LEFT);
            $key = strtoupper($key);
            if (in_array($key,$HacOmoUsers))
                $brokerUsers[$key] = $arr;
            else
                continue;
        }


        //  $brokerUsers= Hash::sort($brokerUsers, '{s}internal_ref_no', 'asc');
        ksort($brokerUsers);


        $dataGroupByIrn = array();
        foreach ($array_data as $row) {
            $irn = $row[1];
            $totalQty = $row[17];
            $row[7] = strtoupper(trim($row[7]));

            if ($totalQty)
                $dataGroupByIrn[$irn][] = $row;
        }


        $model = ClassRegistry::init('Portfolio');
        $Portfolio = $this->Components->load('Portfolio');
        $this->ttypeArr = $Portfolio->getTransactionType();
        $dataToSave = array();


        $i = 0;


        foreach ($brokerUsers as $irn => $user) {
            $i++;


            if ($i > $userFrom and $i <= $userTo) {


                $pid = $user['portfolio_id'];
                $broker_fee = $user['broker_fee'];

                //   pr($dataGroupByIrn[$irn]);

                if (!isset($dataGroupByIrn[$irn])) {
                    echo "<h2>There is no share found for $irn in Hac excell </h2>";

                    continue;
                } else {

                    $actualHoldings = $dataGroupByIrn[$irn];
                }


                $model->contain('PortfolioTransaction');
                $allTransactions = $model->find('all', array(
                        'conditions' => "Portfolio.id=$pid"

                    )
                );

                $instrumentListKeyId = $StockBangladesh->instrumentList(3);

                $portfolioHoldingsTransaction = $Portfolio->getPortfolioHoldings2($allTransactions, $this->ttypeArr);

                // padding missing share of $portfolioHoldingsTransaction in $actualHoldings
                foreach ($portfolioHoldingsTransaction as $instrumentId => $arr) {
                    $temp = array();
                    $code = $instrumentListKeyId[$instrumentId];


                    $temp[] = ''; //0
                    $temp[] = $irn;//1
                    $temp[] = '';//2
                    $temp[] = '';//3
                    $temp[] = '';//4
                    $temp[] = '';//5
                    $temp[] = '';//6
                    $temp[] = $code;//7
                    $temp[] = '';//8
                    $temp[] = '';//9
                    $temp[] = 0;//10
                    $temp[] = '';//11
                    $temp[] = '';//12
                    $temp[] = 0;//13
                    $temp[] = '';//14
                    $temp[] = 0;//15
                    $temp[] = '';//16
                    $temp[] = 0;//17
                    $temp[] = '';//18
                    $temp[] = 0;//19
                    $temp[] = '';//20
                    $temp[] = 0;//21
                    $temp[] = 0;//22
                    $temp[] = '';//23
                    $temp[] = 0;//24
                    $temp[] = '';//25
                    $temp[] = '';//26
                    $temp[] = '';//27


                    $shareExist = Hash::extract($actualHoldings, "{n}[7=$code]");


                    if (empty($shareExist)) {

                        $actualHoldings[] = $temp;
                    }

                }



                echo "==================================================processing $irn is started=========================================<br />";

                foreach ($actualHoldings as $share) {


                    $instrumentCode = strtoupper(trim($share[7]));



                    if (!isset($instrumentList[$instrumentCode])) {
                        echo "<h3>$instrumentCode is not found</h3>";
                        continue;


                    } else {
                        $instrumentId = $instrumentList[$instrumentCode];
                        $category = $StockBangladesh->get_category($instrumentId);


                        $newEntryArr = $this->adjustPortfolio_hac($share, $portfolioHoldingsTransaction, $instrumentId, $category, $pid, $broker_fee);
                        $dataToSave = array_merge($dataToSave, $newEntryArr);

                    }

                    // pr($newEntryArr);



                }
                echo "==================================================processing $irn is finished=========================================<br />";


            }
            // else
            //  echo "'.$irn.' has no transaction";


        }


        // pr($dataToSave);

        if (count($dataToSave)) {
            $model = ClassRegistry::init('PortfolioTransaction');
            $model2 = ClassRegistry::init('Portfolio');

           // $confirm=0; //temporarily disabled as new system running
            if ($confirm) {
                $model->saveMany($dataToSave, array('atomic' => true));
                // $model2->saveMany($temp2, array('atomic' => true));

                $rep = count($dataToSave) . ' NEW ROW INSERTED';
                echo "<br/>****************$rep*********************<br/>";
            } else {
                $rep = count($dataToSave) . ' new transaction will be insert. Please confirm to save it';
                $rt = Router::url('/', true) . "Portfolios/portfolio_update_script_hac/$userFrom/$userTo/1";
                //     echo $rt;
                echo "<br /><a href='$rt'>$rep</a> <br />";

            }


        }
        exit;
    }



    public function adjustPortfolio_hac($share, $portfolioHoldingsTransaction, $instrumentId, $category, $pid, $broker_fee)
    {
        Configure::write('debug', 2);

        App::uses('CakeTime', 'Utility');
        $freeQty = $share[10];
        $tempAvgCostScript=$share[15];
        $avgCostScript = ($tempAvgCostScript*100)/(100+$broker_fee); //substitution of commission or broker fee
        $totalQty = $share[17];
        $lockinQty = $share[21];
        $instrumentCode = strtoupper(trim($share[7]));
        $bo_irn = trim($share[1]);



        // remove lockin quantity
        if ($lockinQty > 0) {
            $totalQty = $totalQty - $lockinQty;
        }


        if (isset($portfolioHoldingsTransaction[$instrumentId])) {

            $existingPortfolioQty = $portfolioHoldingsTransaction[$instrumentId]['totalQuantity'];
            $existingPortfolioDividendQuantity = $portfolioHoldingsTransaction[$instrumentId]['dividendQuantity'];
            $receiveableDividendQuantity = $portfolioHoldingsTransaction[$instrumentId]['receiveableDividendQuantity'];
            $saleAbleShares = $portfolioHoldingsTransaction[$instrumentId]['saleAbleShares'];
            $avgCostPortfolio=$portfolioHoldingsTransaction[$instrumentId]['avgCost'];

        } else {
            $existingPortfolioQty = 0;
            $existingPortfolioDividendQuantity = 0;
            $receiveableDividendQuantity = 0;
            $saleAbleShares = 0;
        }
        $diff = $totalQty - $existingPortfolioQty;
        echo "<span style='color:green'>$instrumentCode excell totalQty =$totalQty portfolio existingPortfolioQty=$existingPortfolioQty  diff=$diff<br /></span>";



        $returnArr = array();
        $transaction_time_mature = date("Y-m-d H:i:s", strtotime("-30 days"));
        $transaction_time_immature = date("Y-m-d H:i:s");

        //for backdated portfolio Update change immature date...
        // $transaction_time_immature = date("Y-m-d H:i:s", strtotime("-1 days"));

        if ($existingPortfolioQty == 0)  // need a fresh entry
        {
            $adjustAbleQty = $totalQty;
            $avgCost=$avgCostScript;

            if ($freeQty >= $adjustAbleQty) {
                $temp = array();
                $amount = $adjustAbleQty;  // takes all

                $temp['portfolio_id'] = $pid;
                $temp['instrument_id'] = $instrumentId;
                $temp['transaction_type_id'] = 1;  // buy as adding share

                $temp['rate'] = $avgCost;
                // $new_transaction_time = date("Y-m-d H:i:s", strtotime("-30 days"));
                $temp['transaction_time'] = $transaction_time_mature;
                $temp['commission'] = $broker_fee;
                $today = date("Y-m-d");
                $temp['dse_order_id'] = "script-$today";
                $temp['amount'] = $amount;
                if ($temp['amount']) {
                    $returnArr[] = $temp;
                    echo "1=>" . $temp['amount'] . " $instrumentCode FRESH ENTRY to $bo_irn <br />";
                }


            } elseif ($freeQty < $adjustAbleQty) {
                $temp = array();
                $amount = $freeQty;  // takes all of free share. and some share will be still left

                $temp['portfolio_id'] = $pid;
                $temp['instrument_id'] = $instrumentId;
                $temp['transaction_type_id'] = 1;  // buy as adding share

                $temp['rate'] = $avgCost;
                //  $new_transaction_time = date("Y-m-d H:i:s", strtotime("-30 days"));
                $temp['transaction_time'] = $transaction_time_mature;
                $temp['commission'] = $broker_fee;
                $today = date("Y-m-d");
                $temp['dse_order_id'] = "script-$today";
                $temp['amount'] = $amount;
                if ($temp['amount']) {
                    $returnArr[] = $temp;
                    echo "2=>" . $temp['amount'] . " $instrumentCode FRESH ENTRY  to $bo_irn <br />";
                }

                // now add immature shares
                $temp = array();
                $amount = $adjustAbleQty - $freeQty;  // takes all of free share. and some share will be still left

                $temp['portfolio_id'] = $pid;
                $temp['instrument_id'] = $instrumentId;
                $temp['transaction_type_id'] = 1;  // buy as adding share

                $temp['rate'] = $avgCost;
                // $new_transaction_time = date("Y-m-d H:i:s");
                $temp['transaction_time'] = $transaction_time_immature;
                $temp['commission'] = $broker_fee;
                $today = date("Y-m-d");
                $temp['dse_order_id'] = "script-$today";

                if ($amount)
                {
                    $temp['amount'] = $amount;
                    if ($temp['amount']) {
                        $returnArr[] = $temp;
                        echo "3=>" . $temp['amount'] . " $instrumentCode FRESH ENTRY(IMMATURE) to $bo_irn <br />";
                    }
                }

            } else  // adding remaining share as immature
            {
                //@ do nothing
            }


        }

        else  // already this share in portfolio. need adjustment
        {
            $totalCostScript=$totalQty*$avgCostScript;
            $totalCostPortfolio=$existingPortfolioQty*$avgCostPortfolio;
            $diffTotalCost=$totalCostScript-$totalCostPortfolio;


            if ($diff == 0)// portfolio for this item is ok/up to date. NO ACTION REQUIRED FOR NEW ENTRY
            {
                $avgCost=$avgCostPortfolio;

                if ($saleAbleShares < $freeQty) // we have some space to add share as mature
                {


                    //adding shortage of mature share

                    $allowedQty = $freeQty - $saleAbleShares;  // maximum allowed quantity to input as mature share

                    $temp = array();
                    $temp['portfolio_id'] = $pid;
                    $temp['instrument_id'] = $instrumentId;
                    $temp['transaction_type_id'] = 1;  // buy as adding share
                    $temp['rate'] = $avgCost;
                    // $new_transaction_time = date("Y-m-d H:i:s", strtotime("-30 days"));
                    $temp['transaction_time'] = $transaction_time_mature;
                    $temp['commission'] = $broker_fee;
                    $today = date("Y-m-d");
                    $temp['dse_order_id'] = "script-$today";
                    $temp['amount'] = $allowedQty;
                    if ($temp['amount']) {
                        $returnArr[] = $temp;
                        echo "4=>" . $temp['amount'] . " $instrumentCode ADDED (as mature)  to $bo_irn <br />";
                    }

                    //removing excess of immature shares

                    // $allowedLockQty=($existingPortfolioQty-$saleAbleShares)-($totalQty-$freeQty);

                    $temp = array();
                    $temp['portfolio_id'] = $pid;
                    $temp['instrument_id'] = $instrumentId;
                    $temp['transaction_type_id'] = 2;  // SELL as REMOVE share
                    $temp['amount'] = $allowedQty;
                    $temp['rate'] = $avgCost;
                    // $new_transaction_time = date("Y-m-d H:i:s"); // setting today .So it will be shown as immature
                    $temp['transaction_time'] = $transaction_time_immature;
                    $temp['commission'] = $broker_fee;
                    $today = date("Y-m-d");
                    $temp['dse_order_id'] = "script-$today";
                    if ($temp['amount']) {
                        $returnArr[] = $temp;
                        echo "5=>" . $temp['amount'] . " $instrumentCode REMOVED (as immature) form $bo_irn <br />";
                    }

                }
                elseif ($saleAbleShares > $freeQty)
                {
                    //removing excess of mature shares
                    $allowedQty = $saleAbleShares - $freeQty;  // maximum allowed quantity to input as mature share

                    $temp = array();
                    $temp['portfolio_id'] = $pid;
                    $temp['instrument_id'] = $instrumentId;
                    $temp['transaction_type_id'] = 2;  // buy as adding share
                    $temp['rate'] = $avgCost;
                    // $new_transaction_time = date("Y-m-d H:i:s", strtotime("-30 days"));  // changing to past so it will be shown as Mature
                    $temp['transaction_time'] = $transaction_time_mature;
                    $temp['commission'] = $broker_fee;
                    $today = date("Y-m-d");
                    $temp['dse_order_id'] = "script-$today";
                    $temp['amount'] = $allowedQty;
                    if ($temp['amount']) {
                        $returnArr[] = $temp;
                        echo "6=>" . $temp['amount'] . " $instrumentCode REMOVED (as mature) form $bo_irn <br />";
                    }



                    //adding shortage of immature share

                    //$allowedLockQty=($totalQty-$freeQty)-($existingPortfolioQty-$saleAbleShares);

                    $temp = array();
                    $temp['portfolio_id'] = $pid;
                    $temp['instrument_id'] = $instrumentId;
                    $temp['transaction_type_id'] = 1;  // SELL as REMOVE share
                    $temp['amount'] = $allowedQty;
                    $temp['rate'] = $avgCost;
                    //  $new_transaction_time = date("Y-m-d H:i:s"); // setting today .So it will be shown as immature
                    $temp['transaction_time'] = $transaction_time_immature;
                    $temp['commission'] = $broker_fee;
                    $today = date("Y-m-d");
                    $temp['dse_order_id'] = "script-$today";
                    if ($temp['amount']) {
                        $returnArr[] = $temp;
                        echo "7=>" . $temp['amount'] . " $instrumentCode ADDED (as immature) to $bo_irn <br />";
                    }

                }



            } elseif ($diff < 0)// portfolio has more quantity than it should be. So we have to remove them
            {

                $avgCost=$diffTotalCost/-($diff);
                $adjustAbleQty = abs($diff);




                /* =========free share  adjustment start=================*/

                if ($saleAbleShares < $freeQty) // we have some space to add share as mature
                {
                    //@todo manual action required

                    //adding shortage of mature share

                    $allowedQty = $freeQty - $saleAbleShares;  // maximum allowed quantity to input as mature share

                    $temp = array();
                    $temp['portfolio_id'] = $pid;
                    $temp['instrument_id'] = $instrumentId;
                    $temp['transaction_type_id'] = 1;  // buy as adding share
                    $temp['rate'] = $avgCost;
                    // $new_transaction_time = date("Y-m-d H:i:s", strtotime("-30 days"));
                    $temp['transaction_time'] = $transaction_time_mature;
                    $temp['commission'] = $broker_fee;
                    $today = date("Y-m-d");
                    $temp['dse_order_id'] = "script-$today";
                    $temp['amount'] = $allowedQty;
                    if ($temp['amount']) {
                        $returnArr[] = $temp;
                        echo "8=>" . $temp['amount'] . " $instrumentCode ADDED (as mature)  to $bo_irn <br />";
                    }

                    //removing excess of immature shares

                    $allowedLockQty=($existingPortfolioQty-$saleAbleShares)-($totalQty-$freeQty);

                    $temp = array();
                    $temp['portfolio_id'] = $pid;
                    $temp['instrument_id'] = $instrumentId;
                    $temp['transaction_type_id'] = 2;  // SELL as REMOVE share
                    $temp['amount'] = $allowedLockQty;
                    $temp['rate'] = $avgCost;
                    // $new_transaction_time = date("Y-m-d H:i:s"); // setting today .So it will be shown as immature
                    $temp['transaction_time'] = $transaction_time_immature;
                    $temp['commission'] = $broker_fee;
                    $today = date("Y-m-d");
                    $temp['dse_order_id'] = "script-$today";
                    if ($temp['amount']) {
                        $returnArr[] = $temp;
                        echo "9=>" . $temp['amount'] . " $instrumentCode REMOVED (as immature) form $bo_irn <br />";
                    }

                }

                elseif ($saleAbleShares == $freeQty)
                {

                    //removing excess of immature shares
                    $allowedLockQty=($existingPortfolioQty-$saleAbleShares)-($totalQty-$freeQty);

                    $temp = array();
                    $temp['portfolio_id'] = $pid;
                    $temp['instrument_id'] = $instrumentId;
                    $temp['transaction_type_id'] = 2;  // SELL as REMOVE share
                    $temp['amount'] = $allowedLockQty;
                    $temp['rate'] = $avgCost;
                    // $new_transaction_time = date("Y-m-d H:i:s"); // setting today .So it will be shown as immature
                    $temp['transaction_time'] = $transaction_time_immature;
                    $temp['commission'] = $broker_fee;
                    $today = date("Y-m-d");
                    $temp['dse_order_id'] = "script-$today";
                    if ($temp['amount']) {
                        $returnArr[] = $temp;
                        echo "10=>" . $temp['amount'] . " $instrumentCode REMOVED (as immature) form $bo_irn <br />";
                    }

                }

                elseif ($saleAbleShares > $freeQty)
                {
                    //removing excess of mature shares
                    $allowedQty = $saleAbleShares - $freeQty;  // maximum allowed quantity to input as mature share

                    $temp = array();
                    $temp['portfolio_id'] = $pid;
                    $temp['instrument_id'] = $instrumentId;
                    $temp['transaction_type_id'] = 2;  // buy as adding share
                    $temp['rate'] = $avgCost;
                    // $new_transaction_time = date("Y-m-d H:i:s", strtotime("-30 days"));  // changing to past so it will be shown as Mature
                    $temp['transaction_time'] = $transaction_time_mature;
                    $temp['commission'] = $broker_fee;
                    $today = date("Y-m-d");
                    $temp['dse_order_id'] = "script-$today";
                    $temp['amount'] = $allowedQty;
                    if ($temp['amount']) {
                        $returnArr[] = $temp;
                        echo "11=>" . $temp['amount'] . " $instrumentCode REMOVED (as mature) form $bo_irn <br />";
                    }





                    $allowedLockQty=($totalQty-$freeQty)-($existingPortfolioQty-$saleAbleShares);

                    if($allowedLockQty>0)
                    {
                        //adding shortage of immature share
                        $temp = array();
                        $temp['portfolio_id'] = $pid;
                        $temp['instrument_id'] = $instrumentId;
                        $temp['transaction_type_id'] = 1;
                        $temp['amount'] = $allowedLockQty;
                        $temp['rate'] = $avgCost;
                        // $new_transaction_time = date("Y-m-d H:i:s"); // setting today .So it will be shown as immature
                        $temp['transaction_time'] = $transaction_time_immature;
                        $temp['commission'] = $broker_fee;
                        $today = date("Y-m-d");
                        $temp['dse_order_id'] = "script-$today";
                        if ($temp['amount']) {
                            $returnArr[] = $temp;
                            echo "12=>" . $temp['amount'] . " $instrumentCode ADDED (as immature) to $bo_irn <br />";
                        }
                    }
                    elseif($allowedLockQty<0)
                    {  //removing excess of immature shares
                        $temp = array();
                        $temp['portfolio_id'] = $pid;
                        $temp['instrument_id'] = $instrumentId;
                        $temp['transaction_type_id'] = 2;  // SELL as REMOVE share
                        $temp['amount'] = -($allowedLockQty);
                        $temp['rate'] = $avgCost;
                        // $new_transaction_time = date("Y-m-d H:i:s"); // setting today .So it will be shown as immature
                        $temp['transaction_time'] = $transaction_time_immature;
                        $temp['commission'] = $broker_fee;
                        $today = date("Y-m-d");
                        $temp['dse_order_id'] = "script-$today";
                        if ($temp['amount']) {
                            $returnArr[] = $temp;
                            echo "13=>" . $temp['amount'] . " $instrumentCode REMOVED (as mature) to $bo_irn <br />";
                        }
                    }



                }


            }

            elseif ($diff > 0)// portfolio has less quantity than it should be. So we have to add them
            {
                $avgCost=$diffTotalCost/$diff;
                /* =========free share  adjustment start=================*/

                if ($saleAbleShares < $freeQty) // we have some space to add share as mature
                {
                    //adding shortage of mature share
                    $allowedQty = $freeQty - $saleAbleShares;  // maximum allowed quantity to input as mature share


                    $temp = array();
                    $temp['portfolio_id'] = $pid;
                    $temp['instrument_id'] = $instrumentId;
                    $temp['transaction_type_id'] = 1;  // buy as adding share
                    $temp['rate'] = $avgCost;
                    // $new_transaction_time = date("Y-m-d H:i:s", strtotime("-30 days"));  // changing to past so it will be shown as Mature
                    $temp['transaction_time'] = $transaction_time_mature;
                    $temp['commission'] = $broker_fee;
                    $today = date("Y-m-d");
                    $temp['dse_order_id'] = "script-$today";
                    $temp['amount'] = $allowedQty;
                    if ($temp['amount'])
                    {
                        $returnArr[] = $temp;
                        echo "14=>" . $temp['amount'] . " $instrumentCode ADDED (as mature) to $bo_irn <br />";
                    }

                    //removing excess of immature share
                    $allowedLockQty=($existingPortfolioQty-$saleAbleShares)-($totalQty-$freeQty);

                    $temp = array();
                    $temp['portfolio_id'] = $pid;
                    $temp['instrument_id'] = $instrumentId;
                    $temp['transaction_type_id'] = 2;  // SELL as REMOVE share
                    $temp['amount'] = $allowedLockQty;
                    $temp['rate'] = $avgCost;
                    //  $new_transaction_time = date("Y-m-d H:i:s"); // setting today .So it will be shown as immature
                    $temp['transaction_time'] = $transaction_time_immature;
                    $temp['commission'] = $broker_fee;
                    $today = date("Y-m-d");
                    $temp['dse_order_id'] = "script-$today";
                    if ($temp['amount']) {
                        $returnArr[] = $temp;
                        echo "15=>" . $temp['amount'] . " $instrumentCode REMOVED (as immature) form $bo_irn <br />";
                    }


                }
                elseif ($saleAbleShares == $freeQty) // we have to add left share as immature as we have already saleable share as free share
                {

                    //adding shortage of immature share
                    $allowedLockQty=($totalQty-$freeQty)-($existingPortfolioQty-$saleAbleShares);

                    $temp = array();
                    $temp['portfolio_id'] = $pid;
                    $temp['instrument_id'] = $instrumentId;
                    $temp['transaction_type_id'] = 1;  // buy as adding share
                    $temp['amount'] = $allowedLockQty;
                    $temp['rate'] = $avgCost;
                    // $new_transaction_time = date("Y-m-d H:i:s"); // setting today .So it will be shown as immature
                    $temp['transaction_time'] = $transaction_time_immature;
                    $temp['commission'] = $broker_fee;
                    $today = date("Y-m-d");
                    $temp['dse_order_id'] = "script-$today";
                    if ($temp['amount']) {
                        $returnArr[] = $temp;
                        echo "16=>" . $temp['amount'] . " $instrumentCode ADDED (as immature) to $bo_irn <br />";
                    }

                }

                elseif ($saleAbleShares > $freeQty) // we have some share in the portfolio that have inputed by mistake
                {
                    // @todo treatment needed to remove share

                    //removing excess of mature share

                    $allowedQty =$saleAbleShares-$freeQty ;

                    $temp = array();
                    $temp['portfolio_id'] = $pid;
                    $temp['instrument_id'] = $instrumentId;
                    $temp['transaction_type_id'] = 2;  // SELL as REMOVE share
                    $temp['amount'] = $allowedQty;
                    $temp['rate'] = $avgCost;
                    $new_transaction_time =  date("Y-m-d H:i:s", strtotime("-30 days")); // setting today .So it will be shown as immature
                    $temp['transaction_time'] = $new_transaction_time;
                    $temp['commission'] = $broker_fee;
                    $today = date("Y-m-d");
                    $temp['dse_order_id'] = "script-$today";
                    if ($temp['amount']) {
                        $returnArr[] = $temp;
                        echo "17=>" . $temp['amount'] . " $instrumentCode REMOVED (as mature) from $bo_irn <br />";
                    }


                    //adding shortage of immature share

                    $allowedLockQty=($totalQty-$freeQty)-($existingPortfolioQty-$saleAbleShares);

                    $temp = array();
                    $temp['portfolio_id'] = $pid;
                    $temp['instrument_id'] = $instrumentId;
                    $temp['transaction_type_id'] = 1;  // buy as adding share
                    $temp['amount'] = $allowedLockQty; // taking all remaining quantity
                    $temp['rate'] = $avgCost;
                    // $new_transaction_time = date("Y-m-d H:i:s"); // setting today .So it will be shown as immature
                    $temp['transaction_time'] = $transaction_time_immature;
                    $temp['commission'] = $broker_fee;
                    $today = date("Y-m-d");
                    $temp['dse_order_id'] = "script-$today";

                    if ($temp['amount']) {
                        $returnArr[] = $temp;
                        echo "18=>" . $temp['amount'] . " $instrumentCode ADDED (as immature) to $bo_irn <br />";
                    }

                }

            }
        }

        return $returnArr;

    }



    public function portfolio_share_update_script_hac($userFrom = 0, $userTo = 15, $confirm = 0)
    {
       // Configure::write('debug', 2);
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
        $instrumentList = $StockBangladesh->instrumentList(2);
        $metaKey = array("category");
        $instrumentInfo = $StockBangladesh->getFundamentalInfo(0, $metaKey);

     

        $brokerId = Configure::read('broker.hac.id');
        $Omo = $this->Components->load('Omo');
        $userList = $Omo->getUsersList(4, 1);


        $array_data = array();

        $portfolios_file_path = Configure::read('broker.hac.portfolios_file_path');
        $fileArr = $StockBangladesh->scan_dir($portfolios_file_path);
        $fullFilePath = "$portfolios_file_path/" . $fileArr[0];
        $file = fopen($fullFilePath, "r");

        // read each data row in the file

        while (!feof($file)) {
            $row = fgetcsv($file);
            if ($row[1] == '') {
                continue;
            }
            else
                $array_data[] = $row;

        }
        // unset($array_data[1]);


        $HacOmoUsers= Hash::extract($array_data,'{n}.1');
        $HacOmoUsers=array_unique($HacOmoUsers);
        $HacOmoUsers = Hash::sort($HacOmoUsers,'{n}','asc');


        $brokerUsers = array();
        foreach ($userList[$brokerId] as $irn => $arr) {
            $key = trim($irn);
            $key = str_pad($key, 5, "0", STR_PAD_LEFT);
            $key = strtoupper($key);
            if (in_array($key,$HacOmoUsers))
                $brokerUsers[$key] = $arr;
            else
                continue;
        }


        //  $brokerUsers= Hash::sort($brokerUsers, '{s}internal_ref_no', 'asc');
        ksort($brokerUsers);


        $dataGroupByIrn = array();
        foreach ($array_data as $row) {
            $irn = $row[1];
            $totalQty = $row[17];
            $row[7] = strtoupper(trim($row[7]));

            if ($totalQty)
                $dataGroupByIrn[$irn][] = $row;
        }


        $model = ClassRegistry::init('Portfolio');
        $Portfolio = $this->Components->load('Portfolio2');
        $this->ttypeArr = $Portfolio->getTransactionType();
        $dataToSave = array();


        $i = 0;


        foreach ($brokerUsers as $irn => $user) {
            $i++;


            if ($i > $userFrom and $i <= $userTo) {


                $pid = $user['portfolio_id'];
                $broker_fee = $user['broker_fee'];

                //   pr($dataGroupByIrn[$irn]);

                if (!isset($dataGroupByIrn[$irn])) {
                    echo "<h2>There is no share found for $irn in Hac excell </h2>";

                    continue;
                } else {

                    $actualHoldings = $dataGroupByIrn[$irn];
                }


                $model->contain('PortfolioShare');
                $allTransactions = $model->find('all', array(
                        'conditions' => "Portfolio.id=$pid"

                    )
                );

                $instrumentListKeyId = $StockBangladesh->instrumentList(3);

                $portfolioHoldingsTransaction = $Portfolio->getPortfolioHoldings2($allTransactions, $this->ttypeArr);

                // padding missing share of $portfolioHoldingsTransaction in $actualHoldings
                foreach ($portfolioHoldingsTransaction as $instrumentId => $arr) {
                    $temp = array();
                    $code = $instrumentListKeyId[$instrumentId];


                    $temp[] = ''; //0
                    $temp[] = $irn;//1
                    $temp[] = '';//2
                    $temp[] = '';//3
                    $temp[] = '';//4
                    $temp[] = '';//5
                    $temp[] = '';//6
                    $temp[] = $code;//7
                    $temp[] = '';//8
                    $temp[] = '';//9
                    $temp[] = 0;//10
                    $temp[] = '';//11
                    $temp[] = '';//12
                    $temp[] = 0;//13
                    $temp[] = '';//14
                    $temp[] = 0;//15
                    $temp[] = '';//16
                    $temp[] = 0;//17
                    $temp[] = '';//18
                    $temp[] = 0;//19
                    $temp[] = '';//20
                    $temp[] = 0;//21
                    $temp[] = 0;//22
                    $temp[] = '';//23
                    $temp[] = 0;//24
                    $temp[] = '';//25
                    $temp[] = '';//26
                    $temp[] = '';//27


                    $shareExist = Hash::extract($actualHoldings, "{n}[7=$code]");


                    if (empty($shareExist)) {

                        $actualHoldings[] = $temp;
                    }

                }



                echo "==================================================processing $irn is started=========================================<br />";

                foreach ($actualHoldings as $share) {


                    $instrumentCode = strtoupper(trim($share[7]));



                    if (!isset($instrumentList[$instrumentCode])) {
                        echo "<h3>$instrumentCode is not found</h3>";
                        continue;


                    } else {
                        $instrumentId = $instrumentList[$instrumentCode];


                        if(isset($instrumentInfo[$instrumentId]['category']['meta_value']))
                        {
                            $category = $instrumentInfo[$instrumentId]['category']['meta_value'];
                        }
                        else
                        {
                            echo "<h3>$instrumentCode category undefined</h3>";
                            continue;
                        }

                        $newEntryArr = $this->adjustPortfolio_share_hac($share, $portfolioHoldingsTransaction, $instrumentId, $category, $pid, $broker_fee);
                        $dataToSave = array_merge($dataToSave, $newEntryArr);

                    }

                    // pr($newEntryArr);



                }
                echo "==================================================processing $irn is finished=========================================<br />";


            }
            // else
            //  echo "'.$irn.' has no transaction";


        }


        // pr($dataToSave);

        if (count($dataToSave)) {
            $model = ClassRegistry::init('PortfolioShare');
          //  $model2 = ClassRegistry::init('Portfolio');
            if ($confirm) {
                $model->saveMany($dataToSave, array('atomic' => true));
                // $model2->saveMany($temp2, array('atomic' => true));

                $rep = count($dataToSave) . ' NEW ROW INSERTED IN Portfolio Shares table';
                echo "<br/>****************$rep*********************<br/>";
            } else {
                $rep = count($dataToSave) . ' new transaction will be insert in portfolio shares table. Please confirm to save it';
                $rt = Router::url('/', true) . "Portfolios/portfolio_share_update_script_hac/$userFrom/$userTo/1";
                //     echo $rt;
                echo "<br /><a href='$rt'>$rep</a> <br />";

            }


        }
        exit;
    }



    public function adjustPortfolio_share_hac($share, $portfolioHoldingsTransaction, $instrumentId, $category, $pid, $broker_fee)
    {
        Configure::write('debug', 2);

        App::uses('CakeTime', 'Utility');
        $freeQty = $share[10];
        $tempAvgCostScript=$share[15];
        $avgCostScript = ($tempAvgCostScript*100)/(100+$broker_fee); //substitution of commission or broker fee
        $totalQty = $share[17];
        $lockinQty = $share[21];
        $instrumentCode = strtoupper(trim($share[7]));
        $bo_irn = trim($share[1]);



        // remove lockin quantity
        if ($lockinQty > 0) {
            $totalQty = $totalQty - $lockinQty;
        }


        if (isset($portfolioHoldingsTransaction[$instrumentId])) {

            $existingPortfolioQty = $portfolioHoldingsTransaction[$instrumentId]['totalQuantity'];
            $existingPortfolioDividendQuantity = $portfolioHoldingsTransaction[$instrumentId]['dividendQuantity'];
            $receiveableDividendQuantity = $portfolioHoldingsTransaction[$instrumentId]['receiveableDividendQuantity'];
            $saleAbleShares = $portfolioHoldingsTransaction[$instrumentId]['saleAbleShares'];
            $avgCostPortfolio=$portfolioHoldingsTransaction[$instrumentId]['avgCost'];

        } else {
            $existingPortfolioQty = 0;
            $existingPortfolioDividendQuantity = 0;
            $receiveableDividendQuantity = 0;
            $saleAbleShares = 0;
        }
        $diff = $totalQty - $existingPortfolioQty;
        echo "<span style='color:green'>$instrumentCode excell totalQty =$totalQty portfolio existingPortfolioQty=$existingPortfolioQty  diff=$diff<br /></span>";



        $returnArr = array();
        $transaction_time_mature = date("Y-m-d H:i:s", strtotime("-30 days"));
        $transaction_time_immature = date("Y-m-d H:i:s");

        //for backdated portfolio Update change immature date...
        // $transaction_time_immature = date("Y-m-d H:i:s", strtotime("-1 days"));

        if ($existingPortfolioQty == 0)  // need a fresh entry
        {
            $adjustAbleQty = $totalQty;
            $avgCost=$avgCostScript;

            if ($freeQty >= $adjustAbleQty) {
                $temp = array();
                $amount = $adjustAbleQty;  // takes all

                $temp['portfolio_id'] = $pid;
                $temp['instrument_id'] = $instrumentId;
                $temp['transaction_type_id'] = 1;  // buy as adding share

                $temp['rate'] = $avgCost;
                // $new_transaction_time = date("Y-m-d H:i:s", strtotime("-30 days"));
                $temp['transaction_time'] = $transaction_time_mature;
                $temp['commission'] = $broker_fee;
                $today = date("Y-m-d");
                $temp['dse_order_id'] = "script-$today";
                $temp['amount'] = $amount;
                if ($temp['amount']) {
                    $returnArr[] = $temp;
                    echo "1=>" . $temp['amount'] . " $instrumentCode FRESH ENTRY to $bo_irn <br />";
                }


            } elseif ($freeQty < $adjustAbleQty) {
                $temp = array();
                $amount = $freeQty;  // takes all of free share. and some share will be still left

                $temp['portfolio_id'] = $pid;
                $temp['instrument_id'] = $instrumentId;
                $temp['transaction_type_id'] = 1;  // buy as adding share

                $temp['rate'] = $avgCost;
                //  $new_transaction_time = date("Y-m-d H:i:s", strtotime("-30 days"));
                $temp['transaction_time'] = $transaction_time_mature;
                $temp['commission'] = $broker_fee;
                $today = date("Y-m-d");
                $temp['dse_order_id'] = "script-$today";
                $temp['amount'] = $amount;
                if ($temp['amount']) {
                    $returnArr[] = $temp;
                    echo "2=>" . $temp['amount'] . " $instrumentCode FRESH ENTRY  to $bo_irn <br />";
                }

                // now add immature shares
                $temp = array();
                $amount = $adjustAbleQty - $freeQty;  // takes all of free share. and some share will be still left

                $temp['portfolio_id'] = $pid;
                $temp['instrument_id'] = $instrumentId;
                $temp['transaction_type_id'] = 1;  // buy as adding share

                $temp['rate'] = $avgCost;
                // $new_transaction_time = date("Y-m-d H:i:s");
                $temp['transaction_time'] = $transaction_time_immature;
                $temp['commission'] = $broker_fee;
                $today = date("Y-m-d");
                $temp['dse_order_id'] = "script-$today";

                if ($amount)
                {
                    $temp['amount'] = $amount;
                    if ($temp['amount']) {
                        $returnArr[] = $temp;
                        echo "3=>" . $temp['amount'] . " $instrumentCode FRESH ENTRY(IMMATURE) to $bo_irn <br />";
                    }
                }

            } else  // adding remaining share as immature
            {
                //@ do nothing
            }


        }

        else  // already this share in portfolio. need adjustment
        {
            $totalCostScript=$totalQty*$avgCostScript;
            $totalCostPortfolio=$existingPortfolioQty*$avgCostPortfolio;
            $diffTotalCost=$totalCostScript-$totalCostPortfolio;


            if ($diff == 0)// portfolio for this item is ok/up to date. NO ACTION REQUIRED FOR NEW ENTRY
            {
                $avgCost=$avgCostPortfolio;

                if ($saleAbleShares < $freeQty) // we have some space to add share as mature
                {


                    //adding shortage of mature share

                    $allowedQty = $freeQty - $saleAbleShares;  // maximum allowed quantity to input as mature share

                    $temp = array();
                    $temp['portfolio_id'] = $pid;
                    $temp['instrument_id'] = $instrumentId;
                    $temp['transaction_type_id'] = 1;  // buy as adding share
                    $temp['rate'] = $avgCost;
                    // $new_transaction_time = date("Y-m-d H:i:s", strtotime("-30 days"));
                    $temp['transaction_time'] = $transaction_time_mature;
                    $temp['commission'] = $broker_fee;
                    $today = date("Y-m-d");
                    $temp['dse_order_id'] = "script-$today";
                    $temp['amount'] = $allowedQty;
                    if ($temp['amount']) {
                        $returnArr[] = $temp;
                        echo "4=>" . $temp['amount'] . " $instrumentCode ADDED (as mature)  to $bo_irn <br />";
                    }

                    //removing excess of immature shares

                    // $allowedLockQty=($existingPortfolioQty-$saleAbleShares)-($totalQty-$freeQty);

                    $temp = array();
                    $temp['portfolio_id'] = $pid;
                    $temp['instrument_id'] = $instrumentId;
                    $temp['transaction_type_id'] = 2;  // SELL as REMOVE share
                    $temp['amount'] = $allowedQty;
                    $temp['rate'] = $avgCost;
                    // $new_transaction_time = date("Y-m-d H:i:s"); // setting today .So it will be shown as immature
                    $temp['transaction_time'] = $transaction_time_immature;
                    $temp['commission'] = $broker_fee;
                    $today = date("Y-m-d");
                    $temp['dse_order_id'] = "script-$today";
                    if ($temp['amount']) {
                        $returnArr[] = $temp;
                        echo "5=>" . $temp['amount'] . " $instrumentCode REMOVED (as immature) form $bo_irn <br />";
                    }

                }
                elseif ($saleAbleShares > $freeQty)
                {
                    //removing excess of mature shares
                    $allowedQty = $saleAbleShares - $freeQty;  // maximum allowed quantity to input as mature share

                    $temp = array();
                    $temp['portfolio_id'] = $pid;
                    $temp['instrument_id'] = $instrumentId;
                    $temp['transaction_type_id'] = 2;  // buy as adding share
                    $temp['rate'] = $avgCost;
                    // $new_transaction_time = date("Y-m-d H:i:s", strtotime("-30 days"));  // changing to past so it will be shown as Mature
                    $temp['transaction_time'] = $transaction_time_mature;
                    $temp['commission'] = $broker_fee;
                    $today = date("Y-m-d");
                    $temp['dse_order_id'] = "script-$today";
                    $temp['amount'] = $allowedQty;
                    if ($temp['amount']) {
                        $returnArr[] = $temp;
                        echo "6=>" . $temp['amount'] . " $instrumentCode REMOVED (as mature) form $bo_irn <br />";
                    }



                    //adding shortage of immature share

                    //$allowedLockQty=($totalQty-$freeQty)-($existingPortfolioQty-$saleAbleShares);

                    $temp = array();
                    $temp['portfolio_id'] = $pid;
                    $temp['instrument_id'] = $instrumentId;
                    $temp['transaction_type_id'] = 1;  // SELL as REMOVE share
                    $temp['amount'] = $allowedQty;
                    $temp['rate'] = $avgCost;
                    //  $new_transaction_time = date("Y-m-d H:i:s"); // setting today .So it will be shown as immature
                    $temp['transaction_time'] = $transaction_time_immature;
                    $temp['commission'] = $broker_fee;
                    $today = date("Y-m-d");
                    $temp['dse_order_id'] = "script-$today";
                    if ($temp['amount']) {
                        $returnArr[] = $temp;
                        echo "7=>" . $temp['amount'] . " $instrumentCode ADDED (as immature) to $bo_irn <br />";
                    }

                }



            } elseif ($diff < 0)// portfolio has more quantity than it should be. So we have to remove them
            {

                $avgCost=$diffTotalCost/-($diff);
                $adjustAbleQty = abs($diff);




                /* =========free share  adjustment start=================*/

                if ($saleAbleShares < $freeQty) // we have some space to add share as mature
                {
                    //@todo manual action required

                    //adding shortage of mature share

                    $allowedQty = $freeQty - $saleAbleShares;  // maximum allowed quantity to input as mature share

                    $temp = array();
                    $temp['portfolio_id'] = $pid;
                    $temp['instrument_id'] = $instrumentId;
                    $temp['transaction_type_id'] = 1;  // buy as adding share
                    $temp['rate'] = $avgCost;
                    // $new_transaction_time = date("Y-m-d H:i:s", strtotime("-30 days"));
                    $temp['transaction_time'] = $transaction_time_mature;
                    $temp['commission'] = $broker_fee;
                    $today = date("Y-m-d");
                    $temp['dse_order_id'] = "script-$today";
                    $temp['amount'] = $allowedQty;
                    if ($temp['amount']) {
                        $returnArr[] = $temp;
                        echo "8=>" . $temp['amount'] . " $instrumentCode ADDED (as mature)  to $bo_irn <br />";
                    }

                    //removing excess of immature shares

                    $allowedLockQty=($existingPortfolioQty-$saleAbleShares)-($totalQty-$freeQty);

                    $temp = array();
                    $temp['portfolio_id'] = $pid;
                    $temp['instrument_id'] = $instrumentId;
                    $temp['transaction_type_id'] = 2;  // SELL as REMOVE share
                    $temp['amount'] = $allowedLockQty;
                    $temp['rate'] = $avgCost;
                    // $new_transaction_time = date("Y-m-d H:i:s"); // setting today .So it will be shown as immature
                    $temp['transaction_time'] = $transaction_time_immature;
                    $temp['commission'] = $broker_fee;
                    $today = date("Y-m-d");
                    $temp['dse_order_id'] = "script-$today";
                    if ($temp['amount']) {
                        $returnArr[] = $temp;
                        echo "9=>" . $temp['amount'] . " $instrumentCode REMOVED (as immature) form $bo_irn <br />";
                    }

                }

                elseif ($saleAbleShares == $freeQty)
                {

                    //removing excess of immature shares
                    $allowedLockQty=($existingPortfolioQty-$saleAbleShares)-($totalQty-$freeQty);

                    $temp = array();
                    $temp['portfolio_id'] = $pid;
                    $temp['instrument_id'] = $instrumentId;
                    $temp['transaction_type_id'] = 2;  // SELL as REMOVE share
                    $temp['amount'] = $allowedLockQty;
                    $temp['rate'] = $avgCost;
                    // $new_transaction_time = date("Y-m-d H:i:s"); // setting today .So it will be shown as immature
                    $temp['transaction_time'] = $transaction_time_immature;
                    $temp['commission'] = $broker_fee;
                    $today = date("Y-m-d");
                    $temp['dse_order_id'] = "script-$today";
                    if ($temp['amount']) {
                        $returnArr[] = $temp;
                        echo "10=>" . $temp['amount'] . " $instrumentCode REMOVED (as immature) form $bo_irn <br />";
                    }

                }

                elseif ($saleAbleShares > $freeQty)
                {
                    //removing excess of mature shares
                    $allowedQty = $saleAbleShares - $freeQty;  // maximum allowed quantity to input as mature share

                    $temp = array();
                    $temp['portfolio_id'] = $pid;
                    $temp['instrument_id'] = $instrumentId;
                    $temp['transaction_type_id'] = 2;  // buy as adding share
                    $temp['rate'] = $avgCost;
                    // $new_transaction_time = date("Y-m-d H:i:s", strtotime("-30 days"));  // changing to past so it will be shown as Mature
                    $temp['transaction_time'] = $transaction_time_mature;
                    $temp['commission'] = $broker_fee;
                    $today = date("Y-m-d");
                    $temp['dse_order_id'] = "script-$today";
                    $temp['amount'] = $allowedQty;
                    if ($temp['amount']) {
                        $returnArr[] = $temp;
                        echo "11=>" . $temp['amount'] . " $instrumentCode REMOVED (as mature) form $bo_irn <br />";
                    }





                    $allowedLockQty=($totalQty-$freeQty)-($existingPortfolioQty-$saleAbleShares);

                    if($allowedLockQty>0)
                    {
                        //adding shortage of immature share
                        $temp = array();
                        $temp['portfolio_id'] = $pid;
                        $temp['instrument_id'] = $instrumentId;
                        $temp['transaction_type_id'] = 1;
                        $temp['amount'] = $allowedLockQty;
                        $temp['rate'] = $avgCost;
                        // $new_transaction_time = date("Y-m-d H:i:s"); // setting today .So it will be shown as immature
                        $temp['transaction_time'] = $transaction_time_immature;
                        $temp['commission'] = $broker_fee;
                        $today = date("Y-m-d");
                        $temp['dse_order_id'] = "script-$today";
                        if ($temp['amount']) {
                            $returnArr[] = $temp;
                            echo "12=>" . $temp['amount'] . " $instrumentCode ADDED (as immature) to $bo_irn <br />";
                        }
                    }
                    elseif($allowedLockQty<0)
                    {  //removing excess of immature shares
                        $temp = array();
                        $temp['portfolio_id'] = $pid;
                        $temp['instrument_id'] = $instrumentId;
                        $temp['transaction_type_id'] = 2;  // SELL as REMOVE share
                        $temp['amount'] = -($allowedLockQty);
                        $temp['rate'] = $avgCost;
                        // $new_transaction_time = date("Y-m-d H:i:s"); // setting today .So it will be shown as immature
                        $temp['transaction_time'] = $transaction_time_immature;
                        $temp['commission'] = $broker_fee;
                        $today = date("Y-m-d");
                        $temp['dse_order_id'] = "script-$today";
                        if ($temp['amount']) {
                            $returnArr[] = $temp;
                            echo "13=>" . $temp['amount'] . " $instrumentCode REMOVED (as mature) to $bo_irn <br />";
                        }
                    }



                }


            }

            elseif ($diff > 0)// portfolio has less quantity than it should be. So we have to add them
            {
                $avgCost=$diffTotalCost/$diff;
                /* =========free share  adjustment start=================*/

                if ($saleAbleShares < $freeQty) // we have some space to add share as mature
                {
                    //adding shortage of mature share
                    $allowedQty = $freeQty - $saleAbleShares;  // maximum allowed quantity to input as mature share


                    $temp = array();
                    $temp['portfolio_id'] = $pid;
                    $temp['instrument_id'] = $instrumentId;
                    $temp['transaction_type_id'] = 1;  // buy as adding share
                    $temp['rate'] = $avgCost;
                    // $new_transaction_time = date("Y-m-d H:i:s", strtotime("-30 days"));  // changing to past so it will be shown as Mature
                    $temp['transaction_time'] = $transaction_time_mature;
                    $temp['commission'] = $broker_fee;
                    $today = date("Y-m-d");
                    $temp['dse_order_id'] = "script-$today";
                    $temp['amount'] = $allowedQty;
                    if ($temp['amount'])
                    {
                        $returnArr[] = $temp;
                        echo "14=>" . $temp['amount'] . " $instrumentCode ADDED (as mature) to $bo_irn <br />";
                    }

                    //removing excess of immature share
                    $allowedLockQty=($existingPortfolioQty-$saleAbleShares)-($totalQty-$freeQty);

                    $temp = array();
                    $temp['portfolio_id'] = $pid;
                    $temp['instrument_id'] = $instrumentId;
                    $temp['transaction_type_id'] = 2;  // SELL as REMOVE share
                    $temp['amount'] = $allowedLockQty;
                    $temp['rate'] = $avgCost;
                    //  $new_transaction_time = date("Y-m-d H:i:s"); // setting today .So it will be shown as immature
                    $temp['transaction_time'] = $transaction_time_immature;
                    $temp['commission'] = $broker_fee;
                    $today = date("Y-m-d");
                    $temp['dse_order_id'] = "script-$today";
                    if ($temp['amount']) {
                        $returnArr[] = $temp;
                        echo "15=>" . $temp['amount'] . " $instrumentCode REMOVED (as immature) form $bo_irn <br />";
                    }


                }
                elseif ($saleAbleShares == $freeQty) // we have to add left share as immature as we have already saleable share as free share
                {

                    //adding shortage of immature share
                    $allowedLockQty=($totalQty-$freeQty)-($existingPortfolioQty-$saleAbleShares);

                    $temp = array();
                    $temp['portfolio_id'] = $pid;
                    $temp['instrument_id'] = $instrumentId;
                    $temp['transaction_type_id'] = 1;  // buy as adding share
                    $temp['amount'] = $allowedLockQty;
                    $temp['rate'] = $avgCost;
                    // $new_transaction_time = date("Y-m-d H:i:s"); // setting today .So it will be shown as immature
                    $temp['transaction_time'] = $transaction_time_immature;
                    $temp['commission'] = $broker_fee;
                    $today = date("Y-m-d");
                    $temp['dse_order_id'] = "script-$today";
                    if ($temp['amount']) {
                        $returnArr[] = $temp;
                        echo "16=>" . $temp['amount'] . " $instrumentCode ADDED (as immature) to $bo_irn <br />";
                    }

                }

                elseif ($saleAbleShares > $freeQty) // we have some share in the portfolio that have inputed by mistake
                {
                    // @todo treatment needed to remove share

                    //removing excess of mature share

                    $allowedQty =$saleAbleShares-$freeQty ;

                    $temp = array();
                    $temp['portfolio_id'] = $pid;
                    $temp['instrument_id'] = $instrumentId;
                    $temp['transaction_type_id'] = 2;  // SELL as REMOVE share
                    $temp['amount'] = $allowedQty;
                    $temp['rate'] = $avgCost;
                    $new_transaction_time =  date("Y-m-d H:i:s", strtotime("-30 days")); // setting today .So it will be shown as immature
                    $temp['transaction_time'] = $new_transaction_time;
                    $temp['commission'] = $broker_fee;
                    $today = date("Y-m-d");
                    $temp['dse_order_id'] = "script-$today";
                    if ($temp['amount']) {
                        $returnArr[] = $temp;
                        echo "17=>" . $temp['amount'] . " $instrumentCode REMOVED (as mature) from $bo_irn <br />";
                    }


                    //adding shortage of immature share

                    $allowedLockQty=($totalQty-$freeQty)-($existingPortfolioQty-$saleAbleShares);

                    $temp = array();
                    $temp['portfolio_id'] = $pid;
                    $temp['instrument_id'] = $instrumentId;
                    $temp['transaction_type_id'] = 1;  // buy as adding share
                    $temp['amount'] = $allowedLockQty; // taking all remaining quantity
                    $temp['rate'] = $avgCost;
                    // $new_transaction_time = date("Y-m-d H:i:s"); // setting today .So it will be shown as immature
                    $temp['transaction_time'] = $transaction_time_immature;
                    $temp['commission'] = $broker_fee;
                    $today = date("Y-m-d");
                    $temp['dse_order_id'] = "script-$today";

                    if ($temp['amount']) {
                        $returnArr[] = $temp;
                        echo "18=>" . $temp['amount'] . " $instrumentCode ADDED (as immature) to $bo_irn <br />";
                    }

                }

            }
        }

        return $returnArr;

    }

///////////////////////////////////////////////////////////for Hac broker house END/////////////////////////////////////////////////////////////////////////

//////////////////////////////////////////////////////////for SHARP broker house///////////////////////////////////////////////////////////////////////////
    public function portfolio_update_sharp($userPerSlot = 15)
    {
       //   Configure::write('debug', 2);
        $brokerId = Configure::read('broker.sharp.id');
        $Omo = $this->Components->load('Omo');
        $userList = $Omo->getUsersList(4, 1);
        $StockBangladesh = $this->Components->load('StockBangladesh');
        $portfolios_file_path = Configure::read('broker.sharp.portfolios_file_path');
        $fileArr = $StockBangladesh->scan_dir($portfolios_file_path);
        $fullFilePath = "$portfolios_file_path/" . $fileArr[0];
        $file = fopen($fullFilePath, "r");

        // read each data row in the file
        $dataGroupByIrn = array();

        while (!feof($file)) {
            $row = fgetcsv($file);





            if ($row[0] == 'Balance : ' || $row[0] == 'Client Stock Inventory' ||$row[0] == '') {
                continue;
            }


            if ($row[2] == 'Client:') {
                //if(is_int($row[0])) {
                $internal_ref_no = trim($row[3]);
                $internal_ref_no = explode('Code: ', $internal_ref_no);
                $internal_ref_no = explode(')', $internal_ref_no[1]);
                $internal_ref_no = $internal_ref_no[0];
               // $internal_ref_no = substr($internal_ref_no, 0, -1);
                $internal_ref_no = strtoupper($internal_ref_no);
                $internal_ref_no = str_pad($internal_ref_no, 5, "0", STR_PAD_LEFT);

                $irnArray[]=$internal_ref_no;
                $fileDate=trim($row[14]);

              //  $fileDate=date('d/m/Y',strtotime($fileDate));

            }

        }

        if($fileDate != date('d/m/Y'))
        {
            echo "<br>";
            echo "File Date :$fileDate";
            echo "<br>";
            echo "Today's date:".date('d/m/Y');
            echo "<h2>this is not today's file.please recheck and upload the correct file again</h2>";
            exit;
        }


        //$sharpOmoUsers= Hash::extract($irnArray,'{n}.1');
        $sharpOmoUsers=array_unique($irnArray);
        $sharpOmoUsers = Hash::sort($sharpOmoUsers,'{n}','asc');

        $brokerUsers = array();
        foreach ($userList[$brokerId] as $irn => $arr) {
            $key = trim($irn);
            $key = str_pad($key, 5, "0", STR_PAD_LEFT);
            $key = strtoupper($key);

            if (in_array($key,$sharpOmoUsers))
                $brokerUsers[$key] = $arr;
            else
                continue;
        }



        $totalUser = count($brokerUsers) + 15;
        ksort($brokerUsers);
        $this->set('pageTitleMain','Portfolio Update');
        $this->set('pageTitleSmall','update process of user portfolios ');
        $this->set('totalUser', $totalUser);
        $this->set('userPerSlot', $userPerSlot);
        $this->set('brokerUsers', $brokerUsers);


    }


    public function portfolio_update_script_sharp($userFrom = 0, $userTo = 15, $confirm = 0)
    {
       // Configure::write('debug', 2);
        require_once(APP . 'Vendor' . DS . 'phpexcel' . DS . 'PHPExcel.php');

        $brokerId = Configure::read('broker.sharp.id');
        if ($this->Auth->user('group_id') > 1) {  // if not super admin
            if ($brokerId != $this->Auth->user('broker_id')) {
                echo "This is not your house";
                exit;
            }
        }

        $StockBangladesh = $this->Components->load('StockBangladesh');
        $ip = $StockBangladesh->getIp();
        $instrumentList = $StockBangladesh->instrumentList(2);
        $metaKey = array("category");
        $instrumentInfo = $StockBangladesh->getFundamentalInfo(0, $metaKey);

        $portfolios_file_path = Configure::read('broker.sharp.portfolios_file_path');
        $fileArr = $StockBangladesh->scan_dir($portfolios_file_path);
        $fullFilePath = "$portfolios_file_path/" . $fileArr[0];
        $file = fopen($fullFilePath, "r");

        // read each data row in the file
        $dataGroupByIrn = array();

        while (!feof($file)) {
            $row = fgetcsv($file);

            if ($row[0] == 'Balance : ' || $row[0] == 'Client Stock Inventory' || $row[0] == 'Date:'|| $row[0] == '') {
                continue;
            }
            if ($row[2] == 'Client:') {
                //if(is_int($row[0])) {
                $internal_ref_no = trim($row[3]);
                $internal_ref_no = explode('Code: ', $internal_ref_no);
                $internal_ref_no = explode(')', $internal_ref_no[1]);
                $internal_ref_no = $internal_ref_no[0];
                // $internal_ref_no = substr($internal_ref_no, 0, -1);
                $internal_ref_no = strtoupper($internal_ref_no);
                $internal_ref_no = str_pad($internal_ref_no, 5, "0", STR_PAD_LEFT);

                $irnArray[]=$internal_ref_no;

            }
            else {

                $result = Hash::insert($row, 'irn', $internal_ref_no);
                $dataGroupByIrn[$internal_ref_no][] = $result;

            }

        }


       // $sharpOmoUsers= Hash::extract($irnArray,'{n}.1');
        $sharpOmoUsers=array_unique($irnArray);
        $sharpOmoUsers = Hash::sort($sharpOmoUsers,'{n}','asc');

        $brokerId = Configure::read('broker.sharp.id');
        $Omo = $this->Components->load('Omo');
        $userList = $Omo->getUsersList(4, 1);
        $brokerUsers = array();
        foreach ($userList[$brokerId] as $irn => $arr) {
            $key = trim($irn);
            $key = str_pad($key, 5, "0", STR_PAD_LEFT);
            $key = strtoupper($key);

            if (in_array($key,$sharpOmoUsers))
                $brokerUsers[$key] = $arr;
            else
                continue;
        }


        ksort($brokerUsers);




        $model = ClassRegistry::init('Portfolio');
        $Portfolio = $this->Components->load('Portfolio');
        $this->ttypeArr = $Portfolio->getTransactionType();
        $dataToSave = array();


        $i = 0;
        foreach ($brokerUsers as $irn => $user) {
            $i++;


            if ($i > $userFrom and $i <= $userTo) {


                $pid = $user['portfolio_id'];
                $broker_fee = $user['broker_fee'];


                if (!isset($dataGroupByIrn[$irn])) {
                    echo "<h2>There is no share found for $irn in Sharp excell </h2>";

                    continue;
                } else {

                    $actualHoldings = $dataGroupByIrn[$irn];
                }


                $model->contain('PortfolioTransaction');
                $allTransactions = $model->find('all', array(
                        'conditions' => "Portfolio.id=$pid"

                    )
                );



                $instrumentListKeyId = $StockBangladesh->instrumentList(3);

                $portfolioHoldingsTransaction = $Portfolio->getPortfolioHoldings2($allTransactions, $this->ttypeArr);


                // padding missing share of $portfolioHoldingsTransaction in $actualHoldings
                foreach ($portfolioHoldingsTransaction as $instrumentId => $arr) {
                    $temp = array();
                    $code = $instrumentListKeyId[$instrumentId];



                    /*
                        [0] => BEXIMCO
                        [1] => 575
                        [2] => 575
                        [3] => 0
                        [4] => 0
                        [5] => 39.13
                        [6] => 22,501.95
                        [7] => 30.30
                        [8] => 30.30
                        [9] => 17,422.50
                        [10] =>
                        [11] =>
                        [12] =>
                        [13] =>
                        [14] =>
                        [15] =>
                        [irn] => 00821
                     */


                    $temp[] = $code; //0
                    $temp[] = 0;//1
                    $temp[] = 0;//2
                    $temp[] = 0;//3
                    $temp[] = 0;//4
                    $temp[] = '';//5
                    $temp[] = '';//6
                    $temp[] = '';//7
                    $temp[] = '';//8
                    $temp[] = '';//9
                    $temp[] = '';//10
                    $temp[] = '';//11
                    $temp[] = '';//12
                    $temp[] = '';//13
                    $temp[] = '';//14
                    $temp[] = '';//15
                    $temp['irn'] = $internal_ref_no;//16


                    $shareExist = Hash::extract($actualHoldings, "{n}[0=$code]");


                    if (empty($shareExist)) {

                        $actualHoldings[] = $temp;
                    }

                }



                echo "==================================================processing $irn is started=========================================<br />";

                  //  $i=0;

                foreach ($actualHoldings as $share) {

                        $instrumentCode = strtoupper(trim($share[0]));



                        if (!isset($instrumentList[$instrumentCode])) {
                            echo "<h3>$instrumentCode is not found</h3>";
                            continue;


                        } else {

                            $instrumentId = $instrumentList[$instrumentCode];

                            if(isset($instrumentInfo[$instrumentId]['category']['meta_value']))
                            {
                                $category = $instrumentInfo[$instrumentId]['category']['meta_value'];
                            }
                            else
                            {
                                echo "<h3>$instrumentCode category undefined</h3>";
                                continue;
                            }

                            $newEntryArr = $this->adjustPortfolio_sharp($share, $portfolioHoldingsTransaction, $instrumentId, $category, $pid, $broker_fee);
                            $dataToSave = array_merge($dataToSave, $newEntryArr);


                        }


                }


                echo "==================================================processing $irn is finished=========================================<br />";


            }

        }


        if (count($dataToSave)) {
            $confirm=0; // temporarily disabled as new system is running
            $model = ClassRegistry::init('PortfolioTransaction');
            $model2 = ClassRegistry::init('Portfolio');
            if ($confirm) {
                $model->saveMany($dataToSave, array('atomic' => true));
                // $model2->saveMany($temp2, array('atomic' => true));

                $rep = count($dataToSave) . ' NEW ROW INSERTED';
                echo "<br/>****************$rep*********************<br/>";
            } else {
                $rep = count($dataToSave) . ' new transaction will be insert. Please confirm to save it';
                $rt = Router::url('/', true) . "Portfolios/portfolio_update_script_sharp/$userFrom/$userTo/1";
                //     echo $rt;
                echo "<br /><a href='$rt'>$rep</a> <br />";

            }


        }
        exit;
    }


    public function adjustPortfolio_sharp($share, $portfolioHoldingsTransaction, $instrumentId, $category, $pid, $broker_fee)
    {
       // Configure::write('debug', 2);

        App::uses('CakeTime', 'Utility');

        $freeQty = str_replace(',', '', $share[2]);
        $tempAvgCostScript=$share[5];
        $avgCostScript = ($tempAvgCostScript*100)/(100+$broker_fee); //substitution of commission or broker fee
        $totalQty = str_replace(',', '', $share[1]);
        $lockinQty = str_replace(',', '', $share[4]);
        $instrumentCode = strtoupper(trim($share[0]));
        $bo_irn = trim($share['irn']);

        // remove lockin quantity
        if ($lockinQty > 0) {
            $totalQty = $totalQty - $lockinQty;
        }


        if (isset($portfolioHoldingsTransaction[$instrumentId])) {

            $existingPortfolioQty = $portfolioHoldingsTransaction[$instrumentId]['totalQuantity'];
            $existingPortfolioDividendQuantity = $portfolioHoldingsTransaction[$instrumentId]['dividendQuantity'];
            $receiveableDividendQuantity = $portfolioHoldingsTransaction[$instrumentId]['receiveableDividendQuantity'];
            $saleAbleShares = $portfolioHoldingsTransaction[$instrumentId]['saleAbleShares'];
            $avgCostPortfolio=$portfolioHoldingsTransaction[$instrumentId]['avgCost'];


        } else {
            $existingPortfolioQty = 0;
            $existingPortfolioDividendQuantity = 0;
            $receiveableDividendQuantity = 0;
            $saleAbleShares = 0;
        }
        $diff = $totalQty - $existingPortfolioQty;
        echo "<span style='color:green'>$instrumentCode excell totalQty =$totalQty portfolio existingPortfolioQty=$existingPortfolioQty  diff=$diff<br /></span>";



        $returnArr = array();
        $transaction_time_mature = date("Y-m-d H:i:s", strtotime("-30 days"));
        $transaction_time_immature =date("Y-m-d H:i:s");


        if ($existingPortfolioQty == 0)  // need a fresh entry
        {
            $adjustAbleQty = $totalQty;
            $avgCost=$avgCostScript;


            if ($freeQty >= $adjustAbleQty) {
                $temp = array();
                $amount = $adjustAbleQty;  // takes all

                $temp['portfolio_id'] = $pid;
                $temp['instrument_id'] = $instrumentId;
                $temp['transaction_type_id'] = 1;  // buy as adding share

                $temp['rate'] = $avgCost;
                // $new_transaction_time = date("Y-m-d H:i:s", strtotime("-30 days"));
                $temp['transaction_time'] = $transaction_time_mature;
                $temp['commission'] = $broker_fee;
                $today = date("Y-m-d");
                $temp['dse_order_id'] = "script-$today";
                $temp['amount'] = $amount;
                if ($temp['amount']) {
                    $returnArr[] = $temp;
                    echo "1=>" . $temp['amount'] . " $instrumentCode FRESH ENTRY to $bo_irn <br />";
                }


            } elseif ($freeQty < $adjustAbleQty) {
                $temp = array();
                $amount = $freeQty;  // takes all of free share. and some share will be still left

                $temp['portfolio_id'] = $pid;
                $temp['instrument_id'] = $instrumentId;
                $temp['transaction_type_id'] = 1;  // buy as adding share

                $temp['rate'] = $avgCost;
                //  $new_transaction_time = date("Y-m-d H:i:s", strtotime("-30 days"));
                $temp['transaction_time'] = $transaction_time_mature;
                $temp['commission'] = $broker_fee;
                $today = date("Y-m-d");
                $temp['dse_order_id'] = "script-$today";
                $temp['amount'] = $amount;
                if ($temp['amount']) {
                    $returnArr[] = $temp;
                    echo "2=>" . $temp['amount'] . " $instrumentCode FRESH ENTRY  to $bo_irn <br />";
                }

                // now add immature shares
                $temp = array();
                $amount = $adjustAbleQty - $freeQty;  // takes all of free share. and some share will be still left

                $temp['portfolio_id'] = $pid;
                $temp['instrument_id'] = $instrumentId;
                $temp['transaction_type_id'] = 1;  // buy as adding share

                $temp['rate'] = $avgCost;
                // $new_transaction_time = date("Y-m-d H:i:s");
                $temp['transaction_time'] = $transaction_time_immature;
                $temp['commission'] = $broker_fee;
                $today = date("Y-m-d");
                $temp['dse_order_id'] = "script-$today";

                if ($amount)
                {
                    $temp['amount'] = $amount;
                    if ($temp['amount']) {
                        $returnArr[] = $temp;
                        echo "3=>" . $temp['amount'] . " $instrumentCode FRESH ENTRY(IMMATURE) to $bo_irn <br />";
                    }
                }

            } else  // adding remaining share as immature
            {
                //@ do nothing
            }


        }

        else  // already this share in portfolio. need adjustment
        {
            $totalCostScript=$totalQty*$avgCostScript;
            $totalCostPortfolio=$existingPortfolioQty*$avgCostPortfolio;
            $diffTotalCost=$totalCostScript-$totalCostPortfolio;




            if ($diff == 0)// portfolio for this item is ok/up to date. NO ACTION REQUIRED FOR NEW ENTRY
            {
                $avgCost=$avgCostPortfolio;

                if ($saleAbleShares < $freeQty) // we have some space to add share as mature
                {


                    //adding shortage of mature share

                    $allowedQty = $freeQty - $saleAbleShares;  // maximum allowed quantity to input as mature share

                    $temp = array();
                    $temp['portfolio_id'] = $pid;
                    $temp['instrument_id'] = $instrumentId;
                    $temp['transaction_type_id'] = 1;  // buy as adding share
                    $temp['rate'] = $avgCost;
                    // $new_transaction_time = date("Y-m-d H:i:s", strtotime("-30 days"));
                    $temp['transaction_time'] = $transaction_time_mature;
                    $temp['commission'] = $broker_fee;
                    $today = date("Y-m-d");
                    $temp['dse_order_id'] = "script-$today";
                    $temp['amount'] = $allowedQty;
                    if ($temp['amount']) {
                        $returnArr[] = $temp;
                        echo "4=>" . $temp['amount'] . " $instrumentCode ADDED (as mature)  to $bo_irn <br />";
                    }

                    //removing excess of immature shares

                    // $allowedLockQty=($existingPortfolioQty-$saleAbleShares)-($totalQty-$freeQty);

                    $temp = array();
                    $temp['portfolio_id'] = $pid;
                    $temp['instrument_id'] = $instrumentId;
                    $temp['transaction_type_id'] = 2;  // SELL as REMOVE share
                    $temp['amount'] = $allowedQty;
                    $temp['rate'] = $avgCost;
                    // $new_transaction_time = date("Y-m-d H:i:s"); // setting today .So it will be shown as immature
                    $temp['transaction_time'] = $transaction_time_immature;
                    $temp['commission'] = $broker_fee;
                    $today = date("Y-m-d");
                    $temp['dse_order_id'] = "script-$today";
                    if ($temp['amount']) {
                        $returnArr[] = $temp;
                        echo "5=>" . $temp['amount'] . " $instrumentCode REMOVED (as immature) form $bo_irn <br />";
                    }

                }
                elseif ($saleAbleShares > $freeQty)
                {
                    //removing excess of mature shares
                    $allowedQty = $saleAbleShares - $freeQty;  // maximum allowed quantity to input as mature share

                    $temp = array();
                    $temp['portfolio_id'] = $pid;
                    $temp['instrument_id'] = $instrumentId;
                    $temp['transaction_type_id'] = 2;  // buy as adding share
                    $temp['rate'] = $avgCost;
                    // $new_transaction_time = date("Y-m-d H:i:s", strtotime("-30 days"));  // changing to past so it will be shown as Mature
                    $temp['transaction_time'] = $transaction_time_mature;
                    $temp['commission'] = $broker_fee;
                    $today = date("Y-m-d");
                    $temp['dse_order_id'] = "script-$today";
                    $temp['amount'] = $allowedQty;
                    if ($temp['amount']) {
                        $returnArr[] = $temp;
                        echo "6=>" . $temp['amount'] . " $instrumentCode REMOVED (as mature) form $bo_irn <br />";
                    }



                    //adding shortage of immature share

                    //$allowedLockQty=($totalQty-$freeQty)-($existingPortfolioQty-$saleAbleShares);

                    $temp = array();
                    $temp['portfolio_id'] = $pid;
                    $temp['instrument_id'] = $instrumentId;
                    $temp['transaction_type_id'] = 1;  // SELL as REMOVE share
                    $temp['amount'] = $allowedQty;
                    $temp['rate'] = $avgCost;
                    //  $new_transaction_time = date("Y-m-d H:i:s"); // setting today .So it will be shown as immature
                    $temp['transaction_time'] = $transaction_time_immature;
                    $temp['commission'] = $broker_fee;
                    $today = date("Y-m-d");
                    $temp['dse_order_id'] = "script-$today";
                    if ($temp['amount']) {
                        $returnArr[] = $temp;
                        echo "7=>" . $temp['amount'] . " $instrumentCode ADDED (as immature) to $bo_irn <br />";
                    }

                }



            } elseif ($diff < 0)// portfolio has more quantity than it should be. So we have to remove them
            {

                $adjustAbleQty = abs($diff);

                $avgCost=$diffTotalCost/-($diff);

                /* =========free share  adjustment start=================*/

                if ($saleAbleShares < $freeQty) // we have some space to add share as mature
                {
                    //@todo manual action required

                    //adding shortage of mature share

                    $allowedQty = $freeQty - $saleAbleShares;  // maximum allowed quantity to input as mature share

                    $temp = array();
                    $temp['portfolio_id'] = $pid;
                    $temp['instrument_id'] = $instrumentId;
                    $temp['transaction_type_id'] = 1;  // buy as adding share
                    $temp['rate'] = $avgCost;
                    // $new_transaction_time = date("Y-m-d H:i:s", strtotime("-30 days"));
                    $temp['transaction_time'] = $transaction_time_mature;
                    $temp['commission'] = $broker_fee;
                    $today = date("Y-m-d");
                    $temp['dse_order_id'] = "script-$today";
                    $temp['amount'] = $allowedQty;
                    if ($temp['amount']) {
                        $returnArr[] = $temp;
                        echo "8=>" . $temp['amount'] . " $instrumentCode ADDED (as mature)  to $bo_irn <br />";
                    }

                    //removing excess of immature shares

                    $allowedLockQty=($existingPortfolioQty-$saleAbleShares)-($totalQty-$freeQty);

                    $temp = array();
                    $temp['portfolio_id'] = $pid;
                    $temp['instrument_id'] = $instrumentId;
                    $temp['transaction_type_id'] = 2;  // SELL as REMOVE share
                    $temp['amount'] = $allowedLockQty;
                    $temp['rate'] = $avgCost;
                    // $new_transaction_time = date("Y-m-d H:i:s"); // setting today .So it will be shown as immature
                    $temp['transaction_time'] = $transaction_time_immature;
                    $temp['commission'] = $broker_fee;
                    $today = date("Y-m-d");
                    $temp['dse_order_id'] = "script-$today";
                    if ($temp['amount']) {
                        $returnArr[] = $temp;
                        echo "9=>" . $temp['amount'] . " $instrumentCode REMOVED (as immature) form $bo_irn <br />";
                    }

                }

                elseif ($saleAbleShares == $freeQty)
                {

                    //removing excess of immature shares
                    $allowedLockQty=($existingPortfolioQty-$saleAbleShares)-($totalQty-$freeQty);

                    $temp = array();
                    $temp['portfolio_id'] = $pid;
                    $temp['instrument_id'] = $instrumentId;
                    $temp['transaction_type_id'] = 2;  // SELL as REMOVE share
                    $temp['amount'] = $allowedLockQty;
                    $temp['rate'] = $avgCost;
                    // $new_transaction_time = date("Y-m-d H:i:s"); // setting today .So it will be shown as immature
                    $temp['transaction_time'] = $transaction_time_immature;
                    $temp['commission'] = $broker_fee;
                    $today = date("Y-m-d");
                    $temp['dse_order_id'] = "script-$today";
                    if ($temp['amount']) {
                        $returnArr[] = $temp;
                        echo "10=>" . $temp['amount'] . " $instrumentCode REMOVED (as immature) form $bo_irn <br />";
                    }

                }

                elseif ($saleAbleShares > $freeQty)
                {
                    //removing excess of mature shares
                    $allowedQty = $saleAbleShares - $freeQty;  // maximum allowed quantity to input as mature share

                    $temp = array();
                    $temp['portfolio_id'] = $pid;
                    $temp['instrument_id'] = $instrumentId;
                    $temp['transaction_type_id'] = 2;  // buy as adding share
                    $temp['rate'] = $avgCost;
                    // $new_transaction_time = date("Y-m-d H:i:s", strtotime("-30 days"));  // changing to past so it will be shown as Mature
                    $temp['transaction_time'] = $transaction_time_mature;
                    $temp['commission'] = $broker_fee;
                    $today = date("Y-m-d");
                    $temp['dse_order_id'] = "script-$today";
                    $temp['amount'] = $allowedQty;
                    if ($temp['amount']) {
                        $returnArr[] = $temp;
                        echo "11=>" . $temp['amount'] . " $instrumentCode REMOVED (as mature) form $bo_irn <br />";
                    }


                    $allowedLockQty=($totalQty-$freeQty)-($existingPortfolioQty-$saleAbleShares);

                    if($allowedLockQty>0)
                    {
                        //adding shortage of immature share
                        $temp = array();
                        $temp['portfolio_id'] = $pid;
                        $temp['instrument_id'] = $instrumentId;
                        $temp['transaction_type_id'] = 1;
                        $temp['amount'] = $allowedLockQty;
                        $temp['rate'] = $avgCost;
                        // $new_transaction_time = date("Y-m-d H:i:s"); // setting today .So it will be shown as immature
                        $temp['transaction_time'] = $transaction_time_immature;
                        $temp['commission'] = $broker_fee;
                        $today = date("Y-m-d");
                        $temp['dse_order_id'] = "script-$today";
                        if ($temp['amount']) {
                            $returnArr[] = $temp;
                            echo "12=>" . $temp['amount'] . " $instrumentCode ADDED (as immature) to $bo_irn <br />";
                        }
                    }
                    elseif($allowedLockQty<0)
                    {  //removing excess of immature shares
                        $temp = array();
                        $temp['portfolio_id'] = $pid;
                        $temp['instrument_id'] = $instrumentId;
                        $temp['transaction_type_id'] = 2;  // SELL as REMOVE share
                        $temp['amount'] = -($allowedLockQty);
                        $temp['rate'] = $avgCost;
                        // $new_transaction_time = date("Y-m-d H:i:s"); // setting today .So it will be shown as immature
                        $temp['transaction_time'] = $transaction_time_immature;
                        $temp['commission'] = $broker_fee;
                        $today = date("Y-m-d");
                        $temp['dse_order_id'] = "script-$today";
                        if ($temp['amount']) {
                            $returnArr[] = $temp;
                            echo "13=>" . $temp['amount'] . " $instrumentCode REMOVED (as mature) to $bo_irn <br />";
                        }
                    }



                }


            }

            elseif ($diff > 0)// portfolio has less quantity than it should be. So we have to add them
            {

                $avgCost=$diffTotalCost/$diff;
                /* =========free share  adjustment start=================*/

                if ($saleAbleShares < $freeQty) // we have some space to add share as mature
                {
                    //adding shortage of mature share
                    $allowedQty = $freeQty - $saleAbleShares;  // maximum allowed quantity to input as mature share


                    $temp = array();
                    $temp['portfolio_id'] = $pid;
                    $temp['instrument_id'] = $instrumentId;
                    $temp['transaction_type_id'] = 1;  // buy as adding share
                    $temp['rate'] = $avgCost;
                    // $new_transaction_time = date("Y-m-d H:i:s", strtotime("-30 days"));  // changing to past so it will be shown as Mature
                    $temp['transaction_time'] = $transaction_time_mature;
                    $temp['commission'] = $broker_fee;
                    $today = date("Y-m-d");
                    $temp['dse_order_id'] = "script-$today";
                    $temp['amount'] = $allowedQty;
                    if ($temp['amount'])
                    {
                        $returnArr[] = $temp;
                        echo "14=>" . $temp['amount'] . " $instrumentCode ADDED (as mature) to $bo_irn <br />";
                    }

                    //removing excess of immature share
                    $allowedLockQty=($existingPortfolioQty-$saleAbleShares)-($totalQty-$freeQty);

                    $temp = array();
                    $temp['portfolio_id'] = $pid;
                    $temp['instrument_id'] = $instrumentId;
                    $temp['transaction_type_id'] = 2;  // SELL as REMOVE share
                    $temp['amount'] = $allowedLockQty;
                    $temp['rate'] = $avgCost;
                    //  $new_transaction_time = date("Y-m-d H:i:s"); // setting today .So it will be shown as immature
                    $temp['transaction_time'] = $transaction_time_immature;
                    $temp['commission'] = $broker_fee;
                    $today = date("Y-m-d");
                    $temp['dse_order_id'] = "script-$today";
                    if ($temp['amount']) {
                        $returnArr[] = $temp;
                        echo "15=>" . $temp['amount'] . " $instrumentCode REMOVED (as immature) form $bo_irn <br />";
                    }


                }
                elseif ($saleAbleShares == $freeQty) // we have to add left share as immature as we have already saleable share as free share
                {

                    //adding shortage of immature share
                    $allowedLockQty=($totalQty-$freeQty)-($existingPortfolioQty-$saleAbleShares);

                    $temp = array();
                    $temp['portfolio_id'] = $pid;
                    $temp['instrument_id'] = $instrumentId;
                    $temp['transaction_type_id'] = 1;  // buy as adding share
                    $temp['amount'] = $allowedLockQty;
                    $temp['rate'] = $avgCost;
                    // $new_transaction_time = date("Y-m-d H:i:s"); // setting today .So it will be shown as immature
                    $temp['transaction_time'] = $transaction_time_immature;
                    $temp['commission'] = $broker_fee;
                    $today = date("Y-m-d");
                    $temp['dse_order_id'] = "script-$today";
                    if ($temp['amount']) {
                        $returnArr[] = $temp;
                        echo "16=>" . $temp['amount'] . " $instrumentCode ADDED (as immature) to $bo_irn <br />";
                    }

                }

                elseif ($saleAbleShares > $freeQty) // we have some share in the portfolio that have inputed by mistake
                {
                    // @todo treatment needed to remove share

                    //removing excess of mature share

                    $allowedQty =$saleAbleShares-$freeQty ;

                    $temp = array();
                    $temp['portfolio_id'] = $pid;
                    $temp['instrument_id'] = $instrumentId;
                    $temp['transaction_type_id'] = 2;  // SELL as REMOVE share
                    $temp['amount'] = $allowedQty;
                    $temp['rate'] = $avgCost;
                    $new_transaction_time =  date("Y-m-d H:i:s", strtotime("-30 days")); // setting today .So it will be shown as immature
                    $temp['transaction_time'] = $new_transaction_time;
                    $temp['commission'] = $broker_fee;
                    $today = date("Y-m-d");
                    $temp['dse_order_id'] = "script-$today";
                    if ($temp['amount']) {
                        $returnArr[] = $temp;
                        echo "17=>" . $temp['amount'] . " $instrumentCode REMOVED (as mature) from $bo_irn <br />";
                    }


                    //adding shortage of immature share

                    $allowedLockQty=($totalQty-$freeQty)-($existingPortfolioQty-$saleAbleShares);

                    $temp = array();
                    $temp['portfolio_id'] = $pid;
                    $temp['instrument_id'] = $instrumentId;
                    $temp['transaction_type_id'] = 1;  // buy as adding share
                    $temp['amount'] = $allowedLockQty; // taking all remaining quantity
                    $temp['rate'] = $avgCost;
                    // $new_transaction_time = date("Y-m-d H:i:s"); // setting today .So it will be shown as immature
                    $temp['transaction_time'] = $transaction_time_immature;
                    $temp['commission'] = $broker_fee;
                    $today = date("Y-m-d");
                    $temp['dse_order_id'] = "script-$today";

                    if ($temp['amount']) {
                        $returnArr[] = $temp;
                        echo "18=>" . $temp['amount'] . " $instrumentCode ADDED (as immature) to $bo_irn <br />";
                    }

                }

            }
        }

        return $returnArr;

    }

    public function bonus_update_sharp()
    {
        Configure::write('debug', 2);

       /* require_once(APP . 'Vendor' . DS . 'phpexcel' . DS . 'PHPExcel.php');

        $StockBangladesh = $this->Components->load('StockBangladesh');
        $Omo = $this->Components->load('Omo');
        $fileArr = $StockBangladesh->scan_dir($portfolio_file_path);
        $fullFilePath = "$portfolio_file_path/" . $fileArr[0];
        */

        require_once(APP . 'Vendor' . DS . 'phpexcel' . DS . 'PHPExcel.php');
        $StockBangladesh = $this->Components->load('StockBangladesh');
        $Omo = $this->Components->load('Omo');
        $bonus_file_path = Configure::read('broker.sharp.bonus_file_path');
        $fileArr = $StockBangladesh->scan_dir($bonus_file_path);
        $fullFilePath = "$bonus_file_path/" . $fileArr[0];
        $array_data = $Omo->xlsToArray($fullFilePath);

      //  $file = fopen($fullFilePath, "r");
        $array_data1 = array();

        // read each data row in the file
        $dataGroupByIrn = array();
        $mykey = 0;//
        foreach ($array_data as $bonus)
        {
           // $row = fgetcsv($file);

            if ($bonus[0]=='Client'||$bonus[0] == '' ) {
                continue;
            }

           // $array_data[] = $row;
             if ($bonus[0]=='Client Code:') {

                 $internal_ref_no = trim($bonus[1]);
                 $internal_ref_no = ltrim($internal_ref_no, '0');
               //  $internal_ref_no = str_pad($internal_ref_no, 5, "0", STR_PAD_LEFT);


             }
            elseif ($bonus[0]=='Client Name:') {
                //if(is_int($row[0])) {
                $client_name = trim($bonus[3]);
             //   pr($client_name);

            }
             else {
                 $result = Hash::insert($bonus, 'irn',$internal_ref_no);
                // $result = Hash::insert($result, 'name',$client_name);
                 //$users = Hash::insert($row, '{n}.User.new', 'value');
                // $dataGroupByIrn[$internal_ref_no][]= $result;
                 // $result = Hash::insert($row, 'irn',$mykey[0]);
                   $array_data1[]=$result;


             }


        }


      //  $bonusShare=0;
        foreach($array_data1 as $bonusShare)
        {
            $instrumentName=$bonusShare[1];
            $clientCode=$bonusShare['irn'];
            $shareAmount=$bonusShare[4];

            $instrumentModel = ClassRegistry::init('Instrument');
            $ins_id = $instrumentModel->find('all', array("conditions"=>array("Instrument.instrument_code" =>$instrumentName),'fields'=>array('id'),'recursive' => -1));

            $userModel = ClassRegistry::init('User');
            $user_id = $userModel->find('all', array("conditions"=>array("User.internal_ref_no" =>$clientCode),'fields'=>array('portfolio_id','broker_fee'),'recursive' => -1));


            $portfolioTransaction['id'] = '';
            if(isset($user_id[0]['User']['portfolio_id']))
            {
                $portfolioTransaction['portfolio_id'] = $user_id[0]['User']['portfolio_id'];
                $portfolioTransaction['commission'] = $user_id[0]['User']['broker_fee'];

            }
            else
            {
                echo "p_id & broker fee not found for $clientCode";
                echo "<br>";
                continue;
            }

            if(isset($ins_id[0] ['Instrument']['id']))
                $portfolioTransaction['instrument_id'] = $ins_id[0] ['Instrument']['id'];
            else
            {
                echo "ins_id not found $instrumentName";
                echo "<br>";
                continue;
            }

            $portfolioTransaction['transaction_type_id'] = 1;
            $portfolioTransaction['amount'] = $shareAmount;
            $portfolioTransaction['rate'] = 0;
            $portfolioTransaction['transaction_time'] = date("Y-m-d H:i:s", strtotime("-30 days"));;
            $portfolioTransaction['updated'] =  date("Y-m-d H:i:s");


          // pr($portfolioTransaction);

            $transactionModel = ClassRegistry::init('PortfolioTransaction');
           if($transactionModel->save($portfolioTransaction, array('atomic' => true)))
           {
               echo "successful";
               echo "<br>";
           }
            else{ echo "error";
                echo "<br>";}

        }
       // pr($array_data);
        exit;
    }
////////////////////////////////////////////////////////for Sharp broker house END///////////////////////////////////////////////////////////////////////////////
/////////////////////////////////////////////////////////////////for Commerce broker house/////////////////////////////////////////////////////////////////////////
    public function portfolio_update_commerce($userPerSlot = 15)
    {
       // Configure::write('debug', 2);
        require_once(APP . 'Vendor' . DS . 'phpexcel' . DS . 'PHPExcel.php');
        $portfolio_file_path = Configure::read('broker.commerce.portfolios_file_path');
        $StockBangladesh = $this->Components->load('StockBangladesh');
        $Omo = $this->Components->load('Omo');
        $fileArr = $StockBangladesh->scan_dir($portfolio_file_path);

        $fullFilePath = "$portfolio_file_path/" . $fileArr[0];

        $today=date('d_m_Y');
       /* if(strpos($fileArr[0],$today) == false)
        {
            echo "<br>";
            echo "<h2>this is not today's file.please recheck and upload the correct file again</h2>";
            exit;
        }*/


        $array_data = $Omo->xlsToArray($fullFilePath);
        unset($array_data[1]);

        $commerceOmoUsers= Hash::extract($array_data,'{n}.0');
        $commerceOmoUsers=array_unique($commerceOmoUsers);
        $commerceOmoUsers = Hash::sort($commerceOmoUsers,'{n}','asc');

        // pr($array_data);

        $brokerId = Configure::read('broker.commerce.id');

        $userList = $Omo->getUsersList(4, 1);
        $brokerUsers = array();

        foreach ($userList[$brokerId] as $irn => $arr) {
            $key = trim($irn);
            $key = str_pad($key, 5, "0", STR_PAD_LEFT);
            $key = strtoupper($key);
            //  if ($key == '0H204')
            if(in_array($key,$commerceOmoUsers))
                $brokerUsers[$key] = $arr;
            else
                continue;
        }


        $totalUser = count($brokerUsers) + 15;
        ksort($brokerUsers);
        $this->set('totalUser', $totalUser);
        $this->set('userPerSlot', $userPerSlot);
        $this->set('brokerUsers', $brokerUsers);
        $this->set('pageTitleMain','Portfolio Update');
        $this->set('pageTitleSmall','update process of user portfolios ');
    }

    public function portfolio_update_script_commerce($userFrom = 0, $userTo = 15, $confirm = 0)
    {
        Configure::write('debug', 2);
        require_once(APP . 'Vendor' . DS . 'phpexcel' . DS . 'PHPExcel.php');

        $StockBangladesh = $this->Components->load('StockBangladesh');
        $ip = $StockBangladesh->getIp();
        $instrumentList = $StockBangladesh->instrumentList(2);
        $metaKey = array("category");
        $instrumentInfo = $StockBangladesh->getFundamentalInfo(0, $metaKey);

        $brokerId = Configure::read('broker.commerce.id');
        $Omo = $this->Components->load('Omo');
        $userList = $Omo->getUsersList(4, 1);


        $today = date('Y-m-d');
        $portfolio_file_path = Configure::read('broker.commerce.portfolios_file_path');
        $fileArr = $StockBangladesh->scan_dir($portfolio_file_path);
        $fullFilePath = "$portfolio_file_path/" . $fileArr[0];
        $filename_dateArr = explode('.', $fileArr[0]);
        $reportDate = date('Y-m-d', strtotime($filename_dateArr[0]));
        echo $fileArr[0];

        /* if ($reportDate == '1970-01-01') {
             echo $fileArr[0];
             echo "<br/><br/>Correct date is not found in file name<br /> please write appropriate date in tradins file name <br/><h3> Example: 2015-02-17.xlsx or 02-17-2015.xlsx</h3>";
             // CakeEmail::deliver('info@stockbangladesh.com', 'Trade Ins problem-Apex', 'Date string can not be found', array('from' => 'omo@stockbangladesh.net'));
             exit;
         }

         if ($reportDate != $today) {
             echo $fileArr[0];
             echo "<br/>This is not today's file.<br/>";
             exit;
         }*/

        $array_data = $Omo->xlsToArray($fullFilePath);
        unset($array_data[1]);

        $apexOmoUsers= Hash::extract($array_data,'{n}.0');
        $apexOmoUsers=array_unique($apexOmoUsers);
        $apexOmoUsers = Hash::sort($apexOmoUsers,'{n}','asc');

        $brokerUsers = array();
        foreach ($userList[$brokerId] as $irn => $arr) {
            $key = trim($irn);
            $key = str_pad($key, 5, "0", STR_PAD_LEFT);
            $key = strtoupper($key);
            //  if ($key == '0H204')

            if(in_array($key,$apexOmoUsers))
            {
                $brokerUsers[$key] = $arr;
            }
            else
                continue;
        }

        ksort($brokerUsers);



        $dataGroupByIrn = array();

        foreach ($array_data as $row) {
            $irn = $row[0];
            $totalQty = $row[5];
            $row[1] = strtoupper(trim($row[1]));

            if ($totalQty)
                $dataGroupByIrn[$irn][] = $row;
        }

        $model = ClassRegistry::init('Portfolio');
        $Portfolio = $this->Components->load('Portfolio');
        $this->ttypeArr = $Portfolio->getTransactionType();
        $dataToSave = array();

        $i = 0;
        foreach ($brokerUsers as $irn => $user) {
            $i++;
            //   pr($i);
            if ($i > $userFrom and $i <= $userTo) {

                $pid = $user['portfolio_id'];
                $broker_fee = $user['broker_fee'];
                // pr($dataGroupByIrn[$irn]);


                if (!isset($dataGroupByIrn[$irn])) {
                    echo "<h2>There is no share found for $irn in Apex excell</h2>";
                    continue;
                } else {

                    $actualHoldings = $dataGroupByIrn[$irn];
                }


                $model->contain('PortfolioTransaction');
                $allTransactions = $model->find('all', array(
                        'conditions' => "Portfolio.id=$pid"

                    )
                );

                $instrumentListKeyId = $StockBangladesh->instrumentList(3);

                $portfolioHoldingsTransaction = $Portfolio->getPortfolioHoldings2($allTransactions, $this->ttypeArr);


                // padding missing share of $portfolioHoldingsTransaction in $actualHoldings

                foreach ($portfolioHoldingsTransaction as $instrumentId => $arr)
                {
                    $temp = array();
                    $code = $instrumentListKeyId[$instrumentId];

                    $temp[] = $irn;
                    $temp[] = $code;
                    $temp[] = 0;
                    $temp[] = 0;
                    $temp[] = 0;
                    $temp[] = 0;
                    $temp[] = 'NULL';
                    $temp[] = 0;


                    $shareExist = Hash::extract($actualHoldings, "{n}[1=$code]");

                    if (empty($shareExist)) {

                        $actualHoldings[] = $temp;

                    }

                }

                echo "==================================================processing $irn is started=========================================<br />";
                foreach ($actualHoldings as $share) {

                    $instrumentCode = strtoupper(trim($share[1]));

                    // $category = $instrumentInfo[$instrumentId]['category']['meta_value'];

                    if (!isset($instrumentList[$instrumentCode])) {
                        echo "<h3>$instrumentCode is not found</h3>";
                        continue;
                    } else {


                        $instrumentId = $instrumentList[$instrumentCode];

                        if(isset($instrumentInfo[$instrumentId]['category']['meta_value']))
                        {
                            $category = $instrumentInfo[$instrumentId]['category']['meta_value'];
                        }
                        else
                        {
                            echo "<h3>$instrumentCode category undefined</h3>";
                            continue;
                        }
                        $newEntryArr = $this-> adjustPortfolio_commerce($share, $portfolioHoldingsTransaction, $instrumentId, $category, $pid, $broker_fee);
                        $dataToSave = array_merge($dataToSave, $newEntryArr);
                    }

                }

                echo "==================================================processing $irn is finished=========================================<br />";

            }



        }


        if (count($dataToSave)) {
            $model = ClassRegistry::init('PortfolioTransaction');
            if ($confirm) {
                $model->saveMany($dataToSave, array('atomic' => true));
                $rep = count($dataToSave) . ' NEW ROW INSERTED';
                echo "<br/>****************$rep*********************<br/>";
            } else {
                $rep = count($dataToSave) . ' new transaction will be insert. Please confirm to save it';
                $rt = Router::url('/', true) . "Portfolios/portfolio_update_script_commerce/$userFrom/$userTo/1";
                //     echo $rt;
                echo "<br /><a href='$rt'>$rep</a> <br />";

            }


        }
        exit;
    }

    public function adjustPortfolio_commerce($share, $portfolioHoldingsTransaction, $instrumentId, $category, $pid, $broker_fee)
    {
        Configure::write('debug', 2);

        App::uses('CakeTime', 'Utility');
        $freeQty = $share[2];
        $tempAvgCostScript=$share[4];
        $avgCostScript = ($tempAvgCostScript*100)/(100+$broker_fee); //substitution of commission or broker fee
        $totalQty = $share[5];
        $devQty = $share[6];
        $instrumentCode = strtoupper(trim($share[1]));
        $bo_irn = trim($share[0]);

        // remove lockin quantity
        if ($devQty > 0) {
            $totalQty = $totalQty - $devQty;
        }


        if (isset($portfolioHoldingsTransaction[$instrumentId])) {

            $existingPortfolioQty = $portfolioHoldingsTransaction[$instrumentId]['totalQuantity'];
            $existingPortfolioDividendQuantity = $portfolioHoldingsTransaction[$instrumentId]['dividendQuantity'];
            $receiveableDividendQuantity = $portfolioHoldingsTransaction[$instrumentId]['receiveableDividendQuantity'];
            $saleAbleShares = $portfolioHoldingsTransaction[$instrumentId]['saleAbleShares'];
            $avgCostPortfolio=$portfolioHoldingsTransaction[$instrumentId]['avgCost'];

        } else {
            $existingPortfolioQty = 0;
            $existingPortfolioDividendQuantity = 0;
            $receiveableDividendQuantity = 0;
            $saleAbleShares = 0;
        }
        $diff = $totalQty - $existingPortfolioQty;
        echo "<span style='color:green'>$instrumentCode excell totalQty =$totalQty portfolio existingPortfolioQty=$existingPortfolioQty  diff=$diff<br /></span>";




        $returnArr = array();
        $transaction_time_mature = date("Y-m-d H:i:s", strtotime("-30 days"));
        $transaction_time_immature =date("Y-m-d H:i:s");



        //for backdated portfolio Update change immature date...
        // $transaction_time_immature = date("Y-m-d H:i:s", strtotime("-1 days"));

        if ($existingPortfolioQty == 0)  // need a fresh entry
        {
            $adjustAbleQty = $totalQty;
            $avgCost=$avgCostScript;

            if ($freeQty >= $adjustAbleQty) {
                $temp = array();
                $amount = $adjustAbleQty;  // takes all

                $temp['portfolio_id'] = $pid;
                $temp['instrument_id'] = $instrumentId;
                $temp['transaction_type_id'] = 1;  // buy as adding share

                $temp['rate'] = $avgCost;
                // $new_transaction_time = date("Y-m-d H:i:s", strtotime("-30 days"));
                $temp['transaction_time'] = $transaction_time_mature;
                $temp['commission'] = $broker_fee;
                $today = date("Y-m-d");
                $temp['dse_order_id'] = "script-$today";
                $temp['amount'] = $amount;
                if ($temp['amount']) {
                    $returnArr[] = $temp;
                    echo "1=>" . $temp['amount'] . " $instrumentCode FRESH ENTRY to $bo_irn <br />";
                }


            } elseif ($freeQty < $adjustAbleQty) {
                $temp = array();
                $amount = $freeQty;  // takes all of free share. and some share will be still left

                $temp['portfolio_id'] = $pid;
                $temp['instrument_id'] = $instrumentId;
                $temp['transaction_type_id'] = 1;  // buy as adding share

                $temp['rate'] = $avgCost;
                //  $new_transaction_time = date("Y-m-d H:i:s", strtotime("-30 days"));
                $temp['transaction_time'] = $transaction_time_mature;
                $temp['commission'] = $broker_fee;
                $today = date("Y-m-d");
                $temp['dse_order_id'] = "script-$today";
                $temp['amount'] = $amount;
                if ($temp['amount']) {
                    $returnArr[] = $temp;
                    echo "2=>" . $temp['amount'] . " $instrumentCode FRESH ENTRY  to $bo_irn <br />";
                }

                // now add immature shares
                $temp = array();
                $amount = $adjustAbleQty - $freeQty;  // takes all of free share. and some share will be still left

                $temp['portfolio_id'] = $pid;
                $temp['instrument_id'] = $instrumentId;
                $temp['transaction_type_id'] = 1;  // buy as adding share

                $temp['rate'] = $avgCost;
                // $new_transaction_time = date("Y-m-d H:i:s");
                $temp['transaction_time'] = $transaction_time_immature;
                $temp['commission'] = $broker_fee;
                $today = date("Y-m-d");
                $temp['dse_order_id'] = "script-$today";

                if ($amount)
                {
                    $temp['amount'] = $amount;
                    if ($temp['amount']) {
                        $returnArr[] = $temp;
                        echo "3=>" . $temp['amount'] . " $instrumentCode FRESH ENTRY(IMMATURE) to $bo_irn <br />";
                    }
                }

            } else  // adding remaining share as immature
            {
                //@ do nothing
            }


        }

        else  // already this share in portfolio. need adjustment
        {
            $totalCostScript=$totalQty*$avgCostScript;
            $totalCostPortfolio=$existingPortfolioQty*$avgCostPortfolio;
            $diffTotalCost=$totalCostScript-$totalCostPortfolio;


            if ($diff == 0)// portfolio for this item is ok/up to date. NO ACTION REQUIRED FOR NEW ENTRY
            {
                $avgCost=$avgCostPortfolio;

                if ($saleAbleShares < $freeQty) // we have some space to add share as mature
                {


                    //adding shortage of mature share

                    $allowedQty = $freeQty - $saleAbleShares;  // maximum allowed quantity to input as mature share

                    $temp = array();
                    $temp['portfolio_id'] = $pid;
                    $temp['instrument_id'] = $instrumentId;
                    $temp['transaction_type_id'] = 1;  // buy as adding share
                    $temp['rate'] = $avgCost;
                    // $new_transaction_time = date("Y-m-d H:i:s", strtotime("-30 days"));
                    $temp['transaction_time'] = $transaction_time_mature;
                    $temp['commission'] = $broker_fee;
                    $today = date("Y-m-d");
                    $temp['dse_order_id'] = "script-$today";
                    $temp['amount'] = $allowedQty;
                    if ($temp['amount']) {
                        $returnArr[] = $temp;
                        echo "4=>" . $temp['amount'] . " $instrumentCode ADDED (as mature)  to $bo_irn <br />";
                    }

                    //removing excess of immature shares

                    // $allowedLockQty=($existingPortfolioQty-$saleAbleShares)-($totalQty-$freeQty);

                    $temp = array();
                    $temp['portfolio_id'] = $pid;
                    $temp['instrument_id'] = $instrumentId;
                    $temp['transaction_type_id'] = 2;  // SELL as REMOVE share
                    $temp['amount'] = $allowedQty;
                    $temp['rate'] = $avgCost;
                    // $new_transaction_time = date("Y-m-d H:i:s"); // setting today .So it will be shown as immature
                    $temp['transaction_time'] = $transaction_time_immature;
                    $temp['commission'] = $broker_fee;
                    $today = date("Y-m-d");
                    $temp['dse_order_id'] = "script-$today";
                    if ($temp['amount']) {
                        $returnArr[] = $temp;
                        echo "5=>" . $temp['amount'] . " $instrumentCode REMOVED (as immature) form $bo_irn <br />";
                    }

                }
                elseif ($saleAbleShares > $freeQty)
                {
                    //removing excess of mature shares
                    $allowedQty = $saleAbleShares - $freeQty;  // maximum allowed quantity to input as mature share

                    $temp = array();
                    $temp['portfolio_id'] = $pid;
                    $temp['instrument_id'] = $instrumentId;
                    $temp['transaction_type_id'] = 2;  // buy as adding share
                    $temp['rate'] = $avgCost;
                    // $new_transaction_time = date("Y-m-d H:i:s", strtotime("-30 days"));  // changing to past so it will be shown as Mature
                    $temp['transaction_time'] = $transaction_time_mature;
                    $temp['commission'] = $broker_fee;
                    $today = date("Y-m-d");
                    $temp['dse_order_id'] = "script-$today";
                    $temp['amount'] = $allowedQty;
                    if ($temp['amount']) {
                        $returnArr[] = $temp;
                        echo "6=>" . $temp['amount'] . " $instrumentCode REMOVED (as mature) form $bo_irn <br />";
                    }



                    //adding shortage of immature share

                    //$allowedLockQty=($totalQty-$freeQty)-($existingPortfolioQty-$saleAbleShares);

                    $temp = array();
                    $temp['portfolio_id'] = $pid;
                    $temp['instrument_id'] = $instrumentId;
                    $temp['transaction_type_id'] = 1;  // SELL as REMOVE share
                    $temp['amount'] = $allowedQty;
                    $temp['rate'] = $avgCost;
                    //  $new_transaction_time = date("Y-m-d H:i:s"); // setting today .So it will be shown as immature
                    $temp['transaction_time'] = $transaction_time_immature;
                    $temp['commission'] = $broker_fee;
                    $today = date("Y-m-d");
                    $temp['dse_order_id'] = "script-$today";
                    if ($temp['amount']) {
                        $returnArr[] = $temp;
                        echo "7=>" . $temp['amount'] . " $instrumentCode ADDED (as immature) to $bo_irn <br />";
                    }

                }



            } elseif ($diff < 0)// portfolio has more quantity than it should be. So we have to remove them
            {
                $avgCost=$diffTotalCost/-($diff);

                $adjustAbleQty = abs($diff);




                /* =========free share  adjustment start=================*/

                if ($saleAbleShares < $freeQty) // we have some space to add share as mature
                {
                    //@todo manual action required

                    //adding shortage of mature share

                    $allowedQty = $freeQty - $saleAbleShares;  // maximum allowed quantity to input as mature share

                    $temp = array();
                    $temp['portfolio_id'] = $pid;
                    $temp['instrument_id'] = $instrumentId;
                    $temp['transaction_type_id'] = 1;  // buy as adding share
                    $temp['rate'] = $avgCost;
                    // $new_transaction_time = date("Y-m-d H:i:s", strtotime("-30 days"));
                    $temp['transaction_time'] = $transaction_time_mature;
                    $temp['commission'] = $broker_fee;
                    $today = date("Y-m-d");
                    $temp['dse_order_id'] = "script-$today";
                    $temp['amount'] = $allowedQty;
                    if ($temp['amount']) {
                        $returnArr[] = $temp;
                        echo "8=>" . $temp['amount'] . " $instrumentCode ADDED (as mature)  to $bo_irn <br />";
                    }

                    //removing excess of immature shares

                    $allowedLockQty=($existingPortfolioQty-$saleAbleShares)-($totalQty-$freeQty);

                    $temp = array();
                    $temp['portfolio_id'] = $pid;
                    $temp['instrument_id'] = $instrumentId;
                    $temp['transaction_type_id'] = 2;  // SELL as REMOVE share
                    $temp['amount'] = $allowedLockQty;
                    $temp['rate'] = $avgCost;
                    // $new_transaction_time = date("Y-m-d H:i:s"); // setting today .So it will be shown as immature
                    $temp['transaction_time'] = $transaction_time_immature;
                    $temp['commission'] = $broker_fee;
                    $today = date("Y-m-d");
                    $temp['dse_order_id'] = "script-$today";
                    if ($temp['amount']) {
                        $returnArr[] = $temp;
                        echo "9=>" . $temp['amount'] . " $instrumentCode REMOVED (as immature) form $bo_irn <br />";
                    }

                }

                elseif ($saleAbleShares == $freeQty)
                {

                    //removing excess of immature shares
                    $allowedLockQty=($existingPortfolioQty-$saleAbleShares)-($totalQty-$freeQty);

                    $temp = array();
                    $temp['portfolio_id'] = $pid;
                    $temp['instrument_id'] = $instrumentId;
                    $temp['transaction_type_id'] = 2;  // SELL as REMOVE share
                    $temp['amount'] = $allowedLockQty;
                    $temp['rate'] = $avgCost;
                    // $new_transaction_time = date("Y-m-d H:i:s"); // setting today .So it will be shown as immature
                    $temp['transaction_time'] = $transaction_time_immature;
                    $temp['commission'] = $broker_fee;
                    $today = date("Y-m-d");
                    $temp['dse_order_id'] = "script-$today";
                    if ($temp['amount']) {
                        $returnArr[] = $temp;
                        echo "10=>" . $temp['amount'] . " $instrumentCode REMOVED (as immature) form $bo_irn <br />";
                    }

                }

                elseif ($saleAbleShares > $freeQty)
                {
                    //removing excess of mature shares
                    $allowedQty = $saleAbleShares - $freeQty;  // maximum allowed quantity to input as mature share

                    $temp = array();
                    $temp['portfolio_id'] = $pid;
                    $temp['instrument_id'] = $instrumentId;
                    $temp['transaction_type_id'] = 2;  // buy as adding share
                    $temp['rate'] = $avgCost;
                    // $new_transaction_time = date("Y-m-d H:i:s", strtotime("-30 days"));  // changing to past so it will be shown as Mature
                    $temp['transaction_time'] = $transaction_time_mature;
                    $temp['commission'] = $broker_fee;
                    $today = date("Y-m-d");
                    $temp['dse_order_id'] = "script-$today";
                    $temp['amount'] = $allowedQty;
                    if ($temp['amount']) {
                        $returnArr[] = $temp;
                        echo "11=>" . $temp['amount'] . " $instrumentCode REMOVED (as mature) form $bo_irn <br />";
                    }





                    $allowedLockQty=($totalQty-$freeQty)-($existingPortfolioQty-$saleAbleShares);

                    if($allowedLockQty>0)
                    {
                        //adding shortage of immature share
                        $temp = array();
                        $temp['portfolio_id'] = $pid;
                        $temp['instrument_id'] = $instrumentId;
                        $temp['transaction_type_id'] = 1;
                        $temp['amount'] = $allowedLockQty;
                        $temp['rate'] = $avgCost;
                        // $new_transaction_time = date("Y-m-d H:i:s"); // setting today .So it will be shown as immature
                        $temp['transaction_time'] = $transaction_time_immature;
                        $temp['commission'] = $broker_fee;
                        $today = date("Y-m-d");
                        $temp['dse_order_id'] = "script-$today";
                        if ($temp['amount']) {
                            $returnArr[] = $temp;
                            echo "12=>" . $temp['amount'] . " $instrumentCode ADDED (as immature) to $bo_irn <br />";
                        }
                    }
                    elseif($allowedLockQty<0)
                    {  //removing excess of immature shares
                        $temp = array();
                        $temp['portfolio_id'] = $pid;
                        $temp['instrument_id'] = $instrumentId;
                        $temp['transaction_type_id'] = 2;  // SELL as REMOVE share
                        $temp['amount'] = -($allowedLockQty);
                        $temp['rate'] = $avgCost;
                        // $new_transaction_time = date("Y-m-d H:i:s"); // setting today .So it will be shown as immature
                        $temp['transaction_time'] = $transaction_time_immature;
                        $temp['commission'] = $broker_fee;
                        $today = date("Y-m-d");
                        $temp['dse_order_id'] = "script-$today";
                        if ($temp['amount']) {
                            $returnArr[] = $temp;
                            echo "13=>" . $temp['amount'] . " $instrumentCode REMOVED (as mature) to $bo_irn <br />";
                        }
                    }



                }


            }

            elseif ($diff > 0)// portfolio has less quantity than it should be. So we have to add them
            {

                $avgCost=$diffTotalCost/$diff;

                /* =========free share  adjustment start=================*/

                if ($saleAbleShares < $freeQty) // we have some space to add share as mature
                {
                    //adding shortage of mature share
                    $allowedQty = $freeQty - $saleAbleShares;  // maximum allowed quantity to input as mature share


                    $temp = array();
                    $temp['portfolio_id'] = $pid;
                    $temp['instrument_id'] = $instrumentId;
                    $temp['transaction_type_id'] = 1;  // buy as adding share
                    $temp['rate'] = $avgCost;
                    // $new_transaction_time = date("Y-m-d H:i:s", strtotime("-30 days"));  // changing to past so it will be shown as Mature
                    $temp['transaction_time'] = $transaction_time_mature;
                    $temp['commission'] = $broker_fee;
                    $today = date("Y-m-d");
                    $temp['dse_order_id'] = "script-$today";
                    $temp['amount'] = $allowedQty;
                    if ($temp['amount'])
                    {
                        $returnArr[] = $temp;
                        echo "14=>" . $temp['amount'] . " $instrumentCode ADDED (as mature) to $bo_irn <br />";
                    }

                    //removing excess of immature share
                    $allowedLockQty=($existingPortfolioQty-$saleAbleShares)-($totalQty-$freeQty);

                    $temp = array();
                    $temp['portfolio_id'] = $pid;
                    $temp['instrument_id'] = $instrumentId;
                    $temp['transaction_type_id'] = 2;  // SELL as REMOVE share
                    $temp['amount'] = $allowedLockQty;
                    $temp['rate'] = $avgCost;
                    //  $new_transaction_time = date("Y-m-d H:i:s"); // setting today .So it will be shown as immature
                    $temp['transaction_time'] = $transaction_time_immature;
                    $temp['commission'] = $broker_fee;
                    $today = date("Y-m-d");
                    $temp['dse_order_id'] = "script-$today";
                    if ($temp['amount']) {
                        $returnArr[] = $temp;
                        echo "15=>" . $temp['amount'] . " $instrumentCode REMOVED (as immature) form $bo_irn <br />";
                    }


                }
                elseif ($saleAbleShares == $freeQty) // we have to add left share as immature as we have already saleable share as free share
                {

                    //adding shortage of immature share
                    $allowedLockQty=($totalQty-$freeQty)-($existingPortfolioQty-$saleAbleShares);

                    $temp = array();
                    $temp['portfolio_id'] = $pid;
                    $temp['instrument_id'] = $instrumentId;
                    $temp['transaction_type_id'] = 1;  // buy as adding share
                    $temp['amount'] = $allowedLockQty;
                    $temp['rate'] = $avgCost;
                    // $new_transaction_time = date("Y-m-d H:i:s"); // setting today .So it will be shown as immature
                    $temp['transaction_time'] = $transaction_time_immature;
                    $temp['commission'] = $broker_fee;
                    $today = date("Y-m-d");
                    $temp['dse_order_id'] = "script-$today";
                    if ($temp['amount']) {
                        $returnArr[] = $temp;
                        echo "16=>" . $temp['amount'] . " $instrumentCode ADDED (as immature) to $bo_irn <br />";
                    }

                }

                elseif ($saleAbleShares > $freeQty) // we have some share in the portfolio that have inputed by mistake
                {
                    // @todo treatment needed to remove share

                    //removing excess of mature share

                    $allowedQty =$saleAbleShares-$freeQty ;

                    $temp = array();
                    $temp['portfolio_id'] = $pid;
                    $temp['instrument_id'] = $instrumentId;
                    $temp['transaction_type_id'] = 2;  // SELL as REMOVE share
                    $temp['amount'] = $allowedQty;
                    $temp['rate'] = $avgCost;
                    $new_transaction_time =  date("Y-m-d H:i:s", strtotime("-30 days")); // setting today .So it will be shown as immature
                    $temp['transaction_time'] = $new_transaction_time;
                    $temp['commission'] = $broker_fee;
                    $today = date("Y-m-d");
                    $temp['dse_order_id'] = "script-$today";
                    if ($temp['amount']) {
                        $returnArr[] = $temp;
                        echo "17=>" . $temp['amount'] . " $instrumentCode REMOVED (as mature) from $bo_irn <br />";
                    }


                    //adding shortage of immature share

                    $allowedLockQty=($totalQty-$freeQty)-($existingPortfolioQty-$saleAbleShares);

                    $temp = array();
                    $temp['portfolio_id'] = $pid;
                    $temp['instrument_id'] = $instrumentId;
                    $temp['transaction_type_id'] = 1;  // buy as adding share
                    $temp['amount'] = $allowedLockQty; // taking all remaining quantity
                    $temp['rate'] = $avgCost;
                    // $new_transaction_time = date("Y-m-d H:i:s"); // setting today .So it will be shown as immature
                    $temp['transaction_time'] = $transaction_time_immature;
                    $temp['commission'] = $broker_fee;
                    $today = date("Y-m-d");
                    $temp['dse_order_id'] = "script-$today";

                    if ($temp['amount']) {
                        $returnArr[] = $temp;
                        echo "18=>" . $temp['amount'] . " $instrumentCode ADDED (as immature) to $bo_irn <br />";
                    }

                }

            }
        }

        return $returnArr;

    }
//////////////////////////////////////////////////////////////for commerce broker house END////////////////////////////////////////////////////////////////////


/////////////////////////////////////////////////////////////for FIS broker house//////////////////////////////////////////////////////////////////////////

public function omo_user_import($start=0,$limit=200)
{
    Configure::write('debug', 2);

    //$q = "select * from omo_user where `active` = '1' limit 0,10";
    $q = "select * from omo_user where `active` = '1' ORDER BY `omo_user`.`id` ASC limit $start,$limit";
    $db = ConnectionManager::getDataSource('default');
    $result = $db->query($q);
/*pr($result);
    exit;*/

    App::uses('User', 'Model');
    $User = new User();
    $dataToSave = array();
    $dataToSave2 = array();





    foreach ($result as $row) {

        $temp = array();
        $temp['username'] = $row['omo_user']['user_name'];

        $u= $row['omo_user']['user_name'];

        $q = "select * from users where username LIKE '$u'";
        $userExist = $db->query($q);

        if(!empty($userExist))
        {
            //pr($row['omo_user']['user_name'] . ' ' . $row['omo_user']['temp_int_ref_id'] . ' ' . $row['omo_user']['email'] . ' username already exist');
            $row['omo_user']['user_name']= $row['omo_user']['user_name'].'_fis';
        }


        $temp['email'] = $row['omo_user']['email'];
        $temp['bo_id'] = $row['omo_user']['bo_account_no'];
        $temp['password'] = '1473e271d3f64aacffa70494ec7b390a5698f533';
        $temp['internal_ref_no'] = $row['omo_user']['temp_int_ref_id'];
        $temp['broker_id'] = 9;
        $temp['portfolio_id'] = 0;
        $temp['broker_fee'] = 0.5;
        $temp['active'] = 1;
        $temp['address'] = $row['omo_user']['address'];
        $temp['first_name'] = $row['omo_user']['full_name'];
        $temp['mobile_no'] = $row['omo_user']['mob'];
        $temp['group_id'] = 4;
        $User->create();
        $User->save($temp);

        $pid = $User->getLastInsertId();
        $temp['id']= $pid;
        $temp['portfolio_id']= $pid;
        $dataToSave[]= $temp;
        $User->save($temp);

        $data=array();

        $Portfolio = new Portfolio();
        $data['id'] = $pid;
        $data['portfolio_name'] = 'Default';
        $data['broker_fee'] = 0.5;
        $data['broker'] = 9;

        $dataToSave2[]= $data;
        $Portfolio->create();
        $Portfolio->save($data);

        pr($pid);
//exit;
    }

    /*if (!empty($dataToSave)) {

        $User->saveMany($dataToSave, array('atomic' => true));

    }
    if (!empty($dataToSave2)) {

        $Portfolio->saveMany($dataToSave2, array('atomic' => true));

    }*/


    //pr($result);
    exit;
}
    public function portfolio_update_fis($userPerSlot = 15)
    {
        Configure::write('debug', 2);
        $brokerId = Configure::read('broker.fis.id');
        $StockBangladesh = $this->Components->load('StockBangladesh');
        $instrumentList=$StockBangladesh->instrumentList(2);

        $Omo = $this->Components->load('Omo');
        $userList = $Omo->getUsersList(4, 1);
        $fisUsers = array();
        foreach ($userList[$brokerId] as $irn => $arr) {
            $key = trim($irn);
            $key = str_pad($key, 6, "0", STR_PAD_LEFT);
            $key = strtoupper($key);
            $fisUsers[$key] = $arr;
        }
//pr($fisUsers);
        $xmlArray = Xml::toArray(Xml::build('fis/portfolio/20171024-164301-Positions-FIC.xml'));
        $dataToSave=array();

        //$userData = Hash::extract($xmlArray['Positions']['InsertOne'], '{n}.ClientCode');
        $holdings = Hash::combine($xmlArray['Positions']['InsertOne'], '{n}.SecurityCode', '{n}', '{n}.ClientCode');

        foreach($fisUsers as $clientCode=>$user)
        {
            if(isset($holdings[$clientCode]))
            {
                foreach($holdings[$clientCode] as $code=>$details)
                {
                    $temp = array();
                    $temp['portfolio_id'] = $user['portfolio_id'];
                    $temp['instrument_id'] = $instrumentList[trim($code)];
                    $temp['transaction_type_id'] = 1;  // buy as adding share

                    $temp['rate'] = round($details['TotalCost']/$details['Quantity'],2);
                    $transaction_time_mature = date("Y-m-d H:i:s", strtotime("-30 days"));
                    $temp['transaction_time'] = $transaction_time_mature;
                    $temp['commission'] = 0.5;
                    $today = date("Y-m-d");
                    $temp['dse_order_id'] = "script-$today";
                    $temp['amount'] = $details['Quantity'];

                    $dataToSave[] = $temp;
                }


            }
            else
            {
                pr($clientCode.' has no holdings');
            }
        }


        $model = ClassRegistry::init('PortfolioTransaction');

            $model->saveMany($dataToSave, array('atomic' => true));
            $rep = count($dataToSave) . ' NEW ROW INSERTED';
        echo $rep;
        exit;

    }

/////////////////////////////////////////////////////////////for FIS broker house END//////////////////////////////////////////////////////////////////////////


}