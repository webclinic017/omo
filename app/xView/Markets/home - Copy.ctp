<?php
$activeMenuId='active_'.$this->params['controller'].'_'.$this->params['action'];
/**
ADDING CSS BY ELEMENT ( THAT IS PREVIOUSLY GROUPED SOME CSS ) TO DEFAULT LAYOUT.
IT WILL BE ADDED WHERE echo $this->fetch('css') IS CALLED IN DEFAULT LAYOUT.
*/
echo $this->element('css_element/global2');
echo $this->element('css_element/pagelevel2');
echo $this->element('css_element/theme2');

/**
ADDING DIRECTLY A CSS FROM VIEW TO DEFAULT LAYOUT CSS BLOCK. NO ECHO NEEDED. INLINE FALSE MUST BE SET.
*/

$this->Html->css('assets/css/style-metronic', null, array('inline' => false));
$this->Html->css('assets/css/pages/coming-soon', null, array('inline' => false));
$this->Html->css('assets/plugins/bootstrap-modal/css/bootstrap-modal-bs3patch', null, array('inline' => false));
$this->Html->css('assets/plugins/bootstrap-modal/css/bootstrap-modal', null, array('inline' => false));
$this->Html->css('assets/plugins/bootstrap-markdown/css/bootstrap-markdown.min', null, array('inline' => false));

?>
<?php
$this->start('countdown');
?>
<div class="col-md-5 hidden-xs hidden-sm col-md-offset-2 navbar-left">
    <button type="button" class="btn btn-lg green"><?php echo __($remainingText);?></button>
                <span class="coming-soon-countdown">
                   <span id="defaultCountdown"></span>
                </span>
</div>
<?php $this->end(); ?>

<!-- TODO: ITS ALWAYS ADDING MENUE TO THE TOP.ITS WORKING LIKE PREPEND BUT APPEND IS NOT WORKING. FIND OUT A SOLUTION -->

<?php
echo $this->element('layout_element/side_bar2');
?>

<!-- TODO: ADS MANAGEMENT FROM ADMIN SHOULD BE IMPLEMENTED -->
<!-- BEGIN TOP ADS BLOCK-->
<div class="row">
    <div class="col-md-12 hidden-xs hidden-sm">
        <?php echo $this->Html->image('assets/img/stock_bangladesh_vat_center.gif', array('class' => 'middle-footer-widget img-responsive'));?>
    </div>

</div>


<!-- END TOP ADS BLOCK-->

<div class="clearfix"></div>

<!-- BEGIN PAGE HEADER-->
<div class="row">
    <!-- BEGIN PAGE TITLE & BREADCRUMB-->
    <div class="col-md-12">
        <ul class="page-breadcrumb breadcrumb">
            <li class="btn-group">
                <button type="button" class="btn green">
                    <i class="fa fa-calendar"></i><span><?php echo $this->Time->nice($lastTradeInfo['IndexValue'][0]['date_time']);?></span>
                </button>
            </li>
            <li>
                <i class="fa fa-home"></i>
                <?php  echo $this->Html->link(__('Home'),'/');  ?>
                <i class="fa fa-angle-right"></i>
            </li>
            <li><?php  echo $this->Html->link(__('Dashboard'),'/markets/home');  ?></li>

        </ul>
        <!-- END PAGE TITLE & BREADCRUMB-->
    </div>
</div>
<!-- END PAGE HEADER-->

<!-- BEGIN Portlet PORTLET-->
<div class="portlet">
    <div class="portlet-body" >
        <div class="row">
            <div class="col-md-12">
                <input type="hidden" id="select2_sample6" class="form-control select2">
            </div>
        </div>
        <div class="row">
            <div class="col-md-12">
                <div class="btn-group btn-group-justified">

                    <a href="#a" class="btn btn-xs red" >Line chart <i class="fa fa-edit"></i></a>
                    <a href="#a" class="btn btn-xs blue" ><i class="fa fa-file-o"></i> Column chart</a>
                    <a href="#a" class="btn btn-xs green" >Area chart <i class="fa fa-font"></i></a>
                    <a href="#a" class="btn btn-xs yellow" >Scatter chart<i class="fa fa-search"></i></a>

                </div>
            </div>
        </div>
    </div>
</div>
<!-- END Portlet PORTLET-->
<!--MARKET SUMMARY  -START-->

<div class="portlet">
    <div class="portlet-title">
        <div class="caption"><i class="fa fa-reorder"></i>Market Summary</div>
        <div class="tools">
            <a href="javascript:;" class="collapse"></a>
            <?php echo $this->Html->link('','/markets/market_summary',array('class' => 'reload', 'escape' => false));  ?>
            <a href="market_summary" data-toggle="modal" class="feedback"></a>
            <a href="javascript:;" class="remove"></a>
        </div>
    </div>
    <div class="portlet-body" id="marketsmarket_summary">
        <?php echo $this->element('market_summary'); ?>
</div>
</div>

<!--MARKET SUMMARY  -END-->


<div class="clearfix"></div>

