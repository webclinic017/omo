<?php
App::uses('AppController', 'Controller');
/**
 * Feedbacks Controller
 *
 * @property Feedback $Feedback
 * @property PaginatorComponent $Paginator
 */
class FeedbacksController extends AppController {

    public function beforeFilter() {
        parent::beforeFilter();

        //$this->Auth->allow('test');
        $this->Auth->allow();

    }
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
		$this->Feedback->recursive = 0;
		$this->set('feedbacks', $this->Paginator->paginate());
	}
public function send_feedback() {
    $this->layout='ajax';
    App::uses('CakeTime', 'Utility');
    $apps_code=$this->request->data['Feedback']['apps_code'];
    if($this->Auth->user('id'))
        $user_id=$this->Auth->user('id');
    else
        $user_id=0;
    $applicationInfo = $this->Feedback->query("SELECT *  FROM `applications` WHERE `apps_code` LIKE '$apps_code'");
    $this->request->data['Feedback']['application_id']=$applicationInfo[0]['applications']['id'];
    $this->request->data['Feedback']['apps_code']=$apps_code;
    $this->request->data['Feedback']['status']='new';
    $this->request->data['Feedback']['user_id']=$user_id;
    //$this->request->data['Feedback']['feedback_user_contact']=$user_id;
    $this->request->data['Feedback']['submitted_at']=CakeTime::format(CakeTime::fromString('now'), '%Y-%m-%d %H:%M:%S');
    $t=$this->request->data;
    $post=$t;
    $this->set("post",$post);
    //$this->Feedback->user_feedback_email=$email;

    $this->Feedback->save($this->request->data);

	}

/**
 * view method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function view($id = null) {
		if (!$this->Feedback->exists($id)) {
			throw new NotFoundException(__('Invalid feedback'));
		}
		$options = array('conditions' => array('Feedback.' . $this->Feedback->primaryKey => $id));
		$this->set('feedback', $this->Feedback->find('first', $options));
	}

/**
 * add method
 *
 * @return void
 */
	public function add() {
		if ($this->request->is('post')) {
			$this->Feedback->create();
			if ($this->Feedback->save($this->request->data)) {
				$this->Session->setFlash(__('The feedback has been saved.'));
				return $this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The feedback could not be saved. Please, try again.'));
			}
		}
		$applications = $this->Feedback->Application->find('list');
		$users = $this->Feedback->User->find('list');
		$this->set(compact('applications', 'users'));
	}

/**
 * edit method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function edit($id = null) {
		if (!$this->Feedback->exists($id)) {
			throw new NotFoundException(__('Invalid feedback'));
		}
		if ($this->request->is(array('post', 'put'))) {
			if ($this->Feedback->save($this->request->data)) {
				$this->Session->setFlash(__('The feedback has been saved.'));
				return $this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The feedback could not be saved. Please, try again.'));
			}
		} else {
			$options = array('conditions' => array('Feedback.' . $this->Feedback->primaryKey => $id));
			$this->request->data = $this->Feedback->find('first', $options);
		}
		$applications = $this->Feedback->Application->find('list');
		$users = $this->Feedback->User->find('list');
		$this->set(compact('applications', 'users'));
	}

/**
 * delete method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function delete($id = null) {
		$this->Feedback->id = $id;
		if (!$this->Feedback->exists()) {
			throw new NotFoundException(__('Invalid feedback'));
		}
		$this->request->onlyAllow('post', 'delete');
		if ($this->Feedback->delete()) {
			$this->Session->setFlash(__('The feedback has been deleted.'));
		} else {
			$this->Session->setFlash(__('The feedback could not be deleted. Please, try again.'));
		}
		return $this->redirect(array('action' => 'index'));
	}

/**
 * admin_index method
 *
 * @return void
 */
	public function admin_index() {
		$this->Feedback->recursive = 0;
		$this->set('feedbacks', $this->Paginator->paginate());
	}

/**
 * admin_view method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function admin_view($id = null) {
		if (!$this->Feedback->exists($id)) {
			throw new NotFoundException(__('Invalid feedback'));
		}
		$options = array('conditions' => array('Feedback.' . $this->Feedback->primaryKey => $id));
		$this->set('feedback', $this->Feedback->find('first', $options));
	}

/**
 * admin_add method
 *
 * @return void
 */
	public function admin_add() {
		if ($this->request->is('post')) {
			$this->Feedback->create();
			if ($this->Feedback->save($this->request->data)) {
				$this->Session->setFlash(__('The feedback has been saved.'));
				return $this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The feedback could not be saved. Please, try again.'));
			}
		}
		$applications = $this->Feedback->Application->find('list');
		$users = $this->Feedback->User->find('list');
		$this->set(compact('applications', 'users'));
	}

/**
 * admin_edit method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function admin_edit($id = null) {
		if (!$this->Feedback->exists($id)) {
			throw new NotFoundException(__('Invalid feedback'));
		}
		if ($this->request->is(array('post', 'put'))) {
			if ($this->Feedback->save($this->request->data)) {
				$this->Session->setFlash(__('The feedback has been saved.'));
				return $this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The feedback could not be saved. Please, try again.'));
			}
		} else {
			$options = array('conditions' => array('Feedback.' . $this->Feedback->primaryKey => $id));
			$this->request->data = $this->Feedback->find('first', $options);
		}
		$applications = $this->Feedback->Application->find('list');
		$users = $this->Feedback->User->find('list');
		$this->set(compact('applications', 'users'));
	}

/**
 * admin_delete method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function admin_delete($id = null) {
		$this->Feedback->id = $id;
		if (!$this->Feedback->exists()) {
			throw new NotFoundException(__('Invalid feedback'));
		}
		$this->request->onlyAllow('post', 'delete');
		if ($this->Feedback->delete()) {
			$this->Session->setFlash(__('The feedback has been deleted.'));
		} else {
			$this->Session->setFlash(__('The feedback could not be deleted. Please, try again.'));
		}
		return $this->redirect(array('action' => 'index'));
	}}
