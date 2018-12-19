<?php
App::uses('AppController', 'Controller');

/**

 * Instruments Controller

 *

 */
class DashboardsController extends AppController

{

    //public $helpers = array( 'StockBangladesh');

    public function beforeFilter()

    {
        parent::beforeFilter();
        $this->Auth->allow('trade2');
        $this->Auth->allow('trade_test');
       // $this->Auth->allow();
    }

    public function home()
    {
      
        $this->layout='ajax';

    }
    public function trade()
    {

        //Configure::write('debug', 2);
        $brokerIdApex = Configure::read('broker.apex.id');
        $brokerIdHac = Configure::read('broker.hac.id');
        $brokerIdSharp = Configure::read('broker.sharp.id');

        $StockBangladesh = $this->Components->load('StockBangladesh');

        $instrumentList=$StockBangladesh->instrumentList(3);

//pr($StockBangladesh->instrumentList(3));

        if($this->Auth->user('portfolio_id')) {
            $pid = $this->Auth->user('portfolio_id');
            $broker_fee = $this->Auth->user('broker_fee');
            $broker_id = $this->Auth->user('broker_id');
            $loanCode = $this->Auth->user('loanCode');
        }


        //  $id=3;  // for development testing only

        $Portfolio = $this->Components->load('Portfolio');

        $allTransactions=$Portfolio->getAllTransactions($pid);
        // pr($allTransactions);
        $this->ttypeArr=$Portfolio->getTransactionType();
        $balance=$Portfolio->getPortfolioBalanceNew($allTransactions,$this->ttypeArr);
        $portfolioHoldingsTransaction=$Portfolio->getPortfolioHoldings2($allTransactions,$this->ttypeArr);
        //  pr($balance);
        // pr($portfolioHoldingsTransaction);
        //   exit;

        $Omo = $this->Components->load('Omo');
        $allOrdersInfo=array();
        $lastUsed=$Omo->getUsedBalance($allOrdersInfo,$broker_fee);
        $sellList=$Omo->createSellList($portfolioHoldingsTransaction,$instrumentList);
        $accepting_order=$Omo->checkAcceptOrder($broker_id);
        $circuit_breaker=$Omo->checkCircuitBreaker($broker_id);

        $permittedPortfolioArr=$this->Auth->user('portfolio_list');
        $permittedPortfolioArr=unserialize($permittedPortfolioArr);


        // portfolio manager list
        App::uses('User', 'Model');
        $User = new User();
        $userinfo=$this->Auth->user();
        if(!isset($userinfo['portfolio_manager_id'])) {
            $userinfo['portfolio_manager_id'] = $userinfo['id'];
            $userinfo['portfolio_manager_portfolio_list'] = $userinfo['portfolio_list'];
            $this->Auth->login($userinfo);
        }

        /* if(!isset($userinfo['portfolio_manager_portfolio_list'])) {
             $userinfo['portfolio_manager_portfolio_list'] = $userinfo['portfolio_list'];
             $this->Auth->login($userinfo);
         }*/

        $permittedPortfolioArr=$this->Auth->user('portfolio_manager_portfolio_list');
        $permittedPortfolioArr=unserialize($permittedPortfolioArr);
        $permittedPortfolioArr[$this->Auth->user('id')]=$this->Auth->user('id');
        $userListInfo = $User->find('all', array(
            'conditions' => array('User.id' => $permittedPortfolioArr),
            'recursive' => -1
        ));

        $introducedUserList = $User->find('all', array(
            'conditions' => array('User.introducer_id' => $pid),
            'recursive' => -1
        ));


        $circuitModel = ClassRegistry::init('CircuitBreaker');
        $circuitList=array();
        $circuitListData = $circuitModel->find('all');
        if(count($circuitListData))
        $circuitList = Hash::combine($circuitListData, '{n}.CircuitBreaker.company','{n}.CircuitBreaker');

        $this->set('userListInfo',$userListInfo);
        $this->set('introducedUserList',$introducedUserList);
        $this->set('instrumentList', $instrumentList);
        $this->set('portfolio_id', $this->Auth->user('portfolio_id'));
        $this->set('sellInstrumentList', $sellList);
        $this->set('accepting_order', $accepting_order);
        $this->set('circuit_breaker', $circuit_breaker);
        $this->set('circuitList', $circuitList);

        $this->set('balance',$balance);
        $this->set('lastUsed',$lastUsed);
        $this->set('broker_fee',$broker_fee);
        $this->set('broker_id',$broker_id);
        $this->set('brokerIdApex',$brokerIdApex);
        $this->set('brokerIdHac',$brokerIdHac);
        $this->set('brokerIdSharp',$brokerIdSharp);
        $this->set('loanCode',$loanCode);

        $this->set('pageTitleMain','Trading Dashboard');
        $this->set('pageTitleSmall','order form');
//exit;

    }

