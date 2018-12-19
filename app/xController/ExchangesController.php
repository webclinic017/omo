<?php
App::uses('AppController', 'Controller');
/**
 * Exchanges Controller
 *
 * @property Exchange $Exchange
 * @property PaginatorComponent $Paginator
 */
class ExchangesController extends AppController {

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
		$this->Exchange->recursive = 0;
		$this->set('exchanges', $this->Paginator->paginate());
	}

/**
 * view method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function view($id = null) {
		if (!$this->Exchange->exists($id)) {
			throw new NotFoundException(__('Invalid exchange'));
		}
		$options = array('conditions' => array('Exchange.' . $this->Exchange->primaryKey => $id));
		$this->set('exchange', $this->Exchange->find('first', $options));
	}

/**
 * add method
 *
 * @return void
 */
	public function add() {
		if ($this->request->is('post')) {
			$this->Exchange->create();
			if ($this->Exchange->save($this->request->data)) {
				$this->Session->setFlash(__('The exchange has been saved.'));
				return $this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The exchange could not be saved. Please, try again.'));
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
		if (!$this->Exchange->exists($id)) {
			throw new NotFoundException(__('Invalid exchange'));
		}
		if ($this->request->is(array('post', 'put'))) {
			if ($this->Exchange->save($this->request->data)) {
				$this->Session->setFlash(__('The exchange has been saved.'));
				return $this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The exchange could not be saved. Please, try again.'));
			}
		} else {
			$options = array('conditions' => array('Exchange.' . $this->Exchange->primaryKey => $id));
			$this->request->data = $this->Exchange->find('first', $options);
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
		$this->Exchange->id = $id;
		if (!$this->Exchange->exists()) {
			throw new NotFoundException(__('Invalid exchange'));
		}
		$this->request->allowMethod('post', 'delete');
		if ($this->Exchange->delete()) {
			$this->Session->setFlash(__('The exchange has been deleted.'));
		} else {
			$this->Session->setFlash(__('The exchange could not be deleted. Please, try again.'));
		}
		return $this->redirect(array('action' => 'index'));
	}
}
