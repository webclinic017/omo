<?php
App::uses('AppController', 'Controller');


class TestController  extends Controller{
	
    public function index($id)
    {
        
        Configure::write('debug', 2);

        $objPHPExcel = new PHPExcel();
        dd("df");
        $dbh = new PDO('mysql:host=localhost;dbname=stocknet_omonew', "stocknet_userdb", "Pb&lyTR=iez(");
    	echo "<pre>";
    	$query = $dbh->query("select * from portfolio_transactions where portfolio_id in (select id from portfolios where broker = $id)");
    	$rows = $query->fetchAll();
    	print_r($rows);
        exit;
    }

}
