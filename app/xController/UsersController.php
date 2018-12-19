<?php
App::uses('AppController', 'Controller');
/**
 * Users Controller
 *
 * @property User $User
 */
class UsersController extends AppController
{

    //public $components = array('SignMeUp.SignMeUp');
    public $components = array('Paginator', 'DataTable', 'RequestHandler');

    public function beforeFilter()
    {
        parent::beforeFilter();

        $this->Auth->allow('logout');
        //$this->Auth->allow('home');
        $this->Auth->allow(array('login','change_password', 'crop', 'upload', 'facebook_logout', 'forgotten_password', 'register', 'activate', 'check_username', 'password_reset', 'list_users', 'list_users2'));



    }



    public function register()
    {
      //   Configure::write('debug', 2);
        // $this->layout = 'default-login';

        if (!$this->data && $this->Session->check('last_post_data')) {
            $this->data = $this->Session->read('last_post_data');
            $this->Session->delete('last_post_data');
        }

        if ($this->request->is('post')) {
//pr($this->data);
//            exit;
            App::import('Vendor', 'recaptchalib');
            $privatekey = "6LfEFO4SAAAAAGPIfwqfm279WRP6C1yIMaRhG9d2";
            $resp = recaptcha_check_answer($privatekey,
                $_SERVER["REMOTE_ADDR"],
                $_POST["recaptcha_challenge_field"],
                $_POST["recaptcha_response_field"]);

            if (!$resp->is_valid) {
                $this->Session->write('last_post_data', $this->data);

                $this->Session->setFlash(__('The reCAPTCHA was not entered correctly. Go back and try it again'));
                $this->redirect(array('action' => 'login'));
            } else {

                // Your code here to handle a successful verification
            }


            //return Security::hash(serialize($data).microtime().rand(1,100), null, true);
            $activationCode = Security::hash(serialize($this->request->data) . microtime() . rand(1, 100), null, true);;
            $this->request->data['User']['activation_code'] = $activationCode;
            $this->request->data['User']['group_id'] = 2;
            $this->User->create();
            if ($this->User->save($this->request->data)) {
                App::uses('CakeEmail', 'Network/Email');
                $Email = new CakeEmail('test');
                $to = $this->request->data['User']['email'];
                $Email->from(array('info@stockbangladesh.com' => 'StockBangladesh Ltd.'))
                    ->template('welcome_registration3','default_notification')
                   // ->template('welcome_registration4')
                    ->emailFormat('html')
                    ->viewVars(array('to' => $to, 'activation' => $activationCode, 'username' => $this->request->data['User']['first_name']))
                    ->to($to)
                    ->subject('Activate your StockBangladesh Account')
                    ->send();

                $this->Session->setFlash(__('Thanks for registering. Please check your Inbox to activate the account'));
                $this->redirect(array('action' => 'login'));
            } else {
                $this->Session->setFlash(__('Please correct the following errors and try again'));
            }
        }

        //$this->SignMeUp->register();
    }

