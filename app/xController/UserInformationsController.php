<?php
App::uses('AppController', 'Controller');
/**
 * UserInformations Controller
 *
 * @property UserInformation $UserInformation
 * @property PaginatorComponent $Paginator
 */
class UserInformationsController extends AppController {

/**
 * Components
 *
 * @var array
 */
	public $components = array('Paginator');

    public function beforeFilter()
    {
        parent::beforeFilter();


        $this->Auth->allow(array('update_users'));



    }


/**
 * index method
 *
 * @return void
 */
	public function index() {
		$this->UserInformation->recursive = 0;
		$this->set('userInformations', $this->Paginator->paginate());
	}

/**
 * view method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function view($id = null) {
		if (!$this->UserInformation->exists($id)) {
			throw new NotFoundException(__('Invalid user information'));
		}
		$options = array('conditions' => array('UserInformation.' . $this->UserInformation->primaryKey => $id));
		$this->set('userInformation', $this->UserInformation->find('first', $options));
	}

/**
 * add method
 *
 * @return void
 */
	public function add() {
		if ($this->request->is('post')) {
			$this->UserInformation->create();
			if ($this->UserInformation->save($this->request->data)) {
				$this->Session->setFlash(__('The user information has been saved.'));
				return $this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The user information could not be saved. Please, try again.'));
			}
		}
		$users = $this->UserInformation->User->find('list');
		$metas = $this->UserInformation->Meta->find('list');
		$this->set(compact('users', 'metas'));
	}

/**
 * edit method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function edit($id = null) {
		if (!$this->UserInformation->exists($id)) {
			throw new NotFoundException(__('Invalid user information'));
		}
		if ($this->request->is(array('post', 'put'))) {
			if ($this->UserInformation->save($this->request->data)) {
				$this->Session->setFlash(__('The user information has been saved.'));
				return $this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The user information could not be saved. Please, try again.'));
			}
		} else {
			$options = array('conditions' => array('UserInformation.' . $this->UserInformation->primaryKey => $id));
			$this->request->data = $this->UserInformation->find('first', $options);
		}
		$users = $this->UserInformation->User->find('list');
		$metas = $this->UserInformation->Meta->find('list');
		$this->set(compact('users', 'metas'));
	}

/**
 * delete method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function delete($id = null) {
		$this->UserInformation->id = $id;
		if (!$this->UserInformation->exists()) {
			throw new NotFoundException(__('Invalid user information'));
		}
		$this->request->allowMethod('post', 'delete');
		if ($this->UserInformation->delete()) {
			$this->Session->setFlash(__('The user information has been deleted.'));
		} else {
			$this->Session->setFlash(__('The user information could not be deleted. Please, try again.'));
		}
		return $this->redirect(array('action' => 'index'));
	}

    public function update_users($id = null) {
        Configure::write('debug', 2);
        pr($this->data);
        $userId=$this->Session->read('Auth.User.id');
        $dataToSave=array();
        if($userId) {
            $StockBangladesh = $this->Components->load('StockBangladesh');
            $MetaData = $StockBangladesh->getMetaKeyByGroup(0, 'user_informations');
            $MetaData = Hash::combine($MetaData, '{n}.Meta.meta_key', '{n}.Meta.id');


            foreach($this->data['UserInformation'] as $metaKey=>$metaVal)
            {
                $temp=array();
                    $temp['user_id']=$userId;
                    $temp['meta_id']=$MetaData[trim($metaKey)];
                    $temp['meta_value']=trim($metaVal);
                if(!empty($metaVal))
                $dataToSave[]=$temp;
            }

            pr($MetaData);
        }

        if (!empty($dataToSave)) {

            $this->UserInformation->saveMany($dataToSave, array('atomic' => true));
            $this->Session->setFlash('User information updated');


        }
        pr($dataToSave);

        return $this->redirect(
            array('controller' => 'users', 'action' => 'home')
        );

    }
}
