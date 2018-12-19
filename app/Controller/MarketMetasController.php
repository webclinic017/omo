<?php
App::uses('AppController', 'Controller');
/**
 * MarketMetas Controller
 *
 * @property MarketMeta $MarketMeta
 * @property PaginatorComponent $Paginator
 */
class MarketMetasController extends AppController {

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
		$this->MarketMeta->recursive = 0;
		$this->set('marketMetas', $this->Paginator->paginate());
	}

/**
 * view method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function view($id = null) {
		if (!$this->MarketMeta->exists($id)) {
			throw new NotFoundException(__('Invalid market meta'));
		}
		$options = array('conditions' => array('MarketMeta.' . $this->MarketMeta->primaryKey => $id));
		$this->set('marketMeta', $this->MarketMeta->find('first', $options));
	}

/**
 * add method
 *
 * @return void
 */
	public function add() {
		if ($this->request->is('post')) {
			$this->MarketMeta->create();
			if ($this->MarketMeta->save($this->request->data)) {
				$this->Session->setFlash(__('The market meta has been saved.'));
				return $this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The market meta could not be saved. Please, try again.'));
			}
		}
	}

/**
 * edit method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function edit($id = null) {
		if (!$this->MarketMeta->exists($id)) {
			throw new NotFoundException(__('Invalid market meta'));
		}
		if ($this->request->is(array('post', 'put'))) {
			if ($this->MarketMeta->save($this->request->data)) {
				$this->Session->setFlash(__('The market meta has been saved.'));
				return $this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The market meta could not be saved. Please, try again.'));
			}
		} else {
			$options = array('conditions' => array('MarketMeta.' . $this->MarketMeta->primaryKey => $id));
			$this->request->data = $this->MarketMeta->find('first', $options);
		}
	}

/**
 * delete method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function delete($id = null) {
		$this->MarketMeta->id = $id;
		if (!$this->MarketMeta->exists()) {
			throw new NotFoundException(__('Invalid market meta'));
		}
		$this->request->allowMethod('post', 'delete');
		if ($this->MarketMeta->delete()) {
			$this->Session->setFlash(__('The market meta has been deleted.'));
		} else {
			$this->Session->setFlash(__('The market meta could not be deleted. Please, try again.'));
		}
		return $this->redirect(array('action' => 'index'));
	}
}
