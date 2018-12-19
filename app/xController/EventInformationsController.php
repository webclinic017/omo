<?php
App::uses('AppController', 'Controller');
/**
 * EventInformations Controller
 *
 * @property EventInformation $EventInformation
 * @property PaginatorComponent $Paginator
 */
class EventInformationsController extends AppController {

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
		$this->EventInformation->recursive = 0;
		$this->set('eventInformations', $this->Paginator->paginate());
	}

/**
 * view method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function view($id = null) {
		if (!$this->EventInformation->exists($id)) {
			throw new NotFoundException(__('Invalid event information'));
		}
		$options = array('conditions' => array('EventInformation.' . $this->EventInformation->primaryKey => $id));
		$this->set('eventInformation', $this->EventInformation->find('first', $options));
	}

/**
 * add method
 *
 * @return void
 */
	public function add() {
		if ($this->request->is('post')) {
			$this->EventInformation->create();
			if ($this->EventInformation->save($this->request->data)) {
				$this->Session->setFlash(__('The event information has been saved.'));
				return $this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The event information could not be saved. Please, try again.'));
			}
		}
		$events = $this->EventInformation->Event->find('list');
		$metas = $this->EventInformation->Meta->find('list');
		$this->set(compact('events', 'metas'));
	}

/**
 * edit method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function edit($id = null) {
		if (!$this->EventInformation->exists($id)) {
			throw new NotFoundException(__('Invalid event information'));
		}
		if ($this->request->is(array('post', 'put'))) {
			if ($this->EventInformation->save($this->request->data)) {
				$this->Session->setFlash(__('The event information has been saved.'));
				return $this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The event information could not be saved. Please, try again.'));
			}
		} else {
			$options = array('conditions' => array('EventInformation.' . $this->EventInformation->primaryKey => $id));
			$this->request->data = $this->EventInformation->find('first', $options);
		}
		$events = $this->EventInformation->Event->find('list');
		$metas = $this->EventInformation->Meta->find('list');
		$this->set(compact('events', 'metas'));
	}

/**
 * delete method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function delete($id = null) {
		$this->EventInformation->id = $id;
		if (!$this->EventInformation->exists()) {
			throw new NotFoundException(__('Invalid event information'));
		}
		$this->request->allowMethod('post', 'delete');
		if ($this->EventInformation->delete()) {
			$this->Session->setFlash(__('The event information has been deleted.'));
		} else {
			$this->Session->setFlash(__('The event information could not be deleted. Please, try again.'));
		}
		return $this->redirect(array('action' => 'index'));
	}
}
