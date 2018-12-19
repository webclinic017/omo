<?php
App::uses('AppController', 'Controller');
/**
 * Fundamentals Controller
 *
 * @property Fundamental $Fundamental
 * @property PaginatorComponent $Paginator
 */
class FundamentalsController extends AppController {

/**
 * Components
 *
 * @var array
 */
    public $components = array('Paginator','DataTable','RequestHandler');
    public $helpers = array('StockBangladesh');
/**
 * index method
 *
 * @return void
 */
	public function index() {
        $StockBangladesh = $this->Components->load('StockBangladesh');
        $this->set('instrumentList', $StockBangladesh->instrumentList(1));
		/*$this->Fundamental->recursive = 0;
		$this->set('fundamentals', $this->Paginator->paginate());*/

       //$this->Fundamental->recursive = 0;
        /*$this->paginate = array(

            'fields' => array('Instrument.instrument_code','Fundamental.meta_value', 'Fundamental.meta_date'),
        );
        pr($this->Paginator->paginate());*/
        $this->set('fundamentalMetas', $this->Fundamental->FundamentalMeta->find('list'));
        if($this->RequestHandler->responseType() == 'json') {
            /*$this->paginate = array(
                //'fields' => array('Instrument.instrument_code','FundamentalMeta.meta_key','Fundamental.meta_value', 'Fundamental.meta_date'),
                'fields' => array('Instrument.instrument_code','Fundamental.meta_value', 'Fundamental.meta_date'),
            );*/

            $this->paginate = array(
                'fields' => array('Fundamental.id','Fundamental.meta_value', 'Fundamental.meta_date'),
                'link' => array(
                    'Instrument' => array(
                        'fields' => array('instrument_code')
                    ),
                    'FundamentalMeta' => array(
                        'fields' => array('meta_key')
                    )
                )
            );
            $this->DataTable->fields = array('Fundamental.id','Instrument.instrument_code','FundamentalMeta.meta_key','Fundamental.meta_value', 'Fundamental.meta_date');
            $this->DataTable->emptyElements = 1;
            /*$this->paginate  = array(
                'link' => array(
                    'Fundamental',
                    'Instrument',
                    'FundamentalMeta',
                    'order' => 'Fundamental.id DESC',
                    'group' => 'Fundamental.id'
                ),
                'fields' => array('Instrument.instrument_code','Fundamental.meta_value', 'Fundamental.meta_date')
            );*/


            //$this->DataTable->mDataProp = true;
            $this->set('response', $this->DataTable->getResponse());
            $this->set('_serialize','response');
        }
	}

/**
 * view method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function view($id = null) {
		if (!$this->Fundamental->exists($id)) {
			throw new NotFoundException(__('Invalid fundamental'));
		}
		$options = array('conditions' => array('Fundamental.' . $this->Fundamental->primaryKey => $id));
		$this->set('fundamental', $this->Fundamental->find('first', $options));
	}

/**
 * add method
 *
 * @return void
 */
	public function add() {
        $StockBangladesh = $this->Components->load('StockBangladesh');
        $instruments=$StockBangladesh->instrumentList(2);

        $instrument_code = $this->params['data']['instrument_code'];
        $meta_key = $this->params['data']['meta_key'];
        $meta_value = $this->params['data']['meta_value'];
        $meta_date = $this->params['data']['meta_date'];

      /*  $this->Fundamental->set('instrument_id', $instruments[trim($instrument_code)]);
        $this->Fundamental->set('meta_key', $meta_key);
        $this->Fundamental->set('meta_value', $meta_value);
        $this->Fundamental->set('meta_date', $meta_date);*/

        //$this->Fundamental->save();
        $newdata['Fundamental']['instrument_id']=$instruments[trim($instrument_code)];
        $newdata['Fundamental']['fundamental_meta_id']=$meta_key;
        $newdata['Fundamental']['meta_value']=$meta_value;
        $newdata['Fundamental']['meta_date']=date("Y-m-d",strtotime($meta_date));

        pr($newdata);



        if ($this->Fundamental->save($newdata)) {
            $this->Session->setFlash(__('The fundamental has been saved.'));
            echo 'The fundamental has been saved.';
           // return $this->redirect(array('action' => 'index'));
        } else {
            //$this->Session->setFlash(__('The fundamental could not be saved. Please, try again.'));
         //   __('The fundamental could not be saved. Please, try again.');
            echo 'The fundamental could not be saved. Please, try again.';
        }
//pr($data);
        exit;
		/*if ($this->request->is('post')) {
			$this->Fundamental->create();
			if ($this->Fundamental->save($this->request->data)) {
				$this->Session->setFlash(__('The fundamental has been saved.'));
				return $this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The fundamental could not be saved. Please, try again.'));
			}
		}
		$instruments = $this->Fundamental->Instrument->find('list');
		$fundamentalMetas = $this->Fundamental->FundamentalMeta->find('list');
		$this->set(compact('instruments', 'fundamentalMetas'));*/
	}

/**
 * edit method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function edit($id = null) {
        $id = $this->params['data']['id'];
        $columnName = $this->params['data']['columnName'];
        $value = $this->params['data']['value'];

        $this->Fundamental->set('id', $id);
        $this->Fundamental->set($columnName, $value);

        //$this->Fundamental->set('meta_date', $meta_date);


        if ($this->request->is(array('post', 'put'))) {
            if ($this->Fundamental->save($this->request->data)) {
               // $this->Session->setFlash(__('The fundamental has been saved.'));
                //return $this->redirect(array('action' => 'index'));
                echo "The fundamental has been saved.";
            } else {
                //$this->Session->setFlash(__('The fundamental could not be saved. Please, try again.'));
                echo "The fundamental could not be saved. Please, try again.";
            }
        }
        exit;
	}

/**
 * delete method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function delete($id = null) {
       // $this->request->allowMethod('ajax');
		$this->Fundamental->id = $id;
		if (!$this->Fundamental->exists()) {
			throw new NotFoundException(__('Invalid fundamental'));
		}
		//$this->request->allowMethod('post', 'delete', 'get');
		if ($this->Fundamental->delete()) {
			$this->Session->setFlash(__('The fundamental has been deleted.'));
		} else {
			$this->Session->setFlash(__('The fundamental could not be deleted. Please, try again.'));
		}
		//return $this->redirect(array('action' => 'index'));

        //echo "ok";
        exit;
	}

/**
 * admin_index method
 *
 * @return void
 */
	public function admin_index() {
		$this->Fundamental->recursive = 0;
		$this->set('fundamentals', $this->Paginator->paginate());
	}

/**
 * admin_view method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function admin_view($id = null) {
		if (!$this->Fundamental->exists($id)) {
			throw new NotFoundException(__('Invalid fundamental'));
		}
		$options = array('conditions' => array('Fundamental.' . $this->Fundamental->primaryKey => $id));
		$this->set('fundamental', $this->Fundamental->find('first', $options));
	}

/**
 * admin_add method
 *
 * @return void
 */
	public function admin_add() {
		if ($this->request->is('post')) {
			$this->Fundamental->create();
			if ($this->Fundamental->save($this->request->data)) {
				$this->Session->setFlash(__('The fundamental has been saved.'));
				return $this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The fundamental could not be saved. Please, try again.'));
			}
		}
		$instruments = $this->Fundamental->Instrument->find('list');
		$fundamentalMetas = $this->Fundamental->FundamentalMeta->find('list');
		$this->set(compact('instruments', 'fundamentalMetas'));
	}

/**
 * admin_edit method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function admin_edit($id = null) {
		if (!$this->Fundamental->exists($id)) {
			throw new NotFoundException(__('Invalid fundamental'));
		}
		if ($this->request->is(array('post', 'put'))) {
			if ($this->Fundamental->save($this->request->data)) {
				$this->Session->setFlash(__('The fundamental has been saved.'));
				return $this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The fundamental could not be saved. Please, try again.'));
			}
		} else {
			$options = array('conditions' => array('Fundamental.' . $this->Fundamental->primaryKey => $id));
			$this->request->data = $this->Fundamental->find('first', $options);
		}
		$instruments = $this->Fundamental->Instrument->find('list');
		$fundamentalMetas = $this->Fundamental->FundamentalMeta->find('list');
		$this->set(compact('instruments', 'fundamentalMetas'));
	}

/**
 * admin_delete method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function admin_delete($id = null) {
		$this->Fundamental->id = $id;
		if (!$this->Fundamental->exists()) {
			throw new NotFoundException(__('Invalid fundamental'));
		}
		$this->request->allowMethod('post', 'delete');
		if ($this->Fundamental->delete()) {
			$this->Session->setFlash(__('The fundamental has been deleted.'));
		} else {
			$this->Session->setFlash(__('The fundamental could not be deleted. Please, try again.'));
		}
		return $this->redirect(array('action' => 'index'));
	}
}