    public function trade_test()
    {

       //  Configure::write('debug', 2);
        $brokerIdApex = Configure::read('broker.apex.id');
        $brokerIdHac = Configure::read('broker.hac.id');
        $brokerIdSharp = Configure::read('broker.sharp.id');

        $StockBangladesh = $this->Components->load('StockBangladesh');

        $instrumentList=$StockBangladesh->instrumentList(3);

//pr($StockBangladesh->instrumentList(3));

        if($this->Auth->user('portfolio_id')) {
            $pid = $this->Auth->user('portfolio_id');
            $broker_fee = $this->Auth->user('broker_fee');
            $broker_id = $this->Auth->user('broker_id');
          //  $loanCode = $this->Auth->user('loanCode');
        }


        //  $id=3;  // for development testing only

        $Portfolio = $this->Components->load('Portfolio');

        $allTransactions=$Portfolio->getAllTransactions($pid);
        // pr($allTransactions);
        $this->ttypeArr=$Portfolio->getTransactionType();
        $balance=$Portfolio->getPortfolioBalanceNew($allTransactions,$this->ttypeArr);
        $portfolioHoldingsTransaction=$Portfolio->getPortfolioHoldings2($allTransactions,$this->ttypeArr);
        //  pr($balance);
        // pr($portfolioHoldingsTransaction);
        //   exit;

        $Omo = $this->Components->load('Omo');
        $allOrdersInfo=array();
        $lastUsed=$Omo->getUsedBalance($allOrdersInfo,$broker_fee);
        $sellList=$Omo->createSellList($portfolioHoldingsTransaction,$instrumentList);
        $accepting_order=$Omo->checkAcceptOrder($broker_id);
        $circuit_breaker=$Omo->checkCircuitBreaker($broker_id);

        $permittedPortfolioArr=$this->Auth->user('portfolio_list');
        $permittedPortfolioArr=unserialize($permittedPortfolioArr);


       // portfolio manager list
        App::uses('User', 'Model');
        $User = new User();
        $userinfo=$this->Auth->user();
        if(!isset($userinfo['portfolio_manager_id'])) {
            $userinfo['portfolio_manager_id'] = $userinfo['id'];
            $userinfo['portfolio_manager_portfolio_list'] = $userinfo['portfolio_list'];
            $this->Auth->login($userinfo);
        }

       /* if(!isset($userinfo['portfolio_manager_portfolio_list'])) {
            $userinfo['portfolio_manager_portfolio_list'] = $userinfo['portfolio_list'];
            $this->Auth->login($userinfo);
        }*/

        $permittedPortfolioArr=$this->Auth->user('portfolio_manager_portfolio_list');
        $permittedPortfolioArr=unserialize($permittedPortfolioArr);
        $permittedPortfolioArr[$this->Auth->user('id')]=$this->Auth->user('id');
        $userListInfo = $User->find('all', array(
            'conditions' => array('User.id' => $permittedPortfolioArr),
            'recursive' => -1
        ));


        $circuitModel = ClassRegistry::init('CircuitBreaker');
        $circuitList = $circuitModel->find('all');
        $circuitList = Hash::combine($circuitList, '{n}.CircuitBreaker.company','{n}.CircuitBreaker');

        $this->set('userListInfo',$userListInfo);
        $this->set('instrumentList', $instrumentList);
        $this->set('portfolio_id', $this->Auth->user('portfolio_id'));
        $this->set('sellInstrumentList', $sellList);
        $this->set('accepting_order', $accepting_order);
        $this->set('circuit_breaker', $circuit_breaker);
        $this->set('circuitList', $circuitList);

        $this->set('balance',$balance);
        $this->set('lastUsed',$lastUsed);
        $this->set('broker_fee',$broker_fee); ///////
        $this->set('broker_id',$broker_id);
        $this->set('brokerIdApex',$brokerIdApex);
        $this->set('brokerIdHac',$brokerIdHac);
        $this->set('brokerIdSharp',$brokerIdSharp);


        $this->set('pageTitleMain','Trading Dashboard');
        $this->set('pageTitleSmall','order form');
//exit;

    }
    public function trade2()
    {

        // Configure::write('debug', 2);
        $StockBangladesh = $this->Components->load('StockBangladesh');

        $instrumentList=$StockBangladesh->instrumentList(3);

//pr($StockBangladesh->instrumentList(3));

        if($this->Auth->user('portfolio_id')) {
            $pid = $this->Auth->user('portfolio_id');
            $broker_fee = $this->Auth->user('broker_fee');
            $broker_id = $this->Auth->user('broker_id');
        }

        //  $id=3;  // for development testing only

        $Portfolio = $this->Components->load('Portfolio');

        $allTransactions=$Portfolio->getAllTransactions($pid);
        // pr($allTransactions);
        $this->ttypeArr=$Portfolio->getTransactionType();
        $balance=$Portfolio->getPortfolioBalanceNew($allTransactions,$this->ttypeArr);
        $portfolioHoldingsTransaction=$Portfolio->getPortfolioHoldings2($allTransactions,$this->ttypeArr);
        //  pr($balance);
        // pr($portfolioHoldingsTransaction);
        //   exit;

        $Omo = $this->Components->load('Omo');
        $allOrdersInfo=array();
        $lastUsed=$Omo->getUsedBalance($allOrdersInfo,$broker_fee);
        $sellList=$Omo->createSellList($portfolioHoldingsTransaction,$instrumentList);
        $accepting_order=$Omo->checkAcceptOrder($broker_id);

        $permittedPortfolioArr=$this->Auth->user('portfolio_list');
        $permittedPortfolioArr=unserialize($permittedPortfolioArr);


       // portfolio manager list
        App::uses('User', 'Model');
        $User = new User();
        $userinfo=$this->Auth->user();
        if(!isset($userinfo['portfolio_manager_id'])) {
            $userinfo['portfolio_manager_id'] = $userinfo['id'];
            $userinfo['portfolio_manager_portfolio_list'] = $userinfo['portfolio_list'];
            $this->Auth->login($userinfo);
        }

       /* if(!isset($userinfo['portfolio_manager_portfolio_list'])) {
            $userinfo['portfolio_manager_portfolio_list'] = $userinfo['portfolio_list'];
            $this->Auth->login($userinfo);
        }*/

        $permittedPortfolioArr=$this->Auth->user('portfolio_manager_portfolio_list');
        $permittedPortfolioArr=unserialize($permittedPortfolioArr);
        $permittedPortfolioArr[$this->Auth->user('id')]=$this->Auth->user('id');
        $userListInfo = $User->find('all', array(
            'conditions' => array('User.id' => $permittedPortfolioArr),
            'recursive' => -1
        ));
        $this->set('userListInfo',$userListInfo);



        $this->set('instrumentList', $instrumentList);
        $this->set('portfolio_id', $this->Auth->user('portfolio_id'));
        $this->set('sellInstrumentList', $sellList);
        $this->set('accepting_order', $accepting_order);

        $this->set('balance',$balance);
        $this->set('lastUsed',$lastUsed);
        $this->set('broker_fee',$broker_fee);


        $this->set('pageTitleMain','');
        $this->set('pageTitleSmall','');
//exit;

    }

public function test()
{
    $this->layout='ajax';
}
public function test2()
{

}

