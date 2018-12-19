<?php
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

//$this->Html->css('assets/plugins/bootstrap/css/bootstrap.min', null, array('inline' => false));
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
/**
ADDING A SIDEBAR MENU TO THE side_bar_menu_1 BLOCK.
NOTE THAT SERIAL OF THESE 3 ARE IMPORTANT. 1ST APPEND MENUE 2ND MENUE BLOCK THIRD SIDEBAR2 BLOCK
TODO:      ITS ALWAYS ADDING MENUE TO THE TOP.ITS WORKING LIKE PREPEND BUT APPEND IS NOT WORKING. FIND OUT A SOLUTION (ABOVE FORM OF TODO IS FOR STORMPHP TODO SYNTEX)
*/

$this->append('side_bar_menu_1');
?>
<li>
    <?php
    echo $this->Html->link('Sidebar Menu From View', '/posts/index');
    ?>
</li>
<?php
    $this->end();
?>

<?php
echo $this->element('layout_element/side_bar_menu_1');
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

<div class="clearfix"></div>
<!-- BEGIN DASHBOARD STATS -->

<!-- BEGIN Portlet PORTLET-->
<div class="portlet">
    <div class="portlet-title">
        <div class="caption"><i class="fa fa-reorder"></i>Market Summary</div>
        <div class="tools">
            <a href="javascript:;" class="collapse"></a>
            <?php echo $this->Html->link('','/markets/market_summary',array('class' => 'reload', 'escape' => false));  ?>
            <a href="index chart" data-toggle="modal" class="feedback"></a>
            <a href="javascript:;" class="remove"></a>
        </div>
    </div>
    <div class="portlet-body" id="marketsmarket_summary">
        <div class="row">
            <div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">
                <div class="dashboard-stat blue">
                    <div class="visual">
                        <i class="fa fa-bar-chart-o"></i>
                    </div>
                    <div class="details">
                        <div class="number">
                            <?php echo Hash::get(Hash::extract($lastTradeInfo, 'IndexValue.{n}[index_id=2]'), '0.capital_value');?>
                        </div>
                        <div class="desc">
                            <div><i class="fa fa-level-up"></i><span class="label label-sm">DS30 <?php echo Hash::get(Hash::extract($lastTradeInfo, 'IndexValue.{n}[index_id=1]'), '0.capital_value'); echo ' ('.$this->Number->toPercentage(Hash::get(Hash::extract($lastTradeInfo, 'IndexValue.{n}[index_id=1]'), '0.percentage_deviation')).')'; ?>)</span></div>
                            <div><i class="fa fa-level-up"></i><span class="label label-sm">DSEX <?php echo Hash::get(Hash::extract($lastTradeInfo, 'IndexValue.{n}[index_id=2]'), '0.capital_value'); echo ' ('.$this->Number->toPercentage(Hash::get(Hash::extract($lastTradeInfo, 'IndexValue.{n}[index_id=2]'), '0.percentage_deviation')).')';?></span></div>

                        </div>
                    </div>
                    <a class="more" href="#">
                        View more <i class="m-icon-swapright m-icon-white"></i>
                    </a>
                </div>
            </div>
            <div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">
                <div class="dashboard-stat yellow">
                    <div class="visual">
                        <i class="fa fa-money"></i>
                    </div>
                    <div class="details">
                        <div class="number"> <?php echo Hash::get($lastTradeInfo, 'MarketStat.0.stats_value');?></div>
                        <div class="desc">
                            Total Trade (MN)
                        </div>
                    </div>
                    <a class="more" href="#">
                        View more <i class="m-icon-swapright m-icon-white"></i>
                    </a>
                </div>
            </div>
            <div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">
                <div class="dashboard-stat green">
                    <div class="visual">
                        <i class="glyphicon glyphicon-arrow-up"></i>
                    </div>
                    <div class="details">
                        <div class="number"><?php echo Hash::apply($lastTradeInfo, 'DataBanksIntraday.{s}.{s}[change>0]', 'count'); ?></div>
                        <div class="desc">
                            <?php
                            $databank=Hash::sort(Hash::extract($lastTradeInfo, 'DataBanksIntraday.{s}[change>0]'), '{n}.change_per', 'desc');
                            $i=1;
                            foreach($databank as $row){
                             if($i>2)
                                break;
                             ++$i;
                            ?>
                            <div><i class="fa fa-level-up"></i><span class="label label-sm"><?php echo $row['instrument_code']; echo ' ('.$this->Number->toPercentage($row['change_per']).')';?></span></div>
                            <?php
                            }
                            ?>
                            <!--<div><i class="fa fa-level-up"></i><span class="label label-sm">(4.56%)</span></div>-->
                        </div>
                    </div>
                    <a class="more" href="#">
                        View more <i class="m-icon-swapright m-icon-white"></i>
                    </a>
                </div>
            </div>
            <div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">
                <div class="dashboard-stat red">
                    <div class="visual">
                        <i class="glyphicon glyphicon-arrow-down"></i>
                    </div>
                    <div class="details">
                        <div class="number"><?php echo Hash::apply($lastTradeInfo, 'DataBanksIntraday.{s}[change<0]', 'count'); ?></div>
                        <div class="desc">
                            <?php
                            $databank=Hash::sort(Hash::extract($lastTradeInfo, 'DataBanksIntraday.{s}[change<0]'), '{n}.change_per', 'asc');
                            $i=1;
                            foreach($databank as $row){
                             if($i>2)
                                break;
                             ++$i;
                            ?>
                            <div><i class="fa fa-level-down"></i><span class="label label-sm"><?php echo $row['instrument_code']; echo ' ('.$this->Number->toPercentage($row['change_per']).')';?></span></div>
                            <?php
                            }
                            ?>
                        </div>
                    </div>
                    <a class="more" href="#">
                        View more <i class="m-icon-swapright m-icon-white"></i>
                    </a>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- END Portlet PORTLET-->
