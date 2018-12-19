<?php
App::uses('AppController', 'Controller');
/**
 * PortfolioShares Controller
 *
 * @property PortfolioShare $PortfolioShare
 * @property PaginatorComponent $Paginator
 */
class PortfolioSharesController extends AppController {

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
		$this->PortfolioShare->recursive = 0;
		$this->set('portfolioShares', $this->Paginator->paginate());
	}

/**
 * view method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function view($id = null) {
		if (!$this->PortfolioShare->exists($id)) {
			throw new NotFoundException(__('Invalid portfolio share'));
		}
		$options = array('conditions' => array('PortfolioShare.' . $this->PortfolioShare->primaryKey => $id));
		$this->set('portfolioShare', $this->PortfolioShare->find('first', $options));
	}

/**
 * add method
 *
 * @return void
 */
	public function add() {
		if ($this->request->is('post')) {
			$this->PortfolioShare->create();
			if ($this->PortfolioShare->save($this->request->data)) {
				$this->Session->setFlash(__('The portfolio share has been saved.'));
				return $this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The portfolio share could not be saved. Please, try again.'));
			}
		}
		$portfolios = $this->PortfolioShare->Portfolio->find('list');
		$instruments = $this->PortfolioShare->Instrument->find('list');
		$transactionTypes = $this->PortfolioShare->TransactionType->find('list');
		$parentPortfolioShares = $this->PortfolioShare->ParentPortfolioShare->find('list');
		$this->set(compact('portfolios', 'instruments', 'transactionTypes', 'parentPortfolioShares'));
	}

/**
 * edit method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function edit($id = null) {
		if (!$this->PortfolioShare->exists($id)) {
			throw new NotFoundException(__('Invalid portfolio share'));
		}
		if ($this->request->is(array('post', 'put'))) {
			if ($this->PortfolioShare->save($this->request->data)) {
				$this->Session->setFlash(__('The portfolio share has been saved.'));
				return $this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The portfolio share could not be saved. Please, try again.'));
			}
		} else {
			$options = array('conditions' => array('PortfolioShare.' . $this->PortfolioShare->primaryKey => $id));
			$this->request->data = $this->PortfolioShare->find('first', $options);
		}
		$portfolios = $this->PortfolioShare->Portfolio->find('list');
		$instruments = $this->PortfolioShare->Instrument->find('list');
		$transactionTypes = $this->PortfolioShare->TransactionType->find('list');
		$parentPortfolioShares = $this->PortfolioShare->ParentPortfolioShare->find('list');
		$this->set(compact('portfolios', 'instruments', 'transactionTypes', 'parentPortfolioShares'));
	}

/**
 * delete method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function delete($id = null) {
		$this->PortfolioShare->id = $id;
		if (!$this->PortfolioShare->exists()) {
			throw new NotFoundException(__('Invalid portfolio share'));
		}
		$this->request->allowMethod('post', 'delete');
		if ($this->PortfolioShare->delete()) {
			$this->Session->setFlash(__('The portfolio share has been deleted.'));
		} else {
			$this->Session->setFlash(__('The portfolio share could not be deleted. Please, try again.'));
		}
		return $this->redirect(array('action' => 'index'));
	}
}
