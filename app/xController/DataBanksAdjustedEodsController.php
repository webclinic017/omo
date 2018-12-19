<?php
App::uses('AppController', 'Controller');
/**
 * DataBanksAdjustedEods Controller
 *
 * @property DataBanksAdjustedEod $DataBanksAdjustedEod
 * @property PaginatorComponent $Paginator
 */
class DataBanksAdjustedEodsController extends AppController {

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
		$this->DataBanksAdjustedEod->recursive = 0;
		$this->set('dataBanksAdjustedEods', $this->Paginator->paginate());
	}

/**
 * view method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function view($id = null) {
		if (!$this->DataBanksAdjustedEod->exists($id)) {
			throw new NotFoundException(__('Invalid data banks adjusted eod'));
		}
		$options = array('conditions' => array('DataBanksAdjustedEod.' . $this->DataBanksAdjustedEod->primaryKey => $id));
		$this->set('dataBanksAdjustedEod', $this->DataBanksAdjustedEod->find('first', $options));
	}

/**
 * add method
 *
 * @return void
 */
	public function add() {
		if ($this->request->is('post')) {
			$this->DataBanksAdjustedEod->create();
			if ($this->DataBanksAdjustedEod->save($this->request->data)) {
				$this->Session->setFlash(__('The data banks adjusted eod has been saved.'));
				return $this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The data banks adjusted eod could not be saved. Please, try again.'));
			}
		}
		$markets = $this->DataBanksAdjustedEod->Market->find('list');
		$instruments = $this->DataBanksAdjustedEod->Instrument->find('list');
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
		if (!$this->DataBanksAdjustedEod->exists($id)) {
			throw new NotFoundException(__('Invalid data banks adjusted eod'));
		}
		if ($this->request->is(array('post', 'put'))) {
			if ($this->DataBanksAdjustedEod->save($this->request->data)) {
				$this->Session->setFlash(__('The data banks adjusted eod has been saved.'));
				return $this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The data banks adjusted eod could not be saved. Please, try again.'));
			}
		} else {
			$options = array('conditions' => array('DataBanksAdjustedEod.' . $this->DataBanksAdjustedEod->primaryKey => $id));
			$this->request->data = $this->DataBanksAdjustedEod->find('first', $options);
		}
		$markets = $this->DataBanksAdjustedEod->Market->find('list');
		$instruments = $this->DataBanksAdjustedEod->Instrument->find('list');
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
		$this->DataBanksAdjustedEod->id = $id;
		if (!$this->DataBanksAdjustedEod->exists()) {
			throw new NotFoundException(__('Invalid data banks adjusted eod'));
		}
		$this->request->allowMethod('post', 'delete');
		if ($this->DataBanksAdjustedEod->delete()) {
			$this->Session->setFlash(__('The data banks adjusted eod has been deleted.'));
		} else {
			$this->Session->setFlash(__('The data banks adjusted eod could not be deleted. Please, try again.'));
		}
		return $this->redirect(array('action' => 'index'));
	}

/**
 * admin_index method
 *
 * @return void
 */
	public function admin_index() {
		$this->DataBanksAdjustedEod->recursive = 0;
		$this->set('dataBanksAdjustedEods', $this->Paginator->paginate());
	}

/**
 * admin_view method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function admin_view($id = null) {
		if (!$this->DataBanksAdjustedEod->exists($id)) {
			throw new NotFoundException(__('Invalid data banks adjusted eod'));
		}
		$options = array('conditions' => array('DataBanksAdjustedEod.' . $this->DataBanksAdjustedEod->primaryKey => $id));
		$this->set('dataBanksAdjustedEod', $this->DataBanksAdjustedEod->find('first', $options));
	}

/**
 * admin_add method
 *
 * @return void
 */
	public function admin_add() {
		if ($this->request->is('post')) {
			$this->DataBanksAdjustedEod->create();
			if ($this->DataBanksAdjustedEod->save($this->request->data)) {
				$this->Session->setFlash(__('The data banks adjusted eod has been saved.'));
				return $this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The data banks adjusted eod could not be saved. Please, try again.'));
			}
		}
		$markets = $this->DataBanksAdjustedEod->Market->find('list');
		$instruments = $this->DataBanksAdjustedEod->Instrument->find('list');
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
		if (!$this->DataBanksAdjustedEod->exists($id)) {
			throw new NotFoundException(__('Invalid data banks adjusted eod'));
		}
		if ($this->request->is(array('post', 'put'))) {
			if ($this->DataBanksAdjustedEod->save($this->request->data)) {
				$this->Session->setFlash(__('The data banks adjusted eod has been saved.'));
				return $this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The data banks adjusted eod could not be saved. Please, try again.'));
			}
		} else {
			$options = array('conditions' => array('DataBanksAdjustedEod.' . $this->DataBanksAdjustedEod->primaryKey => $id));
			$this->request->data = $this->DataBanksAdjustedEod->find('first', $options);
		}
		$markets = $this->DataBanksAdjustedEod->Market->find('list');
		$instruments = $this->DataBanksAdjustedEod->Instrument->find('list');
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
		$this->DataBanksAdjustedEod->id = $id;
		if (!$this->DataBanksAdjustedEod->exists()) {
			throw new NotFoundException(__('Invalid data banks adjusted eod'));
		}
		$this->request->allowMethod('post', 'delete');
		if ($this->DataBanksAdjustedEod->delete()) {
			$this->Session->setFlash(__('The data banks adjusted eod has been deleted.'));
		} else {
			$this->Session->setFlash(__('The data banks adjusted eod could not be deleted. Please, try again.'));
		}
		return $this->redirect(array('action' => 'index'));
	}
}
