<?php
App::uses('AppController', 'Controller');
/**
 * UserMetas Controller
 *
 * @property UserMeta $UserMeta
 * @property PaginatorComponent $Paginator
 */
class UserMetasController extends AppController {

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
		$this->UserMeta->recursive = 0;
		$this->set('userMetas', $this->Paginator->paginate());
	}

/**
 * view method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function view($id = null) {
		if (!$this->UserMeta->exists($id)) {
			throw new NotFoundException(__('Invalid user meta'));
		}
		$options = array('conditions' => array('UserMeta.' . $this->UserMeta->primaryKey => $id));
		$this->set('userMeta', $this->UserMeta->find('first', $options));
	}

/**
 * add method
 *
 * @return void
 */
	public function add() {
		if ($this->request->is('post')) {
			$this->UserMeta->create();
			if ($this->UserMeta->save($this->request->data)) {
				$this->Session->setFlash(__('The user meta has been saved.'));
				return $this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The user meta could not be saved. Please, try again.'));
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
		if (!$this->UserMeta->exists($id)) {
			throw new NotFoundException(__('Invalid user meta'));
		}
		if ($this->request->is(array('post', 'put'))) {
			if ($this->UserMeta->save($this->request->data)) {
				$this->Session->setFlash(__('The user meta has been saved.'));
				return $this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The user meta could not be saved. Please, try again.'));
			}
		} else {
			$options = array('conditions' => array('UserMeta.' . $this->UserMeta->primaryKey => $id));
			$this->request->data = $this->UserMeta->find('first', $options);
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
		$this->UserMeta->id = $id;
		if (!$this->UserMeta->exists()) {
			throw new NotFoundException(__('Invalid user meta'));
		}
		$this->request->allowMethod('post', 'delete');
		if ($this->UserMeta->delete()) {
			$this->Session->setFlash(__('The user meta has been deleted.'));
		} else {
			$this->Session->setFlash(__('The user meta could not be deleted. Please, try again.'));
		}
		return $this->redirect(array('action' => 'index'));
	}
}
