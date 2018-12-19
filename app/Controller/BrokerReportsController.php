<?php
App::uses('AppController', 'Controller');
/**
 * Users Controller
 *
 * @property User $User
 */
class BrokerReportsController extends AppController
{

    //public $components = array('SignMeUp.SignMeUp');
    public $components = array('Paginator', 'DataTable', 'RequestHandler');

    public function beforeFilter()
    {
        parent::beforeFilter();

        $this->Auth->allow();



    }

    public function reportSummary()
    {

     //Configure::write('debug', 2);

        $bro_id=$this->Auth->user('broker_id');
        $brokerModel = ClassRegistry::init('Broker');

        $brokers = $brokerModel->find('all', array("conditions"=>array('Broker.id'=>$bro_id),'fields'=>array('broker_name','id'),'recursive' => -1) );

//pr($brokers);
       // exit;
        $this->set('brokers',$brokers);



    }


    function billingReport($paramData)
    {// Configure::write('debug', 2);
        $parameters=explode(',',$paramData);

        $brokerHouse =$parameters[2];
        $bro_id=$this->Auth->user('broker_id');

            if ($brokerHouse != $bro_id) {
                echo "This is not your house";
                exit;
            }


            $dateForm =$parameters[0];
            $s_date=explode(' ',$dateForm);
            $dateForm=$s_date[0];
            $dateForm="".$dateForm." 1:00:00";

            $dateTo = $parameters[1];
            $e_date=explode(' ',$dateTo);
            $dateTo=$e_date[0];
            $dateTo="".$dateTo." 23:59:00";


            $RawTradeinsModel = ClassRegistry::init('RawTradins');
            $transactions = $RawTradeinsModel->find('all', array("conditions"=>array("RawTradins.execute_time BETWEEN ? and ?" => array($dateForm, $dateTo),"RawTradins.broker_id"=>$bro_id),'order'=>array('RawTradins.substatus DESC'),'recursive' => -1) );

        $userModel = ClassRegistry::init('User');
        $apexOmoUsersHCode = $userModel->find('all', array("conditions"=>array("User.broker_id" =>$bro_id,"User.internal_ref_no Like" =>"%H%"),'fields'=>array('internal_ref_no','broker_id','broker_fee'),'order'=>array('User.internal_ref_no ASC'),'recursive' => -1) );


        $apexOmoUsersNonH = $userModel->find('all', array("conditions"=>array("User.broker_id" =>$bro_id,"User.internal_ref_no NOT Like" =>"%H%"),'fields'=>array('internal_ref_no','broker_id'),'recursive' => -1) );


        $broker_fee_hcode = Hash::combine($apexOmoUsersHCode, '{n}.User.internal_ref_no','{n}.User.broker_fee');

        $apexOmoUsersNonH = Hash::extract($apexOmoUsersNonH,'{n}.User.internal_ref_no');

        $transactionsArray=array();
        foreach($transactions as $transaction) {

                $tempExecuteDate=explode(' ',$transaction['RawTradins']['execute_time']);
                $executeDate=$tempExecuteDate[0];
              //  $executeTime=$tempExecuteDate[1];

                $keyString="".$transaction['RawTradins']['order_id']."_".$transaction['RawTradins']['execution_id']."_".$executeDate."";

                $transaction = Hash::insert($transaction['RawTradins'],'execute_date',$executeDate);
             //   $transaction = Hash::insert($transaction['RawTradins'],'execute_time',$executeTime);

                $transactionsArray[$keyString]=$transaction;

            }

        $filledTransactions=Hash::extract($transactionsArray, '{s}[substatus=Filled]');


        $filledTransactions = Hash::combine($filledTransactions,  array('%s:%s', '{n}.order_id', '{n}.execute_date'),'{n}.substatus');


        $partialFilledTransactions=Hash::extract($transactionsArray, '{s}[substatus=Partially filled]');
        $partialFilledTransactions = Hash::combine($partialFilledTransactions, array('%s:%s', '{n}.order_id', '{n}.execute_date'), '{n}.execute_qty');




            $date = Hash::extract($transactionsArray,'{s}.execute_date');
            $clientCode = Hash::extract($transactionsArray,'{s}.client_ac');



            $unicDate=array_unique($date);
            $unicDate = Hash::sort($unicDate,'{n}','asc');



            $unicClientCode=array_unique($clientCode);
            $unicClientCode = Hash::sort($unicClientCode,'{n}','asc');

        $totalTradeSummationforHcode=0;
        $totalTradeSummationforNonHcode=0;
        $totalCommissionSummationHcode=0;
        $totalCommissionSummationNonHcode=0;

            $commissionPercentForNonCode=0.0003;

        foreach($unicDate as $key=>$day)
            {
                $totalTradeforHcode=0;
                $totalTradeforNonHcode=0;
                $commissionForHcode=0;
                $partialExcQty=array();
                foreach($transactionsArray as $transaction)
                { $executedAmount=0;
                    $executedPrice=0;
                    $tradedate=$transaction['execute_date'];

                    if($day==$tradedate)
                    {
                        if(strpos($transaction['client_ac'], "H"))
                        {
                            $irn=$transaction['client_ac'];

                            $irn = ltrim($irn, '0');

                            if($transaction['substatus']=="Partially filled")
                            {
                                $orderId=$transaction['order_id'];
                                if(isset($filledTransactions[$orderId.":".$tradedate]))
                                {
                                    if(isset($partialExcQty[$orderId.":".$tradedate]))
                                    {
                                        $partialExcQty[$orderId.":".$tradedate]+=$transaction['execute_qty'];
                                    }
                                    else
                                    $partialExcQty[$orderId.":".$tradedate]=$transaction['execute_qty'];

                                    continue;
                                }
                                else
                                {

                                    $executedAmount=$transaction['execute_qty'];
                                    $executedPrice=$transaction['order_avg_price'];

                                }
                            }
                            elseif($transaction['substatus']=="Filled")
                            {
                                $orderId=$transaction['order_id'];
                                if(isset($partialFilledTransactions[$orderId.":".$tradedate]))
                                {
                                    if($partialExcQty[$orderId.":".$tradedate]==$transaction['order_qty'])
                                    {
                                        $executedAmount=$transaction['order_qty'];
                                        $executedPrice=$transaction['order_avg_price'];
                                    }
                                    else
                                    {
                                        $executedAmount=$transaction['execute_qty']+$partialExcQty[$orderId.":".$tradedate];
                                        $executedPrice=$transaction['order_avg_price'];

                                    }

                                }
                                else
                                {

                                    $executedAmount=$transaction['execute_qty'];    //['order_qty']
                                    $executedPrice=$transaction['order_avg_price'];

                                }

                            }

                            $clientTransaction=($executedAmount*$executedPrice);

                            if(isset($broker_fee_hcode[$irn]))
                            {
                                $comm=($clientTransaction*$broker_fee_hcode[$irn])/100;
                            }
                           else
                           {

                               $nonOmoUser[$irn] =$irn;
                               $comm=($clientTransaction*.5)/100;
                           }

                            $commissionForHcode+=$comm;

                            $totalTradeforHcode+=$clientTransaction;


                        }

                        else
                        {
                            if(in_array($transaction['client_ac'],$apexOmoUsersNonH, TRUE))
                            {


                                if($transaction['substatus']=="Partially filled")
                                {
                                    $orderId=$transaction['order_id'];
                                    if(isset($filledTransactions[$orderId.":".$tradedate]))
                                    {

                                        if(isset($partialExcQty[$orderId.":".$tradedate]))
                                        {
                                            $partialExcQty[$orderId.":".$tradedate]+=$transaction['execute_qty'];
                                        }
                                        else
                                            $partialExcQty[$orderId.":".$tradedate]=$transaction['execute_qty'];
                                        continue;
                                    }
                                    else
                                    {

                                        $executedAmount=$transaction['execute_qty'];
                                        $executedPrice=$transaction['order_avg_price'];

                                    }
                                }

                                elseif($transaction['substatus']=="Filled")
                                {
                                    $orderId=$transaction['order_id'];
                                    if(isset($partialFilledTransactions[$orderId.":".$tradedate]))
                                    {
                                        if($partialExcQty[$orderId.":".$tradedate]==$transaction['order_qty'])
                                        {
                                            $executedAmount=$transaction['order_qty'];
                                            $executedPrice=$transaction['order_avg_price'];
                                        }
                                        else
                                        {
                                            $executedAmount=$transaction['execute_qty']+$partialExcQty[$orderId.":".$tradedate];
                                            $executedPrice=$transaction['order_avg_price'];
                                        }

                                    }
                                    else
                                    {

                                        $executedAmount=$transaction['execute_qty'];    //['order_qty']
                                        $executedPrice=$transaction['order_avg_price'];

                                    }

                                }


                                $totalTradeforNonHcode+=($executedAmount*$executedPrice);
                            }

                        }


                    }

                }


                $commissionForNonHcode=($totalTradeforNonHcode*$commissionPercentForNonCode);

                $totalTradeSummationforHcode+=$totalTradeforHcode;
                $totalTradeSummationforNonHcode+=$totalTradeforNonHcode;

                $totalCommissionSummationHcode+=$commissionForHcode;
                $totalCommissionSummationNonHcode+=$commissionForNonHcode;

                $dataPerDay[$key]['date']=$day;
                $dataPerDay[$key]['tradeAmountHcode']=$totalTradeforHcode;
                $dataPerDay[$key]['tradeAmountNonHcode']=$totalTradeforNonHcode;
                $dataPerDay[$key]['commissionHcode']=$commissionForHcode;
                $dataPerDay[$key]['commissionNonHcode']=$commissionForNonHcode;


            }

            $dataTotalForDays['totalTradeSummationHcode']=$totalTradeSummationforHcode;
            $dataTotalForDays['totalTradeSummationNonHcode']=$totalTradeSummationforNonHcode;
            $dataTotalForDays['totalCommissionSummationHcode']=$totalCommissionSummationHcode;
            $dataTotalForDays['totalCommissionSummationNonHcode']=$totalCommissionSummationNonHcode;

            $this->set('dataPerDay',$dataPerDay);
            $this->set('dataTotalForDays',$dataTotalForDays);


            $totalTradeSummationClientHcode=0;
            $totalTradeSummationNonClientNonHcode=0;
            $totalCommissionSummationClientHcode=0;
            $totalCommissionSummationClientNonHcode=0;
            $partialExcQty=array();


        $clientDetailsDataNonHcode=array();
            foreach($unicClientCode as $key=>$client)
            {
                $totalTradeClientHcode=0;
                $totalTradeClientNonHcode=0;


                foreach($transactionsArray as $key1=>$transaction)
                {
                    $executedAmount=0;
                    $executedPrice=0;
                    $tempCode=$transaction['client_ac'];


                    if($client==$tempCode)
                    {
                        $tradedate=$transaction['execute_date'];
                        $tradetime=$transaction['execute_time'];

                        if(strpos($transaction['client_ac'], "H"))
                        {

                            if($transaction['substatus']=="Partially filled")
                            {
                                $orderId=$transaction['order_id'];
                                if(isset($filledTransactions[$orderId.":".$tradedate]))
                                {

                                    if(isset($partialExcQty[$orderId.":".$tradedate]))
                                    {
                                        $partialExcQty[$orderId.":".$tradedate]+=$transaction['execute_qty'];
                                    }
                                    else
                                        $partialExcQty[$orderId.":".$tradedate]=$transaction['execute_qty'];
                                    continue;
                                }
                                else
                                {

                                    $executedAmount=$transaction['execute_qty'];
                                    $executedPrice=$transaction['order_avg_price'];

                                }
                            }
                            elseif($transaction['substatus']=="Filled")
                            {
                                $orderId=$transaction['order_id'];
                                if(isset($partialFilledTransactions[$orderId.":".$tradedate]))
                                {
                                    if($partialExcQty[$orderId.":".$tradedate]==$transaction['order_qty'])
                                    {
                                        $executedAmount=$transaction['order_qty'];
                                        $executedPrice=$transaction['order_avg_price'];
                                    }
                                    else
                                    {
                                        $executedAmount=$transaction['execute_qty']+$partialExcQty[$orderId.":".$tradedate];
                                        $executedPrice=$transaction['order_avg_price'];
                                    }

                                }
                                else
                                {

                                    $executedAmount=$transaction['execute_qty'];    //['order_qty']
                                    $executedPrice=$transaction['order_avg_price'];

                                }

                            }


                            $clientDetailsDataHcode[$client][$key1]['code']=$transaction['client_ac'];
                            $clientDetailsDataHcode[$client][$key1]['date']=$tradedate;
                            $clientDetailsDataHcode[$client][$key1]['instrument']=$transaction['symbol'];
                            $clientDetailsDataHcode[$client][$key1]['trade_time']=$tradetime;
                            $clientDetailsDataHcode[$client][$key1]['trade_type']=$transaction['side'];
                            $clientDetailsDataHcode[$client][$key1]['price']=$transaction['order_avg_price'];
                            $clientDetailsDataHcode[$client][$key1]['quantity']=$executedAmount;
                            $clientDetailsDataHcode[$client][$key1]['order_ref_no']=$transaction['order_id'];
                            $clientDetailsDataHcode[$client][$key1]['total_trade']=$transaction['order_avg_price']*$transaction['execute_qty'];

                            $irn=$transaction['client_ac'];
                            $irn = ltrim($irn, '0');


                            if(isset($broker_fee_hcode[$irn]))
                            {
                                $commissionPer=$broker_fee_hcode[$irn]/100;


                            }
                            else
                            {

                                $nonOmoUser[$irn] =$irn;
                                $commissionPer=0.5/100;

                            }


                          $totalTradeClientHcode+=($executedAmount*$executedPrice);

                        }

                        else
                        {

                            if(in_array($transaction['client_ac'],$apexOmoUsersNonH, TRUE))
                            {



                                if($transaction['substatus']=="Partially filled")
                                {
                                    $orderId=$transaction['order_id'];
                                    if(isset($filledTransactions[$orderId.":".$tradedate]))
                                    {
                                        if(isset($partialExcQty[$orderId.":".$tradedate]))
                                        {
                                            $partialExcQty[$orderId.":".$tradedate]+=$transaction['execute_qty'];
                                        }
                                        else
                                            $partialExcQty[$orderId.":".$tradedate]=$transaction['execute_qty'];
                                        continue;
                                    }
                                    else
                                    {

                                        $executedAmount=$transaction['execute_qty'];
                                        $executedPrice=$transaction['order_avg_price'];

                                    }
                                }
                                elseif($transaction['substatus']=="Filled")
                                {
                                    $orderId=$transaction['order_id'];
                                    if(isset($partialFilledTransactions[$orderId.":".$tradedate]))
                                    {
                                        if($partialExcQty[$orderId.":".$tradedate]==$transaction['order_qty'])
                                        {
                                            $executedAmount=$transaction['order_qty'];
                                            $executedPrice=$transaction['order_avg_price'];
                                        }
                                        else
                                        {
                                            $executedAmount=$transaction['execute_qty']+$partialExcQty[$orderId.":".$tradedate];
                                            $executedPrice=$transaction['order_avg_price'];
                                        }

                                    }
                                    else
                                    {

                                        $executedAmount=$transaction['execute_qty'];    //['order_qty']
                                        $executedPrice=$transaction['order_avg_price'];

                                    }

                                }


                                $clientDetailsDataNonHcode[$client][$key1]['code'] = $transaction['client_ac'];
                                $clientDetailsDatNonaHcode[$client][$key1]['date'] =$tradedate;
                                $clientDetailsDataNonHcode[$client][$key1]['instrument'] = $transaction['symbol'];
                                $clientDetailsDataNonHcode[$client][$key1]['trade_time'] = $tradetime;
                                $clientDetailsDataNonHcode[$client][$key1]['trade_type'] = $transaction['side'];
                                $clientDetailsDataNonHcode[$client][$key1]['price'] = $transaction['order_avg_price'];
                                $clientDetailsDataNonHcode[$client][$key1]['quantity'] = $executedAmount;
                                $clientDetailsDataNonHcode[$client][$key1]['order_ref_no'] = $transaction['order_id'];
                                $clientDetailsDataNonHcode[$client][$key1]['total_trade'] = $transaction['order_avg_price'] * $transaction['execute_qty'];


                                $totalTradeClientNonHcode += ($executedAmount* $executedPrice);


                            }

                        }


                    }

                }


                $commissionHcode=($totalTradeClientHcode*$commissionPer);
                $commissionNonHcode=($totalTradeClientNonHcode*$commissionPercentForNonCode);

                $totalTradeSummationClientHcode+=$totalTradeClientHcode;
                $totalTradeSummationNonClientNonHcode+=$totalTradeClientNonHcode;


                $totalCommissionSummationClientHcode+=$commissionHcode;
                $totalCommissionSummationClientNonHcode+=$commissionNonHcode;

                if(strpos($client, "H"))
                {
                    $dataPerHClient[$key]['client']=$client;
                    $dataPerHClient[$key]['tradeAmountHcode']=$totalTradeClientHcode;
                    $dataPerHClient[$key]['commissionHcode']=$commissionHcode;
                    $dataPerHClient[$key]['commissionPer']=$commissionPer;
                }
               else
               {
                   if(in_array($client,$apexOmoUsersNonH, TRUE))
                   {
                       $dataPerNonHClient[$key]['client'] = $client;
                       $dataPerNonHClient[$key]['tradeAmountNonHcode'] = $totalTradeClientNonHcode;
                       $dataPerNonHClient[$key]['commissionNonHcode'] = $commissionNonHcode;
                       $dataPerNonHClient[$key]['commissionPerNonH'] = $commissionPercentForNonCode;

                   }

               }


            }

            $dataTotalForClient['totalTradeSummationHcode']=$totalTradeSummationClientHcode;
            $dataTotalForClient['totalTradeSummationNonHcode']=$totalTradeSummationNonClientNonHcode;
            $dataTotalForClient['totalCommissionSummationHcode']=$totalCommissionSummationClientHcode;
            $dataTotalForClient['totalCommissionSummationNonHcode']=$totalCommissionSummationClientNonHcode;




            $this->set('dataPerHClient',$dataPerHClient);
            $this->set('dataPerNonHClient',$dataPerNonHClient);
            $this->set('dataTotalForClient',$dataTotalForClient);
            $this->set('clientDetailsData',$clientDetailsDataHcode);
            $this->set('clientDetailsDataNonHClient',$clientDetailsDataNonHcode);
            $this->set('nonOmoUser',$nonOmoUser);



    }