    public function check_username()
    {
        $username = $_REQUEST["username"];
        //$username = "Clark";
        $found = $this->User->find('first', array(
            'conditions' => "User.username LIKE  '$username'",
            'recursive' => 0
        ));
        //pr($found);
        //exit;
        if (empty($found)) {
            echo json_encode(array('status' => 'OK', 'message' => 'Username <b>' . $username . '</b> is available. You can just pick it up!'));
        } else {
            echo json_encode(array('status' => 'ERROR', 'message' => 'Username <b>' . $username . '</b> is not available. Please choose another one.'));
        }
        //echo $username;
        exit;
//        $this->layout = 'ajax';
        //$this->SignMeUp->register();
    }

//http://localhost/omo/users/activate/a104ab14f33c666b35072fcec7230c51ca388f79
    public function activate($activation_code)
    {
        $inactive_user = $this->User->find('first', array('conditions' => "`activation_code` LIKE '$activation_code'", 'recursive' => -1));

        if (count($inactive_user)) {
            if ($inactive_user['User']['active'] == 0) {
                $this->User->id = $inactive_user['User']['id'];
                $this->User->saveField('active', 1);
                $to = $inactive_user['User']['email'];
                $name = $inactive_user['User']['first_name'];

                App::uses('CakeEmail', 'Network/Email');
                $Email = new CakeEmail('test');
                $Email->from(array('info@stockbangladesh.com' => 'StockBangladesh Ltd.'))
                    ->template('after_activation','default_notification')
                    ->emailFormat('html')
                    ->viewVars(array('name' => $name))
                    ->to($to)
                    ->subject('Your account is active now')
                    ->send();

                $this->Session->setFlash(__('Congratulations!Your account is active you can login now'));
                $this->redirect($this->Auth->loginAction);
            } else {
                $this->Session->setFlash(__('Your account is already active'));
                $this->redirect($this->Auth->loginAction);
            }

        } else {
            $this->Session->setFlash(__('Invalid activation code'));
            $this->redirect($this->Auth->loginAction);
        }
    }

    public function forgotten_password()
    {

        $user = $this->User->find('first', array('conditions' => array('email' => $this->request->data('email')), 'recursive' => -1));
        if (!empty($user)) {
            $this->User->id = $user['User']['id'];
            $reset_key = md5(String::uuid());
            if ($this->User->saveField('password_reset', $reset_key)) {

                App::uses('CakeEmail', 'Network/Email');
                $Email = new CakeEmail('test');
                $Email->from(array('info@stockbangladesh.com' => 'StockBangladesh Ltd.'))
                    ->template('forgotten_password','default_notification')

                    ->emailFormat('html')
                    ->viewVars(array('name' => $user['User']['username'], 'reset_key' => $reset_key))
                    ->to($this->request->data('email'))
                    ->subject('Password Reset Request')
                    ->send();

                $this->Session->setFlash('Thank you. A password recovery email has now been sent to ' . $this->request->data('email'));
                $this->redirect($this->Auth->loginAction);

            }
        } else {
            $this->Session->setFlash('No user found with email: ' . $this->request->data('email'));
            $this->redirect($this->Auth->loginAction);
        }
    }
    public function forgotten_username()
    {

        $user = $this->User->find('first', array('conditions' => array('email' => $this->request->data('email')), 'recursive' => -1));
        if (!empty($user)) {
            App::uses('CakeEmail', 'Network/Email');
            $Email = new CakeEmail('test');
            $Email->from(array('info@stockbangladesh.com' => 'StockBangladesh Ltd.'))
                ->template('forgotten_username','default_notification')
                ->emailFormat('text')
                ->viewVars(array('name' => $user['User']['username']))
                ->to($this->request->data('email'))
                ->subject('Password Reset Request')
                ->send();

            $this->Session->setFlash('Thank you. A password recovery email has now been sent to ' . $this->request->data('email'));
            $this->redirect($this->Auth->loginAction);

        } else {
            $this->Session->setFlash('No user found with email: ' . $this->request->data('email'));
            $this->redirect($this->Auth->loginAction);
        }
    }

    public function password_reset($reset_key='none')
    {
      //  Configure::write('debug', 2);
        $this->set('reset_key',$reset_key);

        $user = $this->User->find('first', array('conditions' => "`password_reset` LIKE '$reset_key'", 'recursive' => -1));

        if (count($user)) {
        if ($this->data) {

                $this->User->id = $user['User']['id'];
                $user['User']['password'] = $this->data['User']['password'];
                $user['User']['password_reset'] = null;
                if ($this->User->save($user)) {

                    App::uses('CakeEmail', 'Network/Email');
                    $Email = new CakeEmail('test');
                    $Email->from(array('info@stockbangladesh.com' => 'StockBangladesh Ltd.'))
                        ->template('new_password','default_notification')
                        ->emailFormat('html')
                        ->viewVars(array('name' => $user['User']['username'], 'password' => $user['User']['password']))
                        ->to($user['User']['email'])
                        ->subject('Your password reset successful')
                        ->send();

                    $this->Session->setFlash(__('Your password reset successfully'));
                    $this->redirect($this->Auth->loginAction);
                }
            }


        }else
        {
            $this->Session->setFlash(__('Invalid reset key'));
            $this->redirect($this->Auth->loginAction);
        }

    }