<div class="row">

    <!--DSEX, DS30 PANEL  -START-->
    <div class="col-md-6 col-sm-6">
        <div class="portlet">
            <div class="portlet-title">
                <!--<div class="caption"><i class="fa fa-reorder"></i>Index Chart</div>-->
                <a href="#" data-original-title="facebook" class="social-icon facebook"></a>
                <a href="#" data-original-title="twitter" class="social-icon twitter"></a>
                <a href="#" data-original-title="Goole Plus" class="social-icon googleplus"></a>
                <div class="tools">
                    <a href="javascript:;" class="collapse"></a>
                    <?php echo $this->Html->link('','/markets/index_chart',array('class' => 'reload', 'escape' => false));  ?>
                    <a id="ajax-demo" href="index_chart" data-toggle="modal" class="feedback"></a>
                </div>
            </div>
            <div class="portlet-body" id="marketsindex_chart">
                <?php echo $this->element('index_chart'); ?>
            </div>
        </div>

    </div>
    <!--DSEX, DS30 PANEL  -END-->
    <!--VALUE CHART -START-->
    <div class="col-md-6 col-sm-6">
        <div class="portlet">
            <div class="portlet-title">
                <a href="#" data-original-title="facebook" class="social-icon facebook"></a>
                <a href="#" data-original-title="twitter" class="social-icon twitter"></a>
                <a href="#" data-original-title="Goole Plus" class="social-icon googleplus"></a>
                <div class="tools">
                    <a href="javascript:;" class="collapse"></a>
                    <?php echo $this->Html->link('','/markets/value_chart',array('class' => 'reload', 'escape' => false));  ?>
                    <a href="volume_chart" data-toggle="modal" class="feedback"></a>
                </div>
            </div>
            <div class="portlet-body" id="marketsvalue_chart">
                <?php echo $this->element('value_chart'); ?>
            </div>
        </div>
        <!--VALUE CHART -END-->
        <!--TRADE CHART -START-->
        <div class="portlet">
            <div class="portlet-title">
                <a href="#" data-original-title="facebook" class="social-icon facebook"></a>
                <a href="#" data-original-title="twitter" class="social-icon twitter"></a>
                <a href="#" data-original-title="Goole Plus" class="social-icon googleplus"></a>
                <div class="tools">
                    <a href="javascript:;" class="collapse"></a>
                    <?php echo $this->Html->link('','/markets/trade_chart',array('class' => 'reload', 'escape' => false));  ?>
                    <a href="index chart" data-toggle="modal" class="feedback"></a>
                </div>
            </div>
            <div class="portlet-body" id="marketstrade_chart">
                <?php echo $this->element('trade_chart'); ?>
            </div>
        </div>

        <!--TRADE CHART -END-->
    </div>

</div>

<div class="clearfix"></div>

<div class="row ">
<!--MARKET COMMENTARY PANEL  -START-->
<div class="col-md-12 col-sm-12">
<div class="portlet box blue">
<div class="portlet-title">
    <div class="caption">
        <i class="fa fa-bell-o"></i>Market Commentary
    </div>
    <div class="actions">
        <div class="btn-group">
            <a class="btn btn-sm default" href="#" data-toggle="dropdown" data-hover="dropdown" data-close-others="true">
                Filter By <i class="fa fa-angle-down"></i>
            </a>
            <div class="dropdown-menu hold-on-click dropdown-checkboxes pull-right">
                <label><input type="checkbox"/> Finance</label>
                <label><input type="checkbox" checked=""/> Membership</label>
                <label><input type="checkbox"/> Customer Support</label>
                <label><input type="checkbox" checked=""/> HR</label>
                <label><input type="checkbox"/> System</label>
            </div>
        </div>
    </div>
</div>
<div class="portlet-body">
<div class="scroller" style="height: 200px;" data-always-visible="1" data-rail-visible="0">
<ul class="feeds">
<li>
    <div class="col1">
        <div class="cont">
            <div class="cont-col1">
                <div class="label label-sm label-info">
                    <i class="fa fa-check"></i>
                </div>
            </div>
            <div class="cont-col2">
                <div class="desc">
                    You have 4 pending tasks.
														<span class="label label-sm label-warning ">
															 Take action <i class="fa fa-share"></i>
														</span>
                </div>
            </div>
        </div>
    </div>
    <div class="col2">
        <div class="date">
            Just now
        </div>
    </div>
</li>
<li>
    <a href="#">
        <div class="col1">
            <div class="cont">
                <div class="cont-col1">
                    <div class="label label-sm label-success">
                        <i class="fa fa-bar-chart-o"></i>
                    </div>
                </div>
                <div class="cont-col2">
                    <div class="desc">
                        Finance Report for year 2013 has been released.
                    </div>
                </div>
            </div>
        </div>
        <div class="col2">
            <div class="date">
                20 mins
            </div>
        </div>
    </a>
</li>
<li>
    <div class="col1">
        <div class="cont">
            <div class="cont-col1">
                <div class="label label-sm label-danger">
                    <i class="fa fa-user"></i>
                </div>
            </div>
            <div class="cont-col2">
                <div class="desc">
                    You have 5 pending membership that requires a quick review.
                </div>
            </div>
        </div>
    </div>
    <div class="col2">
        <div class="date">
            24 mins
        </div>
    </div>
</li>
<li>
    <div class="col1">
        <div class="cont">
            <div class="cont-col1">
                <div class="label label-sm label-info">
                    <i class="fa fa-shopping-cart"></i>
                </div>
            </div>
            <div class="cont-col2">
                <div class="desc">
                    New order received with
														<span class="label label-sm label-success">
															Reference Number: DR23923
														</span>
                </div>
            </div>
        </div>
    </div>
    <div class="col2">
        <div class="date">
            30 mins
        </div>
    </div>
</li>
<li>
    <div class="col1">
        <div class="cont">
            <div class="cont-col1">
                <div class="label label-sm label-success">
                    <i class="fa fa-user"></i>
                </div>
            </div>
            <div class="cont-col2">
                <div class="desc">
                    You have 5 pending membership that requires a quick review.
                </div>
            </div>
        </div>
    </div>
    <div class="col2">
        <div class="date">
            24 mins
        </div>
    </div>
</li>
<li>
    <div class="col1">
        <div class="cont">
            <div class="cont-col1">
                <div class="label label-sm label-default">
                    <i class="fa fa-bell-o"></i>
                </div>
            </div>
            <div class="cont-col2">
                <div class="desc">
                    Web server hardware needs to be upgraded.
														<span class="label label-sm label-default ">
															Overdue
														</span>
                </div>
            </div>
        </div>
    </div>
    <div class="col2">
        <div class="date">
            2 hours
        </div>
    </div>
</li>
<li>
    <a href="#">
        <div class="col1">
            <div class="cont">
                <div class="cont-col1">
                    <div class="label label-sm label-default">
                        <i class="fa fa-briefcase"></i>
                    </div>
                </div>
                <div class="cont-col2">
                    <div class="desc">
                        IPO Report for year 2013 has been released.
                    </div>
                </div>
            </div>
        </div>
        <div class="col2">
            <div class="date">
                20 mins
            </div>
        </div>
    </a>
</li>
<li>
    <div class="col1">
        <div class="cont">
            <div class="cont-col1">
                <div class="label label-sm label-info">
                    <i class="fa fa-check"></i>
                </div>
            </div>
            <div class="cont-col2">
                <div class="desc">
                    You have 4 pending tasks.
														<span class="label label-sm label-warning ">
															 Take action <i class="fa fa-share"></i>
														</span>
                </div>
            </div>
        </div>
    </div>
    <div class="col2">
        <div class="date">
            Just now
        </div>
    </div>
