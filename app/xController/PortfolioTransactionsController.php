<?php
App::uses('AppController', 'Controller');
/**
 * PortfolioTransactions Controller
 *
 * @property PortfolioTransaction $PortfolioTransaction
 * @property PaginatorComponent $Paginator
 */
class PortfolioTransactionsController extends AppController
{

    /**
     * Components
     *
     * @var array
     */
    public $components = array('Paginator');

    public function beforeFilter()
    {
        parent::beforeFilter();

        //$this->Auth->allow('test');
        $this->Auth->allow();

    }

    public function sell()
    {

        $allTransactions = $this->PortfolioTransaction->Portfolio->find('all', array(
                'conditions' => "Portfolio.user_id=2"
                //                ,'recursive' => 2
            )

        );


        $Portfolio = $this->Components->load('Portfolio');

        $this->ttypeArr = $Portfolio->getTransactionType();
        $balance = $Portfolio->getPortfolioBalance($allTransactions, $this->ttypeArr);
        $portfolioHoldingsTransaction = $Portfolio->getPortfolioHoldings($allTransactions, $this->ttypeArr);

        $portfolioCommission = $allTransactions[0]['Portfolio']['broker_fee'];

        //  pr($portfolioHoldingsTransaction);


        $dataToSave = array();

        $postArr = array();
        $postArr['portfolio_id'] = $this->request->data('pid');
        $postArr['instrument_id'] = $this->request->data('instrumentId');
        $postArr['transaction_type_id'] = 2;
        $postArr['amount'] = $this->request->data('amount');
        $postArr['rate'] = $this->request->data('rate');
        $postArr['transaction_time'] = $this->request->data('transaction_time');
        $postArr['commission'] = $this->request->data('commission');
        $postArr['parent_id'] = $tid = $this->request->data('tid');
        $dataToSave[] = $postArr;

        $error = $Portfolio->sellValidate($portfolioHoldingsTransaction, $postArr);


        if (!$error) {
            $this->PortfolioTransaction->saveMany($dataToSave, array('atomic' => true));
            echo "Share sold successfully";
        } else {
            echo $error;
        }

        /* $tid= $this->request->data('tid');

         $oldRow=$this->PortfolioTransaction->findById($tid,array(
             'recursive' => 0
         ));

         $data = array('id' => $tid
         , 'amount' =>  $oldRow['PortfolioTransaction']['amount']-$this->request->data('amount')
         );

         $this->PortfolioTransaction->save($data);*/


        exit;
    }

    public function add_row()
    {
        $StockBangladesh = $this->Components->load('StockBangladesh');


        $instrumentList = $StockBangladesh->instrumentList(2);

        $allTransactions = $this->PortfolioTransaction->Portfolio->find('all', array(
                'conditions' => "Portfolio.user_id=2"
//                ,'recursive' => 2
            )

        );


        $Portfolio = $this->Components->load('Portfolio');

        $this->ttypeArr = $Portfolio->getTransactionType();
        $balance = $Portfolio->getPortfolioBalance($allTransactions, $this->ttypeArr);
        //$portfolioHoldingsTransaction=$Portfolio->getPortfolioHoldings($allTransactions,$this->ttypeArr);

        $portfolioCommission = $allTransactions[0]['Portfolio']['broker_fee'];


        $dataToSave = array();

        $postArr = array();

        $postArr['portfolio_id'] = $this->request->data('pid');
        $instrumentCode = trim($this->request->data('instrumentId'));
        $postArr['instrument_id'] = $instrumentList[$instrumentCode];
        $postArr['transaction_type_id'] = 1;
        $postArr['amount'] = $this->request->data('amount');
        $postArr['rate'] = $this->request->data('rate');
        $postArr['transaction_time'] = $this->request->data('transaction_time');
        $postArr['commission'] = $this->request->data('commission');
        $dataToSave[] = $postArr;

        $purchaseAmount = $postArr['amount'] * $postArr['rate'];

//print_r($postArr);

            $instrumentId=$instrumentList[$instrumentCode];
        if ($balance > $purchaseAmount) {
            $this->PortfolioTransaction->saveMany($dataToSave, array('atomic' => true));
            $tid=$this->PortfolioTransaction->getLastInsertId();
            echo "Share bought successfully :$tid:$instrumentId";
            //echo $tid;
        } else {
            echo "You dont have sufficient balance. You have $balance Taka but you need $purchaseAmount";
        }


        exit;
    }

