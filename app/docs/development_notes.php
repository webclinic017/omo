<?php
pr(Hash::extract($lastTradeInfo, 'DataBanksIntraday.{n}[instrument_code=/FDGDFG/]'));
pr(Hash::extract($lastTradeInfo, 'DataBanksIntraday.{s}.lm_date_time'));
pr(Hash::extract($lastTradeInfo, 'DataBanksIntraday.{s}.id'));

//print first element of array
pr(array_values($lastTradeInfo['DataBanksIntraday'])[0]['lm_date_time']);

//print last element of array
pr(end($lastTradeInfo['DataBanksIntraday'])['lm_date_time']);

pr(Hash::combine($lastTradeInfo, 'DataBanksIntraday.{n}.instrument_code', 'DataBanksIntraday.{n}[instrument_code]'));
pr(Hash::combine(Hash::sort(Hash::extract($lastTradeInfo, 'DataBanksIntraday.{n}'), '{n}.id', 'asc'), 'DataBanksIntraday.{n}.instrument_code', 'DataBanksIntraday.{n}[instrument_code]'));


pr(Hash::extract($lastTradeInfo, 'DataBanksIntraday.{n}[change<0]'));
pr(Hash::sort(Hash::extract($lastTradeInfo, 'DataBanksIntraday.{n}'), '{n}.id', 'asc'));
pr(Hash::combine(Hash::sort(Hash::extract($lastTradeInfo, 'DataBanksIntraday.{n}'), '{n}.id', 'asc'), '{n}.instrument_code', '{n}'));
pr(Hash::extract($lastTradeInfo, 'IndexValue.{n}[index_id=2]'));
pr(Configure::read('EXCHANGE_ID'));
pr(Hash::apply($lastTradeInfo, 'DataBanksIntraday.{n}[change<0]', 'count'));
$arr = Hash::map($lastTradeInfo, 'DataBanksIntraday.{n}[instrument_code]', function($newArr) {
    return $newArr['name'];
});
pr($arr);


pr( CakeTime::dayAsSql('2013-12-19 11:00', 'lm_date_time'));
?>

highchart demo
============
http://jsfiddle.net/zqvNq/1/

select data within a minute range
===================================
SELECT *  FROM `data_banks_intradays` WHERE (lm_date_time >= '2013-12-19 14:24:00') AND (lm_date_time <= '2013-12-19 14:24:59')

set primary key order by desc by defult
===========================================
ALTER TABLE `index_values` ORDER BY `id` DESC ;
(it can be done from phpmyadmin operation tab)

copy a column into another
=====================================
UPDATE `data_banks_intradays` SET `trade_time`=`lm_date_time`

**** Saving datbase using Model may cause problem with cache (specially new field). Clear it
**** http://www.pontikis.net/blog/auto_post_on_facebook_with_php
****




More notes at:
============================
https://docs.google.com/spreadsheet/ccc?key=0Am4tVG90Z_5qdDE1N1pHRk5oNXl5Vi1DNHFmc3ZQSFE&usp=drive_web#gid=0

wordpress integration
================================
http://www.balistupa.com/blog/2010/08/how-to-redirect-appwebrootblog-into-blog-wordpress-cakephp/
http://www.charityandbiscuits.com/blog/tutorial-convert-bootstrap-site-template-wordpress/#step1
http://stackoverflow.com/questions/15188261/single-sign-on-sso-between-wordpress-and-cakephp


datatable
===================================================================================
https://code.google.com/p/jquery-datatables-editable/wiki/Overview
https://github.com/cnizzdotcom/cakephp-datatable


<?php echo Router::url(array('controller'=>'users','action'=>'list'));?>

<?php echo Router::url('/', true);?>

get request
===========================================
$value1 = $this->params['url']['key1'];
$value2 = $this->params['url']['key2'];

$(document).ready(function()  error solution
===========================================================
http://writing.colin-gourlay.com/safely-using-ready-before-including-jquery/


..\lib\Cake\Console\cake bake

../lib/Cake/Console/cake crons update_eods_and_intraday_data

setting corn of cakephp
==========================================================
chmod 755 cake (from console directory)
cd /home/stock/new/app && Console/cake crons update_eods_and_intraday_data

Debug all properties of javascript object by alert
=========================================================
alert(data.toSource())

Using jquery from view directly
===========================================================

$(function () {


});

see the executed mysql query from controller (debug must be set 2)
=====================================================================
$db =& ConnectionManager::getDataSource('default');
$db->showLog();

Sparkline tab problem
=============================================
$('.inlinesparkline').sparkline('html', {
enableTagOptions: true,
disableHiddenCheck: true,
height: '20px'
//width: '100px'
});
});

High chart tab problem
============================================================

$('body').on('shown.bs.tab', function (e) {
var target = $(e.target).attr("href") // activated tab
alert(target);
chart_collumn_gain_loser_depth.reflow()
})


or use following css in custom.css file for High chart tab problem
================================================
/* bootstrap hack: fix content width inside hidden tabs  it creates problem when use <div class="row"> inside the tab*/
.tab-content > .tab-pane,
.pill-content > .pill-pane {
display: block;     /* undo display:none          */
height: 0;          /* height:0 is also invisible */
overflow-y: hidden; /* no-overflow                */
}
.tab-content > .active,
.pill-content > .active {
height: auto;       /* let the content decide it  */
} /* bootstrap hack end */

insert sql for market
    ===========================
    INSERT INTO `markets` (`trade_date`, `is_trading_day`, `market_started`, `market_closed`, `comments`, `exchange_id`) VALUES
    ('2014-11-04', 1, '10:30:00', '14:30:00', '', 1),
    ('2014-11-05', 1, '10:30:00', '14:30:00', '', 1);


cakephp update
===================================
    $this->User->updateAll(
    array('mobileNo' => "'$MobileNo'"),
    array('email' => $email)
    );

csv generate
======================================
    SELECT * INTO OUTFILE "c:/mydata.csv"
    FIELDS TERMINATED BY ',' OPTIONALLY ENCLOSED BY '"'
    LINES TERMINATED BY "\n"
    FROM my_table;

    http://andy-carter.com/blog/exporting-data-to-a-downloadable-csv-file-with-cakephp
    https://github.com/FriendsOfCake/cakephp-csvview


email template
===============================================

    http://templates.mailchimp.com/resources/inline-css/

facebook
===============================================
    On the Facebook App page, click "edit App" then click "Advanced" in the left-hand navigation.
    Then for "Valid OAuth redirect URIs" add http://localhost:3000... or whatever you want the accepted redirect to be.
