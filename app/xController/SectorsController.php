<?php
App::uses('AppController', 'Controller');
/**
 * Sectors Controller
 *
 * @property Sector $Sector
 * @property PaginatorComponent $Paginator
 */
class SectorsController extends AppController {

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
/**
 * index method
 *
 * @return void
 */
	public function index() {
		$this->Sector->recursive = 0;
		$this->set('sectors', $this->Paginator->paginate());
	}

    public function test()
    {
        $StockBangladesh = $this->Components->load('StockBangladesh');
        $lastTradeInfo = $StockBangladesh->prepareLastTradeInfo('2014-07-13');

       // $x=$this->Sector->find('all');
       // pr($x);
        exit;

    }
/**
 * view method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function view($id = null) {
		if (!$this->Sector->exists($id)) {
			throw new NotFoundException(__('Invalid sector'));
		}
		$options = array('conditions' => array('Sector.' . $this->Sector->primaryKey => $id));
		$this->set('sector', $this->Sector->find('first', $options));
	}

/**
 * add method
 *
 * @return void
 */
	public function add() {
		if ($this->request->is('post')) {
			$this->Sector->create();
			if ($this->Sector->save($this->request->data)) {
				$this->Session->setFlash(__('The sector has been saved.'));
				return $this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The sector could not be saved. Please, try again.'));
			}
		}
		$exchanges = $this->Sector->Exchange->find('list');
		$this->set(compact('exchanges'));
	}

/**
 * edit method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function edit($id = null) {
		if (!$this->Sector->exists($id)) {
			throw new NotFoundException(__('Invalid sector'));
		}
		if ($this->request->is(array('post', 'put'))) {
			if ($this->Sector->save($this->request->data)) {
				$this->Session->setFlash(__('The sector has been saved.'));
				return $this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The sector could not be saved. Please, try again.'));
			}
		} else {
			$options = array('conditions' => array('Sector.' . $this->Sector->primaryKey => $id));
			$this->request->data = $this->Sector->find('first', $options);
		}
		$exchanges = $this->Sector->Exchange->find('list');
		$this->set(compact('exchanges'));
	}

/**
 * delete method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function delete($id = null) {
		$this->Sector->id = $id;
		if (!$this->Sector->exists()) {
			throw new NotFoundException(__('Invalid sector'));
		}
		$this->request->allowMethod('post', 'delete');
		if ($this->Sector->delete()) {
			$this->Session->setFlash(__('The sector has been deleted.'));
		} else {
			$this->Session->setFlash(__('The sector could not be deleted. Please, try again.'));
		}
		return $this->redirect(array('action' => 'index'));
	}
}