</li>
<li>
    <a href="#">
        <div class="col1">
            <div class="cont">
                <div class="cont-col1">
                    <div class="label label-sm label-danger">
                        <i class="fa fa-bar-chart-o"></i>
                    </div>
                </div>
                <div class="cont-col2">
                    <div class="desc">
                        Finance Report for year 2013 has been released.
                    </div>
                </div>
            </div>
        </div>
        <div class="col2">
            <div class="date">
                20 mins
            </div>
        </div>
    </a>
</li>
<li>
    <div class="col1">
        <div class="cont">
            <div class="cont-col1">
                <div class="label label-sm label-default">
                    <i class="fa fa-user"></i>
                </div>
            </div>
            <div class="cont-col2">
                <div class="desc">
                    You have 5 pending membership that requires a quick review.
                </div>
            </div>
        </div>
    </div>
    <div class="col2">
        <div class="date">
            24 mins
        </div>
    </div>
</li>
<li>
    <div class="col1">
        <div class="cont">
            <div class="cont-col1">
                <div class="label label-sm label-info">
                    <i class="fa fa-shopping-cart"></i>
                </div>
            </div>
            <div class="cont-col2">
                <div class="desc">
                    New order received with
														<span class="label label-sm label-success">
															Reference Number: DR23923
														</span>
                </div>
            </div>
        </div>
    </div>
    <div class="col2">
        <div class="date">
            30 mins
        </div>
    </div>
</li>
<li>
    <div class="col1">
        <div class="cont">
            <div class="cont-col1">
                <div class="label label-sm label-success">
                    <i class="fa fa-user"></i>
                </div>
            </div>
            <div class="cont-col2">
                <div class="desc">
                    You have 5 pending membership that requires a quick review.
                </div>
            </div>
        </div>
    </div>
    <div class="col2">
        <div class="date">
            24 mins
        </div>
    </div>
</li>
<li>
    <div class="col1">
        <div class="cont">
            <div class="cont-col1">
                <div class="label label-sm label-warning">
                    <i class="fa fa-bell-o"></i>
                </div>
            </div>
            <div class="cont-col2">
                <div class="desc">
                    Web server hardware needs to be upgraded.
														<span class="label label-sm label-default ">
															Overdue
														</span>
                </div>
            </div>
        </div>
    </div>
    <div class="col2">
        <div class="date">
            2 hours
        </div>
    </div>
</li>
<li>
    <a href="#">
        <div class="col1">
            <div class="cont">
                <div class="cont-col1">
                    <div class="label label-sm label-info">
                        <i class="fa fa-briefcase"></i>
                    </div>
                </div>
                <div class="cont-col2">
                    <div class="desc">
                        IPO Report for year 2013 has been released.
                    </div>
                </div>
            </div>
        </div>
        <div class="col2">
            <div class="date">
                20 mins
            </div>
        </div>
    </a>
</li>
</ul>
</div>
<div class="scroller-footer">
    <div class="pull-right">
        <a href="#">See All Records <i class="m-icon-swapright m-icon-gray"></i></a> &nbsp;
    </div>
</div>
</div>
</div>
</div>
<!--MARKET COMMENTARY PANEL  -END-->
</div>

<div class="clearfix"></div>

<div class="row ">
<!--TOP LIST POSITIVE  -START-->
<div class="col-md-6 col-sm-6">
<div class="portlet">
<div class="portlet-title">
    <!--<div class="caption"><i class="fa fa-reorder"></i>Index Chart</div>-->
    <a href="#" data-original-title="facebook" class="social-icon facebook"></a>
    <a href="#" data-original-title="twitter" class="social-icon twitter"></a>
    <a href="#" data-original-title="Goole Plus" class="social-icon googleplus"></a>

    <div class="tools">
        <a href="javascript:;" class="collapse"></a>
        <?php echo $this->Html->link('','/markets/index_chart',array('class' => 'reload', 'escape' => false));  ?>
        <a href="gainer_green" data-toggle="modal" class="feedback"></a>
    </div>
</div>
<div class="portlet-body flip-scroll">
<!--<div class="scroller" style="height:470px" data-always-visible="1" data-rail-visible="1" data-rail-color="red" data-handle-color="green">-->
<div class="scroller" style="height:470px" data-handle-color="green">
<div id="accordion1" class="panel-group ">
<div class="panel panel-success">
    <div class="panel-heading">
        <h4 class="panel-title">
            <a class="accordion-toggle" data-toggle="collapse" data-parent="#accordion1" href="#accordion1_1">
                <i class="fa fa-star"></i> Top Gainers (by %) </a>
        </h4>
    </div>
    <div id="accordion1_1" class="panel-collapse collapse in">
        <div class="panel-body">

        </div>
        <table class="table table-hover table-condensed flip-content">
            <thead class="flip-content">
            <tr>
                <th>
                    Code
                </th>
                <th class="numeric">
                    Change(%)
                </th>
                <th class="numeric">
                    LTP
                </th>
                <th class="numeric">
                    Volume
                </th>
                <th class="numeric">
Action
                </th>

            </tr>
            </thead>
            <tbody>
            <?php

                     $databank_change_up_arr=Hash::sort($lastTradeInfo['DataBanksIntraday'], '{s}.change_per', 'desc');
                     $i=0;

                     foreach($databank_change_up_arr as $databank_change_up){
                     $i++;
                     if($i>5)
            break;
            ?>
            <tr>
                <td>
                    <?php echo $databank_change_up['instrument_code']; ?>
                </td>
                <td class="success">
                    <?php  echo $this->Number->toPercentage($databank_change_up['change_per']); ?>
                </td>
                <td class="numeric">
                    <?php  echo $this->Number->precision($databank_change_up['close_price'],2); ?>
                </td>

                <td class="numeric">
                    <?php  echo $this->Number->precision($databank_change_up['total_volume'],0); ?>
                </td>
                <td>
                    <a class="btn default btn-xs blue-stripe" href="#">View</a>
                </td>

            </tr>
            <?php } ?>

            </tbody>
        </table>
    </div>
