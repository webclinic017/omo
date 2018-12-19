<?php
App::uses('AppController', 'Controller');
/**
 * DataBankBlocks Controller
 *
 * @property DataBankBlock $DataBankBlock
 * @property PaginatorComponent $Paginator
 */
class DataBankBlocksController extends AppController {

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
		$this->DataBankBlock->recursive = 0;
		$this->set('dataBankBlocks', $this->Paginator->paginate());
	}

/**
 * view method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function view($id = null) {
		if (!$this->DataBankBlock->exists($id)) {
			throw new NotFoundException(__('Invalid data bank block'));
		}
		$options = array('conditions' => array('DataBankBlock.' . $this->DataBankBlock->primaryKey => $id));
		$this->set('dataBankBlock', $this->DataBankBlock->find('first', $options));
	}

/**
 * add method
 *
 * @return void
 */
	public function add() {
		if ($this->request->is('post')) {
			$this->DataBankBlock->create();
			if ($this->DataBankBlock->save($this->request->data)) {
				$this->Session->setFlash(__('The data bank block has been saved.'));
				return $this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The data bank block could not be saved. Please, try again.'));
			}
		}
		$markets = $this->DataBankBlock->Market->find('list');
		$instruments = $this->DataBankBlock->Instrument->find('list');
		$this->set(compact('markets', 'instruments'));
	}

/**
 * edit method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function edit($id = null) {
		if (!$this->DataBankBlock->exists($id)) {
			throw new NotFoundException(__('Invalid data bank block'));
		}
		if ($this->request->is(array('post', 'put'))) {
			if ($this->DataBankBlock->save($this->request->data)) {
				$this->Session->setFlash(__('The data bank block has been saved.'));
				return $this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The data bank block could not be saved. Please, try again.'));
			}
		} else {
			$options = array('conditions' => array('DataBankBlock.' . $this->DataBankBlock->primaryKey => $id));
			$this->request->data = $this->DataBankBlock->find('first', $options);
		}
		$markets = $this->DataBankBlock->Market->find('list');
		$instruments = $this->DataBankBlock->Instrument->find('list');
		$this->set(compact('markets', 'instruments'));
	}

/**
 * delete method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function delete($id = null) {
		$this->DataBankBlock->id = $id;
		if (!$this->DataBankBlock->exists()) {
			throw new NotFoundException(__('Invalid data bank block'));
		}
		$this->request->allowMethod('post', 'delete');
		if ($this->DataBankBlock->delete()) {
			$this->Session->setFlash(__('The data bank block has been deleted.'));
		} else {
			$this->Session->setFlash(__('The data bank block could not be deleted. Please, try again.'));
		}
		return $this->redirect(array('action' => 'index'));
	}
}
