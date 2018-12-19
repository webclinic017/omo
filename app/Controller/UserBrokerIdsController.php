<?php
    App::uses('AppController', 'Controller');
    /**
     * Users Controller
     *
     * @property User $User
     */
    class UserBrokerIdsController extends AppController
    {
		public function beforeFilter()
		{
			parent::beforeFilter();

			$this->Auth->allow();

		}
    	public function user_broker_id()
    	{
			Configure::write('debug', 2);

    		$portfolioModel = ClassRegistry::init('Portfolio');

    		//,'fields'=>array('broker_name','id'),'recursive' => -1)

        	$portfoli = $portfolioModel->find('all', array("conditions"=>array('Portfolio.broker'=>'')));

            $portfoliId=array();

        	foreach ($portfoli as $portfoliBroker) 
            {
              $portfoliId[$portfoliBroker['Portfolio']['id']]=$portfoliBroker['Portfolio']['id'];
            }


            foreach ($portfoliId as $portfoliIdV) 
            {
            	 $userModel = ClassRegistry::init('User');
            	 $userI = $userModel->find('all', array("conditions"=>array('User.portfolio_id'=>$portfoliIdV), 'recursive'=>-1));	

            	 pr($userI);

            	 if($userI)
            	 {
            	 	echo "YEs" . $portfoliIdV;
            	 }
            	 else
            	 {
            	 	echo "No" . $portfoliIdV;
            	 }

            }

            /*echo "<pre>";
            pr($portfoliId);
            echo "</pre>";

            $userModel = ClassRegistry::init('User');

            $userI = $userModel->find('all', array("conditions"=>array('User.portfolio_id'=>21), 'recursive'=>-1));

            pr($userI);*/

            /*$usesID=array();

            foreach ($user as $userId) 
            {
              $usesID[$userId['User']['id']]=$userId['User']['broker_id'];
            }
            echo "<pre>";
            pr($usesID);
            echo "</pre>";
           // $i=0;

            foreach ($usesID as $key => $uses_brokerID) 
            {
                $portfoliID=$key;

                $brokerID=$uses_brokerID;

                $updateuserBrokerID['id']=$portfoliID;

                $updateuserBrokerID['broker']=$brokerID;

                pr($updateuserBrokerID);

               //$portfolioModel = ClassRegistry::init('Portfolio');

                //$save=$portfolioModel->save($updateuserBrokerID);

            }*/

			exit;
    	}

		public function portfoli_transactionn_id_delete()
		{
			Configure::write('debug', 2);

			$portfolioModel = ClassRegistry::init('Portfolio');

			$portfoli = $portfolioModel->find('all', array("conditions"=>array('Portfolio.broker'=>5)));

			$portfoliId=array();

			foreach ($portfoli as $portfoliBroker)
			{
				$portfoliId[$portfoliBroker['Portfolio']['id']]=$portfoliBroker['Portfolio']['id'];
			}

			//pr($portfoliId);

			$porfolio_transaction_Model = ClassRegistry::init('PortfolioTransaction');

			$porfolio_transaction = $porfolio_transaction_Model->find('all', array('conditions'=>array('PortfolioTransaction.portfolio_id'=>$portfoliId),'recursive'=>-1));

			//pr($result);

			$transactionIdDelete=array();

			foreach ($porfolio_transaction as $porfolio_transaction_value)
			{
				$transactionIdDelete[$porfolio_transaction_value['PortfolioTransaction']['id']] = $porfolio_transaction_value['PortfolioTransaction']['portfolio_id'];
			}


			//pr($transactionIdDelete);

			$transactions_id_delete=array();

			foreach ($transactionIdDelete as $key => $transactionIdDelete_value)
			{
				$deleteID = $key;


				$deletePortfolioId = $transactionIdDelete_value;

				$transactions_id_delete['id']=$deleteID;

				$transactions_id_delete['portfolio_id']=$deletePortfolioId;
				$porfolio_transaction_Model->delete($transactions_id_delete);

			}

			/*$portfolio_id_delete=array();

               foreach ($portfoliId as $portfoliIdvalue)
               {
                   $delete_portfolio_id=$portfoliIdvalue;

                   $portfolio_id_delete['id']=$delete_portfolio_id;

                   //pr($portfolio_id_delete);
                $portfolioModel->delete($portfolio_id_delete);

               }*/

			exit;
		}
		public function portfoli_transactionn_datechange()
		{
			Configure::write('debug', 2);

			$portfolioModel = ClassRegistry::init('Portfolio');

			$porfolio_transaction_Model = ClassRegistry::init('PortfolioTransaction');

			$sen="script-2015-04-26";
			$trans_time=date("Y-m-d", strtotime("-1 days"));

			pr($trans_time);

			$porfolio_transaction = $porfolio_transaction_Model->find('all', array('conditions'=>array('PortfolioTransaction.transaction_time LIKE'=>"%".$trans_time."%",'PortfolioTransaction.dse_order_id'=>$sen),'recursive'=>-1));


			foreach ($porfolio_transaction as $key => $trans)
			{

				$updateuserBrokerID['id']=$trans['PortfolioTransaction']['id'];

				$updateuserBrokerID['transaction_time']=date("Y-m-d", strtotime("-5 days"));

				pr($updateuserBrokerID);


				if($porfolio_transaction_Model->save($updateuserBrokerID))
				{

					echo"update ".$updateuserBrokerID['transaction_time']."successfull to" .$updateuserBrokerID['id']."";

					
				}

			}






			exit;
		}
    }

