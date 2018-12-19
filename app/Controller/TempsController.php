<?php
App::uses('AppController', 'Controller');
/**
 * Users Controller
 *
 * @property User $User
 */
class TempsController extends AppController
{

    //public $components = array('SignMeUp.SignMeUp');
    public $components = array('Paginator', 'DataTable', 'RequestHandler');

    public function beforeFilter()
    {
        parent::beforeFilter();

        $this->Auth->allow();



    }




    public function test()
    {
echo "here";
        exit;

    }


}
