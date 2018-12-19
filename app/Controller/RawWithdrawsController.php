<?php
App::uses('AppController', 'Controller');
/**
 * RawWithdraws Controller
 *
 * @property RawWithdraw $RawWithdraw
 * @property PaginatorComponent $Paginator
 */
class RawWithdrawsController extends AppController {

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
		$this->RawWithdraw->recursive = 0;
		$this->set('rawWithdraws', $this->Paginator->paginate());
	}

/**
 * view method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function view($id = null) {
		if (!$this->RawWithdraw->exists($id)) {
			throw new NotFoundException(__('Invalid raw withdraw'));
		}
		$options = array('conditions' => array('RawWithdraw.' . $this->RawWithdraw->primaryKey => $id));
		$this->set('rawWithdraw', $this->RawWithdraw->find('first', $options));
	}

/**
 * add method
 *
 * @return void
 */
	public function add() {
		if ($this->request->is('post')) {
			$this->RawWithdraw->create();
			if ($this->RawWithdraw->save($this->request->data)) {
				$this->Session->setFlash(__('The raw withdraw has been saved.'));
				return $this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The raw withdraw could not be saved. Please, try again.'));
			}
		}
		$portfolioTransactions = $this->RawWithdraw->PortfolioTransaction->find('list');
		$this->set(compact('portfolioTransactions'));
	}

/**
 * edit method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function edit($id = null) {
		if (!$this->RawWithdraw->exists($id)) {
			throw new NotFoundException(__('Invalid raw withdraw'));
		}
		if ($this->request->is(array('post', 'put'))) {
			if ($this->RawWithdraw->save($this->request->data)) {
				$this->Session->setFlash(__('The raw withdraw has been saved.'));
				return $this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The raw withdraw could not be saved. Please, try again.'));
			}
		} else {
			$options = array('conditions' => array('RawWithdraw.' . $this->RawWithdraw->primaryKey => $id));
			$this->request->data = $this->RawWithdraw->find('first', $options);
		}
		$portfolioTransactions = $this->RawWithdraw->PortfolioTransaction->find('list');
		$this->set(compact('portfolioTransactions'));
	}

/**
 * delete method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function delete($id = null) {
		$this->RawWithdraw->id = $id;
		if (!$this->RawWithdraw->exists()) {
			throw new NotFoundException(__('Invalid raw withdraw'));
		}
		$this->request->allowMethod('post', 'delete');
		if ($this->RawWithdraw->delete()) {
			$this->Session->setFlash(__('The raw withdraw has been deleted.'));
		} else {
			$this->Session->setFlash(__('The raw withdraw could not be deleted. Please, try again.'));
		}
		return $this->redirect(array('action' => 'index'));
	}
}