<!--
<div class="row">
    <div class="col-lg-12 col-md-12 col-sm-6 col-xs-12">
        <div id="volume_div"></div>
    </div>
</div>
-->


<!-- END DASHBOARD STATS -->
<div class="clearfix"></div>
<div class="row">
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
                    <a id="ajax-demo" href="index chart" data-toggle="modal" class="feedback"></a>
                </div>
            </div>
            <div class="portlet-body" id="marketsindex_chart">
                <div class="tabbable-custom nav-justified">
                    <ul class="nav nav-tabs nav-justified">
                        <li class="active"><a href="#tab_1_1_1" data-toggle="tab">DSEX</a></li>
                        <li><a href="#tab_1_1_2" data-toggle="tab">DSE30</a></li>
                        <li><a href="#tab_1_1_3" data-toggle="tab">CSE</a></li>
                    </ul>
                    <div class="tab-content">
                        <div class="tab-pane active" id="tab_1_1_1">
                            <div id="dsex_div"></div>
                            <div class="btn-group btn-group-justified">
                                <a href="#a" class="btn btn-xs red" id="line_dsex_div" >Line chart <i class="fa fa-edit"></i></a>
                                <a href="#a" class="btn btn-xs blue" id="column_dsex_div"><i class="fa fa-file-o"></i> Column chart</a>
                                <a href="#a" class="btn btn-xs green" id="areaspline_dsex_div" >Area chart <i class="fa fa-font"></i></a>
                                <a href="#a" class="btn btn-xs yellow" id="scatter_dsex_div">Scatter chart<i class="fa fa-search"></i></a>
                            </div>
                        </div>
                        <div class="tab-pane" id="tab_1_1_2">
                            <div id="ds30_div"></div>
                            <div class="btn-group btn-group-justified">
                                <a href="#a" class="btn btn-xs red" id="line_ds30_div" >Line chart <i class="fa fa-edit"></i></a>
                                <a href="#a" class="btn btn-xs blue" id="column_ds30_div"><i class="fa fa-file-o"></i> Column chart</a>
                                <a href="#a" class="btn btn-xs green" id="areaspline_ds30_div" >Area chart <i class="fa fa-font"></i></a>
                                <a href="#a" class="btn btn-xs yellow" id="scatter_ds30_div">Scatter chart<i class="fa fa-search"></i></a>
                            </div>
                        </div>
                        <div class="tab-pane" id="tab_1_1_3">

                        </div>
                    </div>
                </div>

            </div>
        </div>

    </div>
    <div class="col-md-6 col-sm-6">
        <div class="portlet">
            <div class="portlet-title">
                <a href="#" data-original-title="facebook" class="social-icon facebook"></a>
                <a href="#" data-original-title="twitter" class="social-icon twitter"></a>
                <a href="#" data-original-title="Goole Plus" class="social-icon googleplus"></a>
                <div class="tools">
                    <a href="javascript:;" class="collapse"></a>
                    <?php echo $this->Html->link('','/markets/value_chart',array('class' => 'reload', 'escape' => false));  ?>
                    <a href="index chart" data-toggle="modal" class="feedback"></a>
                </div>
            </div>
            <div class="portlet-body" id="marketsvalue_chart">
                <div class="row">
                    <div class="col-lg-12 col-md-12 col-sm-6 col-xs-12">
                        <div id="value_div"></div>
                    </div>
                </div>
            </div>
        </div>

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
                <div class="row">
                    <div class="col-lg-12 col-md-12 col-sm-6 col-xs-12">
                        <div id="trade_div"></div>
                    </div>
                </div>
            </div>
        </div>

        <!-- END PORTLET-->
    </div>

