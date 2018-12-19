<?php
App::uses('AppController', 'Controller');
/**
 * PortfolioLedgers Controller
 *
 * @property PortfolioLedger $PortfolioLedger
 * @property PaginatorComponent $Paginator
 */
class PortfolioLedgersController extends AppController {

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
		$this->PortfolioLedger->recursive = 0;
		$this->set('portfolioLedgers', $this->Paginator->paginate());
	}

/**
 * view method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function view($id = null) {
		if (!$this->PortfolioLedger->exists($id)) {
			throw new NotFoundException(__('Invalid portfolio ledger'));
		}
		$options = array('conditions' => array('PortfolioLedger.' . $this->PortfolioLedger->primaryKey => $id));
		$this->set('portfolioLedger', $this->PortfolioLedger->find('first', $options));
	}

/**
 * add method
 *
 * @return void
 */
	public function add() {
		if ($this->request->is('post')) {
			$this->PortfolioLedger->create();
			if ($this->PortfolioLedger->save($this->request->data)) {
				$this->Session->setFlash(__('The portfolio ledger has been saved.'));
				return $this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The portfolio ledger could not be saved. Please, try again.'));
			}
		}
		$portfolios = $this->PortfolioLedger->Portfolio->find('list');
		$instruments = $this->PortfolioLedger->Instrument->find('list');
		$transactionTypes = $this->PortfolioLedger->TransactionType->find('list');
		$this->set(compact('portfolios', 'instruments', 'transactionTypes'));
	}

/**
 * edit method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function edit($id = null) {
		if (!$this->PortfolioLedger->exists($id)) {
			throw new NotFoundException(__('Invalid portfolio ledger'));
		}
		if ($this->request->is(array('post', 'put'))) {
			if ($this->PortfolioLedger->save($this->request->data)) {
				$this->Session->setFlash(__('The portfolio ledger has been saved.'));
				return $this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The portfolio ledger could not be saved. Please, try again.'));
			}
		} else {
			$options = array('conditions' => array('PortfolioLedger.' . $this->PortfolioLedger->primaryKey => $id));
			$this->request->data = $this->PortfolioLedger->find('first', $options);
		}
		$portfolios = $this->PortfolioLedger->Portfolio->find('list');
		$instruments = $this->PortfolioLedger->Instrument->find('list');
		$transactionTypes = $this->PortfolioLedger->TransactionType->find('list');
		$this->set(compact('portfolios', 'instruments', 'transactionTypes'));
	}

/**
 * delete method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function delete($id = null) {
		$this->PortfolioLedger->id = $id;
		if (!$this->PortfolioLedger->exists()) {
			throw new NotFoundException(__('Invalid portfolio ledger'));
		}
		$this->request->allowMethod('post', 'delete');
		if ($this->PortfolioLedger->delete()) {
			$this->Session->setFlash(__('The portfolio ledger has been deleted.'));
		} else {
			$this->Session->setFlash(__('The portfolio ledger could not be deleted. Please, try again.'));
		}
		return $this->redirect(array('action' => 'index'));
	}
}
