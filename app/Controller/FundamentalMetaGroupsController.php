<?php
App::uses('AppController', 'Controller');
/**
 * FundamentalMetaGroups Controller
 *
 * @property FundamentalMetaGroup $FundamentalMetaGroup
 * @property PaginatorComponent $Paginator
 */
class FundamentalMetaGroupsController extends AppController {

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
		$this->FundamentalMetaGroup->recursive = 0;
		$this->set('fundamentalMetaGroups', $this->Paginator->paginate());
	}

/**
 * view method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function view($id = null) {
		if (!$this->FundamentalMetaGroup->exists($id)) {
			throw new NotFoundException(__('Invalid fundamental meta group'));
		}
		$options = array('conditions' => array('FundamentalMetaGroup.' . $this->FundamentalMetaGroup->primaryKey => $id));
		$this->set('fundamentalMetaGroup', $this->FundamentalMetaGroup->find('first', $options));
	}

/**
 * add method
 *
 * @return void
 */
	public function add() {
		if ($this->request->is('post')) {
			$this->FundamentalMetaGroup->create();
			if ($this->FundamentalMetaGroup->save($this->request->data)) {
				$this->Session->setFlash(__('The fundamental meta group has been saved.'));
				return $this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The fundamental meta group could not be saved. Please, try again.'));
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
		if (!$this->FundamentalMetaGroup->exists($id)) {
			throw new NotFoundException(__('Invalid fundamental meta group'));
		}
		if ($this->request->is(array('post', 'put'))) {
			if ($this->FundamentalMetaGroup->save($this->request->data)) {
				$this->Session->setFlash(__('The fundamental meta group has been saved.'));
				return $this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The fundamental meta group could not be saved. Please, try again.'));
			}
		} else {
			$options = array('conditions' => array('FundamentalMetaGroup.' . $this->FundamentalMetaGroup->primaryKey => $id));
			$this->request->data = $this->FundamentalMetaGroup->find('first', $options);
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
		$this->FundamentalMetaGroup->id = $id;
		if (!$this->FundamentalMetaGroup->exists()) {
			throw new NotFoundException(__('Invalid fundamental meta group'));
		}
		$this->request->allowMethod('post', 'delete');
		if ($this->FundamentalMetaGroup->delete()) {
			$this->Session->setFlash(__('The fundamental meta group has been deleted.'));
		} else {
			$this->Session->setFlash(__('The fundamental meta group could not be deleted. Please, try again.'));
		}
		return $this->redirect(array('action' => 'index'));
	}
}