</div>
<div class="panel panel-success">
    <div class="panel-heading">
        <h4 class="panel-title">
            <a class="accordion-toggle" data-toggle="collapse" data-parent="#accordion1" href="#accordion1_2">
                <i class="fa fa-reorder"></i> Top Gainer (by change) </a>
        </h4>
    </div>
    <div id="accordion1_2" class="panel-collapse collapse">
        <div class="panel-body">

        </div>
        <table class="table table-hover table-condensed flip-content">
            <thead class="flip-content">
            <tr>
                <th>
                    Code
                </th>
                <th class="numeric">
                    Change
                </th>
                <th class="numeric">
                    LTP
                </th>
                <th class="numeric">
                    Volume
                </th>
                <th class="numeric">

                </th>

            </tr>
            </thead>
            <tbody>
            <?php

                     $databank_change_up_arr=Hash::sort($lastTradeInfo['DataBanksIntraday'], '{s}.change', 'desc');
                     $i=0;

                     foreach($databank_change_up_arr as $databank_change_up){
                     $i++;
                     if($i>5)
            break;
            ?>
            <tr>
                <td>
                    <?php echo $databank_change_up['instrument_code']; ?>
                </td>
                <td class="success">
                    <?php  echo $this->Number->precision($databank_change_up['change'],2); ?>
                </td>
                <td class="numeric">
                    <?php  echo $this->Number->precision($databank_change_up['close_price'],2); ?>
                </td>

                <td class="numeric">
                    <?php  echo $this->Number->precision($databank_change_up['total_volume'],0); ?>
                </td>
                <td>
                    <a class="btn default btn-xs blue-stripe" href="#">View</a>
                </td>

            </tr>
            <?php } ?>

            </tbody>
        </table>
    </div>
</div>
<div class="panel panel-success">
    <div class="panel-heading">
        <h4 class="panel-title">
            <a class="accordion-toggle" data-toggle="collapse" data-parent="#accordion1" href="#accordion1_3">
                <i class="fa fa-thumbs-up"></i>Top Volume</a>
        </h4>
    </div>
    <div id="accordion1_3" class="panel-collapse collapse">
        <div class="panel-body">

        </div>
        <table class="table table-hover table-condensed flip-content">
            <thead class="flip-content">
            <tr>
                <th>
                    Code
                </th>
                <th class="numeric">
                    Change
                </th>
                <th class="numeric">
                    LTP
                </th>
                <th class="numeric">
                    Volume
                </th>
                <th class="numeric">

                </th>

            </tr>
            </thead>
            <tbody>
            <?php

                     $databank_change_up_arr=Hash::sort($lastTradeInfo['DataBanksIntraday'], '{s}.total_volume', 'desc');
                     $i=0;

                     foreach($databank_change_up_arr as $databank_change_up){
                     $i++;
                     if($i>5)
            break;
            ?>
            <tr>
                <td>
                    <?php echo $databank_change_up['instrument_code']; ?>
                </td>
                <td class="numeric">
                    <?php  echo $this->Number->toPercentage($databank_change_up['change_per']); ?>
                </td>
                <td class="numeric">
                    <?php  echo $this->Number->precision($databank_change_up['close_price'],2); ?>
                </td>

                <td class="success">
                    <?php  echo $this->Number->precision($databank_change_up['total_volume'],0); ?>
                </td>
                <td>
                    <a class="btn default btn-xs blue-stripe" href="#">View</a>
                </td>

            </tr>
            <?php } ?>

            </tbody>
        </table>
    </div>
</div>
<div class="panel panel-success">
    <div class="panel-heading">
        <h4 class="panel-title">
            <a class="accordion-toggle" data-toggle="collapse" data-parent="#accordion1" href="#accordion1_4">
                <i class="fa fa-thumbs-up"></i>Top volume gain(%)</a>
        </h4>
    </div>
    <div id="accordion1_4" class="panel-collapse collapse">
        <div class="panel-body">

        </div>
        <table class="table table-hover table-condensed flip-content">
            <thead class="flip-content">
            <tr>
                <th>
                    Code
                </th>
                <th class="numeric">
                    Vol chg
                </th>
                <th class="numeric">
                    Tod vol
                </th>
                <th class="numeric">
                    Y vol
                </th>
                <th class="numeric">

                </th>

            </tr>
            </thead>
            <tbody>
            <?php

                     $databank_change_up_arr=Hash::sort($lastTradeInfo['DataBanksIntraday'], '{s}.y_total_volume_change_per', 'desc');
                     $i=0;

                     foreach($databank_change_up_arr as $databank_change_up){
                     $i++;
                     if($i>5)
            break;
            ?>
            <tr>
                <td>
                    <?php echo $databank_change_up['instrument_code']; ?>
                </td>
                <td class="success">
                    <?php  echo $this->Number->toPercentage($databank_change_up['y_total_volume_change_per']); ?>
                </td>
                <td class="numeric">
                    <?php  echo $this->Number->precision($databank_change_up['total_volume'],0); ?>
                </td>

                <td class="numeric">
                    <?php  echo $this->Number->precision($databank_change_up['y_total_volume'],0); ?>
                </td>
                <td>
                    <a class="btn default btn-xs blue-stripe" href="#">View</a>
                </td>

            </tr>
            <?php } ?>

            </tbody>
        </table>
    </div>
</div>
<div class="panel panel-success">
    <div class="panel-heading">
        <h4 class="panel-title">
            <a class="accordion-toggle" data-toggle="collapse" data-parent="#accordion1" href="#accordion1_5">
                <i class="fa fa-fire"></i>Top Value </a>
        </h4>
    </div>
    <div id="accordion1_5" class="panel-collapse collapse">
        <div class="panel-body">

        </div>
        <table class="table table-hover table-condensed flip-content">
            <thead class="flip-content">
            <tr>
                <th>
                    Code
                </th>
                <th class="numeric">
                    Change
                </th>
                <th class="numeric">
                    LTP
                </th>
                <th class="numeric">
                    Value(M)
                </th>
                <th class="numeric">

                </th>

            </tr>
            </thead>
            <tbody>
            <?php

                     $databank_change_up_arr=Hash::sort($lastTradeInfo['DataBanksIntraday'], '{s}.public_total_value', 'desc');
                     $i=0;

                     foreach($databank_change_up_arr as $databank_change_up){
                     $i++;
                     if($i>5)
            break;
            ?>
            <tr>
                <td>
                    <?php echo $databank_change_up['instrument_code']; ?>
                </td>
                <td class="numeric">
                    <?php  echo $this->Number->toPercentage($databank_change_up['change_per']); ?>
                </td>
                <td class="numeric">
                    <?php  echo $this->Number->precision($databank_change_up['close_price'],2); ?>
                </td>

                <td class="success">
                    <?php  echo $this->Number->precision($databank_change_up['public_total_value'],2); ?>
                </td>
                <td>
                    <a class="btn default btn-xs blue-stripe" href="#">View</a>
                </td>

            </tr>
            <?php } ?>

            </tbody>
        </table>
    </div>