    public function getPrice()
    {
        //Configure::write('debug', 2);
        require_once(APP . 'Vendor' . DS . 'simplehtmldom' . DS . 'simple_html_dom.php');
        $instrumentId=211;
        if(isset($_POST['instrumentId']))
            $instrumentId = $_POST['instrumentId'];

        //    Configure::write('debug', 2);
        $StockBangladesh = $this->Components->load('StockBangladesh');


        $instrumentList=$StockBangladesh->instrumentList(3);
        $code = $instrumentList[$instrumentId];

        $lastTwoMarketInfoArr = $StockBangladesh->getMarketInfo(0, 0);
        $marketId = $lastTwoMarketInfoArr[0]['Market']['id'];
        $lastTradeInfo = $StockBangladesh->getAllInsLtp($marketId);
        //array_values($lastTradeInfo['DataBanksIntraday'])[0]['lm_date_time']
        //pr(array_values($lastTradeInfo['DataBanksIntraday'])[0]['lm_date_time']);

        $tradeData=$lastTradeInfo[$instrumentId];

       // $tradeData=array_values($tradeData)[0];   // in live this line is creating problem
        foreach($tradeData as $row)
        {
            $tradeData=$row;
        }
       
        $quote_bases=$tradeData['quote_bases'];
        $categoryArr=explode('-',$quote_bases);
        $category=trim($categoryArr[0]);

        if($this->Auth->user('portfolio_id')) {
            $pid = $this->Auth->user('portfolio_id');

        }


        $Portfolio = $this->Components->load('Portfolio');

        $allTransactions=$Portfolio->getAllTransactions($pid);
        // pr($allTransactions);
        $this->ttypeArr=$Portfolio->getTransactionType();
        $balance=$Portfolio->getPortfolioBalanceNew($allTransactions,$this->ttypeArr);

        $getTextCse='';
        $getText='';
        /*
        $getText = $this->get_web_page('http://www.dsebd.org/bshis_new1_old.php?w=' . $code);
        $getText = preg_replace('/Please click on the button to refresh/', ' ', $getText);
        $getText = preg_replace('/<INPUT\b[^>]*>(.*?)[^>]/', ' ', $getText);
        $getText = preg_replace('/<META\b[^>]*>(.*?)[^>]/', ' ', $getText);


        $html = str_get_html($getText);
        $html->find('table',2)->class = 'table table-striped table-bordered table-advance table-hover';
        $getText= $html->find('table',2)->outertext;


        $getTextCse = $this->get_web_page('http://www.cse.com.bd/depth_show.php?w=' . $code);
        $getTextCse = preg_replace('/Please click on the button to refresh/', ' ', $getTextCse);
        $getTextCse = preg_replace('/<INPUT\b[^>]*>(.*?)[^>]/', ' ', $getTextCse);
        $getTextCse = preg_replace('/<META\b[^>]*>(.*?)[^>]/', ' ', $getTextCse);

        $html = str_get_html($getTextCse);
        $html->find('table',2)->class = 'table table-striped table-bordered table-advance table-hover';
        $getTextCse= $html->find('table',2)->outertext;*/



        $tradeData['balance']=$balance;
        $tradeData['category']=$category;
        $tradeData['market_depth']=$getText;
        $tradeData['market_depth_cse']=$getTextCse;
        $jsonresult = json_encode($tradeData);

        echo $jsonresult;
        //  pr($getLastTradeInfo);
        exit;
    }