    public function change_password()
    {
          Configure::write('debug', 2);
        $userId=$this->Session->read('Auth.User.id');
$currentPassword=$this->data['User']['cpassword'];
        $currentPassword=AuthComponent::password($currentPassword);
        $user = $this->User->find('first', array('conditions' => "`id` = $userId and password LIKE '$currentPassword'", 'recursive' => -1));

        if (count($user)) {
            if ($this->data) {

                $this->User->id = $user['User']['id'];
                $user['User']['password'] = $this->data['User']['password'];

                if ($this->User->save($user)) {

                  /*  App::uses('CakeEmail', 'Network/Email');
                    $Email = new CakeEmail('test');
                    $Email->from(array('info@stockbangladesh.com' => 'StockBangladesh Ltd.'))
                        ->template('new_password','default_notification')
                        ->emailFormat('html')
                        ->viewVars(array('name' => $this->data['User']['username'], 'password' => $this->data['User']['password']))
                        ->to($this->data['User']['email'])
                        ->subject('Your password changed successful')
                        ->send();*/

                    $this->Session->setFlash(__('Your password changed successfully'));

                }
            }


        }else
        {
            $this->Session->setFlash(__('Please enter your valid current password'));

        }

        $this->redirect(
            array('controller' => 'users', 'action' => 'home')
        );

    }

    protected function _setCookie($id)
    {
        if (!$this->request->data('User.remember_me')) {
            return false;
        }
        $data = array(
            'username' => $this->request->data('User.username'),
            'password' => $this->request->data('User.password')
        );
        $this->Cookie->write('User', $data, true, '+2 week');
        return true;
    }

    protected function _setUuid($id)
    {
        $uuid = String::uuid();
        //Cache::write($id, $uuid, 'login');
        Cache::write($id, $id, 'login');
        $uuidArr = array();
        $uuidArr['uuid'] = $uuid;
        $uuidArr['id'] = $id;

        $this->Cookie->write('uuidArr', $uuidArr, true, '+2 week');
        //$this->Session->write('Auth.User.uuid',$uuid);
        return true;
    }

    protected function _isMulti($id)
    {
        if (Cache::read($id)) {
            return true;
        }
        /* $cuuid=$this->Cookie->read('uuid');
         $uuid=Cache::read($id);
         if($cuuid==$uuid)
             return false;

         Cache::write($id, $uuid, 'login');
         $this->Cookie->write('uuid', $uuid, true, '+2 week');
         return true;*/
    }

    /*protected function _setUuid($id)
    {
        $uuid=String::uuid();
        Cache::write($id, $uuid, 'login');
        $this->Cookie->write('uuid', $uuid, true, '+2 week');
        return true;
    }*/