</div>
<div class="panel panel-success">
    <div class="panel-heading">
        <h4 class="panel-title">
            <a class="accordion-toggle" data-toggle="collapse" data-parent="#accordion1" href="#accordion1_6">
                <i class="fa fa-bookmark"></i> Top value gainer(%) </a>
        </h4>
    </div>
    <div id="accordion1_6" class="panel-collapse collapse">
        <div class="panel-body">

        </div>
        <table class="table table-hover table-condensed flip-content">
            <thead class="flip-content">
            <tr>
                <th>
                    Code
                </th>
                <th class="numeric">
                    Change
                </th>
                <th class="numeric">
                    T Value (M)
                </th>
                <th class="numeric">
                    Y value (M)
                </th>
                <th class="numeric">

                </th>

            </tr>
            </thead>
            <tbody>
            <?php

                     $databank_change_up_arr=Hash::sort($lastTradeInfo['DataBanksIntraday'], '{s}.y_public_total_value_change_per', 'desc');
                     $i=0;

                     foreach($databank_change_up_arr as $databank_change_up){
                     $i++;
                     if($i>5)
            break;
            ?>
            <tr>
                <td>
                    <?php echo $databank_change_up['instrument_code']; ?>
                </td>
                <td class="success">
                    <?php  echo $this->Number->toPercentage($databank_change_up['y_public_total_value_change_per']); ?>
                </td>
                <td class="numeric">
                    <?php  echo $this->Number->precision($databank_change_up['public_total_value'],2); ?>
                </td>

                <td class="numeric">
                    <?php  echo $this->Number->precision($databank_change_up['y_public_total_value'],2); ?>
                </td>
                <td>
                    <a class="btn default btn-xs blue-stripe" href="#">View</a>
                </td>

            </tr>
            <?php } ?>

            </tbody>
        </table>
    </div>
</div>

</div>
</div>
</div>
</div>
</div>
<!--TOP LIST POSITIVE  -END-->
<!--TOP LIST NEGETIVE  -START-->
<div class="col-md-6 col-sm-6">
<div class="portlet">
<div class="portlet-title">
    <!--<div class="caption"><i class="fa fa-reorder"></i>Index Chart</div>-->
    <a href="#" data-original-title="facebook" class="social-icon facebook"></a>
    <a href="#" data-original-title="twitter" class="social-icon twitter"></a>
    <a href="#" data-original-title="Goole Plus" class="social-icon googleplus"></a>
    <div class="tools">
        <a href="javascript:;" class="collapse"></a>
        <?php echo $this->Html->link('','/markets/index_chart',array('class' => 'reload', 'escape' => false));  ?>
        <a href="gainer_red" data-toggle="modal" class="feedback"></a>
    </div>
</div>
<div class="portlet-body">
<div class="scroller" style="height:470px" data-handle-color="green">
<div id="accordion1r" class="panel-group">
<div class="panel panel-danger">
    <div class="panel-heading">
        <h4 class="panel-title">
            <a class="accordion-toggle" data-toggle="collapse" data-parent="#accordion1r" href="#accordion1_1r">
                <i class="fa fa-star-o"></i> Top Loosers (%) </a>
        </h4>
    </div>
    <div id="accordion1_1r" class="panel-collapse collapse in">
        <div class="panel-body">
           <!-- <div class="alert alert-danger">
                Check out the below dropdown menu. It will be opened as usual since there is enough space at the bottom.
            </div>-->
        </div>
        <table class="table table-hover table-condensed flip-content">
            <thead class="flip-content">
            <tr>
                <th>
                    Code
                </th>
                <th class="numeric">
                    Change(%)
                </th>
                <th class="numeric">
                    LTP
                </th>
                <th class="numeric">
                    Volume
                </th>
                <th class="numeric">
                    Action
                </th>

            </tr>
            </thead>
            <tbody>
            <?php

                     $databank_change_up_arr=Hash::sort($lastTradeInfo['DataBanksIntraday'], '{s}.change_per', 'asc');
                     $i=0;

                     foreach($databank_change_up_arr as $databank_change_up){
                     $i++;
                     if($i>5)
            break;
            ?>
            <tr>
                <td>
                    <?php echo $databank_change_up['instrument_code']; ?>
                </td>
                <td class="success">
                    <?php  echo $this->Number->toPercentage($databank_change_up['change_per']); ?>
                </td>
                <td class="numeric">
                    <?php  echo $this->Number->precision($databank_change_up['close_price'],2); ?>
                </td>

                <td class="numeric">
                    <?php  echo $this->Number->precision($databank_change_up['total_volume'],0); ?>
                </td>
                <td>
                    <a class="btn default btn-xs blue-stripe" href="#">View</a>
                </td>

            </tr>
            <?php } ?>

            </tbody>
        </table>
    </div>

</div>
<div class="panel panel-danger">
    <div class="panel-heading">
        <h4 class="panel-title">
            <a class="accordion-toggle" data-toggle="collapse" data-parent="#accordion1r" href="#accordion1_2r">
                <i class="fa fa-star-o"></i> Top Loosers (change) </a>
        </h4>
    </div>
    <div id="accordion1_2r" class="panel-collapse collapse">
        <div class="panel-body">

        </div>
        <table class="table table-hover table-condensed flip-content">
            <thead class="flip-content">
            <tr>
                <th>
                    Code
                </th>
                <th class="numeric">
                    Change
                </th>
                <th class="numeric">
                    LTP
                </th>
                <th class="numeric">
                    Volume
                </th>
                <th class="numeric">

                </th>

            </tr>
            </thead>
            <tbody>
            <?php

                     $databank_change_up_arr=Hash::sort($lastTradeInfo['DataBanksIntraday'], '{s}.change', 'asc');
                     $i=0;

                     foreach($databank_change_up_arr as $databank_change_up){
                     $i++;
                     if($i>5)
            break;
            ?>
            <tr>
                <td>
                    <?php echo $databank_change_up['instrument_code']; ?>
                </td>
                <td class="success">
                    <?php  echo $this->Number->precision($databank_change_up['change'],2); ?>
                </td>
                <td class="numeric">
                    <?php  echo $this->Number->precision($databank_change_up['close_price'],2); ?>
                </td>

                <td class="numeric">
                    <?php  echo $this->Number->precision($databank_change_up['total_volume'],0); ?>
                </td>
                <td>
                    <a class="btn default btn-xs blue-stripe" href="#">View</a>
                </td>

            </tr>
            <?php } ?>

            </tbody>
        </table>
    </div>
