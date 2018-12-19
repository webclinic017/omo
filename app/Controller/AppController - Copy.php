<?php
/**
 * Application level Controller
 *
 * This file is application-wide controller file. You can put all
 * application-wide controller-related methods here.
 *
 * PHP 5
 *
 * CakePHP(tm) : Rapid Development Framework (http://cakephp.org)
 * Copyright (c) Cake Software Foundation, Inc. (http://cakefoundation.org)
 *
 * Licensed under The MIT License
 * For full copyright and license information, please see the LICENSE.txt
 * Redistributions of files must retain the above copyright notice.
 *
 * @copyright     Copyright (c) Cake Software Foundation, Inc. (http://cakefoundation.org)
 * @link          http://cakephp.org CakePHP(tm) Project
 * @package       app.Controller
 * @since         CakePHP(tm) v 0.2.9
 * @license       http://www.opensource.org/licenses/mit-license.php MIT License
 */
App::uses('Controller', 'Controller');

/**
 * Application Controller
 *
 * Add your application-wide methods in the class below, your controllers
 * will inherit them.
 *
 * @package        app.Controller
 * @link        http://book.cakephp.org/2.0/en/controllers.html#the-app-controller
 */
class AppController extends Controller
{
    //public $components = array('DebugKit.Toolbar');

    public $components = array(
        'Acl',
        'Auth' => array(
            'authorize' => array(
                'Actions' => array('actionPath' => 'controllers')
            ),
            'authError' => 'Did you really think you are allowed to see that?'
        ),
        'Session',
        'Cookie',
        'DebugKit.Toolbar',
        'Crud.Crud' => array(
            'actions' => array(
                'index', 'add', 'edit', 'view', 'delete'
            )
        ),
        //'Facebook.Connect'
        'Facebook.Connect'=> array('model' => 'User')


    );




    public $helpers = array(
        'Html'
        ,'Form' => array('className' => 'BootstrapForm' )
        ,'Session'
        ,'AssetCompress.AssetCompress'
       // ,'MinifyHtml.MinifyHtml'
        ,'Facebook.Facebook'

    );


    public function beforeFilter()
    {
        $this->Auth->allow();
       // $this->layout = 'default_3_3';

        $this->Cookie->type('rijndael'); //Enable AES symetric encryption of cookie
        $this->Auth->loginAction = array('controller' => 'users', 'action' => 'login');
        $this->Auth->logoutRedirect = array('controller' => 'users', 'action' => 'login');
        $this->Auth->loginRedirect = array('controller' => 'dashboards', 'action' => 'trade');
        $this->Auth->unauthorizedRedirect = array('controller' => 'dashboards', 'action' => 'home');
       /* $this->Auth->authenticate = array(
            'Cookie' => array(
                'fields' => array(
                    'username' => 'username',
                    'password' => 'password'
                ),
                'userModel' => 'User',
            ),
            'Form'
        );*/


        /*SET ALL MENU AVAILABALE IN VIEW*/

        $this->menu_define();

        /*PROCESS ALL CSS AND SET THEM TO BE AVAILABLE IN LAYOUT*/
        $globalCss = Configure::read('css.global');

        $themeCss = array();
        if (Configure::check('css.theme'))
            $themeCss = Configure::read('css.theme');

        $pageCss = array();

        if (Configure::check('css.' . strtolower($this->params['controller']) . '.' . strtolower($this->params['action'])))
            $pageCss = Configure::read('css.' . strtolower($this->params['controller']) . '.' . strtolower($this->params['action']));

        $allCss = array_merge($globalCss, $themeCss, $pageCss);
        $allCss = array_unique($allCss);
        $this->set('allCss', $allCss);


        /*PROCESS ALL SCRIPT AND SET THEM TO BE AVAILABLE IN LAYOUT*/
        $globalScript = Configure::read('script.global');

        $pageScript = array();
        if (Configure::check('script.' . strtolower($this->params['controller']) . '.' . strtolower($this->params['action'])))
            $pageScript = Configure::read('script.' . strtolower($this->params['controller']) . '.' . strtolower($this->params['action']));

        $allScripts = array_merge($globalScript, $pageScript);
        $allScripts = array_unique($allScripts);
        $this->set('allScripts', $allScripts);

        $this->set('css_asset_compression_enable', false);
        $this->set('js_asset_compression_enable', false);


        /*
         * variable to pass into js file
         * */
        $cakeToJsArr = array();
        $cakeToJsArr['url'] = Router::url('/', true);
        $cakeToJsArr = json_encode($cakeToJsArr);
        $this->set('cakeToJsArr', $cakeToJsArr);


        if ($this->Auth->loggedIn()) {
            $authenticateVariable='omoauth_'.$this->Auth->user('id');
            Cache::write($authenticateVariable, $this->getIp(), 'login');
        }

    }

    public function getIp() {
        $ip = $_SERVER['REMOTE_ADDR'];

        if (!empty($_SERVER['HTTP_CLIENT_IP'])) {
            $ip = $_SERVER['HTTP_CLIENT_IP'];
        } elseif (!empty($_SERVER['HTTP_X_FORWARDED_FOR'])) {
            $ip = $_SERVER['HTTP_X_FORWARDED_FOR'];
        }

        return $ip;
    }

    /**
     * List of components which can handle action invocation
     * @var array
     */
    public $dispatchComponents = array();

    /**
     * Dispatches the controller action. Checks that the action exists and isn't private.
     *
     * If CakePHP raises MissingActionException we attempt to execute Crud
     *
     * @param CakeRequest $request
     * @return mixed The resulting response.
     * @throws PrivateActionException When actions are not public or prefixed by _
     * @throws MissingActionException When actions are not defined and scaffolding and CRUD is not enabled.
     */
    public function invokeAction(CakeRequest $request)
    {
        try {
            return parent::invokeAction($request);
        } catch (MissingActionException $e) {
            // Check for any dispatch components
            if (!empty($this->dispatchComponents)) {
                // Iterate dispatchComponents
                foreach ($this->dispatchComponents as $component => $enabled) {
                    // Skip them if they aren't enabled
                    if (empty($enabled)) {
                        continue;
                    }

                    // Skip if isActionMapped isn't defined in the Component
                    if (!method_exists($this->{$component}, 'isActionMapped')) {
                        continue;
                    }

                    // Skip if the action isn't mapped
                    if (!$this->{$component}->isActionMapped($request->params['action'])) {
                        continue;
                    }

                    // Skip if execute isn't defined in the Component
                    if (!method_exists($this->{$component}, 'execute')) {
                        continue;
                    }

                    // Execute the callback, can return CakeResponse object
                    return $this->{$component}->execute();
                }
            }

            // No additional callbacks, re-throw the normal Cake exception
            throw $e;
        }
    }

    public function menu_define()
    {
        $menu = Configure::read('menu');
//pr($menu);
       //exit;
        // For default settings name must be menu
        $this->set(compact('menu'));
    }


}