    public function login()
    {
        $this->layout = 'default-login';

        //    exit;

        $this->set('loadRegisterForm', 0);
        if (!$this->data && $this->Session->check('last_post_data')) {
            $this->data = $this->Session->read('last_post_data');
            $this->Session->delete('last_post_data');
            $this->set('loadRegisterForm', 1);
        }

        if ($this->request->is('post')) {
//pr($this->request);
            if ($this->Auth->login()) {
                // pr($this->data);

                if ($this->Auth->user('active') == 0) {
                    $this->Session->setFlash("You haven't activated your account yet. Please check your email.");
                    $this->redirect($this->Auth->logout());
                }

                $this->_setCookie($this->Auth->user('id'));
                $authenticateVariable='auth_'.$this->Auth->user('id');
                if (Cache::read($authenticateVariable)) {
                    $this->Session->setFlash('Another user already logged in using same username');
                    // Cache::delete($this->Auth->user('id'));
                    $this->redirect($this->Auth->logout());
                }
                //Cache::write($this->Auth->user('id'), $this->Auth->user('id'), 'login');
                Cache::write($authenticateVariable, $this->getIp(), 'login');
                // $this->_setUuid($this->Auth->user('id'));
                $this->redirect($this->Auth->redirect());
            } else {
                $this->Session->setFlash('Your username or password was incorrect.');
            }
        }

        /*if ($this->Session->read('Auth.User')) {
            $this->Session->setFlash('You are logged in!');
            $this->redirect('/', null, false);
        }*/

        if ($this->Auth->loggedIn() || $this->Auth->login()) {
            return $this->redirect($this->Auth->redirectUrl());
        }

    }


    public function logout()
    {
        $this->Session->setFlash('You are now logout.');
        $authenticateVariable='auth_'.$this->Auth->user('id');
        Cache::delete($authenticateVariable);
        $this->Session->write('fbLogout', true);
        $this->Session->delete('FB');
        //$this->Auth->logout();
        $this->Session->destroy();

        $this->redirect($this->Auth->logout());
    }

    /**
     * index method
     *
     * @return void
     */
    public function index()
    {
        $this->User->recursive = 0;
        $this->set('users', $this->paginate());
    }

    /**
     * view method
     *
     * @throws NotFoundException
     * @param string $id
     * @return void
     */
    public function view($id = null)
    {
        $this->User->id = $id;
        if (!$this->User->exists()) {
            throw new NotFoundException(__('Invalid user'));
        }
        $this->set('user', $this->User->read(null, $id));
    }

    /**
     * add method
     *
     * @return void
     */
    public function add()
    {
        if ($this->request->is('post')) {
            $this->User->create();
            if ($this->User->save($this->request->data)) {
                $this->Session->setFlash(__('The user has been saved'));
                $this->redirect(array('action' => 'index'));
            } else {
                $this->Session->setFlash(__('The user could not be saved. Please, try again.'));
            }
        }
        $groups = $this->User->Group->find('list');
        $this->set(compact('groups'));
    }

    /**
     * edit method
     *
     * @throws NotFoundException
     * @param string $id
     * @return void
     */
    public function edit($id = null)
    {
        $this->User->id = $id;
        if (!$this->User->exists()) {
            throw new NotFoundException(__('Invalid user'));
        }
        if ($this->request->is('post') || $this->request->is('put')) {
            if ($this->User->save($this->request->data)) {
                $this->Session->setFlash(__('The user has been saved'));
                $this->redirect(array('action' => 'index'));
            } else {
                $this->Session->setFlash(__('The user could not be saved. Please, try again.'));
            }
        } else {
            $this->request->data = $this->User->read(null, $id);
        }
        $groups = $this->User->Group->find('list');
        $this->set(compact('groups'));
    }

    /**
     * delete method
     *
     * @throws MethodNotAllowedException
     * @throws NotFoundException
     * @param string $id
     * @return void
     */
    public function delete($id = null)
    {
        if (!$this->request->is('post')) {
            throw new MethodNotAllowedException();
        }
        $this->User->id = $id;
        if (!$this->User->exists()) {
            throw new NotFoundException(__('Invalid user'));
        }
        if ($this->User->delete()) {
            $this->Session->setFlash(__('User deleted'));
            $this->redirect(array('action' => 'index'));
        }
        $this->Session->setFlash(__('User was not deleted'));
        $this->redirect(array('action' => 'index'));
    }

