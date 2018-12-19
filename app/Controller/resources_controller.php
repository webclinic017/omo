<?php
/*
 * @author: 
 * @Controller: To maintain resource functions
 *
 * Created: 25-02-2010
 *
 */

class ResourcesController extends AppController {
	
	var $uses = array ('Symbol', 'Simulation', 'User', 'MarketSummery', 'Output', 'Settingmonitor','Datasetting','Datatitlehead','Sectorsetting','News','NewsType','Symboladjustment');
	
	//var $cacheAction = true;
//	var $paginate = array ('limit' => 5 );
	
    function beforeFilter() {
       parent::beforeFilter();
       $this->Auth->allow('index','minchart2','datamatrixsetting','marketsum','getsectorweekcompare','getsectorweekvolumecompare','sectorweekvolumecompare','datamatrixhead','matrixsetting','sectortracker','getsectorlist','datamatrixsector','dsenews','latestnews','portfoliodatamatrix','getpricelistforportfolio','multibar','multibar1','multibar2','gegainloose','pyramid','perarea','dsechartcompare','volcompare','closeprice','predict_eps','report_dsechart','index_review','admin_observation_add','secminchartdraw','sectorminutechart','about_coefficient','share_impact','mutual_fund_chart','corporate_announcement','news_report','admin_reportnews_add','topten_fundamental','sector_analysis','market_yield','peg_ratio','sector_beta','sector_pe','category_pe','individual_return','share_impact','minutechartprev','getweekchart','navchart' ,'share_impact_sector','index_chart','mcap_review','toptenvalue', 'toptengainer','weeklytopten','index_mover','sbindexcompare','trdvolumecompare','sectorwise_comparison','sectorwise_tradevalue_compare','sectorwise_marketcontribution_compare', 'sectorwise_tradevalueChange_compare','sectorwise_vol_compare','sectorwise_gainer_compare','sectorwise_gainer_depth_compare','sectorwise_prev_gainer_depth_compare','sectorwise_looser_compare', 'sectorwise_unchange_compare','sectorwise_hawla_compare','sectorwise_mcap_compare','sectorchart','mmSectorChart','sector_intraday','insert_peg_ratio','insert_rrr_beta','insert_contributor','insert_yield_payout','__generate_erm');
       //$this->Auth->deny('datamatrix');
    }
    
     
 function __generate_erm($symbol = '')
    {
        //Configure::write('debug',3);
        $this->layout = 'default-one';
        $this->pageTitle = 'Stock Bangladesh :: Beta Coefficient';

        $this->set('key',$symbol);
        
        $dscgenArr = $this->Output->find ( 'all', array ('conditions' => array ('symbol = 1'), 'fields' => array ('close', 'date' ), 'order' => 'id DESC','limit'=>520));
        $dateWiseGeneralIndex = array();
        for($i = 0; $i < count($dscgenArr); $i++)
        {                    
            $dateWiseGeneralIndex[$dscgenArr[$i]['Output']['date']]   = $dscgenArr[$i]['Output']['close'];                    
        }
        
        $preindex = 0;
        $totalErm = 0;
        foreach($dateWiseGeneralIndex as $date=>$genindex)
        {
            if(($preindex!=0)&&($dateWiseGeneralIndex[$date]!=0))
                 {
                   $ERmValue = (($preindex-$dateWiseGeneralIndex[$date])/$dateWiseGeneralIndex[$date])*100;///calculate the return value
                   $ERmarray[] = $ERmValue;
                 }
            $preindex = $dateWiseGeneralIndex[$date];
            
        }
        $ERm= array_sum($ERmarray) / count($ERmarray); 
        
        //$beta_info = $this->__betacoefficient($symbol);
        //$individual_beta = $beta_info[$symbol]['beta'];
        //$individual_return = .05+ (($ERm - .05)*$individual_beta);
        return $ERm;
        
        
    }
 
 
 function insert_peg_ratio()
 {
     Configure::write('debug',3);
     $this->layout = 'default-one';
     $this->pageTitle = 'Stock Bangladesh :: Price Earning Growth Ratio';
     $symbolArr = $this->Symbol->find('all', array ('conditions' => array ('inactive=\'No\' AND otc_market=\'No\' AND business_segment!=\'Mutual Funds\' AND business_segment!=\'Corporate Bond\' AND corporate_declaration_restriction = 0 AND category!=\'Z\' ' ), 'fields' => array ('id','dse_code','lasttradeprice','face_value','yclose','bonus_issue','right_issue','q1','q2','q3','q4'), 'order'=>'id ASC'));
     
     $performanceSql = "SELECT fin_year, symbol_id,code,earning_per_share FROM company_financial_performance WHERE earning_per_share!='' AND fin_year >=2008 ORDER BY symbol_id ASC";
     $performanceArr = $this->Symbol->query($performanceSql);
     
     foreach($performanceArr as $arr)
     {
        $symbol_id = $arr['company_financial_performance']['code'];
        $performance[$symbol_id][] = $arr;
     }
     
     $outerloopcount = 0;
     foreach($performance as $symbol=>$newArr)
     {
         $total_diff = 0;
         $outerloopcount++;
         arsort($newArr); ///sorted by financial year DESC
         $prevEPS = 0;
         $count =0;
         foreach($newArr as $arr)
         {
             //$outerloopcount++;
             if($prevEPS == 0)
             {
                 $EPSforPE[$symbol] = (float)$arr['company_financial_performance']['earning_per_share'];
                 $EPS = (float)$arr['company_financial_performance']['earning_per_share'];
             }
             if($prevEPS!=0)
             {
                $count++;
                $total_year[$symbol] = $count;
                $year = $arr['company_financial_performance']['fin_year'];
                $EPS = (float)$arr['company_financial_performance']['earning_per_share'];
                
                if($EPS > (5*$prevEPS))
                {
                   $EPS = $EPS/10;
                }
                $diff[$symbol] = (($prevEPS - $EPS)/$EPS)*100; 
             }
             $prevEPS = $EPS;
             if($count == 1)
             break;
         }
         
     }
     
      foreach ($symbolArr as $arr)
        {
           $symbol = $arr['Symbol']['dse_code'];
           $symbol_id = $arr['Symbol']['id'];
           if(!empty($diff[$symbol]))
           {
               
               if($EPSforPE[$symbol] ==0)
               $pe[$symbol] = 0;
               else
               $pe[$symbol] = $arr['Symbol']['lasttradeprice'] / $EPSforPE[$symbol];
               if (isset($_GET['alphsort']) && $_GET['alphsort']!='')
               {
                  $PEGratio[$symbol]['name']     =  $symbol;
                  $PEGratio[$symbol]['pegratio'] =  $pe[$symbol]/$diff[$symbol];
               }
               if (isset($_GET['paysort']) && $_GET['paysort']!='')
               {
                  $PEGratio[$symbol]['pegratio'] =  $pe[$symbol]/$diff[$symbol];
                  $PEGratio[$symbol]['name']     =  $symbol;
               }
               $PEGratio[$symbol]['pegratio'] =  $pe[$symbol]/$diff[$symbol];
               $PEGratio[$symbol]['name']     =  $symbol;
               
               $peg = $PEGratio[$symbol]['pegratio'];
               $date = date('Y-m-d');
               $update_sql = "UPDATE newspaper_shareinfo_table SET peg = $peg where dse_code = '$symbol' AND date LIKE '%$date%'";
               pr($update_sql);
               $this->Symbol->query($update_sql);
               
               /*$date = date('d-m-Y');
               $update_summery = "UPDATE individual_summery SET peg = $peg where code = '$symbol' AND date_time ='$date'";
               $this->Symbol->query($update_summery);*/
               pr("Update Successful");
               
           }
        }
     
     die;
     
 }
 
 function insert_rrr_beta()
 {
     Configure::write('debug',3);
     $this->layout = 'default-one';
     $this->pageTitle = 'Stock Bangladesh :: Price Earning Growth Ratio';
     $symbolArr = $this->Symbol->find('all', array ('conditions' => array ('inactive=\'No\' AND otc_market=\'No\' AND id>4 ' ), 'fields' => array ('id','dse_code','lasttradeprice','face_value','yclose','bonus_issue','right_issue','q1','q2','q3','q4'), 'order'=>'id ASC'));
     
     foreach ($symbolArr as $arr)
        {
           $symbol = $arr['Symbol']['dse_code'];
           $symbol_id = $arr['Symbol']['id'];
           
           $beta = $this->__betacoefficient($symbol_id);
           $beta = $beta[$symbol_id]['beta'];
           
           $ERm = $this->__generate_erm($symbol_id);
           $individual_beta = $beta;
           $rrr = .05+ (($ERm - .05)*$individual_beta);
           
           $date = date('Y-m-d');
           $update_sql = "UPDATE newspaper_shareinfo_table SET beta = $beta, rrr = $rrr where dse_code = '$symbol' AND date LIKE '%$date%'";
           pr("Update Successful");
           $this->Symbol->query($update_sql);
               
           
        }
     
     /*pr($PEGratio);
     die;*/
     
     die;
     
 }
 
 
 function insert_contributor()
    {
        Configure::write('debug',3);
        //set_time_limit(0);
        $this->layout = 'default-one';
        $this->pageTitle = 'Stock Bangladesh :: Share Impact';
        
        $dateArr = $this->MarketSummery->find('all', array('fields' => array('date','dgen','cap_equity'),'order' => array('id DESC'),'limit'=>2));
        $lastdayIndex = $dateArr[1]['MarketSummery']['dgen'];
        
        $lastdate = $dateArr [1] ['MarketSummery'] ['date'];
        $lastdayMcap = $dateArr[1]['MarketSummery']['cap_equity'];
        $lastdate = $dateArr [0] ['MarketSummery'] ['date'];
        $Mdate = explode("-",$lastdate);
        $Odate = $Mdate[2].'-'.$Mdate[1].'-'.$Mdate[0];
        
        
        $start_date = date('d-m-Y',strtotime($dateArr[1]['MarketSummery']['date']));
        $startstamp = strtotime($start_date)-6*60*60;
        $end_date = date('d-m-Y',strtotime($dateArr[0]['MarketSummery']['date']));
        $endstamp = strtotime($end_date)-6*60*60;
        //pr($startstamp);
        
        
        $querystr="SELECT * FROM `corporate_action` WHERE `datestamp` >=$startstamp and `datestamp` <$endstamp  and`action`='stockdiv' and `active`=1 ORDER BY `datestamp` ASC";            
        $corporateAction = $this->Symbol->query($querystr);
       // pr($corporateAction);
        
        foreach($corporateAction as $row)
        {
            if($row['corporate_action']['action']=='stockdiv')
            {
                $adjustmentFactor[$row['corporate_action']['symbol']]['symbol']=$row['corporate_action']['symbol'];
                $adjustmentFactor[$row['corporate_action']['symbol']]['value']=(100+$row['corporate_action']['value'])/100;
            }
        }
        
        $sql = "SELECT * FROM outputs where date= '$Odate' and symbol>4 and volume!=0 ORDER BY id";
        $outputdata = $this->Symbol->query($sql);
        $outputarr = array();
        foreach($outputdata as $arr)
        {
            $symbol = $arr['outputs']['symbol'];
            $outputarr[$symbol] = $arr; 
        }
        
        $SymbolArr = $this->Symbol->find( 'all', array ('conditions' => array ('inactive=\'No\' AND otc_market=\'No\' AND business_segment!=\'Mutual Funds\' AND business_segment!=\'Corporate Bond\' AND category!=\'Z\'' ), 'fields' => array ('id','dse_code','lasttradeprice','yclose','no_of_securities','corporate_declaration_restriction','business_segment','share_percentage_public')));
        
        $total_information = array();
        $final_index = array();
        $index_change = array();
        $index_change_per = array();
        $total_change = 0;
        $total_price_change = 0;
        foreach($SymbolArr as $symbol)
        {
            
          if(($symbol['Symbol']['id']!=1) && ($symbol['Symbol']['corporate_declaration_restriction']!=1))
            
            {
                if(!empty($outputarr[$symbol['Symbol']['id']]))
                {  
                   $securities[$symbol['Symbol']['id']]       = $symbol['Symbol']['no_of_securities'];
                   if(!empty($adjustmentFactor[$symbol['Symbol']['id']]))
                    {
                        $symbol['Symbol']['yclose'] = $symbol['Symbol']['yclose']/ $adjustmentFactor[$symbol['Symbol']['id']]['value'];
                    }
                    $change[$symbol['Symbol']['id']]           =  $symbol['Symbol']['lasttradeprice'] - $symbol['Symbol']['yclose'];
                    $total_impact[$symbol['Symbol']['id']]     = $change[$symbol['Symbol']['id']]* $securities[$symbol['Symbol']['id']];
                    $increasedMcap[$symbol['Symbol']['id']]    = $lastdayMcap + $total_impact[$symbol['Symbol']['id']];
                    $final_index[$symbol['Symbol']['id']]      = ($lastdayIndex*$increasedMcap[$symbol['Symbol']['id']])/$lastdayMcap;
                    $index_change[$symbol['Symbol']['id']]     = $final_index[$symbol['Symbol']['id']]-$lastdayIndex;
                    $index_change_per[$symbol['Symbol']['id']] = ($final_index[$symbol['Symbol']['id']]-$lastdayIndex)/$lastdayIndex;
                    $total_change += $index_change[$symbol['Symbol']['id']];  
                    
                       $total_information[$symbol['Symbol']['id']]['name']     = $symbol['Symbol']['dse_code'];
                       $total_information[$symbol['Symbol']['id']]['sector']     = $symbol['Symbol']['business_segment'];
                       $total_information[$symbol['Symbol']['id']]['contribution']  = $index_change[$symbol['Symbol']['id']]/ abs($change[$symbol['Symbol']['id']]);
                    
                    $index_contributor = $total_information[$symbol['Symbol']['id']]['contribution'];
                    $insert_index_change = $index_change[$symbol['Symbol']['id']];
                    $insert_index_change_per = $index_change_per[$symbol['Symbol']['id']]*100;
                    $date = date('Y-m-d');
                    $symbol = $symbol['Symbol']['id'];
                    $update_sql = "UPDATE newspaper_shareinfo_table SET index_contibutor = $index_contributor where symbol = '$symbol' AND date LIKE '%$date%'";
                   //pr($update_sql);
                   pr("Update Successful");
                   $this->Symbol->query($update_sql);
                   
                   /*$date = date('d-m-Y');
                   $update_summery = "UPDATE individual_summery SET index_change = $insert_index_change, index_change_per = $insert_index_change_per, index_contribution = '$index_contributor' where symbol = '$symbol' AND date_time ='$date'";
                   $this->Symbol->query($update_summery);
                   pr("Update Successful");*/
                   
                } 
            }
        }
        
        
        die;
    }
 
 function insert_yield_payout()
    {
        Configure::write('debug',3);
        
        $this->layout = 'default-one';
        $this->pageTitle = 'Stock Bangladesh :: Market Yield';
        
        $SymbolArr = $this->Symbol->find('all', array ('conditions' => array ('inactive=\'No\' AND otc_market=\'No\'' ), 'fields' => array ('id','dse_code','lasttradeprice','face_value','yclose','bonus_issue','right_issue','q1','q2','q3','q4')));
        
        $querystr="SELECT DISTINCT(symbol),code,value,date FROM `corporate_action` WHERE `active`=1 AND action='cashdiv' ORDER BY `datestamp` ASC";
        $corporateAction = $this->Symbol->query($querystr);
        
        $corporateActionArr = array();
        foreach($corporateAction as $action)
        {
            $symbol = $action['corporate_action']['symbol'];
            $corporateActionArr[$symbol]['id'] = $action['corporate_action']['symbol']; 
            $corporateActionArr[$symbol]['name'] = $action['corporate_action']['code'];
            $corporateActionArr[$symbol]['dividend'] = $action['corporate_action']['value'];
            $corporateActionArr[$symbol]['date'] = $action['corporate_action']['date'];
        }
        /*pr($corporateActionArr);
        die;*/
        
        
        $total_infoArr = array();
        foreach ($SymbolArr as $arr)
        {
           $symbol = $arr['Symbol']['id'];
           if(!empty($corporateActionArr[$symbol]))
           { 
               $q1 = $arr['Symbol']['q1'];
               $q2 = $arr['Symbol']['q2'];
               $q3 = $arr['Symbol']['q3'];
               $q4 = $arr['Symbol']['q4'];
               $qeps = 0;
               $factor = 1;

                if ($q1) {

                    $qeps = $q1;

                    $factor = 4;

                }

                if ($q2) {

                    $qeps = $q2;

                    $factor = 2;

                }

                if ($q3) {

                    $qeps = $q3;

                    $factor = 4 / 3;

                }

                if ($q4) {

                    $qeps = $q4;

                    $factor = 1;

                }
               $annualizedEPS = $qeps * $factor;
               
               $total_infoArr[$symbol]['dividend_value'] = $corporateActionArr[$symbol]['dividend']; 
               $total_infoArr[$symbol]['code'] = $arr['Symbol']['dse_code'];
               $total_infoArr[$symbol]['facevalue'] = $arr['Symbol']['face_value'];
               $total_infoArr[$symbol]['lasttradeprice'] = $arr['Symbol']['lasttradeprice'];
               $total_infoArr[$symbol]['dividend_value'] = $corporateActionArr[$symbol]['dividend']; 
               if(($arr['Symbol']['face_value']== 10) ||($arr['Symbol']['face_value']== 10.0))
                $dividend = $corporateActionArr[$symbol]['dividend']/10;
               else
                $dividend = $corporateActionArr[$symbol]['dividend'];
               
               $total_infoArr[$symbol]['yield'] = ($dividend/$arr['Symbol']['lasttradeprice'])*100;
               $total_infoArr[$symbol]['payout'] = ($dividend/$annualizedEPS)*100;
               $total_infoArr[$symbol]['declaration_date'] = $corporateActionArr[$symbol]['date'];
               $total_infoArr[$symbol]['eps'] = $annualizedEPS;
               
               $payout = $total_infoArr[$symbol]['payout'];
               $yield  = $total_infoArr[$symbol]['yield'];
               
               $date = date('Y-m-d');
               $update_sql = "UPDATE newspaper_shareinfo_table SET payout_ratio = $payout, dividend_yield = $yield where symbol = '$symbol' AND date LIKE '%$date%'";
               pr("Update Successful");
               $this->Symbol->query($update_sql);
               
              /* $date = date('d-m-Y');
               $update_summery = "UPDATE individual_summery SET payout = $payout, yield = $yield where symbol = '$symbol' AND date_time ='$date'";
               $this->Symbol->query($update_summery);
               pr("Update Successful");*/
               
           }
        }
        
        die;
   
 }
	function index() {
		$this->redirect ( array ('action' => 'download' ) );
	}
	
	function download() {
	//Configure::write('debug',3);
        if (! $this->Session->check ( 'Auth.User' )) {
            $this->Session->setFlash ( 'You are not authorized to access that location.' );
            $this->redirect ( array ('controller' => 'users', 'action' => 'login' ) );
        }
		$this->layout = 'default-one';
		$this->pageTitle = 'Stock Bangladesh :: Download';
		
		$symbolList = $this->Symbol->find ( 'list', array ('conditions' => array ('id > 1000 AND inactive=\'No\' AND name!= \'\' ' ), 'order' => 'name', 'fields' => array ('Symbol.id', 'Symbol.name' ) ) );
		
		
		$last10days = time() - (10*24*60*60);
		
		$corporateList = $this->Symbol->query ( 'SELECT * FROM corporate_action WHERE datestamp > '.$last10days.' GROUP BY symbol ORDER BY id' );
		//pr($corporateList);
		$this->set ( 'symbol_list', $symbolList );
		$this->set ( 'corporate_list', $corporateList );
	}
	
	function amibrokerplugin($err = null) {

        //Configure::write('debug',3);
        if (! $this->Session->check ( 'Auth.User' )) {
            $this->Session->setFlash ( 'You are not authorized to access that location.' );
            $this->redirect ( array ('controller' => 'users', 'action' => 'login' ) );
        }
        $this->layout = 'default-one';

        $this->pageTitle = 'Stock Bangladesh :: Ami Broker Data Plugin';

        $package_type = array('6 Months' => '6 Months','12 Months'=>'12 Months');
        $this->set('package', $package_type);        

        $this->set ( 'err', $err );



        if (isset ( $_POST ) && ! empty ( $_POST )) {



            $AMIHost = "79.142.78.245:3306";  

            $AMIDB = "shareban_plugin";

            $AMIUser = "shareban_stms";

            $AMIPassword = "sTmS115^~!db";
             


            $AMILink = mysql_connect ( $AMIHost, $AMIUser, $AMIPassword );



            if (! $AMILink) {

                $this->Session->setFlash ( 'Could not connect: ' . mysql_error () . ')' );

                $this->redirect ( array ('controller' => 'resources', 'action' => 'amibrokerplugin' ) );

            }



            $db_selected = mysql_select_db ( $AMIDB, $AMILink );



            if (! $db_selected) {

                $this->Session->setFlash ( 'Can\'t select database : ' . mysql_error () . ')' );

                $this->redirect ( array ('controller' => 'resources', 'action' => 'amibrokerplugin' ) );

            }



            $Username = trim ( mysql_escape_string ( $_POST ['username'] ) );

            $Password = trim ( mysql_escape_string ( $_POST ['password'] ) );

            $Email = trim ( mysql_escape_string ( $_POST ['email'] ) );

            $Contact = trim ( mysql_escape_string ( $_POST ['contact'] ) );

            $Company = trim ( mysql_escape_string ( $_POST ['company'] ) );
            
            $Package = trim ( mysql_escape_string ( $this->data['package'] ) );

            /*pr($this->data);
            pr($this->data['package']);
            pr($Package);
            die;*/

            $UserLoginSql = "SELECT username FROM plugin_users2 WHERE username='" . $Username . "'";

            $UserLoginResult = mysql_query ( $UserLoginSql, $AMILink );



            $row = mysql_fetch_assoc ( $UserLoginResult );



            if (empty ( $row )) {



                $UserLoginSql2 = "SELECT username FROM plugin_users2 WHERE email='" . $Email . "'";

                $UserLoginResult = mysql_query ( $UserLoginSql2, $AMILink );



                $row = mysql_fetch_assoc ( $UserLoginResult );



                if (! empty ( $row )) {

                    $this->Session->setFlash ( 'Email is already used. Please try another one.' );

                    $this->set ( 'ami_email', '1' );

                    $this->redirect ( array ('controller' => 'resources', 'action' => 'amibrokerplugin/ie' ) );

                } else {

                    $NewUserSql = "INSERT INTO plugin_users2(username, password, active, email, contact_no, company_name, package_type ) values('" . $Username . "','" . $Password . "', 0, '" . $Email . "', '" . $Contact . "', '" . $Company . "','" . $Package . "')";



                    mysql_query ( $NewUserSql, $AMILink );

                    $this->Session->setFlash ( 'Your registration has completed successfully.' );

                    $this->redirect ( array ('controller' => 'resources', 'action' => 'amibrokerplugin' ) );

                }

            } else {

                $this->Session->setFlash ( 'User Name already exist. Please try another one.' );

                $this->redirect ( array ('controller' => 'resources', 'action' => 'amibrokerplugin/iu' ) );

            }

        }

    }
	function datamatrixsetting()
     {
        $this->layout = 'default-one';
        $userId = $this->Session->read('Auth.User.id');
        //pr($userId);
        $this->set('user_id',$userId);
        $symbols = $this->Symbol->find('all', array('conditions' => array('inactive = \'No\''), 'fields' => array('id','dse_code'),'order' => array('dse_code ASC')));        
        
        $selectedcompany = $this->Datasetting->find('all', array('conditions' => array('user_id ='.$userId), 'fields' => array('symbol_id')));        
        $company_list = array();
        foreach($selectedcompany as $selected)
        {
           $company_list[] = $selected['Datasetting']['symbol_id']; 
        }
        //pr($company_list);
        $this->set('companylist',$company_list);
        $this->set('symbol',$symbols);
        
        $this->set('total',count($company_list));
        
       // pr($symbols); 
        if(!empty($this->data))
        {
            //echo '<pre>';
            //print_r($this->data); die;
            
            
            $id = $this->data['Resource']['id'];
            $deletesql = "DELETE FROM `datasettings` WHERE user_id = $userId ;" ;
            $deleted = $this->Symbol->query($deletesql);
            $namesql = "SELECT id,dse_code FROM symbols WHERE inactive = 'No' ORDER BY dse_code ASC";
            $dsecode = $this->Symbol->query($namesql);
            $savecompany = array();
            
            $type = 1;
            //pr($this->data); die;
           
            for($i=0;$i<count($dsecode);$i++)
            {
                if($this->data['Resource'][$dsecode[$i]['symbols']['dse_code']]!=0)
                {
                 //$savecompany[] = $dsecode[$i]['symbols']['id'];
                 $symbol_id = $dsecode[$i]['symbols']['id'];
                 $insertsql = "INSERT INTO `datasettings` ( `user_id` , `symbol_id` , `type`) VALUES ('$userId' , '$symbol_id', '$type') ;" ;
                 $selected = $this->Symbol->query($insertsql);
                 
                }
            }
            $this->Session->setFlash('setting has been saved successfully.');
            $this->redirect ( array ('controller' => 'resources', 'action' => 'datamatrix' ) );
            
          }
        
        
         
     }
     
     function datamatrixhead()
     {
        $this->layout = 'default-one';
        $userId = $this->Session->read('Auth.User.id');
        //pr($userId);
        //$this->set('user_id',$userId);
        
        //echo 'sdjkfhdskjfdhsfidsjhfduisfhd';
        $namesql = "SHOW COLUMNS FROM datamatrix_default_head";
        $dsecode = mysql_query($namesql);
        $header = array();
        while($colms = mysql_fetch_assoc($dsecode))
        {            
            $header[] = $colms['Field'];
          //echo '<br>';  
        }
        
        $this->set('header',$header);
        
        /*$headsql  = "SELECT * FROM datamatrix_default_head WHERE user_id=".$userId;
        $headqry  = $this->Datatitlehead->query($namesql);
        $saveHead = array();
        */
        $saveHead = $this->Datatitlehead->find('all', array('conditions' => array('user_id ='.$userId), 'fields' => array()));        
        //echo $saveHead['Datatitlehead']['code'];
        $headList = array();
        for($i=3;$i<count($header);$i++)
        {
            $headList[$header[$i]] = $saveHead[0]['Datatitlehead'][$header[$i]];
        }
        
        $this->set('saveheadList',$headList);
        
        /*echo '<pre>';
        print_r($header);
        print_r($saveHead);
        print_r($headList);
        
        die;*/
        
        if(!empty($this->data))
        {
            /*echo '<pre>';
            print_r($this->data);
            echo '</pre>';*/
            
            $id = $this->data['Resource']['id'];
            $deletesql = "DELETE FROM `datamatrix_default_head` WHERE user_id = $userId ;" ;
            $deleted   = $this->Datatitlehead->query($deletesql);
            
            $sql = "INSERT INTO `datamatrix_default_head` (`user_id`, `status`, `code`, `sector`, `category`, `market_lot`, `face_value`, `nav`, `lastprice`, `open`, `high`, `low`, `pchange`, `pe`, `volume`, `value`, `trade`) VALUES ('$userId', '1', '".$this->data['Resource']['code']."', '".$this->data['Resource']['sector']."', '".$this->data['Resource']['category']."', '".$this->data['Resource']['market_lot']."', '".$this->data['Resource']['face_value']."', '".$this->data['Resource']['nav']."', '".$this->data['Resource']['lastprice']."', '".$this->data['Resource']['open']."', '".$this->data['Resource']['high']."', '".$this->data['Resource']['low']."', '".$this->data['Resource']['pchange']."', '".$this->data['Resource']['pe']."', '".$this->data['Resource']['volume']."', '".$this->data['Resource']['value']."', '".$this->data['Resource']['trade']."')";
            
            $deleted   = $this->Datatitlehead->query($sql);
            $this->Session->setFlash('setting has been saved successfully.');
            //$this->redirect ( array ('controller' => 'users', 'action' => 'dashboard' ) );
            $this->redirect ( array ('controller' => 'resources', 'action' => 'datamatrix' ) );
            //die;
            
            
        }
        
         
     }
	function matrixsetting() {
        $this->layout = 'default-matrix';
        $this->pageTitle = 'Stock Bangladesh :: DSE Data Matrix';
        $userId = $this->Session->read('Auth.User.id');
    }
    function datamatrix() {
        
        if (! $this->Session->check ( 'Auth.User' )) {
            $this->Session->setFlash ( 'You are not authorized to access that location.' );
            $this->redirect ( array ('controller' => 'users', 'action' => 'login' ) );
        }
	
        if(isset($_POST["mattrix_date"])){
			$this->set("mydate",$_POST["mattrix_date"]);
		}
        $this->layout = 'default-matrix';
        $this->pageTitle = 'Stock Bangladesh :: DSE Data Matrix';
        $userId = $this->Session->read('Auth.User.id');
        
        $namesql = "SHOW COLUMNS FROM datamatrix_default_head";
        $dsecode = mysql_query($namesql);
        $header = array();
        while($colms = mysql_fetch_assoc($dsecode))
        {            
            $header[] = $colms['Field'];
          //echo '<br>';  
        }
        
        $this->set('header',$header);
        
        $saveHead = $this->Datatitlehead->find('all', array('conditions' => array('user_id ='.$userId), 'fields' => array()));        
        //echo $saveHead['Datatitlehead']['code'];
         $headList = array();
        if(!empty($saveHead))
        {
            for($i=3;$i<count($header);$i++)
            {
                $headList[$header[$i]] = $saveHead[0]['Datatitlehead'][$header[$i]];
            }
            //$this->set('selectedTitle',$headList);
            
        }
        //pr($headList);
        if(!empty($headList))
        {
            
            $this->set('selectedTitle',$headList);
            //pr('full'.$headList) ;die;
            
        }
        else
        {
            for($i=3;$i<count($header);$i++)
                {
                    $headList[$header[$i]] = 1;
                }
                
                $this->set('selectedTitle',$headList);
               // pr('empty'.$headList) ;die;
        }
    
    }
	
   
    function getpricelist($mydate=NULL) {
       $userId = $this->Session->read('Auth.User.id');
       $selectedcompany = $this->Datasetting->find('all', array('conditions' => array('user_id ='.$userId), 'fields' => array('symbol_id')));        
       //echo "<pre>";
       //print_r($selectedcompany);
	   
       if(!empty($selectedcompany))
       {
      
        $company_list = array();
        foreach($selectedcompany as $selected)
        {
           $company_list[] = $selected['Datasetting']['symbol_id']; 
        } 
        
        $result = array();
        foreach($company_list as $company)
        {   
            $result[] = $this->Symbol->find('all', array('conditions' => array('id='.$company)));
         }
         //echo "<pre>";
         //print_r($result);
         //die;
       //else
//       { 
//       $result = $this->Symbol->find ( 'all' );
//        
//       }

        if (count ( $result )) {
            
            $arrall = array ();
            
            $lastTradePriceList = $this->Symbol->find ( 'list', array ('fields' => array ('id', 'lasttradeprice' ) ) );

            $ycloseList = $this->Symbol->find ( 'list', array ('fields' => array ('id', 'yclose' ) ) );
			
           $sql = "SELECT * FROM outputs USE INDEX (symbol) ORDER BY id DESC LIMIT 0, 400";
            //*$sql = "SELECT *,UNIX_TIMESTAMP(str_to_date(date, '%d-%c-%Y')) FROM stocknet_plugin.eod USE INDEX (symbol) ORDER BY id DESC LIMIT 0, 244";
            /*--- FIRST USE OF MEMCACHE :: START HERE ---*/
            if (class_exists ( 'Memcache' )) {                 
                $memcache = new Memcache ( );

                $memcache->connect ( 'localhost', 11211 ) or die ( "Could not connect" );

                $memKey2 = md5 ( 'org_resoures_getpricelist_1' );

                if (! $memcache->get ( $memKey2 )) {
                    //echo '--not set--';
                    $resultArr = $this->Symbol->query ( $sql );
                    //*$resultArr = mysql_query ( $sql, $AMILink );
                    $memcache->set ( $memKey2, $resultArr, MEMCACHE_COMPRESSED, 60 );
                }
                //echo 'set';
                $resultArr = $memcache->get ( $memKey2 );

            } else {

                //*$resultArr = mysql_query ( $sql, $AMILink );
                $resultArr = $this->Symbol->query ( $sql );

            }

            /*--- FIRST USE OF MEMCACHE :: END HERE ---*/
            //*$resultArr = mysql_query ( $sql, $AMILink );
            $resultArr = $this->Symbol->query ( $sql );
            
            //pr($resultArr);die();

            /*$resultinfo = array();
            while($eachrow = mysql_fetch_row($resultArr))
              {
                  $resultinfo[] = $eachrow;
                  
              } for */
            
           
            $lastday = $resultArr [0] ['outputs'] ['date'];
            //pr($lastday);
            $lastdaystamp = strtotime ( $lastday );
            //pr($lastdaystamp); die;
            
            

            $resultArr = array_reverse ( $resultArr );
             //pr($resultArr);die;
            
            //pr($lastdaystamp);
            $sortedResult = array ();

            foreach ( $resultArr as $res ) {
                
                //pr($res [1]);
                //pr($res[13]);
                
                
                if ($res ['outputs'] ['symbol'] > 1 && $res ['outputs'] ['tradevalues'] != 0 && $res ['outputs'] ['daystamp'] >= $lastdaystamp) {// && $res ['outputs'] ['daystamp'] >= $lastdaystamp
                    $res ['outputs'] ['lastprice'] = $lastTradePriceList [$res ['outputs'] ['symbol']];
                    $res ['outputs'] ['yclose'] = $ycloseList [$res ['outputs'] ['symbol']];

                    $companyFinPerf = "SELECT * FROM `company_financial_performance` WHERE `symbol_id`='".$res ['outputs'] ['symbol']."' and asset_val_per_share!=''  ORDER BY  fin_year DESC LIMIT 1";
                    $companyFinPerfResult = $this->Symbol->query($companyFinPerf);
                   
                    $res ['outputs'] ['asset_val_per_share'] = $companyFinPerfResult[0]['company_financial_performance']['asset_val_per_share'];
                    $sortedResult [$res ['outputs'] ['symbol']] = $res;



                }
                

            } 



            
            $coreDataCount = 1;

            //pr($sortedResult); die;
            
            //pr($result); die;

            foreach ( $result as $row ) {



                $qeps = 0;

                $symbol = $row[0] ['Symbol'] ['id'];

                $factor = 1;

                if ($row [0]['Symbol'] ['q1']) {

                    $qeps = $row [0]['Symbol'] ['q1'];

                    $factor = 4;

                }

                if ($row[0] ['Symbol'] ['q2']) {

                    $qeps = $row [0]['Symbol'] ['q2'];

                    $factor = 2;

                }

                if ($row [0]['Symbol'] ['q3']) {

                    $qeps = $row [0]['Symbol'] ['q3'];

                    $factor = 4 / 3;

                }

                if ($row [0]['Symbol'] ['q4']) {

                    $qeps = $row [0]['Symbol'] ['q4'];

                    $factor = 1;

                }

                $annualizedEPS = $qeps * $factor;



                //if(isset($sortedResult[$symbol]['outputs']['lastprice']) && $annualizedEPS !=0)
                if (isset ( $sortedResult [$symbol] ['outputs'] ['lastprice'] )) {

                    $coredata ['id'] = $row [0]['Symbol'] ['id'];

                    $coredata ['id'] = $coreDataCount ++;

                    $coredata ['code'] = trim ( $row [0]['Symbol'] ['dse_code'] );

                    if($coredata ['code']=='DELTALIFE'){
                        $coredata ['sector'] = 'Life Insurance';
                    }else if($coredata ['code']=='FAREASTLIF'){
                        $coredata ['sector'] = 'Life Insurance';
                    }else if($coredata ['code']=='MEGHNALIFE'){
                        $coredata ['sector'] = 'Life Insurance';
                    }else if($coredata ['code']=='NATLIFEINS'){
                        $coredata ['sector'] = 'Life Insurance';
                    }else if($coredata ['code']=='POPULARLIF'){
                        $coredata ['sector'] = 'Life Insurance';
                    }else if($coredata ['code']=='PRAGATILIF'){
                        $coredata ['sector'] = 'Life Insurance';
                    }else if($coredata ['code']=='PRIMELIFE'){
                        $coredata ['sector'] = 'Life Insurance';
                    }else if($coredata ['code']=='PROGRESLIF'){
                        $coredata ['sector'] = 'Life Insurance';
                    }else if($coredata ['code']=='RUPALILIFE'){
                        $coredata ['sector'] = 'Life Insurance';
                    }else if($coredata ['code']=='SANDHANINS'){
                        $coredata ['sector'] = 'Life Insurance';
                    }else if($coredata ['code']=='SUNLIFEINS'){
                        $coredata ['sector'] = 'Life Insurance';
                    }else{
                        $coredata ['sector'] = trim ( $row [0]['Symbol'] ['business_segment'] );
                    }


                    $coredata ['category'] = $row [0]['Symbol'] ['category'];

                    $coredata ['market_lot'] = $row [0]['Symbol'] ['market_lot'];

                    $coredata ['face_value'] = $row [0]['Symbol'] ['face_value'];

                    $coredata ['nav'] = $sortedResult [$symbol] ['outputs'] ['asset_val_per_share'];

                    $coredata ['lastprice'] = round ( $sortedResult [$symbol] ['outputs'] ['lastprice'], 2 );

                    $coredata ['open'] = round ( $sortedResult [$symbol] ['outputs'] ['open'], 2 );

                    $coredata ['high'] = round ( $sortedResult [$symbol] ['outputs'] ['high'], 2 );

                    $coredata ['low'] = round ( $sortedResult [$symbol] ['outputs'] ['low'], 2 );

                    $coredata ['volume'] = $sortedResult [$symbol] ['outputs'] ['volume'] + 0;

                    $coredata ['value'] = round ( $sortedResult [$symbol] ['outputs'] ['tradevalues'], 2 );
                    
                    $coredata ['lastprice'] = round ( $sortedResult [$symbol] ['outputs'] ['lastprice'], 2 );

                    $coredata ['trade'] = $sortedResult [$symbol] ['outputs'] ['trade'];
					
					$coredata ['ycp'] = $sortedResult [$symbol] ['outputs'] ['yclose'];

                    $totalChange = ($sortedResult [$symbol] ['outputs'] ['lastprice'] - $sortedResult [$symbol] ['outputs'] ['yclose']);
					$totalChangePer = (($sortedResult [$symbol] ['outputs'] ['lastprice'] - $sortedResult [$symbol] ['outputs'] ['yclose']) / $sortedResult [$symbol] ['outputs'] ['yclose']) * 100;
                    
                    $totalChangePer = round ( $totalChangePer, 2 );

                    $coredata ['pchange'] = $totalChangePer; 
                    $coredata ['change'] = $totalChange; 
					



                    if ($annualizedEPS == 0)

                    $pe = 0;

                    else

                    $pe = $sortedResult [$symbol] ['outputs'] ['lastprice'] / $annualizedEPS;



                    $coredata ['pe'] = round ( $pe, 2 );
                    $ratio = $coredata ['volume']/$coredata ['trade'];
                    $coredata ['ratio'] = round($ratio,2);   
					$coredata ['eps'] = round ( $annualizedEPS, 2 );

                    $arrall [] = $coredata;

                }

            }

            $arr = $arrall;

            $jsonresult = $this->__JEncode ( $arr );

            echo '({"total":"' . count ( $result ) . '","results":' . $jsonresult . '})';

        } else {

            echo '({"total":"0", "results":""})';

        }
        
   }
   
   else
       { 
	   
       $result = $this->Symbol->find ( 'all' );
		if($mydate){
			$date=$mydate;//21-12-2010
		}
		//$date="21-12-2010";
        if (count ( $result )) {
            
            $arrall = array ();
            
            $lastTradePriceList = $this->Symbol->find ( 'list', array ('fields' => array ('id', 'lasttradeprice' ) ) );

            $ycloseList = $this->Symbol->find ( 'list', array ('fields' => array ('id', 'yclose' ) ) );
			if($date)
			$sql = "SELECT * FROM outputs USE INDEX (symbol) WHERE date LIKE '$date' ORDER BY id DESC LIMIT 0, 400";
			else $sql = "SELECT * FROM outputs USE INDEX (symbol) ORDER BY id DESC LIMIT 0, 400";
			//echo $sql;
            //$sql = "SELECT * FROM outputs USE INDEX (symbol) ORDER BY id DESC LIMIT 0, 400";
            //*$sql = "SELECT *,UNIX_TIMESTAMP(str_to_date(date, '%d-%c-%Y')) FROM stocknet_plugin.eod USE INDEX (symbol) ORDER BY id DESC LIMIT 0, 244";
            /*--- FIRST USE OF MEMCACHE :: START HERE ---*/
            if (0) {               //class_exists ( 'Memcache' )  
                $memcache = new Memcache ( );

                $memcache->connect ( 'localhost', 11211 ) or die ( "Could not connect" );

                $memKey2 = md5 ( 'org_resoures_getpricelist_1' );

                if (! $memcache->get ( $memKey2 )) {
                    //echo '--not set--';
                    $resultArr = $this->Symbol->query ( $sql );
                    //*$resultArr = mysql_query ( $sql, $AMILink );
                    $memcache->set ( $memKey2, $resultArr, MEMCACHE_COMPRESSED, 60 );

                }

                //echo 'set';
                $resultArr = $memcache->get ( $memKey2 );

            } else {

                //*$resultArr = mysql_query ( $sql, $AMILink );
                $resultArr = $this->Symbol->query ( $sql );

            }

            /*--- FIRST USE OF MEMCACHE :: END HERE ---*/
            //*$resultArr = mysql_query ( $sql, $AMILink );
            $resultArr = $this->Symbol->query ( $sql );
            
         //  print_r($resultArr); die;

            /*$resultinfo = array();
            while($eachrow = mysql_fetch_row($resultArr))
              {
                  $resultinfo[] = $eachrow;
                  
              } for */
            
           
            $lastday = $resultArr [0] ['outputs'] ['date'];
            //pr($lastday);
            $lastdaystamp = strtotime ( $lastday );
            //pr($lastdaystamp); die;
            
            

            $resultArr = array_reverse ( $resultArr );
             //pr($resultArr);die;
            
            //pr($lastdaystamp);
            $sortedResult = array ();

            foreach ( $resultArr as $res ) {
                
                //pr($res [1]);
                //pr($res[13]);
                
                
                if ($res ['outputs'] ['symbol'] > 1 && $res ['outputs'] ['tradevalues'] != 0 && $res ['outputs'] ['daystamp'] >= $lastdaystamp) {// && $res ['outputs'] ['daystamp'] >= $lastdaystamp
                    $res ['outputs'] ['lastprice'] = $res ['outputs'] ['close'];//$lastTradePriceList [$res ['outputs'] ['symbol']];
                   // $res ['outputs'] ['yclose'] = $ycloseList [$res ['outputs'] ['symbol']];
					
					$last_id= $res ['outputs'] ['id'];
					$companyYcp = "SELECT symbol,close FROM `outputs` WHERE `symbol`='".$res ['outputs'] ['symbol']."' and id < $last_id ORDER BY id DESC  LIMIT 1";
					$ycpInfo=$this->Symbol->query($companyYcp);
					$ycpPrice=$ycpInfo[0]['outputs'] ['close'];
					$res ['outputs'] ['yclose'] = $ycpPrice;
					
                    $companyFinPerf = "SELECT * FROM `company_financial_performance` WHERE `symbol_id`='".$res ['outputs'] ['symbol']."' and asset_val_per_share!=''  ORDER BY  fin_year DESC LIMIT 1";
                    $companyFinPerfResult = $this->Symbol->query($companyFinPerf);
                   
                    $res ['outputs'] ['asset_val_per_share'] = $companyFinPerfResult[0]['company_financial_performance']['asset_val_per_share'];
                    $sortedResult [$res ['outputs'] ['symbol']] = $res;



                }
                

            } 
//print_r($sortedResult);
//die();

             
            //echo count($sortedResult); die;
            $coreDataCount = 1;

            //pr($sortedResult); die;
            
            //pr($result); die;

            foreach ( $result as $row ) {



                $qeps = 0;

                $symbol = $row ['Symbol'] ['id'];

                $factor = 1;

                if ($row ['Symbol'] ['q1']) {

                    $qeps = $row ['Symbol'] ['q1'];

                    $factor = 4;

                }

                if ($row ['Symbol'] ['q2']) {

                    $qeps = $row ['Symbol'] ['q2'];

                    $factor = 2;

                }

                if ($row ['Symbol'] ['q3']) {

                    $qeps = $row ['Symbol'] ['q3'];

                    $factor = 4 / 3;

                }

                if ($row ['Symbol'] ['q4']) {

                    $qeps = $row ['Symbol'] ['q4'];

                    $factor = 1;

                }

                $annualizedEPS = $qeps * $factor;



                //if(isset($sortedResult[$symbol]['outputs']['lastprice']) && $annualizedEPS !=0)
                if (isset ( $sortedResult [$symbol] ['outputs'] ['lastprice'] )) {

                    $coredata ['id'] = $row ['Symbol'] ['id'];

                    $coredata ['id'] = $coreDataCount ++;

                    $coredata ['code'] = trim ( $row ['Symbol'] ['dse_code'] );

                    if($coredata ['code']=='DELTALIFE'){
                        $coredata ['sector'] = 'Life Insurance';
                    }else if($coredata ['code']=='FAREASTLIF'){
                        $coredata ['sector'] = 'Life Insurance';
                    }else if($coredata ['code']=='MEGHNALIFE'){
                        $coredata ['sector'] = 'Life Insurance';
                    }else if($coredata ['code']=='NATLIFEINS'){
                        $coredata ['sector'] = 'Life Insurance';
                    }else if($coredata ['code']=='POPULARLIF'){
                        $coredata ['sector'] = 'Life Insurance';
                    }else if($coredata ['code']=='PRAGATILIF'){
                        $coredata ['sector'] = 'Life Insurance';
                    }else if($coredata ['code']=='PRIMELIFE'){
                        $coredata ['sector'] = 'Life Insurance';
                    }else if($coredata ['code']=='PROGRESLIF'){
                        $coredata ['sector'] = 'Life Insurance';
                    }else if($coredata ['code']=='RUPALILIFE'){
                        $coredata ['sector'] = 'Life Insurance';
                    }else if($coredata ['code']=='SANDHANINS'){
                        $coredata ['sector'] = 'Life Insurance';
                    }else if($coredata ['code']=='SUNLIFEINS'){
                        $coredata ['sector'] = 'Life Insurance';
                    }else{
                        $coredata ['sector'] = trim ( $row ['Symbol'] ['business_segment'] );
                    }


                    $coredata ['category'] = $row ['Symbol'] ['category'];

                    $coredata ['market_lot'] = $row ['Symbol'] ['market_lot'];

                    $coredata ['face_value'] = $row ['Symbol'] ['face_value'];

                    $coredata ['nav'] = $sortedResult [$symbol] ['outputs'] ['asset_val_per_share'];

                    $coredata ['lastprice'] = round ( $sortedResult [$symbol] ['outputs'] ['lastprice'], 2 );

                    $coredata ['open'] = round ( $sortedResult [$symbol] ['outputs'] ['open'], 2 );

                    $coredata ['high'] = round ( $sortedResult [$symbol] ['outputs'] ['high'], 2 );

                    $coredata ['low'] = round ( $sortedResult [$symbol] ['outputs'] ['low'], 2 );

                    $coredata ['volume'] = $sortedResult [$symbol] ['outputs'] ['volume'] + 0;

                    $coredata ['value'] = round ( $sortedResult [$symbol] ['outputs'] ['tradevalues'], 2 );
                    
                    $coredata ['lastprice'] = round ( $sortedResult [$symbol] ['outputs'] ['lastprice'], 2 );

                    $coredata ['trade'] = $sortedResult [$symbol] ['outputs'] ['trade'];
					
					$coredata ['ycp'] = $sortedResult [$symbol] ['outputs'] ['yclose'];

					$totalChange = ($sortedResult [$symbol] ['outputs'] ['lastprice'] - $sortedResult [$symbol] ['outputs'] ['yclose']);
					
                    $totalChangePer = (($sortedResult [$symbol] ['outputs'] ['lastprice'] - $sortedResult [$symbol] ['outputs'] ['yclose']) / $sortedResult [$symbol] ['outputs'] ['yclose']) * 100;
                    
                    $totalChangePer = round ( $totalChangePer, 2 );

                    $coredata ['pchange'] = $totalChangePer;
                    $coredata ['change'] = $totalChange;



                    if ($annualizedEPS == 0)

                    $pe = 0;

                    else

                    $pe = $sortedResult [$symbol] ['outputs'] ['lastprice'] / $annualizedEPS;



                    $coredata ['pe'] = round ( $pe, 2 );
                    $ratio = $coredata ['volume']/$coredata ['trade'];
                    $coredata ['ratio'] = round($ratio,2); 
					$coredata ['eps'] = round ( $annualizedEPS, 2 );
					
                    $arrall [] = $coredata;

                }

            }

            $arr = $arrall;

            $jsonresult = $this->__JEncode ( $arr );

            echo '({"total":"' . count ( $result ) . '","results":' . $jsonresult . '})';

        } else {

            echo '({"total":"0", "results":""})';

        }
       }

        die ();

    }
	/*
    function getpricelist()
    {
        $result = $this->Symbol->find('all');
        
        if(count($result)){
            
            $arrall    = array();
            
            $sql       = "SELECT * FROM data_banks_intraday ORDER BY id DESC LIMIT 0, 350";
            
            
            
            /*--- FIRST USE OF MEMCACHE :: START HERE ---*/
	/*
            if (class_exists('Memcache')) {
                
                $memcache = new Memcache;
                $memcache->connect('localhost', 11211) or die ("Could not connect");
                
                $memKey2  = md5('resoures_getpricelist_1');                        
                
                if (!$memcache->get($memKey2)) {
                    //echo '--not set--';
                    $resultArr = $this->Symbol->query($sql);
                    $memcache->set($memKey2, $resultArr, MEMCACHE_COMPRESSED, 60);            
                }       
                //echo 'set';
                $resultArr = $memcache->get($memKey2);            
            }
            else {
                $resultArr = $this->Symbol->query($sql);
            }
            /*--- FIRST USE OF MEMCACHE :: END HERE ---*/
	
	/*
            $resultArr = array_reverse($resultArr);
            
            $sortedResult = array();
            foreach($resultArr as $res)
            {
                $sortedResult[$res['data_banks_intraday']['symbol_id']] = $res;
            }
            
            $coreDataCount = 1;
            
            foreach($result as $row){
                                
                $qeps   = 0;
                $symbol = $row['Symbol']['id'];
                $factor = 1;
                if($row['Symbol']['q1'])
                {
                    $qeps   = $row['Symbol']['q1'];
                    $factor = 4;
                }
                if($row['Symbol']['q2'])
                {
                    $qeps   = $row['Symbol']['q2'];
                    $factor = 2;
                }
                if($row['Symbol']['q3'])
                {
                    $qeps   = $row['Symbol']['q3'];
                    $factor = 4/3;
                }
                if($row['Symbol']['q4'])
                {
                    $qeps   = $row['Symbol']['q4'];
                    $factor = 1;
                }
                $annualizedEPS = $qeps*$factor;
                
                if(isset($sortedResult[$symbol]['data_banks_intraday']['lastprice']) && $annualizedEPS !=0)
                {
                    $coredata['id']         = $row['Symbol']['id'];
                    $coredata['id']         = $coreDataCount++;
                    $coredata['code']       = trim($row['Symbol']['dse_code']);
                    $coredata['sector']     = trim($row['Symbol']['business_segment']);
                    $coredata['category']   = $row['Symbol']['category'];
                    $coredata['market_lot'] = $row['Symbol']['market_lot'];
                    $coredata['face_value'] = $row['Symbol']['face_value'];

                    $coredata['lastprice']  = round($sortedResult[$symbol]['data_banks_intraday']['lastprice'], 2);
                    $coredata['high']       = round($sortedResult[$symbol]['data_banks_intraday']['high'], 2);
                    $coredata['low']        = round($sortedResult[$symbol]['data_banks_intraday']['low'], 2);
                    $coredata['volume']     = $sortedResult[$symbol]['data_banks_intraday']['volume'];
                    
                    $coredata['value']      = round($sortedResult[$symbol]['data_banks_intraday']['value'], 2);
                    
                    $coredata['lastprice']  = round($sortedResult[$symbol]['data_banks_intraday']['lastprice'], 2);
                    $coredata['trade']      = $sortedResult[$symbol]['data_banks_intraday']['trade'];
                    $totalChangePer         = (($sortedResult[$symbol]['data_banks_intraday']['lastprice'] - $sortedResult[$symbol]['data_banks_intraday']['yclose']) / $sortedResult[$symbol]['data_banks_intraday']['yclose']) * 100;
                    
                    $totalChangePer         = round($totalChangePer, 2);
                    $coredata['pchange']    = $totalChangePer;
                                        
                    $pe                     = $sortedResult[$symbol]['data_banks_intraday']['lastprice']/$annualizedEPS;
                    
                    $coredata['pe']         = round($pe,2);
                    $arrall[]               = $coredata;                    
                }
            }
            $arr = $arrall;            
                        
            $jsonresult = $this->__JEncode($arr);
            echo '({"total":"'.count($result).'","results":'.$jsonresult.'})';
        } 
        else {
            echo '({"total":"0", "results":""})';
        }
        die;        
    } 
    */
	
	// Encodes a SQL array into a JSON formated string
	function __JEncode($arr) {
		
		if (version_compare ( PHP_VERSION, "5.2", "<" )) {
			
			//App::import('Vendor', 'json', array('file' => 'JSON.php'));
			require_once (WWW_ROOT . DS . 'json' . DS . 'JSON.php');
			//require_once("./JSON.php"); //if php<5.2 need JSON class
			$json = new Services_JSON ( ); //instantiate new json object
			$data = $json->encode ( $arr ); //encode the data in json format
		} else {
			$data = json_encode ( $arr ); //encode the data in json format
		}
		return $data;
	}
	
	// Encodes a YYYY-MM-DD into a MM-DD-YYYY string
	function __codeDate($date) {
		$tab = explode ( "-", $date );
		$r = $tab [1] . "/" . $tab [2] . "/" . $tab [0];
		return $r;
	}
	
	// Encodes a MM-DD-YYYY into a YYYY-MM-DD string
	function __decodeDate($date) {
		$tab = explode ( "/", $date );
		$n = count ( $tab );
		if ($n == 3) {
			$r = $tab [2] . "-" . $tab [0] . "-" . $tab [1];
		} else {
			$r = "";
		}
		return $r;
	}
	
	function archive() {
		$this->layout = 'default-one';
		$this->pageTitle = 'Stock Bangladesh :: Archive Of MST';
	}
	
	function coefficient() {
        if (! $this->Session->check ( 'Auth.User' )) {
            $this->Session->setFlash ( 'You are not authorized to access that location.' );
            $this->redirect ( array ('controller' => 'users', 'action' => 'login' ) );
        }

        $this->layout = 'default-one';

        $this->pageTitle = 'Stock Bangladesh :: Beta Coefficient';



         if (isset ( $_POST ['TickerSymbol'] )) {
            $total_array = array();
            $total_array = $this->__betacoefficient($_POST ['TickerSymbol']);
            /*echo "<pre>";
            print_r($total_array);
            echo "<pre>";*/
            $range = $total_array[$_POST ['TickerSymbol']]['range'];
            $betaCoefficient = $total_array[$_POST ['TickerSymbol']]['beta'];
            $covariance = $total_array[$_POST ['TickerSymbol']]['covariance']; 
            $variance = $total_array[$_POST ['TickerSymbol']]['variance']; 
            $esrArr = $total_array[$_POST ['TickerSymbol']]['excessStockReturns']; 
            $emrArr = $total_array[$_POST ['TickerSymbol']]['excessMarketReturns']; 
            $esrTimeArr = $total_array[$_POST ['TickerSymbol']]['dateArr']; 
            $closePriceArrStock = $total_array[$_POST ['TickerSymbol']]['stockPriceArrWeekly']; 
            $dseIndexArrMarket = $total_array[$_POST ['TickerSymbol']]['indexArrWeekly'];   
            
            $this->set ( 'range', $range );

            $this->set ( 'betaCoefficient', $betaCoefficient );
            
            $this->set ( 'covariance', $covariance );
                            
            $this->set ( 'variance', $variance );                

            $this->set ( 'excessStockReturns', $esrArr );

            $this->set ( 'excessMarketReturns', $emrArr );
            
            $this->set ( 'dateArr', $esrTimeArr );
            
            $this->set ( 'stockPriceArrWeekly', $closePriceArrStock);

            $this->set ( 'indexArrWeekly', $dseIndexArrMarket );
           // die;
        }

    }
    
    function about_coefficient()
    {
        $this->layout = 'blank';
    }
	
	/*
    *  Sector comparison --demo                                 
    */

    function sectorcompare($updateRequest = '') 
    {
       // Configure::write('debug',3); 
       if (! $this->Session->check ( 'Auth.User' )) {
            $this->Session->setFlash ( 'You are not authorized to access that location.' );
            $this->redirect ( array ('controller' => 'users', 'action' => 'login' ) );
        }  
        $this->layout = 'default-compare';
        $this->pageTitle = 'Stock Bangladesh :: Sector Comparison';
        App::import ( 'Vendor', 'Phpchartdir', array ('file' => 'phpchartdir.php' ) );
        require_once (WWW_ROOT . DS . 'chart' . DS . 'Image_Toolbox.class.php');
        
        if(!empty($this->data))
        {
            $currentdate = $this->data['date'];
            $date = explode('-',$currentdate);
            $year = $date[0]; 
            $month = $date[1];
            $day =  $date[2]; 
            
            $weekday = date("l", mktime(0,0,0,$month,$day-1,$year));
            //pr($weekday);    
                
                if ($weekday == 'Friday')
                    $prevtimestamp = mktime ( 0, 0, 0, $month, $day - 2, $year );
                else if ($weekday == 'Saturday')
                    $prevtimestamp = mktime ( 0, 0, 0, $month, $day - 3, $year );
                else
                    $prevtimestamp = mktime ( 6, 0, 0, $month, $day - 1, $year );
            $prevdate = date('Y-m-d',$prevtimestamp);
            //pr($prevdate);
            
            
            
            
            $marketsql = "SELECT * FROM market_summeries WHERE date ='".$currentdate."' OR date ='".$prevdate."' ORDER BY id DESC";
        }else{
            $marketsql = "SELECT * FROM market_summeries ORDER BY id DESC LIMIT 0, 2";
            $this->set('nextdate',0);
        }
        
        
        $sql = "SELECT id,business_segment,dse_code FROM symbols WHERE business_segment!=''";
        $symbolinfo = $this->Symbol->query ( $sql );
        $sortedSymbolArr = array ();
        $sortedCodeArr = array ();
        foreach ( $symbolinfo as $row ) {
            $symbol = $row ['symbols'] ['id'];
            $code = trim($row ['symbols'] ['dse_code']);
            $sector = $row ['symbols'] ['business_segment'];
            $sortedSymbolArr [$symbol] = trim ( $sector );
            $sortedCodeArr[$code]=$symbol;
        }

        //$sql = "SELECT * FROM market_summeries ORDER BY id DESC LIMIT 0, 2";

        $marketArr = $this->Symbol->query ( $marketsql );

        $lastdate = $marketArr [0] ['market_summeries'] ['date'];

        //$lastdaystamp = strtotime ( $lastdate );
        $lastdaystamp = strtotime ( $lastdate )- (12*60*60);
        $lastdaystampOdd = strtotime ( $lastdate );
        $onedaybefore = $marketArr [1] ['market_summeries'] ['date'];
        $this->set('prevdate',$onedaybefore);
        
            $nextdateexplode = explode('-',$lastdate);
            $nyear = $nextdateexplode[0]; 
            $nmonth = $nextdateexplode[1];
            $nday =  $nextdateexplode[2]; 
            $weekday = date("l", mktime(0,0,0,$nmonth,$nday+1,$nyear));
               if ($weekday == 'Friday')
                    $nextdaytimestamp = mktime ( 0, 0, 0, $month, $day + 3, $year );
                else if ($weekday == 'Saturday')
                    $nextdaytimestamp = mktime ( 0, 0, 0, $month, $day + 2, $year );
                else
                    $nextdaytimestamp = mktime ( 6, 0, 0, $month, $day + 1, $year );
               $nextdate = date('Y-m-d',$nextdaytimestamp);
        
            if(!empty($this->data))
            {
                $this->set('nextdate',$nextdate);
            }
        
        $onedaybeforestamp = strtotime ( $onedaybefore )-(12*60*60);
        $sql = "SELECT * FROM outputs USE INDEX (symbol) where daystamp>=$onedaybeforestamp and symbol>10 ORDER BY id ";
        $resultArr = $this->Symbol->query ( $sql );
        $sortedArr = array ();
        foreach ( $resultArr as $row ) {
            $day = $row ['outputs'] ['date'];

            $symbol = $row ['outputs'] ['symbol'];

            $tradevalue = $row ['outputs'] ['tradevalues'];

            $day = strtotime ( $day );

            $sector = $sortedSymbolArr [$symbol];

            $sortedArr [$day] [$sector] [$symbol] = $tradevalue;

        }

        $sectorCapArr = array ();
        foreach ( $sortedArr as $day => $arr ) {

            $marketCap = 0;

            foreach ( $arr as $sector => $datarr ) {

                $sectorTotal = 0;

                foreach ( $datarr as $symbol => $tradevalue ) {

                    $sectorTotal += $tradevalue;

                    $marketCap += $tradevalue;

                }
            if($sectorTotal!=0)
                $sectorCapArr [$sector] [] = $sectorTotal;

            }



            //echo "$marketCap <br />";
        }



    //    echo "<pre>";
  //      print_r ( $sectorCapArr);
//        die;
        



        /*$totaltrade=0;
        foreach ($resultArr as $result)
        {

        $totaltrade+=$result['outputs']['tradevalues'];
        }

        echo $totaltrade;*/



        //exit ();




        $labels = array ();

        $lastdateTotal = 0;

        $onedaybeforeTotal = 0;
        arsort($sectorCapArr);//himel
        foreach ( $sectorCapArr as $sector => $dataArr ) {

            $labels [] = $sector;

            $data [] = $dataArr [0];

            $data2 [] = $dataArr [1];

            $onedaybeforeTotal += $dataArr [0];

            $lastdateTotal += $dataArr [1];

        }
       //$daystamp=$lastdaystamp;
       $daystamp=$lastdaystamp+(12*60*60);
       //$yesterdayStamp=$onedaybeforestamp;
       $yesterdayStamp=$onedaybeforestamp+(12*60*60);

        $oddsql = "SELECT sum(tradevalues) as totalodd FROM outputs_odd_lot where daystamp=$yesterdayStamp";

        $oddresultArryester = $this->Symbol->query ( $oddsql );

        $oddsql = "SELECT sum(tradevalues) as totalodd FROM outputs_odd_lot where daystamp=$daystamp";
        

        $oddresultArrtoday = $this->Symbol->query ( $oddsql );


        $blocksql = "SELECT sum(tradevalues) as totalblock FROM outputs_block where daystamp=$yesterdayStamp";

        $blockresultArryester = $this->Symbol->query ( $blocksql );

        $blocksql = "SELECT sum(tradevalues) as totalblock FROM outputs_block where daystamp=$daystamp";

        $blockresultArrtoday = $this->Symbol->query ( $blocksql );

        /*echo "<pre>";
        print_r($sectorCapArr);
        exit;*/
        $this->set ( 'sectorCapArr', $sectorCapArr );
        $_SESSION['sectorCapArrBar']=$sectorCapArr;
        $this->set ( 'oddresultArryester', round($oddresultArryester[0][0]['totalodd'],2) );
        $this->set ( 'oddresultArrtoday', round($oddresultArrtoday[0][0]['totalodd'],2) );
        $this->set ( 'blockresultArryester', round($blockresultArryester[0][0]['totalblock'],2) );
        $this->set ( 'blockresultArrtoday', round($blockresultArrtoday[0][0]['totalblock'],2) );
        $this->set ( 'lastdate', $lastdate );
        $_SESSION['lastdate']=$lastdate;
        $this->set ( 'onedaybefore', $onedaybefore );
        $_SESSION['onedaybefore']=$onedaybefore;
        $this->set ( 'lastdateTotal', $lastdateTotal );
        $_SESSION['lastdateTotal']=$lastdateTotal;
        $this->set ( 'onedaybeforeTotal', $onedaybeforeTotal );
        $_SESSION['onedaybeforeTotal']=$onedaybeforeTotal;
        
        $this->set('data',$data);
        $this->set('data2',$data2);
        $this->set('label',$labels);
        
        //echo "<pre>";
//        ksort($sectorCapArr);
//        print_r ($sectorCapArr);
        //print_r ( $data);
        //print_r ( $data2);

//        die;

        //$data = array (88, 124, 96 );




        # Data for inner ring
        //$data2 = array (77, 87, 45 );




        # Labels for the sectors
        //$labels = array ("Hardware", "Software", "Services" );




        # Colors for the sectors
        $colors = array (0xff9999, 0x9999ff, 0x66ff66 );



        #
        # Create the main chart, which contains the chart title, the outer ring, and the
        # legend box
        #




        # Create a PieChart object of size 450 x 360 pixels, with transparent background
        $c = new PieChart ( 890, 660 );



        # Add a title to the chart with 18pts Times Bold Italic font
        $c->addTitle ( "Sector wise Market Composition", "timesbi.ttf", 16 );



        # Set donut center at (160, 200), and outer/inner radii as 150/100 pixels
        $c->setDonutSize ( 350, 325, 300, 200 );



        # Add a label at the bottom-right corner of the ring to label the outer ring Use
        # 12pts Arial Bold Italic font in white (ffffff) color, on a green (008800)
        # background, with soft lighting effect and 5 pixels rounded corners
        $t = $c->addText ( 295, 300, "$lastdate", "arialbi.ttf", 12, 0xffffff );

        $t->setBackground ( 0x008800, Transparent, softLighting () );

        $t->setRoundedCorners ( 5 );



        # Set the legend box at (320, 50) with 12 pts Arial Bold Italic font, with no border
        $legendObj = $c->addLegend ( 700, 50, true, "arialbi.ttf", 10 );

        $legendObj->setBackground ( Transparent, Transparent );



        # Set the pie data and the pie labels
        $c->setData ( $data, $labels );



        # Set the pie colors
        $c->setColors2 ( DataColor, $colors );



        # Set pie border color to white (ffffff)
        $c->setLineColor ( 0xffffff );



        # Set pie label to value in $###M format, percentage in (##.#%) format, in two lines.
        $c->setLabelFormat ( "{percent|1}%" );



        # Use 10pts Airal Bold for the sector labels
        $c->setLabelStyle ( "arialbd.ttf", 10 );



        # Set the label position to -25 pixels from the sector (which would be internal to
        # the sector)
        $c->setLabelPos ( - 25 );

        //$c->setLabelLayout(SideLayout);




        #
        # Create the inner ring.
        #




        # Create a PieChart object of size 280 x 320 pixels, with transparent background
        $c2 = new PieChart ( 550, 600, Transparent );



        # Set donut center at (110, 110), and outer/inner radii as 100/50 pixels
        $c2->setDonutSize ( 300, 235, 200, 50 );



        # Add a label at the center of the ring to label the inner ring. Use 12pts Arial Bold
        # Italic font in white (ffffff) color, on a deep blue (0000cc) background, with soft
        # lighting effect and 5 pixels rounded corners
        $t2 = $c2->addText ( 50, 10, "$onedaybefore", "arialbi.ttf", 12, 0xffffff, Center );

        $t2->setBackground ( 0x0000cc, Transparent, softLighting () );

        $t2->setRoundedCorners ( 5 );



        # Set the pie data and the pie labels
        $c2->setData ( $data2, $labels );



        # Set the pie colors
        $c2->setColors2 ( DataColor, $colors );



        # Set pie border color to white (ffffff)
        $c2->setLineColor ( 0xffffff );



        # Set pie label to value in $###M format, percentage in (##.#%) format, in two lines.
        $c2->setLabelFormat ( "{percent|1}%" );



        # Use 10pts Airal Bold for the sector labels
        $c2->setLabelStyle ( "arialbd.ttf", 10 );



        # Set the label position to -25 pixels from the sector (which would be internal to
        # the sector)
        $c2->setLabelPos ( - 25 );



        # merge the inner ring into the outer ring at (50, 90)
        $makeChartObj = $c->makeChart3 ();

        $makeChartObj->merge ( $c2->makeChart3 (), 50, 90, TopLeft, 0 );



        # Output the chart
        //header ( "Content-type: image/png" );
        //print ($c->makeChart2 ( PNG )) ;
        $chartData = $c->makeChart2 ( PNG );
        //print($chartData);
        
        
        $chartImagePath = WWW_ROOT . 'chart' . DS . 'sectorcomparechart.png';

        $f = fopen ( $chartImagePath, "wb" );

        fwrite ( $f, $chartData );

        fclose ( $f );
        
        

        /*$img = new Image_Toolbox ( $chartImagePath );
        $width = $img->_img ['main'] ['width'];
        $img->addImage ( $width, 10, '#FFFFFF' );
        $img->blendMask ( 'left', 'bottom', IMAGE_TOOLBOX_BLEND_COPY, 0, 650 );
        $img->output ();*/
        
       //die();


    }
    
    
    
    
     
    
    function sectorcompare1($updateRequest = '') {
       // Configure::write('debug',3);   
        $this->layout = 'default-compare';
        $this->pageTitle = 'Stock Bangladesh :: Sector Comparison';
        App::import ( 'Vendor', 'Phpchartdir', array ('file' => 'phpchartdir.php' ) );
        require_once (WWW_ROOT . DS . 'chart' . DS . 'Image_Toolbox.class.php');
        
        if(!empty($this->data))
        {
            $currentdate = $this->data['date'];
            $date = explode('-',$currentdate);
            $year = $date[0]; 
            $month = $date[1];
            $day =  $date[2]; 
            
            $weekday = date("l", mktime(0,0,0,$month,$day-1,$year));
            //pr($weekday);    
                
                if ($weekday == 'Friday')
                    $prevtimestamp = mktime ( 0, 0, 0, $month, $day - 2, $year );
                else if ($weekday == 'Saturday')
                    $prevtimestamp = mktime ( 0, 0, 0, $month, $day - 3, $year );
                else
                    $prevtimestamp = mktime ( 6, 0, 0, $month, $day - 1, $year );
            $prevdate = date('Y-m-d',$prevtimestamp);
            //pr($prevdate);
            
            
            
            
            $marketsql = "SELECT * FROM market_summeries WHERE date ='".$currentdate."' OR date ='".$prevdate."' ORDER BY id DESC";
        }else{
            $marketsql = "SELECT * FROM market_summeries ORDER BY id DESC LIMIT 0, 2";
            $this->set('nextdate',0);
        }
        
        
        $sql = "SELECT id,business_segment,dse_code FROM symbols";
        $symbolinfo = $this->Symbol->query ( $sql );
        $sortedSymbolArr = array ();
        $sortedCodeArr = array ();
        foreach ( $symbolinfo as $row ) {
            $symbol = $row ['symbols'] ['id'];
            $code = trim($row ['symbols'] ['dse_code']);
            $sector = $row ['symbols'] ['business_segment'];
            $sortedSymbolArr [$symbol] = trim ( $sector );
            $sortedCodeArr[$code]=$symbol;
        }

        //$sql = "SELECT * FROM market_summeries ORDER BY id DESC LIMIT 0, 2";

        $marketArr = $this->Symbol->query ( $marketsql );

        $lastdate = $marketArr [0] ['market_summeries'] ['date'];

        //$lastdaystamp = strtotime ( $lastdate );
        $lastdaystamp = strtotime ( $lastdate )- (12*60*60);
        $lastdaystampOdd = strtotime ( $lastdate );
        $onedaybefore = $marketArr [1] ['market_summeries'] ['date'];
        $this->set('prevdate',$onedaybefore);
        
            $nextdateexplode = explode('-',$lastdate);
            $nyear = $nextdateexplode[0]; 
            $nmonth = $nextdateexplode[1];
            $nday =  $nextdateexplode[2]; 
            $weekday = date("l", mktime(0,0,0,$nmonth,$nday+1,$nyear));
               if ($weekday == 'Friday')
                    $nextdaytimestamp = mktime ( 0, 0, 0, $month, $day + 3, $year );
                else if ($weekday == 'Saturday')
                    $nextdaytimestamp = mktime ( 0, 0, 0, $month, $day + 2, $year );
                else
                    $nextdaytimestamp = mktime ( 6, 0, 0, $month, $day + 1, $year );
               $nextdate = date('Y-m-d',$nextdaytimestamp);
        
            if(!empty($this->data))
            {
                $this->set('nextdate',$nextdate);
            }
        
        $onedaybeforestamp = strtotime ( $onedaybefore )-(12*60*60);
        $sql = "SELECT * FROM outputs USE INDEX (symbol) where daystamp>=$onedaybeforestamp and symbol>10 ORDER BY id ";
        $resultArr = $this->Symbol->query ( $sql );
        $sortedArr = array ();
        foreach ( $resultArr as $row ) {
            $day = $row ['outputs'] ['date'];

            $symbol = $row ['outputs'] ['symbol'];

            $tradevalue = $row ['outputs'] ['tradevalues'];

            $day = strtotime ( $day );

            $sector = $sortedSymbolArr [$symbol];

            $sortedArr [$day] [$sector] [$symbol] = $tradevalue;

        }

        $sectorCapArr = array ();
        foreach ( $sortedArr as $day => $arr ) {

            $marketCap = 0;

            foreach ( $arr as $sector => $datarr ) {

                $sectorTotal = 0;

                foreach ( $datarr as $symbol => $tradevalue ) {

                    $sectorTotal += $tradevalue;

                    $marketCap += $tradevalue;

                }
            if($sectorTotal!=0)
                $sectorCapArr [$sector] [] = $sectorTotal;

            }



            //echo "$marketCap <br />";
        }



    //    echo "<pre>";
  //      print_r ( $sectorCapArr);
//        die;
        



        /*$totaltrade=0;
        foreach ($resultArr as $result)
        {

        $totaltrade+=$result['outputs']['tradevalues'];
        }

        echo $totaltrade;*/



        //exit ();




        $labels = array ();

        $lastdateTotal = 0;

        $onedaybeforeTotal = 0;
        arsort($sectorCapArr);//himel
        foreach ( $sectorCapArr as $sector => $dataArr ) {

            $labels [] = $sector;

            $data [] = $dataArr [0];

            $data2 [] = $dataArr [1];

            $onedaybeforeTotal += $dataArr [0];

            $lastdateTotal += $dataArr [1];

        }
       //$daystamp=$lastdaystamp;
       $daystamp=$lastdaystamp+(12*60*60);
       //$yesterdayStamp=$onedaybeforestamp;
       $yesterdayStamp=$onedaybeforestamp+(12*60*60);

        $oddsql = "SELECT sum(tradevalues) as totalodd FROM outputs_odd_lot where daystamp=$yesterdayStamp";

        $oddresultArryester = $this->Symbol->query ( $oddsql );

        $oddsql = "SELECT sum(tradevalues) as totalodd FROM outputs_odd_lot where daystamp=$daystamp";
        

        $oddresultArrtoday = $this->Symbol->query ( $oddsql );


        $blocksql = "SELECT sum(tradevalues) as totalblock FROM outputs_block where daystamp=$yesterdayStamp";

        $blockresultArryester = $this->Symbol->query ( $blocksql );

        $blocksql = "SELECT sum(tradevalues) as totalblock FROM outputs_block where daystamp=$daystamp";

        $blockresultArrtoday = $this->Symbol->query ( $blocksql );

        /*echo "<pre>";
        print_r($sectorCapArr);
        exit;*/
        $this->set ( 'sectorCapArr', $sectorCapArr );
        $_SESSION['sectorCapArrBar']=$sectorCapArr;
        $this->set ( 'oddresultArryester', round($oddresultArryester[0][0]['totalodd'],2) );
        $this->set ( 'oddresultArrtoday', round($oddresultArrtoday[0][0]['totalodd'],2) );
        $this->set ( 'blockresultArryester', round($blockresultArryester[0][0]['totalblock'],2) );
        $this->set ( 'blockresultArrtoday', round($blockresultArrtoday[0][0]['totalblock'],2) );
        $this->set ( 'lastdate', $lastdate );
        $_SESSION['lastdate']=$lastdate;
        $this->set ( 'onedaybefore', $onedaybefore );
        $_SESSION['onedaybefore']=$onedaybefore;
        $this->set ( 'lastdateTotal', $lastdateTotal );
        $_SESSION['lastdateTotal']=$lastdateTotal;
        $this->set ( 'onedaybeforeTotal', $onedaybeforeTotal );
        $_SESSION['onedaybeforeTotal']=$onedaybeforeTotal;
        
        $this->set('data',$data);
        $this->set('data2',$data2);
        $this->set('label',$labels);
        
        //echo "<pre>";
//        ksort($sectorCapArr);
//        print_r ($sectorCapArr);
        //print_r ( $data);
        //print_r ( $data2);

//        die;

        //$data = array (88, 124, 96 );




        # Data for inner ring
        //$data2 = array (77, 87, 45 );




        # Labels for the sectors
        //$labels = array ("Hardware", "Software", "Services" );




        # Colors for the sectors
        $colors = array (0xff9999, 0x9999ff, 0x66ff66 );



        #
        # Create the main chart, which contains the chart title, the outer ring, and the
        # legend box
        #




        # Create a PieChart object of size 450 x 360 pixels, with transparent background
        $c = new PieChart ( 890, 660 );



        # Add a title to the chart with 18pts Times Bold Italic font
        $c->addTitle ( "Sector wise Market Composition", "timesbi.ttf", 16 );



        # Set donut center at (160, 200), and outer/inner radii as 150/100 pixels
        $c->setDonutSize ( 350, 325, 300, 200 );



        # Add a label at the bottom-right corner of the ring to label the outer ring Use
        # 12pts Arial Bold Italic font in white (ffffff) color, on a green (008800)
        # background, with soft lighting effect and 5 pixels rounded corners
        $t = $c->addText ( 295, 300, "$lastdate", "arialbi.ttf", 12, 0xffffff );

        $t->setBackground ( 0x008800, Transparent, softLighting () );

        $t->setRoundedCorners ( 5 );



        # Set the legend box at (320, 50) with 12 pts Arial Bold Italic font, with no border
        $legendObj = $c->addLegend ( 700, 50, true, "arialbi.ttf", 10 );

        $legendObj->setBackground ( Transparent, Transparent );



        # Set the pie data and the pie labels
        $c->setData ( $data, $labels );



        # Set the pie colors
        $c->setColors2 ( DataColor, $colors );



        # Set pie border color to white (ffffff)
        $c->setLineColor ( 0xffffff );



        # Set pie label to value in $###M format, percentage in (##.#%) format, in two lines.
        $c->setLabelFormat ( "{percent|1}%" );



        # Use 10pts Airal Bold for the sector labels
        $c->setLabelStyle ( "arialbd.ttf", 10 );



        # Set the label position to -25 pixels from the sector (which would be internal to
        # the sector)
        $c->setLabelPos ( - 25 );

        //$c->setLabelLayout(SideLayout);




        #
        # Create the inner ring.
        #




        # Create a PieChart object of size 280 x 320 pixels, with transparent background
        $c2 = new PieChart ( 550, 600, Transparent );



        # Set donut center at (110, 110), and outer/inner radii as 100/50 pixels
        $c2->setDonutSize ( 300, 235, 200, 50 );



        # Add a label at the center of the ring to label the inner ring. Use 12pts Arial Bold
        # Italic font in white (ffffff) color, on a deep blue (0000cc) background, with soft
        # lighting effect and 5 pixels rounded corners
        $t2 = $c2->addText ( 50, 10, "$onedaybefore", "arialbi.ttf", 12, 0xffffff, Center );

        $t2->setBackground ( 0x0000cc, Transparent, softLighting () );

        $t2->setRoundedCorners ( 5 );



        # Set the pie data and the pie labels
        $c2->setData ( $data2, $labels );



        # Set the pie colors
        $c2->setColors2 ( DataColor, $colors );



        # Set pie border color to white (ffffff)
        $c2->setLineColor ( 0xffffff );



        # Set pie label to value in $###M format, percentage in (##.#%) format, in two lines.
        $c2->setLabelFormat ( "{percent|1}%" );



        # Use 10pts Airal Bold for the sector labels
        $c2->setLabelStyle ( "arialbd.ttf", 10 );



        # Set the label position to -25 pixels from the sector (which would be internal to
        # the sector)
        $c2->setLabelPos ( - 25 );



        # merge the inner ring into the outer ring at (50, 90)
        $makeChartObj = $c->makeChart3 ();

        $makeChartObj->merge ( $c2->makeChart3 (), 50, 90, TopLeft, 0 );



        # Output the chart
        //header ( "Content-type: image/png" );
        //print ($c->makeChart2 ( PNG )) ;
        $chartData = $c->makeChart2 ( PNG );
        //print($chartData);
        
        
        $chartImagePath = WWW_ROOT . 'chart' . DS . 'sectorcomparechart.png';

        $f = fopen ( $chartImagePath, "wb" );

        fwrite ( $f, $chartData );

        fclose ( $f );
        
        

        /*$img = new Image_Toolbox ( $chartImagePath );
        $width = $img->_img ['main'] ['width'];
        $img->addImage ( $width, 10, '#FFFFFF' );
        $img->blendMask ( 'left', 'bottom', IMAGE_TOOLBOX_BLEND_COPY, 0, 650 );
        $img->output ();*/
        
       //die();


    }   
    
    function multibar($type=NULL){
        App::import ( 'Vendor', 'Phpchartdir', array ('file' => 'phpchartdir.php'));
        require_once (WWW_ROOT . DS . 'chart' . DS . 'Image_Toolbox.class.php');
        # The data for the bar chart
        foreach($_SESSION['sectorCapArrBar'] as $key=>$val){
        $dataSort[$key]=$val[1];
        }
        asort($dataSort);
        foreach($dataSort as $key=>$data){
            $data0[]=$_SESSION['sectorCapArrBar'][$key][1];
            $data1[]=$_SESSION['sectorCapArrBar'][$key][0];
        }
        /*foreach($dataSort as $key=>$data){
            $datap0[]=number_format($_SESSION['sectorCapArrBar'][$key][0]/$_SESSION["onedaybeforeTotal"],2);
            $datap1[]=number_format($_SESSION['sectorCapArrBar'][$key][1]/$_SESSION["lastdateTotal"],2);
        }
        */
        # The labels for the bar chart. The labels contains embedded images as icons.
        foreach($dataSort  as $key=>$val){
        $labels[]=$key;
        }
        //rsort($labels);
        # Create a XYChart object of size 600 x 350 pixels, using 0xe0e0ff as the background
        # color, 0xccccff as the border color, with 1 pixel 3D border effect.
        $c = new XYChart(700, 750, 0xe9ffe2, 0xccccff, 1);

        #Set directory for loading images to current script directory
        #Need when running under Microsoft IIS
        $c->setSearchPath(dirname(__FILE__));

        # Add a title to the chart using 14 points Times Bold Itatic font and light blue
        # (0x9999ff) as the background color
        $textBoxObj = $c->addTitle("", "timesbi.ttf", 14);
        $textBoxObj->setBackground(0xe9ffe2);

        # Set the plotarea at (60, 45) and of size 500 x 210 pixels, using white (0xffffff)
        # as the background
        $c->setPlotArea(120, 45, 500, 610, 0xffffff);

        # Swap the x and y axes to create a horizontal bar chart
        $c->swapXY();

        # Add a title to the y axis using 11 pt Times Bold Italic as font
        $c->yAxis->setTitle("Volume (millions)", "timesbi.ttf", 13);

        # Set the labels on the x axis
        $c->xAxis->setLabels($labels);

        # Disable x-axis ticks by setting the tick length to 0
        $c->xAxis->setTickLength(0);

        # Add a stacked bar layer to the chart
        $layer = $c->addBarLayer2(Stack);

        $textBoxObj = $c->addText ( 400, 400, "www.stockbangladesh.org", "timesbi.ttf", 13, 0xc09090 );
        $textBoxObj->setAlignment ( TopLeft );
                
        # Add the first two data sets to the chart as a stacked bar group
        $layer->addDataGroup($_SESSION["lastdate"]);
        $layer->addDataSet($data0, 0x8080ff, "Trade");

        $layer->addDataGroup($_SESSION["onedaybefore"]);
        $layer->addDataSet($data1, 0x80ff80, "Trade");

        # Set the sub-bar gap to 0, so there is no gap between stacked bars with a group
        $layer->setBarGap(0.2, 0);

        # Set the bar border to transparent
        $layer->setBorderColor(Transparent);

        # Set the aggregate label format
        //$layer->setAggregateLabelFormat("Year {dataGroupName}\n{value} millions");

        # Set the aggregate label font to 8 point Arial Bold Italic
        $layer->setAggregateLabelStyle("timesbi.ttf",10);

        # Reverse 20% space at the right during auto-scaling to allow space for the aggregate
        # bar labels
        $c->yAxis->setAutoScale(0.1);

        # Add a legend box at (310, 300) using TopCenter alignment, with 2 column grid
        # layout, and use 8 pts Arial Bold Italic as font
        $legendBox = $c->addLegend2(310, 700, 2, "arialbi.ttf", 13);
        $legendBox->setAlignment(TopCenter);

        # Set the format of the text displayed in the legend box
        $legendBox->setText(" {dataGroupName} {dataSetName}");

        # Set the background and border of the legend box to transparent
        $legendBox->setBackground(Transparent, Transparent);

        # Output the chart
        //header("Content-type: image/png");
         //print($c->makeChart2(PNG));
         
         
         # Output the chart
        //header ( "Content-type: image/png" );
        //print ($c->makeChart2 ( PNG )) ;
        $chartData = $c->makeChart2 ( PNG );
        //print($chartData);
        $chartImagePath = WWW_ROOT . 'chart' . DS . 'multibar.png';

        $f = fopen ( $chartImagePath, "wb" );

        fwrite ( $f, $chartData );

        fclose ( $f );
        
        $img = new Image_Toolbox ( $chartImagePath );
        $width = $img->_img ['main'] ['width'];
        $img->addImage ( $width, 10, '#e9ffe2' );
        $img->blendMask ( 'left', 'bottom', IMAGE_TOOLBOX_BLEND_COPY, 0, 740 );
        $img->output ();
}
 function multibar1($sectors=NULL){
        App::import ( 'Vendor', 'Phpchartdir', array ('file' => 'phpchartdir.php'));
        require_once (WWW_ROOT . DS . 'chart' . DS . 'Image_Toolbox.class.php');
        # The data for the bar chart
        foreach($_SESSION['sectorCapArrBar'] as $key=>$val){
        $dataSort[$key]=$val[1];
        }
        asort($dataSort);
        foreach($dataSort as $key=>$data){
            $data0[]=number_format(($_SESSION['sectorCapArrBar'][$key][1]/$_SESSION["lastdateTotal"])*100,1);
            $data1[]=number_format(($_SESSION['sectorCapArrBar'][$key][0]/$_SESSION["onedaybeforeTotal"])*100,1);
        }

        # The labels for the bar chart. The labels contains embedded images as icons.
        foreach($dataSort  as $key=>$val){
        $labels[]=$key;
        }
        //rsort($labels);
        # Create a XYChart object of size 600 x 350 pixels, using 0xe0e0ff as the background
        # color, 0xccccff as the border color, with 1 pixel 3D border effect.
        $c = new XYChart(700, 750, 0xe9ffe2, 0xccccff, 1);

        #Set directory for loading images to current script directory
        #Need when running under Microsoft IIS
        $c->setSearchPath(dirname(__FILE__));

        # Add a title to the chart using 14 points Times Bold Itatic font and light blue
        # (0x9999ff) as the background color
        $textBoxObj = $c->addTitle("", "timesbi.ttf", 14);
        $textBoxObj->setBackground(0xe9ffe2);

        # Set the plotarea at (60, 45) and of size 500 x 210 pixels, using white (0xffffff)
        # as the background
        $c->setPlotArea(120, 45, 500, 610, 0xffffff);

        # Swap the x and y axes to create a horizontal bar chart
        $c->swapXY();

        # Add a title to the y axis using 11 pt Times Bold Italic as font
        $c->yAxis->setTitle("Volume", "timesbi.ttf", 13);

        # Set the labels on the x axis
        $c->xAxis->setLabels($labels);

        # Disable x-axis ticks by setting the tick length to 0
        $c->xAxis->setTickLength(0);

        # Add a stacked bar layer to the chart
        $layer = $c->addBarLayer2(Stack);

        $textBoxObj = $c->addText ( 400, 400, "www.stockbangladesh.org", "timesbi.ttf", 13, 0xc09090 );
        $textBoxObj->setAlignment ( TopLeft );

        # Add the first two data sets to the chart as a stacked bar group
        $layer->addDataGroup($_SESSION["lastdate"]);
        $layer->addDataSet($data0, 0x8080ff, "Trade");

        $layer->addDataGroup($_SESSION["onedaybefore"]);
        $layer->addDataSet($data1, 0x80ff80, "Trade");

        # Set the sub-bar gap to 0, so there is no gap between stacked bars with a group
        $layer->setBarGap(0.2, 0);

        # Set the bar border to transparent
        $layer->setBorderColor(Transparent);

        # Set the aggregate label format
        //$layer->setAggregateLabelFormat("Year {dataGroupName}\n{value} millions");

        # Set the aggregate label font to 8 point Arial Bold Italic
        $layer->setAggregateLabelStyle("timesbi.ttf", 10);

        # Reverse 20% space at the right during auto-scaling to allow space for the aggregate
        # bar labels
        $c->yAxis->setAutoScale(0.1);

        # Add a legend box at (310, 300) using TopCenter alignment, with 2 column grid
        # layout, and use 8 pts Arial Bold Italic as font
        $legendBox = $c->addLegend2(310, 700, 2, "arialbi.ttf", 13);
        $legendBox->setAlignment(TopCenter);

        # Set the format of the text displayed in the legend box
        $legendBox->setText(" {dataGroupName} {dataSetName} ");

        # Set the background and border of the legend box to transparent
        $legendBox->setBackground(Transparent, Transparent);

        # Output the chart
        $chartData = $c->makeChart2 ( PNG );
        $chartImagePath = WWW_ROOT . 'chart' . DS . 'multibar1.png';

        $f = fopen ( $chartImagePath, "wb" );

        fwrite ( $f, $chartData );

        fclose ( $f );
        
        $img = new Image_Toolbox ( $chartImagePath );
        $width = $img->_img ['main'] ['width'];
        $img->addImage ( $width, 10, '#e9ffe2' );
        $img->blendMask ( 'left', 'bottom', IMAGE_TOOLBOX_BLEND_COPY, 0, 740 );
        $img->output ();
}

  function multibar2($sectors=NULL){
 
         
         $tade_dates=mysql_fetch_array(mysql_query("SELECT * FROM market_summeries ORDER BY id desc LIMIT 1"));
         $current_date=$tade_dates['date'];
         $sqlStr="SELECT DISTINCT business_segment FROM symbols WHERE business_segment!='' ORDER BY business_segment ASC LIMIT 21";
         $sectors=$this->Symbol->query($sqlStr);
        // print_r($sectors);
         $sqlStr="SELECT business_segment,id,dse_code,yclose,last_final_trade_price,(lasttradeprice-yclose) as final_change,((lasttradeprice-yclose)/yclose)*100 as final_chang_per FROM symbols WHERE business_segment!=''  ORDER BY business_segment ASC    ";
         $dataSymbol=$this->Symbol->query($sqlStr);
         

         $dat_format=explode("-",$current_date);
         $dat_format=$dat_format[2].'-'.$dat_format[1].'-'.$dat_format[0];
         $sqlStr="SELECT symbol FROM outputs WHERE date LIKE '%$dat_format%' AND volume>0 AND symbol>1 ";
                $sqlQuery=mysql_query($sqlStr);
                while($data=mysql_fetch_assoc($sqlQuery)){
                    $dataOutput[]=$data['symbol'];//$data['symbol']
                }
                
         
         $dataArray=array();
         foreach($sectors as $sector){
         $sector_name=$sector['symbols']['business_segment'];
         $gainertotal=0;
         $losertotal=0;
         $un_ch=0;
         $unchangetotal=0;
             
            foreach($dataSymbol as $data){
            if($data['symbols']['business_segment']==$sector_name){
            if(in_array($data['symbols']["id"],$dataOutput)){
                if($data[0]['final_chang_per']>=2)$gainertotal++;
                if($data[0]['final_chang_per']<=-2)$losertotal++;
                if($data[0]['final_chang_per']>-2 AND $data[0]['final_chang_per']<0)$unchangetotal++;
                if($data[0]['final_chang_per']>=0 AND  $data[0]['final_chang_per']<2)$un_ch++;
                
            }
            }
            $dataArray[$sector_name]["gainer"]=$gainertotal;
            $dataArray[$sector_name]["looser"]=$losertotal;
            $dataArray[$sector_name]["equal"]=$unchangetotal;
            $dataArray[$sector_name]["un_ch"]=$un_ch;
            }
         }
        foreach($dataArray as $key=>$data){
            if(($data["gainer"]+$data["looser"]+$data["equal"]+$data["un_ch"])==0)    
            unset($dataArray[$key]);
        }
        App::import ( 'Vendor', 'Phpchartdir', array ('file' => 'phpchartdir.php')); 
        require_once (WWW_ROOT . DS . 'chart' . DS . 'Image_Toolbox.class.php');

        $dataArray=array_reverse($dataArray);

        foreach($dataArray as $key=>$swdata){
         $labels[]=$key;
         $data0[]=$swdata["gainer"];
         $data1[]=$swdata["looser"];
         $data2[]=$swdata["equal"];
         $data3[]=$swdata["un_ch"];
        }


        # Create a XYChart object of size 500 x 320 pixels. Use a vertical gradient color
        # from pale blue (e8f0f8) to sky blue (aaccff) spanning half the chart height as
        # background. Set border to blue (88aaee). Use rounded corners. Enable soft drop
        # shadow.
        $c = new XYChart(800, 520);
        $c->setBackground($c->linearGradientColor(0, 0, 0, $c->getHeight() / 2, 0xffffff,0xffffff), 0x88aaee);
        $c->setRoundedFrame();
        $c->setDropShadow();

        #Set directory for loading images to current script directory
        #Need when running under Microsoft IIS
        $c->setSearchPath(dirname(__FILE__));

        # Add a title to the chart using 15 points Arial Italic. Set top/bottom margins to 15
        # pixels.
        $title = $c->addTitle("Sectorwise Gainer Looser in-depth", "ariali.ttf", 15);
        $title->setMargin2(0, 0, 15, 15);

        # Tentatively set the plotarea to 50 pixels from the left edge, and to just under the
        # title. Set the width to 60% of the chart width, and the height to 50 pixels from
        # the bottom edge. Use pale blue (e8f0f8) background, transparent border, and grey
        # (aaaaaa) grid lines.
        $c->setPlotArea(50, $title->getHeight(), $c->getWidth() * 6 / 10, $c->getHeight() -$title->getHeight() - 50, 0xe8f0f8, -1, Transparent, 0xaaaaaa);

        # Add a legend box where the top-right corner is anchored at 10 pixels from the right
        # edge, and just under the title. Use vertical layout and 8 points Arial font.
        $legendBox = $c->addLegend($c->getWidth() - 10, $title->getHeight(), true, "arial.ttf", 8);
        $legendBox->setAlignment(TopRight);

        # Set the legend box background and border to transparent
        $legendBox->setBackground(Transparent, Transparent);

        # Set the legend box icon size to 16 x 32 pixels to match with custom icon size
        $legendBox->setKeySize(16, 32);

        # Set axes to transparent
        $c->xAxis->setColors(Transparent);
        $c->yAxis->setColors(Transparent);

        # Set the labels on the x axis
        $c->xAxis->setLabels($labels);

        # Add a percentage bar layer
        $layer = $c->addBarLayer2(Percentage);

        $c->swapXY();
        # Add the three data sets to the bar layer, using icons images with labels as data
        # set names
        $textBoxObj = $c->addText ( 600, 10, "www.stockbangladesh.org", "timesbi.ttf", 11, 0xc09090 );
        $textBoxObj->setAlignment ( TopLeft );

        $layer->addDataSet($data1, 0xff0000,"-2%");
        $layer->addDataSet($data2, 0xffCEBE,"+(0 to -2)%");
        $layer->addDataSet($data3, 0xACF4AC,"(2 to 0)%");
        $layer->addDataSet($data0, 0x00ff00,"+2%");
        # Use soft lighting effect with light direction from top
        $layer->setBorderColor(Transparent, softLighting(Top));

        # Enable data label at the middle of the the bar
        $textBoxObj = $layer->setDataLabelStyle();
        $textBoxObj->setAlignment(Center);

        # For a vertical stacked chart with positive data only, the last data set is always
        # on top. However, in a vertical legend box, the last data set is at the bottom. This
        # can be reversed by using the setLegend method.
        $layer->setLegend(ReverseLegend);

        # Adjust the plot area size, such that the bounding box (inclusive of axes) is 15
        # pixels from the left edge, just below the title, 10 pixels to the right of the
        # legend box, and 15 pixels from the bottom edge.
        $layoutLegendObj = $c->layoutLegend();
        $c->packPlotArea(15, $title->getHeight(), $layoutLegendObj->getLeftX() - 10,
            $c->getHeight() - 15);

        # Output the chart
       $chartData = $c->makeChart2 ( PNG );
        $chartImagePath = WWW_ROOT . 'chart' . DS . 'multibar2.png';

        $f = fopen ( $chartImagePath, "wb" );

        fwrite ( $f, $chartData );

        fclose ( $f );
        
        $img = new Image_Toolbox ( $chartImagePath );
        $width = $img->_img ['main'] ['width'];
        $img->addImage ( $width, 10, '#ffffff' );
        $img->blendMask ( 'left', 'bottom', IMAGE_TOOLBOX_BLEND_COPY, 0, 520 );
        $img->output ();   
}
function gegainloose(){
        //Configure::write("debug",3);
        
         $tade_dates=mysql_fetch_array(mysql_query("SELECT * FROM market_summeries ORDER BY id desc LIMIT 1"));
         $current_date=$tade_dates['date'];
         $sqlStr="SELECT DISTINCT business_segment FROM symbols WHERE business_segment!='' ORDER BY business_segment ASC LIMIT 21";
         $sectors=$this->Symbol->query($sqlStr);
        // print_r($sectors);
         $sqlStr="SELECT business_segment,id,dse_code,yclose,last_final_trade_price,(lasttradeprice-yclose) as final_change,((lasttradeprice-yclose)/yclose)*100 as final_chang_per FROM symbols WHERE business_segment!=''  ORDER BY business_segment ASC    ";
         $dataSymbol=$this->Symbol->query($sqlStr);
         $dat_format=explode("-",$current_date);
         $dat_format=$dat_format[2].'-'.$dat_format[1].'-'.$dat_format[0];
          $sqlStr="SELECT symbol FROM outputs WHERE date LIKE '%$dat_format%' AND volume>0 AND symbol>1 ";
                $sqlQuery=mysql_query($sqlStr);
                while($data=mysql_fetch_assoc($sqlQuery)){
                    $dataOutput[]=$data['symbol'];//$data['symbol']
                }
                
         
         $dataArray=array();
         foreach($sectors as $sector){
         $sector_name=$sector['symbols']['business_segment'];
         $gainertotal=0;
         $losertotal=0;
         $unchangetotal=0;
             foreach($dataSymbol as $data){
            if($data['symbols']['business_segment']==$sector_name){
            if(in_array($data['symbols']["id"],$dataOutput)){
                if($data[0]['final_chang_per']>0)$gainertotal++;
                if($data[0]['final_chang_per']<0)$losertotal++;
                if($data[0]['final_chang_per']==0)$unchangetotal++;    
            }
            }
            $dataArray[$sector_name]["gainer"]=$gainertotal;
            $dataArray[$sector_name]["looser"]=$losertotal;
            $dataArray[$sector_name]["equal"]=$unchangetotal;
            }
         }
         
        App::import ( 'Vendor', 'Phpchartdir', array ('file' => 'phpchartdir.php')); 
        require_once (WWW_ROOT . DS . 'chart' . DS . 'Image_Toolbox.class.php');
        foreach($dataArray as $key=>$swdata){
         $labels[]=$key;
         $data0[]=$swdata["gainer"];
         $data1[]=$swdata["looser"];
         $data2[]=$swdata["equal"];
        }

        # Create a XYChart object of size 560 x 280 pixels.
        $c = new XYChart(760, 480);

        # Add a title to the chart using 14 pts Arial Bold Italic font
        $c->addTitle("Sectorwise Gainer Loser", "arialbi.ttf", 14);

        # Set the plotarea at (50, 50) and of 500 x 200 pixels in size. Use alternating light
        # grey (f8f8f8) / white (ffffff) background. Set border to transparent and use grey
        # (CCCCCC) dotted lines as horizontal and vertical grid lines
        $c->setPlotArea(50, 50, 700, 320, 0xffffff, 0xf8f8f8, Transparent, $c->dashLineColor(
            0xcccccc, DotLine), $c->dashLineColor(0xcccccc, DotLine));
        $c->xAxis->setLabelStyle("Arial", 8, TextColor, 90);
        # Add a legend box at (50, 22) using horizontal layout. Use 10 pt Arial Bold Italic
        # font, with transparent background
        $legendObj = $c->addLegend(50, 22, false, "arialbi.ttf", 10);
        $legendObj->setBackground(Transparent);
        $textBoxObj = $c->addText ( 400, 100, "www.stockbangladesh.org", "timesbi.ttf", 13, 0xc09090 );
        # Set the x axis labels
        $c->xAxis->setLabels($labels);

        # Draw the ticks between label positions (instead of at label positions)
        $c->xAxis->setTickOffset(0.5);

        # Add axis title
        $c->yAxis->setTitle("");

        # Set axis line width to 2 pixels
        $c->xAxis->setWidth(2);
        $c->yAxis->setWidth(2);

        # Add a multi-bar layer with 3 data sets
        $layer = $c->addBarLayer2(Side);
        $layer->addDataSet($data0, 0x00ff00, "Gainer");
        $layer->addDataSet($data1, 0xff0000, "Looser");
        $layer->addDataSet($data2, 0x0000ff, "No Change");

        # Set bar shape to circular (cylinder)
        $layer->setBarShape(CircleShape);

        # Configure the bars within a group to touch each others (no gap)
        $layer->setBarGap(0.4, TouchBar);

        # Output the chart
        $chartData = $c->makeChart2 ( PNG );
        $chartImagePath = WWW_ROOT . 'chart' . DS . 'gegainloose.png';

        $f = fopen ( $chartImagePath, "wb" );

        fwrite ( $f, $chartData );

        fclose ( $f );
        
        $img = new Image_Toolbox ( $chartImagePath );
        $width = $img->_img ['main'] ['width'];
        $img->addImage ( $width, 10, '#ffffff' );
        $img->blendMask ( 'left', 'bottom', IMAGE_TOOLBOX_BLEND_COPY, 0, 470 );
        $img->output ();  
        }
function pyramid(){
         $tade_dates=mysql_fetch_array(mysql_query("SELECT * FROM market_summeries ORDER BY id desc LIMIT 1"));
         $current_date=$tade_dates['date'];
         $sqlStr="SELECT date,issueadvance,issuedecline,issueunchange,issuetraded FROM market_summeries WHERE date LIKE '%$current_date%' LIMIT 1";
         $dataSort=mysql_fetch_assoc(mysql_query($sqlStr));
         
         $unchangetotal=$dataSort["issueunchange"];
         $losertotal=$dataSort["issuedecline"];
         $gainertotal=$dataSort["issueadvance"];
         
        App::import ( 'Vendor', 'Phpchartdir', array ('file' => 'phpchartdir.php'));
        require_once (WWW_ROOT . DS . 'chart' . DS . 'Image_Toolbox.class.php');
        $data=array($unchangetotal,$losertotal,$gainertotal); 
        # The labels for the pyramid chart
        $labels = array( "No Change","Loose", "Gain");

        # The colors for the pyramid layers
        $colors = array(0xeebb22, 0xff0000, 0x00ff00);

        # Create a PyramidChart object of size 500 x 400 pixels
        $c = new PyramidChart(500, 400);

        # Set the pyramid center at (200, 180), and width x height to 150 x 300 pixels
        $c->setPyramidSize(200, 180, 150, 300);

        # Set the elevation to 15 degrees
        $c->setViewAngle(15);

        # Set the pyramid data and labels
        $c->setData($data, $labels);

        # Set the layer colors to the given colors
        $c->setColors2(DataColor, $colors);

        # Leave 1% gaps between layers
        $c->setLayerGap(0.00);

        # Add labels at the center of the pyramid layers using Arial Bold font. The labels

        # will show the percentage of the layers.
        $c->setCenterLabel("", "arialbd.ttf");

        # Add labels at the right side of the pyramid layers using Arial Bold font. The
        # labels will have two lines showing the layer name and value.
        $c->setRightLabel("{label}\n No of Share {percent}% ({value})", "arialbd.ttf");

        # Output the chart
        $chartData = $c->makeChart2 ( PNG );
        $chartImagePath = WWW_ROOT . 'chart' . DS . 'pyramid.png';

        $f = fopen ( $chartImagePath, "wb" );

        fwrite ( $f, $chartData );

        fclose ( $f );
        
        $img = new Image_Toolbox ( $chartImagePath );
        $width = $img->_img ['main'] ['width'];
        $img->addImage ( $width, 10, '#e9ffe2' );
        $img->blendMask ( 'left', 'bottom', IMAGE_TOOLBOX_BLEND_COPY, 0, 350 );
        $img->output ();
}

function perarea(){
    $sqlStr="SELECT date FROM market_summeries ORDER BY id desc LIMIT 45";
    $sqlQuery=mysql_query($sqlStr);
    while($data=mysql_fetch_assoc($sqlQuery)){
    $tade_dates[]=$data['date'];
    }
    $tade_dates=array_reverse($tade_dates);
     foreach($tade_dates as $date){     
        $sqlStr="SELECT date,issueadvance,issuedecline,issueunchange,issuetraded FROM market_summeries WHERE date LIKE '%$date%' LIMIT 1";
        $dataArray[]=mysql_fetch_assoc(mysql_query($sqlStr));
        }
    foreach($dataArray as $data){
    /*$data0[]=$data["issueadvance"]/$data["issuetraded"]*100;
    $data1[]=$data["issuedecline"]/$data["issuetraded"]*100;
    $data2[]=$data["issueunchange"]/$data["issuetraded"]*100;*/
    $data0[]=$data["issueadvance"];
    $data1[]=$data["issuedecline"];
    $data2[]=$data["issueunchange"];
    $labels[]=$data["date"];
    }    
    
    //print_r($labels); 
        App::import ( 'Vendor', 'Phpchartdir', array ('file' => 'phpchartdir.php'));
        require_once (WWW_ROOT . DS . 'chart' . DS . 'Image_Toolbox.class.php');
        # Create a XYChart object of size 500 x 280 pixels, using 0xffffcc as background
        # color, with a black border, and 1 pixel 3D border effect
        $c = new XYChart(700, 380,  0xe9ffe1, 0, 1);

        #Set directory for loading images to current script directory
        #Need when running under Microsoft IIS
        $c->setSearchPath(dirname(__FILE__));

        # Set the plotarea at (50, 45) and of size 320 x 200 pixels with white background.
        # Enable horizontal and vertical grid lines using the grey (0xc0c0c0) color.
        $plotAreaObj = $c->setPlotArea(50, 45, 520, 250, 0xffffff);
        $plotAreaObj->setGridColor(0xc0c0c0, 0xc0c0c0);

        # Add a legend box at (370, 45) using vertical layout and 8 points Arial Bold font.
        $legendBox = $c->addLegend(600, 45, true, "arialbd.ttf", 8);
        $textBoxObj = $c->addText ( 500, 20, "www.stockbangladesh.org", "timesbi.ttf", 13, 0xc09090 );
        # Set the legend box background and border to transparent
        $legendBox->setBackground(Transparent, Transparent);

        # Set the legend box icon size to 16 x 32 pixels to match with custom icon size
        $legendBox->setKeySize(16, 32);

        # Add a title to the chart using 14 points Times Bold Itatic font and white font
        # color, and 0x804020 as the background color
        $textBoxObj = $c->addTitle("Gainer Loser Trend", "timesbi.ttf", 14, 0xffffff);
        $textBoxObj->setBackground(0x004000);

        # Set the labels on the x axis.
        $c->xAxis->setLabels($labels);

        # Set multi-style axis label formatting. Start of year labels are displayed as yyyy.
        # For other labels, just show minor tick.
        //$c->xAxis->setMultiFormat(StartOfYearFilter(), "{value}", AllPassFilter(), "-");
        $c->xAxis->setLabelStyle("Arial", 8, TextColor, 90);
        # Add a percentage area layer to the chart
        $layer = $c->addAreaLayer2(Percentage);
        $c->yAxis2->setLinearScale(100, 0, -10);
        $c->yAxis2->setLabelFormat("{value}%");

        # Add the three data sets to the area layer, using icons images with labels as data
        # set names
        $layer->addDataSet($data0, 0x4804040,"Advance");

        $layer->addDataSet($data2, 0x4ffffff,"Unchange");
        $layer->addDataSet($data1, 0x40ddaa77,"Decline");
        # For a vertical stacked chart with positive data only, the last data set is always
        # on top. However, in a vertical legend box, the last data set is at the bottom. This
        # can be reversed by using the setLegend method.
        $layer->setLegend(ReverseLegend);

        # Output the chart
        $chartData = $c->makeChart2 ( PNG );
        $chartImagePath = WWW_ROOT . 'chart' . DS . 'perarea.png';

        $f = fopen ( $chartImagePath, "wb" );

        fwrite ( $f, $chartData );

        fclose ( $f );
        
        $img = new Image_Toolbox ( $chartImagePath );
        $width = $img->_img ['main'] ['width'];
        $img->addImage ( $width, 10, '#e9ffe2' );
        $img->blendMask ( 'left', 'bottom', IMAGE_TOOLBOX_BLEND_COPY, 0, 370 );
        $img->output ();
}
function dsechartcompare($chartType = 'dsi')
    {   
        //ob_start();
        require_once(WWW_ROOT . DS . 'chart'. DS .'phpchartdir.php');
        require_once(WWW_ROOT . DS . 'chart'. DS .'Image_Toolbox.class.php');
        
        
        $getLastIndex = $this->Symbol->query("select value from configuration WHERE `configuration`.`name` like 'index_last_id'");        
        $getLastIndex =$getLastIndex[0]['configuration']['value'];
        
        $sqlStr="SELECT date FROM market_summeries ORDER BY id DESC LIMIT 2 ";
        $market_summeries=$this->MarketSummery->query($sqlStr);
        $last_trade_date=$market_summeries[1]["market_summeries"]["date"];
        //print_r($market_summeries);
        
        $dataArray=array();
        $sqlStr="select * from `index` where IDX_INDEX_ID like '%$chartType%' AND IDX_DATE_TIME LIKE '%".$last_trade_date."%' ORDER BY id";
        $sqlQuery=mysql_query($sqlStr);
        while($data=mysql_fetch_assoc($sqlQuery)){
            $dataArray[]=$data;
        }
        
        //print_r($dataArray);
        //exit;
                     
        $querySQL  = ' SELECT id, IDX_DATE_TIME, IDX_CAPITAL_VALUE, IDX_GROSS_VALUE, IDX_INDEX_ID, IDX_DEVIATION FROM `index` WHERE `id` > \''.$getLastIndex.'\' ';
        $graphData = $this->Symbol->query($querySQL);
        
        $dArr    = array();
        
        $dsiArr    = array();
        $dsiLabel  = array();
        $ds20Arr   = array();
        $ds20Label = array();
        $dgenArr   = array();
        $dgenLabel = array();
        
        foreach ($graphData as $data)
        {
            $datetime   = $data['index']['IDX_DATE_TIME'];
            $datetime   = strtotime($datetime);
            $grossValue = $data['index']['IDX_CAPITAL_VALUE'];
            $indexId    = trim($data['index']['IDX_INDEX_ID']);
                        
            if($data['index']['IDX_DEVIATION'])
            {
               if($indexId=='DSI')
                {
                    $dsiArr[]    = $grossValue;
                    $ctime       = date('H:i',$datetime) ;
                    $dsiLabel[]  = $ctime;
                }
                if($indexId=='DS20')
                {
                    $ds20Arr[]   = $grossValue;
                    $ctime       = date('H:i',$datetime) ;
                    $ds20Label[] =$ctime;
                }
                if($indexId=='DGEN')
                {
                    $dgenArr[]   = $grossValue;
                    $ctime       = date('H:i',$datetime) ;
                    $dgenLabel[] = $ctime;
                }
            }
        }
        
        
        $dsiArr1    = array();
        $dsiLabel1  = array();
         $labels=array();
        
        foreach($dataArray as $data){
            $datetime   = $data['IDX_DATE_TIME'];
            $datetime   = strtotime($datetime);
            $grossValue = $data['IDX_CAPITAL_VALUE'];
            $indexId    = trim($data['IDX_INDEX_ID']);
            $dsiArr1[]    = $grossValue;
            $ctime       = date('H:i',$datetime) ;
            
            $dsiLabel1[]  = $ctime;
        }
                
        $labels = $dsiLabel1;

        $setTitle = '';
        $setColour = '0x80ff0000';
        $setImage = '';
        
        if(!empty($graphData) && $chartType !='' ){
            switch(strtolower($chartType)){
                case 'dsi':  
                           $dArr = $dsiArr;             
                           $setTitle  = 'DSI';
                           $setImage  = 'dsi.png';
                           $setColour = 0x80ff0000;
                           break; 
                case 'ds20':       
                           $dArr = $ds20Arr;                    
                           $setTitle  = 'DS20';
                           $setImage  = 'dse20.png';
                           $setColour = 0x808080ff;
                           break; 
                case 'dgen':
                           $dArr = $dgenArr;
                           $setTitle  = 'Dse General';
                           $setImage  = 'dgen.png';
                           $setColour = 0x8000ff00;
                           break;                       
            }
        }
        //print_r($dArr);
        # Create a XYChart object of size 350 x 230 pixels
        $c = new XYChart(450, 330);
        
        # Set the plotarea at (50, 30) and of size 250 x 150 pixels.
        $c->setPlotArea(50, 30, 350, 200);        
        # Add a legend box at (55, 0) (top of the chart) using 8 pts Arial Font. Set
        # background and border to Transparent.
        $legendObj = $c->addLegend(55, 0, false, "", 8);
        $legendObj->setBackground(Transparent);
        
        $textBoxObj = $c->addText ( 100, 30, "www.stockbangladesh.org", "timesbi.ttf", 9, 0xc09090 );
        $textBoxObj->setAlignment ( TopLeft );

        # Add a title to the x axis
        $c->xAxis->setTitle("Index Comparison");
        
        # Add a title to the y axis
        $c->yAxis->setTitle("Index Compare");
        
        $c->xAxis->setLabelStyle ( "Arial", 8, TextColor, 90 );
        # Set the labels on the x axis.
        $c->xAxis->setLabels($labels);
        
        # Display 1 out of 2 labels on the x-axis. Show minor ticks for remaining labels.
        $c->xAxis->setLabelStep(2, 1);
        
        # Add three area layers, each representing one data set. The areas are drawn in
        # semi-transparent colors.
        $c->addAreaLayer($dArr, 0x8000ff00, date("Y-m-d",strtotime($graphData[0]["index"]["IDX_DATE_TIME"])).'('.$dArr[count($dArr)-1].')', 2);
        $c->addAreaLayer($dsiArr1, 0x808080ff, $last_trade_date.'('.$dsiArr1[count($dsiArr1)-1].')', 3);

        # Output the chart
        $chartData = $c->makeChart2 ( PNG );
        $chartImagePath = WWW_ROOT . 'chart' . DS . 'dsechartcompare.png';

        $f = fopen ( $chartImagePath, "wb" );

        fwrite ( $f, $chartData );

        fclose ( $f );
        
        $img = new Image_Toolbox ( $chartImagePath );
        $width = $img->_img ['main'] ['width'];
        $img->addImage ( $width, 10, '#ffffff' );
        $img->blendMask ( 'left', 'bottom', IMAGE_TOOLBOX_BLEND_COPY, 0, 320 );
        $img->output ();
    } 
function volcompare($type=NULL){

        require_once(WWW_ROOT . DS . 'chart'. DS .'phpchartdir.php');
        require_once(WWW_ROOT . DS . 'chart'. DS .'Image_Toolbox.class.php');
        $getLastIndex = $this->Symbol->query("select value from configuration WHERE `configuration`.`name` like 'data_bank_intraday_lid'");        
        $getLastIndex =$getLastIndex[0]['configuration']['value'];
        
        $sqlStr="SELECT volume,lastprice,currenttime FROM data_banks_intraday WHERE symbol_id=1 AND id>$getLastIndex ORDER BY id";
        $dataArray=$this->Symbol->query($sqlStr);
        $diff=0;
        $count=0;
        foreach($dataArray as $data){
        if($count<50){
            $graphData['index'][]=$data["data_banks_intraday"]["lastprice"];
            $graphData['volume'][]=$data["data_banks_intraday"]["volume"]/1000000-$diff;
            $graphData['label'][]=date("H:i",$data["data_banks_intraday"]["currenttime"]);
            $diff=$data["data_banks_intraday"]["volume"]/1000000;
            $count++;
        }
        }
        for($i=0;$i<count($graphData['volume']);$i++){
            $avgVol[]=number_format(array_sum($graphData["volume"])/(count($graphData["volume"])),2);                      
        }
        $avg=$avgVol[0];

        # Create a XYChart object of size 300 x 300 pixels
        $c = new XYChart(400, 350);
        
        # Set the plotarea at (45, 30) and of size 200 x 200 pixels
        $c->setPlotArea(45, 40, 320, 220);
        # Add a title to the chart using 12 pts Arial Bold Italic font
        $c->addTitle("Index Vs. Trade Volume ".number_format($diff,2)."(mn)\nAverage : $avg(mn) /5 min", "arialbi.ttf", 10);        
//$c->addTitle("Index Vs. Trade Volume ".number_format($tempdata,2).'(mn)', "arialbi.ttf", 12);
        
        # Add a title to the y axis
        $c->yAxis->setTitle("");
        
        # Add a title to the x axis
        $c->xAxis->setTitle($tradedate);
        $c->xAxis->setLabelStyle ( "Arial", 8, TextColor, 90 );

        $textBoxObj = $c->addText ( 50, 40, "www.stockbangladesh.org", "timesbi.ttf", 9, 0xc09090 );
        $textBoxObj->setAlignment ( TopLeft );

        $trendLayerObj = $c->addTrendLayer($avgVol, 0x008000, "Trend Line"); //trend chart
        $trendLayerObj->setLineWidth(2);
        $trendLayerObj->setUseYAxis2 ();

        $c->addLineLayer($dgenArr,0xff0000);
            
        $c->addLineLayer($graphData['index'],0xff0000);
        //$c->addBarLayer($dgenArr1,0x00ff00);
        
        $barLayerObj = $c->addBarLayer3 ($graphData['volume']);
        $barLayerObj->setBarShape (CircleShape );
        $barLayerObj->setUseYAxis2 ();
        # Add a green (0x00ff00) 3D area chart layer using the give data
        
        # Set the labels on the x axis.
        $c->xAxis->setLabels($graphData['label']);
        
        # Display 1 out of 3 labels on the x-axis.
        /*if(count($dgenLabel)>12)$c->xAxis->setLabelStep(2);
        else */
        if($count<30)
        $c->xAxis->setLabelStep(1);
        else $c->xAxis->setLabelStep(2);
        # Output the chart
        
        $chartData = $c->makeChart2 ( PNG );
        $chartImagePath = WWW_ROOT . 'chart' . DS . 'volcompare.png';

        $f = fopen ( $chartImagePath, "wb" );
        fwrite ( $f, $chartData );
        fclose ( $f );
        
        $img = new Image_Toolbox ( $chartImagePath );
        $width = $img->_img ['main'] ['width'];
        $img->addImage ( $width, 10, '#ffffff' );
        $img->blendMask ( 'left', 'bottom', IMAGE_TOOLBOX_BLEND_COPY, 0, 340 );
        $img->output ();
        
        
} 

    function sectorweekcompare($updateRequest = '') {
        if (! $this->Session->check ( 'Auth.User' )) {
            $this->Session->setFlash ( 'You are not authorized to access that location.' );
            $this->redirect ( array ('controller' => 'users', 'action' => 'login' ) );
        }
        $this->layout = 'default-three';

        $this->pageTitle = 'Stock Bangladesh :: Weekly Sector Comparison';
        
        
        $sql = "SELECT id,business_segment,dse_code FROM symbols";

        $symbolinfo = $this->Symbol->query ( $sql );


        $sortedSymbolArr = array ();
        $sortedCodeArr = array ();

        foreach ( $symbolinfo as $row ) {

            $symbol = $row ['symbols'] ['id'];
            $code = trim($row ['symbols'] ['dse_code']);

            $sector = $row ['symbols'] ['business_segment'];

            $sortedSymbolArr [$symbol] = trim ( $sector );
            $sortedCodeArr[$code]=$symbol;

        }
        
        
        $sql = "SELECT * FROM market_summeries ORDER BY id DESC LIMIT 0, 7";

        $marketArr = $this->Symbol->query ( $sql );
        
        $title = array();
        $date = explode('-',$marketArr [0] ['market_summeries'] ['date']);
        $date = $date[2].'-'.$date[1].'-'.$date[0];
        $title ['date_11'] = $date;
        
        $date = explode('-',$marketArr [1] ['market_summeries'] ['date']);
        $date = $date[2].'-'.$date[1].'-'.$date[0];
        $title ['date_12'] = $date;
        
        $title ['date_d1'] = "Change1";
        $title ['date_11c'] = 'Contribution% ('.$title ['date_11'].')';
        $title ['date_12c'] = 'Contribution% ('.$title ['date_12'].')';
        $title ['date_c1'] = 'Difference1';
        
        
        $title ['date_21'] = $title ['date_12'];
        $date = explode('-',$marketArr [2] ['market_summeries'] ['date']);
        $date = $date[2].'-'.$date[1].'-'.$date[0];        
        $title ['date_22'] = $date;
        
        $title ['date_d2'] = "Change2";
        $title ['date_21c'] = 'Contribution% ('.$title ['date_21'].')';
        $title ['date_22c'] = 'Contribution% ('.$title ['date_22'].')';
        $title ['date_c2'] = 'Difference2';
        
        $title ['date_31'] = $title ['date_22'];
        $date = explode('-',$marketArr [3] ['market_summeries'] ['date']);
        $date = $date[2].'-'.$date[1].'-'.$date[0];
        $title ['date_32'] = $date;
        
        $title ['date_d3'] = "Change3";
        $title ['date_31c'] = 'Contribution% ('.$title ['date_31'].')';
        $title ['date_32c'] = 'Contribution% ('.$title ['date_32'].')';
        $title ['date_c3'] = 'Difference3';
        
        $title ['date_41'] = $title ['date_32'];
        $date = explode('-',$marketArr [4] ['market_summeries'] ['date']);
        $date = $date[2].'-'.$date[1].'-'.$date[0];
        $title ['date_42'] = $date;
        
        $title ['date_d4'] = "Change4";
        $title ['date_41c'] = 'Contribution% ('.$title ['date_41'].')';
        $title ['date_42c'] = 'Contribution% ('.$title ['date_42'].')';
        $title ['date_c4'] = 'Difference4';
        
        $title ['date_51'] = $title ['date_42'];
        $date = explode('-',$marketArr [5] ['market_summeries'] ['date']);
        $date = $date[2].'-'.$date[1].'-'.$date[0];
        $title ['date_52'] = $date;
        
        $title ['date_d5'] = "Change5";
        $title ['date_51c'] = 'Contribution% ('.$title ['date_51'].')';
        $title ['date_52c'] = 'Contribution% ('.$title ['date_52'].')';
        $title ['date_c5'] = 'Difference5';
        
        $title ['date_61'] = $title ['date_52'];
        $date = explode('-',$marketArr [6] ['market_summeries'] ['date']);
        $date = $date[2].'-'.$date[1].'-'.$date[0];
        $title ['date_62'] = $date;
        
        $title ['date_d6'] = "Change6";
        $title ['date_61c'] = 'Contribution% ('.$title ['date_61'].')';
        $title ['date_62c'] = 'Contribution% ('.$title ['date_62'].')';
        $title ['date_c6'] = 'Difference6';
        
        //pr($marketArr);
        //pr($title);die;
        //$this->set ( 'title', $title);        
        
        $lastdate = $marketArr [0] ['market_summeries'] ['date'];

        $lastdaystamp = strtotime ( $lastdate )- (12*60*60);
        

        $onedaybefore = $marketArr [6] ['market_summeries'] ['date'];

        $onedaybeforestamp = strtotime ( $onedaybefore )-(12*60*60);



        $sql = "SELECT * FROM outputs USE INDEX (symbol) where daystamp>=$onedaybeforestamp and symbol>1 ORDER BY id DESC";

        $resultArr = $this->Symbol->query ( $sql );
        
        

        $sortedArr = array ();

        foreach ( $resultArr as $row ) {

            $day = $row ['outputs'] ['date'];

            $symbol = $row ['outputs'] ['symbol'];

            $tradevalue = $row ['outputs'] ['tradevalues'];

            //$day = strtotime ( $day );

            $sector = $sortedSymbolArr [$symbol];

            $sortedArr [$day] [$sector] [$symbol] = $tradevalue;

        }

        
        $sectorCapArr = array ();



        foreach ( $sortedArr as $day => $arr ) {

            $marketCap = 0;

            foreach ( $arr as $sector => $datarr ) {

                $sectorTotal = 0;

                foreach ( $datarr as $symbol => $tradevalue ) {

                    $sectorTotal += $tradevalue;

                    $marketCap += $tradevalue;

                }

                $sectorCapArr [$sector] [$day] = $sectorTotal;

            }



            //echo "$marketCap <br />";
        }
        ksort($sectorCapArr);
        
         $total_0 = 0 ;
        $total_1 = 0 ;
        $total_2 = 0 ;
        $total_3 = 0 ;
        $total_4 = 0 ;
        $total_5 = 0 ;
        $total_6 = 0 ;        
       
        $total = array();
        
        foreach($sectorCapArr as $sector=>$row)
        {   
            $date1 = explode('-',$marketArr[0]['market_summeries']['date']);            
            $date_1 = ltrim(rtrim($date1[2])).'-'.ltrim(rtrim($date1[1])).'-'.ltrim(rtrim($date1[0]));            
            $total_0 += $row[$date_1];
            //echo '<br>';
            $date1 = explode('-',$marketArr[1]['market_summeries']['date']);            
            $date_1 = ltrim(rtrim($date1[2])).'-'.ltrim(rtrim($date1[1])).'-'.ltrim(rtrim($date1[0]));            
            $total_1 += $row[$date_1];
            //echo '<br>';
            $date1 = explode('-',$marketArr[2]['market_summeries']['date']);            
            $date_1 = ltrim(rtrim($date1[2])).'-'.ltrim(rtrim($date1[1])).'-'.ltrim(rtrim($date1[0]));            
            $total_2 += $row[$date_1];
            //echo '<br>';
            $date1 = explode('-',$marketArr[3]['market_summeries']['date']);            
            $date_1 = ltrim(rtrim($date1[2])).'-'.ltrim(rtrim($date1[1])).'-'.ltrim(rtrim($date1[0]));            
            $total_3 += $row[$date_1];
            //echo '<br>';
            $date1 = explode('-',$marketArr[4]['market_summeries']['date']);            
            $date_1 = ltrim(rtrim($date1[2])).'-'.ltrim(rtrim($date1[1])).'-'.ltrim(rtrim($date1[0]));            
            $total_4 += $row[$date_1];
            //echo '<br>';
            $date1 = explode('-',$marketArr[5]['market_summeries']['date']);            
            $date_1 = ltrim(rtrim($date1[2])).'-'.ltrim(rtrim($date1[1])).'-'.ltrim(rtrim($date1[0]));            
            $total_5 += $row[$date_1];
            //echo '<br>';
            $date1 = explode('-',$marketArr[6]['market_summeries']['date']);            
            $date_1 = ltrim(rtrim($date1[2])).'-'.ltrim(rtrim($date1[1])).'-'.ltrim(rtrim($date1[0]));            
            $total_6 += $row[$date_1];            
        }   
        
        
        $data = array();
        $allData = array();
        //pr($title);
        foreach ( $sectorCapArr as $sector => $arr ) 
        {
            $data['sector'] = $sector;
            foreach ( $arr as $day => $value ) 
            {
                //echo $day.' <--> '.$value.'+++';
                if($title ['date_11'] == $day){
                    $data[$title ['date_11'].'1'] = $value;
                }
                else if($title ['date_12'] == $day){
                    $data[$title ['date_12'].'2'] = $value;
                    $data['Change13'] = number_format($data[$title ['date_11'].'1'] - $data[$title ['date_12'].'2'],2,'.','');
                    
                    $data[$title ['date_11c'].'4'] = ($data[$title ['date_11'].'1']*100)/ $total_0;
                    $data[$title ['date_12c'].'5'] = ($data[$title ['date_12'].'2']*100)/ $total_1;
                    $data[$title ['date_c1'].'6'] = number_format(($data[$title ['date_11c'].'4'] - $data[$title ['date_12c'].'5']),2,'.','');
                    
                    $data[$title['date_21'].'7'] = $value;                    
                }
                else if($title ['date_22'] == $day){
                    $data[$title ['date_22'].'8'] = $value;
                    $data['Change29'] = number_format($data[$title ['date_21'].'7'] - $data[$title ['date_22'].'8'],2,'.','');
                    $data[$title ['date_21c'].'10'] = $data[$title ['date_12c'].'5'];
                    $data[$title ['date_22c'].'11'] = ($data[$title ['date_22'].'8']*100)/ $total_2;
                    $data[$title ['date_c2'].'12'] = number_format($data[$title ['date_21c'].'10'] - $data[$title ['date_22c'].'11'],2,'.','');
                    $data[$title ['date_31'].'13'] = $value;
                }
                else if($title ['date_32'] == $day){
                    $data[$title ['date_32'].'14'] = $value;
                    $data['Change315'] = number_format($data[$title ['date_31'].'13'] - $data[$title ['date_32'].'14'],2,'.','');
                    
                    $data[$title ['date_31c'].'16'] = $data[$title ['date_22c'].'11'];
                    $data[$title ['date_32c'].'17'] = ($data[$title ['date_32'].'14']*100)/ $total_3;
                    $data[$title ['date_c3'].'18'] = number_format($data[$title ['date_31c'].'16'] - $data[$title ['date_32c'].'17'],2,'.','');
                    
                    $data[$title ['date_41'].'19'] = $value;
                }
                else if($title ['date_42'] == $day){
                    $data[$title ['date_42'].'20'] = $value;
                    $data['Change421'] = number_format($data[$title ['date_41'].'19'] - $data[$title ['date_42'].'20'],2,'.','');
                    
                    $data[$title ['date_41c'].'22'] = $data[$title ['date_32c'].'17'];
                    $data[$title ['date_42c'].'23'] = ($data[$title ['date_42'].'20']*100)/ $total_4;
                    $data[$title ['date_c4'].'24'] = number_format($data[$title ['date_41c'].'22'] - $data[$title ['date_42c'].'23'],2,'.','');
                    
                    $data[$title ['date_51'].'25'] = $value;
                }
                else if($title ['date_52'] == $day){
                    $data[$title ['date_52'].'26'] = $value;
                    $data['Change527'] = number_format($data[$title ['date_51'].'25'] - $data[$title ['date_52'].'26'],2,'.','');
                    
                    $data[$title ['date_51c'].'28'] = $data[$title ['date_42c'].'23'];
                    $data[$title ['date_52c'].'29'] = ($data[$title ['date_52'].'26']*100)/ $total_5;
                    $data[$title ['date_c5'].'30'] = number_format($data[$title ['date_51c'].'28'] - $data[$title ['date_52c'].'29'],2,'.','');
                    
                    $data[$title ['date_61'].'31'] = $value;
                }
                else if($title ['date_62'] == $day){
                    $data[$title ['date_62'].'32'] = $value;
                    $data['Change633'] = number_format($data[$title ['date_61'].'31'] - $data[$title ['date_62'].'32'],2,'.','');
                    
                    $data[$title ['date_61c'].'34'] = $data[$title ['date_52c'].'29'];
                    $data[$title ['date_62c'].'35'] = ($data[$title ['date_62'].'32']*100)/ $total_6;
                    $data[$title ['date_c6'].'36'] = number_format(($data[$title ['date_61c'].'34'] - $data[$title ['date_62c'].'35']),2,'.','');
                    
                }
                else
                    $data[$day] = 0;
                
                //pr($data);
            }
            //echo '<br>';
            $allData[] = $data;

        }
       
        
        //die;
        
        $mappingName = array();
        
        foreach($allData as $value)
        {
            foreach($value as $indexName => $ivalue)
            {
                $mappingName [$indexName] = $indexName;
            }
            break;
        }

        //echo "<pre>";
        //print_r ($title);
        //print_r ($mappingName);
        //print_r ( $sectorCapArr);
        //print_r ($allData);
        //print_r ( $marketArr);
        //print_r ( $title);  
        //die;
        
        
       
        $total[] = $total_0;
        $total[] = $total_1;
        $total[] = $total_2;
        $total[] = $total_3;
        $total[] = $total_4;
        $total[] = $total_5;
        $total[] = $total_6;
        
        $data = array();
        $data['sector'] = "Z_Total";
        $data[$title ['date_11'].'1'] = $total_0;
        $data[$title ['date_12'].'2'] = $total_1;
        $data[$title ['date_d1'].'3'] = $total_0 - $total_1;
        
        $data[$title ['date_21'].'4'] = $total_1;
        $data[$title ['date_22'].'5'] = $total_2;
        $data[$title ['date_d2'].'6'] = $total_1 - $total_2;
        
        $data[$title ['date_31'].'7'] = $total_2;
        $data[$title ['date_32'].'8'] = $total_3;
        $data[$title ['date_d3'].'9'] = $total_2 - $total_3;
        
        $data[$title ['date_41'].'10'] = $total_3;
        $data[$title ['date_42'].'11'] = $total_4;
        $data[$title ['date_d4'].'12'] = $total_3 - $total_4;
        
        $data[$title ['date_51'].'13'] = $total_4;
        $data[$title ['date_52'].'14'] = $total_5;
        $data[$title ['date_d5'].'15'] = $total_4 - $total_5;
        
        $data[$title ['date_61'].'16'] = $total_5;
        $data[$title ['date_62'].'17'] = $total_6;
        $data[$title ['date_d6'].'18'] = $total_5 - $total_6;
        //$data[] = null;
        $allData[] = $data;
        
    
        //echo '<pre>';
        //pr($title);
        //pr($allData);die;
        
        
        //$this->set ( 'sectorCapArr', $sectorCapArr);
        //$this->set ( 'total', $total);
        $this->set ( 'title_a', $title);
        $this->set ( 'mappingName', $mappingName);
        //$this->set ( 'marketArr', $marketArr );
        //$this->set ( 'lastdateTotal', $lastdateTotal );
        //$this->set ( 'onedaybeforeTotal', $onedaybeforeTotal );*/

    }
    
    function getsectorweekcompare() {

        $sql = "SELECT id,business_segment,dse_code FROM symbols";

        $symbolinfo = $this->Symbol->query ( $sql );


        $sortedSymbolArr = array ();
        $sortedCodeArr = array ();

        foreach ( $symbolinfo as $row ) {

            $symbol = $row ['symbols'] ['id'];
            $code = trim($row ['symbols'] ['dse_code']);

            $sector = $row ['symbols'] ['business_segment'];

            $sortedSymbolArr [$symbol] = trim ( $sector );
            $sortedCodeArr[$code]=$symbol;

        }
        
        
        $sql = "SELECT * FROM market_summeries ORDER BY id DESC LIMIT 0, 7";

        $marketArr = $this->Symbol->query ( $sql );
        
        $title = array();
        $date = explode('-',$marketArr [0] ['market_summeries'] ['date']);
        $date = $date[2].'-'.$date[1].'-'.$date[0];
        $title ['date_11'] = $date;
        
        $date = explode('-',$marketArr [1] ['market_summeries'] ['date']);
        $date = $date[2].'-'.$date[1].'-'.$date[0];
        $title ['date_12'] = $date;
        
        $title ['date_d1'] = "Change1";
        $title ['date_11c'] = 'Contribution% ('.$title ['date_11'].')';
        $title ['date_12c'] = 'Contribution% ('.$title ['date_12'].')';
        $title ['date_c1'] = 'Difference1';
        
        
        $title ['date_21'] = $title ['date_12'];
        $date = explode('-',$marketArr [2] ['market_summeries'] ['date']);
        $date = $date[2].'-'.$date[1].'-'.$date[0];        
        $title ['date_22'] = $date;
        
        $title ['date_d2'] = "Change2";
        $title ['date_21c'] = 'Contribution% ('.$title ['date_21'].')';
        $title ['date_22c'] = 'Contribution% ('.$title ['date_22'].')';
        $title ['date_c2'] = 'Difference2';
        
        $title ['date_31'] = $title ['date_22'];
        $date = explode('-',$marketArr [3] ['market_summeries'] ['date']);
        $date = $date[2].'-'.$date[1].'-'.$date[0];
        $title ['date_32'] = $date;
        
        $title ['date_d3'] = "Change3";
        $title ['date_31c'] = 'Contribution% ('.$title ['date_31'].')';
        $title ['date_32c'] = 'Contribution% ('.$title ['date_32'].')';
        $title ['date_c3'] = 'Difference3';
        
        $title ['date_41'] = $title ['date_32'];
        $date = explode('-',$marketArr [4] ['market_summeries'] ['date']);
        $date = $date[2].'-'.$date[1].'-'.$date[0];
        $title ['date_42'] = $date;
        
        $title ['date_d4'] = "Change4";
        $title ['date_41c'] = 'Contribution% ('.$title ['date_41'].')';
        $title ['date_42c'] = 'Contribution% ('.$title ['date_42'].')';
        $title ['date_c4'] = 'Difference4';
        
        $title ['date_51'] = $title ['date_42'];
        $date = explode('-',$marketArr [5] ['market_summeries'] ['date']);
        $date = $date[2].'-'.$date[1].'-'.$date[0];
        $title ['date_52'] = $date;
        
        $title ['date_d5'] = "Change5";
        $title ['date_51c'] = 'Contribution% ('.$title ['date_51'].')';
        $title ['date_52c'] = 'Contribution% ('.$title ['date_52'].')';
        $title ['date_c5'] = 'Difference5';
        
        $title ['date_61'] = $title ['date_52'];
        $date = explode('-',$marketArr [6] ['market_summeries'] ['date']);
        $date = $date[2].'-'.$date[1].'-'.$date[0];
        $title ['date_62'] = $date;
        
        $title ['date_d6'] = "Change6";
        $title ['date_61c'] = 'Contribution% ('.$title ['date_61'].')';
        $title ['date_62c'] = 'Contribution% ('.$title ['date_62'].')';
        $title ['date_c6'] = 'Difference6';
        
        //pr($marketArr);
        //pr($title);die;
        //$this->set ( 'title', $title);        
        
        $lastdate = $marketArr [0] ['market_summeries'] ['date'];

        $lastdaystamp = strtotime ( $lastdate )- (12*60*60);
        

        $onedaybefore = $marketArr [6] ['market_summeries'] ['date'];

        $onedaybeforestamp = strtotime ( $onedaybefore )-(12*60*60);



        $sql = "SELECT * FROM outputs USE INDEX (symbol) where daystamp>=$onedaybeforestamp and symbol>1 ORDER BY id DESC";

        $resultArr = $this->Symbol->query ( $sql );
        
        

        $sortedArr = array ();

        foreach ( $resultArr as $row ) {

            $day = $row ['outputs'] ['date'];

            $symbol = $row ['outputs'] ['symbol'];

            $tradevalue = $row ['outputs'] ['tradevalues'];

            //$day = strtotime ( $day );

            $sector = $sortedSymbolArr [$symbol];

            $sortedArr [$day] [$sector] [$symbol] = $tradevalue;

        }

        
        $sectorCapArr = array ();



        foreach ( $sortedArr as $day => $arr ) {

            $marketCap = 0;

            foreach ( $arr as $sector => $datarr ) {

                $sectorTotal = 0;

                foreach ( $datarr as $symbol => $tradevalue ) {

                    $sectorTotal += $tradevalue;

                    $marketCap += $tradevalue;

                }

                $sectorCapArr [$sector] [$day] = $sectorTotal;

            }



            //echo "$marketCap <br />";
        }
        ksort($sectorCapArr);
        
        
        $total_0 = 0 ;
        $total_1 = 0 ;
        $total_2 = 0 ;
        $total_3 = 0 ;
        $total_4 = 0 ;
        $total_5 = 0 ;
        $total_6 = 0 ;
      
        $total = array();
        
        foreach($sectorCapArr as $sector=>$row)
        {   
            $date1 = explode('-',$marketArr[0]['market_summeries']['date']);            
            $date_1 = ltrim(rtrim($date1[2])).'-'.ltrim(rtrim($date1[1])).'-'.ltrim(rtrim($date1[0]));            
            $total_0 += $row[$date_1];
            //echo '<br>';
            $date1 = explode('-',$marketArr[1]['market_summeries']['date']);            
            $date_1 = ltrim(rtrim($date1[2])).'-'.ltrim(rtrim($date1[1])).'-'.ltrim(rtrim($date1[0]));            
            $total_1 += $row[$date_1];
            //echo '<br>';
            $date1 = explode('-',$marketArr[2]['market_summeries']['date']);            
            $date_1 = ltrim(rtrim($date1[2])).'-'.ltrim(rtrim($date1[1])).'-'.ltrim(rtrim($date1[0]));            
            $total_2 += $row[$date_1];
            //echo '<br>';
            $date1 = explode('-',$marketArr[3]['market_summeries']['date']);            
            $date_1 = ltrim(rtrim($date1[2])).'-'.ltrim(rtrim($date1[1])).'-'.ltrim(rtrim($date1[0]));            
            $total_3 += $row[$date_1];
            //echo '<br>';
            $date1 = explode('-',$marketArr[4]['market_summeries']['date']);            
            $date_1 = ltrim(rtrim($date1[2])).'-'.ltrim(rtrim($date1[1])).'-'.ltrim(rtrim($date1[0]));            
            $total_4 += $row[$date_1];
            //echo '<br>';
            $date1 = explode('-',$marketArr[5]['market_summeries']['date']);            
            $date_1 = ltrim(rtrim($date1[2])).'-'.ltrim(rtrim($date1[1])).'-'.ltrim(rtrim($date1[0]));            
            $total_5 += $row[$date_1];
            //echo '<br>';
            $date1 = explode('-',$marketArr[6]['market_summeries']['date']);            
            $date_1 = ltrim(rtrim($date1[2])).'-'.ltrim(rtrim($date1[1])).'-'.ltrim(rtrim($date1[0]));            
            $total_6 += $row[$date_1];
        }
        
        
        
        $data = array();
        $allData = array();
        
       foreach ( $sectorCapArr as $sector => $arr ) 
        {
            $data['sector'] = $sector;
            foreach ( $arr as $day => $value ) 
            {
                //echo $day.' <--> '.$value.'+++';
                if($title ['date_11'] == $day){
                    $data[$title ['date_11'].'1'] = $value;
                }
                else if($title ['date_12'] == $day){
                    $data[$title ['date_12'].'2'] = $value;
                    $data['Change13'] = number_format($data[$title ['date_11'].'1'] - $data[$title ['date_12'].'2'],2,'.','');
                    
                    $data[$title ['date_11c'].'4'] = ($data[$title ['date_11'].'1']*100)/ $total_0;
                    $data[$title ['date_12c'].'5'] = ($data[$title ['date_12'].'2']*100)/ $total_1;
                    $data[$title ['date_c1'].'6'] = number_format(($data[$title ['date_11c'].'4'] - $data[$title ['date_12c'].'5']),2,'.','');
                    
                    $data[$title['date_21'].'7'] = $value;                    
                }
                else if($title ['date_22'] == $day){
                    $data[$title ['date_22'].'8'] = $value;
                    $data['Change29'] = number_format($data[$title ['date_21'].'7'] - $data[$title ['date_22'].'8'],2,'.','');
                    $data[$title ['date_21c'].'10'] = $data[$title ['date_12c'].'5'];
                    $data[$title ['date_22c'].'11'] = ($data[$title ['date_22'].'8']*100)/ $total_2;
                    $data[$title ['date_c2'].'12'] = number_format($data[$title ['date_21c'].'10'] - $data[$title ['date_22c'].'11'],2,'.','');
                    $data[$title ['date_31'].'13'] = $value;
                }
                else if($title ['date_32'] == $day){
                    $data[$title ['date_32'].'14'] = $value;
                    $data['Change315'] = number_format($data[$title ['date_31'].'13'] - $data[$title ['date_32'].'14'],2,'.','');
                    
                    $data[$title ['date_31c'].'16'] = $data[$title ['date_22c'].'11'];
                    $data[$title ['date_32c'].'17'] = ($data[$title ['date_32'].'14']*100)/ $total_3;
                    $data[$title ['date_c3'].'18'] = number_format($data[$title ['date_31c'].'16'] - $data[$title ['date_32c'].'17'],2,'.','');
                    
                    $data[$title ['date_41'].'19'] = $value;
                }
                else if($title ['date_42'] == $day){
                    $data[$title ['date_42'].'20'] = $value;
                    $data['Change421'] = number_format($data[$title ['date_41'].'19'] - $data[$title ['date_42'].'20'],2,'.','');
                    
                    $data[$title ['date_41c'].'22'] = $data[$title ['date_32c'].'17'];
                    $data[$title ['date_42c'].'23'] = ($data[$title ['date_42'].'20']*100)/ $total_4;
                    $data[$title ['date_c4'].'24'] = number_format($data[$title ['date_41c'].'22'] - $data[$title ['date_42c'].'23'],2,'.','');
                    
                    $data[$title ['date_51'].'25'] = $value;
                }
                else if($title ['date_52'] == $day){
                    $data[$title ['date_52'].'26'] = $value;
                    $data['Change527'] = number_format($data[$title ['date_51'].'25'] - $data[$title ['date_52'].'26'],2,'.','');
                    
                    $data[$title ['date_51c'].'28'] = $data[$title ['date_42c'].'23'];
                    $data[$title ['date_52c'].'29'] = ($data[$title ['date_52'].'26']*100)/ $total_5;
                    $data[$title ['date_c5'].'30'] = number_format($data[$title ['date_51c'].'28'] - $data[$title ['date_52c'].'29'],2,'.','');
                    
                    $data[$title ['date_61'].'31'] = $value;
                }
                else if($title ['date_62'] == $day){
                    $data[$title ['date_62'].'32'] = $value;
                    $data['Change633'] = number_format($data[$title ['date_61'].'31'] - $data[$title ['date_62'].'32'],2,'.','');
                    
                    $data[$title ['date_61c'].'34'] = $data[$title ['date_52c'].'29'];
                    $data[$title ['date_62c'].'35'] = ($data[$title ['date_62'].'32']*100)/ $total_6;
                    $data[$title ['date_c6'].'36'] = number_format(($data[$title ['date_61c'].'34'] - $data[$title ['date_62c'].'35']),2,'.','');
                    
                }
                else
                    $data[$day] = 0;
                
                //pr($data);
            }
            //echo '<br>';
            $allData[] = $data;

        }
       
        
       
        
        $total[] = $total_0;
        $total[] = $total_1;
        $total[] = $total_2;
        $total[] = $total_3;
        $total[] = $total_4;
        $total[] = $total_5;
        $total[] = $total_6;
        
        $data = array();
        $data['sector'] = "Z_Total";
        $data[$title ['date_11'].'1'] = $total_0;
        $data[$title ['date_12'].'2'] = $total_1;
        $data[$title ['date_d1'].'3'] = $total_0 - $total_1;
        $data[$title ['date_11c'].'4'] = 0;
        $data[$title ['date_12c'].'5'] = 0;
        $data[$title ['date_c1'].'6'] = 0;
        
        
        $data[$title ['date_21'].'7'] = $total_1;
        $data[$title ['date_22'].'8'] = $total_2;
        $data[$title ['date_d2'].'9'] = $total_1 - $total_2;
        $data[$title ['date_21c'].'10'] = 0;
        $data[$title ['date_22c'].'11'] = 0;
        $data[$title ['date_c2'].'12'] = 0;
        
        $data[$title ['date_31'].'13'] = $total_2;
        $data[$title ['date_32'].'14'] = $total_3;
        $data[$title ['date_d3'].'15'] = $total_2 - $total_3;
        $data[$title ['date_31c'].'16'] = 0;
        $data[$title ['date_32c'].'17'] = 0;
        $data[$title ['date_c3'].'18'] = 0;
        
        $data[$title ['date_41'].'19'] = $total_3;
        $data[$title ['date_42'].'20'] = $total_4;
        $data[$title ['date_d4'].'21'] = $total_3 - $total_4;
        $data[$title ['date_41c'].'22'] = 0;
        $data[$title ['date_42c'].'23'] = 0;
        $data[$title ['date_c4'].'24'] = 0;
        
        $data[$title ['date_51'].'25'] = $total_4;
        $data[$title ['date_52'].'26'] = $total_5;
        $data[$title ['date_d5'].'27'] = $total_4 - $total_5;
        $data[$title ['date_51c'].'28'] = 0;
        $data[$title ['date_52c'].'29'] = 0;
        $data[$title ['date_c5'].'30'] = 0;
        
        $data[$title ['date_61'].'31'] = $total_5;
        $data[$title ['date_62'].'32'] = $total_6;
        $data[$title ['date_d6'].'33'] = $total_5 - $total_6;
        $data[$title ['date_61c'].'34'] = 0;
        $data[$title ['date_62c'].'35'] = 0;
        $data[$title ['date_c6'].'36'] = 0;
        //$data[] = null;
        $allData[] = $data;
        
        $arr        = $allData;
        $jsonresult = $this->__JEncode ( $arr );
        echo '({"total":"' . count ( $result ) . '","results":' . $jsonresult . '})';
        
        die ();

    }

    function getsectorchart() {

        $this->sectorcompare ( $_GET );



        require_once (WWW_ROOT . DS . 'chart' . DS . 'Image_Toolbox.class.php');

        $chartImagePath = WWW_ROOT . 'chart' . DS . 'sectorcomparechart.png';



        $img = new Image_Toolbox ( $chartImagePath );



        $width = $img->_img ['main'] ['width'];



        $img->addImage ( $width, 10, '#FFFFFF' );

        //$img->blendMask ( 'left', 'bottom', IMAGE_TOOLBOX_BLEND_COPY, 0, 440 );
        //$img->blendMask ( 'left', 'bottom', IMAGE_TOOLBOX_BLEND_COPY, 0, 470 );
        $img->blendMask ( 'left', 'bottom', IMAGE_TOOLBOX_BLEND_COPY, 0, 650 );

        //$img->blend('left','bottom',IMAGE_TOOLBOX_BLEND_COPY);
        $img->output ();

        die();

    }



    /*
    *  Weekly comparison --demo
    */



    function weeklycompare($updateRequest = '') {
        if (! $this->Session->check ( 'Auth.User' )) {
            $this->Session->setFlash ( 'You are not authorized to access that location.' );
            $this->redirect ( array ('controller' => 'users', 'action' => 'login' ) );
        }

        App::import ( 'Vendor', 'Phpchartdir', array ('file' => 'phpchartdir.php' ) );

        require_once (WWW_ROOT . DS . 'chart' . DS . 'Image_Toolbox.class.php');



        $this->layout = 'default-one';

        // $this->layout ='default-mainchart';
        $this->pageTitle = 'Stock Bangladesh :: Weekly Chart - Price Chart/ Graph';



        $inv = 60;

        $inv1 = 300;



        if (isset ( $updateRequest ['sym'] ) && $updateRequest ['sym'] != '')

        $_REQUEST ['TickerSymbol'] = $updateRequest ['sym'];

        if (isset ( $updateRequest ['inv'] ) && $updateRequest ['inv'] != '')

        $_REQUEST ['inv'] = $updateRequest ['inv'];



        if (isset ( $_REQUEST ['TickerSymbol'] )) {

            $this->layout = 'default-mainchart';

            $inv = $_REQUEST ['inv'];



            //$inv = 600;




            $symbolInfo = $this->Symbol->find ( 'first', array ('conditions' => array ('id=' . $_REQUEST ['TickerSymbol'] ), 'fields' => array ('Symbol.dse_code', 'Symbol.name' ) ) );

            $name = $symbolInfo ['Symbol'] ['name'];

            $name = ucwords ( strtolower ( $name ) );



            $this->pageTitle = 'Stock Bangladesh :: Weekly Chart #' . $name . '- Price Chart/ Graph';



            $this->set ( 'sym', $_REQUEST ['TickerSymbol'] );



            $symbol = $_REQUEST ['TickerSymbol'];

            $symbol = trim ( $symbol );

            $interval = $inv;



            $code = $symbolInfo ['Symbol'] ['dse_code'];

            $name = $symbolInfo ['Symbol'] ['name'];

            $minute = $interval / 60;



            if ($minute > 1) {

                $minute = $minute . ' Minutes Chart';

            } else {

                $minute = $minute . ' Minutes Chart';

            }



            $nameOfTheDay = date ( 'l' );

            if ($nameOfTheDay == 'Friday')

            $todayTimeStamp = mktime ( 0, 0, 0, date ( 'm' ), date ( 'd' ) - 1, date ( 'Y' ) );

            else if ($nameOfTheDay == 'Saturday')

            $todayTimeStamp = mktime ( 0, 0, 0, date ( 'm' ), date ( 'd' ) - 2, date ( 'Y' ) );

            else

            $todayTimeStamp = mktime ( 0, 0, 0, date ( 'm' ), date ( 'd' ), date ( 'Y' ) );



            /*$todayTimeStamp = mktime(0, 0, 0, date('m'), date('d'), date('Y'));*/



            $todayTimeStamp = $todayTimeStamp - 3 * 24 * 60 * 60;



            /*--- FIRST USE OF MEMCACHE :: START HERE ---*/

            /* if (class_exists('Memcache')) {

            $memcache = new Memcache;
            $memcache->connect('localhost', 11211) or die ("Could not connect");

            $memKey3  = md5('select * from data_banks_intraday where symbol_id ='.$symbol.' AND date >= '.$todayTimeStamp.' ORDER BY id DESC LIMIT 0, 400');

            if (!$memcache->get($memKey3)) {
            $shareData = $this->Symbol->query('select * from data_banks_intraday where symbol_id ='.$symbol.' AND date >= '.$todayTimeStamp.' ORDER BY id DESC LIMIT 0, 400');
            $memcache->set($memKey3, $shareData, MEMCACHE_COMPRESSED, 60);
            }

            $shareData = $memcache->get($memKey3);
            }
            else {
            $shareData = $this->Symbol->query('select * from data_banks_intraday where symbol_id ='.$symbol.' AND date >= '.$todayTimeStamp.' ORDER BY id DESC LIMIT 0, 400');
            }*/

            /*--- FIRST USE OF MEMCACHE :: END HERE ---*/



            $shareData = $this->Symbol->query ( 'select id,lastprice,volume,date from data_banks_intraday where symbol_id =' . $symbol . ' ORDER BY id DESC LIMIT 0, 1500' );



            //  print_r($shareData);




            // exit;
            $timeWiseArr = array ();

            $timeKeyArr = array ();



            $daywiseData = array ();



            foreach ( $shareData as $row ) {

                $currenttime = $row ['data_banks_intraday'] ['date'];

                $day = date ( 'D', $currenttime );



                $currenttime = $row ['data_banks_intraday'] ['date'];

                //$currenttime = $currenttime + (8*60*60);




                $mod = $currenttime % $interval;



                $timeToBeAccounted = $currenttime - $mod + $interval;

                $temp = $row;

                $temp ['date_time'] = date ( 'd M  h:ia', $timeToBeAccounted );

                $daywiseData [$day] [$timeToBeAccounted] [$currenttime] = $temp;



            }



            foreach ( $shareData as $row ) {

                $currenttime = $row ['data_banks_intraday'] ['date'];

                //$currenttime = $currenttime + (8*60*60);




                $mod = $currenttime % $interval;

                $timeToBeAccounted = $currenttime - $mod + $interval;

                //echo date('h:i A', $timeToBeAccounted).'<br><br>';
                $timeWiseArr [$timeToBeAccounted] [] = date ( 'd h:i A', $timeToBeAccounted );

                $timeWiseArr [$timeToBeAccounted] [] = $row;



                $modtime = date ( 'd M  h:ia', $timeToBeAccounted );

            }



            foreach ( $timeWiseArr as $key => $arr ) {

                $timeKeyArr [] = $key;

            }



            $summary = array ();

            foreach ( $daywiseData as $weekday => $data ) {

                foreach ( $data as $tradetime => $tradeArr ) {

                    $rowVolume = 0;

                    $volumePerInterval = 0;

                    $volume = 0;

                    foreach ( $tradeArr as $eachArr ) {

                        if ($rowVolume) {

                            $volume = $rowVolume - $eachArr ['data_banks_intraday'] ['volume'];

                            $volumePerInterval = $volume + $volumePerInterval;

                        }

                        $rowVolume = $eachArr ['data_banks_intraday'] ['volume'];

                        $rowLtp = $eachArr ['data_banks_intraday'] ['lastprice'];



                    }

                    $summary [$weekday] [$tradetime] ['volume'] = $volumePerInterval;

                    $summary [$weekday] [$tradetime] ['ltp'] = $rowLtp;

                    $summary [$weekday] [$tradetime] ['time'] = date ( 'h:i', $tradetime );

                    $summary [$weekday] [$tradetime] ['timestamp'] = $tradetime;

                }

            }



            $thuvol = array ();

            $thuprice = array ();

            $labels = array ();

            foreach ( $summary ['Thu'] as $day ) {

                $thuvol [] = $day ['volume'];

                $thuprice [] = $day ['ltp'];

                $labels [] = $day ['time'];

            }



            $wedvol = array ();

            $wedprice = array ();

            foreach ( $summary ['Wed'] as $day ) {

                $wedvol [] = $day ['volume'];

                $wedprice [] = $day ['ltp'];

            }



            $tuevol = array ();

            $tueprice = array ();

            foreach ( $summary ['Tue'] as $day ) {

                $tuevol [] = $day ['volume'];

                $tueprice [] = $day ['ltp'];

            }



            $monvol = array ();

            $monprice = array ();

            foreach ( $summary ['Mon'] as $day ) {

                $monvol [] = $day ['volume'];

                $monprice [] = $day ['ltp'];

            }



            $sunvol = array ();

            $sunprice = array ();

            foreach ( $summary ['Sun'] as $day ) {

                $sunvol [] = $day ['volume'];

                $sunprice [] = $day ['ltp'];

            }



            //exit;




            //$data0 = array(100, 125, 156, 147, 87, 124, 178, 109, 140, 106, 192, 122);
            //$data1 = array(122, 156, 179, 211, 198, 177, 160, 220, 190, 188, 220, 270);
            //$data2 = array(167, 190, 213, 267, 250, 320, 212, 199, 245, 267, 240, 310);
            //$labels = array("Jan", "Feb", "Mar", "Apr", "May", "Jun", "Jul", "Aug", "Sept","Oct", "Nov", "Dec");




            $data0 = array_reverse ( $thuvol );

            $data1 = array_reverse ( $wedvol );

            $data2 = array_reverse ( $tuevol );

            $data3 = array_reverse ( $monvol );

            $data4 = array_reverse ( $sunvol );



            $xdata0 = array_reverse ( $thuprice );

            $xdata1 = array_reverse ( $wedprice );

            $xdata2 = array_reverse ( $tueprice );

            $xdata3 = array_reverse ( $monprice );

            $xdata4 = array_reverse ( $sunprice );

            $labels = array_reverse ( $labels );

            //$labels=$timeArr;
            /*
            echo "<pre>";
            print_r($date0);
            print_r($labels);
            print_r($ltpArr);
            exit;
            */



            # Create a XYChart object of size 580 x 280 pixels
            $c = new XYChart ( 1000, 480 );



            # Add a title to the chart using 14 pts Arial Bold Italic font
            $c->addTitle ( "Weekly comparison-$code", "arialbi.ttf", 14 );



            # Set the plot area at (50, 50) and of size 500 x 200. Use two alternative background
            # colors (f8f8f8 and ffffff)
            $c->setPlotArea ( 80, 50, 900, 350, 0xf8f8f8, 0xffffff );



            # Add a legend box at (50, 25) using horizontal layout. Use 8pts Arial as font, with
            # transparent background.
            $legendObj = $c->addLegend ( 50, 25, false, "arial.ttf", 8 );

            $legendObj->setBackground ( Transparent );



            # Add custom text at (176, 21) (top right corner of plotarea) using 11pt Times Bold
            # Italic font/red (0xc09090) color
            $textBoxObj = $c->addText ( 750, 50, "www.stockbangladesh.org", "timesbi.ttf", 11, 0xc09090 );

            $textBoxObj->setAlignment ( TopLeft );



            # Set the x axis labels
            $c->xAxis->setLabels ( $labels );

            # Set the labels on the x axis.
            $c->xAxis->setLabelStyle ( "Arial", 8, TextColor, 90 );



            # Draw the ticks between label positions (instead of at label positions)
            $c->xAxis->setTickOffset ( 0.99 );



            # Add a multi-bar layer with 3 data sets
            $layer = $c->addBarLayer2 ( Side );

            $layer->addDataSet ( $data0, 0xff8080, "Thu" );

            $layer->addDataSet ( $data1, 0x80ff80, "Wed" );

            $layer->addDataSet ( $data2, 0x8080ff, "Tue" );

            $layer->addDataSet ( $data3, 0x808080, "Mon" );

            $layer->addDataSet ( $data4, 0xbbbb00, "Sun" );



            # Set 50% overlap between bars
            $layer->setOverlapRatio ( 0.75 );



            # Add a title to the y-axis
            $c->yAxis->setTitle ( "Volume" );



            # Add a line layer to the chart
            $layer = $c->addLineLayer ();

            $layer->setUseYAxis2 ();

            # Add the first line. Plot the points with a 7 pixel square symbol
            $dataSetObj = $layer->addDataSet ( $xdata0, 0xcf4040, "Thu" );

            $dataSetObj->setDataSymbol ( SquareSymbol, 5 );



            $dataSetObj = $layer->addDataSet ( $xdata1, 0x80ff80, "Wed" );

            $dataSetObj->setDataSymbol ( SquareSymbol, 5 );



            $dataSetObj = $layer->addDataSet ( $xdata2, 0x8080ff, "Tue" );

            $dataSetObj->setDataSymbol ( SquareSymbol, 5 );



            $dataSetObj = $layer->addDataSet ( $xdata3, 0x808080, "Mon" );

            $dataSetObj->setDataSymbol ( SquareSymbol, 5 );



            $dataSetObj = $layer->addDataSet ( $xdata4, 0xbbbb00, "Sun" );

            $dataSetObj->setDataSymbol ( SquareSymbol, 5 );



            # Output the chart
            //    header ( "Content-type: image/png" );
            //print ($c->makeChart2 ( PNG )) ;




            $chartData = $c->makeChart2 ( PNG );



            $chartImagePath = WWW_ROOT . 'chart' . DS . 'weeklycompare.png';

            $f = fopen ( $chartImagePath, "wb" );

            fwrite ( $f, $chartData );

            fclose ( $f );

            //die();

            /*
            $chartImageMap = $c->getHTMLImageMap ( "", "", "title='{dataSetName} at {xLabel} =  {value|2} '" );
            $this->set ( 'chartImageMap', $chartImageMap );

            if (isset ( $_REQUEST ['mapData'] ) && $_REQUEST ['mapData'] == 'yes') {
            echo "-#-";
            echo $chartImageMap;
            die ( '-#-' );
            }*/



            /*$img = new Image_Toolbox ( $chartImagePath );

            $width = $img->_img ['main'] ['width'];

            $img->addImage ( $width, 10, '#FFFFFF' );
            $img->blendMask ( 'left', 'bottom', IMAGE_TOOLBOX_BLEND_COPY, 0, 470 );
            $img->output ();
            */



        }



        $this->set ( 'inv', $inv );

        $this->set ( 'inv1', $inv1 );

    }
	
	/*
    *   To generate miunute chart    
    */
        function minutechart($updateRequest = '') {
            if (! $this->Session->check ( 'Auth.User' )) {
            $this->Session->setFlash ( 'You are not authorized to access that location.' );
            $this->redirect ( array ('controller' => 'users', 'action' => 'login' ) );
        }
        $this->layout = 'default-one';
        $this->pageTitle = 'Stock Bangladesh :: Minute Chart - Price Chart/ Graph';
        
        /*if (! $this->Session->check ( 'Auth.User' )) {
            $this->Session->setFlash ( 'Please login again.' );

            $this->redirect ( array ('controller' => 'users', 'action' => 'login' ) );
        }*/
        
            
        $inv = 60;
        $inv1 = 300;
        
        if (isset ( $updateRequest ['sym'] ) && $updateRequest ['sym'] != '')
            $_REQUEST ['TickerSymbol'] = $updateRequest ['sym'];
        if (isset ( $updateRequest ['inv'] ) && $updateRequest ['inv'] != '')
            $_REQUEST ['inv'] = $updateRequest ['inv'];
        
        if (isset ( $_REQUEST ['TickerSymbol'] )) {
            $inv = $_REQUEST ['inv'];
            
            //pr($_REQUEST ['TickerSymbol']);
            
            //$symbolInfosql = 'select * from stocknet_plugin.data_banks_intraday where symbol_id =' . $symbol . '  AND TO_DAYS(FROM_UNIXTIME(datestamp))= TO_DAYS(FROM_UNIXTIME(' . $requestTimeStamp . '))  ORDER BY id DESC LIMIT 0, 400' ;
            //$symbolInfoquery = mysql_query ( $symbolInfosql, $AMILink );
            ///////////////////from .com database/////////////
            $symbolInfo = $this->Symbol->find ( 'first', array ('conditions' => array ('id=' . $_REQUEST ['TickerSymbol'] ), 'fields' => array ('Symbol.dse_code', 'Symbol.name' ) ) );
            /////////////////////////////////////////////
            //$symbolInfo = array();
//            while($eachrow = mysql_fetch_row($symbolInfoquery))
//              {
//                  $symbolInfo[] = $eachrow;
//                  
//              }
            
            
            $name = $symbolInfo ['Symbol'] ['name'];
            $name = ucwords ( strtolower ( $name ) );
            
            $this->pageTitle = 'Stock Bangladesh :: Minute Chart #' . $name . '- Price Chart/ Graph';
            
            $this->set ( 'sym', $_REQUEST ['TickerSymbol'] );
            
            App::import ( 'Vendor', 'Phpchartdir', array ('file' => 'phpchartdir.php' ) );
            $symbol = $_REQUEST ['TickerSymbol'];
            $symbol = trim ( $symbol );
            $interval = $inv;
            
            $code = $symbolInfo ['Symbol'] ['dse_code'];
            $name = $symbolInfo ['Symbol'] ['name'];
            $minute = $interval / 60;
            
            if ($minute > 1) {
                $minute = $minute . ' Minutes Chart';
            } else {
                $minute = $minute . ' Minutes Chart';
            }
            
            $nameOfTheDay = date ( 'l' );
            if ($nameOfTheDay == 'Friday')
                $todayTimeStamp = mktime ( 0, 0, 0, date ( 'm' ), date ( 'd' ) - 1, date ( 'Y' ) );
            else if ($nameOfTheDay == 'Saturday')
                $todayTimeStamp = mktime ( 0, 0, 0, date ( 'm' ), date ( 'd' ) - 2, date ( 'Y' ) );
            else
                $todayTimeStamp = mktime ( 0, 0, 0, date ( 'm' ), date ( 'd' ), date ( 'Y' ) );
                
            /*$todayTimeStamp = mktime(0, 0, 0, date('m'), date('d'), date('Y'));*/
            
            //$getLastIntradayIdSql = 'select * from configuration where name=\'data_bank_intraday_lid\' ' ;
           // $getLastIntradayId = mysql_query ( $getLastIntradayIdSql, $AMILink );
            
            $getLastIntradayId = $this->Symbol->query('SELECT value from configuration WHERE name=\'data_bank_intraday_lid\' ');
            
            $getLastIntradayId = $getLastIntradayId[0]['configuration']['value'];
            //pr($getLastIntradayId); die;
            /*--- FIRST USE OF MEMCACHE :: START HERE ---*/
            if (class_exists ( 'Memcache' )) {
                
                $memcache = new Memcache ( );
                $memcache->connect ( 'localhost', 11211 ) or die ( "Could not connect" );
                $memKey3 = md5 ( 'select * from stockorg_stock.data_banks_intraday where symbol_id =' . $symbol . ' AND id > ' . $getLastIntradayId . ' ORDER BY id DESC' );
                
                if (! $memcache->get ( $memKey3 )) {
                    
                    $shareData = $this->Symbol->query ( 'select * from stockorg_stock.data_banks_intraday where symbol_id =' . $symbol . ' AND id > ' . $getLastIntradayId . ' ORDER BY id DESC' );
                    $memcache->set ( $memKey3, $shareData, MEMCACHE_COMPRESSED, 60 );
                }
                
                $shareData = $memcache->get ( $memKey3 );
            } else {
               
                $shareData = $this->Symbol->query ( 'select * from stockorg_stock.data_banks_intraday where symbol_id =' . $symbol . ' AND id > ' . $getLastIntradayId . ' ORDER BY id DESC' );
                
            }
            /*--- FIRST USE OF MEMCACHE :: END HERE ---*/
            
            //pr($shareData);
//            die;
            $timeWiseArr = array ();
            $timeKeyArr = array ();
            
            foreach ( $shareData as $row ) {
                $currenttime = $row ['data_banks_intraday'] ['date'];
                
                $mod = $currenttime % $interval;
                $timeToBeAccounted = $currenttime - $mod + $interval;
                $timeWiseArr [$timeToBeAccounted] [] = $row;
                
                $modtime = date ( 'd M  h:ia', $timeToBeAccounted );
            }
            $rowDataVolumeStart = 0;
            $rowDataVolumeEnd = 0;
            $currentDataVolume = 0;
            $tempVolumeCounter = 0;
            $totalArrayCount = count($timeWiseArr);
            $myDefinedCounter = 1;
            foreach ( $timeWiseArr as $key => $arr ) {
                $timeKeyArr [] = $key;
            }
            
            $finalArr = array ();
            $totalvolume = $shareData [0] ['data_banks_intraday'] ['volume'];
            $tradetimestamp = $shareData [0] ['data_banks_intraday'] ['date'];
            $dayhigh = $shareData [0] ['data_banks_intraday'] ['high'];
            $daylow = $shareData [0] ['data_banks_intraday'] ['low'];
            $totaltrade = $shareData [0] ['data_banks_intraday'] ['trade'];
            $yclose=$shareData [0] ['data_banks_intraday'] ['yclose'];
            
            $tradeDate = date ( 'd M y h:ia', $tradetimestamp );           
            $i = 0;
            $singleCount = 0;
            $finalPrice = 0;
            //pr($timeWiseArr);
            $startPrice = 0;
            $endPrice = 0;
            
            foreach ( $timeWiseArr as $key => $arr ) {
                $datetime = date ( 'h:i A', $key );
                $temp = array ();
                $startArr = array ();
                $endArr = array ();
                $ind = count ( $arr );
                $counterArr = count($arr);
                $finalPrice = $arr[0]['data_banks_intraday']['close'];
                
                if(!$rowDataVolumeStart) {
                    $rowDataVolumeStart = $arr[0]['data_banks_intraday']['volume'];
                    $startPrice = $arr[0]['data_banks_intraday']['close'];
                }

                if($myDefinedCounter==$totalArrayCount){
                    $rowDataVolumeEnd  =0;
                    $endPrice = $arr[0]['data_banks_intraday']['yclose'];
                }else {
                    $rowDataVolumeEnd = $arr[$counterArr-1]['data_banks_intraday']['volume'];
                    $endPrice = $arr[0]['data_banks_intraday']['close'];

                }
                
                if ($ind == 1) {
                    $startArr = $arr [$ind - 1];
                    $endArr = $arr [$ind - 1];
                    
                    if (isset ( $timeKeyArr [$i + 1] )) {
                        $time = $timeKeyArr [$i + 1];
                        $endvolume = $timeWiseArr [$time] [0] ['data_banks_intraday'] ['volume'];
                    } else {
                        $endvolume = 0;
                    }
                    $startvolume = $startArr ['data_banks_intraday'] ['volume'];
                } else {
                    
                    if (isset ( $timeKeyArr [$i] )) {
                        $time = $timeKeyArr [$i];
                        $preArrInd = count ($timeWiseArr [$time] );
                        $startvolume = $timeWiseArr [$time] [0] ['data_banks_intraday'] ['volume'];
                        
                    } else {
                        $startvolume = 0;
                        
                    }
                    $endArr = $arr [$ind - 1];
                    if (isset ( $endArr )) {
                        $endvolume = $endArr ['data_banks_intraday'] ['volume'];
                    } else {
                        $endvolume = 0;
                    }
                }
                
                $temp ['ltp'] = $finalPrice;
                $finalPrice = $arr[$counterArr-1]['data_banks_intraday']['lastprice'];
                
                $temp ['high'] = $endArr ['data_banks_intraday'] ['high'];
                $temp ['low'] = $endArr ['data_banks_intraday'] ['low'];
                $temp ['close'] = $endArr ['data_banks_intraday'] ['close'];
                $temp ['yclose'] = $endArr ['data_banks_intraday'] ['yclose'];
                $temp ['trade'] = $endArr ['data_banks_intraday'] ['trade'];
                $temp ['volume'] = $rowDataVolumeStart - $rowDataVolumeEnd;

                if($startPrice > $endPrice){
                    $myPositiveCounter += $temp ['volume'];

                }else {
                    $myNegativeCounter += $temp ['volume'];
                }

                $rowDataVolumeStart = $rowDataVolumeEnd;
                $startPrice = $endPrice;
                $myDefinedCounter++;

                $temp ['value'] = $endArr ['data_banks_intraday'] ['value'];
                $temp ['datetime'] = $datetime;
                $temp ['idatetime'] = $key;
                $finalArr [] = $temp;

                ++ $i;
            }


            $xdata = array ();
            $ydata = array ();
            $vdata = array ();

            $totalbar = count ( $finalArr );

            foreach ( $finalArr as $mykey => $row ) {
                $volumetemp = $row ['volume'];

                if ($volumetemp < 0) {
                    continue;
                }

                $xdata [] = $row ['ltp'];
                $vdata [] = $finalArr [$mykey +1] =$row ['volume'];

                if ($interval < 120 && $totalbar > 80) {

                    if ($interval == 60) {
                        $yint = 600;
                    } else {
                        $yint = 300;
                    }
                    $currenttime = $row ['idatetime'];

                    $mod = $currenttime % $yint;

                    if ($mod == 0) {
                        $ydata [] = $row ['datetime'];
                    } else {
                        $ydata [] = "-";
                    }
                } else {
                    $ydata [] = $row ['datetime'];
                }

            }



            $xdata = array_reverse ( $xdata );
            $ydata = array_reverse ( $ydata );
            $vdata = array_reverse ( $vdata );
            
            $max = 50;

            $lastprice = $xdata [count ( $xdata ) - 1];
            $lasttime = $ydata [count ( $ydata ) - 1];
            $lastvolume = $vdata [count ( $vdata ) - 1];

            array_unshift($vdata, 0);
            array_pop($vdata);
            
            # The data for the chart
            $myPositiveCounter=0;
            $myNegativeCounter=0;
            $myEqualCounter=0;

            if($yclose<$xdata[0])
            {
                $myPositiveCounter=$vdata[0];
            }
            if($yclose>$xdata[0])
            {
                $myNegativeCounter=$vdata[0];
            }
            /* echo "<pre >";
            echo "xdata";
            print_r($xdata);
            echo "vdata";
            print_r($vdata);
            exit;
            */
            for($i=0;$i<count($vdata);$i++)
            {
                if($xdata[$i]>$xdata[$i-1])
                {

                    $myPositiveCounter+=$vdata[$i];
                    
                }
                if ($xdata[$i]<$xdata[$i-1])
                {
                    $myNegativeCounter+=$vdata[$i];
                    
                }
                if ($xdata[$i]==$xdata[$i-1])
                {
                    $myEqualCounter+=$vdata[$i];

                }


            }
            //exit;
            $data0 = $xdata;
            $data1 = $vdata;
            $labels = $ydata;

            $myPositivePer=($myPositiveCounter/$totalvolume)*100;
            $myPositivePer=round($myPositivePer,2);

            $myNegativePer=($myNegativeCounter/$totalvolume)*100;
            $myNegativePer=round($myNegativePer,2);

            $myEqualPer=($myEqualCounter/$totalvolume)*100;
            $myEqualPer=round($myEqualPer,2);


            # Create a XYChart object of size 300 x 180 pixels
            $c = new XYChart ( 760, 450 );



            $c->setBackground ( $c->linearGradientColor ( 0, 0, 0, 400, 0xE7FFDF, 0xffffff ), 0xE3EFC2 );

            $c->setRoundedFrame ( 0xffffff, 0 );

            //$c->setBackground($c->linearGradientColor(0, 0, 0, 400, 0xffffbb, 0xffffff), 0x888888);
            //$c->setRoundedFrame(0xffffff, 0);




            # Set the plot area at (50, 20) and of size 200 x 130 pixels
            $c->setPlotArea ( 50, 50, 650, 320, 0xffffff, - 1, - 1, $c->dashLineColor ( 0xaaaaaa, DotLine ), Transparent );



            # Add a title to the chart using 8 pts Arial Bold font
            $arialbdPath = WWW_ROOT . 'font' . DS . 'arialbd.ttf';

            $c->addTitle ( "$code- $tradeDate          Last price : $lastprice   high : $dayhigh  low : $daylow  trade : $totaltrade   Total Volume - $totalvolume ", $arialbdPath, 8, 0x333333, 0xE7FFDF );
            $textBoxObj = $c->addText ( 180, 12, "Bull Vol: $myPositiveCounter($myPositivePer%) Neutral Vol: $myEqualCounter($myEqualPer%)  Bear Vol: $myNegativeCounter ($myNegativePer%)", $arialbdPath, 8, 0x333333 );
            //$c->addTitle ( "$code-$tradeDate          Last price : $lastprice   high : $dayhigh low : $daylow trade : $totaltrade   Total Volume - $totalvolume Positive: Negative: ", $arialbdPath, 14, 0x333333, 0xE7FFDF );



            # Set the labels on the x axis.
            $c->xAxis->setLabels ( $labels );

            $c->xAxis->setLabelStyle ( "Arial", 8, TextColor, 90 );

            # Add a title to the primary (left) y axis
            $c->yAxis->setTitle ( "PRICE" );



            # Set the axis, label and title colors for the primary y axis to red (0xc00000) to
            # match the first data set
            $c->yAxis->setColors ( 0x008000, 0x008000, 0x008000 );



            # Add a title to the secondary (right) y axis
            $c->yAxis2->setTitle ( "VOLUME" );



            # set the axis, label and title colors for the primary y axis to green (0x008000) to
            # match the second data set
            $c->yAxis2->setColors ( 0x008000, 0x008000, 0x008000 );



            $textBoxObj = $c->addText ( 500, 50, "www.stockbangladesh.org", "timesbi.ttf", 11, 0xc09090 );

            $textBoxObj->setAlignment ( TopLeft );



            # Add a line layer to the chart
            $layer = $c->addLineLayer ();



            # Add the first line. Plot the points with a 7 pixel square symbol
            $dataSetObj = $layer->addDataSet ( $data0, 0xcf4040, "Price" );

            $dataSetObj->setDataSymbol ( SquareSymbol, 5 );



            $trendLayerObj = $c->addTrendLayer ( $data0, 0x008000, "Trend Line" );

            $trendLayerObj->setLineWidth ( 1 );



            $trendLayerObj->addPredictionBand ( 0.95, 0x8066ff66 );



            $barLayerObj = $c->addBarLayer3 ( $data1 );

            $barLayerObj->setBarShape ( CircleShape );



            $barLayerObj->setUseYAxis2 ();



            //    $c->addAreaLayer($data1, $c->yZoneColor(60, 0x8033ff33, 0x80ff3333));




            //$chart1URL = $c->makeSession("chart1");
            # Create an image map for the chart




            $chartData = $c->makeChart2 ( PNG );

            $chart1URL = $c->makeSession("minchart");

            $this->set('chart1URL', $chart1URL);



            $chartImagePath = WWW_ROOT . 'chart' . DS . 'mm_chart_full.png';

            $f = fopen ( $chartImagePath, "wb" );

            fwrite ( $f, $chartData );

            fclose ( $f );



            $chartImageMap = $c->getHTMLImageMap ( "", "", "title='{dataSetName} at {xLabel} =  {value|2} '" );

            $this->set ( 'chartImageMap', $chartImageMap );



            if (isset ( $_REQUEST ['mapData'] ) && $_REQUEST ['mapData'] == 'yes') {

                echo "-#-";

                echo $chartImageMap;

                die ( '-#-' );

            }

        }



        $this->set ( 'inv', $inv );

        $this->set ( 'inv1', $inv1 );
        
        
        

    }
	
	function minutechartnext($updateRequest = '') {
		//$this->layout = '';
		$this->pageTitle = 'Stock Bangladesh :: Minute Chart - Price Chart/ Graph';
		
		$inv = 60;
		$inv1 = 300;
		
		if (isset ( $updateRequest ['sym'] ) && $updateRequest ['sym'] != '')
			$_REQUEST ['TickerSymbol'] = $updateRequest ['sym'];
		if (isset ( $updateRequest ['inv'] ) && $updateRequest ['inv'] != '')
			$_REQUEST ['inv'] = $updateRequest ['inv'];
		
		if (isset ( $_REQUEST ['TickerSymbol'] )) {
			$inv = $_REQUEST ['inv'];
			
			$symbolInfo = $this->Symbol->find ( 'first', array ('conditions' => array ('id=' . $_REQUEST ['TickerSymbol'] ), 'fields' => array ('Symbol.dse_code', 'Symbol.name' ) ) );
			$name = $symbolInfo ['Symbol'] ['name'];
			$name = ucwords ( strtolower ( $name ) );
			
			$this->pageTitle = 'Stock Bangladesh :: Minute Chart #' . $name . '- Price Chart/ Graph';
			
			$this->set ( 'sym', $_REQUEST ['TickerSymbol'] );
			
			App::import ( 'Vendor', 'Phpchartdir', array ('file' => 'phpchartdir.php' ) );
			$symbol = $_REQUEST ['TickerSymbol'];
			$symbol = trim ( $symbol );
			$interval = $inv;
			
			$code = $symbolInfo ['Symbol'] ['dse_code'];
			$name = $symbolInfo ['Symbol'] ['name'];
			$minute = $interval / 60;
			
			if ($minute > 1) {
				$minute = $minute . ' Minutes Chart';
			} else {
				$minute = $minute . ' Minutes Chart';
			}
			
			$todayTimeStamp = mktime ( 0, 0, 0, date ( 'm' ), date ( 'd' ), date ( 'Y' ) );
			$shareData = $this->Symbol->query ( 'select * from data_banks_intraday where symbol_id =' . $symbol . ' AND date >= ' . $todayTimeStamp . ' ORDER BY id DESC LIMIT 0, 400' );
			
			$timeWiseArr = array ();
			$timeKeyArr = array ();
			
			foreach ( $shareData as $row ) {
				$currenttime = $row ['data_banks_intraday'] ['date'];
				//$currenttime = $currenttime + (8*60*60);
				

				$mod = $currenttime % $interval;
				$timeToBeAccounted = $currenttime - $mod + $interval;
				//echo date('h:i A', $timeToBeAccounted).'<br><br>';
				$timeWiseArr [$timeToBeAccounted] [] = $row;
				
				$modtime = date ( 'd M  h:ia', $timeToBeAccounted );
			}
			
			foreach ( $timeWiseArr as $key => $arr ) {
				$timeKeyArr [] = $key;
			}
			
			$finalArr = array ();
			$totalvolume = $shareData [0] ['data_banks_intraday'] ['volume'];
			$i = 0;
			
			foreach ( $timeWiseArr as $key => $arr ) {
				$datetime = date ( 'h:i A', $key );
				$temp = array ();
				$startArr = array ();
				$endArr = array ();
				$ind = count ( $arr );
				
				if ($ind == 1) {
					$startArr = $arr [$ind - 1];
					$endArr = $arr [$ind - 1];
					
					if (isset ( $timeKeyArr [$i + 1] )) {
						$time = $timeKeyArr [$i + 1];
						$endvolume = $timeWiseArr [$time] [0] ['data_banks_intraday'] ['volume'];
					} else {
						$endvolume = 0;
					}
					$startvolume = $startArr ['data_banks_intraday'] ['volume'];
				} else {
					$startArr = $arr [0];
					
					if (isset ( $startArr )) {
						$startvolume = $startArr ['data_banks_intraday'] ['volume'];
					}
					$endArr = $arr [$ind - 1];
					
					if (isset ( $endArr )) {
						$endvolume = $endArr ['data_banks_intraday'] ['volume'];
					} else {
						$endvolume = 0;
					}
				}
				
				$temp ['ltp'] = $endArr ['data_banks_intraday'] ['lastprice'];
				
				//$temp['open']      = $endArr['data_banks_intraday']['open'];
				$temp ['high'] = $endArr ['data_banks_intraday'] ['high'];
				$temp ['low'] = $endArr ['data_banks_intraday'] ['low'];
				$temp ['close'] = $endArr ['data_banks_intraday'] ['close'];
				$temp ['yclose'] = $endArr ['data_banks_intraday'] ['yclose'];
				$temp ['trade'] = $endArr ['data_banks_intraday'] ['trade'];
				$temp ['volume'] = $startvolume - $endvolume;
				$temp ['value'] = $endArr ['data_banks_intraday'] ['value'];
				$temp ['datetime'] = $datetime;
				$temp ['idatetime'] = $key;
				$finalArr [] = $temp;
				
				++ $i;
			}
			
			$xdata = array ();
			$ydata = array ();
			$vdata = array ();
			
			$totalbar = count ( $finalArr );
			
			foreach ( $finalArr as $row ) {
				$volumetemp = $row ['volume'];
				
				if ($volumetemp < 0) {
					continue;
				}
				
				$xdata [] = $row ['ltp'];
				$vdata [] = $row ['volume'];
				
				if ($interval < 120 && $totalbar > 80) {
					
					if ($interval == 60) {
						$yint = 600;
					} else {
						$yint = 300;
					}
					$currenttime = $row ['idatetime'];
					
					$mod = $currenttime % $yint;
					
					if ($mod == 0) {
						$ydata [] = $row ['datetime'];
					} else {
						$ydata [] = "-";
					}
				} else {
					$ydata [] = $row ['datetime'];
				}
			
			}
			
			$xdata = array_reverse ( $xdata );
			$ydata = array_reverse ( $ydata );
			$vdata = array_reverse ( $vdata );
			
			$max = 50;
			
			$lastprice = $xdata [count ( $xdata ) - 1];
			$lasttime = $ydata [count ( $ydata ) - 1];
			$lastvolume = $vdata [count ( $vdata ) - 1];
			
			# The data for the chart
			$data0 = $xdata;
			$data1 = $vdata;
			$labels = $ydata;
			
			# Create a XYChart object of size 300 x 180 pixels
			$c = new XYChart ( 760, 450 );
			
			$c->setBackground ( $c->linearGradientColor ( 0, 0, 0, 400, 0xE7FFDF, 0xffffff ), 0xE3EFC2 );
			$c->setRoundedFrame ( 0xffffff, 0 );
			//$c->setBackground($c->linearGradientColor(0, 0, 0, 400, 0xffffbb, 0xffffff), 0x888888);
			//$c->setRoundedFrame(0xffffff, 0);
			

			# Set the plot area at (50, 20) and of size 200 x 130 pixels
			$c->setPlotArea ( 50, 50, 650, 320, 0xffffff, - 1, - 1, $c->dashLineColor ( 0xaaaaaa, DotLine ), Transparent );
			
			# Add a title to the chart using 8 pts Arial Bold font
			$arialbdPath = WWW_ROOT . 'font' . DS . 'arialbd.ttf';
			
			$c->addTitle ( "$code-$minute             Last price    $lastprice    Volume   $lastvolume   at   $lasttime  Total Volume - $totalvolume", $arialbdPath, 8, 0x333333, 0xE7FFDF );
			
			# Set the labels on the x axis.
			$c->xAxis->setLabels ( $labels );
			$c->xAxis->setLabelStyle ( "Arial", 8, TextColor, 90 );
			# Add a title to the primary (left) y axis
			$c->yAxis->setTitle ( "PRICE" );
			
			# Set the axis, label and title colors for the primary y axis to red (0xc00000) to
			# match the first data set
			$c->yAxis->setColors ( 0x008000, 0x008000, 0x008000 );
			
			# Add a title to the secondary (right) y axis
			$c->yAxis2->setTitle ( "VOLUME" );
			
			# set the axis, label and title colors for the primary y axis to green (0x008000) to
			# match the second data set
			$c->yAxis2->setColors ( 0x008000, 0x008000, 0x008000 );
			
			# Add a line layer to the chart
			$layer = $c->addLineLayer ();
			
			# Add the first line. Plot the points with a 7 pixel square symbol
			$dataSetObj = $layer->addDataSet ( $data0, 0xcf4040, "Price" );
			$dataSetObj->setDataSymbol ( SquareSymbol, 5 );
			
			$barLayerObj = $c->addBarLayer3 ( $data1 );
			$barLayerObj->setBarShape ( CircleShape );
			
			$barLayerObj->setUseYAxis2 ();
			
			//$chart1URL = $c->makeSession("chart1");        
			# Create an image map for the chart
			

			$chartData = $c->makeChart2 ( PNG );
			
			$chartImagePath = WWW_ROOT . 'chart' . DS . 'mm_chart_full.png';
			$f = fopen ( $chartImagePath, "wb" );
			fwrite ( $f, $chartData );
			fclose ( $f );
			
			$chartImageMap = $c->getHTMLImageMap ( "", "", "title='{dataSetName} at {xLabel} =  {value|2} '" );
			$this->set ( 'chartImageMap', $chartImageMap );
			
			if (isset ( $_REQUEST ['mapData'] ) && $_REQUEST ['mapData'] == 'yes') {
				echo "-#-";
				echo $chartImageMap;
				die ( '-#-' );
			}
		}
		
		$this->set ( 'inv', $inv );
		$this->set ( 'inv1', $inv1 );
	}
	
	function minchart() {
		$this->minutechart ( $_GET );
		
		if (isset ( $_REQUEST ['mapData'] ) && $_REQUEST ['mapData'] == 'no') {
			require_once (WWW_ROOT . DS . 'chart' . DS . 'Image_Toolbox.class.php');
			$chartImagePath = WWW_ROOT . 'chart' . DS . 'mm_chart_full.png';
			
			$img = new Image_Toolbox ( $chartImagePath );
			
			$width = $img->_img ['main'] ['width'];
			
			$img->addImage ( $width, 10, '#FFFFFF' );
			$img->blendMask ( 'left', 'bottom', IMAGE_TOOLBOX_BLEND_COPY, 0, 440 );
			//$img->blend('left','bottom',IMAGE_TOOLBOX_BLEND_COPY);
			$img->output ();
		}
	}
	
	function minchart1() {
		$this->minutechart ( $_GET );
		
		require_once (WWW_ROOT . DS . 'chart' . DS . 'Image_Toolbox.class.php');
		$chartImagePath = WWW_ROOT . 'chart' . DS . 'mm_chart_full.png';
		
		$img = new Image_Toolbox ( $chartImagePath );
		
		$width = $img->_img ['main'] ['width'];
		
		$img->addImage ( $width, 10, '#FFFFFF' );
		$img->blendMask ( 'left', 'bottom', IMAGE_TOOLBOX_BLEND_COPY, 0, 440 );
		$img->output ();
	}
    
    function minchart2() {
        $this->minutechart ( $_GET );
        
        if (isset ( $_REQUEST ['mapData'] ) && $_REQUEST ['mapData'] == 'no') {
            require_once (WWW_ROOT . DS . 'chart' . DS . 'Image_Toolbox.class.php');
            $chartImagePath = WWW_ROOT . 'chart' . DS . 'mm_chart_full_p.png';
            
            $img = new Image_Toolbox ( $chartImagePath );
            
            $width = $img->_img ['main'] ['width'];
            
            $img->addImage ( $width, 10, '#FFFFFF' );
            $img->blendMask ( 'left', 'bottom', IMAGE_TOOLBOX_BLEND_COPY, 0, 440 );
            //$img->blend('left','bottom',IMAGE_TOOLBOX_BLEND_COPY);
            $img->output ();
        }
    }
	
	function updateMinChart() {
	
	}
	
	/*
    *   To generate self evaluation    
    */
	function selfevaluation($myUserId = null) {
		$this->layout = 'default-one';
		$this->pageTitle = 'Stock Bangladesh :: Test yourself - A self evaluation section';
		
		$acp = array ();
		$acpPosition = array ();
		
		$topMACPResult = $this->Simulation->query ( 'SELECT sum(point) as member_macp, user_id FROM simulations GROUP BY user_id ORDER BY member_macp DESC' );
		$totalRecommender = count ( $topMACPResult );
		
		if (count ( $topMACPResult )) {
			foreach ( $topMACPResult as $newAcp ) {
				$acp [$newAcp ['simulations'] ['user_id']] = $newAcp [0] ['member_macp'];
			}
			
			$position = 1;
			foreach ( $acp as $userid => $eachAcp ) {
				$acpPosition [$userid] = $position;
				++ $position;
			}
		}
		
		$this->paginate = array ('order' => 'start_date desc', 'limit' => 10 );
		
		$resultData = array ();
		
		if ($this->Session->check ( 'Auth.User' )) {
			
			$sessionUserId = $this->Session->read ( 'Auth.User.id' );
			if (isset ( $myUserId ) && ! empty ( $myUserId )) {
				
				if ($sessionUserId != $myUserId) {
					$this->Session->setFlash ( 'Invalid user. Please login again.' );
					$this->redirect ( array ('controller' => 'users', 'action' => 'login' ) );
				}
			}
			
			if ($sessionUserId == 2) {
				$resultData = $this->paginate ( 'Simulation' );
			} else {
				//if(isset($_GET['self']) && $_GET['self'] ==1)
				//                    $resultData = $this->paginate('Simulation', 'user_id='.$myUserId);
				//                 else   
				$resultData = $this->paginate ( 'Simulation', 'user_id=' . $sessionUserId );
			}
			
			$sessionmemberPosition = 0;
			
			//if(isset($_GET['self']) && $_GET['self'] ==1)                
			//    $sessionmemberPoint    = $acp[$myUserId];
			//else   
			$sessionmemberPoint = $acp [$sessionUserId];
			
			$sessionmemberPoint = round ( $sessionmemberPoint, 0 );
			
			//if(isset($_GET['self']) && $_GET['self'] ==1)                
			//    $sessionmemberPosition = $acpPosition[$myUserId];
			//else   
			$sessionmemberPosition = $acpPosition [$sessionUserId];
			
			if (! $sessionmemberPosition)
				$sessionmemberPosition = "Not defined.";
			
			$this->set ( 'sessionmemberPoint', $sessionmemberPoint );
			$this->set ( 'sessionmemberPosition', $sessionmemberPosition );
		} else {
			$resultData = $this->paginate ( 'Simulation', 'user_id="-5"' );
		}
		
		$tempResultData = array ();
        //pr($resultData);
        //die;
		
		if (! empty ( $resultData )) {
			
			foreach ( $resultData as $rowInd => $row ) {
				$shareDtails = $this->Symbol->find ( 'first', array ('conditions' => 'id=' . $row ['Simulation'] ['symbol'], 'fields' => array ('Symbol.category', 'Symbol.dse_code' ) ) );
				
				$tempResultData [$rowInd] ['symbol'] = $row ['Simulation'] ['symbol'];
				$tempResultData [$rowInd] ['recommendation_type'] = $row ['Simulation'] ['recommendation_type'];
				$tempResultData [$rowInd] ['recommended_price'] = $row ['Simulation'] ['recommended_price'];
				$tempResultData [$rowInd] ['current_price'] = $row ['Simulation'] ['current_price'];
				$tempResultData [$rowInd] ['point'] = $row ['Simulation'] ['point'];
				
				$tempResultData [$rowInd] ['category'] = $shareDtails ['Symbol'] ['category'];
				$tempResultData [$rowInd] ['dse_code'] = $shareDtails ['Symbol'] ['dse_code'];
				
				if ($row ['Simulation'] ['end_date'])
					$endDate = date ( 'd-M-Y', $row ['Simulation'] ['end_date'] );
				else
					$endDate = '';
				
				$tempResultData [$rowInd] ['endDate'] = $endDate;
				
				$tempResultData [$rowInd] ['validTime'] = time () - 2 * 24 * 60 * 60;
				$tempResultData [$rowInd] ['noOfRecInLast3Days'] = $this->Simulation->find ( 'count', array ('conditions' => array ('start_date > ' . $tempResultData [$rowInd] ['validTime'] . ' AND symbol=' . $row ['Simulation'] ['symbol'] ) ) );
				$tempResultData [$rowInd] ['recommendDate'] = date ( 'd-M-Y', $row ['Simulation'] ['start_date'] );
				$tempResultData [$rowInd] ['datecon'] = $row ['Simulation'] ['start_date'] + 12 * 60 * 60;
				$tempResultData [$rowInd] ['memberPoint'] = $acp [$row ['Simulation'] ['user_id']];
				$tempResultData [$rowInd] ['memberPoint'] = round ( $tempResultData [$rowInd] ['memberPoint'], 0 );
				$tempResultData [$rowInd] ['memberPosition'] = $acpPosition [$row ['Simulation'] ['user_id']];
				$tempResultData [$rowInd] ['topic_id'] = $row ['Simulation'] ['topic_id'];
				$tempResultData [$rowInd] ['status'] = $row ['Simulation'] ['status'];
				$tempResultData [$rowInd] ['recommender_id'] = $row ['Simulation'] ['user_id'];
				
				$totalTradedDaysInfo = $this->Symbol->query ( 'select * from market_summeries where UNIX_TIMESTAMP(str_to_date(date, \'%Y-%c-%d\'))>' . $tempResultData [$rowInd] ['datecon'] );
				$totalTradedDays = count ( $totalTradedDaysInfo );
				$tempResultData [$rowInd] ['totalTradedDays'] = $totalTradedDays;
				
				$matured = 0;
				if ($shareDtails ['Symbol'] ['category'] == 'Z') {
					if ($totalTradedDays >= 7)
						$matured = 1;
					else
						$remainingdayToBeMature = 7 - $totalTradedDays;
				} else {
					if ($totalTradedDays >= 4)
						$matured = 1;
					else
						$remainingdayToBeMature = 4 - $totalTradedDays;
				}
				
				$maturedMsg = '';
				if ($tempResultData [$rowInd] ['recommender_id'] == $this->Session->read ( 'Auth.User.id' )) {
					if ($matured) {
						$html_code_for_sell_it = 'Hold <br /><a class="red-bold underline" href="' . $this->webroot . 'resources/sellmyshare/' . $row ['Simulation'] ['id'] . '">STOP </a>';
						$maturedMsg = '(Matured)';
					} else {
						$html_code_for_sell_it = 'Hold <br /><b>STOP </b>';
						$maturedMsg = '(' . $remainingdayToBeMature . ' days remaining to be matured)';
					}
				} else {
					if ($matured) {
						$html_code_for_sell_it = 'Hold';
						$maturedMsg = "(Matured)";
					} else {
						$html_code_for_sell_it = 'Hold';
						$maturedMsg = '(' . $remainingdayToBeMature . ' days remaining to be matured)';
					}
				}
				
				$tempResultData [$rowInd] ['maturedMsg'] = $maturedMsg;
				$tempResultData [$rowInd] ['html_code_for_sell_it'] = $html_code_for_sell_it;
				$tempResultData [$rowInd] ['totalTradedDays'] = $totalTradedDays;
				$tempResultData [$rowInd] ['totalTradedDays'] = $totalTradedDays;
			
			}
		}
		
		$this->set ( 'result', $tempResultData );
		
		/* finding top 5 by avg ---> */
		$topMACPResultAvg = $this->Simulation->query ( 'SELECT sum(point) as member_macp, count(id) as totalrecommendation, avg(point) as average, user_id FROM simulations GROUP BY user_id ORDER BY average DESC' );
		
		$topMACPResultAvgFilterred = array ();
		$temptopMACPResultAvgFilterred = array ();
		
		if (count ( $topMACPResultAvg )) {
			foreach ( $topMACPResultAvg as $topMACPResultRow ) {
				if (isset ( $topMACPResultRow ['0'] ['totalrecommendation'] ) && $topMACPResultRow ['0'] ['totalrecommendation'] >= 5) {
					$topMACPResultAvgFilterred [] = $topMACPResultRow;
				}
			}
			
			$position = 1;
			foreach ( $topMACPResultAvgFilterred as $indx => $eachAcp1 ) {
				
				if ($position > 10) {
					break;
				}
				
				$temptopMACPResultAvgFilterred [$indx] ['user_id'] = $eachAcp1 ['simulations'] ['user_id'];
				$temptopMACPResultAvgFilterred [$indx] ['average'] = $eachAcp1 ['0'] ['average'];
				$temptopMACPResultAvgFilterred [$indx] ['username'] = $this->User->field ( 'username', array ('id=' . $eachAcp1 ['simulations'] ['user_id'] ) );
				
				$temptopMACPResultAvgFilterred [$indx] ['macp'] = round ( $temptopMACPResultAvgFilterred [$indx] ['average'], 2 );
				$temptopMACPResultAvgFilterred [$indx] ['totalrecommendation'] = $eachAcp1 ['0'] ['totalrecommendation'];
				$temptopMACPResultAvgFilterred [$indx] ['position'] = $position ++;
			}
		}
		
		//pr($temptopMACPResultAvgFilterred);
		$this->set ( 'topMACPResultAvgFilterred', $temptopMACPResultAvgFilterred );
		
		$currentmonth = date ( 'm' );
		$currentyear = date ( 'Y' );
		$currentmonthTimestamp = mktime ( 0, 0, 0, $currentmonth, 1, $currentyear ) - 1800;
		
		$acpMonth = array ();
		$acpPositionMonth = array ();
		// This query is for calculating MACP
		$topMACPStrMonth = 'SELECT sum(point) as member_macp, user_id FROM simulations WHERE start_date > ' . $currentmonthTimestamp . ' GROUP BY user_id ORDER BY member_macp DESC';
		
		$topMACPResultMonth = $this->Simulation->query ( $topMACPStrMonth );
		$totalRecommenderMonth = count ( $topMACPResultMonth );
		
		if (count ( $topMACPResultMonth )) {
			foreach ( $topMACPResultMonth as $newAcpMonth ) {
				$acpMonth [$newAcpMonth ['simulations'] ['user_id']] = $newAcpMonth [0] ['member_macp'];
			}
			
			$position = 1;
			foreach ( $acpMonth as $userid1 => $eachAcp ) {
				$acpPositionMonth [$userid1] = $position;
				++ $position;
			}
		}
		
		$position = 1;
		$tempAcpMonth = array ();
		
		foreach ( $acpMonth as $userId => $eachAcp ) {
			if ($position > 10)
				break;
			
			$tempAcpMonth [$userId] ['username'] = $this->User->field ( 'username', array ('id=' . $userId ) );
			$tempAcpMonth [$userId] ['macp'] = round ( $eachAcp, 0 );
			$tempAcpMonth [$userId] ['totalRecommendation'] = $this->Simulation->find ( 'count', array ('conditions' => array ('user_id=' . $userId . ' AND start_date > ' . $currentmonthTimestamp ) ) );
			$tempAcpMonth [$userId] ['position'] = $position;
			
			++ $position;
		}
		
		$position = 1;
		$tempAcp = array ();
		
		foreach ( $acp as $userId1 => $eachAcp ) {
			if ($position > 10)
				break;
			
			$tempAcp [$userId1] ['username'] = $this->User->field ( 'username', array ('id=' . $userId1 ) );
			$tempAcp [$userId1] ['macp'] = round ( $eachAcp, 0 );
			$tempAcp [$userId1] ['totalRecommendation'] = $this->Simulation->find ( 'count', array ('conditions' => array ('user_id=' . $userId1 ) ) );
			$tempAcp [$userId1] ['position'] = $position;
			
			++ $position;
		}
		
		$this->set ( 'acp', $tempAcp );
		$this->set ( 'acpMonth', $tempAcpMonth );
		$this->set ( 'totalRecommender', $totalRecommender );
	}
	
	/*
    *   To Generate Market Monitor    
    */
	function monitor() {
        if (! $this->Session->check ( 'Auth.User' )) {
            $this->Session->setFlash ( 'You are not authorized to access that location.' );
            $this->redirect ( array ('controller' => 'users', 'action' => 'login' ) );
        }
		$this->layout = 'default-two';
		$this->pageTitle = 'Stock Bangladesh :: Watch the price movement of selected share';
		$userId = $this->Session->read('Auth.User.id'); 
        $sql = "SELECT * FROM `settingmonitors` WHERE user_id=".$userId ;
        $exist = $this->Symbol->query($sql);
        
        //echo "<pre>";
        //print_r($exist);die;
        
		if(!empty($this->data))
        {
            $TickerSymbol1 = $this->data['Resource']['company0'];
            $TickerSymbol2 = $this->data['Resource']['company1'];
            $TickerSymbol3 = $this->data['Resource']['company2'];
            $TickerSymbol4 = $this->data['Resource']['company3'];
            $TickerSymbol5 = $this->data['Resource']['company4'];
            $TickerSymbol6 = $this->data['Resource']['company5'];
            $TickerSymbol7 = $this->data['Resource']['company6'];
            $TickerSymbol8 = $this->data['Resource']['company7'];
            $TickerSymbol9 = $this->data['Resource']['company8'];
            $inv           = $this->data['Resource']['inv'];
            
        } 
		
        else
        {  
			$TickerSymbol1 = $exist[0]['settingmonitors']['symbol1'];
			$TickerSymbol2 = $exist[0]['settingmonitors']['symbol2'];
			$TickerSymbol3 = $exist[0]['settingmonitors']['symbol3'];
			$TickerSymbol4 = $exist[0]['settingmonitors']['symbol4'];
			$TickerSymbol5 = $exist[0]['settingmonitors']['symbol5'];
			$TickerSymbol6 = $exist[0]['settingmonitors']['symbol6'];
			$TickerSymbol7 = $exist[0]['settingmonitors']['symbol7'];
			$TickerSymbol8 = $exist[0]['settingmonitors']['symbol8'];
			$TickerSymbol9 = $exist[0]['settingmonitors']['symbol9'];
            $inv           = $exist[0]['settingmonitors']['interval'];
        }
			
			
            $this->set ( 'TickerSymbol1', $TickerSymbol1 );
			$this->set ( 'TickerSymbol2', $TickerSymbol2 );
			$this->set ( 'TickerSymbol3', $TickerSymbol3 );
			$this->set ( 'TickerSymbol4', $TickerSymbol4 );
			$this->set ( 'TickerSymbol5', $TickerSymbol5 );
			$this->set ( 'TickerSymbol6', $TickerSymbol6 );
			$this->set ( 'TickerSymbol7', $TickerSymbol7 );
			$this->set ( 'TickerSymbol8', $TickerSymbol8 );
			$this->set ( 'TickerSymbol9', $TickerSymbol9 );
           
		
		
		$this->set ( 'symbol_list', $this->FrontsideMenu->symbolList );
		$this->set ( 'inv', $inv );
	}
    function monitor1() {
        if (! $this->Session->check ( 'Auth.User' )) {
            $this->Session->setFlash ( 'You are not authorized to access that location.' );
            $this->redirect ( array ('controller' => 'users', 'action' => 'login' ) );
        }
        $this->layout = 'default-two';
        $this->pageTitle = 'Stock Bangladesh :: Watch the price movement of selected share';
        $userId = $this->Session->read('Auth.User.id'); 
        $sql = "SELECT * FROM `settingmonitors` WHERE user_id=".$userId ;
        $exist = $this->Symbol->query($sql);
        
        //echo "<pre>";
        //print_r($exist);die;
        
        if(!empty($this->data))
        {
            $TickerSymbol1 = $this->data['Resource']['company0'];
            $TickerSymbol2 = $this->data['Resource']['company1'];
            $TickerSymbol3 = $this->data['Resource']['company2'];
            $TickerSymbol4 = $this->data['Resource']['company3'];
            $TickerSymbol5 = $this->data['Resource']['company4'];
            $TickerSymbol6 = $this->data['Resource']['company5'];
            $TickerSymbol7 = $this->data['Resource']['company6'];
            $TickerSymbol8 = $this->data['Resource']['company7'];
            $TickerSymbol9 = $this->data['Resource']['company8'];
            $inv           = $this->data['Resource']['inv'];
            
        } 
        
        else
        {  
            $TickerSymbol1 = $exist[0]['settingmonitors']['symbol1'];
            $TickerSymbol2 = $exist[0]['settingmonitors']['symbol2'];
            $TickerSymbol3 = $exist[0]['settingmonitors']['symbol3'];
            $TickerSymbol4 = $exist[0]['settingmonitors']['symbol4'];
            $TickerSymbol5 = $exist[0]['settingmonitors']['symbol5'];
            $TickerSymbol6 = $exist[0]['settingmonitors']['symbol6'];
            $TickerSymbol7 = $exist[0]['settingmonitors']['symbol7'];
            $TickerSymbol8 = $exist[0]['settingmonitors']['symbol8'];
            $TickerSymbol9 = $exist[0]['settingmonitors']['symbol9'];
            $inv           = $exist[0]['settingmonitors']['interval'];
        }
            
            
            $this->set ( 'TickerSymbol1', $TickerSymbol1 );
            $this->set ( 'TickerSymbol2', $TickerSymbol2 );
            $this->set ( 'TickerSymbol3', $TickerSymbol3 );
            $this->set ( 'TickerSymbol4', $TickerSymbol4 );
            $this->set ( 'TickerSymbol5', $TickerSymbol5 );
            $this->set ( 'TickerSymbol6', $TickerSymbol6 );
            $this->set ( 'TickerSymbol7', $TickerSymbol7 );
            $this->set ( 'TickerSymbol8', $TickerSymbol8 );
            $this->set ( 'TickerSymbol9', $TickerSymbol9 );
           
        
        
        $this->set ( 'symbol_list', $this->FrontsideMenu->symbolList );
        $this->set ( 'inv', $inv );
    }
    
	/*
    *   To Generate Data Matrix From Portfolio
    */
    function portfoliodatamatrix() {
        $this->layout = 'default-two';
        $this->pageTitle = 'Stock Bangladesh :: Watch the price movement of selected share';
        $userId = $this->Session->read('Auth.User.id'); 
        $sql = "SELECT * FROM `settingmonitors` WHERE user_id=".$userId ;
        $exist = $this->Symbol->query($sql);
        /*echo "<pre>";
        print_r($_REQUEST);
        echo "</pre>";
        die;*/
        $namesql = "SHOW COLUMNS FROM datamatrix_default_head";
        $dsecode = mysql_query($namesql);
        $header = array();
        while($colms = mysql_fetch_assoc($dsecode))
        {            
            $header[] = $colms['Field'];
          //echo '<br>';  
        }
        
        $this->set('header',$header);
        
        $saveHead = $this->Datatitlehead->find('all', array('conditions' => array('user_id ='.$userId), 'fields' => array()));        
        //echo $saveHead['Datatitlehead']['code'];
         $headList = array();
        if(!empty($saveHead))
        {
            for($i=3;$i<count($header);$i++)
            {
                $headList[$header[$i]] = $saveHead[0]['Datatitlehead'][$header[$i]];
            }
            //$this->set('selectedTitle',$headList);
            
        }
        //pr($headList);
        if(!empty($headList))
        {
            
            $this->set('selectedTitle',$headList);
            //pr('full'.$headList) ;die;
            
        }
        else
        {
            for($i=3;$i<count($header);$i++)
                {
                    $headList[$header[$i]] = 1;
                }
                
                $this->set('selectedTitle',$headList);
               // pr('empty'.$headList) ;die;
        }
        if(!empty($this->data))
        {
            $count         = $this->data['Resource']['count'];
            $TickerSymbol  = array(); 
            for($i = 0; $i < $count; $i++ )
            {
                $TickerSymbol[] = $this->data['Resource']['company'.$i];
            }            
        }
        $this->set ( 'company_list', $TickerSymbol ); 
        /*echo "<pre>";
        print_r($_REQUEST);
        print_r($TickerSymbol);
        echo "</pre>";
        die;*/
        
       
    }
    
    function getpricelistforportfolio() {

       $userId = $this->Session->read('Auth.User.id');
       
       //$selectedcompany = $this->Datasetting->find('all', array('conditions' => array('user_id ='.$userId), 'fields' => array('symbol_id')));        
       // ----------------------------------------------------------------
       
       $portfolioInfo = mysql_fetch_assoc(mysql_query("SELECT * FROM portfolios WHERE user_id=".$userId));
       //$portfolioInfo = $this->Portfolio->find('first', array('conditions' => array('user_id='.$userId)));
       $allShareQRY = mysql_query("SELECT * FROM portfolio_shares WHERE is_active=1 AND protfolio_id=".$portfolioInfo['id']);
       //echo "<pre>";
       //print_r($portfolioInfo);
       $company_list = array();
       if(mysql_num_rows($allShareQRY))
       {
            while($allShare = mysql_fetch_assoc($allShareQRY))
           {
               $symbol_id      = $allShare['symbol_id'];
               $code           = mysql_fetch_assoc(mysql_query("SELECT * FROM  symbols WHERE id=".$symbol_id));               
               $company_list[$code['id']] = $code['dse_code']; 
           }
       }
       //echo "<pre>";
//       print_r($company_list); die;
       
       
       
       if(count($company_list))
       {
            $result = array();
            foreach($company_list as $key=>$company)
            {   
                $result[] = $this->Symbol->find('all', array('conditions' => array('id='.$key)));
            }
            //echo "<pre>";
//            print_r($result); die;
            
            if (count ( $result )) 
            {            
                $arrall = array ();            
                $lastTradePriceList = $this->Symbol->find ( 'list', array ('fields' => array ('id', 'lasttradeprice' ) ) );
                $ycloseList = $this->Symbol->find ( 'list', array ('fields' => array ('id', 'yclose' ) ) );

                $sql = "SELECT * FROM outputs USE INDEX (symbol) ORDER BY id DESC LIMIT 0, 400";
            
                if (class_exists ( 'Memcache' )) 
                {
                    $memcache = new Memcache ( );
                    $memcache->connect ( 'localhost', 11211 ) or die ( "Could not connect" );
                    $memKey2 = md5 ( 'org_resoures_getpricelist_1' );
                    if (! $memcache->get ( $memKey2 )) 
                    {                        
                        $resultArr = $this->Symbol->query ( $sql );                        
                        $memcache->set ( $memKey2, $resultArr, MEMCACHE_COMPRESSED, 60 );
                    }                    
                    $resultArr = $memcache->get ( $memKey2 );

                } 
                else 
                {                
                    $resultArr = $this->Symbol->query ( $sql );
                }
                
                
                $resultArr    = $this->Symbol->query ( $sql ); 
                //echo "<pre>";
//                print_r($resultArr); die;          
                $lastday      = $resultArr [0] ['outputs'] ['date'];
                $lastdaystamp = strtotime ( $lastday );
                //echo "<pre>";
//                print_r($lastdaystamp); die;          
                $resultArr    = array_reverse ( $resultArr );
                $sortedResult = array ();

                foreach ( $resultArr as $res ) 
                {
                    if ($res ['outputs'] ['symbol'] > 1 && $res ['outputs'] ['tradevalues'] != 0 && $res ['outputs'] ['daystamp'] >= $lastdaystamp) {
                        $res ['outputs'] ['lastprice'] = $lastTradePriceList [$res ['outputs'] ['symbol']];
                        $res ['outputs'] ['yclose']    = $ycloseList [$res ['outputs'] ['symbol']];

                        $companyFinPerf       = "SELECT * FROM `company_financial_performance` WHERE `symbol_id`='".$res ['outputs'] ['symbol']."' and asset_val_per_share!=''  ORDER BY  fin_year DESC LIMIT 1";
                        $companyFinPerfResult = $this->Symbol->query($companyFinPerf);
                       
                        $res ['outputs'] ['asset_val_per_share']    = $companyFinPerfResult[0]['company_financial_performance']['asset_val_per_share'];
                        $sortedResult [$res ['outputs'] ['symbol']] = $res;



                    }
                    

                } 
                //echo "<pre>";
                //print_r($resultArr);
                //die;
                $coreDataCount = 1;
                foreach ( $result as $row ) {
                    $qeps = 0;
                    $symbol = $row[0] ['Symbol'] ['id'];
                    $factor = 1;
                    if ($row [0]['Symbol'] ['q1']) {
                        $qeps = $row [0]['Symbol'] ['q1'];
                        $factor = 4;
                    }
                    if ($row[0] ['Symbol'] ['q2']) {
                        $qeps = $row [0]['Symbol'] ['q2'];
                        $factor = 2;
                    }
                    if ($row [0]['Symbol'] ['q3']) {
                        $qeps = $row [0]['Symbol'] ['q3'];
                        $factor = 4 / 3;
                    }
                    if ($row [0]['Symbol'] ['q4']) {
                        $qeps = $row [0]['Symbol'] ['q4'];
                        $factor = 1;
                    }
                    $annualizedEPS = $qeps * $factor;
                    //if(isset($sortedResult[$symbol]['outputs']['lastprice']) && $annualizedEPS !=0)
                    if (isset ( $sortedResult [$symbol] ['outputs'] ['lastprice'] )) {
                        $coredata ['id'] = $row [0]['Symbol'] ['id'];
                        $coredata ['id'] = $coreDataCount ++;
                        $coredata ['code'] = trim ( $row [0]['Symbol'] ['dse_code'] );
                        if($coredata ['code']=='DELTALIFE'){
                            $coredata ['sector'] = 'Life Insurance';
                        }else if($coredata ['code']=='FAREASTLIF'){
                            $coredata ['sector'] = 'Life Insurance';
                        }else if($coredata ['code']=='MEGHNALIFE'){
                            $coredata ['sector'] = 'Life Insurance';
                        }else if($coredata ['code']=='NATLIFEINS'){
                            $coredata ['sector'] = 'Life Insurance';
                        }else if($coredata ['code']=='POPULARLIF'){
                            $coredata ['sector'] = 'Life Insurance';
                        }else if($coredata ['code']=='PRAGATILIF'){
                            $coredata ['sector'] = 'Life Insurance';
                        }else if($coredata ['code']=='PRIMELIFE'){
                            $coredata ['sector'] = 'Life Insurance';
                        }else if($coredata ['code']=='PROGRESLIF'){
                            $coredata ['sector'] = 'Life Insurance';
                        }else if($coredata ['code']=='RUPALILIFE'){
                            $coredata ['sector'] = 'Life Insurance';
                        }else if($coredata ['code']=='SANDHANINS'){
                            $coredata ['sector'] = 'Life Insurance';
                        }else if($coredata ['code']=='SUNLIFEINS'){
                            $coredata ['sector'] = 'Life Insurance';
                        }else{
                            $coredata ['sector'] = trim ( $row [0]['Symbol'] ['business_segment'] );
                        }


                        $coredata ['category'] = $row [0]['Symbol'] ['category'];

                        $coredata ['market_lot'] = $row [0]['Symbol'] ['market_lot'];

                        $coredata ['face_value'] = $row [0]['Symbol'] ['face_value'];

                        $coredata ['nav'] = $sortedResult [$symbol] ['outputs'] ['asset_val_per_share'];

                        $coredata ['lastprice'] = round ( $sortedResult [$symbol] ['outputs'] ['lastprice'], 2 );

                        $coredata ['open'] = round ( $sortedResult [$symbol] ['outputs'] ['open'], 2 );

                        $coredata ['high'] = round ( $sortedResult [$symbol] ['outputs'] ['high'], 2 );

                        $coredata ['low'] = round ( $sortedResult [$symbol] ['outputs'] ['low'], 2 );

                        $coredata ['volume'] = $sortedResult [$symbol] ['outputs'] ['volume'] + 0;

                        $coredata ['value'] = round ( $sortedResult [$symbol] ['outputs'] ['tradevalues'], 2 );
                        
                        $coredata ['lastprice'] = round ( $sortedResult [$symbol] ['outputs'] ['lastprice'], 2 );

                        $coredata ['trade'] = $sortedResult [$symbol] ['outputs'] ['trade'];

                        $totalChangePer = (($sortedResult [$symbol] ['outputs'] ['lastprice'] - $sortedResult [$symbol] ['outputs'] ['yclose']) / $sortedResult [$symbol] ['outputs'] ['yclose']) * 100;
                        
                        $totalChangePer = round ( $totalChangePer, 2 );

                        $coredata ['pchange'] = $totalChangePer;



                        if ($annualizedEPS == 0)

                        $pe = 0;

                        else

                        $pe = $sortedResult [$symbol] ['outputs'] ['lastprice'] / $annualizedEPS;



                        $coredata ['pe'] = round ( $pe, 2 );
                        $ratio = $coredata ['volume']/$coredata ['trade'];
                        $coredata ['ratio'] = round($ratio,2); 

                        $arrall [] = $coredata;

                    }

                }

                $arr = $arrall;
                //echo "<pre>";
//                print_r($arr);
//                die;

                $jsonresult = $this->__JEncode ( $arr );

                echo '({"total":"' . count ( $result ) . '","results":' . $jsonresult . '})';

            } else {

                echo '({"total":"0", "results":""})';

            }
            
       }
   
        else
        { 
            $result = $this->Symbol->find ( 'all' );

            if (count ( $result )) 
            {
            
            $arrall = array ();
            
            $lastTradePriceList = $this->Symbol->find ( 'list', array ('fields' => array ('id', 'lasttradeprice' ) ) );

            $ycloseList = $this->Symbol->find ( 'list', array ('fields' => array ('id', 'yclose' ) ) );

            $sql = "SELECT * FROM outputs USE INDEX (symbol) ORDER BY id DESC LIMIT 0, 400";
            //*$sql = "SELECT *,UNIX_TIMESTAMP(str_to_date(date, '%d-%c-%Y')) FROM stocknet_plugin.eod USE INDEX (symbol) ORDER BY id DESC LIMIT 0, 244";
            /*--- FIRST USE OF MEMCACHE :: START HERE ---*/
            if (class_exists ( 'Memcache' )) {                 
                $memcache = new Memcache ( );

                $memcache->connect ( 'localhost', 11211 ) or die ( "Could not connect" );

                $memKey2 = md5 ( 'org_resoures_getpricelist_1' );

                if (! $memcache->get ( $memKey2 )) {
                    //echo '--not set--';
                    $resultArr = $this->Symbol->query ( $sql );
                    //*$resultArr = mysql_query ( $sql, $AMILink );
                    $memcache->set ( $memKey2, $resultArr, MEMCACHE_COMPRESSED, 60 );

                }

                //echo 'set';
                $resultArr = $memcache->get ( $memKey2 );

            } else {

                //*$resultArr = mysql_query ( $sql, $AMILink );
                $resultArr = $this->Symbol->query ( $sql );

            }

            /*--- FIRST USE OF MEMCACHE :: END HERE ---*/
            //*$resultArr = mysql_query ( $sql, $AMILink );
            $resultArr = $this->Symbol->query ( $sql );
            
            //pr($resultArr); die;

            /*$resultinfo = array();
            while($eachrow = mysql_fetch_row($resultArr))
              {
                  $resultinfo[] = $eachrow;
                  
              } for */
            
           
            $lastday = $resultArr [0] ['outputs'] ['date'];
            //pr($lastday);
            $lastdaystamp = strtotime ( $lastday );
            //pr($lastdaystamp); die;
            
            

            $resultArr = array_reverse ( $resultArr );
             //pr($resultArr);die;
            
            //pr($lastdaystamp);
            $sortedResult = array ();

            foreach ( $resultArr as $res ) {
                
                //pr($res [1]);
                //pr($res[13]);
                
                
                if ($res ['outputs'] ['symbol'] > 1 && $res ['outputs'] ['tradevalues'] != 0 && $res ['outputs'] ['daystamp'] >= $lastdaystamp) {
                    $res ['outputs'] ['lastprice'] = $lastTradePriceList [$res ['outputs'] ['symbol']];
                    $res ['outputs'] ['yclose'] = $ycloseList [$res ['outputs'] ['symbol']];

                    $companyFinPerf = "SELECT * FROM `company_financial_performance` WHERE `symbol_id`='".$res ['outputs'] ['symbol']."' and asset_val_per_share!=''  ORDER BY  fin_year DESC LIMIT 1";
                    $companyFinPerfResult = $this->Symbol->query($companyFinPerf);
                   
                    $res ['outputs'] ['asset_val_per_share'] = $companyFinPerfResult[0]['company_financial_performance']['asset_val_per_share'];
                    $sortedResult [$res ['outputs'] ['symbol']] = $res;



                }
                

            } 


             
            //echo count($sortedResult); die;
            $coreDataCount = 1;

            //pr($sortedResult); die;
            
            //pr($result); die;

            foreach ( $result as $row ) {



                $qeps = 0;

                $symbol = $row ['Symbol'] ['id'];

                $factor = 1;

                if ($row ['Symbol'] ['q1']) {

                    $qeps = $row ['Symbol'] ['q1'];

                    $factor = 4;

                }

                if ($row ['Symbol'] ['q2']) {

                    $qeps = $row ['Symbol'] ['q2'];

                    $factor = 2;

                }

                if ($row ['Symbol'] ['q3']) {

                    $qeps = $row ['Symbol'] ['q3'];

                    $factor = 4 / 3;

                }

                if ($row ['Symbol'] ['q4']) {

                    $qeps = $row ['Symbol'] ['q4'];

                    $factor = 1;

                }

                $annualizedEPS = $qeps * $factor;



                //if(isset($sortedResult[$symbol]['outputs']['lastprice']) && $annualizedEPS !=0)
                if (isset ( $sortedResult [$symbol] ['outputs'] ['lastprice'] )) {

                    $coredata ['id'] = $row ['Symbol'] ['id'];

                    $coredata ['id'] = $coreDataCount ++;

                    $coredata ['code'] = trim ( $row ['Symbol'] ['dse_code'] );

                    if($coredata ['code']=='DELTALIFE'){
                        $coredata ['sector'] = 'Life Insurance';
                    }else if($coredata ['code']=='FAREASTLIF'){
                        $coredata ['sector'] = 'Life Insurance';
                    }else if($coredata ['code']=='MEGHNALIFE'){
                        $coredata ['sector'] = 'Life Insurance';
                    }else if($coredata ['code']=='NATLIFEINS'){
                        $coredata ['sector'] = 'Life Insurance';
                    }else if($coredata ['code']=='POPULARLIF'){
                        $coredata ['sector'] = 'Life Insurance';
                    }else if($coredata ['code']=='PRAGATILIF'){
                        $coredata ['sector'] = 'Life Insurance';
                    }else if($coredata ['code']=='PRIMELIFE'){
                        $coredata ['sector'] = 'Life Insurance';
                    }else if($coredata ['code']=='PROGRESLIF'){
                        $coredata ['sector'] = 'Life Insurance';
                    }else if($coredata ['code']=='RUPALILIFE'){
                        $coredata ['sector'] = 'Life Insurance';
                    }else if($coredata ['code']=='SANDHANINS'){
                        $coredata ['sector'] = 'Life Insurance';
                    }else if($coredata ['code']=='SUNLIFEINS'){
                        $coredata ['sector'] = 'Life Insurance';
                    }else{
                        $coredata ['sector'] = trim ( $row ['Symbol'] ['business_segment'] );
                    }


                    $coredata ['category'] = $row ['Symbol'] ['category'];

                    $coredata ['market_lot'] = $row ['Symbol'] ['market_lot'];

                    $coredata ['face_value'] = $row ['Symbol'] ['face_value'];

                    $coredata ['nav'] = $sortedResult [$symbol] ['outputs'] ['asset_val_per_share'];

                    $coredata ['lastprice'] = round ( $sortedResult [$symbol] ['outputs'] ['lastprice'], 2 );

                    $coredata ['open'] = round ( $sortedResult [$symbol] ['outputs'] ['open'], 2 );

                    $coredata ['high'] = round ( $sortedResult [$symbol] ['outputs'] ['high'], 2 );

                    $coredata ['low'] = round ( $sortedResult [$symbol] ['outputs'] ['low'], 2 );

                    $coredata ['volume'] = $sortedResult [$symbol] ['outputs'] ['volume'] + 0;

                    $coredata ['value'] = round ( $sortedResult [$symbol] ['outputs'] ['tradevalues'], 2 );
                    
                    $coredata ['lastprice'] = round ( $sortedResult [$symbol] ['outputs'] ['lastprice'], 2 );

                    $coredata ['trade'] = $sortedResult [$symbol] ['outputs'] ['trade'];

                    $totalChangePer = (($sortedResult [$symbol] ['outputs'] ['lastprice'] - $sortedResult [$symbol] ['outputs'] ['yclose']) / $sortedResult [$symbol] ['outputs'] ['yclose']) * 100;
                    
                    $totalChangePer = round ( $totalChangePer, 2 );

                    $coredata ['pchange'] = $totalChangePer;



                    if ($annualizedEPS == 0)

                    $pe = 0;

                    else

                    $pe = $sortedResult [$symbol] ['outputs'] ['lastprice'] / $annualizedEPS;



                    $coredata ['pe'] = round ( $pe, 2 );
                    $ratio = $coredata ['volume']/$coredata ['trade'];
                    $coredata ['ratio'] = round($ratio,2); 

                    $arrall [] = $coredata;

                }

            }

            $arr = $arrall;

            $jsonresult = $this->__JEncode ( $arr );

            echo '({"total":"' . count ( $result ) . '","results":' . $jsonresult . '})';

        } else {

            echo '({"total":"0", "results":""})';

        }
       }

        die ();

    }
    
	/*
    *   To Generate Market Monitor    
    */
	function genchart() {
		$this->layout = 'default-two';
		$this->pageTitle = 'Stock Bangladesh :: Watch the price movement of selected share';
		
		App::import ( 'Vendor', 'json', array ('file' => 'JSON.php' ) );
		
		if (isset ( $_POST ) && ! empty ( $_POST )) {
			$TickerSymbol1 = $_POST ['TickerSymbol1'];
			$TickerSymbol2 = $_POST ['TickerSymbol2'];
			$TickerSymbol3 = $_POST ['TickerSymbol3'];
			$TickerSymbol4 = $_POST ['TickerSymbol4'];
			$TickerSymbol5 = $_POST ['TickerSymbol5'];
			$TickerSymbol6 = $_POST ['TickerSymbol6'];
			$TickerSymbol7 = $_POST ['TickerSymbol7'];
			$TickerSymbol8 = $_POST ['TickerSymbol8'];
			$TickerSymbol9 = $_POST ['TickerSymbol9'];
			
			if (isset ( $_POST ['inv'] )) {
				$inv = $_POST ['inv'];
			} else {
				$inv = 300;
			}
            
            if($_POST['submit']=='Submit')
            {
                $this->set ( 'TickerSymbol1', $TickerSymbol1 );
			    $this->set ( 'TickerSymbol2', $TickerSymbol2 );
			    $this->set ( 'TickerSymbol3', $TickerSymbol3 );
			    $this->set ( 'TickerSymbol4', $TickerSymbol4 );
			    $this->set ( 'TickerSymbol5', $TickerSymbol5 );
			    $this->set ( 'TickerSymbol6', $TickerSymbol6 );
			    $this->set ( 'TickerSymbol7', $TickerSymbol7 );
			    $this->set ( 'TickerSymbol8', $TickerSymbol8 );
			    $this->set ( 'TickerSymbol9', $TickerSymbol9 );
		   }
           else
           {
               $userId = $this->Session->read('Auth.User.id'); 
               //$sql = "UPDATE `course_certificates` SET participant_id= '$participant_id', is_certified = '1'  WHERE id =".$c_id ;
               $sql = "SELECT * FROM `settingmonitors` WHERE user_id=".$userId ;
               $exist = $this->Symbol->query($sql);
                   if(!empty($exist))
                   {
                       $updatesql = "UPDATE `settingmonitors` SET `symbol1` = '$TickerSymbol1', `symbol2` = '$TickerSymbol2', `symbol3`= '$TickerSymbol3', `symbol4` = '$TickerSymbol4', `symbol5` = '$TickerSymbol5', `symbol6` = '$TickerSymbol6', `symbol7` = '$TickerSymbol7', `symbol8` = '$TickerSymbol8', `symbol9` = '$TickerSymbol9', `interval` = '$inv' WHERE `user_id`=".$userId;
                       //pr($updatesql);
                       if($this->Symbol->query($updatesql));
                       $this->Session->setflash('Selection saved');
                   }
                   else{
                       $insertsql = "INSERT INTO `settingmonitors` ( `id` , `symbol1` , `symbol2` , `symbol3`, `symbol4` , `symbol5` , `symbol6`, `symbol7`, `symbol8`, `symbol9`, `interval`, `user_id`)                    
                            VALUES (NULL , '$TickerSymbol1', '$TickerSymbol2', '$TickerSymbol3','$TickerSymbol4', '$TickerSymbol5', '$TickerSymbol6' ,'$TickerSymbol7' ,'$TickerSymbol8' ,'$TickerSymbol9', '$inv', '$userId');";
                       if($this->Symbol->query($insertsql ));
                       $this->Session->setflash('Selection saved');
                   }
                   
               $this->set ( 'TickerSymbol1', $TickerSymbol1 );
                $this->set ( 'TickerSymbol2', $TickerSymbol2 );
                $this->set ( 'TickerSymbol3', $TickerSymbol3 );
                $this->set ( 'TickerSymbol4', $TickerSymbol4 );
                $this->set ( 'TickerSymbol5', $TickerSymbol5 );
                $this->set ( 'TickerSymbol6', $TickerSymbol6 );
                $this->set ( 'TickerSymbol7', $TickerSymbol7 );
                $this->set ( 'TickerSymbol8', $TickerSymbol8 );
                $this->set ( 'TickerSymbol9', $TickerSymbol9 );
           }
        }
		$this->set ( 'inv', $inv );
	}
    function genchart1() {
        $this->layout = 'default-two';
        $this->pageTitle = 'Stock Bangladesh :: Watch the price movement of selected share';
        
        App::import ( 'Vendor', 'json', array ('file' => 'JSON.php' ) );
        
        if (isset ( $_POST ) && ! empty ( $_POST )) {
            $TickerSymbol1 = $_POST ['TickerSymbol1'];
            $TickerSymbol2 = $_POST ['TickerSymbol2'];
            $TickerSymbol3 = $_POST ['TickerSymbol3'];
            $TickerSymbol4 = $_POST ['TickerSymbol4'];
            $TickerSymbol5 = $_POST ['TickerSymbol5'];
            $TickerSymbol6 = $_POST ['TickerSymbol6'];
            $TickerSymbol7 = $_POST ['TickerSymbol7'];
            $TickerSymbol8 = $_POST ['TickerSymbol8'];
            $TickerSymbol9 = $_POST ['TickerSymbol9'];
            
            if (isset ( $_POST ['inv'] )) {
                $inv = $_POST ['inv'];
            } else {
                $inv = 300;
            }
            
            if($_POST['submit']=='Submit')
            {
                $this->set ( 'TickerSymbol1', $TickerSymbol1 );
                $this->set ( 'TickerSymbol2', $TickerSymbol2 );
                $this->set ( 'TickerSymbol3', $TickerSymbol3 );
                $this->set ( 'TickerSymbol4', $TickerSymbol4 );
                $this->set ( 'TickerSymbol5', $TickerSymbol5 );
                $this->set ( 'TickerSymbol6', $TickerSymbol6 );
                $this->set ( 'TickerSymbol7', $TickerSymbol7 );
                $this->set ( 'TickerSymbol8', $TickerSymbol8 );
                $this->set ( 'TickerSymbol9', $TickerSymbol9 );
           }
           else
           {
               $userId = $this->Session->read('Auth.User.id'); 
               //$sql = "UPDATE `course_certificates` SET participant_id= '$participant_id', is_certified = '1'  WHERE id =".$c_id ;
               $sql = "SELECT * FROM `settingmonitors` WHERE user_id=".$userId ;
               $exist = $this->Symbol->query($sql);
                   if(!empty($exist))
                   {
                       $updatesql = "UPDATE `settingmonitors` SET `symbol1` = '$TickerSymbol1', `symbol2` = '$TickerSymbol2', `symbol3`= '$TickerSymbol3', `symbol4` = '$TickerSymbol4', `symbol5` = '$TickerSymbol5', `symbol6` = '$TickerSymbol6', `symbol7` = '$TickerSymbol7', `symbol8` = '$TickerSymbol8', `symbol9` = '$TickerSymbol9', `interval` = '$inv' WHERE `user_id`=".$userId;
                       //pr($updatesql);
                       if($this->Symbol->query($updatesql));
                       $this->Session->setflash('Selection saved');
                   }
                   else{
                       $insertsql = "INSERT INTO `settingmonitors` ( `id` , `symbol1` , `symbol2` , `symbol3`, `symbol4` , `symbol5` , `symbol6`, `symbol7`, `symbol8`, `symbol9`, `interval`, `user_id`)                    
                            VALUES (NULL , '$TickerSymbol1', '$TickerSymbol2', '$TickerSymbol3','$TickerSymbol4', '$TickerSymbol5', '$TickerSymbol6' ,'$TickerSymbol7' ,'$TickerSymbol8' ,'$TickerSymbol9', '$inv', '$userId');";
                       if($this->Symbol->query($insertsql ));
                       $this->Session->setflash('Selection saved');
                   }
                   
               $this->set ( 'TickerSymbol1', $TickerSymbol1 );
                $this->set ( 'TickerSymbol2', $TickerSymbol2 );
                $this->set ( 'TickerSymbol3', $TickerSymbol3 );
                $this->set ( 'TickerSymbol4', $TickerSymbol4 );
                $this->set ( 'TickerSymbol5', $TickerSymbol5 );
                $this->set ( 'TickerSymbol6', $TickerSymbol6 );
                $this->set ( 'TickerSymbol7', $TickerSymbol7 );
                $this->set ( 'TickerSymbol8', $TickerSymbol8 );
                $this->set ( 'TickerSymbol9', $TickerSymbol9 );
           }
        }
        $this->set ( 'inv', $inv );
    }
	
	/*
    *   To generate miunute chart as  monitor chart
    */
	function monitorchart() {
		$this->layout = 'default-one';
		$this->pageTitle = 'Stock Bangladesh :: Watch the price movement of selected share';
		
		$inv = 60;
		$inv1 = 300;
		if (isset ( $_GET ['TickerSymbol'] )) {
			$inv = $_GET ['inv'];
			
			$symbolInfo = $this->Symbol->find ( 'first', array ('conditions' => array ('id=' . $_GET ['TickerSymbol'] ), 'fields' => array ('Symbol.name' ) ) );
			$name = $symbolInfo ['Symbol'] ['name'];
			$name = ucwords ( strtolower ( $name ) );
			
			$this->set ( 'sym', $_GET ['TickerSymbol'] );
		}
		
		$this->set ( 'inv', $inv );
		$this->set ( 'inv1', $inv1 );
	}
	/*
    *   To generate rnd miunute chart
    */
	function mmminchart($dseChart = '') {

		App::import ( 'Vendor', 'Phpchartdir', array ('file' => 'phpchartdir.php' ) );

		require_once (WWW_ROOT . DS . 'chart' . DS . 'Image_Toolbox.class.php');



		$symbol = $_GET ['sym'];

		$symbol = trim ( $symbol );

		$interval = $_GET ['inv'];



		$symbolInfo = $this->Symbol->find ( 'first', array ('conditions' => array ('id=' . $symbol ), 'fields' => array ('Symbol.dse_code', 'Symbol.name' ) ) );



		$code = $symbolInfo ['Symbol'] ['dse_code'];

		$name = $symbolInfo ['Symbol'] ['name'];

		$minute = $interval / 60;



		if ($minute > 1) {

			$minute = $minute . ' Minutes Chart';

		} else {

			$minute = $minute . ' Minutes Chart';

		}



		$nameOfTheDay = date ( 'l' );

		if ($nameOfTheDay == 'Friday')

		$todayTimeStamp = mktime ( 0, 0, 0, date ( 'm' ), date ( 'd' ) - 1, date ( 'Y' ) );

		else if ($nameOfTheDay == 'Saturday')

		$todayTimeStamp = mktime ( 0, 0, 0, date ( 'm' ), date ( 'd' ) - 2, date ( 'Y' ) );

		else

		$todayTimeStamp = mktime ( 0, 0, 0, date ( 'm' ), date ( 'd' ), date ( 'Y' ) );



		//$todayTimeStamp = mktime(0, 0, 0, date('m'), date('d'), date('Y'));




		/*--- FIRST USE OF MEMCACHE :: START HERE ---*/

		if (class_exists ( 'Memcache' )) {



			$memcache = new Memcache ( );

			$memcache->connect ( 'localhost', 11211 ) or die ( "Could not connect" );



			$memKey3 = md5 ( 'select * from stockorg_stock.data_banks_intraday where symbol_id =' . $symbol . ' AND date >= ' . $todayTimeStamp . ' ORDER BY id DESC LIMIT 0, 400' );



			if (! $memcache->get ( $memKey3 )) {

				$shareData = $this->Symbol->query ( 'select * from stockorg_stock.data_banks_intraday where symbol_id =' . $symbol . ' AND date >= ' . $todayTimeStamp . ' ORDER BY id DESC LIMIT 0, 400' );

				$memcache->set ( $memKey3, $shareData, MEMCACHE_COMPRESSED, 60 );

			}



			$shareData = $memcache->get ( $memKey3 );

		} else {

			$shareData = $this->Symbol->query ( 'select * from stockorg_stock.data_banks_intraday where symbol_id =' . $symbol . ' AND date >= ' . $todayTimeStamp . ' ORDER BY id DESC LIMIT 0, 400' );

		}

		/*--- FIRST USE OF MEMCACHE :: END HERE ---*/



		$timeWiseArr = array ();
			$timeKeyArr  = array ();
			foreach ( $shareData as $row ) {
				$currenttime = $row ['data_banks_intraday'] ['date'];
				//$currenttime = $currenttime + (8*60*60);
				$mod = $currenttime % $interval;
				$timeToBeAccounted = $currenttime - $mod + $interval;
				//echo date('h:i A', $timeToBeAccounted).'<br><br>';
				$timeWiseArr [$timeToBeAccounted] [] = $row;
				$modtime = date ( 'd M  h:ia', $timeToBeAccounted );
			}

			//pr($timeWiseArr);
			$rowDataVolumeStart = 0;
			$rowDataVolumeEnd = 0;
			$currentDataVolume = 0;
			$tempVolumeCounter = 0;
			$totalArrayCount = count($timeWiseArr);
			$myDefinedCounter = 1;
			foreach ( $timeWiseArr as $key => $arr ) {
				$timeKeyArr [] = $key;
			}

			//pr($tempVolumeCounter);
			$finalArr = array ();
			$totalvolume = $shareData [0] ['data_banks_intraday'] ['volume'];
			$tradetimestamp = $shareData [0] ['data_banks_intraday'] ['date'];
			$dayhigh = $shareData [0] ['data_banks_intraday'] ['high'];
			$daylow = $shareData [0] ['data_banks_intraday'] ['low'];
			$totaltrade = $shareData [0] ['data_banks_intraday'] ['trade'];
			$yclose=$shareData [0] ['data_banks_intraday'] ['yclose'];

			$tradeDate = date ( 'd M y h:ia', $tradetimestamp );
			$i = 0;
			$singleCount = 0;
			$finalPrice = 0;
			//pr($timeWiseArr);
			$startPrice = 0;
			$endPrice = 0;
			foreach ( $timeWiseArr as $key => $arr ) {
				$datetime = date ( 'h:i A', $key );
				$temp = array ();
				$startArr = array ();
				$endArr = array ();
				$ind = count ( $arr );
				$counterArr = count($arr);
				$finalPrice = $arr[0]['data_banks_intraday']['close'];


				if(!$rowDataVolumeStart) {
					$rowDataVolumeStart = $arr[0]['data_banks_intraday']['volume'];
					$startPrice = $arr[0]['data_banks_intraday']['close'];
				}

				if($myDefinedCounter==$totalArrayCount){
					$rowDataVolumeEnd  =0;
					$endPrice = $arr[0]['data_banks_intraday']['yclose'];
				}else {
					$rowDataVolumeEnd = $arr[$counterArr-1]['data_banks_intraday']['volume'];
					$endPrice = $arr[0]['data_banks_intraday']['close'];
				}

				//$endArr ['data_banks_intraday'] ['lastprice'];
				if ($ind == 1) {
					$startArr = $arr [$ind - 1];
					$endArr = $arr [$ind - 1];

					if (isset ( $timeKeyArr [$i + 1] )) {
						$time = $timeKeyArr [$i + 1];
						$endvolume = $timeWiseArr [$time] [0] ['data_banks_intraday'] ['volume'];
					} else {
						$endvolume = 0;
					}
					$startvolume = $startArr ['data_banks_intraday'] ['volume'];
				} else {

					//$startArr = $arr [0];
					if (isset ( $timeKeyArr [$i] )) {
						$time = $timeKeyArr [$i];

						$preArrInd = count ($timeWiseArr [$time] );

						$startvolume = $timeWiseArr [$time] [0] ['data_banks_intraday'] ['volume'];
						//pr("found");
					} else {
						$startvolume = 0;
						//pr('NO');
					}
					$endArr = $arr [$ind - 1];
					if (isset ( $endArr )) {
						$endvolume = $endArr ['data_banks_intraday'] ['volume'];
					} else {
						$endvolume = 0;
					}
				}
				//pr($startvolume);
				//$temp ['ltp'] = $endArr ['data_banks_intraday'] ['lastprice'];
				$temp ['ltp'] = $finalPrice;
				$finalPrice = $arr[$counterArr-1]['data_banks_intraday']['lastprice'];
				//$temp['open']      = $endArr['data_banks_intraday']['open'];
				$temp ['high'] = $endArr ['data_banks_intraday'] ['high'];
				$temp ['low'] = $endArr ['data_banks_intraday'] ['low'];
				$temp ['close'] = $endArr ['data_banks_intraday'] ['close'];
				$temp ['yclose'] = $endArr ['data_banks_intraday'] ['yclose'];
				$temp ['trade'] = $endArr ['data_banks_intraday'] ['trade'];
				//$tempVolumeCounter += $rowDataVolumeStart - $rowDataVolumeEnd;
				//$temp ['volume'] = $finalVolume;
				//$finalVolume =  $rowDataVolumeStart - $rowDataVolumeEnd;
				$temp ['volume'] = $rowDataVolumeStart - $rowDataVolumeEnd;
				//$temp ['volume'] = $startvolume - $endvolume;
				if($startPrice > $endPrice){
					$myPositiveCounter += $temp ['volume'];

				}else {
					$myNegativeCounter += $temp ['volume'];
				}
				$rowDataVolumeStart = $rowDataVolumeEnd;
				$startPrice = $endPrice;
				$myDefinedCounter++;
				//$totalVolumeCompared+= $temp ['volume'];
				$temp ['value'] = $endArr ['data_banks_intraday'] ['value'];
				$temp ['datetime'] = $datetime;
				$temp ['idatetime'] = $key;
				$finalArr [] = $temp;
				++ $i;
			}


			//pr("Positive".$myPositiveCounter);
			//pr("Negative".$myNegativeCounter);
			$xdata = array ();
			$ydata = array ();
			$vdata = array ();
		//$totalbar = count($finalArr);



$j = 0;
		foreach ( $finalArr as $row ) {

			$tempvolume = $row ['volume'];

			if ($tempvolume < 0) {

				continue;

			}



			if ($j > 15)

			break;



			$xdata [] = $row ['ltp'];

			$vdata [] = $row ['volume'];

			$ydata [] = $row ['datetime'];



			$j ++;

		}



		$xdata = array_reverse ( $xdata );

		$ydata = array_reverse ( $ydata );

		$vdata = array_reverse ( $vdata );



		$max = 50;



		$lastprice = $xdata [count ( $xdata ) - 1];

		$lasttime = $ydata [count ( $ydata ) - 1];

		$lastvolume = $vdata [count ( $vdata ) - 1];

array_unshift($vdata, 0);
			array_pop($vdata);

		# The data for the chart
		$data0 = $xdata;

		$data1 = $vdata;
//$data1[count($vdata)-1]=$lastvolume;
		$labels = $ydata;



		# Create a XYChart object of size 300 x 180 pixels
		$c = new XYChart ( 305, 290 );



		$c->setBackground ( $c->linearGradientColor ( 0, 0, 0, 290, 0xEFF1F2, 0xffffff ), 0xE3EFC2 );

		$c->setRoundedFrame ( 0xffffff, 0 );



		# Set the plot area at (50, 20) and of size 200 x 130 pixels
		$c->setPlotArea ( 39, 40, 195, 180, 0xffffff, - 1, - 1, $c->dashLineColor ( 0xaaaaaa, DotLine ), Transparent );



		$arialbdPath = WWW_ROOT . 'font' . DS . 'arialbd.ttf';

		# Add a title to the chart using 8 pts Arial Bold font
		$c->addTitle ( "$code  LTP-$lastprice    TOTAL VOL-$totalvolume", $arialbdPath, 8, 0x008000 );



		# Set the labels on the x axis.
		$c->xAxis->setLabels ( $labels );

		$c->xAxis->setLabelStyle ( "Arial", 8, TextColor, 90 );

		# Add a title to the primary (left) y axis
		$c->yAxis->setTitle ( "PRICE" );



		# Set the axis, label and title colors for the primary y axis to red (0xc00000) to
		# match the first data set
		$c->yAxis->setColors ( 0x008000, 0x008000, 0x008000 );



		# Add a title to the secondary (right) y axis
		$c->yAxis2->setTitle ( "VOLUME" );



		# set the axis, label and title colors for the primary y axis to green (0x008000) to
		# match the second data set
		$c->yAxis2->setColors ( 0x008000, 0x008000, 0x008000 );



		# Add a line layer to the chart
		$layer = $c->addLineLayer ();



		# Add the first line. Plot the points with a 7 pixel square symbol
		$dataSetObj = $layer->addDataSet ( $data0, 0xcf4040, "Price" );

		$dataSetObj->setDataSymbol ( SquareSymbol, 5 );



		$barLayerObj = $c->addBarLayer3 ( $data1 );

		$barLayerObj->setBarShape ( CircleShape );



		$barLayerObj->setUseYAxis2 ();



		$chartData = $c->makeChart2 ( PNG );
        print($chartData);
/*

		$chartImagePath = WWW_ROOT . 'chart' . DS . 'mm_chart.png';

		$f = fopen ( $chartImagePath, "wb" );

		fwrite ( $f, $chartData );

		fclose ( $f );



		$img = new Image_Toolbox ( $chartImagePath );



		$width = $img->_img ['main'] ['width'];



		$img->addImage ( $width, 10, '#FFFFFF' );

		$img->blendMask ( 'left', 'bottom', IMAGE_TOOLBOX_BLEND_COPY, 0, 280 );

		$img->output ();
		*/
		die();
	    }

        
	
	function itementry($errorMsg = '') {
		$this->layout = 'default-one';
		$this->pageTitle = 'Stock Bangladesh :: Modified Self Evaluation - Item Entry';
		
		if (! $this->Session->check ( 'Auth.User' )) {
			
			$this->Session->setFlash ( 'Please login again.' );
			$this->redirect ( array ('controller' => 'users', 'action' => 'login' ) );
		}
		$userId = $this->Session->read ( 'Auth.User.id' );
		
		$strUserACPs = "SELECT sum(point) as member_macp FROM simulations WHERE user_id='$userId';";
		$resultUserACPs = $this->Simulation->query ( $strUserACPs );
		
		$memberACPs = intval ( $resultUserACPs [0] [0] ['member_macp'] );
		$this->set ( 'memberACPs', $memberACPs );
		
		$this->set ( 'errorMsg', $errorMsg );
	}
	
	function itemconfirm() {
		$this->layout = 'default-one';
		$this->pageTitle = 'Stock Bangladesh :: Modified Self Evaluation - Item Confirm';
		
		if (! $this->Session->check ( 'Auth.User' )) {
			
			$this->Session->setFlash ( 'Please login again.' );
			$this->redirect ( array ('controller' => 'users', 'action' => 'login' ) );
		}
		$userId = $this->Session->read ( 'Auth.User.id' );
		
		$strUserACPs = "SELECT sum(point) as member_macp FROM simulations WHERE user_id='$userId';";
		$resultUserACPs = $this->Simulation->query ( $strUserACPs );
		
		$memberACPs = intval ( $resultUserACPs [0] [0] ['member_macp'] );
		$this->set ( 'memberACPs', $memberACPs );
		
		if (isset ( $_POST ['TickerSymbol'] ) && $_POST ['TickerSymbol'] != '' && $_POST ['ItemPrice'] && $_POST ['ItemPrice'] != '' && is_numeric ( $_POST ['ItemPrice'] )) {
			
			$resultUserACPs = $this->Symbol->query ( 'SELECT lasttradeprice FROM symbols WHERE id =' . $_POST ['TickerSymbol'] );
			//@shimul:  last trade price need to pick from symbol tables
			

			$lastTradePrice = $resultUserACPs [0] ['symbols'] ['lasttradeprice'];
			
			$this->set ( 'lastTradePrice', $lastTradePrice );
			$this->set ( 'TickerSymbol', $_POST ['TickerSymbol'] );
			$this->set ( 'ItemPrice', $_POST ['ItemPrice'] );
		} else {
			$this->Session->setFlash ( 'Try again.' );
			$this->redirect ( array ('action' => 'itementry' ) );
		}
	}
	
	function trynow() {
		$this->layout = 'default-one';
		$this->pageTitle = 'Stock Bangladesh :: Minute Chart - Price Chart/ Graph';
		
		if (! $this->Session->check ( 'Auth.User' )) {
			
			$this->Session->setFlash ( 'Please login again.' );
			$this->redirect ( array ('controller' => 'users', 'action' => 'login' ) );
		}
		$userId = $this->Session->read ( 'Auth.User.id' );
		
		$currentClosePrice = array ();
		$recommended_price = 0;
		$symbol = 0;
		$startDate = 0;
		
		if (isset ( $_POST ['TickerSymbol'] ) && $_POST ['TickerSymbol'] != '' && $_POST ['ItemPrice'] && $_POST ['ItemPrice'] != '' && is_numeric ( $_POST ['ItemPrice'] )) {
			$errorMsg = '';
			$symbol = $_POST ['TickerSymbol'];
			
			$recommandationType = 'Buy';
			$end_date = 12 * 60 * 60;
			$startDate = time () + 12 * 60 * 60;
			$recommended_price = $_POST ['ItemPrice'];
			settype ( $recommended_price, 'float' );
			
			$currentClosePrice = $this->Symbol->query ( 'SELECT name, lasttradeprice FROM symbols WHERE id=' . $symbol );
			
			$currentClosePrice = $currentClosePrice [0] ['symbols'];
			
			$is_active = 1;
			
			if ($recommandationType == 'Buy') {
				if ($currentClosePrice ['lasttradeprice'] > $recommended_price) {
					$errorMsg .= '<li>You have to choose a higher buy price than current price.<br />';
					$errorMsg .= 'At this moment ' . $currentClosePrice ['name'] . ' is trading at ' . $currentClosePrice ['lasttradeprice'] . ' Tk.<br />';
					$errorMsg .= 'You have chosen ' . $recommended_price . ' Tk.</li>';
				}
			} else {
				if ($currentClosePrice->close < $recommended_price) {
					$errorMsg .= '<li>You have to choose a lower sell price than current price.<br />';
					$errorMsg .= 'At this moment ' . $currentClosePrice ['name'] . ' is trading at ' . $currentClosePrice ['lasttradeprice'] . ' Tk.<br />';
					$errorMsg .= 'You have chosen ' . $recommended_price . ' Tk.</li>';
				}
			}
			
			$resultDuplicate = $this->Simulation->query ( "SELECT * FROM  `simulations` WHERE user_id='$userId' AND symbol='$symbol' AND TO_DAYS( FROM_UNIXTIME(start_date)) = TO_DAYS( FROM_UNIXTIME($startDate))" );
			
			if (! empty ( $resultDuplicate )) {
				$errorMsg .= "You have already tested this share today! ";
			}
			
			// calculate user ACP
			$resultUserACP = $this->Simulation->query ( "SELECT sum(point) as member_macp FROM simulations WHERE user_id='$userId'" );
			//pr($resultUserACP);
			

			$memberACP = intval ( $resultUserACP [0] [0] ['member_macp'] );
			
			if ($memberACP < - 300) {
				$errorMsg .= "Your ACP is below -300. You can not test any share! ";
			} else if ($memberACP < 1) {
				// check number of recommendation
				$rsNoRecommend = $this->Simulation->query ( "SELECT count(*) as cnt FROM `simulations` WHERE user_id='$userId' AND TO_DAYS( FROM_UNIXTIME(start_date)) =TO_DAYS( FROM_UNIXTIME($startDate))" );
				
				$this->set ( 'cntVal', ">>" . $rsNoRecommend [0] [0] ['cnt'] );
				
				if ($rsNoRecommend [0] [0] ['cnt']) {
					$errorMsg .= "You can test only one share per day! ";
				}
			} else {
				// check number of recommendation
				$rsNoRecommend = $this->Simulation->query ( "SELECT count(*) as cnt FROM `simulations` WHERE user_id='$userId' AND TO_DAYS( FROM_UNIXTIME(start_date)) =TO_DAYS( FROM_UNIXTIME($startDate))" );
				
				$this->set ( 'cntVal', ">>" . $rsNoRecommend [0] [0] ['cnt'] );
				
				if ($rsNoRecommend [0] [0] ['cnt'] > 4) {
					$errorMsg .= "You can test only five(5) shares per day!";
				}
			}
			
			if ($errorMsg == '') {
				$insertSimulationData = $this->Simulation->query ( "INSERT INTO `simulations` ( `id` , `user_id` , `symbol` , `start_date` , `end_date` , `recommended_price` ,`current_price`, `status` ,  `recommendation_type` ) VALUES (NULL , '$userId', '$symbol', '$startDate', '$end_date', '$recommended_price','$recommended_price', 'buy' ,'$recommandationType')" );
				
				$this->Session->setFlash ( 'You have bought your share successfully.' );
				$this->redirect ( array ('action' => 'selfevaluation' ) );
			}
			
			$this->redirect ( array ('action' => 'itementry/' . $errorMsg ) );
		} else {
			$this->Session->setFlash ( 'Try again.' );
			$this->redirect ( array ('action' => 'itementry' ) );
		}
	}
	
	function csvHeader($filename) {
		header ( "Pragma: public" );
		header ( "Expires: 0" );
		header ( "Cache-Control: must-revalidate, post-check=0, pre-check=0" );
		header ( "Content-Type: application/force-download" );
		header ( "Content-Type: application/octet-stream" );
		header ( "Content-Type: application/download" );
		;
		header ( "Content-Disposition: attachment;filename=$filename" );
		header ( "Content-Transfer-Encoding: binary " );
	}
	
	/**
	 * write the xls begin of file
	 */
	function BOF() {
		echo pack ( "ssssss", 0x809, 0x8, 0x0, 0x10, 0x0, 0x0 );
		return;
	}
	
	/**
	 * write the xls end of file
	 */
	function EOF() {
		echo pack ( "ss", 0x0A, 0x00 );
		return;
	}
	
	/**
	 * write a number
	 * @param $Row row to write $Value (first row is 0)
	 * @param $Col column to write $Value (first column is 0)
	 * @param $Value number value
	 */
	function writeNumber($Row, $Col, $Value) {
		echo pack ( "sssss", 0x203, 14, $Row, $Col, 0x0 );
		echo pack ( "d", $Value );
		return;
	}
	
	/**
	 * write a string label
	 * @param $Row row to write $Value (first row is 0)
	 * @param $Col column to write $Value (first column is 0)
	 * @param $Value string value
	 */
	function writeLabel($Row, $Col, $Value) {
		$L = strlen ( $Value );
		echo pack ( "ssssss", 0x204, 8 + $L, $Row, $Col, 0x0, $L );
		echo $Value;
		return;
	}
	
	/*
	function singlecsv() {
        //Configure::write("debug",3);
		$this->layout = 'default-one';
		$this->pageTitle = 'Stock Bangladesh :: Download Data';
		
		if (! $this->Session->check ( 'Auth.User' )) {
			
			$this->Session->setFlash ( 'Please login again.' );
			$this->redirect ( array ('controller' => 'users', 'action' => 'login' ) );
		}
		$userId = $this->Session->read ( 'Auth.User.id' );
		
		if (isset ( $_POST ['Download'] )) {
            //pr($_POST); die;
			$symbol = $_POST ['SymbolId'];
			$format = $_POST ['DataFormat'];
            $start_date = $_POST ['data']['start_date'];
            $end_date = $_POST ['data']['end_date'];
			$durationInDays = $_POST ['SelectDay'];
            
            $range = 0;
            if(($start_date!='') || ($end_date!=''))
            {
                $range = 1;
                $startstamp = strtotime($start_date);
                if($end_date!=''){
                    $endstamp = strtotime($end_date);
                }else{
                    $endstamp = time () + 6 * 60 * 60;
                }
            }else{
                $todayStamp = time () + 6 * 60 * 60;
                $startstamp = $todayStamp - $durationInDays * 24 * 60 * 60;
            }
			
			$todayStamp = time () + 6 * 60 * 60;
			$startstamp = $todayStamp - $durationInDays * 24 * 60 * 60;
            
            $startdate = date('d-M-Y',$startstamp);
            //pr($startdate); die;
            //pr($startstamp);
			
			$symbolInfo = $this->Symbol->find ( 'first', array ('conditions' => array ('id=' . $symbol ) ) );
			
			$code = $symbolInfo ['Symbol'] ['dse_code'];
            
            
            //echo date('Y-m-d',$day);
            
			
			if ($format == 'csv') {
                
				$filePath = WWW_ROOT . 'csv' . DS . $code . '.csv';
               // pr($filePath); die;
				$_fp = @fopen ( $filePath, 'w' );
				$_csv_data = "Date" . ',' . "Open" . ',' . "High" . ',' . "Low" . ',' . "Close" . ',' . "Volume" . "\n";
				//pr($_csv_data); die;
				@fwrite ( $_fp, $_csv_data );
				
                if($range==0)
                {
                    $csvSQL = 'select Output.id, date_format(str_to_date(date, \'%d-%c-%Y\'), \'%Y-%m-%d\') as date, Output.open as open, Output.high as high, Output.low as low, Output.close as close, Output.volume as volume from symbols as c, outputs as Output  where c.id=Output.symbol and c.id=' . $symbol . ' and UNIX_TIMESTAMP(str_to_date(date, \'%d-%c-%Y\'))>' . $startstamp . ' order by Output.id desc';
                }else{
                    $csvSQL = 'select Output.id, date_format(str_to_date(date, \'%d-%c-%Y\'), \'%Y-%m-%d\') as date, Output.open as open, Output.high as high, Output.low as low, Output.close as close, Output.volume as volume from symbols as c, outputs as Output  where c.id=Output.symbol and c.id=' . $symbol . ' and UNIX_TIMESTAMP(str_to_date(date, \'%d-%c-%Y\'))>' . $startstamp . ' and UNIX_TIMESTAMP(str_to_date(date, \'%d-%c-%Y\'))<' . $endstamp . ' order by Output.id desc';    
                }
				    //$csvSQL = 'select Output.id, date_format(str_to_date(date, \'%d-%c-%Y\'), \'%Y-%m-%d\') as date, Output.open as open, Output.high as high, Output.low as low, Output.close as close, Output.volume as volume from symbols as c, outputs as Output  where c.id=Output.symbol and c.id=' . $symbol . ' and UNIX_TIMESTAMP(str_to_date(date, \'%d-%c-%Y\'))>' . $startstamp . ' order by Output.id desc';
				$dataList = $this->Symbol->query ( $csvSQL );
                //pr($dataList); die;
                
                
				if (! empty ( $dataList )) {
					foreach ( $dataList as $dATA ) 
                    {
                        
                        //pr($dATA);
                        $querystr="SELECT * FROM `corporate_action` WHERE `symbol` =$symbol and `active`=1 ORDER BY `datestamp` DESC";
                        $corporateAction = $this->Symbol->query($querystr);
                        
                        
                      if((isset($_POST['Adjusted'])) && !empty($corporateAction))
                      {
                         
                        $day=$corporateAction[0]['corporate_action']['datestamp']+7*60*60;
                        $actiondate = date('Y-m-d',$day);
                        //pr($dATA [0] ['date']);
                        //pr($actiondate); die;
                        if($dATA [0] ['date']<$actiondate)
                        {
                            //pr('action'); die;
                            $action = $corporateAction[0]['corporate_action']['action'];
                            if($action=='stockdiv')
                            {
                                $adjustmentFactor=(100+$corporateAction[0]['corporate_action']['value'])/100;
                                $open   =$dATA ['Output'] ['open']/$adjustmentFactor;
                                $high   =$dATA ['Output'] ['high']/$adjustmentFactor;
                                $low    =$dATA ['Output'] ['low']/$adjustmentFactor;
                                $close  =$dATA ['Output'] ['close']/$adjustmentFactor;
                                $volume =$dATA ['Output'] ['volume'];
                            }
                            
                            if($action=='cashdiv')
                            {
                                $symbolSQL = "SELECT face_value FROM symbols WHERE id=$symbol";
                                $result = $this->Symbol->query($symbolSQL);
                                $facevalue  = $result[0]['symbols']['face_value'];
                                $adjustmentFactor=$facevalue*$corporateAction[0]['corporate_action']['value']/100;
                                
                                $open   =$dATA ['Output'] ['open']-$adjustmentFactor;
                                $high   =$dATA ['Output'] ['high']-$adjustmentFactor;
                                $low    =$dATA ['Output'] ['low']-$adjustmentFactor;
                                $close  =$dATA ['Output'] ['close']-$adjustmentFactor;
                                $volume =$dATA ['Output'] ['volume'];
                                
                            }
                            
                            if($action=='rightshare')
                            {
                                $symbolSQL = "SELECT face_value FROM symbols WHERE id=$symbol";
                                $result     = $this->Symbol->query($symbolSQL);
                                $facevalue  = $result[0]['symbols']['face_value'];
                                $adjustmentFactor=(100+$corporateAction[0]['corporate_action']['value'])/100;
                                $premium    =$corporateAction[0]['corporate_action']['premium'];                    
                                $close_price_adjustment_factor=($premium+$facevalue)-(($premium+$facevalue)/$adjustmentFactor);
                                
                                $open   =($dATA ['Output'] ['open']+$close_price_adjustment_factor)/$adjustmentFactor;
                                $high   =($dATA ['Output'] ['high']+$close_price_adjustment_factor)/$adjustmentFactor;
                                $low    =($dATA ['Output'] ['low']+$close_price_adjustment_factor)/$adjustmentFactor;
                                $close  =($dATA ['Output'] ['close']+$close_price_adjustment_factor)/$adjustmentFactor;
                                $volume =$dATA ['Output'] ['volume'];
                            }
                            
                            if($action=='split')
                            {
                                 //pr('split'); die;
                                $adjustmentFactor = $corporateAction[0]['corporate_action']['value'];
                                $open   =$dATA ['Output'] ['open']/$adjustmentFactor;
                                $high   =$dATA ['Output'] ['high']/$adjustmentFactor;
                                $low    =$dATA ['Output'] ['low']/$adjustmentFactor;
                                $close  =$dATA ['Output'] ['close']/$adjustmentFactor;
                                $volume =$dATA ['Output'] ['volume']*$adjustmentFactor;
                            }
                           // pr('not found'); die;
                             
                            $_csv_data = ucfirst ( $dATA [0] ['date'] ) . ',' . ucfirst ( $open ) . ',' . ucfirst ( $high ) . ',' . $low . ',' . $close . ',' . $volume . ',' . "\n";
                            @fwrite ( $_fp, $_csv_data );
                        }
                        else
                        {  
						    $_csv_data = ucfirst ( $dATA [0] ['date'] ) . ',' . ucfirst ( $dATA ['Output'] ['open'] ) . ',' . ucfirst ( $dATA ['Output'] ['high'] ) . ',' . $dATA ['Output'] ['low'] . ',' . $dATA ['Output'] ['close'] . ',' . $dATA ['Output'] ['volume'] . ',' . "\n";
						    @fwrite ( $_fp, $_csv_data );
                        }
                        
					  }
                  else
                    {  
                        $_csv_data = ucfirst ( $dATA [0] ['date'] ) . ',' . ucfirst ( $dATA ['Output'] ['open'] ) . ',' . ucfirst ( $dATA ['Output'] ['high'] ) . ',' . $dATA ['Output'] ['low'] . ',' . $dATA ['Output'] ['close'] . ',' . $dATA ['Output'] ['volume'] . ',' . "\n";
                        //pr($_csv_data);
                        @fwrite ( $_fp, $_csv_data );
                    }
                  }
				}
				
				$fileName = $code . '.csv';
				
				header ( "Content-Disposition: attachment; filename=" . $fileName );
				readfile ( $filePath );
				exit ();
			}
			
			if ($format == 'xls') {
                $filePath = WWW_ROOT . 'csv' . DS . $code . '.xls';
				$this->csvHeader ( $code . '.xls' );
                $this->BOF ();
				
				$this->writeLabel ( 0, 0, "Date" );
				$this->writeLabel ( 0, 1, "Open" );
				$this->writeLabel ( 0, 2, "High" );
				$this->writeLabel ( 0, 3, "Low" );
				$this->writeLabel ( 0, 4, "Close" );
				$this->writeLabel ( 0, 5, "Volume" );
				
				//$xlsSQL = 'select Output.id, date_format(str_to_date(date, \'%d-%c-%Y\'), \'%d-%M-%y\') as date, Output.open as open, Output.high as high, Output.low as low, Output.close as close, Output.volume as volume from symbols as c, outputs as Output  where c.id=Output.symbol and c.id=' . $symbol . ' and UNIX_TIMESTAMP(str_to_date(date, \'%d-%c-%Y\'))>' . $startstamp . ' order by Output.id desc';
                if($range==0)
                {
                    $xlsSQL = 'select Output.id, date_format(str_to_date(date, \'%d-%c-%Y\'), \'%Y-%m-%d\') as date, Output.open as open, Output.high as high, Output.low as low, Output.close as close, Output.volume as volume from symbols as c, outputs as Output  where c.id=Output.symbol and c.id=' . $symbol . ' and UNIX_TIMESTAMP(str_to_date(date, \'%d-%c-%Y\'))>' . $startstamp . ' order by Output.id desc';
                }else{
                    $xlsSQL = 'select Output.id, date_format(str_to_date(date, \'%d-%c-%Y\'), \'%Y-%m-%d\') as date, Output.open as open, Output.high as high, Output.low as low, Output.close as close, Output.volume as volume from symbols as c, outputs as Output  where c.id=Output.symbol and c.id=' . $symbol . ' and UNIX_TIMESTAMP(str_to_date(date, \'%d-%c-%Y\'))>' . $startstamp . ' and UNIX_TIMESTAMP(str_to_date(date, \'%d-%c-%Y\'))<' . $endstamp . ' order by Output.id desc';    
                }
				
				$dataList = $this->Symbol->query ( $xlsSQL );
                
				
				if (! empty ( $dataList )) {
					$count = 1;
					foreach ( $dataList as $dATA ) {
                        
                     //pr($dATA); die;
                     $querystr="SELECT * FROM `corporate_action` WHERE `symbol` =$symbol and `active`=1 ORDER BY `datestamp` ASC";
                     $corporateAction = $this->Symbol->query($querystr);
                        
                      if((isset($_POST['Adjusted'])) && !empty($corporateAction))
                      {
                        $day=$corporateAction[0]['corporate_action']['datestamp']+7*60*60;
                        $actiondate = date('Y-m-d',$day);
                        //pr($actiondate); die;
                        if($dATA [0] ['date']<$actiondate)
                        {
                            $action = $corporateAction[0]['corporate_action']['action'];
                            if($action=='stockdiv')
                            {
                                $adjustmentFactor=(100+$corporateAction[0]['corporate_action']['value'])/100;
                                $open   =$dATA ['Output'] ['open']/$adjustmentFactor;
                                $high   =$dATA ['Output'] ['high']/$adjustmentFactor;
                                $low    =$dATA ['Output'] ['low']/$adjustmentFactor;
                                $close  =$dATA ['Output'] ['close']/$adjustmentFactor;
                                $volume =$dATA ['Output'] ['volume'];
                            }
                            
                            if($action=='cashdiv')
                            {
                                $symbolSQL = "SELECT face_value FROM symbols WHERE id=$symbol";
                                $result = $this->Symbol->query($symbolSQL);
                                $facevalue  = $result[0]['symbols']['face_value'];
                                $adjustmentFactor=$facevalue*$corporateAction[0]['corporate_action']['value']/100;
                                
                                $open   =$dATA ['Output'] ['open']-$adjustmentFactor;
                                $high   =$dATA ['Output'] ['high']-$adjustmentFactor;
                                $low    =$dATA ['Output'] ['low']-$adjustmentFactor;
                                $close  =$dATA ['Output'] ['close']-$adjustmentFactor;
                                $volume =$dATA ['Output'] ['volume'];
                                
                            }
                            
                            if($action=='rightshare')
                            {
                                $symbolSQL = "SELECT face_value FROM symbols WHERE id=$symbol";
                                $result     = $this->Symbol->query($symbolSQL);
                                $facevalue  = $result[0]['symbols']['face_value'];
                                $adjustmentFactor=(100+$corporateAction[0]['corporate_action']['value'])/100;
                                $premium    =$corporateAction[0]['corporate_action']['premium'];                    
                                $close_price_adjustment_factor=($premium+$facevalue)-(($premium+$facevalue)/$adjustmentFactor);
                                
                                $open   =($dATA ['Output'] ['open']+$close_price_adjustment_factor)/$adjustmentFactor;
                                $high   =($dATA ['Output'] ['high']+$close_price_adjustment_factor)/$adjustmentFactor;
                                $low    =($dATA ['Output'] ['low']+$close_price_adjustment_factor)/$adjustmentFactor;
                                $close  =($dATA ['Output'] ['close']+$close_price_adjustment_factor)/$adjustmentFactor;
                                $volume =$dATA ['Output'] ['volume']; 
                            }
                            
                            if($action=='split')
                            {
                                $adjustmentFactor = $corporateAction[0]['corporate_action']['value'];
                                $open   =$dATA ['Output'] ['open']/$adjustmentFactor;
                                $high   =$dATA ['Output'] ['high']/$adjustmentFactor;
                                $low    =$dATA ['Output'] ['low']/$adjustmentFactor;
                                $close  =$dATA ['Output'] ['close']/$adjustmentFactor;
                                $volume =$dATA ['Output'] ['volume']*$adjustmentFactor;
                            }
                             
                            $this->writeLabel ( $count, 0, ucfirst ( $dATA [0] ['date'] ) );
                            $this->writeLabel ( $count, 1, ucfirst ( $open ) );
                            $this->writeLabel ( $count, 2, ucfirst ( $high ) );
                            $this->writeLabel ( $count, 3, ucfirst ( $low ) );
                            $this->writeLabel ( $count, 4, ucfirst ( $close ) );
                            $this->writeLabel ( $count, 5, ucfirst ( $volume ) );
                            $count ++;
                        }
                        else
                        {  
                            $this->writeLabel ( $count, 0, ucfirst ( $dATA [0] ['date'] ) );
                            $this->writeLabel ( $count, 1, ucfirst ( $dATA ['Output'] ['open'] ) );
                            $this->writeLabel ( $count, 2, ucfirst ( $dATA ['Output'] ['high'] ) );
                            $this->writeLabel ( $count, 3, ucfirst ( $dATA ['Output'] ['low'] ) );
                            $this->writeLabel ( $count, 4, ucfirst ( $dATA ['Output'] ['close'] ) );
                            $this->writeLabel ( $count, 5, ucfirst ( $dATA ['Output'] ['volume'] ) );
                            $count ++;
                        }
                        
                      }
                  else
                    {  
                        $this->writeLabel ( $count, 0, ucfirst ( $dATA [0] ['date'] ) );
                        $this->writeLabel ( $count, 1, ucfirst ( $dATA ['Output'] ['open'] ) );
                        $this->writeLabel ( $count, 2, ucfirst ( $dATA ['Output'] ['high'] ) );
                        $this->writeLabel ( $count, 3, ucfirst ( $dATA ['Output'] ['low'] ) );
                        $this->writeLabel ( $count, 4, ucfirst ( $dATA ['Output'] ['close'] ) );
                        $this->writeLabel ( $count, 5, ucfirst ( $dATA ['Output'] ['volume'] ) );
                        $count ++;
                    }
                  }
                  $this->EOF ();
				}
				        
				
				exit ();
			}
			
			if ($format == 'txt') {
				$filePath = WWW_ROOT . 'csv' . DS . $code . '.txt';
				$_fp = @fopen ( $filePath, 'w' );
				$_csv_data = "Date" . ',' . "Open" . ',' . "High" . ',' . "Low" . ',' . "Close" . ',' . "Volume" . "\n";
				
				@fwrite ( $_fp, $_csv_data );
				
				//$csvSQL = 'select Output.id, date_format(str_to_date(date, \'%d-%c-%Y\'), \'%d-%M-%y\') as date, Output.open as open, Output.high as high, Output.low as low, Output.close as close, Output.volume as volume from symbols as c, outputs as Output  where c.id=Output.symbol and c.id=' . $symbol . ' and UNIX_TIMESTAMP(str_to_date(date, \'%d-%c-%Y\'))>' . $startstamp . ' order by Output.id desc';
                if($range==0)
                {
                    $csvSQL = 'select Output.id, date_format(str_to_date(date, \'%d-%c-%Y\'), \'%Y-%m-%d\') as date, Output.open as open, Output.high as high, Output.low as low, Output.close as close, Output.volume as volume from symbols as c, outputs as Output  where c.id=Output.symbol and c.id=' . $symbol . ' and UNIX_TIMESTAMP(str_to_date(date, \'%d-%c-%Y\'))>' . $startstamp . ' order by Output.id desc';
                }else{
                    $csvSQL = 'select Output.id, date_format(str_to_date(date, \'%d-%c-%Y\'), \'%Y-%m-%d\') as date, Output.open as open, Output.high as high, Output.low as low, Output.close as close, Output.volume as volume from symbols as c, outputs as Output  where c.id=Output.symbol and c.id=' . $symbol . ' and UNIX_TIMESTAMP(str_to_date(date, \'%d-%c-%Y\'))>' . $startstamp . ' and UNIX_TIMESTAMP(str_to_date(date, \'%d-%c-%Y\'))<' . $endstamp . ' order by Output.id desc';    
                }
				
				$dataList = $this->Symbol->query ( $csvSQL );
				
				if (! empty ( $dataList )) {
					foreach ( $dataList as $dATA ) {
						$_csv_data = ucfirst ( $dATA [0] ['date'] ) . ',' . ucfirst ( $dATA ['Output'] ['open'] ) . ',' . ucfirst ( $dATA ['Output'] ['high'] ) . ',' . $dATA ['Output'] ['low'] . ',' . $dATA ['Output'] ['close'] . ',' . $dATA ['Output'] ['volume'] . ',' . "\n";
						@fwrite ( $_fp, $_csv_data );
					}
				}
				
				$fileName = $code . '.txt';
				
				header ( "Content-Disposition: attachment; filename=" . $fileName );
				readfile ( $filePath );
				exit ();
			}
		
		}
	}*/

    function singlecsv() {
		//Configure::write("debug",3);
        $this->layout = 'default-one';
        $this->pageTitle = 'Stock Bangladesh :: Download Data';
        if (! $this->Session->check ( 'Auth.User' )) {
            $this->Session->setFlash ( 'Please login again.' );
            $this->Session->del('Auth.redirect');
            $this->Session->write('Auth.redirect', 'resources/download');
            $this->Session->write('Auth.gobackpage', 'resources/download');
            $this->redirect ( array ('controller' => 'users', 'action' => 'login' ) );
        }
       //pr($_POST); 
      
        $userId = $this->Session->read ( 'Auth.User.id' );
        if (isset ( $_POST ['Download'] )) {
            $symbol = $_POST['SymbolId'];
            $format = $_POST ['DataFormat'];
            
			$start_date = $_POST['data']['start_date'];
            $end_date = $_POST ['data']['end_date'];
			
			$durationInDays = $_POST['SelectDay'];
			
			 if(isset($_POST['Adjusted']) )
              {
			  	$source_table_name = "outputs_adjusted";
			  }else{
			  	$source_table_name = "outputs";
			  }
            
            $range = 0;
            if(($start_date!='') || ($end_date!=''))
            {
                $range = 1;
                $startstamp = strtotime($start_date);
                if($end_date!=''){
                    $endstamp = strtotime($end_date);
                }else{
                    $endstamp = time () + 6 * 60 * 60;
                }
            }else{
                $todayStamp = time () + 6 * 60 * 60;
	            $startstamp = $todayStamp - ($durationInDays * 24 * 60 * 60);
            }
			
			//pr($_POST);
            $symbolInfo = $this->Symbol->find ( 'first', array ('conditions' => array ('id=' . $symbol ) ) );
            $code = $symbolInfo ['Symbol'] ['dse_code'];

            if ($format == 'csv') {
                $filePath = WWW_ROOT . 'csv' . DS . $code . '.csv';
                $_fp = @fopen ( $filePath, 'w' );
                $_csv_data = "Date" . ',' . "Open" . ',' . "High" . ',' . "Low" . ',' . "Close" . ',' . "Volume" . "\n";
                @fwrite ( $_fp, $_csv_data );

                 //$csvSQL = 'select Output.id, date_format(str_to_date(date, \'%d-%c-%Y\'), \'%Y-%m-%d\') as date, Output.open as open, Output.high as high, Output.low as low, Output.close as close, Output.volume as volume FROM symbols as c, '.$source_table_name.' as Output  where c.id=Output.symbol and c.id=' . $symbol . ' and UNIX_TIMESTAMP(str_to_date(date, \'%d-%c-%Y\'))>' . $startstamp . ' order by Output.id desc';
				$csvSQL = 'select Output.id, date_format(str_to_date(date, \'%d-%c-%Y\'), \'%Y-%m-%d\') as date, Output.open as open, Output.high as high, Output.low as low, Output.close as close, Output.volume as volume FROM '.$source_table_name.' as Output  where Output.symbol=' . $symbol . ' and daystamp>' . $startstamp . ' order by Output.id desc';
                $dataList = $this->Symbol->query ( $csvSQL );

                if (! empty ( $dataList )) {
                    foreach ( $dataList as $dATA ) {
                        $_csv_data = ucfirst ( $dATA [0] ['date'] ) . ',' . ucfirst ( $dATA ['Output'] ['open'] ) . ',' . ucfirst ( $dATA ['Output'] ['high'] ) . ',' . $dATA ['Output'] ['low'] . ',' . $dATA ['Output'] ['close'] . ',' . $dATA ['Output'] ['volume'] . ',' . "\n";
                        @fwrite ( $_fp, $_csv_data );
                    }

                }
                $fileName = $code . '.csv';
                header ( "Content-Disposition: attachment; filename=" . $fileName );
                readfile ( $filePath );
                exit ();
            }

            if ($format == 'xls') {
               $filePath = WWW_ROOT . 'csv' . DS . $code . '.xls';
                $this->csvHeader ( $code . '.xls' );
                $this->BOF ();

                $this->writeLabel ( 0, 0, "Date" );
                $this->writeLabel ( 0, 1, "Open" );
                $this->writeLabel ( 0, 2, "High" );
                $this->writeLabel ( 0, 3, "Low" );
                $this->writeLabel ( 0, 4, "Close" );
                $this->writeLabel ( 0, 5, "Volume" );

                $xlsSQL = 'select Output.id, date_format(str_to_date(date, \'%d-%c-%Y\'), \'%d-%M-%y\') as date, Output.open as open, Output.high as high, Output.low as low, Output.close as close, Output.volume as volume from symbols as c, '.$source_table_name.' as Output  where c.id=Output.symbol and c.id=' . $symbol . ' and UNIX_TIMESTAMP(str_to_date(date, \'%d-%c-%Y\'))>' . $startstamp . ' order by Output.id desc';
                $dataList = $this->Symbol->query ( $xlsSQL );

                if (! empty ( $dataList )) {
                    $count = 1;
                    foreach ( $dataList as $dATA ) {
                        $this->writeLabel ( $count, 0, ucfirst ( $dATA [0] ['date'] ) );
                        $this->writeLabel ( $count, 1, ucfirst ( $dATA ['Output'] ['open'] ) );
                        $this->writeLabel ( $count, 2, ucfirst ( $dATA ['Output'] ['high'] ) );
                        $this->writeLabel ( $count, 3, ucfirst ( $dATA ['Output'] ['low'] ) );
                        $this->writeLabel ( $count, 4, ucfirst ( $dATA ['Output'] ['close'] ) );
                        $this->writeLabel ( $count, 5, ucfirst ( $dATA ['Output'] ['volume'] ) );
                        $count ++;
                    }
                }

                $this->EOF ();
                exit ();
            }

            if ($format == 'txt') {
                $filePath = WWW_ROOT . 'csv' . DS . $code . '.txt';
                $_fp = @fopen ( $filePath, 'w' );
                $_csv_data = "Date" . ',' . "Open" . ',' . "High" . ',' . "Low" . ',' . "Close" . ',' . "Volume" . "\n";

                @fwrite ( $_fp, $_csv_data );
                $csvSQL = 'select Output.id, date_format(str_to_date(date, \'%d-%c-%Y\'), \'%d-%M-%y\') as date, Output.open as open, Output.high as high, Output.low as low, Output.close as close, Output.volume as volume from symbols as c, '.$source_table_name.' as Output  where c.id=Output.symbol and c.id=' . $symbol . ' and UNIX_TIMESTAMP(str_to_date(date, \'%d-%c-%Y\'))>' . $startstamp . ' order by Output.id desc';
                $dataList = $this->Symbol->query ( $csvSQL );

                if (! empty ( $dataList )) {
                    foreach ( $dataList as $dATA ) {
                        $_csv_data = ucfirst ( $dATA [0] ['date'] ) . ',' . ucfirst ( $dATA ['Output'] ['open'] ) . ',' . ucfirst ( $dATA ['Output'] ['high'] ) . ',' . $dATA ['Output'] ['low'] . ',' . $dATA ['Output'] ['close'] . ',' . $dATA ['Output'] ['volume'] . ',' . "\n";
                        @fwrite ( $_fp, $_csv_data );
                    }
                }

                $fileName = $code . '.txt';
                header ( "Content-Disposition: attachment; filename=" . $fileName );
                readfile ( $filePath );
                exit ();
            }
        }
    }      
      
/*      
    function singlecsv() {
        //Configure::write("debug",3);
        $this->layout = 'default-one';
        $this->pageTitle = 'Stock Bangladesh :: Download Data';
        
        $userId = $this->Session->read ( 'Auth.User.id' );
        
        if (isset ( $_POST ['Download'] )) {
            //pr($_POST); 
            //pr('start = '.$_POST['data']['start_date']);
            //pr('end = '.$_POST['data']['end_date']);
            //die;
            $symbol = $_POST ['SymbolId'];
            $format = $_POST ['DataFormat'];
            
            $start_date = $_POST ['data']['start_date'];
            $end_date = $_POST ['data']['end_date'];
            
            $durationInDays = $_POST ['SelectDay'];
            $range = 0;
            if(($start_date!='') || ($end_date!=''))
            {
                $range = 1;
                $startstamp = strtotime($start_date)-6*60*60;
                if($end_date!=''){
                    $endstamp = strtotime($end_date);
                }else{
                    $endstamp = time () + 6 * 60 * 60;
                }
            }else{
                $todayStamp = time () + 6 * 60 * 60;
                $startstamp = $todayStamp - $durationInDays * 24 * 60 * 60;
            }
            //echo 'range = '.$range;
            //die;
            
            $startdate = date('d-M-Y',$startstamp);
            //pr($startdate); die;
            //pr($startstamp);
            
            $symbolInfo = $this->Symbol->find ( 'first', array ('conditions' => array ('id=' . $symbol ) ) );
            
            $code = $symbolInfo ['Symbol'] ['dse_code'];
            
            
            //echo date('Y-m-d',$day);
            
            
            if ($format == 'csv') {
                
                $filePath = WWW_ROOT . 'csv' . DS . $code . '.csv';
               // pr($filePath); die;
                $_fp = @fopen ( $filePath, 'w' );
                $_csv_data = "Date" . ',' . "Open" . ',' . "High" . ',' . "Low" . ',' . "Close" . ',' . "Volume" . "\n";
                //pr($_csv_data); die;
                @fwrite ( $_fp, $_csv_data );
                if($range==0)
                {
                    $csvSQL = 'select Output.id, date_format(str_to_date(date, \'%d-%c-%Y\'), \'%Y-%m-%d\') as date, Output.open as open, Output.high as high, Output.low as low, Output.close as close, Output.volume as volume from symbols as c, outputs as Output  where c.id=Output.symbol and c.id=' . $symbol . ' and UNIX_TIMESTAMP(str_to_date(date, \'%d-%c-%Y\'))>' . $startstamp . ' order by Output.id desc';
                }else{
                    $csvSQL = 'select Output.id, date_format(str_to_date(date, \'%d-%c-%Y\'), \'%Y-%m-%d\') as date, Output.open as open, Output.high as high, Output.low as low, Output.close as close, Output.volume as volume from symbols as c, outputs as Output  where c.id=Output.symbol and c.id=' . $symbol . ' and UNIX_TIMESTAMP(str_to_date(date, \'%d-%c-%Y\'))>' . $startstamp . ' and UNIX_TIMESTAMP(str_to_date(date, \'%d-%c-%Y\'))<' . $endstamp . ' order by Output.id desc';
                }
                $dataList = $this->Symbol->query ( $csvSQL );
                //pr($dataList); die;
                
                
                if (! empty ( $dataList )) {
                    foreach ( $dataList as $dATA ) 
                    {
                        
                        //pr($dATA);
                        $querystr="SELECT * FROM `corporate_action` WHERE `symbol` =$symbol and `active`=1 ORDER BY `datestamp` DESC";
                        $corporateAction = $this->Symbol->query($querystr);
                        
                        
                      if((isset($_POST['Adjusted'])) && !empty($corporateAction))
                      {
                         
                        $day=$corporateAction[0]['corporate_action']['datestamp']+7*60*60;
                        $actiondate = date('Y-m-d',$day);
                        //pr($dATA [0] ['date']);
                        //pr($actiondate); die;
                        if($dATA [0] ['date']<$actiondate)
                        {
                            //pr('action'); die;
                            $action = $corporateAction[0]['corporate_action']['action'];
                            if($action=='stockdiv')
                            {
                                $adjustmentFactor=(100+$corporateAction[0]['corporate_action']['value'])/100;
                                $open   =$dATA ['Output'] ['open']/$adjustmentFactor;
                                $high   =$dATA ['Output'] ['high']/$adjustmentFactor;
                                $low    =$dATA ['Output'] ['low']/$adjustmentFactor;
                                $close  =$dATA ['Output'] ['close']/$adjustmentFactor;
                                $volume =$dATA ['Output'] ['volume'];
                            }
                            
                            if($action=='cashdiv')
                            {
                                $symbolSQL = "SELECT face_value FROM symbols WHERE id=$symbol";
                                $result = $this->Symbol->query($symbolSQL);
                                $facevalue  = $result[0]['symbols']['face_value'];
                                $adjustmentFactor=$facevalue*$corporateAction[0]['corporate_action']['value']/100;
                                
                                $open   =$dATA ['Output'] ['open']-$adjustmentFactor;
                                $high   =$dATA ['Output'] ['high']-$adjustmentFactor;
                                $low    =$dATA ['Output'] ['low']-$adjustmentFactor;
                                $close  =$dATA ['Output'] ['close']-$adjustmentFactor;
                                $volume =$dATA ['Output'] ['volume'];
                                
                            }
                            
                            if($action=='rightshare')
                            {
                                $symbolSQL = "SELECT face_value FROM symbols WHERE id=$symbol";
                                $result     = $this->Symbol->query($symbolSQL);
                                $facevalue  = $result[0]['symbols']['face_value'];
                                $adjustmentFactor=(100+$corporateAction[0]['corporate_action']['value'])/100;
                                $premium    =$corporateAction[0]['corporate_action']['premium'];                    
                                $close_price_adjustment_factor=($premium+$facevalue)-(($premium+$facevalue)/$adjustmentFactor);
                                
                                $open   =($dATA ['Output'] ['open']+$close_price_adjustment_factor)/$adjustmentFactor;
                                $high   =($dATA ['Output'] ['high']+$close_price_adjustment_factor)/$adjustmentFactor;
                                $low    =($dATA ['Output'] ['low']+$close_price_adjustment_factor)/$adjustmentFactor;
                                $close  =($dATA ['Output'] ['close']+$close_price_adjustment_factor)/$adjustmentFactor;
                                $volume =$dATA ['Output'] ['volume'];
                            }
                            
                            if($action=='split')
                            {
                                 //pr('split'); die;
                                $adjustmentFactor = $corporateAction[0]['corporate_action']['value'];
                                $open   =$dATA ['Output'] ['open']/$adjustmentFactor;
                                $high   =$dATA ['Output'] ['high']/$adjustmentFactor;
                                $low    =$dATA ['Output'] ['low']/$adjustmentFactor;
                                $close  =$dATA ['Output'] ['close']/$adjustmentFactor;
                                $volume =$dATA ['Output'] ['volume']*$adjustmentFactor;
                            }
                           // pr('not found'); die;
                             
                            $_csv_data = ucfirst ( $dATA [0] ['date'] ) . ',' . ucfirst ( $open ) . ',' . ucfirst ( $high ) . ',' . $low . ',' . $close . ',' . $volume . ',' . "\n";
                            @fwrite ( $_fp, $_csv_data );
                        }
                        else
                        {  
                            $_csv_data = ucfirst ( $dATA [0] ['date'] ) . ',' . ucfirst ( $dATA ['Output'] ['open'] ) . ',' . ucfirst ( $dATA ['Output'] ['high'] ) . ',' . $dATA ['Output'] ['low'] . ',' . $dATA ['Output'] ['close'] . ',' . $dATA ['Output'] ['volume'] . ',' . "\n";
                            @fwrite ( $_fp, $_csv_data );
                        }
                        
                      }
                  else
                    {  
                        $_csv_data = ucfirst ( $dATA [0] ['date'] ) . ',' . ucfirst ( $dATA ['Output'] ['open'] ) . ',' . ucfirst ( $dATA ['Output'] ['high'] ) . ',' . $dATA ['Output'] ['low'] . ',' . $dATA ['Output'] ['close'] . ',' . $dATA ['Output'] ['volume'] . ',' . "\n";
                        //pr($_csv_data);
                        @fwrite ( $_fp, $_csv_data );
                    }
                  }
                }
                
                $fileName = $code . '.csv';
                
                header ( "Content-Disposition: attachment; filename=" . $fileName );
                readfile ( $filePath );
                exit ();
            }
            
            if ($format == 'xls') {
                $filePath = WWW_ROOT . 'csv' . DS . $code . '.xls';
                $this->csvHeader ( $code . '.xls' );
                $this->BOF ();
                
                $this->writeLabel ( 0, 0, "Date" );
                $this->writeLabel ( 0, 1, "Open" );
                $this->writeLabel ( 0, 2, "High" );
                $this->writeLabel ( 0, 3, "Low" );
                $this->writeLabel ( 0, 4, "Close" );
                $this->writeLabel ( 0, 5, "Volume" );
                
                if($range==0)
                {
                    $xlsSQL = 'select Output.id, date_format(str_to_date(date, \'%d-%c-%Y\'), \'%Y-%m-%d\') as date, Output.open as open, Output.high as high, Output.low as low, Output.close as close, Output.volume as volume from symbols as c, outputs as Output  where c.id=Output.symbol and c.id=' . $symbol . ' and UNIX_TIMESTAMP(str_to_date(date, \'%d-%c-%Y\'))>' . $startstamp . ' order by Output.id desc';
                }else{
                    $xlsSQL = 'select Output.id, date_format(str_to_date(date, \'%d-%c-%Y\'), \'%Y-%m-%d\') as date, Output.open as open, Output.high as high, Output.low as low, Output.close as close, Output.volume as volume from symbols as c, outputs as Output  where c.id=Output.symbol and c.id=' . $symbol . ' and UNIX_TIMESTAMP(str_to_date(date, \'%d-%c-%Y\'))>' . $startstamp . ' and UNIX_TIMESTAMP(str_to_date(date, \'%d-%c-%Y\'))<' . $endstamp . ' order by Output.id desc';    
                }
                
                
                
                
                $dataList = $this->Symbol->query ( $xlsSQL );
                
                
                if (! empty ( $dataList )) {
                    $count = 1;
                    foreach ( $dataList as $dATA ) {
                        
                     //pr($dATA); die;
                     $querystr="SELECT * FROM `corporate_action` WHERE `symbol` =$symbol and `active`=1 ORDER BY `datestamp` ASC";
                     $corporateAction = $this->Symbol->query($querystr);
                        
                      if((isset($_POST['Adjusted'])) && !empty($corporateAction))
                      {
                        $day=$corporateAction[0]['corporate_action']['datestamp']+7*60*60;
                        $actiondate = date('Y-m-d',$day);
                        //pr($actiondate); die;
                        if($dATA [0] ['date']<$actiondate)
                        {
                            $action = $corporateAction[0]['corporate_action']['action'];
                            if($action=='stockdiv')
                            {
                                $adjustmentFactor=(100+$corporateAction[0]['corporate_action']['value'])/100;
                                $open   =$dATA ['Output'] ['open']/$adjustmentFactor;
                                $high   =$dATA ['Output'] ['high']/$adjustmentFactor;
                                $low    =$dATA ['Output'] ['low']/$adjustmentFactor;
                                $close  =$dATA ['Output'] ['close']/$adjustmentFactor;
                                $volume =$dATA ['Output'] ['volume'];
                            }
                            
                            if($action=='cashdiv')
                            {
                                $symbolSQL = "SELECT face_value FROM symbols WHERE id=$symbol";
                                $result = $this->Symbol->query($symbolSQL);
                                $facevalue  = $result[0]['symbols']['face_value'];
                                $adjustmentFactor=$facevalue*$corporateAction[0]['corporate_action']['value']/100;
                                
                                $open   =$dATA ['Output'] ['open']-$adjustmentFactor;
                                $high   =$dATA ['Output'] ['high']-$adjustmentFactor;
                                $low    =$dATA ['Output'] ['low']-$adjustmentFactor;
                                $close  =$dATA ['Output'] ['close']-$adjustmentFactor;
                                $volume =$dATA ['Output'] ['volume'];
                                
                            }
                            
                            if($action=='rightshare')
                            {
                                $symbolSQL = "SELECT face_value FROM symbols WHERE id=$symbol";
                                $result     = $this->Symbol->query($symbolSQL);
                                $facevalue  = $result[0]['symbols']['face_value'];
                                $adjustmentFactor=(100+$corporateAction[0]['corporate_action']['value'])/100;
                                $premium    =$corporateAction[0]['corporate_action']['premium'];                    
                                $close_price_adjustment_factor=($premium+$facevalue)-(($premium+$facevalue)/$adjustmentFactor);
                                
                                $open   =($dATA ['Output'] ['open']+$close_price_adjustment_factor)/$adjustmentFactor;
                                $high   =($dATA ['Output'] ['high']+$close_price_adjustment_factor)/$adjustmentFactor;
                                $low    =($dATA ['Output'] ['low']+$close_price_adjustment_factor)/$adjustmentFactor;
                                $close  =($dATA ['Output'] ['close']+$close_price_adjustment_factor)/$adjustmentFactor;
                                $volume =$dATA ['Output'] ['volume']; 
                            }
                            
                            if($action=='split')
                            {
                                $adjustmentFactor = $corporateAction[0]['corporate_action']['value'];
                                $open   =$dATA ['Output'] ['open']/$adjustmentFactor;
                                $high   =$dATA ['Output'] ['high']/$adjustmentFactor;
                                $low    =$dATA ['Output'] ['low']/$adjustmentFactor;
                                $close  =$dATA ['Output'] ['close']/$adjustmentFactor;
                                $volume =$dATA ['Output'] ['volume']*$adjustmentFactor;
                            }
                             
                            $this->writeLabel ( $count, 0, ucfirst ( $dATA [0] ['date'] ) );
                            $this->writeLabel ( $count, 1, ucfirst ( $open ) );
                            $this->writeLabel ( $count, 2, ucfirst ( $high ) );
                            $this->writeLabel ( $count, 3, ucfirst ( $low ) );
                            $this->writeLabel ( $count, 4, ucfirst ( $close ) );
                            $this->writeLabel ( $count, 5, ucfirst ( $volume ) );
                            $count ++;
                        }
                        else
                        {  
                            $this->writeLabel ( $count, 0, ucfirst ( $dATA [0] ['date'] ) );
                            $this->writeLabel ( $count, 1, ucfirst ( $dATA ['Output'] ['open'] ) );
                            $this->writeLabel ( $count, 2, ucfirst ( $dATA ['Output'] ['high'] ) );
                            $this->writeLabel ( $count, 3, ucfirst ( $dATA ['Output'] ['low'] ) );
                            $this->writeLabel ( $count, 4, ucfirst ( $dATA ['Output'] ['close'] ) );
                            $this->writeLabel ( $count, 5, ucfirst ( $dATA ['Output'] ['volume'] ) );
                            $count ++;
                        }
                        
                      }
                  else
                    {  
                        $this->writeLabel ( $count, 0, ucfirst ( $dATA [0] ['date'] ) );
                        $this->writeLabel ( $count, 1, ucfirst ( $dATA ['Output'] ['open'] ) );
                        $this->writeLabel ( $count, 2, ucfirst ( $dATA ['Output'] ['high'] ) );
                        $this->writeLabel ( $count, 3, ucfirst ( $dATA ['Output'] ['low'] ) );
                        $this->writeLabel ( $count, 4, ucfirst ( $dATA ['Output'] ['close'] ) );
                        $this->writeLabel ( $count, 5, ucfirst ( $dATA ['Output'] ['volume'] ) );
                        $count ++;
                    }
                  }
                  $this->EOF ();
                }
                        
                
                exit ();
            }
            
            if ($format == 'txt') {
                $filePath = WWW_ROOT . 'csv' . DS . $code . '.txt';
                $_fp = @fopen ( $filePath, 'w' );
                $_csv_data = "Date" . ',' . "Open" . ',' . "High" . ',' . "Low" . ',' . "Close" . ',' . "Volume" . "\n";
                
                @fwrite ( $_fp, $_csv_data );
                
                
                //$csvSQL = 'select Output.id, date_format(str_to_date(date, \'%d-%c-%Y\'), \'%d-%M-%y\') as date, Output.open as open, Output.high as high, Output.low as low, Output.close as close, Output.volume as volume from symbols as c, outputs as Output  where c.id=Output.symbol and c.id=' . $symbol . ' and UNIX_TIMESTAMP(str_to_date(date, \'%d-%c-%Y\'))>' . $startstamp . ' order by Output.id desc';
                if($range==0)
                {
                    $csvSQL = 'select Output.id, date_format(str_to_date(date, \'%d-%c-%Y\'), \'%Y-%m-%d\') as date, Output.open as open, Output.high as high, Output.low as low, Output.close as close, Output.volume as volume from symbols as c, outputs as Output  where c.id=Output.symbol and c.id=' . $symbol . ' and UNIX_TIMESTAMP(str_to_date(date, \'%d-%c-%Y\'))>' . $startstamp . ' order by Output.id desc';
                }else{
                    $csvSQL = 'select Output.id, date_format(str_to_date(date, \'%d-%c-%Y\'), \'%Y-%m-%d\') as date, Output.open as open, Output.high as high, Output.low as low, Output.close as close, Output.volume as volume from symbols as c, outputs as Output  where c.id=Output.symbol and c.id=' . $symbol . ' and UNIX_TIMESTAMP(str_to_date(date, \'%d-%c-%Y\'))>' . $startstamp . ' and UNIX_TIMESTAMP(str_to_date(date, \'%d-%c-%Y\'))<' . $endstamp . ' order by Output.id desc';    
                }
                $dataList = $this->Symbol->query ( $csvSQL );
                
                if (! empty ( $dataList )) {
                    foreach ( $dataList as $dATA ) {
                        $_csv_data = ucfirst ( $dATA [0] ['date'] ) . ',' . ucfirst ( $dATA ['Output'] ['open'] ) . ',' . ucfirst ( $dATA ['Output'] ['high'] ) . ',' . $dATA ['Output'] ['low'] . ',' . $dATA ['Output'] ['close'] . ',' . $dATA ['Output'] ['volume'] . ',' . "\n";
                        @fwrite ( $_fp, $_csv_data );
                    }
                }
                
                $fileName = $code . '.txt';
                
                header ( "Content-Disposition: attachment; filename=" . $fileName );
                readfile ( $filePath );
                exit ();
            }
        
        }
    }
*/	
	function lastdaydata() {
		$this->layout = 'default-one';
		$this->pageTitle = 'Stock Bangladesh :: Download Daily Data';
	
	}
	
	function thoyearsadjusteddata() {
		$this->layout = 'default-one';
		$this->pageTitle = 'Stock Bangladesh :: Download Daily Data';
	
	}
	
	function twoyearssinglecsv()
	{
		//Configure::write("debug",3);
		//ob_start();
		//set_time_limit(0);
		$this->layout = 'default-one';
		$this->pageTitle = 'Stock Bangladesh :: Download Daily Data';
		
		if (! $this->Session->check ( 'Auth.User' )) {
			
			$this->Session->setFlash ( 'Please login again.' );
			$this->redirect ( array ('controller' => 'users', 'action' => 'login' ) );
		}
		
		$userId = $this->Session->read ( 'Auth.User.id' );
		//pr($_POST);
		
		if (isset ( $_POST ['Download'] )) {
			$format = $_POST ['DataFormat'];
			$targetDate = '2monthsAdjusted';
		//
		$durationInDays = 60;
		$todayStamp = time () + 6 * 60 * 60;
		$startstamp = $todayStamp - $durationInDays * 24 * 60 * 60;
				
		$tradingDateSQL = 'select Output.id FROM outputs_adjusted as Output  where  daystamp>' . $startstamp . ' order by Output.id asc';
		
		
		$tradingDataList = $this->Symbol->query ( $tradingDateSQL );
			
			//pr($tradingDataList);
			//pr(count($tradingDataList));
        //die('ss');    
		
			if (count ( $tradingDataList ) > 0) {
				if ($format == 'csv') {
					$filePath = WWW_ROOT . 'csvall' . DS . $targetDate . '.csv';
					$_fp = @fopen ( $filePath, 'w' );
					@fwrite ( $_fp, $_csv_data );
					
					$csvSQL = 'select Output.code as code, date_format(str_to_date(date, \'%d-%c-%Y\'), \'%Y-%m-%d\') as date, Output.open as open, Output.high as high, Output.low as low, Output.close as close, Output.volume as volume from outputs_adjusted as Output  where daystamp>' . $startstamp . ' order by Output.id asc';
					
					$dataList = $this->Symbol->query ( $csvSQL );
                    
					
					if (! empty ( $dataList )) {
						foreach ( $dataList as $dATA ) {
							if($dATA ['Output'] ['code']==''){continue;}
							$dATA ['Output'] ['volume'] = $dATA ['Output'] ['volume'] + 0;
							$_csv_data = $dATA ['Output'] ['code'] . ',' . ucfirst ( $dATA [0] ['date'] ) . ',' . ucfirst ( $dATA ['Output'] ['open'] ) . ',' . ucfirst ( $dATA ['Output'] ['high'] ) . ',' . $dATA ['Output'] ['low'] . ',' . $dATA ['Output'] ['close'] . ',' . $dATA ['Output'] ['volume'] . ',' . "\n";
                            @fwrite ( $_fp, $_csv_data );
						}
					}
					
					$fileName = 'stockbangladesh.org_' . $targetDate . '.csv';
					
					header ( "Content-Disposition: attachment; filename=" . $fileName );
					readfile ( $filePath );
					exit ();
				}
				
			} 

			else {
				$this->Session->setFlash ( 'No data available.' );
				$this->redirect ( array ('action' => 'lastdaydata' ) );
			}
		}
	}
	
	function allinasinglecsv() {
		$this->layout = 'default-one';
		$this->pageTitle = 'Stock Bangladesh :: Download Daily Data';
		
		if (! $this->Session->check ( 'Auth.User' )) {
			
			$this->Session->setFlash ( 'Please login again.' );
			$this->redirect ( array ('controller' => 'users', 'action' => 'login' ) );
		}
		$userId = $this->Session->read ( 'Auth.User.id' );
		
		if (isset ( $_POST ['Download'] )) {
			$format = $_POST ['DataFormat'];
			$targetDate = $_POST ['TargetDate'];
			
			if ($targetDate == '') {
				$this->redirect ( array ('action' => 'lastdaydata' ) );
			}
			
			$tradingDateSQL = 'select Output.id, date_format(str_to_date(date, \'%d-%c-%Y\'), \'%Y-%m-%d\') as date from symbols as Symbol, outputs as Output  where Symbol.id=Output.symbol and date=\'' . $targetDate . '\' order by Output.id asc';
			$tradingDataList = $this->Symbol->query ( $tradingDateSQL );
            
			if (count ( $tradingDataList ) > 0) {
				if ($format == 'csv') {
					$filePath = WWW_ROOT . 'csvall' . DS . $targetDate . '.csv';
					$_fp = @fopen ( $filePath, 'w' );
					@fwrite ( $_fp, $_csv_data );
					
					$csvSQL = 'select c.dse_code, Output.id, date_format(str_to_date(date, \'%d-%c-%Y\'), \'%Y-%m-%d\') as date, Output.open as open, Output.high as high, Output.low as low, Output.close as close, Output.volume as volume from symbols as c, outputs as Output  where c.id=Output.symbol and date =\'' . $targetDate . '\' order by Output.id asc';
					
					$dataList = $this->Symbol->query ( $csvSQL );
                    
					
					if (! empty ( $dataList )) {
						foreach ( $dataList as $dATA ) {
							$dATA ['Output'] ['volume'] = $dATA ['Output'] ['volume'] + 0;
							$_csv_data = $dATA ['c'] ['dse_code'] . ',' . ucfirst ( $dATA [0] ['date'] ) . ',' . ucfirst ( $dATA ['Output'] ['open'] ) . ',' . ucfirst ( $dATA ['Output'] ['high'] ) . ',' . $dATA ['Output'] ['low'] . ',' . $dATA ['Output'] ['close'] . ',' . $dATA ['Output'] ['volume'] . ',' . "\n";
                            @fwrite ( $_fp, $_csv_data );
						}
					}
					
					$fileName = 'stockbangladesh.org_' . $targetDate . '.csv';
					
					header ( "Content-Disposition: attachment; filename=" . $fileName );
					readfile ( $filePath );
					exit ();
				}
				
				if ($format == 'xls') {
					$filePath = WWW_ROOT . 'csvall' . DS . $code . '.xls';
					$this->csvHeader ( $code . '.xls' );
					$this->BOF ();
					
					$this->writeLabel ( 0, 0, "Date" );
					$this->writeLabel ( 0, 1, "Open" );
					$this->writeLabel ( 0, 2, "High" );
					$this->writeLabel ( 0, 3, "Low" );
					$this->writeLabel ( 0, 4, "Close" );
					$this->writeLabel ( 0, 5, "Volume" );
					
					$xlsSQL = 'select c.dse_code, Output.id, date_format(str_to_date(date, \'%d-%c-%Y\'), \'%Y-%m-%d\') as date, Output.open as open, Output.high as high, Output.low as low, Output.close as close, Output.volume as volume from symbols as c, outputs as Output  where c.id=Output.symbol and date =\'' . $targetDate . '\' order by Output.id asc';
					
					$dataList = $this->Symbol->query ( $xlsSQL );
					
					if (! empty ( $dataList )) {
						$count = 1;
						foreach ( $dataList as $dATA ) {
							$this->writeLabel ( $count, 0, $dATA ['c'] ['dse_code'] );
							$this->writeLabel ( $count, 1, ucfirst ( $dATA [0] ['date'] ) );
							$this->writeLabel ( $count, 2, ucfirst ( $dATA ['Output'] ['open'] ) );
							$this->writeLabel ( $count, 3, ucfirst ( $dATA ['Output'] ['high'] ) );
							$this->writeLabel ( $count, 4, ucfirst ( $dATA ['Output'] ['low'] ) );
							$this->writeLabel ( $count, 5, ucfirst ( $dATA ['Output'] ['close'] ) );
							$this->writeLabel ( $count, 6, ucfirst ( $dATA ['Output'] ['volume'] ) );
							$count ++;
						}
					}
					
					$this->EOF ();
					exit ();
				}
				
				if ($format == 'txt') {
					$filePath = WWW_ROOT . 'csvall' . DS . $code . '.txt';
					$_fp = @fopen ( $filePath, 'w' );
					$_csv_data = "Date" . ',' . "Open" . ',' . "High" . ',' . "Low" . ',' . "Close" . ',' . "Volume" . "\n";
					
					@fwrite ( $_fp, $_csv_data );
					
					$txtSQL = 'select c.dse_code, Output.id, date_format(str_to_date(date, \'%d-%c-%Y\'), \'%Y-%m-%d\') as date, Output.open as open, Output.high as high, Output.low as low, Output.close as close, Output.volume as volume from symbols as c, outputs as Output  where c.id=Output.symbol and date =\'' . $targetDate . '\' order by Output.id asc';
					
					$dataList = $this->Symbol->query ( $txtSQL );
					
					if (! empty ( $dataList )) {
						foreach ( $dataList as $dATA ) {
							$dATA ['Output'] ['volume'] = $dATA ['Output'] ['volume'] + 0;
							$_csv_data = $dATA ['c'] ['dse_code'] . ',' . ucfirst ( $dATA [0] ['date'] ) . ',' . ucfirst ( $dATA ['Output'] ['open'] ) . ',' . ucfirst ( $dATA ['Output'] ['high'] ) . ',' . $dATA ['Output'] ['low'] . ',' . $dATA ['Output'] ['close'] . ',' . $dATA ['Output'] ['volume'] . ',' . "\n";
							@fwrite ( $_fp, $_csv_data );
						}
					}
					
					$fileName = $code . '.txt';
					
					header ( "Content-Disposition: attachment; filename=" . $fileName );
					readfile ( $filePath );
					exit ();
				}
			} 

			else {
				$this->Session->setFlash ( 'No data available.' );
				$this->redirect ( array ('action' => 'lastdaydata' ) );
			}
		}
	}
	
           
	function yearsdata() {
		$this->layout = 'default-one';
		$this->pageTitle = 'Stock Bangladesh :: Download Data';
		
		if (! $this->Session->check ( 'Auth.User' )) {
			
			$this->Session->setFlash ( 'Please login again.' );
			$this->redirect ( array ('controller' => 'users', 'action' => 'login' ) );
		}
		$userId = $this->Session->read ( 'Auth.User.id' );
		
		$durationInDays = 900;
		$todayStamp = time () + 6 * 60 * 60;
		$startstamp = $todayStamp - $durationInDays * 24 * 60 * 60;
		
		$symbolInfo = $this->Symbol->find ( 'list', array ('fields' => array ('id', 'dse_code' ) ) );
		
		foreach ( $symbolInfo as $symbolId => $symbolCode ) {
			$filePath = WWW_ROOT . 'data_cd' . DS . $symbolCode . '.csv';
			$_fp = @fopen ( $filePath, 'w' );
			$_csv_data = "Ticker" . ',' . "Date" . ',' . "Open" . ',' . "High" . ',' . "Low" . ',' . "Close" . ',' . "Volume" . "\n";
			
			@fwrite ( $_fp, $_csv_data );
			
			$csvSQL = 'select Output.id, date_format(str_to_date(date, \'%d-%c-%Y\'), \'%Y-%M-%d\') as date, Output.open as open, Output.high as high, Output.low as low, Output.close as close, Output.volume as volume from symbols as c, outputs as Output  where c.id=Output.symbol and c.id=' . $symbolId . ' and UNIX_TIMESTAMP(str_to_date(date, \'%d-%c-%Y\'))>' . $startstamp . ' order by Output.id desc';
			
			$dataList = $this->Symbol->query ( $csvSQL );
			
			if (! empty ( $dataList )) {
				foreach ( $dataList as $dATA ) {
					$_csv_data = $symbolCode . ',' . ucfirst ( $dATA [0] ['date'] ) . ',' . ucfirst ( $dATA ['Output'] ['open'] ) . ',' . ucfirst ( $dATA ['Output'] ['high'] ) . ',' . $dATA ['Output'] ['low'] . ',' . $dATA ['Output'] ['close'] . ',' . $dATA ['Output'] ['volume'] . ',' . "\n";
					@fwrite ( $_fp, $_csv_data );
				}
			}
		}
		die ( 'All CSV generated successfully.' );
	}
	
    
    function esignaldata() {

        $this->layout = 'default-one';

        $this->pageTitle = 'Stock Bangladesh :: Download Data';



        if (! $this->Session->check ( 'Auth.User' )) {



            $this->Session->setFlash ( 'Please login again.' );

            $this->Session->del('Auth.redirect');
            $this->Session->write('Auth.redirect', 'resources/esignaldata');
            $this->Session->write('Auth.gobackpage', 'resources/esignaldata');
            
            $this->redirect ( array ('controller' => 'users', 'action' => 'login' ) );

        }
         
        $this->Session->del('Auth.redirect');
        $userId = $this->Session->read ( 'Auth.User.id' );



        $symbolInfoList = $this->Symbol->find ( 'all', array ('fields' => array ('id', 'dse_code', 'name','category', 'last_agm_held', 'last_year_eps', 'q1', 'q2', 'q3', 'q4', 'market_lot', 'face_value', 'no_of_securities', 'share_percentage_public', 'share_percentage_director', 'share_percentage_institute','share_percentage_govt','year_end' ) ) );

        $financilaInfoList = array();

        foreach($symbolInfoList as $s_id)
        {
            $financilaInfoList[] = $this->Symbol->query ( ' SELECT fin_year,symbol_id, asset_val_per_share, dividend,q1_date,q2_date,q3_date,q4_date,record_date,earning_per_share,asset_val_per_share FROM company_financial_performance WHERE symbol_id='.$s_id['Symbol'] ['id'].' ORDER BY fin_year DESC LIMIT 2' );

        }

        //pr($financilaInfoList);

        $tempFinancilaInfoList = array ();
        $quaterDateList        = array ();
        $t = 1;
        foreach ( $financilaInfoList as $financilaInfo )
        {
            foreach($financilaInfo as $fin)
            {
                if ($fin ['company_financial_performance'] ['symbol_id'] > 1000 AND (!empty($fin ['company_financial_performance'] ['earning_per_share']) OR !empty($fin ['company_financial_performance'] ['asset_val_per_share'])))
                {
                    $tempFinancilaInfoList [$fin ['company_financial_performance'] ['symbol_id']] = $fin ['company_financial_performance'];
                    if($t%2 == 1)
                    {
                        $quaterDateList [$fin ['company_financial_performance'] ['symbol_id']] = $fin ['company_financial_performance'];
                    }
                    $t++;
                }
            }

        }

        $financilaInfoList = $tempFinancilaInfoList;

        //echo '<pre>';
        //pr($tempFinancilaInfoList); die;




        $tempSymbolInfoList = array ();

        foreach ( $symbolInfoList as $symbolInfo ) {

            if (isset ( $financilaInfoList [$symbolInfo ['Symbol'] ['id']] ))

            $symbolInfo ['cfp'] = $financilaInfoList [$symbolInfo ['Symbol'] ['id']];

            else

            $symbolInfo ['cfp'] = array ();



            $tempSymbolInfoList [$symbolInfo ['Symbol'] ['id']] = $symbolInfo;

        }



    //pr($tempSymbolInfoList); die;




        $filePath = WWW_ROOT . 'esignal' . DS . 'esignaldata.csv';

        //pr($filePath);

        $_fp = @fopen ( $filePath, 'w' );

        $_csv_data = "Ticker" . ',' . "Name" . ',' . "Category" . ',' . "Last AGM Held" . ',' . " EPS Last Year" . ',' . "EPS Q1" . ',' . "EPS Q2" . ',' . "EPS Q3" . ',' . "EPS Q4" . ',' . "Book Value" . ',' . "Divident" . ',' . "Market Lot" . ',' . "Face Value" . ',' . "Shares Out" . ',' . "Shares Float" . ',' . "Insider Hold Percentage" . ',' . "Institution Hold Percentage" . ',' . "Gov Holding" . ',' . "Last Q dec Date" . ',' . "Record Date" . ',' . "Year End"   . "\n";



        @fwrite ( $_fp, $_csv_data );



        if (! empty ( $tempSymbolInfoList )) {

            foreach ( $tempSymbolInfoList as $dATA ) {



                if (! isset ( $dATA ['cfp'] ['asset_val_per_share'] ))

                $dATA ['cfp'] ['asset_val_per_share'] = '';

                if (! isset ( $dATA ['cfp'] ['dividend'] ))

                $dATA ['cfp'] ['dividend'] = '';
                
                $dividend = explode(',',$dATA ['cfp'] ['dividend']);
                if(count($dividend)>1)
                {
                    $dATA ['cfp'] ['dividend'] = $dividend[0].' and '.$dividend[1];
                }
                

                $q_date = '';
                if ( !empty( $dATA ['cfp'] ['q1_date'] ))
                $q_date = $dATA ['cfp'] ['q1_date'];
                if ( !empty( $dATA ['cfp'] ['q2_date'] ))
                $q_date = $dATA ['cfp'] ['q2_date'];
                if ( !empty( $dATA ['cfp'] ['q3_date'] ))
                $q_date = $dATA ['cfp'] ['q3_date'];
                if ( !empty( $dATA ['cfp'] ['q4_date'] ))
                $q_date = $dATA ['cfp'] ['q4_date'];


                $_csv_data = $dATA ['Symbol'] ['dse_code'] . ',' . ucfirst ( $dATA ['Symbol'] ['name'] ) . ',' . $dATA ['Symbol'] ['category'] . ',' . $dATA ['Symbol'] ['last_agm_held'] . ',' . $dATA ['cfp'] ['earning_per_share'] . ',' . $dATA ['Symbol'] ['q1'] . ',' . $dATA ['Symbol'] ['q2'] . ',' . $dATA ['Symbol'] ['q3'] . ',' . $dATA ['Symbol'] ['q4'] . ',' . $dATA ['cfp'] ['asset_val_per_share'] . ',' . $dATA ['cfp'] ['dividend'] . ',' . $dATA ['Symbol'] ['market_lot'] . ',' . $dATA ['Symbol'] ['face_value'] . ',' . $dATA ['Symbol'] ['no_of_securities'] . ',' . $dATA ['Symbol'] ['share_percentage_public'] . ',' . $dATA ['Symbol'] ['share_percentage_director'] . ',' . $dATA ['Symbol'] ['share_percentage_institute'] . ',' . $dATA ['Symbol'] ['share_percentage_govt'] . ',' . $q_date . ',' . $dATA ['cfp'] ['record_date'] . ',' . $dATA ['Symbol'] ['year_end'] . ',' . "\n";

                @fwrite ( $_fp, $_csv_data );

            }

        }



        $fileName = 'esignaldata.csv';

        header ( "Content-Disposition: attachment; filename=" . $fileName );

        readfile ( $filePath );

        exit ();

    }

    function esignaldata_version2() {

        Configure::write('debug', 2);
        $this->layout = 'default-one';

        $this->pageTitle = 'Stock Bangladesh :: Download Data';



       /* if (! $this->Session->check ( 'Auth.User' )) {



            $this->Session->setFlash ( 'Please login again.' );

            $this->Session->del('Auth.redirect');
            $this->Session->write('Auth.redirect', 'resources/esignaldata');
            $this->Session->write('Auth.gobackpage', 'resources/esignaldata');

            $this->redirect ( array ('controller' => 'users', 'action' => 'login' ) );

        }*/

       // $this->Session->del('Auth.redirect');
      //  $userId = $this->Session->read ( 'Auth.User.id' );


        //$symbolInfoList = array();
        $symbolInfoList = $this->Symbol->query (' SELECT id,cse_code,business_segment,category,year_end,no_of_securities,share_percentage_director,share_percentage_govt,share_percentage_institute,share_percentage_foreign,share_percentage_public,reserve_and_surplus FROM symbols');
        foreach($symbolInfoList as $s)
        {
            $symbolList[$s['symbols']['id']]=$s;

        }

        $financilaInfoList = array();

pr($symbolList);
        foreach($symbolList as $s_id)
        {
            $financilaInfoList = $this->Symbol->query ( ' SELECT fin_year,symbol_id, asset_val_per_share, dividend,q1_date,q2_date,q3_date,q4_date,record_date,earning_per_share,asset_val_per_share FROM company_financial_performance WHERE symbol_id='.$s_id['Symbol'] ['id'].' ORDER BY fin_year DESC' );
           // $s_id['cfp']=$financilaInfoList;
            foreach($financilaInfoList as $a)
            {
                $b[$a['company_financial_performance']['fin_year']]=$a;

            }
          //  $b[]=$symbolList[$s_id['Symbol'] ['id']];

            pr($b);
            exit;

        }

             /*   $tempFinancilaInfoList = array ();

                foreach ( $financilaInfoList as $financilaInfo )
                {
                    foreach($financilaInfo as $fin)
                    {


                            $tempFinancilaInfoList [$fin ['company_financial_performance'] ['fin_year']] = $fin ['company_financial_performance'];


                    }
                  //  $financilaInfoList[] = $tempFinancilaInfoList;
                }

        $financilaInfoList[] = $tempFinancilaInfoList;

        //echo '<pre>';
        pr($financilaInfoList); die;
*/



        $tempSymbolInfoList = array ();

        foreach ( $symbolInfoList as $symbolInfo ) {

            if (isset ( $financilaInfoList [$symbolInfo ['Symbol'] ['id']] ))

                $symbolInfo ['cfp'] = $financilaInfoList [$symbolInfo ['Symbol'] ['id']];

            else

                $symbolInfo ['cfp'] = array ();



            $tempSymbolInfoList [$symbolInfo ['Symbol'] ['id']] = $symbolInfo;

        }



     //  pr($tempSymbolInfoList); die;




        $filePath = WWW_ROOT . 'esignal' . DS . 'esignaldata.csv';

        //pr($filePath);

        $_fp = @fopen ( $filePath, 'w' );

      //  $_csv_data = "Ticker" . ',' . "Name" . ',' . "Category" . ',' . "Last AGM Held" . ',' . " EPS Last Year" . ',' . "EPS Q1" . ',' . "EPS Q2" . ',' . "EPS Q3" . ',' . "EPS Q4" . ',' . "Book Value" . ',' . "Divident" . ',' . "Market Lot" . ',' . "Face Value" . ',' . "Shares Out" . ',' . "Shares Float" . ',' . "Insider Hold Percentage" . ',' . "Institution Hold Percentage" . ',' . "Gov Holding" . ',' . "Last Q dec Date" . ',' . "Record Date" . ',' . "Year End"   . "\n";



       // @fwrite ( $_fp, $_csv_data );



        if (! empty ( $tempSymbolInfoList )) {

            foreach ( $tempSymbolInfoList as $dATA ) {



             /*   if (! isset ( $dATA ['cfp'] ['asset_val_per_share'] ))

                    $dATA ['cfp'] ['asset_val_per_share'] = '';

                if (! isset ( $dATA ['cfp'] ['dividend'] ))

                    $dATA ['cfp'] ['dividend'] = '';

                $dividend = explode(',',$dATA ['cfp'] ['dividend']);
                if(count($dividend)>1)
                {
                    $dATA ['cfp'] ['dividend'] = $dividend[0].' and '.$dividend[1];
                }


                $q_date = '';
                if ( !empty( $dATA ['cfp'] ['q1_date'] ))
                    $q_date = $dATA ['cfp'] ['q1_date'];
                if ( !empty( $dATA ['cfp'] ['q2_date'] ))
                    $q_date = $dATA ['cfp'] ['q2_date'];
                if ( !empty( $dATA ['cfp'] ['q3_date'] ))
                    $q_date = $dATA ['cfp'] ['q3_date'];
                if ( !empty( $dATA ['cfp'] ['q4_date'] ))
                    $q_date = $dATA ['cfp'] ['q4_date'];*/


                foreach($dATA ['cfp'] as $fin_yr)
                {
                    $financialInfo[$fin_yr['company_financial_performance']['fin_year']]=$fin_yr['company_financial_performance'];
                }

               // pr($financialInfo);

                $_csv_data = $dATA ['Symbol'] ['cse_code'] . ',' .$dATA ['Symbol'] ['business_segment']  . ',' . $dATA ['Symbol'] ['category'] . ',' . $dATA ['Symbol'] ['year_end'] . ',' . $dATA ['Symbol'] ['no_of-securities'] . ',' . $dATA ['Symbol'] ['share_percentage_director'] . ',' . $dATA ['Symbol'] ['share_percentage_govt'] . ',' . $dATA ['Symbol'] ['share_percentage_institute'] . ',' . $dATA ['Symbol'] ['share_percentage_foreign'] . ',' . $dATA ['Symbol'] ['share_percentage_public'] . ',' . $financialInfo ['2014'] ['restated_net_asset_value_per_share'] . ',' . $financialInfo ['2013'] ['restated_net_asset_value_per_share'] . ',' . $financialInfo ['2012'] ['restated_net_asset_value_per_share']. ',' . $financialInfo ['2011'] ['restated_net_asset_value_per_share'] . ',' . $financialInfo ['2010'] ['restated_net_asset_value_per_share'] . ',' . $financialInfo ['2009'] ['restated_net_asset_value_per_share'] . ',' . $financialInfo ['2008'] ['restated_net_asset_value_per_share'] . ',' . $financialInfo ['2007'] ['restated_net_asset_value_per_share'] . ',' . $financialInfo ['2006'] ['asset_val_per_share'] . ',' . $financialInfo ['2005'] ['restated_net_asset_value_per_share'] . ',' . $financialInfo ['2014'] ['dividend'] . ',' .$dATA ['Symbol']['reserve_and_surplus'] . ',' . "\n";

                pr($dATA);
              //  pr($_csv_data);

             //   @fwrite ( $_fp, $_csv_data );

            }


        }

exit;

        $fileName = 'esignaldata.csv';

        header ( "Content-Disposition: attachment; filename=" . $fileName );

        readfile ( $filePath );

        exit ();

    }

    function amibrokerdata() {

        $this->layout = 'default-one';

        $this->pageTitle = 'Stock Bangladesh :: Download Data';



        if (! $this->Session->check ( 'Auth.User' )) {



            $this->Session->setFlash ( 'Please login again.' );

            $this->Session->del('Auth.redirect');
            $this->Session->write('Auth.redirect', 'resources/esignaldata');
            $this->Session->write('Auth.gobackpage', 'resources/esignaldata');

            $this->redirect ( array ('controller' => 'users', 'action' => 'login' ) );

        }

        $this->Session->del('Auth.redirect');
        $userId = $this->Session->read ( 'Auth.User.id' );



        $symbolInfoList = $this->Symbol->find ( 'all', array ('fields' => array ('id', 'dse_code','business_segment', 'name','category', 'last_agm_held', 'last_year_eps', 'q1', 'q2', 'q3', 'q4', 'market_lot', 'face_value', 'no_of_securities', 'share_percentage_public', 'share_percentage_director', 'share_percentage_institute','share_percentage_govt','year_end' ) ) );

        $financilaInfoList = array();

        foreach($symbolInfoList as $s_id)
        {
            $financilaInfoList[] = $this->Symbol->query ( ' SELECT fin_year,symbol_id, asset_val_per_share, dividend,q1_date,q2_date,q3_date,q4_date,record_date,earning_per_share,asset_val_per_share FROM company_financial_performance WHERE symbol_id='.$s_id['Symbol'] ['id'].' ORDER BY fin_year DESC LIMIT 2' );

        }

        //pr($financilaInfoList);

        $tempFinancilaInfoList = array ();
        $quaterDateList        = array ();
        $t = 1;
        foreach ( $financilaInfoList as $financilaInfo )
        {
            foreach($financilaInfo as $fin)
            {
                if ($fin ['company_financial_performance'] ['symbol_id'] > 1000 AND (!empty($fin ['company_financial_performance'] ['earning_per_share']) OR !empty($fin ['company_financial_performance'] ['asset_val_per_share'])))
                {
                    $tempFinancilaInfoList [$fin ['company_financial_performance'] ['symbol_id']] = $fin ['company_financial_performance'];
                    if($t%2 == 1)
                    {
                        $quaterDateList [$fin ['company_financial_performance'] ['symbol_id']] = $fin ['company_financial_performance'];
                    }
                    $t++;
                }
            }

        }

        $financilaInfoList = $tempFinancilaInfoList;

        //echo '<pre>';
        //pr($tempFinancilaInfoList); die;




        $tempSymbolInfoList = array ();

        foreach ( $symbolInfoList as $symbolInfo ) {

            if (isset ( $financilaInfoList [$symbolInfo ['Symbol'] ['id']] ))

            $symbolInfo ['cfp'] = $financilaInfoList [$symbolInfo ['Symbol'] ['id']];

            else

            $symbolInfo ['cfp'] = array ();



            $tempSymbolInfoList [$symbolInfo ['Symbol'] ['id']] = $symbolInfo;

        }



    //pr($tempSymbolInfoList); die;




        $filePath = WWW_ROOT . 'esignal' . DS . 'esignaldata.csv';

        //pr($filePath);

        $_fp = @fopen ( $filePath, 'w' );

        $_csv_data = "Ticker" . ',' . "Name" . ',' . "SectorName" . ',' . "IndustryName" . ','. "Category" . ',' . "Last AGM Held" . ',' . " EPS Last Year" . ',' . "EPS Q1" . ',' . "EPS Q2" . ',' . "EPS Q3" . ',' . "EPS Q4" . ',' . "Book Value" . ',' . "Divident" . ',' . "Market Lot" . ',' . "Face Value" . ',' . "Shares Out" . ',' . "Shares Float" . ',' . "Insider Hold Percentage" . ',' . "Institution Hold Percentage" . ',' . "Gov Holding" . ',' . "Last Q dec Date" . ',' . "Record Date" . ',' . "Year End"   . "\n";



        @fwrite ( $_fp, $_csv_data );



        if (! empty ( $tempSymbolInfoList )) {

            foreach ( $tempSymbolInfoList as $dATA ) {



                if (! isset ( $dATA ['cfp'] ['asset_val_per_share'] ))

                $dATA ['cfp'] ['asset_val_per_share'] = '';

                if (! isset ( $dATA ['cfp'] ['dividend'] ))

                $dATA ['cfp'] ['dividend'] = '';

                $dividend = explode(',',$dATA ['cfp'] ['dividend']);
                if(count($dividend)>1)
                {
                    $dATA ['cfp'] ['dividend'] = $dividend[0].' and '.$dividend[1];
                }


                $q_date = '';
                if ( !empty( $dATA ['cfp'] ['q1_date'] ))
                $q_date = $dATA ['cfp'] ['q1_date'];
                if ( !empty( $dATA ['cfp'] ['q2_date'] ))
                $q_date = $dATA ['cfp'] ['q2_date'];
                if ( !empty( $dATA ['cfp'] ['q3_date'] ))
                $q_date = $dATA ['cfp'] ['q3_date'];
                if ( !empty( $dATA ['cfp'] ['q4_date'] ))
                $q_date = $dATA ['cfp'] ['q4_date'];


                $_csv_data = $dATA ['Symbol'] ['dse_code'] . ',' . ucfirst ( $dATA ['Symbol'] ['name'] ). ',' . ucfirst ( $dATA ['Symbol'] ['business_segment'] ). ',' . ucfirst ( $dATA ['Symbol'] ['business_segment'] ). ',' . $dATA ['Symbol'] ['category'] . ',' . $dATA ['Symbol'] ['last_agm_held'] . ',' . $dATA ['cfp'] ['earning_per_share'] . ',' . $dATA ['Symbol'] ['q1'] . ',' . $dATA ['Symbol'] ['q2'] . ',' . $dATA ['Symbol'] ['q3'] . ',' . $dATA ['Symbol'] ['q4'] . ',' . $dATA ['cfp'] ['asset_val_per_share'] . ',' . $dATA ['cfp'] ['dividend'] . ',' . $dATA ['Symbol'] ['market_lot'] . ',' . $dATA ['Symbol'] ['face_value'] . ',' . $dATA ['Symbol'] ['no_of_securities'] . ',' . $dATA ['Symbol'] ['share_percentage_public'] . ',' . $dATA ['Symbol'] ['share_percentage_director'] . ',' . $dATA ['Symbol'] ['share_percentage_institute'] . ',' . $dATA ['Symbol'] ['share_percentage_govt'] . ',' . $q_date . ',' . $dATA ['cfp'] ['record_date'] . ',' . $dATA ['Symbol'] ['year_end'] . ',' . "\n";

                @fwrite ( $_fp, $_csv_data );

            }

        }



        $fileName = 'esignaldata.csv';

        header ( "Content-Disposition: attachment; filename=" . $fileName );

        readfile ( $filePath );

        exit ();

    }

    
	function sellmyshare($simulationIndex) {
		
		$this->layout = 'default-one';
		$this->pageTitle = 'Stock Bangladesh :: Sell My Share';
		
		if (! $this->Session->check ( 'Auth.User' )) {
			
			$this->Session->setFlash ( 'Please login again.' );
			$this->redirect ( array ('controller' => 'users', 'action' => 'login' ) );
		}
		$userId = $this->Session->read ( 'Auth.User.id' );
		
		$requestedRecommendationInfo = $this->Simulation->find ( 'first', array ('conditions' => array ('id=' . $simulationIndex ) ) );
		
		$endDate = time () + 12 * 60 * 60;
		$updateMySshare = $this->Simulation->query ( 'UPDATE `simulations` SET `status`=\'sell\', `end_date`=\'' . $endDate . '\' where id=' . $simulationIndex );
		$this->Session->setFlash ( 'You have sold your share successfully.' );
		$this->redirect ( array ('action' => 'selfevaluation' ) );
	}
    
     function dailyopenprice() {
         if (! $this->Session->check ( 'Auth.User' )) {
            $this->Session->setFlash ( 'You are not authorized to access that location.' );
            $this->redirect ( array ('controller' => 'users', 'action' => 'login' ) );
        }
        $this->layout = 'default-matrix';
        $this->pageTitle = 'Stock Bangladesh :: Daily Open Close Price';

    }

    function dailyvolumematrix() {
        if (! $this->Session->check ( 'Auth.User' )) {
            $this->Session->setFlash ( 'You are not authorized to access that location.' );
            $this->redirect ( array ('controller' => 'users', 'action' => 'login' ) );
        }
        $this->layout = 'default-matrix';
        $this->pageTitle = 'Stock Bangladesh :: Volume Based data Matrix';

    }
    function fundamatrix() {
        if (! $this->Session->check ( 'Auth.User' )) {
            $this->Session->setFlash ( 'You are not authorized to access that location.' );
            $this->redirect ( array ('controller' => 'users', 'action' => 'login' ) );
        }
        $this->layout = 'default-matrix';
        $this->pageTitle = 'Stock Bangladesh :: Fundamental data Matrix';

    }
    
function getopencomplist() {

        //$result = $this->Symbol->find ( 'all' );
        $symbolList = $this->Symbol->find('all', array('conditions' => array(' Symbol.dse_code != \'\' ','Symbol.inactive=\'No\'','Symbol.otc_market=\'No\'', 'Symbol.id > 1'), 'order' => ' Symbol.dse_code ASC '));
        $sql = "SELECT * FROM market_summeries ORDER BY id DESC LIMIT 0, 2";

        $marketArr = $this->Symbol->query ( "SELECT * FROM market_summeries ORDER BY id DESC LIMIT 0, 1");

        $lastdate = $marketArr [0] ['market_summeries'] ['date'];
        $Mdate = explode("-",$lastdate);
        $Odate = $Mdate[2].''.$Mdate[1].'-'.$Mdate[0];
        //pr($symbolList);
        $companyRowData = array();
        $companyOutputData = array();
        foreach ($symbolList as $name) {

            $companyOutputData = $this->Symbol->query('SELECT * FROM outputs WHERE symbol=\''.$name['Symbol']['id'].'\' order by id DESC LIMIT 2');
            $companyOutputData ['Symbol'] =  $name['Symbol'];
            $companyRowData[] = $companyOutputData;
        }

        $lowCloseBelow2dayOpen = array();
        $closeUp2dayOpen = array();
        $highUp2dayOpen = array();
        $highLow2dayOpen = array();
        $other2dayOpen = array();
        $coreDataCount = 1;


        //pr($companyRowData);
        foreach($companyRowData as $symbolData){

            if (($symbolData[0]['outputs']['volume']==0 ) && ($symbolData[0]['outputs']['date']!=$Odate )) {
                continue;
            }
            //07-07-2010  (output)       2010-07-07 (market)

            $todayOpenPrice =  $symbolData[0]['outputs']['open'];
            $yLowPrice =  $symbolData[1]['outputs']['low'];
            $yClosePrice =  $symbolData[1]['outputs']['close'];
            $yHignPrice =  $symbolData[1]['outputs']['high'];
            //$yHignPrice =  $symbolData[0]['outputs']['high'];

            if($todayOpenPrice < $yLowPrice) {
                $lowCloseBelow2dayOpen[] =  $symbolData;
                $coredata ['pricechange'] = 'Opened below YLP';
            }else if($todayOpenPrice < $yClosePrice) {
                $closeUp2dayOpen[] =  $symbolData;
                $coredata ['pricechange'] = 'Opened between YLP and YCP';
            }else if($todayOpenPrice > $yHignPrice) {
                $highUp2dayOpen[] =  $symbolData;
                $coredata ['pricechange'] = 'Opened above YHP';
            }else if(($todayOpenPrice <= $yHignPrice) && ($todayOpenPrice > $yClosePrice)) {
                $highLow2dayOpen[] =  $symbolData;
                $coredata ['pricechange'] = 'Opened between YCP and YHP';
            }else {
                $other2dayOpen[] =  $symbolData;
                $coredata ['pricechange'] = 'Opened at YCP';
            }

            $qeps   = 0;
            $factor = 1;
            $querterNo = 1;
            if($symbolData['Symbol']['q1'])
            {
                $qeps   = $symbolData['Symbol']['q1'];
                $factor = 4;
                $querterNo = "Q1";
            }
            if($symbolData['Symbol']['q2'])
            {
                $qeps   = $symbolData['Symbol']['q2'];
                $factor = 2;
                $querterNo = "Q2";
            }
            if($symbolData['Symbol']['q3'])
            {
                $qeps   = $symbolData['Symbol']['q3'];
                $factor = 4/3;
                $querterNo = "Q3";
            }
            if($symbolData['Symbol']['q4'])
            {
                $qeps   = $symbolData['Symbol']['q4'];
                $factor = 1;
                $querterNo = "Annual";
            }

            //pr($qeps);
            //pr($factor);
            $annualizedEPS    = $qeps*$factor;
            $pe = 0;
            if($annualizedEPS != 0)
            $pe = $symbolData['Symbol']['lasttradeprice']/$annualizedEPS;
            $annualizedEPS = round($annualizedEPS,2);
            $pe = round($pe,2);
            if($pe < 0)
            {
                $pe = "Negetive";
            }


            $coredata ['id'] = $coreDataCount ++;

            $coredata ['code'] = $symbolData['Symbol']['dse_code'].'  ('.$symbolData['Symbol']['category'].')' ;
            //$coredata ['code'] = $symbolData['Symbol']['dse_code'].'('.$symbolData['Symbol']['business_segment'].'/'.$symbolData['Symbol']['category'].')' ;
            $coredata ['face_value'] = $symbolData['Symbol']['face_value'].'/'.$symbolData['Symbol']['market_lot'];
            $coredata ['difference'] = $symbolData[0]['outputs']['open'] - $symbolData[1]['outputs']['close'];
            $coredata ['lastprice'] = $symbolData[0]['outputs']['close'];
            $coredata ['open_difference'] = $symbolData[0]['outputs']['close'] - $symbolData[0]['outputs']['open'];
            $coredata ['open'] = $symbolData[0]['outputs']['open'];
            $coredata ['high'] = $symbolData[0]['outputs']['high'];
            $coredata ['low'] = $symbolData[0]['outputs']['low'];
            $coredata ['volume'] = round($symbolData[0]['outputs']['volume']);
            $coredata ['eps'] = $annualizedEPS;
            //$paramData ['sym'] = $symbolData['Symbol']['id'];
            // $paramData ['inv'] = 60;


            //$coredata ['green'] = $this->minutechart($paramData,'positive');
            //$coredata ['red'] = $this->minutechart($paramData,'negative');
            $coredata ['pe'] = $pe;
            /*
            code (sector/catgiry)
            face-value/market-lot
            difference (close and open)
            lasttradeprice
            open
            high
            low
            volume
            green(minute) [Below or Equal previous minute's Price]
            red(minute)   [Traded Above previous minute's price]
            green-red
            eps
            p/e
            */
            //$coredata ['sector'] = trim ( $symbolList[$symbolData[1]['outputs']['symbol']]);
            //$coredata ['category'] = trim ( $symbolList[$symbolData[1]['outputs']['symbol']]);
            $arrall [] = $coredata;
        }
        $arr = $arrall;


        $jsonresult = $this->__JEncode ( $arr );

        echo '({"total":"' . count ( $symbolList ) . '","results":' . $jsonresult . '})';


        die ();



    }

    function minutechartall() {

        set_time_limit(0);
        //pr($_REQUEST);
        //pr($updateRequest);
        $this->layout = 'default-one';

        $this->pageTitle = 'Stock Bangladesh :: Minute Chart - Price Chart/ Graph';

        $inv = 60;
        $inv1 = 300;

        $symbolList = $this->Symbol->find ( 'all', array ('conditions' => array ('id > 1000 AND inactive=\'No\' AND name!= \'\'  AND otc_market= \'No\' ' ), 'order' => 'name', 'fields' => array ('Symbol.id', 'Symbol.name', 'Symbol.dse_code' , 'Symbol.no_of_securities', 'Symbol.share_percentage_public', 'Symbol.lasttradeprice', 'Symbol.business_segment' ) ) );
        //$symbolList = $this->Symbol->find ( 'all', array ('conditions' => array ('id > 1000 AND inactive=\'No\' AND name!= \'\' ' ), 'order' => 'name', 'fields' => array ('Symbol.id', 'Symbol.name', 'Symbol.dse_code' , 'Symbol.no_of_securities', 'Symbol.share_percentage_public', 'Symbol.lasttradeprice', 'Symbol.business_segment' ), 'limit' => 110 ) );

        //echo "time=".time();

        //print_r($symbolList);
        //die('s');
        //print_r($symbolList);
        //pr($symbolList);
        //die();
        $marketArr = $this->Symbol->query ( "SELECT * FROM market_summeries ORDER BY id DESC LIMIT 0, 1");

        $lastdate = $marketArr [0] ['market_summeries'] ['date'];
        //$lastdate = '2010-10-13';
        $Mdate = explode("-",$lastdate);
        $Odate = $Mdate[2].'-'.$Mdate[1].'-'.$Mdate[0];
        //$OdateTime = strtotime($lastdate);
        //$OdateTime = $OdateTime + 6*60*60;
        

        $count = 0;
        foreach ($symbolList as $symbolArr) {
            $code = $symbolArr['Symbol']['dse_code'];
            $name = $symbolArr['Symbol']['name'];
            $symbol = $symbolArr['Symbol']['id'];
            $tnos = $symbolArr['Symbol']['no_of_securities'];
            $pubper = $symbolArr['Symbol']['share_percentage_public'];
            $lastTradePrice = $symbolArr['Symbol']['lasttradeprice'];
            $business_segment = $symbolArr['Symbol']['business_segment'];


            //pr($symbolList);
            $companyOutputData = $this->Symbol->query('SELECT * FROM outputs WHERE symbol=\''.$symbol.'\' order by id DESC LIMIT 3');
            //$companyOutputData = $this->Symbol->query('SELECT * FROM outputs WHERE symbol=\''.$symbol.'\' AND daystamp<'.$OdateTime.' order by id DESC LIMIT 3');
            $companyOutputData ['Symbol'] =  $name['Symbol'];
            //$companyRowData[] = $companyOutputData;
            //pr($companyOutputData);

            if (($companyOutputData[0]['outputs']['volume']==0 ) || ($companyOutputData[0]['outputs']['date']!=$Odate )) {
                //die();
                continue;
            }

            $immaturedVolume =  $companyOutputData[0]['outputs']['volume'] + $companyOutputData[1]['outputs']['volume'] + $companyOutputData[2]['outputs']['volume'];


            $minute = $inv / 60;
            if($count% 50 == 0) {
                //set_time_limit(120);
            }

            //echo ($code.'--'.$name);
            //die();
            $getLastIntradayId = $this->Symbol->query ( 'SELECT value from configuration WHERE name=\'data_bank_intraday_lid\' ' );
            $getLastIntradayId = $getLastIntradayId [0] ['configuration'] ['value'];

            /*--- FIRST USE OF MEMCACHE :: START HERE ---*/
            
            if (class_exists ( 'Memcache' )) {
                $memcache = new Memcache ( );
                $memcache->connect ( 'localhost', 11211 ) or die ( "Could not connect" );
                $memKey3 = md5 ( 'select * from stockorg_stock.data_banks_intraday where symbol_id =' . $symbol . ' AND id > ' . $getLastIntradayId . ' ORDER BY id DESC' );
                if (! $memcache->get ( $memKey3 )) {
                    $shareData = $this->Symbol->query ( 'select * from stockorg_stock.data_banks_intraday where symbol_id =' . $symbol . ' AND id > ' . $getLastIntradayId . ' ORDER BY id DESC' );
                    $memcache->set ( $memKey3, $shareData, MEMCACHE_COMPRESSED, 60 );
                }
                $shareData = $memcache->get ( $memKey3 );

            } else {
                $shareData = $this->Symbol->query ( 'select * from stockorg_stock.data_banks_intraday where symbol_id =' . $symbol . ' AND id > ' . $getLastIntradayId . ' ORDER BY id DESC' );
                //$shareData = $this->Symbol->query ( 'select * from data_banks_intraday where symbol_id =' . $symbol . ' AND TO_DAYS(FROM_UNIXTIME(date)) = TO_DAYS(\''.$lastdate.'\') ORDER BY id DESC' );
            }
            
            
            /*--- FIRST USE OF MEMCACHE :: END HERE ---*/
            // echo "time=".time()."<br />";

            $timeWiseArr = array ();
            $timeKeyArr  = array ();

            foreach ( $shareData as $row ) {
                $currenttime = $row ['data_banks_intraday'] ['date'];
                //$currenttime = $currenttime + (8*60*60);

                $mod = $currenttime % $interval;
                $timeToBeAccounted = $currenttime - $mod + $interval;
                //echo date('h:i A', $timeToBeAccounted).'<br><br>';
                $timeWiseArr [$timeToBeAccounted] [] = $row;

                $modtime = date ( 'd M  h:ia', $timeToBeAccounted );
            }

            $rowDataVolumeStart = 0;
            $rowDataVolumeEnd = 0;
            $currentDataVolume = 0;
            $tempVolumeCounter = 0;
            $totalArrayCount = count($timeWiseArr);
            $myDefinedCounter = 1;
            foreach ( $timeWiseArr as $key => $arr ) {
                $timeKeyArr [] = $key;
            }

            //pr($tempVolumeCounter);
            $finalArr = array ();
            $totalvolume = $shareData [0] ['data_banks_intraday'] ['volume'];
            $tradetimestamp = $shareData [0] ['data_banks_intraday'] ['date'];
            $dayhigh = $shareData [0] ['data_banks_intraday'] ['high'];
            $daylow = $shareData [0] ['data_banks_intraday'] ['low'];
            $totaltrade = $shareData [0] ['data_banks_intraday'] ['trade'];
            $yclose=$shareData [0] ['data_banks_intraday'] ['yclose'];

            $tradeDate = date ( 'd M y h:ia', $tradetimestamp );
            $i = 0;
            $singleCount = 0;
            $finalPrice = 0;
            //pr($timeWiseArr);
            $startPrice = 0;
            $endPrice = 0;
            foreach ( $timeWiseArr as $key => $arr ) {
                $datetime = date ( 'h:i A', $key );
                $temp = array ();
                $startArr = array ();
                $endArr = array ();
                $ind = count ( $arr );
                $counterArr = count($arr);
                $finalPrice = $arr[0]['data_banks_intraday']['close'];


                if(!$rowDataVolumeStart) {
                    $rowDataVolumeStart = $arr[0]['data_banks_intraday']['volume'];
                    $startPrice = $arr[0]['data_banks_intraday']['close'];
                }

                if($myDefinedCounter==$totalArrayCount){
                    $rowDataVolumeEnd  =0;
                    $endPrice = $arr[0]['data_banks_intraday']['yclose'];
                }else {
                    $rowDataVolumeEnd = $arr[$counterArr-1]['data_banks_intraday']['volume'];
                    $endPrice = $arr[0]['data_banks_intraday']['close'];

                }

                //$endArr ['data_banks_intraday'] ['lastprice'];






                if ($ind == 1) {
                    $startArr = $arr [$ind - 1];
                    $endArr = $arr [$ind - 1];

                    if (isset ( $timeKeyArr [$i + 1] )) {
                        $time = $timeKeyArr [$i + 1];
                        $endvolume = $timeWiseArr [$time] [0] ['data_banks_intraday'] ['volume'];
                    } else {
                        $endvolume = 0;
                    }
                    $startvolume = $startArr ['data_banks_intraday'] ['volume'];
                } else {


                    //$startArr = $arr [0];
                    if (isset ( $timeKeyArr [$i] )) {
                        $time = $timeKeyArr [$i];

                        $preArrInd = count ($timeWiseArr [$time] );

                        $startvolume = $timeWiseArr [$time] [0] ['data_banks_intraday'] ['volume'];
                        //pr("found");
                    } else {
                        $startvolume = 0;
                        //pr('NO');
                    }





                    $endArr = $arr [$ind - 1];

                    if (isset ( $endArr )) {
                        $endvolume = $endArr ['data_banks_intraday'] ['volume'];
                    } else {
                        $endvolume = 0;
                    }
                }
                //pr($startvolume);
                //$temp ['ltp'] = $endArr ['data_banks_intraday'] ['lastprice'];
                $temp ['ltp'] = $finalPrice;
                $finalPrice = $arr[$counterArr-1]['data_banks_intraday']['lastprice'];
                //$lastTradePrice = $finalPrice; 

                //$temp['open']      = $endArr['data_banks_intraday']['open'];
                $temp ['high'] = $endArr ['data_banks_intraday'] ['high'];
                $temp ['low'] = $endArr ['data_banks_intraday'] ['low'];
                $temp ['close'] = $endArr ['data_banks_intraday'] ['close'];
                $temp ['yclose'] = $endArr ['data_banks_intraday'] ['yclose'];
                $temp ['trade'] = $endArr ['data_banks_intraday'] ['trade'];
                //$tempVolumeCounter += $rowDataVolumeStart - $rowDataVolumeEnd;


                //$temp ['volume'] = $finalVolume;
                //$finalVolume =  $rowDataVolumeStart - $rowDataVolumeEnd;
                $temp ['volume'] = $rowDataVolumeStart - $rowDataVolumeEnd;

                //$temp ['volume'] = $startvolume - $endvolume;
                if($startPrice > $endPrice){
                    $myPositiveCounter += $temp ['volume'];

                }else {
                    $myNegativeCounter += $temp ['volume'];
                }

                $rowDataVolumeStart = $rowDataVolumeEnd;
                $startPrice = $endPrice;
                $myDefinedCounter++;

                //$totalVolumeCompared+= $temp ['volume'];
                $temp ['value'] = $endArr ['data_banks_intraday'] ['value'];
                $temp ['datetime'] = $datetime;
                $temp ['idatetime'] = $key;
                $finalArr [] = $temp;

                ++ $i;
            }

            $xdata = array ();
            $ydata = array ();
            $vdata = array ();

            $totalbar = count ( $finalArr );

            foreach ( $finalArr as $mykey => $row ) {
                $volumetemp = $row ['volume'];

                if ($volumetemp < 0) {
                    continue;
                }

                $xdata [] = $row ['ltp'];
                $vdata [] = $finalArr [$mykey +1] =$row ['volume'];

                if ($interval < 120 && $totalbar > 80) {

                    if ($interval == 60) {
                        $yint = 600;
                    } else {
                        $yint = 300;
                    }
                    $currenttime = $row ['idatetime'];

                    $mod = $currenttime % $yint;

                    if ($mod == 0) {
                        $ydata [] = $row ['datetime'];
                    } else {
                        $ydata [] = "-";
                    }
                } else {
                    $ydata [] = $row ['datetime'];
                }

            }



            $xdata = array_reverse ( $xdata );
            $ydata = array_reverse ( $ydata );
            $vdata = array_reverse ( $vdata );
            //array_shift
            $max = 50;

            $lastprice = $xdata [count ( $xdata ) - 1];
            $lasttime = $ydata [count ( $ydata ) - 1];
            $lastvolume = $vdata [count ( $vdata ) - 1];

            array_unshift($vdata, 0);
            //array_pop($vdata);
            //pr($vdata);
            # The data for the chart
            $myPositiveCounter=0;
            $myNegativeCounter=0;
            $myEqualCounter=0;

            if($yclose<$xdata[0])
            {
                $myPositiveCounter=$vdata[0];
            }
            if($yclose>$xdata[0])
            {
                $myNegativeCounter=$vdata[0];
            }
            /* echo "<pre >";
            echo "xdata";
            print_r($xdata);
            echo "vdata";
            print_r($vdata);
            exit;
            */
            for($i=0;$i<count($vdata);$i++)
            {
                if($xdata[$i]>$xdata[$i-1])
                {

                    $myPositiveCounter+=$vdata[$i];
                    //echo $myPositiveCounter."myPositiveCounter[".$vdata[$i]."]".$xdata[$i-1].">".$xdata[$i]."<br />";
                }
                if ($xdata[$i]<$xdata[$i-1])
                {
                    $myNegativeCounter+=$vdata[$i];
                    //echo $myNegativeCounter."myNegativeCounter[".$vdata[$i]."]".$xdata[$i-1]."<=".$xdata[$i]."<br />";
                }
                if ($xdata[$i]==$xdata[$i-1])
                {
                    $myEqualCounter+=$vdata[$i];

                }


            }
            //exit;
            $data0 = $xdata;
            $data1 = $vdata;
            $labels = $ydata;

            $myPositivePer=($myPositiveCounter/$totalvolume)*100;
            $myPositivePer=round($myPositivePer,2);

            $myNegativePer=($myNegativeCounter/$totalvolume)*100;
            $myNegativePer=round($myNegativePer,2);

            $myEqualPer=($myEqualCounter/$totalvolume)*100;
            $myEqualPer=round($myEqualPer,2);
            //pr($shareData);
            $count++;


            $coredata ['id'] = $count ++;
            $coredata ['code'] = trim ( $code );
            $coredata ['sector'] = trim ( $business_segment );
            $coredata ['tnos'] = $tnos;
            $coredata ['pubper'] = $pubper;
            $coredata ['pubnumb'] = round($tnos * $pubper/100);
            $coredata ['bull_vol'] = $myPositiveCounter;
            $coredata ['bull_per'] = $myPositivePer;
            $coredata ['bear_vol'] = $myNegativeCounter;
            $coredata ['bear_per'] = $myNegativePer;
            $coredata ['nutral'] = $myEqualCounter;
            $coredata ['nutral_per'] = $myEqualPer;
            $coredata ['tot_per'] = ($myEqualPer + $myPositivePer + $myNegativePer);
            $coredata ['tot_vol'] = $totalvolume;
            $coredata ['immature'] = $immaturedVolume;
            $coredata ['open'] = $endArr ['data_banks_intraday'] ['open'];
            $coredata ['lastprice'] = $lastTradePrice;


            $arrall [] = $coredata;

        }
        $arr = $arrall;
        $jsonresult = $this->__JEncode ( $arr );

        echo '({"total":"' . count ( $symbolList ) . '","results":' . $jsonresult . '})';
        die();
    }

    function getfundamatrix() {

        //  set_time_limit(0);
        //pr($_REQUEST);
        //pr($updateRequest);
       // Configure::write('debug',3);
        $this->layout = 'default-one';

        $this->pageTitle = 'Stock Bangladesh :: Fundamental Data Matrix';

        $inv = 60;
        $inv1 = 300;

        $symbolList = $this->Symbol->find ( 'all', array ('conditions' => array ('id > 1000 AND inactive=\'No\' AND name!= \'\'  AND otc_market= \'No\' ' ), 'order' => 'name', 'fields' => array ('Symbol.id', 'Symbol.name', 'Symbol.dse_code' ,'outstanding_capital','face_value', 'Symbol.no_of_securities', 'Symbol.share_percentage_public','Symbol.share_percentage_institute','Symbol.share_percentage_govt','Symbol.share_percentage_director', 'Symbol.lasttradeprice', 'Symbol.business_segment', 'Symbol.category', 'Symbol.q1' , 'Symbol.q2', 'Symbol.q3', 'Symbol.q4') ) );
        //$symbolList = $this->Symbol->find ( 'all', array ('conditions' => array ('id > 1000 AND inactive=\'No\' AND name!= \'\' ' ), 'order' => 'name', 'fields' => array ('Symbol.id', 'Symbol.name', 'Symbol.dse_code' , 'Symbol.no_of_securities', 'Symbol.share_percentage_public', 'Symbol.lasttradeprice', 'Symbol.business_segment' ), 'limit' => 110 ) );

        //echo "time=".time();

        //pr($symbolList);
        //die();
        //print_r($symbolList);

        $marketArr = $this->Symbol->query ( "SELECT * FROM market_summeries ORDER BY id DESC LIMIT 0, 1");

        $lastdate = $marketArr [0] ['market_summeries'] ['date'];
        $Mdate = explode("-",$lastdate);
        $Odate = $Mdate[2].'-'.$Mdate[1].'-'.$Mdate[0];



        $count = 0;
        foreach ($symbolList as $symbolArr) {
            $code = $symbolArr['Symbol']['dse_code'];
            $name = $symbolArr['Symbol']['name'];
            $symbol = $symbolArr['Symbol']['id'];
            $tnos = $symbolArr['Symbol']['no_of_securities'];
            $pubper = $symbolArr['Symbol']['share_percentage_public'];
            $dirper = $symbolArr['Symbol']['share_percentage_director'];
            $instper = $symbolArr['Symbol']['share_percentage_institute'];
            $govtper = $symbolArr['Symbol']['share_percentage_govt'];
            $lastTradePrice = $symbolArr['Symbol']['lasttradeprice'];
            $business_segment = $symbolArr['Symbol']['business_segment'];
            $outstanding_capital=$symbolArr['Symbol']['outstanding_capital'];
            $face_value=$symbolArr['Symbol']['face_value'];
            $category=$symbolArr['Symbol']['category'];

            //pr($symbolList);
            $count++;


            $companyOutputData = $this->Symbol->query('SELECT * FROM outputs WHERE symbol=\''.$symbol.'\' order by id DESC LIMIT 3');
            $companyOutputData ['Symbol'] =  $name['Symbol'];
            //$companyRowData[] = $companyOutputData;
            //pr($companyOutputData);

            if (($companyOutputData[0]['outputs']['volume']==0 ) || ($companyOutputData[0]['outputs']['date']!=$Odate )) {
                continue;
            }

            $immaturedVolume =  $companyOutputData[0]['outputs']['volume'] + $companyOutputData[1]['outputs']['volume'] ;//+ $companyOutputData[2]['outputs']['volume'];



            $financialPerformance = $this->Symbol->query('SELECT * FROM company_financial_performance as performance WHERE symbol_id='.$symbol.' AND earning_per_share!=\'\' ORDER BY fin_year DESC LIMIT 1');
            $companyFinPerfNav = $this->Symbol->query("SELECT * FROM `company_financial_performance` WHERE `symbol_id`='".$symbol."' and asset_val_per_share!=''  ORDER BY  fin_year DESC LIMIT 1");
            $authorizedcapital = $this->Symbol->query("SELECT * FROM `company_financial_performance` WHERE `symbol_id`='".$symbol."' and authorized_capital!='' ORDER BY  fin_year DESC LIMIT 1");
            
            /*if(!empty($financialPerformance[0]['performance']['nav'])){
                if(!empty($financialPerformance[0]['performance']['nav_restat'])){
                    $nav = $financialPerformance[0]['performance']['nav_restat']+0;
                }else{
                    $nav =$financialPerformance[0]['performance']['nav']+0;
                }
            }
            */
            $authorized_capital = $authorizedcapital[0]['company_financial_performance']['authorized_capital'];
            if(!empty($companyFinPerfNav[0]['company_financial_performance']['asset_val_per_share'])){
                 $nav = $companyFinPerfNav[0]['company_financial_performance']['asset_val_per_share'];
            }else {
                 $nav = $companyFinPerfNav[0]['company_financial_performance']['restated_net_asset_value_per_share'];
            }
                
            //pr($authorizedcapital);
            
            $qeps   = 0;
            $factor = 1;
            $querterNo = 1;
            if($symbolArr['Symbol']['q1'])
            {
                $qeps   = $symbolArr['Symbol']['q1'];
                $factor = 4;
                $querterNo = "Q1";
            }
            if($symbolArr['Symbol']['q2'])
            {
                $qeps   = $symbolArr['Symbol']['q2'];
                $factor = 2;
                $querterNo = "Q2";
            }
            if($symbolArr['Symbol']['q3'])
            {
                $qeps   = $symbolArr['Symbol']['q3'];
                $factor = 4/3;
                $querterNo = "Q3";
            }
            if($symbolArr['Symbol']['q4'])
            {
                $qeps   = $symbolArr['Symbol']['q4'];
                $factor = 1;
                $querterNo = "Annual";
            }

            //pr($qeps);
            //pr($factor);
            $annualizedEPS    = $qeps*$factor;
            $pe = 0;
            if($annualizedEPS != 0)
            $pe = $symbolArr['Symbol']['lasttradeprice']/$annualizedEPS;
            $annualizedEPS = round($annualizedEPS,2);
            $pe = round($pe,2);
            if($pe < 0)
            {
                $pe = "Negetive";
            }

            $coredata ['id'] = $count ++;
            $coredata ['code'] = trim ( $code );
            $coredata ['sector'] = trim ( $business_segment );
            $coredata ['tnos'] = $tnos;
            $coredata ['dirper'] = $dirper;
            $coredata ['instper'] = $instper;
            $coredata ['govtper'] = $govtper;
            $coredata ['pubper'] = $pubper;
            $pubnumb=round($tnos * $pubper/100);
            $coredata ['pubnumb'] = $pubnumb;
            $coredata ['paidup'] =$outstanding_capital;
            $publiccap=($pubnumb*$lastTradePrice)/1000000;
            $coredata ['publiccap'] =round($publiccap,2);
            $coredata ['nav'] =$nav+0;
            $coredata ['pnav'] =round($lastTradePrice/$nav,2);
            $coredata ['facevalue'] = $face_value;
            $coredata ['category'] = $category;
            // $coredata ['bull_vol'] = $myPositiveCounter;
            //$coredata ['bull_per'] = $myPositivePer;
            //$coredata ['bear_vol'] = $myNegativeCounter;
            //$coredata ['bear_per'] = $myNegativePer;
            //$coredata ['nutral'] = $myEqualCounter;
            //$coredata ['nutral_per'] = $myEqualPer;
            $coredata ['immature'] = $immaturedVolume;
            $coredata ['tradeable'] = $pubnumb-$immaturedVolume;
            //$coredata ['open'] = $endArr ['data_banks_intraday'] ['open'];
            $coredata ['lastprice'] = $lastTradePrice;
            $coredata ['pe'] = $pe;
            
            $coredata ['average'] = round(($coredata ['nav'] + $lastTradePrice)/2,2);
            $coredata ['marginratio'] = round(($coredata ['average']/$lastTradePrice),2);
            $coredata ['authorized'] = $authorized_capital+0;
            
            $marginAllow = 'No';
            if($pe > 0 && $pe <40) {
                $marginAllow =  'Yes';    
            }
            $coredata ['marginallow'] = $marginAllow;


            $arrall [] = $coredata;

        }
        $arr = $arrall;
        $jsonresult = $this->__JEncode ( $arr );

        echo '({"total":"' . count ( $symbolList ) . '","results":' . $jsonresult . '})';
        die();
    }
    function minutechartprev($updateRequest = '') {
        if (! $this->Session->check ( 'Auth.User' )) {
            $this->Session->setFlash ( 'You are not authorized to access that location.' );
            $this->redirect ( array ('controller' => 'users', 'action' => 'login' ) );
        }

       $this->layout = 'default-one';
        $this->pageTitle = 'Stock Bangladesh :: Minute Chart - Price Chart/ Graph';
        
        $nameOfTheDay = date ( 'l' );
        if ($nameOfTheDay == 'Friday')
            $requestTimeStamp = mktime ( 0, 0, 0, date ( 'm' ), date ( 'd' ) - 1, date ( 'Y' ) );
        else if ($nameOfTheDay == 'Saturday')
            $requestTimeStamp = mktime ( 0, 0, 0, date ( 'm' ), date ( 'd' ) - 2, date ( 'Y' ) );
        else
            $requestTimeStamp = mktime ( 0, 0, 0, date ( 'm' ), date ( 'd' ), date ( 'Y' ) );
            
        $requestdate = date('Y-m-d',$requestTimeStamp);
        $this->set ( 'date', $requestdate );
      
        
        if(isset($_REQUEST ['TickerSymbol']) AND isset($_REQUEST ['inv']) AND isset($_REQUEST ['date']))
        {
            $updateRequest ['sym'] = $_REQUEST ['TickerSymbol'];
            $updateRequest ['inv'] = $_REQUEST ['inv'];
         $tmpArr = array();
         $tmpArr['date'] = $_REQUEST ['date'];
         $this->data['date'] = $_REQUEST ['date'];
        }    
        $inv = 60;
        $inv1 = 300;
        if (isset ( $updateRequest ['sym'] ) && $updateRequest ['sym'] != '')

        $_REQUEST ['TickerSymbol'] = $updateRequest ['sym'];
        
        if (isset ( $updateRequest ['inv'] ) && $updateRequest ['inv'] != '')

        $_REQUEST ['inv'] = $updateRequest ['inv'];

        if (isset ( $_REQUEST ['TickerSymbol'] )) {

            $inv = $_REQUEST ['inv']; 
        
        $requestdate = $this->data['date'];
        if(empty($this->data))    
            $requestdate = $_REQUEST ['date'];
       // pr($_REQUEST ['date']); die; 
        
        
        if(empty($requestdate) AND empty($_REQUEST['TickerSymbol']))
            {
               $nameOfTheDay = date ( 'l' );
                if ($nameOfTheDay == 'Friday')
                    $requestTimeStamp = mktime ( 0, 0, 0, date ( 'm' ), date ( 'd' ) - 1, date ( 'Y' ) );
                else if ($nameOfTheDay == 'Saturday')
                    $requestTimeStamp = mktime ( 0, 0, 0, date ( 'm' ), date ( 'd' ) - 2, date ( 'Y' ) );
                else
                    $requestTimeStamp = mktime ( 0, 0, 0, date ( 'm' ), date ( 'd' ), date ( 'Y' ) );
                    
                $requestdate = date('Y-m-d',$requestTimeStamp);
                $this->set ( 'date', $requestdate );
                
                   
            }
            else
            {
                $this->set ( 'date', $requestdate );
                $date = explode('-',$requestdate);
                $year = $date[0]; 
                $month = $date[1];
                $day =  $date[2]; 
                $requestTimeStamp = mktime ( 6, 0, 0, $month, $day, $year );
            }
            
            $today = date('Y-m-d',time());  
            if($today == $requestdate)
            {
                $tradedateprev = $this->MarketSummery->query("SELECT date FROM market_summeries WHERE date<'$requestdate' ORDER BY date DESC limit 3");
            }else{
                $tradedatenext = $this->MarketSummery->query("SELECT date FROM market_summeries WHERE date>'$requestdate' ORDER BY date ASC limit 3");
                $tradedateprev = $this->MarketSummery->query("SELECT date FROM market_summeries WHERE date<'$requestdate' ORDER BY date DESC limit 3");
            }    

            $symbol = $_REQUEST ['TickerSymbol'];
            
            $this->set ('nextdate', $tradedatenext[0]['market_summeries']['date']);
            $next = explode('-',$tradedatenext[0]['market_summeries']['date']);
            $nexttimestamp = mktime ( 0, 0, 0, $next[1], $next[2], $next[0] );
            
            $nextvolumesql = "SELECT * FROM volume_data WHERE symbol = $symbol AND TO_DAYS(FROM_UNIXTIME(date))= TO_DAYS(FROM_UNIXTIME('$nexttimestamp'))";//date = 1290318051";TO_DAYS(FROM_UNIXTIME(date))= TO_DAYS(FROM_UNIXTIME(' . $nexttimestamp . ')) ";
            $datanext = $this->Symbol->query($nextvolumesql);
            $this->set('bullnext',$datanext[0]['volume_data']['bull_volume']);
            $this->set('bullpernext',$datanext[0]['volume_data']['bull_per']);
            $this->set('bearnext',$datanext[0]['volume_data']['bear_volume']);
            $this->set('bearpernext',$datanext[0]['volume_data']['bear_per']);
            $this->set('neutralnext',$datanext[0]['volume_data']['neutral_volume']);
            $this->set('neutralpernext',$datanext[0]['volume_data']['neutral_per']);
            $this->set('dayvolumenext',$datanext[0]['volume_data']['total_volume']);
            
            
            $this->set ('nextdate2', $tradedatenext[1]['market_summeries']['date']);
            $next2 = explode('-',$tradedatenext[1]['market_summeries']['date']);
            $nexttimestamp2 = mktime ( 0, 0, 0, $next2[1], $next2[2], $next2[0] );
            
            $nextvolumesql2 = "SELECT * FROM volume_data WHERE symbol = $symbol AND TO_DAYS(FROM_UNIXTIME(date))= TO_DAYS(FROM_UNIXTIME('$nexttimestamp2'))";//date = 1290318051";TO_DAYS(FROM_UNIXTIME(date))= TO_DAYS(FROM_UNIXTIME(' . $nexttimestamp . ')) ";
            $datanext2 = $this->Symbol->query($nextvolumesql2);
            $this->set('bullnext2',$datanext2[0]['volume_data']['bull_volume']);
            $this->set('bullpernext2',$datanext2[0]['volume_data']['bull_per']);
            $this->set('bearnext2',$datanext2[0]['volume_data']['bear_volume']);
            $this->set('bearpernext2',$datanext2[0]['volume_data']['bear_per']);
            $this->set('neutralnext2',$datanext2[0]['volume_data']['neutral_volume']);
            $this->set('neutralpernext2',$datanext2[0]['volume_data']['neutral_per']);
            $this->set('dayvolumenext2',$datanext2[0]['volume_data']['total_volume']);
            
            
            $this->set ('nextdate3', $tradedatenext[2]['market_summeries']['date']);
            $next3 = explode('-',$tradedatenext[2]['market_summeries']['date']);
            $nexttimestamp3 = mktime ( 0, 0, 0, $next3[1], $next3[2], $next3[0] );
            
            $nextvolumesql3 = "SELECT * FROM volume_data WHERE symbol = $symbol AND TO_DAYS(FROM_UNIXTIME(date))= TO_DAYS(FROM_UNIXTIME('$nexttimestamp3'))";//date = 1290318051";TO_DAYS(FROM_UNIXTIME(date))= TO_DAYS(FROM_UNIXTIME(' . $nexttimestamp . ')) ";
            $datanext3 = $this->Symbol->query($nextvolumesql3);
            $this->set('bullnext3',$datanext3[0]['volume_data']['bull_volume']);
            $this->set('bullpernext3',$datanext3[0]['volume_data']['bull_per']);
            $this->set('bearnext3',$datanext3[0]['volume_data']['bear_volume']);
            $this->set('bearpernext3',$datanext3[0]['volume_data']['bear_per']);
            $this->set('neutralnext3',$datanext3[0]['volume_data']['neutral_volume']);
            $this->set('neutralpernext3',$datanext3[0]['volume_data']['neutral_per']);
            $this->set('dayvolumenext3',$datanext3[0]['volume_data']['total_volume']);
            
            
            $this->set ( 'prevdate', $tradedateprev[0]['market_summeries']['date']);
            $prev = explode('-',$tradedateprev[0]['market_summeries']['date']);
            $prevtimestamp = mktime ( 0, 0, 0, $prev[1], $prev[2], $prev[0] );
            
            $prevolumesql = "SELECT * FROM volume_data WHERE symbol = $symbol AND TO_DAYS(FROM_UNIXTIME(date))= TO_DAYS(FROM_UNIXTIME('$prevtimestamp'))";//date = 1290318051";TO_DAYS(FROM_UNIXTIME(date))= TO_DAYS(FROM_UNIXTIME(' . $nexttimestamp . ')) ";
            $dataprev = $this->Symbol->query($prevolumesql);
            //pr($prevtimestamp);
            //pr($dataprev);
            $this->set('bullprev',$dataprev[0]['volume_data']['bull_volume']);
            $this->set('bullperprev',$dataprev[0]['volume_data']['bull_per']);
            $this->set('bearprev',$dataprev[0]['volume_data']['bear_volume']);
            $this->set('bearperprev',$dataprev[0]['volume_data']['bear_per']);
            $this->set('neutralprev',$dataprev[0]['volume_data']['neutral_volume']);
            $this->set('neutralperprev',$dataprev[0]['volume_data']['neutral_per']);
            $this->set('dayvolumeprev',$dataprev[0]['volume_data']['total_volume']);
            
            $this->set ( 'prevdate2', $tradedateprev[1]['market_summeries']['date']);
            $prev2 = explode('-',$tradedateprev[1]['market_summeries']['date']);
            $prevtimestamp2 = mktime ( 0, 0, 0, $prev2[1], $prev2[2], $prev2[0] );
            $prevolumesql2 = "SELECT * FROM volume_data WHERE symbol = $symbol AND TO_DAYS(FROM_UNIXTIME(date))= TO_DAYS(FROM_UNIXTIME('$prevtimestamp2'))";//date = 1290318051";TO_DAYS(FROM_UNIXTIME(date))= TO_DAYS(FROM_UNIXTIME(' . $nexttimestamp . ')) ";
            $dataprev2 = $this->Symbol->query($prevolumesql2);
            $this->set('bullprev2',$dataprev2[0]['volume_data']['bull_volume']);
            $this->set('bullperprev2',$dataprev2[0]['volume_data']['bull_per']);
            $this->set('bearprev2',$dataprev2[0]['volume_data']['bear_volume']);
            $this->set('bearperprev2',$dataprev2[0]['volume_data']['bear_per']);
            $this->set('neutralprev2',$dataprev2[0]['volume_data']['neutral_volume']);
            $this->set('neutralperprev2',$dataprev2[0]['volume_data']['neutral_per']);
            $this->set('dayvolumeprev2',$dataprev2[0]['volume_data']['total_volume']);
            
            
            $this->set ( 'prevdate3', $tradedateprev[2]['market_summeries']['date']);
            $prev3 = explode('-',$tradedateprev[2]['market_summeries']['date']);
            $prevtimestamp3 = mktime ( 0, 0, 0, $prev3[1], $prev3[2], $prev3[0] );
            
            $prevolumesql3 = "SELECT * FROM volume_data WHERE symbol = $symbol AND TO_DAYS(FROM_UNIXTIME(date))= TO_DAYS(FROM_UNIXTIME('$prevtimestamp3'))";//date = 1290318051";TO_DAYS(FROM_UNIXTIME(date))= TO_DAYS(FROM_UNIXTIME(' . $nexttimestamp . ')) ";
            $dataprev3 = $this->Symbol->query($prevolumesql3);
            $this->set('bullprev3',$dataprev3[0]['volume_data']['bull_volume']);
            $this->set('bullperprev3',$dataprev3[0]['volume_data']['bull_per']);
            $this->set('bearprev3',$dataprev3[0]['volume_data']['bear_volume']);
            $this->set('bearperprev3',$dataprev3[0]['volume_data']['bear_per']);
            $this->set('neutralprev3',$dataprev3[0]['volume_data']['neutral_volume']);
            $this->set('neutralperprev3',$dataprev3[0]['volume_data']['neutral_per']);
            $this->set('dayvolumeprev3',$dataprev3[0]['volume_data']['total_volume']);
            
            
            $symbolInfo = $this->Symbol->find ( 'first', array ('conditions' => array ('id=' . $_REQUEST ['TickerSymbol'] ), 'fields' => array ('Symbol.dse_code', 'Symbol.name' ) ) );
            $name = $symbolInfo ['Symbol'] ['name'];
            $name = ucwords ( strtolower ( $name ) );
            
            $this->pageTitle = "$name :: Minute Chart Stock Bangladesh";
            $this->set ( 'sym', $_REQUEST ['TickerSymbol'] );
            
            //App::import ( 'Vendor', 'Phpchartdir', array ('file' => 'phpchartdir.php' ) );

            ///$symbol = $_REQUEST ['TickerSymbol'];
            $symbol = trim ( $symbol );
            $interval = $inv;

            $code = $symbolInfo ['Symbol'] ['dse_code'];
            $name = $symbolInfo ['Symbol'] ['name'];
            $minute = $interval / 60;

            if ($minute > 1) {

                $minute = $minute . ' Minutes Chart';

            } else {

                $minute = $minute . ' Minutes Chart';

            }
            //$shareDataSql = 'select * from stocknet_plugin.data_banks_intraday where symbol_id =' . $symbol . '  AND TO_DAYS(FROM_UNIXTIME(datestamp))= TO_DAYS(FROM_UNIXTIME(' . $requestTimeStamp . '))  ORDER BY id DESC LIMIT 0, 400' ;
            //$shareData = mysql_query ( $shareDataSql, $AMILink );
            $shareData = $this->Symbol->query ( 'select * from data_banks_intraday where symbol_id =' . $symbol . '  AND TO_DAYS(FROM_UNIXTIME(date))= TO_DAYS(FROM_UNIXTIME(' . $requestTimeStamp . '))  ORDER BY id DESC LIMIT 0, 400' );
            
            $timeWiseArr = array ();
            $timeKeyArr  = array ();

            foreach ( $shareData as $row ) {
                $currenttime = $row ['data_banks_intraday'] ['date'];
                //$currenttime = $currenttime + (8*60*60);

                $mod = $currenttime % $interval;
                $timeToBeAccounted = $currenttime - $mod + $interval;
                $timeWiseArr [$timeToBeAccounted] [] = $row;
                $modtime = date ( 'd M  h:ia', $timeToBeAccounted );
            }

            //pr($timeWiseArr);
            $rowDataVolumeStart = 0;
            $rowDataVolumeEnd = 0;
            $currentDataVolume = 0;
            $tempVolumeCounter = 0;
            $totalArrayCount = count($timeWiseArr);
            $myDefinedCounter = 1;
            foreach ( $timeWiseArr as $key => $arr ) {
                $timeKeyArr [] = $key;
            }

            //pr($tempVolumeCounter);
            $finalArr = array ();
            $totalvolume = $shareData [0] ['data_banks_intraday'] ['volume'];
            $tradetimestamp = $shareData [0] ['data_banks_intraday'] ['date'];
            $dayhigh = $shareData [0] ['data_banks_intraday'] ['high'];
            $daylow = $shareData [0] ['data_banks_intraday'] ['low'];
            $totaltrade = $shareData [0] ['data_banks_intraday'] ['trade'];
            $yclose= $shareData [0] ['data_banks_intraday'] ['yclose'];

            $tradeDate = date ( 'd M y h:ia', $tradetimestamp );
            $i = 0;
            $singleCount = 0;
            $finalPrice = 0;
            //pr($timeWiseArr);
            $startPrice = 0;
            $endPrice = 0;
            foreach ( $timeWiseArr as $key => $arr ) {
                $datetime = date ( 'h:i A', $key );
                $temp = array ();
                $startArr = array ();
                $endArr = array ();
                $ind = count ( $arr );
                $counterArr = count($arr);
                $finalPrice = $arr[0]['data_banks_intraday']['close'];


                if(!$rowDataVolumeStart) {
                    $rowDataVolumeStart = $arr[0]['data_banks_intraday']['volume'];
                    $startPrice = $arr[0]['data_banks_intraday']['close'];
                }

                if($myDefinedCounter==$totalArrayCount){
                    $rowDataVolumeEnd  =0;
                    $endPrice = $arr[0]['data_banks_intraday']['yclose'];
                }else {
                    $rowDataVolumeEnd = $arr[$counterArr-1]['data_banks_intraday']['volume'];
                    $endPrice = $arr[0]['data_banks_intraday']['close'];

                }

                //$endArr ['data_banks_intraday'] ['lastprice'];
             
                if ($ind == 1) {
                    $startArr = $arr [$ind - 1];
                    $endArr = $arr [$ind - 1];

                    if (isset ( $timeKeyArr [$i + 1] )) {
                        $time = $timeKeyArr [$i + 1];
                        $endvolume = $timeWiseArr [$time] [0] ['data_banks_intraday'] ['volume'];
                    } else {
                        $endvolume = 0;
                    }
                    $startvolume = $startArr ['data_banks_intraday'] ['volume'];
                } else {

                    if (isset ( $timeKeyArr [$i] )) {
                        $time = $timeKeyArr [$i];

                        $preArrInd = count ($timeWiseArr [$time] );

                        $startvolume = $timeWiseArr [$time] [0] ['data_banks_intraday'] ['volume'];
                        //pr("found");
                    } else {
                        $startvolume = 0;
                        //pr('NO');
                    }
             
                    $endArr = $arr [$ind - 1];

                    if (isset ( $endArr )) {
                        $endvolume = $endArr ['data_banks_intraday'] ['volume'];
                    } else {
                        $endvolume = 0;
                    }
                }
                $temp ['ltp'] = $finalPrice;
                $finalPrice = $arr[$counterArr-1]['data_banks_intraday']['lastprice'];
                
                $temp ['high'] = $endArr ['data_banks_intraday'] ['high'];
                $temp ['low'] = $endArr ['data_banks_intraday'] ['low'];
                $temp ['close'] = $endArr ['data_banks_intraday'] ['close'];
                $temp ['yclose'] = $endArr ['data_banks_intraday'] ['yclose'];
                $temp ['trade'] = $endArr ['data_banks_intraday'] ['trade'];
                $temp ['volume'] = $rowDataVolumeStart - $rowDataVolumeEnd;

                if($startPrice > $endPrice){
                    $myPositiveCounter += $temp ['volume'];

                }else {
                    $myNegativeCounter += $temp ['volume'];
                }

                $rowDataVolumeStart = $rowDataVolumeEnd;
                $startPrice = $endPrice;
                $myDefinedCounter++;

                $temp ['value'] = $endArr ['data_banks_intraday'] ['value'];
                $temp ['datetime'] = $datetime;
                $temp ['idatetime'] = $key;
                $finalArr [] = $temp;

                ++ $i;
            }


            $xdata = array ();
            $ydata = array ();
            $vdata = array ();

            $totalbar = count ( $finalArr );

            foreach ( $finalArr as $mykey => $row ) {
                $volumetemp = $row ['volume'];

                if ($volumetemp < 0) {
                    continue;
                }

                $xdata [] = $row ['ltp'];
                $vdata [] = $finalArr [$mykey +1] =$row ['volume'];
                $ydata [] = $row ['datetime']; 

                /*if ($interval < 120 && $totalbar > 80) {

                    if ($interval == 60) {
                        $yint = 600;
                    } else {
                        $yint = 300;
                    }
                    $currenttime = $row ['idatetime'];

                    $mod = $currenttime % $yint;

                    if ($mod == 0) {
                        $ydata [] = $row ['datetime'];
                    } else {
                        $ydata [] = "-";
                    }
                } else {
                    $ydata [] = $row ['datetime'];
                } */

            }



            $xdata = array_reverse ( $xdata );
            $ydata = array_reverse ( $ydata );
            $vdata = array_reverse ( $vdata );
            
            $max = 50;

            $lastprice = $xdata [count ( $xdata ) - 1];
            $lasttime = $ydata [count ( $ydata ) - 1];
            $lastvolume = $vdata [count ( $vdata ) - 1];

            array_unshift($vdata, 0);
            array_pop($vdata);
            
            # The data for the chart
            $myPositiveCounter=0;
            $myNegativeCounter=0;
            $myEqualCounter=0;

            if($yclose<$xdata[0])
            {
                $myPositiveCounter=$vdata[0];
            }
            if($yclose>$xdata[0])
            {
                $myNegativeCounter=$vdata[0];
            }
            /*echo "<pre >";
            echo "xdata";
            print_r($xdata);
            echo "vdata";
            print_r($vdata);
            exit;*/
            
            for($i=0;$i<count($vdata);$i++)
            {
                if($xdata[$i]>$xdata[$i-1])
                {

                    $myPositiveCounter+=$vdata[$i];
                    
                }
                if ($xdata[$i]<$xdata[$i-1])
                {
                    $myNegativeCounter+=$vdata[$i];
                    
                }
                if ($xdata[$i]==$xdata[$i-1])
                {
                    $myEqualCounter+=$vdata[$i];

                }


            }
            //exit;
            $data0 = $xdata;
            $data1 = $vdata;
            $labels = $ydata;

            $myPositivePer=($myPositiveCounter/$totalvolume)*100;
            $myPositivePer=round($myPositivePer,2);

            $myNegativePer=($myNegativeCounter/$totalvolume)*100;
            $myNegativePer=round($myNegativePer,2);

            $myEqualPer=($myEqualCounter/$totalvolume)*100;
            $myEqualPer=round($myEqualPer,2);
            
            $this->set('data0',$xdata);
            $this->set('data1',$vdata);
            $this->set('labels',$ydata);
            
            $this->set('bull',$myPositiveCounter);
            $this->set('bullper',$myPositivePer);
            $this->set('bear',$myNegativeCounter);
            $this->set('bearper',$myNegativePer);
            $this->set('neutral',$myEqualCounter);
            $this->set('neutralper',$myEqualPer);
            $this->set('dayvolume',$totalvolume);

            
            $this->set('code',$code);
            $this->set('tradeDate',$tradeDate);
            $this->set('lastprice',$lastprice);
            $this->set('dayhigh',$dayhigh);
            $this->set('daylow',$daylow);
            $this->set('totaltrade',$totaltrade);
            $this->set('totalvolume',$totalvolume);

            $this->set('myPositiveCounter',$myPositiveCounter);
            $this->set('myPositivePer',$myPositivePer);
            $this->set('myEqualCounter',$myEqualCounter);
            $this->set('myEqualPer',$myEqualPer);
            $this->set('myNegativeCounter',$myNegativeCounter);
            $this->set('myNegativePer',$myNegativePer);
            

            

            /*# Create a XYChart object of size 300 x 180 pixels
            $c = new XYChart ( 760, 450 );



            $c->setBackground ( $c->linearGradientColor ( 0, 0, 0, 400, 0xE7FFDF, 0xffffff ), 0xE3EFC2 );

            $c->setRoundedFrame ( 0xffffff, 0 );

            //$c->setBackground($c->linearGradientColor(0, 0, 0, 400, 0xffffbb, 0xffffff), 0x888888);
            //$c->setRoundedFrame(0xffffff, 0);




            # Set the plot area at (50, 20) and of size 200 x 130 pixels
            $c->setPlotArea ( 50, 50, 650, 320, 0xffffff, - 1, - 1, $c->dashLineColor ( 0xaaaaaa, DotLine ), Transparent );



            # Add a title to the chart using 8 pts Arial Bold font
            $arialbdPath = WWW_ROOT . 'font' . DS . 'arialbd.ttf';

            $c->addTitle ( "$code- $tradeDate          Last price : $lastprice   high : $dayhigh  low : $daylow  trade : $totaltrade   Total Volume - $totalvolume ", $arialbdPath, 8, 0x333333, 0xE7FFDF );
            $textBoxObj = $c->addText ( 180, 12, "Bull Vol: $myPositiveCounter($myPositivePer%) Neutral Vol: $myEqualCounter($myEqualPer%)  Bear Vol: $myNegativeCounter ($myNegativePer%)", $arialbdPath, 8, 0x333333 );
            //$c->addTitle ( "$code-$tradeDate          Last price : $lastprice   high : $dayhigh low : $daylow trade : $totaltrade   Total Volume - $totalvolume Positive: Negative: ", $arialbdPath, 14, 0x333333, 0xE7FFDF );



            # Set the labels on the x axis.
            $c->xAxis->setLabels ( $labels );

            $c->xAxis->setLabelStyle ( "Arial", 8, TextColor, 90 );

            # Add a title to the primary (left) y axis
            $c->yAxis->setTitle ( "PRICE" );



            # Set the axis, label and title colors for the primary y axis to red (0xc00000) to
            # match the first data set
            $c->yAxis->setColors ( 0x008000, 0x008000, 0x008000 );



            # Add a title to the secondary (right) y axis
            $c->yAxis2->setTitle ( "VOLUME" );



            # set the axis, label and title colors for the primary y axis to green (0x008000) to
            # match the second data set
            $c->yAxis2->setColors ( 0x008000, 0x008000, 0x008000 );



            $textBoxObj = $c->addText ( 500, 50, "www.stockbangladesh.org", "timesbi.ttf", 11, 0xc09090 );

            $textBoxObj->setAlignment ( TopLeft );



            # Add a line layer to the chart
            $layer = $c->addLineLayer ();



            # Add the first line. Plot the points with a 7 pixel square symbol
            $dataSetObj = $layer->addDataSet ( $data0, 0xcf4040, "Price" );

            $dataSetObj->setDataSymbol ( SquareSymbol, 5 );



            $trendLayerObj = $c->addTrendLayer ( $data0, 0x008000, "Trend Line" );

            $trendLayerObj->setLineWidth ( 1 );



            $trendLayerObj->addPredictionBand ( 0.95, 0x8066ff66 );



            $barLayerObj = $c->addBarLayer3 ( $data1 );

            $barLayerObj->setBarShape ( CircleShape );



            $barLayerObj->setUseYAxis2 ();



            //    $c->addAreaLayer($data1, $c->yZoneColor(60, 0x8033ff33, 0x80ff3333));




            //$chart1URL = $c->makeSession("chart1");
            # Create an image map for the chart




            $chartData = $c->makeChart2 ( PNG );

            $chart1URL = $c->makeSession("minchart2");

            $this->set('chart1URL', $chart1URL);



            $chartImagePath = WWW_ROOT . 'chart' . DS . 'mm_chart_full_p.png';

            $f = fopen ( $chartImagePath, "wb" );

            fwrite ( $f, $chartData );

            fclose ( $f );



            $chartImageMap = $c->getHTMLImageMap ( "", "", "title='{dataSetName} at {xLabel} =  {value|2} '" );

            $this->set ( 'chartImageMap', $chartImageMap );



            if (isset ( $_REQUEST ['mapData'] ) && $_REQUEST ['mapData'] == 'yes') {

                echo "-#-";

                echo $chartImageMap;

                die ( '-#-' );

            }  */

        }



        $this->set ( 'inv', $inv );

        $this->set ( 'inv1', $inv1 );
        
   
    }
    
    function minutechartprevold($updateRequest = '') {

        $this->layout = 'default-one';
        $this->pageTitle = 'Stock Bangladesh :: Minute Chart - Price Chart/ Graph';
       
      
        
        if(isset($_REQUEST ['TickerSymbol']) AND isset($_REQUEST ['inv']) AND isset($_REQUEST ['date']))
        {
            $updateRequest ['sym'] = $_REQUEST ['TickerSymbol'];
            $updateRequest ['inv'] = $_REQUEST ['inv'];
         $tmpArr = array();
         $tmpArr['date'] = $_REQUEST ['date'];
         $this->data['date'] = $_REQUEST ['date'];
        }    
        $inv = 60;
        $inv1 = 300;
        if (isset ( $updateRequest ['sym'] ) && $updateRequest ['sym'] != '')

        $_REQUEST ['TickerSymbol'] = $updateRequest ['sym'];
        
        if (isset ( $updateRequest ['inv'] ) && $updateRequest ['inv'] != '')

        $_REQUEST ['inv'] = $updateRequest ['inv'];

        if (isset ( $_REQUEST ['TickerSymbol'] )) {

            $inv = $_REQUEST ['inv'];
        
        $requestdate = $this->data['date'];
        if(empty($this->data))
            $requestdate = $_REQUEST ['date'];
       // pr($_REQUEST ['date']); die; 
        
        
        if(empty($requestdate) AND empty($_REQUEST['TickerSymbol']))
            {
               $nameOfTheDay = date ( 'l' );
                if ($nameOfTheDay == 'Friday')
                    $requestTimeStamp = mktime ( 0, 0, 0, date ( 'm' ), date ( 'd' ) - 1, date ( 'Y' ) );
                else if ($nameOfTheDay == 'Saturday')
                    $requestTimeStamp = mktime ( 0, 0, 0, date ( 'm' ), date ( 'd' ) - 2, date ( 'Y' ) );
                else
                    $requestTimeStamp = mktime ( 0, 0, 0, date ( 'm' ), date ( 'd' ), date ( 'Y' ) );
                    
                $requestdate = date('Y-m-d',$requestTimeStamp);
                $this->set ( 'date', $requestdate );
                
                   
            }
            else
            {
                $this->set ( 'date', $requestdate );
                $date = explode('-',$requestdate);
                $year = $date[0]; 
                $month = $date[1];
                $day =  $date[2]; 
                $requestTimeStamp = mktime ( 6, 0, 0, $month, $day, $year );
            }
            
            $today = date('Y-m-d',time());
            if($today == $requestdate)
            {
                $tradedateprev = $this->MarketSummery->query("SELECT date FROM market_summeries WHERE date<'$requestdate' ORDER BY date DESC limit 3");
            }else{
                $tradedatenext = $this->MarketSummery->query("SELECT date FROM market_summeries WHERE date>'$requestdate' ORDER BY date ASC limit 3");
                $tradedateprev = $this->MarketSummery->query("SELECT date FROM market_summeries WHERE date<'$requestdate' ORDER BY date DESC limit 3");
            }    

            $symbol = $_REQUEST ['TickerSymbol'];
            
            $this->set ('nextdate', $tradedatenext[0]['market_summeries']['date']);
            $next = explode('-',$tradedatenext[0]['market_summeries']['date']);
            $nexttimestamp = mktime ( 0, 0, 0, $next[1], $next[2], $next[0] );
            
            $nextvolumesql = "SELECT * FROM volume_data WHERE symbol = $symbol AND TO_DAYS(FROM_UNIXTIME(date))= TO_DAYS(FROM_UNIXTIME('$nexttimestamp'))";//date = 1290318051";TO_DAYS(FROM_UNIXTIME(date))= TO_DAYS(FROM_UNIXTIME(' . $nexttimestamp . ')) ";
            $datanext = $this->Symbol->query($nextvolumesql);
            $this->set('bullnext',$datanext[0]['volume_data']['bull_volume']);
            $this->set('bullpernext',$datanext[0]['volume_data']['bull_per']);
            $this->set('bearnext',$datanext[0]['volume_data']['bear_volume']);
            $this->set('bearpernext',$datanext[0]['volume_data']['bear_per']);
            $this->set('neutralnext',$datanext[0]['volume_data']['neutral_volume']);
            $this->set('neutralpernext',$datanext[0]['volume_data']['neutral_per']);
            $this->set('dayvolumenext',$datanext[0]['volume_data']['total_volume']);
            
            
            $this->set ('nextdate2', $tradedatenext[1]['market_summeries']['date']);
            $next2 = explode('-',$tradedatenext[1]['market_summeries']['date']);
            $nexttimestamp2 = mktime ( 0, 0, 0, $next2[1], $next2[2], $next2[0] );
            
            $nextvolumesql2 = "SELECT * FROM volume_data WHERE symbol = $symbol AND TO_DAYS(FROM_UNIXTIME(date))= TO_DAYS(FROM_UNIXTIME('$nexttimestamp2'))";//date = 1290318051";TO_DAYS(FROM_UNIXTIME(date))= TO_DAYS(FROM_UNIXTIME(' . $nexttimestamp . ')) ";
            $datanext2 = $this->Symbol->query($nextvolumesql2);
            $this->set('bullnext2',$datanext2[0]['volume_data']['bull_volume']);
            $this->set('bullpernext2',$datanext2[0]['volume_data']['bull_per']);
            $this->set('bearnext2',$datanext2[0]['volume_data']['bear_volume']);
            $this->set('bearpernext2',$datanext2[0]['volume_data']['bear_per']);
            $this->set('neutralnext2',$datanext2[0]['volume_data']['neutral_volume']);
            $this->set('neutralpernext2',$datanext2[0]['volume_data']['neutral_per']);
            $this->set('dayvolumenext2',$datanext2[0]['volume_data']['total_volume']);
            
            
            $this->set ('nextdate3', $tradedatenext[2]['market_summeries']['date']);
            $next3 = explode('-',$tradedatenext[2]['market_summeries']['date']);
            $nexttimestamp3 = mktime ( 0, 0, 0, $next3[1], $next3[2], $next3[0] );
            
            $nextvolumesql3 = "SELECT * FROM volume_data WHERE symbol = $symbol AND TO_DAYS(FROM_UNIXTIME(date))= TO_DAYS(FROM_UNIXTIME('$nexttimestamp3'))";//date = 1290318051";TO_DAYS(FROM_UNIXTIME(date))= TO_DAYS(FROM_UNIXTIME(' . $nexttimestamp . ')) ";
            $datanext3 = $this->Symbol->query($nextvolumesql3);
            $this->set('bullnext3',$datanext3[0]['volume_data']['bull_volume']);
            $this->set('bullpernext3',$datanext3[0]['volume_data']['bull_per']);
            $this->set('bearnext3',$datanext3[0]['volume_data']['bear_volume']);
            $this->set('bearpernext3',$datanext3[0]['volume_data']['bear_per']);
            $this->set('neutralnext3',$datanext3[0]['volume_data']['neutral_volume']);
            $this->set('neutralpernext3',$datanext3[0]['volume_data']['neutral_per']);
            $this->set('dayvolumenext3',$datanext3[0]['volume_data']['total_volume']);
            
            
            $this->set ( 'prevdate', $tradedateprev[0]['market_summeries']['date']);
            $prev = explode('-',$tradedateprev[0]['market_summeries']['date']);
            $prevtimestamp = mktime ( 0, 0, 0, $prev[1], $prev[2], $prev[0] );
            
            $prevolumesql = "SELECT * FROM volume_data WHERE symbol = $symbol AND TO_DAYS(FROM_UNIXTIME(date))= TO_DAYS(FROM_UNIXTIME('$prevtimestamp'))";//date = 1290318051";TO_DAYS(FROM_UNIXTIME(date))= TO_DAYS(FROM_UNIXTIME(' . $nexttimestamp . ')) ";
            $dataprev = $this->Symbol->query($prevolumesql);
            //pr($prevtimestamp);
            //pr($dataprev);
            $this->set('bullprev',$dataprev[0]['volume_data']['bull_volume']);
            $this->set('bullperprev',$dataprev[0]['volume_data']['bull_per']);
            $this->set('bearprev',$dataprev[0]['volume_data']['bear_volume']);
            $this->set('bearperprev',$dataprev[0]['volume_data']['bear_per']);
            $this->set('neutralprev',$dataprev[0]['volume_data']['neutral_volume']);
            $this->set('neutralperprev',$dataprev[0]['volume_data']['neutral_per']);
            $this->set('dayvolumeprev',$dataprev[0]['volume_data']['total_volume']);
            
            $this->set ( 'prevdate2', $tradedateprev[1]['market_summeries']['date']);
            $prev2 = explode('-',$tradedateprev[1]['market_summeries']['date']);
            $prevtimestamp2 = mktime ( 0, 0, 0, $prev2[1], $prev2[2], $prev2[0] );
            $prevolumesql2 = "SELECT * FROM volume_data WHERE symbol = $symbol AND TO_DAYS(FROM_UNIXTIME(date))= TO_DAYS(FROM_UNIXTIME('$prevtimestamp2'))";//date = 1290318051";TO_DAYS(FROM_UNIXTIME(date))= TO_DAYS(FROM_UNIXTIME(' . $nexttimestamp . ')) ";
            $dataprev2 = $this->Symbol->query($prevolumesql2);
            $this->set('bullprev2',$dataprev2[0]['volume_data']['bull_volume']);
            $this->set('bullperprev2',$dataprev2[0]['volume_data']['bull_per']);
            $this->set('bearprev2',$dataprev2[0]['volume_data']['bear_volume']);
            $this->set('bearperprev2',$dataprev2[0]['volume_data']['bear_per']);
            $this->set('neutralprev2',$dataprev2[0]['volume_data']['neutral_volume']);
            $this->set('neutralperprev2',$dataprev2[0]['volume_data']['neutral_per']);
            $this->set('dayvolumeprev2',$dataprev2[0]['volume_data']['total_volume']);
            
            
            $this->set ( 'prevdate3', $tradedateprev[2]['market_summeries']['date']);
            $prev3 = explode('-',$tradedateprev[2]['market_summeries']['date']);
            $prevtimestamp3 = mktime ( 0, 0, 0, $prev3[1], $prev3[2], $prev3[0] );
            
            $prevolumesql3 = "SELECT * FROM volume_data WHERE symbol = $symbol AND TO_DAYS(FROM_UNIXTIME(date))= TO_DAYS(FROM_UNIXTIME('$prevtimestamp3'))";//date = 1290318051";TO_DAYS(FROM_UNIXTIME(date))= TO_DAYS(FROM_UNIXTIME(' . $nexttimestamp . ')) ";
            $dataprev3 = $this->Symbol->query($prevolumesql3);
            $this->set('bullprev3',$dataprev3[0]['volume_data']['bull_volume']);
            $this->set('bullperprev3',$dataprev3[0]['volume_data']['bull_per']);
            $this->set('bearprev3',$dataprev3[0]['volume_data']['bear_volume']);
            $this->set('bearperprev3',$dataprev3[0]['volume_data']['bear_per']);
            $this->set('neutralprev3',$dataprev3[0]['volume_data']['neutral_volume']);
            $this->set('neutralperprev3',$dataprev3[0]['volume_data']['neutral_per']);
            $this->set('dayvolumeprev3',$dataprev3[0]['volume_data']['total_volume']);
            
            
            $symbolInfo = $this->Symbol->find ( 'first', array ('conditions' => array ('id=' . $_REQUEST ['TickerSymbol'] ), 'fields' => array ('Symbol.dse_code', 'Symbol.name' ) ) );
            $name = $symbolInfo ['Symbol'] ['name'];
            $name = ucwords ( strtolower ( $name ) );
            
            $this->pageTitle = "$name :: Minute Chart Stock Bangladesh";
            $this->set ( 'sym', $_REQUEST ['TickerSymbol'] );
            
            App::import ( 'Vendor', 'Phpchartdir', array ('file' => 'phpchartdir.php' ) );

            ///$symbol = $_REQUEST ['TickerSymbol'];
            $symbol = trim ( $symbol );
            $interval = $inv;

            $code = $symbolInfo ['Symbol'] ['dse_code'];
            $name = $symbolInfo ['Symbol'] ['name'];
            $minute = $interval / 60;

            if ($minute > 1) {

                $minute = $minute . ' Minutes Chart';

            } else {

                $minute = $minute . ' Minutes Chart';

            }
            //$shareDataSql = 'select * from stocknet_plugin.data_banks_intraday where symbol_id =' . $symbol . '  AND TO_DAYS(FROM_UNIXTIME(datestamp))= TO_DAYS(FROM_UNIXTIME(' . $requestTimeStamp . '))  ORDER BY id DESC LIMIT 0, 400' ;
            //$shareData = mysql_query ( $shareDataSql, $AMILink );
            $shareData = $this->Symbol->query ( 'select * from data_banks_intraday where symbol_id =' . $symbol . '  AND TO_DAYS(FROM_UNIXTIME(date))= TO_DAYS(FROM_UNIXTIME(' . $requestTimeStamp . '))  ORDER BY id DESC LIMIT 0, 400' );
            
            $timeWiseArr = array ();
            $timeKeyArr  = array ();

            foreach ( $shareData as $row ) {
                $currenttime = $row ['data_banks_intraday'] ['date'];
                //$currenttime = $currenttime + (8*60*60);

                $mod = $currenttime % $interval;
                $timeToBeAccounted = $currenttime - $mod + $interval;
                $timeWiseArr [$timeToBeAccounted] [] = $row;
                $modtime = date ( 'd M  h:ia', $timeToBeAccounted );
            }

            //pr($timeWiseArr);
            $rowDataVolumeStart = 0;
            $rowDataVolumeEnd = 0;
            $currentDataVolume = 0;
            $tempVolumeCounter = 0;
            $totalArrayCount = count($timeWiseArr);
            $myDefinedCounter = 1;
            foreach ( $timeWiseArr as $key => $arr ) {
                $timeKeyArr [] = $key;
            }

            //pr($tempVolumeCounter);
            $finalArr = array ();
            $totalvolume = $shareData [0] ['data_banks_intraday'] ['volume'];
            $tradetimestamp = $shareData [0] ['data_banks_intraday'] ['date'];
            $dayhigh = $shareData [0] ['data_banks_intraday'] ['high'];
            $daylow = $shareData [0] ['data_banks_intraday'] ['low'];
            $totaltrade = $shareData [0] ['data_banks_intraday'] ['trade'];
            $yclose= $shareData [0] ['data_banks_intraday'] ['yclose'];

            $tradeDate = date ( 'd M y h:ia', $tradetimestamp );
            $i = 0;
            $singleCount = 0;
            $finalPrice = 0;
            //pr($timeWiseArr);
            $startPrice = 0;
            $endPrice = 0;
            foreach ( $timeWiseArr as $key => $arr ) {
                $datetime = date ( 'h:i A', $key );
                $temp = array ();
                $startArr = array ();
                $endArr = array ();
                $ind = count ( $arr );
                $counterArr = count($arr);
                $finalPrice = $arr[0]['data_banks_intraday']['close'];


                if(!$rowDataVolumeStart) {
                    $rowDataVolumeStart = $arr[0]['data_banks_intraday']['volume'];
                    $startPrice = $arr[0]['data_banks_intraday']['close'];
                }

                if($myDefinedCounter==$totalArrayCount){
                    $rowDataVolumeEnd  =0;
                    $endPrice = $arr[0]['data_banks_intraday']['yclose'];
                }else {
                    $rowDataVolumeEnd = $arr[$counterArr-1]['data_banks_intraday']['volume'];
                    $endPrice = $arr[0]['data_banks_intraday']['close'];

                }

                //$endArr ['data_banks_intraday'] ['lastprice'];
             
                if ($ind == 1) {
                    $startArr = $arr [$ind - 1];
                    $endArr = $arr [$ind - 1];

                    if (isset ( $timeKeyArr [$i + 1] )) {
                        $time = $timeKeyArr [$i + 1];
                        $endvolume = $timeWiseArr [$time] [0] ['data_banks_intraday'] ['volume'];
                    } else {
                        $endvolume = 0;
                    }
                    $startvolume = $startArr ['data_banks_intraday'] ['volume'];
                } else {

                    if (isset ( $timeKeyArr [$i] )) {
                        $time = $timeKeyArr [$i];

                        $preArrInd = count ($timeWiseArr [$time] );

                        $startvolume = $timeWiseArr [$time] [0] ['data_banks_intraday'] ['volume'];
                        //pr("found");
                    } else {
                        $startvolume = 0;
                        //pr('NO');
                    }
             
                    $endArr = $arr [$ind - 1];

                    if (isset ( $endArr )) {
                        $endvolume = $endArr ['data_banks_intraday'] ['volume'];
                    } else {
                        $endvolume = 0;
                    }
                }
                $temp ['ltp'] = $finalPrice;
                $finalPrice = $arr[$counterArr-1]['data_banks_intraday']['lastprice'];
                
                $temp ['high'] = $endArr ['data_banks_intraday'] ['high'];
                $temp ['low'] = $endArr ['data_banks_intraday'] ['low'];
                $temp ['close'] = $endArr ['data_banks_intraday'] ['close'];
                $temp ['yclose'] = $endArr ['data_banks_intraday'] ['yclose'];
                $temp ['trade'] = $endArr ['data_banks_intraday'] ['trade'];
                $temp ['volume'] = $rowDataVolumeStart - $rowDataVolumeEnd;

                if($startPrice > $endPrice){
                    $myPositiveCounter += $temp ['volume'];

                }else {
                    $myNegativeCounter += $temp ['volume'];
                }

                $rowDataVolumeStart = $rowDataVolumeEnd;
                $startPrice = $endPrice;
                $myDefinedCounter++;

                $temp ['value'] = $endArr ['data_banks_intraday'] ['value'];
                $temp ['datetime'] = $datetime;
                $temp ['idatetime'] = $key;
                $finalArr [] = $temp;

                ++ $i;
            }


            $xdata = array ();
            $ydata = array ();
            $vdata = array ();

            $totalbar = count ( $finalArr );

            foreach ( $finalArr as $mykey => $row ) {
                $volumetemp = $row ['volume'];

                if ($volumetemp < 0) {
                    continue;
                }

                $xdata [] = $row ['ltp'];
                $vdata [] = $finalArr [$mykey +1] =$row ['volume'];

                if ($interval < 120 && $totalbar > 80) {

                    if ($interval == 60) {
                        $yint = 600;
                    } else {
                        $yint = 300;
                    }
                    $currenttime = $row ['idatetime'];

                    $mod = $currenttime % $yint;

                    if ($mod == 0) {
                        $ydata [] = $row ['datetime'];
                    } else {
                        $ydata [] = "-";
                    }
                } else {
                    $ydata [] = $row ['datetime'];
                }

            }



            $xdata = array_reverse ( $xdata );
            $ydata = array_reverse ( $ydata );
            $vdata = array_reverse ( $vdata );
            
            $max = 50;

            $lastprice = $xdata [count ( $xdata ) - 1];
            $lasttime = $ydata [count ( $ydata ) - 1];
            $lastvolume = $vdata [count ( $vdata ) - 1];

            array_unshift($vdata, 0);
            array_pop($vdata);
            
            # The data for the chart
            $myPositiveCounter=0;
            $myNegativeCounter=0;
            $myEqualCounter=0;

            if($yclose<$xdata[0])
            {
                $myPositiveCounter=$vdata[0];
            }
            if($yclose>$xdata[0])
            {
                $myNegativeCounter=$vdata[0];
            }
            /*echo "<pre >";
            echo "xdata";
            print_r($xdata);
            echo "vdata";
            print_r($vdata);
            exit;*/
            
            for($i=0;$i<count($vdata);$i++)
            {
                if($xdata[$i]>$xdata[$i-1])
                {

                    $myPositiveCounter+=$vdata[$i];
                    
                }
                if ($xdata[$i]<$xdata[$i-1])
                {
                    $myNegativeCounter+=$vdata[$i];
                    
                }
                if ($xdata[$i]==$xdata[$i-1])
                {
                    $myEqualCounter+=$vdata[$i];

                }


            }
            //exit;
            $data0 = $xdata;
            $data1 = $vdata;
            $labels = $ydata;

            $myPositivePer=($myPositiveCounter/$totalvolume)*100;
            $myPositivePer=round($myPositivePer,2);

            $myNegativePer=($myNegativeCounter/$totalvolume)*100;
            $myNegativePer=round($myNegativePer,2);

            $myEqualPer=($myEqualCounter/$totalvolume)*100;
            $myEqualPer=round($myEqualPer,2);
            
            
            $this->set('bull',$myPositiveCounter);
            $this->set('bullper',$myPositivePer);
            $this->set('bear',$myNegativeCounter);
            $this->set('bearper',$myNegativePer);
            $this->set('neutral',$myEqualCounter);
            $this->set('neutralper',$myEqualPer);
            $this->set('dayvolume',$totalvolume);


            # Create a XYChart object of size 300 x 180 pixels
            $c = new XYChart ( 760, 450 );



            $c->setBackground ( $c->linearGradientColor ( 0, 0, 0, 400, 0xE7FFDF, 0xffffff ), 0xE3EFC2 );

            $c->setRoundedFrame ( 0xffffff, 0 );

            //$c->setBackground($c->linearGradientColor(0, 0, 0, 400, 0xffffbb, 0xffffff), 0x888888);
            //$c->setRoundedFrame(0xffffff, 0);




            # Set the plot area at (50, 20) and of size 200 x 130 pixels
            $c->setPlotArea ( 50, 50, 650, 320, 0xffffff, - 1, - 1, $c->dashLineColor ( 0xaaaaaa, DotLine ), Transparent );



            # Add a title to the chart using 8 pts Arial Bold font
            $arialbdPath = WWW_ROOT . 'font' . DS . 'arialbd.ttf';

            $c->addTitle ( "$code- $tradeDate          Last price : $lastprice   high : $dayhigh  low : $daylow  trade : $totaltrade   Total Volume - $totalvolume ", $arialbdPath, 8, 0x333333, 0xE7FFDF );
            $textBoxObj = $c->addText ( 180, 12, "Bull Vol: $myPositiveCounter($myPositivePer%) Neutral Vol: $myEqualCounter($myEqualPer%)  Bear Vol: $myNegativeCounter ($myNegativePer%)", $arialbdPath, 8, 0x333333 );
            //$c->addTitle ( "$code-$tradeDate          Last price : $lastprice   high : $dayhigh low : $daylow trade : $totaltrade   Total Volume - $totalvolume Positive: Negative: ", $arialbdPath, 14, 0x333333, 0xE7FFDF );



            # Set the labels on the x axis.
            $c->xAxis->setLabels ( $labels );

            $c->xAxis->setLabelStyle ( "Arial", 8, TextColor, 90 );

            # Add a title to the primary (left) y axis
            $c->yAxis->setTitle ( "PRICE" );



            # Set the axis, label and title colors for the primary y axis to red (0xc00000) to
            # match the first data set
            $c->yAxis->setColors ( 0x008000, 0x008000, 0x008000 );



            # Add a title to the secondary (right) y axis
            $c->yAxis2->setTitle ( "VOLUME" );



            # set the axis, label and title colors for the primary y axis to green (0x008000) to
            # match the second data set
            $c->yAxis2->setColors ( 0x008000, 0x008000, 0x008000 );



            $textBoxObj = $c->addText ( 500, 50, "www.stockbangladesh.org", "timesbi.ttf", 11, 0xc09090 );

            $textBoxObj->setAlignment ( TopLeft );



            # Add a line layer to the chart
            $layer = $c->addLineLayer ();



            # Add the first line. Plot the points with a 7 pixel square symbol
            $dataSetObj = $layer->addDataSet ( $data0, 0xcf4040, "Price" );

            $dataSetObj->setDataSymbol ( SquareSymbol, 5 );



            $trendLayerObj = $c->addTrendLayer ( $data0, 0x008000, "Trend Line" );

            $trendLayerObj->setLineWidth ( 1 );



            $trendLayerObj->addPredictionBand ( 0.95, 0x8066ff66 );



            $barLayerObj = $c->addBarLayer3 ( $data1 );

            $barLayerObj->setBarShape ( CircleShape );



            $barLayerObj->setUseYAxis2 ();



            //    $c->addAreaLayer($data1, $c->yZoneColor(60, 0x8033ff33, 0x80ff3333));




            //$chart1URL = $c->makeSession("chart1");
            # Create an image map for the chart




            $chartData = $c->makeChart2 ( PNG );

            $chart1URL = $c->makeSession("minchart2");

            $this->set('chart1URL', $chart1URL);



            $chartImagePath = WWW_ROOT . 'chart' . DS . 'mm_chart_full_p.png';

            $f = fopen ( $chartImagePath, "wb" );

            fwrite ( $f, $chartData );

            fclose ( $f );



            $chartImageMap = $c->getHTMLImageMap ( "", "", "title='{dataSetName} at {xLabel} =  {value|2} '" );

            $this->set ( 'chartImageMap', $chartImageMap );



            if (isset ( $_REQUEST ['mapData'] ) && $_REQUEST ['mapData'] == 'yes') {

                echo "-#-";

                echo $chartImageMap;

                die ( '-#-' );

            }

        }



        $this->set ( 'inv', $inv );

        $this->set ( 'inv1', $inv1 );
        
        
        

    }
    
    function monitorsetting()
    {
        $this->layout = 'default-one';
         
        $userId = $this->Session->read('Auth.User.id');
        $this->set('user_id',$userId);
        $symbols = $this->Symbol->find('list', array('conditions' => array('inactive = \'No\''), 'fields' => array('id','dse_code'),'order' => array('dse_code ASC')));        
        $symbolHeader = array(0 => '-Select Company-');
        $this->set('symbol', $symbolHeader+$symbols);
        
        if(!empty($this->data))
        {
            pr($this->data['Settingmonitor']['company1']);
            $monitordata['Settingmonitor']['symbol1']   = trim($this->data['Settingmonitor']['company1']);
            $monitordata['Settingmonitor']['symbol2']   = trim($this->data['Settingmonitor']['company2']);;
            $monitordata['Settingmonitor']['symbol3']   = trim($this->data['Settingmonitor']['company3']);
            $monitordata['Settingmonitor']['symbol4']   = trim($this->data['Settingmonitor']['company4']); 
            $monitordata['Settingmonitor']['symbol5']   = trim($this->data['Settingmonitor']['company5']); 
            $monitordata['Settingmonitor']['symbol6']   = trim($this->data['Settingmonitor']['company6']); 
            $monitordata['Settingmonitor']['symbol7']   = trim($this->data['Settingmonitor']['company7']); 
            $monitordata['Settingmonitor']['symbol8']   = trim($this->data['Settingmonitor']['company8']); 
            $monitordata['Settingmonitor']['symbol9']   = trim($this->data['Settingmonitor']['company9']); 
            $monitordata['Settingmonitor']['user_id']   = trim($this->data['Settingmonitor']['user_id']); 
           
            if ($this->Settingmonitor->save($monitordata))
            {
                $this->Session->setFlash('setting has been saved successfully.');
                //$this->redirect(array('controller'=>'resources','action' => 'monitor'));
            }
        }
    }
    
    function totalinfo()
    {
        
		$this->PageTitle='DSEFn';
		$this->layout = 'blank';
        
    }
    function totalinfo1()
    {
        
        $this->PageTitle='DSEFn';
        $this->layout = 'default-summary';
        
    }
	function companyname()
    {

		$params=
		array(
		'conditions' => array('Symbol.inactive' =>'no','Symbol.otc_market' =>'no'), //array of conditions
		'recursive' => 1, //int
		'fields' => array('Symbol.dse_code','Symbol.id','Symbol.name','Symbol.business_segment'), //array of field names
		'order' => array('Symbol.dse_code ASC')
		);
		$condition = ' inactive="no" AND otc_market="no"';
		$codeLists = $this->Symbol->find('all',$params); //array('fields'=> array('dse_code', 'name','name','business_segment'))
	    $this->set('codeLists', $codeLists);
		$this->layout = 'blank';
        
        
        
        //himel[
        $startDate = time()-15*24*60*60;
        $marketSummery = $this->MarketSummery->find('all', array('conditions' => array('UNIX_TIMESTAMP(str_to_date(date, \'%Y-%c-%d\'))>'.$startDate), 'order' => 'id DESC', 'limit'=>2));

        // DSE MARKET SUMMERY
        if(!empty($marketSummery))
        {
            if(isset($marketSummery[0]['MarketSummery']['date']))
            $this->set('tradeDate',$marketSummery[0]['MarketSummery']['date']);

            if(isset($marketSummery[0]['MarketSummery']['dsi']) && isset($marketSummery[1]['MarketSummery']['dsi']))
            {
                $this->set('lastdaydsi',$marketSummery[1]['MarketSummery']['dsi']);
                $dsiChange = $marketSummery[0]['MarketSummery']['dsi'] - $marketSummery[1]['MarketSummery']['dsi'];
                $dsiChangePer = ($dsiChange/$marketSummery[1]['MarketSummery']['dsi']) * 100;

                if($dsiChange > 0)
                $dsiimg = "<img src=\"".$this->webroot."img/inc.jpg\" alt=\"+\"> ";

                elseif ($dsiChange < 0)
                $dsiimg = "<img src=\"".$this->webroot."img/dec.jpg\" alt=\"-\"> ";

                elseif ($dsiChange == 0)
                $dsiimg = "<img src=\"".$this->webroot."img/eq.jpg\" alt=\"=\"> ";

                $this->set('dsiChange',$dsiChange);
                $this->set('dsiChangePer',$dsiChangePer);
                $this->set('dsiimg',$dsiimg);
            }

            if(isset($marketSummery[0]['MarketSummery']['dgen']) && isset($marketSummery[1]['MarketSummery']['dgen']))
            {
                $dgenChange = $marketSummery[0]['MarketSummery']['dgen'] - $marketSummery[1]['MarketSummery']['dgen'];
                $dgenChangePer = ($dgenChange/$marketSummery[1]['MarketSummery']['dgen']) * 100;
                $this->set('lastdaydgen',$marketSummery[1]['MarketSummery']['dgen']);
                if($dgenChange>0)
                {
                    $css='smallgreentext';
                    $dgenimg="<img src=\"".$this->webroot."img/inc.jpg\" alt=\"+\"> ";
                }

                elseif ($dgenChange<0)
                {
                    $css='smallredtext';
                    $dgenimg="<img src=\"".$this->webroot."img/dec.jpg\" alt=\"-\"> ";
                }

                elseif ($dgenChange==0)
                {
                    $css='smallgreentext';
                    $dgenimg="<img src=\"".$this->webroot."img/eq.jpg\" alt=\"=\"> ";
                }

                $this->set('css',$css);
                $this->set('dgenChangePer',$dgenChangePer);
                $this->set('dgenChange',$dgenChange);
                $this->set('dgenimg',$dgenimg);
                $this->set('dgen',$marketSummery[0]['MarketSummery']['dgen']);
            }
            if(isset($marketSummery[0]['MarketSummery']['ds20']) && isset($marketSummery[1]['MarketSummery']['ds20']))
            {
                $ds20Change = $marketSummery[0]['MarketSummery']['ds20'] - $marketSummery[1]['MarketSummery']['ds20'];
                $ds20ChangePer = ($ds20Change/$marketSummery[1]['MarketSummery']['ds20']) * 100;
                $this->set('lastdayds20',$marketSummery[1]['MarketSummery']['ds20']);
                if($ds20Change>0)
                {
                    $ds20css='smallgreentext';
                    $ds20img="<img src=\"".$this->webroot."img/inc.jpg\" alt=\"+\"> ";
                }

                elseif ($ds20Change<0)
                {
                    $ds20css='smallredtext';
                    $ds20img="<img src=\"".$this->webroot."img/dec.jpg\" alt=\"-\"> ";
                }

                elseif ($ds20Change==0)
                {
                    $ds20css='smallgreentext';
                    $ds20img="<img src=\"".$this->webroot."img/eq.jpg\" alt=\"=\"> ";
                }

                $this->set('ds20css',$ds20css);
                $this->set('ds20ChangePer',$ds20ChangePer);
                $this->set('ds20Change',$ds20Change);
                $this->set('ds20img',$ds20img);
                $this->set('ds20',$marketSummery[0]['MarketSummery']['ds20']);
            }

            // SET DSE DATA
            $this->set('dse_market_summery', $marketSummery);
            $this->set('css',$css);
            $this->set('dgenChangePer',$dgenChangePer);
            $this->set('dgenChange',$dgenChange);
            $this->set('dgenimg',$dgenimg);
            $this->set('dgen',$marketSummery[0]['MarketSummery']['dgen']);
        }

        $ctgMarketSummery = $this->Symbol->query("select * from market_summery_ctg where id=(select max(id) from market_summery_ctg)");

        if(isset($ctgMarketSummery[0]) && !empty($ctgMarketSummery[0]))
        {
            $cse30Change = ($ctgMarketSummery[0]['market_summery_ctg']['cse30changeper'] *
            $ctgMarketSummery[0]['market_summery_ctg']['cse30']) / 100;

            $cse30Change = round($cse30Change,2) ;

            $cscxChange = ($ctgMarketSummery[0]['market_summery_ctg']['cscxchageper'] *
            $ctgMarketSummery[0]['market_summery_ctg']['cscx']) / 100;

            $cscxChange=round($cscxChange,2) ;

            if($cse30Change>0)
            {
                $cssctg='smallgreentext';
                $cse30img="<img src=\"".$this->webroot."img/inc.jpg\" alt=\"+\"> ";
            }
            elseif ($cse30Change<0)
            {
                $cssctg='smallredtext';
                $cse30img="<img src=\"".$this->webroot."img/dec.jpg\" alt=\"-\"> ";
            }
            elseif ($cse30Change==0)
            {
                $cssctg='smallgreentext';
                $cse30img="<img src=\"".$this->webroot."img/eq.jpg\" alt=\"=\"> ";
            }

            if($cscxChange>0)
            {
                $cscximg="<img src=\"".$this->webroot."img/inc.jpg\" alt=\"+\"> ";
                $csscx = 'smallgreentext';
            }
            elseif ($cscxChange<0)
            {
                $cscximg="<img src=\"".$this->webroot."img/dec.jpg\" alt=\"-\"> ";
                $csscx = 'smallredtext';
            }
            elseif ($cscxChange==0)
            {
                $cscximg="<img src=\"".$this->webroot."img/eq.jpg\" alt=\"=\"> ";
                $csscx = 'smallgreentext';
            }

            // SET CSE DATA
            $this->set('cse_market_summery', $ctgMarketSummery[0]);
            $this->set('cssctg',$cssctg);
            $this->set('csscx',$csscx);
            $this->set('cse30Change',$cse30Change);
            $this->set('cscximg',$cscximg);
            $this->set('cscxChange',$cscxChange);
            $this->set('cse30img',$cse30img);
        }
        //himel]
        
    }
function upperleft()
    {
        $this->layout = 'blank';
        
    }
function marketsum($code=NULL)
    {
        $this->set('sym',$code);
		$this->layout = 'blank';
        
    }
function upperright($dsecode=NULL)
    {
       
		//$this->layout ='default-two'; 
		/*This is for make the function unchance , write according to id*/
	   $sqlStr="SELECT id FROM symbols WHERE dse_code LIKE '".$dsecode."' LIMIT 1 " ;
	   $symboldata=mysql_fetch_assoc(mysql_query($sqlStr));
	  
	   
	    $this->pageTitle = 'Stock Bangladesh :: Company Details'; 
        $symbolId=$id=$symboldata['id'];
		$this->Symbol->id =$symbolId ;//
        $shareInfo = $this->Symbol->read();	
        
        if($shareInfo['Symbol']['q1'])
            $shareInfo['Symbol']['eps_in_bd'] = $shareInfo['Symbol']['q1'];
        
        if($shareInfo['Symbol']['q2'])
            $shareInfo['Symbol']['eps_in_bd'] = $shareInfo['Symbol']['q2'];
        
        if($shareInfo['Symbol']['q3'])
            $shareInfo['Symbol']['eps_in_bd'] = $shareInfo['Symbol']['q3'];
            
        if($shareInfo['Symbol']['q4'])
            $shareInfo['Symbol']['eps_in_bd'] = $shareInfo['Symbol']['q4'];            
            
        $this->set('share_info', $shareInfo);
		$this->set('symbol_id', $symbolId);
        
        // get Last trade price
		$this->DataBank->recursive = -1;
		//$dataBank = $this->Symbol->query('first', array('conditions' => array('DataBank.symbol_id' => $symbolId), 'order' => array('DataBank.id DESC'), 'limit' => 1	));
        //$dataBank = $this->Symbol->query('SELECT * FROM data_banks_intraday WHERE symbol_id='.$symbolId.' ORDER BY id DESC LIMIT 1');
        
        $dataBank = $this->Symbol->query('SELECT open, high, low, close, volume FROM outputs WHERE symbol=\''.$symbolId.'\' ORDER BY id DESC LIMIT 1');
		        
        $dataBank = $dataBank[0];

        $this->set('databank_info', $dataBank);
        		 
		$lastTradePrice = $shareInfo['Symbol']['lasttradeprice'];		
		$yClose         = $shareInfo['Symbol']['yclose'];
        
		if($yClose == 0) {
			$todayChange    = 0;
			$todayChangePer = 0;
		} else {
			$todayChange    = $lastTradePrice - $yClose;
            
            // change on single share
			$todayChangePer = ( $todayChange / $yClose ) * 100; 
		}
		$this->set('today_change', $todayChange);
		$this->set('today_change_per', $todayChangePer);
		 		
		/*  
        *   get 52 weeks high price
        *
        *   @var high52 => HIGH PRICE FOR 52 DATE
        *   @var highDate => HIGH PRICE OCCURING DATE
        */
		$max52 = $this->Symbol->query('select MAX(high) as high52, date as highDate from outputs WHERE symbol=\''.$symbolId.'\' AND (TO_DAYS(NOW()) - TO_DAYS(FROM_UNIXTIME(daystamp)) <=365) GROUP BY symbol');		
        //pr($max52);		
		$this->set('max52', $max52[0][0]['high52']);
		
        /*  
        *   get 52 weeks low price
        *
        *   @var low52 => LOW PRICE FOR 52 DATE
        *   @var lowDate => LOW PRICE OCCURING DATE
        */		
        
		$min52 = $this->Symbol->query('select MIN(low) as low52, date as lowDate from outputs  WHERE symbol=\''.$symbolId.'\' AND (TO_DAYS(NOW()) - TO_DAYS(FROM_UNIXTIME(daystamp)) <=365) GROUP BY symbol');
        //pr($min52);
		$this->set('min52', $min52[0][0]['low52']);
		
		$newsOfShare = $this->Symbol->query('SELECT id, code, details, UNIX_TIMESTAMP(str_to_date(postdate, \'%Y-%c-%d\')) as postdate, UNIX_TIMESTAMP(str_to_date(expiredate, \'%Y-%c-%d\')) as expiredate FROM news WHERE code = \''.$shareInfo['Symbol']['dse_code'].'\' ORDER BY postdate DESC LIMIT 0 , 3 ');
		$this->set('news_of_share', $newsOfShare);
		
		$financialPerformance = $this->Symbol->query('SELECT * FROM company_financial_performance as performance WHERE symbol_id='.$symbolId.' ORDER BY fin_year DESC');
        
        $this->set('financial_performance', $financialPerformance);		
	
		//$this->set('has',"Test");
		$this->layout = 'blank';
        
    }
	
     
 function sectorweekvolumecompare($updateRequest = '') {
     if (! $this->Session->check ( 'Auth.User' )) {
            $this->Session->setFlash ( 'You are not authorized to access that location.' );
            $this->redirect ( array ('controller' => 'users', 'action' => 'login' ) );
        }
        $this->layout = 'default-three';

        $this->pageTitle = 'Stock Bangladesh :: Weekly Sector Comparison';
        
        
        $sql = "SELECT id,business_segment,dse_code FROM symbols";

        $symbolinfo = $this->Symbol->query ( $sql );


        $sortedSymbolArr = array ();
        $sortedCodeArr = array ();

        foreach ( $symbolinfo as $row ) {

            $symbol = $row ['symbols'] ['id'];
            $code = trim($row ['symbols'] ['dse_code']);

            $sector = $row ['symbols'] ['business_segment'];

            $sortedSymbolArr [$symbol] = trim ( $sector );
            $sortedCodeArr[$code]=$symbol;

        }
        
        
        $sql = "SELECT * FROM market_summeries ORDER BY id DESC LIMIT 0, 7";

        $marketArr = $this->Symbol->query ( $sql );
        
        $title = array();
        $date = explode('-',$marketArr [0] ['market_summeries'] ['date']);
        $date = $date[2].'-'.$date[1].'-'.$date[0];
        $title ['date_11'] = $date;
        
        $date = explode('-',$marketArr [1] ['market_summeries'] ['date']);
        $date = $date[2].'-'.$date[1].'-'.$date[0];
        $title ['date_12'] = $date;
        
        $title ['date_d1'] = "Change1";
        $title ['date_11c'] = 'Contribution% ('.$title ['date_11'].')';
        $title ['date_12c'] = 'Contribution% ('.$title ['date_12'].')';
        $title ['date_c1'] = 'Difference1';
        
        
        $title ['date_21'] = $title ['date_12'];
        $date = explode('-',$marketArr [2] ['market_summeries'] ['date']);
        $date = $date[2].'-'.$date[1].'-'.$date[0];        
        $title ['date_22'] = $date;
        
        $title ['date_d2'] = "Change2";
        $title ['date_21c'] = 'Contribution% ('.$title ['date_21'].')';
        $title ['date_22c'] = 'Contribution% ('.$title ['date_22'].')';
        $title ['date_c2'] = 'Difference2';
        
        $title ['date_31'] = $title ['date_22'];
        $date = explode('-',$marketArr [3] ['market_summeries'] ['date']);
        $date = $date[2].'-'.$date[1].'-'.$date[0];
        $title ['date_32'] = $date;
        
        $title ['date_d3'] = "Change3";
        $title ['date_31c'] = 'Contribution% ('.$title ['date_31'].')';
        $title ['date_32c'] = 'Contribution% ('.$title ['date_32'].')';
        $title ['date_c3'] = 'Difference3';
        
        $title ['date_41'] = $title ['date_32'];
        $date = explode('-',$marketArr [4] ['market_summeries'] ['date']);
        $date = $date[2].'-'.$date[1].'-'.$date[0];
        $title ['date_42'] = $date;
        
        $title ['date_d4'] = "Change4";
        $title ['date_41c'] = 'Contribution% ('.$title ['date_41'].')';
        $title ['date_42c'] = 'Contribution% ('.$title ['date_42'].')';
        $title ['date_c4'] = 'Difference4';
        
        $title ['date_51'] = $title ['date_42'];
        $date = explode('-',$marketArr [5] ['market_summeries'] ['date']);
        $date = $date[2].'-'.$date[1].'-'.$date[0];
        $title ['date_52'] = $date;
        
        $title ['date_d5'] = "Change5";
        $title ['date_51c'] = 'Contribution% ('.$title ['date_51'].')';
        $title ['date_52c'] = 'Contribution% ('.$title ['date_52'].')';
        $title ['date_c5'] = 'Difference5';
        
        $title ['date_61'] = $title ['date_52'];
        $date = explode('-',$marketArr [6] ['market_summeries'] ['date']);
        $date = $date[2].'-'.$date[1].'-'.$date[0];
        $title ['date_62'] = $date;
        
        $title ['date_d6'] = "Change6";
        $title ['date_61c'] = 'Contribution% ('.$title ['date_61'].')';
        $title ['date_62c'] = 'Contribution% ('.$title ['date_62'].')';
        $title ['date_c6'] = 'Difference6';
        
        //pr($marketArr);
        //pr($title);die;
        //$this->set ( 'title', $title);        
        
        $lastdate = $marketArr [0] ['market_summeries'] ['date'];

        $lastdaystamp = strtotime ( $lastdate )- (12*60*60);
        

        $onedaybefore = $marketArr [6] ['market_summeries'] ['date'];

        $onedaybeforestamp = strtotime ( $onedaybefore )-(12*60*60);



        $sql = "SELECT * FROM outputs USE INDEX (symbol) where daystamp>=$onedaybeforestamp and symbol>1 ORDER BY id DESC";

        $resultArr = $this->Symbol->query ( $sql );
        
        

        $sortedArr = array ();

        foreach ( $resultArr as $row ) {

            $day = $row ['outputs'] ['date'];

            $symbol = $row ['outputs'] ['symbol'];

            $tradevalue = $row ['outputs'] ['volume'];

            //$day = strtotime ( $day );

            $sector = $sortedSymbolArr [$symbol];

            $sortedArr [$day] [$sector] [$symbol] = $tradevalue;

        }

        
        $sectorCapArr = array ();



        foreach ( $sortedArr as $day => $arr ) {

            $marketCap = 0;

            foreach ( $arr as $sector => $datarr ) {

                $sectorTotal = 0;

                foreach ( $datarr as $symbol => $tradevalue ) {

                    $sectorTotal += $tradevalue;

                    $marketCap += $tradevalue;

                }

                $sectorCapArr [$sector] [$day] = $sectorTotal;

            }



            //echo "$marketCap <br />";
        }
        ksort($sectorCapArr);
        
         $total_0 = 0 ;
        $total_1 = 0 ;
        $total_2 = 0 ;
        $total_3 = 0 ;
        $total_4 = 0 ;
        $total_5 = 0 ;
        $total_6 = 0 ;        
       
        $total = array();
        
        foreach($sectorCapArr as $sector=>$row)
        {   
            $date1 = explode('-',$marketArr[0]['market_summeries']['date']);            
            $date_1 = ltrim(rtrim($date1[2])).'-'.ltrim(rtrim($date1[1])).'-'.ltrim(rtrim($date1[0]));            
            $total_0 += $row[$date_1];
            //echo '<br>';
            $date1 = explode('-',$marketArr[1]['market_summeries']['date']);            
            $date_1 = ltrim(rtrim($date1[2])).'-'.ltrim(rtrim($date1[1])).'-'.ltrim(rtrim($date1[0]));            
            $total_1 += $row[$date_1];
            //echo '<br>';
            $date1 = explode('-',$marketArr[2]['market_summeries']['date']);            
            $date_1 = ltrim(rtrim($date1[2])).'-'.ltrim(rtrim($date1[1])).'-'.ltrim(rtrim($date1[0]));            
            $total_2 += $row[$date_1];
            //echo '<br>';
            $date1 = explode('-',$marketArr[3]['market_summeries']['date']);            
            $date_1 = ltrim(rtrim($date1[2])).'-'.ltrim(rtrim($date1[1])).'-'.ltrim(rtrim($date1[0]));            
            $total_3 += $row[$date_1];
            //echo '<br>';
            $date1 = explode('-',$marketArr[4]['market_summeries']['date']);            
            $date_1 = ltrim(rtrim($date1[2])).'-'.ltrim(rtrim($date1[1])).'-'.ltrim(rtrim($date1[0]));            
            $total_4 += $row[$date_1];
            //echo '<br>';
            $date1 = explode('-',$marketArr[5]['market_summeries']['date']);            
            $date_1 = ltrim(rtrim($date1[2])).'-'.ltrim(rtrim($date1[1])).'-'.ltrim(rtrim($date1[0]));            
            $total_5 += $row[$date_1];
            //echo '<br>';
            $date1 = explode('-',$marketArr[6]['market_summeries']['date']);            
            $date_1 = ltrim(rtrim($date1[2])).'-'.ltrim(rtrim($date1[1])).'-'.ltrim(rtrim($date1[0]));            
            $total_6 += $row[$date_1];            
        }   
        
        
        $data = array();
        $allData = array();
        //pr($title);
        foreach ( $sectorCapArr as $sector => $arr ) 
        {
            $data['sector'] = $sector;
            foreach ( $arr as $day => $value ) 
            {
                //echo $day.' <--> '.$value.'+++';
                if($title ['date_11'] == $day){
                    $data[$title ['date_11'].'1'] = $value;
                }
                else if($title ['date_12'] == $day){
                    $data[$title ['date_12'].'2'] = $value;
                    $data['Change13'] = number_format($data[$title ['date_11'].'1'] - $data[$title ['date_12'].'2'],2,'.','');
                    
                    $data[$title ['date_11c'].'4'] = ($data[$title ['date_11'].'1']*100)/ $total_0;
                    $data[$title ['date_12c'].'5'] = ($data[$title ['date_12'].'2']*100)/ $total_1;
                    $data[$title ['date_c1'].'6'] = number_format(($data[$title ['date_11c'].'4'] - $data[$title ['date_12c'].'5']),2,'.','');
                    
                    $data[$title['date_21'].'7'] = $value;                    
                }
                else if($title ['date_22'] == $day){
                    $data[$title ['date_22'].'8'] = $value;
                    $data['Change29'] = number_format($data[$title ['date_21'].'7'] - $data[$title ['date_22'].'8'],2,'.','');
                    $data[$title ['date_21c'].'10'] = $data[$title ['date_12c'].'5'];
                    $data[$title ['date_22c'].'11'] = ($data[$title ['date_22'].'8']*100)/ $total_2;
                    $data[$title ['date_c2'].'12'] = number_format($data[$title ['date_21c'].'10'] - $data[$title ['date_22c'].'11'],2,'.','');
                    $data[$title ['date_31'].'13'] = $value;
                }
                else if($title ['date_32'] == $day){
                    $data[$title ['date_32'].'14'] = $value;
                    $data['Change315'] = number_format($data[$title ['date_31'].'13'] - $data[$title ['date_32'].'14'],2,'.','');
                    
                    $data[$title ['date_31c'].'16'] = $data[$title ['date_22c'].'11'];
                    $data[$title ['date_32c'].'17'] = ($data[$title ['date_32'].'14']*100)/ $total_3;
                    $data[$title ['date_c3'].'18'] = number_format($data[$title ['date_31c'].'16'] - $data[$title ['date_32c'].'17'],2,'.','');
                    
                    $data[$title ['date_41'].'19'] = $value;
                }
                else if($title ['date_42'] == $day){
                    $data[$title ['date_42'].'20'] = $value;
                    $data['Change421'] = number_format($data[$title ['date_41'].'19'] - $data[$title ['date_42'].'20'],2,'.','');
                    
                    $data[$title ['date_41c'].'22'] = $data[$title ['date_32c'].'17'];
                    $data[$title ['date_42c'].'23'] = ($data[$title ['date_42'].'20']*100)/ $total_4;
                    $data[$title ['date_c4'].'24'] = number_format($data[$title ['date_41c'].'22'] - $data[$title ['date_42c'].'23'],2,'.','');
                    
                    $data[$title ['date_51'].'25'] = $value;
                }
                else if($title ['date_52'] == $day){
                    $data[$title ['date_52'].'26'] = $value;
                    $data['Change527'] = number_format($data[$title ['date_51'].'25'] - $data[$title ['date_52'].'26'],2,'.','');
                    
                    $data[$title ['date_51c'].'28'] = $data[$title ['date_42c'].'23'];
                    $data[$title ['date_52c'].'29'] = ($data[$title ['date_52'].'26']*100)/ $total_5;
                    $data[$title ['date_c5'].'30'] = number_format($data[$title ['date_51c'].'28'] - $data[$title ['date_52c'].'29'],2,'.','');
                    
                    $data[$title ['date_61'].'31'] = $value;
                }
                else if($title ['date_62'] == $day){
                    $data[$title ['date_62'].'32'] = $value;
                    $data['Change633'] = number_format($data[$title ['date_61'].'31'] - $data[$title ['date_62'].'32'],2,'.','');
                    
                    $data[$title ['date_61c'].'34'] = $data[$title ['date_52c'].'29'];
                    $data[$title ['date_62c'].'35'] = ($data[$title ['date_62'].'32']*100)/ $total_6;
                    $data[$title ['date_c6'].'36'] = number_format(($data[$title ['date_61c'].'34'] - $data[$title ['date_62c'].'35']),2,'.','');
                    
                }
                else
                    $data[$day] = 0;
                
                //pr($data);
            }
            //echo '<br>';
            $allData[] = $data;

        }
       
        
        //die;
        
        $mappingName = array();
        
        foreach($allData as $value)
        {
            foreach($value as $indexName => $ivalue)
            {
                $mappingName [$indexName] = $indexName;
            }
            break;
        }

        //echo "<pre>";
        //print_r ($title);
        //print_r ($mappingName);
        //print_r ( $sectorCapArr);
        //print_r ($allData);
        //print_r ( $marketArr);
        //print_r ( $title);  
        //die;
        
        
       
        $total[] = $total_0;
        $total[] = $total_1;
        $total[] = $total_2;
        $total[] = $total_3;
        $total[] = $total_4;
        $total[] = $total_5;
        $total[] = $total_6;
        
        $data = array();
        $data['sector'] = "Z_Total";
        $data[$title ['date_11'].'1'] = $total_0;
        $data[$title ['date_12'].'2'] = $total_1;
        $data[$title ['date_d1'].'3'] = $total_0 - $total_1;
        
        $data[$title ['date_21'].'4'] = $total_1;
        $data[$title ['date_22'].'5'] = $total_2;
        $data[$title ['date_d2'].'6'] = $total_1 - $total_2;
        
        $data[$title ['date_31'].'7'] = $total_2;
        $data[$title ['date_32'].'8'] = $total_3;
        $data[$title ['date_d3'].'9'] = $total_2 - $total_3;
        
        $data[$title ['date_41'].'10'] = $total_3;
        $data[$title ['date_42'].'11'] = $total_4;
        $data[$title ['date_d4'].'12'] = $total_3 - $total_4;
        
        $data[$title ['date_51'].'13'] = $total_4;
        $data[$title ['date_52'].'14'] = $total_5;
        $data[$title ['date_d5'].'15'] = $total_4 - $total_5;
        
        $data[$title ['date_61'].'16'] = $total_5;
        $data[$title ['date_62'].'17'] = $total_6;
        $data[$title ['date_d6'].'18'] = $total_5 - $total_6;
        //$data[] = null;
        $allData[] = $data;
        
    
        //echo '<pre>';
        //pr($title);
        //pr($allData);die;
        
        
        //$this->set ( 'sectorCapArr', $sectorCapArr);
        //$this->set ( 'total', $total);
        $this->set ( 'title_a', $title);
        $this->set ( 'mappingName', $mappingName);
        //$this->set ( 'marketArr', $marketArr );
        //$this->set ( 'lastdateTotal', $lastdateTotal );
        //$this->set ( 'onedaybeforeTotal', $onedaybeforeTotal );*/

    }
    
    function getsectorweekvolumecompare() {

        $sql = "SELECT id,business_segment,dse_code FROM symbols";

        $symbolinfo = $this->Symbol->query ( $sql );


        $sortedSymbolArr = array ();
        $sortedCodeArr = array ();

        foreach ( $symbolinfo as $row ) {

            $symbol = $row ['symbols'] ['id'];
            $code = trim($row ['symbols'] ['dse_code']);

            $sector = $row ['symbols'] ['business_segment'];

            $sortedSymbolArr [$symbol] = trim ( $sector );
            $sortedCodeArr[$code]=$symbol;

        }
        
        
        $sql = "SELECT * FROM market_summeries ORDER BY id DESC LIMIT 0, 7";

        $marketArr = $this->Symbol->query ( $sql );
        
        $title = array();
        $date = explode('-',$marketArr [0] ['market_summeries'] ['date']);
        $date = $date[2].'-'.$date[1].'-'.$date[0];
        $title ['date_11'] = $date;
        
        $date = explode('-',$marketArr [1] ['market_summeries'] ['date']);
        $date = $date[2].'-'.$date[1].'-'.$date[0];
        $title ['date_12'] = $date;
        
        $title ['date_d1'] = "Change1";
        $title ['date_11c'] = 'Contribution% ('.$title ['date_11'].')';
        $title ['date_12c'] = 'Contribution% ('.$title ['date_12'].')';
        $title ['date_c1'] = 'Difference1';
        
        
        $title ['date_21'] = $title ['date_12'];
        $date = explode('-',$marketArr [2] ['market_summeries'] ['date']);
        $date = $date[2].'-'.$date[1].'-'.$date[0];        
        $title ['date_22'] = $date;
        
        $title ['date_d2'] = "Change2";
        $title ['date_21c'] = 'Contribution% ('.$title ['date_21'].')';
        $title ['date_22c'] = 'Contribution% ('.$title ['date_22'].')';
        $title ['date_c2'] = 'Difference2';
        
        $title ['date_31'] = $title ['date_22'];
        $date = explode('-',$marketArr [3] ['market_summeries'] ['date']);
        $date = $date[2].'-'.$date[1].'-'.$date[0];
        $title ['date_32'] = $date;
        
        $title ['date_d3'] = "Change3";
        $title ['date_31c'] = 'Contribution% ('.$title ['date_31'].')';
        $title ['date_32c'] = 'Contribution% ('.$title ['date_32'].')';
        $title ['date_c3'] = 'Difference3';
        
        $title ['date_41'] = $title ['date_32'];
        $date = explode('-',$marketArr [4] ['market_summeries'] ['date']);
        $date = $date[2].'-'.$date[1].'-'.$date[0];
        $title ['date_42'] = $date;
        
        $title ['date_d4'] = "Change4";
        $title ['date_41c'] = 'Contribution% ('.$title ['date_41'].')';
        $title ['date_42c'] = 'Contribution% ('.$title ['date_42'].')';
        $title ['date_c4'] = 'Difference4';
        
        $title ['date_51'] = $title ['date_42'];
        $date = explode('-',$marketArr [5] ['market_summeries'] ['date']);
        $date = $date[2].'-'.$date[1].'-'.$date[0];
        $title ['date_52'] = $date;
        
        $title ['date_d5'] = "Change5";
        $title ['date_51c'] = 'Contribution% ('.$title ['date_51'].')';
        $title ['date_52c'] = 'Contribution% ('.$title ['date_52'].')';
        $title ['date_c5'] = 'Difference5';
        
        $title ['date_61'] = $title ['date_52'];
        $date = explode('-',$marketArr [6] ['market_summeries'] ['date']);
        $date = $date[2].'-'.$date[1].'-'.$date[0];
        $title ['date_62'] = $date;
        
        $title ['date_d6'] = "Change6";
        $title ['date_61c'] = 'Contribution% ('.$title ['date_61'].')';
        $title ['date_62c'] = 'Contribution% ('.$title ['date_62'].')';
        $title ['date_c6'] = 'Difference6';
        
        //pr($marketArr);
        //pr($title);die;
        //$this->set ( 'title', $title);        
        
        $lastdate = $marketArr [0] ['market_summeries'] ['date'];

        $lastdaystamp = strtotime ( $lastdate )- (12*60*60);
        

        $onedaybefore = $marketArr [6] ['market_summeries'] ['date'];

        $onedaybeforestamp = strtotime ( $onedaybefore )-(12*60*60);



        $sql = "SELECT * FROM outputs USE INDEX (symbol) where daystamp>=$onedaybeforestamp and symbol>1 ORDER BY id DESC";

        $resultArr = $this->Symbol->query ( $sql );
        
         //pr($sortedSymbolArr);
         //pr($resultArr); die;

        $sortedArr = array ();

        foreach ( $resultArr as $row ) {

            $day = $row ['outputs'] ['date'];

            $symbol = $row ['outputs'] ['symbol'];
            $tradevalue = number_format($row ['outputs'] ['volume']);
            //$day = strtotime ( $day );
            $sector = $sortedSymbolArr [$symbol];
             //pr($sector ); 
            $sortedArr [$day] [$sector] [$symbol] = $tradevalue;

        }
        //pr($sortedArr);die;
       

        
        $sectorCapArr = array ();



        foreach ( $sortedArr as $day => $arr ) {

            $marketCap = 0;

            foreach ( $arr as $sector => $datarr ) {

                $sectorTotal = 0;

                foreach ( $datarr as $symbol => $tradevalue ) {

                    $sectorTotal += $tradevalue;

                    $marketCap += $tradevalue;

                }

                $sectorCapArr [$sector] [$day] = $sectorTotal;

            }



            //echo "$marketCap <br />";
        }
        ksort($sectorCapArr);
        
        
        $total_0 = 0 ;
        $total_1 = 0 ;
        $total_2 = 0 ;
        $total_3 = 0 ;
        $total_4 = 0 ;
        $total_5 = 0 ;
        $total_6 = 0 ;
      
        $total = array();
        
        foreach($sectorCapArr as $sector=>$row)
        {   
            $date1 = explode('-',$marketArr[0]['market_summeries']['date']);            
            $date_1 = ltrim(rtrim($date1[2])).'-'.ltrim(rtrim($date1[1])).'-'.ltrim(rtrim($date1[0]));            
            $total_0 += $row[$date_1];
            //echo '<br>';
            $date1 = explode('-',$marketArr[1]['market_summeries']['date']);            
            $date_1 = ltrim(rtrim($date1[2])).'-'.ltrim(rtrim($date1[1])).'-'.ltrim(rtrim($date1[0]));            
            $total_1 += $row[$date_1];
            //echo '<br>';
            $date1 = explode('-',$marketArr[2]['market_summeries']['date']);            
            $date_1 = ltrim(rtrim($date1[2])).'-'.ltrim(rtrim($date1[1])).'-'.ltrim(rtrim($date1[0]));            
            $total_2 += $row[$date_1];
            //echo '<br>';
            $date1 = explode('-',$marketArr[3]['market_summeries']['date']);            
            $date_1 = ltrim(rtrim($date1[2])).'-'.ltrim(rtrim($date1[1])).'-'.ltrim(rtrim($date1[0]));            
            $total_3 += $row[$date_1];
            //echo '<br>';
            $date1 = explode('-',$marketArr[4]['market_summeries']['date']);            
            $date_1 = ltrim(rtrim($date1[2])).'-'.ltrim(rtrim($date1[1])).'-'.ltrim(rtrim($date1[0]));            
            $total_4 += $row[$date_1];
            //echo '<br>';
            $date1 = explode('-',$marketArr[5]['market_summeries']['date']);            
            $date_1 = ltrim(rtrim($date1[2])).'-'.ltrim(rtrim($date1[1])).'-'.ltrim(rtrim($date1[0]));            
            $total_5 += $row[$date_1];
            //echo '<br>';
            $date1 = explode('-',$marketArr[6]['market_summeries']['date']);            
            $date_1 = ltrim(rtrim($date1[2])).'-'.ltrim(rtrim($date1[1])).'-'.ltrim(rtrim($date1[0]));            
            $total_6 += $row[$date_1];
        }
        
        
        
        $data = array();
        $allData = array();
        
       foreach ( $sectorCapArr as $sector => $arr ) 
        {
            $data['sector'] = $sector;
            foreach ( $arr as $day => $value ) 
            {
                //echo $day.' <--> '.$value.'+++';
                if($title ['date_11'] == $day){
                    $data[$title ['date_11'].'1'] = $value;
                }
                else if($title ['date_12'] == $day){
                    $data[$title ['date_12'].'2'] = $value;
                    $data['Change13'] = number_format($data[$title ['date_11'].'1'] - $data[$title ['date_12'].'2'],2,'.','');
                    
                    $data[$title ['date_11c'].'4'] = ($data[$title ['date_11'].'1']*100)/ $total_0;
                    $data[$title ['date_12c'].'5'] = ($data[$title ['date_12'].'2']*100)/ $total_1;
                    $data[$title ['date_c1'].'6'] = number_format(($data[$title ['date_11c'].'4'] - $data[$title ['date_12c'].'5']),2,'.','');
                    
                    $data[$title['date_21'].'7'] = $value;                    
                }
                else if($title ['date_22'] == $day){
                    $data[$title ['date_22'].'8'] = $value;
                    $data['Change29'] = number_format($data[$title ['date_21'].'7'] - $data[$title ['date_22'].'8'],2,'.','');
                    $data[$title ['date_21c'].'10'] = $data[$title ['date_12c'].'5'];
                    $data[$title ['date_22c'].'11'] = ($data[$title ['date_22'].'8']*100)/ $total_2;
                    $data[$title ['date_c2'].'12'] = number_format($data[$title ['date_21c'].'10'] - $data[$title ['date_22c'].'11'],2,'.','');
                    $data[$title ['date_31'].'13'] = $value;
                }
                else if($title ['date_32'] == $day){
                    $data[$title ['date_32'].'14'] = $value;
                    $data['Change315'] = number_format($data[$title ['date_31'].'13'] - $data[$title ['date_32'].'14'],2,'.','');
                    
                    $data[$title ['date_31c'].'16'] = $data[$title ['date_22c'].'11'];
                    $data[$title ['date_32c'].'17'] = ($data[$title ['date_32'].'14']*100)/ $total_3;
                    $data[$title ['date_c3'].'18'] = number_format($data[$title ['date_31c'].'16'] - $data[$title ['date_32c'].'17'],2,'.','');
                    
                    $data[$title ['date_41'].'19'] = $value;
                }
                else if($title ['date_42'] == $day){
                    $data[$title ['date_42'].'20'] = $value;
                    $data['Change421'] = number_format($data[$title ['date_41'].'19'] - $data[$title ['date_42'].'20'],2,'.','');
                    
                    $data[$title ['date_41c'].'22'] = $data[$title ['date_32c'].'17'];
                    $data[$title ['date_42c'].'23'] = ($data[$title ['date_42'].'20']*100)/ $total_4;
                    $data[$title ['date_c4'].'24'] = number_format($data[$title ['date_41c'].'22'] - $data[$title ['date_42c'].'23'],2,'.','');
                    
                    $data[$title ['date_51'].'25'] = $value;
                }
                else if($title ['date_52'] == $day){
                    $data[$title ['date_52'].'26'] = $value;
                    $data['Change527'] = number_format($data[$title ['date_51'].'25'] - $data[$title ['date_52'].'26'],2,'.','');
                    
                    $data[$title ['date_51c'].'28'] = $data[$title ['date_42c'].'23'];
                    $data[$title ['date_52c'].'29'] = ($data[$title ['date_52'].'26']*100)/ $total_5;
                    $data[$title ['date_c5'].'30'] = number_format($data[$title ['date_51c'].'28'] - $data[$title ['date_52c'].'29'],2,'.','');
                    
                    $data[$title ['date_61'].'31'] = $value;
                }
                else if($title ['date_62'] == $day){
                    $data[$title ['date_62'].'32'] = $value;
                    $data['Change633'] = number_format($data[$title ['date_61'].'31'] - $data[$title ['date_62'].'32'],2,'.','');
                    
                    $data[$title ['date_61c'].'34'] = $data[$title ['date_52c'].'29'];
                    $data[$title ['date_62c'].'35'] = ($data[$title ['date_62'].'32']*100)/ $total_6;
                    $data[$title ['date_c6'].'36'] = number_format(($data[$title ['date_61c'].'34'] - $data[$title ['date_62c'].'35']),2,'.','');
                    
                }
                else
                    $data[$day] = 0;
                
                //pr($data);
            }
            //echo '<br>';
            $allData[] = $data;

        }
       
        
       
        
        $total[] = $total_0;
        $total[] = $total_1;
        $total[] = $total_2;
        $total[] = $total_3;
        $total[] = $total_4;
        $total[] = $total_5;
        $total[] = $total_6;
        
        $data = array();
        $data['sector'] = "Z_Total";
        $data[$title ['date_11'].'1'] = $total_0;
        $data[$title ['date_12'].'2'] = $total_1;
        $data[$title ['date_d1'].'3'] = $total_0 - $total_1;
        $data[$title ['date_11c'].'4'] = 0;
        $data[$title ['date_12c'].'5'] = 0;
        $data[$title ['date_c1'].'6'] = 0;
        
        
        $data[$title ['date_21'].'7'] = $total_1;
        $data[$title ['date_22'].'8'] = $total_2;
        $data[$title ['date_d2'].'9'] = $total_1 - $total_2;
        $data[$title ['date_21c'].'10'] = 0;
        $data[$title ['date_22c'].'11'] = 0;
        $data[$title ['date_c2'].'12'] = 0;
        
        $data[$title ['date_31'].'13'] = $total_2;
        $data[$title ['date_32'].'14'] = $total_3;
        $data[$title ['date_d3'].'15'] = $total_2 - $total_3;
        $data[$title ['date_31c'].'16'] = 0;
        $data[$title ['date_32c'].'17'] = 0;
        $data[$title ['date_c3'].'18'] = 0;
        
        $data[$title ['date_41'].'19'] = $total_3;
        $data[$title ['date_42'].'20'] = $total_4;
        $data[$title ['date_d4'].'21'] = $total_3 - $total_4;
        $data[$title ['date_41c'].'22'] = 0;
        $data[$title ['date_42c'].'23'] = 0;
        $data[$title ['date_c4'].'24'] = 0;
        
        $data[$title ['date_51'].'25'] = $total_4;
        $data[$title ['date_52'].'26'] = $total_5;
        $data[$title ['date_d5'].'27'] = $total_4 - $total_5;
        $data[$title ['date_51c'].'28'] = 0;
        $data[$title ['date_52c'].'29'] = 0;
        $data[$title ['date_c5'].'30'] = 0;
        
        $data[$title ['date_61'].'31'] = $total_5;
        $data[$title ['date_62'].'32'] = $total_6;
        $data[$title ['date_d6'].'33'] = $total_5 - $total_6;
        $data[$title ['date_61c'].'34'] = 0;
        $data[$title ['date_62c'].'35'] = 0;
        $data[$title ['date_c6'].'36'] = 0;
        //$data[] = null;
        $allData[] = $data;
        
        $arr        = $allData;
        $jsonresult = $this->__JEncode ( $arr );
        echo '({"total":"' . count ( $jsonresult ) . '","results":' . $jsonresult . '})';
        
        die ();

    }
    
     function savevolume()
    {
        
        
            $inv = 60;
            $inv1 = 300;
            $requestdate = $this->data['date'];
            
            
            $date = time();// date('Y-m-d h:i:s',time()+6*60*60);
            $interval = $inv;
            $requestTimeStamp = mktime ( 0, 0, 0, date ( 'm' ), date ( 'd' ), date ( 'Y' ) );
            
            $symbolarray = $this->Symbol->query("SELECT * FROM symbols WHERE inactive='No' ;"); 
            //$symbolarray = $this->Symbol->find ( 'all', array ('conditions'=>array('inactive=\'No\''),'limit'=>40, 'fields' => array ( 'Symbol.id') ) );
            
         foreach($symbolarray as $symbol)
            {
            $shareDataSql = 'select * from data_banks_intraday where symbol_id =' . $symbol['symbols']['id'] . '  AND TO_DAYS(FROM_UNIXTIME(date)) = TO_DAYS(FROM_UNIXTIME(' . $requestTimeStamp . '))  ORDER BY id DESC LIMIT 0, 400' ;
            //$shareData = mysql_query ( $shareDataSql, $AMILink );
            
            $shareDatainfo = $this->Symbol->query($shareDataSql);   
            //pr($shareDatainfo);
            $timeWiseArr = array ();
            $timeKeyArr  = array ();

            foreach ( $shareDatainfo as $row ) {
                $currenttime = $row ['data_banks_intraday']['date'];
                

                $mod = $currenttime % $interval;
                $timeToBeAccounted = $currenttime - $mod + $interval;
                $timeWiseArr [$timeToBeAccounted] [] = $row;
                $modtime = date ( 'd M  h:ia', $timeToBeAccounted );
            }

            //pr($timeWiseArr);
            $rowDataVolumeStart = 0;
            $rowDataVolumeEnd = 0;
            $currentDataVolume = 0;
            $tempVolumeCounter = 0;
            $totalArrayCount = count($timeWiseArr);
            $myDefinedCounter = 1;
            foreach ( $timeWiseArr as $key => $arr ) {
                $timeKeyArr [] = $key;
            }

            //pr($tempVolumeCounter);
            $finalArr = array ();
            $totalvolume = $shareDatainfo[0]['data_banks_intraday']['volume'];
            $tradetimestamp = $shareDatainfo[0]['data_banks_intraday']['date'];
            $dayhigh = $shareDatainfo [0]['data_banks_intraday']['high'];
            $daylow = $shareDatainfo [0]['data_banks_intraday']['low'];
            $totaltrade = $shareDatainfo [0]['data_banks_intraday']['trade'];
            $yclose = $shareDatainfo [0]['data_banks_intraday']['yclose'];

            $tradeDate = date ( 'd M y h:ia', $tradetimestamp );
            $i = 0;
            $singleCount = 0;
            $finalPrice = 0;
            //pr($timeWiseArr);
            $startPrice = 0;
            $endPrice = 0;
            foreach ( $timeWiseArr as $key => $arr ) {
                $datetime = date ( 'h:i A', $key );
                $temp = array ();
                $startArr = array ();
                $endArr = array ();
                $ind = count ( $arr );
                $counterArr = count($arr);
                $finalPrice = $arr[0]['data_banks_intraday']['close'];


                if(!$rowDataVolumeStart) {
                    $rowDataVolumeStart = $arr[0]['data_banks_intraday']['volume'];
                    $startPrice = $arr[0]['data_banks_intraday']['close'];
                }

                if($myDefinedCounter==$totalArrayCount){
                    $rowDataVolumeEnd  =0;
                    $endPrice = $arr[0]['data_banks_intraday']['yclose'];
                }else {
                    $rowDataVolumeEnd = $arr[$counterArr-1]['data_banks_intraday']['volume'];
                    $endPrice = $arr[0]['data_banks_intraday']['close'];

                }

                //$endArr ['data_banks_intraday'] ['lastprice'];
             
                if ($ind == 1) {
                    $startArr = $arr [$ind - 1];
                    $endArr = $arr [$ind - 1];

                    if (isset ( $timeKeyArr [$i + 1] )) {
                        $time = $timeKeyArr [$i + 1];
                        $endvolume = $timeWiseArr [$time] [0]['data_banks_intraday']['volume'];
                    } else {
                        $endvolume = 0;
                    }
                    $startvolume = $startArr['data_banks_intraday']['volume'];
                } else {

                    if (isset ( $timeKeyArr [$i] )) {
                        $time = $timeKeyArr [$i];

                        $preArrInd = count ($timeWiseArr [$time] );

                        $startvolume = $timeWiseArr [$time] [0]['data_banks_intraday']['volume'];
                        //pr("found");
                    } else {
                        $startvolume = 0;
                        //pr('NO');
                    }
             
                    $endArr = $arr [$ind - 1];

                    if (isset ( $endArr )) {
                        $endvolume = $endArr ['data_banks_intraday']['volume'];
                    } else {
                        $endvolume = 0;
                    }
                }
                $temp ['ltp'] = $finalPrice;
                $finalPrice = $arr[$counterArr-1]['data_banks_intraday']['lastprice'];
                
                $temp ['high'] = $endArr ['data_banks_intraday']['high'];
                $temp ['low'] = $endArr ['data_banks_intraday']['low'];
                $temp ['close'] = $endArr ['data_banks_intraday']['close'];
                $temp ['yclose'] = $endArr['data_banks_intraday']['yclose'];
                $temp ['trade'] = $endArr ['data_banks_intraday']['trade'] ;
                $temp ['volume'] = $rowDataVolumeStart - $rowDataVolumeEnd;

                if($startPrice > $endPrice){
                    $myPositiveCounter += $temp ['volume'];

                }else {
                    $myNegativeCounter += $temp ['volume'];
                }

                $rowDataVolumeStart = $rowDataVolumeEnd;
                $startPrice = $endPrice;
                $myDefinedCounter++;

                $temp ['value'] = $endArr ['data_banks_intraday']['value'];
                $temp ['datetime'] = $datetime;
                $temp ['idatetime'] = $key;
                $finalArr [] = $temp;

                ++ $i;
            }


            $xdata = array ();
            $ydata = array ();
            $vdata = array ();

            $totalbar = count ( $finalArr );

            foreach ( $finalArr as $mykey => $row ) {
                $volumetemp = $row ['volume'];

                if ($volumetemp < 0) {
                    continue;
                }

                $xdata [] = $row ['ltp'];
                $vdata [] = $finalArr [$mykey +1] =$row ['volume'];

  //              if ($interval < 120 && $totalbar > 80) {

//                    if ($interval == 60) {
//                        $yint = 600;
//                    } else {
//                        $yint = 300;
//                    }
//                    $currenttime = $row ['idatetime'];

//                    $mod = $currenttime % $yint;

//                    if ($mod == 0) {
//                        $ydata [] = $row ['datetime'];
//                    } else {
//                        $ydata [] = "-";
//                    }
//                } else {
//                    $ydata [] = $row ['datetime'];
//                }

            }



            $xdata = array_reverse ( $xdata );
            //$ydata = array_reverse ( $ydata );
            $vdata = array_reverse ( $vdata );
            
            $max = 50;

            //$lastprice = $xdata [count ( $xdata ) - 1];
            //$lasttime = $ydata [count ( $ydata ) - 1];
            //$lastvolume = $vdata [count ( $vdata ) - 1];

            //pr($vdata);
            array_unshift($vdata, 0);
            array_pop($vdata);
            
            # The data for the chart
            $myPositiveCounter=0;
            $myNegativeCounter=0;
            $myEqualCounter=0;

            if($yclose<$xdata[0])
            {
                $myPositiveCounter=$vdata[0];
            }
            if($yclose>$xdata[0])
            {
                $myNegativeCounter=$vdata[0];
            }
            /* echo "<pre >";
            echo "xdata";
            print_r($xdata);
            echo "vdata";
            print_r($vdata);
            exit;
            */
            for($i=0;$i<count($vdata);$i++)
            {
                if($xdata[$i]>$xdata[$i-1])
                {

                    $myPositiveCounter+=$vdata[$i];
                    
                }
                if ($xdata[$i]<$xdata[$i-1])
                {
                    $myNegativeCounter+=$vdata[$i];
                    
                }
                if ($xdata[$i]==$xdata[$i-1])
                {
                    $myEqualCounter+=$vdata[$i];

                }


            }
            //exit;
            $data0 = $xdata;
            $data1 = $vdata;
            //$labels = $ydata;

            $myPositivePer=($myPositiveCounter/$totalvolume)*100;
            $myPositivePer=round($myPositivePer,2);

            $myNegativePer=($myNegativeCounter/$totalvolume)*100;
            $myNegativePer=round($myNegativePer,2);

            $myEqualPer=($myEqualCounter/$totalvolume)*100;
            $myEqualPer=round($myEqualPer,2);
        
            $company_id = $symbol['symbols']['id'];
        //pr($myPositiveCounter.' '.$symbol['Symbol']['id'] );
        //pr($myPositivePer);
        //pr($myNegativeCounter);
        ///pr($myNegativePer);
       // pr($myEqualCounter);
       // pr($myEqualPer) ;
        
        $sql = "INSERT INTO `volume_data` ( `id` , `symbol` , `bull_volume` , `bull_per`, `bear_volume` , `bear_per` , `neutral_volume`, `neutral_per`, `total_volume`, `date`)                    
                            VALUES (NULL , '$company_id', '$myPositiveCounter', '$myPositivePer','$myNegativeCounter', '$myNegativePer', '$myEqualCounter' ,'$myEqualPer' ,'$totalvolume' ,'$date');";
        
        $checkduplicate = "SELECT * FROM volume_data WHERE symbol =".$company_id;
        $duplicate = $this->Symbol->query($checkduplicate);
        //pr($duplicate);
            if(empty($duplicate))
            {
            $this->Symbol->query($sql);             
            }
      }   
        
 }
 
function datamatrixsector()
     {
        $this->layout = 'default-one';
        $userId = $this->Session->read('Auth.User.id');
        //pr($userId);
        $this->set('user_id',$userId);
        $sectorsql = "SELECT DISTINCT(business_segment) FROM symbols WHERE inactive='No' AND business_segment!=''";
        $sectors = $this->Symbol->query($sectorsql);
        
        $selectedsector = $this->Sectorsetting->find('all', array('conditions' => array('user_id ='.$userId), 'fields' => array('sectorname')));
        $sector_list = array();
        foreach($selectedsector as $selected)
        {
           $sector_list[] = $selected['Sectorsetting']['sectorname']; 
        }
        //pr($sector_list); die;
        $this->set('sectorlist',$sector_list);
        $this->set('sector',$sectors);
        
        $this->set('total',count($sector_list));
        //$this->set('totalsector',count($sectors));
        
        
       // pr($symbols); 
        if(!empty($this->data))
        {
          
            $deletesql = "DELETE FROM `sectorsettings` WHERE user_id = $userId ;" ;
            $deleted = $this->Symbol->query($deletesql);
            $namesql = "SELECT DISTINCT(business_segment) FROM symbols WHERE inactive='No' AND business_segment!=''";
            $dsecode = $this->Symbol->query($namesql);
            $status = 1;
            
            for($i=0;$i<count($dsecode);$i++)
            {
                if($this->data['Resource'][$dsecode[$i]['symbols']['business_segment']]!='0')
                {
                 $sector_name = $dsecode[$i]['symbols']['business_segment'];
                 $insertsql = "INSERT INTO `sectorsettings` ( `user_id` , `sectorname` , `status`) VALUES ('$userId' , '$sector_name', '$status') ;" ;
                 $selected = $this->Symbol->query($insertsql);
                 
                }
                
            }
            $this->Session->setFlash('setting has been saved successfully.');
            $this->redirect ( array ('controller' => 'resources', 'action' => 'datamatrixsector' ) );
            
          }
  
  }
 
 function sectortracker($sector=NULL) {
     
     if (! $this->Session->check ( 'Auth.User' )) {
            $this->Session->setFlash ( 'You are not authorized to access that location.' );
            $this->redirect ( array ('controller' => 'users', 'action' => 'login' ) );
        }
        $this->layout = 'default-one';
       // Configure::write("debug",3);
        $sectorsql = "SELECT DISTINCT business_segment FROM symbols WHERE inactive='No' AND business_segment!=''";
        $sectorArr = $this->Symbol->query ( $sectorsql );
        
        foreach($sectorArr as $arr)
        {
            $sec_name = $arr['symbols']['business_segment'];
            $sec_name = str_replace("&","and",$sec_name);            
            $sectors[]['business_segment'] = $sec_name;
        }
        $this->set('sectors',$sectors);
        if($sector=='')
         {
           $sector='Bank';
         }
        $this->set('key',$sector);
        
        
        
        /////////////////////////////////// EPS, company information of specific sector////////////////////////////
        $sector = str_replace("and","&",$sector);
        $sql = "SELECT id,dse_code,business_segment,market_lot,q1, q2, q3, q4 FROM symbols WHERE business_segment LIKE '%$sector%'";
        $symbolinfo = $this->Symbol->query ( $sql );
        //pr($symbolinfo); die;
        $this->set('no_of_items',count($symbolinfo));
        //echo "<pre>";
        //print_r($symbolinfo); 
        
        $sortedSymbolArr = array ();
        $sortedCodeArr = array ();

        foreach ( $symbolinfo as $row ) {
            $symbol = $row ['symbols'] ['id'];
            $code = trim($row ['symbols'] ['dse_code']);
            $q1 = $row ['symbols'] ['q1'];
            $q2 = $row ['symbols'] ['q2'];
            $q3 = $row ['symbols'] ['q3'];
            $q4 = $row ['symbols'] ['q4'];
            
            if($q1)
            {
                $qeps   = $q1;
                $factor = 4;
                $querterNo = "Q1";
            }
            if($q2)
            {
                $qeps   = $q2;
                $factor = 2;
                $querterNo = "Q2";
            }
            if($q3)
            {
                $qeps   = $q3;
                $factor = 4/3;
                $querterNo = "Q3";
            }
            if($q4)
            {
                $qeps   = $q4;
                $factor = 1;
                $querterNo = "Annual";
            }
            
            $annualizedEPS    = $qeps*$factor;
            $sortedCodeArr[$symbol]=$annualizedEPS;
            $sortedSymbolArr [] = trim ( $symbol );
        }
        //$totalepsarr =array();
        $totaleps = 0;
        foreach($sortedCodeArr as $symbol=>$eps)
        {
            $totaleps += $eps;////////////////total eps of all company of a particular sector
            
        }
        $this->set('totaleps',$totaleps);
        //pr($totaleps); die;
        /////////////////////////////////////end finding EPS,company information/////////////////////////////////////
        
        $this->set('totalcompany',count($sortedSymbolArr));
        $sql = "SELECT * FROM market_summeries ORDER BY id DESC LIMIT 0, 8";
        $marketArr = $this->Symbol->query ( $sql );
        $datearr= array();
        foreach($marketArr as $market)
        {
            $datearr[] = $market['market_summeries']['date'] ;
            
        }
        //print_r( $datearr);
        
        $lastdate = $datearr [0];
        $lastdaystamp = strtotime ( $lastdate )- (12*60*60);
        $this->set('today',$lastdate);
        $this->set('dates',$datearr);

        $sixdaybeforestamp = strtotime ( $datearr[6] )-(12*60*60);
        
        $sevendaybeforestamp = strtotime ( $datearr[7] )-(12*60*60);
        
        $totaldaytradevalues = array();
        $totaldaytradevolume = array();
        $companycount = array();
        $symbolresult =  array();
      
/********************************************************************************************************************/      
     // echo "<pre>";
        foreach($datearr as $date)
        {
            ///***** find out the total tradevalues total volume of a particular day 
           $sqlall = "SELECT SUM(tradevalues),SUM(volume)     FROM outputs  WHERE TO_DAYS(FROM_UNIXTIME(daystamp))= TO_DAYS('$date') and symbol>1 ORDER BY id ASC";
            $resultArrall = $this->Symbol->query ($sqlall );
          //  echo "<pre>";
        //    print_r($resultArrall);
            $datewisecompanyinfo = array();
            foreach($sortedSymbolArr as $symbol)///////////find out the company names of a specific sector in a particular date
            {
                $symbolsql = "SELECT symbol,trade,date FROM outputs WHERE TO_DAYS(FROM_UNIXTIME(daystamp))= TO_DAYS('$date') and symbol = '$symbol' ORDER BY id ASC";
                $symbolresult[$date][] = $this->Symbol->query ( $symbolsql );
                //print_r($symbolresult);
                $count = 0;
                for($i=0;$i<count($symbolresult[$date]);$i++)
                {
                    
                    if(!empty($symbolresult[$date][$i]))
                    {
                        //pr($symbolresult[$date][$i][0]['outputs']['symbol']);
                        //$datewisecompanyinfo[$date] = $symbolresult[$date][$i][0]['outputs']['symbol'];
                        $companycount[$date] =  ++$count;
                    }
                }
            }
            //pr($symbolresult);die;
            //pr($companycount);
            $totaldaytradevalues[$date] = $resultArrall[0][0]['SUM(tradevalues)'];
            $totaldaytradevolume[$date] = $resultArrall[0][0]['SUM(volume)'];
        //    $totalnosprice[$date] = $resultArrall[0][0]['total_capital'];///////////////////////////Total NOS*price
        }
        //print_r($totalnosprice);
        $this->set('totaldayvalue',$totaldaytradevalues);
        $this->set('totaldayvolume',$totaldaytradevolume);
        $this->set('eachdaycompany',$companycount);
        //pr($companycount);
        //pr($symbolresult);
        
       // die;
        
       //////////////////////////for NAV/////////////////////////////////////////////////////////
       $datewiseNAV = array();
       $lastpricearr = array();
       $numberofsharearr = array();
       foreach($symbolresult as $date=>$symbol)
       {
           //pr($date);
           //pr($symbol);
           $totalNav = 0;
           $lastpriceofsector = 0;
           $no_of_share = 0;
           foreach($symbol as $arr)
           {
               //pr($arr);
                   if(!empty($arr))
                   {
                    $financialPerformance = $this->Symbol->query('SELECT symbol_id,code,fin_year,earning_per_share,asset_val_per_share  FROM company_financial_performance as performance WHERE symbol_id='.$arr[0]['outputs']['symbol'].' AND earning_per_share!=\'\' AND asset_val_per_share!=\'\' ORDER BY fin_year DESC LIMIT 1');
                    //pr($financialPerformance);
                    $totalNav += $financialPerformance[0]['performance']['asset_val_per_share']; 
                    $datewiseNAV[$date] = $totalNav;
                    
                    $lastprice = $this->Symbol->query('SELECT id,lasttradeprice,no_of_securities  FROM symbols WHERE id='.$arr[0]['outputs']['symbol'].' AND inactive=\'No\'  ORDER BY id ');  
                    $lastpriceofsector +=$lastprice[0]['symbols']['lasttradeprice']; 
                    $no_of_share +=$lastprice[0]['symbols']['no_of_securities']; 
                    $lastpricearr[$date] = $lastpriceofsector;
                    $numberofsharearr[$date] = $no_of_share;
                    
                  }
           }
       }
       
       //pr($numberofsharearr); die;
       //pr($this->closeData);
       
       //pr($this->closeData);
       
       $this->set('totalnav',$datewiseNAV);
       $this->set('avglastprice',$lastpricearr);
       $this->set('totalshare',$numberofsharearr);
       //die;
       ////////////////////////////////////******End calculating NAV******/////////////////////////////////
  
        foreach($sortedSymbolArr as $symbols)
        {
            ///find out output information of a particular sector for last seven days
           $sql = "SELECT * FROM outputs USE INDEX (symbol) where daystamp>=$sevendaybeforestamp and symbol=$symbols ORDER BY id DESC";
           $resultArr[] = $this->Symbol->query ( $sql );
           //Find NOS*price 
           $sqlStr="SELECT no_of_securities as nos_price,outstanding_capital as total_authorise_capital ,share_percentage_director, share_percentage_govt,          share_percentage_institute , share_percentage_foreign,share_percentage_public  FROM symbols WHERE id = $symbols";
           $nosPriceArr[$symbols] = $this->Symbol->query ( $sqlStr );
        }
                       
        /*NOS*price*/
       $sortedArr = array ();
        $volumeArr = array();
        $tradeArr = array();
        $noPriceArr = array();
        foreach ( $resultArr as $rows ) {
            foreach($rows as $row)
            {
                $day = $row ['outputs'] ['date'];
                $symbol = $row ['outputs'] ['symbol'];
                $tradevalue = $row ['outputs'] ['tradevalues'];
                $tradevolume = $row ['outputs'] ['volume'];
                $tradenumber = $row ['outputs'] ['trade'];
                $noPriceArr= $row ['outputs'] ['tradevalues']*$nosPriceArr[$symbol][0]['symbols']['nos_price'];
                
                $day = strtotime ( $day );
                $sortedArr [$day] [$symbol] = $tradevalue;  ///////////sorted array contains the  tradevalues of a particular company of a day
                $volumeArr [$day] [$symbol] = $tradevolume; ///////////sorted array contains the  volume of a particular company of a day
                $tradeArr [$day] [$symbol] = $tradenumber;  ///////////sorted array contains the  number of trade of a particular company of a day
                $nosPrice[$day][$symbol] = $noPriceArr;
                
            }
        }
                
        $total_authorise_capital=0;
        $share_percentage_govt=0.0;
        $share_percentage_director=0;
        $share_percentage_institute=0;
        $share_percentage_foreign=0;
        $share_percentage_public=0;
        
        foreach($nosPriceArr as $auth_data  ){
        $total_authorise_capital+=$auth_data[0]['symbols']['total_authorise_capital'];
        $share_percentage_govt+=$auth_data[0]['symbols']['share_percentage_govt'];
        $share_percentage_director+=$auth_data[0]['symbols']['share_percentage_director'];
        $share_percentage_institute+=$auth_data[0]['symbols']['share_percentage_institute'];
        $share_percentage_foreign+=$auth_data[0]['symbols']['share_percentage_foreign'];
        $share_percentage_public+=$auth_data[0]['symbols']['share_percentage_public'];
        }
        $this->set('total_authorise_capital',$total_authorise_capital);
        $this->set('share_percentage_govt',$share_percentage_govt);
        $this->set('share_percentage_institute',$share_percentage_institute);
        $this->set('share_percentage_director',$share_percentage_director);
        $this->set('share_percentage_foreign',$share_percentage_foreign);
        $this->set('share_percentage_public',$share_percentage_public);
        //pr($volumeArr);
         
        
        $sectorCapArr = array ();
        
        foreach ( $sortedArr as $day => $arr ) {   ///////////
             $sectorTotal = 0;
            foreach ( $arr as $symbol => $tradevalue ) {
                $sectorTotal += $tradevalue; /////////sector total contains the total tradevalues of a sector
                $sectorCapArr [$sector] [$day] = $sectorTotal;  //total tradevalues of a prticular day of a particular sector
            }   
          }
          //pr($sectorCapArr);die;   
         
          //pr($volumeArr); die;
          $sectortotalvolumeArr = array();
          foreach ( $volumeArr as $day => $arr ) {
             $sectorTotalvolume = 0;
            foreach ( $arr as $symbol => $tradevolume ) {
                $sectorTotalvolume += $tradevolume;  ///////////////sectotalvolume contains total volume of a sector 
                $sectortotalvolumeArr [$sector] [$day] = $sectorTotalvolume; //total volume of a prticular day of a particular sector
            }   
          }
          //pr($sectortotalvolumeArr); die;
          
          $sectortotaltradeArr = array();
          //pr($tradeArr); die;
          foreach ( $tradeArr as $day => $arr ) {
             $sectorTotaltrade = 0;
            foreach ( $arr as $symbol => $tradenumber ) {
                $sectorTotaltrade += $tradenumber;  ///////////////$sectorTotaltrade contains total number of trade of a sector 
                $sectortotaltradeArr [$sector] [$day] = $sectorTotaltrade; //total volume of a prticular day of a particular sector

            }   
          }
          //pr($sectortotaltradeArr); die;
        
        $sectortotalcaptalArr=array();
        foreach ( $nosPrice as $day => $arr ) {
             $sectorNoPrice = 0;
            foreach ( $arr as $symbol => $nos_price ) {
                $sectorNoPrice += $nos_price;  ///////////////sectotalvolume contains total volume of a sector 
                $sectortotalcaptalArr [$sector] [$day] = $sectorNoPrice; //total volume of a prticular day of a particular sector
            }   
          }
        $this->set('contribution',$sectorCapArr);
        $this->set('totalvolume',$sectortotalvolumeArr);
        $this->set('totaltrade',$sectortotaltradeArr);
        $this->set('totalcapital',$sectortotalcaptalArr);
   }
    
 function getsectorlist() {

       $userId = $this->Session->read('Auth.User.id');
       
       $selectedsector = $this->Sectorsetting->find('all', array('conditions' => array('user_id ='.$userId), 'fields' => array()));
       
       if(!empty($selectedsector))
       {
       
        $sector_list = array();
        foreach($selectedsector as $selected)
        {
           $sector_list[] = $selected['Sectorsetting']['sectorname']; 
        }
        //pr($sector_list);
        //echo $sector_list.'sector';
        
        foreach($sector_list as $sector)
        {
        
            $resultsql = "SELECT id FROM symbols WHERE business_segment = '$sector'";
            $company[]=$this->Symbol->query($resultsql);
            
         }
        $company_list =array();
         
         for($i=0;$i<count($company);$i++)
         {
             for($j=0;$j<count($company[$i]);$j++)
             {
                 $company_list[] = $company[$i][$j]['symbols']['id']; 
                 
                 
             }
         }
        
        $result = array();   
        foreach($company_list as $company)
        {
        
            $resultsql = "SELECT * FROM symbols WHERE id = '$company'";
            $result[]=$this->Symbol->query($resultsql);
            
        }
         
        
        //echo $result.'<br>' ; 
         
         

        if (count ( $result )) {
            
            $arrall = array ();
            
            $lastTradePriceList = $this->Symbol->find ( 'list', array ('fields' => array ('id', 'lasttradeprice' ) ) );

            $ycloseList = $this->Symbol->find ( 'list', array ('fields' => array ('id', 'yclose' ) ) );

            $sql = "SELECT * FROM outputs USE INDEX (symbol) ORDER BY id DESC LIMIT 0, 400";
            //*$sql = "SELECT *,UNIX_TIMESTAMP(str_to_date(date, '%d-%c-%Y')) FROM stocknet_plugin.eod USE INDEX (symbol) ORDER BY id DESC LIMIT 0, 244";
            /*--- FIRST USE OF MEMCACHE :: START HERE ---*/
            if (class_exists ( 'Memcache' )) {                 
                $memcache = new Memcache ( );

                $memcache->connect ( 'localhost', 11211 ) or die ( "Could not connect" );

                $memKey2 = md5 ( 'org_resoures_getpricelist_1' );

                if (! $memcache->get ( $memKey2 )) {
                    //echo '--not set--';
                    $resultArr = $this->Symbol->query ( $sql );
                    //*$resultArr = mysql_query ( $sql, $AMILink );
                    $memcache->set ( $memKey2, $resultArr, MEMCACHE_COMPRESSED, 60 );

                }

                //echo 'set';
                $resultArr = $memcache->get ( $memKey2 );

            } else {

                //*$resultArr = mysql_query ( $sql, $AMILink );
                $resultArr = $this->Symbol->query ( $sql );

            }

            /*--- FIRST USE OF MEMCACHE :: END HERE ---*/
            //*$resultArr = mysql_query ( $sql, $AMILink );
            $resultArr = $this->Symbol->query ( $sql );
            
            //pr($resultArr); die;

            /*$resultinfo = array();
            while($eachrow = mysql_fetch_row($resultArr))
              {
                  $resultinfo[] = $eachrow;
                  
              } for */
            
           
            $lastday = $resultArr [0] ['outputs'] ['date'];
            //pr($lastday);
            $lastdaystamp = strtotime ( $lastday );
            //pr($lastdaystamp); die;
            
            

            $resultArr = array_reverse ( $resultArr );
             //pr($resultArr);die;
            
            
            //pr($lastdaystamp);
            $sortedResult = array ();

            foreach ( $resultArr as $res ) {
                
                //pr($res [1]);
                //pr($res[13]);
                
                
                if ($res ['outputs'] ['symbol'] > 1 && $res ['outputs'] ['tradevalues'] != 0 && $res ['outputs'] ['daystamp'] >= $lastdaystamp) {
                    $res ['outputs'] ['lastprice'] = $lastTradePriceList [$res ['outputs'] ['symbol']];
                    $res ['outputs'] ['yclose'] = $ycloseList [$res ['outputs'] ['symbol']];

                    $companyFinPerf = "SELECT * FROM `company_financial_performance` WHERE `symbol_id`='".$res ['outputs'] ['symbol']."' and asset_val_per_share!=''  ORDER BY  fin_year DESC LIMIT 1";
                    $companyFinPerfResult = $this->Symbol->query($companyFinPerf);
                   
                    $res ['outputs'] ['asset_val_per_share'] = $companyFinPerfResult[0]['company_financial_performance']['asset_val_per_share'];
                    $sortedResult [$res ['outputs'] ['symbol']] = $res;



                }
                

            } 


            
            //echo count($sortedResult); die;
            $coreDataCount = 1;

            //echo $sortedResult.'res'; 
            
            //pr($result); die;
           
            foreach ( $result as $row ) {
                
            
                $qeps = 0;

                $symbol = $row [0]['symbols'] ['id'];

                $factor = 1;

                if ($row [0]['symbols'] ['q1']) {

                    $qeps = $row [0]['symbols'] ['q1'];

                    $factor = 4;

                }

                if ($row [0]['symbols'] ['q2']) {

                    $qeps = $row [0]['symbols'] ['q2'];

                    $factor = 2;

                }

                if ($row [0]['symbols'] ['q3']) {

                    $qeps = $row [0]['symbols'] ['q3'];

                    $factor = 4 / 3;

                }

                if ($row [0]['symbols'] ['q4']) {

                    $qeps = $row [0]['symbols'] ['q4'];

                    $factor = 1;

                }

                $annualizedEPS = $qeps * $factor;



                //if(isset($sortedResult[$symbol]['outputs']['lastprice']) && $annualizedEPS !=0)
                if (isset ( $sortedResult [$symbol] ['outputs'] ['lastprice'] )) {

                    $coredata ['id'] = $row [0]['symbols'] ['id'];

                    $coredata ['id'] = $coreDataCount ++;

                    $coredata ['code'] = trim ( $row [0]['symbols'] ['dse_code'] );

                    if($coredata ['code']=='DELTALIFE'){
                        $coredata ['sector'] = 'Life Insurance';
                    }else if($coredata ['code']=='FAREASTLIF'){
                        $coredata ['sector'] = 'Life Insurance';
                    }else if($coredata ['code']=='MEGHNALIFE'){
                        $coredata ['sector'] = 'Life Insurance';
                    }else if($coredata ['code']=='NATLIFEINS'){
                        $coredata ['sector'] = 'Life Insurance';
                    }else if($coredata ['code']=='POPULARLIF'){
                        $coredata ['sector'] = 'Life Insurance';
                    }else if($coredata ['code']=='PRAGATILIF'){
                        $coredata ['sector'] = 'Life Insurance';
                    }else if($coredata ['code']=='PRIMELIFE'){
                        $coredata ['sector'] = 'Life Insurance';
                    }else if($coredata ['code']=='PROGRESLIF'){
                        $coredata ['sector'] = 'Life Insurance';
                    }else if($coredata ['code']=='RUPALILIFE'){
                        $coredata ['sector'] = 'Life Insurance';
                    }else if($coredata ['code']=='SANDHANINS'){
                        $coredata ['sector'] = 'Life Insurance';
                    }else if($coredata ['code']=='SUNLIFEINS'){
                        $coredata ['sector'] = 'Life Insurance';
                    }else{
                        $coredata ['sector'] = trim ( $row [0]['symbols'] ['business_segment'] );
                    }


                    $coredata ['category'] = $row [0]['symbols'] ['category'];

                    $coredata ['market_lot'] = $row [0]['symbols'] ['market_lot'];

                    $coredata ['face_value'] = $row [0]['symbols'] ['face_value'];

                    $coredata ['nav'] = $sortedResult [$symbol] ['outputs'] ['asset_val_per_share'];

                    $coredata ['lastprice'] = round ( $sortedResult [$symbol] ['outputs'] ['lastprice'], 2 );

                    $coredata ['open'] = round ( $sortedResult [$symbol] ['outputs'] ['open'], 2 );

                    $coredata ['high'] = round ( $sortedResult [$symbol] ['outputs'] ['high'], 2 );

                    $coredata ['low'] = round ( $sortedResult [$symbol] ['outputs'] ['low'], 2 );

                    $coredata ['volume'] = $sortedResult [$symbol] ['outputs'] ['volume'] + 0;

                    $coredata ['value'] = round ( $sortedResult [$symbol] ['outputs'] ['tradevalues'], 2 );
                    
                    $coredata ['lastprice'] = round ( $sortedResult [$symbol] ['outputs'] ['lastprice'], 2 );

                    $coredata ['trade'] = $sortedResult [$symbol] ['outputs'] ['trade'];

                    $totalChangePer = (($sortedResult [$symbol] ['outputs'] ['lastprice'] - $sortedResult [$symbol] ['outputs'] ['yclose']) / $sortedResult [$symbol] ['outputs'] ['yclose']) * 100;
                    
                    $totalChangePer = round ( $totalChangePer, 2 );

                    $coredata ['pchange'] = $totalChangePer;



                    if ($annualizedEPS == 0)

                    $pe = 0;

                    else

                    $pe = $sortedResult [$symbol] ['outputs'] ['lastprice'] / $annualizedEPS;



                    $coredata ['pe'] = round ( $pe, 2 );

                  $arrall [] = $coredata;

                }

            }
            //echo count($coredata).'hello'; 

            $arr = $arrall;
            
            $jsonresult = $this->__JEncode ( $arr );
            //echo $jsonresult.'hello';

            echo '({"total":"' . count ( $result ) . '","results":' . $jsonresult . '})';

        } else {

            echo '({"total":"0", "results":""})';

        }
        
   }
   
   else
       { 
       $result = $this->Symbol->find ( 'all' );

        if (count ( $result )) {
            
            $arrall = array ();
            
            $lastTradePriceList = $this->Symbol->find ( 'list', array ('fields' => array ('id', 'lasttradeprice' ) ) );

            $ycloseList = $this->Symbol->find ( 'list', array ('fields' => array ('id', 'yclose' ) ) );

            $sql = "SELECT * FROM outputs USE INDEX (symbol) ORDER BY id DESC LIMIT 0, 244";
            //*$sql = "SELECT *,UNIX_TIMESTAMP(str_to_date(date, '%d-%c-%Y')) FROM stocknet_plugin.eod USE INDEX (symbol) ORDER BY id DESC LIMIT 0, 244";
            /*--- FIRST USE OF MEMCACHE :: START HERE ---*/
            if (class_exists ( 'Memcache' )) {                 
                $memcache = new Memcache ( );

                $memcache->connect ( 'localhost', 11211 ) or die ( "Could not connect" );

                $memKey2 = md5 ( 'org_resoures_getpricelist_1' );

                if (! $memcache->get ( $memKey2 )) {
                    //echo '--not set--';
                    $resultArr = $this->Symbol->query ( $sql );
                    //*$resultArr = mysql_query ( $sql, $AMILink );
                    $memcache->set ( $memKey2, $resultArr, MEMCACHE_COMPRESSED, 60 );

                }

                //echo 'set';
                $resultArr = $memcache->get ( $memKey2 );

            } else {

                //*$resultArr = mysql_query ( $sql, $AMILink );
                $resultArr = $this->Symbol->query ( $sql );

            }

            /*--- FIRST USE OF MEMCACHE :: END HERE ---*/
            //*$resultArr = mysql_query ( $sql, $AMILink );
            $resultArr = $this->Symbol->query ( $sql );
            
            //pr($resultArr); die;

            /*$resultinfo = array();
            while($eachrow = mysql_fetch_row($resultArr))
              {
                  $resultinfo[] = $eachrow;
                  
              } for */
            
           
            $lastday = $resultArr [0] ['outputs'] ['date'];
            //pr($lastday);
            $lastdaystamp = strtotime ( $lastday );
            //pr($lastdaystamp); die;
            
            

            $resultArr = array_reverse ( $resultArr );
             //pr($resultArr);die;
            
            //pr($lastdaystamp);
            $sortedResult = array ();

            foreach ( $resultArr as $res ) {
                
                //pr($res [1]);
                //pr($res[13]);
                
                
                if ($res ['outputs'] ['symbol'] > 1 && $res ['outputs'] ['tradevalues'] != 0 && $res ['outputs'] ['daystamp'] >= $lastdaystamp) {
                    $res ['outputs'] ['lastprice'] = $lastTradePriceList [$res ['outputs'] ['symbol']];
                    $res ['outputs'] ['yclose'] = $ycloseList [$res ['outputs'] ['symbol']];

                    $companyFinPerf = "SELECT * FROM `company_financial_performance` WHERE `symbol_id`='".$res ['outputs'] ['symbol']."' and asset_val_per_share!=''  ORDER BY  fin_year DESC LIMIT 1";
                    $companyFinPerfResult = $this->Symbol->query($companyFinPerf);
                   
                    $res ['outputs'] ['asset_val_per_share'] = $companyFinPerfResult[0]['company_financial_performance']['asset_val_per_share'];
                    $sortedResult [$res ['outputs'] ['symbol']] = $res;



                }
                

            } 



            //echo count($sortedResult); die;
            $coreDataCount = 1;

            //pr($sortedResult); die;
            
            //pr($result); die;

            foreach ( $result as $row ) {



                $qeps = 0;

                $symbol = $row ['Symbol'] ['id'];

                $factor = 1;

                if ($row ['Symbol'] ['q1']) {

                    $qeps = $row ['Symbol'] ['q1'];

                    $factor = 4;

                }

                if ($row ['Symbol'] ['q2']) {

                    $qeps = $row ['Symbol'] ['q2'];

                    $factor = 2;

                }

                if ($row ['Symbol'] ['q3']) {

                    $qeps = $row ['Symbol'] ['q3'];

                    $factor = 4 / 3;

                }

                if ($row ['Symbol'] ['q4']) {

                    $qeps = $row ['Symbol'] ['q4'];

                    $factor = 1;

                }

                $annualizedEPS = $qeps * $factor;



                //if(isset($sortedResult[$symbol]['outputs']['lastprice']) && $annualizedEPS !=0)
                if (isset ( $sortedResult [$symbol] ['outputs'] ['lastprice'] )) {

                    $coredata ['id'] = $row ['Symbol'] ['id'];

                    $coredata ['id'] = $coreDataCount ++;

                    $coredata ['code'] = trim ( $row ['Symbol'] ['dse_code'] );

                    if($coredata ['code']=='DELTALIFE'){
                        $coredata ['sector'] = 'Life Insurance';
                    }else if($coredata ['code']=='FAREASTLIF'){
                        $coredata ['sector'] = 'Life Insurance';
                    }else if($coredata ['code']=='MEGHNALIFE'){
                        $coredata ['sector'] = 'Life Insurance';
                    }else if($coredata ['code']=='NATLIFEINS'){
                        $coredata ['sector'] = 'Life Insurance';
                    }else if($coredata ['code']=='POPULARLIF'){
                        $coredata ['sector'] = 'Life Insurance';
                    }else if($coredata ['code']=='PRAGATILIF'){
                        $coredata ['sector'] = 'Life Insurance';
                    }else if($coredata ['code']=='PRIMELIFE'){
                        $coredata ['sector'] = 'Life Insurance';
                    }else if($coredata ['code']=='PROGRESLIF'){
                        $coredata ['sector'] = 'Life Insurance';
                    }else if($coredata ['code']=='RUPALILIFE'){
                        $coredata ['sector'] = 'Life Insurance';
                    }else if($coredata ['code']=='SANDHANINS'){
                        $coredata ['sector'] = 'Life Insurance';
                    }else if($coredata ['code']=='SUNLIFEINS'){
                        $coredata ['sector'] = 'Life Insurance';
                    }else{
                        $coredata ['sector'] = trim ( $row ['Symbol'] ['business_segment'] );
                    }


                    $coredata ['category'] = $row ['Symbol'] ['category'];

                    $coredata ['market_lot'] = $row ['Symbol'] ['market_lot'];

                    $coredata ['face_value'] = $row ['Symbol'] ['face_value'];

                    $coredata ['nav'] = $sortedResult [$symbol] ['outputs'] ['asset_val_per_share'];

                    $coredata ['lastprice'] = round ( $sortedResult [$symbol] ['outputs'] ['lastprice'], 2 );

                    $coredata ['open'] = round ( $sortedResult [$symbol] ['outputs'] ['open'], 2 );

                    $coredata ['high'] = round ( $sortedResult [$symbol] ['outputs'] ['high'], 2 );

                    $coredata ['low'] = round ( $sortedResult [$symbol] ['outputs'] ['low'], 2 );

                    $coredata ['volume'] = $sortedResult [$symbol] ['outputs'] ['volume'] + 0;

                    $coredata ['value'] = round ( $sortedResult [$symbol] ['outputs'] ['tradevalues'], 2 );
                    
                    $coredata ['lastprice'] = round ( $sortedResult [$symbol] ['outputs'] ['lastprice'], 2 );

                    $coredata ['trade'] = $sortedResult [$symbol] ['outputs'] ['trade'];

                    $totalChangePer = (($sortedResult [$symbol] ['outputs'] ['lastprice'] - $sortedResult [$symbol] ['outputs'] ['yclose']) / $sortedResult [$symbol] ['outputs'] ['yclose']) * 100;
                    
                    $totalChangePer = round ( $totalChangePer, 2 );

                    $coredata ['pchange'] = $totalChangePer;



                    if ($annualizedEPS == 0)

                    $pe = 0;

                    else

                    $pe = $sortedResult [$symbol] ['outputs'] ['lastprice'] / $annualizedEPS;



                    $coredata ['pe'] = round ( $pe, 2 );

                    $arrall [] = $coredata;

                }

            }

            $arr = $arrall;

            $jsonresult = $this->__JEncode ( $arr );

            echo '({"total":"' . count ( $result ) . '","results":' . $jsonresult . '})';

        } else {

            echo '({"total":"0", "results":""})';

        }
       }

        die ();

    }
     
function dsenews()
    {		
		 Configure::write("debug",0);
        $this->pageTitle = 'Stock Bangladesh :: News';
        $this->set('webroot', WWW_ROOT . 'files' . DS);
        $this->set('ds', DS);
        
        $condition = ' News.is_active=1 ';    
        if($type != '')    
        
            $condition = 'News.news_type='.$type.' AND News.is_active=1';
            
            $newsCategoryList = $this->NewsType->find('list', array('fields'=> array('NewsType.id', 'NewsType.name')));
            $this->set('news_cat_list', $newsCategoryList);
           // pr($newsCategoryList); die;
            
            $this->paginate = array('limit' => 4, 'order' => 'News.news_type ASC, News.id DESC ');
            
            $data = $this->paginate('News', $condition, null, 'news_type');
            $this->set('news_list', $data);
           // $this->set('news_type', $type);
           // $this->set('news_count', isset($this->params['paging']['News']['count']) ? $this->params['paging']['News']['count'] : 0 );        
        $this->layout = 'blank';
        
    }
  function latestnews($type = '')
    {
		$this->pageTitle = 'Stock Bangladesh :: News';
        $this->set('webroot', WWW_ROOT . 'files' . DS);
        $this->set('ds', DS);
       // Configure::write("debug",0);
        $condition = ' News.is_active=1';// AND News.code LIKE %$type%
		    
        /*if($type != '')    
        	$condition = 'News.news_type='.$type.' AND News.is_active=1';*/
        $newsCategoryList = $this->NewsType->find('list', array('fields'=> array('NewsType.id', 'NewsType.name')));
        $this->set('news_cat_list', $newsCategoryList);
         //  pr($newsCategoryList); die;
        if($type!='')$condition1 = array("News.is_active"=>1,"News.code"=>$type);
        
		$this->paginate = array('limit' => 10, 'order' => 'News.news_type ASC, News.id DESC ');
        $data = $this->paginate('News', $condition1, null, 'news_type');
        
		$this->layout = 'blank';
        if(isset($this->params['requested']))
        {
            $news['news_list']= $data;
            $news['news_type']= $type;
            $news['news_count']= isset($this->params['paging']['News']['count']) ? $this->params['paging']['News']['count'] : 0 ;        
        
            return $news;
        }
        else{
            $this->set('news_list', $data);
            $this->set('news_type', $type);
            $this->set('news_count', isset($this->params['paging']['News']['count']) ? $this->params['paging']['News']['count'] : 0 );        
        
        }
        
    }
    
    function closeprice($sector = '') {
        //Configure::write("debug",3);
        $this->layout = 'default-one';
        $this->pageTitle = 'Stock Bangladesh :: Download Data';



        if (! $this->Session->check ( 'Auth.User' )) {

            $this->Session->setFlash ( 'Please login again.' );

            $this->redirect ( array ('controller' => 'users', 'action' => 'login' ) );

        }

        $userId = $this->Session->read ( 'Auth.User.id' );
        
        //$sectorsql = "SELECT DISTINCT business_segment FROM symbols WHERE inactive='No' AND business_segment!=''";
        //$sectors = $this->Symbol->query ( $sectorsql );
        //pr($sectors);
        $this->set('sector',$sector);
        
        if (!empty($this->data)) {
            
            
            $sector_name = $this->data['sector'];
            $sector = $this->data['sector'];
            $today = $this->data['date'];
            
            $newformat = explode('-',$today);
            $date = $newformat[2].'-'.$newformat[1].'-'.$newformat[0];
            
            $symbolInfo = $this->Symbol->find ( 'all', array ('conditions' => array ('inactive= \'No\' AND business_segment='.'\''.$sector.'\''.''),'fields'=> array('id', 'dse_code','lasttradeprice') ) );
            
                        
                if($sector == 'Food & Allied')
                {
                  $sector_name ='Food';  
                }
                if($sector == 'Fuel & Power')
                {
                  $sector_name ='Fuel';  
                }
                
                if($sector == 'Paper & Printing')
                {
                  $sector_name ='Paper';  
                }
                
                if($sector == 'Pharmaceuticals & Chemicals')
                {
                  $sector_name ='Pharmaceuticals';  
                }
                if($sector == 'Financial Institutions')
                {
                  $sector_name ='Financial';  
                }
                if($sector == 'Mutual Funds')
                {
                  $sector_name ='Mutual';  
                }
                if($sector == 'IT Sector')
                {
                  $sector_name ='IT';  
                }
                if($sector == 'Tannery Industries')
                {
                  $sector_name ='Tannery';  
                }
                if($sector == 'Ceramics Sector')
                {
                  $sector_name ='Ceramics';  
                }
                
                //pr($sector_name); die;
                
                
                $path = $sector_name.'_'.$date.'.csv';
                $filePath = WWW_ROOT . 'csv' . DS . $path;

                $_fp = @fopen ( $filePath, 'w' );

                //$_csv_data = "Date" . ',' . "Company" .','. "Last trade price" .','. "Open Price" . ',' . "Close Price" . "\n";
                $_csv_data = "Date" . ',' . "Company" .','. "Open" . ','. "High" . ','. "Low" . ',' . "Close" .',' . "Volume" . "\n";
                @fwrite ( $_fp, $_csv_data );
                
                //foreach($datearray as $id=>$dates)
//                {
                    foreach($symbolInfo as $symbol)
                    {
                        //pr($symbol['Symbol']['id']);
                        $csvSQL = "SELECT date,name,open,high,low,close,volume,symbol FROM outputs WHERE symbol =".$symbol['Symbol']['id']." AND date = '$date'  ORDER BY id ASC"; 
                        $dataList = $this->Symbol->query ( $csvSQL );
                            if (! empty ( $dataList )) {
                             foreach ( $dataList as $dATA ) 
                                {
                                    $_csv_data =  $date . ',' . ucfirst ( $symbol['Symbol']['dse_code'] ) . ','.  ucfirst ( $dATA ['outputs'] ['open'] ) . ','. ucfirst ( $dATA ['outputs'] ['high'] ) . ',' . ucfirst ( $dATA ['outputs'] ['low'] ) . ','. ucfirst ( $dATA ['outputs'] ['close'] ) . ',' .ucfirst ( $dATA ['outputs'] ['volume'] ) . ',' . "\n";
                                    @fwrite ( $_fp, $_csv_data );
                                }

                            }
                    }
                $fileName = $path;
                header ( "Content-Disposition: attachment; filename=" . $fileName );
                readfile ( $filePath );

                exit ();

            
           
        }

    }
    
function predict_eps()
   {
       $this->layout = 'default-one';
       //Configure::write("debug",3);
       $Host = "localhost";  
       $DB = "stockorg_stock";
       $User = "stockorg_stock";
       $Password = "SBd2007S!";
       $Link = mysql_connect ( $Host, $User, $Password ) or die(mysql_error());
           if (! $Link) {
                $this->Session->setFlash ( 'Could not connect: ' . mysql_error () . ')' );
                $this->redirect ( array ('controller' => 'resources', 'action' => 'predict_eps' ) );
           }
            
           $db_selected = mysql_select_db ( $DB, $Link );
            
           if (! $db_selected) {
                $this->Session->setFlash ( 'Can\'t select database : ' . mysql_error () . ')' );
                $this->redirect ( array ('controller' => 'resources', 'action' => 'predict_eps' ) );
           }
           
           $company_nameSql = "SELECT DISTINCT organization_name FROM bank_income_statement WHERE sector = 'Bank' order by organization_name ASC";
           $company_name = mysql_query ( $company_nameSql, $Link );
           $company_array = array();
           $count=1;
           while($row = mysql_fetch_assoc ( $company_name ))
           {
               $company_array[$count] = $row['organization_name'];
               $count++;
           }
           $this->set('company_name',$company_array);
           
           $quarter = array('1st' => '1st', '2nd' => '2nd', '3rd' => '3rd');
           $this->set('quarter',$quarter);
           //pr($company_array);
        
        if(!empty($this->data))
        {
            //pr($_POST['company']); die;
            //if($_POST['company']=='')
            $profit_this_year = $this->data['Resource']['profit'];
            $no_of_share = $this->data['Resource']['shares'];//from symbol table 'no_of_securities'
            $Q_net_profit = $this->data['Resource']['qprofit'];
            $company = $_POST['company'];
            $known_quarter = $_POST['quarter'];
            $quarter_eps = $this->data['Resource']['qeps'];
            $this->set('key',$company);
            $this->set('qua',$known_quarter);
            
            $bank_statementSql = "SELECT year,net_operating_income,total_provision,provision_for_taxation,EPS FROM bank_income_statement WHERE organization_name = '$company' order by year DESC LIMIT 3";
            $bank_info = mysql_query ( $bank_statementSql, $Link );
            $count=1;
            while($row = mysql_fetch_assoc ( $bank_info ))
             {
                 $prevyears[$count] = $row['year'];
                 $years = $row['year'];
                 $profit[$years] = $row['net_operating_income'];
                 $provision[$years] = $row['total_provision'];
                 $taxation[$years] = $row['provision_for_taxation'];
                 $EPS[$years] = $row['EPS'];
                 
                 $per_provision[$years] = ($provision[$years]/$profit[$years])*100;
                 $per_taxation[$years] = ($taxation[$years]/$profit[$years])*100;
                 $net_profit[$years] = $profit[$years]-($provision[$years]+$taxation[$years]);
                 
                 $count++;
             }
              //pr($per_provision);
             //pr($per_taxation);
            // pr($net_profit);
           //  pr($prevyears);      10000000000
             
            // pr($prevyears[1]);
             $this->set('year',$prevyears);
             $this->set('prevEPS',$EPS);
             $this->set('quEPS',$quarter_eps);
             $total_provision_percentage = 0;
             $total_taxation_percentage = 0;
             
             for($i=1;$i<=count($prevyears);$i++)
             {
                 $total_provision_percentage = $total_provision_percentage + $per_provision[$prevyears[$i]];
                 $total_taxation_percentage = $total_taxation_percentage + $per_taxation[$prevyears[$i]];
             }
             $projected_provision = (($total_provision_percentage/3)*$profit_this_year)/100;
             $projected_taxation = (($total_taxation_percentage/3)*$profit_this_year)/100;
             
             $projected_net_profit = $profit_this_year - ($projected_provision + $projected_taxation);
             $projected_EPS = $projected_net_profit/$no_of_share; ///////////////our projected EPS
            
             ///////////calculating the EPS From DSE data///////
             $calculated_month_profit = ($projected_net_profit/12)*3;
             if($known_quarter=='1st')
             {
                 $calculated_month_profit = ($projected_net_profit/12)*9;
             }
             if($known_quarter=='2nd')
             {
                 $calculated_month_profit = ($projected_net_profit/12)*6;
             }
             if($known_quarter=='3rd')
             {
                 $calculated_month_profit = ($projected_net_profit/12)*3;
             }
             
             //$three_month_profit =  ($projected_net_profit/12)*3;/////need some option
             $expected_net_profit = $Q_net_profit + $calculated_month_profit;
             $expected_EPS =   $expected_net_profit/$no_of_share;
             $deviated_EPS_plus = ($expected_EPS*105)/100;
             $deviated_EPS_minus = ($expected_EPS*95)/100;
            
            $this->set('expected_EPS',$expected_EPS);
            $this->set('dev_EPS_plus',$expected_EPS);
            $this->set('dev_EPS_minus',$expected_EPS);
            
        }
       
   }
   
   
   
   
   ////////////////////for report test////////////////////////////////////////
   
   function index_review()
   {
       //Configure::write('debug',3);
       if (! $this->Session->check ( 'Auth.User' )) {
            $this->Session->setFlash ( 'You are not authorized to access that location.' );
            $this->redirect ( array ('controller' => 'users', 'action' => 'login' ) );
        }
       $this->layout = 'default-one';
       /*$userGroup = $this->Session->read('Auth.User.group_id');
       $this->set('group',$userGroup);*/
       //$timerange = array(1=>'1 day',7=>'1 week',15=>'15 Days',30=>'1 month',90=>'3 month',180=>'6 month',365=>'1 year');
       $timerange = array(1=>'1 day',7=>'1 week',15=>'15 Days',30=>'1 month',90=>'3 month',365=>'1 year');
       $fields = array('open'=>'open','close'=>'close','high'=>'high','low'=>'low','volume'=>'volume');
       $market = array('dse'=>'DSE','cse'=>'CSE');
       $this->set('market',$market);
       $this->set('fields',$fields);
       $this->set('timerange',$timerange);
       $limit = 1;
       $date_range = 0;
       
       if(!empty($this->data))
       {
           $limit = $this->data['Resource']['duration'];
           $market = $this->data['Resource']['market'];
           $from_date = $this->data['Resource']['start_date'];
           $to_date = $this->data['Resource']['end_date'];
           if(empty($from_date))
           {
               
               if($limit==1)
               {
                  $this->set('limit',$limit);
                  $this->set('daterange',$date_range);
                  $indexsql =" SELECT date,open,high,low,close,ycp,volume,trade,tradevalues FROM `outputs` WHERE `symbol` =5 ORDER BY daystamp DESC LIMIT $limit" ;
                  $indexdata = $this->Symbol->query($indexsql);
               }
               else
               {
                  $this->set('limit',$limit);
                  $this->set('daterange',$date_range);
                  $indexsql =" SELECT date,open,high,low,close,volume,trade,tradevalues FROM outputs_week as outputs WHERE `symbol` =5 ORDER BY daystamp DESC";
                  $indexdata = $this->Symbol->query($indexsql);
                  $_SESSION['info'] = $indexdata;
               }
               
               
              // pr($indexdata);
               //die;
               $this->set('indexdata',$indexdata);
           
           }
           else
           {
               $date_range = 1; 
               if($limit==1)
               {
                  $this->set('limit',$limit);
                  $this->set('daterange',$date_range);
                  $_SESSION['limit'] = $limit;
                  $start_stamp = strtotime($from_date) ;
                  if(!empty($to_date))
                  {
                    $end_stamp   = strtotime($to_date)+12*3600;
                  }
                  else
                    $end_stamp   = time()+12*3600;
                  $indexsql    =" SELECT date,open,high,low,close,ycp,volume,trade,tradevalues FROM `outputs` WHERE `symbol` =5 AND daystamp >= $start_stamp and daystamp <=$end_stamp ORDER BY daystamp DESC" ;
                  $indexdata   = $this->Symbol->query($indexsql);
                  $this->set('indexdata',$indexdata);
                  $_SESSION['info'] = $indexdata;
                  //pr($indexdata);
                  $total_row = -1;
                  $this->set('totalrow',$total_row);
                  //pr(count($indexdata));
                  
               }
               else
               {
                  $this->set('limit',$limit);
                  $this->set('daterange',$date_range);
                  $start_stamp = strtotime($from_date)-72*3600;
                  if(!empty($to_date))
                  {
                    $end_stamp   = strtotime($to_date);
                  }
                  else
                    $end_stamp   = time();
                  $indexsql    =" SELECT date,open,high,low,close,volume,trade,tradevalues FROM outputs_week as outputs WHERE `symbol` =5 AND daystamp BETWEEN $start_stamp and $end_stamp ORDER BY daystamp DESC" ;
                  //pr($indexsql);
                  $indexdata   = $this->Symbol->query($indexsql);
                  $this->set('indexdata',$indexdata);
                  $_SESSION['info']  = $indexdata;
                  $_SESSION['range'] = $date_range;
                  $_SESSION['limit'] = $limit;
                  
                  
                  //pr($indexdata);
                  if($limit == 7)
                  {
                    $total_row = (int)(count($indexdata)/2);
                  }
                  else if($limit == 15)
                  {
                    $total_row = (int)(count($indexdata)/4);
                  }
                  else if($limit == 30)
                  {
                    $total_row = (int)(count($indexdata)/8);
                  }
                  else if($limit == 90)
                  {
                    $total_row = (int)(count($indexdata)/24);
                  }
                  else if($limit == 365)
                  {
                    $total_row = (int)(count($indexdata)/104);
                  }
                  $this->set('totalrow',$total_row);
                  $_SESSION['row']   =$total_row;
                  
                  
               }
               
               
           }
       }
       else
       {
           $this->set('limit',$limit);
           $indexsql = "SELECT date,open,high,low,close,ycp,volume,trade,tradevalues FROM `outputs` WHERE `symbol` =5 ORDER BY daystamp DESC LIMIT 1" ;        
           $indexdata = $this->Symbol->query($indexsql);
           //pr($indexdata);
           $this->set('indexdata',$indexdata);
       }
       
       
        /*$present_date = date('Y-m-d',strtotime('-1 week'));
        $this_sunday = date('Y-m-d', strtotime($present_date.'next sunday'));
        $this_sundaystamp = strtotime($this_sunday);
        $this_thursday = date('Y-m-d', strtotime($present_date.'next thursday'));
        $this_thursdaystamp = strtotime($this_thursday)+24*3600;
        $this->set('this_sunday',$this_sunday);
        $this->set('this_thursday',$this_thursday);*/
       
       
   }
   
   function mcap_review()
   {
       //Configure::write('debug',3);
       $this->layout = 'default-one';
       
       //$timerange = array(1=>'1 day',7=>'1 week',15=>'15 Days',30=>'1 month',90=>'3 month',180=>'6 month',365=>'1 year');
       $timerange = array(1=>'1 day',7=>'1 week',15=>'15 Days',30=>'1 month',90=>'3 month',365=>'1 year');
       $fields = array('open'=>'open','close'=>'close','high'=>'high','low'=>'low','volume'=>'volume');
       $market = array('dse'=>'DSE','cse'=>'CSE');
       $this->set('market',$market);
       $this->set('fields',$fields);
       $this->set('timerange',$timerange);
       $limit = 1;
       $date_range = 0;
       
       if(!empty($this->data))
       {
           $limit = $this->data['Resource']['duration'];
           $market = $this->data['Resource']['market'];
           $from_date = $this->data['Resource']['start_date'];
           $to_date = $this->data['Resource']['end_date'];
           if(empty($from_date))
           {
               if($limit==1)
               {
                  $this->set('limit',$limit);
                  $this->set('daterange',$date_range);
                  $indexsql =" SELECT id,date,dgen,cap_total FROM `market_summeries` WHERE cap_total IS NOT NULL ORDER BY id DESC LIMIT $limit" ;
                  $indexdata = $this->Symbol->query($indexsql);
                  $this->set('capdata',$indexdata);
               }
           }
           else
           {
              
                $this->set('limit',$limit);
                $start_stamp = strtotime($from_date) ;
                if(!empty($to_date))
                 $end_stamp   = strtotime($to_date);
                else
                 $end_stamp   = time();
                   
                $indexsql =" SELECT id,date,dgen,cap_total FROM `market_summeries` WHERE cap_total IS NOT NULL AND UNIX_TIMESTAMP(date) >= $start_stamp and UNIX_TIMESTAMP(date) <=$end_stamp ORDER BY id DESC" ;
                $indexdata = $this->Symbol->query($indexsql);
                //pr($indexdata);
                $this->set('capdata',$indexdata);
              
           }
       }
       
       
       else
       {
          $this->set('limit',$limit);
          $this->set('daterange',$date_range);
          $indexsql =" SELECT date,dgen,cap_total FROM `market_summeries` WHERE cap_total IS NOT NULL ORDER BY id DESC LIMIT 1" ;
          $indexdata = $this->Symbol->query($indexsql);
          $this->set('capdata',$indexdata);
           
       }
   }
   
   function index_chart()
    {
        //Configure::write('debug',3);
        if (! $this->Session->check ( 'Auth.User' )) {
            $this->Session->setFlash ( 'You are not authorized to access that location.' );
            $this->redirect ( array ('controller' => 'users', 'action' => 'login' ) );
        }
        require_once (WWW_ROOT . DS . 'chart' . DS . 'phpchartdir.php');
        require_once (WWW_ROOT . DS . 'chart' . DS . 'Image_Toolbox.class.php');
        
        
       $indexdata = $_SESSION['info'];
       $daterange = $_SESSION['range'];
       $limit = $_SESSION['limit'];
       $totalrow = $_SESSION['row'];
       //pr($indexdata);
       
       $date = array();
       $index_changeArr = array();
       $volumearr = array();
       $count = 0;
       $weekcount = 0;
       $count = 0;
       $indexcount = 0; 
          foreach($indexdata as $data) {
             if($limit ==1)
             {
                //pr($data);
                $change = $indexdata[$indexcount]['outputs']['close'] - $indexdata[$indexcount+1]['outputs']['close'];
                $changeper   = ($change/$indexdata[$indexcount+1]['outputs']['close'])*100;
                //pr($changeper);
                $indexcount++;
                
                if($changeper!=0)
                {
                    $count++;
                    $date[][$count] =  $data['outputs']['date'];
                    $index_changeArr[][$count] =  $changeper;
                    $volumearr[][$count] = $data['outputs']['volume']/1000000;
                }
               
             }
             else
             {
                 if($daterange==0)
                 {
                    $weekly_norange = 1; 
                    if($limit==7)
                    {
                        $st = 1;
                        $en   = 0;
                        $pre  = 2;
                    }
                    else if($limit==15)
                    {
                        $st = 3;
                        $en   = 0;
                        $pre  = 4;
                    }
                    else if($limit==30)
                    {
                        $st = 7;
                        $en   = 0;
                        $pre  = 8;
                    }
                    else if($limit==90)
                    {
                        $st = 23;
                        $en = 0;
                        $pre  = 24;
                    }
                    else if($limit==365)
                    {
                        $st = 103;
                        $en   = 0;
                        $pre  = 104;
                    }
                    
                    
                    $change = $indexdata[$en]['outputs']['close']-$indexdata[$pre]['outputs']['close'];
                    $changeper = ($change/ $indexdata[$pre]['outputs']['close'])*100;
                    if($changeper!=0)
                    {
                        $index_changeArr[][$weekcount] =  $changeper;
                        $date[][$weekcount] = $indexdata[$en]['outputs']['date'];
                        $volume = $indexdata[$en]['outputs']['volume']+$indexdata[$st]['outputs']['volume'];
                        $volumearr[][$weekcount] = $volume/1000000;
                    }
                    
                 }
                 else
                 { 
                    $weekcount++;
                    if($limit==7)
                    {
                        $start = $count+1;
                        $end = $count;
                        $prev = $count+2;
                    }
                    else if($limit==15)
                    {
                        $start = $count+3;
                        $end = $count;
                        $prev = $count+4;
                    }
                    else if($limit==30)
                    {
                        $start = $count+7;
                        $end = $count;
                        $prev = $count+8;
                    }
                    else if($limit==90)
                    {
                        $start = $count+23;
                        $end = $count;
                        $prev = $count+24;
                    }
                    else if($limit==365)
                    {
                        $start = $count+103;
                        $end = $count;
                        $prev = $count+104;
                    }
                    
                    $change = $indexdata[$end]['outputs']['close']-$indexdata[$prev]['outputs']['close'];
                    $changeper = ($change/ $indexdata[$count+2]['outputs']['close'])*100;
                    if($changeper!=0)
                    {
                        $index_changeArr[][$weekcount] =  $changeper;
                        $date[][$weekcount] = $indexdata[$end]['outputs']['date'];
                        $volume = $indexdata[$end]['outputs']['volume']+$indexdata[$start]['outputs']['volume'];
                        $volumearr[][$weekcount] = $volume/1000000;
                        
                    }
                    
                    if($limit == 7)
                    {
                        $count=$count+2;
                    }
                    else if($limit == 15)
                    {
                        $count=$count+4;
                    }
                    else if($limit == 30)
                    {
                        $count=$count+8;
                    }
                    else if($limit == 90)
                    {
                        $count=$count+24;
                    }
                    else if($limit == 365)
                    {
                        $count=$count+104;
                    }
                     
                 }
                  if($weekly_norange==1)
             break;
             if($weekcount == $totalrow)
             break;
             }
             
            /* if($weekly_norange==1)
             break;
             if($weekcount == $totalrow)
             break;*/
          }
        
        //pr($date);
        //pr($index_changeArr);
       // pr($volumearr);
        arsort($date);
        arsort($index_changeArr);
        arsort($volumearr);
        
        $change = array();
        $dateArr = array();
        $vol = array();
        $arraycount = count($index_changeArr);
        //pr($arraycount);
        for($i=$arraycount;$i>0;$i--)
        {
            $change[] = $index_changeArr[$i-1][$i] ;
            $avgChange[] = array_sum($change)/count($change);
            $dateArr[] = $date[$i-1][$i];
            $vol[] = $volumearr[$i-1][$i];
        }
        //pr($change);
        //pr($dateArr);
        
        $c = new XYChart(600, 400);
        $c->setPlotArea(50, 25, 500, 250);
        //$c->SetDrawPlotAreaBackground(0xE0E0E0);

        $legendObj = $c->addLegend(55, 5, false, "", 8);
        $legendObj->setBackground(Transparent);
        
        $textBoxObj = $c->addText ( 100, 30, "www.stockbangladesh.org", "timesbi.ttf", 9, 0xc09090 );
        $textBoxObj->setAlignment ( TopLeft );

        # Add a title to the x axis
        $c->xAxis->setTitle("Date");
        
        # Add a title to the y axis
        $c->yAxis->setTitle("Index change %");
        $c->yAxis2->setTitle("Volume", "arial.ttf", 10);
        
        $c->xAxis->setLabelStyle ( "Arial", 8, TextColor, 90 );
        # Set the labels on the x axis.
        $c->xAxis->setLabels($dateArr);      
        
        /*$c->yAxis2->setTitle ( "VOLUME" );*/
        # set the axis, label and title colors for the primary y axis to green (0x008000) to
        # match the second data set
        
        //$c->yAxis2->setColors ( 0x008000);
        /*$c->yAxis2->setLabels($trdvolumeArr);
        $c->yAxis2->setLabelStep(5, 1);*/
        
        # Display 1 out of 2 labels on the x-axis. Show minor ticks for remaining labels.
        $c->xAxis->setLabelStep(1, 1);
        
        //$c->addLineLayer($sb71Arr, 0x80EB0000, "SB71 Index");
        $layer = $c->addLineLayer();
        $layer->setLineWidth(2);
        $layer->addDataSet($change, 0x80FF0000, "Index Change%");
        $layer->addDataSet($avgChange, 0x8000ff00, "Avg Change%");
        
        
        /*$layer = $c->addLineLayer($change, 0x80FF0000, "Index Change%");
        $layer->addLineLayer($avg, 0x8000ff00, "Avg PE");
        $ds = $layer->getDataSet(0);
        $ds->setDataSymbol(DiamondSymbol, 5);
        $layer->setLineWidth(2);*/
        
        //$c->addLineLayer($change, 0x8000EB00);
        //$colors = array(0x2D8F0A, 0xA52C2C, 0x2D8F0A, 0xA52C2C, 0x2D8F0A, 0xA52C2C,0x2D8F0A, 0xA52C2C,0x2D8F0A, 0xA52C2C,0x2D8F0A, 0xA52C2C,0x2D8F0A, 0xA52C2C,0x2D8F0A, 0xA52C2C,0x2D8F0A, 0xA52C2C,0x2D8F0A, 0xA52C2C,0x2D8F0A, 0xA52C2C,0x2D8F0A, 0xA52C2C,0x2D8F0A, 0xA52C2C, 0x2D8F0A, 0xA52C2C, 0x2D8F0A, 0xA52C2C,0x2D8F0A, 0xA52C2C,0x2D8F0A, 0xA52C2C,0x2D8F0A, 0xA52C2C,0x2D8F0A, 0xA52C2C,0x2D8F0A, 0xA52C2C,0x2D8F0A, 0xA52C2C,0x2D8F0A, 0xA52C2C,0x2D8F0A, 0xA52C2C,0x2D8F0A, 0xA52C2C);
        $barLayerObj = $c->addBarLayer3 ($vol);
        //$barLayerObj->setBorderColor(-1, 1);
        $barLayerObj->setBarShape (CircleShape );
        
        $barLayerObj->setUseYAxis2 ();
        # Output the chart
        /*header("Content-type: image/png");
        print($c->makeChart2(PNG));
        exit;*/
        $chartData=$c->makeChart2(PNG);
        
        $chartImagePath = WWW_ROOT . 'chart'. DS . 'index_chart.png';
        $f = fopen($chartImagePath, "wb");
        fwrite($f, $chartData);
        fclose($f);
        $img = new Image_Toolbox($chartImagePath);
        $width=$img->_img['main']['width'];
        $img->addImage($width,10,'#ffffff');
        $img->blendMask('left','bottom',IMAGE_TOOLBOX_BLEND_COPY, 0, 390);
        $img->output();
        
    }
   
   
   function report_dsechart($chartType = 'dsi')
    {   
        //Configure::write('debug',3);
        require_once(WWW_ROOT . DS . 'chart'. DS .'phpchartdir.php');
        require_once(WWW_ROOT . DS . 'chart'. DS .'Image_Toolbox.class.php');
        
        $marketSummery = $this->MarketSummery->find('all', array('order' => 'id DESC', 'limit'=>7));
        $dsitempArr    = array();
        $dsiLabel  = array();
        $ds20tempArr   = array();
        $ds20Label = array();
        $dgentempArr   = array();
        $turntempArr = array();
        $labelarray = array();
        foreach($marketSummery as $summery)
        {
           $datetime = strtotime($summery['MarketSummery']['date']);
           $dsiLabel    = date('M d',$datetime) ;
           $labelarray[] = $dsiLabel;
           $dsitempArr[$dsiLabel] = $summery['MarketSummery']['dsi'];
           $ds20tempArr[$dsiLabel] = $summery['MarketSummery']['ds20'];
           $dgentempArr[$dsiLabel] = $summery['MarketSummery']['dgen'];
           $turntempArr[$dsiLabel] = $summery['MarketSummery']['totaltrade'];
        }
        
        for($i=(count($labelarray))-1;$i>=0;$i--)
        {
            $labels[] = $labelarray[$i];
        }
        
        //pr($labels);
        foreach ($labels as $label)
        {
            $dsiArr[] = $dsitempArr[$label];
            $ds20Arr[] = $ds20tempArr[$label];
            $dgenArr[] = $dgentempArr[$label];
            $turnArr[] = $turntempArr[$label];
        }
        $setTitle = '';
        $setColour = '0x80ff0000';
        $setColourturn = '0x80000000';
        $setImage = '';
        if(!empty($marketSummery) && $chartType !='' ){
            switch($chartType){
                case 'dsi':  
                           $dArr = $dsiArr;             
                           $setTitle  = 'DSI';
                           $setImage  = 'dsi_report.png';
                           $setColour = 0x80ff0000;
                           break; 
                case 'ds20':       
                           $dArr = $ds20Arr;                    
                           $setTitle  = 'DS20';
                           $setImage  = 'dse20_report.png';
                           $setColour = 0x808080ff;
                           break; 
                case 'dgen':
                           $dArr = $dgenArr;
                           $setTitle  = 'Dse General';
                           $setImage  = 'dgen_report.png';
                           $setColour = 0x80ff0000;
                           break;                       
            }
        } 
        
        
        $c = new XYChart(220, 200);
        $c->setPlotArea(30, 25, 150, 100);

        $legendObj = $c->addLegend(20, 0, false, "", 6);
        $legendObj->setBackground(Transparent);

        $c->xAxis->setTitle("Time");
        
        $c->yAxis->setTitle($setTitle);
        $c->xAxis->setLabels($labels);
        //$c->yAxis2->setLabels($turnArr);
        
        $c->xAxis->setLabelStep(1, 1);

        $c->xAxis->setLabelStyle("Arial", 6, TextColor, 90);
        $c->yAxis->setLabelStyle("Arial", 6, TextColor, 0);
        $c->yAxis2->setLabelStyle("Arial", 6, TextColor, 0);
        
        $c->addLineLayer($dArr, $setColour, $setTitle." Index");
        
        /*$layer = $c->addLineLayer(0);
        $dataSetObj = $layer->addDataSet($turnArr, 0xcf4040, "turnover");
        $dataSetObj->setDataSymbol(SquareSymbol, 4);*/
        $barLayerObj = $c->addBarLayer3 ($turnArr);
        $barLayerObj->setBarShape (CircleShape );
        $barLayerObj->setUseYAxis2 ();
        
        
        $chartData = $c->makeChart2(PNG);
        $chartImagePath = WWW_ROOT . 'chart'. DS . $setImage;
        
        $f = fopen($chartImagePath, "wb");
        fwrite($f, $chartData);
        fclose($f);
        $img = new Image_Toolbox($chartImagePath);
        
        $width = $img->_img['main']['width'];

        $img->addImage($width, 50, '#CDCDCD');
        $img->blendMask('left', 'bottom', IMAGE_TOOLBOX_BLEND_COPY, 0, 190);
        $img->output(); 
        exit();
    }
    

   
   function mutual_fund_chart() ///for generating mutual fund information
   {
      //Configure::write('debug',3);
      if (! $this->Session->check ( 'Auth.User' )) {
            $this->Session->setFlash ( 'You are not authorized to access that location.' );
            $this->redirect ( array ('controller' => 'users', 'action' => 'login' ) );
        }
      $this->layout = 'default-compare';
      $total_information = array();
      $SymbolArr = $this->Symbol->find('all', array ('conditions' => array ('business_segment =\'Mutual Funds\' AND inactive=\'No\' AND otc_market=\'No\'' ), 'fields' => array ('id','dse_code','face_value','lasttradeprice','q1','q2','q3','q4','no_of_securities','category','year_end','dse_listing_year','outstanding_capital','market_capital'),'order'=>'dse_code ASC' ));
      
      $facevaluearray = array();
      foreach($SymbolArr as $symbol)
      {
          $symbol_name = $symbol['Symbol']['dse_code'];
          
          $face_value = $symbol['Symbol']['face_value'];
          if($face_value == '10.0')
          $face_value = 10;
          if($face_value == '100.0')
          $face_value = 100;
          $facevaluearray[$symbol_name] = $face_value;
      }
      //pr($facevaluearray);
      //die;
      $this->set('mutual_fund',$SymbolArr);
      
      /*pr($SymbolArr);
      die;*/
      
      $limit = 5;
      $datelist = $this->MarketSummery->find('all', array('fields' => array('date'),'order' => array('id DESC'),'limit'=>$limit));        
                    
      $startdate = date('d-m-Y',strtotime($datelist[$limit-1]['MarketSummery']['date']));//convert the date format to fetch data from output
      $enddate = date('d-m-Y',strtotime($datelist[0]['MarketSummery']['date']));
      $startstamp = strtotime($startdate)-6*60*60;
      $endstamp = strtotime($enddate)-6*60*60;
      
      $this->set('today',$enddate);
      $this->set('prevday',$startdate);
      $prevprice = $this->Output->find('all', array('conditions'=>array('date=\''.$startdate.'\' AND volume!=0')));////////////query for finding the close price of all the company of mutual fund
      
      $query_avg_price = $this->Output->find('all', array('conditions'=>array('daystamp>='.$startstamp.' AND volume!=0')));////////////query for finding the avg price of all the company of mutual fund
      $pricearray = array();
      $total_price = 0;
      $shareprice = array();
      /*pr($prevprice);
      die;*/
      
      foreach($SymbolArr as $symbol)  ////////////for finding the close price of all the company of mutual fund
      {   
          foreach($prevprice as $price)
          {
             if($price['Output']['symbol'] == $symbol['Symbol']['id'])
              {
                 $shareprice[$symbol['Symbol']['dse_code']] = $price['Output']['close'];
              }
          }
      }
      
      foreach($SymbolArr as $symbol)  ////////////for finding the avg price of all the company of mutual fund
      {
          $price_array = 0;
          $count = 0;
          foreach($query_avg_price as $avg_price)
          {
             
             if($avg_price['Output']['symbol'] == $symbol['Symbol']['id'])
              {
                 $count++; 
                 $price_array +=$avg_price['Output']['close'];
                 $avg_price_array[$symbol['Symbol']['dse_code']] = $price_array;
              }
          }
      }
      
      $year = date('Y');
      
      //pr($corporateSql);
      
      
      $total_traded_company = $count;
      
      $weeknoprev = '0'.date('W')-1;
      $weekncurr = date('W');
	  $navSqlCheckCurrentWeek = "SELECT * FROM mutual_import WHERE weekno = $weekncurr AND year = $year";
	  $nav_data_CheckCurrentWeek = $this->Symbol->query($navSqlCheckCurrentWeek);
	  //pr($nav_data_CheckCurrentWeek);
	  if(!count($nav_data_CheckCurrentWeek)) {
	  	$weeknoprev = '0'.date('W')-2;
        $weekncurr = date('W') -1;
	  }
	  
      $navSql = "SELECT * FROM mutual_import WHERE ( weekno = $weeknoprev OR weekno = $weekncurr ) AND year = $year";
      
      /*$weeknoprev = 52;
      $weekncurr = 1;
      $navSql = "SELECT * FROM mutual_import WHERE ( weekno = $weeknoprev and year = 2011 and label='Dec-4') OR (weekno = $weekncurr and year = $year)";*/
      
      $nav_data = $this->Symbol->query($navSql);
      $nav_infoprev = array();
      $nav_inforecent = array();
      
      foreach($nav_data as $navArr)
      {
          $week = $navArr['mutual_import']['weekno'];
          $code = $navArr['mutual_import']['code'];
          $mpb = $navArr['mutual_import']['mpb'];
          $cpb = $navArr['mutual_import']['cpb'];
          
          if($week == $weeknoprev)
          {
            $nav_infoprev[$code]['mpb'] = $mpb; 
            $nav_infoprev[$code]['cpb'] = $cpb; 
          }
          if($week == $weekncurr)
          {
            $nav_inforecent[$code]['mpb'] = $mpb; 
            $nav_inforecent[$code]['cpb'] = $cpb; 
          }
          
            
      }
      
      /*
      die;*/
      
      foreach($SymbolArr as $symbol)
      {
         if(!empty($shareprice[$symbol['Symbol']['dse_code']]))
           {
            $q1 = $symbol['Symbol']['q1'];
            $q2 = $symbol['Symbol']['q2'];
            $q3 = $symbol['Symbol']['q3'];
            $q4 = $symbol['Symbol']['q4'];
            $company_lastprice = $symbol ['Symbol'] ['lasttradeprice'];
            //pr($company_lastprice);
            if($q1)
            {
                $qeps   = $q1;
                $factor = 4;
                $querterNo = "Q1";
            }
            if($q2)
            {
                $qeps   = $q2;
                $factor = 2;
                $querterNo = "Q2";
            }
            if($q3)
            {
                $qeps   = $q3;
                $factor = 4/3;
                $querterNo = "Q3";
            }
            if($q4)
            {
                $qeps   = $q4;
                $factor = 1;
                $querterNo = "Annual";
            }
            
           $companyEPS = $qeps*$factor;  
           $pricearray[$symbol['Symbol']['dse_code']]['eps'] = $companyEPS ;
           
           $code = $symbol['Symbol']['dse_code'];
           $corporateSql = $this->Symbol->query("SELECT * FROM corporate_action WHERE date LIKE '%2011%' AND code ='$code'");
           
             if($facevaluearray[$symbol['Symbol']['dse_code']]==100)
              {
                  $symbol['Symbol']['lasttradeprice'] = $symbol['Symbol']['lasttradeprice']/10;
                  $shareprice[$symbol['Symbol']['dse_code']] = $shareprice[$symbol['Symbol']['dse_code']]/10;
                  $avg_price_array[$symbol['Symbol']['dse_code']] = $avg_price_array[$symbol['Symbol']['dse_code']]/10;
              }
              $pricearray[$symbol['Symbol']['dse_code']]['price_change_per'] = (($symbol['Symbol']['lasttradeprice']-$shareprice[$symbol['Symbol']['dse_code']])*100)/$shareprice[$symbol['Symbol']['dse_code']];
              $pricearray[$symbol['Symbol']['dse_code']]['price_change']     = $symbol['Symbol']['lasttradeprice']-$shareprice[$symbol['Symbol']['dse_code']];
              $pricearray[$symbol['Symbol']['dse_code']]['ltp']              = $symbol['Symbol']['lasttradeprice'];
              $pricearray[$symbol['Symbol']['dse_code']]['ycp']              = $shareprice[$symbol['Symbol']['dse_code']];
              $pricearray[$symbol['Symbol']['dse_code']]['name']             = $symbol['Symbol']['dse_code'];
              $pricearray[$symbol['Symbol']['dse_code']]['year_end']         = $symbol['Symbol']['year_end'];
              $pricearray[$symbol['Symbol']['dse_code']]['no_of_securities'] = $symbol['Symbol']['no_of_securities'];
              $pricearray[$symbol['Symbol']['dse_code']]['category']         = $symbol['Symbol']['category_bangla'];
              $pricearray[$symbol['Symbol']['dse_code']]['avg_price']        = $avg_price_array[$symbol['Symbol']['dse_code']]/5;
              
              $pricearray[$symbol['Symbol']['dse_code']]['facevalue']        = $facevaluearray[$symbol['Symbol']['dse_code']];
              $pricearray[$symbol['Symbol']['dse_code']]['bangla_name']      = $symbol['Symbol']['dse_code_bangla'];
              $pricearray[$symbol['Symbol']['dse_code']]['entry_year']       = $symbol['Symbol']['dse_listing_year'];
              $pricearray[$symbol['Symbol']['dse_code']]['maturity_year']    = $symbol['Symbol']['dse_listing_year'];
              
              $pricearray[$symbol['Symbol']['dse_code']]['mpb_recent']       = $nav_inforecent[$symbol['Symbol']['dse_code']]['mpb'];
              $pricearray[$symbol['Symbol']['dse_code']]['mpb_prev']         = $nav_infoprev[$symbol['Symbol']['dse_code']]['mpb'];
              $pricearray[$symbol['Symbol']['dse_code']]['mpb_change']       = $pricearray[$symbol['Symbol']['dse_code']]['mpb_recent'] - $pricearray[$symbol['Symbol']['dse_code']]['mpb_prev'];
              $pricearray[$symbol['Symbol']['dse_code']]['mpb_change_per']   = (($pricearray[$symbol['Symbol']['dse_code']]['mpb_recent'] - $pricearray[$symbol['Symbol']['dse_code']]['mpb_prev'])/$pricearray[$symbol['Symbol']['dse_code']]['mpb_prev'])*100;
              $pricearray[$symbol['Symbol']['dse_code']]['mpb_nav']          = $symbol['Symbol']['no_of_securities']*$nav_inforecent[$symbol['Symbol']['dse_code']]['mpb'];
              
              $pricearray[$symbol['Symbol']['dse_code']]['cpb_recent']       = $nav_inforecent[$symbol['Symbol']['dse_code']]['cpb'];
              $pricearray[$symbol['Symbol']['dse_code']]['cpb_prev']         = $nav_infoprev[$symbol['Symbol']['dse_code']]['cpb'];
              $pricearray[$symbol['Symbol']['dse_code']]['cpb_change']       = $pricearray[$symbol['Symbol']['dse_code']]['cpb_recent'] - $pricearray[$symbol['Symbol']['dse_code']]['cpb_prev'];
              $pricearray[$symbol['Symbol']['dse_code']]['cpb_change_per']   = (($pricearray[$symbol['Symbol']['dse_code']]['cpb_recent'] - $pricearray[$symbol['Symbol']['dse_code']]['cpb_prev'])/$pricearray[$symbol['Symbol']['dse_code']]['cpb_prev'])*100;
              $pricearray[$symbol['Symbol']['dse_code']]['cpb_nav']          = $symbol['Symbol']['no_of_securities']*$nav_inforecent[$symbol['Symbol']['dse_code']]['cpb'];
           
              $pricearray[$symbol['Symbol']['dse_code']]['action']           = $corporateSql[0]['corporate_action']['action'] ;
              $pricearray[$symbol['Symbol']['dse_code']]['action_value']     = $corporateSql[0]['corporate_action']['value'] ;
           }
      }
      /*echo '<pre>';
      print_r($nav_inforecent);
      die; */
      $this->set('pricearray',$pricearray);
      
     
   }
   
   function corporate_announcement()
   {
       //Configure::write('debug',3);
       if (! $this->Session->check ( 'Auth.User' )) {
            $this->Session->setFlash ( 'You are not authorized to access that location.' );
            $this->redirect ( array ('controller' => 'users', 'action' => 'login' ) );
        }
       $this->layout = 'default-three';
       $userGroup = $this->Session->read('Auth.User.group_id');
       $this->set('group',$userGroup);
       
       
       //$datelist = $this->MarketSummery->find('all', array('fields' => array('date'),'order' => array('id DESC'),'limit'=>28));        
//       $startdate = $datelist[27]['MarketSummery']['date'];
//       $end_date = $datelist[0]['MarketSummery']['date'];
//       
//       $startstamp = strtotime($startdate)-6*60*60;
//       $endstamp = strtotime($end_date)-6*60*60;
       
       $SymbolArr = $this->Symbol->find( 'list', array ('conditions' => array ('inactive=\'No\' AND otc_market=\'No\'' ), 'fields' => array ('id','face_value'),'order'=>'dse_code ASC' ) );
       $this->set('facevalue',$SymbolArr);
       
       $corporate_action = $this->Symboladjustment->find('all', array('conditions'=>array('active=1'),'order'=>'id DESC'));
       
       $last_year = date('Y',strtotime('-1 year'));
       $split_action = $this->Symboladjustment->find('all', array('conditions'=>array('active=1 AND action=\'split\''),'order'=>'id DESC','limit'=>7));
       $split_array = array();
       foreach($split_action as $split)
       {
           $split_array[]=$split;
       }
       //pr($split_array);
       //die;
       
       ///////////////latest dividend information//////////////////////
       $dividend_array = array();
       foreach($corporate_action as $dividend)
       {
           if(($dividend['Symboladjustment']['action'] =='cashdiv')|| ($dividend['Symboladjustment']['action'] =='stockdiv'))
           {
               $dividend_array[]=$dividend;
           }
       }
       /////////////// End latest dividend information/////////////////
       
       ////////////////////////dividend of last year///////////////////
       $dividend_action = $this->Symboladjustment->find('all', array('conditions'=>array('active=1 AND date LIKE \'%'.$last_year.'%\''),'order'=>'id DESC'));
       $dividend_array_last = array();
       foreach($dividend_action as $dividend)
       {
           if(($dividend['Symboladjustment']['action'] =='cashdiv')|| ($dividend['Symboladjustment']['action'] =='stockdiv'))
           {
               $dividend_array_last[]=$dividend;
           }
       }
      //////////////////////////end dividend of last yeat//////////////// 
      
      /////////////////////////right //////////////////////// 
       $right_action = $this->Symboladjustment->find('all', array('conditions'=>array('active=1 AND action=\'rightshare\''),'order'=>'id DESC'));
       $right_array = array();
       foreach($right_action as $right)
       {
           $right_array[]=$right; 
       }
       //////////end right///////////////////////////////////
       
       require_once (WWW_ROOT . DS . 'chart' . DS . 'class_http.php');
       $h = new http();
       $h->dir = "temp/";
       $url    = "http://dsebd.org/Company_AGM.htm";
       
       if (!$h->fetch($url, 50)) {        
        pr("There is a problem with the http request!");
        pr($h->log);
        exit();
        }
        while(stripos($h->body,'<!--') > 0){
            $pos[1] = stripos($h->body,'<!--');
            $pos[2] = stripos($h->body,'-->', $pos[1]);
            $len[1] = $pos[2] - $pos[1] + 3;
            $x = substr($h->body,$pos[1],$len[1]);
            $h->body = str_replace($x,'',$h->body);
        }
        
       $tableData = http::table_into_array($h->body, 'Name of Company', 0, null);
       $this->set('tabledata',$tableData);
        
        $sql = "SELECT * FROM report_observation WHERE is_active=1 AND tag='corporate_announcement'";
        $observation_detail =  $this->Symbol->query($sql);
        //pr($observation_detail);
        //die;
        
        $this->set('observation',$observation_detail);
       
       $this->set('dividendarray',$dividend_array);
       $this->set('dividendarraylast',$dividend_array_last);
       
       $this->set('splitarray',$split_array);
       $this->set('rightarray',$right_array);
       
       
   }
   
   function news_report($range = '')
   {
       //Configure::write('debug',3);
       $this->layout = 'default-three';
       $userGroup = $this->Session->read('Auth.User.group_id');
       $this->set('group',$userGroup);
       
       $category = array('Economy and Industry'=>'Economy and Industry','Political News'=>'Political News','Social News'=>'Social News','Environment'=>'Environment','Capital Market'=>'Capital Market','Company News'=>'Company News');
       foreach($category as $cat)
       {
        $newsinfo[$cat] =$this->Symbol->query("SELECT * FROM report_news WHERE category='$cat' AND is_active=1");
       }
       $this->set('newsinfo',$newsinfo);
       
        $sql = "SELECT * FROM report_observation WHERE is_active=1 AND tag='news_report'";
        $observation_detail =  $this->Symbol->query($sql);
        $this->set('observation',$observation_detail);
   }
   
   function topten_fundamental($range = '')
   {
       //Configure::write('debug',3);
       if (! $this->Session->check ( 'Auth.User' )) {
            $this->Session->setFlash ( 'You are not authorized to access that location.' );
            $this->redirect ( array ('controller' => 'users', 'action' => 'login' ) );
        }
       $this->layout = 'default-three';  
       $userGroup = $this->Session->read('Auth.User.group_id');
       $this->set('group',$userGroup);
       $timerange = array('1 Day'=>'1 Day','1 Week'=>'1 Week','15 Days'=>'15 Days','1 Month'=>'1 Month');
       $this->set('timerange',$timerange);
       //pr($range.'-----');
       if(empty($range))
       {
         $this->set('range','1 Week');
         $range = '1 Week';
       }else{
          // pr($range);
       $this->set('range',$range);
       }
       
       if(($range=='1 Day')||empty($range)){$limit =2; }
       if($range=='1 Week'){$limit =7;}
       if($range=='15 Days'){$limit =15;}
       if($range=='1 Month'){$limit =30;}
       $datelist = $this->MarketSummery->find('all', array('fields' => array('date'),'order' => array('id DESC'),'limit'=>$limit));
      
       $startdate = date('d-m-Y',strtotime($datelist[$limit-1]['MarketSummery']['date']));//convert the date format to fetch data from output
       $enddate = date('d-m-Y',strtotime($datelist[0]['MarketSummery']['date']));
       
       $startstamp = strtotime($startdate)-6*60*60;
       $endstamp = strtotime($enddate)-6*60*60;
       
       //pr($startdate);
       //pr($enddate);
       
       /*we consider default facevalue = 10*/
       $facevaluearray = $this->Symbol->find ( 'list', array ('conditions' => array ('inactive= \'No\' AND otc_market= \'No\' AND id>1'), 'fields' => array ('dse_code','face_value')));
       $symbolarray    = $this->Symbol->find ( 'all', array ('conditions' => array ('inactive= \'No\' AND otc_market= \'No\' AND id>1'), 'fields' => array ('id','lasttradeprice','dse_code','no_of_securities','face_value','q1','q2','q3','q4')));
       
       
       if($limit==2)
       { 
           $startdate= date('d-m-Y',strtotime($datelist[1]['MarketSummery']['date']));//convert the date format to fetch data from output     
       }
       
       
       $toptenbyprice = array();
       
       foreach($symbolarray as $symbol)
       {
           //pr($symbol['Symbol']['dse_code'].'->'.$facevaluearray[$symbol['Symbol']['dse_code']]);
          $todaytoptenbypriceSql = "SELECT id,symbol,name,open,high,low,close,volume,date,tradevalues FROM outputs WHERE date='".$enddate."' AND symbol=".$symbol['Symbol']['id']." AND volume!=0 ";
          $todaytoptenbyprice = $this->Output->query($todaytoptenbypriceSql);
          
          $prevtoptenbypriceSql = "SELECT id,symbol,name,open,high,low,close,volume,date,tradevalues FROM outputs WHERE date='".$startdate."' AND symbol=".$symbol['Symbol']['id']." AND volume!=0 ";
          $prevtoptenbyprice = $this->Output->query($prevtoptenbypriceSql);
          
          if(!empty($prevtoptenbyprice) && !empty($todaytoptenbyprice)){
              
              if(($facevaluearray[$symbol['Symbol']['dse_code']]=='100')||($facevaluearray[$symbol['Symbol']['dse_code']]=='100.0'))
              {
                  $symbol['Symbol']['lasttradeprice'] = $symbol['Symbol']['lasttradeprice']/10;
                  $prevtoptenbyprice[0]['outputs']['close'] = $prevtoptenbyprice[0]['outputs']['close']/10;
                  
              }    
          $toptenbyprice[$symbol['Symbol']['dse_code']]['price_change_per'] = (($symbol['Symbol']['lasttradeprice']-$prevtoptenbyprice[0]['outputs']['close'])*100)/$prevtoptenbyprice[0]['outputs']['close'];
          $toptenbyprice[$symbol['Symbol']['dse_code']]['price_change']     = $symbol['Symbol']['lasttradeprice']-$prevtoptenbyprice[0]['outputs']['close'];
          $toptenbyprice[$symbol['Symbol']['dse_code']]['ltp']              = $symbol['Symbol']['lasttradeprice'];
          $toptenbyprice[$symbol['Symbol']['dse_code']]['ycp']              = $prevtoptenbyprice[0]['outputs']['close'];
          
          $toptenbyturnovergrowth[$symbol['Symbol']['dse_code']]['turnover_change_per']   = (($todaytoptenbyprice[0]['outputs']['tradevalues']-$prevtoptenbyprice[0]['outputs']['tradevalues'])*100)/$prevtoptenbyprice[0]['outputs']['tradevalues'];
          $toptenbyturnovergrowth[$symbol['Symbol']['dse_code']]['turnover_change']       = $todaytoptenbyprice[0]['outputs']['tradevalues']-$prevtoptenbyprice[0]['outputs']['tradevalues'];
          $toptenbyturnovergrowth[$symbol['Symbol']['dse_code']]['today_turnover']        = $todaytoptenbyprice[0]['outputs']['tradevalues'];
          $toptenbyturnovergrowth[$symbol['Symbol']['dse_code']]['y_turnover']            = $prevtoptenbyprice[0]['outputs']['tradevalues'];
          }
          
       }
       //die;
       /************  for top10 volume turnover marketcapital   *****************////////////////////
       $todaytopten = array();
       $toptenbyvolume = array();
       $toptenbyturnover = array();
       $toptenMcap = array();
      foreach($symbolarray as $symbol)
           {
               if($limit==2)
               {
               $todaytoptenSql = "SELECT id,symbol,name,SUM(volume) as total_volume,SUM(tradevalues) as total_turnover FROM outputs WHERE date='".$enddate."' AND symbol=".$symbol['Symbol']['id']." AND volume!=0 ";
               
               }else{
                $todaytoptenSql = "SELECT SUM(volume) as total_volume,SUM(tradevalues) as total_turnover FROM outputs WHERE daystamp>='".$startstamp."' AND daystamp<='".$endstamp."' AND symbol=".$symbol['Symbol']['id']." AND volume!=0 ";
               }
               $todaytopten[$symbol['Symbol']['dse_code']] = $this->Output->query($todaytoptenSql);
               //pr($todaytopten);
               if(!empty($todaytopten[$symbol['Symbol']['dse_code']][0][0]['total_volume'])){
               $toptenbyvolume[$symbol['Symbol']['dse_code']]    = $todaytopten[$symbol['Symbol']['dse_code']][0][0]['total_volume'];
               $toptenbyturnover[$symbol['Symbol']['dse_code']]  = $todaytopten[$symbol['Symbol']['dse_code']][0][0]['total_turnover'];
               $toptenMcap[$symbol['Symbol']['dse_code']]        = $todaytopten[$symbol['Symbol']['dse_code']][0][0]['total_turnover']* $symbol['Symbol']['no_of_securities'];
               }
               
           }
     /************  End for top10 volume turnover marketcapital   *****************////////////////////
     
     /************  for top10 EPS and P/E  *****************////////////////////
      $toptenbyEPS = array();
      $toptenbyPE  = array();
           
      foreach($symbolarray as $symbol)
           {
                $qeps = 0;
                $factor = 1;
                $q1 = $symbol['Symbol'] ['q1'];
                $q2 = $symbol['Symbol'] ['q2'];
                $q3 = $symbol['Symbol'] ['q3'];
                $q4 = $symbol['Symbol'] ['q4'];
                
                if ($q1) {
                    $qeps = $symbol['Symbol'] ['q1'];;
                    $factor = 4;
                }

                if ($q2) {
                    $qeps = $symbol['Symbol'] ['q2'];;
                    $factor = 2;
                }

                if ($q3) {
                    $qeps = $symbol['Symbol'] ['q3'];;
                    $factor = 4 / 3;
                }

                if ($q4) {
                    $qeps = (float)$symbol['Symbol'] ['q4'];;
                    $factor = 1;
                }

                
                $toptenbyEPS[$symbol['Symbol'] ['dse_code']] = $qeps * $factor;
                $peSql = "SELECT symbol,name, SUM(close) as total_price FROM outputs WHERE date='".$enddate."' AND symbol=".$symbol['Symbol']['id']." AND volume!=0 ";  //retrieve the close price of a company of last trade day
                
                $result = $this->Symbol->query($peSql);
                if(($facevaluearray[$symbol['Symbol']['dse_code']]=='100')||($facevaluearray[$symbol['Symbol']['dse_code']]=='100.0'))
                  {
                     $result[0][0]['total_price'] = $result[0][0]['total_price']/10;
                  } 
                if($toptenbyEPS[$symbol['Symbol'] ['dse_code']]!=0)
                {
                    $toptenbyPE[$symbol['Symbol'] ['dse_code']] = $result[0][0]['total_price']/$toptenbyEPS[$symbol['Symbol'] ['dse_code']];
                }
                
           
           }
           
           //pr($toptenbyEPS);
           //pr($toptenbyPE);
           
           //die;
      /************  for top10 EPS   *****************////////////////////
           
         //  foreach($symbolarray as $symbol)
//           {
//              
//           }
           
           
           
      
       
       //pr($toptenbyEPS);die;
       //pr($toptenMcap);
       //pr($toptenbyvolume);
       //pr($toptenbyturnover);
       
       //die;
   /////////////////// generating the topten gainer and looser by price ///////////////////////// 
       arsort($toptenbyprice);
       $topten_price = array();
       $count=0;
       foreach($toptenbyprice as $company=>$arr)
       {
           $topten_price[$count]['company'] = $company;
           $topten_price[$count]['ycp'] = $arr['ycp'];
           $topten_price[$count]['cp'] = $arr['ltp'];
           $topten_price[$count]['price_change_per'] = $arr['price_change_per'];
           $count++;
           if($count==10)
           break;
       }
       //pr($topten_price);
       
       asort($toptenbyprice);
       $bottomten_price = array();
       $count=0;
       foreach($toptenbyprice as $company=>$arr)
       {
           $bottomten_price[$count]['company'] = $company;
           $bottomten_price[$count]['ycp'] = $arr['ycp'];
           $bottomten_price[$count]['cp'] = $arr['ltp'];
           $bottomten_price[$count]['price_change_per'] = $arr['price_change_per'];
           $count++;
           if($count==10)
           break;
       }
       
       ///////////////// End of topten gainer and looser by price ///////////////////////// 
       
      //////////////// generating the topten gainer and looser by Turnover ///////////////////////// 
       arsort($toptenbyturnover);
       //pr($toptenbyturnover); die;
       $topten_turnover = array();
       $count=0;
       foreach($toptenbyturnover as $company=>$arr)
       {
           
           $topten_turnover[$count]['company'] = $company;
           $topten_turnover[$count]['turnover'] = $arr;
           $count++;
           if($count==10)
           break;
       }
       
       
       asort($toptenbyturnover);
       $bottomten_turnover = array();
       $count=0;
       foreach($toptenbyturnover as $company=>$arr)
       {
           
           $bottomten_turnover[$count]['company'] = $company;
           $bottomten_turnover[$count]['turnover'] = $arr;
           
           $count++;
           if($count==10)
           break;
       }
          
       ///////////////// End of topten gainer and looser by Turnover ///////////////////////// 
       
        //////////////// generating the topten gainer and looser by Turnover Growth ///////////////////////// 
       arsort($toptenbyturnovergrowth);
       $topten_turnover_growth = array();
       $count=0;
       foreach($toptenbyturnovergrowth as $company=>$arr)
       {
           $topten_turnover_growth[$count]['turnover_change_per'] = $arr['turnover_change_per'];
           $topten_turnover_growth[$count]['company'] = $company;
           $topten_turnover_growth[$count]['yturnover'] = $arr['y_turnover'];
           $topten_turnover_growth[$count]['turnover'] = $arr['today_turnover'];
           $topten_turnover_growth[$count]['turnover_change'] = $arr['turnover_change'];
           
           $count++;
           if($count==10)
           break;
       }
       //pr($topten_price);
       
       asort($toptenbyturnovergrowth);
       $bottomten_turnover_growth = array();
       $count=0;
       foreach($toptenbyturnovergrowth as $company=>$arr)
       {
           $bottomten_turnover_growth[$count]['turnover_change_per'] = $arr['turnover_change_per'];
           $bottomten_turnover_growth[$count]['company'] = $company;
           $bottomten_turnover_growth[$count]['yturnover'] = $arr['y_turnover'];
           $bottomten_turnover_growth[$count]['turnover'] = $arr['today_turnover'];
           $bottomten_turnover_growth[$count]['turnover_change'] = $arr['turnover_change'];
           
           $count++;
           if($count==10)
           break;
       }
       
       ///////////////// End of topten gainer and looser by Turnover ///////////////////////// 
       
       
       //////////////// generating the topten gainer and looser by Volume ///////////////////////// 
       arsort($toptenbyvolume);
       
       $topten_volume = array();
       $count=0;
       foreach($toptenbyvolume as $company=>$arr)
       {
           
           $topten_volume[$count]['company'] = $company;
           $topten_volume[$count]['volume'] = $arr;
           $count++;
           if($count==10)
           break;
       }
       
       
       asort($toptenbyvolume);
       $bottomten_volume = array();
       $count=0;
       foreach($toptenbyvolume as $company=>$arr)
       {
           
           $bottomten_volume[$count]['company'] = $company;
           $bottomten_volume[$count]['volume'] = $arr;
           
           $count++;
           if($count==10)
           break;
       }
          
       ///////////////// End of topten gainer and looser by Volume ///////////////////////// 
       
       
       //////////////// generating the topten gainer and looser by Market Capital ///////////////////////// 
       arsort($toptenMcap);
       
       $topten_mCap = array();
       $count=0;
       foreach($toptenMcap as $company=>$arr)
       {
           
           $topten_mCap[$count]['company'] = $company;
           $topten_mCap[$count]['mCap'] = $arr;
           $count++;
           if($count==10)
           break;
       }
       
       
       asort($toptenMcap);
       $bottomten_mCap = array();
       $count=0;
       foreach($toptenMcap as $company=>$arr)
       {
           
           $bottomten_mCap[$count]['company'] = $company;
           $bottomten_mCap[$count]['mCap'] = $arr;
           
           $count++;
           if($count==10)
           break;
       }
          
       ///////////////// End of topten gainer and looser by Market Capital ///////////////////////// 
        
      //////////////// generating the topten gainer and looser by EPS ///////////////////////// 
       arsort($toptenbyEPS);
       
       $topten_EPS = array();
       $count=0;
       foreach($toptenbyEPS as $company=>$arr)
       {
           
           $topten_EPS[$count]['company'] = $company;
           $topten_EPS[$count]['EPS'] = $arr;
           $count++;
           if($count==10)
           break;
       }
       
       
       asort($toptenbyEPS);
       $bottomten_EPS = array();
       $count=0;
       foreach($toptenbyEPS as $company=>$arr)
       {
           
           $bottomten_EPS[$count]['company'] = $company;
           $bottomten_EPS[$count]['EPS'] = $arr;
           
           $count++;
           if($count==10)
           break;
       }
          
       ///////////////// End of topten gainer and looser by EPS ///////////////////////// 
       
       
       //////////////// generating the topten gainer and looser by PE ///////////////////////// 
       arsort($toptenbyPE);
       
       $topten_PE = array();
       $count=0;
       foreach($toptenbyPE as $company=>$arr)
       {
           
           $topten_PE[$count]['company'] = $company;
           $topten_PE[$count]['PE'] = $arr;
           $count++;
           if($count==10)
           break;
       }
       
       
       asort($toptenbyPE);
       $bottomten_PE = array();
       $count=0;
       foreach($toptenbyPE as $company=>$arr)
       {
           
           $bottomten_PE[$count]['company'] = $company;
           $bottomten_PE[$count]['PE'] = $arr;
           
           $count++;
           if($count==10)
           break;
       }
          
       ///////////////// End of topten gainer and looser by PE ///////////////////////// 
       
       $this->set('toptengainer_price_percent',$topten_price);
       $this->set('toptenlooser_price_percent',$bottomten_price);
       
       $this->set('toptengainer_volume',$topten_volume);
       $this->set('toptenlooser_volume',$bottomten_volume);
       
       $this->set('toptengainer_mCap',$topten_mCap);
       $this->set('toptenlooser_mCap',$bottomten_mCap);
       
       $this->set('toptengainer_EPS',$topten_EPS);
       $this->set('toptenlooser_EPS',$bottomten_EPS);
       
       $this->set('toptengainer_PE',$topten_PE);
       $this->set('toptenlooser_PE',$bottomten_PE);
       
       $this->set('toptengainer_turnover',$topten_turnover);
       $this->set('toptenlooser_turnover',$bottomten_turnover);
       $this->set('toptengainer_turnover_percent',$topten_turnover_growth);
       $this->set('toptenlooser_turnover_percent',$bottomten_turnover_growth);
       
       $sql = "SELECT * FROM report_observation WHERE is_active=1 AND tag='topten_fundamental'";
       $observation_detail =  $this->Symbol->query($sql);
       $this->set('observation',$observation_detail);
       
       
   }
   
   
   function sector_analysis($range = '')
   {
       //Configure::write('debug',3);
       if (! $this->Session->check ( 'Auth.User' )) {
            $this->Session->setFlash ( 'You are not authorized to access that location.' );
            $this->redirect ( array ('controller' => 'users', 'action' => 'login' ) );
        }
       $this->layout = 'default-three';  
       $userGroup = $this->Session->read('Auth.User.group_id');
       $this->set('group',$userGroup);
       
       $sectors = $this->Symbol->find ( 'all', array ('conditions' => array ('inactive= \'No\' AND otc_market= \'No\' AND business_segment!=\'\''), 'fields' => array ('DISTINCT Symbol.business_segment') ) );
       
       $timerange = array('1 Day'=>'1 Day','1 Week'=>'1 Week','15 Days'=>'15 Days','1 Month'=>'1 Month');
       $this->set('timerange',$timerange);
       if(empty($range))
       {
         $this->set('range','1 Week');
         $range = '1 Week';
       }else{
       $this->set('range',$range);
       }
       //pr($range);
       $total_information = array();
       $SymbolArr = array();
      
      /////////////////////** generate Sectorwise symbol list**////////////// 
       foreach($sectors as $sector)
       {
            $SymbolArr[$sector['Symbol']['business_segment']] = $this->Symbol->find( 'all', array ('conditions' => array ('business_segment ="'.$sector['Symbol']['business_segment'].'" AND inactive=\'No\' AND otc_market=\'No\'' ), 'fields' => array ('id','dse_code','face_value','lasttradeprice','q1','q2','q3','q4','no_of_securities' ) ) );
       }
      ///////////////////// end of sector list//////////////////////
        //pr($range); die;
       //$limit == 1;
       if(($range=='1 Day')||empty($range)){$limit =1; }
       if($range=='1 Week'){$limit =7;}
       if($range=='15 Days'){$limit =15;}
       if($range=='1 Month'){$limit =30;}
       $datelist = $this->MarketSummery->find('all', array('fields' => array('date'),'order' => array('id DESC'),'limit'=>$limit));        
      // pr($datelist); 
                    
       $startdate = $datelist[$limit-1]['MarketSummery']['date'];
       $end_date = $datelist[0]['MarketSummery']['date'];
       
       $startstamp = strtotime($startdate)-6*60*60;
       $endstamp = strtotime($end_date)-6*60*60;
       
       //pr($startstamp);
       //pr($endstamp);
       //die;
       $sectorEpstotal = array();
       $sectorlastpricetotal = array();
      
       foreach($SymbolArr as $sector=>$arr)
       {
            
           //pr($arr);
           $total_eps_company = 0;
           $total_lastprice_company = 0;
           //$qeps = 0;
           $mCap = 0;
           //TO_DAYS(FROM_UNIXTIME(daystamp))= TO_DAYS('$date')
           foreach($arr as $row)
            {
                if($limit==1)
                {
                    $resultArr[$sector][] = $this->Output->find('all',array('conditions'=>array('daystamp>='.$startstamp.' AND symbol='.$row['Symbol']['id']))); //query for avg price
                }
                else{
                    $resultArr[$sector][] = $this->Output->find('all',array('conditions'=>array('daystamp>='.$startstamp.' AND daystamp<='.$endstamp.' AND symbol='.$row['Symbol']['id']))); //query for avg price    
                }
                
                $companyFinPerf = "SELECT asset_val_per_share FROM `company_financial_performance` WHERE `symbol_id`='".$row['Symbol']['id']."' and asset_val_per_share!=''  ORDER BY  fin_year DESC LIMIT 1";//query for NAV
                $companyFinPerfResult[$sector][] = $this->Symbol->query($companyFinPerf);
                
                $q1 = $row ['Symbol'] ['q1'];
                $q2 = $row ['Symbol'] ['q2'];
                $q3 = $row ['Symbol'] ['q3'];
                $q4 = $row ['Symbol'] ['q4'];
                $company_lastprice = $row ['Symbol'] ['lasttradeprice'];
                //pr($company_lastprice);
                if($q1)
                {
                    $qeps   = $q1;
                    $factor = 4;
                    $querterNo = "Q1";
                }
                if($q2)
                {
                    $qeps   = $q2;
                    $factor = 2;
                    $querterNo = "Q2";
                }
                if($q3)
                {
                    $qeps   = $q3;
                    $factor = 4/3;
                    $querterNo = "Q3";
                }
                if($q4)
                {
                    $qeps   = $q4;
                    $factor = 1;
                    $querterNo = "Annual";
                }
                
                $companyEPS = $qeps*$factor;
                $total_eps_company += $companyEPS;  
                $total_lastprice_company +=$company_lastprice; 
                
                   
           }
           
                $sector_totallastprice[$sector] = $total_lastprice_company;
                $sectorEpstotal[$sector] = $total_eps_company;
       }
      
      //pr($resultArr);

      //die; 
       
       
       /////////////////////////***start fetching data from the output table for tradevalues(for total price) and NAV from company financial performance(for iNAV) ****////////////
       $sector_totaltradevalues = array();
       $sector_totaltradecompany = array();
       $sector_totaltradevolume = array();
       $sector_totaltradenumber = array();
       $company_tradevalues = array();
       foreach($resultArr as $sector=>$result)///////calculating the Avg Price of all company of the sector
       {
           $total_tradevalue = 0;
           $tradedcompanyofSector = 0; 
           $total_tradevolume = 0;
           $total_tradenumber = 0;
           foreach($result as $row)
           {
               $tradevalue = 0;
               $tradevolume = 0;
               $tradenumber = 0;
               foreach($row as $rows)////////////for 1 week or more///////
               {
                   $tradevalue  += $rows['Output']['tradevalues'];///store tradevalue for specific time range
                   $tradevolume += $rows['Output']['volume'];//store volume of specific time range
                   $tradenumber += $rows['Output']['trade'];//store trade number for specific time range
                    
               }
               
               //pr($row);
               if($row[0]['Output']['tradevalues']!=0)
               {
                  $tradedcompanyofSector++; 
               }
               $company_tradevalues[$sector][$row[0]['Output']['symbol']] = $tradevalue;//store the companywise tradevalues 
               $total_tradevalue  += $tradevalue;//$row[0]['Output']['tradevalues'];//store the sum of tradevalues of all company of the sector
               $total_tradevolume += $tradevolume;//$row[0]['Output']['volume'];////store the sum of volume of all company of the sector
               $total_tradenumber += $tradenumber;//$row[0]['Output'] ['trade'];////store the sum of number of trades of all company of the sector
           }
           $sector_totaltradevalues[$sector] = $total_tradevalue; 
           $sector_totaltradecompany[$sector] = $tradedcompanyofSector;////total number of traded company 
           $sector_totaltradevolume[$sector] = $total_tradevolume;
           $sector_totaltradenumber[$sector] = $total_tradenumber;
       }
       //pr($sector_totaltradevalues);
       //pr($sector_totaltradevolume);
       //die;
       $sector_totalMarketCap = array();
       foreach($SymbolArr as $sector=>$arr)
       {
           $mCap = 0;
           foreach($arr as $row)
           {
             $nos = $row ['Symbol'] ['no_of_securities'];  
             $Symbol = $row ['Symbol'] ['id'];  
             if(!empty($company_tradevalues[$sector][$Symbol]))
             {
                $mCap += ($nos*$company_tradevalues[$sector][$Symbol]);
             }
           }
           $sector_totalMarketCap[$sector] = $mCap/1000000;
       }
       
       
       $sector_totalNAV = array();
       foreach($companyFinPerfResult as $sector=>$result)///////calculating the NAV of all company of the sector
       {
           $total_NAV = 0;
           foreach($result as $row)
           {
               $total_NAV += $row[0]['company_financial_performance']['asset_val_per_share'];
           }
           $sector_totalNAV[$sector] = $total_NAV; //////total NAV of the sector
           
           
       }
       //pr($sector_totalNAV);     die;
       
       //////////////////***end of calculation of total price of a sector****/////////////////
       
       /////////////now find the avg EPS and avg price of  sectors///////////////////
       $total_information = array();
       foreach($sectors as $sector)
       {
           $sector = $sector['Symbol']['business_segment'];
           $total_information[$sector]['avg_eps']   = $sectorEpstotal[$sector]/$sector_totaltradecompany[$sector];
           $total_information[$sector]['avg_price'] = $sector_totaltradevalues[$sector]/$sector_totaltradecompany[$sector];
           $total_information[$sector]['turnover'] = $sector_totaltradevalues[$sector];
           $total_information[$sector]['avg_pe'] = $sector_totallastprice[$sector]/$sectorEpstotal[$sector];
           $total_information[$sector]['iNAV'] = $sector_totalNAV[$sector]/$sector_totaltradecompany[$sector];
           $total_information[$sector]['vol'] = $sector_totaltradevolume[$sector]/$sector_totaltradecompany[$sector];
           $total_information[$sector]['hawla'] = $sector_totaltradenumber[$sector];///$sector_totaltradecompany[$sector];
           $total_information[$sector]['mcap'] = $sector_totalMarketCap[$sector];
           
       }
       
       //pr($total_information); die;
       $this->set('total_info',$total_information);
       /////////////end of calculation of avg EPS and avg Price////////////////////////
       
    //****************************Categorywise Analysis**********************************************//////
   //*********************************************************************************************///
  /////******************************************************************************************/////
        $categories = $this->Symbol->find ( 'all', array ('conditions' => array ('inactive= \'No\' AND otc_market= \'No\' AND business_segment!=\'\' '), 'fields' => array ('DISTINCT Symbol.category') ) );
        //pr($category);
        $total_information_cat = array();
        $categoryArr = array();
      
            
       foreach($categories as $category) ///generate categorywise symbol list
       {
          $categoryArr[$category['Symbol']['category']] = $this->Symbol->find( 'all', array ('conditions' => array ('category ="'.$category['Symbol']['category'].'" AND inactive=\'No\' AND otc_market=\'No\'' ), 'fields' => array ('id','dse_code','face_value','lasttradeprice','q1','q2','q3','q4','no_of_securities' ) ) );
       }
       
       $catEpstotal = array();
       $sectorlastpricetotal = array();
      
       foreach($categoryArr as $cat=>$arr)
       {
            
           //pr($arr);
           $cat_total_eps_company = 0;
           $cat_total_lastprice_company = 0;
           //$qeps = 0;
           $mCap = 0;
           //TO_DAYS(FROM_UNIXTIME(daystamp))= TO_DAYS('$date')
           foreach($arr as $row)
            {
                if($limit==1)
                {
                    $cat_resultArr[$cat][] = $this->Output->find('all',array('conditions'=>array('daystamp>='.$startstamp.' AND symbol='.$row['Symbol']['id']))); //query for avg price
                }
                else{
                    $cat_resultArr[$cat][] = $this->Output->find('all',array('conditions'=>array('daystamp>='.$startstamp.' AND daystamp<='.$endstamp.' AND symbol='.$row['Symbol']['id']))); //query for avg price    
                }
                $cat_companyFinPerf = "SELECT asset_val_per_share FROM `company_financial_performance` WHERE `symbol_id`='".$row['Symbol']['id']."' and asset_val_per_share!=''  ORDER BY  fin_year DESC LIMIT 1";//query for NAV
                $cat_companyFinPerfResult[$cat][] = $this->Symbol->query($cat_companyFinPerf);
                
                $q1 = $row ['Symbol'] ['q1'];
                $q2 = $row ['Symbol'] ['q2'];
                $q3 = $row ['Symbol'] ['q3'];
                $q4 = $row ['Symbol'] ['q4'];
                $cat_company_lastprice = $row ['Symbol'] ['lasttradeprice'];
                //pr($company_lastprice);
                if($q1)
                {
                    $qeps   = $q1;
                    $factor = 4;
                    $querterNo = "Q1";
                }
                if($q2)
                {
                    $qeps   = $q2;
                    $factor = 2;
                    $querterNo = "Q2";
                }
                if($q3)
                {
                    $qeps   = $q3;
                    $factor = 4/3;
                    $querterNo = "Q3";
                }
                if($q4)
                {
                    $qeps   = $q4;
                    $factor = 1;
                    $querterNo = "Annual";
                }
                
                $cat_companyEPS = $qeps*$factor;
                $cat_total_eps_company += $cat_companyEPS;  
                $cat_total_lastprice_company +=$cat_company_lastprice; 
                
                   
           }
           
                $cat_totallastprice[$cat] = $cat_total_lastprice_company;
                $catEpstotal[$cat] = $cat_total_eps_company;
       }
       //pr($catEpstotal); die;
       $cat_totaltradevalues = array();
       $cat_totaltradecompany = array();
       $cat_totaltradevolume = array();
       $cat_totaltradenumber = array();
       foreach($cat_resultArr as $cat=>$result)///////calculating the Avg Price of all company of the sector
       {
           $cat_total_tradevalue = 0;
           $tradedcompanyofCat = 0; 
           $cat_total_tradevolume = 0;
           $cat_total_tradenumber = 0;
           foreach($result as $row)
           {
              $cat_tradevalue  = 0;
              $cat_tradevolume = 0;
              $cat_tradenumber = 0;
              foreach($row as $rows)////////////for 1 week or more///////
               {
                   $cat_tradevalue  += $rows['Output']['tradevalues'];///store tradevalue for specific time range
                   $cat_tradevolume += $rows['Output']['volume'];//store volume of specific time range
                   $cat_tradenumber += $rows['Output']['trade'];//store trade number for specific time range
                    
               } 
               
               if($row[0]['Output']['tradevalues']!=0)
               {
                  $tradedcompanyofCat++; 
               }
               $cat_company_tradevalues[$cat][$row[0]['Output']['symbol']] = $cat_tradevalue;//store the companywise tradevalues 
               $cat_total_tradevalue  += $cat_tradevalue;//store the sum of tradevalues of all company of the sector
               $cat_total_tradevolume += $cat_tradevolume;////store the sum of volume of all company of the sector
               $cat_total_tradenumber += $cat_tradenumber;////store the sum of number of trades of all company of the sector
           }
           $cat_totaltradevalues[$cat] = $cat_total_tradevalue; 
           $cat_totaltradecompany[$cat] = $tradedcompanyofCat;////total number of traded company 
           $cat_totaltradevolume[$cat] = $cat_total_tradevolume;
           $cat_totaltradenumber[$cat] = $cat_total_tradenumber;
       }
       
       $cat_totalMarketCap = array();
       foreach($categoryArr as $cat=>$arr)
       {
           $cat_mCap = 0;
           foreach($arr as $row)
           {
             $nos = $row ['Symbol'] ['no_of_securities'];  
             $Symbol = $row ['Symbol'] ['id'];  
             if(!empty($cat_company_tradevalues[$cat][$Symbol]))
             {
                $cat_mCap += ($nos*$cat_company_tradevalues[$cat][$Symbol]);
             }
           }
           $cat_totalMarketCap[$cat] = $cat_mCap/1000000;
       }
       
       
       $cat_totalNAV = array();
       foreach($cat_companyFinPerfResult as $cat=>$result)///////calculating the NAV of all company of the sector
       {
           $cat_total_NAV = 0;
           foreach($result as $row)
           {
               $cat_total_NAV += $row[0]['company_financial_performance']['asset_val_per_share'];
           }
           $cat_totalNAV[$cat] = $cat_total_NAV; //////total NAV of the sector
           
           
       }
       
       $cat_total_information = array();
       foreach($categories as $category)
       {
           $cat = $category['Symbol']['category'];
           $cat_total_information[$cat]['cat_avg_eps']   = $catEpstotal[$cat]/$cat_totaltradecompany[$cat];
           $cat_total_information[$cat]['cat_avg_price'] = $cat_totaltradevalues[$cat]/$cat_totaltradecompany[$cat];
           $cat_total_information[$cat]['cat_turnover']  = $cat_totaltradevalues[$cat];
           $cat_total_information[$cat]['cat_avg_pe']    = $cat_totallastprice[$cat]/$catEpstotal[$cat];
           $cat_total_information[$cat]['cat_iNAV']      = $cat_totalNAV[$cat]/$cat_totaltradecompany[$cat];
           $cat_total_information[$cat]['cat_vol']       = $cat_totaltradevolume[$cat]/$cat_totaltradecompany[$cat];
           $cat_total_information[$cat]['cat_hawla']     = $cat_totaltradenumber[$cat];///$sector_totaltradecompany[$sector];
           $cat_total_information[$cat]['cat_mcap']      = $cat_totalMarketCap[$cat];
           
       }
       $this->set('cat_total_info',$cat_total_information);
       $sql = "SELECT * FROM report_observation WHERE is_active=1 and tag='mutual_fund_chart'";
       $observation_detail =  $this->Symbol->query($sql);
       $this->set('observation',$observation_detail);
       //pr($cat_total_information);die; 
     //****************************End Categorywise Analysis*******************************//////  
   }
   
   function admin_observation_add($tag = '')
   {
       
       //Configure::write('debug',3);
       $this->layout = 'default-one';
       $this->set('tag',$tag);
       
       
       if (!empty($this->data)) {
            
            if($this->data['Resource']['title'] == ''){
                $this->Session->setFlash('Please enter news title.');
                $this->redirect(array('action' => 'admin_observation_add'));
            }
            
            if($this->data['Resource']['details'] == ''){
                $this->Session->setFlash('Please enter news details.');
                $this->redirect(array('action' => 'admin_observation_add'));
            }
            
                         
            //pr($this->data); die;
            $active = 1;
            $title     = trim($this->data['Resource']['title']);
            $details   = trim($this->data['Resource']['details']);
            $tag       = trim($this->data['Resource']['tag']);
            $published = trim($this->data['Resource']['published_date']);
            $created   = date('Y-m-d h:i:s');
            
            $sql = "INSERT INTO `report_observation` ( `id` , `title` , `detail` , `tag`, `creation_date` , `publish_date` , `is_active`)                    
                            VALUES (NULL , '$title', '$details', '$tag','$created', '$published', '$active');";
            
            $this->Symbol->query($sql);
            $this->redirect(array('action' => $tag));
            
        }
       
   }
   
   function admin_reportnews_add()
   {
       
       Configure::write('debug',3);
       $this->layout = 'default-one';
       $category = array('Economy and Industry'=>'Economy and Industry','Political News'=>'Political News','Social News'=>'Social News','Environment'=>'Environment','Capital Market'=>'Capital Market','Company News'=>'Company News');
       $this->set('category',$category);
       if (!empty($this->data)) {
            
            if($this->data['Resource']['title'] == ''){
                $this->Session->setFlash('Please enter news title.');
                $this->redirect(array('action' => 'admin_reportnews_add'));
            }
            if($this->data['Resource']['details'] == ''){
                $this->Session->setFlash('Please enter news details.');
                $this->redirect(array('action' => 'admin_reportnews_add'));
            }
            
            $active = 1;
            $title     = trim($this->data['Resource']['title']);
            $details   = trim($this->data['Resource']['details']);
            $category  = trim($this->data['Resource']['category']);
            $source  = trim($this->data['Resource']['source']);
            $created   = date('Y-m-d');
            
            $sql = "INSERT INTO `report_news` (`id`, `title` ,`detail` ,`category` ,`publish_date` ,`source` ,`is_active`) 
            VALUES (NULL,'$title',  '$details',  '$category',  '$created',  '$source',  '$active')";
            
            $this->Symbol->query($sql);
            $this->redirect(array('action' => 'news_report'));
            
        }
       
   }
   
   
   
   
   /////////////////////////end report//////////////////////////////////////////
 function sectorminutechart($updateRequest =NULL) {
		Configure::write("debug",0);
		$this->layout = 'default-one';
		$this->pageTitle = 'Stock Bangladesh :: Minute Chart - Price Chart/ Graph';
		if (! $this->Session->check ( 'Auth.User' )) {
			//$this->Session->setFlash ( 'Please login again.' );
		//	$this->redirect ( array ('controller' => 'users', 'action' => 'login' ) );
		}
		$sectors=$this->Symbol->query("SELECT DISTINCT business_segment FROM symbols WHERE business_segment!='' LIMIT 30");
		$this->set("sectors",$sectors);
		$sector_name=$_POST["TickerSymbol"];
		$this->set('sector_name1',trim($sector_name));
		$this->set('sym',$sector_name);
		}
    function secminchartdraw($sectorPost){
	
		Configure::write("debug",0);
		$this->layout = 'default-one';
		require_once(WWW_ROOT . DS . 'chart'. DS .'phpchartdir.php');
		$inv = 60;
		$inv1 = 300;
		$sector_name=$sectorPost;
		//$sector_name="Bank";
		
		$sqlStr="SELECT dse_code,name,id,face_value FROM symbols WHERE  business_segment LIKE '%".$sector_name."%' AND otc_market='No' AND inactive='No' LIMIT 30";
		$sector_wise_items=$this->Symbol->query($sqlStr);
		//print_r($sector_wise_items);
		foreach($sector_wise_items as $item){
		$sector_items[$item["symbols"]["id"]]=$item["symbols"]["dse_code"];
		$face_value[$item["symbols"]["dse_code"]]=$item["symbols"]["face_value"];
		}	

		if (isset ( $updateRequest ['sym'] ) && $updateRequest ['sym'] != '')
		$_REQUEST ['TickerSymbol'] = $updateRequest ['sym'];
		if (isset ( $updateRequest ['inv'] ) && $updateRequest ['inv'] != '')
		$_REQUEST ['inv'] = $updateRequest ['inv'];
		if (isset ($sector_name)) {
			$inv = $_REQUEST ['inv'];
			$symbolInfo = $this->Symbol->find ( 'first', array ('conditions' => array ('id=' . $_REQUEST ['TickerSymbol'] ), 'fields' => array ('Symbol.dse_code', 'Symbol.name' ) ));
			$name = $symbolInfo ['Symbol'] ['name'];
			$name = ucwords ( strtolower ( $name ) );
			$this->pageTitle = "$name ::Sector Minute Chart Stock Bangladesh";
			$this->set ( 'sym', $_REQUEST ['TickerSymbol'] );
			$getLastIntradayId = $this->Symbol->query ( 'SELECT value from configuration WHERE name=\'data_bank_intraday_lid\' ' );
			$getLastIntradayId = $getLastIntradayId [0] ['configuration'] ['value'];
			$sector_key=array_keys($sector_items);
			
			foreach($sector_key as $key){
			$shareStr="select * from data_banks_intraday where symbol_id=$key AND id >  $getLastIntradayId  LIMIT 250 ";
			$forShareData[$key]=$this->Symbol->query($shareStr);
			}
			//print_r($forShareData);
			//exit;
		//	print_r($forShareData);
		//	exit;
			$forShareData1=array();
		//	print_r(count($forShareData));
			foreach ($forShareData as $row_key=>$row ) {
				foreach($row as $row1){
					$forShareData1[$row_key][$row1["data_banks_intraday"]["date"]]=$row1;
					$timeTocount1[]=$row1["data_banks_intraday"]["date"];
				}				
			}
			//print_r($forShareData1);
			//exit;
			foreach($forShareData1 as $items){
				$shared_vol=0;
				$shared_value=0;
				$shared_price=0;
					foreach($items as $key=>$item){
					$multiply=1;
					if($face_value[$item["data_banks_intraday"]["code"]]==100)$multiply=10;					
					$item_price=$item["data_banks_intraday"]["lastprice"];
					$item_volume=$item["data_banks_intraday"]["value"]*10000;
					$item_price=$item_price/$multiply;
					$item_volume=$item_volume*$multiply;
					$shared_data["vol"][$key]+=$item_volume;
					$shared_data["value"][$key]=$item_price;
					}
				}
	$xdata = array ();
	$ydata = array ();
	$vdata = array ();
	//print_r($shared_data["vol"]);
       ksort($shared_data["vol"],SORT_NUMERIC);
	//print_r($shared_data["vol"]);
	//exit;
//print_r($shared_data["value"]);
//exit;
$prev_val=0;
foreach($shared_data["vol"] as $key=>$share){
	$curr_val=$share-$prev_val;
	if($curr_val<0)$curr_val=0;
	$xdata[]=date("H:i",$key);
	$vdata[]=$curr_val;
	$ydata[]=$shared_data["value"][$key];
	$prev_val=$share;
}	

	$data0 = $ydata;
	$data1 = $vdata;
	$labels = $xdata;
	
	$last=$data0[count($data0)-1];
	$max=max($data0);
	$min=max($data0);
	$sum=array_sum($data0);
	
	# Create a XYChart object of size 300 x 180 pixels
	$c = new XYChart ( 760, 450 );
	$c->setBackground ( $c->linearGradientColor ( 0, 0, 0, 400, 0xE7FFDF, 0xffffff ), 0xE3EFC2 );
	$c->setRoundedFrame ( 0xffffff, 0 );

			//$c->setBackground($c->linearGradientColor(0, 0, 0, 400, 0xffffbb, 0xffffff), 0x888888);
			//$c->setRoundedFrame(0xffffff, 0);

			# Set the plot area at (50, 20) and of size 200 x 130 pixels
	$c->setPlotArea ( 50, 50, 650, 320, 0xffffff, - 1, - 1, $c->dashLineColor ( 0xaaaaaa, DotLine ), Transparent );
			# Add a title to the chart using 8 pts Arial Bold font
	$arialbdPath = WWW_ROOT . 'font' . DS . 'arialbd.ttf';

	$c->addTitle ( "$code-$tradeDate          Last price : $last   high : $max low : $min trade : $sum  ", $arialbdPath, 8, 0x333333, 0xE7FFDF );
			//$textBoxObj = $c->addText ( 180, 12, "Bull Vol: $myPositiveCounter($myPositivePer%) Neutral Vol: $myEqualCounter($myEqualPer%)  Bear Vol: $myNegativeCounter ($myNegativePer%)", $arialbdPath, 8, 0x333333 );
			//$c->addTitle ( "$code-$tradeDate          Last price : $lastprice   high : $dayhigh low : $daylow trade : $totaltrade   Total Volume - $totalvolume Positive: Negative: ", $arialbdPath, 14, 0x333333, 0xE7FFDF );

			# Set the labels on the x axis.
	$c->xAxis->setLabels ( $labels );

	$c->xAxis->setLabelStyle ( "Arial", 8, TextColor, 90 );

			# Add a title to the primary (left) y axis
	$c->yAxis->setTitle ( "PRICE" );

			# Set the axis, label and title colors for the primary y axis to red (0xc00000) to
			# match the first data set
	$c->yAxis->setColors ( 0x008000, 0x008000, 0x008000 );

			# Add a title to the secondary (right) y axis
			$c->yAxis2->setTitle ( "VOLUME" );
			# set the axis, label and title colors for the primary y axis to green (0x008000) to
			# match the second data set
			$c->yAxis2->setColors ( 0x008000, 0x008000, 0x008000 );

			$textBoxObj = $c->addText ( 500, 50, "www.stockbangladesh.org", "timesbi.ttf", 11, 0xc09090 );
			$textBoxObj->setAlignment ( TopLeft );

			# Add a line layer to the chart
			$layer = $c->addLineLayer ();

			# Add the first line. Plot the points with a 7 pixel square symbol
			$dataSetObj = $layer->addDataSet ( $data0, 0xcf4040, "Price" );
			$dataSetObj->setDataSymbol ( SquareSymbol, 5 );

			$trendLayerObj = $c->addTrendLayer ( $data0, 0x008000, "Trend Line" );
			$trendLayerObj->setLineWidth ( 1 );
			$trendLayerObj->addPredictionBand ( 0.95, 0x8066ff66 );
			
			$barLayerObj = $c->addBarLayer3 ( $data1 );
			$barLayerObj->setBarShape ( CircleShape );
			$barLayerObj->setUseYAxis2 ();
			$c->xAxis->setLabelStep(5);
	# Output the chart
	header("Content-type: image/png");
	print($c->makeChart2(PNG));
	exit;
	}
	}
    
    function market_yield()
    {
        //Configure::write('debug',3);
        if (! $this->Session->check ( 'Auth.User' )) {
            $this->Session->setFlash ( 'You are not authorized to access that location.' );
            $this->redirect ( array ('controller' => 'users', 'action' => 'login' ) );
        }
        
        $this->layout = 'default-one';
        $this->pageTitle = 'Market Yield for Dhaka stock exchange';
        $this->set("meta_description", "Calculate what market yield or dividend yield and pay out ratio");
        $this->set("meta_keywords", "Dividend yield, payout ratio");

        
        $SymbolArr = $this->Symbol->find('all', array ('conditions' => array ('inactive=\'No\' AND otc_market=\'No\'' ), 'fields' => array ('id','dse_code','lasttradeprice','face_value','yclose','bonus_issue','right_issue','q1','q2','q3','q4')));
        
        $querystr="SELECT DISTINCT(symbol),code,value,date FROM `corporate_action` WHERE `active`=1 AND action='cashdiv' ORDER BY `datestamp` ASC";
        $corporateAction = $this->Symbol->query($querystr);
        
        $corporateActionArr = array();
        foreach($corporateAction as $action)
        {
            $symbol = $action['corporate_action']['symbol'];
            $corporateActionArr[$symbol]['id'] = $action['corporate_action']['symbol']; 
            $corporateActionArr[$symbol]['name'] = $action['corporate_action']['code'];
            $corporateActionArr[$symbol]['dividend'] = $action['corporate_action']['value'];
            $corporateActionArr[$symbol]['date'] = $action['corporate_action']['date'];
        }
        /*pr($corporateActionArr);
        die;*/
        
        
        $total_infoArr = array();
        foreach ($SymbolArr as $arr)
        {
           $symbol = $arr['Symbol']['id'];
           if(!empty($corporateActionArr[$symbol]))
           { 
               $q1 = $arr['Symbol']['q1'];
               $q2 = $arr['Symbol']['q2'];
               $q3 = $arr['Symbol']['q3'];
               $q4 = $arr['Symbol']['q4'];
               $qeps = 0;
               $factor = 1;

                if ($q1) {

                    $qeps = $q1;

                    $factor = 4;

                }

                if ($q2) {

                    $qeps = $q2;

                    $factor = 2;

                }

                if ($q3) {

                    $qeps = $q3;

                    $factor = 4 / 3;

                }

                if ($q4) {

                    $qeps = $q4;

                    $factor = 1;

                }
               $annualizedEPS = $qeps * $factor;
               
               if(isset($_GET['alphsort']) && $_GET['alphsort']!='')
                    {
                       $total_infoArr[$symbol]['code'] = $arr['Symbol']['dse_code'];
                    }
               if(isset($_GET['divsort']) && $_GET['divsort']!='')
                    {
                        if(($arr['Symbol']['face_value']== 10) ||($arr['Symbol']['face_value']== 10.0))
                            $dividend = $corporateActionArr[$symbol]['dividend']/10;
                        else
                            $dividend = $corporateActionArr[$symbol]['dividend'];
                       
                        $total_infoArr[$symbol]['yield'] = ($dividend/$arr['Symbol']['lasttradeprice'])*100;
                       
                    }
               if(isset($_GET['paysort']) && $_GET['paysort']!='')
                    {
                        if(($arr['Symbol']['face_value']== 10) ||($arr['Symbol']['face_value']== 10.0))
                            $dividend = $corporateActionArr[$symbol]['dividend']/10;
                        else
                            $dividend = $corporateActionArr[$symbol]['dividend'];
                            $total_infoArr[$symbol]['payout'] = ($dividend/$annualizedEPS)*100;
                    }
               
               
               $total_infoArr[$symbol]['dividend_value'] = $corporateActionArr[$symbol]['dividend']; 
               $total_infoArr[$symbol]['code'] = $arr['Symbol']['dse_code'];
               $total_infoArr[$symbol]['facevalue'] = $arr['Symbol']['face_value'];
               $total_infoArr[$symbol]['lasttradeprice'] = $arr['Symbol']['lasttradeprice'];
               $total_infoArr[$symbol]['dividend_value'] = $corporateActionArr[$symbol]['dividend']; 
               if(($arr['Symbol']['face_value']== 10) ||($arr['Symbol']['face_value']== 10.0))
                $dividend = $corporateActionArr[$symbol]['dividend']/10;
               else
                $dividend = $corporateActionArr[$symbol]['dividend'];
               
               $total_infoArr[$symbol]['yield'] = ($dividend/$arr['Symbol']['lasttradeprice'])*100;
               $total_infoArr[$symbol]['payout'] = ($dividend/$annualizedEPS)*100;
               $total_infoArr[$symbol]['declaration_date'] = $corporateActionArr[$symbol]['date'];
               $total_infoArr[$symbol]['eps'] = $annualizedEPS;
               
           }
        }
        
        if (isset($_GET['alphsort']) && $_GET['alphsort']!='') {
            
            if($_GET['alphsort'] == 'alphasc')
            {
                
                $alphsort = 'alphdesc';    
                asort($total_infoArr);
                $this->set('alphsort',$alphsort);
            }
            elseif($_GET['alphsort'] == 'alphdesc')
            {
                
                $alphsort = 'alphasc';
                arsort($total_infoArr);
                $this->set('alphsort',$alphsort);
            }
        } 
        
        
        if (isset($_GET['divsort']) && $_GET['divsort']!='') {
            
            if($_GET['divsort'] == 'divasc')
            {
               $contsort = 'divdesc';    
               asort($total_infoArr);
               $this->set('divsort',$contsort);
            }
            elseif($_GET['divsort'] == 'divdesc')
            {
               $contsort = 'divasc';
               arsort($total_infoArr);
               $this->set('divsort',$contsort);
            }
        }  
       //pr($total_change);
      // die;
        if (isset($_GET['paysort']) && $_GET['paysort']!='') {
            
            if($_GET['paysort'] == 'payasc')
            {
                
                $sort = 'paydesc';    
                asort($total_infoArr);
                $this->set('paysort',$sort);
            }
            elseif($_GET['paysort'] == 'paydesc')
            {
               
                $sort = 'payasc';
                arsort($total_infoArr);
                $this->set('paysort',$sort);
            }
        }
        
        // pr($total_infoArr);
        // die;
        $this->set('dividend_yield',$total_infoArr);
   
 }
 
 function peg_ratio()
 {
     //Configure::write('debug',3);
     //set_time_limit(0);
     if (! $this->Session->check ( 'Auth.User' )) {
            $this->Session->setFlash ( 'You are not authorized to access that location.' );
            $this->redirect ( array ('controller' => 'users', 'action' => 'login' ) );
        }
     $this->layout = 'default-one';
     $this->pageTitle = 'Stock Bangladesh :: Price Earning Growth Ratio';
     $symbolArr = $this->Symbol->find('all', array ('conditions' => array ('inactive=\'No\' AND otc_market=\'No\' AND business_segment!=\'Mutual Funds\' AND business_segment!=\'Corporate Bond\' AND corporate_declaration_restriction = 0 AND category!=\'Z\' ' ), 'fields' => array ('id','dse_code','lasttradeprice','face_value','yclose','bonus_issue','right_issue','q1','q2','q3','q4'), 'order'=>'id ASC'));
     
     $performanceSql = "SELECT fin_year, symbol_id,code,earning_per_share FROM company_financial_performance WHERE earning_per_share!='' AND fin_year >=2008 ORDER BY symbol_id ASC";
     $performanceArr = $this->Symbol->query($performanceSql);
     
     foreach($performanceArr as $arr)
     {
        $symbol_id = $arr['company_financial_performance']['code'];
        $performance[$symbol_id][] = $arr;
     }
     
     $outerloopcount = 0;
     foreach($performance as $symbol=>$newArr)
     {
         $total_diff = 0;
         $outerloopcount++;
         arsort($newArr); ///sorted by financial year DESC
         $prevEPS = 0;
         $count =0;
         foreach($newArr as $arr)
         {
             //$outerloopcount++;
             if($prevEPS == 0)
             {
                 $EPSforPE[$symbol] = (float)$arr['company_financial_performance']['earning_per_share'];
                 $EPS = (float)$arr['company_financial_performance']['earning_per_share'];
             }
             if($prevEPS!=0)
             {
                $count++;
                $total_year[$symbol] = $count;
                $year = $arr['company_financial_performance']['fin_year'];
                $EPS = (float)$arr['company_financial_performance']['earning_per_share'];
                
                if($EPS > (5*$prevEPS))
                {
                   $EPS = $EPS/10;
                }
                $diff[$symbol] = (($prevEPS - $EPS)/$EPS)*100; 
             }
             $prevEPS = $EPS;
             if($count == 1)
             break;
         }
         
     }
     
      foreach ($symbolArr as $arr){
            
           $symbol = $arr['Symbol']['dse_code'];
           if(!empty($diff[$symbol])){               
               if($EPSforPE[$symbol] ==0)
               $pe[$symbol] = 0;
               else
               $pe[$symbol] = $arr['Symbol']['lasttradeprice'] / $EPSforPE[$symbol];
               if (isset($_GET['alphsort']) && $_GET['alphsort']!='')
               {
                  $PEGratio[$symbol]['name']     =  $symbol;
                  $PEGratio[$symbol]['pegratio'] =  $pe[$symbol]/$diff[$symbol];
               }
               if (isset($_GET['paysort']) && $_GET['paysort']!='')
               {
                  $PEGratio[$symbol]['pegratio'] =  $pe[$symbol]/$diff[$symbol];
                  $PEGratio[$symbol]['name']     =  $symbol;
               }
               $PEGratio[$symbol]['pegratio'] =  $pe[$symbol]/$diff[$symbol];
               $PEGratio[$symbol]['name']     =  $symbol;
               
           }
        }
     
     /*pr($PEGratio);
     die;*/
     if (isset($_GET['paysort']) && $_GET['paysort']!='') {
            
            if($_GET['paysort'] == 'payasc')
            {
                $sort = 'paydesc';    
                asort($PEGratio);
                $this->set('paysort',$sort);
            }
            elseif($_GET['paysort'] == 'paydesc')
            {
               
                $sort = 'payasc';
                arsort($PEGratio);
                $this->set('paysort',$sort);
            }
        }
     if (isset($_GET['alphsort']) && $_GET['alphsort']!='') {
            
            if($_GET['alphsort'] == 'alphasc')
            {
                
                $alphsort = 'alphdesc';    
                asort($PEGratio);
                $this->set('alphsort',$alphsort);
            }
            elseif($_GET['alphsort'] == 'alphdesc')
            {
                
                $alphsort = 'alphasc';
                arsort($PEGratio);
                $this->set('alphsort',$alphsort);
            }
        }
        
     
     $this->set('PEGratio',$PEGratio);
    //die; 
 }
 
 function sector_beta($sector = '')
    {
        //Configure::write('debug',3);
        if (! $this->Session->check ( 'Auth.User' )) {
            $this->Session->setFlash ( 'You are not authorized to access that location.' );
            $this->redirect ( array ('controller' => 'users', 'action' => 'login' ) );
        }
        $this->layout = 'default-one';
        $this->pageTitle = 'Stock Bangladesh :: Beta Coefficient';
        
        $sectorArr = $this->Symbol->find ( 'all', array ('conditions' => array ('inactive= \'No\' AND otc_market= \'No\' AND business_segment!=\'\''), 'fields' => array ('DISTINCT Symbol.business_segment') ) );
        
        foreach($sectorArr as $arr)
        {
            
            $sec_name = $arr['Symbol']['business_segment'];
            
            $sec_name = str_replace("&","and",$sec_name);            
            $sectors[]['business_segment'] = $sec_name;
            
            
        }
        if($sector=='')
         {
           $sector='Bank';
         }
        $this->set('sectors',$sectors);
        $this->set('key',$sector);
        
        $sector = str_replace("and","&",$sector);
       
         
        $dateArr = $this->MarketSummery->find('all', array('fields' => array('date','dgen','cap_equity'),'order' => array('id DESC'),'limit'=>1));
        $lastdate = $dateArr [0] ['MarketSummery'] ['date']; 
        
        $SymbolArr = $this->Symbol->find( 'all', array ('conditions' => array ('business_segment ="'.$sector.'" AND inactive=\'No\' AND otc_market=\'No\'' ), 'fields' => array ('id','dse_code','lasttradeprice','no_of_securities' ) ) );
        //pr($SymbolArr);
        
        
        $total_info = array();
        $sectorwise_marketCap = array();
        $mcapSector =0;
        foreach($SymbolArr as $symbol)
        {
            $sym = $symbol['Symbol']['id'] ;
            $individual_mcap[$sym] =  $symbol['Symbol']['lasttradeprice']*$symbol['Symbol']['no_of_securities'];
            $mcap = $symbol['Symbol']['lasttradeprice']*$symbol['Symbol']['no_of_securities'];     
            $beta_info = $this->__betacoefficient($sym);
            $individual_beta[$sym] = $beta_info[$sym]['beta'];
            $mcapSector += $mcap;
            $sectorwise_marketCap = $mcapSector; 
        }
        
        
        $individual_weight_beta = 0;
        foreach($individual_mcap as $symbol=>$mcapital)
        {
           $individual_weight_beta += ($mcapital/$sectorwise_marketCap)*$individual_beta[$symbol] ;
        }
        $sectoral_beta = $individual_weight_beta ;
        
        /*$upsql = "UPDATE `newspaper_sector_pe` SET `sector_beta` = ".$sectoral_beta." WHERE `sector` ='".$sector."' ";
        mysql_query($upsql) or die(mysql_error().$upsql);*/
       
        $updatefor_sbsector_summeries = "UPDATE `sbsector_summeries` SET `sector_beta` = ".$sectoral_beta." WHERE `date_time` LIKE'%".$lastdate."%' AND sector='$sector' ";
        $this->Symbol->query($updatefor_sbsector_summeries);
           
       $this->set('sector_beta',$sectoral_beta);
       $this->set('individual_beta',$individual_beta);
       $this->set('symbolarray',$SymbolArr);  
    }
    
    function sector_pe($category = 'category') {
        if (! $this->Session->check ( 'Auth.User' )) {
            $this->Session->setFlash ( 'You are not authorized to access that location.' );
            $this->redirect ( array ('controller' => 'users', 'action' => 'login' ) );
        }
        set_time_limit(0);
        //Configure::write('debug',3);
        $this->layout = 'default-one';
        $this->pageTitle = 'Latest sectoral P/E of Dhaka stock exchange';
        $this->set("meta_description", "Calculate live sectoral P/E for DSE");
        $this->set("meta_keywords", "sector P/E");
        
        $sectorArr = $this->Symbol->find('all', array ('conditions' => array ('inactive= \'No\' AND otc_market= \'No\' AND business_segment!=\'\''), 'fields' => array ('DISTINCT Symbol.business_segment') ) );
        
        foreach($sectorArr as $arr){
            $sec_name = $arr['Symbol']['business_segment'];
            
			if($sec_name == 'Food & Allied' ){
             	$sec_name = 'Food and Allied'; 
            }
            elseif($sec_name == 'Fuel & Power'){
             	$sec_name = 'Fuel and Power';             
            }
            elseif($sec_name == 'Pharmaceuticals & Chemicals' ){
             	$sec_name = 'Pharmaceuticals and Chemicals';
            }
            elseif($sec_name == 'Services & Real Estate' ){
             	$sec_name = 'Services and Real Estate';             
            }
            elseif($sec_name == 'Paper & Printing' ){
             	$sec_name = 'Paper and Printing';
            }
            elseif($sec_name == 'Travel & Leisure' ){
             	$sec_name = 'Travel and Leisure';
            }
            $sectors[]['business_segment'] = $sec_name;
        }
        
		if($sector==''){
           $sector='Bank';
         }
        $this->set('sectors',$sectors);
        $this->set('key',$sector);
            if($sector == 'Food and Allied'){
             	$sector = 'Food & Allied'; 
            }
            elseif($sector == 'Fuel and Power'){
             	$sector = 'Fuel & Power';             
            }
            elseif($sector == 'Pharmaceuticals and Chemicals'){
             	$sector = 'Pharmaceuticals & Chemicals';             
            }
            elseif($sector == 'Services and Real Estate'){
             	$sector = 'Services & Real Estate';             
            }
            elseif($sector == 'Paper and Printing'){
             	$sector = 'Paper & Printing';             
            }
            elseif($sector == 'Travel and Leisure'){
             	$sector = 'Travel & Leisure';             
            } 
    
       $SymbolArr = $this->Symbol->find( 'all', array ('conditions' => array ('inactive=\'No\' AND otc_market=\'No\'  AND corporate_declaration_restriction=0  AND category!=\'Z\' ' ), 'fields' => array ('id','dse_code','lasttradeprice','no_of_securities','business_segment','q1','q2','q3','q4','category')));//'business_segment ="'.$sector.'" AND 
    
	//    print_r($SymbolArr);
        /*PE Data*****************************************************************/
        $dataArray=array();
        $eps=0;
        $market_cap=0;
        $market_eps=0;
		
        foreach($sectorArr as $sector){
        if($sector["Symbol"]["business_segment"]!="Mutual Funds" && $sector["Symbol"]["business_segment"]!="Corporate Bond" ){
        $dataArray[$sector["Symbol"]["business_segment"]]["price_share"]=0;
        $dataArray[$sector["Symbol"]["business_segment"]]["eps_share"]=0;
            foreach($SymbolArr as $symbol){
                if($sector["Symbol"]["business_segment"]==$symbol["Symbol"]["business_segment"]){
                    
					if($symbol["Symbol"]["q4"]!=0)$eps=(float)$symbol["Symbol"]["q4"];
                    else if($symbol["Symbol"]["q3"]!=0)$eps=(float)$symbol["Symbol"]["q3"]*(4/3);
                    else if($symbol["Symbol"]["q2"]!=0)$eps=(float)$symbol["Symbol"]["q2"]*2;
                    else if($symbol["Symbol"]["q1"]!=0)$eps=(float)$symbol["Symbol"]["q1"]*4;
                    
					//$symbol["Symbol"]["dse_code"].' '.$eps;
                    $dataArray[$sector["Symbol"]["business_segment"]]["price_share"]+=$symbol["Symbol"]["lasttradeprice"]*$symbol["Symbol"]["no_of_securities"];
                    $dataArray[$sector["Symbol"]["business_segment"]]["eps_share"]+=$symbol["Symbol"]["no_of_securities"]*$eps;
                    $market_cap+=$symbol["Symbol"]["lasttradeprice"]*$symbol["Symbol"]["no_of_securities"];
                    $market_eps+=$symbol["Symbol"]["no_of_securities"]*$eps;
                }
            }
        }
        }
		
		//print_r($dataArray);
        $selectSQl = "SELECT * FROM newspaper_sector_pe WHERE active = 1";
        $selectQry = mysql_query($selectSQl);
        
        $dateArr = $this->MarketSummery->find('all', array('fields' => array('date','dgen','cap_equity'),'order' => array('id DESC'),'limit'=>1));
        $lastdate = $dateArr [0] ['MarketSummery'] ['date']; 
        /*if(mysql_num_rows($selectQry)) 
        {
            foreach($dataArray AS $sectNm => $insData)
            {
                $upsql = "UPDATE `newspaper_sector_pe` SET `sector_pe` = ".($insData['price_share']/$insData['eps_share']).", `sector_cap` = ".$insData['price_share'].", `sector_earning` = ".$insData['eps_share'].", `date` = '".date("d-m-Y",time())."' WHERE `sector` ='".$sectNm."' ";
                mysql_query($upsql) or die(mysql_error().$upsql);
                
                $updatefor_sbsector_summeries = "UPDATE `sbsector_summeries` SET `sector_pe` = ".($insData['price_share']/$insData['eps_share']).", `sector_earning` = ".$insData['eps_share']." WHERE `date_time` LIKE'%".$lastdate."%' AND sector='$sector' ";
                $this->Symbol->query($updatefor_sbsector_summeries);
           
            }
            
        }
        else
        {
            foreach($dataArray AS $sectNm => $insData)
            {
                $inssql = "INSERT INTO `newspaper_sector_pe` (`sector`, `sector_pe`, `sector_cap`, `sector_earning`, `date`) VALUES ('".$sectNm."',".($insData['price_share']/$insData['eps_share']).",".$insData['price_share'].",".$insData['eps_share'].",'".date("d-m-Y",time())."')";
                mysql_query($inssql) or die(mysql_error().$inssql);
            }
            
        } */
        
        foreach($dataArray AS $sectNm => $insData){
			$updatefor_sbsector_summeries = "UPDATE `sbsector_summeries` SET `sector_pe` = ".($insData['price_share']/$insData['eps_share']).", `sector_earning` = ".$insData['eps_share']." WHERE `date_time` LIKE'%".$lastdate."%' AND sector='$sectNm' ";
                $this->Symbol->query($updatefor_sbsector_summeries);
            } 
        /*PE Data END****************************************************************/
       
       $pearray = array();
       foreach($dataArray as $sector=>$sectorData){
           $pearray[$sector]['pe']          = $sectorData['price_share']/$sectorData['eps_share'];
           $pearray[$sector]['sector']      = $sector;
           $pearray[$sector]['price_share'] = $sectorData['price_share'];
           $pearray[$sector]['eps_share']   = $sectorData['eps_share'];
       }
      if($_GET['pesort'] == 'peasc')
            {
                $sort = 'pedesc';
                asort($pearray);    
                $this->set('sector_pe',$pearray);
                $pelist = $this->Symbol->query($peSql);
                $this->set('pesort',$sort);
            }
        else if($_GET['pesort'] == 'pedesc')
            {
                $sort = 'peasc';    
                arsort($pearray);
                $this->set('sector_pe',$pearray);
                $this->set('pesort',$sort);
            }
        else
        {
            $this->set('sector_pe',$pearray);     
        }
        
       $this->set("market_pe",number_format($market_cap/$market_eps, 2));
       $this->set('individual_beta',$individual_beta);
       $this->set('symbolarray',$SymbolArr);
    }
	
	function get_pe(){
		$SymbolArr = $this->Symbol->find( 'all', array('conditions' => array('inactive=\'No\' AND otc_market=\'No\'  AND corporate_declaration_restriction=0  AND category!=\'Z\' ' ), 'fields' => array ('id','dse_code','lasttradeprice','no_of_securities','business_segment','q1','q2','q3','q4','category')));//'business_segment ="'.$sector.'" AND 
    
		/* PE Data *****************************************************************/
		$dataArray=array();
		$eps=0;
		$market_cap=0;
		$market_eps=0;
		 $sectorArr = $this->Symbol->find('all', array ('conditions' => array ('inactive= \'No\' AND otc_market= \'No\' AND business_segment!=\'\''), 'fields' => array ('DISTINCT Symbol.business_segment') ) );
        
        foreach($sectorArr as $arr){
            $sec_name = $arr['Symbol']['business_segment'];
            
			if($sec_name == 'Food & Allied' ){
             	$sec_name = 'Food and Allied'; 
            }
            elseif($sec_name == 'Fuel & Power'){
             	$sec_name = 'Fuel and Power';             
            }
            elseif($sec_name == 'Pharmaceuticals & Chemicals' ){
             	$sec_name = 'Pharmaceuticals and Chemicals';
            }
            elseif($sec_name == 'Services & Real Estate' ){
             	$sec_name = 'Services and Real Estate';             
            }
            elseif($sec_name == 'Paper & Printing' ){
             	$sec_name = 'Paper and Printing';
            }
            elseif($sec_name == 'Travel & Leisure' ){
             	$sec_name = 'Travel and Leisure';
            }
            $sectors[]['business_segment'] = $sec_name;
        }
        
		if($sector==''){
           $sector='Bank';
         }
        $this->set('sectors',$sectors);
        $this->set('key',$sector);
            if($sector == 'Food and Allied'){
             	$sector = 'Food & Allied'; 
            }
            elseif($sector == 'Fuel and Power'){
             	$sector = 'Fuel & Power';             
            }
            elseif($sector == 'Pharmaceuticals and Chemicals'){
             	$sector = 'Pharmaceuticals & Chemicals';             
            }
            elseif($sector == 'Services and Real Estate'){
             	$sector = 'Services & Real Estate';             
            }
            elseif($sector == 'Paper and Printing'){
             	$sector = 'Paper & Printing';             
            }
            elseif($sector == 'Travel and Leisure'){
             	$sector = 'Travel & Leisure';             
            }
			   
		foreach($sectorArr as $sector){
		    if($sector["Symbol"]["business_segment"]!="Mutual Funds" && $sector["Symbol"]["business_segment"]!="Corporate Bond" ){
				  $dataArray[$sector["Symbol"]["business_segment"]]["price_share"]=0;
				  $dataArray[$sector["Symbol"]["business_segment"]]["eps_share"]=0;
			  foreach($SymbolArr as $symbol){
				if($sector["Symbol"]["business_segment"]==$symbol["Symbol"]["business_segment"]){
				    if($symbol["Symbol"]["q4"]!=0) $eps=(float)$symbol["Symbol"]["q4"];
					   else if($symbol["Symbol"]["q3"]!=0) $eps=(float)$symbol["Symbol"]["q3"]*(4/3);
					   else if($symbol["Symbol"]["q2"]!=0) $eps=(float)$symbol["Symbol"]["q2"]*2;
					   else if($symbol["Symbol"]["q1"]!=0) $eps=(float)$symbol["Symbol"]["q1"]*4;
    
				     //$symbol["Symbol"]["dse_code"].' '.$eps;
				    $dataArray[$sector["Symbol"]["business_segment"]]["price_share"]+=$symbol["Symbol"]["lasttradeprice"]*$symbol["Symbol"]["no_of_securities"];
				    $dataArray[$sector["Symbol"]["business_segment"]]["eps_share"]+=$symbol["Symbol"]["no_of_securities"]*$eps;
				    $market_cap+=$symbol["Symbol"]["lasttradeprice"]*$symbol["Symbol"]["no_of_securities"];
				    $market_eps+=$symbol["Symbol"]["no_of_securities"]*$eps;
				}
			  }
		    }
		} // end of foreach loop
		Configure::write('debug',3);
		$this->set("market_pe", number_format($market_cap/$market_eps, 2));
		echo $market_cap."<br/>";
		echo $market_eps."<br/>";
		echo("Today's Market PE is: ".number_format($market_cap/$market_eps, 2));
		//die();
	 } // end of get_pe() function
	
function category_pe($category = 'category') {
    if (! $this->Session->check ( 'Auth.User' )) {
            $this->Session->setFlash ( 'You are not authorized to access that location.' );
            $this->redirect ( array ('controller' => 'users', 'action' => 'login' ) );
        }
        set_time_limit(0);
        //Configure::write('debug',3);
        $this->layout = 'default-one';
        $this->pageTitle = 'Latest category P/E of Dhaka stock exchange';
        $this->set("meta_description", "Calculate live category P/E for DSE");
        $this->set("meta_keywords", "category P/E");

        
        $categoryArr = $this->Symbol->find ( 'all', array ('conditions' => array ('inactive= \'No\' AND otc_market= \'No\' AND business_segment!=\'\''), 'fields' => array ('DISTINCT Symbol.category') ) );
    
        $SymbolArr = $this->Symbol->find( 'all', array ('conditions' => array ('inactive=\'No\' AND otc_market=\'No\' AND business_segment!=\'Mutual Funds\' AND business_segment!=\'Corporate Bond\'   AND corporate_declaration_restriction=0' ), 'fields' => array ('id','dse_code','lasttradeprice','no_of_securities','business_segment','q1','q2','q3','q4','category' ) ) );//'business_segment ="'.$sector.'" AND 
        /*PE Data*****************************************************************/
        $dataArray=array();
        $eps=0;
        foreach($categoryArr as $sector){
        $dataArray[$sector["Symbol"]["category"]]["price_share"]=0;
        $dataArray[$sector["Symbol"]["category"]]["eps_share"]=0;
            foreach($SymbolArr as $symbol){
                if($sector["Symbol"]["category"]==$symbol["Symbol"]["category"]){
                    if($symbol["Symbol"]["q4"]!=0)$eps=(float)$symbol["Symbol"]["q4"];
                    else if($symbol["Symbol"]["q3"]!=0)$eps=(float)$symbol["Symbol"]["q3"]*(4/3);
                    else if($symbol["Symbol"]["q2"]!=0)$eps=(float)$symbol["Symbol"]["q2"]*2;
                    else if($symbol["Symbol"]["q1"]!=0)$eps=(float)$symbol["Symbol"]["q1"]*4;
                    //$symbol["Symbol"]["dse_code"].' '.$eps;
                    $dataArray[$sector["Symbol"]["category"]]["price_share"]+=$symbol["Symbol"]["lasttradeprice"]*$symbol["Symbol"]["no_of_securities"];
                    $dataArray[$sector["Symbol"]["category"]]["eps_share"]+=$symbol["Symbol"]["no_of_securities"]*$eps;
                }
            }
        }

        /*PE Data END****************************************************************/
       $this->set('sector_pe',$dataArray);
       $this->set('individual_beta',$individual_beta);
       $this->set('symbolarray',$SymbolArr);  
    }
    
    function individual_return($symbol = '')
    {
        if (! $this->Session->check ( 'Auth.User' )) {
            $this->Session->setFlash ( 'You are not authorized to access that location.' );
            $this->redirect ( array ('controller' => 'users', 'action' => 'login' ) );
        }
        //Configure::write('debug',3);
        $this->layout = 'default-one';
        $this->pageTitle = 'Stock Bangladesh :: Beta Coefficient';

        $this->set('key',$symbol);
        
        $dscgenArr = $this->Output->find ( 'all', array ('conditions' => array ('symbol = 1' ), 'fields' => array ('close', 'date' ), 'order' => 'id DESC','limit'=>520 ) );
        $dateWiseGeneralIndex = array();
        for($i = 0; $i < count($dscgenArr); $i++)
        {                    
            $dateWiseGeneralIndex[$dscgenArr[$i]['Output']['date']]   = $dscgenArr[$i]['Output']['close'];                    
        }
        
        $preindex = 0;
        $totalErm = 0;
        foreach($dateWiseGeneralIndex as $date=>$genindex)
        {
            if(($preindex!=0)&&($dateWiseGeneralIndex[$date]!=0))
                 {
                   $ERmValue = (($preindex-$dateWiseGeneralIndex[$date])/$dateWiseGeneralIndex[$date])*100;///calculate the return value
                   $ERmarray[] = $ERmValue;
                 }
            $preindex = $dateWiseGeneralIndex[$date];
            
        }
        $ERm= array_sum($ERmarray) / count($ERmarray); 
        
        $beta_info = $this->__betacoefficient($symbol);
        $individual_beta = $beta_info[$symbol]['beta'];
        $individual_return = .05+ (($ERm - .05)*$individual_beta);
        
        $this->set('individual_return',$individual_return);
        $this->set('individual_beta',$individual_beta);
        $this->set('market_return',$ERm);
        
        
    }
    
    function share_impact()
    {
        //Configure::write('debug',3);
        //set_time_limit(0);
        $this->layout = 'default-one';
        $this->pageTitle = 'Stock Bangladesh :: Share Impact';
        
        $dateArr = $this->MarketSummery->find('all', array('fields' => array('date','dgen','cap_equity'),'order' => array('id DESC'),'limit'=>2));
        $lastdayIndex = $dateArr[1]['MarketSummery']['dgen'];
        
        $lastdate = $dateArr [1] ['MarketSummery'] ['date'];
        $TindexData = $this->Symbol->query ( 'select id,symbol_id,close,date_time,lastprice from data_banks_intraday where symbol_id =3 AND date_time LIKE '."'$lastdate%'".' ORDER BY id DESC LIMIT 1' );
        $lastdayTindex = $TindexData[0]['data_banks_intraday']['lastprice'];
        
        $lastdayMcap = $dateArr[1]['MarketSummery']['cap_equity'];
        $lastdate = $dateArr [0] ['MarketSummery'] ['date'];
        $Mdate = explode("-",$lastdate);
        $Odate = $Mdate[2].'-'.$Mdate[1].'-'.$Mdate[0];
        
        $shareData = $this->Symbol->query ('select id,symbol_id,close,date_time,lastprice from data_banks_intraday where symbol_id =1 ORDER BY id DESC LIMIT 2');
        $last_dse_update = explode(' ',$shareData[0]['data_banks_intraday']['date_time']);
        $dsechange = $shareData[0]['data_banks_intraday']['lastprice'] - $lastdayIndex;
        
        
        $this->set('dse_update',$last_dse_update[1]);
        $this->set('dse_change',$dsechange);
        
        $start_date = date('d-m-Y',strtotime($dateArr[1]['MarketSummery']['date']));
        $startstamp = strtotime($start_date)-6*60*60;
        $end_date = date('d-m-Y',strtotime($dateArr[0]['MarketSummery']['date']));
        $endstamp = strtotime($end_date)-6*60*60;
        //pr($startstamp);
        
        
        $querystr="SELECT * FROM `corporate_action` WHERE `datestamp` >=$startstamp and `datestamp` <$endstamp  and`action`='stockdiv' and `active`=1 ORDER BY `datestamp` ASC";            
        $corporateAction = $this->Symbol->query($querystr);
       // pr($corporateAction);
        
        foreach($corporateAction as $row)
        {
            if($row['corporate_action']['action']=='stockdiv')
            {
                $adjustmentFactor[$row['corporate_action']['symbol']]['symbol']=$row['corporate_action']['symbol'];
                $adjustmentFactor[$row['corporate_action']['symbol']]['value']=(100+$row['corporate_action']['value'])/100;
            }
        }
        
        $sql = "SELECT * FROM outputs where date= '$Odate' and symbol>4 and volume!=0 ORDER BY id";
        $outputdata = $this->Symbol->query($sql);
        $outputarr = array();
        foreach($outputdata as $arr)
        {
            $symbol = $arr['outputs']['symbol'];
            $outputarr[$symbol] = $arr; 
        }
        
        $SymbolArr = $this->Symbol->find( 'all', array ('conditions' => array ('inactive=\'No\' AND otc_market=\'No\' AND business_segment!=\'Mutual Funds\' AND business_segment!=\'Corporate Bond\' AND category!=\'Z\'' ), 'fields' => array ('id','dse_code','lasttradeprice','yclose','no_of_securities','corporate_declaration_restriction','business_segment','share_percentage_public')));
        
        $lastdayMcap_public = 0;
        foreach($SymbolArr as $symbol)
        {
            
            if(($symbol['Symbol']['id']!=1) && ($symbol['Symbol']['corporate_declaration_restriction']!=1))
            {
                if(!empty($outputarr[$symbol['Symbol']['id']]))
                {
                $securities[$symbol['Symbol']['id']]         = $symbol['Symbol']['no_of_securities'];
                $public[$symbol['Symbol']['id']]             = $symbol['Symbol']['share_percentage_public'];
                $public_securities[$symbol['Symbol']['id']]  = ($securities[$symbol['Symbol']['id']]*$public[$symbol['Symbol']['id']])/100;
                
                 if(!empty($adjustmentFactor[$symbol['Symbol']['id']]))
                    {
                        $symbol['Symbol']['yclose'] = $symbol['Symbol']['yclose']/ $adjustmentFactor[$symbol['Symbol']['id']]['value'];
                    }                                                                                                      
                    $lastdayMcap_public += $public_securities[$symbol['Symbol']['id']]*$symbol['Symbol']['yclose'];
                    $todayMcap_public += $public_securities[$symbol['Symbol']['id']]*$symbol['Symbol']['lasttradeprice'];
                }
            }
            
        }     
        
        $total_information = array();
        $final_index = array();
        $index_change = array();
        $index_change_per = array();
        $total_change = 0;
        $total_price_change = 0;
        foreach($SymbolArr as $symbol)
        {
            
          if(($symbol['Symbol']['id']!=1) && ($symbol['Symbol']['corporate_declaration_restriction']!=1))
            
            {
                if(!empty($outputarr[$symbol['Symbol']['id']]))
                {  
                   $securities[$symbol['Symbol']['id']]       = $symbol['Symbol']['no_of_securities'];
                   if(!empty($adjustmentFactor[$symbol['Symbol']['id']]))
                    {
                        $symbol['Symbol']['yclose'] = $symbol['Symbol']['yclose']/ $adjustmentFactor[$symbol['Symbol']['id']]['value'];
                    }
                    $change[$symbol['Symbol']['id']]           =  $symbol['Symbol']['lasttradeprice'] - $symbol['Symbol']['yclose'];
                    $total_impact[$symbol['Symbol']['id']]     = $change[$symbol['Symbol']['id']]* $securities[$symbol['Symbol']['id']];
                    $increasedMcap[$symbol['Symbol']['id']]    = $lastdayMcap + $total_impact[$symbol['Symbol']['id']];
                    $final_index[$symbol['Symbol']['id']]      = ($lastdayIndex*$increasedMcap[$symbol['Symbol']['id']])/$lastdayMcap;
                    $index_change[$symbol['Symbol']['id']]     = $final_index[$symbol['Symbol']['id']]-$lastdayIndex;
                    $index_change_per[$symbol['Symbol']['id']] = ($final_index[$symbol['Symbol']['id']]-$lastdayIndex)/$lastdayIndex;
                    $total_change += $index_change[$symbol['Symbol']['id']];  
                    
                    if(isset($_GET['alphsort']) && $_GET['alphsort']!='')
                    {
                       $total_information[$symbol['Symbol']['id']]['name']     = $symbol['Symbol']['dse_code'];
                    }
                    if(isset($_GET['sectorsort']) && $_GET['sectorsort']!='')
                    {
                       $total_information[$symbol['Symbol']['id']]['sector']     = $symbol['Symbol']['business_segment'];
                    }
                    if(isset($_GET['contsort']) && $_GET['contsort']!='')
                    {
                       $total_information[$symbol['Symbol']['id']]['contribution']  = $index_change[$symbol['Symbol']['id']]/ abs($change[$symbol['Symbol']['id']]);
                    }
                    
                    
                    
                    
                    $total_contribution += $index_change[$symbol['Symbol']['id']]/ abs($change[$symbol['Symbol']['id']]); 
                    $total_information[$symbol['Symbol']['id']]['index_change']     = number_format($index_change[$symbol['Symbol']['id']],5);
                    $total_information[$symbol['Symbol']['id']]['index_per_change'] = number_format($index_change_per[$symbol['Symbol']['id']],6); 
                    $total_information[$symbol['Symbol']['id']]['contribution']     = $index_change[$symbol['Symbol']['id']]/ abs($change[$symbol['Symbol']['id']]);
                    $total_information[$symbol['Symbol']['id']]['sector']           = $symbol['Symbol']['business_segment'];
                    $total_information[$symbol['Symbol']['id']]['yclose']           = $symbol['Symbol']['yclose'];
                    $total_information[$symbol['Symbol']['id']]['lastprice']        = $symbol['Symbol']['lasttradeprice'];
                    $total_information[$symbol['Symbol']['id']]['change']           = $change[$symbol['Symbol']['id']];
                    $total_price_change += $change[$symbol['Symbol']['id']];
                   
                } 
            }
        }
        
        $traded_index = ($lastdayTindex* $todayMcap_public)/ $lastdayMcap_public;
       
        //pr($total_information);
       // die;
      if (isset($_GET['alphsort']) && $_GET['alphsort']!='') {
            
            if($_GET['alphsort'] == 'alphasc')
            {
                
                $alphsort = 'alphdesc';    
                asort($total_information);
                $this->set('alphsort',$alphsort);
            }
            elseif($_GET['alphsort'] == 'alphdesc')
            {
                
                $alphsort = 'alphasc';
                arsort($total_information);
                $this->set('alphsort',$alphsort);
            }
        } 
        
        if (isset($_GET['sectorsort']) && $_GET['sectorsort']!='') {
            
            if($_GET['sectorsort'] == 'sectorasc')
            {
               $sectorsort = 'sectordesc';    
               asort($total_information);
               $this->set('sectorsort',$sectorsort);
            }
            elseif($_GET['sectorsort'] == 'sectordesc')
            {
               $sectorsort = 'sectorasc';
               arsort($total_information);
               $this->set('sectorsort',$sectorsort);
            }
        }
        
        if (isset($_GET['contsort']) && $_GET['contsort']!='') {
            
            if($_GET['contsort'] == 'contasc')
            {
               $contsort = 'contdesc';    
               asort($total_information);
               $this->set('contsort',$contsort);
            }
            elseif($_GET['contsort'] == 'contdesc')
            {
               $contsort = 'contasc';
               arsort($total_information);
               $this->set('contsort',$contsort);
            }
        }  
       //pr($total_change);
      // die;
        if (isset($_GET['sort']) && $_GET['sort']!='') {
            
            if($_GET['sort'] == 'asc')
            {
                
                $sort = 'desc';    
                asort($total_information);
                $this->set('sort',$sort);
            }
            elseif($_GET['sort'] == 'desc')
            {
               
                $sort = 'asc';
                arsort($total_information);
                $this->set('sort',$sort);
            }
            
            $this->set('total_information',$total_information);
            
        }
        
        $this->set('total_change',$total_change);
        $this->set('total_price_change',$total_price_change);
        $this->set('total_contribution',$total_contribution);
        $this->set('last_index',$lastdayIndex);
        $this->set('public_index',$traded_index);
        $this->set('total_information',$total_information);
        
    }
    
    function sbindexcompare()
    {
        //Configure::write('debug',3);     
        require_once(WWW_ROOT . DS . 'chart'. DS .'phpchartdir.php');
        require_once(WWW_ROOT . DS . 'chart'. DS .'Image_Toolbox.class.php');
        
        $dateArr = $this->MarketSummery->find('all', array('fields' => array('date','dgen','cap_equity'),'order' => array('id DESC'),'limit'=>2));
        $lastdayIndex = $dateArr[1]['MarketSummery']['dgen']; 
        
        $lastdate = $dateArr [1] ['MarketSummery'] ['date'];
        $TindexData = $this->Symbol->query ( 'select id,symbol_id,close,date_time,lastprice from data_banks_intraday where symbol_id =3 AND date_time LIKE '."'$lastdate%'".' ORDER BY id DESC LIMIT 1' );
        $lastdayTindex = $TindexData[0]['data_banks_intraday']['lastprice'];
        //$lastdayTindex = 4884.44;
        /*pr($lastdayTindex);
        die;*/
        
        $current_time = strtotime(date('d-M-Y 11:00:04'));
        $end_time = strtotime(date('d-M-Y 15:10:04'));
        /*pr($current_time);
        pr($end_time);
        die;*/
        $querySQL = "SELECT * FROM `data_banks_intraday` WHERE `symbol_id` <=3 AND currenttime BETWEEN $current_time AND $end_time order by id asc" ;
        $graphData = $this->Symbol->query($querySQL);
        //pr($querySQL);
        //pr($graphData);
        //die;
        
        $dsegenArr = array();
        $trdgenArrtmp = array();
        $sbdsegenArrtmp = array();
        $dsecount = 1;
        foreach($graphData as $data)
          {
              $indexcode = $data['data_banks_intraday']['code'];
              
              if($indexcode == 'DSEGEN')
              {
                $grossValue      = $data['data_banks_intraday']['lastprice'] ;
                $dsegenArr[0]     = $lastdayIndex;
                $dsegenArr[$dsecount]   = $grossValue;
                $dsecount++;
                $dsegenArr[$dsecount]   = $grossValue;
                $dsecount++;
                $dsegenArr[$dsecount]   = $grossValue;
                $dsecount++;
                $dsegenArr[$dsecount]   = $grossValue;
                $dsecount++;
                $dsegenArr[$dsecount]   = $grossValue;
                $dsecount++;
                
                if($dsecount==250)
                {
                    break;
                }
              }
              if($indexcode == 'SBDSEGEN')
              {
                $sbdsegenArrtmp[]   = $data;
              }
              
              if($indexcode == 'TRDGEN')
              {
                $trdgenArrtmp[]    = $data;
              }
              
          }
          //pr($sbdsegenArrtmp);
         // die;
          $interval = 60;
          $timeWiseArrsb = array();
          foreach ( $sbdsegenArrtmp as $row ) {
                
                $currenttime = $row ['data_banks_intraday'] ['date'];
                $mod = $currenttime % $interval;
                $timeToBeAccounted = $currenttime - $mod + $interval;
                $timeWiseArrsb [$timeToBeAccounted] [] = $row;
                $modtime = date ( 'd M  h:ia', $timeToBeAccounted );
            }
            
            $sbdsegenArr[0] = $lastdayIndex;
            foreach($timeWiseArrsb as $time=>$arr)
            {
                $sbdsegenArr[] = $arr[0]['data_banks_intraday']['lastprice'];
                $last_dse_update = explode(' ',$arr[0]['data_banks_intraday']['date_time']);
                $sbtime          = $last_dse_update[1];
                $dsiLabel[]      = $sbtime;
                
            }
            
          $timeWiseArrtrd = array();
          foreach ( $trdgenArrtmp as $row ) {
                
                $currenttime = $row ['data_banks_intraday'] ['date'];
                $mod = $currenttime % $interval;
                $timeToBeAccounted = $currenttime - $mod + $interval;
                $timeWiseArrtrd [$timeToBeAccounted] [] = $row;
                $modtime = date ( 'd M  h:ia', $timeToBeAccounted );
            }
            $trdgenArr[0] = $lastdayTindex;
            $count=0;
            foreach($timeWiseArrtrd as $time=>$arr)
            {
                $count++;
                if(($count==1) || ($count==2) || ($count==3))
                {
                    $trdgenArr[$count] = $lastdayTindex;
                }
                else
                {
                    $trdgenArr[] = $arr[0]['data_banks_intraday']['lastprice'];
                }
                
            }
          
            
       /* pr($dsegenArr);
        pr($sbdsegenArr);
        pr($trdgenArr);
        pr($dsiLabel);
        die;*/ 
        
           
        $c = new XYChart(700, 355);
        $c->setPlotArea(50, 25, 600, 250);

        $legendObj = $c->addLegend(55, 5, false, "", 8);
        $legendObj->setBackground(Transparent);
        
        $textBoxObj = $c->addText ( 100, 30, "www.stockbangladesh.org", "timesbi.ttf", 9, 0xc09090 );
        $textBoxObj->setAlignment ( TopLeft );

        # Add a title to the x axis
        $c->xAxis->setTitle("Index Comparison");
        
        # Add a title to the y axis
        $c->yAxis->setTitle("Index Compare");
        
        $c->xAxis->setLabelStyle ( "Arial", 8, TextColor, 90 );
        # Set the labels on the x axis.
        $c->xAxis->setLabels($dsiLabel);      
        
        /*$c->yAxis2->setTitle ( "VOLUME" );*/
        # set the axis, label and title colors for the primary y axis to green (0x008000) to
        # match the second data set
        
        //$c->yAxis2->setColors ( 0x008000);
        /*$c->yAxis2->setLabels($trdvolumeArr);
        $c->yAxis2->setLabelStep(5, 1);*/
        
        # Display 1 out of 2 labels on the x-axis. Show minor ticks for remaining labels.
        $c->xAxis->setLabelStep(10, 1);
        
        # Add three area layers, each representing one data set. The areas are drawn in
        # semi-transparent colors.
        /*$c->addAreaLayer($dArr, 0x8000ff00, date("Y-m-d",strtotime($graphData[0]["index"]["IDX_DATE_TIME"])).'('.$dArr[count($dArr)-1].')', 2);
        $c->addAreaLayer($dsiArr1, 0x808080ff, $last_trade_date.'('.$dsiArr1[count($dsiArr1)-1].')', 3);*/
        
        $c->addLineLayer($dsegenArr, 0x80EB0000, "DSE Index");
        $c->addLineLayer($sbdsegenArr, 0x800000B9, "SB Index");
        $c->addLineLayer($trdgenArr, 0x80018F00, "Trd. Index");    
        
        /*$barLayerObj = $c->addBarLayer3 ($trdvolumeArr,"","volume",2);
        $barLayerObj -> setBarShape (CircleShape );*/
        //$barLayerObj ->setUseYAxis2 ();
        
        # Output the chart
       /* header("Content-type: image/png");
        print($c->makeChart2(PNG));
        exit;*/
        $chartData=$c->makeChart2(PNG);
        
        $chartImagePath = WWW_ROOT . 'chart'. DS . 'sbindexchart.png';
        $f = fopen($chartImagePath, "wb");
        fwrite($f, $chartData);
        fclose($f);
        $img = new Image_Toolbox($chartImagePath);
        $width=$img->_img['main']['width'];
        $img->addImage($width,10,'#ffffff');
        $img->blendMask('left','bottom',IMAGE_TOOLBOX_BLEND_COPY, 0, 345);
        $img->output();
    }
    
    function trdvolumecompare()
    {
        //Configure::write('debug',3);     
        App::import('Vendor', 'Phpchartdir', array('file' => 'phpchartdir.php'));        
        require_once(WWW_ROOT . DS . 'chart'. DS .'Image_Toolbox.class.php');
        
        $current_time = strtotime(date('d-M-Y 11:26:04'));
        $end_time = strtotime(date('d-M-Y 15:10:04'));
          
        $querySQL = "SELECT volume,date,lastprice FROM `data_banks_intraday` WHERE `symbol_id` = 3 and currenttime BETWEEN $current_time AND $end_time order by id asc " ;
        $graphData = $this->Symbol->query($querySQL);
        $sbdsegenArr    = array();
        $trdgenArr = array();
        $interval = 60;
        foreach ( $graphData as $row ) {
                
                $currenttime = $row ['data_banks_intraday'] ['date'];
                $mod = $currenttime % $interval;
                $timeToBeAccounted = $currenttime - $mod + $interval;
                //echo date('h:i A', $timeToBeAccounted).'<br><br>';
                $timeWiseArr [$timeToBeAccounted] [] = $row;
                $modtime = date ( 'd M  h:ia', $timeToBeAccounted );
            }
            
        //pr($timeWiseArr);
        //die;
        
        $count = 0;
        foreach($timeWiseArr as $time=>$arr)
        {
            //$count = count($arr);
            /*$start_volume = $arr[0]['data_banks_intraday']['volume'];
            $end_volume = $arr[$count-1]['data_banks_intraday']['volume'];*/
            $trdvolumeArr[] = $arr[0]['data_banks_intraday']['volume']/100000000;
            $dsiLabel[] = date('h:i:s',$time);
            
        }
        /*pr($trdvolumeArr);
        pr($dsiLabel);
        die;*/
        
        $c = new XYChart(700, 355);
        $c->setPlotArea(60, 25, 600, 250);

        $legendObj = $c->addLegend(55, 5, false, "", 8);
        $legendObj->setBackground(Transparent);
        
        $textBoxObj = $c->addText ( 100, 30, "www.stockbangladesh.org", "timesbi.ttf", 9, 0xc09090 );
        $textBoxObj->setAlignment ( TopLeft );

        # Add a title to the x axis
        $c->xAxis->setTitle("Time");
        
        # Add a title to the y axis
        $c->yAxis->setTitle("Traded Market Cap.(mn)");
        
        $c->xAxis->setLabelStyle ( "Arial", 8, TextColor, 90 );
        # Set the labels on the x axis.
        $c->xAxis->setLabels($dsiLabel);   
        
        # set the axis, label and title colors for the primary y axis to green (0x008000) to
        # match the second data set
        
        //$c->yAxis2->setColors ( 0x008000);
        //$c->yAxis2->setLabels($trdvolumeArr);
        //$c->yAxis2->setLabelStep(5, 1);
        
        # Display 1 out of 2 labels on the x-axis. Show minor ticks for remaining labels.
        $c->xAxis->setLabelStep(5, 1);
        
        # Add three area layers, each representing one data set. The areas are drawn in
        # semi-transparent colors.
        /*$c->addAreaLayer($dArr, 0x8000ff00, date("Y-m-d",strtotime($graphData[0]["index"]["IDX_DATE_TIME"])).'('.$dArr[count($dArr)-1].')', 2);
        $c->addAreaLayer($dsiArr1, 0x808080ff, $last_trade_date.'('.$dsiArr1[count($dsiArr1)-1].')', 3);*/
        
        /*$c->addLineLayer($dsegenArr, 0x80EB0000, "DSE Index",4);
        $c->addLineLayer($sbdsegenArr, 0x800000B9, "SB Index",4);
        $c->addLineLayer($trdgenArr, 0x80018F00, "Trd. Index",4);    */
        
        $barLayerObj = $c->addBarLayer3 ($trdvolumeArr,"","volume");
        $barLayerObj -> setBarShape (CircleShape);
        //$barLayerObj ->setUseYAxis2 ();
        
        # Output the chart
        /*header("Content-type: image/png");
        print($c->makeChart2(PNG));
        exit;*/
        $chartData=$c->makeChart2(PNG);
        
        $chartImagePath = WWW_ROOT . 'chart'. DS . 'sbvolumechart.png';
        $f = fopen($chartImagePath, "wb");
        fwrite($f, $chartData);
        fclose($f);
        $img = new Image_Toolbox($chartImagePath);
        $width=$img->_img['main']['width'];
        $img->addImage($width,10,'#ffffff');
        $img->blendMask('left','bottom',IMAGE_TOOLBOX_BLEND_COPY, 0, 345);
        $img->output();
    }
    
    function weeklycompare_($updateRequest = '') {

        App::import ( 'Vendor', 'Phpchartdir', array ('file' => 'phpchartdir.php' ) );

        require_once (WWW_ROOT . DS . 'chart' . DS . 'Image_Toolbox.class.php');
        
        $this->layout = 'default-one';
        $this->pageTitle = 'Stock Bangladesh :: Weekly Chart - Price Chart/ Graph';

        $inv = 60;
        $inv1 = 300;
        
        if (isset ( $updateRequest ['sym'] ) && $updateRequest ['sym'] != '')

        $_REQUEST ['TickerSymbol'] = $updateRequest ['sym'];

        if (isset ( $updateRequest ['inv'] ) && $updateRequest ['inv'] != '')

        $_REQUEST ['inv'] = $updateRequest ['inv'];



        if (isset ( $_REQUEST ['TickerSymbol'] )) {

            $this->layout = 'default-mainchart';

            $inv = $_REQUEST ['inv'];

            $symbolInfo = $this->Symbol->find ( 'first', array ('conditions' => array ('id=' . $_REQUEST ['TickerSymbol'] ), 'fields' => array ('Symbol.dse_code', 'Symbol.name' ) ) );

            $name = $symbolInfo ['Symbol'] ['name'];

            $name = ucwords ( strtolower ( $name ) );

            $this->pageTitle = 'Stock Bangladesh :: Weekly Chart #' . $name . '- Price Chart/ Graph';
            $this->set ( 'sym', $_REQUEST ['TickerSymbol'] );
            
            $symbol = $_REQUEST ['TickerSymbol'];

            $symbol = trim ( $symbol );
            $interval = $inv;
    
            $code = $symbolInfo ['Symbol'] ['dse_code'];

            $name = $symbolInfo ['Symbol'] ['name'];

            $minute = $interval / 60;
        
            if ($minute > 1) {

                $minute = $minute . ' Minutes Chart';

            } else {

                $minute = $minute . ' Minutes Chart';

            }



            $nameOfTheDay = date ( 'l' );

            if ($nameOfTheDay == 'Friday')

            $todayTimeStamp = mktime ( 0, 0, 0, date ( 'm' ), date ( 'd' ) - 1, date ( 'Y' ) );

            else if ($nameOfTheDay == 'Saturday')

            $todayTimeStamp = mktime ( 0, 0, 0, date ( 'm' ), date ( 'd' ) - 2, date ( 'Y' ) );

            else

            $todayTimeStamp = mktime ( 0, 0, 0, date ( 'm' ), date ( 'd' ), date ( 'Y' ) );

            
            $todayTimeStamp = $todayTimeStamp - 3 * 24 * 60 * 60;



            $shareData = $this->Symbol->query ( 'select id,lastprice,volume,date from data_banks_intraday where symbol_id =' . $symbol . ' ORDER BY id DESC LIMIT 0, 1500' );
            
            $timeWiseArr = array ();

            $timeKeyArr = array ();



            $daywiseData = array ();



            foreach ( $shareData as $row ) {

                $currenttime = $row ['data_banks_intraday'] ['date'];

                $day = date ( 'D', $currenttime );



                $currenttime = $row ['data_banks_intraday'] ['date'];

                //$currenttime = $currenttime + (8*60*60);




                $mod = $currenttime % $interval;



                $timeToBeAccounted = $currenttime - $mod + $interval;

                $temp = $row;

                $temp ['date_time'] = date ( 'd M  h:ia', $timeToBeAccounted );

                $daywiseData [$day] [$timeToBeAccounted] [$currenttime] = $temp;



            }



            foreach ( $shareData as $row ) {

                $currenttime = $row ['data_banks_intraday'] ['date'];

                
                $mod = $currenttime % $interval;

                $timeToBeAccounted = $currenttime - $mod + $interval;

                $timeWiseArr [$timeToBeAccounted] [] = date ( 'd h:i A', $timeToBeAccounted );

                $timeWiseArr [$timeToBeAccounted] [] = $row;



                $modtime = date ( 'd M  h:ia', $timeToBeAccounted );

            }



            foreach ( $timeWiseArr as $key => $arr ) {

                $timeKeyArr [] = $key;

            }



            $summary = array ();

            foreach ( $daywiseData as $weekday => $data ) {

                foreach ( $data as $tradetime => $tradeArr ) {

                    $rowVolume = 0;

                    $volumePerInterval = 0;

                    $volume = 0;

                    foreach ( $tradeArr as $eachArr ) {

                        if ($rowVolume) {

                            $volume = $rowVolume - $eachArr ['data_banks_intraday'] ['volume'];

                            $volumePerInterval = $volume + $volumePerInterval;

                        }

                        $rowVolume = $eachArr ['data_banks_intraday'] ['volume'];

                        $rowLtp = $eachArr ['data_banks_intraday'] ['lastprice'];



                    }

                    $summary [$weekday] [$tradetime] ['volume'] = $volumePerInterval;

                    $summary [$weekday] [$tradetime] ['ltp'] = $rowLtp;

                    $summary [$weekday] [$tradetime] ['time'] = date ( 'h:i', $tradetime );

                    $summary [$weekday] [$tradetime] ['timestamp'] = $tradetime;

                }

            }



            $thuvol = array ();

            $thuprice = array ();

            $labels = array ();

            foreach ( $summary ['Thu'] as $day ) {

                $thuvol [] = $day ['volume'];

                $thuprice [] = $day ['ltp'];

                $labels [] = $day ['time'];

            }



            $wedvol = array ();

            $wedprice = array ();

            foreach ( $summary ['Wed'] as $day ) {

                $wedvol [] = $day ['volume'];

                $wedprice [] = $day ['ltp'];

            }



            $tuevol = array ();

            $tueprice = array ();

            foreach ( $summary ['Tue'] as $day ) {

                $tuevol [] = $day ['volume'];

                $tueprice [] = $day ['ltp'];

            }



            $monvol = array ();

            $monprice = array ();

            foreach ( $summary ['Mon'] as $day ) {

                $monvol [] = $day ['volume'];

                $monprice [] = $day ['ltp'];

            }



            $sunvol = array ();

            $sunprice = array ();

            foreach ( $summary ['Sun'] as $day ) {

                $sunvol [] = $day ['volume'];

                $sunprice [] = $day ['ltp'];

            }



            //exit;




            //$data0 = array(100, 125, 156, 147, 87, 124, 178, 109, 140, 106, 192, 122);
            //$data1 = array(122, 156, 179, 211, 198, 177, 160, 220, 190, 188, 220, 270);
            //$data2 = array(167, 190, 213, 267, 250, 320, 212, 199, 245, 267, 240, 310);
            //$labels = array("Jan", "Feb", "Mar", "Apr", "May", "Jun", "Jul", "Aug", "Sept","Oct", "Nov", "Dec");




            $data0 = array_reverse ( $thuvol );

            $data1 = array_reverse ( $wedvol );

            $data2 = array_reverse ( $tuevol );

            $data3 = array_reverse ( $monvol );

            $data4 = array_reverse ( $sunvol );



            $xdata0 = array_reverse ( $thuprice );

            $xdata1 = array_reverse ( $wedprice );

            $xdata2 = array_reverse ( $tueprice );

            $xdata3 = array_reverse ( $monprice );

            $xdata4 = array_reverse ( $sunprice );

            $labels = array_reverse ( $labels );

            //$labels=$timeArr;
            /*
            echo "<pre>";
            print_r($date0);
            print_r($labels);
            print_r($ltpArr);
            exit;
            */



            # Create a XYChart object of size 580 x 280 pixels
            $c = new XYChart ( 1000, 480 );



            # Add a title to the chart using 14 pts Arial Bold Italic font
            $c->addTitle ( "Weekly comparison-$code", "arialbi.ttf", 14 );



            # Set the plot area at (50, 50) and of size 500 x 200. Use two alternative background
            # colors (f8f8f8 and ffffff)
            $c->setPlotArea ( 50, 50, 900, 350, 0xf8f8f8, 0xffffff );



            # Add a legend box at (50, 25) using horizontal layout. Use 8pts Arial as font, with
            # transparent background.
            $legendObj = $c->addLegend ( 50, 25, false, "arial.ttf", 8 );

            $legendObj->setBackground ( Transparent );



            # Add custom text at (176, 21) (top right corner of plotarea) using 11pt Times Bold
            # Italic font/red (0xc09090) color
            $textBoxObj = $c->addText ( 750, 50, "www.stockbangladesh.org", "timesbi.ttf", 11, 0xc09090 );

            $textBoxObj->setAlignment ( TopLeft );



            # Set the x axis labels
            $c->xAxis->setLabels ( $labels );

            # Set the labels on the x axis.
            $c->xAxis->setLabelStyle ( "Arial", 8, TextColor, 90 );



            # Draw the ticks between label positions (instead of at label positions)
            $c->xAxis->setTickOffset ( 0.99 );



            # Add a multi-bar layer with 3 data sets
            $layer = $c->addBarLayer2 ( Side );

            $layer->addDataSet ( $data0, 0xff8080, "Thu" );

            $layer->addDataSet ( $data1, 0x80ff80, "Wed" );

            $layer->addDataSet ( $data2, 0x8080ff, "Tue" );

            $layer->addDataSet ( $data3, 0x808080, "Mon" );

            $layer->addDataSet ( $data4, 0xbbbb00, "Sun" );



            # Set 50% overlap between bars
            $layer->setOverlapRatio ( 0.75 );



            # Add a title to the y-axis
            $c->yAxis->setTitle ( "Volume" );



            # Add a line layer to the chart
            $layer = $c->addLineLayer ();

            $layer->setUseYAxis2 ();

            # Add the first line. Plot the points with a 7 pixel square symbol
            $dataSetObj = $layer->addDataSet ( $xdata0, 0xcf4040, "Thu" );
            $dataSetObj->setDataSymbol ( SquareSymbol, 5 );

            $dataSetObj = $layer->addDataSet ( $xdata1, 0x80ff80, "Wed" );
            $dataSetObj->setDataSymbol ( SquareSymbol, 5 );
            $dataSetObj = $layer->addDataSet ( $xdata2, 0x8080ff, "Tue" );

            $dataSetObj->setDataSymbol ( SquareSymbol, 5 );
            $dataSetObj = $layer->addDataSet ( $xdata3, 0x808080, "Mon" );
            $dataSetObj->setDataSymbol ( SquareSymbol, 5 );
            $dataSetObj = $layer->addDataSet ( $xdata4, 0xbbbb00, "Sun" );

            $dataSetObj->setDataSymbol ( SquareSymbol, 5 );

            # Output the chart
            //header ( "Content-type: image/png" );
            //print ($c->makeChart2 ( PNG )) ;
            $chartData = $c->makeChart2 ( PNG );
            $chartImagePath = WWW_ROOT . 'chart' . DS . 'weeklycompare.png';
            $f = fopen ( $chartImagePath, "wb" );
            fwrite ( $f, $chartData );
            fclose ( $f );


        }
        $this->set ( 'inv', $inv );
        $this->set ( 'inv1', $inv1 );
    }
    function getweekchart() {
        
        $this->weeklycompare ( $_GET );
        if (isset ( $_REQUEST ['mapData'] ) && $_REQUEST ['mapData'] == 'no') {
            require_once (WWW_ROOT . DS . 'chart' . DS . 'Image_Toolbox.class.php');
            $chartImagePath = WWW_ROOT . 'chart' . DS . 'weeklycompare.png';
            $img = new Image_Toolbox ( $chartImagePath );
            $width = $img->_img ['main'] ['width'];
            $img->addImage ( $width, 10, '#FFFFFF' );
            $img->blendMask ( 'left', 'bottom', IMAGE_TOOLBOX_BLEND_COPY, 0, 470 );
            $img->output ();
            die;
        }
    }
    
function navchart(){
         if (! $this->Session->check ( 'Auth.User' )) {
            $this->Session->setFlash ( 'You are not authorized to access that location.' );
            $this->redirect ( array ('controller' => 'users', 'action' => 'login' ) );
        }
        $this->layout ='default-one';
            $this->pageTitle = 'Stock Bangladesh :: NAV Chart';
        $conditions = array("Symbol.business_segment" => "Mutual Funds");
        $alldata=$this->Symbol->find('all', array('fields'=>array('Symbol.dse_code'),'conditions' => $conditions,'order'=>array('Symbol.dse_code')));
        $this->set('symbol_lists',$alldata);
        $_SESSION["nav_item"]=trim($_POST["TickerSymbol"]);
        $this->set('nav_item',trim($_POST["TickerSymbol"]));
        $this->set('item_code',$_SESSION["nav_item"]);
        $item_code=trim($_POST["TickerSymbol"]);
        
        App::import ( 'Vendor', 'Phpchartdir', array ('file' => 'phpchartdir.php'));
        require_once (WWW_ROOT . DS . 'chart' . DS . 'Image_Toolbox.class.php');
    //$item_code
    //$item_code=$_SESSION["nav_item"];
    # The data for the line chart
    
    $sqlStr="SELECT * FROM mutual_import WHERE code LIKE '%".$item_code."%' AND mpb!=0 AND enable_disable='1' ORDER BY weekno ";
    $queryStr=mysql_query($sqlStr);
    while($data=mysql_fetch_assoc($queryStr)){
    $dataArray[]=$data;    
    }
    
    $sqlStr="SELECT id,lasttradeprice FROM symbols WHERE dse_code LIKE '".$item_code."' ";
    $data=$this->Symbol->query($sqlStr);
    
    //$last_trade_price=$data[0]["symbols"]["lasttradeprice"];
    
    $date_start="1-1-2010";///Need to find dare from 
    $daystamp1=strtotime($date_start);
    $sym_id=$data[0]["symbols"]["id"];
    
    $week_dates=array();
    $week_count=0;
    $SqlStr="SELECT symbol, daystamp,close,date FROM outputs WHERE symbol=$sym_id AND daystamp>=$daystamp1 order by id asc";    
    foreach($this->Output->query($SqlStr) as $dataOp){
        $dataArray2[]=$data;        
        $dayStamp=$dataOp['outputs']["daystamp"];
        $week_no=date("W",$dayStamp);
        if(date("D",$dayStamp-24*60*60)=="Sun")
            {
                $week_dates[(int)(date("Y",$dayStamp).$week_no)]=date("Y-m-d",$dayStamp-24*60*60);
            }
        else{
                $week_dates_di[(int)(date("Y",$dayStamp).$week_no)]=date("Y-m-d",$dayStamp-24*60*60);
            }
        $weeks[(int)(date("Y",$dayStamp).$week_no)]=(int)$week_no;
        $outputData[(int)(date("Y",$dayStamp).$week_no)]=$dataOp['outputs']["close"];
        $weekmax=$week_no;        
    }
    ksort($tempOutput);
    ksort($weeks);        
    foreach($week_dates_di as $key=>$date){
        $date=strtotime($date);
        $day_adv=date("w",$date);    
        $week_sundays[$key]=date("Y-m-d",$date-$day_adv*24*60*60);
        
    }
    //print_r($week_dates_di);
    $dataArray=array();
    $sqlStr="SELECT * FROM mutual_import WHERE code LIKE '%".$item_code."%' AND mpb!=0 AND enable_disable='1' ORDER BY id ";
    $queryStr=mysql_query($sqlStr);
    $start_date=strtotime($week_sundays[0]);
    $end_date=strtotime($week_dates[count($week_sundays)-1]);
    while($data=mysql_fetch_assoc($queryStr)){
    $dates_sunday[]=$data["sunday_date"];
    $sunday_date=$data["sunday_date"];
    if(in_array($data["sunday_date"],$week_sundays)){
            $dataArray[]=$data;
        }
    else{
        //$dataArray[]=$dataArray[count($dataArray)-1];
    }        
    }
    //echo count($dataArray).'<'.count($outputData);
    //print_r($dataArray);
    if(count($dataArray)<count($outputData)){
    $out_rev=array_reverse($outputData);
    $first_date=$dataArray[0]["sunday_date"];
    foreach($week_sundays as $sunday)
        {
            
            if(strtotime($sunday)<strtotime($first_date)){array_pop($out_rev);}
        }
    $outputData=array_reverse($out_rev);
    }
    
    $data0=array();
    $data1=array();    
    $count=0;    
    foreach($dataArray as $navData){
        if($count>0){
        $cc=(strtotime($navData['sunday_date'])-strtotime($last_sunday))/(7*24*60*60);
        if($cc>1){
        for($i=0;$i<$cc;$i++){
            $data0[]=$data0[count($data0)-1];
            $data1[]=$data1[count($data1)-1];
            $labels[]=date("Y-m-d",strtotime($labels[count($labels)-1])+7*24*60*60);
        }
        }
        }
        $data0[]=$navData['mpb']/1.0;
        $data1[]=$navData['cpb']/1.0;
        $labels[]=$navData['sunday_date'];
        $last_sunday=$navData["sunday_date"];
        $count++;
    }
    
    $arr_rev=array_reverse($labels);
    $arr_rev1=array_reverse($data0);
    $arr_rev2=array_reverse($data1);
    //echo count($labels).' '.count($outputData);
    if(count($labels)>count($outputData)){
    for($ii=0;$ii<count($labels)-count($outputData);$ii++)
        {
            array_pop($arr_rev);
            array_pop($arr_rev1);
            array_pop($arr_rev2);
        }
        }
    
    $labels=array_reverse($arr_rev);
    $data0=array_reverse($arr_rev1);
    $data1=array_reverse($arr_rev2);
    //print_r($labels);
    /*New correction*/
    if($data0[count($data0)-1]==0)$data0[count($data0)-2];
    if($data1[count($data1)-1]==0)$data1[count($data1)-2];
    
    //echo count($labels).' '.count($outputData);
    $op_rev=array_reverse($outputData);
    if(count($labels)<count($outputData)){
    for($ii=0;$ii<count($outputData)-count($labels);$ii++)
        {
            array_pop($op_rev);
        }
        $outputData=array_reverse($op_rev);
        }
    /*End new correction */
    //print_r($data0);
    $cur_date=(int)date("W",strtotime(date("Y-m-d")));
    $max_label=array_pop($week_sundays);
    $in_arr=(int)date("W",strtotime($max_label));
    if($cur_date>$in_arr){
        $cc1=date("Y-m-d",(strtotime($max_label))+(7*24*60*60));
        $sqlStr1="SELECT * FROM mutual_import WHERE code LIKE '%".$item_code."%' AND mpb!=0 AND enable_disable='1' AND sunday_date LIKE '%".$cc1."%' LIMIT 1";
        $queryStr1=mysql_query($sqlStr1);
        $sqlResult1=mysql_fetch_assoc($queryStr1);
//print_r($sqlResult1);
        $labels[]=$sqlResult1["sunday_date"];
        if($sqlResult1['mpb']==NULL)$sqlResult1['mpb']=$data0[count($data0)-1];
        $data0[]=$sqlResult1['mpb']/1.0;
        if($sqlResult1['cpb']==NULL)$sqlResult1['cpb']=$data1[count($data1)-1];
        $data1[]=$sqlResult1['cpb']/1.0;
        $sqlStr2="SELECT close FROM outputs WHERE symbol=$sym_id ORDER BY id desc LIMIT 1 ";
        $op_query=mysql_query($op_query);
        $op_data=mysql_fetch_array($op_data);
    //    print_r($op_data);
/*New correction*/
        $outputData[]=$outputData[count($outputData)-1];
    }
//print_r($data0);
//if(count($outputData)>count($data0)){$arrr=array_reverse($outputData);array_pop($arrr);array_reverse($arrr);$outputData=$arrr;}
//$outputData=array_reverse($outputData);
/*End Data calculation*/
            
            # Create a XYChart object of size 300 x 180 pixels
            $c = new XYChart ( 760, 450 );
            $c->setBackground ( $c->linearGradientColor ( 0, 0, 0, 400, 0xE7FFDF, 0xffffff ), 0xE3EFC2 );
            $c->setRoundedFrame ( 0xffffff, 0 );

            //$c->setBackground($c->linearGradientColor(0, 0, 0, 400, 0xffffbb, 0xffffff), 0x888888);
            //$c->setRoundedFrame(0xffffff, 0);

            # Set the plot area at (50, 20) and of size 200 x 130 pixels
            $c->setPlotArea ( 50, 50, 650, 320, 0xffffff, - 1, - 1, $c->dashLineColor ( 0xaaaaaa, DotLine ), Transparent );
            # Add a title to the chart using 8 pts Arial Bold font
            $arialbdPath = WWW_ROOT . 'font' . DS . 'arialbd.ttf';


        # Add a legend box at (45, 12) (top of the chart) using horizontal layout and 8 pts
        
        # Arial font Set the background and border color to Transparent.
        $legendObj = $c->addLegend(45, 12, false, "", 8);
        $legendObj->setBackground(Transparent);
        
        # Add a title to the chart using 9 pts Arial Bold/white font. Use a 1 x 2 bitmap
        # pattern as the background.
        $textBoxObj = $c->addTitle($_SESSION["nav_item"], "arialbd.ttf", 9,
            0xffffff);
        $textBoxObj->setBackground($c->patternColor(array(0x004000, 0x008000), 2));
        
        $textBoxObj = $c->addText ( 500, 50, "www.stockbangladesh.org", "timesbi.ttf", 11, 0xc09090 );
        $textBoxObj->setAlignment ( TopLeft );
        
        # Set the y axis label format to nn%
        $c->yAxis->setLabelFormat("{value}");
        $c->yAxis->setAutoScale(10,10,0);/*CHANGE*/
        
        # Set the labels on the x axis
        $c->xAxis->setLabels($labels);
        $c->xAxis->setLabelStyle ( "Arial", 8, TextColor, 90 );
        
        # Add a line layer to the chart
        $layer = $c->addLineLayer(0);
        //print_r($data0);
        //echo "<br>";
        
        # Add the first line. Plot the points with a 7 pixel square symbol
        $dataSetObj = $layer->addDataSet($data0, 0xcf4040, "Market Price Basis NAV ".$data0[count($data0)-1]);
        $dataSetObj->setDataSymbol(SquareSymbol, 4);
        //print_r($data1);
    //    exit;
        # Add the second line. Plot the points with a 9 pixel dismond symbol
        $dataSetObj = $layer->addDataSet($data1, 0x40cf40, "Cost Price Basis NAV ".$data1[count($data1)-1]);
        $dataSetObj->setDataSymbol(DiamondSymbol, 5);
        
        $dataSetObj = $layer->addDataSet($outputData, 0x8000FF, "Close Price ".$outputData[count($outputData)-1]);
        $dataSetObj->setDataSymbol(DiamondSymbol, 5);
        # Create the image and save it in a temporary location
        $chart1URL = $c->makeSession("chart1");
        $this->set('chart1URL',$chart1URL);
        
        # Create an image map for the chart
        $imageMap = $c->getHTMLImageMap("", "", "title='{xLabel}: {value|2}'");
        $this->set('imageMap',$imageMap);
    }
    
    function share_impact_sector()
    {
        if (! $this->Session->check ( 'Auth.User' )) {
            $this->Session->setFlash ( 'You are not authorized to access that location.' );
            $this->redirect ( array ('controller' => 'users', 'action' => 'login' ) );
        }
        //Configure::write('debug',3);
        //set_time_limit(0);
        $this->layout = 'default-one';
        $this->pageTitle = 'Stock Bangladesh :: Sector Share Impact';
        
        $dateArr = $this->MarketSummery->find('all', array('fields' => array('date','dgen','dsi','cap_equity'),'order' => array('id DESC'),'limit'=>2));
        $lastdayIndex = $dateArr[1]['MarketSummery']['dsi'];
        $lastdayMcap = $dateArr[1]['MarketSummery']['cap_equity'];
        $lastdate = $dateArr [0] ['MarketSummery'] ['date'];
        $Mdate = explode("-",$lastdate);
        $Odate = $Mdate[2].'-'.$Mdate[1].'-'.$Mdate[0];
        
        $shareData = $this->Symbol->query ('select id,symbol_id,close,date_time,lastprice from data_banks_intraday where symbol_id =5 ORDER BY id DESC LIMIT 2');
        $last_dse_update = explode(' ',$shareData[0]['data_banks_intraday']['date_time']);
        $dsechange = $shareData[0]['data_banks_intraday']['lastprice'] - $lastdayIndex;
        
        $this->set('dse_update',$last_dse_update[1]);
        $this->set('dse_change',$dsechange);
        $this->set('lastday_index',$lastdayIndex);
        
        $start_date = date('d-m-Y',strtotime($dateArr[1]['MarketSummery']['date']));
        $startstamp = strtotime($start_date)-6*60*60;
        $end_date = date('d-m-Y',strtotime($dateArr[0]['MarketSummery']['date']));
        $endstamp = strtotime($end_date)-6*60*60;
        //pr($startstamp);
        
        
        $querystr="SELECT * FROM `corporate_action` WHERE `datestamp` >=$startstamp and `datestamp` <$endstamp  and`action`='stockdiv' and `active`=1 ORDER BY `datestamp` ASC";            
        $corporateAction = $this->Symbol->query($querystr);
       // pr($corporateAction);
        
        foreach($corporateAction as $row)
        {
            if($row['corporate_action']['action']=='stockdiv')
            {
                $adjustmentFactor[$row['corporate_action']['symbol']]['symbol']=$row['corporate_action']['symbol'];
                $adjustmentFactor[$row['corporate_action']['symbol']]['value']=(100+$row['corporate_action']['value'])/100;
            }
        }
        
        $sql = "SELECT * FROM outputs where date= '$Odate' and symbol>10 and volume!=0 ORDER BY id";
        $outputdata = $this->Symbol->query($sql);
        $outputarr = array();
        foreach($outputdata as $arr)
        {
            $symbol = $arr['outputs']['symbol'];
            $outputarr[$symbol] = $arr; 
        }
        
        $sectorArr = $this->Symbol->find ( 'all', array ('conditions' => array ('inactive= \'No\' AND otc_market= \'No\' AND business_segment!=\'\' AND business_segment!=\'Mutual Funds\' AND business_segment!=\'Corporate Bond\''), 'fields' => array ('DISTINCT Symbol.business_segment') ) );
        
        $SymbolArr = $this->Symbol->find( 'all', array ('conditions' => array ('inactive=\'No\' AND otc_market=\'No\' AND business_segment!=\'Mutual Funds\' AND business_segment!=\'Corporate Bond\' AND category!=\'Z\' AND id!=1 AND corporate_declaration_restriction=0' ), 'fields' => array ('id','dse_code','lasttradeprice','yclose','no_of_securities','corporate_declaration_restriction','business_segment','share_percentage_public')));
        
        $datetime = date('Y-m-d h:i:s',time());
        $datestamp = time();
        $total_information_sector = array();
        $final_index_sector = array();
        $index_change_sector = array();
        $index_change_per_sector = array();
        $total_contribution = 0;
        $total_index_change = 0;
        foreach($sectorArr as $sector)
        {
            
            $total_contribution_sector = 0;
            $total_change_sector = 0;
            $total_change_per_sector = 0;
            $total_price_change_sector = 0;
            foreach($SymbolArr as $symbol)
            {
                
              if($symbol['Symbol']['business_segment'] == $sector['Symbol']['business_segment'])
                
                {
                    if(!empty($outputarr[$symbol['Symbol']['id']]))
                    {  
                       $securities[$symbol['Symbol']['id']]       = $symbol['Symbol']['no_of_securities'];
                       if(!empty($adjustmentFactor[$symbol['Symbol']['id']]))
                        {
                            $symbol['Symbol']['yclose'] = $symbol['Symbol']['yclose']/ $adjustmentFactor[$symbol['Symbol']['id']]['value'];
                        }
                        $change[$symbol['Symbol']['id']]           =  $symbol['Symbol']['lasttradeprice'] - $symbol['Symbol']['yclose'];
                        $total_impact[$symbol['Symbol']['id']]     = $change[$symbol['Symbol']['id']]* $securities[$symbol['Symbol']['id']];
                        $increasedMcap[$symbol['Symbol']['id']]    = $lastdayMcap + $total_impact[$symbol['Symbol']['id']];
                        $final_index[$symbol['Symbol']['id']]      = ($lastdayIndex*$increasedMcap[$symbol['Symbol']['id']])/$lastdayMcap;
                        $index_change[$symbol['Symbol']['id']]     = $final_index[$symbol['Symbol']['id']]-$lastdayIndex;
                        $index_change_per[$symbol['Symbol']['id']] = ($final_index[$symbol['Symbol']['id']]-$lastdayIndex)/$lastdayIndex;
                        $total_change_sector += $index_change[$symbol['Symbol']['id']];  
                        $total_change_per_sector += $index_change_per[$symbol['Symbol']['id']];  
                        
                        
                        $total_information[$symbol['Symbol']['id']]['name']     = $symbol['Symbol']['dse_code'];
                        $total_information[$symbol['Symbol']['id']]['sector']     = $symbol['Symbol']['business_segment'];
                        $total_information[$symbol['Symbol']['id']]['contribution']  = $index_change[$symbol['Symbol']['id']]/ abs($change[$symbol['Symbol']['id']]);
                        
                        $total_contribution_sector += $index_change[$symbol['Symbol']['id']]/ abs($change[$symbol['Symbol']['id']]); 
                        $total_information[$symbol['Symbol']['id']]['index_change']     = number_format($index_change[$symbol['Symbol']['id']],5);
                        $total_information[$symbol['Symbol']['id']]['index_per_change'] = number_format($index_change_per[$symbol['Symbol']['id']],6); 
                        $total_information[$symbol['Symbol']['id']]['contribution']     = $index_change[$symbol['Symbol']['id']]/ abs($change[$symbol['Symbol']['id']]);
                        $total_information[$symbol['Symbol']['id']]['sector']           = $symbol['Symbol']['business_segment'];
                        $total_information[$symbol['Symbol']['id']]['yclose']           = $symbol['Symbol']['yclose'];
                        $total_information[$symbol['Symbol']['id']]['lastprice']        = $symbol['Symbol']['lasttradeprice'];
                        $total_information[$symbol['Symbol']['id']]['change']           = $change[$symbol['Symbol']['id']];
                        $total_price_change_sector += $change[$symbol['Symbol']['id']];
                       
                    } 
                }
                    if(isset($_GET['alphsort']) && $_GET['alphsort']!='')
                    {
                       $total_information_sector[$sector['Symbol']['business_segment']]['sector_name']  =  $sector['Symbol']['business_segment'];
                    }
                    if(isset($_GET['sort']) && $_GET['sort']!='')
                    {
                       $total_information_sector[$sector['Symbol']['business_segment']]['index_change']     =  $total_change_sector;
                    }
                    if(isset($_GET['contsort']) && $_GET['contsort']!='')
                    {
                       $total_information_sector[$sector['Symbol']['business_segment']]['contribution']     =  $total_contribution_sector;
                    }
                
                 $total_information_sector[$sector['Symbol']['business_segment']]['price_change']     =  $total_price_change_sector;
                 $total_information_sector[$sector['Symbol']['business_segment']]['index_change_per'] =  $total_change_per_sector;
                 $total_information_sector[$sector['Symbol']['business_segment']]['sector_name']  =  $sector['Symbol']['business_segment'];
                 $total_information_sector[$sector['Symbol']['business_segment']]['index_change']     =  $total_change_sector;
                 $total_information_sector[$sector['Symbol']['business_segment']]['contribution']     =  $total_contribution_sector;
                
                
                
            }
            $total_contribution += $total_contribution_sector;
            $total_index_change += $total_change_sector;
        /*$sector_name =  $sector['Symbol']['business_segment'];
        $insertSql = "INSERT INTO `sbsector_summeries` (`id` ,`sector` ,`index_change` ,`index_change_per` ,`price_change` ,`contribution` ,`datestamp` ,`date_time`)
        VALUES (NULL, '$sector_name', '$total_change_sector', '$total_change_per_sector', '$total_price_change_sector', '$total_contribution_sector', '$datestamp', '$datetime')";
        $this->Symbol->query($insertSql);*/
        }
        
        if (isset($_GET['alphsort']) && $_GET['alphsort']!='') {
            
            if($_GET['alphsort'] == 'alphasc')
            {
                
                $alphsort = 'alphdesc';    
                asort($total_information_sector);
                $this->set('alphsort',$alphsort);
            }
            elseif($_GET['alphsort'] == 'alphdesc')
            {
                
                $alphsort = 'alphasc';
                arsort($total_information_sector);
                $this->set('alphsort',$alphsort);
            }
        } 
        
        
        if (isset($_GET['contsort']) && $_GET['contsort']!='') {
            
            if($_GET['contsort'] == 'contasc')
            {
               $contsort = 'contdesc';    
               asort($total_information_sector);
               $this->set('contsort',$contsort);
            }
            elseif($_GET['contsort'] == 'contdesc')
            {
               $contsort = 'contasc';
               arsort($total_information_sector);
               $this->set('contsort',$contsort);
            }
        }  
        if (isset($_GET['sort']) && $_GET['sort']!='') {
            
            if($_GET['sort'] == 'asc')
            {
                
                $sort = 'desc';    
                asort($total_information_sector);
                $this->set('sort',$sort);
            }
            elseif($_GET['sort'] == 'desc')
            {
               
                $sort = 'asc';
                arsort($total_information_sector);
                $this->set('sort',$sort);
            }
            
            
        }
        
       $this->set('total_information',$total_information_sector);
       $this->set('total_contribution',$total_contribution);
       $this->set('total_index_change',$total_index_change);
       
    }
    function toptengainer() {
       
       $datelist = $this->MarketSummery->find('all', array('fields' => array('date'),'order' => array('id DESC'),'limit'=>1));
       $exdate = explode('-',$datelist[0]['MarketSummery']['date']);
       $outputdate = $exdate[2].'-'.$exdate[1].'-'.$exdate[0];
        
       $symbol_list = $this->FrontsideMenu->symbolList;
       $symbolarray = "SELECT symbol,close,ycp, (close-ycp) as price_change,(((close-ycp)/ycp)*100) as price_change_per FROM outputs WHERE volume!=0 AND date='$outputdate' AND symbol>4 ORDER BY price_change_per DESC";
       $info = $this->Symbol->query($symbolarray);
       
       $topten = array();
       $count = 0;
       foreach($info as $symbol)
       {
           $company = $symbol_list[$symbol['outputs']['symbol']];
           $topten['top'][$company]['price_change_per'] = $symbol[0]['price_change_per'];
           $topten['top'][$company]['cp'] = $symbol['outputs']['close'];
           $topten['top'][$company]['ycp'] = $symbol['outputs']['ycp'];
           $topten['top'][$company]['price_change'] = $symbol[0]['price_change'];
           $topten['top'][$company]['company'] = $company;
           $topten['top'][$company]['id'] = $symbol['outputs']['symbol'];
           $count++;
           if($count==10)
           {
               break;
           }
       }
       
       for($i=count($info)-1;$i>count($info)-11;$i--)
       {
           $company = $symbol_list[$info[$i]['outputs']['symbol']];
           $topten['bottom'][$company]['price_change_per'] = $info[$i][0]['price_change_per'];
           $topten['bottom'][$company]['cp'] = $info[$i]['outputs']['close'];
           $topten['bottom'][$company]['ycp'] = $info[$i]['outputs']['ycp'];
           $topten['bottom'][$company]['price_change'] = $info[$i][0]['price_change'];
           $topten['bottom'][$company]['company'] = $company;
           $topten['bottom'][$company]['id'] = $info[$i]['outputs']['symbol'];
           
       }
       
       return $topten; 
       /*$symbolarray = "SELECT id,lasttradeprice,yclose, (lasttradeprice-yclose) as price_change,(((lasttradeprice-yclose)/yclose)*100) as price_change_per ,dse_code,no_of_securities FROM symbols WHERE inactive='No' AND otc_market = 'No' AND id>1 ORDER BY price_change_per DESC";
       $info = $this->Symbol->query($symbolarray);
       $topten = array();
       $count = 0;
       foreach($info as $symbol)
       {
           
           $company = $symbol['symbols']['dse_code'];
           $topten['top'][$company]['price_change_per'] = $symbol[0]['price_change_per'];
           $topten['top'][$company]['cp'] = $symbol['symbols']['lasttradeprice'];
           $topten['top'][$company]['ycp'] = $symbol['symbols']['yclose'];
           $topten['top'][$company]['price_change'] = $symbol[0]['price_change'];
           $topten['top'][$company]['company'] = $symbol['symbols']['dse_code'];
           $topten['top'][$company]['id'] = $symbol['symbols']['id'];
           $count++;
           if($count==10)
           {
               break;
           }
       }
       
       for($i=count($info)-1;$i>count($info)-11;$i--)
       {
           $company = $info[$i]['symbols']['dse_code'];
           $topten['bottom'][$company]['price_change_per'] = $info[$i][0]['price_change_per'];
           $topten['bottom'][$company]['cp'] = $info[$i]['symbols']['lasttradeprice'];
           $topten['bottom'][$company]['ycp'] = $info[$i]['symbols']['yclose'];
           $topten['bottom'][$company]['price_change'] = $info[$i][0]['price_change'];
           $topten['bottom'][$company]['company'] = $info[$i]['symbols']['dse_code'];
           $topten['bottom'][$company]['id'] = $info[$i]['symbols']['id'];
       }
       
       return $topten;*/
       
      

    }
         function toptenvalue()
    {
        //Configure::write('debug',3);
        $datelist = $this->MarketSummery->find('all', array('fields' => array('date'),'order' => array('id DESC'),'limit'=>1));
        $startdate= date('d-m-Y',strtotime($datelist[0]['MarketSummery']['date']));
        $sql = "SELECT * FROM outputs where tradevalues!=0 AND symbol >10 AND date = '$startdate' ORDER BY tradevalues DESC ";
        $topvalue['value'] = $this->Symbol->query ( $sql );
        $symbol_list = $this->FrontsideMenu->symbolList;
        $topvalue['symbol_list'] = $symbol_list;
        //pr($topvolume);
        //sdie;
        return $topvalue;
        
    }
    function weeklytopten()
   {
       //Configure::write('debug',3);
       $datelist = $this->MarketSummery->find('all', array('fields' => array('date'),'order' => array('id DESC'),'limit'=>7));
       
       $startdate = date('d-m-Y',strtotime($datelist[6]['MarketSummery']['date']));//convert the date format to fetch data from output
       $enddate = date('d-m-Y',strtotime($datelist[0]['MarketSummery']['date']));
       
       
       $startdaySql = "SELECT id,symbol,name,open,high,low,close,volume,date,tradevalues,ycp FROM outputs WHERE date='".$startdate."' AND volume!=0 AND symbol>1";
       $startinfo = $this->Symbol->query($startdaySql);
       foreach($startinfo as $startarr)
       {
           $date = $startarr['outputs']['date'];
           $symbol = $startarr['outputs']['symbol'];
           $previnfo[$symbol] = $startarr;
       }   
       
       $enddaySql = "SELECT id,symbol,name,open,high,low,close,volume,date,tradevalues,ycp FROM outputs WHERE date='".$enddate."' AND volume!=0 AND symbol>1";
       $endinfo = $this->Symbol->query($enddaySql);
       foreach($endinfo as $endarr)
       {
           $date = $endarr['outputs']['date'];
           $symbol = $endarr['outputs']['symbol'];
           $todayinfo[$symbol] = $endarr;
       }   
       
       $symbol_list = $this->FrontsideMenu->symbolList;
       
       $weekarr = array();
       foreach($symbol_list as $id=>$name)
       {
           if((!empty($todayinfo[$id])) && (!empty($previnfo[$id])))
           {
               if($previnfo[$id]['outputs']['close']!=0)
               {
                   $change = $todayinfo[$id]['outputs']['close'] - $previnfo[$id]['outputs']['close'];
                   $change_per = ($change/$previnfo[$id]['outputs']['close'])*100;
                   $weekarr[$id]['change_per'] = $change_per;
                   $weekarr[$id]['change'] = $change;
                   $weekarr[$id]['ltp'] = $todayinfo[$id]['outputs']['close'];
                   $weekarr[$id]['ycp'] = $previnfo[$id]['outputs']['close'];
                   $weekarr[$id]['id'] = $id;
                   $weekarr[$id]['name'] = $name;
                   
                   
               }
           }
       }
       
       
       arsort($weekarr);
       $weektop['top'] = $weekarr ;
       asort($weekarr);
       $weektop['bottom'] = $weekarr ;
       return $weektop;
       
   }
   function index_mover()
   {
        //Configure::write('debug',3);
        $dateArr = $this->MarketSummery->find('all', array('fields' => array('date','dsi','cap_equity'),'order' => array('id DESC'),'limit'=>2));
        $lastdayIndex = $dateArr[1]['MarketSummery']['dsi']; 
        $lastdayMcap = $dateArr[1]['MarketSummery']['cap_equity'];
        $lastdate = $dateArr [0] ['MarketSummery'] ['date'];
        
        $ydate = $dateArr [1] ['MarketSummery'] ['date'];
        $TindexData = $this->Symbol->query ( 'select id,symbol_id,close,date_time,lastprice from data_banks_intraday where symbol_id =3 AND date_time LIKE '."'$ydate%'".' ORDER BY id DESC LIMIT 1' );
        $lastdayTindex = $TindexData[0]['data_banks_intraday']['lastprice'];
        
        $Mdate = explode("-",$lastdate);
        $Odate = $Mdate[2].'-'.$Mdate[1].'-'.$Mdate[0];
        
               
        /*$indexData = $this->Symbol->query ( 'select lastprice from data_banks_intraday where symbol_id =3 ORDER BY id DESC LIMIT 1' );
        $lastdayTindex = $indexData[0]['data_banks_intraday']['lastprice'];*/
        //$lastdayTindex = 5567.81;
        $shareData = $this->Symbol->query ( 'select id,symbol_id,close,date_time,lastprice from data_banks_intraday where symbol_id =5 ORDER BY id DESC LIMIT 2' );
        
        $last_dse_update = explode(' ',$shareData[0]['data_banks_intraday']['date_time']);
        $dsechange = $shareData[0]['data_banks_intraday']['lastprice'] - $lastdayIndex;
        
        
        $this->set('dse_update',$last_dse_update[1]);
        $this->set('dse_change',$dsechange);
        
        $start_date = date('d-m-Y',strtotime($dateArr[1]['MarketSummery']['date']));
        $startstamp = strtotime($start_date)-6*60*60;
        $end_date = date('d-m-Y',strtotime($dateArr[0]['MarketSummery']['date']));
        $endstamp = strtotime($end_date)-6*60*60;
        //pr($startstamp);
        
        
        $querystr="SELECT * FROM `corporate_action` WHERE `datestamp` >=$startstamp and `datestamp` <$endstamp  and`action`='stockdiv' and `active`=1 ORDER BY `datestamp` ASC";            
        $corporateAction = $this->Symbol->query($querystr);
       // pr($corporateAction);
        
        foreach($corporateAction as $row)
        {
            if($row['corporate_action']['action']=='stockdiv')
            {
                $adjustmentFactor[$row['corporate_action']['symbol']]['symbol']=$row['corporate_action']['symbol'];
                $adjustmentFactor[$row['corporate_action']['symbol']]['value']=(100+$row['corporate_action']['value'])/100;
            }
        }
        
        
        $SymbolArr = $this->Symbol->find( 'all', array ('conditions' => array ('inactive=\'No\' AND otc_market=\'No\' AND business_segment!=\'Mutual Funds\' AND business_segment!=\'Corporate Bond\' AND category!=\'Z\'' ), 'fields' => array ('id','dse_code','lasttradeprice','yclose','no_of_securities','corporate_declaration_restriction','business_segment','share_percentage_public')));
        
        
       $startdaySql = "SELECT id,symbol,name,open,high,low,close,volume,date,tradevalues,ycp FROM outputs WHERE date='".$Odate."' AND volume!=0 AND symbol>10";
       $startinfo = $this->Symbol->query($startdaySql);
       foreach($startinfo as $startarr)
       {
           $date = $startarr['outputs']['date'];
           $symbol = $startarr['outputs']['symbol'];
           $previnfo[$symbol] = $startarr;
       }   
        
        $total_information = array();
        $final_index = array();
        $index_change = array();
        $index_change_per = array();
        $total_change = 0;
        $total_price_change = 0;
        foreach($SymbolArr as $symbol)
        {
          $symbol_id = $symbol['Symbol']['id'];
          if(($symbol_id!=1) && ($symbol['Symbol']['corporate_declaration_restriction']!=1))
            
            {
                
                if($previnfo[$symbol_id]['outputs']['volume']!=0)
                {  
                   $securities[$symbol_id]       = $symbol['Symbol']['no_of_securities'];
                   if(!empty($adjustmentFactor[$symbol_id]))
                    {
                        $symbol['Symbol']['yclose'] = $symbol['Symbol']['yclose']/ $adjustmentFactor[$symbol_id]['value'];
                    }
                    $change[$symbol_id]           =  $symbol['Symbol']['lasttradeprice'] - $symbol['Symbol']['yclose'];
                    $total_impact[$symbol_id]     = $change[$symbol_id]* $securities[$symbol_id];
                    $increasedMcap[$symbol_id]    = $lastdayMcap + $total_impact[$symbol_id];
                    $final_index[$symbol_id]      = ($lastdayIndex*$increasedMcap[$symbol_id])/$lastdayMcap;
                    $index_change[$symbol_id]     = $final_index[$symbol_id]-$lastdayIndex;
                    $index_change_per[$symbol_id] = ($final_index[$symbol_id]-$lastdayIndex)/$lastdayIndex;
                    $total_change += $index_change[$symbol_id]; 
                     
                    /*$total_information[$symbol_id]['name']          = $symbol['Symbol']['dse_code'];
                    $total_information[$symbol_id]['sector']        = $symbol['Symbol']['business_segment'];
                    $total_information[$symbol_id]['contribution']  = $index_change[$symbol_id]/ abs($change[$symbol_id]);*/
                    
                    //$total_contribution += $index_change[$symbol['Symbol']['id']]/ abs($change[$symbol['Symbol']['id']]); 
                    $total_information[$symbol_id]['index_change']     = number_format($index_change[$symbol_id],5);
                    $total_information[$symbol_id]['name']             = $symbol['Symbol']['dse_code'];
                    $total_information[$symbol_id]['change']           = $change[$symbol_id];
                    $total_information[$symbol_id]['index_per_change'] = number_format($index_change_per[$symbol_id],6); 
                    $total_information[$symbol_id]['contribution']     = $index_change[$symbol_id]/ abs($change[$symbol_id]);
                    $total_information[$symbol_id]['sector']           = $symbol['Symbol']['business_segment'];
                    $total_information[$symbol_id]['yclose']           = $symbol['Symbol']['yclose'];
                    $total_information[$symbol_id]['lastprice']        = $symbol['Symbol']['lasttradeprice'];
                    $total_information[$symbol_id]['volume']        = $previnfo[$symbol_id]['outputs']['volume'];
                    
                    //$total_price_change += $change[$symbol_id];
                } 
            }
        }
        
        
        
        arsort($total_information);
        $count = 0;
        $indexmover = array();
        foreach($total_information as $id=>$info)
        {
           //pr($id);
           $indexmover['positive'][$count]['id'] = $id;
           $indexmover['positive'][$count]['name'] = $info['name'];
           $indexmover['positive'][$count]['lastprice'] = $info['lastprice'];
           $indexmover['positive'][$count]['yclose'] = $info['yclose'];
           $indexmover['positive'][$count]['index_change'] = $info['index_change'];
           $indexmover['positive'][$count]['index_per_change'] = $info['index_per_change'];
           $indexmover['positive'][$count]['volume'] = $info['volume'];
           $count++;
           if($count==5)
           {
               break;
           }
        }
        asort($total_information);
        
        //$indexmover = array();
        $count = 0;
        foreach($total_information as $id=>$info)
        {
        
           $indexmover['negative'][$count]['id'] = $id;
           $indexmover['negative'][$count]['name'] = $info['name'];
           $indexmover['negative'][$count]['lastprice'] = $info['lastprice'];
           $indexmover['negative'][$count]['yclose'] = $info['yclose'];
           $indexmover['negative'][$count]['index_change'] = $info['index_change'];
           $indexmover['negative'][$count]['index_per_change'] = $info['index_per_change'];
           $indexmover['negative'][$count]['volume'] = $info['volume'];
           $count++;
           if($count==5)
           {
               break;
           }
        }
       
       //pr($indexmover);
       //die;
        return $indexmover;
        
   }
 
   function sectorwise_comparison($sector = '')
    {
        //Configure::write('debug',3);
        //pr('start');
        
        $this->layout = 'default-compare';
        $this->pageTitle = 'Stock Bangladesh :: Sector Comparison';
        
        /*$ip          = $_SERVER['REMOTE_ADDR'];
        $ipcheckSql  = "SELECT ip FROM user_ip WHERE is_active =1 AND ip='ipcheck'";
        $ipenable    = mysql_query($ipcheckSql);
        if(mysql_num_rows($ipenable))
        {
            $brokerIPSql = "SELECT ip FROM user_ip WHERE is_active =1 AND ip='".$ip."'";
            $access = mysql_query($brokerIPSql);
            if(!mysql_num_rows($access))
            {
                $this->Session->setFlash ( 'You are not authorized to access this location' );
                $this->redirect ( array ('controller' => 'users', 'action' => 'index' ) );
                //die("You are not authorized to access this location.");
            }
        }*/
        
        $sectorArr = $this->Symbol->find ('all', array ('conditions' => array ('inactive= \'No\' AND otc_market= \'No\' AND business_segment!=\'\''), 'fields' => array ('DISTINCT Symbol.business_segment')));
        
        foreach($sectorArr as $arr)
        {
            $sec_name = $arr['Symbol']['business_segment'];
            $sec_name = str_replace("&","and",$sec_name);
            $sectors[]['business_segment'] = $sec_name;
        }
        if($sector=='')
         {
           $sector='Bank';
         }
        $this->set('sectors',$sectors);
        
        $this->set('key',$sector);
        $sector = str_replace("and","&",$sector);
        
        /*$date = date('Y-m-d',time());
        $last_sunday = date('Y-m-d', strtotime($date.'last sunday'));
        $laststamp = strtotime($last_sunday)-6*60*60;
        $todaystamp = time();*/
        $end_time = strtotime(date('d-M-Y 15:45:04'));
        $current_time = time();
        
        $sql = 'SELECT * FROM market_summeries ORDER BY id DESC LIMIT 4';
        $dateinfo = $this->Symbol->query($sql);
        //pr($dateinfo);
        
        $total_day = count($dateinfo);
        if($current_time < $end_time)
        {
            $startdate = $dateinfo [3] ['market_summeries'] ['date'];
        }
        else{
            $startdate = $dateinfo [2] ['market_summeries'] ['date'];
        }
        $lastdate = $dateinfo [0] ['market_summeries'] ['date'];
        $startstamp = strtotime($startdate);
        //pr($startstamp);
        $dataSql = "SELECT * FROM sbsector_summeries where datestamp >=$startstamp AND sector LIKE '%$sector%' order by datestamp ASC ";
        $sectorinfo = $this->Symbol->query($dataSql);
        /*pr($sectorinfo);
        die;*/
        
        $datewise_sector = array();
        $date = array();
        foreach($sectorinfo as $sectorArr)
        {
            $date[] = date('d-m-Y',strtotime($sectorArr['sbsector_summeries']['date_time']));
        }
        
        if($current_time < $end_time)
        {
         $total_mCap0 = ($dateinfo[1]['market_summeries']['value']/1000000)+$sectorinfo[2]['sbsector_summeries']['sector_odd_tradevalues']+$sectorinfo[2]['sbsector_summeries']['sector_block_tradevalues'];
        $total_mCap1 = ($dateinfo[2]['market_summeries']['value']/1000000)+$sectorinfo[1]['sbsector_summeries']['sector_odd_tradevalues']+$sectorinfo[1]['sbsector_summeries']['sector_block_tradevalues'];
        }
        else
        {
        $total_mCap0 = ($dateinfo[0]['market_summeries']['value']/1000000)+$sectorinfo[2]['sbsector_summeries']['sector_odd_tradevalues']+$sectorinfo[2]['sbsector_summeries']['sector_block_tradevalues'];
        $total_mCap1 = ($dateinfo[1]['market_summeries']['value']/1000000)+$sectorinfo[1]['sbsector_summeries']['sector_odd_tradevalues']+$sectorinfo[1]['sbsector_summeries']['sector_block_tradevalues'];
        }
        $this->set('total_mcap0',$total_mCap0);
        $this->set('total_mcap1',$total_mCap1);
        
        
        $_SESSION['total_mcap0']=$total_mCap0;
        $_SESSION['total_mcap1']=$total_mCap1;
        $_SESSION['sector']=$sector;
        $_SESSION['all_info'] = $sectorinfo;
        $this->set('total_info',$sectorinfo);
        $_SESSION['today']=$date[2];
        $_SESSION['yesterday']=$date[1];
        
       /* pr($sectorinfo);
        die; */
        $dataOutput = array();
        $dat_format = $date[2];
        $sqlStr="SELECT business_segment,id,dse_code,name,yclose,last_final_trade_price,(lasttradeprice-yclose) as final_change,((lasttradeprice-yclose)/yclose)*100 as final_chang_per FROM symbols WHERE business_segment = '$sector'  ORDER BY business_segment ASC    ";
        //pr($sqlStr);
         $dataSymbol=$this->Symbol->query($sqlStr);
         /*pr($dataSymbol);
         die;*/
        $dataOutput = array(); 
        $sqlStr="SELECT symbol FROM outputs WHERE date LIKE '%$dat_format%' AND volume>0 AND symbol>4 ";
        $sqlQuery=mysql_query($sqlStr);
        while($data=mysql_fetch_assoc($sqlQuery)){
            $dataOutput[]=$data['symbol'];
        }
         
         $dataArray=array();
         $high_value = -9999;
         $low_value = 9999;
         
            foreach($dataSymbol as $data){
                
               if(in_array($data['symbols']["id"],$dataOutput))
               {
                   
                   if($data[0]['final_chang_per'] > $high_value)
                    {
                       $high_company = $data['symbols']['name'];
                       $high_value = $data[0]['final_chang_per'];
                    }
                    
                if($data[0]['final_chang_per'] < $low_value)
                    {
                        $low_company = $data['symbols']['name'];
                        $low_value = $data[0]['final_chang_per'];
                    }
               }
        
        }
        
        $this->set('high_company',$high_company);
        $this->set('low_company',$low_company);
        
    
    }
    
     function sectorwise_tradevalue_compare($sector = '')
    {
       //Configure::write('debug',3);
       
       /*pr($_SESSION['all_info']);
       die;*/
       $sectorwise_tradevalue0 = $_SESSION['all_info'][2]['sbsector_summeries']['sector_tradevalues'];
       $sectorwise_tradevalue1 = $_SESSION['all_info'][1]['sbsector_summeries']['sector_tradevalues'];
       $sector = $_SESSION['sector'];
       $today = $_SESSION['today'];
       $yesterday = $_SESSION['yesterday'];   
       if($sectorwise_tradevalue0 >= $sectorwise_tradevalue1){ $yesterdaycolor = 0xf58220; $todaycolor = 0xc2d76e;}
        else { $todaycolor = 0xf58220; $yesterdaycolor = 0xc2d76e;}
         
        require_once (WWW_ROOT . DS . 'chart' . DS . 'phpchartdir.php');
        require_once (WWW_ROOT . DS . 'chart' . DS . 'Image_Toolbox.class.php');
        $c = new XYChart(830, 250, 0xe9ffe2, 0x000000, 1);
        $c->setPlotArea(160, 45, 550, 130, 0xffffff);
        $textBoxObj = $c->addTitle("", "times.ttf", 1);
        $textBoxObj->setBackground(0xe9ffe2);
        
        $c->swapXY();
        $c->xAxis->setLabels("Sectorwise Turnover");
        $c->xAxis->setTickLength(2);        
        $layer = $c->addBarLayer2(Stack);
        $textBoxObj = $c->addText ( 0, 20, " ", "timesbi.ttf", 1, 0xc09090 );
        $textBoxObj->setAlignment ( TopLeft );
        
        /*$legendBox = $c->addLegend($c->getWidth(), $textBoxObj->getHeight()+20, true, "arial.ttf", 8);
        $legendBox->setAlignment(TopRight);*/
        
        $layer->addDataGroup($today);
        $layer->addDataSet(round($sectorwise_tradevalue0,2), $todaycolor, " ");
        $layer->addDataGroup($yesterday);
        $layer->addDataSet(round($sectorwise_tradevalue1,2), $yesterdaycolor, " ");
        $layer->setBarGap(0.2, 0);
        $layer->setBorderColor(Transparent);                  
        $layer->setAggregateLabelStyle("times.ttf", 20);
        $c->yAxis->setAutoScale(0,0,1);
        $c->yAxis->setLabelStyle("arial.ttf", 14);

        
        
        $legendBox = $c->addLegend2(400, 10, 2, "arial.ttf", 9);
        $legendBox->setAlignment(TopCenter);
        $legendBox->setText(" {dataGroupName} {dataSetName} ");
        $legendBox->setBackground(Transparent, Transparent);
        /*header("Content-type: image/png");
        print($c->makeChart2(PNG));*/
        
        $chartData=$c->makeChart2(PNG);
        $chartImagePath = WWW_ROOT . 'chart'. DS . 'sectorwise_tradevalue_compare.png';
        $f = fopen($chartImagePath, "wb");
        fwrite($f, $chartData);
        fclose($f);
        $img = new Image_Toolbox($chartImagePath);
        $width=$img->_img['main']['width'];
        $img->addImage($width,10,'#ffffff');
        $img->blendMask('left','bottom',IMAGE_TOOLBOX_BLEND_COPY, 0, 240);
        $img->output();
        
    }
    
    function sectorwise_marketcontribution_compare($sector = '')
    {
       //Configure::write('debug',3);
        
       $sector_mcap0 = $_SESSION['all_info'][2]['sbsector_summeries']['sector_tradevalues'];
       $sector_mcap1 = $_SESSION['all_info'][1]['sbsector_summeries']['sector_tradevalues'];
       
       $today_mcap = $_SESSION['total_mcap0'];
       $yesterday_mcap = $_SESSION['total_mcap1'];
       
       $contribution0 = ($sector_mcap0/$today_mcap)*100;
       $contribution1 = ($sector_mcap1/$yesterday_mcap)*100;
       /*pr($today_mcap);
       pr($yesterday_mcap);
       
       pr($sector_mcap0);
       pr($sector_mcap1);
       
       pr($contribution0);
       pr($contribution1);
       die;*/
       
              
       $sector = $_SESSION['sector'];
       $today = $_SESSION['today'];
       $yesterday = $_SESSION['yesterday'];   
       if($contribution0 >= $contribution1){ $yesterdaycolor = 0xf58220; $todaycolor = 0xc2d76e;}
        else { $todaycolor = 0xf58220; $yesterdaycolor = 0xc2d76e;}
         
        require_once (WWW_ROOT . DS . 'chart' . DS . 'phpchartdir.php');
        require_once (WWW_ROOT . DS . 'chart' . DS . 'Image_Toolbox.class.php');
        $c = new XYChart(830, 250, 0xe9ffe2, 0x000000, 1);
        $c->setPlotArea(160, 45, 550, 130, 0xffffff);
        $textBoxObj = $c->addTitle(" ", "times.ttf", 10);
        $textBoxObj->setBackground(0xe9ffe2);
        
        $c->swapXY();
        $c->xAxis->setLabels("Sectorwise Contribution %");
        $c->xAxis->setTickLength(2);        
        $layer = $c->addBarLayer2(Stack);
        $textBoxObj = $c->addText ( 170, 20, " ", "times.ttf", 9, 0xc09090 );
        $textBoxObj->setAlignment ( TopLeft );
        $layer->addDataGroup($today);
        $layer->addDataSet(number_format($contribution0,2), $todaycolor, " ");
        $layer->addDataGroup($yesterday);
        $layer->addDataSet(number_format($contribution1,2), $yesterdaycolor, " ");
        $layer->setBarGap(0.2, 0);
        $layer->setBorderColor(Transparent);                  
        $layer->setAggregateLabelStyle("times.ttf", 20);
        $c->yAxis->setAutoScale(0,0,1);
        $c->yAxis->setLabelStyle("arial.ttf", 14);
        $legendBox = $c->addLegend2(400, 10, 2, "arial.ttf", 9);
        $legendBox->setAlignment(TopCenter);
        $legendBox->setText(" {dataGroupName} {dataSetName} ");
        $legendBox->setBackground(Transparent, Transparent);
        /*header("Content-type: image/png");
        print($c->makeChart2(PNG));*/
        
        $chartData=$c->makeChart2(PNG);
        $chartImagePath = WWW_ROOT . 'chart'. DS . 'sectorwise_marketcontribution_compare.png';
        $f = fopen($chartImagePath, "wb");
        fwrite($f, $chartData);
        fclose($f);
        $img = new Image_Toolbox($chartImagePath);
        $width=$img->_img['main']['width'];
        $img->addImage($width,10,'#ffffff');
        $img->blendMask('left','bottom',IMAGE_TOOLBOX_BLEND_COPY, 0, 240);
        $img->output();
        
    }
    
    function sectorwise_tradevalueChange_compare($sector = '')
    {
        
       $sectorwise_tradevalue0 = $_SESSION['all_info'][2]['sbsector_summeries']['sector_tradevalues'];
       $sectorwise_tradevalue1 = $_SESSION['all_info'][1]['sbsector_summeries']['sector_tradevalues'];
       $sectorwise_tradevalue2 = $_SESSION['all_info'][0]['sbsector_summeries']['sector_tradevalues'];
       
       $sectorwise_tradevalue_change0 = (($sectorwise_tradevalue0 - $sectorwise_tradevalue1)/$sectorwise_tradevalue1)*100;
       $sectorwise_tradevalue_change1 = (($sectorwise_tradevalue1 - $sectorwise_tradevalue2)/$sectorwise_tradevalue2)*100;
       
       $sector = $_SESSION['sector'];
       $today = $_SESSION['today'];
       $yesterday = $_SESSION['yesterday'];
       if($sectorwise_tradevalue_change0 >= $sectorwise_tradevalue_change1){ $yesterdaycolor = 0xf58220; $todaycolor = 0xc2d76e;}
        else { $todaycolor = 0xf58220; $yesterdaycolor = 0xc2d76e;}
         
        require_once (WWW_ROOT . DS . 'chart' . DS . 'phpchartdir.php');
        require_once (WWW_ROOT . DS . 'chart' . DS . 'Image_Toolbox.class.php');
        $c = new XYChart(830, 250, 0xe9ffe2, 0x000000, 1);
        $c->setPlotArea(160, 45, 550, 130, 0xffffff);
        $textBoxObj = $c->addTitle(" ", "timesbi.ttf", 10);
        $textBoxObj->setBackground(0xe9ffe2);
        
        $c->swapXY();
        $c->xAxis->setLabels("Sectorwise Turnover Change%");
        $c->xAxis->setTickLength(2);
        $layer = $c->addBarLayer2(Stack);
        $textBoxObj = $c->addText ( 170, 20, " ", "times.ttf", 9, 0xc09090 );
        $textBoxObj->setAlignment ( TopLeft );
        $layer->addDataGroup($today);
        $layer->addDataSet(round($sectorwise_tradevalue_change0,2), $todaycolor, " ");
        $layer->addDataGroup($yesterday);
        $layer->addDataSet(round($sectorwise_tradevalue_change1,2), $yesterdaycolor, " ");
        $layer->setBarGap(0.2, 0);
        $layer->setBorderColor(Transparent);
        $layer->setAggregateLabelStyle("times.ttf", 20);
        $c->yAxis->setAutoScale(0,0,0.5);
        $c->yAxis->setLabelStyle("arial.ttf", 14);
        $legendBox = $c->addLegend2(400, 10, 2, "arial.ttf", 9);
        $legendBox->setAlignment(TopCenter);
        $legendBox->setText(" {dataGroupName} {dataSetName} ");
        $legendBox->setBackground(Transparent, Transparent);
        /*header("Content-type: image/png");
        print($c->makeChart2(PNG));*/
        
        $chartData=$c->makeChart2(PNG);
        $chartImagePath = WWW_ROOT . 'chart'. DS . 'sectorwise_tradevalueChange_compare.png';
        $f = fopen($chartImagePath, "wb");
        fwrite($f, $chartData);
        fclose($f);
        $img = new Image_Toolbox($chartImagePath);
        $width=$img->_img['main']['width'];
        $img->addImage($width,10,'#ffffff');
        $img->blendMask('left','bottom',IMAGE_TOOLBOX_BLEND_COPY, 0, 240);
        $img->output();
        
    }
    
    function sectorwise_vol_compare($sector = '')
    {
        //Configure::write('debug',3);
        require_once (WWW_ROOT . DS . 'chart' . DS . 'phpchartdir.php');
        require_once (WWW_ROOT . DS . 'chart' . DS . 'Image_Toolbox.class.php');
        
        $volume0 = $_SESSION['all_info'][2]['sbsector_summeries']['volume'];
        $volume1 = $_SESSION['all_info'][1]['sbsector_summeries']['volume'];
        
        $sector = $_SESSION['sector'];
        $today = $_SESSION['today'];
        $yesterday = $_SESSION['yesterday'];
        /*pr($sector);
        die;*/
        if($volume0 >= $volume1){ $yesterdaycolor = 0xf58220; $todaycolor = 0xc2d76e;}
        else { $todaycolor = 0xf58220; $yesterdaycolor = 0xc2d76e;}
        
        $c = new XYChart(830, 250, 0xe9ffe2, 0x000000, 1);
        $c->setPlotArea(160, 45, 550, 130, 0xffffff);
        $textBoxObj = $c->addTitle(" ", "times.ttf", 10);
        $textBoxObj->setBackground(0xe9ffe2);
        
        $c->swapXY();
        $c->xAxis->setLabels("Sectorwise Volume");
        $c->xAxis->setTickLength(2);
        $layer = $c->addBarLayer2(Stack);
        $textBoxObj = $c->addText ( 170, 20, " ", "times.ttf", 9, 0xc09090 );
        $textBoxObj->setAlignment ( TopLeft );
        $layer->addDataGroup($today);
        $layer->addDataSet($volume0, $todaycolor, " ");
        $layer->addDataGroup($yesterday);
        $layer->addDataSet($volume1, $yesterdaycolor, " ");
        $layer->setBarGap(0.2, 0);
        $layer->setBorderColor(Transparent);
        $layer->setAggregateLabelStyle("times.ttf", 20);
        $c->yAxis->setAutoScale(0,0,1);
        $c->yAxis->setLabelStyle("arial.ttf", 14);
        $legendBox = $c->addLegend2(400, 10, 2, "arial.ttf", 9);
        $legendBox->setAlignment(TopCenter);
        $legendBox->setText(" {dataGroupName} {dataSetName} ");
        $legendBox->setBackground(Transparent, Transparent);
        /*header("Content-type: image/png");
        print($c->makeChart2(PNG));*/
        $chartData=$c->makeChart2(PNG);
        $chartImagePath = WWW_ROOT . 'chart'. DS . 'sectorwise_vol_compare.png';
        $f = fopen($chartImagePath, "wb");
        fwrite($f, $chartData);
        fclose($f);
        $img = new Image_Toolbox($chartImagePath);
        $width=$img->_img['main']['width'];
        $img->addImage($width,10,'#ffffff');
        $img->blendMask('left','bottom',IMAGE_TOOLBOX_BLEND_COPY, 0, 240);
        $img->output();
        
    }  
    
    function sectorwise_gainer_compare($sector = '')
    {
        //Configure::write('debug',3);
        require_once (WWW_ROOT . DS . 'chart' . DS . 'phpchartdir.php');
        require_once (WWW_ROOT . DS . 'chart' . DS . 'Image_Toolbox.class.php');
        
        $gainer0   = $_SESSION['all_info'][2]['sbsector_summeries']['sector_gainer'];
        $looser0   = $_SESSION['all_info'][2]['sbsector_summeries']['sector_looser'];
        $nochange0 = $_SESSION['all_info'][2]['sbsector_summeries']['sector_unchange'];
        
        
        $sector = $_SESSION['sector'];
        $today = $_SESSION['today'];
        $yesterday = $_SESSION['yesterday'];
        /*pr($sector);
        die;*/
        /*if($gainer0 >= $gainer1){ $yesterdaycolor = 0xff0000; $todaycolor = 0x00ff00;}
        else { $todaycolor = 0xff0000; $yesterdaycolor = 0x00ff00;}*/
        
        
        $c = new XYChart(830, 280, 0xe9ffe2, 0x000000, 1);
        $c->setPlotArea(160, 45, 550, 150, 0xffffff);
        $textBoxObj = $c->addTitle(" ", "timesbi.ttf", 10);
        $textBoxObj->setBackground(0xe9ffe2);
        $c->swapXY();
        $c->xAxis->setLabels("Sectorwise Gainer/Looser");
        $c->xAxis->setTickLength(2);
        $layer = $c->addBarLayer2(Stack);
        $textBoxObj = $c->addText ( 130, 20, " ", "times.ttf", 9, 0xc09090 );
        $textBoxObj->setAlignment ( TopLeft );
        $layer->addDataGroup("Gainer");
        $layer->addDataSet($gainer0, 0xc2d76e, " ");
        $layer->addDataGroup("Looser");
        $layer->addDataSet($looser0, 0xf58220, " ");
        $layer->addDataGroup("No Change");
        $layer->addDataSet($nochange0, 0xd4e6ae, " ");        
        
        $layer->setBarGap(0.2, 0);
        $layer->setBorderColor(Transparent);
        $layer->setAggregateLabelStyle("times.ttf", 20);
        $c->yAxis->setAutoScale(0,0,1);      
        $c->yAxis->setLabelStyle("arial.ttf", 14);
        $legendBox = $c->addLegend2(300, 10, 2, "arialbi.ttf", 9);
        $legendBox->setAlignment(TopCenter);
        $legendBox->setText(" {dataGroupName} {dataSetName} ");
        $legendBox->setBackground(Transparent, Transparent); 
        /*header("Content-type: image/png");
        print($c->makeChart2(PNG));*/
        $chartData=$c->makeChart2(PNG);
        $chartImagePath = WWW_ROOT . 'chart'. DS . 'sectorwise_gainer_compare.png';
        $f = fopen($chartImagePath, "wb");
        fwrite($f, $chartData);
        fclose($f);
        $img = new Image_Toolbox($chartImagePath);
        $width=$img->_img['main']['width'];
        $img->addImage($width,10,'#ffffff');
        $img->blendMask('left','bottom',IMAGE_TOOLBOX_BLEND_COPY, 0, 270);
        $img->output();
        
    }
    
    function sectorwise_gainer_depth_compare($sector ='')
    {
        require_once (WWW_ROOT . DS . 'chart' . DS . 'phpchartdir.php');
        require_once (WWW_ROOT . DS . 'chart' . DS . 'Image_Toolbox.class.php');
        Configure::write('debug',3);
        $gainertotal   = $_SESSION['all_info'][2]['sbsector_summeries']['gt_two'];
        $losertotal    = $_SESSION['all_info'][2]['sbsector_summeries']['lt_min_two'];
        $unchangetotal = $_SESSION['all_info'][2]['sbsector_summeries']['bt_min_two_zero'];
        $un_ch         = $_SESSION['all_info'][2]['sbsector_summeries']['bt_two_zero'];
        
        $sector = $_SESSION['sector'];
        $today = $_SESSION['today'];
        //pr($today);die;
        //$dat_format = date('d-m-Y',strtotime($today));
         
        
        # Create a XYChart object of size 500 x 320 pixels. Use a vertical gradient color
        # from pale blue (e8f0f8) to sky blue (aaccff) spanning half the chart height as
        # background. Set border to blue (88aaee). Use rounded corners. Enable soft drop
        # shadow.
        $c = new XYChart(850, 250, 0xe9ffe2, 0x000000, 1);
        $c->setPlotArea(190, 45, 550, 130, 0xffffff);
        //$c->setBackground($c->linearGradientColor(0, 0, 0, $c->getHeight() / 2, 0xffffff,0xffffff), 0x88aaee);
        //$c->setRoundedFrame();
        //$c->setDropShadow();

        #Set directory for loading images to current script directory
        #Need when running under Microsoft IIS
        $c->setSearchPath(dirname(__FILE__));

        # Add a title to the chart using 15 points Arial Italic. Set top/bottom margins to 15
        # pixels.
        $title = $c->addTitle(" ".$today, "arial.ttf", 16);
        $title->setMargin2(0, 0, 15, 15);

        # Tentatively set the plotarea to 50 pixels from the left edge, and to just under the
        # title. Set the width to 60% of the chart width, and the height to 50 pixels from
        # the bottom edge. Use pale blue (e8f0f8) background, transparent border, and grey
        # (aaaaaa) grid lines.
        //$c->setPlotArea(50, $title->getHeight(), $c->getWidth() * 6 / 10, $c->getHeight() -$title->getHeight() - 50, 0xe8f0f8, -1, Transparent, 0xaaaaaa);

        # Add a legend box where the top-right corner is anchored at 10 pixels from the right
        # edge, and just under the title. Use vertical layout and 8 points Arial font.
        $legendBox = $c->addLegend($c->getWidth(), $title->getHeight()-20, true, "arial.ttf", 8);
        /*$legendBox = $c->addLegend2(400, 10, 2, "arialbi.ttf", 9);*/
        $legendBox->setAlignment(TopRight);

        # Set the legend box background and border to transparent
        $legendBox->setBackground(Transparent, Transparent);

        # Set the legend box icon size to 16 x 32 pixels to match with custom icon size
        //$legendBox->setKeySize(16, 32);

        # Set axes to transparent
        $c->xAxis->setColors(Transparent);
        $c->yAxis->setColors(Transparent);

        # Set the labels on the x axis
        $c->xAxis->setLabels("Sectorwise Gainer Looser in-depth");
        $c->yAxis->setLabelStyle("arial.ttf", 14);
        
        # Add a percentage bar layer
        $layer = $c->addBarLayer2(Percentage);

        $c->swapXY();
        # Add the three data sets to the bar layer, using icons images with labels as data
        # set names
        $textBoxObj = $c->addText ( 200, 10, " ", "times.ttf", 9, 0xc09090 );
        $textBoxObj->setAlignment ( TopLeft );

        $layer->addDataSet($losertotal, 0xf9ccdf,"-2%");
        $layer->addDataSet($unchangetotal, 0xf58220,"+(0 to -2)%");
        $layer->addDataSet($un_ch, 0xd4e6ae,"(2 to 0)%");
        $layer->addDataSet($gainertotal, 0xc2d76e,"+2%");
        # Use soft lighting effect with light direction from top
        //$layer->setBorderColor(Transparent, softLighting(Top));

        # Enable data label at the middle of the the bar
        $textBoxObj = $layer->setDataLabelStyle();
        $textBoxObj->setAlignment(Center);

        # For a vertical stacked chart with positive data only, the last data set is always
        # on top. However, in a vertical legend box, the last data set is at the bottom. This
        # can be reversed by using the setLegend method.
        $layer->setLegend(ReverseLegend);

        # Output the chart
        /*header("Content-type: image/png");
        print($c->makeChart2(PNG));*/
        $chartData=$c->makeChart2(PNG);
        $chartImagePath = WWW_ROOT . 'chart'. DS . 'sectorwise_gainer_depth_compare.png';
        $f = fopen($chartImagePath, "wb");
        fwrite($f, $chartData);
        fclose($f);
        $img = new Image_Toolbox($chartImagePath);
        $width=$img->_img['main']['width'];
        $img->addImage($width,10,'#ffffff');
        $img->blendMask('left','bottom',IMAGE_TOOLBOX_BLEND_COPY, 0, 240);
        $img->output();
    }
    
    function sectorwise_prev_gainer_depth_compare($sector ='')
    {
        $gainertotal   = $_SESSION['all_info'][1]['sbsector_summeries']['gt_two'];
        $losertotal    = $_SESSION['all_info'][1]['sbsector_summeries']['lt_min_two'];
        $unchangetotal = $_SESSION['all_info'][1]['sbsector_summeries']['bt_min_two_zero'];
        $un_ch         = $_SESSION['all_info'][1]['sbsector_summeries']['bt_two_zero'];
        
        $sector = $_SESSION['sector'];
        $yesterday = $_SESSION['yesterday'];
        
        
        require_once (WWW_ROOT . DS . 'chart' . DS . 'phpchartdir.php');
        require_once (WWW_ROOT . DS . 'chart' . DS . 'Image_Toolbox.class.php');

        

        # Create a XYChart object of size 500 x 320 pixels. Use a vertical gradient color
        # from pale blue (e8f0f8) to sky blue (aaccff) spanning half the chart height as
        # background. Set border to blue (88aaee). Use rounded corners. Enable soft drop
        # shadow.
        $c = new XYChart(850, 250, 0xe9ffe2, 0x000000, 1);
        $c->setPlotArea(190, 45, 550, 130, 0xffffff);
        //$c->setBackground($c->linearGradientColor(0, 0, 0, $c->getHeight() / 2, 0xffffff,0xffffff), 0x88aaee);
        //$c->setRoundedFrame();
        //$c->setDropShadow();

        #Set directory for loading images to current script directory
        #Need when running under Microsoft IIS
        $c->setSearchPath(dirname(__FILE__));

        # Add a title to the chart using 15 points Arial Italic. Set top/bottom margins to 15
        # pixels.
        $title = $c->addTitle(" ".$yesterday, "arial.ttf", 16);
        $title->setMargin2(0, 0, 15, 15);

        # Tentatively set the plotarea to 50 pixels from the left edge, and to just under the
        # title. Set the width to 60% of the chart width, and the height to 50 pixels from
        # the bottom edge. Use pale blue (e8f0f8) background, transparent border, and grey
        # (aaaaaa) grid lines.
        //$c->setPlotArea(50, $title->getHeight(), $c->getWidth() * 6 / 10, $c->getHeight() -$title->getHeight() - 50, 0xe8f0f8, -1, Transparent, 0xaaaaaa);

        # Add a legend box where the top-right corner is anchored at 10 pixels from the right
        # edge, and just under the title. Use vertical layout and 8 points Arial font.
        $legendBox = $c->addLegend($c->getWidth(), $title->getHeight()-20, true, "arial.ttf", 8);
        /*$legendBox = $c->addLegend2(400, 10, 2, "arialbi.ttf", 9);*/
        $legendBox->setAlignment(TopRight);

        # Set the legend box background and border to transparent
        $legendBox->setBackground(Transparent, Transparent);

        # Set the legend box icon size to 16 x 32 pixels to match with custom icon size
        //$legendBox->setKeySize(16, 32);

        # Set axes to transparent
        $c->xAxis->setColors(Transparent);
        $c->yAxis->setColors(Transparent);

        # Set the labels on the x axis
        $c->xAxis->setLabels("Sectorwise Gainer Looser in-depth");
        $c->yAxis->setLabelStyle("arial.ttf", 14);

        # Add a percentage bar layer
        $layer = $c->addBarLayer2(Percentage);

        $c->swapXY();
        # Add the three data sets to the bar layer, using icons images with labels as data
        # set names
        $textBoxObj = $c->addText ( 200, 10, " ", "times.ttf", 9, 0xc09090 );
        $textBoxObj->setAlignment ( TopLeft );

        $layer->addDataSet($losertotal, 0xf9ccdf,"-2%");
        $layer->addDataSet($unchangetotal, 0xf58220,"+(0 to -2)%");
        $layer->addDataSet($un_ch, 0xd4e6ae,"(2 to 0)%");
        $layer->addDataSet($gainertotal, 0xc2d76e,"+2%");
        # Use soft lighting effect with light direction from top
        //$layer->setBorderColor(Transparent, softLighting(Top));

        # Enable data label at the middle of the the bar
        $textBoxObj = $layer->setDataLabelStyle();
        $textBoxObj->setAlignment(Center);

        # For a vertical stacked chart with positive data only, the last data set is always
        # on top. However, in a vertical legend box, the last data set is at the bottom. This
        # can be reversed by using the setLegend method.
        $layer->setLegend(ReverseLegend);

        # Output the chart
        /*header("Content-type: image/png");
        print($c->makeChart2(PNG));*/
        $chartData=$c->makeChart2(PNG);
        $chartImagePath = WWW_ROOT . 'chart'. DS . 'sectorwise_prev_gainer_depth_compare.png';
        $f = fopen($chartImagePath, "wb");
        fwrite($f, $chartData);
        fclose($f);
        $img = new Image_Toolbox($chartImagePath);
        $width=$img->_img['main']['width'];
        $img->addImage($width,10,'#ffffff');
        $img->blendMask('left','bottom',IMAGE_TOOLBOX_BLEND_COPY, 0, 240);
        $img->output();
    }
    
    function sectorwise_looser_compare($sector = '')
    {
        //Configure::write('debug',3);
        require_once (WWW_ROOT . DS . 'chart' . DS . 'phpchartdir.php');
        require_once (WWW_ROOT . DS . 'chart' . DS . 'Image_Toolbox.class.php');
        
        $looser0 = $_SESSION['sectorwise_looser0'];
        $looser1 = $_SESSION['sectorwise_looser1'];
        $sector  = $_SESSION['sector'];
        $today   = $_SESSION['today'];
        $yesterday = $_SESSION['yesterday'];
        /*pr($sector);
        die;*/
        if($gainer0 >= $gainer1){ $yesterdaycolor = 0xff0000; $todaycolor = 0x00ff00;}
        else { $todaycolor = 0xff0000; $yesterdaycolor = 0x00ff00;}
        
        $c = new XYChart(800, 140, 0xe9ffe2, 0x000000, 1);
        $c->setPlotArea(160, 45, 550, 40, 0xffffff);
        $textBoxObj = $c->addTitle("Sectorwise Looser", "timesbi.ttf", 10);
        $textBoxObj->setBackground(0xe9ffe2);
        
        $c->swapXY();
        $c->yAxis->setTitle("Issue Decline", "timesbi.ttf", 9);
        $c->xAxis->setLabels($sector);
        $c->xAxis->setTickLength(2);
        $layer = $c->addBarLayer2(Stack);
        $textBoxObj = $c->addText ( 170, 20, " ", "timesbi.ttf", 9, 0xc09090 );
        $textBoxObj->setAlignment ( TopLeft );
        $layer->addDataGroup($today);
        $layer->addDataSet($looser0, $todaycolor, " ");
        $layer->addDataGroup($yesterday);
        $layer->addDataSet($looser1, $yesterdaycolor, " ");
        $layer->setBarGap(0.2, 0);
        $layer->setBorderColor(Transparent);
        $layer->setAggregateLabelStyle("timesbi.ttf", 10);
        $c->yAxis->setAutoScale(0,0,1);
        $legendBox = $c->addLegend2(400, 10, 2, "arialbi.ttf", 9);
        $legendBox->setAlignment(TopCenter);
        $legendBox->setText(" {dataGroupName} {dataSetName} ");
        $legendBox->setBackground(Transparent, Transparent);
        /*header("Content-type: image/png");
        print($c->makeChart2(PNG));*/
        $chartData=$c->makeChart2(PNG);
        $chartImagePath = WWW_ROOT . 'chart'. DS . 'sectorwise_looser_compare.png';
        $f = fopen($chartImagePath, "wb");
        fwrite($f, $chartData);
        fclose($f);
        $img = new Image_Toolbox($chartImagePath);
        /*$width=$img->_img['main']['width'];
        $img->addImage($width,10,'#ffffff');
        $img->blendMask('left','bottom',IMAGE_TOOLBOX_BLEND_COPY, 0, 260);*/
        $img->output();
        
    }
    
    function sectorwise_unchange_compare($sector = '')
    {
        //Configure::write('debug',3);
        require_once (WWW_ROOT . DS . 'chart' . DS . 'phpchartdir.php');
        require_once (WWW_ROOT . DS . 'chart' . DS . 'Image_Toolbox.class.php');
        
        $nochange0 = $_SESSION['sectorwise_nochange0'];
        $nochange1 = $_SESSION['sectorwise_nochange1'];
        $sector  = $_SESSION['sector'];
        $today   = $_SESSION['today'];
        $yesterday = $_SESSION['yesterday'];
        /*pr($sector);
        die;*/
        if($nochange0 >= $nochange1){ $yesterdaycolor = 0xff0000; $todaycolor = 0x00ff00;}
        else { $todaycolor = 0xff0000; $yesterdaycolor = 0x00ff00;}
        
        $c = new XYChart(800, 140, 0xe9ffe2, 0x000000, 1);
        $c->setPlotArea(160, 45, 550, 40, 0xffffff);
        $textBoxObj = $c->addTitle("Sectorwise Unchanged", "timesbi.ttf", 10);
        $textBoxObj->setBackground(0xe9ffe2);
        
        $c->swapXY();
        $c->yAxis->setTitle("Issue Unchange", "timesbi.ttf", 9);
        $c->xAxis->setLabels($sector);
        $c->xAxis->setTickLength(2);
        $layer = $c->addBarLayer2(Stack);
        $textBoxObj = $c->addText ( 170, 20, " ", "timesbi.ttf", 9, 0xc09090 );
        $textBoxObj->setAlignment ( TopLeft );
        $layer->addDataGroup($today);
        $layer->addDataSet($nochange0, $todaycolor, " ");
        $layer->addDataGroup($yesterday);
        $layer->addDataSet($nochange1, $yesterdaycolor, " ");
        $layer->setBarGap(0.2, 0);
        $layer->setBorderColor(Transparent);
        $layer->setAggregateLabelStyle("timesbi.ttf", 10);
        $c->yAxis->setAutoScale(0,0,1);
        $legendBox = $c->addLegend2(400, 10, 2, "arialbi.ttf", 9);
        $legendBox->setAlignment(TopCenter);
        $legendBox->setText(" {dataGroupName} {dataSetName} ");
        $legendBox->setBackground(Transparent, Transparent);
        /*header("Content-type: image/png");
        print($c->makeChart2(PNG));*/
        $chartData=$c->makeChart2(PNG);
        $chartImagePath = WWW_ROOT . 'chart'. DS . 'sectorwise_unchange_compare.png';
        $f = fopen($chartImagePath, "wb");
        fwrite($f, $chartData);
        fclose($f);
        $img = new Image_Toolbox($chartImagePath);
        /*$width=$img->_img['main']['width'];
        $img->addImage($width,10,'#ffffff');
        $img->blendMask('left','bottom',IMAGE_TOOLBOX_BLEND_COPY, 0, 260);*/
        $img->output();
        
    }
    
    function sectorwise_hawla_compare($sector = '')
    {
        //Configure::write('debug',3);
        require_once (WWW_ROOT . DS . 'chart' . DS . 'phpchartdir.php');
        require_once (WWW_ROOT . DS . 'chart' . DS . 'Image_Toolbox.class.php');
        
        $hawla0 = $_SESSION['all_info'][2]['sbsector_summeries']['sector_trade'];
        $hawla1 = $_SESSION['all_info'][1]['sbsector_summeries']['sector_trade'];
        
        $sector  = $_SESSION['sector'];
        $today   = $_SESSION['today'];
        $yesterday = $_SESSION['yesterday'];
        /*pr($sector);
        die;*/
        if($hawla0 >= $hawla1){ $yesterdaycolor = 0xf58220; $todaycolor = 0xc2d76e;}
        else { $todaycolor = 0xf58220; $yesterdaycolor = 0xc2d76e;}
        
        $c = new XYChart(830, 250, 0xe9ffe2, 0x000000, 1);
        $c->setPlotArea(160, 45, 550, 130, 0xffffff);
        $textBoxObj = $c->addTitle(" ", "times.ttf", 10);
        $textBoxObj->setBackground(0xe9ffe2);
        
        $c->swapXY();
        $c->xAxis->setLabels("Sectorwise Hawla");
        $c->xAxis->setTickLength(2);
        $layer = $c->addBarLayer2(Stack);
        $textBoxObj = $c->addText ( 170, 20, " ", "times.ttf", 9, 0xc09090 );
        $textBoxObj->setAlignment ( TopLeft );
        $layer->addDataGroup($today);
        $layer->addDataSet($hawla0, $todaycolor, " ");
        $layer->addDataGroup($yesterday);
        $layer->addDataSet($hawla1, $yesterdaycolor, " ");
        $layer->setBarGap(0.2, 0);
        $layer->setBorderColor(Transparent);
        $layer->setAggregateLabelStyle("times.ttf", 20);
        $c->yAxis->setAutoScale(0,0,1);
        $c->yAxis->setLabelStyle("arial.ttf", 14);
        $legendBox = $c->addLegend2(400, 10, 2, "arial.ttf", 9);
        $legendBox->setAlignment(TopCenter);
        $legendBox->setText(" {dataGroupName} {dataSetName} ");
        $legendBox->setBackground(Transparent, Transparent);
        /*header("Content-type: image/png");
        print($c->makeChart2(PNG));*/
        $chartData=$c->makeChart2(PNG);
        $chartImagePath = WWW_ROOT . 'chart'. DS . 'sectorwise_hawla_compare.png';
        $f = fopen($chartImagePath, "wb");
        fwrite($f, $chartData);
        fclose($f);
        $img = new Image_Toolbox($chartImagePath);
        $width=$img->_img['main']['width'];
        $img->addImage($width,10,'#ffffff');
        $img->blendMask('left','bottom',IMAGE_TOOLBOX_BLEND_COPY, 0, 240);
        $img->output();
    }
    
    function sectorwise_mcap_compare($sector = '')
    {
        //Configure::write('debug',3);
        require_once (WWW_ROOT . DS . 'chart' . DS . 'phpchartdir.php');
        require_once (WWW_ROOT . DS . 'chart' . DS . 'Image_Toolbox.class.php');
        
        $sectorwise_mcap0 = $_SESSION['all_info'][2]['sbsector_summeries']['sector_cap']/1000000;
        $sectorwise_mcap1 = $_SESSION['all_info'][1]['sbsector_summeries']['sector_cap']/1000000;
        
        $sector  = $_SESSION['sector'];
        $today   = $_SESSION['today'];
        $yesterday = $_SESSION['yesterday'];
        /*pr($sector);
        die;*/
        if($sectorwise_mcap0 >= $sectorwise_mcap1){ $yesterdaycolor = 0xf58220; $todaycolor = 0xc2d76e;}
        else { $todaycolor = 0xf58220; $yesterdaycolor = 0xc2d76e;}
        
        $c = new XYChart(830, 250, 0xe9ffe2, 0x000000, 1);
        $c->setPlotArea(160, 45, 550, 130, 0xffffff);
        $textBoxObj = $c->addTitle(" ", "times.ttf", 10);
        $textBoxObj->setBackground(0xe9ffe2);
        
        $c->swapXY();
        $c->xAxis->setLabels("Sectorwise Market Capital");
        $c->xAxis->setTickLength(2);
        $layer = $c->addBarLayer2(Stack);
        $textBoxObj = $c->addText ( 170, 20, " ", "times.ttf", 9, 0xc09090 );
        $textBoxObj->setAlignment ( TopLeft );
        $layer->addDataGroup($today);
        $layer->addDataSet(round($sectorwise_mcap0,2), $todaycolor, " ");
        $layer->addDataGroup($yesterday);
        $layer->addDataSet(round($sectorwise_mcap1,2), $yesterdaycolor, " ");
        $layer->setBarGap(0.2, 0);
        $layer->setBorderColor(Transparent);
        $layer->setAggregateLabelStyle("times.ttf", 20);
        $c->yAxis->setAutoScale(0,0,1);
        $c->yAxis->setLabelStyle("arial.ttf", 14);
        $legendBox = $c->addLegend2(400, 10, 2, "arial.ttf", 9);
        $legendBox->setAlignment(TopCenter);
        $legendBox->setText(" {dataGroupName} {dataSetName} ");
        $legendBox->setBackground(Transparent, Transparent);
        /*header("Content-type: image/png");
        print($c->makeChart2(PNG));*/
        $chartData=$c->makeChart2(PNG);
        $chartImagePath = WWW_ROOT . 'chart'. DS . 'sectorwise_mcap_compare.png';
        $f = fopen($chartImagePath, "wb");
        fwrite($f, $chartData);
        fclose($f);
        $img = new Image_Toolbox($chartImagePath);
        $width=$img->_img['main']['width'];
        $img->addImage($width,10,'#ffffff');
        $img->blendMask('left','bottom',IMAGE_TOOLBOX_BLEND_COPY, 0, 240);
        $img->output();
    }
    
   function sector_intraday1( $sector = '')//backup. not longer used
    {
        //Configure::write('debug',3);
        $this->layout = 'default-compare';
        $this->pageTitle = 'Stock Bangladesh :: Sector Share Impact';
        
        $sectorArr = $this->Symbol->find ( 'all', array ('conditions' => array ('inactive= \'No\' AND otc_market= \'No\' AND business_segment!=\'\' AND business_segment!=\'Mutual Funds\' AND business_segment!=\'Corporate Bond\''), 'fields' => array ('DISTINCT Symbol.business_segment'),'order'=> array('business_segment ASC') ) );
        foreach($sectorArr as $arr)
        {
            $sec_name = $arr['Symbol']['business_segment'];
            if($sec_name == 'Food & Allied' )
            {
             $sec_name = 'Food and Allied'; 
            }
            elseif($sec_name == 'Fuel & Power' )
            {
             $sec_name = 'Fuel and Power';
             
            }
            elseif($sec_name == 'Pharmaceuticals & Chemicals' )
            {
             $sec_name = 'Pharmaceuticals and Chemicals';
             
            }
            elseif($sec_name == 'Services & Real Estate' )
            {
             $sec_name = 'Services and Real Estate';
             
            }
            elseif($sec_name == 'Paper & Printing' )
            {
             $sec_name = 'Paper and Printing';
             
            }
            elseif($sec_name == 'Travel & Leisure' )
            {
             $sec_name = 'Travel and Leisure';
             
            }
            $sectors[] = $sec_name;
        }
        if($sector=='')
         {
           $sector='Bank';
         }
        $this->set('sector_name',$sectors);
        $this->set('key',$sector);
        
    }
   
   
    function sector_intraday( $sector = '')
    {
        if (! $this->Session->check ( 'Auth.User' )) {
            $this->Session->setFlash ( 'You are not authorized to access that location.' );
            $this->redirect ( array ('controller' => 'users', 'action' => 'login' ) );
        }
        //Configure::write('debug',3);
        $this->layout = 'default-compare';
        $this->pageTitle = 'Stock Bangladesh :: Sector Share Impact';
        
        $sectorArr = $this->Symbol->find ( 'all', array ('conditions' => array ('inactive= \'No\' AND otc_market= \'No\' AND business_segment!=\'\' AND business_segment!=\'Mutual Funds\' AND business_segment!=\'Corporate Bond\''), 'fields' => array ('DISTINCT Symbol.business_segment'),'order'=> array('business_segment ASC') ) );
        foreach($sectorArr as $arr)
        {
            $sec_name = $arr['Symbol']['business_segment'];
            if($sec_name == 'Food & Allied' )
            {
             $sec_name = 'Food and Allied'; 
            }
            elseif($sec_name == 'Fuel & Power' )
            {
             $sec_name = 'Fuel and Power';
             
            }
            elseif($sec_name == 'Pharmaceuticals & Chemicals' )
            {
             $sec_name = 'Pharmaceuticals and Chemicals';
             
            }
            elseif($sec_name == 'Services & Real Estate' )
            {
             $sec_name = 'Services and Real Estate';
             
            }
            elseif($sec_name == 'Paper & Printing' )
            {
             $sec_name = 'Paper and Printing';
             
            }
            elseif($sec_name == 'Travel & Leisure' )
            {
             $sec_name = 'Travel and Leisure';
             
            }
            $sectors[] = $sec_name;
        }
        if($sector=='')
         {
           $sector='Bank';
         }
        $this->set('sector_name',$sectors);
        $this->set('key',$sector);
        
    }
    function sectorchart1()//backup. not longer used
    {

        $this->layout = 'default-three';

        $this->pageTitle = 'Stock Bangladesh :: Watch the price movement of selected share';



        App::import ( 'Vendor', 'json', array ('file' => 'JSON.php' ) );



        if (isset ( $_POST ) && ! empty ( $_POST )) {

            $TickerSymbol1 = $_POST ['TickerSymbol1'];

            $TickerSymbol2 = $_POST ['TickerSymbol2'];

            $TickerSymbol3 = $_POST ['TickerSymbol3'];

            $TickerSymbol4 = $_POST ['TickerSymbol4'];

            $TickerSymbol5 = $_POST ['TickerSymbol5'];

            $TickerSymbol6 = $_POST ['TickerSymbol6'];

            $TickerSymbol7 = $_POST ['TickerSymbol7'];

            $TickerSymbol8 = $_POST ['TickerSymbol8'];

            $TickerSymbol9 = $_POST ['TickerSymbol9'];
            
            $TickerSymbol10 = $_POST ['TickerSymbol10'];
            
            $TickerSymbol11 = $_POST ['TickerSymbol11'];
            
            $TickerSymbol12 = $_POST ['TickerSymbol12'];
            
            $TickerSymbol13 = $_POST ['TickerSymbol13'];
            
            $TickerSymbol14 = $_POST ['TickerSymbol14'];
            
            $TickerSymbol15 = $_POST ['TickerSymbol15'];
            
            $TickerSymbol16 = $_POST ['TickerSymbol16'];
            
            $TickerSymbol17 = $_POST ['TickerSymbol17'];
            
            $TickerSymbol18 = $_POST ['TickerSymbol18'];
            
            $TickerSymbol19 = $_POST ['TickerSymbol19'];
            
            $TickerSymbol20 = $_POST ['TickerSymbol20'];



            /*if (isset ( $_POST ['inv'] )) {

                $inv = $_POST ['inv'];

            } else {

                $inv = 300;

            }*/



            $this->set ( 'TickerSymbol1', $TickerSymbol1 );

            $this->set ( 'TickerSymbol2', $TickerSymbol2 );

            $this->set ( 'TickerSymbol3', $TickerSymbol3 );

            $this->set ( 'TickerSymbol4', $TickerSymbol4 );

            $this->set ( 'TickerSymbol5', $TickerSymbol5 );

            $this->set ( 'TickerSymbol6', $TickerSymbol6 );

            $this->set ( 'TickerSymbol7', $TickerSymbol7 );

            $this->set ( 'TickerSymbol8', $TickerSymbol8 );

            $this->set ( 'TickerSymbol9', $TickerSymbol9 );
            
            $this->set ( 'TickerSymbol10', $TickerSymbol10 );
            
            $this->set ( 'TickerSymbol11', $TickerSymbol11 );
            
            $this->set ( 'TickerSymbol12', $TickerSymbol12 );
            
            $this->set ( 'TickerSymbol13', $TickerSymbol13 );
            
            $this->set ( 'TickerSymbol14', $TickerSymbol14 );
            
            $this->set ( 'TickerSymbol15', $TickerSymbol15 );
                                                         
            $this->set ( 'TickerSymbol16', $TickerSymbol16 );
            
            $this->set ( 'TickerSymbol17', $TickerSymbol17 );
            
            $this->set ( 'TickerSymbol18', $TickerSymbol18 );
            
            $this->set ( 'TickerSymbol19', $TickerSymbol19 );
            
            $this->set ( 'TickerSymbol20', $TickerSymbol20 );

        }

        //$this->set ( 'inv', $inv );

    } 
    function sectorchart() 
    {

        $this->layout = 'default-three';

        $this->pageTitle = 'Stock Bangladesh :: Watch the price movement of selected share';



        App::import ( 'Vendor', 'json', array ('file' => 'JSON.php' ) );



        if (isset ( $_POST ) && ! empty ( $_POST )) {

            $TickerSymbol1 = $_POST ['TickerSymbol1'];

            $TickerSymbol2 = $_POST ['TickerSymbol2'];

            $TickerSymbol3 = $_POST ['TickerSymbol3'];

            $TickerSymbol4 = $_POST ['TickerSymbol4'];

            $TickerSymbol5 = $_POST ['TickerSymbol5'];

            $TickerSymbol6 = $_POST ['TickerSymbol6'];

            $TickerSymbol7 = $_POST ['TickerSymbol7'];

            $TickerSymbol8 = $_POST ['TickerSymbol8'];

            $TickerSymbol9 = $_POST ['TickerSymbol9'];
            
            $TickerSymbol10 = $_POST ['TickerSymbol10'];
            
            $TickerSymbol11 = $_POST ['TickerSymbol11'];
            
            $TickerSymbol12 = $_POST ['TickerSymbol12'];
            
            $TickerSymbol13 = $_POST ['TickerSymbol13'];
            
            $TickerSymbol14 = $_POST ['TickerSymbol14'];
            
            $TickerSymbol15 = $_POST ['TickerSymbol15'];
            
            $TickerSymbol16 = $_POST ['TickerSymbol16'];
            
            $TickerSymbol17 = $_POST ['TickerSymbol17'];
            
            $TickerSymbol18 = $_POST ['TickerSymbol18'];
            
            $TickerSymbol19 = $_POST ['TickerSymbol19'];
            
            $TickerSymbol20 = $_POST ['TickerSymbol20'];



            /*if (isset ( $_POST ['inv'] )) {

                $inv = $_POST ['inv'];

            } else {

                $inv = 300;

            }*/



            $this->set ( 'TickerSymbol1', $TickerSymbol1 );

            $this->set ( 'TickerSymbol2', $TickerSymbol2 );

            $this->set ( 'TickerSymbol3', $TickerSymbol3 );

            $this->set ( 'TickerSymbol4', $TickerSymbol4 );

            $this->set ( 'TickerSymbol5', $TickerSymbol5 );

            $this->set ( 'TickerSymbol6', $TickerSymbol6 );

            $this->set ( 'TickerSymbol7', $TickerSymbol7 );

            $this->set ( 'TickerSymbol8', $TickerSymbol8 );

            $this->set ( 'TickerSymbol9', $TickerSymbol9 );
            
            $this->set ( 'TickerSymbol10', $TickerSymbol10 );
            
            $this->set ( 'TickerSymbol11', $TickerSymbol11 );
            
            $this->set ( 'TickerSymbol12', $TickerSymbol12 );
            
            $this->set ( 'TickerSymbol13', $TickerSymbol13 );
            
            $this->set ( 'TickerSymbol14', $TickerSymbol14 );
            
            $this->set ( 'TickerSymbol15', $TickerSymbol15 );
                                                         
            $this->set ( 'TickerSymbol16', $TickerSymbol16 );
            
            $this->set ( 'TickerSymbol17', $TickerSymbol17 );
            
            $this->set ( 'TickerSymbol18', $TickerSymbol18 );
            
            $this->set ( 'TickerSymbol19', $TickerSymbol19 );
            
            $this->set ( 'TickerSymbol20', $TickerSymbol20 );

        }

        //$this->set ( 'inv', $inv );

    } 
    
    function mmSectorChart($chart = '') //not longer used
    {
        require_once (WWW_ROOT . DS . 'chart' . DS . 'phpchartdir.php');
        require_once (WWW_ROOT . DS . 'chart' . DS . 'Image_Toolbox.class.php');
        $sector = $_GET ['sym'];

        $sector = trim ( $sector );
        
        if(!empty($sector))
        {
            if($sector == 'Food and Allied' )
            {
             $sector_is = 'Food & Allied'; 
            }
            elseif($sector == 'Fuel and Power' )
            { 
             $sector_is = 'Fuel & Power';
            }
            elseif($sector == 'Pharmaceuticals and Chemicals' )
            {
            
             $sector_is = 'Pharmaceuticals & Chemicals';
            }
            elseif($sector == 'Services and Real Estate' )
            {
             $sector_is = 'Services & Real Estate';
             
            }
            elseif($sector == 'Paper and Printing' )
            {
             $sector_is = 'Paper & Printing';
             
            }
            elseif($sector == 'Travel and Leisure' )
            {
             $sector_is = 'Travel & Leisure';
            }
            else
            $sector_is = $sector;
            
        
        $this->set('key',$sector);
        
        $sql = "SELECT * FROM market_summeries ORDER BY id DESC LIMIT 0, 2";
        $marketArr = $this->Symbol->query ($sql);
        $lastdate = $marketArr [0] ['market_summeries'] ['date'];
        
        
        $dataSql = "SELECT * FROM sbsector_intraday where date_time LIKE '%$lastdate%' AND sector = '$sector_is' order by datestamp ASC ";
        $dataInfo = $this->Symbol->query($dataSql);
        $diff = 0;
        foreach($dataInfo as $arr)
        {
            $data[] = $arr['sbsector_intraday']['index_change'];
            $xlabel[] = date('h:i',$arr['sbsector_intraday']['datestamp']);
            $cont[] = $arr['sbsector_intraday']['contribution'];
            $price_change[] = $arr['sbsector_intraday']['price_change'];
            $vol[] = $arr['sbsector_intraday']['volume']/1000000 - $diff;
            $diff = $arr['sbsector_intraday']['volume']/1000000;
        }  
        
        $contCount = count($cont);
        //$c = new XYChart(700, 400);
        $c = new XYChart ( 305, 290 );
        //$c->setPlotArea(50, 25, 600, 250);
        $c->setBackground ( $c->linearGradientColor ( 0, 0, 0, 290, 0xEFF1F2, 0xffffff ), 0xE3EFC2 );

        $c->setRoundedFrame ( 0xffffff, 0 );
        $c->setPlotArea(50, 40, 200, 180);

        $legendObj = $c->addLegend(55, 5, false, "", 8);
        $legendObj->setBackground(Transparent);
        
        //$textBoxObj = $c->addText ( 100, 10, "www.stockbangladesh.com", "timesbi.ttf", 9, 0xc09090 );
        $textBoxObj = $c->addText ( 150, 10, $sector, "times.ttf", 16, 0x000000 );
        $textBoxObj->setAlignment ( TopCenter );
        #set the background color
        //$titleObj->setBackground($c->patternColor(array(0x4000, 0x8000), 2));

        # Add a title to the x axis
        $c->xAxis->setTitle("Time", "arial.ttf", 10);
        
        # Add a title to the y axis
        $c->yAxis->setTitle("Index Change", "arial.ttf", 10);

        $c->xAxis->setLabelStyle ( "Arial", 8, TextColor, 90 );
        # Set the labels on the x axis.
        $c->xAxis->setLabels($xlabel);      
        
        
        # set the axis, label and title colors for the primary y axis to green (0x008000) to
        # match the second data set
        
        # Display 1 out of 2 labels on the x-axis. Show minor ticks for remaining labels.
        $c->xAxis->setLabelStep(3, 1);
        
        # Add three area layers, each representing one data set. The areas are drawn in
        # semi-transparent colors.
        
        //$c->addLineLayer($data, 0x8000EB00, $sector." Index Change  ".$lastdate);
        
        //$c->addLineLayer(array(), Transparent, "Title AAA BBB");
        $layer = $c->addLineLayer($data, 0x80FF0000);
        $ds = $layer->getDataSet(0);
        $ds->setDataSymbol(DiamondSymbol, 5);
        $layer->setLineWidth(2);
        
        //$barcolor = "0x00FFFF, 0xFF00FF,0x800000";
        //$colors = array(0x00FFFF, 0xFF00FF,0x000000, 0x00FFFF, 0xFF00FF,0x000000, 0x00FFFF, 0xFF00FF,0x000000, 0x00FFFF, 0xFF00FF,0x000000, 0x00FFFF, 0xFF00FF,0x000000,0x00FFFF, 0xFF00FF,0x000000, 0x00FFFF, 0xFF00FF,0x000000, 0x00FFFF, 0xFF00FF,0x000000, 0x00FFFF, 0xFF00FF,0x000000, 0x00FFFF, 0xFF00FF,0x000000, 0x00FFFF, 0xFF00FF,0x000000, 0x00FFFF, 0xFF00FF,0x000000, 0x00FFFF, 0xFF00FF,0x000000,0x00FFFF, 0xFF00FF,0x000000, 0x00FFFF, 0xFF00FF,0x000000, 0x00FFFF, 0xFF00FF,0x000000);
        //$colors = array(0xf9ccdf, 0xf58220, 0xd4e6ae, 0xc2d76e, 0xf9ccdf,0xf58220,0xd4e6ae,0xc2d76e,0xf9ccdf,0xf58220,0xd4e6ae,0xc2d76e,0xf9ccdf,0xf58220,0xd4e6ae,0xc2d76e,0xf9ccdf,0xf58220,0xd4e6ae,0xc2d76e,0xf9ccdf,0xf58220,0xd4e6ae,0xc2d76e,0xf9ccdf, 0xf58220, 0xd4e6ae, 0xc2d76e, 0xf9ccdf,0xf58220,0xd4e6ae,0xc2d76e,0xf9ccdf,0xf58220,0xd4e6ae,0xc2d76e,0xf9ccdf,0xf58220,0xd4e6ae,0xc2d76e,0xf9ccdf,0xf58220,0xd4e6ae,0xc2d76e,0xf9ccdf,0xf58220,0xd4e6ae,0xc2d76e);
        $colors = array(0xff0000, 0x00ff00, 0xff0000, 0x00ff00, 0xff0000, 0x00ff00,0xff0000, 0x00ff00,0xff0000, 0x00ff00,0xff0000, 0x00ff00,0xff0000, 0x00ff00,0xff0000, 0x00ff00,0xff0000, 0x00ff00,0xff0000, 0x00ff00,0xff0000, 0x00ff00,0xff0000, 0x00ff00,0xff0000, 0x00ff00, 0xff0000, 0x00ff00, 0xff0000, 0x00ff00,0xff0000, 0x00ff00,0xff0000, 0x00ff00,0xff0000, 0x00ff00,0xff0000, 0x00ff00,0xff0000, 0x00ff00,0xff0000, 0x00ff00,0xff0000, 0x00ff00,0xff0000, 0x00ff00,0xff0000, 0x00ff00);
        $barLayerObj = $c->addBarLayer3 ($vol,$colors);
        $barLayerObj->setBorderColor(-1, 1);

        //$barLayerObj->setBarShape (CircleShape );
        $barLayerObj->setUseYAxis2 ();
        
        //$dataSetObj = $layer->addDataSet($data1, 0x40cf40, "Cost Price Basis NAV ".$data1[count($data1)-1]);
        //$c->setDataSymbol(DiamondSymbol, 5);
        
        $chartData=$c->makeChart2(PNG);
        
        /*$chartImagePath = WWW_ROOT . 'chart'. DS . 'sbindexchart.png';
        $f = fopen($chartImagePath, "wb");
        fwrite($f, $chartData);
        fclose($f);
        $img = new Image_Toolbox($chartImagePath);
        $img->output();
        $chartData = $c->makeChart2 ( PNG );*/
        print($chartData);
        } 
        
    }
    
    function mmSectorChartnew($chart = '')
    {
        $sector = $_GET ['sym'];

        $sector = trim ( $sector );
        
        if(!empty($sector))
        {
            if($sector == 'Food and Allied' )
            {
             $sector_is = 'Food & Allied'; 
            }
            elseif($sector == 'Fuel and Power' )
            { 
             $sector_is = 'Fuel & Power';
            }
            elseif($sector == 'Pharmaceuticals and Chemicals' )
            {
            
             $sector_is = 'Pharmaceuticals & Chemicals';
            }
            elseif($sector == 'Services and Real Estate' )
            {
             $sector_is = 'Services & Real Estate';
             
            }
            elseif($sector == 'Paper and Printing' )
            {
             $sector_is = 'Paper & Printing';
             
            }
            elseif($sector == 'Travel and Leisure' )
            {
             $sector_is = 'Travel & Leisure';
            }
            else
            $sector_is = $sector;
            
        
        $this->set('key',$sector);
        
        $sql = "SELECT * FROM market_summeries ORDER BY id DESC LIMIT 0, 2";
        $marketArr = $this->Symbol->query ($sql);
        $lastdate = $marketArr [0] ['market_summeries'] ['date'];
        
        
        $dataSql = "SELECT * FROM sbsector_intraday where date_time LIKE '%$lastdate%' AND sector like '$sector_is%' order by datestamp ASC ";
        $dataInfo = $this->Symbol->query($dataSql);
        $diff = 0;
        foreach($dataInfo as $arr)
        {
            $data[] = $arr['sbsector_intraday']['index_change'];
            $xlabel[] = $arr['sbsector_intraday']['datestamp'];//date('h:i',$arr['sbsector_intraday']['datestamp']);
            $cont[] = $arr['sbsector_intraday']['contribution'];
            $price_change[] = $arr['sbsector_intraday']['price_change'];
            $vol[] = $arr['sbsector_intraday']['volume']/1000000 - $diff;
            $diff = $arr['sbsector_intraday']['volume']/1000000;
        }  
        //himel
        $count_v=count($vol);
        for($i=0;$i<$count_v;$i++)
        {
            $volume_array[]=array('x' => (int)$xlabel[$i],'y' =>$vol[$i]);
        }
        $count_p=count($data);
        for($i=0;$i<$count_p;$i++)
        {
            $index_change_array[]=array('x' => (int)$xlabel[$i],'y' => (double)$data[$i]);
        }
        $data_json['title']=$sector;
        $data_json['index_change']=$index_change_array;
        $data_json['volume']=$volume_array;
            
            $jsonresult = $this->__JEncode ( $data_json );
            echo $jsonresult;
            die;
        
        
        
        $contCount = count($cont);
        //$c = new XYChart(700, 400);
        $c = new XYChart ( 305, 290 );
        //$c->setPlotArea(50, 25, 600, 250);
        $c->setBackground ( $c->linearGradientColor ( 0, 0, 0, 290, 0xEFF1F2, 0xffffff ), 0xE3EFC2 );

        $c->setRoundedFrame ( 0xffffff, 0 );
        $c->setPlotArea(50, 40, 200, 180);

        $legendObj = $c->addLegend(55, 5, false, "", 8);
        $legendObj->setBackground(Transparent);
        
        //$textBoxObj = $c->addText ( 100, 10, "www.stockbangladesh.com", "timesbi.ttf", 9, 0xc09090 );
        $textBoxObj = $c->addText ( 150, 10, $sector, "times.ttf", 16, 0x000000 );
        $textBoxObj->setAlignment ( TopCenter );
        #set the background color
        //$titleObj->setBackground($c->patternColor(array(0x4000, 0x8000), 2));

        # Add a title to the x axis
        $c->xAxis->setTitle("Time", "arial.ttf", 10);
        
        # Add a title to the y axis
        $c->yAxis->setTitle("Index Change", "arial.ttf", 10);

        $c->xAxis->setLabelStyle ( "Arial", 8, TextColor, 90 );
        # Set the labels on the x axis.
        $c->xAxis->setLabels($xlabel);      
        
        
        # set the axis, label and title colors for the primary y axis to green (0x008000) to
        # match the second data set
        
        # Display 1 out of 2 labels on the x-axis. Show minor ticks for remaining labels.
        $c->xAxis->setLabelStep(3, 1);
        
        # Add three area layers, each representing one data set. The areas are drawn in
        # semi-transparent colors.
        
        //$c->addLineLayer($data, 0x8000EB00, $sector." Index Change  ".$lastdate);
        
        //$c->addLineLayer(array(), Transparent, "Title AAA BBB");
        $layer = $c->addLineLayer($data, 0x80FF0000);
        $ds = $layer->getDataSet(0);
        $ds->setDataSymbol(DiamondSymbol, 5);
        $layer->setLineWidth(2);
        
        //$barcolor = "0x00FFFF, 0xFF00FF,0x800000";
        //$colors = array(0x00FFFF, 0xFF00FF,0x000000, 0x00FFFF, 0xFF00FF,0x000000, 0x00FFFF, 0xFF00FF,0x000000, 0x00FFFF, 0xFF00FF,0x000000, 0x00FFFF, 0xFF00FF,0x000000,0x00FFFF, 0xFF00FF,0x000000, 0x00FFFF, 0xFF00FF,0x000000, 0x00FFFF, 0xFF00FF,0x000000, 0x00FFFF, 0xFF00FF,0x000000, 0x00FFFF, 0xFF00FF,0x000000, 0x00FFFF, 0xFF00FF,0x000000, 0x00FFFF, 0xFF00FF,0x000000, 0x00FFFF, 0xFF00FF,0x000000,0x00FFFF, 0xFF00FF,0x000000, 0x00FFFF, 0xFF00FF,0x000000, 0x00FFFF, 0xFF00FF,0x000000);
        //$colors = array(0xf9ccdf, 0xf58220, 0xd4e6ae, 0xc2d76e, 0xf9ccdf,0xf58220,0xd4e6ae,0xc2d76e,0xf9ccdf,0xf58220,0xd4e6ae,0xc2d76e,0xf9ccdf,0xf58220,0xd4e6ae,0xc2d76e,0xf9ccdf,0xf58220,0xd4e6ae,0xc2d76e,0xf9ccdf,0xf58220,0xd4e6ae,0xc2d76e,0xf9ccdf, 0xf58220, 0xd4e6ae, 0xc2d76e, 0xf9ccdf,0xf58220,0xd4e6ae,0xc2d76e,0xf9ccdf,0xf58220,0xd4e6ae,0xc2d76e,0xf9ccdf,0xf58220,0xd4e6ae,0xc2d76e,0xf9ccdf,0xf58220,0xd4e6ae,0xc2d76e,0xf9ccdf,0xf58220,0xd4e6ae,0xc2d76e);
        $colors = array(0xff0000, 0x00ff00, 0xff0000, 0x00ff00, 0xff0000, 0x00ff00,0xff0000, 0x00ff00,0xff0000, 0x00ff00,0xff0000, 0x00ff00,0xff0000, 0x00ff00,0xff0000, 0x00ff00,0xff0000, 0x00ff00,0xff0000, 0x00ff00,0xff0000, 0x00ff00,0xff0000, 0x00ff00,0xff0000, 0x00ff00, 0xff0000, 0x00ff00, 0xff0000, 0x00ff00,0xff0000, 0x00ff00,0xff0000, 0x00ff00,0xff0000, 0x00ff00,0xff0000, 0x00ff00,0xff0000, 0x00ff00,0xff0000, 0x00ff00,0xff0000, 0x00ff00,0xff0000, 0x00ff00,0xff0000, 0x00ff00);
        $barLayerObj = $c->addBarLayer3 ($vol,$colors);
        $barLayerObj->setBorderColor(-1, 1);

        //$barLayerObj->setBarShape (CircleShape );
        $barLayerObj->setUseYAxis2 ();
        
        //$dataSetObj = $layer->addDataSet($data1, 0x40cf40, "Cost Price Basis NAV ".$data1[count($data1)-1]);
        //$c->setDataSymbol(DiamondSymbol, 5);
        
        $chartData=$c->makeChart2(PNG);
        
        /*$chartImagePath = WWW_ROOT . 'chart'. DS . 'sbindexchart.png';
        $f = fopen($chartImagePath, "wb");
        fwrite($f, $chartData);
        fclose($f);
        $img = new Image_Toolbox($chartImagePath);
        $img->output();
        $chartData = $c->makeChart2 ( PNG );*/
        print($chartData);
        } 
        
    }
    
    function datamatrix_week() {

        $this->layout = 'default-matrix';

        $this->pageTitle = 'Data Matrix-Easy search and sorting';
        $this->set("meta_description", "data grid for all company");
        $this->set("meta_keywords", "company search, grouping company");
        
    }
        
    

    
    function getpricelist_week() {
    //Configure::write('debug',3);
    $symbolSQl = "SELECT * FROM symbols WHERE inactive='No' AND otc_market='No' AND id>4";
    $symbolQRY = $this->Symbol->query($symbolSQl);
    $symbolArr = array();
    foreach($symbolQRY as $symbols)
    {
        $symbol_id = $symbols['symbols']['id'];
        $symbol_name = $symbols['symbols']['dse_code'];
        $symbolArr[$symbol_id] =$symbols; 
    }
    /*echo '<pre>';
    print_r($symbolArr);
    die;*/
    $outputweekSQl = "SELECT * FROM outputs_week WHERE symbol=1 ORDER BY id DESC LIMIT 3";
    $outputweekQRY = mysql_query($outputweekSQl);
    $weekDate = array();    
    while($outputweekData = mysql_fetch_assoc($outputweekQRY))
    {
        $weekDate[] = $outputweekData['date'];        
    }
    /*echo '<pre>';
    print_r($weekDate);*/
    //die;
    
    list($fDay1,$fMn1,$fYr1) = explode("-",$weekDate[1]);    
    list($fDay2,$fMn2,$fYr2) = explode("-",$weekDate[0]);
    
    if(mktime(0,0,0,$fMn1,$fDay1,$fYr1) > mktime(0,0,0,$fMn2,$fDay2,$fYr2))
    {
        $weekendDate   = $weekDate[1];
        $weekstartDate = $weekDate[0];
    }
    else
    {
        $weekendDate   = $weekDate[0];
        $weekstartDate = $weekDate[1];
    }
    $prevweekendDate = $weekDate[2];
    //echo $prevweekendDate."+".$weekstartDate ."+".$weekendDate."<br>";
    /*echo "<pre>";*/
    $outputweekDataSQl = 
    "SELECT * FROM outputs_week WHERE date='".$weekstartDate."'
    UNION ALL 
    SELECT * FROM outputs_week WHERE date='".$weekendDate."'
    UNION ALL 
    SELECT * FROM outputs_week WHERE date='".$prevweekendDate."'
    ";
    
    $outputweekDataQRY = mysql_query($outputweekDataSQl);
     /*pr($outputweekDataQRY);
     die;*/
    $outputweekDataArr = array();
    while($outputweekData = mysql_fetch_assoc($outputweekDataQRY))
    {
        $outputweekDataArr[$outputweekData['symbol']][] = $outputweekData;
    }
    /*echo $outputweekDataSQl;
    echo '<pre>';*/
    
    // pr($outputweekDataArr);
     //die; 
    $outputweeklyDataArrFinal = array();
    $count = 0;
    foreach($outputweekDataArr AS $symbol => $dataArr)
    {
        $close    = 0;
        $open     = 0;
        $volume   = 0;
        $tradeVal = 0;
        $trade    = 0;
        $high     = 0;
        $low      = 0;
        $count++;
        
        if($weekendDate == $dataArr[0]['date'])
        {
            //echo $weekstartDate ."==". $dataArr[0]['date'].'1<br>';
            $close     = $dataArr[0]['close'];
            $volume   += $dataArr[0]['volume'];
            $tradeVal += $dataArr[0]['tradevalues'];
            $trade    += $dataArr[0]['trade'];
            $high      = $dataArr[0]['high'];
            $low       = $dataArr[0]['low'];
        }
        else if($weekendDate == $dataArr[1]['date'])
        {
            //echo $weekstartDate ."==". $dataArr[1]['date'].'2<br>';
            $close     = $dataArr[1]['close'];
            $volume   += $dataArr[1]['volume'];
            $tradeVal += $dataArr[1]['tradevalues'];
            $trade    += $dataArr[1]['trade'];
            $high      = $dataArr[1]['high'];
            $low       = $dataArr[1]['low'];
        }
         
        if($weekstartDate == $dataArr[0]['date'])
        {
            //echo $weekendDate ."==". $dataArr[0]['date'].'3<br>';
            $open      = $dataArr[0]['open'];
            $volume   += $dataArr[0]['volume'];
            $tradeVal += $dataArr[0]['tradevalues'];
            $trade    += $dataArr[0]['trade'];
            if($high < $dataArr[0]['high'])
                $high = $dataArr[0]['high'];
            if($low > $dataArr[0]['low'])
                $low = $dataArr[0]['low'];
            
        }
        else if($weekstartDate == $dataArr[1]['date'])
        {
            //echo $weekendDate ."==". $dataArr[1]['date'].'4<br>';
            $open      = $dataArr[1]['open'];
            
            $volume   += $dataArr[1]['volume'];
            $tradeVal += $dataArr[1]['tradevalues'];
            $trade    += $dataArr[1]['trade'];
            if($high < $dataArr[1]['high'])
                $high = $dataArr[1]['high'];
            if($low > $dataArr[1]['low'])
                $low = $dataArr[1]['low'];
        }
        $lwcp = $dataArr[2]['close'];
        $eps = 0;
        $temp = array();
        if($symbolArr[$symbol]['symbols']['q4']!=0)$eps=(float)$symbolArr[$symbol]['symbols']['q4'];
        else if($symbolArr[$symbol]['symbols']['q3']!=0)$eps=(float)$symbolArr[$symbol]['symbols']['q3']*(4/3);
        else if($symbolArr[$symbol]['symbols']['q2']!=0)$eps=(float)$symbolArr[$symbol]['symbols']['q2']*2;
        else if($symbolArr[$symbol]['symbols']['q1']!=0)$eps=(float)$symbolArr[$symbol]['symbols']['q1']*4;
        $pe=0;
        if($eps!=0)
        {
           $pe = $symbolArr[$symbol]['symbols']['lasttradeprice']/$eps; 
        }
        
       
       if(!empty($symbolArr[$symbol]['symbols']['business_segment']))
       {
        if(($open!=0) &&($high!=0) && ($low!=0)&&($close!=0))
        {
            $temp['id']          = $symbolArr[$symbol]['symbols']['id'];
            $temp['code']        = $symbolArr[$symbol]['symbols']['dse_code'];
            $temp['face_value']  = $symbolArr[$symbol]['symbols']['face_value'];
            $temp['market_lot']  = $symbolArr[$symbol]['symbols']['market_lot'];
            $temp['sector']      = $symbolArr[$symbol]['symbols']['business_segment'];
            $temp['category']    = $symbolArr[$symbol]['symbols']['category'];
            $temp['lastprice']   = $close;
            $temp['change']     = round(($close - $lwcp),2);
            $temp['pchange']     = round(((($close - $lwcp)/$lwcp)*100),2);
            $temp['open']        = $open;
            $temp['close']       = $close;
            $temp['high']        = $high;
            $temp['low']         = $low;
            $temp['ycp']         = $lwcp;
            $temp['volume']      = $volume;
            $temp['value']       = $tradeVal;
            $temp['trade']       = $trade;
            $temp['eps']         = round($eps,2);
            $temp['pe']          = round($pe,2);
            $outputweeklyDataArrFinal[] = $temp;
        }
       }
    }
    
   /* pr($outputweeklyDataArrFinal);
    die;*/
    
     $jsonresult = $this->__JEncode ( $outputweeklyDataArrFinal );

      echo '({"total":"' . count ( $outputweeklyDataArrFinal ) . '","results":' . $jsonresult . '})';
        die ();

    }
    
    function sectorcompare_week() 
   {
       // Configure::write('debug',3);
        $this->layout = 'default-compare';
        $this->pageTitle = 'Stock Bangladesh :: Weekly Sector Comparison';
        
        /*$ip          = $_SERVER['REMOTE_ADDR'];
        $ipcheckSql  = "SELECT ip FROM user_ip WHERE is_active =1 AND ip='ipcheck'";
        $ipenable    = mysql_query($ipcheckSql);
        if(mysql_num_rows($ipenable))
        {
            $brokerIPSql = "SELECT ip FROM user_ip WHERE is_active =1 AND ip='".$ip."'";
            $access = mysql_query($brokerIPSql);
            if(!mysql_num_rows($access))
            {
                $this->Session->setFlash ( 'You are not authorized to access this location' );
                $this->redirect ( array ('controller' => 'users', 'action' => 'index' ) );
                //die("You are not authorized to access this location.");
            }
        }  */
        
        require_once (WWW_ROOT . DS . 'chart' . DS . 'phpchartdir.php');
        //require_once (WWW_ROOT . DS . 'chart' . DS . 'Image_Toolbox.class.php');
        
        $sectorSql = "SELECT DISTINCT(business_segment),business_segment_bangla FROM symbols WHERE inactive='No' AND otc_market='No' AND business_segment!=''";
        $sectorArr = $this->Symbol->query($sectorSql);
        foreach($sectorArr as $sectors)
        {
            $sector_name = $sectors['symbols']['business_segment'];
            $sector_name_bangla = $sectors['symbols']['business_segment_bangla'];
            $sectorArray[$sector_name] = $sector_name_bangla;
        } 
        $this->set('sector_name',$sectorArray);
        /*pr($sectorArr);
        die;*/
        
        $date = date('Y-m-d',strtotime('-2 week'));
        $prev_sunday = date('Y-m-d', strtotime($date.'next sunday'));
//$prev_sunday = '2011-10-30';
        $prev_sundaystamp = strtotime($prev_sunday);
        $prev_thursday = date('Y-m-d', strtotime($date.'next thursday'));
//$prev_thursday = '2011-11-03';
        $prev_thursdaystamp = strtotime($prev_thursday)+24*3600;
        //echo $prev_sunday.'<br />';
        //echo $prev_thursday.'<br />';
        
        //$present_date = date('Y-m-d',time());
        $present_date = date('Y-m-d',strtotime('-1 week'));
        $this_sunday = date('Y-m-d', strtotime($present_date.'next sunday'));
//$this_sunday = '2011-10-30';
        $this_sundaystamp = strtotime($this_sunday);
        $this_thursday = date('Y-m-d', strtotime($present_date.'next thursday'));
//$this_thursday = '2011-11-03';
        $this_thursdaystamp = strtotime($this_thursday)+24*3600;
        //echo $this_sunday.'<br />';
        //echo $this_thursday.'<br />';
        //die;
        
      /////////////****************for Previous week****************/////////////////////////////////
        
        $sql = "SELECT SUM(value) as total_marketCap FROM market_summeries where UNIX_TIMESTAMP(date) between $prev_sundaystamp AND $prev_thursdaystamp";
        $prevweekTotalmcap = $this->Symbol->query($sql);
        
        $prevweekmarketcap = $prevweekTotalmcap[0][0]['total_marketCap'] /1000000;
        $dataSqlPrev = "SELECT * FROM sbsector_summeries where datestamp between $prev_sundaystamp AND $prev_thursdaystamp order by datestamp ASC ";
        //$sectorinfoPrev = $this->Symbol->query($dataSqlPrev);
        $sectorinfoPrev = $this->Symbol->query($dataSqlPrev);
        
        $prevweekarr = array();
        $prevweektradevalues = 0;
        //$prevtotaltradevalues = 0;
        foreach($sectorArray as $sectors=>$banglaname)
        {
            $prevweektradevalues = 0;
            $symbol_sector = $sectors;
            
            foreach($sectorinfoPrev as $prevarr)
            {
                $prevsector = $prevarr['sbsector_summeries']['sector'];
                   if($symbol_sector == $prevsector)
                   {                   
                    $prevweektradevalues += $prevarr['sbsector_summeries']['sector_tradevalues'];
                    $prevweekarr['prevweek'][$prevsector] = $prevweektradevalues;
                   }
                   //$prevtotaltradevalues+=$prevarr['sbsector_summeries']['sector_tradevalues'];
            }
            $prevweekcontribution[$symbol_sector]['tradevalues'] = $prevweekarr['prevweek'][$symbol_sector];
            $prevweekcontribution[$symbol_sector]['contribution'] = ($prevweekarr['prevweek'][$symbol_sector]/$prevweekmarketcap)*100;
            
        }
        
        
     /////////////****************End for Previous week****************/////////////////////////////////
        
     /////////////****************for this week****************/////////////////////////////////////////
        $sql = "SELECT SUM(value) as total_marketCap FROM market_summeries where UNIX_TIMESTAMP(date) between $this_sundaystamp AND $this_thursdaystamp";
        $thisweekTotalmcap = $this->Symbol->query($sql);
        //pr($thisweekTotalmcap);
        $thisweekmarketcap = $thisweekTotalmcap[0][0]['total_marketCap'] /1000000;
        
        $dataSqlPresent = "SELECT * FROM sbsector_summeries where datestamp between $this_sundaystamp AND $this_thursdaystamp order by datestamp ASC ";
        $sectorinfoPresent = $this->Symbol->query($dataSqlPresent);
        
        $thisweekarr = array();
        $thisweektradevalues = 0;
        //$thistotaltradevalues = 0;
        foreach($sectorArray as $sectors=>$banglaname)
        {
            $thisweektradevalues = 0;
            $symbol_sector = $sectors;
            foreach($sectorinfoPresent as $thisarr)
            {
                $thissector = $thisarr['sbsector_summeries']['sector'];
                   if($symbol_sector == $thissector)
                   {                   
                    $thisweektradevalues += $thisarr['sbsector_summeries']['sector_tradevalues'];
                    $thisweekarr['thisweek'][$thissector] = $thisweektradevalues;
                   }
                   //$thistotaltradevalues+=$thisarr['sbsector_summeries']['sector_tradevalues'];
            }
            
            $thisweekcontribution[$symbol_sector]['tradevalues'] = $thisweekarr['thisweek'][$symbol_sector];
            $thisweekcontribution[$symbol_sector]['contribution'] = ($thisweekarr['thisweek'][$symbol_sector]/$thisweekmarketcap)*100;
            
        }
        
        $this->set('previnfo',$prevweekcontribution);
        $_SESSION['previnfo'] = $prevweekcontribution;
        $this->set('thisinfo',$thisweekcontribution);
        $_SESSION['thisinfo'] = $thisweekcontribution;
        $this->set('thisTotal',$thisweekmarketcap);
        $this->set('prevTotal',$prevweekmarketcap);
        $this->set('prevsunday',$prev_sunday);
        $this->set('prevthursday',$prev_thursday);
        $this->set('thissunday',$this_sunday);
        $this->set('thisthursday',$this_thursday);
        
        
        foreach($sectorArray as $sectors=>$banglaname)
        {
            $sector_name = $sectors;
            $bangla_sector = $banglaname;
            $todayval = $thisweekcontribution[$sector_name]['tradevalues'];
            $prevval =  $prevweekcontribution[$sector_name]['tradevalues'];
            $change = $thisweekcontribution[$sector_name]['tradevalues'] - $prevweekcontribution[$sector_name]['tradevalues'];
            $todaycontrib = $thisweekcontribution[$sector_name]['contribution'];
            $prevcontrib =  $prevweekcontribution[$sector_name]['contribution'];
            $changecontrib = $todaycontrib - $prevcontrib;
            //$changeper = $thisweekcontribution[$sector_name]['tradevalues'] - $prevweekcontribution[$sector_name]['tradevalues'];
          $changeArr[$bangla_sector]['changecontrib'] = $changecontrib ; 
          $changeArr[$bangla_sector]['todayval'] = $todayval; 
          $changeArr[$bangla_sector]['prevval'] = $prevval; 
          $changeArr[$bangla_sector]['change'] = $change; 
          $changeArr[$bangla_sector]['todaycontrib'] = $todaycontrib;
          $changeArr[$bangla_sector]['prevcontrib'] = $prevcontrib;
          
        }
        arsort($changeArr);
        $this->set('change',$changeArr);
        
        //echo '<pre>';
        
        //print_r($changeArr);
        //die;
        foreach($thisweekcontribution as $sector=>$thisdata)
        {
          $data2[] = round($thisdata['contribution'],2);  
          $labels[] = $sector;
        }
        //pr($data2);
        //die;
        foreach($prevweekcontribution as $sector=>$prevdata)
        {
          $data[] = round($prevdata['contribution'],2);  
        }
        
        
        
        $colors = array (0xff9999, 0x9999ff, 0x66ff66 );

        #
        # Create the main chart, which contains the chart title, the outer ring, and the
        # legend box
        #


        # Create a PieChart object of size 450 x 360 pixels, with transparent background
        $c = new PieChart ( 950, 660,0xE7E6E6 );



        # Add a title to the chart with 18pts Times Bold Italic font
        $c->addTitle ( "Sector wise Weekly Market Composition", "timesbi.ttf", 15 );



        # Set donut center at (160, 200), and outer/inner radii as 150/100 pixels
        $c->setDonutSize ( 350, 325, 300, 200 );


        # Add a label at the bottom-right corner of the ring to label the outer ring Use
        # 12pts Arial Bold Italic font in white (ffffff) color, on a green (008800)
        # background, with soft lighting effect and 5 pixels rounded corners
        $t = $c->addText ( 295, 300, "This Week", "arial.ttf", 12, 0xffffff );

        $t->setBackground ( 0x008800, Transparent, softLighting () );

        $t->setRoundedCorners ( 5 );


        # Set the legend box at (320, 50) with 12 pts Arial Bold Italic font, with no border
        $legendObj = $c->addLegend ( 700, 100, true, "arial.ttf", 11 );

        $legendObj->setBackground ( Transparent, Transparent );


        # Set the pie data and the pie labels
        $c->setData ( $data, $labels );



        # Set the pie colors
        $c->setColors2 ( DataColor, $colors );



        # Set pie border color to white (ffffff)
        $c->setLineColor ( 0xFFFFFF );



        # Set pie label to value in $###M format, percentage in (##.#%) format, in two lines.
        $c->setLabelFormat ( "{percent|1}%" );



        # Use 10pts Airal Bold for the sector labels
        $c->setLabelStyle ( "arial.ttf", 10 );



        # Set the label position to -25 pixels from the sector (which would be internal to
        # the sector)
        $c->setLabelPos ( - 25 );

        //$c->setLabelLayout(SideLayout);


        # Create a PieChart object of size 280 x 320 pixels, with transparent background
        $c2 = new PieChart ( 550, 600, Transparent );



        # Set donut center at (110, 110), and outer/inner radii as 100/50 pixels
        $c2->setDonutSize ( 300, 235, 200, 50 );


        # Add a label at the center of the ring to label the inner ring. Use 12pts Arial Bold
        # Italic font in white (ffffff) color, on a deep blue (0000cc) background, with soft
        # lighting effect and 5 pixels rounded corners
        $t2 = $c2->addText ( 50, 10, "Prev Week", "arial.ttf", 12, 0xffffff, Center );

        $t2->setBackground ( 0x0000cc, Transparent, softLighting () );

        $t2->setRoundedCorners ( 5 );

        # Set the pie data and the pie labels
        $c2->setData ( $data2, $labels );


        # Set the pie colors
        $c2->setColors2 ( DataColor, $colors );


        # Set pie border color to white (ffffff)
        $c2->setLineColor ( 0xffffff );


        # Set pie label to value in $###M format, percentage in (##.#%) format, in two lines.
        $c2->setLabelFormat ( "{percent|1}%" );


        # Use 10pts Airal Bold for the sector labels
        $c2->setLabelStyle ( "arial.ttf", 10 );


        # Set the label position to -25 pixels from the sector (which would be internal to
        # the sector)
        $c2->setLabelPos ( - 25 );


        # merge the inner ring into the outer ring at (50, 90)
        $makeChartObj = $c->makeChart3 ();

        $makeChartObj->merge ( $c2->makeChart3 (), 50, 90, TopLeft, 0 );



        # Output the chart
        //header ( "Content-type: image/png" );
        //print ($c->makeChart2 ( PNG )) ;
        $chartData = $c->makeChart2 ( PNG );
        //print($chartData);
        
        
        $chartImagePath = WWW_ROOT . 'chart' . DS . 'sectorcomparechartweek.png';

        $f = fopen ( $chartImagePath, "wb" );

        fwrite ( $f, $chartData );

        fclose ( $f );
       
        
 /////////////****************End for this week****************/////////////////////////////////
}

function multibar_week($type=NULL){
App::import ( 'Vendor', 'Phpchartdir', array ('file' => 'phpchartdir.php'));
require_once (WWW_ROOT . DS . 'chart' . DS . 'Image_Toolbox.class.php');
# The data for the bar chart


foreach($_SESSION['thisinfo'] as $sectors=>$vals){
    $total_data[$sectors]['this'] = round($vals['tradevalues'],2);
    $total_data[$sectors]['prev'] = round($_SESSION['previnfo'][$sectors]['tradevalues'],2);
    $total_data[$sectors]['sector'] = $sectors;
}
/*arsort($total_data);
echo '<pre>';
print_r($total_data);
die;*/
//print_r($data1);
asort($total_data);
foreach($total_data as $key=>$data)
{
    $datatoday[] = $data['this'];
    $dataprevday[] = $data['prev'];
    $labels[] = $key;
}



# Create a XYChart object of size 600 x 350 pixels, using 0xe0e0ff as the background
# color, 0xccccff as the border color, with 1 pixel 3D border effect.
$c = new XYChart(700, 750, 0xe9ffe2, 0xccccff, 1);

#Set directory for loading images to current script directory
#Need when running under Microsoft IIS
$c->setSearchPath(dirname(__FILE__));

# Add a title to the chart using 14 points Times Bold Itatic font and light blue
# (0x9999ff) as the background color
$textBoxObj = $c->addTitle("", "timesbi.ttf", 14);
$textBoxObj->setBackground(0xe9ffe2);

# Set the plotarea at (60, 45) and of size 500 x 210 pixels, using white (0xffffff)
# as the background
$c->setPlotArea(120, 45, 500, 610, 0xffffff);

# Swap the x and y axes to create a horizontal bar chart
$c->swapXY();

# Add a title to the y axis using 11 pt Times Bold Italic as font
$c->yAxis->setTitle("Volume (millions)", "timesbi.ttf", 13);

# Set the labels on the x axis
$c->xAxis->setLabels($labels);

# Disable x-axis ticks by setting the tick length to 0
$c->xAxis->setTickLength(0);

# Add a stacked bar layer to the chart
$layer = $c->addBarLayer2(Stack);

$textBoxObj = $c->addText ( 400, 400, "www.stockbangladesh.org", "timesbi.ttf", 13, 0xc09090 );
$textBoxObj->setAlignment ( TopLeft );
        
# Add the first two data sets to the chart as a stacked bar group
$layer->addDataGroup("This Week");
$layer->addDataSet($datatoday, 0x8080ff, "Trade");

$layer->addDataGroup("Prev Week");
$layer->addDataSet($dataprevday, 0x80ff80, "Trade");

# Set the sub-bar gap to 0, so there is no gap between stacked bars with a group
$layer->setBarGap(0.2, 0);

# Set the bar border to transparent
$layer->setBorderColor(Transparent);

# Set the aggregate label format
//$layer->setAggregateLabelFormat("Year {dataGroupName}\n{value} millions");

# Set the aggregate label font to 8 point Arial Bold Italic
$layer->setAggregateLabelStyle("timesbi.ttf",10);

# Reverse 20% space at the right during auto-scaling to allow space for the aggregate
# bar labels
$c->yAxis->setAutoScale(0.1);

# Add a legend box at (310, 300) using TopCenter alignment, with 2 column grid
# layout, and use 8 pts Arial Bold Italic as font
$legendBox = $c->addLegend2(310, 700, 2, "arialbi.ttf", 13);
$legendBox->setAlignment(TopCenter);

# Set the format of the text displayed in the legend box
$legendBox->setText(" {dataGroupName} {dataSetName}");

# Set the background and border of the legend box to transparent
$legendBox->setBackground(Transparent, Transparent);

# Output the chart
header("Content-type: image/png");
print($c->makeChart2(PNG));
}
function multibar1_week($sectors=NULL){
App::import ( 'Vendor', 'Phpchartdir', array ('file' => 'phpchartdir.php'));
require_once (WWW_ROOT . DS . 'chart' . DS . 'Image_Toolbox.class.php');
# The data for the bar chart
foreach($_SESSION['thisinfo'] as $sectors=>$vals){
    $total_data[$sectors]['this'] = round($vals['contribution'],2);
    $total_data[$sectors]['prev'] = round($_SESSION['previnfo'][$sectors]['contribution'],2);
    $total_data[$sectors]['sector'] = $sectors;
}
/*arsort($total_data);
echo '<pre>';
print_r($total_data);
die;*/
//print_r($data1);
asort($total_data);
foreach($total_data as $key=>$data)
{
    $datatoday[] = $data['this'];
    $dataprevday[] = $data['prev'];
    $labels[] = $key;
}





# Create a XYChart object of size 600 x 350 pixels, using 0xe0e0ff as the background
# color, 0xccccff as the border color, with 1 pixel 3D border effect.
$c = new XYChart(700, 750, 0xe9ffe2, 0xccccff, 1);

#Set directory for loading images to current script directory
#Need when running under Microsoft IIS
$c->setSearchPath(dirname(__FILE__));

# Add a title to the chart using 14 points Times Bold Itatic font and light blue
# (0x9999ff) as the background color
$textBoxObj = $c->addTitle("", "timesbi.ttf", 14);
$textBoxObj->setBackground(0xe9ffe2);

# Set the plotarea at (60, 45) and of size 500 x 210 pixels, using white (0xffffff)
# as the background
$c->setPlotArea(120, 45, 500, 610, 0xffffff);

# Swap the x and y axes to create a horizontal bar chart
$c->swapXY();

# Add a title to the y axis using 11 pt Times Bold Italic as font
$c->yAxis->setTitle("Volume", "timesbi.ttf", 13);

# Set the labels on the x axis
$c->xAxis->setLabels($labels);

# Disable x-axis ticks by setting the tick length to 0
$c->xAxis->setTickLength(0);

# Add a stacked bar layer to the chart
$layer = $c->addBarLayer2(Stack);

$textBoxObj = $c->addText ( 400, 400, "www.stockbangladesh.org", "timesbi.ttf", 13, 0xc09090 );
$textBoxObj->setAlignment ( TopLeft );

# Add the first two data sets to the chart as a stacked bar group
$layer->addDataGroup("This Week");
$layer->addDataSet($datatoday, 0x8080ff, "Trade");

$layer->addDataGroup("Prev Week");
$layer->addDataSet($dataprevday, 0x80ff80, "Trade");

# Set the sub-bar gap to 0, so there is no gap between stacked bars with a group
$layer->setBarGap(0.2, 0);

# Set the bar border to transparent
$layer->setBorderColor(Transparent);

# Set the aggregate label format
//$layer->setAggregateLabelFormat("Year {dataGroupName}\n{value} millions");

# Set the aggregate label font to 8 point Arial Bold Italic
$layer->setAggregateLabelStyle("timesbi.ttf", 10);

# Reverse 20% space at the right during auto-scaling to allow space for the aggregate
# bar labels
$c->yAxis->setAutoScale(0.1);

# Add a legend box at (310, 300) using TopCenter alignment, with 2 column grid
# layout, and use 8 pts Arial Bold Italic as font
$legendBox = $c->addLegend2(310, 700, 2, "arialbi.ttf", 13);
$legendBox->setAlignment(TopCenter);

# Set the format of the text displayed in the legend box
$legendBox->setText(" {dataGroupName} {dataSetName} ");

# Set the background and border of the legend box to transparent
$legendBox->setBackground(Transparent, Transparent);

# Output the chart
header("Content-type: image/png");
print($c->makeChart2(PNG));
}
function multibar2_week($sectors=NULL){
 
 /*$tade_dates=mysql_fetch_array(mysql_query("SELECT * FROM market_summeries ORDER BY id desc LIMIT 1"));
 $current_date=$tade_dates['date'];*/
 $oneweekprevdate = $this->Symbol->query("SELECT date FROM `outputs_week` WHERE `symbol` =1 ORDER by id DESC");
 $weeklastdate = $oneweekprevdate[0]['outputs_week']['date'];
 
 $sqlStr="SELECT * FROM sector_weekly WHERE week_last_date = '$weeklastdate' ORDER BY sector DESC";
 $sectors=$this->Symbol->query($sqlStr);
 
App::import ( 'Vendor', 'Phpchartdir', array ('file' => 'phpchartdir.php')); 

foreach($sectors as $swdata){
 $labels[]=$swdata['sector_weekly']['sector'];
 $data0[]=$swdata['sector_weekly']['gt_two'];
 $data1[]=$swdata['sector_weekly']['lt_min_two'];
 $data2[]=$swdata['sector_weekly']['bt_min_two_zero'];
 $data3[]=$swdata['sector_weekly']['bt_two_zero'];
}


# Create a XYChart object of size 500 x 320 pixels. Use a vertical gradient color
# from pale blue (e8f0f8) to sky blue (aaccff) spanning half the chart height as
# background. Set border to blue (88aaee). Use rounded corners. Enable soft drop
# shadow.
$c = new XYChart(800, 520);
$c->setBackground($c->linearGradientColor(0, 0, 0, $c->getHeight() / 2, 0xffffff,0xffffff), 0x88aaee);
$c->setRoundedFrame();
$c->setDropShadow();

#Set directory for loading images to current script directory
#Need when running under Microsoft IIS
$c->setSearchPath(dirname(__FILE__));

# Add a title to the chart using 15 points Arial Italic. Set top/bottom margins to 15
# pixels.
$title = $c->addTitle("This Week Sectorwise Gainer Looser in-depth ", "ariali.ttf", 14);
$title->setMargin2(0, 0, 15, 15);

# Tentatively set the plotarea to 50 pixels from the left edge, and to just under the
# title. Set the width to 60% of the chart width, and the height to 50 pixels from
# the bottom edge. Use pale blue (e8f0f8) background, transparent border, and grey
# (aaaaaa) grid lines.
$c->setPlotArea(50, $title->getHeight(), $c->getWidth() * 6 / 10, $c->getHeight() -$title->getHeight() - 50, 0xe8f0f8, -1, Transparent, 0xaaaaaa);

# Add a legend box where the top-right corner is anchored at 10 pixels from the right
# edge, and just under the title. Use vertical layout and 8 points Arial font.
$legendBox = $c->addLegend($c->getWidth() - 10, $title->getHeight(), true, "arial.ttf", 8);
$legendBox->setAlignment(TopRight);

# Set the legend box background and border to transparent
$legendBox->setBackground(Transparent, Transparent);

# Set the legend box icon size to 16 x 32 pixels to match with custom icon size
$legendBox->setKeySize(16, 32);

# Set axes to transparent
$c->xAxis->setColors(Transparent);
$c->yAxis->setColors(Transparent);

# Set the labels on the x axis
$c->xAxis->setLabels($labels);

# Add a percentage bar layer
$layer = $c->addBarLayer2(Percentage);

$c->swapXY();
# Add the three data sets to the bar layer, using icons images with labels as data
# set names
$textBoxObj = $c->addText ( 600, 10, "www.stockbangladesh.org", "timesbi.ttf", 11, 0xc09090 );
$textBoxObj->setAlignment ( TopLeft );

$layer->addDataSet($data1, 0xff0000,"-2%");
$layer->addDataSet($data2, 0xffCEBE,"+(0 to -2)%");
$layer->addDataSet($data3, 0xACF4AC,"(2 to 0)%");
$layer->addDataSet($data0, 0x00ff00,"+2%");
# Use soft lighting effect with light direction from top
//$layer->setBorderColor(Transparent, softLighting(Top));

# Enable data label at the middle of the the bar
$textBoxObj = $layer->setDataLabelStyle();
$textBoxObj->setAlignment(Center);

# For a vertical stacked chart with positive data only, the last data set is always
# on top. However, in a vertical legend box, the last data set is at the bottom. This
# can be reversed by using the setLegend method.
$layer->setLegend(ReverseLegend);

# Adjust the plot area size, such that the bounding box (inclusive of axes) is 15
# pixels from the left edge, just below the title, 10 pixels to the right of the
# legend box, and 15 pixels from the bottom edge.
$layoutLegendObj = $c->layoutLegend();
$c->packPlotArea(15, $title->getHeight(), $layoutLegendObj->getLeftX() - 10,
    $c->getHeight() - 15);

# Output the chart
header("Content-type: image/png");
print($c->makeChart2(PNG));
}
function volcompare_week($type=NULL){

        require_once(WWW_ROOT . DS . 'chart'. DS .'phpchartdir.php');
        //$getLastIndex=49649;
        //$count=0;
       //echo '<pre>' ;
       $oneweekprevdate = $this->Symbol->query("SELECT date FROM `outputs_week` WHERE `symbol` =1 ORDER by id DESC");
       //print_r($oneweekprevdate);die;
       $weekfirstdate = date('Y-m-d',strtotime($oneweekprevdate[1]['outputs_week']['date']));
       $firststamp = strtotime($weekfirstdate);
       
        $dataSql = "SELECT volume,lastprice,currenttime FROM data_banks_intraday WHERE symbol_id=1 AND date>$firststamp ORDER BY id ASC";
        $dataInfo = $this->Symbol->query($dataSql);
        //print_r($dataInfo);
        $diff = 0;
        $prevvol = 0;
        foreach($dataInfo as $count=>$arr)
        {
            if($count==0)
            {
                $index[]=$arr["data_banks_intraday"]["lastprice"];
                $volume[]=0;
                $label[]=date("d-M H:i",$arr["data_banks_intraday"]["currenttime"]);
            }
            if(($count%5==0) && ($arr['data_banks_intraday']['lastprice']!=0)&&($count>=1) && $check  == 0)
            {                 
                $temp = ($arr['data_banks_intraday']['volume']/1000000) - $diff;
                $v = '';
                if(!empty($temp))
                {
                    $volume[] = $arr['data_banks_intraday']['volume']/1000000 - $diff;
                    $index[]=$arr["data_banks_intraday"]["lastprice"];
                    $label[]=date("d-M H:i",$arr["data_banks_intraday"]["currenttime"]);
                    $v = $temp;
                }
                else
                {
                    if(!empty($prevvol))
                    {
                        $volume[] = $prevvol;
                        $index[]=$arr["data_banks_intraday"]["lastprice"];
                        $label[]=date("d-M H:i",$arr["data_banks_intraday"]["currenttime"]);
                        //$v = $prevvol;
                    }
                    
                }
                
                //echo $v."<br>";
                
            }
            $check  = 0;
            $temp2 = $arr['data_banks_intraday']['volume']/1000000 - $diff;
            if(!empty($temp2))
                $prevvol = $arr['data_banks_intraday']['volume']/1000000 - $diff; 
            else
                $check  = 1;
            $diff = $arr['data_banks_intraday']['volume']/1000000;
           
        }
        
        /*print_r($index);
        print_r($volume);
        print_r($label);
        echo array_sum($volume);
        die;*/
        
        for($i=0;$i<count($volume);$i++){
            $avgVol[]=number_format(array_sum($volume)/(count($volume)),2);                      
        }
        $avg=$avgVol[0];

        # Create a XYChart object of size 300 x 300 pixels
        $c = new XYChart ( 765, 440 );
        $c->setPlotArea ( 70, 70, 610, 280, 0xF6F6F6 );
        /*$c = new XYChart(400, 350);
        
        # Set the plotarea at (45, 30) and of size 200 x 200 pixels
        $c->setPlotArea(45, 40, 320, 220);*/
        # Add a title to the chart using 12 pts Arial Bold Italic font
        $c->addTitle("Index Vs. Trade Volume ".number_format($diff,2)."(mn)\nAverage : $avg(mn) /5 min", "arialbi.ttf", 10);        
//$c->addTitle("Index Vs. Trade Volume ".number_format($tempdata,2).'(mn)', "arialbi.ttf", 12);
        
        # Add a title to the y axis
        $c->yAxis->setTitle("");
        
        # Add a title to the x axis
        $c->xAxis->setTitle($tradedate);
        $c->xAxis->setLabelStyle ( "Arial", 8, TextColor, 90 );

        $textBoxObj = $c->addText ( 50, 40, "www.stockbangladesh.org", "timesbi.ttf", 9, 0xc09090 );
        $textBoxObj->setAlignment ( TopLeft );

        $trendLayerObj = $c->addTrendLayer($avgVol, 0x008000, "Trend Line"); //trend chart
        $trendLayerObj->setLineWidth(2);
        $trendLayerObj->setUseYAxis2 ();

        $c->addLineLayer($dgenArr,0xff0000);
            
        $c->addLineLayer($index,0xff0000);
        //$c->addBarLayer($dgenArr1,0x00ff00);
        
        $barLayerObj = $c->addBarLayer3 ($volume);
        $barLayerObj->setBarShape (CircleShape );
        $barLayerObj->setUseYAxis2 ();
        # Add a green (0x00ff00) 3D area chart layer using the give data
        
        # Set the labels on the x axis.
        $c->xAxis->setLabels($label);
        
        # Display 1 out of 3 labels on the x-axis.
        /*if(count($dgenLabel)>12)$c->xAxis->setLabelStep(2);
        else */
        if($count<30)
        $c->xAxis->setLabelStep(1);
        else $c->xAxis->setLabelStep(2);
        # Output the chart
        header("Content-type: image/png");
        print($c->makeChart2(PNG));
                    
}

function getsectorchart_week() {

        $this->sectorcompare_week ( $_GET );

        require_once (WWW_ROOT . DS . 'chart' . DS . 'Image_Toolbox.class.php');

        $chartImagePath = WWW_ROOT . 'chart' . DS . 'sectorcomparechartweek.png';



        $img = new Image_Toolbox ( $chartImagePath );



        $width = $img->_img ['main'] ['width'];



        $img->addImage ( $width, 10, '#FFFFFF' );

        //$img->blendMask ( 'left', 'bottom', IMAGE_TOOLBOX_BLEND_COPY, 0, 440 );
        //$img->blendMask ( 'left', 'bottom', IMAGE_TOOLBOX_BLEND_COPY, 0, 470 );
        $img->blendMask ( 'left', 'bottom', IMAGE_TOOLBOX_BLEND_COPY, 0, 650 );

        //$img->blend('left','bottom',IMAGE_TOOLBOX_BLEND_COPY);
        $img->output ();

        die();

    }
    
    
    function minutechartnew1($updateRequest = '') {
        $this->layout = 'default-compare';
        
        $this->pageTitle = 'Minute Chart - Price Chart/ Graph For DSE';
        $this->set("meta_description", "Live Market monitor tool for Dhaka Stock Exchange");
        $this->set("meta_keywords", "DSE Market Monitor,DSE Price,Share price information");

        
        if (! $this->Session->check ( 'Auth.User' )) {
            $this->Session->setFlash ( 'Please login again.' );
            $this->Session->del('Auth.redirect');
            $this->Session->write('Auth.redirect', 'resources/minutechartnew');
            $this->Session->write('Auth.gobackpage', 'resources/minutechartnew');
            
            $this->redirect ( array ('controller' => 'users', 'action' => 'login' ) );
        }
        //$this->Session->del('Auth.redirect');
        $inv = 60;
        $inv1 = 300;
        if (isset ( $updateRequest ['sym'] ) && $updateRequest ['sym'] != '')
        $_REQUEST ['TickerSymbol'] = $updateRequest ['sym'];
        if (isset ( $updateRequest ['inv'] ) && $updateRequest ['inv'] != '')
        $_REQUEST ['inv'] = $updateRequest ['inv'];
        if (isset ( $_REQUEST ['TickerSymbol'] )) {
            $inv = $_REQUEST ['inv'];
            $symbolInfo = $this->Symbol->find ( 'first', array ('conditions' => array ('id=' . $_REQUEST ['TickerSymbol'] ), 'fields' => array ('Symbol.dse_code', 'Symbol.name' ) ) );
            $name = $symbolInfo ['Symbol'] ['name'];
            $name = ucwords ( strtolower ( $name ) );
            $this->pageTitle = "$name :: Minute Chart";
            $this->set ( 'sym', $_REQUEST ['TickerSymbol'] );
            //App::import ( 'Vendor', 'Phpchartdir', array ('file' => 'phpchartdir.php' ) );
            $symbol = $_REQUEST ['TickerSymbol'];
            $symbol = trim ( $symbol );
            $interval = $inv;
            $code = $symbolInfo ['Symbol'] ['dse_code'];
            $name = $symbolInfo ['Symbol'] ['name'];
            $minute = $interval / 60;
            if ($minute > 1) {
                $minute = $minute . ' Minutes Chart';
            } else {
                $minute = $minute . ' Minutes Chart';
            }
            $nameOfTheDay = date ( 'l' );
            if ($nameOfTheDay == 'Friday')
            $todayTimeStamp = mktime ( 0, 0, 0, date ( 'm' ), date ( 'd' ) - 1, date ( 'Y' ) );
            else if ($nameOfTheDay == 'Saturday')
            $todayTimeStamp = mktime ( 0, 0, 0, date ( 'm' ), date ( 'd' ) - 2, date ( 'Y' ) );
            else
            $todayTimeStamp = mktime ( 0, 0, 0, date ( 'm' ), date ( 'd' ), date ( 'Y' ) );
            /*$todayTimeStamp = mktime(0, 0, 0, date('m'), date('d'), date('Y'));*/
            $getLastIntradayId = $this->Symbol->query ( 'SELECT value from configuration WHERE name=\'data_bank_intraday_lid\' ' );
            $getLastIntradayId = $getLastIntradayId [0] ['configuration'] ['value'];
            /*--- FIRST USE OF MEMCACHE :: START HERE ---*/

            if (class_exists ( 'Memcache' )) {
                $memcache = new Memcache ( );
                $memcache->connect ( 'localhost', 11211 ) or die ( "Could not connect" );
                $memKey3 = md5 ( 'select * from stockorg_stock.data_banks_intraday where symbol_id =' . $symbol . ' AND id > ' . $getLastIntradayId . ' ORDER BY id DESC' );
                if (! $memcache->get ( $memKey3 )) {
                    $shareData = $this->Symbol->query ( 'select * from stockorg_stock.data_banks_intraday where symbol_id =' . $symbol . ' AND id > ' . $getLastIntradayId . ' ORDER BY id DESC' );

                    $memcache->set ( $memKey3, $shareData, MEMCACHE_COMPRESSED, 60 );
                }
                $shareData = $memcache->get ( $memKey3 );

            } else {
                $shareData = $this->Symbol->query ( 'select * from stockorg_stock.data_banks_intraday where symbol_id =' . $symbol . ' AND id > ' . $getLastIntradayId . ' ORDER BY id DESC' );

            }

            /*--- FIRST USE OF MEMCACHE :: END HERE ---*/
            $timeWiseArr = array ();
            $timeKeyArr  = array ();
            foreach ( $shareData as $row ) {
                $currenttime = $row ['data_banks_intraday'] ['date'];
                //$currenttime = $currenttime + (8*60*60);
                $mod = $currenttime % $interval;
                $timeToBeAccounted = $currenttime - $mod + $interval;
                //echo date('h:i A', $timeToBeAccounted).'<br><br>';
                $timeWiseArr [$timeToBeAccounted] [] = $row;
                $modtime = date ( 'd M  h:ia', $timeToBeAccounted );
            }

            //pr($timeWiseArr);
            $rowDataVolumeStart = 0;
            $rowDataVolumeEnd = 0;
            $currentDataVolume = 0;
            $tempVolumeCounter = 0;
            $totalArrayCount = count($timeWiseArr);
            $myDefinedCounter = 1;
            foreach ( $timeWiseArr as $key => $arr ) {
                $timeKeyArr [] = $key;
            }

            //pr($tempVolumeCounter);
            $finalArr = array ();
            $totalvolume = $shareData [0] ['data_banks_intraday'] ['volume'];
            $tradetimestamp = $shareData [0] ['data_banks_intraday'] ['date'];
            $dayhigh = $shareData [0] ['data_banks_intraday'] ['high'];
            $daylow = $shareData [0] ['data_banks_intraday'] ['low'];
            $dayclose = $shareData [0] ['data_banks_intraday'] ['close'];
            $dayopen = $shareData [0] ['data_banks_intraday'] ['open'];
            $totaltrade = $shareData [0] ['data_banks_intraday'] ['trade'];
            
            if($symbol == 1)
            {
                $market_summeriesSQL = mysql_fetch_assoc(mysql_query("SELECT * FROM market_summeries ORDER BY id DESC LIMIT 1"));
                $totaltrade = $market_summeriesSQL['totaltrade'];
            }
            
            
            
            $yclose=$shareData [0] ['data_banks_intraday'] ['yclose'];

            $tradeDate = date ( 'd M y h:ia', $tradetimestamp );
            $i = 0;
            $singleCount = 0;
            $finalPrice = 0;
            //pr($timeWiseArr);
            $startPrice = 0;
            $endPrice = 0;
            foreach ( $timeWiseArr as $key => $arr ) {
                $datetime = date ( 'h:i A', $key );
                $temp = array ();
                $startArr = array ();
                $endArr = array ();
                $ind = count ( $arr );
                $counterArr = count($arr);
                $finalPrice = $arr[0]['data_banks_intraday']['close'];


                if(!$rowDataVolumeStart) {
                    $rowDataVolumeStart = $arr[0]['data_banks_intraday']['volume'];
                    $startPrice = $arr[0]['data_banks_intraday']['close'];
                }

                if($myDefinedCounter==$totalArrayCount){
                    $rowDataVolumeEnd  =0;
                    $endPrice = $arr[0]['data_banks_intraday']['yclose'];
                }else {
                    $rowDataVolumeEnd = $arr[$counterArr-1]['data_banks_intraday']['volume'];
                    $endPrice = $arr[0]['data_banks_intraday']['close'];
                }

                //$endArr ['data_banks_intraday'] ['lastprice'];
                if ($ind == 1) {
                    $startArr = $arr [$ind - 1];
                    $endArr = $arr [$ind - 1];

                    if (isset ( $timeKeyArr [$i + 1] )) {
                        $time = $timeKeyArr [$i + 1];
                        $endvolume = $timeWiseArr [$time] [0] ['data_banks_intraday'] ['volume'];
                    } else {
                        $endvolume = 0;
                    }
                    $startvolume = $startArr ['data_banks_intraday'] ['volume'];
                } else {

                    //$startArr = $arr [0];
                    if (isset ( $timeKeyArr [$i] )) {
                        $time = $timeKeyArr [$i];

                        $preArrInd = count ($timeWiseArr [$time] );

                        $startvolume = $timeWiseArr [$time] [0] ['data_banks_intraday'] ['volume'];
                        //pr("found");
                    } else {
                        $startvolume = 0;
                        //pr('NO');
                    }
                    $endArr = $arr [$ind - 1];
                    if (isset ( $endArr )) {
                        $endvolume = $endArr ['data_banks_intraday'] ['volume'];
                    } else {
                        $endvolume = 0;
                    }
                }
                //pr($startvolume);
                //$temp ['ltp'] = $endArr ['data_banks_intraday'] ['lastprice'];
                $temp ['ltp'] = $finalPrice;
                $finalPrice = $arr[$counterArr-1]['data_banks_intraday']['lastprice'];
                //$temp['open']      = $endArr['data_banks_intraday']['open'];
                $temp ['high'] = $endArr ['data_banks_intraday'] ['high'];
                $temp ['low'] = $endArr ['data_banks_intraday'] ['low'];
                $temp ['close'] = $endArr ['data_banks_intraday'] ['close'];
                $temp ['yclose'] = $endArr ['data_banks_intraday'] ['yclose'];
                $temp ['trade'] = $endArr ['data_banks_intraday'] ['trade'];
                //$tempVolumeCounter += $rowDataVolumeStart - $rowDataVolumeEnd;
                //$temp ['volume'] = $finalVolume;
                //$finalVolume =  $rowDataVolumeStart - $rowDataVolumeEnd;
                $temp ['volume'] = $rowDataVolumeStart - $rowDataVolumeEnd;
                //$temp ['volume'] = $startvolume - $endvolume;
                if($startPrice > $endPrice){
                    $myPositiveCounter += $temp ['volume'];

                }else {
                    $myNegativeCounter += $temp ['volume'];
                }

                $rowDataVolumeStart = $rowDataVolumeEnd;
                $startPrice = $endPrice;
                $myDefinedCounter++;

                //$totalVolumeCompared+= $temp ['volume'];
                $temp ['value'] = $endArr ['data_banks_intraday'] ['value'];
                $temp ['datetime'] = $datetime;
                $temp ['idatetime'] = $key;
                if($temp ['volume'] != 0)
                    $finalArr [] = $temp;

                ++ $i;
            }

            /*echo "<pre>";
            print_r($finalArr);
            die;*/
            //pr("Positive".$myPositiveCounter);
            //pr("Negative".$myNegativeCounter);
            $xdata = array ();
            $ydata = array ();
            $vdata = array ();
            $totalbar = count ( $finalArr );
            foreach ( $finalArr as $mykey => $row ) {
                $volumetemp = $row ['volume'];

                if ($volumetemp < 0) {
                    continue;
                }

                $xdata [] = $row ['ltp'];
                $vdata [] = $finalArr [$mykey +1] =$row ['volume'];
                //himel[
                
                    $volume_array[]=array($row ['idatetime'],$row ['volume']);
                    $price_array[]=array($row ['idatetime'],$row ['ltp']);
                //himel]
                
                
                if ($interval < 120 && $totalbar > 80) {

                    if ($interval == 60) {
                        $yint = 600;
                    } else {
                        $yint = 300;
                    }
                    $currenttime = $row ['idatetime'];

                    $mod = $currenttime % $yint;

                    if ($mod == 0) {
                        $ydata [] = $row ['datetime'];
                    } else {
                        $ydata [] = "-";
                    }
                } else {
                    $ydata [] = $row ['datetime'];
                }

            }
            $data_['volume']=array_reverse($volume_array);
            $data_['price']=array_reverse($price_array);
            
            //$jsonresult = $this->__JEncode ( $data_ );
            $this->set('data',$data_);
            
            /*echo '<pre>';
            print_r($final);
            die; */
            

            $xdata = array_reverse ( $xdata );
            $ydata = array_reverse ( $ydata );
            $vdata = array_reverse ( $vdata );
            //array_shift
            $max = 50;

            $lastprice = $xdata [count ( $xdata ) - 1];
            $lasttime = $ydata [count ( $ydata ) - 1];
            $lastvolume = $vdata [count ( $vdata ) - 1];

            array_unshift($vdata, 0);
            array_pop($vdata);
            //pr($vdata);
            # The data for the chart
            $myPositiveCounter=0;
            $myNegativeCounter=0;
            $myEqualCounter=0;

            if($yclose<$xdata[0])
            {
                $myPositiveCounter=$vdata[0];
            }
            if($yclose>$xdata[0])
            {
                $myNegativeCounter=$vdata[0];
            }
            /* echo "<pre >";
            echo "xdata";
            print_r($xdata);
            echo "vdata";
            print_r($vdata);
            exit;
            */
            for($i=0;$i<count($vdata);$i++)
            {
                if($xdata[$i]>$xdata[$i-1])
                {

                    $myPositiveCounter+=$vdata[$i];
                    //echo $myPositiveCounter."myPositiveCounter[".$vdata[$i]."]".$xdata[$i-1].">".$xdata[$i]."<br />";
                }
                if ($xdata[$i]<$xdata[$i-1])
                {
                    $myNegativeCounter+=$vdata[$i];
                    //echo $myNegativeCounter."myNegativeCounter[".$vdata[$i]."]".$xdata[$i-1]."<=".$xdata[$i]."<br />";
                }
                if ($xdata[$i]==$xdata[$i-1])
                {
                    $myEqualCounter+=$vdata[$i];

                }


            }
            //exit;
            $this->set('xdata',$xdata);
            $this->set('vdata',$vdata);
            $this->set('labels',$ydata);
            $this->set('graph_title',"$code-$tradeDate  open: $dayopen  high : $dayhigh low : $daylow close: $dayclose Hawla : $totaltrade   Total Volume : $totalvolume ");
            $this->set('graph_subtitle',"Probable { Bull Vol: $myPositiveCounter($myPositivePer%) Neutral Vol: $myEqualCounter($myEqualPer%)  Bear Vol: $myNegativeCounter ($myNegativePer%) }");
            $data0 = $xdata;
            $data1 = $vdata;
            $labels = $ydata;
            
        }                            
        $this->set ( 'inv', $inv );
        $this->set ( 'inv1', $inv1 );
    }
    
    function minutechart_ajax1() 
    {
        //configure::write('debug',3);
        //pr($_REQUEST);
        //pr($updateRequest);
        //$this->Session->del('Auth.redirect');  
              
        /*$inv = 60;
        $inv1 = 300;
        */
        /*if (isset ( $updateRequest ['sym'] ) && $updateRequest ['sym'] != '')
            $_REQUEST ['TickerSymbol'] = $updateRequest ['sym'];
        if (isset ( $updateRequest ['inv'] ) && $updateRequest ['inv'] != '')
            $_REQUEST ['inv'] = $updateRequest ['inv'];
        
            */
        //if (isset ( $_REQUEST ['TickerSymbol'] )) 
        {
            //echo 'a'.$updateRequest['sym'];
            $_REQUEST ['TickerSymbol']=11101;//test
            $inv = 60;//$_REQUEST ['inv'];
            $symbolInfo = $this->Symbol->find ( 'first', array ('conditions' => array ('id=' . $_REQUEST ['TickerSymbol'] ), 'fields' => array ('Symbol.dse_code', 'Symbol.name' ) ) );
            $name = $symbolInfo ['Symbol'] ['name'];
            $name = ucwords ( strtolower ( $name ) );
            //$this->pageTitle = "$name :: Minute Chart";
            //$this->set ( 'sym', $_REQUEST ['TickerSymbol'] );
            //App::import ( 'Vendor', 'Phpchartdir', array ('file' => 'phpchartdir.php' ) );
            
            $symbol = $_REQUEST ['TickerSymbol'];
            $symbol = trim ( $symbol );
            $interval = $inv;
            
            $code = $symbolInfo ['Symbol'] ['dse_code'];
            $name = $symbolInfo ['Symbol'] ['name'];
            
            $minute = $interval / 60;
            if ($minute > 1) {
                $minute = $minute . ' Minutes Chart';
            } else {
                $minute = $minute . ' Minutes Chart';
            }
            $nameOfTheDay = date ( 'l' );
            if ($nameOfTheDay == 'Friday')
            $todayTimeStamp = mktime ( 0, 0, 0, date ( 'm' ), date ( 'd' ) - 1, date ( 'Y' ) );
            else if ($nameOfTheDay == 'Saturday')
            $todayTimeStamp = mktime ( 0, 0, 0, date ( 'm' ), date ( 'd' ) - 2, date ( 'Y' ) );
            else
            $todayTimeStamp = mktime ( 0, 0, 0, date ( 'm' ), date ( 'd' ), date ( 'Y' ) );
            /*$todayTimeStamp = mktime(0, 0, 0, date('m'), date('d'), date('Y'));*/
            $getLastIntradayId = $this->Symbol->query ( 'SELECT value from configuration WHERE name=\'data_bank_intraday_lid\' ' );
            $getLastIntradayId = $getLastIntradayId [0] ['configuration'] ['value'];
            
            
            /*--- FIRST USE OF MEMCACHE :: START HERE ---*/

            if (class_exists ( 'Memcache' )) {
                $memcache = new Memcache ( );
                $memcache->connect ( 'localhost', 11211 ) or die ( "Could not connect" );
                $memKey3 = md5 ( 'select * from stockorg_stock.data_banks_intraday where symbol_id =' . $symbol . ' AND id > ' . $getLastIntradayId . ' ORDER BY id DESC' );
                if (! $memcache->get ( $memKey3 )) {
                    $shareData = $this->Symbol->query ( 'select * from stockorg_stock.data_banks_intraday where symbol_id =' . $symbol . ' AND id > ' . $getLastIntradayId . ' ORDER BY id DESC' );

                    $memcache->set ( $memKey3, $shareData, MEMCACHE_COMPRESSED, 60 );
                }
                $shareData = $memcache->get ( $memKey3 );

            } else {
                $shareData = $this->Symbol->query ( 'select * from stockorg_stock.data_banks_intraday where symbol_id =' . $symbol . ' AND id > ' . $getLastIntradayId . ' ORDER BY id DESC' );

            }
            
            //PRINT_R($shareData);
            
            
            /*--- FIRST USE OF MEMCACHE :: END HERE ---*/
            $timeWiseArr = array ();
            $timeKeyArr  = array ();
            foreach ( $shareData as $row ) {
                $currenttime = $row ['data_banks_intraday'] ['date'];
                //$currenttime = $currenttime + (8*60*60);
                $mod = $currenttime % $interval;
                $timeToBeAccounted = $currenttime - $mod + $interval;
                //echo date('h:i A', $timeToBeAccounted).'<br><br>';
                $timeWiseArr [$timeToBeAccounted] [] = $row;
                $modtime = date ( 'd M  h:ia', $timeToBeAccounted );
            }

            //pr($timeWiseArr);
            $rowDataVolumeStart = 0;
            $rowDataVolumeEnd = 0;
            $currentDataVolume = 0;
            $tempVolumeCounter = 0;
            $totalArrayCount = count($timeWiseArr);
            $myDefinedCounter = 1;
            foreach ( $timeWiseArr as $key => $arr ) {
                $timeKeyArr [] = $key;
            }
            
            //pr($tempVolumeCounter);
            $finalArr = array ();
            $totalvolume = $shareData [0] ['data_banks_intraday'] ['volume'];
            $tradetimestamp = $shareData [0] ['data_banks_intraday'] ['date'];
            $dayhigh = $shareData [0] ['data_banks_intraday'] ['high'];
            $daylow = $shareData [0] ['data_banks_intraday'] ['low'];
            $dayclose = $shareData [0] ['data_banks_intraday'] ['close'];
            $dayopen = $shareData [0] ['data_banks_intraday'] ['open'];
            $totaltrade = $shareData [0] ['data_banks_intraday'] ['trade'];
            
            if($symbol == 1)
            {
                $market_summeriesSQL = mysql_fetch_assoc(mysql_query("SELECT * FROM market_summeries ORDER BY id DESC LIMIT 1"));
                $totaltrade = $market_summeriesSQL['totaltrade'];
            }
            
            
            
            $yclose=$shareData [0] ['data_banks_intraday'] ['yclose'];

            $tradeDate = date ( 'd M y h:ia', $tradetimestamp );
            $i = 0;
            $singleCount = 0;
            $finalPrice = 0;
            //pr($timeWiseArr);
            $startPrice = 0;
            $endPrice = 0;
            foreach ( $timeWiseArr as $key => $arr ) {
                $datetime = date ( 'h:i A', $key );
                $temp = array ();
                $startArr = array ();
                $endArr = array ();
                $ind = count ( $arr );
                $counterArr = count($arr);
                $finalPrice = $arr[0]['data_banks_intraday']['close'];


                if(!$rowDataVolumeStart) {
                    $rowDataVolumeStart = $arr[0]['data_banks_intraday']['volume'];
                    $startPrice = $arr[0]['data_banks_intraday']['close'];
                }

                if($myDefinedCounter==$totalArrayCount){
                    $rowDataVolumeEnd  =0;
                    $endPrice = $arr[0]['data_banks_intraday']['yclose'];
                }else {
                    $rowDataVolumeEnd = $arr[$counterArr-1]['data_banks_intraday']['volume'];
                    $endPrice = $arr[0]['data_banks_intraday']['close'];
                }

                //$endArr ['data_banks_intraday'] ['lastprice'];
                if ($ind == 1) {
                    $startArr = $arr [$ind - 1];
                    $endArr = $arr [$ind - 1];

                    if (isset ( $timeKeyArr [$i + 1] )) {
                        $time = $timeKeyArr [$i + 1];
                        $endvolume = $timeWiseArr [$time] [0] ['data_banks_intraday'] ['volume'];
                    } else {
                        $endvolume = 0;
                    }
                    $startvolume = $startArr ['data_banks_intraday'] ['volume'];
                } else {

                    //$startArr = $arr [0];
                    if (isset ( $timeKeyArr [$i] )) {
                        $time = $timeKeyArr [$i];

                        $preArrInd = count ($timeWiseArr [$time] );

                        $startvolume = $timeWiseArr [$time] [0] ['data_banks_intraday'] ['volume'];
                        //pr("found");
                    } else {
                        $startvolume = 0;
                        //pr('NO');
                    }
                    $endArr = $arr [$ind - 1];
                    if (isset ( $endArr )) {
                        $endvolume = $endArr ['data_banks_intraday'] ['volume'];
                    } else {
                        $endvolume = 0;
                    }
                }
                //pr($startvolume);
                //$temp ['ltp'] = $endArr ['data_banks_intraday'] ['lastprice'];
                $temp ['ltp'] = $finalPrice;
                $finalPrice = $arr[$counterArr-1]['data_banks_intraday']['lastprice'];
                //$temp['open']      = $endArr['data_banks_intraday']['open'];
                $temp ['high'] = $endArr ['data_banks_intraday'] ['high'];
                $temp ['low'] = $endArr ['data_banks_intraday'] ['low'];
                $temp ['close'] = $endArr ['data_banks_intraday'] ['close'];
                $temp ['yclose'] = $endArr ['data_banks_intraday'] ['yclose'];
                $temp ['trade'] = $endArr ['data_banks_intraday'] ['trade'];
                //$tempVolumeCounter += $rowDataVolumeStart - $rowDataVolumeEnd;
                //$temp ['volume'] = $finalVolume;
                //$finalVolume =  $rowDataVolumeStart - $rowDataVolumeEnd;
                $temp ['volume'] = $rowDataVolumeStart - $rowDataVolumeEnd;
                //$temp ['volume'] = $startvolume - $endvolume;
                if($startPrice > $endPrice){
                    $myPositiveCounter += $temp ['volume'];

                }else {
                    $myNegativeCounter += $temp ['volume'];
                }

                $rowDataVolumeStart = $rowDataVolumeEnd;
                $startPrice = $endPrice;
                $myDefinedCounter++;

                //$totalVolumeCompared+= $temp ['volume'];
                $temp ['value'] = $endArr ['data_banks_intraday'] ['value'];
                $temp ['datetime'] = $datetime;
                $temp ['idatetime'] = $key;
                if($temp ['volume'] != 0)
                    $finalArr [] = $temp;

                ++ $i;
            }
            //pr($finalArr);
            /*echo "<pre>";
            print_r($finalArr);
            die;*/
            //pr("Positive".$myPositiveCounter);
            //pr("Negative".$myNegativeCounter);
            $xdata = array ();
            $ydata = array ();
            $vdata = array ();
            $totalbar = count ( $finalArr );
            foreach ( $finalArr as $mykey => $row ) {
                $volumetemp = $row ['volume'];

                if ($volumetemp < 0) {
                    continue;
                }
                //himel[
                
                    $volume_array[]=array($row ['idatetime'],$row ['volume']);
                    $price_array[]=array($row ['idatetime'],$row ['ltp']);
                //himel]
                $xdata [] = $row ['ltp'];
                $vdata [] = $finalArr [$mykey +1] =$row ['volume'];
                $ydata [] = $row ['idatetime'];
                /*if ($interval < 120 && $totalbar > 80) {

                    if ($interval == 60) {
                        $yint = 600;
                    } else {
                        $yint = 300;
                    }
                    $currenttime = $row ['idatetime'];
                    //echo '='.date('Y-m-d h:i:s',$currenttime);

                    $mod = $currenttime % $yint;

                    if ($mod == 0) {
                         $ydata [] = $row ['datetime'];
                    } else {
                         $ydata [] = "-";
                    }
                } else {
                     $ydata [] = $row ['datetime'];
                } */

            }

            //pr($ydata);
            
            $xdata = array_reverse ( $xdata );
            $ydata = array_reverse ( $ydata );
            $vdata = array_reverse ( $vdata );
            //array_shift
            $max = 50;

            $lastprice = $xdata [count ( $xdata ) - 1];
            $lasttime = $ydata [count ( $ydata ) - 1];
            $lastvolume = $vdata [count ( $vdata ) - 1];

            array_unshift($vdata, 0);
            array_pop($vdata);
            //pr($vdata);
            # The data for the chart
            $myPositiveCounter=0;
            $myNegativeCounter=0;
            $myEqualCounter=0;

            if($yclose<$xdata[0])
            {
                $myPositiveCounter=$vdata[0];
            }
            if($yclose>$xdata[0])
            {
                $myNegativeCounter=$vdata[0];
            }
            /* echo "<pre >";
            echo "xdata";
            print_r($xdata);
            echo "vdata";
            print_r($vdata);
            exit;
            */
            for($i=0;$i<count($vdata);$i++)
            {
                if($xdata[$i]>$xdata[$i-1])
                {

                    $myPositiveCounter+=$vdata[$i];
                    //echo $myPositiveCounter."myPositiveCounter[".$vdata[$i]."]".$xdata[$i-1].">".$xdata[$i]."<br />";
                }
                if ($xdata[$i]<$xdata[$i-1])
                {
                    $myNegativeCounter+=$vdata[$i];
                    //echo $myNegativeCounter."myNegativeCounter[".$vdata[$i]."]".$xdata[$i-1]."<=".$xdata[$i]."<br />";
                }
                if ($xdata[$i]==$xdata[$i-1])
                {
                    $myEqualCounter+=$vdata[$i];

                }


            }
            //print_r($ydata);
            
            
            /*$data_json['volume']=$vdata;
            $data_json['price']=$xdata;
            $data_json['time']=$ydata;
            */
            
            //exit;
            /*$this->set('xdata',$xdata);
            $this->set('vdata',$vdata);
            $this->set('labels',$ydata);
            $this->set('graph_title',"$code-$tradeDate  open: $dayopen  high : $dayhigh low : $daylow close: $dayclose Hawla : $totaltrade   Total Volume : $totalvolume ");
            $this->set('graph_subtitle',"Probable { Bull Vol: $myPositiveCounter($myPositivePer%) Neutral Vol: $myEqualCounter($myEqualPer%)  Bear Vol: $myNegativeCounter ($myNegativePer%) }");
            */
            /*$xdata['volume']=array('0.10','2.20','0.30','0.40','0.50');
            $xdata['price']=array('0.10','0.20','0.30','0.40','0.50');
            $xdata['time']=array('1326277140000','1326277200000','1326277260000','1326277320000','1326277380000');                                 
            *///$xdata=array('10','20','30','40','50','60',';','110','120','130','140','150','160',';','210','220','230','240','250','260');
            //$xdata=array('10','20','30','40','50','60','70',';','110','120','130','140','150','160','170',';','210','220','230','240','250','260','270');
            $data_json['volume']=array( 1316681940,8.1);//test $volume_array;
            $data_json['price']=array(1316681940,7500);//test $price_array;
            
            $jsonresult = $this->__JEncode ( $data_json );
            //echo '({"total":"' . count ( $xdata ) . '","results":' . $jsonresult . '})';
            echo $jsonresult;
            //echo join(",",array_values($xdata));
            //echo 'ac';
            die;
            
        }
        
        
    }
    
    function minutechartnew($updateRequest = '') {
        if (! $this->Session->check ( 'Auth.User' )) {
            $this->Session->setFlash ( 'You are not authorized to access that location.' );
            $this->redirect ( array ('controller' => 'users', 'action' => 'login' ) );
        }

        //pr($_REQUEST);
        //pr($updateRequest);
        $this->layout = 'default-compare';
        
        $this->pageTitle = 'Minute Chart - Price Chart/ Graph For DSE';
        $this->set("meta_description", "Live Market monitor tool for Dhaka Stock Exchange");
        $this->set("meta_keywords", "DSE Market Monitor,DSE Price,Share price information");

        
        if (! $this->Session->check ( 'Auth.User' )) {
            $this->Session->setFlash ( 'Please login again.' );
            $this->Session->del('Auth.redirect');
            $this->Session->write('Auth.redirect', 'resources/minutechart');
            $this->Session->write('Auth.gobackpage', 'resources/minutechart');
            
            $this->redirect ( array ('controller' => 'users', 'action' => 'login' ) );
        }
        //$this->Session->del('Auth.redirect');
        $inv = 60;
        $inv1 = 300;
        if (isset ( $updateRequest ['sym'] ) && $updateRequest ['sym'] != '')
        $_REQUEST ['TickerSymbol'] = $updateRequest ['sym'];
        if (isset ( $updateRequest ['inv'] ) && $updateRequest ['inv'] != '')
        $_REQUEST ['inv'] = $updateRequest ['inv'];
        if (isset ( $_REQUEST ['TickerSymbol'] )) {
            $inv = $_REQUEST ['inv'];
            $symbolInfo = $this->Symbol->find ( 'first', array ('conditions' => array ('id=' . $_REQUEST ['TickerSymbol'] ), 'fields' => array ('Symbol.dse_code', 'Symbol.name' ) ) );
            $name = $symbolInfo ['Symbol'] ['name'];
            $name = ucwords ( strtolower ( $name ) );
            $this->pageTitle = "$name :: Minute Chart";
            $this->set ( 'sym', $_REQUEST ['TickerSymbol'] );
            //App::import ( 'Vendor', 'Phpchartdir', array ('file' => 'phpchartdir.php' ) );
            $symbol = $_REQUEST ['TickerSymbol'];
            $symbol = trim ( $symbol );
            $interval = $inv;
            $code = $symbolInfo ['Symbol'] ['dse_code'];
            $name = $symbolInfo ['Symbol'] ['name'];
            $minute = $interval / 60;
            if ($minute > 1) {
                $minute = $minute . ' Minutes Chart';
            } else {
                $minute = $minute . ' Minutes Chart';
            }
            $nameOfTheDay = date ( 'l' );
            if ($nameOfTheDay == 'Friday')
            $todayTimeStamp = mktime ( 0, 0, 0, date ( 'm' ), date ( 'd' ) - 1, date ( 'Y' ) );
            else if ($nameOfTheDay == 'Saturday')
            $todayTimeStamp = mktime ( 0, 0, 0, date ( 'm' ), date ( 'd' ) - 2, date ( 'Y' ) );
            else
            $todayTimeStamp = mktime ( 0, 0, 0, date ( 'm' ), date ( 'd' ), date ( 'Y' ) );
            /*$todayTimeStamp = mktime(0, 0, 0, date('m'), date('d'), date('Y'));*/
            $getLastIntradayId = $this->Symbol->query ( 'SELECT value from configuration WHERE name=\'data_bank_intraday_lid\' ' );
            $getLastIntradayId = $getLastIntradayId [0] ['configuration'] ['value'];
            /*--- FIRST USE OF MEMCACHE :: START HERE ---*/

            if (class_exists ( 'Memcache' )) {
                $memcache = new Memcache ( );
                $memcache->connect ( 'localhost', 11211 ) or die ( "Could not connect" );
                $memKey3 = md5 ( 'select * from stockorg_stock.data_banks_intraday where symbol_id =' . $symbol . ' AND id > ' . $getLastIntradayId . ' ORDER BY id DESC' );
                if (! $memcache->get ( $memKey3 )) {
                    $shareData = $this->Symbol->query ( 'select * from stockorg_stock.data_banks_intraday where symbol_id =' . $symbol . ' AND id > ' . $getLastIntradayId . ' ORDER BY id DESC' );

                    $memcache->set ( $memKey3, $shareData, MEMCACHE_COMPRESSED, 60 );
                }
                $shareData = $memcache->get ( $memKey3 );

            } else {
                $shareData = $this->Symbol->query ( 'select * from stockorg_stock.data_banks_intraday where symbol_id =' . $symbol . ' AND id > ' . $getLastIntradayId . ' ORDER BY id DESC' );

            }

            //himel
                $this->set('last_point_id',$shareData[0]['data_banks_intraday'] ['id']);
                $this->set('last_point_vol',$shareData[0]['data_banks_intraday'] ['volume']);
                $this->set('code',$shareData[0]['data_banks_intraday'] ['code']);
                $this->set('last_date',$shareData[0]['data_banks_intraday'] ['date']);
                $this->set('TickerSymbol',$symbol);
                /*echo $shareData[0]['data_banks_intraday'] ['id'];
                die();*/
            //himel
            /*--- FIRST USE OF MEMCACHE :: END HERE ---*/
            $timeWiseArr = array ();
            $timeKeyArr  = array ();
            foreach ( $shareData as $row ) {
                $currenttime = $row ['data_banks_intraday'] ['date'];
                //$currenttime = $currenttime + (8*60*60);
                $mod = $currenttime % $interval;
                $timeToBeAccounted = $currenttime - $mod + $interval;
                //echo date('h:i A', $timeToBeAccounted).'<br><br>';
                $timeWiseArr [$timeToBeAccounted] [] = $row;
                $modtime = date ( 'd M  h:ia', $timeToBeAccounted );
            }

            //pr($timeWiseArr);
            $rowDataVolumeStart = 0;
            $rowDataVolumeEnd = 0;
            $currentDataVolume = 0;
            $tempVolumeCounter = 0;
            $totalArrayCount = count($timeWiseArr);
            $myDefinedCounter = 1;
            foreach ( $timeWiseArr as $key => $arr ) {
                $timeKeyArr [] = $key;
            }

            //pr($tempVolumeCounter);
            $finalArr = array ();
            $totalvolume = $shareData [0] ['data_banks_intraday'] ['volume'];
            $tradetimestamp = $shareData [0] ['data_banks_intraday'] ['date'];
            $dayhigh = $shareData [0] ['data_banks_intraday'] ['high'];
            $daylow = $shareData [0] ['data_banks_intraday'] ['low'];
            $dayclose = $shareData [0] ['data_banks_intraday'] ['close'];
            $dayopen = $shareData [0] ['data_banks_intraday'] ['open'];
            $totaltrade = $shareData [0] ['data_banks_intraday'] ['trade'];
            
            if($symbol == 1)
            {
                $market_summeriesSQL = mysql_fetch_assoc(mysql_query("SELECT * FROM market_summeries ORDER BY id DESC LIMIT 1"));
                $totaltrade = $market_summeriesSQL['totaltrade'];
            }
            
            
            
            $yclose=$shareData [0] ['data_banks_intraday'] ['yclose'];

            $tradeDate = date ( 'd M y h:ia', $tradetimestamp );
            $i = 0;
            $singleCount = 0;
            $finalPrice = 0;
            //pr($timeWiseArr);
            $startPrice = 0;
            $endPrice = 0;
            foreach ( $timeWiseArr as $key => $arr ) {
                $datetime = date ( 'h:i A', $key );
                $temp = array ();
                $startArr = array ();
                $endArr = array ();
                $ind = count ( $arr );
                $counterArr = count($arr);
                $finalPrice = $arr[0]['data_banks_intraday']['close'];


                if(!$rowDataVolumeStart) {
                    $rowDataVolumeStart = $arr[0]['data_banks_intraday']['volume'];
                    $startPrice = $arr[0]['data_banks_intraday']['close'];
                }

                if($myDefinedCounter==$totalArrayCount){
                    $rowDataVolumeEnd  =0;
                    $endPrice = $arr[0]['data_banks_intraday']['yclose'];
                }else {
                    $rowDataVolumeEnd = $arr[$counterArr-1]['data_banks_intraday']['volume'];
                    $endPrice = $arr[0]['data_banks_intraday']['close'];
                }

                //$endArr ['data_banks_intraday'] ['lastprice'];
                if ($ind == 1) {
                    $startArr = $arr [$ind - 1];
                    $endArr = $arr [$ind - 1];

                    if (isset ( $timeKeyArr [$i + 1] )) {
                        $time = $timeKeyArr [$i + 1];
                        $endvolume = $timeWiseArr [$time] [0] ['data_banks_intraday'] ['volume'];
                    } else {
                        $endvolume = 0;
                    }
                    $startvolume = $startArr ['data_banks_intraday'] ['volume'];
                } else {

                    //$startArr = $arr [0];
                    if (isset ( $timeKeyArr [$i] )) {
                        $time = $timeKeyArr [$i];

                        $preArrInd = count ($timeWiseArr [$time] );

                        $startvolume = $timeWiseArr [$time] [0] ['data_banks_intraday'] ['volume'];
                        //pr("found");
                    } else {
                        $startvolume = 0;
                        //pr('NO');
                    }
                    $endArr = $arr [$ind - 1];
                    if (isset ( $endArr )) {
                        $endvolume = $endArr ['data_banks_intraday'] ['volume'];
                    } else {
                        $endvolume = 0;
                    }
                }
                //pr($startvolume);
                //$temp ['ltp'] = $endArr ['data_banks_intraday'] ['lastprice'];
                $temp ['ltp'] = $finalPrice;
                $finalPrice = $arr[$counterArr-1]['data_banks_intraday']['lastprice'];
                //$temp['open']      = $endArr['data_banks_intraday']['open'];
                $temp ['high'] = $endArr ['data_banks_intraday'] ['high'];
                $temp ['low'] = $endArr ['data_banks_intraday'] ['low'];
                $temp ['close'] = $endArr ['data_banks_intraday'] ['close'];
                $temp ['yclose'] = $endArr ['data_banks_intraday'] ['yclose'];
                $temp ['trade'] = $endArr ['data_banks_intraday'] ['trade'];
                //$tempVolumeCounter += $rowDataVolumeStart - $rowDataVolumeEnd;
                //$temp ['volume'] = $finalVolume;
                //$finalVolume =  $rowDataVolumeStart - $rowDataVolumeEnd;
                $temp ['volume'] = $rowDataVolumeStart - $rowDataVolumeEnd;
                //$temp ['volume'] = $startvolume - $endvolume;
                if($startPrice > $endPrice){
                    $myPositiveCounter += $temp ['volume'];

                }else {
                    $myNegativeCounter += $temp ['volume'];
                }

                $rowDataVolumeStart = $rowDataVolumeEnd;
                $startPrice = $endPrice;
                $myDefinedCounter++;

                //$totalVolumeCompared+= $temp ['volume'];
                $temp ['value'] = $endArr ['data_banks_intraday'] ['value'];
                $temp ['datetime'] = $datetime;
                $temp ['idatetime'] = $key;
                if($temp ['volume'] != 0)
                    $finalArr [] = $temp;

                ++ $i;
            }

            /*echo "<pre>";
            print_r($finalArr);
            die;*/
            //pr("Positive".$myPositiveCounter);
            //pr("Negative".$myNegativeCounter);
            $xdata = array ();
            $ydata = array ();
            $vdata = array ();
            $totalbar = count ( $finalArr );
            foreach ( $finalArr as $mykey => $row ) {
                $volumetemp = $row ['volume'];

                if ($volumetemp < 0) {
                    continue;
                }

                $xdata [] = $row ['ltp'];
                $vdata [] = $finalArr [$mykey +1] =$row ['volume'];
                $ydata [] = $row ['idatetime']; ////HIMEL
                //himel[
                
                   /* $volume_array[]=array($row ['idatetime'],$row ['volume']);
                    $price_array[]=array($row ['idatetime'],(double)$row ['ltp']);*/
                //himel]
                
                
                /*if ($interval < 120 && $totalbar > 80) {

                    if ($interval == 60) {
                        $yint = 600;
                    } else {
                        $yint = 300;
                    }
                    $currenttime = $row ['idatetime'];

                    $mod = $currenttime % $yint;

                    if ($mod == 0) {
                        $ydata [] = $row ['datetime'];
                    } else {
                        $ydata [] = "-";
                    }
                } else {
                    $ydata [] = $row ['datetime'];
                }*/

            }
            
            

            $xdata = array_reverse ( $xdata );
            $ydata = array_reverse ( $ydata );
            $vdata = array_reverse ( $vdata );
            //array_shift
            $max = 50;

            $lastprice = $xdata [count ( $xdata ) - 1];
            $lasttime = $ydata [count ( $ydata ) - 1];
            $lastvolume = $vdata [count ( $vdata ) - 1];

            array_unshift($vdata, 0);
            array_pop($vdata);
            ////HIMEL][
            $count_v=count($vdata);
            for($i=0;$i<$count_v;$i++)
            {
                $volume_array[]=array($ydata[$i],$vdata[$i]);
            }
            $count_p=count($xdata);
            for($i=0;$i<$count_p;$i++)
            {
                $price_array[]=array($ydata[$i],(double)$xdata[$i]);
            }    
            //HIMEL]
            # The data for the chart
            $myPositiveCounter=0;
            $myNegativeCounter=0;
            $myEqualCounter=0;

            if($yclose<$xdata[0])
            {
                $myPositiveCounter=$vdata[0];
            }
            if($yclose>$xdata[0])
            {
                $myNegativeCounter=$vdata[0];
            }
            /* echo "<pre >";
            echo "xdata";
            print_r($xdata);
            echo "vdata";
            print_r($vdata);
            exit;
            */
            for($i=0;$i<count($vdata);$i++)
            {
                if($xdata[$i]>$xdata[$i-1])
                {

                    $myPositiveCounter+=$vdata[$i];
                    //echo $myPositiveCounter."myPositiveCounter[".$vdata[$i]."]".$xdata[$i-1].">".$xdata[$i]."<br />";
                }
                if ($xdata[$i]<$xdata[$i-1])
                {
                    $myNegativeCounter+=$vdata[$i];
                    //echo $myNegativeCounter."myNegativeCounter[".$vdata[$i]."]".$xdata[$i-1]."<=".$xdata[$i]."<br />";
                }
                if ($xdata[$i]==$xdata[$i-1])
                {
                    $myEqualCounter+=$vdata[$i];

                }


            }
            //exit;
            /*$this->set('xdata',$xdata);
            $this->set('vdata',$vdata);
            $this->set('labels',$ydata);  */
            //***$this->set('graph_title',"$code-$tradeDate  open: $dayopen  high : $dayhigh low : $daylow close: $dayclose Hawla : $totaltrade   Total Volume : $totalvolume ");
            //***$this->set('graph_subtitle',"Probable { Bull Vol: $myPositiveCounter($myPositivePer%) Neutral Vol: $myEqualCounter($myEqualPer%)  Bear Vol: $myNegativeCounter ($myNegativePer%) }");
            
            
            $data_['volume']=array_reverse($volume_array);
            $data_['price']=array_reverse($price_array);
            
            $this->set('data',$data_);
            
            $this->set('company_name',$code);
            $this->set('tradeDate',$tradeDate);
            $this->set('dayopen',$dayopen);
            $this->set('dayhigh',$dayhigh);
            $this->set('daylow',$daylow);         
            $this->set('dayclose',$dayclose);
            //$this->set('tradeDate',$dayhigh);
            /*$data0 = $xdata;
            $data1 = $vdata;
            $labels = $ydata;*/
            /*
            $myPositivePer=($myPositiveCounter/$totalvolume)*100;
            $myPositivePer=round($myPositivePer,2);

            $myNegativePer=($myNegativeCounter/$totalvolume)*100;
            $myNegativePer=round($myNegativePer,2);

            $myEqualPer=($myEqualCounter/$totalvolume)*100;
            $myEqualPer=round($myEqualPer,2);


            # Create a XYChart object of size 300 x 180 pixels
            $c = new XYChart ( 765, 420 );
            $c->setBackground ( $c->linearGradientColor ( 100, 0, 100, 400, 0xDCD6D3, 0xF6F6F6 ), 0xC8C3C0 ); 
            $c->setRoundedFrame ( 0xff0000, 0 );

            //$c->setBackground($c->linearGradientColor(0, 0, 0, 400, 0xffffbb, 0xffffff), 0x888888);
            //$c->setRoundedFrame(0xffffff, 0);

            # Set the plot area at (50, 20) and of size 200 x 130 pixels
            $c->setPlotArea ( 70, 70, 610, 280, 0xF6F6F6 );
            # Add a title to the chart using 8 pts Arial Bold font
            $arialbdPath = WWW_ROOT . 'font' . DS . 'arialbd.ttf';

            $c->addTitle ("$code-$tradeDate  open: $dayopen  high : $dayhigh low : $daylow close: $dayclose Hawla : $totaltrade   Total Volume : $totalvolume ", $arialbdPath, 8, 0x02536C, 0xDDD7D4 );
            $textBoxObj = $c->addText ( 148, 15, "Probable { Bull Vol: $myPositiveCounter($myPositivePer%) Neutral Vol: $myEqualCounter($myEqualPer%)  Bear Vol: $myNegativeCounter ($myNegativePer%) }", $arialbdPath, 8, 0x02536C );
            //$c->addTitle ( "$code-$tradeDate          Last price : $lastprice   high : $dayhigh low : $daylow trade : $totaltrade   Total Volume - $totalvolume Positive: Negative: ", $arialbdPath, 14, 0x333333, 0xE7FFDF );

            # Set the labels on the x axis.
            $c->xAxis->setLabels ( $labels );

            $c->xAxis->setLabelStyle ( "tahoma", 8, 0x683014, 90 );

            # Add a title to the primary (left) y axis
            $c->yAxis->setTitle ( "PRICE" );

            # Set the axis, label and title colors for the primary y axis to red (0xc00000) to
            # match the first data set
            $c->yAxis->setColors ( 0x682809, 0x682809, 0x682809 );

            # Add a title to the secondary (right) y axis
            $c->yAxis2->setTitle ( "VOLUME" );
            # set the axis, label and title colors for the primary y axis to green (0x008000) to
            # match the second data set
            $c->yAxis2->setColors ( 0x682809, 0x682809, 0x682809 );

            $textBoxObj = $c->addText ( 500, 50, "www.stockbangladesh.com", "timesbi.ttf", 11, 0xc09090 );
            $textBoxObj->setAlignment ( TopLeft );

            # Add a line layer to the chart
            $layer = $c->addLineLayer ();

            # Add the first line. Plot the points with a 7 pixel square symbol
            $dataSetObj = $layer->addDataSet ( $data0, 0xcf4040, "Price" );
            $dataSetObj->setDataSymbol ( SquareSymbol, 5 );

            $trendLayerObj = $c->addTrendLayer ( $data0, 0x0B578F, "Trend Line" );
            $trendLayerObj->setLineWidth ( 1 );
            $trendLayerObj->addPredictionBand ( 0.95, 0x80D9D7D7 );
            
            $barLayerObj = $c->addBarLayer3 ( $data1 );
            $barLayerObj->setBarShape ( CircleShape );
            $barLayerObj->setUseYAxis2 ();

            //    $c->addAreaLayer($data1, $c->yZoneColor(60, 0x8033ff33, 0x80ff3333));
            //$chart1URL = $c->makeSession("chart1");
            # Create an image map for the chart

            $chartData = $c->makeChart2 ( PNG );
            //print($chartData);
            $chart1URL = $c->makeSession("minchart");
            $this->set('chart1URL', $chart1URL);
            
            $chartImagePath = WWW_ROOT . 'chart' . DS . 'mm_chart_full.png';
            /*$f = fopen ( $chartImagePath, "wb" );
            fwrite ( $f, $chartData );
            fclose ( $f );* /
            $chartImageMap = $c->getHTMLImageMap ( "", "", "title='{dataSetName} at {xLabel} =  {value|2} '" );

            $this->set ( 'chartImageMap', $chartImageMap );
            if (isset ( $_REQUEST ['mapData'] ) && $_REQUEST ['mapData'] == 'yes') {
                echo "-#-";
                echo $chartImageMap;
                die ( '-#-' );
            }                        */
        }                            
        $this->set ( 'inv', $inv );
        $this->set ( 'inv1', $inv1 );
    }
    
    
    function minutechart_ajax() 
    {
        //configure::write('debug',3);
        //pr($_REQUEST);
        //pr($updateRequest);
        //$this->Session->del('Auth.redirect');  
              
        /*$inv = 60;
        $inv1 = 300;
        */
        /*if (isset ( $updateRequest ['sym'] ) && $updateRequest ['sym'] != '')
            $_REQUEST ['TickerSymbol'] = $updateRequest ['sym'];
        if (isset ( $updateRequest ['inv'] ) && $updateRequest ['inv'] != '')
            $_REQUEST ['inv'] = $updateRequest ['inv'];
        
            */
        //if (isset ( $_REQUEST ['TickerSymbol'] )) 
        
            //echo 'a'.$updateRequest['sym'];
            //echo 'a'.$_GET['TickerSymbol'];
            //$_REQUEST['TickerSymbol']=11101;//test
            if(!empty($_REQUEST ['inv']))
                $inv = $_REQUEST ['inv'];
            else
                $inv = 60;//$_REQUEST ['inv'];
             
            $symbolInfo = $this->Symbol->find ( 'first', array ('conditions' => array ('id=' . $_REQUEST ['TickerSymbol'] ), 'fields' => array ('Symbol.dse_code', 'Symbol.name' ) ) );
            $name = $symbolInfo ['Symbol'] ['name'];
            $name = ucwords ( strtolower ( $name ) );
            //$this->pageTitle = "$name :: Minute Chart";
            //$this->set ( 'sym', $_REQUEST ['TickerSymbol'] );
            //App::import ( 'Vendor', 'Phpchartdir', array ('file' => 'phpchartdir.php' ) );
            
            $symbol = $_REQUEST ['TickerSymbol'];
            $symbol = trim ( $symbol );
            $interval = $inv;
            $code = $symbolInfo ['Symbol'] ['dse_code'];
            $name = $symbolInfo ['Symbol'] ['name'];
            
            $minute = $interval / 60;
            if ($minute > 1) {
                $minute = $minute . ' Minutes Chart';
            } else {
                $minute = $minute . ' Minutes Chart';
            }
            $nameOfTheDay = date ( 'l' );
            if ($nameOfTheDay == 'Friday')
            $todayTimeStamp = mktime ( 0, 0, 0, date ( 'm' ), date ( 'd' ) - 1, date ( 'Y' ) );
            else if ($nameOfTheDay == 'Saturday')
            $todayTimeStamp = mktime ( 0, 0, 0, date ( 'm' ), date ( 'd' ) - 2, date ( 'Y' ) );
            else
            $todayTimeStamp = mktime ( 0, 0, 0, date ( 'm' ), date ( 'd' ), date ( 'Y' ) );
            /*$todayTimeStamp = mktime(0, 0, 0, date('m'), date('d'), date('Y'));*/
            
            if(!empty($_REQUEST ['last']))
                $getLastIntradayId=$_REQUEST ['last'];
            else
            {
                $getLastIntradayId = $this->Symbol->query ( 'SELECT value from configuration WHERE name=\'data_bank_intraday_lid\' ' );
                $getLastIntradayId = $getLastIntradayId [0] ['configuration'] ['value'];
            }
            //xxx$getLastIntradayId=19836800;//test $_REQUEST ['last'];
            
            
            /*--- FIRST USE OF MEMCACHE :: START HERE ---*/

            if (class_exists ( 'Memcache' )) {
                $memcache = new Memcache ( );
                $memcache->connect ( 'localhost', 11211 ) or die ( "Could not connect" );
                $memKey3 = md5 ( 'select * from stockorg_stock.data_banks_intraday where symbol_id =' . $symbol . ' AND id > ' . $getLastIntradayId . ' ORDER BY id DESC' );
                if (! $memcache->get ( $memKey3 )) {
                    $shareData = $this->Symbol->query ( 'select * from stockorg_stock.data_banks_intraday where symbol_id =' . $symbol . ' AND id > ' . $getLastIntradayId . ' ORDER BY id DESC' );

                    $memcache->set ( $memKey3, $shareData, MEMCACHE_COMPRESSED, 60 );
                }
                $shareData = $memcache->get ( $memKey3 );

            } else {
                $shareData = $this->Symbol->query ( 'select * from stockorg_stock.data_banks_intraday where symbol_id =' . $symbol . ' AND id > ' . $getLastIntradayId . ' ORDER BY id DESC' );

            }
            
            //PRINT_R($shareData);
            
            
            /*--- FIRST USE OF MEMCACHE :: END HERE ---*/
            $timeWiseArr = array ();
            $timeKeyArr  = array ();
            foreach ( $shareData as $row ) {
                $currenttime = $row ['data_banks_intraday'] ['date'];
                //$currenttime = $currenttime + (8*60*60);
                $mod = $currenttime % $interval;
                $timeToBeAccounted = $currenttime - $mod + $interval;
                //echo date('h:i A', $timeToBeAccounted).'<br><br>';
                $timeWiseArr [$timeToBeAccounted] [] = $row;
                $modtime = date ( 'd M  h:ia', $timeToBeAccounted );
            }

            //pr($timeWiseArr);
            if(!empty($_REQUEST ['last_volume']))
                $rowDataVolumeEnd=$_REQUEST ['last_volume'];
            else
                $rowDataVolumeEnd = 0;
            $rowDataVolumeStart = 0;
            $currentDataVolume = 0;
            $tempVolumeCounter = 0;
            $totalArrayCount = count($timeWiseArr);
            $myDefinedCounter = 1;
            foreach ( $timeWiseArr as $key => $arr ) {
                $timeKeyArr [] = $key;
            }
            
            //pr($tempVolumeCounter);
            $finalArr = array ();
            $totalvolume = $shareData [0] ['data_banks_intraday'] ['volume'];
            $tradetimestamp = $shareData [0] ['data_banks_intraday'] ['date'];
            $dayhigh = $shareData [0] ['data_banks_intraday'] ['high'];
            $daylow = $shareData [0] ['data_banks_intraday'] ['low'];
            $dayclose = $shareData [0] ['data_banks_intraday'] ['close'];
            $dayopen = $shareData [0] ['data_banks_intraday'] ['open'];
            $totaltrade = $shareData [0] ['data_banks_intraday'] ['trade'];
            
            if($symbol == 1)
            {
                $market_summeriesSQL = mysql_fetch_assoc(mysql_query("SELECT * FROM market_summeries ORDER BY id DESC LIMIT 1"));
                $totaltrade = $market_summeriesSQL['totaltrade'];
            }
            
            
            
            $yclose=$shareData [0] ['data_banks_intraday'] ['yclose'];

            $tradeDate = date ( 'd M y h:ia', $tradetimestamp );
            $i = 0;
            $singleCount = 0;
            $finalPrice = 0;
            //pr($timeWiseArr);
            $startPrice = 0;
            $endPrice = 0;
            foreach ( $timeWiseArr as $key => $arr ) {
                $datetime = date ( 'h:i A', $key );
                $temp = array ();
                $startArr = array ();
                $endArr = array ();
                $ind = count ( $arr );
                $counterArr = count($arr);
                $finalPrice = $arr[0]['data_banks_intraday']['close'];


                if(!$rowDataVolumeStart) {
                    $rowDataVolumeStart = $arr[0]['data_banks_intraday']['volume'];
                    $startPrice = $arr[0]['data_banks_intraday']['close'];
                }

                if($myDefinedCounter==$totalArrayCount){
                    //himel
                    if(!empty($_REQUEST ['last_volume']))
                        $rowDataVolumeEnd=$_REQUEST ['last_volume'];
                    else
                        $rowDataVolumeEnd = 0;
                    //$rowDataVolumeEnd  =0;
                    //himel
                    $endPrice = $arr[0]['data_banks_intraday']['yclose'];
                }else {
                    $rowDataVolumeEnd = $arr[$counterArr-1]['data_banks_intraday']['volume'];
                    $endPrice = $arr[0]['data_banks_intraday']['close'];
                }

                //$endArr ['data_banks_intraday'] ['lastprice'];
                if ($ind == 1) {
                    $startArr = $arr [$ind - 1];
                    $endArr = $arr [$ind - 1];

                    if (isset ( $timeKeyArr [$i + 1] )) {
                        $time = $timeKeyArr [$i + 1];
                        $endvolume = $timeWiseArr [$time] [0] ['data_banks_intraday'] ['volume'];
                    } else {
                        $endvolume = 0;
                    }
                    $startvolume = $startArr ['data_banks_intraday'] ['volume'];
                } else {

                    //$startArr = $arr [0];
                    if (isset ( $timeKeyArr [$i] )) {
                        $time = $timeKeyArr [$i];

                        $preArrInd = count ($timeWiseArr [$time] );

                        $startvolume = $timeWiseArr [$time] [0] ['data_banks_intraday'] ['volume'];
                        //pr("found");
                    } else {
                        $startvolume = 0;
                        //pr('NO');
                    }
                    $endArr = $arr [$ind - 1];
                    if (isset ( $endArr )) {
                        $endvolume = $endArr ['data_banks_intraday'] ['volume'];
                    } else {
                        $endvolume = 0;
                    }
                }
                //pr($startvolume);
                //$temp ['ltp'] = $endArr ['data_banks_intraday'] ['lastprice'];
                $temp ['ltp'] = $finalPrice;
                $finalPrice = $arr[$counterArr-1]['data_banks_intraday']['lastprice'];
                //$temp['open']      = $endArr['data_banks_intraday']['open'];
                $temp ['high']  = $endArr ['data_banks_intraday'] ['high'];
                $temp ['low']   = $endArr ['data_banks_intraday'] ['low'];
                $temp ['close'] = $endArr ['data_banks_intraday'] ['close'];
                $temp ['yclose']= $endArr ['data_banks_intraday'] ['yclose'];
                $temp ['trade'] = $endArr ['data_banks_intraday'] ['trade'];
                //$tempVolumeCounter += $rowDataVolumeStart - $rowDataVolumeEnd;
                //$temp ['volume'] = $finalVolume;
                //$finalVolume =  $rowDataVolumeStart - $rowDataVolumeEnd;
                $temp ['volume'] = $rowDataVolumeStart - $rowDataVolumeEnd;
                //$temp ['volume'] = $startvolume - $endvolume;
                if($startPrice > $endPrice){
                    $myPositiveCounter += $temp ['volume'];

                }else {
                    $myNegativeCounter += $temp ['volume'];
                }

                $rowDataVolumeStart = $rowDataVolumeEnd;
                $startPrice = $endPrice;
                $myDefinedCounter++;

                //$totalVolumeCompared+= $temp ['volume'];
                $temp ['value'] = $endArr ['data_banks_intraday'] ['value'];
                $temp ['datetime'] = $datetime;
                $temp ['idatetime'] = $key;
                if($temp ['volume'] != 0)
                    $finalArr [] = $temp;

                ++ $i;
            }
            //pr($finalArr);
            /*echo "<pre>";
            print_r($finalArr);
            die;*/
            //pr("Positive".$myPositiveCounter);
            //pr("Negative".$myNegativeCounter);
            $xdata = array ();
            $ydata = array ();
            $vdata = array ();
            $totalbar = count ( $finalArr );
            foreach ( $finalArr as $mykey => $row ) {
                $volumetemp = $row ['volume'];

                if ($volumetemp < 0) {
                    continue;
                }
                //himel[
                    if(!empty($_REQUEST ['last']))
                    {
                        $volume_array[]=array('x' => $row ['idatetime'],'y' => $row ['volume']);
                        $price_array[]=array('x' => $row ['idatetime'],'y' => (double)$row ['ltp']);
                    }
                    else
                    {
                        $xdata [] = $row ['ltp'];    
                        $vdata [] = $finalArr [$mykey +1] =$row ['volume'];    
                        $ydata [] = $row ['idatetime'];    
                    }
                    
                //himel]
                
                /*if ($interval < 120 && $totalbar > 80) {

                    if ($interval == 60) {
                        $yint = 600;
                    } else {
                        $yint = 300;
                    }
                    $currenttime = $row ['idatetime'];
                    //echo '='.date('Y-m-d h:i:s',$currenttime);

                    $mod = $currenttime % $yint;

                    if ($mod == 0) {
                         $ydata [] = $row ['datetime'];
                    } else {
                         $ydata [] = "-";
                    }
                } else {
                     $ydata [] = $row ['datetime'];
                } */

            }
            
            

            //pr($ydata);
            if(empty($_REQUEST ['last']))
            {
                $xdata = array_reverse ( $xdata );
                $ydata = array_reverse ( $ydata );
                $vdata = array_reverse ( $vdata );
                //array_shift
                $max = 50;

                $lastprice = $xdata [count ( $xdata ) - 1];
                $lasttime = $ydata [count ( $ydata ) - 1];
                $lastvolume = $vdata [count ( $vdata ) - 1];

                array_unshift($vdata, 0);
                array_pop($vdata);
                
                $count_v=count($vdata);
                for($i=0;$i<$count_v;$i++)
                {
                    $volume_array[]=array('x' => $ydata[$i],'y' => $vdata[$i]);
                }
                $count_p=count($xdata);
                for($i=0;$i<$count_p;$i++)
                {
                    $price_array[]=array('x' => $ydata[$i],'y' => (double)$xdata[$i]);
                }
            }
            
            
            
            //pr($vdata);
            # The data for the chart
            $myPositiveCounter=0;
            $myNegativeCounter=0;
            $myEqualCounter=0;

            if($yclose<$xdata[0])
            {
                $myPositiveCounter=$vdata[0];
            }
            if($yclose>$xdata[0])
            {
                $myNegativeCounter=$vdata[0];
            }
            /* echo "<pre >";
            echo "xdata";
            print_r($xdata);
            echo "vdata";
            print_r($vdata);
            exit;
            */
            for($i=0;$i<count($vdata);$i++)
            {
                if($xdata[$i]>$xdata[$i-1])
                {

                    $myPositiveCounter+=$vdata[$i];
                    //echo $myPositiveCounter."myPositiveCounter[".$vdata[$i]."]".$xdata[$i-1].">".$xdata[$i]."<br />";
                }
                if ($xdata[$i]<$xdata[$i-1])
                {
                    $myNegativeCounter+=$vdata[$i];
                    //echo $myNegativeCounter."myNegativeCounter[".$vdata[$i]."]".$xdata[$i-1]."<=".$xdata[$i]."<br />";
                }
                if ($xdata[$i]==$xdata[$i-1])
                {
                    $myEqualCounter+=$vdata[$i];

                }


            }
            //himel
            
            //ready data for json encode
            $data_json['affected_row']=count($shareData);//test . not used in ctp
            $data_json['last_id']=$shareData[0]['data_banks_intraday'] ['id'];
            $data_json['last_volume']=$shareData[0]['data_banks_intraday'] ['volume'];
            //$data_json['title']="$code-$tradeDate  open: $dayopen  high : $dayhigh low : $daylow close: $dayclose Hawla : $totaltrade   Total Volume : $totalvolume ";
            //$data_json['sub_title']="Probable { Bull Vol: $myPositiveCounter($myPositivePer%) Neutral Vol: $myEqualCounter($myEqualPer%)  Bear Vol: $myNegativeCounter ($myNegativePer%) }";
            
            $data_json['price']=array_reverse($price_array);
            $data_json['volume']=array_reverse($volume_array );
            //json encode 
            $jsonresult = $this->__JEncode ( $data_json );
            
            echo $jsonresult;
            die;
            
        
        
        
    }
    function mmminchartnew($dseChart = '') 
    {

        //App::import ( 'Vendor', 'Phpchartdir', array ('file' => 'phpchartdir.php' ) );

        //require_once (WWW_ROOT . DS . 'chart' . DS . 'Image_Toolbox.class.php');

        if(!empty($_REQUEST ['inv']))
                $interval = $_REQUEST ['inv'];
            else
                $interval = 60;//$_REQUEST ['inv'];
            

        $symbol = $_GET ['sym'];

        $symbol = trim ( $symbol );

        //$interval = $_GET ['inv'];



        $symbolInfo = $this->Symbol->find ( 'first', array ('conditions' => array ('id=' . $symbol ), 'fields' => array ('Symbol.dse_code', 'Symbol.name' ) ) );



        $code = $symbolInfo ['Symbol'] ['dse_code'];

        $name = $symbolInfo ['Symbol'] ['name'];

        $minute = $interval / 60;



        if ($minute > 1) {

            $minute = $minute . ' Minutes Chart';

        } else {

            $minute = $minute . ' Minutes Chart';

        }



        $nameOfTheDay = date ( 'l' );

        if ($nameOfTheDay == 'Friday')

        $todayTimeStamp = mktime ( 0, 0, 0, date ( 'm' ), date ( 'd' ) - 1, date ( 'Y' ) );

        else if ($nameOfTheDay == 'Saturday')

        $todayTimeStamp = mktime ( 0, 0, 0, date ( 'm' ), date ( 'd' ) - 2, date ( 'Y' ) );

        else

        $todayTimeStamp = mktime ( 0, 0, 0, date ( 'm' ), date ( 'd' ), date ( 'Y' ) );



        //$todayTimeStamp = mktime(0, 0, 0, date('m'), date('d'), date('Y'));




        /*--- FIRST USE OF MEMCACHE :: START HERE ---*/

        if (class_exists ( 'Memcache' )) {



            $memcache = new Memcache ( );

            $memcache->connect ( 'localhost', 11211 ) or die ( "Could not connect" );



            $memKey3 = md5 ( 'select * from stockorg_stock.data_banks_intraday where symbol_id =' . $symbol . ' AND date >= ' . $todayTimeStamp . ' ORDER BY id DESC LIMIT 0, 400' );



            if (! $memcache->get ( $memKey3 )) {

                $shareData = $this->Symbol->query ( 'select * from stockorg_stock.data_banks_intraday where symbol_id =' . $symbol . ' AND date >= ' . $todayTimeStamp . ' ORDER BY id DESC LIMIT 0, 400' );

                $memcache->set ( $memKey3, $shareData, MEMCACHE_COMPRESSED, 60 );

            }



            $shareData = $memcache->get ( $memKey3 );

        } else {

            $shareData = $this->Symbol->query ( 'select * from stockorg_stock.data_banks_intraday where symbol_id =' . $symbol . ' AND date >= ' . $todayTimeStamp . ' ORDER BY id DESC LIMIT 0, 400' );

        }

        /*--- FIRST USE OF MEMCACHE :: END HERE ---*/



        $timeWiseArr = array ();
            $timeKeyArr  = array ();
            foreach ( $shareData as $row ) {
                $currenttime = $row ['data_banks_intraday'] ['date'];
                //$currenttime = $currenttime + (8*60*60);
                $mod = $currenttime % $interval;
                $timeToBeAccounted = $currenttime - $mod + $interval;
                //echo date('h:i A', $timeToBeAccounted).'<br><br>';
                $timeWiseArr [$timeToBeAccounted] [] = $row;
                $modtime = date ( 'd M  h:ia', $timeToBeAccounted );
            }

            //pr($timeWiseArr);
            $rowDataVolumeStart = 0;
            $rowDataVolumeEnd = 0;
            $currentDataVolume = 0;
            $tempVolumeCounter = 0;
            $totalArrayCount = count($timeWiseArr);
            $myDefinedCounter = 1;
            foreach ( $timeWiseArr as $key => $arr ) {
                $timeKeyArr [] = $key;
            }

            //pr($tempVolumeCounter);
            $finalArr = array ();
            $totalvolume = $shareData [0] ['data_banks_intraday'] ['volume'];
            $tradetimestamp = $shareData [0] ['data_banks_intraday'] ['date'];
            $dayhigh = $shareData [0] ['data_banks_intraday'] ['high'];
            $daylow = $shareData [0] ['data_banks_intraday'] ['low'];
            $totaltrade = $shareData [0] ['data_banks_intraday'] ['trade'];
            $yclose=$shareData [0] ['data_banks_intraday'] ['yclose'];

            $tradeDate = date ( 'd M y h:ia', $tradetimestamp );
            $i = 0;
            $singleCount = 0;
            $finalPrice = 0;
            //pr($timeWiseArr);
            $startPrice = 0;
            $endPrice = 0;
            foreach ( $timeWiseArr as $key => $arr ) {
                $datetime = date ( 'h:i A', $key );
                $temp = array ();
                $startArr = array ();
                $endArr = array ();
                $ind = count ( $arr );
                $counterArr = count($arr);
                $finalPrice = $arr[0]['data_banks_intraday']['close'];


                if(!$rowDataVolumeStart) {
                    $rowDataVolumeStart = $arr[0]['data_banks_intraday']['volume'];
                    $startPrice = $arr[0]['data_banks_intraday']['close'];
                }

                if($myDefinedCounter==$totalArrayCount){
                    $rowDataVolumeEnd  =0;
                    $endPrice = $arr[0]['data_banks_intraday']['yclose'];
                }else {
                    $rowDataVolumeEnd = $arr[$counterArr-1]['data_banks_intraday']['volume'];
                    $endPrice = $arr[0]['data_banks_intraday']['close'];
                }

                //$endArr ['data_banks_intraday'] ['lastprice'];
                if ($ind == 1) {
                    $startArr = $arr [$ind - 1];
                    $endArr = $arr [$ind - 1];

                    if (isset ( $timeKeyArr [$i + 1] )) {
                        $time = $timeKeyArr [$i + 1];
                        $endvolume = $timeWiseArr [$time] [0] ['data_banks_intraday'] ['volume'];
                    } else {
                        $endvolume = 0;
                    }
                    $startvolume = $startArr ['data_banks_intraday'] ['volume'];
                } else {

                    //$startArr = $arr [0];
                    if (isset ( $timeKeyArr [$i] )) {
                        $time = $timeKeyArr [$i];

                        $preArrInd = count ($timeWiseArr [$time] );

                        $startvolume = $timeWiseArr [$time] [0] ['data_banks_intraday'] ['volume'];
                        //pr("found");
                    } else {
                        $startvolume = 0;
                        //pr('NO');
                    }
                    $endArr = $arr [$ind - 1];
                    if (isset ( $endArr )) {
                        $endvolume = $endArr ['data_banks_intraday'] ['volume'];
                    } else {
                        $endvolume = 0;
                    }
                }
                //pr($startvolume);
                //$temp ['ltp'] = $endArr ['data_banks_intraday'] ['lastprice'];
                $temp ['ltp'] = $finalPrice;
                $finalPrice = $arr[$counterArr-1]['data_banks_intraday']['lastprice'];
                //$temp['open']      = $endArr['data_banks_intraday']['open'];
                $temp ['high'] = $endArr ['data_banks_intraday'] ['high'];
                $temp ['low'] = $endArr ['data_banks_intraday'] ['low'];
                $temp ['close'] = $endArr ['data_banks_intraday'] ['close'];
                $temp ['yclose'] = $endArr ['data_banks_intraday'] ['yclose'];
                $temp ['trade'] = $endArr ['data_banks_intraday'] ['trade'];
                //$tempVolumeCounter += $rowDataVolumeStart - $rowDataVolumeEnd;
                //$temp ['volume'] = $finalVolume;
                //$finalVolume =  $rowDataVolumeStart - $rowDataVolumeEnd;
                $temp ['volume'] = $rowDataVolumeStart - $rowDataVolumeEnd;
                //$temp ['volume'] = $startvolume - $endvolume;
                if($startPrice > $endPrice){
                    $myPositiveCounter += $temp ['volume'];

                }else {
                    $myNegativeCounter += $temp ['volume'];
                }
                $rowDataVolumeStart = $rowDataVolumeEnd;
                $startPrice = $endPrice;
                $myDefinedCounter++;
                //$totalVolumeCompared+= $temp ['volume'];
                $temp ['value'] = $endArr ['data_banks_intraday'] ['value'];
                $temp ['datetime'] = $datetime;
                $temp ['idatetime'] = $key;
                $finalArr [] = $temp;
                ++ $i;
            }


            //pr("Positive".$myPositiveCounter);
            //pr("Negative".$myNegativeCounter);
            $xdata = array ();
            $ydata = array ();
            $vdata = array ();
        //$totalbar = count($finalArr);



$j = 0;
        foreach ( $finalArr as $row ) {

            $tempvolume = $row ['volume'];

            if ($tempvolume < 0) {

                continue;

            }



            if ($j > 15)

            break;


           /*
           himel
            $volume_array[]=array('x' => $row ['idatetime'],'y' => $row ['volume']);
            $price_array[]=array('x' => $row ['idatetime'],'y' => (double)$row ['ltp']);
            */
            $xdata [] = $row ['ltp'];

            $vdata [] = $row ['volume'];

            //$ydata [] = $row ['datetime'];
            $ydata [] = $row ['idatetime'];



            $j ++;

        }



        $xdata = array_reverse ( $xdata );

        $ydata = array_reverse ( $ydata );

        $vdata = array_reverse ( $vdata );



        $max = 50;



        $lastprice = $xdata [count ( $xdata ) - 1];

        $lasttime = $ydata [count ( $ydata ) - 1];

        $lastvolume = $vdata [count ( $vdata ) - 1];

        array_unshift($vdata, 0);
            array_pop($vdata);
            
        //himel
        $count_v=count($vdata);
        for($i=0;$i<$count_v;$i++)
        {
            $volume_array[]=array('x' => $ydata[$i],'y' => $vdata[$i]);
        }
        $count_p=count($xdata);
        for($i=0;$i<$count_p;$i++)
        {
            $price_array[]=array('x' => $ydata[$i],'y' => (double)$xdata[$i]);
        }
        //print_r($volume_array);
        //himel
        
        # The data for the chart
        $data0 = $xdata;

        $data1 = $vdata;
//$data1[count($vdata)-1]=$lastvolume;
        $labels = $ydata;

        $data_json['code']=$code;
        $data_json['title']="LTP: ".$lastprice." TOTAL VOL: ".$totalvolume;
        $data_json['price']=$price_array;
        $data_json['volume']=$volume_array;
            
            $jsonresult = $this->__JEncode ( $data_json );
            //echo '({"total":"' . count ( $xdata ) . '","results":' . $jsonresult . '})';
            echo $jsonresult;
            //echo join(",",array_values($xdata));
            //echo 'ac';
            die;
        
        }
        function minutechart_wo_load($updateRequest = '') 
        {

        //pr($_REQUEST);
        //pr($updateRequest);
                $this->layout = 'default-compare';
                
                $this->pageTitle = 'Minute Chart - Price Chart/ Graph For DSE';
                $this->set("meta_description", "Live Market monitor tool for Dhaka Stock Exchange");
                $this->set("meta_keywords", "DSE Market Monitor,DSE Price,Share price information");

                
                if (! $this->Session->check ( 'Auth.User' )) {
                    $this->Session->setFlash ( 'Please login again.' );
                    $this->Session->del('Auth.redirect');
                    $this->Session->write('Auth.redirect', 'resources/minutechart');
                    $this->Session->write('Auth.gobackpage', 'resources/minutechart');
                    
                    $this->redirect ( array ('controller' => 'users', 'action' => 'login' ) );
                }
            
            //$this->Session->del('Auth.redirect');
            $inv = 60;
            $inv1 = 300;
            if (isset ( $updateRequest ['sym'] ) && $updateRequest ['sym'] != '')
            $_REQUEST ['TickerSymbol'] = $updateRequest ['sym'];
            if (isset ( $updateRequest ['inv'] ) && $updateRequest ['inv'] != '')
            $_REQUEST ['inv'] = $updateRequest ['inv'];
            if (isset ( $_REQUEST ['TickerSymbol'] )) {
                $inv = $_REQUEST ['inv'];
                $symbolInfo = $this->Symbol->find ( 'first', array ('conditions' => array ('id=' . $_REQUEST ['TickerSymbol'] ), 'fields' => array ('Symbol.dse_code', 'Symbol.name' ) ) );
                $name = $symbolInfo ['Symbol'] ['name'];
                $name = ucwords ( strtolower ( $name ) );
                $this->pageTitle = "$name :: Minute Chart";
                $this->set ( 'sym', $_REQUEST ['TickerSymbol'] );
                //App::import ( 'Vendor', 'Phpchartdir', array ('file' => 'phpchartdir.php' ) );
                $symbol = $_REQUEST ['TickerSymbol'];
                $symbol = trim ( $symbol );
                $interval = $inv;
                $code = $symbolInfo ['Symbol'] ['dse_code'];
                $name = $symbolInfo ['Symbol'] ['name'];
                $minute = $interval / 60;
                if ($minute > 1) {
                    $minute = $minute . ' Minutes Chart';
                } else {
                    $minute = $minute . ' Minutes Chart';
                }
                $nameOfTheDay = date ( 'l' );
                if ($nameOfTheDay == 'Friday')
                $todayTimeStamp = mktime ( 0, 0, 0, date ( 'm' ), date ( 'd' ) - 1, date ( 'Y' ) );
                else if ($nameOfTheDay == 'Saturday')
                $todayTimeStamp = mktime ( 0, 0, 0, date ( 'm' ), date ( 'd' ) - 2, date ( 'Y' ) );
                else
                $todayTimeStamp = mktime ( 0, 0, 0, date ( 'm' ), date ( 'd' ), date ( 'Y' ) );
                /*$todayTimeStamp = mktime(0, 0, 0, date('m'), date('d'), date('Y'));*/
                $getLastIntradayId = $this->Symbol->query ( 'SELECT value from configuration WHERE name=\'data_bank_intraday_lid\' ' );
                $getLastIntradayId = $getLastIntradayId [0] ['configuration'] ['value'];
                /*--- FIRST USE OF MEMCACHE :: START HERE ---*/

                if (class_exists ( 'Memcache' )) {
                    $memcache = new Memcache ( );
                    $memcache->connect ( 'localhost', 11211 ) or die ( "Could not connect" );
                    $memKey3 = md5 ( 'select * from stockorg_stock.data_banks_intraday where symbol_id =' . $symbol . ' AND id > ' . $getLastIntradayId . ' ORDER BY id DESC' );
                    if (! $memcache->get ( $memKey3 )) {
                        $shareData = $this->Symbol->query ( 'select * from stockorg_stock.data_banks_intraday where symbol_id =' . $symbol . ' AND id > ' . $getLastIntradayId . ' ORDER BY id DESC' );

                        $memcache->set ( $memKey3, $shareData, MEMCACHE_COMPRESSED, 60 );
                    }
                    $shareData = $memcache->get ( $memKey3 );

                } else {
                    $shareData = $this->Symbol->query ( 'select * from stockorg_stock.data_banks_intraday where symbol_id =' . $symbol . ' AND id > ' . $getLastIntradayId . ' ORDER BY id DESC' );

                }

                //himel
                    $this->set('last_point_id',$shareData[0]['data_banks_intraday'] ['id']);
                    $this->set('last_point_vol',$shareData[0]['data_banks_intraday'] ['volume']);
                    $this->set('code',$shareData[0]['data_banks_intraday'] ['code']);
                    $this->set('last_date',$shareData[0]['data_banks_intraday'] ['date']);
                    $this->set('TickerSymbol',$symbol);
                    /*echo $shareData[0]['data_banks_intraday'] ['id'];
                    die();*/
                //himel
                /*--- FIRST USE OF MEMCACHE :: END HERE ---*/
                $timeWiseArr = array ();
                $timeKeyArr  = array ();
                foreach ( $shareData as $row ) {
                    $currenttime = $row ['data_banks_intraday'] ['date'];
                    //$currenttime = $currenttime + (8*60*60);
                    $mod = $currenttime % $interval;
                    $timeToBeAccounted = $currenttime - $mod + $interval;
                    //echo date('h:i A', $timeToBeAccounted).'<br><br>';
                    $timeWiseArr [$timeToBeAccounted] [] = $row;
                    $modtime = date ( 'd M  h:ia', $timeToBeAccounted );
                }

                //pr($timeWiseArr);
                $rowDataVolumeStart = 0;
                $rowDataVolumeEnd = 0;
                $currentDataVolume = 0;
                $tempVolumeCounter = 0;
                $totalArrayCount = count($timeWiseArr);
                $myDefinedCounter = 1;
                foreach ( $timeWiseArr as $key => $arr ) {
                    $timeKeyArr [] = $key;
                }

                //pr($tempVolumeCounter);
                $finalArr = array ();
                $totalvolume = $shareData [0] ['data_banks_intraday'] ['volume'];
                $tradetimestamp = $shareData [0] ['data_banks_intraday'] ['date'];
                $dayhigh = $shareData [0] ['data_banks_intraday'] ['high'];
                $daylow = $shareData [0] ['data_banks_intraday'] ['low'];
                $dayclose = $shareData [0] ['data_banks_intraday'] ['close'];
                $dayopen = $shareData [0] ['data_banks_intraday'] ['open'];
                $totaltrade = $shareData [0] ['data_banks_intraday'] ['trade'];
                
                if($symbol == 1)
                {
                    $market_summeriesSQL = mysql_fetch_assoc(mysql_query("SELECT * FROM market_summeries ORDER BY id DESC LIMIT 1"));
                    $totaltrade = $market_summeriesSQL['totaltrade'];
                }
                
                
                
                $yclose=$shareData [0] ['data_banks_intraday'] ['yclose'];

                $tradeDate = date ( 'd M y h:ia', $tradetimestamp );
                $i = 0;
                $singleCount = 0;
                $finalPrice = 0;
                //pr($timeWiseArr);
                $startPrice = 0;
                $endPrice = 0;
                foreach ( $timeWiseArr as $key => $arr ) {
                    $datetime = date ( 'h:i A', $key );
                    $temp = array ();
                    $startArr = array ();
                    $endArr = array ();
                    $ind = count ( $arr );
                    $counterArr = count($arr);
                    $finalPrice = $arr[0]['data_banks_intraday']['close'];


                    if(!$rowDataVolumeStart) {
                        $rowDataVolumeStart = $arr[0]['data_banks_intraday']['volume'];
                        $startPrice = $arr[0]['data_banks_intraday']['close'];
                    }

                    if($myDefinedCounter==$totalArrayCount){
                        $rowDataVolumeEnd  =0;
                        $endPrice = $arr[0]['data_banks_intraday']['yclose'];
                    }else {
                        $rowDataVolumeEnd = $arr[$counterArr-1]['data_banks_intraday']['volume'];
                        $endPrice = $arr[0]['data_banks_intraday']['close'];
                    }

                    //$endArr ['data_banks_intraday'] ['lastprice'];
                    if ($ind == 1) {
                        $startArr = $arr [$ind - 1];
                        $endArr = $arr [$ind - 1];

                        if (isset ( $timeKeyArr [$i + 1] )) {
                            $time = $timeKeyArr [$i + 1];
                            $endvolume = $timeWiseArr [$time] [0] ['data_banks_intraday'] ['volume'];
                        } else {
                            $endvolume = 0;
                        }
                        $startvolume = $startArr ['data_banks_intraday'] ['volume'];
                    } else {

                        //$startArr = $arr [0];
                        if (isset ( $timeKeyArr [$i] )) {
                            $time = $timeKeyArr [$i];

                            $preArrInd = count ($timeWiseArr [$time] );

                            $startvolume = $timeWiseArr [$time] [0] ['data_banks_intraday'] ['volume'];
                            //pr("found");
                        } else {
                            $startvolume = 0;
                            //pr('NO');
                        }
                        $endArr = $arr [$ind - 1];
                        if (isset ( $endArr )) {
                            $endvolume = $endArr ['data_banks_intraday'] ['volume'];
                        } else {
                            $endvolume = 0;
                        }
                    }
                    //pr($startvolume);
                    //$temp ['ltp'] = $endArr ['data_banks_intraday'] ['lastprice'];
                    $temp ['ltp'] = $finalPrice;
                    $finalPrice = $arr[$counterArr-1]['data_banks_intraday']['lastprice'];
                    //$temp['open']      = $endArr['data_banks_intraday']['open'];
                    $temp ['high'] = $endArr ['data_banks_intraday'] ['high'];
                    $temp ['low'] = $endArr ['data_banks_intraday'] ['low'];
                    $temp ['close'] = $endArr ['data_banks_intraday'] ['close'];
                    $temp ['yclose'] = $endArr ['data_banks_intraday'] ['yclose'];
                    $temp ['trade'] = $endArr ['data_banks_intraday'] ['trade'];
                    //$tempVolumeCounter += $rowDataVolumeStart - $rowDataVolumeEnd;
                    //$temp ['volume'] = $finalVolume;
                    //$finalVolume =  $rowDataVolumeStart - $rowDataVolumeEnd;
                    $temp ['volume'] = $rowDataVolumeStart - $rowDataVolumeEnd;
                    //$temp ['volume'] = $startvolume - $endvolume;
                    if($startPrice > $endPrice){
                        $myPositiveCounter += $temp ['volume'];

                    }else {
                        $myNegativeCounter += $temp ['volume'];
                    }

                    $rowDataVolumeStart = $rowDataVolumeEnd;
                    $startPrice = $endPrice;
                    $myDefinedCounter++;

                    //$totalVolumeCompared+= $temp ['volume'];
                    $temp ['value'] = $endArr ['data_banks_intraday'] ['value'];
                    $temp ['datetime'] = $datetime;
                    $temp ['idatetime'] = $key;
                    if($temp ['volume'] != 0)
                        $finalArr [] = $temp;

                    ++ $i;
                }

                /*echo "<pre>";
                print_r($finalArr);
                die;*/
                //pr("Positive".$myPositiveCounter);
                //pr("Negative".$myNegativeCounter);
                $xdata = array ();
                $ydata = array ();
                $vdata = array ();
                $totalbar = count ( $finalArr );
                foreach ( $finalArr as $mykey => $row ) {
                    $volumetemp = $row ['volume'];

                    if ($volumetemp < 0) {
                        continue;
                    }

                    $xdata [] = $row ['ltp'];
                    $vdata [] = $finalArr [$mykey +1] =$row ['volume'];
                    $ydata [] = $row ['idatetime']; ////HIMEL
                    //himel[
                    
                       /* $volume_array[]=array($row ['idatetime'],$row ['volume']);
                        $price_array[]=array($row ['idatetime'],(double)$row ['ltp']);*/
                    //himel]
                    
                    
                    /*if ($interval < 120 && $totalbar > 80) {

                        if ($interval == 60) {
                            $yint = 600;
                        } else {
                            $yint = 300;
                        }
                        $currenttime = $row ['idatetime'];

                        $mod = $currenttime % $yint;

                        if ($mod == 0) {
                            $ydata [] = $row ['datetime'];
                        } else {
                            $ydata [] = "-";
                        }
                    } else {
                        $ydata [] = $row ['datetime'];
                    }*/

                }
                
                

                $xdata = array_reverse ( $xdata );
                $ydata = array_reverse ( $ydata );
                $vdata = array_reverse ( $vdata );
                //array_shift
                $max = 50;

                $lastprice = $xdata [count ( $xdata ) - 1];
                $lasttime = $ydata [count ( $ydata ) - 1];
                $lastvolume = $vdata [count ( $vdata ) - 1];

                array_unshift($vdata, 0);
                array_pop($vdata);
                ////HIMEL][
                $count_v=count($vdata);
                for($i=0;$i<$count_v;$i++)
                {
                    $volume_array[]=array($ydata[$i],$vdata[$i]);
                }
                $count_p=count($xdata);
                for($i=0;$i<$count_p;$i++)
                {
                    $price_array[]=array($ydata[$i],(double)$xdata[$i]);
                }    
                //HIMEL]
                # The data for the chart
                $myPositiveCounter=0;
                $myNegativeCounter=0;
                $myEqualCounter=0;

                if($yclose<$xdata[0])
                {
                    $myPositiveCounter=$vdata[0];
                }
                if($yclose>$xdata[0])
                {
                    $myNegativeCounter=$vdata[0];
                }
                /* echo "<pre >";
                echo "xdata";
                print_r($xdata);
                echo "vdata";
                print_r($vdata);
                exit;
                */
                for($i=0;$i<count($vdata);$i++)
                {
                    if($xdata[$i]>$xdata[$i-1])
                    {

                        $myPositiveCounter+=$vdata[$i];
                        //echo $myPositiveCounter."myPositiveCounter[".$vdata[$i]."]".$xdata[$i-1].">".$xdata[$i]."<br />";
                    }
                    if ($xdata[$i]<$xdata[$i-1])
                    {
                        $myNegativeCounter+=$vdata[$i];
                        //echo $myNegativeCounter."myNegativeCounter[".$vdata[$i]."]".$xdata[$i-1]."<=".$xdata[$i]."<br />";
                    }
                    if ($xdata[$i]==$xdata[$i-1])
                    {
                        $myEqualCounter+=$vdata[$i];

                    }


                }
                //exit;
                /*$this->set('xdata',$xdata);
                $this->set('vdata',$vdata);
                $this->set('labels',$ydata);  */
                //***$this->set('graph_title',"$code-$tradeDate  open: $dayopen  high : $dayhigh low : $daylow close: $dayclose Hawla : $totaltrade   Total Volume : $totalvolume ");
                //***$this->set('graph_subtitle',"Probable { Bull Vol: $myPositiveCounter($myPositivePer%) Neutral Vol: $myEqualCounter($myEqualPer%)  Bear Vol: $myNegativeCounter ($myNegativePer%) }");
                
                
                $data_['volume']=array_reverse($volume_array);
                $data_['price']=array_reverse($price_array);
                
                $this->set('data',$data_);
                
                $this->set('company_name',$code);
                $this->set('tradeDate',$tradeDate);
                $this->set('dayopen',$dayopen);
                $this->set('dayhigh',$dayhigh);
                $this->set('daylow',$daylow);         
                $this->set('dayclose',$dayclose);
                
            }                            
            $this->set ( 'inv', $inv );
            $this->set ( 'inv1', $inv1 );
        }
        function minutechart_element($updateRequest = '') 
        {

        //pr($_REQUEST);
        //pr($updateRequest);
        $this->layout = 'default-compare';
        
        $this->pageTitle = 'Minute Chart - Price Chart/ Graph For DSE';
        $this->set("meta_description", "Live Market monitor tool for Dhaka Stock Exchange");
        $this->set("meta_keywords", "DSE Market Monitor,DSE Price,Share price information");

        
        if (! $this->Session->check ( 'Auth.User' )) {
            $this->Session->setFlash ( 'Please login again.' );
            $this->Session->del('Auth.redirect');
            $this->Session->write('Auth.redirect', 'resources/minutechart');
            $this->Session->write('Auth.gobackpage', 'resources/minutechart');
            
            $this->redirect ( array ('controller' => 'users', 'action' => 'login' ) );
        }
        //$this->Session->del('Auth.redirect');
        $inv = 60;
        $inv1 = 300;
        if (isset ( $updateRequest ['sym'] ) && $updateRequest ['sym'] != '')
        $_REQUEST ['TickerSymbol'] = $updateRequest ['sym'];
        if (isset ( $updateRequest ['inv'] ) && $updateRequest ['inv'] != '')
        $_REQUEST ['inv'] = $updateRequest ['inv'];
        if (isset ( $_REQUEST ['TickerSymbol'] )) {
            $inv = $_REQUEST ['inv'];
            $symbolInfo = $this->Symbol->find ( 'first', array ('conditions' => array ('id=' . $_REQUEST ['TickerSymbol'] ), 'fields' => array ('Symbol.dse_code', 'Symbol.name' ) ) );
            $name = $symbolInfo ['Symbol'] ['name'];
            $name = ucwords ( strtolower ( $name ) );
            $this->pageTitle = "$name :: Minute Chart";
            $this->set ( 'sym', $_REQUEST ['TickerSymbol'] );
            //App::import ( 'Vendor', 'Phpchartdir', array ('file' => 'phpchartdir.php' ) );
            $symbol = $_REQUEST ['TickerSymbol'];
            $symbol = trim ( $symbol );
            $interval = $inv;
            $code = $symbolInfo ['Symbol'] ['dse_code'];
            $name = $symbolInfo ['Symbol'] ['name'];
            $minute = $interval / 60;
            if ($minute > 1) {
                $minute = $minute . ' Minutes Chart';
            } else {
                $minute = $minute . ' Minutes Chart';
            }
            $nameOfTheDay = date ( 'l' );
            if ($nameOfTheDay == 'Friday')
            $todayTimeStamp = mktime ( 0, 0, 0, date ( 'm' ), date ( 'd' ) - 1, date ( 'Y' ) );
            else if ($nameOfTheDay == 'Saturday')
            $todayTimeStamp = mktime ( 0, 0, 0, date ( 'm' ), date ( 'd' ) - 2, date ( 'Y' ) );
            else
            $todayTimeStamp = mktime ( 0, 0, 0, date ( 'm' ), date ( 'd' ), date ( 'Y' ) );
            /*$todayTimeStamp = mktime(0, 0, 0, date('m'), date('d'), date('Y'));*/
            $getLastIntradayId = $this->Symbol->query ( 'SELECT value from configuration WHERE name=\'data_bank_intraday_lid\' ' );
            $getLastIntradayId = $getLastIntradayId [0] ['configuration'] ['value'];
            /*--- FIRST USE OF MEMCACHE :: START HERE ---*/

            if (class_exists ( 'Memcache' )) {
                $memcache = new Memcache ( );
                $memcache->connect ( 'localhost', 11211 ) or die ( "Could not connect" );
                $memKey3 = md5 ( 'select * from stockorg_stock.data_banks_intraday where symbol_id =' . $symbol . ' AND id > ' . $getLastIntradayId . ' ORDER BY id DESC' );
                if (! $memcache->get ( $memKey3 )) {
                    $shareData = $this->Symbol->query ( 'select * from stockorg_stock.data_banks_intraday where symbol_id =' . $symbol . ' AND id > ' . $getLastIntradayId . ' ORDER BY id DESC' );

                    $memcache->set ( $memKey3, $shareData, MEMCACHE_COMPRESSED, 60 );
                }
                $shareData = $memcache->get ( $memKey3 );

            } else {
                $shareData = $this->Symbol->query ( 'select * from stockorg_stock.data_banks_intraday where symbol_id =' . $symbol . ' AND id > ' . $getLastIntradayId . ' ORDER BY id DESC' );

            }

            //himel
                $this->set('last_point_id',$shareData[0]['data_banks_intraday'] ['id']);
                $this->set('last_point_vol',$shareData[0]['data_banks_intraday'] ['volume']);
                $this->set('code',$shareData[0]['data_banks_intraday'] ['code']);
                $this->set('last_date',$shareData[0]['data_banks_intraday'] ['date']);
                $this->set('TickerSymbol',$symbol);
                /*echo $shareData[0]['data_banks_intraday'] ['id'];
                die();*/
            //himel
            /*--- FIRST USE OF MEMCACHE :: END HERE ---*/
            $timeWiseArr = array ();
            $timeKeyArr  = array ();
            foreach ( $shareData as $row ) {
                $currenttime = $row ['data_banks_intraday'] ['date'];
                //$currenttime = $currenttime + (8*60*60);
                $mod = $currenttime % $interval;
                $timeToBeAccounted = $currenttime - $mod + $interval;
                //echo date('h:i A', $timeToBeAccounted).'<br><br>';
                $timeWiseArr [$timeToBeAccounted] [] = $row;
                $modtime = date ( 'd M  h:ia', $timeToBeAccounted );
            }

            //pr($timeWiseArr);
            $rowDataVolumeStart = 0;
            $rowDataVolumeEnd = 0;
            $currentDataVolume = 0;
            $tempVolumeCounter = 0;
            $totalArrayCount = count($timeWiseArr);
            $myDefinedCounter = 1;
            foreach ( $timeWiseArr as $key => $arr ) {
                $timeKeyArr [] = $key;
            }

            //pr($tempVolumeCounter);
            $finalArr = array ();
            $totalvolume = $shareData [0] ['data_banks_intraday'] ['volume'];
            $tradetimestamp = $shareData [0] ['data_banks_intraday'] ['date'];
            $dayhigh = $shareData [0] ['data_banks_intraday'] ['high'];
            $daylow = $shareData [0] ['data_banks_intraday'] ['low'];
            $dayclose = $shareData [0] ['data_banks_intraday'] ['close'];
            $dayopen = $shareData [0] ['data_banks_intraday'] ['open'];
            $totaltrade = $shareData [0] ['data_banks_intraday'] ['trade'];
            
            if($symbol == 1)
            {
                $market_summeriesSQL = mysql_fetch_assoc(mysql_query("SELECT * FROM market_summeries ORDER BY id DESC LIMIT 1"));
                $totaltrade = $market_summeriesSQL['totaltrade'];
            }
            
            
            
            $yclose=$shareData [0] ['data_banks_intraday'] ['yclose'];

            $tradeDate = date ( 'd M y h:ia', $tradetimestamp );
            $i = 0;
            $singleCount = 0;
            $finalPrice = 0;
            //pr($timeWiseArr);
            $startPrice = 0;
            $endPrice = 0;
            foreach ( $timeWiseArr as $key => $arr ) {
                $datetime = date ( 'h:i A', $key );
                $temp = array ();
                $startArr = array ();
                $endArr = array ();
                $ind = count ( $arr );
                $counterArr = count($arr);
                $finalPrice = $arr[0]['data_banks_intraday']['close'];


                if(!$rowDataVolumeStart) {
                    $rowDataVolumeStart = $arr[0]['data_banks_intraday']['volume'];
                    $startPrice = $arr[0]['data_banks_intraday']['close'];
                }

                if($myDefinedCounter==$totalArrayCount){
                    $rowDataVolumeEnd  =0;
                    $endPrice = $arr[0]['data_banks_intraday']['yclose'];
                }else {
                    $rowDataVolumeEnd = $arr[$counterArr-1]['data_banks_intraday']['volume'];
                    $endPrice = $arr[0]['data_banks_intraday']['close'];
                }

                //$endArr ['data_banks_intraday'] ['lastprice'];
                if ($ind == 1) {
                    $startArr = $arr [$ind - 1];
                    $endArr = $arr [$ind - 1];

                    if (isset ( $timeKeyArr [$i + 1] )) {
                        $time = $timeKeyArr [$i + 1];
                        $endvolume = $timeWiseArr [$time] [0] ['data_banks_intraday'] ['volume'];
                    } else {
                        $endvolume = 0;
                    }
                    $startvolume = $startArr ['data_banks_intraday'] ['volume'];
                } else {

                    //$startArr = $arr [0];
                    if (isset ( $timeKeyArr [$i] )) {
                        $time = $timeKeyArr [$i];

                        $preArrInd = count ($timeWiseArr [$time] );

                        $startvolume = $timeWiseArr [$time] [0] ['data_banks_intraday'] ['volume'];
                        //pr("found");
                    } else {
                        $startvolume = 0;
                        //pr('NO');
                    }
                    $endArr = $arr [$ind - 1];
                    if (isset ( $endArr )) {
                        $endvolume = $endArr ['data_banks_intraday'] ['volume'];
                    } else {
                        $endvolume = 0;
                    }
                }
                //pr($startvolume);
                //$temp ['ltp'] = $endArr ['data_banks_intraday'] ['lastprice'];
                $temp ['ltp'] = $finalPrice;
                $finalPrice = $arr[$counterArr-1]['data_banks_intraday']['lastprice'];
                //$temp['open']      = $endArr['data_banks_intraday']['open'];
                $temp ['high'] = $endArr ['data_banks_intraday'] ['high'];
                $temp ['low'] = $endArr ['data_banks_intraday'] ['low'];
                $temp ['close'] = $endArr ['data_banks_intraday'] ['close'];
                $temp ['yclose'] = $endArr ['data_banks_intraday'] ['yclose'];
                $temp ['trade'] = $endArr ['data_banks_intraday'] ['trade'];
                //$tempVolumeCounter += $rowDataVolumeStart - $rowDataVolumeEnd;
                //$temp ['volume'] = $finalVolume;
                //$finalVolume =  $rowDataVolumeStart - $rowDataVolumeEnd;
                $temp ['volume'] = $rowDataVolumeStart - $rowDataVolumeEnd;
                //$temp ['volume'] = $startvolume - $endvolume;
                if($startPrice > $endPrice){
                    $myPositiveCounter += $temp ['volume'];

                }else {
                    $myNegativeCounter += $temp ['volume'];
                }

                $rowDataVolumeStart = $rowDataVolumeEnd;
                $startPrice = $endPrice;
                $myDefinedCounter++;

                //$totalVolumeCompared+= $temp ['volume'];
                $temp ['value'] = $endArr ['data_banks_intraday'] ['value'];
                $temp ['datetime'] = $datetime;
                $temp ['idatetime'] = $key;
                if($temp ['volume'] != 0)
                    $finalArr [] = $temp;

                ++ $i;
            }

            /*echo "<pre>";
            print_r($finalArr);
            die;*/
            //pr("Positive".$myPositiveCounter);
            //pr("Negative".$myNegativeCounter);
            $xdata = array ();
            $ydata = array ();
            $vdata = array ();
            $totalbar = count ( $finalArr );
            foreach ( $finalArr as $mykey => $row ) {
                $volumetemp = $row ['volume'];

                if ($volumetemp < 0) {
                    continue;
                }

                $xdata [] = $row ['ltp'];
                $vdata [] = $finalArr [$mykey +1] =$row ['volume'];
                $ydata [] = $row ['idatetime']; ////HIMEL
                //himel[
                
                   /* $volume_array[]=array($row ['idatetime'],$row ['volume']);
                    $price_array[]=array($row ['idatetime'],(double)$row ['ltp']);*/
                //himel]
                
                
                /*if ($interval < 120 && $totalbar > 80) {

                    if ($interval == 60) {
                        $yint = 600;
                    } else {
                        $yint = 300;
                    }
                    $currenttime = $row ['idatetime'];

                    $mod = $currenttime % $yint;

                    if ($mod == 0) {
                        $ydata [] = $row ['datetime'];
                    } else {
                        $ydata [] = "-";
                    }
                } else {
                    $ydata [] = $row ['datetime'];
                }*/

            }
            
            

            $xdata = array_reverse ( $xdata );
            $ydata = array_reverse ( $ydata );
            $vdata = array_reverse ( $vdata );
            //array_shift
            $max = 50;

            $lastprice = $xdata [count ( $xdata ) - 1];
            $lasttime = $ydata [count ( $ydata ) - 1];
            $lastvolume = $vdata [count ( $vdata ) - 1];

            array_unshift($vdata, 0);
            array_pop($vdata);
            ////HIMEL][
            $count_v=count($vdata);
            for($i=0;$i<$count_v;$i++)
            {
                $volume_array[]=array($ydata[$i],$vdata[$i]);
            }
            $count_p=count($xdata);
            for($i=0;$i<$count_p;$i++)
            {
                $price_array[]=array($ydata[$i],(double)$xdata[$i]);
            }    
            //HIMEL]
            # The data for the chart
            $myPositiveCounter=0;
            $myNegativeCounter=0;
            $myEqualCounter=0;

            if($yclose<$xdata[0])
            {
                $myPositiveCounter=$vdata[0];
            }
            if($yclose>$xdata[0])
            {
                $myNegativeCounter=$vdata[0];
            }
            /* echo "<pre >";
            echo "xdata";
            print_r($xdata);
            echo "vdata";
            print_r($vdata);
            exit;
            */
            for($i=0;$i<count($vdata);$i++)
            {
                if($xdata[$i]>$xdata[$i-1])
                {

                    $myPositiveCounter+=$vdata[$i];
                    //echo $myPositiveCounter."myPositiveCounter[".$vdata[$i]."]".$xdata[$i-1].">".$xdata[$i]."<br />";
                }
                if ($xdata[$i]<$xdata[$i-1])
                {
                    $myNegativeCounter+=$vdata[$i];
                    //echo $myNegativeCounter."myNegativeCounter[".$vdata[$i]."]".$xdata[$i-1]."<=".$xdata[$i]."<br />";
                }
                if ($xdata[$i]==$xdata[$i-1]){
                    $myEqualCounter+=$vdata[$i];
                }
            }
            //exit;
            /*$this->set('xdata',$xdata);
            $this->set('vdata',$vdata);
            $this->set('labels',$ydata);  */
            //***$this->set('graph_title',"$code-$tradeDate  open: $dayopen  high : $dayhigh low : $daylow close: $dayclose Hawla : $totaltrade   Total Volume : $totalvolume ");
            //***$this->set('graph_subtitle',"Probable { Bull Vol: $myPositiveCounter($myPositivePer%) Neutral Vol: $myEqualCounter($myEqualPer%)  Bear Vol: $myNegativeCounter ($myNegativePer%) }");
            
            
            $data_['volume']=array_reverse($volume_array);
            $data_['price']=array_reverse($price_array);
            
            $data['data']= $data_;
            $data['company_name']= $code;
            $data['tradeDate']= $tradeDate;
            $data['dayopen']= $dayopen;
            $data['dayhigh']= $dayhigh;
            $data['daylow']= $daylow;
            $data['dayclose']= $dayclose;
            
            return $data;
            
            $this->set('company_name',$code);
            $this->set('tradeDate',$tradeDate);
            $this->set('dayopen',$dayopen);
            $this->set('dayhigh',$dayhigh);
            $this->set('daylow',$daylow);         
            $this->set('dayclose',$dayclose);
            
        }                            
        $this->set ( 'inv', $inv );
        $this->set ( 'inv1', $inv1 );
    }
}
?>