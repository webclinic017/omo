<?php

/*
 * command to run
 * C:\xampp\htdocs\stockbangladesh242\app>..\lib\Cake\Console\cake crons parse_mst
 * */

class CronsShell extends AppShell
{
    public $commission = 0;
    public $parentIdWiseTransaction = array();
    public $ttypeArr = array();
    public function main()
    {
        $this->out('Hello world.');
    }


    /*
 * $returnType=1 will return with group by broker_id and user_id as key of sub array
 * $returnType=2 will return without any group and user_id as key
 * $returnType=3 will return without any group and portfolio_id as key
 * $returnType=4 will return with group by broker_id and internal_ref_no as key of sub array
 *
 * */
    private function  _getUsersList($returnType=1)
    {
        //Configure::write('debug', 2);
        App::uses('User', 'Model');
        $User = new User();

        $userData = $User->find('all', array(
            //'conditions' => "User.active=1",
            'fields' => array('User.id', 'User.broker_id', 'User.portfolio_id', 'User.internal_ref_no', 'User.broker_fee', 'User.balance'),
            'recursive' => -1
        ));
        if($returnType==1)
            $userData=Hash::combine($userData, '{n}.User.id', '{n}.User', '{n}.User.broker_id');
        if($returnType==2)
            $userData=Hash::combine($userData, '{n}.User.id', '{n}.User');
        if($returnType==3)
            $userData=Hash::combine($userData, '{n}.User.portfolio_id', '{n}.User');
        if($returnType==4)
            $userData=Hash::combine($userData, '{n}.User.internal_ref_no', '{n}.User', '{n}.User.broker_id');
        //pr($userData);
        //exit;
        return $userData;
    }

    private function _getTransactionType()
    {
        App::uses('TransactionType', 'Model');
        $TransactionType = new TransactionType();

        $ttype = $TransactionType->find('all', array(

            'recursive' => -1
        ));

        return Hash::combine($ttype, '{n}.TransactionType.id', '{n}.TransactionType.multiplier');
    }

    private function _getPortfolioBalance($allTransactions, $ttypeArr = array(),$balance=0)
    {
        // Configure::write('debug', 2);
//pr($this->getPortfolioHoldings($allTransactions,$ttypeArr));
        $this->commission = $allTransactions[0]['Portfolio']['broker_fee'];


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
        return $balance;
    }

    /*
     * Update balance in user table every day after 5 pm  (at 1 am of the night)
     *
     * */

    public function updateBalance()
    {
       // Configure::write('debug', 3);
        $userList=$this->_getUsersList(3);
        App::uses('Portfolio', 'Model');
        $Portfolio = new Portfolio();
        $Portfolio->contain('PortfolioTransaction');
//pr($userList);

        $dataToSave=array();
        foreach($userList as $pid=>$userInfo) {
            $temp=array();
            $allTransactions = $Portfolio->find('all', array(
                    'conditions' => "Portfolio.id=$pid"
                )

            );
            //pr($allTransactions);
            $balance=0;
            if(!empty($allTransactions)) {
                $this->ttypeArr = $this->_getTransactionType();
                $balance = $this->_getPortfolioBalance($allTransactions, $this->ttypeArr);
                $balance=number_format($balance, 2, '.', '');
                $temp['id']=$userInfo['id'];
                $temp['balance']=$balance;
                $dataToSave[]=$temp;

            }


        }

        $User = ClassRegistry::init('User');
        if(count($dataToSave))
        {
            $User->saveMany($dataToSave, array('atomic' => true));
            //pr($dataToSave);
            echo count($dataToSave).' balanace updated';
        }

    }

    /*
     * Temporary function to make balance zero after importing for old system
     * */

    public function setBalanceZero()
    {
         Configure::write('debug', 3);
        App::uses('CakeEmail', 'Network/Email');
        $userList=$this->_getUsersList(3);
        App::uses('Portfolio', 'Model');
        $Portfolio = new Portfolio();
        $Portfolio->contain('PortfolioTransaction');

        $dataToSave=array();
        foreach($userList as $pid=>$userInfo) {
            $temp=array();
            $allTransactions = $Portfolio->find('all', array(
                    'conditions' => "Portfolio.id=$pid"
                )

            );
            //pr($allTransactions);
            $balance=0;
            if(!empty($allTransactions)) {
                $this->ttypeArr = $this->_getTransactionType();
                $balance = $this->_getPortfolioBalance($allTransactions, $this->ttypeArr);
                $balance=number_format($balance, 2, '.', '');
                $temp['portfolio_id']=$pid;
                $temp['transaction_type_id']=12;
                $temp['amount']=1;
                $temp['rate']=$balance*(-1);
                $temp['transaction_time']=date('Y-m-d H:i:s');

                if($temp['rate']>0)
                $dataToSave[]=$temp;

            }


        }
        $model = ClassRegistry::init('PortfolioTransaction');
        if(count($dataToSave))
        {
            $model->saveMany($dataToSave, array('atomic' => true));

            $lastId = $model->getLastInsertId();

            echo count($dataToSave)." balanace updated. lastId=$lastId";
            CakeEmail::deliver('info@stockbangladesh.com', "setBalanceZero cron completed:  lastid $lastId", "lastId was=$lastId", array('from' => 'omo@stockbangladesh.net'));
        }

    }


}