    function  dateWiseTradeVolumeHcode($dataPerDay,$dataTotalForDays)
    {

    }


        function runTradeInsForRaw()
    {
        Configure::write('debug', 2);
      //  $tradeins_file_path = Configure::read('broker.apex.tradeins_file_path');
      //  $fileArr = $StockBangladesh->scan_dir($tradeins_file_path);
      //  $today = date('Y-m-d');



        /* FOR UPDATE BACKDATED TRADEINS
     1. UNCOMMENTS FOLLOWING LINE ($fileArr[0] and  $today)
     2. CHANGE FILE NAME ACCORDING TO DESIRED DATE HERE
     4. set  $today to desired date (2015-02-09 format);

     IMPORTANT NOTE: IF  BACKDATED FILE MODIFIED, DATE CHANGED AND IT BECOMES LATEST. REGULAR TRADEINS RUNNING WILL TAKE THAT BACKDATED FILE.
     SO CONFIRM THAT LATEST FILE RE UPLOADED.
     */

        //  $fileArr[0]='10-02-2015.xlsx';
         // $today = "2015-02-10";


      //  $filename_dateArr=explode('.',$fileArr[0]);
      //  $reportDate = date('Y-m-d',strtotime($filename_dateArr[0]));


     /*   if ($reportDate == '1970-01-01') {
            echo $fileArr[0];
            echo "<br/><br/>Correct date is not found in file name<br /> please write appropriate date in tradins file name <br/><h3> Example: 2015-02-17.xlsx or 02-17-2015.xlsx</h3>";//info@stockbangladesh.com
            CakeEmail::deliver('info@stockbangladesh.com', 'Trade Ins of Sharp has some problems', 'Date string can not be found', array('from' => 'omo@stockbangladesh.net'));
            exit;
        }

        if ($reportDate != $today) {
            echo $fileArr[0];
            echo "<br/>This is not today's file.<br/>";
            exit;
        }
*/


        $fullFilePath = "apex/RawtradeIns/10-02-2015.csv";
        $Omo = $this->Components->load('Omo');
        $userList = $Omo->getUsersList(4, 1);


        $brokerUsers = array();
        foreach ($userList[6] as $irn => $arr) {
            $key = trim($irn);
            $key = str_pad($key, 5, "0", STR_PAD_LEFT);
            $key = strtoupper($key);
            $brokerUsers[$key] = $arr;
        }


        //  pr($fullFilePath);

        $tradeArr = array();
        $xldata = $Omo->xlsToArray($fullFilePath, 8);

        unset($xldata[0]);



        $dataToSaveForRaw = array();
        $reportDate = '';

/*
 *
 * [1] => Array
        (

        )
 */
        foreach ($xldata as $row) {

            $tempForRaw = array();


            $transaction_time = trim($row[8]);


            //  pr($transaction_time);
            $transaction_time = PHPExcel_Style_NumberFormat::toFormattedString($transaction_time, 'hh:mm:ss');
            $b = explode(' ', $transaction_time);
            $a = explode('-', $b[0]);
            $transaction_time = $a[2] . '-' . $a[0] . '-' . $a[1];
            $transaction_time = "" . $transaction_time . " " . $b[1] . "";
            //  pr($transaction_time);

            //  $reportDate2 = date('Y/m/d',strtotime($filename_dateArr[0]));
            //$transaction_time="$reportDate2 $transaction_time";

            // pr($transaction_time);
            $transaction_time = date("Y-m-d H:i:s", strtotime($transaction_time));
            //    pr($transaction_time);


            $rate = trim($row[7]);
            $rate = (float)str_replace(',', '', $rate);


//pr($transaction_time);
            //       exit;
            $rate = (float)str_replace(',', '', $rate);
            $tempForRaw['client_ac'] = trim($row[0]);
            $tempForRaw['symbol'] = trim($row[1]);
            $tempForRaw['side'] = trim($row[2]);
            $tempForRaw['order_qty'] = trim($row[3]);
            $tempForRaw['order_limit_price'] = trim($row[4]);
            $tempForRaw['substatus'] = trim($row[5]);
            $tempForRaw['execute_qty'] = trim($row[6]);
            $tempForRaw['execute_price'] = $rate;
            $tempForRaw['execute_time'] = $transaction_time;
            $tempForRaw['execute_stat'] = trim($row[9]);
            $tempForRaw['order_avg_price'] = trim($row[10]);
            $tempForRaw['ac_cds'] = trim($row[11]);
            //  $tempForRaw['counter_trader_id'] = trim($row[13]);
            $tempForRaw['execute_type'] = trim($row[12]);
            $tempForRaw['execution_id'] = trim($row[13]);
            $tempForRaw['order_id'] = trim($row[14]);
            $tempForRaw['broker_id'] = 11;
            if ($rate) {

                $dataToSaveForRaw[] = $tempForRaw;
            }
        }



            $rawmodel = ClassRegistry::init('RawTradin');
            if (count($dataToSaveForRaw)) {

                $rawmodel->saveMany($dataToSaveForRaw, array('atomic' => true));
                pr(count($dataToSaveForRaw) . "row inserted");
            }




exit;


    }


    function deleteApex()
    {   Configure::write('debug', 2);
        $rawModel = ClassRegistry::init('RawTradin');
      //  $PortfolioTransaction = ClassRegistry::init('PortfolioTransaction');

      //  $users = $UserModel->find('all', array("conditions"=>array("User.broker_id " => 6),'recursive' => -1) );
       // $user_id = Hash::extract($users,'{n}.User.portfolio_id');
       // $apexOmoUsersHCode = $userModel->find('all', array("conditions"=>array("User.broker_id" =>$bro_id,"User.internal_ref_no Like" =>"%H%"),'fields'=>array('internal_ref_no','broker_id','broker_fee'),'order'=>array('User.internal_ref_no ASC'),'recursive' => -1) );

      if($rawModel->deleteAll(array('RawTradin.execute_time Like' => "%2015-02-08%",'RawTradin.broker_id' => "11")))
      {
          pr("delete successfull");
      }
//pr($user_id);
        exit;

    }

    function compareArray()
    {   Configure::write('debug', 2);
      $array1= array
    (
            'client_id' => 'Client A/C',
            'instrument_code' => 'Name',
            'order_type' => 'Side',
            'order_qty' => 'SentQty',
            'avg_price' => 'Limit',
            'exec_per' => 'Exec%',
            'executed_qty' => 'ExecQty',
            'exec_Val' => 'ExecVal',
            'status' => 'Status',
            'sub_status' => 'SubStatus',
            'remaining_qty' => 'RemQty',
            'created' => 'Date/Time',
            'order_id' => 'OrderID'
        );

        $array2= array
        (
            'client_id' => 'Client A/C',
            'instrument_code' => 'Name',
            'order_type' => 'Side',
            'order_qty' => 'SentQty',
            'avg_price' => 'Limit',
            'exec_per' => 'Exec%',
            'executed_qty' => 'ExecQty',
            'exec_Val' => 'ExecVal',
            'status' => 'Status',

            'remaining_qty' => 'RemQty',
            'created' => 'Date/Time',
            'order_id' => 'OrderID',
            'sub_status' => 'SubStatus'
        );
        $arraysAreEqual = ($array1 == $array2);
        pr($arraysAreEqual);// TRUE if $a and $b have the same key/value pairs.
        $arraysAreEqual = ($array1 === $array2);
        pr($arraysAreEqual);
exit;
    }

    function updateIntroducer()
    {   Configure::write('debug', 2);
        $UserModel = ClassRegistry::init('User');


        $fullFilePath = "files/introduced.xlsx";
        $Omo = $this->Components->load('Omo');
       // $userList = $Omo->getUsersList(4, 1);


       //

        //  pr($fullFilePath);

        $tradeArr = array();
        $xldata = $Omo->xlsToArray($fullFilePath, 8);

       // pr($xldata);
       // exit;

        unset($xldata[1]);

        foreach($xldata as $key=>$rawData)
        {

            $introducer=$rawData[0];
            $temp=explode(':',$rawData[1]);
            $introduced=$temp[0];

        //   $introduced_id = $UserModel->find('all', array("conditions"=>array("User.internal_ref_no" =>$introduced),'fields'=>array('id'),'recursive' => -1) );

            $introducer_port_id = $UserModel->find('all', array("conditions"=>array("User.internal_ref_no" =>$introducer),'fields'=>array('portfolio_id'),'recursive' => -1) );

        //    $this->$UserModel->saveAll($data));


        //   pr($introduced);
           // $savedata['id']=$introduced_id[0]['User']['id'];
         //  $savedata['introducer_id']=$introducer_port_id[0]['User']['portfolio_id'] ;
         //  pr($savedata);

       /*    if($this->$UserModel->saveMany($savedata))
           {
              // $introducer_id = $UserModel->find('all', array("conditions"=>array("User.id" => $savedata['id']),'fields'=>array('introducer_id'),'recursive' => -1) );
             //  pr($introducer_id[0]['User']['introducer_id']);
               echo 'successful';
           }*/

         $UserModel->updateAll(
                array('User.introducer_id' => $introducer_port_id[0]['User']['portfolio_id']),
                array('User.internal_ref_no' => $introduced)
            );


        }


        exit;

    }

