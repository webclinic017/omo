<?php
App::uses('AppController', 'Controller');
/**
 * SectorLists Controller
 *
 * @property SectorList $SectorList
 * @property PaginatorComponent $Paginator
 */
class SectorListsController extends AppController {

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
		$this->SectorList->recursive = 0;
		$this->set('sectorLists', $this->Paginator->paginate());
	}

/**
 * view method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function view($id = null) {
		if (!$this->SectorList->exists($id)) {
			throw new NotFoundException(__('Invalid sector list'));
		}
		$options = array('conditions' => array('SectorList.' . $this->SectorList->primaryKey => $id));
		$this->set('sectorList', $this->SectorList->find('first', $options));
	}

/**
 * add method
 *
 * @return void
 */
	public function add() {
		if ($this->request->is('post')) {
			$this->SectorList->create();
			if ($this->SectorList->save($this->request->data)) {
				$this->Session->setFlash(__('The sector list has been saved.'));
				return $this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The sector list could not be saved. Please, try again.'));
			}
		}
		$exchanges = $this->SectorList->Exchange->find('list');
		$this->set(compact('exchanges'));
	}

/**
 * edit method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function edit($id = null) {
		if (!$this->SectorList->exists($id)) {
			throw new NotFoundException(__('Invalid sector list'));
		}
		if ($this->request->is(array('post', 'put'))) {
			if ($this->SectorList->save($this->request->data)) {
				$this->Session->setFlash(__('The sector list has been saved.'));
				return $this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The sector list could not be saved. Please, try again.'));
			}
		} else {
			$options = array('conditions' => array('SectorList.' . $this->SectorList->primaryKey => $id));
			$this->request->data = $this->SectorList->find('first', $options);
		}
		$exchanges = $this->SectorList->Exchange->find('list');
		$this->set(compact('exchanges'));
	}

/**
 * delete method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function delete($id = null) {
		$this->SectorList->id = $id;
		if (!$this->SectorList->exists()) {
			throw new NotFoundException(__('Invalid sector list'));
		}
		$this->request->allowMethod('post', 'delete');
		if ($this->SectorList->delete()) {
			$this->Session->setFlash(__('The sector list has been deleted.'));
		} else {
			$this->Session->setFlash(__('The sector list could not be deleted. Please, try again.'));
		}
		return $this->redirect(array('action' => 'index'));
	}


}
