<?php
App::uses('AppController', 'Controller');
/**
 * NewsMetas Controller
 *
 * @property NewsMeta $NewsMeta
 * @property PaginatorComponent $Paginator
 */
class NewsMetasController extends AppController {

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
		$this->NewsMeta->recursive = 0;
		$this->set('newsMetas', $this->Paginator->paginate());
	}

/**
 * view method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function view($id = null) {
		if (!$this->NewsMeta->exists($id)) {
			throw new NotFoundException(__('Invalid news meta'));
		}
		$options = array('conditions' => array('NewsMeta.' . $this->NewsMeta->primaryKey => $id));
		$this->set('newsMeta', $this->NewsMeta->find('first', $options));
	}

/**
 * add method
 *
 * @return void
 */
	public function add() {
		if ($this->request->is('post')) {
			$this->NewsMeta->create();
			if ($this->NewsMeta->save($this->request->data)) {
				$this->Session->setFlash(__('The news meta has been saved.'));
				return $this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The news meta could not be saved. Please, try again.'));
			}
		}
		$news = $this->NewsMeta->News->find('list');
		$this->set(compact('news'));
	}

/**
 * edit method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function edit($id = null) {
		if (!$this->NewsMeta->exists($id)) {
			throw new NotFoundException(__('Invalid news meta'));
		}
		if ($this->request->is(array('post', 'put'))) {
			if ($this->NewsMeta->save($this->request->data)) {
				$this->Session->setFlash(__('The news meta has been saved.'));
				return $this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The news meta could not be saved. Please, try again.'));
			}
		} else {
			$options = array('conditions' => array('NewsMeta.' . $this->NewsMeta->primaryKey => $id));
			$this->request->data = $this->NewsMeta->find('first', $options);
		}
		$news = $this->NewsMeta->News->find('list');
		$this->set(compact('news'));
	}

/**
 * delete method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function delete($id = null) {
		$this->NewsMeta->id = $id;
		if (!$this->NewsMeta->exists()) {
			throw new NotFoundException(__('Invalid news meta'));
		}
		$this->request->allowMethod('post', 'delete');
		if ($this->NewsMeta->delete()) {
			$this->Session->setFlash(__('The news meta has been deleted.'));
		} else {
			$this->Session->setFlash(__('The news meta could not be deleted. Please, try again.'));
		}
		return $this->redirect(array('action' => 'index'));
	}
}