    function introducerAgentReport($data)
    {
        configure::write('debug', 2);

        $parameters = explode(',', $data);
        $broker_id = $parameters[2];
        $bro_id = $this->Auth->user('broker_id');

        if ($broker_id != $bro_id) {
            echo "This is not your house";
            exit;
        }

        $dateForm = $parameters[0];
        $s_date = explode(' ', $dateForm);
        $dateForm = $s_date[0];
        $dateForm = "" . $dateForm . " 1:00:00";

        $dateTo = $parameters[1];
        $e_date = explode(' ', $dateTo);
        $dateTo = $e_date[0];
        $dateTo = "" . $dateTo . " 23:59:00";


        $introducercommission = 0.0005;


        $UserModel = ClassRegistry::init('User');
        $RawTradeinsModel = ClassRegistry::init('RawTradins');

        $introducedUsers = $UserModel->find('all', array("conditions" => array("User.introducer_id !=" => 0, "User.broker_id" => $bro_id), 'recursive' => -1));

        $introducer_id = Hash::extract($introducedUsers, '{n}.User.introducer_id');
        $uniqIntroducer = array_unique($introducer_id);

        //$this->set('introducedUsers', $introducedUsers);
        // $introducedUsers=sort($introducedUsers);

  /* foreach($introducedUsers as $key=>$introduced)
         {

             $IntroducerInformation = $UserModel->find('all', array("conditions"=>array("User.portfolio_id" =>$introduced['User']['introducer_id']),'fields'=>array('internal_ref_no','first_name'),'recursive' => -1) );

             $introducedList[$key]['introducer']=$IntroducerInformation[0]['User']['internal_ref_no'];
             $introducedList[$key]['introduced_irn']=$introduced['User']['internal_ref_no'];
             $introducedList[$key]['introduced_broker_fee']=$introduced['User']['broker_fee'];

         }
 */



        $c=0;
        $totalMonthlyBuy = 0;
        $totalMonthlyBuyCommission = 0;
        $totalMonthlySell = 0;
        $totalMonthlySellCommission = 0;
        $totalMonthlyEarnedCommission = 0;

        foreach ($uniqIntroducer as $introducerKey => $introducer)
        {

            $totalBuyAmount = 0;
            $totalSellAmount = 0;

            $IntroducerInformation = $UserModel->find('all', array("conditions" => array("User.portfolio_id" => $introducer), 'fields' => array('internal_ref_no', 'first_name'), 'recursive' => -1));

            $introducedUsersByIntroducer = $UserModel->find('all', array("conditions" => array("User.introducer_id" => $introducer, "User.broker_fee" => 0.5), 'recursive' => -1));


            $introducedList[$IntroducerInformation[0]['User']['internal_ref_no']] = $introducedUsersByIntroducer;



            //  $output = Set::classicExtract($introducedUsersByIntroducer, '{n}.{index[1-2]}');
            $internal_ref_no = Hash::extract($introducedUsersByIntroducer, '{n}.User.internal_ref_no');
            // pr( $RawTradeinsModel->find('all', array("conditions"=>array("RawTradins.execute_time BETWEEN ? and ?" => array($dateForm, $dateTo),"RawTradins.client_ac LIKE"=>"%$internal_ref_no%"),'recursive' => -1) ));


           // pr($internal_ref_no );
            foreach ($internal_ref_no as $key1 => $irn)
            {
                if (strlen($irn) < 5)
                {
                    $diff = 5 - strlen($irn);

                    for ($i = 1; $i <= $diff; $i++)
                    {

                        $irn = '0' . $irn . '';

                    }

                    $internal_ref_no[$key1] = $irn;

                }

            }
           // pr($internal_ref_no );

            $Transactions=array();
            $TransactionsArray=array();

            $Transactions = $RawTradeinsModel->find('all', array("conditions" => array("RawTradins.execute_time BETWEEN ? and ?" => array($dateForm, $dateTo), 'RawTradins.client_ac' => $internal_ref_no), 'recursive' => -1));
            // $IntroducerInfo = $UserModel->find('all', array("conditions"=>array("User.portfolio_id" =>$introducer),'fields'=>array('internal_ref_no','first_name'),'recursive' => -1) );



            foreach ($Transactions as $Transaction) {

                $keyString1 = "" . $Transaction['RawTradins']['order_id'] . "_" . $Transaction['RawTradins']['execution_id'] . "";

                $TransactionsArray[$keyString1] = $Transaction;

            }


            foreach ($TransactionsArray as $TransactionArr) {

                if ($TransactionArr['RawTradins']['side'] == "Buy") {
                    $totalBuyAmount += ($TransactionArr['RawTradins']['execute_qty'] * $TransactionArr['RawTradins']['order_avg_price']);
                }

                if ($TransactionArr['RawTradins']['side'] == "Sell") {
                    $totalSellAmount += ($TransactionArr['RawTradins']['execute_qty'] * $TransactionArr['RawTradins']['order_avg_price']);
                }


            }


            $totalBuyCommission = ($totalBuyAmount * $introducercommission);

            $totalSellCommission = ($totalSellAmount * $introducercommission);


            $totalCommission = $totalBuyCommission + $totalSellCommission;

            $totalAmountforIntroducer[$introducerKey]['buy'] = $totalBuyAmount;
            $totalAmountforIntroducer[$introducerKey]['sell'] = $totalSellAmount;
            $totalAmountforIntroducer[$introducerKey]['buyCommission'] = $totalBuyCommission;
            $totalAmountforIntroducer[$introducerKey]['sellCommission'] = $totalSellCommission;
            $totalAmountforIntroducer[$introducerKey]['totalCommission'] = $totalCommission;
            $totalAmountforIntroducer[$introducerKey]['IntroducerInfo'] = $IntroducerInformation;

            $introducedlist[$introducer]['introduced'] = $introducedUsersByIntroducer;


            $totalMonthlyBuy += $totalBuyAmount;
            $totalMonthlyBuyCommission += $totalSellAmount;
            $totalMonthlySell += $totalBuyCommission;
            $totalMonthlySellCommission += $totalSellCommission;
            $totalMonthlyEarnedCommission += $totalCommission;



        }



        $this->set('totalAmountforIntroducer',$totalAmountforIntroducer);
        $this->set('totalMonthlyBuy',$totalMonthlyBuy);
        $this->set('totalMonthlyBuyCommission',$totalMonthlyBuyCommission);
        $this->set('totalMonthlySell',$totalMonthlySell);
        $this->set('totalMonthlySellCommission',$totalMonthlySellCommission);
        $this->set('totalMonthlyEarnedCommission',$totalMonthlyEarnedCommission);
        $this->set('introducedList',$introducedList);




    }


    function billingReportHac($paramData)
    { Configure::write('debug', 2);
        $parameters=explode(',',$paramData);

        $brokerHouse =$parameters[2];
        $bro_id=$this->Auth->user('broker_id');

        if ($brokerHouse != $bro_id) {
            echo "This is not your house";
            exit;
        }


        $dateForm =$parameters[0];
        $s_date=explode(' ',$dateForm);
        $dateForm=$s_date[0];
        $dateForm="".$dateForm." 1:00:00";

        $dateTo = $parameters[1];
        $e_date=explode(' ',$dateTo);
        $dateTo=$e_date[0];
        $dateTo="".$dateTo." 23:59:00";



        // $billName=$_POST['billName'];

        $RawTradeinsModel = ClassRegistry::init('RawTradins');
        $transactions = $RawTradeinsModel->find('all', array("conditions"=>array("RawTradins.execute_time BETWEEN ? and ?" => array($dateForm, $dateTo),"RawTradins.broker_id"=>$bro_id),'order'=>array('RawTradins.execute_time ASC'),'recursive' => -1) );




        $userModel = ClassRegistry::init('User');
        $hacOmoUsersHCode = $userModel->find('all', array("conditions"=>array("User.broker_id" =>$bro_id,"User.internal_ref_no BETWEEN ? and ?" =>array(70000,90000)),'fields'=>array('internal_ref_no','broker_id','broker_fee'),'order'=>array('User.internal_ref_no ASC'),'recursive' => -1) );


        $hacOmoUsersNonH = $userModel->find('all', array("conditions"=>array("User.broker_id" =>$bro_id,"User.internal_ref_no NOT BETWEEN ? and ?" =>array(70000,90000)),'fields'=>array('internal_ref_no','broker_id'),'recursive' => -1) );

      //  pr($transactions);
      //  pr($hacOmoUsersNonH);
      //  exit;
        //str_pad($irn, 5, "0", STR_PAD_LEFT);

        $broker_fee_hcode = Hash::combine($hacOmoUsersHCode, '{n}.User.internal_ref_no','{n}.User.broker_fee');
        // pr($broker_fee_hcode);

        $hacOmoUsersNonH = Hash::extract($hacOmoUsersNonH,'{n}.User.internal_ref_no');

        $transactionsArray=array();
        foreach($transactions as $transaction) {

            $keyString="".$transaction['RawTradins']['order_id']."_".$transaction['RawTradins']['execution_id']."";

            $transactionsArray[$keyString]=$transaction;

        }


        $date = Hash::extract($transactionsArray,'{s}.RawTradins.execute_time');
        // $dateForWithoutHcode = Hash::extract($transactionsArrayforWithoutHcode,'{s}.RawTradins.execute_time');

        $clientCode = Hash::extract($transactionsArray,'{s}.RawTradins.client_ac');
        // $clientCodeForWithoutHcode = Hash::extract($transactionsArrayforWithoutHcode,'{s}.RawTradins.client_ac');


        foreach($date as $key=>$dateString)
        {
            $temp=explode(' ',$dateString);
            $onlyDate[$key]=$temp[0];
        }

        $unicDate=array_unique($onlyDate);

        $unicClientCode=array_unique($clientCode);




        $totalTradeSummationforHcode=0;
        $totalTradeSummationforNonHcode=0;
        $totalCommissionSummationHcode=0;
        $totalCommissionSummationNonHcode=0;

        // $commissionPercentForCode=0.005;
        $commissionPercentForNonCode=0.0003;
        // $commissionPerClient=0.5;


        foreach($unicDate as $key=>$day)
        {
            $totalTradeforHcode=0;
            $totalTradeforNonHcode=0;
            $commissionForHcode=0;
            foreach($transactionsArray as $transaction)
            {
                $tempdate=explode(' ',$transaction['RawTradins']['execute_time']);
                $tradedate=$tempdate[0];

                if($day==$tradedate)
                {
                    if((70000 <= $transaction['RawTradins']['client_ac']) && ($transaction['RawTradins']['client_ac'] <= 80000))
                    {
                        $irn=$transaction['RawTradins']['client_ac'];

                        // pr($irn);
                        $irn = ltrim($irn, '0');
                        // pr($irn);
                        $clientTransaction=($transaction['RawTradins']['execute_qty']*$transaction['RawTradins']['order_avg_price']);

                        if(isset($broker_fee_hcode[$irn]))
                        {
                            $comm=($clientTransaction*$broker_fee_hcode[$irn])/100;
                        }
                        else
                        {

                            //echo "$irn not Use OMO.Default broker fee (0.5%)";
                            $nonOmoUser[$irn] =$irn;
                            $comm=($clientTransaction*.5)/100;
                        }
                        // pr($broker_fee_hcode[$irn]);

                        $commissionForHcode+=$comm;

                        $totalTradeforHcode+=$clientTransaction;
                        // $totalTradeforHcode+=($transaction['RawTradins']['execute_qty']*$transaction['RawTradins']['order_avg_price']);


                    }

                    else
                    {
                        if(in_array($transaction['RawTradins']['client_ac'],$hacOmoUsersNonH, TRUE))
                        {

                            $totalTradeforNonHcode+=($transaction['RawTradins']['execute_qty']*$transaction['RawTradins']['order_avg_price']);
                        }

                    }

//pr($transaction['RawTradins']['client_ac']);
                }

            }


            // $commissionForHcode=($totalTradeforHcode*$commissionPercentForCode);
            $commissionForNonHcode=($totalTradeforNonHcode*$commissionPercentForNonCode);

           // $totalTradeSummationforHcode+=$totalTradeforHcode;
            $totalTradeSummationforNonHcode+=$totalTradeforNonHcode;

            //$totalCommissionSummationHcode+=$commissionForHcode;
            $totalCommissionSummationNonHcode+=$commissionForNonHcode;

            $dataPerDay[$key]['date']=$day;
           // $dataPerDay[$key]['tradeAmountHcode']=$totalTradeforHcode;
            $dataPerDay[$key]['tradeAmountNonHcode']=$totalTradeforNonHcode;
           // $dataPerDay[$key]['commissionHcode']=$commissionForHcode;
            $dataPerDay[$key]['commissionNonHcode']=$commissionForNonHcode;


        }

       // $dataTotalForDays['totalTradeSummationHcode']=$totalTradeSummationforHcode;
        $dataTotalForDays['totalTradeSummationNonHcode']=$totalTradeSummationforNonHcode;
       // $dataTotalForDays['totalCommissionSummationHcode']=$totalCommissionSummationHcode;
        $dataTotalForDays['totalCommissionSummationNonHcode']=$totalCommissionSummationNonHcode;



        $this->set('dataPerDay',$dataPerDay);
        $this->set('dataTotalForDays',$dataTotalForDays);


        $totalTradeSummationClientHcode=0;
        $totalTradeSummationNonClientNonHcode=0;
        $totalCommissionSummationClientHcode=0;
        $totalCommissionSummationClientNonHcode=0;
        //$commissionHcode=0;

        $commissionPer=0;

        foreach($unicClientCode as $key=>$client)
        {
            $totalTradeClientHcode=0;
            $totalTradeClientNonHcode=0;


            //$clientDetailsDataHcode[$client][$key1]['total_trade_sum']=0;
            //$clientDetailsDataNonHcode[$client][$key1]['total_trade_sum']=0;
            foreach($transactionsArray as $key1=>$transaction)
            {
                $tempCode=$transaction['RawTradins']['client_ac'];


                if($client==$tempCode)
                {
                    $tempdate=explode(' ',$transaction['RawTradins']['execute_time']);

                    $tradedate=$tempdate[0];
                    $tradetime=$tempdate[1];

                    if((70000 <= $transaction['RawTradins']['client_ac']) && ($transaction['RawTradins']['client_ac'] <= 90000))
                    {
                        /*
                        $clientDetailsDataHcode[$client][$key1]['code']=$transaction['RawTradins']['client_ac'];
                        $clientDetailsDataHcode[$client][$key1]['date']=$tradedate;
                        $clientDetailsDataHcode[$client][$key1]['instrument']=$transaction['RawTradins']['symbol'];
                        $clientDetailsDataHcode[$client][$key1]['trade_time']=$tradetime;
                        $clientDetailsDataHcode[$client][$key1]['trade_type']=$transaction['RawTradins']['side'];
                        $clientDetailsDataHcode[$client][$key1]['price']=$transaction['RawTradins']['order_avg_price'];
                        $clientDetailsDataHcode[$client][$key1]['quantity']=$transaction['RawTradins']['execute_qty'];
                        $clientDetailsDataHcode[$client][$key1]['order_ref_no']=$transaction['RawTradins']['order_id'];
                        $clientDetailsDataHcode[$client][$key1]['total_trade']=$transaction['RawTradins']['order_avg_price']*$transaction['RawTradins']['execute_qty'];
                        // $clientDetailsDataHcode[$client][$key1]['total_trade_sum']+=2;

                        $irn=$transaction['RawTradins']['client_ac'];
                        $irn = ltrim($irn, '0');
                        // $clientTransaction=($transaction['RawTradins']['execute_qty']*$transaction['RawTradins']['order_avg_price']);

                        if(isset($broker_fee_hcode[$irn]))
                        {
                            $commissionPer=$broker_fee_hcode[$irn]/100;
                            // $commi=($clientTransaction*$commissionPer)/100;


                        }
                        else
                        {
                           
                           // echo "$irn not Use OMO.Default broker fee (0.5%)";
                         //   pr($irn);
                            $nonOmoUser[$irn] =$irn;
                            $commissionPer=0.5/100;
                            // $commi=($clientTransaction*$commissionPer)/100;

                            // continue;
                        }

                        //  pr($broker_fee_hcode[$irn]);

                        // $commissionHcode+=$commi;

                        //$totalTradeClientHcode+=$clientTransaction;
                        $totalTradeClientHcode+=($transaction['RawTradins']['execute_qty']*$transaction['RawTradins']['order_avg_price']);*/

                    }

                    else
                    {

                        if(in_array($transaction['RawTradins']['client_ac'],$hacOmoUsersNonH, TRUE))
                        {


                            $clientDetailsDataNonHcode[$client][$key1]['code'] = $transaction['RawTradins']['client_ac'];
                            $clientDetailsDatNonaHcode[$client][$key1]['date'] = $tradedate;
                            $clientDetailsDataNonHcode[$client][$key1]['instrument'] = $transaction['RawTradins']['symbol'];
                            $clientDetailsDataNonHcode[$client][$key1]['trade_time'] = $tradetime;
                            $clientDetailsDataNonHcode[$client][$key1]['trade_type'] = $transaction['RawTradins']['side'];
                            $clientDetailsDataNonHcode[$client][$key1]['price'] = $transaction['RawTradins']['order_avg_price'];
                            $clientDetailsDataNonHcode[$client][$key1]['quantity'] = $transaction['RawTradins']['execute_qty'];
                            $clientDetailsDataNonHcode[$client][$key1]['order_ref_no'] = $transaction['RawTradins']['order_id'];
                            $clientDetailsDataNonHcode[$client][$key1]['total_trade'] = $transaction['RawTradins']['order_avg_price'] * $transaction['RawTradins']['execute_qty'];
                            // $clientDetailsDataNonHcode[$client][$key1]['total_trade_sum']+=2;


                            $totalTradeClientNonHcode += ($transaction['RawTradins']['execute_qty'] * $transaction['RawTradins']['order_avg_price']);
                        }

                    }





                }

            }


           // $commissionHcode=($totalTradeClientHcode*$commissionPer);
            $commissionNonHcode=($totalTradeClientNonHcode*$commissionPercentForNonCode);

           // $totalTradeSummationClientHcode+=$totalTradeClientHcode;
            $totalTradeSummationNonClientNonHcode+=$totalTradeClientNonHcode;


           // $totalCommissionSummationClientHcode+=$commissionHcode;
            $totalCommissionSummationClientNonHcode+=$commissionNonHcode;

            if((70000 <= $client) && ($client <= 90000))
            {/*
                $dataPerHClient[$key]['client']=$client;
                $dataPerHClient[$key]['tradeAmountHcode']=$totalTradeClientHcode;
                $dataPerHClient[$key]['commissionHcode']=$commissionHcode;
                $dataPerHClient[$key]['commissionPer']=$commissionPer;
               */
            }
            else
            {
                if(in_array($client,$hacOmoUsersNonH, TRUE))
                {
                    $dataPerNonHClient[$key]['client'] = $client;
                    $dataPerNonHClient[$key]['tradeAmountNonHcode'] = $totalTradeClientNonHcode;
                    $dataPerNonHClient[$key]['commissionNonHcode'] = $commissionNonHcode;
                    $dataPerNonHClient[$key]['commissionPerNonH'] = $commissionPercentForNonCode;

                }

            }
            //  $commissionHcode=array();
            //   $commissionNonHcode=array();
            // $dataPerDay[$key]['commission']=$commission;


        }

       // $dataTotalForClient['totalTradeSummationHcode']=$totalTradeSummationClientHcode;
        $dataTotalForClient['totalTradeSummationNonHcode']=$totalTradeSummationNonClientNonHcode;
       // $dataTotalForClient['totalCommissionSummationHcode']=$totalCommissionSummationClientHcode;
        $dataTotalForClient['totalCommissionSummationNonHcode']=$totalCommissionSummationClientNonHcode;



       // $this->set('dataPerHClient',$dataPerHClient);
        $this->set('dataPerNonHClient',$dataPerNonHClient);
        $this->set('dataTotalForClient',$dataTotalForClient);
       // $this->set('clientDetailsData',$clientDetailsDataHcode);
      //  $this->set('nonOmoUser',$nonOmoUser);


    }

