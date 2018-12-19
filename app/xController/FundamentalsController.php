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
	public $components = array('Paginator');

    public function beforeFilter() {
        parent::beforeFilter();

        //$this->Auth->allow('test');
        $this->Auth->allow();

    }
/**
 * index method
 *
 * @return void
 */
	public function index() {
        Configure::write('debug', 0);
		$this->Fundamental->recursive = 0;
        //pr($this->request->data);

        $cond1=$cond2=$cond3="1=1";
        if(isset($this->request->data['Fundamental']['instrument_id']) && $this->request->data['Fundamental']['instrument_id'])
        {
            $cond1="Fundamental.instrument_id =".$this->request->data['Fundamental']['instrument_id'];
        }

        if(isset($this->request->data['Fundamental']['meta_id']) && $this->request->data['Fundamental']['meta_id'])
        {
            $cond2="Fundamental.meta_id =".$this->request->data['Fundamental']['meta_id'];
        }
        if(isset($this->request->data['Fundamental']['meta_value']))
        {
            $cond3="Fundamental.meta_value like '%".$this->request->data['Fundamental']['meta_value']."%'";
        }

        $this->Paginator->settings = array(
            'conditions' => array("$cond1 and $cond2 and $cond3"),
            'limit' => 30
        );

       /* if(isset($this->request->data['Fundamental']['instrument_id']))
        {
           $cond1="'Fundamental.instrument_id ='.$this->request->data['Fundamental']['instrument_id']";
           $cond2="'Fundamental.fundamental_meta_id ='.$this->request->data['Fundamental']['fundamental_meta_id']";
        $this->Paginator->settings = array(
            'conditions' => array('Fundamental.instrument_id ='.$this->request->data['Fundamental']['instrument_id']),
            'limit' => 10
        );
        }*/

		$this->set('fundamentals', $this->Paginator->paginate());
        $instruments = $this->Fundamental->Instrument->find('list');
        $metas = $this->Fundamental->Meta->find('list');
        $this->set(compact('instruments', 'metas'));
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
		$metas = $this->Fundamental->Meta->find('list');
		$this->set(compact('instruments', 'metas'));
	}

/**
 * edit method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function edit($id = null) {
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
		$metas = $this->Fundamental->Meta->find('list');
		$this->set(compact('instruments', 'metas'));
	}

/**
 * delete method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function delete($id = null) {
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

    public function test_chain()
    {
        echo "working";
        exit;
    }

    public function details()
    {

    }
}
