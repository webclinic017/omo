<?php
App::uses('AppController', 'Controller');
/**
 * RawTradins Controller
 *
 * @property RawTradin $RawTradin
 * @property PaginatorComponent $Paginator
 */
class RawTradinsController extends AppController {

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
		$this->RawTradin->recursive = 0;
		$this->set('rawTradins', $this->Paginator->paginate());
	}

/**
 * view method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function view($id = null) {
		if (!$this->RawTradin->exists($id)) {
			throw new NotFoundException(__('Invalid raw tradin'));
		}
		$options = array('conditions' => array('RawTradin.' . $this->RawTradin->primaryKey => $id));
		$this->set('rawTradin', $this->RawTradin->find('first', $options));
	}

/**
 * add method
 *
 * @return void
 */
	public function add() {
		if ($this->request->is('post')) {
			$this->RawTradin->create();
			if ($this->RawTradin->save($this->request->data)) {
				$this->Session->setFlash(__('The raw tradin has been saved.'));
				return $this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The raw tradin could not be saved. Please, try again.'));
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
		if (!$this->RawTradin->exists($id)) {
			throw new NotFoundException(__('Invalid raw tradin'));
		}
		if ($this->request->is(array('post', 'put'))) {
			if ($this->RawTradin->save($this->request->data)) {
				$this->Session->setFlash(__('The raw tradin has been saved.'));
				return $this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The raw tradin could not be saved. Please, try again.'));
			}
		} else {
			$options = array('conditions' => array('RawTradin.' . $this->RawTradin->primaryKey => $id));
			$this->request->data = $this->RawTradin->find('first', $options);
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
		$this->RawTradin->id = $id;
		if (!$this->RawTradin->exists()) {
			throw new NotFoundException(__('Invalid raw tradin'));
		}
		$this->request->allowMethod('post', 'delete');
		if ($this->RawTradin->delete()) {
			$this->Session->setFlash(__('The raw tradin has been deleted.'));
		} else {
			$this->Session->setFlash(__('The raw tradin could not be deleted. Please, try again.'));
		}
		return $this->redirect(array('action' => 'index'));
	}
}