    function billingReportSbsharp($paramData)
    { Configure::write('debug', 2);
        $parameters=explode(',',$paramData);

        $brokerHouse =$parameters[2];
        $bro_id=$this->Auth->user('broker_id');

        if ($brokerHouse != $bro_id) {
            echo "This is not your house";
            exit;
        }


        $dateForm =$parameters[0];
        $s_date=explode(' ',$dateForm);
        $dateForm=$s_date[0];
        $dateForm="".$dateForm." 1:00:00";

        $dateTo = $parameters[1];
        $e_date=explode(' ',$dateTo);
        $dateTo=$e_date[0];
        $dateTo="".$dateTo." 23:59:00";



        // $billName=$_POST['billName'];

        $RawTradeinsModel = ClassRegistry::init('RawTradins');
        $transactions = $RawTradeinsModel->find('all', array("conditions"=>array("RawTradins.execute_time BETWEEN ? and ?" => array($dateForm, $dateTo),"RawTradins.broker_id"=>$bro_id),'order'=>array('RawTradins.execute_time ASC'),'recursive' => -1) );




        $userModel = ClassRegistry::init('User');
        $hacOmoUsersHCode = $userModel->find('all', array("conditions"=>array("User.broker_id" =>$bro_id,"User.internal_ref_no BETWEEN ? and ?" =>array(50000,90000)),'fields'=>array('internal_ref_no','broker_id','broker_fee'),'order'=>array('User.internal_ref_no ASC'),'recursive' => -1) );


        $hacOmoUsersNonH = $userModel->find('all', array("conditions"=>array("User.broker_id" =>$bro_id,"User.internal_ref_no NOT BETWEEN ? and ?" =>array(50000,90000)),'fields'=>array('internal_ref_no','broker_id'),'recursive' => -1) );

      //  pr($transactions);
      //  pr($hacOmoUsersNonH);
      //  exit;
        //str_pad($irn, 5, "0", STR_PAD_LEFT);

        $broker_fee_hcode = Hash::combine($hacOmoUsersHCode, '{n}.User.internal_ref_no','{n}.User.broker_fee');
        // pr($broker_fee_hcode);

        $hacOmoUsersNonH = Hash::extract($hacOmoUsersNonH,'{n}.User.internal_ref_no');

        $transactionsArray=array();
        foreach($transactions as $transaction) {

            $keyString="".$transaction['RawTradins']['order_id']."_".$transaction['RawTradins']['execution_id']."";

            $transactionsArray[$keyString]=$transaction;

        }


        $date = Hash::extract($transactionsArray,'{s}.RawTradins.execute_time');
        // $dateForWithoutHcode = Hash::extract($transactionsArrayforWithoutHcode,'{s}.RawTradins.execute_time');

        $clientCode = Hash::extract($transactionsArray,'{s}.RawTradins.client_ac');
        // $clientCodeForWithoutHcode = Hash::extract($transactionsArrayforWithoutHcode,'{s}.RawTradins.client_ac');


        foreach($date as $key=>$dateString)
        {
            $temp=explode(' ',$dateString);
            $onlyDate[$key]=$temp[0];
        }

        $unicDate=array_unique($onlyDate);

        $unicClientCode=array_unique($clientCode);




        $totalTradeSummationforHcode=0;
        $totalTradeSummationforNonHcode=0;
        $totalCommissionSummationHcode=0;
        $totalCommissionSummationNonHcode=0;

        // $commissionPercentForCode=0.005;
        $commissionPercentForNonCode=0.0003;
        // $commissionPerClient=0.5;


        foreach($unicDate as $key=>$day)
        {
            $totalTradeforHcode=0;
            $totalTradeforNonHcode=0;
            $commissionForHcode=0;
            foreach($transactionsArray as $transaction)
            {
                $tempdate=explode(' ',$transaction['RawTradins']['execute_time']);
                $tradedate=$tempdate[0];

                if($day==$tradedate)
                {
                    if((70000 <= $transaction['RawTradins']['client_ac']) && ($transaction['RawTradins']['client_ac'] <= 80000))
                    {
                        $irn=$transaction['RawTradins']['client_ac'];

                        // pr($irn);
                        $irn = ltrim($irn, '0');
                        // pr($irn);
                        $clientTransaction=($transaction['RawTradins']['execute_qty']*$transaction['RawTradins']['order_avg_price']);

                        if(isset($broker_fee_hcode[$irn]))
                        {
                            $comm=($clientTransaction*$broker_fee_hcode[$irn])/100;
                        }
                        else
                        {

                            //echo "$irn not Use OMO.Default broker fee (0.5%)";
                            $nonOmoUser[$irn] =$irn;
                            $comm=($clientTransaction*.5)/100;
                        }
                        // pr($broker_fee_hcode[$irn]);

                        $commissionForHcode+=$comm;

                        $totalTradeforHcode+=$clientTransaction;
                        // $totalTradeforHcode+=($transaction['RawTradins']['execute_qty']*$transaction['RawTradins']['order_avg_price']);


                    }

                    else
                    {
                        if(in_array($transaction['RawTradins']['client_ac'],$hacOmoUsersNonH, TRUE))
                        {

                            $totalTradeforNonHcode+=($transaction['RawTradins']['execute_qty']*$transaction['RawTradins']['order_avg_price']);
                        }

                    }

//pr($transaction['RawTradins']['client_ac']);
                }

            }


            // $commissionForHcode=($totalTradeforHcode*$commissionPercentForCode);
            $commissionForNonHcode=($totalTradeforNonHcode*$commissionPercentForNonCode);

           // $totalTradeSummationforHcode+=$totalTradeforHcode;
            $totalTradeSummationforNonHcode+=$totalTradeforNonHcode;

            //$totalCommissionSummationHcode+=$commissionForHcode;
            $totalCommissionSummationNonHcode+=$commissionForNonHcode;

            $dataPerDay[$key]['date']=$day;
           // $dataPerDay[$key]['tradeAmountHcode']=$totalTradeforHcode;
            $dataPerDay[$key]['tradeAmountNonHcode']=$totalTradeforNonHcode;
           // $dataPerDay[$key]['commissionHcode']=$commissionForHcode;
            $dataPerDay[$key]['commissionNonHcode']=$commissionForNonHcode;


        }

       // $dataTotalForDays['totalTradeSummationHcode']=$totalTradeSummationforHcode;
        $dataTotalForDays['totalTradeSummationNonHcode']=$totalTradeSummationforNonHcode;
       // $dataTotalForDays['totalCommissionSummationHcode']=$totalCommissionSummationHcode;
        $dataTotalForDays['totalCommissionSummationNonHcode']=$totalCommissionSummationNonHcode;



        $this->set('dataPerDay',$dataPerDay);
        $this->set('dataTotalForDays',$dataTotalForDays);


        $totalTradeSummationClientHcode=0;
        $totalTradeSummationNonClientNonHcode=0;
        $totalCommissionSummationClientHcode=0;
        $totalCommissionSummationClientNonHcode=0;
        //$commissionHcode=0;

        $commissionPer=0;

        foreach($unicClientCode as $key=>$client)
        {
            $totalTradeClientHcode=0;
            $totalTradeClientNonHcode=0;


            //$clientDetailsDataHcode[$client][$key1]['total_trade_sum']=0;
            //$clientDetailsDataNonHcode[$client][$key1]['total_trade_sum']=0;
            foreach($transactionsArray as $key1=>$transaction)
            {
                $tempCode=$transaction['RawTradins']['client_ac'];


                if($client==$tempCode)
                {
                    $tempdate=explode(' ',$transaction['RawTradins']['execute_time']);

                    $tradedate=$tempdate[0];
                    $tradetime=$tempdate[1];

                    if((70000 <= $transaction['RawTradins']['client_ac']) && ($transaction['RawTradins']['client_ac'] <= 90000))
                    {
                        /*
                        $clientDetailsDataHcode[$client][$key1]['code']=$transaction['RawTradins']['client_ac'];
                        $clientDetailsDataHcode[$client][$key1]['date']=$tradedate;
                        $clientDetailsDataHcode[$client][$key1]['instrument']=$transaction['RawTradins']['symbol'];
                        $clientDetailsDataHcode[$client][$key1]['trade_time']=$tradetime;
                        $clientDetailsDataHcode[$client][$key1]['trade_type']=$transaction['RawTradins']['side'];
                        $clientDetailsDataHcode[$client][$key1]['price']=$transaction['RawTradins']['order_avg_price'];
                        $clientDetailsDataHcode[$client][$key1]['quantity']=$transaction['RawTradins']['execute_qty'];
                        $clientDetailsDataHcode[$client][$key1]['order_ref_no']=$transaction['RawTradins']['order_id'];
                        $clientDetailsDataHcode[$client][$key1]['total_trade']=$transaction['RawTradins']['order_avg_price']*$transaction['RawTradins']['execute_qty'];
                        // $clientDetailsDataHcode[$client][$key1]['total_trade_sum']+=2;

                        $irn=$transaction['RawTradins']['client_ac'];
                        $irn = ltrim($irn, '0');
                        // $clientTransaction=($transaction['RawTradins']['execute_qty']*$transaction['RawTradins']['order_avg_price']);

                        if(isset($broker_fee_hcode[$irn]))
                        {
                            $commissionPer=$broker_fee_hcode[$irn]/100;
                            // $commi=($clientTransaction*$commissionPer)/100;


                        }
                        else
                        {

                           // echo "$irn not Use OMO.Default broker fee (0.5%)";
                         //   pr($irn);
                            $nonOmoUser[$irn] =$irn;
                            $commissionPer=0.5/100;
                            // $commi=($clientTransaction*$commissionPer)/100;

                            // continue;
                        }

                        //  pr($broker_fee_hcode[$irn]);

                        // $commissionHcode+=$commi;

                        //$totalTradeClientHcode+=$clientTransaction;
                        $totalTradeClientHcode+=($transaction['RawTradins']['execute_qty']*$transaction['RawTradins']['order_avg_price']);*/

                    }

                    else
                    {

                        if(in_array($transaction['RawTradins']['client_ac'],$hacOmoUsersNonH, TRUE))
                        {


                            $clientDetailsDataNonHcode[$client][$key1]['code'] = $transaction['RawTradins']['client_ac'];
                            $clientDetailsDatNonaHcode[$client][$key1]['date'] = $tradedate;
                            $clientDetailsDataNonHcode[$client][$key1]['instrument'] = $transaction['RawTradins']['symbol'];
                            $clientDetailsDataNonHcode[$client][$key1]['trade_time'] = $tradetime;
                            $clientDetailsDataNonHcode[$client][$key1]['trade_type'] = $transaction['RawTradins']['side'];
                            $clientDetailsDataNonHcode[$client][$key1]['price'] = $transaction['RawTradins']['order_avg_price'];
                            $clientDetailsDataNonHcode[$client][$key1]['quantity'] = $transaction['RawTradins']['execute_qty'];
                            $clientDetailsDataNonHcode[$client][$key1]['order_ref_no'] = $transaction['RawTradins']['order_id'];
                            $clientDetailsDataNonHcode[$client][$key1]['total_trade'] = $transaction['RawTradins']['order_avg_price'] * $transaction['RawTradins']['execute_qty'];
                            // $clientDetailsDataNonHcode[$client][$key1]['total_trade_sum']+=2;


                            $totalTradeClientNonHcode += ($transaction['RawTradins']['execute_qty'] * $transaction['RawTradins']['order_avg_price']);
                        }

                    }





                }

            }


           // $commissionHcode=($totalTradeClientHcode*$commissionPer);
            $commissionNonHcode=($totalTradeClientNonHcode*$commissionPercentForNonCode);

           // $totalTradeSummationClientHcode+=$totalTradeClientHcode;
            $totalTradeSummationNonClientNonHcode+=$totalTradeClientNonHcode;


           // $totalCommissionSummationClientHcode+=$commissionHcode;
            $totalCommissionSummationClientNonHcode+=$commissionNonHcode;

            if((70000 <= $client) && ($client <= 90000))
            {/*
                $dataPerHClient[$key]['client']=$client;
                $dataPerHClient[$key]['tradeAmountHcode']=$totalTradeClientHcode;
                $dataPerHClient[$key]['commissionHcode']=$commissionHcode;
                $dataPerHClient[$key]['commissionPer']=$commissionPer;
               */
            }
            else
            {
                if(in_array($client,$hacOmoUsersNonH, TRUE))
                {
                    $dataPerNonHClient[$key]['client'] = $client;
                    $dataPerNonHClient[$key]['tradeAmountNonHcode'] = $totalTradeClientNonHcode;
                    $dataPerNonHClient[$key]['commissionNonHcode'] = $commissionNonHcode;
                    $dataPerNonHClient[$key]['commissionPerNonH'] = $commissionPercentForNonCode;

                }

            }
            //  $commissionHcode=array();
            //   $commissionNonHcode=array();
            // $dataPerDay[$key]['commission']=$commission;


        }

       // $dataTotalForClient['totalTradeSummationHcode']=$totalTradeSummationClientHcode;
        $dataTotalForClient['totalTradeSummationNonHcode']=$totalTradeSummationNonClientNonHcode;
       // $dataTotalForClient['totalCommissionSummationHcode']=$totalCommissionSummationClientHcode;
        $dataTotalForClient['totalCommissionSummationNonHcode']=$totalCommissionSummationClientNonHcode;



       // $this->set('dataPerHClient',$dataPerHClient);
        $this->set('dataPerNonHClient',$dataPerNonHClient);
        $this->set('dataTotalForClient',$dataTotalForClient);
       // $this->set('clientDetailsData',$clientDetailsDataHcode);
      //  $this->set('nonOmoUser',$nonOmoUser);


    }
    function billingReportCommerce2($paramData)
    { Configure::write('debug', 2);
        $parameters=explode(',',$paramData);

        $brokerHouse =$parameters[2];
        $bro_id=$this->Auth->user('broker_id');

        if ($brokerHouse != $bro_id) {
            echo "This is not your house";
            exit;
        }


        $dateForm =$parameters[0];
        $s_date=explode(' ',$dateForm);
        $dateForm=$s_date[0];
        $dateForm="".$dateForm." 1:00:00";

        $dateTo = $parameters[1];
        $e_date=explode(' ',$dateTo);
        $dateTo=$e_date[0];
        $dateTo="".$dateTo." 23:59:00";



        // $billName=$_POST['billName'];

        $RawTradeinsModel = ClassRegistry::init('RawTradins');
        $transactions = $RawTradeinsModel->find('all', array("conditions"=>array("RawTradins.execute_time BETWEEN ? and ?" => array($dateForm, $dateTo),"RawTradins.broker_id"=>$bro_id),'order'=>array('RawTradins.execute_time ASC'),'recursive' => -1) );




        $userModel = ClassRegistry::init('User');

        $OmoUsersHCode = $userModel->find('all', array("conditions"=>array("User.broker_id" =>$bro_id,"User.internal_ref_no Like" =>"%H%"),'fields'=>array('internal_ref_no','broker_id','broker_fee'),'order'=>array('User.internal_ref_no ASC'),'recursive' => -1) );


        $apexOmoUsersNonH = $userModel->find('all', array("conditions"=>array("User.broker_id" =>$bro_id,"User.internal_ref_no NOT Like" =>"%H%"),'fields'=>array('internal_ref_no','broker_id'),'recursive' => -1) );


        $hacOmoUsersHCode = $userModel->find('all', array("conditions"=>array("User.broker_id" =>$bro_id,"User.internal_ref_no BETWEEN ? and ?" =>array(70000,90000)),'fields'=>array('internal_ref_no','broker_id','broker_fee'),'order'=>array('User.internal_ref_no ASC'),'recursive' => -1) );


        $hacOmoUsersNonH = $userModel->find('all', array("conditions"=>array("User.broker_id" =>$bro_id,"User.internal_ref_no NOT BETWEEN ? and ?" =>array(70000,90000)),'fields'=>array('internal_ref_no','broker_id'),'recursive' => -1) );

      //  pr($transactions);
      //  pr($hacOmoUsersNonH);
      //  exit;
        //str_pad($irn, 5, "0", STR_PAD_LEFT);

        $broker_fee_hcode = Hash::combine($hacOmoUsersHCode, '{n}.User.internal_ref_no','{n}.User.broker_fee');
        // pr($broker_fee_hcode);

        $hacOmoUsersNonH = Hash::extract($hacOmoUsersNonH,'{n}.User.internal_ref_no');

        $transactionsArray=array();
        foreach($transactions as $transaction) {

            $keyString="".$transaction['RawTradins']['order_id']."_".$transaction['RawTradins']['execution_id']."";

            $transactionsArray[$keyString]=$transaction;

        }


        $date = Hash::extract($transactionsArray,'{s}.RawTradins.execute_time');
        // $dateForWithoutHcode = Hash::extract($transactionsArrayforWithoutHcode,'{s}.RawTradins.execute_time');

        $clientCode = Hash::extract($transactionsArray,'{s}.RawTradins.client_ac');
        // $clientCodeForWithoutHcode = Hash::extract($transactionsArrayforWithoutHcode,'{s}.RawTradins.client_ac');


        foreach($date as $key=>$dateString)
        {
            $temp=explode(' ',$dateString);
            $onlyDate[$key]=$temp[0];
        }

        $unicDate=array_unique($onlyDate);

        $unicClientCode=array_unique($clientCode);




        $totalTradeSummationforHcode=0;
        $totalTradeSummationforNonHcode=0;
        $totalCommissionSummationHcode=0;
        $totalCommissionSummationNonHcode=0;

        // $commissionPercentForCode=0.005;
        $commissionPercentForNonCode=0.0003;
        // $commissionPerClient=0.5;


        foreach($unicDate as $key=>$day)
        {
            $totalTradeforHcode=0;
            $totalTradeforNonHcode=0;
            $commissionForHcode=0;
            foreach($transactionsArray as $transaction)
            {
                $tempdate=explode(' ',$transaction['RawTradins']['execute_time']);
                $tradedate=$tempdate[0];

                if($day==$tradedate)
                {
                    if((70000 <= $transaction['RawTradins']['client_ac']) && ($transaction['RawTradins']['client_ac'] <= 80000))
                    {
                        $irn=$transaction['RawTradins']['client_ac'];

                        // pr($irn);
                        $irn = ltrim($irn, '0');
                        // pr($irn);
                        $clientTransaction=($transaction['RawTradins']['execute_qty']*$transaction['RawTradins']['order_avg_price']);

                        if(isset($broker_fee_hcode[$irn]))
                        {
                            $comm=($clientTransaction*$broker_fee_hcode[$irn])/100;
                        }
                        else
                        {

                            //echo "$irn not Use OMO.Default broker fee (0.5%)";
                            $nonOmoUser[$irn] =$irn;
                            $comm=($clientTransaction*.5)/100;
                        }
                        // pr($broker_fee_hcode[$irn]);

                        $commissionForHcode+=$comm;

                        $totalTradeforHcode+=$clientTransaction;
                        // $totalTradeforHcode+=($transaction['RawTradins']['execute_qty']*$transaction['RawTradins']['order_avg_price']);


                    }

                    else
                    {
                        if(in_array($transaction['RawTradins']['client_ac'],$hacOmoUsersNonH, TRUE))
                        {

                            $totalTradeforNonHcode+=($transaction['RawTradins']['execute_qty']*$transaction['RawTradins']['order_avg_price']);
                        }

                    }

//pr($transaction['RawTradins']['client_ac']);
                }

            }


            // $commissionForHcode=($totalTradeforHcode*$commissionPercentForCode);
            $commissionForNonHcode=($totalTradeforNonHcode*$commissionPercentForNonCode);

           // $totalTradeSummationforHcode+=$totalTradeforHcode;
            $totalTradeSummationforNonHcode+=$totalTradeforNonHcode;

            //$totalCommissionSummationHcode+=$commissionForHcode;
            $totalCommissionSummationNonHcode+=$commissionForNonHcode;

            $dataPerDay[$key]['date']=$day;
           // $dataPerDay[$key]['tradeAmountHcode']=$totalTradeforHcode;
            $dataPerDay[$key]['tradeAmountNonHcode']=$totalTradeforNonHcode;
           // $dataPerDay[$key]['commissionHcode']=$commissionForHcode;
            $dataPerDay[$key]['commissionNonHcode']=$commissionForNonHcode;


        }

       // $dataTotalForDays['totalTradeSummationHcode']=$totalTradeSummationforHcode;
        $dataTotalForDays['totalTradeSummationNonHcode']=$totalTradeSummationforNonHcode;
       // $dataTotalForDays['totalCommissionSummationHcode']=$totalCommissionSummationHcode;
        $dataTotalForDays['totalCommissionSummationNonHcode']=$totalCommissionSummationNonHcode;



        $this->set('dataPerDay',$dataPerDay);
        $this->set('dataTotalForDays',$dataTotalForDays);


        $totalTradeSummationClientHcode=0;
        $totalTradeSummationNonClientNonHcode=0;
        $totalCommissionSummationClientHcode=0;
        $totalCommissionSummationClientNonHcode=0;
        //$commissionHcode=0;

        $commissionPer=0;

        foreach($unicClientCode as $key=>$client)
        {
            $totalTradeClientHcode=0;
            $totalTradeClientNonHcode=0;


            //$clientDetailsDataHcode[$client][$key1]['total_trade_sum']=0;
            //$clientDetailsDataNonHcode[$client][$key1]['total_trade_sum']=0;
            foreach($transactionsArray as $key1=>$transaction)
            {
                $tempCode=$transaction['RawTradins']['client_ac'];


                if($client==$tempCode)
                {
                    $tempdate=explode(' ',$transaction['RawTradins']['execute_time']);

                    $tradedate=$tempdate[0];
                    $tradetime=$tempdate[1];

                    if((70000 <= $transaction['RawTradins']['client_ac']) && ($transaction['RawTradins']['client_ac'] <= 90000))
                    {
                        /*
                        $clientDetailsDataHcode[$client][$key1]['code']=$transaction['RawTradins']['client_ac'];
                        $clientDetailsDataHcode[$client][$key1]['date']=$tradedate;
                        $clientDetailsDataHcode[$client][$key1]['instrument']=$transaction['RawTradins']['symbol'];
                        $clientDetailsDataHcode[$client][$key1]['trade_time']=$tradetime;
                        $clientDetailsDataHcode[$client][$key1]['trade_type']=$transaction['RawTradins']['side'];
                        $clientDetailsDataHcode[$client][$key1]['price']=$transaction['RawTradins']['order_avg_price'];
                        $clientDetailsDataHcode[$client][$key1]['quantity']=$transaction['RawTradins']['execute_qty'];
                        $clientDetailsDataHcode[$client][$key1]['order_ref_no']=$transaction['RawTradins']['order_id'];
                        $clientDetailsDataHcode[$client][$key1]['total_trade']=$transaction['RawTradins']['order_avg_price']*$transaction['RawTradins']['execute_qty'];
                        // $clientDetailsDataHcode[$client][$key1]['total_trade_sum']+=2;

                        $irn=$transaction['RawTradins']['client_ac'];
                        $irn = ltrim($irn, '0');
                        // $clientTransaction=($transaction['RawTradins']['execute_qty']*$transaction['RawTradins']['order_avg_price']);

                        if(isset($broker_fee_hcode[$irn]))
                        {
                            $commissionPer=$broker_fee_hcode[$irn]/100;
                            // $commi=($clientTransaction*$commissionPer)/100;


                        }
                        else
                        {

                           // echo "$irn not Use OMO.Default broker fee (0.5%)";
                         //   pr($irn);
                            $nonOmoUser[$irn] =$irn;
                            $commissionPer=0.5/100;
                            // $commi=($clientTransaction*$commissionPer)/100;

                            // continue;
                        }

                        //  pr($broker_fee_hcode[$irn]);

                        // $commissionHcode+=$commi;

                        //$totalTradeClientHcode+=$clientTransaction;
                        $totalTradeClientHcode+=($transaction['RawTradins']['execute_qty']*$transaction['RawTradins']['order_avg_price']);*/

                    }

                    else
                    {

                        if(in_array($transaction['RawTradins']['client_ac'],$hacOmoUsersNonH, TRUE))
                        {


                            $clientDetailsDataNonHcode[$client][$key1]['code'] = $transaction['RawTradins']['client_ac'];
                            $clientDetailsDatNonaHcode[$client][$key1]['date'] = $tradedate;
                            $clientDetailsDataNonHcode[$client][$key1]['instrument'] = $transaction['RawTradins']['symbol'];
                            $clientDetailsDataNonHcode[$client][$key1]['trade_time'] = $tradetime;
                            $clientDetailsDataNonHcode[$client][$key1]['trade_type'] = $transaction['RawTradins']['side'];
                            $clientDetailsDataNonHcode[$client][$key1]['price'] = $transaction['RawTradins']['order_avg_price'];
                            $clientDetailsDataNonHcode[$client][$key1]['quantity'] = $transaction['RawTradins']['execute_qty'];
                            $clientDetailsDataNonHcode[$client][$key1]['order_ref_no'] = $transaction['RawTradins']['order_id'];
                            $clientDetailsDataNonHcode[$client][$key1]['total_trade'] = $transaction['RawTradins']['order_avg_price'] * $transaction['RawTradins']['execute_qty'];
                            // $clientDetailsDataNonHcode[$client][$key1]['total_trade_sum']+=2;


                            $totalTradeClientNonHcode += ($transaction['RawTradins']['execute_qty'] * $transaction['RawTradins']['order_avg_price']);
                        }

                    }





                }

            }


           // $commissionHcode=($totalTradeClientHcode*$commissionPer);
            $commissionNonHcode=($totalTradeClientNonHcode*$commissionPercentForNonCode);

           // $totalTradeSummationClientHcode+=$totalTradeClientHcode;
            $totalTradeSummationNonClientNonHcode+=$totalTradeClientNonHcode;


           // $totalCommissionSummationClientHcode+=$commissionHcode;
            $totalCommissionSummationClientNonHcode+=$commissionNonHcode;

            if((70000 <= $client) && ($client <= 90000))
            {/*
                $dataPerHClient[$key]['client']=$client;
                $dataPerHClient[$key]['tradeAmountHcode']=$totalTradeClientHcode;
                $dataPerHClient[$key]['commissionHcode']=$commissionHcode;
                $dataPerHClient[$key]['commissionPer']=$commissionPer;
               */
            }
            else
            {
                if(in_array($client,$hacOmoUsersNonH, TRUE))
                {
                    $dataPerNonHClient[$key]['client'] = $client;
                    $dataPerNonHClient[$key]['tradeAmountNonHcode'] = $totalTradeClientNonHcode;
                    $dataPerNonHClient[$key]['commissionNonHcode'] = $commissionNonHcode;
                    $dataPerNonHClient[$key]['commissionPerNonH'] = $commissionPercentForNonCode;

                }

            }
            //  $commissionHcode=array();
            //   $commissionNonHcode=array();
            // $dataPerDay[$key]['commission']=$commission;


        }

       // $dataTotalForClient['totalTradeSummationHcode']=$totalTradeSummationClientHcode;
        $dataTotalForClient['totalTradeSummationNonHcode']=$totalTradeSummationNonClientNonHcode;
       // $dataTotalForClient['totalCommissionSummationHcode']=$totalCommissionSummationClientHcode;
        $dataTotalForClient['totalCommissionSummationNonHcode']=$totalCommissionSummationClientNonHcode;



       // $this->set('dataPerHClient',$dataPerHClient);
        $this->set('dataPerNonHClient',$dataPerNonHClient);
        $this->set('dataTotalForClient',$dataTotalForClient);
       // $this->set('clientDetailsData',$clientDetailsDataHcode);
      //  $this->set('nonOmoUser',$nonOmoUser);


    }

