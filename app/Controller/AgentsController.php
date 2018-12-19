<?php
class AgentsController extends AppController
{
    public function beforeFilter()
    {
        parent::beforeFilter();

        $this->Auth->allow();



    }
    function agentRegistration()
    {

    }
}

?>