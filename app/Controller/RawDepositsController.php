<?php
App::uses('AppController', 'Controller');
/**
 * RawDeposits Controller
 *
 * @property RawDeposit $RawDeposit
 * @property PaginatorComponent $Paginator
 */
class RawDepositsController extends AppController {

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
		$this->RawDeposit->recursive = 0;
		$this->set('rawDeposits', $this->Paginator->paginate());
	}

/**
 * view method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function view($id = null) {
		if (!$this->RawDeposit->exists($id)) {
			throw new NotFoundException(__('Invalid raw deposit'));
		}
		$options = array('conditions' => array('RawDeposit.' . $this->RawDeposit->primaryKey => $id));
		$this->set('rawDeposit', $this->RawDeposit->find('first', $options));
	}

/**
 * add method
 *
 * @return void
 */
	public function add() {
		if ($this->request->is('post')) {
			$this->RawDeposit->create();
			if ($this->RawDeposit->save($this->request->data)) {
				$this->Session->setFlash(__('The raw deposit has been saved.'));
				return $this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The raw deposit could not be saved. Please, try again.'));
			}
		}
		$portfolioTransactions = $this->RawDeposit->PortfolioTransaction->find('list');
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
		if (!$this->RawDeposit->exists($id)) {
			throw new NotFoundException(__('Invalid raw deposit'));
		}
		if ($this->request->is(array('post', 'put'))) {
			if ($this->RawDeposit->save($this->request->data)) {
				$this->Session->setFlash(__('The raw deposit has been saved.'));
				return $this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The raw deposit could not be saved. Please, try again.'));
			}
		} else {
			$options = array('conditions' => array('RawDeposit.' . $this->RawDeposit->primaryKey => $id));
			$this->request->data = $this->RawDeposit->find('first', $options);
		}
		$portfolioTransactions = $this->RawDeposit->PortfolioTransaction->find('list');
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
		$this->RawDeposit->id = $id;
		if (!$this->RawDeposit->exists()) {
			throw new NotFoundException(__('Invalid raw deposit'));
		}
		$this->request->allowMethod('post', 'delete');
		if ($this->RawDeposit->delete()) {
			$this->Session->setFlash(__('The raw deposit has been deleted.'));
		} else {
			$this->Session->setFlash(__('The raw deposit could not be deleted. Please, try again.'));
		}
		return $this->redirect(array('action' => 'index'));
	}
}
