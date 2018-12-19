<?php
App::uses('AppController', 'Controller');
/**
 * MetaGroups Controller
 *
 * @property MetaGroup $MetaGroup
 * @property PaginatorComponent $Paginator
 */
class MetaGroupsController extends AppController {

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
		$this->MetaGroup->recursive = 0;
		$this->set('metaGroups', $this->Paginator->paginate());
	}

/**
 * view method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function view($id = null) {
		if (!$this->MetaGroup->exists($id)) {
			throw new NotFoundException(__('Invalid meta group'));
		}
		$options = array('conditions' => array('MetaGroup.' . $this->MetaGroup->primaryKey => $id));
		$this->set('metaGroup', $this->MetaGroup->find('first', $options));
	}

/**
 * add method
 *
 * @return void
 */
	public function add() {
		if ($this->request->is('post')) {
			$this->MetaGroup->create();
			if ($this->MetaGroup->save($this->request->data)) {
				$this->Session->setFlash(__('The meta group has been saved.'));
				return $this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The meta group could not be saved. Please, try again.'));
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
		if (!$this->MetaGroup->exists($id)) {
			throw new NotFoundException(__('Invalid meta group'));
		}
		if ($this->request->is(array('post', 'put'))) {
			if ($this->MetaGroup->save($this->request->data)) {
				$this->Session->setFlash(__('The meta group has been saved.'));
				return $this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The meta group could not be saved. Please, try again.'));
			}
		} else {
			$options = array('conditions' => array('MetaGroup.' . $this->MetaGroup->primaryKey => $id));
			$this->request->data = $this->MetaGroup->find('first', $options);
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
		$this->MetaGroup->id = $id;
		if (!$this->MetaGroup->exists()) {
			throw new NotFoundException(__('Invalid meta group'));
		}
		$this->request->allowMethod('post', 'delete');
		if ($this->MetaGroup->delete()) {
			$this->Session->setFlash(__('The meta group has been deleted.'));
		} else {
			$this->Session->setFlash(__('The meta group could not be deleted. Please, try again.'));
		}
		return $this->redirect(array('action' => 'index'));
	}
}