    public function edit_row()
    {

        $dataToSave = array();

        $postArr = array();
        $postArr['portfolio_id'] = $this->request->data('pid');
        $postArr['instrument_id'] = $this->request->data('instrumentId');
        $postArr['transaction_type_id'] = 8;
        $postArr['amount'] = $this->request->data('amount');
        $postArr['rate'] = $this->request->data('rate');
        $postArr['transaction_time'] = $this->request->data('transaction_time');
        $postArr['commission'] = $this->request->data('commission'); // if commission edited to 0 it will
        $postArr['parent_id'] = $tid = $this->request->data('tid');
        $dataToSave[] = $postArr;

        $initialRate = $this->request->data('initialRate');
        $editedRate = $this->request->data('rate');
        $initialQuantity = $this->request->data('initialQuantity');
        $editedQuantity = $this->request->data('amount');

        $qtyChange = $editedQuantity - $initialQuantity;
        $rateChange = $editedRate - $initialRate;

        $balanceAdjustment1 = -1 * $qtyChange * $this->request->data('rate');
        $commissionAdjustment1 = (($this->request->data('commission')) / 100) * $balanceAdjustment1;

        /* if ($qtyChange < 0)
             $transaction_type_id = 10;
         else
             $transaction_type_id = 11;*/
        /*
                $postArr = array();
                $postArr['portfolio_id'] = $this->request->data('pid');
                //$postArr['instrument_id'] = $this->request->data('instrumentId');
                $postArr['transaction_type_id'] = $transaction_type_id;
                $postArr['amount'] = 1;
                $postArr['rate'] = $balanceAdjustment1 + $commissionAdjustment1;
                //$postArr['transaction_time'] = $this->request->data('transaction_time');
                //$postArr['commission'] = $this->request->data('commission');
                $postArr['parent_id'] = $tid = $this->request->data('tid');
                $dataToSave[] = $postArr;*/

        /* if ($rateChange < 0)
             $transaction_type_id = 10;
         if ($rateChange > 0)
             $transaction_type_id = 11;*/

        $balanceAdjustment2 = $initialQuantity * $rateChange * (-1);
        $commissionAdjustment2 = (($this->request->data('commission')) / 100) * $balanceAdjustment2;

        $totalAdjustment = $balanceAdjustment1 + $commissionAdjustment1 + $balanceAdjustment2 + $commissionAdjustment2;

        /* $totalAdjustment=$balanceAdjustment1+ $balanceAdjustment2 ;
         $commissionAdjustment = (($this->request->data('commission')) / 100) * $totalAdjustment;
         $totalAdjustment=$totalAdjustment+$commissionAdjustment;*/

        if ($totalAdjustment < 0)
            $transaction_type_id = 11;
        else
            $transaction_type_id = 10;

        $postArr = array();
        $postArr['portfolio_id'] = $this->request->data('pid');
        //$postArr['instrument_id'] = $this->request->data('instrumentId');
        $postArr['transaction_type_id'] = $transaction_type_id;
        $postArr['amount'] = 1;
        $postArr['rate'] = abs($totalAdjustment);
        //$postArr['transaction_time'] = $this->request->data('transaction_time');
        //$postArr['commission'] = $this->request->data('commission');
        $postArr['parent_id'] = $tid = $this->request->data('tid');
        $dataToSave[] = $postArr;

        $this->PortfolioTransaction->saveMany($dataToSave, array('atomic' => true));


        /*  $oldRow=$this->PortfolioTransaction->findById($tid,array(
              'recursive' => 0
          ));
         // exit;

          $data = array('id' => $tid
          , 'amount' =>  $oldRow['PortfolioTransaction']['amount']+$this->request->data('amount')
          , 'rate' => $this->request->data('rate')
          , 'commission' => $this->request->data('commission')
          , 'transaction_time' => $this->request->data('transaction_time')

          );*/

        //print_r($data);
        echo "Edited successfully. Your portfolio balance adjusted by $totalAdjustment Tk.";
        exit;
    }

    public function edit_row2()
    {

        /*   $dataToSave = array();

           $postArr = array();
           $postArr['portfolio_id'] = $this->request->data('pid');
           $postArr['instrument_id'] = $this->request->data('instrumentId');
           $postArr['transaction_type_id'] = 1;
           $postArr['amount'] = $this->request->data('amount');
           $postArr['rate'] = $this->request->data('rate');
           $postArr['transaction_time'] = $this->request->data('transaction_time');
           $postArr['commission'] = $this->request->data('commission');
           $dataToSave[] = $postArr;
   */
        $tid = $this->request->data('tid');

        $oldRow = $this->PortfolioTransaction->findById($tid, array(
            'recursive' => 0
        ));
        // exit;

        $data = array('id' => $tid
        , 'amount' => $oldRow['PortfolioTransaction']['amount'] + $this->request->data('amount')
        , 'rate' => $this->request->data('rate')
        , 'commission' => $this->request->data('commission')
        , 'transaction_time' => $this->request->data('transaction_time')

        );

        $this->PortfolioTransaction->save($data);

        //print_r($data);
        echo "Edited successfully";
        exit;
    }

