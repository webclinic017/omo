<?php
App::uses('AppController', 'Controller');
/**
 * FundamentalMetasFundamentalMetaGroups Controller
 *
 * @property FundamentalMetasFundamentalMetaGroup $FundamentalMetasFundamentalMetaGroup
 * @property PaginatorComponent $Paginator
 */
class FundamentalMetasFundamentalMetaGroupsController extends AppController {

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
		$this->FundamentalMetasFundamentalMetaGroup->recursive = 0;
		$this->set('fundamentalMetasFundamentalMetaGroups', $this->Paginator->paginate());
	}

/**
 * view method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function view($id = null) {
		if (!$this->FundamentalMetasFundamentalMetaGroup->exists($id)) {
			throw new NotFoundException(__('Invalid fundamental metas fundamental meta group'));
		}
		$options = array('conditions' => array('FundamentalMetasFundamentalMetaGroup.' . $this->FundamentalMetasFundamentalMetaGroup->primaryKey => $id));
		$this->set('fundamentalMetasFundamentalMetaGroup', $this->FundamentalMetasFundamentalMetaGroup->find('first', $options));
	}

/**
 * add method
 *
 * @return void
 */
	public function add() {
		if ($this->request->is('post')) {
			$this->FundamentalMetasFundamentalMetaGroup->create();
			if ($this->FundamentalMetasFundamentalMetaGroup->save($this->request->data)) {
				$this->Session->setFlash(__('The fundamental metas fundamental meta group has been saved.'));
				return $this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The fundamental metas fundamental meta group could not be saved. Please, try again.'));
			}
		}
		$fundamentalMetas = $this->FundamentalMetasFundamentalMetaGroup->FundamentalMeta->find('list');
		$fundamentalMetaGroups = $this->FundamentalMetasFundamentalMetaGroup->FundamentalMetaGroup->find('list');
		$this->set(compact('fundamentalMetas', 'fundamentalMetaGroups'));
	}

/**
 * edit method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function edit($id = null) {
		if (!$this->FundamentalMetasFundamentalMetaGroup->exists($id)) {
			throw new NotFoundException(__('Invalid fundamental metas fundamental meta group'));
		}
		if ($this->request->is(array('post', 'put'))) {
			if ($this->FundamentalMetasFundamentalMetaGroup->save($this->request->data)) {
				$this->Session->setFlash(__('The fundamental metas fundamental meta group has been saved.'));
				return $this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The fundamental metas fundamental meta group could not be saved. Please, try again.'));
			}
		} else {
			$options = array('conditions' => array('FundamentalMetasFundamentalMetaGroup.' . $this->FundamentalMetasFundamentalMetaGroup->primaryKey => $id));
			$this->request->data = $this->FundamentalMetasFundamentalMetaGroup->find('first', $options);
		}
		$fundamentalMetas = $this->FundamentalMetasFundamentalMetaGroup->FundamentalMeta->find('list');
		$fundamentalMetaGroups = $this->FundamentalMetasFundamentalMetaGroup->FundamentalMetaGroup->find('list');
		$this->set(compact('fundamentalMetas', 'fundamentalMetaGroups'));
	}

/**
 * delete method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function delete($id = null) {
		$this->FundamentalMetasFundamentalMetaGroup->id = $id;
		if (!$this->FundamentalMetasFundamentalMetaGroup->exists()) {
			throw new NotFoundException(__('Invalid fundamental metas fundamental meta group'));
		}
		$this->request->allowMethod('post', 'delete');
		if ($this->FundamentalMetasFundamentalMetaGroup->delete()) {
			$this->Session->setFlash(__('The fundamental metas fundamental meta group has been deleted.'));
		} else {
			$this->Session->setFlash(__('The fundamental metas fundamental meta group could not be deleted. Please, try again.'));
		}
		return $this->redirect(array('action' => 'index'));
	}
}