    public function getDseMarketDepth($instrumentId=79)
    {
        $extract_enabled=1;
        if($extract_enabled) {
            require_once(APP . 'Vendor' . DS . 'simplehtmldom' . DS . 'simple_html_dom.php');
            if (isset($_POST['instrumentId']))
                $instrumentId = $_POST['instrumentId'];
            $StockBangladesh = $this->Components->load('StockBangladesh');


            $instrumentList = $StockBangladesh->instrumentList(3);
            $code = $instrumentList[$instrumentId];

            $getText = $this->get_web_page('http://www.dsebd.org/bshis_new1_old.php?w=' . $code);
            $getText = preg_replace('/Please click on the button to refresh/', ' ', $getText);
            $getText = preg_replace('/<INPUT\b[^>]*>(.*?)[^>]/', ' ', $getText);
            $getText = preg_replace('/<META\b[^>]*>(.*?)[^>]/', ' ', $getText);


            $html = str_get_html($getText);
            $html->find('table',2)->class = 'table table-striped table-bordered table-advance table-hover';
            $getText1= $html->find('table',2)->outertext;
            $getText2= $html->find('table',5)->outertext;
            $getText="$getText1$getText2";
        }else {
            $getText = null;
        }
echo $getText;
exit;
    }
    public function getCseMarketDepth($instrumentId=79)
    {
        $extract_enabled=1;
        if($extract_enabled) {
            require_once(APP . 'Vendor' . DS . 'simplehtmldom' . DS . 'simple_html_dom.php');
            if (isset($_POST['instrumentId']))
                $instrumentId = $_POST['instrumentId'];
            $StockBangladesh = $this->Components->load('StockBangladesh');


            $instrumentList = $StockBangladesh->instrumentList(3);
            $code = $instrumentList[$instrumentId];


            $getTextCse = $this->get_web_page_cse('http://www.cse.com.bd/depth_show.php?w=' . $code);
            $getTextCse = preg_replace('/Please click on the button to refresh/', ' ', $getTextCse);
            $getTextCse = preg_replace('/<INPUT\b[^>]*>(.*?)[^>]/', ' ', $getTextCse);
            $getTextCse = preg_replace('/<META\b[^>]*>(.*?)[^>]/', ' ', $getTextCse);

            $html = str_get_html($getTextCse);
            $html->find('table',2)->class = 'table table-striped table-bordered table-advance table-hover';

            $getTextCse1= $html->find('table',2)->outertext;
            $getTextCse2= $html->find('table',5)->outertext;
            $getTextCse="$getTextCse1$getTextCse2";
        }else {
            $getTextCse = null;
        }

echo $getTextCse;
exit;
    }

