<?php
App::uses('AppController', 'Controller');
/**
 * CorporateActions Controller
 *
 * @property CorporateAction $CorporateAction
 * @property PaginatorComponent $Paginator
 */
class CorporateActionsController extends AppController {

/**
 * Components
 *
 * @var array
 */
	public $components = array('Paginator');

/**
 * index method
 *
 * @return void
 */
	public function index() {
		$this->CorporateAction->recursive = 0;
		$this->set('corporateActions', $this->Paginator->paginate());
	}

/**
 * view method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function view($id = null) {
		if (!$this->CorporateAction->exists($id)) {
			throw new NotFoundException(__('Invalid corporate action'));
		}
		$options = array('conditions' => array('CorporateAction.' . $this->CorporateAction->primaryKey => $id));
		$this->set('corporateAction', $this->CorporateAction->find('first', $options));
	}

/**
 * add method
 *
 * @return void
 */
	public function add() {
		if ($this->request->is('post')) {
			$this->CorporateAction->create();
			if ($this->CorporateAction->save($this->request->data)) {
				$this->Session->setFlash(__('The corporate action has been saved.'));
				return $this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The corporate action could not be saved. Please, try again.'));
			}
		}
		$instruments = $this->CorporateAction->Instrument->find('list');
		$this->set(compact('instruments'));
	}

/**
 * edit method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function edit($id = null) {
		if (!$this->CorporateAction->exists($id)) {
			throw new NotFoundException(__('Invalid corporate action'));
		}
		if ($this->request->is(array('post', 'put'))) {
			if ($this->CorporateAction->save($this->request->data)) {
				$this->Session->setFlash(__('The corporate action has been saved.'));
				return $this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The corporate action could not be saved. Please, try again.'));
			}
		} else {
			$options = array('conditions' => array('CorporateAction.' . $this->CorporateAction->primaryKey => $id));
			$this->request->data = $this->CorporateAction->find('first', $options);
		}
		$instruments = $this->CorporateAction->Instrument->find('list');
		$this->set(compact('instruments'));
	}

/**
 * delete method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function delete($id = null) {
		$this->CorporateAction->id = $id;
		if (!$this->CorporateAction->exists()) {
			throw new NotFoundException(__('Invalid corporate action'));
		}
		$this->request->allowMethod('post', 'delete');
		if ($this->CorporateAction->delete()) {
			$this->Session->setFlash(__('The corporate action has been deleted.'));
		} else {
			$this->Session->setFlash(__('The corporate action could not be deleted. Please, try again.'));
		}
		return $this->redirect(array('action' => 'index'));
	}

/**
 * admin_index method
 *
 * @return void
 */
	public function admin_index() {
		$this->CorporateAction->recursive = 0;
		$this->set('corporateActions', $this->Paginator->paginate());
	}

/**
 * admin_view method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function admin_view($id = null) {
		if (!$this->CorporateAction->exists($id)) {
			throw new NotFoundException(__('Invalid corporate action'));
		}
		$options = array('conditions' => array('CorporateAction.' . $this->CorporateAction->primaryKey => $id));
		$this->set('corporateAction', $this->CorporateAction->find('first', $options));
	}

/**
 * admin_add method
 *
 * @return void
 */
	public function admin_add() {
		if ($this->request->is('post')) {
			$this->CorporateAction->create();
			if ($this->CorporateAction->save($this->request->data)) {
				$this->Session->setFlash(__('The corporate action has been saved.'));
				return $this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The corporate action could not be saved. Please, try again.'));
			}
		}
		$instruments = $this->CorporateAction->Instrument->find('list');
		$this->set(compact('instruments'));
	}

/**
 * admin_edit method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function admin_edit($id = null) {
		if (!$this->CorporateAction->exists($id)) {
			throw new NotFoundException(__('Invalid corporate action'));
		}
		if ($this->request->is(array('post', 'put'))) {
			if ($this->CorporateAction->save($this->request->data)) {
				$this->Session->setFlash(__('The corporate action has been saved.'));
				return $this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The corporate action could not be saved. Please, try again.'));
			}
		} else {
			$options = array('conditions' => array('CorporateAction.' . $this->CorporateAction->primaryKey => $id));
			$this->request->data = $this->CorporateAction->find('first', $options);
		}
		$instruments = $this->CorporateAction->Instrument->find('list');
		$this->set(compact('instruments'));
	}

/**
 * admin_delete method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function admin_delete($id = null) {
		$this->CorporateAction->id = $id;
		if (!$this->CorporateAction->exists()) {
			throw new NotFoundException(__('Invalid corporate action'));
		}
		$this->request->allowMethod('post', 'delete');
		if ($this->CorporateAction->delete()) {
			$this->Session->setFlash(__('The corporate action has been deleted.'));
		} else {
			$this->Session->setFlash(__('The corporate action could not be deleted. Please, try again.'));
		}
		return $this->redirect(array('action' => 'index'));
	}

    public function create_adjustment_factor($instrumentId = 12) {

        $this->loadModel('DataBanksEod');

        $corPorateAction=$this->CorporateAction->find('all', array(
            'conditions' => "CorporateAction.instrument_id=$instrumentId and CorporateAction.active=1",
            'recursive' => 0,
            'order' => array('CorporateAction.id' => 'desc')
        ));

        // pr($corPorateAction);
        //exit;




        foreach ($corPorateAction as $actionRow)
        {
            $recordDate=$actionRow['CorporateAction']['record_date'];
            $action=$actionRow['CorporateAction']['action'];



            if($action=='stockdiv')
            {
                $adjustmentFactor=100/(100+$actionRow['CorporateAction']['value']);
                $this->DataBanksEod->updateAll(
                    array('DataBanksEod.adjustment_factor' => $adjustmentFactor),
                    array('DataBanksEod.date <' => $recordDate)
                );

            }
            elseif($action=='cashdiv')
            {

                $facevalue  = $actionRow['Instrument']['face_value'];

                $actualPay=$facevalue*$actionRow['CorporateAction']['value']/100;

                $day=$row['corporate_action']['date'];
                //$daystamp= strtotime($day)-24*60*60;
                $daystamp= strtotime($day);

                foreach ($resultarr as $data)
                {
                    if($data[0]['mydate']<$daystamp)
                    {
                        $data['outputs']['open']=$data['outputs']['open']-$adjustmentFactor;
                        $data['outputs']['high']=$data['outputs']['high']-$adjustmentFactor;
                        $data['outputs']['low']=$data['outputs']['low']-$adjustmentFactor;
                        $data['outputs']['close']=$data['outputs']['close']-$adjustmentFactor;
                    }

                    $adjustedArr[]=$data;
                }

                $resultarr=array();
                $resultarr=$adjustedArr;

            }
            elseif($action=='rightshare')
            {

                $symbolSQL = "SELECT face_value FROM symbols WHERE id=$ticker";

                $result = $this->Symbol->query($symbolSQL);

                $facevalue  = $result[0]['symbols']['face_value'];

                $adjustmentFactor=(100+$row['corporate_action']['value'])/100;
                $premium=$row['corporate_action']['premium'];

                $close_price_adjustment_factor=($premium+$facevalue)-(($premium+$facevalue)/$adjustmentFactor);


                $day=$row['corporate_action']['date'];
                //$daystamp= strtotime($day)-24*60*60;
                $daystamp= strtotime($day);

                foreach ($resultarr as $data)
                {
                    if($data[0]['mydate']<$daystamp)
                    {
                        $data['outputs']['open']=(($data['outputs']['open']*100)+(($premium+$facevalue)*$row['corporate_action']['value'])) / (100+$row['corporate_action']['value']);
                        $data['outputs']['high']=(($data['outputs']['high']*100)+(($premium+$facevalue)*$row['corporate_action']['value'])) / (100+$row['corporate_action']['value']);
                        $data['outputs']['low']=(($data['outputs']['low']*100)+(($premium+$facevalue)*$row['corporate_action']['value'])) / (100+$row['corporate_action']['value']);
                        $data['outputs']['close']=
                            (
                                ($data['outputs']['close']*100)
                                +(($premium+$facevalue)*$row['corporate_action']['value'])
                            )
                            / (100+$row['corporate_action']['value']);


                        /*$data['outputs']['open']=($data['outputs']['open']+$close_price_adjustment_factor)/$adjustmentFactor;
                        $data['outputs']['high']=($data['outputs']['high']+$close_price_adjustment_factor)/$adjustmentFactor;
                        $data['outputs']['low']=($data['outputs']['low']+$close_price_adjustment_factor)/$adjustmentFactor;
                        $data['outputs']['close']=($data['outputs']['close']+$close_price_adjustment_factor)/$adjustmentFactor;*/



                    }

                    $adjustedArr[]=$data;
                }

                $resultarr=array();
                $resultarr=$adjustedArr;

            }


            elseif ($action=='split')
            {
                $adjustmentFactor=$row['corporate_action']['value'];

                $day=$row['corporate_action']['date'];
                //$daystamp= strtotime($day)-24*60*60;
                $daystamp= strtotime($day);

                foreach ($resultarr as $data)
                {
                    if($data[0]['mydate']<$daystamp)
                    {
                        $data['outputs']['open']=$data['outputs']['open']/$adjustmentFactor;
                        $data['outputs']['high']=$data['outputs']['high']/$adjustmentFactor;
                        $data['outputs']['low']=$data['outputs']['low']/$adjustmentFactor;
                        $data['outputs']['close']=$data['outputs']['close']/$adjustmentFactor;
                        $data['outputs']['volume']=$data['outputs']['volume']*$adjustmentFactor;
                    }

                    $adjustedArr[]=$data;
                }
                $resultarr=array();
                $resultarr=$adjustedArr;

            }





        }

    }
}
