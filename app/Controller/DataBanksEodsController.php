<?php
App::uses('AppController', 'Controller');
/**
 * DataBanksEods Controller
 *
 * @property DataBanksEod $DataBanksEod
 * @property PaginatorComponent $Paginator
 */
class DataBanksEodsController extends AppController {

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
		$this->DataBanksEod->recursive = 0;
		$this->set('dataBanksEods', $this->Paginator->paginate());
	}

/**
 * view method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function view($id = null) {
		if (!$this->DataBanksEod->exists($id)) {
			throw new NotFoundException(__('Invalid data banks eod'));
		}
		$options = array('conditions' => array('DataBanksEod.' . $this->DataBanksEod->primaryKey => $id));
		$this->set('dataBanksEod', $this->DataBanksEod->find('first', $options));
	}

/**
 * add method
 *
 * @return void
 */
	public function add() {
		if ($this->request->is('post')) {
			$this->DataBanksEod->create();
			if ($this->DataBanksEod->save($this->request->data)) {
				$this->Session->setFlash(__('The data banks eod has been saved.'));
				return $this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The data banks eod could not be saved. Please, try again.'));
			}
		}
		$markets = $this->DataBanksEod->Market->find('list');
		$instruments = $this->DataBanksEod->Instrument->find('list');
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
		if (!$this->DataBanksEod->exists($id)) {
			throw new NotFoundException(__('Invalid data banks eod'));
		}
		if ($this->request->is(array('post', 'put'))) {
			if ($this->DataBanksEod->save($this->request->data)) {
				$this->Session->setFlash(__('The data banks eod has been saved.'));
				return $this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The data banks eod could not be saved. Please, try again.'));
			}
		} else {
			$options = array('conditions' => array('DataBanksEod.' . $this->DataBanksEod->primaryKey => $id));
			$this->request->data = $this->DataBanksEod->find('first', $options);
		}
		$markets = $this->DataBanksEod->Market->find('list');
		$instruments = $this->DataBanksEod->Instrument->find('list');
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
		$this->DataBanksEod->id = $id;
		if (!$this->DataBanksEod->exists()) {
			throw new NotFoundException(__('Invalid data banks eod'));
		}
		$this->request->onlyAllow('post', 'delete');
		if ($this->DataBanksEod->delete()) {
			$this->Session->setFlash(__('The data banks eod has been deleted.'));
		} else {
			$this->Session->setFlash(__('The data banks eod could not be deleted. Please, try again.'));
		}
		return $this->redirect(array('action' => 'index'));
	}

/**
 * admin_index method
 *
 * @return void
 */
	public function admin_index() {
		$this->DataBanksEod->recursive = 0;
		$this->set('dataBanksEods', $this->Paginator->paginate());
	}

/**
 * admin_view method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function admin_view($id = null) {
		if (!$this->DataBanksEod->exists($id)) {
			throw new NotFoundException(__('Invalid data banks eod'));
		}
		$options = array('conditions' => array('DataBanksEod.' . $this->DataBanksEod->primaryKey => $id));
		$this->set('dataBanksEod', $this->DataBanksEod->find('first', $options));
	}

/**
 * admin_add method
 *
 * @return void
 */
	public function admin_add() {
		if ($this->request->is('post')) {
			$this->DataBanksEod->create();
			if ($this->DataBanksEod->save($this->request->data)) {
				$this->Session->setFlash(__('The data banks eod has been saved.'));
				return $this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The data banks eod could not be saved. Please, try again.'));
			}
		}
		$markets = $this->DataBanksEod->Market->find('list');
		$instruments = $this->DataBanksEod->Instrument->find('list');
		$this->set(compact('markets', 'instruments'));
	}

/**
 * admin_edit method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function admin_edit($id = null) {
		if (!$this->DataBanksEod->exists($id)) {
			throw new NotFoundException(__('Invalid data banks eod'));
		}
		if ($this->request->is(array('post', 'put'))) {
			if ($this->DataBanksEod->save($this->request->data)) {
				$this->Session->setFlash(__('The data banks eod has been saved.'));
				return $this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The data banks eod could not be saved. Please, try again.'));
			}
		} else {
			$options = array('conditions' => array('DataBanksEod.' . $this->DataBanksEod->primaryKey => $id));
			$this->request->data = $this->DataBanksEod->find('first', $options);
		}
		$markets = $this->DataBanksEod->Market->find('list');
		$instruments = $this->DataBanksEod->Instrument->find('list');
		$this->set(compact('markets', 'instruments'));
	}

/**
 * admin_delete method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function admin_delete($id = null) {
		$this->DataBanksEod->id = $id;
		if (!$this->DataBanksEod->exists()) {
			throw new NotFoundException(__('Invalid data banks eod'));
		}
		$this->request->onlyAllow('post', 'delete');
		if ($this->DataBanksEod->delete()) {
			$this->Session->setFlash(__('The data banks eod has been deleted.'));
		} else {
			$this->Session->setFlash(__('The data banks eod could not be deleted. Please, try again.'));
		}
		return $this->redirect(array('action' => 'index'));
	}}