</div>
<div class="panel panel-danger">
    <div class="panel-heading">
        <h4 class="panel-title">
            <a class="accordion-toggle" data-toggle="collapse" data-parent="#accordion1r" href="#accordion1_3r">
                <i class="fa fa-star-o"></i> Trading at lowest price </a>
        </h4>
    </div>
    <div id="accordion1_3r" class="panel-collapse collapse">
        <div class="panel-body">

        </div>
        <table class="table table-bordered table-striped table-condensed flip-content">
            <thead class="flip-content">
            <tr>
                <th>
                    Code
                </th>
                <th class="numeric">
                    Price
                </th>
                <th class="numeric">
                    Change
                </th>
                <th class="numeric">
                    High
                </th>
                <th class="numeric">
                    Low
                </th>

            </tr>
            </thead>
            <tbody>
            <tr>
                <td>
                    AAC
                </td>
                <td class="numeric">
                    $1.38
                </td>
                <td class="numeric">
                    -0.01
                </td>

                <td class="numeric">
                    $1.39
                </td>
                <td class="numeric">
                    $1.38
                </td>

            </tr>
            <tr>
                <td>
                    AAD
                </td>
                <td class="numeric">
                    $1.15
                </td>
                <td class="numeric">
                    +0.02
                </td>

                <td class="numeric">
                    $1.15
                </td>
                <td class="numeric">
                    $1.13
                </td>

            </tr>

            </tbody>
        </table>
    </div>
</div>
<div class="panel panel-danger">
    <div class="panel-heading">
        <h4 class="panel-title">
            <a class="accordion-toggle" data-toggle="collapse" data-parent="#accordion1r" href="#accordion1_4r">
                <i class="fa fa-star-o"></i> Top volume looser </a>
        </h4>
    </div>
    <div id="accordion1_4r" class="panel-collapse collapse">
        <div class="panel-body">

        </div>
        <table class="table table-hover table-condensed flip-content">
            <thead class="flip-content">
            <tr>
                <th>
                    Code
                </th>
                <th class="numeric">
                    Vol chg
                </th>
                <th class="numeric">
                    Tod vol
                </th>
                <th class="numeric">
                    Y vol
                </th>
                <th class="numeric">

                </th>

            </tr>
            </thead>
            <tbody>
            <?php

                     $databank_change_up_arr=Hash::sort($lastTradeInfo['DataBanksIntraday'], '{s}.y_total_volume_change_per', 'asc');
                     $i=0;

                     foreach($databank_change_up_arr as $databank_change_up){
                     $i++;
                     if($i>5)
            break;
            ?>
            <tr>
                <td>
                    <?php echo $databank_change_up['instrument_code']; ?>
                </td>
                <td class="success">
                    <?php  echo $this->Number->toPercentage($databank_change_up['y_total_volume_change_per']); ?>
                </td>
                <td class="numeric">
                    <?php  echo $this->Number->precision($databank_change_up['total_volume'],0); ?>
                </td>

                <td class="numeric">
                    <?php  echo $this->Number->precision($databank_change_up['y_total_volume'],0); ?>
                </td>
                <td>
                    <a class="btn default btn-xs blue-stripe" href="#">View</a>
                </td>

            </tr>
            <?php } ?>

            </tbody>
        </table>
    </div>
</div>
<div class="panel panel-danger">
    <div class="panel-heading">
        <h4 class="panel-title">
            <a class="accordion-toggle" data-toggle="collapse" data-parent="#accordion1r" href="#accordion1_5r">
                <i class="fa fa-bookmark-o"></i> Top value looser </a>
        </h4>
    </div>
    <div id="accordion1_5r" class="panel-collapse collapse">
        <div class="panel-body">

        </div>
        <table class="table table-hover table-condensed flip-content">
            <thead class="flip-content">
            <tr>
                <th>
                    Code
                </th>
                <th class="numeric">
                    Change
                </th>
                <th class="numeric">
                    T Value (M)
                </th>
                <th class="numeric">
                    Y value (M)
                </th>
                <th class="numeric">

                </th>

            </tr>
            </thead>
            <tbody>
            <?php

                     $databank_change_up_arr=Hash::sort($lastTradeInfo['DataBanksIntraday'], '{s}.y_public_total_value_change_per', 'asc');
                     $i=0;

                     foreach($databank_change_up_arr as $databank_change_up){
                     $i++;
                     if($i>5)
            break;
            ?>
            <tr>
                <td>
                    <?php echo $databank_change_up['instrument_code']; ?>
                </td>
                <td class="success">
                    <?php  echo $this->Number->toPercentage($databank_change_up['y_public_total_value_change_per']); ?>
                </td>
                <td class="numeric">
                    <?php  echo $this->Number->precision($databank_change_up['public_total_value'],2); ?>
                </td>

                <td class="numeric">
                    <?php  echo $this->Number->precision($databank_change_up['y_public_total_value'],2); ?>
                </td>
                <td>
                    <a class="btn default btn-xs blue-stripe" href="#">View</a>
                </td>

            </tr>
            <?php } ?>

            </tbody>
        </table>
    </div>
</div>

</div>
</div>
</div>
</div>
</div>
<!--TOP LIST POSITIVE  -END-->

</div>

