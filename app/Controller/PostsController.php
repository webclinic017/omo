<?php
class PostsController extends AppController
{
    public $helpers = array('Html', 'Form');

    public function index()
    {
        $this->set('posts', $this->Post->find('all'));
    }

    public function dashboard()
    {

        // $this->layout = 'ajax';
        $this->layout = 'default3';
        //$style='class="active"';
        /* if(isset($this->params['requested'])) {

             return Router::reverse($this->request, true);
         }*/

    }

    public function test()
    {
        $post['Post']['id']=1;
        $post['Post']['title']="test title";
        $post['Post']['body']="test Bodyyyyyyyyyyyyyy";

        $this->set('post',$post);
        $this->layout = 'ajax';

    }
    public function test2()
    {

        $this->layout = 'ajax';

    }

    public function view($id = null)
    {
        if (!$id) {
            throw new NotFoundException(__('Invalid post'));
        }

        $post = $this->Post->findById($id);
        if (!$post) {
            throw new NotFoundException(__('Invalid post'));
        }
        $this->set('post', $post);
    }
}

?>