    function billingReportCommerce3($paramData)
    { Configure::write('debug', 2);
        $parameters=explode(',',$paramData);

        $brokerHouse =$parameters[2];
        $bro_id=$this->Auth->user('broker_id');

        if ($brokerHouse != $bro_id) {
            echo "This is not your house";
            exit;
        }


        $dateForm =$parameters[0];
        $s_date=explode(' ',$dateForm);
        $dateForm=$s_date[0];
        $dateForm="".$dateForm." 1:00:00";

        $dateTo = $parameters[1];
        $e_date=explode(' ',$dateTo);
        $dateTo=$e_date[0];
        $dateTo="".$dateTo." 23:59:00";


        $RawTradeinsModel = ClassRegistry::init('RawTradins');
        $transactions = $RawTradeinsModel->find('all', array("conditions"=>array("RawTradins.execute_time BETWEEN ? and ?" => array($dateForm, $dateTo),"RawTradins.broker_id"=>$bro_id),'order'=>array('RawTradins.substatus DESC'),'recursive' => -1) );

        $userModel = ClassRegistry::init('User');
        $apexOmoUsersHCode = $userModel->find('all', array("conditions"=>array("User.broker_id" =>$bro_id,"User.internal_ref_no Like" =>"%S%"),'fields'=>array('internal_ref_no','broker_id','broker_fee'),'order'=>array('User.internal_ref_no ASC'),'recursive' => -1) );


        $apexOmoUsersNonH = $userModel->find('all', array("conditions"=>array("User.broker_id" =>$bro_id,"User.internal_ref_no NOT Like" =>"%S%"),'fields'=>array('internal_ref_no','broker_id'),'recursive' => -1) );



        $broker_fee_hcode = Hash::combine($apexOmoUsersHCode, '{n}.User.internal_ref_no','{n}.User.broker_fee');

        $apexOmoUsersNonH = Hash::extract($apexOmoUsersNonH,'{n}.User.internal_ref_no');

        $transactionsArray=array();
        foreach($transactions as $transaction) {

            $tempExecuteDate=explode(' ',$transaction['RawTradins']['execute_time']);
            $executeDate=$tempExecuteDate[0];
            //  $executeTime=$tempExecuteDate[1];

            $keyString="".$transaction['RawTradins']['order_id']."_".$transaction['RawTradins']['execution_id']."_".$executeDate."";

            $transaction = Hash::insert($transaction['RawTradins'],'execute_date',$executeDate);
            //   $transaction = Hash::insert($transaction['RawTradins'],'execute_time',$executeTime);

            $transactionsArray[$keyString]=$transaction;

        }

        $filledTransactions=Hash::extract($transactionsArray, '{s}[substatus=Filled]');


        $filledTransactions = Hash::combine($filledTransactions,  array('%s:%s', '{n}.order_id', '{n}.execute_date'),'{n}.substatus');


        $partialFilledTransactions=Hash::extract($transactionsArray, '{s}[substatus=Partially filled]');
        $partialFilledTransactions = Hash::combine($partialFilledTransactions, array('%s:%s', '{n}.order_id', '{n}.execute_date'), '{n}.execute_qty');




        $date = Hash::extract($transactionsArray,'{s}.execute_date');
        $clientCode = Hash::extract($transactionsArray,'{s}.client_ac');



        $unicDate=array_unique($date);
        $unicDate = Hash::sort($unicDate,'{n}','asc');



        $unicClientCode=array_unique($clientCode);
        $unicClientCode = Hash::sort($unicClientCode,'{n}','asc');

        $totalTradeSummationforHcode=0;
        $totalTradeSummationforNonHcode=0;
        $totalCommissionSummationHcode=0;
        $totalCommissionSummationNonHcode=0;

        $commissionPercentForNonCode=0.0005;

        foreach($unicDate as $key=>$day)
        {
            $totalTradeforHcode=0;
            $totalTradeforNonHcode=0;
            $commissionForHcode=0;
            $partialExcQty=array();
            foreach($transactionsArray as $transaction)
            { $executedAmount=0;
                $executedPrice=0;
                $tradedate=$transaction['execute_date'];

                if($day==$tradedate)
                {
                    if(strpos($transaction['client_ac'], "S"))
                    {
                        $irn=$transaction['client_ac'];

                        $irn = ltrim($irn, '0');

                        if($transaction['substatus']=="Partially filled")
                        {
                            $orderId=$transaction['order_id'];
                            if(isset($filledTransactions[$orderId.":".$tradedate]))
                            {
                                if(isset($partialExcQty[$orderId.":".$tradedate]))
                                {
                                    $partialExcQty[$orderId.":".$tradedate]+=$transaction['execute_qty'];
                                }
                                else
                                    $partialExcQty[$orderId.":".$tradedate]=$transaction['execute_qty'];

                                continue;
                            }
                            else
                            {

                                $executedAmount=$transaction['execute_qty'];
                                $executedPrice=$transaction['order_avg_price'];

                            }
                        }
                        elseif($transaction['substatus']=="Filled")
                        {
                            $orderId=$transaction['order_id'];
                            if(isset($partialFilledTransactions[$orderId.":".$tradedate]))
                            {
                                if($partialExcQty[$orderId.":".$tradedate]==$transaction['order_qty'])
                                {
                                    $executedAmount=$transaction['order_qty'];
                                    $executedPrice=$transaction['order_avg_price'];
                                }
                                else
                                {
                                    $executedAmount=$transaction['execute_qty']+$partialExcQty[$orderId.":".$tradedate];
                                    $executedPrice=$transaction['order_avg_price'];

                                }

                            }
                            else
                            {

                                $executedAmount=$transaction['execute_qty'];    //['order_qty']
                                $executedPrice=$transaction['order_avg_price'];

                            }

                        }

                        $clientTransaction=($executedAmount*$executedPrice);

                        if(isset($broker_fee_hcode[$irn]))
                        {
                            $comm=($clientTransaction*$broker_fee_hcode[$irn])/100;
                        }
                        else
                        {

                            $nonOmoUser[$irn] =$irn;
                            $comm=($clientTransaction*.5)/100;
                        }

                        $commissionForHcode+=$comm;

                        $totalTradeforHcode+=$clientTransaction;


                    }

                    else
                    {
                        if(in_array($transaction['client_ac'],$apexOmoUsersNonH, TRUE))
                        {


                            if($transaction['substatus']=="Partially filled")
                            {
                                $orderId=$transaction['order_id'];
                                if(isset($filledTransactions[$orderId.":".$tradedate]))
                                {

                                    if(isset($partialExcQty[$orderId.":".$tradedate]))
                                    {
                                        $partialExcQty[$orderId.":".$tradedate]+=$transaction['execute_qty'];
                                    }
                                    else
                                        $partialExcQty[$orderId.":".$tradedate]=$transaction['execute_qty'];
                                    continue;
                                }
                                else
                                {

                                    $executedAmount=$transaction['execute_qty'];
                                    $executedPrice=$transaction['order_avg_price'];

                                }
                            }

                            elseif($transaction['substatus']=="Filled")
                            {
                                $orderId=$transaction['order_id'];
                                if(isset($partialFilledTransactions[$orderId.":".$tradedate]))
                                {
                                    if($partialExcQty[$orderId.":".$tradedate]==$transaction['order_qty'])
                                    {
                                        $executedAmount=$transaction['order_qty'];
                                        $executedPrice=$transaction['order_avg_price'];
                                    }
                                    else
                                    {
                                        $executedAmount=$transaction['execute_qty']+$partialExcQty[$orderId.":".$tradedate];
                                        $executedPrice=$transaction['order_avg_price'];
                                    }

                                }
                                else
                                {

                                    $executedAmount=$transaction['execute_qty'];    //['order_qty']
                                    $executedPrice=$transaction['order_avg_price'];

                                }

                            }


                            $totalTradeforNonHcode+=($executedAmount*$executedPrice);
                        }

                    }


                }

            }


            $commissionForNonHcode=($totalTradeforNonHcode*$commissionPercentForNonCode);

            $totalTradeSummationforHcode+=$totalTradeforHcode;
            $totalTradeSummationforNonHcode+=$totalTradeforNonHcode;

            $totalCommissionSummationHcode+=$commissionForHcode;
            $totalCommissionSummationNonHcode+=$commissionForNonHcode;

            $dataPerDay[$key]['date']=$day;
            $dataPerDay[$key]['tradeAmountHcode']=$totalTradeforHcode;
            $dataPerDay[$key]['tradeAmountNonHcode']=$totalTradeforNonHcode;
            $dataPerDay[$key]['commissionHcode']=$commissionForHcode;
            $dataPerDay[$key]['commissionNonHcode']=$commissionForNonHcode;


        }



        $dataTotalForDays['totalTradeSummationHcode']=$totalTradeSummationforHcode;
        $dataTotalForDays['totalTradeSummationNonHcode']=$totalTradeSummationforNonHcode;
        $dataTotalForDays['totalCommissionSummationHcode']=$totalCommissionSummationHcode;
        $dataTotalForDays['totalCommissionSummationNonHcode']=$totalCommissionSummationNonHcode;

        pr($dataPerDay);
        pr($dataTotalForDays);
        exit;
        $this->set('dataPerDay',$dataPerDay);
        $this->set('dataTotalForDays',$dataTotalForDays);


        $totalTradeSummationClientHcode=0;
        $totalTradeSummationNonClientNonHcode=0;
        $totalCommissionSummationClientHcode=0;
        $totalCommissionSummationClientNonHcode=0;
        $partialExcQty=array();


        $clientDetailsDataNonHcode=array();
        foreach($unicClientCode as $key=>$client)
        {
            $totalTradeClientHcode=0;
            $totalTradeClientNonHcode=0;


            foreach($transactionsArray as $key1=>$transaction)
            {
                $executedAmount=0;
                $executedPrice=0;
                $tempCode=$transaction['client_ac'];


                if($client==$tempCode)
                {
                    $tradedate=$transaction['execute_date'];
                    $tradetime=$transaction['execute_time'];

                    if(strpos($transaction['client_ac'], "S"))
                    {

                        if($transaction['substatus']=="Partially filled")
                        {
                            $orderId=$transaction['order_id'];
                            if(isset($filledTransactions[$orderId.":".$tradedate]))
                            {

                                if(isset($partialExcQty[$orderId.":".$tradedate]))
                                {
                                    $partialExcQty[$orderId.":".$tradedate]+=$transaction['execute_qty'];
                                }
                                else
                                    $partialExcQty[$orderId.":".$tradedate]=$transaction['execute_qty'];
                                continue;
                            }
                            else
                            {

                                $executedAmount=$transaction['execute_qty'];
                                $executedPrice=$transaction['order_avg_price'];

                            }
                        }
                        elseif($transaction['substatus']=="Filled")
                        {
                            $orderId=$transaction['order_id'];
                            if(isset($partialFilledTransactions[$orderId.":".$tradedate]))
                            {
                                if($partialExcQty[$orderId.":".$tradedate]==$transaction['order_qty'])
                                {
                                    $executedAmount=$transaction['order_qty'];
                                    $executedPrice=$transaction['order_avg_price'];
                                }
                                else
                                {
                                    $executedAmount=$transaction['execute_qty']+$partialExcQty[$orderId.":".$tradedate];
                                    $executedPrice=$transaction['order_avg_price'];
                                }

                            }
                            else
                            {

                                $executedAmount=$transaction['execute_qty'];    //['order_qty']
                                $executedPrice=$transaction['order_avg_price'];

                            }

                        }


                        $clientDetailsDataHcode[$client][$key1]['code']=$transaction['client_ac'];
                        $clientDetailsDataHcode[$client][$key1]['date']=$tradedate;
                        $clientDetailsDataHcode[$client][$key1]['instrument']=$transaction['symbol'];
                        $clientDetailsDataHcode[$client][$key1]['trade_time']=$tradetime;
                        $clientDetailsDataHcode[$client][$key1]['trade_type']=$transaction['side'];
                        $clientDetailsDataHcode[$client][$key1]['price']=$transaction['order_avg_price'];
                        $clientDetailsDataHcode[$client][$key1]['quantity']=$executedAmount;
                        $clientDetailsDataHcode[$client][$key1]['order_ref_no']=$transaction['order_id'];
                        $clientDetailsDataHcode[$client][$key1]['total_trade']=$transaction['order_avg_price']*$transaction['execute_qty'];

                        $irn=$transaction['client_ac'];
                        $irn = ltrim($irn, '0');


                        if(isset($broker_fee_hcode[$irn]))
                        {
                            $commissionPer=$broker_fee_hcode[$irn]/100;


                        }
                        else
                        {

                            $nonOmoUser[$irn] =$irn;
                            $commissionPer=0.5/100;

                        }


                        $totalTradeClientHcode+=($executedAmount*$executedPrice);

                    }

                    else
                    {

                        if(in_array($transaction['client_ac'],$apexOmoUsersNonH, TRUE))
                        {



                            if($transaction['substatus']=="Partially filled")
                            {
                                $orderId=$transaction['order_id'];
                                if(isset($filledTransactions[$orderId.":".$tradedate]))
                                {
                                    if(isset($partialExcQty[$orderId.":".$tradedate]))
                                    {
                                        $partialExcQty[$orderId.":".$tradedate]+=$transaction['execute_qty'];
                                    }
                                    else
                                        $partialExcQty[$orderId.":".$tradedate]=$transaction['execute_qty'];
                                    continue;
                                }
                                else
                                {

                                    $executedAmount=$transaction['execute_qty'];
                                    $executedPrice=$transaction['order_avg_price'];

                                }
                            }
                            elseif($transaction['substatus']=="Filled")
                            {
                                $orderId=$transaction['order_id'];
                                if(isset($partialFilledTransactions[$orderId.":".$tradedate]))
                                {
                                    if($partialExcQty[$orderId.":".$tradedate]==$transaction['order_qty'])
                                    {
                                        $executedAmount=$transaction['order_qty'];
                                        $executedPrice=$transaction['order_avg_price'];
                                    }
                                    else
                                    {
                                        $executedAmount=$transaction['execute_qty']+$partialExcQty[$orderId.":".$tradedate];
                                        $executedPrice=$transaction['order_avg_price'];
                                    }

                                }
                                else
                                {

                                    $executedAmount=$transaction['execute_qty'];    //['order_qty']
                                    $executedPrice=$transaction['order_avg_price'];

                                }

                            }


                            $clientDetailsDataNonHcode[$client][$key1]['code'] = $transaction['client_ac'];
                            $clientDetailsDatNonaHcode[$client][$key1]['date'] =$tradedate;
                            $clientDetailsDataNonHcode[$client][$key1]['instrument'] = $transaction['symbol'];
                            $clientDetailsDataNonHcode[$client][$key1]['trade_time'] = $tradetime;
                            $clientDetailsDataNonHcode[$client][$key1]['trade_type'] = $transaction['side'];
                            $clientDetailsDataNonHcode[$client][$key1]['price'] = $transaction['order_avg_price'];
                            $clientDetailsDataNonHcode[$client][$key1]['quantity'] = $executedAmount;
                            $clientDetailsDataNonHcode[$client][$key1]['order_ref_no'] = $transaction['order_id'];
                            $clientDetailsDataNonHcode[$client][$key1]['total_trade'] = $transaction['order_avg_price'] * $transaction['execute_qty'];


                            $totalTradeClientNonHcode += ($executedAmount* $executedPrice);


                        }

                    }


                }

            }


            $commissionHcode=($totalTradeClientHcode*$commissionPer);
            $commissionNonHcode=($totalTradeClientNonHcode*$commissionPercentForNonCode);

            $totalTradeSummationClientHcode+=$totalTradeClientHcode;
            $totalTradeSummationNonClientNonHcode+=$totalTradeClientNonHcode;


            $totalCommissionSummationClientHcode+=$commissionHcode;
            $totalCommissionSummationClientNonHcode+=$commissionNonHcode;

            if(strpos($client, "S"))
            {
                $dataPerHClient[$key]['client']=$client;
                $dataPerHClient[$key]['tradeAmountHcode']=$totalTradeClientHcode;
                $dataPerHClient[$key]['commissionHcode']=$commissionHcode;
                $dataPerHClient[$key]['commissionPer']=$commissionPer;
            }
            else
            {
                if(in_array($client,$apexOmoUsersNonH, TRUE))
                {
                    $dataPerNonHClient[$key]['client'] = $client;
                    $dataPerNonHClient[$key]['tradeAmountNonHcode'] = $totalTradeClientNonHcode;
                    $dataPerNonHClient[$key]['commissionNonHcode'] = $commissionNonHcode;
                    $dataPerNonHClient[$key]['commissionPerNonH'] = $commissionPercentForNonCode;

                }

            }


        }

        $dataTotalForClient['totalTradeSummationHcode']=$totalTradeSummationClientHcode;
        $dataTotalForClient['totalTradeSummationNonHcode']=$totalTradeSummationNonClientNonHcode;
        $dataTotalForClient['totalCommissionSummationHcode']=$totalCommissionSummationClientHcode;
        $dataTotalForClient['totalCommissionSummationNonHcode']=$totalCommissionSummationClientNonHcode;




        $this->set('dataPerHClient',$dataPerHClient);
        $this->set('dataPerNonHClient',$dataPerNonHClient);
        $this->set('dataTotalForClient',$dataTotalForClient);
        $this->set('clientDetailsData',$clientDetailsDataHcode);
        $this->set('clientDetailsDataNonHClient',$clientDetailsDataNonHcode);
        $this->set('nonOmoUser',$nonOmoUser);



    }