    public function getCseMarketDepth_dev($instrumentId=79)
    {
        $extract_enabled=1;
        if($extract_enabled) {
            Configure::write('debug', 2);
            require_once(APP . 'Vendor' . DS . 'simplehtmldom' . DS . 'simple_html_dom.php');
            if (isset($_POST['instrumentId']))
                $instrumentId = $_POST['instrumentId'];
            $StockBangladesh = $this->Components->load('StockBangladesh');


            $instrumentList = $StockBangladesh->instrumentList(3);
            $code = $instrumentList[$instrumentId];


            $getTextCse = $this->get_web_page_cse('http://www.cse.com.bd/depth_show.php?w=' . $code);
            //$getTextCse = $this->get_web_page('http://www.dsebd.org/bshis_new1_old.php?w=' . $code);
            $getTextCse = preg_replace('/Please click on the button to refresh/', ' ', $getTextCse);
            $getTextCse = preg_replace('/<INPUT\b[^>]*>(.*?)[^>]/', ' ', $getTextCse);
            $getTextCse = preg_replace('/<META\b[^>]*>(.*?)[^>]/', ' ', $getTextCse);
            pr($getTextCse);
            exit;
            $html = str_get_html($getTextCse);
            $html->find('table', 2)->class = 'table table-striped table-bordered table-advance table-hover';

            $getTextCse1 = $html->find('table', 2)->outertext;
            $getTextCse2 = $html->find('table', 5)->outertext;
            $getTextCse = "$getTextCse1$getTextCse2";
        }
        else
        {
            $getTextCse=null;
        }
        echo $getTextCse;
        exit;
    }



