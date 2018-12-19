<?php
App::uses('AppController', 'Controller');
/**
 * Symbols Controller
 *
 * @property Symbol $Symbol
 * @property PaginatorComponent $Paginator
 */
class SymbolsController extends AppController {

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
		$this->Symbol->recursive = 0;
		$this->set('symbols', $this->Paginator->paginate());
	}

/**
 * view method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function view($id = null) {
		if (!$this->Symbol->exists($id)) {
			throw new NotFoundException(__('Invalid symbol'));
		}
		$options = array('conditions' => array('Symbol.' . $this->Symbol->primaryKey => $id));
		$this->set('symbol', $this->Symbol->find('first', $options));
	}

/**
 * add method
 *
 * @return void
 */
	public function add() {
		if ($this->request->is('post')) {
			$this->Symbol->create();
			if ($this->Symbol->save($this->request->data)) {
				$this->Session->setFlash(__('The symbol has been saved.'));
				return $this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The symbol could not be saved. Please, try again.'));
			}
		}
		$sectors = $this->Symbol->Sector->find('list');
		$this->set(compact('sectors'));
	}

/**
 * edit method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function edit($id = null) {
		if (!$this->Symbol->exists($id)) {
			throw new NotFoundException(__('Invalid symbol'));
		}
		if ($this->request->is(array('post', 'put'))) {
			if ($this->Symbol->save($this->request->data)) {
				$this->Session->setFlash(__('The symbol has been saved.'));
				return $this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The symbol could not be saved. Please, try again.'));
			}
		} else {
			$options = array('conditions' => array('Symbol.' . $this->Symbol->primaryKey => $id));
			$this->request->data = $this->Symbol->find('first', $options);
		}
		$sectors = $this->Symbol->Sector->find('list');
		$this->set(compact('sectors'));
	}

/**
 * delete method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function delete($id = null) {
		$this->Symbol->id = $id;
		if (!$this->Symbol->exists()) {
			throw new NotFoundException(__('Invalid symbol'));
		}
		$this->request->onlyAllow('post', 'delete');
		if ($this->Symbol->delete()) {
			$this->Session->setFlash(__('The symbol has been deleted.'));
		} else {
			$this->Session->setFlash(__('The symbol could not be deleted. Please, try again.'));
		}
		return $this->redirect(array('action' => 'index'));
	}

/**
 * admin_index method
 *
 * @return void
 */
	public function admin_index() {
		$this->Symbol->recursive = 0;
		$this->set('symbols', $this->Paginator->paginate());
	}

/**
 * admin_view method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function admin_view($id = null) {
		if (!$this->Symbol->exists($id)) {
			throw new NotFoundException(__('Invalid symbol'));
		}
		$options = array('conditions' => array('Symbol.' . $this->Symbol->primaryKey => $id));
		$this->set('symbol', $this->Symbol->find('first', $options));
	}

/**
 * admin_add method
 *
 * @return void
 */
	public function admin_add() {
		if ($this->request->is('post')) {
			$this->Symbol->create();
			if ($this->Symbol->save($this->request->data)) {
				$this->Session->setFlash(__('The symbol has been saved.'));
				return $this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The symbol could not be saved. Please, try again.'));
			}
		}
		$sectors = $this->Symbol->Sector->find('list');
		$this->set(compact('sectors'));
	}

/**
 * admin_edit method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function admin_edit($id = null) {
		if (!$this->Symbol->exists($id)) {
			throw new NotFoundException(__('Invalid symbol'));
		}
		if ($this->request->is(array('post', 'put'))) {
			if ($this->Symbol->save($this->request->data)) {
				$this->Session->setFlash(__('The symbol has been saved.'));
				return $this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The symbol could not be saved. Please, try again.'));
			}
		} else {
			$options = array('conditions' => array('Symbol.' . $this->Symbol->primaryKey => $id));
			$this->request->data = $this->Symbol->find('first', $options);
		}
		$sectors = $this->Symbol->Sector->find('list');
		$this->set(compact('sectors'));
	}

/**
 * admin_delete method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function admin_delete($id = null) {
		$this->Symbol->id = $id;
		if (!$this->Symbol->exists()) {
			throw new NotFoundException(__('Invalid symbol'));
		}
		$this->request->onlyAllow('post', 'delete');
		if ($this->Symbol->delete()) {
			$this->Session->setFlash(__('The symbol has been deleted.'));
		} else {
			$this->Session->setFlash(__('The symbol could not be deleted. Please, try again.'));
		}
		return $this->redirect(array('action' => 'index'));
	}}