    function billingReportCommerce($paramData)
    {
        //Configure::write('debug', 2);
        $parameters=explode(',',$paramData);

        $brokerHouse =$parameters[2];
        $bro_id=$this->Auth->user('broker_id');

        if ($brokerHouse != $bro_id) {
            echo "This is not your house";
            exit;
        }


        $dateForm =$parameters[0];
        $s_date=explode(' ',$dateForm);
        $dateForm=$s_date[0];
        $dateForm="".$dateForm." 1:00:00";

        $dateTo = $parameters[1];
        $e_date=explode(' ',$dateTo);
        $dateTo=$e_date[0];
        $dateTo="".$dateTo." 23:59:00";



        // $billName=$_POST['billName'];

        $RawTradeinsModel = ClassRegistry::init('RawTradins');
        $transactions = $RawTradeinsModel->find('all', array("conditions"=>array("RawTradins.execute_time BETWEEN ? and ?" => array($dateForm, $dateTo),"RawTradins.broker_id"=>$bro_id),'order'=>array('RawTradins.execute_time ASC'),'recursive' => -1) );




        $userModel = ClassRegistry::init('User');
        $hacOmoUsersHCode = $userModel->find('all', array("conditions"=>array("User.broker_id" =>$bro_id),'fields'=>array('internal_ref_no','broker_id','broker_fee'),'order'=>array('User.internal_ref_no ASC'),'recursive' => -1) );


        $hacOmoUsersNonH = $userModel->find('all', array("conditions"=>array("User.broker_id" =>$bro_id),'fields'=>array('internal_ref_no','broker_id'),'recursive' => -1) );

        //  pr($transactions);
        //  pr($hacOmoUsersNonH);
        //  exit;
        //str_pad($irn, 5, "0", STR_PAD_LEFT);

        $broker_fee_hcode = Hash::combine($hacOmoUsersHCode, '{n}.User.internal_ref_no','{n}.User.broker_fee');
        // pr($broker_fee_hcode);

        $hacOmoUsersNonH = Hash::extract($hacOmoUsersNonH,'{n}.User.internal_ref_no');


        $transactionsArray=array();
        foreach($transactions as $transaction) {

            $keyString="".$transaction['RawTradins']['order_id']."_".$transaction['RawTradins']['execution_id']."";

            $transactionsArray[$keyString]=$transaction;

        }


        $date = Hash::extract($transactionsArray,'{s}.RawTradins.execute_time');
        // $dateForWithoutHcode = Hash::extract($transactionsArrayforWithoutHcode,'{s}.RawTradins.execute_time');

        $clientCode = Hash::extract($transactionsArray,'{s}.RawTradins.client_ac');
        // $clientCodeForWithoutHcode = Hash::extract($transactionsArrayforWithoutHcode,'{s}.RawTradins.client_ac');


        foreach($date as $key=>$dateString)
        {
            $temp=explode(' ',$dateString);
            $onlyDate[$key]=$temp[0];
        }

        $unicDate=array_unique($onlyDate);

        $unicClientCode=array_unique($clientCode);




        $totalTradeSummationforHcode=0;
        $totalTradeSummationforNonHcode=0;
        $totalCommissionSummationHcode=0;
        $totalCommissionSummationNonHcode=0;

        // $commissionPercentForCode=0.005;
        $commissionPercentForNonCode=0.0005;
        // $commissionPerClient=0.5;


        foreach($unicDate as $key=>$day)
        {
            $totalTradeforHcode=0;
            $totalTradeforNonHcode=0;
            $commissionForHcode=0;
            foreach($transactionsArray as $transaction)
            {
                $tempdate=explode(' ',$transaction['RawTradins']['execute_time']);
                $tradedate=$tempdate[0];



                if($day==$tradedate)
                {
                    $totalTradeforNonHcode+=($transaction['RawTradins']['execute_qty']*$transaction['RawTradins']['order_avg_price']);
//pr($transaction['RawTradins']['client_ac']);
                }

            }




            // $commissionForHcode=($totalTradeforHcode*$commissionPercentForCode);
            $commissionForNonHcode=($totalTradeforNonHcode*$commissionPercentForNonCode);

            // $totalTradeSummationforHcode+=$totalTradeforHcode;
            $totalTradeSummationforNonHcode+=$totalTradeforNonHcode;

            //$totalCommissionSummationHcode+=$commissionForHcode;
            $totalCommissionSummationNonHcode+=$commissionForNonHcode;

            $dataPerDay[$key]['date']=$day;
            // $dataPerDay[$key]['tradeAmountHcode']=$totalTradeforHcode;
            $dataPerDay[$key]['tradeAmountNonHcode']=$totalTradeforNonHcode;
            // $dataPerDay[$key]['commissionHcode']=$commissionForHcode;
            $dataPerDay[$key]['commissionNonHcode']=$commissionForNonHcode;


        }

       // pr($dataPerDay);
      //  exit;

        // $dataTotalForDays['totalTradeSummationHcode']=$totalTradeSummationforHcode;
        $dataTotalForDays['totalTradeSummationNonHcode']=$totalTradeSummationforNonHcode;
        // $dataTotalForDays['totalCommissionSummationHcode']=$totalCommissionSummationHcode;
        $dataTotalForDays['totalCommissionSummationNonHcode']=$totalCommissionSummationNonHcode;



        $this->set('dataPerDay',$dataPerDay);
        $this->set('dataTotalForDays',$dataTotalForDays);


        $totalTradeSummationClientHcode=0;
        $totalTradeSummationNonClientNonHcode=0;
        $totalCommissionSummationClientHcode=0;
        $totalCommissionSummationClientNonHcode=0;
        //$commissionHcode=0;

        $commissionPer=0;

        foreach($unicClientCode as $key=>$client)
        {
            $totalTradeClientHcode=0;
            $totalTradeClientNonHcode=0;


            //$clientDetailsDataHcode[$client][$key1]['total_trade_sum']=0;
            //$clientDetailsDataNonHcode[$client][$key1]['total_trade_sum']=0;
            foreach($transactionsArray as $key1=>$transaction)
            {
                $tempCode=$transaction['RawTradins']['client_ac'];


                if($client==$tempCode)
                {
                    $tempdate=explode(' ',$transaction['RawTradins']['execute_time']);

                    $tradedate=$tempdate[0];
                    $tradetime=$tempdate[1];

                    $clientDetailsDataNonHcode[$client][$key1]['code'] = $transaction['RawTradins']['client_ac'];
                    $clientDetailsDatNonaHcode[$client][$key1]['date'] = $tradedate;
                    $clientDetailsDataNonHcode[$client][$key1]['instrument'] = $transaction['RawTradins']['symbol'];
                    $clientDetailsDataNonHcode[$client][$key1]['trade_time'] = $tradetime;
                    $clientDetailsDataNonHcode[$client][$key1]['trade_type'] = $transaction['RawTradins']['side'];
                    $clientDetailsDataNonHcode[$client][$key1]['price'] = $transaction['RawTradins']['order_avg_price'];
                    $clientDetailsDataNonHcode[$client][$key1]['quantity'] = $transaction['RawTradins']['execute_qty'];
                    $clientDetailsDataNonHcode[$client][$key1]['order_ref_no'] = $transaction['RawTradins']['order_id'];
                    $clientDetailsDataNonHcode[$client][$key1]['total_trade'] = $transaction['RawTradins']['order_avg_price'] * $transaction['RawTradins']['execute_qty'];
                    // $clientDetailsDataNonHcode[$client][$key1]['total_trade_sum']+=2;


                    $totalTradeClientNonHcode += ($transaction['RawTradins']['execute_qty'] * $transaction['RawTradins']['order_avg_price']);





                }

            }


            // $commissionHcode=($totalTradeClientHcode*$commissionPer);
            $commissionNonHcode=($totalTradeClientNonHcode*$commissionPercentForNonCode);

            // $totalTradeSummationClientHcode+=$totalTradeClientHcode;
            $totalTradeSummationNonClientNonHcode+=$totalTradeClientNonHcode;


            // $totalCommissionSummationClientHcode+=$commissionHcode;
            $totalCommissionSummationClientNonHcode+=$commissionNonHcode;

            $dataPerNonHClient[$key]['client'] = $client;
            $dataPerNonHClient[$key]['tradeAmountNonHcode'] = $totalTradeClientNonHcode;
            $dataPerNonHClient[$key]['commissionNonHcode'] = $commissionNonHcode;
            $dataPerNonHClient[$key]['commissionPerNonH'] = $commissionPercentForNonCode;
            //  $commissionHcode=array();
            //   $commissionNonHcode=array();
            // $dataPerDay[$key]['commission']=$commission;


        }

        // $dataTotalForClient['totalTradeSummationHcode']=$totalTradeSummationClientHcode;
        $dataTotalForClient['totalTradeSummationNonHcode']=$totalTradeSummationNonClientNonHcode;
        // $dataTotalForClient['totalCommissionSummationHcode']=$totalCommissionSummationClientHcode;
        $dataTotalForClient['totalCommissionSummationNonHcode']=$totalCommissionSummationClientNonHcode;



        // $this->set('dataPerHClient',$dataPerHClient);
        $this->set('dataPerNonHClient',$dataPerNonHClient);
        $this->set('dataTotalForClient',$dataTotalForClient);
        // $this->set('clientDetailsData',$clientDetailsDataHcode);
        //  $this->set('nonOmoUser',$nonOmoUser);


    }