    public function getSellPrice()
    {
        require_once(APP . 'Vendor' . DS . 'simplehtmldom' . DS . 'simple_html_dom.php');
        $instrumentId=211;
        if(isset($_POST['instrumentId']))
            $instrumentId = $_POST['instrumentId'];

           // Configure::write('debug', 2);


        if($this->Auth->user('portfolio_id')) {
            $pid = $this->Auth->user('portfolio_id');
            $broker_fee = $this->Auth->user('broker_fee');
        }

        $StockBangladesh = $this->Components->load('StockBangladesh');


        $instrumentList=$StockBangladesh->instrumentList(3);
        $code = $instrumentList[$instrumentId];
        $getText='';
        $getTextCse='';
      /*  $getText = $this->get_web_page('http://www.dsebd.org/bshis_new1_old.php?w=' . $code);
        $getText = preg_replace('/Please click on the button to refresh/', ' ', $getText);
        $getText = preg_replace('/<INPUT\b[^>]*>(.*?)[^>]/', ' ', $getText);
        $getText = preg_replace('/<META\b[^>]*>(.*?)[^>]/', ' ', $getText);


        $html = str_get_html($getText);
        $html->find('table',2)->class = 'table table-striped table-bordered table-advance table-hover';
        $getText= $html->find('table',2)->outertext;


        $getTextCse = $this->get_web_page('http://www.cse.com.bd/depth_show.php?w=' . $code);
        $getTextCse = preg_replace('/Please click on the button to refresh/', ' ', $getTextCse);
        $getTextCse = preg_replace('/<INPUT\b[^>]*>(.*?)[^>]/', ' ', $getTextCse);
        $getTextCse = preg_replace('/<META\b[^>]*>(.*?)[^>]/', ' ', $getTextCse);

        $html = str_get_html($getTextCse);
        $html->find('table',2)->class = 'table table-striped table-bordered table-advance table-hover';
        $getTextCse= $html->find('table',2)->outertext;*/

        //  $id=3;  // for development testing only

        $Portfolio = $this->Components->load('Portfolio');

        $allTransactions=$Portfolio->getAllTransactions($pid);

        $this->ttypeArr=$Portfolio->getTransactionType();

        $portfolioHoldingsTransaction=$Portfolio->getPortfolioHoldings2($allTransactions,$this->ttypeArr);
//pr($portfolioHoldingsTransaction);
//        exit;

        $tradeData=$portfolioHoldingsTransaction[$instrumentId]['lastTradeInfo'];
        /* here we are extracting category fromquote bases ex. 'A-EQ'  to reduce further database query*/
        $quote_bases=$tradeData['quote_bases'];
        $categoryArr=explode('-',$quote_bases);
        $category=trim($categoryArr[0]);
        $tradeData['category']=$category;
        $tradeData['totalQuantity']=$portfolioHoldingsTransaction[$instrumentId]['totalQuantity'];
        $tradeData['avgCost']=$portfolioHoldingsTransaction[$instrumentId]['avgCost'];
        $tradeData['market_depth']=$getText;
        $tradeData['market_depth_cse']=$getTextCse;
        $Omo = $this->Components->load('Omo');

        $saleAbleShares=$Portfolio->calculateSaleableShares($portfolioHoldingsTransaction[$instrumentId]['transactions'],$category);
        $usedSaleableQty=$Portfolio->getUsedSaleAbleQuantity();
        $saleAbleShares=$saleAbleShares - $usedSaleableQty[$instrumentId];


        $tradeData['saleAbleShares']=$saleAbleShares;


        $jsonresult = json_encode($tradeData);

        echo $jsonresult;
        //  pr($getLastTradeInfo);
        exit;
    }

    function get_web_page($url)
    {
        $options = array(
            CURLOPT_RETURNTRANSFER => true, // return web page
            CURLOPT_HEADER => false, // don't return headers
            CURLOPT_FOLLOWLOCATION => true, // follow redirects
            CURLOPT_ENCODING => "", // handle all encodings
            CURLOPT_USERAGENT => "spider", // who am i
            CURLOPT_AUTOREFERER => true, // set referer on redirect
            CURLOPT_REFERER => "http://www.dsebd.org/mkt_depth_3.php", // set referer on redirect
            CURLOPT_CONNECTTIMEOUT => 5, // timeout on connect
            CURLOPT_TIMEOUT => 6, // timeout on response
            CURLOPT_MAXREDIRS => 10, // stop after 10 redirects
        );

        $ch = curl_init($url);
        curl_setopt_array($ch, $options);
        $content = curl_exec($ch);
        $err = curl_errno($ch);
        $errmsg = curl_error($ch);
        $header = curl_getinfo($ch);
        curl_close($ch);

        $header['errno'] = $err;
        $header['errmsg'] = $errmsg;
        $header['content'] = $content;
        return $content; //$header;
    }


    function get_web_page_cse($url)
    {
        $options = array(
            CURLOPT_RETURNTRANSFER => true, // return web page
            CURLOPT_HEADER => false, // don't return headers
            CURLOPT_FOLLOWLOCATION => true, // follow redirects
            CURLOPT_ENCODING => "", // handle all encodings
            CURLOPT_USERAGENT => "spider", // who am i
            CURLOPT_AUTOREFERER => true, // set referer on redirect
            CURLOPT_REFERER => "http://www.cse.com.bd/market_depth.php", // set referer on redirect
            CURLOPT_CONNECTTIMEOUT => 5, // timeout on connect
            CURLOPT_TIMEOUT => 6, // timeout on response
            CURLOPT_MAXREDIRS => 10, // stop after 10 redirects
        );

        $ch = curl_init($url);
        curl_setopt_array($ch, $options);
        $content = curl_exec($ch);
        $err = curl_errno($ch);
        $errmsg = curl_error($ch);
        $header = curl_getinfo($ch);
        curl_close($ch);

        $header['errno'] = $err;
        $header['errmsg'] = $errmsg;
        $header['content'] = $content;
        return $content; //$header;
    }







}