    /**
     * index method
     *
     * @return void
     * @todo its getting permission to all- find out why
     */
    public function home()
    {
        Configure::write('debug', 2);

        $this->User->bindModel(
            array('hasMany' => array(
                'UserInformation' => array(
                    'className' => 'UserInformation'
                )
            ),
                'belongsTo' => array(
                    'Broker' => array(
                        'className' => 'Group',
                        'foreignKey' => 'broker_id',
                        'conditions' => '',
                        'fields' => '',
                        'order' => ''
                    ),'Portfolio' => array(
                        'className' => 'Portfolio',
                        'foreignKey' => 'portfolio_id',
                        'conditions' => '',
                        'fields' => '',
                        'order' => ''
                    )
                )
            )
        );

        $userInfo = $this->User->find('first', array(
            'conditions' => "User.id=2",
            'recursive' => 1
        ));
        pr($userInfo);
exit;
        $StockBangladesh = $this->Components->load('StockBangladesh');
        $MetaData = $StockBangladesh->getMetaKeyByGroup(0, 'user_informations');
        if(is_array($MetaData)) {
            $MetaData = Hash::combine($MetaData, '{n}.Meta.id', '{n}.Meta.meta_key');
        }

        $id=0;
        $userData=array();
        $profile_pic='no_pic.gif';

        if($this->Auth->user('id')) {
            $id = $this->Auth->user('id');

            $userInfo = $this->User->find('first', array(
                'conditions' => "User.id=$id",
                'recursive' => 1
            ));

            $userInformation = $userInfo['UserInformation'];
            $userInformation = Hash::sort($userInformation, '{n}.id', 'asc');
            $userData = array();
            foreach ($userInformation as $info) {
                $metaKey = $MetaData[$info['meta_id']];
                $userData['UserInformation'][$metaKey] = $info['meta_value'];

            }
            $profile_pic=$userInfo['User']['profile_pic'];
            $filename="files/profiles/$profile_pic";

            if (!file_exists($filename)) {
                $profile_pic='no_pic.gif';
            }

        }




        $this->set('profile_pic',$profile_pic);



        $this->set('userData',$userData);


    }

    public function upload()
    {

        App::import('Vendor', 'UploadHandler', array('file' => 'file.upload/UploadHandler.php'));

        $upload_handler = new UploadHandler();

        exit;
    }

    public function crop()
    {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $targ_w = $targ_h = 245;
            $jpeg_quality = 90;

            //$src = './demos/demo_files/image5.jpg';
            $profile_img_dir = "files/profiles/";
            $crop_img_dir ="files/";


            $src_file_name = $_POST['imgsrc'];

            $src=$crop_img_dir.$src_file_name;
            $profile_img_scr=$profile_img_dir.$src_file_name;

            $img_r = imagecreatefromjpeg($src);

            $dst_r = ImageCreateTrueColor($targ_w, $targ_h);

            imagecopyresampled($dst_r, $img_r, 0, 0, intval($_POST['x']), intval($_POST['y']), $targ_w, $targ_h, intval($_POST['w']), intval($_POST['h']));

            imagejpeg($dst_r, $profile_img_scr);

            $this->User->id = $this->Auth->user('id');
            $this->User->saveField('profile_pic', $src_file_name);
            //  header('Content-type: image/jpeg');
            //  imagejpeg($dst_r,null,$jpeg_quality);
            echo Router::url('/', true)."files/profiles/$src_file_name";
            exit;
        }

        exit;
    }

    public function list_users()
    {

        if ($this->RequestHandler->responseType() == 'json') {
            $this->paginate = array(
                'fields' => array('User.username', 'User.middle_name', 'User.email', 'User.created'),
            );
            /* $this->set('cities', $this->DataTable->getResponse());
             $this->set('_serialize','cities');*/

            $this->DataTable->mDataProp = true;
            $this->set('response', $this->DataTable->getResponse());
            $this->set('_serialize', 'response');
        }

    }


    public function list_users2()
    {


    }


}
