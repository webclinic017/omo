<?php
App::uses('AppController', 'Controller');
/**
 * FundamentalMetas Controller
 *
 * @property FundamentalMeta $FundamentalMeta
 * @property PaginatorComponent $Paginator
 */
class FundamentalMetasController extends AppController {

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
		$this->FundamentalMeta->recursive = 0;
		$this->set('fundamentalMetas', $this->Paginator->paginate());
	}

/**
 * view method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function view($id = null) {
		if (!$this->FundamentalMeta->exists($id)) {
			throw new NotFoundException(__('Invalid fundamental meta'));
		}
		$options = array('conditions' => array('FundamentalMeta.' . $this->FundamentalMeta->primaryKey => $id));
		$this->set('fundamentalMeta', $this->FundamentalMeta->find('first', $options));
	}

/**
 * add method
 *
 * @return void
 */
	public function add() {
		if ($this->request->is('post')) {
			$this->FundamentalMeta->create();
			if ($this->FundamentalMeta->save($this->request->data)) {
				$this->Session->setFlash(__('The fundamental meta has been saved.'));
				return $this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The fundamental meta could not be saved. Please, try again.'));
			}
		}
		$fundamentalMetaGroups = $this->FundamentalMeta->FundamentalMetaGroup->find('list');
		$this->set(compact('fundamentalMetaGroups'));
	}

/**
 * edit method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function edit($id = null) {
		if (!$this->FundamentalMeta->exists($id)) {
			throw new NotFoundException(__('Invalid fundamental meta'));
		}
		if ($this->request->is(array('post', 'put'))) {
			if ($this->FundamentalMeta->save($this->request->data)) {
				$this->Session->setFlash(__('The fundamental meta has been saved.'));
				return $this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The fundamental meta could not be saved. Please, try again.'));
			}
		} else {
			$options = array('conditions' => array('FundamentalMeta.' . $this->FundamentalMeta->primaryKey => $id));
			$this->request->data = $this->FundamentalMeta->find('first', $options);
		}
		$fundamentalMetaGroups = $this->FundamentalMeta->FundamentalMetaGroup->find('list');
		$this->set(compact('fundamentalMetaGroups'));
	}

/**
 * delete method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function delete($id = null) {
		$this->FundamentalMeta->id = $id;
		if (!$this->FundamentalMeta->exists()) {
			throw new NotFoundException(__('Invalid fundamental meta'));
		}
		$this->request->allowMethod('post', 'delete');
		if ($this->FundamentalMeta->delete()) {
			$this->Session->setFlash(__('The fundamental meta has been deleted.'));
		} else {
			$this->Session->setFlash(__('The fundamental meta could not be deleted. Please, try again.'));
		}
		return $this->redirect(array('action' => 'index'));
	}
}