    public function delete_row()
    {

        $dataToSave = array();

        $postArr=array();

        $postArr['portfolio_id'] = $this->request->data('pid');
        $postArr['instrument_id'] = $this->request->data('instrumentId');
        $postArr['transaction_type_id'] = 9;
        $postArr['amount'] = $this->request->data('amount');
        $postArr['rate'] = $this->request->data('rate');
        $postArr['transaction_time'] = $this->request->data('transaction_time');
        $postArr['commission'] = $this->request->data('commission');
        $postArr['parent_id'] = $tid = $this->request->data('tid');

        $dataToSave[] = $postArr;

        $postArr=array();

        $balanceAdjustment = $this->request->data('amount') * $this->request->data('rate');
        $commissionAdjustment = (($this->request->data('commission')) / 100) * $balanceAdjustment;
        $totalAdjustment=$balanceAdjustment+$commissionAdjustment;


        $postArr['portfolio_id'] = $this->request->data('pid');
        $postArr['instrument_id'] = $this->request->data('instrumentId');
        $postArr['transaction_type_id'] = 10;
        $postArr['amount'] = 1;
        $postArr['rate'] = $totalAdjustment;
      //  $postArr['transaction_time'] = $this->request->data('transaction_time');
      //  $postArr['commission'] = $this->request->data('commission');
        $postArr['parent_id'] = $tid = $this->request->data('tid');

        $dataToSave[] = $postArr;

        $this->PortfolioTransaction->saveMany($dataToSave, array('atomic' => true));

        echo "Removed successfully. Your portfolio balance adjusted by $totalAdjustment Tk.";
        exit;
    }

    public function delete_row2()
    {

        /*   $dataToSave = array();

           $postArr = array();
           $postArr['portfolio_id'] = $this->request->data('pid');
           $postArr['instrument_id'] = $this->request->data('instrumentId');
           $postArr['transaction_type_id'] = 1;
           $postArr['amount'] = $this->request->data('amount');
           $postArr['rate'] = $this->request->data('rate');
           $postArr['transaction_time'] = $this->request->data('transaction_time');
           $postArr['commission'] = $this->request->data('commission');
           $dataToSave[] = $postArr;
   */
        $tid = $this->request->data('tid');

        $oldRow = $this->PortfolioTransaction->findById($tid, array(
            'recursive' => 0
        ));
        // exit;

        $data = array('id' => $tid
        , 'amount' => $oldRow['PortfolioTransaction']['amount'] - $this->request->data('amount')

        );

        $this->PortfolioTransaction->save($data);

        echo "Removed successfully";
        exit;
    }

    /**
     * index method
     *
     * @return void
     */
    public function index()
    {

        pr($this->PortfolioTransaction->find('first', array(
            //'conditions' => "News.instrument_id=$instrumentId and News.is_active=1",
            'recursive' => 0
        )));
        exit;
    }

    /**
     * view method
     *
     * @throws NotFoundException
     * @param string $id
     * @return void
     */
    public function view($id = null)
    {
        if (!$this->PortfolioTransaction->exists($id)) {
            throw new NotFoundException(__('Invalid portfolio transaction'));
        }
        $options = array('conditions' => array('PortfolioTransaction.' . $this->PortfolioTransaction->primaryKey => $id));
        $this->set('portfolioTransaction', $this->PortfolioTransaction->find('first', $options));
    }

    /**
     * add method
     *
     * @return void
     */
    public function add()
    {
        if ($this->request->is('post')) {
            $this->PortfolioTransaction->create();
            if ($this->PortfolioTransaction->save($this->request->data)) {
                $this->Session->setFlash(__('The portfolio transaction has been saved.'));
                return $this->redirect(array('action' => 'index'));
            } else {
                $this->Session->setFlash(__('The portfolio transaction could not be saved. Please, try again.'));
            }
        }
        $portfolios = $this->PortfolioTransaction->Portfolio->find('list');
        $instruments = $this->PortfolioTransaction->Instrument->find('list');
        $transactionTypes = $this->PortfolioTransaction->TransactionType->find('list');
        $this->set(compact('portfolios', 'instruments', 'transactionTypes'));
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
        if (!$this->PortfolioTransaction->exists($id)) {
            throw new NotFoundException(__('Invalid portfolio transaction'));
        }
        if ($this->request->is(array('post', 'put'))) {
            if ($this->PortfolioTransaction->save($this->request->data)) {
                $this->Session->setFlash(__('The portfolio transaction has been saved.'));
                return $this->redirect(array('action' => 'index'));
            } else {
                $this->Session->setFlash(__('The portfolio transaction could not be saved. Please, try again.'));
            }
        } else {
            $options = array('conditions' => array('PortfolioTransaction.' . $this->PortfolioTransaction->primaryKey => $id));
            $this->request->data = $this->PortfolioTransaction->find('first', $options);
        }
        $portfolios = $this->PortfolioTransaction->Portfolio->find('list');
        $instruments = $this->PortfolioTransaction->Instrument->find('list');
        $transactionTypes = $this->PortfolioTransaction->TransactionType->find('list');
        $this->set(compact('portfolios', 'instruments', 'transactionTypes'));
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
        $this->PortfolioTransaction->id = $id;
        if (!$this->PortfolioTransaction->exists()) {
            throw new NotFoundException(__('Invalid portfolio transaction'));
        }
        $this->request->allowMethod('post', 'delete');
        if ($this->PortfolioTransaction->delete()) {
            $this->Session->setFlash(__('The portfolio transaction has been deleted.'));
        } else {
            $this->Session->setFlash(__('The portfolio transaction could not be deleted. Please, try again.'));
        }
        return $this->redirect(array('action' => 'index'));
    }
}
