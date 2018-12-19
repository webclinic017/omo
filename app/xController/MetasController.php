<?php
App::uses('AppController', 'Controller');
/**
 * Metas Controller
 *
 * @property Meta $Meta
 * @property PaginatorComponent $Paginator
 */
class MetasController extends AppController {

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
		$this->Meta->recursive = 0;
		$this->set('metas', $this->Paginator->paginate());
	}

/**
 * view method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function view($id = null) {
		if (!$this->Meta->exists($id)) {
			throw new NotFoundException(__('Invalid meta'));
		}
		$options = array('conditions' => array('Meta.' . $this->Meta->primaryKey => $id));
		$this->set('meta', $this->Meta->find('first', $options));
	}

/**
 * add method
 *
 * @return void
 */
	public function add() {
		if ($this->request->is('post')) {
			$this->Meta->create();
			if ($this->Meta->save($this->request->data)) {
				$this->Session->setFlash(__('The meta has been saved.'));
				return $this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The meta could not be saved. Please, try again.'));
			}
		}
		$metaGroups = $this->Meta->MetaGroup->find('list');
		$this->set(compact('metaGroups'));
	}

/**
 * edit method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function edit($id = null) {
		if (!$this->Meta->exists($id)) {
			throw new NotFoundException(__('Invalid meta'));
		}
		if ($this->request->is(array('post', 'put'))) {
			if ($this->Meta->save($this->request->data)) {
				$this->Session->setFlash(__('The meta has been saved.'));
				return $this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The meta could not be saved. Please, try again.'));
			}
		} else {
			$options = array('conditions' => array('Meta.' . $this->Meta->primaryKey => $id));
			$this->request->data = $this->Meta->find('first', $options);
		}
		$metaGroups = $this->Meta->MetaGroup->find('list');
		$this->set(compact('metaGroups'));
	}

/**
 * delete method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function delete($id = null) {
		$this->Meta->id = $id;
		if (!$this->Meta->exists()) {
			throw new NotFoundException(__('Invalid meta'));
		}
		$this->request->allowMethod('post', 'delete');
		if ($this->Meta->delete()) {
			$this->Session->setFlash(__('The meta has been deleted.'));
		} else {
			$this->Session->setFlash(__('The meta could not be deleted. Please, try again.'));
		}
		return $this->redirect(array('action' => 'index'));
	}
}