<div class="clearfix"></div>
<div class="row ">
<!--NEWS PANEL-LEFT  -START-->
<div class="col-md-6 col-sm-6">
    <!-- BEGIN SAMPLE TABLE PORTLET-->
    <div class="portlet">
        <div class="portlet-title">
            <div class="caption">
                <i class="fa fa-coffee"></i>পত্রিকা হতে সংগৃহীত খবর
            </div>
            <div class="tools">
                <a href="javascript:;" class="collapse"></a>
                <a href="#portlet-config" data-toggle="modal" class="config"></a>
                <a href="javascript:;" class="reload"></a>
                <a href="javascript:;" class="remove"></a>
            </div>
        </div>
        <div class="portlet-body flip-scroll">
            <div id="example1">
             <!--   <ul class="list-group">
                    <li class="list-group-item">
                        <div class="panel panel-info">
                            <div class="panel-heading">
                                <h3 class="panel-title">Info Panel1</h3>
                            </div>
                            <div class="panel-body">
                                Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor
                            </div>
                        </div>
                    </li>
                    <li class="list-group-item">
                        <div class="panel panel-info">
                            <div class="panel-heading">
                                <h3 class="panel-title">Info Panel1</h3>
                            </div>
                            <div class="panel-body">
                                Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor
                            </div>
                        </div>
                    </li>
                    <li class="list-group-item">
                        <div class="panel panel-info">
                            <div class="panel-heading">
                                <h3 class="panel-title">Info Panel1</h3>
                            </div>
                            <div class="panel-body">
                                Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor
                            </div>
                        </div>
                    </li>
                    <li class="list-group-item">
                        <div class="panel panel-info">
                            <div class="panel-heading">
                                <h3 class="panel-title">Info Panel1</h3>
                            </div>
                            <div class="panel-body">
                                Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor
                            </div>
                        </div>
                    </li>
                    <li class="list-group-item">
                        <div class="panel panel-info">
                            <div class="panel-heading">
                                <h3 class="panel-title">Info Panel1</h3>
                            </div>
                            <div class="panel-body">
                                Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor
                            </div>
                        </div>
                    </li>
                </ul>
-->

                <ul>
                    <li>
                        <div class="panel panel-info">
                            <div class="panel-heading">
                                <h3 class="panel-title">ব্যাংকে ঋণ প্রবৃদ্ধি কম, অলস টাকা ৯০ হাজার কোটি</h3>
                            </div>
                            <div class="panel-body">
                                স্টাফ রিপোর্টার : ঢাকা স্টক এক্সচেঞ্জের (ডিএসই) সদস্য মিকা সিকিউরিটিজকে সতর্ক বার্তা দিয়েছে নিয়ন্ত্রক সংস্থা বাংলাদেশ সিকিউরিটিজ অ্যান্ড এক্সচেঞ্জ কমিশন (বিএসইসি)। সিকিউরিটিজ আইন লঙ্ঘন করায় গত ৩১ ডিসেম্বর প্রতিষ্ঠানটির

                            </div>
                        </div>
                    </li>
                    <li>
                        <div class="panel panel-info">
                            <div class="panel-heading">
                                <h3 class="panel-title">বছরের প্রথম দিনেই শীর্ষ স্থানে টেক্সটাইল খাতি  </h3>
                            </div>
                            <div class="panel-body">
                                স্টাফ রিপোর্টার : মতিন স্পিনিং মিল কোম্পানিকে প্রাথমিক গণপ্রস্তাবের (আইপিও) অনুমোদন দেয়ায় অভিযোগ জানিয়েছে বিনিয়োগকারী সম্মিলিত জাতীয় ঐক্য। কারণ প্রতিষ্ঠানটি ৩ কোটি ৪১ লাখ শেয়ারের বিপরীতে ১২১ কোটি ১৭ লাখ টাকা উত্তোলন
                            </div>
                        </div>
                    </li>
                    <li>
                        <div class="panel panel-info">
                            <div class="panel-heading">
                                <h3 class="panel-title">বেসিক ব্যাকের শ্রেণীকৃত ঋণের পরিমাণ ১২.৪২ শতাংশ  </h3>
                            </div>
                            <div class="panel-body">
                                স্টাফ রিপোর্টার : ঢাকা স্টক এক্সচেঞ্জের (ডিএসই) সদস্য মিকা সিকিউরিটিজকে সতর্ক বার্তা দিয়েছে নিয়ন্ত্রক সংস্থা বাংলাদেশ সিকিউরিটিজ অ্যান্ড এক্সচেঞ্জ কমিশন (বিএসইসি)। সিকিউরিটিজ আইন লঙ্ঘন করায় গত ৩১ ডিসেম্বর প্রতিষ্ঠানটির
                            </div>
                        </div>
                    </li>
                </ul>
            </div>

        </div>
    </div>
    <!-- END SAMPLE TABLE PORTLET-->
</div>
<!--NEWS PANEL-LEFT  -END-->

<!--NEWS PANEL-RIGHT  -START-->
<div class="col-md-6 col-sm-6">
    <!-- BEGIN SAMPLE TABLE PORTLET-->
    <div class="portlet">
        <div class="portlet-title">
            <div class="caption">
                <i class="fa fa-coffee"></i>পত্রিকা হতে সংগৃহীত খবর
            </div>
            <div class="tools">
                <a href="javascript:;" class="collapse"></a>
                <a href="#portlet-config" data-toggle="modal" class="config"></a>
                <a href="javascript:;" class="reload"></a>
                <a href="javascript:;" class="remove"></a>
            </div>
        </div>
        <div class="portlet-body flip-scroll">
            <div id="example">
             <!--   <ul class="list-group">
                    <li class="list-group-item">
                        <div class="panel panel-info">
                            <div class="panel-heading">
                                <h3 class="panel-title">Info Panel1</h3>
                            </div>
                            <div class="panel-body">
                                Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor
                            </div>
                        </div>
                    </li>
                    <li class="list-group-item">
                        <div class="panel panel-info">
                            <div class="panel-heading">
                                <h3 class="panel-title">Info Panel1</h3>
                            </div>
                            <div class="panel-body">
                                Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor
                            </div>
                        </div>
                    </li>
                    <li class="list-group-item">
                        <div class="panel panel-info">
                            <div class="panel-heading">
                                <h3 class="panel-title">Info Panel1</h3>
                            </div>
                            <div class="panel-body">
                                Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor
                            </div>
                        </div>
                    </li>
                    <li class="list-group-item">
                        <div class="panel panel-info">
                            <div class="panel-heading">
                                <h3 class="panel-title">Info Panel1</h3>
                            </div>
                            <div class="panel-body">
                                Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor
                            </div>
                        </div>
                    </li>
                    <li class="list-group-item">
                        <div class="panel panel-info">
                            <div class="panel-heading">
                                <h3 class="panel-title">Info Panel1</h3>
                            </div>
                            <div class="panel-body">
                                Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor
                            </div>
                        </div>
                    </li>
                </ul>
