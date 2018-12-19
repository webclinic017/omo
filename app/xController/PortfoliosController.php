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
    public $ttypeArr=array();

    public function beforeFilter()
    {
        parent::beforeFilter();

        //$this->Auth->allow('test');
        $this->Auth->allow();

    }
    function noop($array) {
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
     //   Configure::write('debug', 2);
        $this->layout = 'ajax';
        $this->Portfolio->contain('PortfolioTransaction');
        $allTransactions = $this->Portfolio->find('all',array(
                'conditions' => "Portfolio.user_id=2"
//                ,'recursive' => 2
            )

        );

        $portfolioInfo=$allTransactions[0];
        $Portfolio = $this->Components->load('Portfolio');

        $this->ttypeArr=$Portfolio->getTransactionType();
        $balance=$Portfolio->getPortfolioBalance($allTransactions,$this->ttypeArr);
        $portfolioHoldingsTransaction=$Portfolio->getPortfolioHoldings($allTransactions,$this->ttypeArr);
        $StockBangladesh = $this->Components->load('StockBangladesh');
        $instrumentInfo=$StockBangladesh->instrumentInfo();
        $portfolioCommission=$allTransactions[0]['Portfolio']['broker_fee'];

        $this->set('instrumentList', json_encode($StockBangladesh->instrumentList(3)));

        $temp=array();
        $temp['ABBANK']['ltp']=19;
        $temp['ABBANK']['high']=25;
        $temp['ABBANK']['low']=10;

        $temp['Trident']['ltp']=100;
        $temp['Trident']['high']=200;
        $temp['Trident']['low']=555;


        $temp=json_encode($temp);



        $this->set("temp",$temp);
        $this->set("balance",$balance);
        $this->set("portfolioHoldingsTransaction",$portfolioHoldingsTransaction);
        $this->set("instrumentInfo",$instrumentInfo);
        $this->set("portfolioCommission",$portfolioCommission);
        $this->set("portfolioInfo",$portfolioInfo);

//pr($portfolioHoldingsTransaction);
//pr($instrumentInfo);
//        exit;


//pr($portfolioHoldingsTransaction);

//pr($balance);

      //  exit;
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

    public function admin()
    {
        //  Configure::write('debug', 2);
        //$this->layout = 'ajax';

        require_once(APP . 'webroot' . DS . 'xcrud' . DS . 'xcrud.php');
        $xcrud = Xcrud::get_instance();
        $xcrud->table('portfolio_transactions');
        $this->set('xcrud',$xcrud);

    }

    public function performance()
    {
        $this->layout = 'ajax';

        if($this->Auth->user('id')) {
            $id = $this->Auth->user('id');
        }

            $id=2;  // for development testing only

        $this->Portfolio->contain('PortfolioTransaction');
        $allTransactions = $this->Portfolio->find('all',array(
                'conditions' => "Portfolio.user_id=$id"
            )

        );
        $portfolioInfo=$allTransactions[0];
        $Portfolio = $this->Components->load('Portfolio');

        $this->ttypeArr=$Portfolio->getTransactionType();
        $balance=$Portfolio->getPortfolioBalance($allTransactions,$this->ttypeArr);
        $portfolioHoldingsTransaction=$Portfolio->getPortfolioHoldings($allTransactions,$this->ttypeArr);

        $StockBangladesh = $this->Components->load('StockBangladesh');
        $instrumentInfo=$StockBangladesh->instrumentInfo();
        $portfolioCommission=$allTransactions[0]['Portfolio']['broker_fee'];

        $this->set('instrumentList', json_encode($StockBangladesh->instrumentList(3)));


        $this->set("balance",$balance);
        $this->set("portfolioHoldingsTransaction",$portfolioHoldingsTransaction);
        $this->set("instrumentInfo",$instrumentInfo);
        $this->set("portfolioCommission",$portfolioCommission);
        $this->set("portfolioInfo",$portfolioInfo);
    }
    public function edit_portfolio()
    {
       // $this->layout = 'ajax';
        $this->Portfolio->contain('PortfolioTransaction');
        $allTransactions = $this->Portfolio->find('all',array(
                'conditions' => "Portfolio.user_id=2"
            )

        );

        $portfolioInfo=$allTransactions[0];

        $Portfolio = $this->Components->load('Portfolio');

        $this->ttypeArr=$Portfolio->getTransactionType();
        $balance=$Portfolio->getPortfolioBalance($allTransactions,$this->ttypeArr);
        $portfolioHoldingsTransaction=$Portfolio->getPortfolioHoldings($allTransactions,$this->ttypeArr);

        $StockBangladesh = $this->Components->load('StockBangladesh');
        $instrumentInfo=$StockBangladesh->instrumentInfo();
        $portfolioCommission=$allTransactions[0]['Portfolio']['broker_fee'];

        $this->set('instrumentList', json_encode($StockBangladesh->instrumentList(3)));


        $this->set("balance",$balance);
        $this->set("portfolioHoldingsTransaction",$portfolioHoldingsTransaction);
        $this->set("instrumentInfo",$instrumentInfo);
        $this->set("portfolioCommission",$portfolioCommission);
        $this->set("portfolioInfo",$portfolioInfo);
    }

    public function realized_gain_loss()
    {
       // $this->layout = 'ajax';
        echo 'asdf';
/*
        $this->Portfolio->contain('PortfolioTransaction');
        $allTransactions = $this->Portfolio->find('all',array(
                'conditions' => "Portfolio.user_id=2"
            )

        );
        $portfolioInfo=$allTransactions[0];
        $Portfolio = $this->Components->load('Portfolio');

        $this->ttypeArr=$Portfolio->getTransactionType();
        $balance=$Portfolio->getPortfolioBalance($allTransactions,$this->ttypeArr);
        $portfolioHoldingsTransaction=$Portfolio->getPortfolioHoldings($allTransactions,$this->ttypeArr);

        $StockBangladesh = $this->Components->load('StockBangladesh');
        $instrumentInfo=$StockBangladesh->instrumentInfo();
        $portfolioCommission=$allTransactions[0]['Portfolio']['broker_fee'];

        $this->set('instrumentList', json_encode($StockBangladesh->instrumentList(3)));


        $this->set("balance",$balance);
        $this->set("portfolioHoldingsTransaction",$portfolioHoldingsTransaction);
        $this->set("instrumentInfo",$instrumentInfo);
        $this->set("portfolioCommission",$portfolioCommission);
        $this->set("portfolioInfo",$portfolioInfo);*/


           // $offset     = 0;
          //  $rowLimit   = 15;
           // $pageNumber = 1;

        $this->Portfolio->contain('PortfolioTransaction');
        $allTransactions = $this->Portfolio->find('all',array( ) );
      //  $portfolioInfo=$allTransactions[0];
        $shareList = $this->Portfolio->find('all', array('conditions' => array('Portfolio.user_id=1 AND transaction_type_id=2')));
        echo'<pre>';
        print_r($shareList);
        exit;

        /*
            $portfolioId = $portfolioInfo['Portfolio']['id'];

            //calculating total gain/loss
            //$this->paginate = array('limit' => 25);
        $allTransactions = $this->Portfolio->find('all',array( ) );
        $portfolioInfo=$allTransactions[0]; //pr($shareList);

            $totalShare = count($shareList);
            $this->set('total_share', $totalShare);
            $this->set('portfolio_id', $portfolioId);

            $gainLossTotal = 0;
            if (count($portfolioInfo)) {
                foreach ($portfolioInfo as $share) {

                    $userCommission = $share['portfolioInfo']['commission'];

                    $brokerSellCharge = 0;
                    $brokerBuyCharge  = 0;

                    // calculate commission for each share
                    if(($userCommission=="0") || ($userCommission=="0.0")) {
                        $brokerSellCharge = 0;
                        $brokerBuyCharge  = 0;
                    }
                    else {
                        $brokerSellCharge = ($userCommission/100) * $share['portfolioInfo']['sell_price'];
                        $brokerBuyCharge  = ($userCommission/100) * $share['portfolioInfo']['buying_price'];
                    }

                    $buyBrokerCommissionForSingleTrade  = $brokerBuyCharge  * $share['portfolioInfo']['amount'];
                    $sellBrokerCommissionForSingleTrade = $brokerSellCharge * $share['portfolioInfo']['amount'];

                    $sellPriceWithBrokerCommission = $share['portfolioInfo']['sell_price']   - $brokerSellCharge;
                    $buyPriceWithBrokerCommission  = $share['portfolioInfo']['buying_price'] + $brokerBuyCharge;

                    $gainLossForSingleTrade = (( $share['portfolioInfo']['sell_price'] - $share['portfolioInfo']['buying_price'] ) * $share['portfolioInfo']['no_of_shares']) - ( $sellBrokerCommissionForSingleTrade + $buyBrokerCommissionForSingleTrade );

                    $gainLossTotal += $gainLossForSingleTrade; // total gain loss based on single purchansed
                }
            }

            $this->set('gain_loss_total', $gainLossTotal);
            $this->set('row_limit', $rowLimit);
            $offset = $rowLimit - 2;
            $this->set('offset', $offset);
        echo '<pre>';
        print_r($portfolioInfo);
        exit;
/*
            $this->paginate = array('limit' => 15, 'order' => 'sell_date DESC');
            //$limitedShareList = $this->Pshare->find('all', array('conditions' => array('protfolio_id='.$portfolioId.' AND is_active=0'), 'order' => 'sell_date DESC', 'limit' => '0, 2'));

            $limitedShareList = $this->paginate('Pshare', array('protfolio_id='.$portfolioId.' AND is_active=0'));
            //pr($limitedShareList);

            $setLimitedShare = array();
            if(count($limitedShareList)) {

                $count = 0;
                foreach($limitedShareList as $share) {

                    $setLimitedShare[$count] = $share;

                    $symbolInfo = $this->Symbol->find('first', array('conditions' => array('id='.$share['Pshare']['symbol_id']), 'fields' => array('Symbol.id', 'Symbol.dse_code', 'Symbol.cse_code', 'Symbol.lasttradeprice', 'Symbol.name')));

                    if($share['Pshare']['market'] == 'CSE') {
                        $code = $symbolInfo['Symbol']['cse_code'];
                    } else {
                        $code = $symbolInfo['Symbol']['dse_code'];
                    }
                    $setLimitedShare[$count]['code'] = $code;
                    $setLimitedShare[$count]['id'] = $symbolInfo['Symbol']['id'];

                    $companyName = $symbolInfo['Symbol']['name'];
                    $setLimitedShare[$count]['companyName'] = $companyName;

                    $bdate = date('d/m/Y', $share['Pshare']['buying_date']); //buying date
                    $sdate = date('d/m/Y', $share['Pshare']['sell_date']);   //sell date
                    $setLimitedShare[$count]['bdate'] = $bdate;
                    $setLimitedShare[$count]['sdate'] = $sdate;

                    // calculate commission for each share
                    if(($share['Pshare']['commission']=="0") || ($share['Pshare']['commission']=="0.0")) {
                        $brokerSellCharge = 0;
                        $brokerBuyCharge  = 0;
                    } else {
                        $brokerSellCharge = ($share['Pshare']['commission']/100) * $share['Pshare']['sell_price'];
                        $brokerBuyCharge  = ($share['Pshare']['commission']/100) * $share['Pshare']['buying_price'];
                    }

                    $buyBrokerCommission  = $brokerBuyCharge  * $share['Pshare']['no_of_shares'];
                    $sellBrokerCommission = $brokerSellCharge * $share['Pshare']['no_of_shares'];

                    $setLimitedShare[$count]['buy_broker_commission']  = $buyBrokerCommission;
                    $setLimitedShare[$count]['sell_broker_commission'] = $sellBrokerCommission;

                    $sellPriceWithBrokerCommission = $share['Pshare']['sell_price']   - $brokerSellCharge;
                    $buyPriceWithBrokerCommission  = $share['Pshare']['buying_price'] + $brokerBuyCharge;

                    $setLimitedShare[$count]['sell_price_with_broker_commission']  = $sellPriceWithBrokerCommission;
                    $setLimitedShare[$count]['buy_price_with_broker_commission']   = $buyPriceWithBrokerCommission;


                    $gainLoss = (($share['Pshare']['sell_price'] - $share['Pshare']['buying_price']) * $share['Pshare']['no_of_shares'])-( $sellBrokerCommission + $buyBrokerCommission );
                    $setLimitedShare[$count]['gain_loss']  = $gainLoss;


                    $totalByPrice    = $buyPriceWithBrokerCommission * $share['Pshare']['no_of_shares'];

                    if($totalByPrice>0)
                        $totalByPricePer = ($gainLoss/$totalByPrice) * 100;

                    $setLimitedShare[$count]['total_by_price']     = $totalByPrice;
                    $setLimitedShare[$count]['total_by_price_per'] = $totalByPricePer;

                    $count++;
                }
            }

            $this->set('share_list', $setLimitedShare);

            //if(isset($this->params['named']['page']) && $this->params['named']['page'] != '')
//        $this->redirect(array( 'controller' => 'portfolios', 'action' => 'index/realize&portfolio='.$portfolioId.'&realizepage='.$this->params['named']['page'] ));
      */  }




}
