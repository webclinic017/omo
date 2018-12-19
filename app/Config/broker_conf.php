<?php
/*Example of read configuration
$globalCss = Configure::read('css.global');


array(
    array(
        'title' => 'Home',
        'url' => array('controller' => 'markets', 'action' => 'home'),
    )
 )


*/
//  for Apex
// apex broker id=11

$config['broker']['apex'] = array(
    'id' => 11,
    'portfolios_file_path' => 'apex/portfolio',
    'tradeins_file_path' => 'apex/tradeins',
    'balance_file_path' => 'apex/balance',
    'margin_file_path' => 'apex/margin',
    'margin2_file_path' => 'apex/margin2',
    'withdraw_file_path' => 'apex/withdraw',
    'deposit_file_path' => 'apex/deposit',
    'realized_file_path' => 'apex/total_realized',
    'bonus_path' => 'apex/bonus_right',
    'ipo_path' => 'apex/ipo',
);

$config['broker']['allowed_ip'][11][] ='202.53.175.238'; //Agni
$config['broker']['allowed_ip'][11][] ='202.125.72.110'; //grameen
$config['broker']['allowed_ip'][11][] ='120.50.8.219'; //apex office gulshan
$config['broker']['allowed_ip'][11][] ='202.40.179.78'; //apex office gulshan
$config['broker']['allowed_ip'][11][] ='103.96.105.164'; //jahanara garden

$config['broker']['allowed_ip'][11][] ='120.50.8.218';



//  for HAC Securities
// hac broker id=5

$config['broker']['hac'] = array(
    'id' => 5,
    'portfolios_file_path' => 'hac/portfolio',
    'tradeins_file_path' => 'hac/tradeins',
    'balance_file_path' => 'hac/balance',
    'execute_file_path' => 'hac/execute',
    'margin_file_path' => 'hac/margin',
    'loan_file_path' => 'hac/loan',
    'withdraw_file_path' => 'hac/withdraw',
    'deposit_file_path' => 'hac/deposit',
    'realized_file_path' => 'hac/total_realized',
    'ledger_path' => 'hac/ledger',
    'bonus_path' => 'hac/bonus_right',
    'ipo_path' => 'hac/ipo',
);

$config['broker']['allowed_ip'][5][] ='202.53.175.238';  //agni
$config['broker']['allowed_ip'][5][] ='202.125.72.110';  // grameen
$config['broker']['allowed_ip'][5][] ='103.231.161.72';  // grameen






//for commerce
// commerce broker id=12

$config['broker']['commerce'] = array(
    'id' => 12,
    'portfolios_file_path' => 'commerce/portfolio',
    'tradeins_file_path' => 'commerce/tradeins',
    'balance_file_path' => 'commerce/balance',
    'bonus_path' => 'commerce/bonus_right',
    'ipo_path' => 'commerce/ipo',
    'execute_file_path' => 'commerce/execute'

);

$config['broker']['allowed_ip'][12][] ='202.53.175.238';  //agni
$config['broker']['allowed_ip'][12][] ='202.125.72.110';  //grameen
$config['broker']['allowed_ip'][12][] ='120.50.18.244';
$config['broker']['allowed_ip'][12][] ='120.50.18.242';



// for sharp
// sharp broker id=6

$config['broker']['sharp'] = array(
    'id' => 6,
    'portfolios_file_path' => 'sharp/portfolio',
    'tradeins_file_path' => 'sharp/tradeins',
    'balance_file_path' => 'sharp/balance',
    'execute_file_path' => 'sharp/execute',
    'bonus_path' => 'sharp/bonus_right',
    'ipo_path' => 'sharp/ipo',
    'bonus_file_path' => 'sharp/bonus',

);

$config['broker']['allowed_ip'][6][] ='202.53.175.238';  //agni
$config['broker']['allowed_ip'][6][] ='202.125.72.110';  //grameen
$config['broker']['allowed_ip'][6][] ='103.230.105.16';
$config['broker']['allowed_ip'][6][] ='123.0.18.130';
$config['broker']['allowed_ip'][6][] ='119.30.35.114';
$config['broker']['allowed_ip'][6][] ='119.30.39.120'; //variable



// for sharp-kawran bazar
// sharp broker id=3

$config['broker']['sbsharp'] = array(
    'id' => 3,
    'portfolios_file_path' => 'sbsharp/portfolio',
    'tradeins_file_path' => 'sbsharp/tradeins',
    'balance_file_path' => 'sbsharp/balance',
    'execute_file_path' => 'sbsharp/execute',
    'bonus_path' => 'sbsharp/bonus_right',
    'ipo_path' => 'sbsharp/ipo',
    'bonus_file_path' => 'sbsharp/bonus',

);

$config['broker']['allowed_ip'][3][] ='202.53.175.238';  //agni
$config['broker']['allowed_ip'][3][] ='202.125.72.110';  // grameen
$config['broker']['allowed_ip'][3][] ='180.234.49.138';  // quebee




// for Fakhrul Islam Securities
// fis broker id=9

$config['broker']['fis'] = array(
    'id' => 9,
    'portfolios_file_path' => 'fis/portfolio',
    'tradeins_file_path' => 'fis/tradeins',
    'balance_file_path' => 'fis/balance',
    'execute_file_path' => 'fis/execute',
    'bonus_path' => 'fis/bonus_right',
    'ipo_path' => 'fis/ipo',
    'bonus_file_path' => 'fis/bonus',

);

$config['broker']['allowed_ip'][9][] = '202.53.175.238';  //agni
$config['broker']['allowed_ip'][9][] = '202.125.72.110';  // grameen
$config['broker']['allowed_ip'][9][] = '180.234.49.138';  // quebee
$config['broker']['allowed_ip'][9][] = '27.147.131.189';  // Fakhrul gulshan
$config['broker']['allowed_ip'][9][] = '45.251.56.82';  // Fakhrul 

$config['broker']['allow_z_category_purchase_power'][11]= 0;   //apex
$config['broker']['allow_z_category_purchase_power'][5]= 0;   // hac
$config['broker']['allow_z_category_purchase_power'][12]= 0;  //commerce
$config['broker']['allow_z_category_purchase_power'][6]= 0;  //sharp
$config['broker']['allow_z_category_purchase_power'][3]= 0;  //sbsharp
$config['broker']['allow_z_category_purchase_power'][9]= 1;  //fis


