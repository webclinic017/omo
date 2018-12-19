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

        pr($this->PortfolioShare->find('first',array(
            //'conditions' => "News.instrument_id=$instrumentId and News.is_active=1",
            'recursive' => 0
        )));
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
		$exchanges = $this->PortfolioShare->Exchange->find('list');
		$this->set(compact('portfolios', 'instruments', 'exchanges'));
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
		$exchanges = $this->PortfolioShare->Exchange->find('list');
		$this->set(compact('portfolios', 'instruments', 'exchanges'));
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