    function billingReportSharp($paramData)
    { Configure::write('debug', 2);
        $parameters=explode(',',$paramData);

        $brokerHouse =$parameters[2];
        $bro_id=$this->Auth->user('broker_id');

        if ($brokerHouse != $bro_id) {
            echo "This is not your house";
            exit;
        }


        $dateForm =$parameters[0];
        $s_date=explode(' ',$dateForm);
        $dateForm=$s_date[0];
        $dateForm="".$dateForm." 1:00:00";

        $dateTo = $parameters[1];
        $e_date=explode(' ',$dateTo);
        $dateTo=$e_date[0];
        $dateTo="".$dateTo." 23:59:00";



        // $billName=$_POST['billName'];





        $userModel = ClassRegistry::init('User');
       $sharpOmoUsersCode = $userModel->find('all', array("conditions"=>array("User.broker_id" =>$bro_id),'fields'=>array('internal_ref_no','broker_id','broker_fee'),'order'=>array('User.internal_ref_no ASC'),'recursive' => -1));
       // $online_user_code = Hash::combine($sharpOmoUsersCode, '{n}.User.internal_ref_no','{n}.User.broker_fee');
        $sharpOnlineUser = Hash::extract($sharpOmoUsersCode,'{n}.User.internal_ref_no');
        $RawTradeinsModel = ClassRegistry::init('RawTradins');
        $transactions = $RawTradeinsModel->find('all', array("conditions"=>array("RawTradins.execute_time BETWEEN ? and ?" => array($dateForm, $dateTo),"RawTradins.client_ac"=>$sharpOnlineUser,"RawTradins.broker_id"=>$bro_id),'order'=>array('RawTradins.execute_time ASC'),'recursive' => -1) );


        $transactionsArray=array();
        foreach($transactions as $transaction) {

            $keyString="".$transaction['RawTradins']['order_id']."_".$transaction['RawTradins']['execution_id']."";

            $transactionsArray[$keyString]=$transaction;

        }


        $date = Hash::extract($transactionsArray,'{s}.RawTradins.execute_time');
        $clientCode = Hash::extract($transactionsArray,'{s}.RawTradins.client_ac');


        foreach($date as $key=>$dateString)
        {
            $temp=explode(' ',$dateString);
            $onlyDate[$key]=$temp[0];
        }

        $unicDate=array_unique($onlyDate);

        $unicClientCode=array_unique($clientCode);




        $totalTradeSummationforcode=0;
        $totalCommissionSummationcode=0;

        foreach($unicDate as $key=>$day)
        {
            $totalTradeforcode=0;
          //  $totalTradeforNonHcode=0;
            $commissionForcode=0;
            foreach($transactionsArray as $transaction)
            {
                $tempdate=explode(' ',$transaction['RawTradins']['execute_time']);
                $tradedate=$tempdate[0];

                if($day==$tradedate)
                {

                          $irn=$transaction['RawTradins']['client_ac'];
                          $irn = ltrim($irn, '0');

                          $clientTransaction=($transaction['RawTradins']['execute_qty']*$transaction['RawTradins']['order_avg_price']);


                              $comm=($clientTransaction*.05)/100;


                          $commissionForcode+=$comm;
                          $totalTradeforcode+=$clientTransaction;




                }

            }


            // $commissionForcode=($totalTradeforcode*$commissionPercentForCode);

             $totalTradeSummationforcode+=$totalTradeforcode;

            $totalCommissionSummationcode+=$commissionForcode;


             $dataPerDay[$key]['date']=$day;
             $dataPerDay[$key]['tradeAmountcode']=$totalTradeforcode;
             $dataPerDay[$key]['commissioncode']=$commissionForcode;



        }

         $dataTotalForDays['totalTradeSummationcode']=$totalTradeSummationforcode;
        $dataTotalForDays['totalCommissionSummationcode']=$totalCommissionSummationcode;




        $this->set('dataPerDay',$dataPerDay);
        $this->set('dataTotalForDays',$dataTotalForDays);


        $totalTradeSummationClientcode=0;
        $totalCommissionSummationClientcode=0;

        $commissionPer=0;

        foreach($unicClientCode as $key=>$client)
        {
            $totalTradeClientcode=0;

            foreach($transactionsArray as $key1=>$transaction)
            {
                $tempCode=$transaction['RawTradins']['client_ac'];


                if($client==$tempCode)
                {
                    $tempdate=explode(' ',$transaction['RawTradins']['execute_time']);

                    $tradedate=$tempdate[0];
                    $tradetime=$tempdate[1];


                        $clientDetailsDatacode[$client][$key1]['code']=$transaction['RawTradins']['client_ac'];
                        $clientDetailsDatacode[$client][$key1]['date']=$tradedate;
                        $clientDetailsDatacode[$client][$key1]['instrument']=$transaction['RawTradins']['symbol'];
                        $clientDetailsDatacode[$client][$key1]['trade_time']=$tradetime;
                        $clientDetailsDatacode[$client][$key1]['trade_type']=$transaction['RawTradins']['side'];
                        $clientDetailsDatacode[$client][$key1]['price']=$transaction['RawTradins']['order_avg_price'];
                        $clientDetailsDatacode[$client][$key1]['quantity']=$transaction['RawTradins']['execute_qty'];
                        $clientDetailsDatacode[$client][$key1]['order_ref_no']=$transaction['RawTradins']['order_id'];
                        $clientDetailsDatacode[$client][$key1]['total_trade']=$transaction['RawTradins']['order_avg_price']*$transaction['RawTradins']['execute_qty'];
                        // $clientDetailsDatacode[$client][$key1]['total_trade_sum']+=2;

                        $irn=$transaction['RawTradins']['client_ac'];
                        $irn = ltrim($irn, '0');

                        $commissionPer=0.05/100;
                        $totalTradeClientcode+=($transaction['RawTradins']['execute_qty']*$transaction['RawTradins']['order_avg_price']);





                }

            }


             $commissioncode=($totalTradeClientcode*$commissionPer);

             $totalTradeSummationClientcode+=$totalTradeClientcode;


             $totalCommissionSummationClientcode+=$commissioncode;



                $dataPerClient[$key]['client']=$client;
                $dataPerClient[$key]['tradeAmountcode']=$totalTradeClientcode;
                $dataPerClient[$key]['commissioncode']=$commissioncode;
                $dataPerClient[$key]['commissionPer']=$commissionPer;

        }

         $dataTotalForClient['totalTradeSummationcode']=$totalTradeSummationClientcode;

        $dataTotalForClient['totalCommissionSummationcode']=$totalCommissionSummationClientcode;




         $this->set('dataPerClient',$dataPerClient);

        $this->set('dataTotalForClient',$dataTotalForClient);
         $this->set('clientDetailsData',$clientDetailsDatacode);



    }