-->

                <ul>
                    <li>
                        <div class="panel panel-info">
                            <div class="panel-heading">
                                <h3 class="panel-title">ব্যাংকে ঋণ প্রবৃদ্ধি কম, অলস টাকা ৯০ হাজার কোটি</h3>
                            </div>
                            <div class="panel-body">
                                স্টাফ রিপোর্টার : ঢাকা স্টক এক্সচেঞ্জের (ডিএসই) সদস্য মিকা সিকিউরিটিজকে সতর্ক বার্তা দিয়েছে নিয়ন্ত্রক সংস্থা বাংলাদেশ সিকিউরিটিজ অ্যান্ড এক্সচেঞ্জ কমিশন (বিএসইসি)। সিকিউরিটিজ আইন লঙ্ঘন করায় গত ৩১ ডিসেম্বর প্রতিষ্ঠানটির
                            </div>
                        </div>
                    </li>
                    <li>
                        <div class="panel panel-info">
                            <div class="panel-heading">
                                <h3 class="panel-title">বছরের প্রথম দিনেই শীর্ষ স্থানে টেক্সটাইল খাতি</h3>
                            </div>
                            <div class="panel-body">
                                স্টাফ রিপোর্টার : মতিন স্পিনিং মিল কোম্পানিকে প্রাথমিক গণপ্রস্তাবের (আইপিও) অনুমোদন দেয়ায় অভিযোগ জানিয়েছে বিনিয়োগকারী সম্মিলিত জাতীয় ঐক্য। কারণ প্রতিষ্ঠানটি ৩ কোটি ৪১ লাখ শেয়ারের বিপরীতে ১২১ কোটি ১৭ লাখ টাকা উত্তোলন
                            </div>
                        </div>
                    </li>
                    <li>
                        <div class="panel panel-info">
                            <div class="panel-heading">
                                <h3 class="panel-title">বেসিক ব্যাকের শ্রেণীকৃত ঋণের পরিমাণ ১২.৪২ শতাংশ</h3>
                            </div>
                            <div class="panel-body">
                                স্টাফ রিপোর্টার : ঢাকা স্টক এক্সচেঞ্জের (ডিএসই) সদস্য মিকা সিকিউরিটিজকে সতর্ক বার্তা দিয়েছে নিয়ন্ত্রক সংস্থা বাংলাদেশ সিকিউরিটিজ অ্যান্ড এক্সচেঞ্জ কমিশন (বিএসইসি)। সিকিউরিটিজ আইন লঙ্ঘন করায় গত ৩১ ডিসেম্বর প্রতিষ্ঠানটির
                            </div>
                        </div>
                    </li>
                </ul>
            </div>

        </div>
    </div>
    <!-- END SAMPLE TABLE PORTLET-->
</div>
<!--NEWS PANEL-RIGHT  -END-->
</div>


<h2><?php echo __('Posts'); ?></h2>
<?php //pr($lastTradeInfo); ?>

<?php
/**
ADDING JS BY ELEMENT ( THAT IS PREVIOUSLY GROUPED SOME JS ) TO DEFAULT LAYOUT.
IT WILL BE ADDED WHERE echo $this->fetch('script') IS CALLED IN DEFAULT LAYOUT.
*/

echo $this->element('script_element/core_script2');

/**
ADDING DIRECTLY PAGE LEVEL SCRIPT FROM VIEW TO DEFAULT LAYOUT SCRIPT BLOCK. NO ECHO NEEDED. INLINE FALSE MUST BE SET.
*/

$this->Html->script('assets/plugins/select2/select2.min.js',array('inline' => false));
$this->Html->script('assets/plugins/bootstrap/js/bootstrap2-typeahead.min.js',array('inline' => false));
$this->Html->script('assets/plugins/countdown/jquery.countdown.js',array('inline' => false));

$this->Html->script('assets/plugins/bootstrap-modal/js/bootstrap-modalmanager.js',array('inline' => false));
$this->Html->script('assets/plugins/bootstrap-modal/js/bootstrap-modal.js',array('inline' => false));

$this->Html->script('assets/plugins/jquery-validation/dist/jquery.validate.min.js',array('inline' => false));
$this->Html->script('assets/plugins/bootstrap-markdown/js/bootstrap-markdown.js',array('inline' => false));

$this->Html->script('assets/scripts/custom/jquery.vticker.min.js',array('inline' => false));
$this->Html->script('assets/scripts/core/app.js',array('inline' => false));
$this->Html->script('assets/scripts/custom/custom.js',array('inline' => false));
?>

<?php
/**
WRITE SCRIPT TO ADD AT THE END OF DEFAULT LAYOUT WHERE $this->fetch('view_script'); IS CALLED
*/

$this->start('view_script');
?>
<script>
    jQuery(document).ready(function () {
        App.init();
        //FormComponents.init();
        //UIExtendedModals.init();
        Custom.init();
        // Index.init();

        //Index.initCalendar(); // init index page's custom scripts
        $('.page-sidebar .ajaxify.start').click() // load the content for the dashboard page.


       // var menuContainer = jQuery('.page-sidebar ul');
     /*   var subMenuContainer = $('#<?php echo $activeMenuId; ?>');
        subMenuContainer.parents('li').each(function () {
            subMenuContainer.addClass('active');
            subMenuContainer.children('a > span.arrow').addClass('open');
        });
        subMenuContainer.parents('li').addClass('active');*/


        //$('#example').vTicker();
        $('#example').vTicker('init', {speed: 700,
            pause: 5000,
            showItems: 2,
            padding:4});
        $('#example1').vTicker('init', {speed: 700,
            pause: 5000,
            showItems: 2,
            padding:4});

        $( ".page-breadcrumb> .btn-group" ).on({
            click: function() {
                alert( 'page title here' );
            }
        });

        $('#defaultCountdown').countdown({until: +<?php echo $remainingTime;?>, format: 'HMS'});


    });

</script>
<?php echo $this->HighCharts->render('DSEX Chart'); ?>
<?php echo $this->HighCharts->render('DS30 Chart'); ?>
<?php echo $this->HighCharts->render('value Chart'); ?>
<?php echo $this->HighCharts->render('trade Chart'); ?>
<?php $this->end(); ?>