</div>

<div class="clearfix"></div>
<!-- BEGIN Portlet PORTLET-->
<!--<div class="portlet">
    <div class="portlet-title">
            <a href="#" data-original-title="facebook" class="social-icon facebook"></a>
            <a href="#" data-original-title="twitter" class="social-icon twitter"></a>
            <a href="#" data-original-title="Goole Plus" class="social-icon googleplus"></a>
            <div class="tools">
                <a href="javascript:;" class="collapse"></a>
                <?php echo $this->Html->link('','/markets/index_chart',array('class' => 'reload', 'escape' => false));  ?>
                <a href="index chart" data-toggle="modal" class="feedback"></a>
            </div>
    </div>
    <div class="portlet-body">
        <div class="row">
            <div class="col-lg-12 col-md-12 col-sm-6 col-xs-12">
                <div id="volume_div"></div>
            </div>
        </div>
    </div>
</div>-->
<!-- END Portlet PORTLET-->
<div class="clearfix">
</div>
<div class="row ">
<div class="col-md-12 col-sm-12">
<div class="portlet box blue">
<div class="portlet-title">
    <div class="caption">
        <i class="fa fa-bell-o"></i>Recent Activities
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
</div>



<div class="clearfix"></div>
<div class="row ">
    <div class="col-md-4 col-sm-4">
        <div class="portlet box blue">
            <div class="portlet-title">
                <div class="caption"><i class="fa fa-calendar"></i>Index Stats</div>
                <div class="tools">
                    <a href="" class="collapse"></a>
                    <a href="#portlet-config" data-toggle="modal" class="config"></a>
                    <a  href="index charthhjjh" data-toggle="modal" class="feedback"></a>
                    <a href="<?php echo Router::url(array('controller'=>'posts','action'=>'test2'));?>" class="reload"></a>
                    <a href="" class="remove"></a>
                </div>
            </div>
            <div class="portlet-body" id="poststest2">
                <div class="row">
                    <div class="col-md-4">
                        <div  style="display: block; float: left; width:90%; margin-bottom: 20px;"></div>
                    </div>
                    <div class="margin-bottom-10 visible-sm"></div>
                    <div class="col-md-4">
                        <div class="sparkline-chart">
                            <div class="number" id="sparkline_bar72"></div>
                            <a class="title" href="#">CPU Load <i class="m-icon-swapright"></i></a>
                        </div>
                    </div>
                    <div class="margin-bottom-10 visible-sm"></div>
                    <div class="col-md-4">
                        <div class="sparkline-chart">
                            <div class="number" id="sparkline_lineg"></div>
                            <a class="title" href="#">Load Rate <i class="m-icon-swapright"></i></a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="col-md-4 col-sm-4">
        <div class="portlet box red">
            <div class="portlet-title">
                <div class="caption"><i class="fa fa-calendar"></i>Sector Stats</div>
                <div class="tools">
                    <a href="" class="collapse"></a>
                    <a  href="sector stats here" data-toggle="modal" class="feedback"></a>