    function newOldCombinationClient()
    {
        Configure::write('debug', 2);
       // $StockBangladesh = $this->Components->load('StockBangladesh');
        $old_file_path = 'files/uploads/reports/oldfile.csv';
        $new_file_path = 'files/uploads/reports/newfile.csv';
       // $fileArr = $StockBangladesh->scan_dir($bonus_file_path);
       // $fullFilePath = "$bonus_file_path/" . $fileArr[0];

        $fileOld = fopen($old_file_path, "r");
        $array_data_old = array();

        while (!feof($fileOld)) {
            $row = fgetcsv($fileOld);


            $array_data_old[]=$row;

        }

unset( $array_data_old[131]);
        $array_data_old_transaction = Hash::combine($array_data_old, '{n}.0','{n}.1');
        $array_data_old_commission = Hash::combine($array_data_old, '{n}.0','{n}.2');

        pr(count($array_data_old_transaction));
        pr(count($array_data_old_commission));

        $fileNew = fopen($new_file_path, "r");
        $array_data_new = array();

        while (!feof($fileNew)) {
            $row1 = fgetcsv($fileNew);


            $array_data_new[]=$row1;

        }


        foreach($array_data_new as $newData)
        {
            $irn=$newData[0];
            if(isset($array_data_old_transaction[$irn]))
            {
                $array_data_old_transaction[$irn]+=$newData[1];
                $array_data_old_commission[$irn]+=$newData[2];
            }
            else
            {
                $array_data_old_transaction=Hash::insert($array_data_old_transaction,$irn, $newData[1]);
                $array_data_old_commission=Hash::insert($array_data_old_commission,$irn, $newData[2]);
            }
        }

        $totaltrade=0;
        $totalcom=0;
        $i=0;
        $j=0;
        foreach($array_data_old_transaction as $tran)
        {

            $totaltrade+=$tran;
            $i++;
        }
        foreach($array_data_old_commission as $com)
        {
            $totalcom+=$com;
            $j++;
        }
        $this->set('array_data_old_transaction',$array_data_old_transaction);
        $this->set('array_data_old_commission',$array_data_old_commission);
        $this->set('totaltrade',$totaltrade);
        $this->set('totalcom',$totalcom);
       /* pr(count($array_data_old_transaction));
        pr(count($array_data_old_commission));
        pr($i);
        pr($totaltrade);
        pr($j);
        pr($totalcom);
       // pr($array_data_new);
        exit;*/

    }

    function newOldCombinationDate()
    {
        Configure::write('debug', 2);
        // $StockBangladesh = $this->Components->load('StockBangladesh');
        $old_file_path = 'files/uploads/reports/oldfiledate.csv';
        $new_file_path = 'files/uploads/reports/newfiledate.csv';
        // $fileArr = $StockBangladesh->scan_dir($bonus_file_path);
        // $fullFilePath = "$bonus_file_path/" . $fileArr[0];

        $fileOld = fopen($old_file_path, "r");
        $array_data_old = array();

        while (!feof($fileOld)) {
            $row = fgetcsv($fileOld);


            $array_data_old[]=$row;

        }

        unset( $array_data_old[21]);
        $array_data_old_transaction = Hash::combine($array_data_old, '{n}.0','{n}.1');
        $array_data_old_commission = Hash::combine($array_data_old, '{n}.0','{n}.2');

     //   pr(count($array_data_old_transaction));
      //  pr(count($array_data_old_commission));

      //  pr($array_data_old_transaction);
      //  pr($array_data_old_commission);

       // exit;

        $fileNew = fopen($new_file_path, "r");
        $array_data_new = array();

        while (!feof($fileNew)) {
            $row1 = fgetcsv($fileNew);


            $array_data_new[]=$row1;

        }


        foreach($array_data_new as $newData)
        {
            $irn=$newData[0];
            if(isset($array_data_old_transaction[$irn]))
            {
                $array_data_old_transaction[$irn]+=$newData[1];
                $array_data_old_commission[$irn]+=$newData[2];
            }
            else
            {
                $array_data_old_transaction=Hash::insert($array_data_old_transaction,$irn, $newData[1]);
                $array_data_old_commission=Hash::insert($array_data_old_commission,$irn, $newData[2]);
            }
        }

        $totaltrade=0;
        $totalcom=0;
        $i=0;
        $j=0;
        foreach($array_data_old_transaction as $tran)
        {

            $totaltrade+=$tran;
            $i++;
        }
        foreach($array_data_old_commission as $com)
        {
            $totalcom+=$com;
            $j++;
        }

        $this->set('array_data_old_transaction',$array_data_old_transaction);
        $this->set('array_data_old_commission',$array_data_old_commission);
        $this->set('totaltrade',$totaltrade);
        $this->set('totalcom',$totalcom);

    }

    function readXML()
    {
        Configure::write('debug', 2);
        //$xml = Xml::build('files/uploads/reports/trades-SNM.xml', array('return' => 'domdocument'));
        $xml=Xml::toArray(Xml::build('files/uploads/reports/trades-SNM.xml'));
      $i=0;
        foreach ($xml['Trades']['Detail'] as $row)
        {  if($i>6)
                break;
            pr($row['@Quantity']);
            $i++;

        }
        pr($xml);
        exit;

    }

    function updatePassword()
    {
        Configure::write('debug', 2);
       // pr(mysql_connect());
      //  exit;
        $userModel = ClassRegistry::init('User');
        $UsersCode = $userModel->find('all', array("conditions"=>array("User.broker_id" =>11,"User.internal_ref_no" =>'H136'),'recursive' => -1));
        pr($UsersCode);

      //  $query="UPDATE users SET password='0967db960f3ffaeccfc504e50e279db436344759'WHERE broker_id=11 AND internal_ref_no='H136'";

      //  $result = mysql_query($query) or die();
      /* /*$userModel->updateAll(
            array('User.password' => "123456"),
            array('User.internal_ref_no' => 'H136','User.broker_id' =>11)
        );

        $UsersCode = $userModel->find('all', array("conditions"=>array("User.broker_id" =>11,"User.internal_ref_no" =>'H136'),'recursive' => -1));
        pr($UsersCode);*/
        exit;


    }

    function agentRegistration()
    {
       

    }

    function brokerAdd()
    {
        Configure::write('debug', 2);
        $PortfolioModel = ClassRegistry::init('Portfolio');
        $userModel = ClassRegistry::init('User');
        $portfolioCode = $PortfolioModel->find('all', array("conditions"=>array("Portfolio.broker" =>''),'recursive' => -1));


        $idArray=array();
        foreach($portfolioCode as $key=>$prot)
        {
            $idArray[]=$prot['Portfolio']['id'];
        }

        pr($idArray);
        $userCode = $userModel->find('all', array("conditions"=>array("User.id" =>$idArray)));

       /* $this->Baker->updateAll(
            array('Baker.approved' => true),
            array('Baker.created <=' => $thisYear)
        );*/

        pr($userCode);
        exit;
    }

    function billingReportFis($paramData)
    {
        //Configure::write('debug', 2);
        $parameters=explode(',',$paramData);

        $brokerHouse =$parameters[2];
        $bro_id=$this->Auth->user('broker_id');

        if ($brokerHouse != $bro_id) {
            echo "This is not your house";
            exit;
        }

        $Omo = $this->Components->load('Omo');

        $userList = $Omo->getUsersList(4, 1);
        $brokerUsers = array();
        foreach ($userList[$bro_id] as $irn => $arr) {
            $key = trim($irn);
            $key = str_pad($key, 6, "0", STR_PAD_LEFT);
            $key = strtoupper($key);
            $brokerUsers[$key] = $arr;
        }

        $dateForm =$parameters[0];
        $s_date=explode(' ',$dateForm);
        $dateForm=$s_date[0];
        $dateForm="".$dateForm." 1:00:00";

        $dateTo = $parameters[1];
        $e_date=explode(' ',$dateTo);
        $dateTo=$e_date[0];
        $dateTo="".$dateTo." 23:59:00";



        // $billName=$_POST['billName'];

        $RawTradeinsModel = ClassRegistry::init('RawTradins');
        $transactions = $RawTradeinsModel->find('all', array("conditions"=>array("RawTradins.execute_time BETWEEN ? and ?" => array($dateForm, $dateTo),"RawTradins.broker_id"=>$bro_id),'order'=>array('RawTradins.execute_time ASC'),'recursive' => -1) );
        $transactions_grouped=Hash::combine($transactions, '{n}.RawTradins.execution_id', '{n}.RawTradins','{n}.RawTradins.order_id');

//pr($transactions_grouped);

        /*$report=array();
        foreach($transactions_grouped as $order_id=>$all_transaction_of_this_order)
        {
            foreach($all_transaction_of_this_order as $execution_id=>$trans)
            {
                $temp=array();

                $irn = $trans['client_ac'];
                $irn = str_pad($irn, 6, "0", STR_PAD_LEFT);
                $irn = strtoupper($irn);

                if(isset($brokerUsers[$irn]))
                {
                    $temp['client_ac']=$irn;
                    $temp['symbol']=$trans['symbol'];
                    $temp['side']=$trans['side'];  // buy or sell
                    $temp['execute_qty']=$trans['execute_qty'];
                    $temp['execute_price']=$trans['execute_price'];
                    $temp['execute_time']=$trans['execute_time'];
                    $temp['execution_id']=$trans['execution_id'];
                    $temp['order_id']=$trans['order_id'];

                    $report[$irn][]=$temp;
                }


            }

        }*/


        $report = array();
        foreach ($transactions_grouped as $order_id => $all_transaction_of_this_order) {
            foreach ($all_transaction_of_this_order as $execution_id => $trans) {
                $temp = array();

                $irn = $trans['client_ac'];
                $irn = str_pad($irn, 6, "0", STR_PAD_LEFT);
                $irn = strtoupper($irn);

                if (isset($brokerUsers[$irn])) {

                    if(!isset($report[$irn]['total_trade']))
                    {
                        $report[$irn]['total_trade']=0;
                    }
                    $temp['client_ac'] = $irn;
                    $temp['symbol'] = $trans['symbol'];
                    $temp['side'] = $trans['side'];  // buy or sell
                    $temp['execute_qty'] = $trans['execute_qty'];
                    $temp['execute_price'] = $trans['execute_price'];
                    $temp['execute_time'] = $trans['execute_time'];
                    $temp['execution_id'] = $trans['execution_id'];
                    $temp['order_id'] = $trans['order_id'];

                    $report[$irn]['total_trade'] += $trans['execute_qty']* $trans['execute_price'];
                    $report[$irn]['commission'] = $report[$irn]['total_trade']*.0005;
                }


            }

        }


     //   pr($report);
        $this->set('report',$report);

      //  exit;

        // $this->set('dataPerHClient',$dataPerHClient);
       // $this->set('dataPerNonHClient',$dataPerNonHClient);
       // $this->set('dataTotalForClient',$dataTotalForClient);
        // $this->set('clientDetailsData',$clientDetailsDataHcode);
        //  $this->set('nonOmoUser',$nonOmoUser);


    }


}