<?php
/**
                    HREF OF class="reload" WILL BE CONSIDERED AS AJAX URL.
                    ID OF class="portlet-body" DIV MUST BE NAMED BY CONTROLLER+ACTION WITHOUT SPACE
*/
?>
                   <!-- <a href="http://localhost/omo/markets/home" class="reload"></a>-->
                    <?php echo $this->Html->link('','/markets/home',array('class' => 'reload', 'escape' => false));  ?>
                    <a href="" class="remove"></a>
                </div>
            </div>
            <div class="portlet-body" id="marketshome">
                <div class="row">
                    <div class="col-md-4">
                        <div class="sparkline-chart">
                            <div class="number" id="sparkline_bar"></div>
                            <a class="title" href="#">Network <i class="m-icon-swapright"></i></a>
                        </div>
                    </div>
                    <div class="margin-bottom-10 visible-sm"></div>
                    <div class="col-md-4">
                        <div class="sparkline-chart">
                            <div class="number" id="sparkline_bar2"></div>
                            <a class="title" href="#">CPU Load <i class="m-icon-swapright"></i></a>
                        </div>
                    </div>
                    <div class="margin-bottom-10 visible-sm"></div>
                    <div class="col-md-4">
                        <div class="sparkline-chart">
                            <div class="number" id="sparkline_line"></div>
                            <a class="title" href="#">Load Rate <i class="m-icon-swapright"></i></a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!--<div class="col-md-4 col-sm-4">
        <div class="block-carousel">
            <div id="promo_carousel" class="carousel slide">
                <div class="container">
                    <div class="carousel-inner">
                        <div class="active item">
                          &lt;!&ndash;  <div class="portlet box green">
                                <div class="portlet-title">
                                    <div class="caption"><i class="fa fa-reorder"></i>Default Tabs</div>
                                    <div class="tools">
                                        <a href="javascript:;" class="collapse"></a>
                                        <a href="#portlet-config" data-toggle="modal" class="config"></a>
                                    </div>
                                </div>
                                <div class="portlet-body">
                                    <ul  class="nav nav-tabs">
                                        <li class="active"><a href="#tab_1_1" data-toggle="tab">Home</a></li>
                                        <li class=""><a href="#tab_1_2" data-toggle="tab">Profile</a></li>
                                        <li class="dropdown">
                                            <a href="#"  class="dropdown-toggle" data-toggle="dropdown">Dropdown <i class="fa fa-angle-down"></i></a>
                                            <ul class="dropdown-menu" role="menu">
                                                <li><a href="#tab_1_3" tabindex="-1" data-toggle="tab">Option 1</a></li>
                                                <li><a href="#tab_1_4" tabindex="-1" data-toggle="tab">Option 2</a></li>
                                                <li><a href="#tab_1_3" tabindex="-1" data-toggle="tab">Option 3</a></li>
                                                <li><a href="#tab_1_4" tabindex="-1" data-toggle="tab">Option 4</a></li>
                                            </ul>
                                        </li>
                                    </ul>
                                    <div  class="tab-content">
                                        <div class="tab-pane fade active in" id="tab_1_1">
                                            <p>Raw denim you probably haven't heard of them jean shorts Austin. Nesciunt tofu stumptown aliqua, retro synth master cleanse. Mustache cliche tempor, williamsburg carles vegan helvetica. Reprehenderit butcher retro keffiyeh dreamcatcher synth. Cosby sweater eu banh mi, qui irure terry richardson ex squid. Aliquip placeat salvia cillum iphone. Seitan aliquip quis cardigan american apparel, butcher voluptate nisi qui.</p>
                                        </div>
                                        <div class="tab-pane fade" id="tab_1_2">
                                            <p>Food truck fixie locavore, accusamus mcsweeney's marfa nulla single-origin coffee squid. Exercitation +1 labore velit, blog sartorial PBR leggings next level wes anderson artisan four loko farm-to-table craft beer twee. Qui photo booth letterpress, commodo enim craft beer mlkshk aliquip jean shorts ullamco ad vinyl cillum PBR. Homo nostrud organic, assumenda labore aesthetic magna delectus mollit. Keytar helvetica VHS salvia yr, vero magna velit sapiente labore stumptown. Vegan fanny pack odio cillum wes anderson 8-bit, sustainable jean shorts beard ut DIY ethical culpa terry richardson biodiesel. Art party scenester stumptown, tumblr butcher vero sint qui sapiente accusamus tattooed echo park.</p>
                                        </div>
                                        <div class="tab-pane fade" id="tab_1_3">
                                            <p>Etsy mixtape wayfarers, ethical wes anderson tofu before they sold out mcsweeney's organic lomo retro fanny pack lo-fi farm-to-table readymade. Messenger bag gentrify pitchfork tattooed craft beer, iphone skateboard locavore carles etsy salvia banksy hoodie helvetica. DIY synth PBR banksy irony. Leggings gentrify squid 8-bit cred pitchfork. Williamsburg banh mi whatever gluten-free, carles pitchfork biodiesel fixie etsy retro mlkshk vice blog. Scenester cred you probably haven't heard of them, vinyl craft beer blog stumptown. Pitchfork sustainable tofu synth chambray yr.</p>
                                        </div>
                                        <div class="tab-pane fade" id="tab_1_4">
                                            <p>Trust fund seitan letterpress, keytar raw denim keffiyeh etsy art party before they sold out master cleanse gluten-free squid scenester freegan cosby sweater. Fanny pack portland seitan DIY, art party locavore wolf cliche high life echo park Austin. Cred vinyl keffiyeh DIY salvia PBR, banh mi before they sold out farm-to-table VHS viral locavore cosby sweater. Lomo wolf viral, mustache readymade thundercats keffiyeh craft beer marfa ethical. Wolf salvia freegan, sartorial keffiyeh echo park vegan.</p>
                                        </div>
                                    </div>
                                </div>
                            </div>&ndash;&gt;
                        </div>
                        <div class="item">
                            2nd block
                        </div>
                    </div>
                    <a class="carousel-control left" href="#promo_carousel" data-slide="prev">
                        <i class="m-icon-big-swapleft"></i>
                    </a>
                    <a class="carousel-control right" href="#promo_carousel" data-slide="next">
                        <i class="m-icon-big-swapright"></i>
                    </a>
                    &lt;!&ndash; Indicators &ndash;&gt;
                    <ol class="carousel-indicators">
                        <li data-target="#promo_carousel" data-slide-to="0" class="active"></li>
                        <li data-target="#promo_carousel" data-slide-to="1"></li>
                    </ol>
                </div>
            </div>
        </div>
    </div>-->
</div>
<div id="ajax-modal" class="modal fade" tabindex="-1">
</div>
<script type="text/javascript" src="http://www.stockbangladesh.com/sbapi/temp2.js"></script>
<div id="container_pie" style="width: 900px; height: 850px; margin: 0 auto"></div>

<h2><?php echo __('piuuuuuuuuu'); ?></h2>
<?php //pr($lastTradeInfo); ?>

<?php
/**
ADDING JS BY ELEMENT ( THAT IS PREVIOUSLY GROUPED SOME JS ) TO DEFAULT LAYOUT.
IT WILL BE ADDED WHERE echo $this->fetch('scipt') IS CALLED IN DEFAULT LAYOUT.
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


//$this->Html->script('assets/scripts/ui-extended-modals.js',array('inline' => false));
$this->Html->script('assets/plugins/bootstrap-markdown/js/bootstrap-markdown.js',array('inline' => false));

$this->Html->script('assets/scripts/app.js',array('inline' => false));
$this->Html->script('assets/scripts/custom.js',array('inline' => false));
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
        //UIExtendedModals.init();
        Custom.init();
       // Index.init();

        //Index.initCalendar(); // init index page's custom scripts
        $('.page-sidebar .ajaxify.start').click() // load the content for the dashboard page.


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

