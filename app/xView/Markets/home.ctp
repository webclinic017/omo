<div class="row">
<!--  Main content start-->
<div class="col-md-10">
<!--

<div class="row">
    <div class="col-md-12 col-sm-12">
        <div class="portlet light">
            <div class="portlet-body">
                <div class="row">
                    <?php /*echo $this->element('quick_quote_search'); */?>
                </div>
            </div>
        </div>
    </div>
</div>-->
<!-- END QUICK QUTE SEARCH PORTLET-->

<!--MARKET SUMMARY  -START-->
<div class="clearfix"></div>
<div class="row">
    <div class="col-md-12 col-sm-12">
        <div class="portlet light">
            <div class="portlet-title">
                <div class="caption"><i class="fa fa-reorder"></i>Market Summary</div>
                <div class="tools">
                    <a href="#" data-load="true" data-url="<?php echo Router::url('/markets/market_summary'); ?>"
                       class="reload"></a>
                    <a href="market_summary" data-toggle="modal" class="feedback"></a>
                    <a href="javascript:;" class="remove"></a>
                </div>
            </div>
            <div class="portlet-body">
                <?php echo $this->element('market_summary'); ?>
            </div>
        </div>
    </div>
</div>

<!--MARKET SUMMARY  -END-->

<div class="clearfix"></div>

<div class="row">
    <!--DSEX, DS30 PANEL  -START-->
    <div class="col-md-6 col-sm-6">
        <div class="portlet light">
            <div class="portlet-title">
                <div class="caption"><i class="fa fa-reorder"></i>Index</div>
                <div class="tools">
                    <a href="#" data-load="true" data-url="<?php echo Router::url('/markets/index_chart'); ?>"
                       class="reload"></a>
                    <a href="market_summary" data-toggle="modal" class="feedback"></a>
                    <a href="javascript:;" class="remove"></a>
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
        <div class="portlet light">
            <div class="portlet-title">
                <div class="caption"><i class="fa fa-reorder"></i>Trade value pattern</div>
                <div class="tools">
                    <a href="#" data-load="true" data-url="<?php echo Router::url('/markets/value_chart'); ?>"
                       class="reload"></a>
                    <a href="market_summary" data-toggle="modal" class="feedback"></a>
                    <a href="javascript:;" class="remove"></a>
                </div>
            </div>

            <div class="portlet-body" id="marketsvalue_chart">
                <?php echo $this->element('value_chart'); ?>
            </div>
        </div>
        <!--VALUE CHART -END-->
        <!--TRADE CHART -START-->
        <div class="portlet light">

            <div class="portlet-title">
                <div class="caption"><i class="fa fa-reorder"></i>Trade frequency pattern</div>
                <div class="tools">
                    <a href="#" data-load="true" data-url="<?php echo Router::url('/markets/trade_chart'); ?>"
                       class="reload"></a>
                    <a href="market_summary" data-toggle="modal" class="feedback"></a>
                    <a href="javascript:;" class="remove"></a>
                </div>
            </div>
            <div class="portlet-body" id="marketstrade_chart">
                <?php echo $this->element('trade_chart'); ?>
            </div>
        </div>

        <!--TRADE CHART -END-->
    </div>

</div>

<!--Testing -START-->
<!--<div class="clearfix"></div>
<div class="row">
    <div class="col-md-12 col-sm-12">
        <div class="portlet light">
            <div class="portlet-title">
                <div class="caption caption-md">
                    <i class="icon-bar-chart theme-font hide"></i>
                    <span class="caption-subject theme-font bold uppercase">Market Summary</span>
                    <span class="caption-helper">market index chart...</span>
                </div>
                <div class="tools">
                    <a href="#" class="reload"></a>
                    <a href="market_summary" data-toggle="modal" class="feedback"></a>
                    <a href="javascript:;" class="remove"></a>
                </div>
            </div>
            <div class="portlet-body">
                <div class="row">
                    <div class="col-md-4 col-sm-4">
                        <div class="widget blog-cat-w fx animated fadeInRight" data-animate="fadeInRight">
                            <h3 class="widget-head">Blog Categories</h3>

                            <div class="widget-content">
                                <ul class="list list-ok alt">
                                    <li><a href="blog-single.html">Corporate news</a><span>[12]</span></li>
                                    <li><a href="blog-single.html">Information technology</a><span>[5]</span></li>
                                    <li><a href="blog-single.html">Web development</a><span>[3]</span></li>
                                    <li><a href="blog-single.html">Sports News</a><span>[25]</span></li>
                                </ul>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-4 col-sm-4">

                        <h3 class="block-head">Horizontal Separators</h3>

                        <div class="padd-top-20">
                            <hr>
                        </div>
                        <div class="padd-top-20">
                            <hr class="hr-style2">
                        </div>
                        <div class="padd-top-20">
                            <hr class="hr-style3">
                        </div>
                        <div class="padd-top-20">
                            <hr class="hr-style4">
                        </div>
                        <div class="padd-top-20">
                            <hr class="hr-style5">
                        </div>

                    </div>
                    <div class="col-md-3 col-sm-3">
                        <div class="widget blog-cat-w fx animated fadeInRight" data-animate="fadeInRight">
                            <h3 class="widget-head">Blog Categories</h3>

                            <div class="widget-content">
                                <ul class="list list-ok alt">
                                    <li><a href="blog-single.html">Corporate news</a><span>[12]</span></li>
                                    <li><a href="blog-single.html">Information technology</a><span>[5]</span></li>
                                    <li><a href="blog-single.html">Web development</a><span>[3]</span></li>
                                    <li><a href="blog-single.html">Sports News</a><span>[25]</span></li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>-->
<div class="clearfix"></div>
<div class="row">
<div class="col-md-6 col-sm-6">
<div class="portlet light ">
<div class="portlet-title">
    <div class="caption caption-md">
        <i class="icon-bar-chart theme-font hide"></i>
        <span class="caption-subject theme-font bold uppercase">Top gainer</span>
        <span class="caption-helper hide">daily stats...</span>
    </div>
    <div class="actions">
        <div class="btn-group btn-group-devided" data-toggle="buttons">
            <label class="btn btn-transparent grey-salsa btn-circle btn-sm active">
                <input type="radio" name="options" class="toggle" id="option1">Today</label>
            <label class="btn btn-transparent grey-salsa btn-circle btn-sm">
                <input type="radio" name="options" class="toggle" id="option2">Week</label>
            <label class="btn btn-transparent grey-salsa btn-circle btn-sm">
                <input type="radio" name="options" class="toggle" id="option2">Month</label>
        </div>
    </div>
</div>
<div class="portlet-body">


<div class="tabbable-custom ">
<ul class="nav nav-tabs ">
    <li class="active">
        <a href="#tab_6_1" data-toggle="tab">
            By % </a>
    </li>
    <li class="">
        <a href="#tab_6_2" data-toggle="tab">
            By Change </a>
    </li>
    <li class="">
        <a href="#tab_6_3" data-toggle="tab">
            By Volume </a>
    </li>
    <li class="dropdown">
        <a href="#" class="dropdown-toggle" data-toggle="dropdown">
            More <i class="fa fa-angle-down"></i>
        </a>
        <ul class="dropdown-menu" role="menu">
            <li class="">
                <a href="#tab_6_4" data-toggle="tab">
                    Volume Gain (%) </a>
            </li>
            <li class="">
                <a href="#tab_6_5" data-toggle="tab">
                    Value Change(%) </a>
            </li>
            <li class="">
                <a href="#tab_6_6" data-toggle="tab">
                    Top Value </a>
            </li>
        </ul>
    </li>


</ul>
<div class="tab-content">
<div class="tab-pane active" id="tab_6_1">
    <div class="table-scrollable table-scrollable-borderless">
        <!--<table class="table table-hover table-light">-->
        <h3 class="block-head">By price change (%)</h3>
        <table class="table table-hover flip-content">
            <thead class="flip-content">
            <tr>
                <th>
                    Code
                </th>
                <th class="numeric">
                    Price
                </th>
                <th class="numeric">
                    Volume
                </th>
                <th class="numeric">
                    Chg(%)
                </th>
                <th class="numeric">
                    LTP
                </th>
                <th class="numeric">
                    Volume
                </th>


            </tr>
            </thead>
            <tbody>
            <?php

            $databank_change_up_arr = Hash::sort($lastTradeInfo, '{n}.change_per', 'desc');
            $i = 0;

            foreach ($databank_change_up_arr as $databank_change_up) {
                $instrument_id = $databank_change_up['instrument_id'];
                $change = $databank_change_up['change'];
                $i++;
                if ($i > $table_row_display)
                    break;
                ?>
                <tr>
                    <td>
                        <?php echo $databank_change_up['instrument_code']; ?>

                    </td>

                    <?php echo $this->requestAction("instruments/sparkline_price/$instrument_id/$change", array("return")); ?>

                    <td class="success">
                        <?php echo $this->Number->toPercentage($databank_change_up['change_per']); ?>
                    </td>
                    <td class="numeric">
                        <?php echo $this->Number->precision($databank_change_up['close_price'], 2); ?>
                    </td>

                    <td class="numeric">
                        <?php echo $this->Number->precision($databank_change_up['total_volume'], 0); ?>
                    </td>

                    <!--Action will return including td-->


                </tr>
            <?php } ?>

            </tbody>
        </table>
    </div>
</div>
<div class="tab-pane" id="tab_6_2">
    <div class="table-scrollable table-scrollable-borderless">
        <h3 class="block-head">By Price Change</h3>
        <table class="table table-hover flip-content">
            <thead class="flip-content">
            <tr>
                <th>
                    Code
                </th>
                <th class="numeric">
                    Price
                </th>
                <th class="numeric">
                    Volume
                </th>
                <th class="numeric">
                    Chg(%)
                </th>
                <th class="numeric">
                    LTP
                </th>
                <th class="numeric">
                    Volume
                </th>


            </tr>
            </thead>
            <tbody>
            <?php

            $databank_change_up_arr = Hash::sort($lastTradeInfo, '{n}.change', 'desc');
            $i = 0;

            foreach ($databank_change_up_arr as $databank_change_up) {
                $instrument_id = $databank_change_up['instrument_id'];
                $change = $databank_change_up['change'];
                $i++;
                if ($i > $table_row_display)
                    break;
                ?>
                <tr>
                    <td>
                        <?php echo $databank_change_up['instrument_code']; ?>
                    </td>
                    <?php echo $this->requestAction("instruments/sparkline_price/$instrument_id/$change", array("return")); ?>
                    <td class="success">
                        <?php echo $this->Number->precision($databank_change_up['change'], 2); ?>
                    </td>
                    <td class="numeric">
                        <?php echo $this->Number->precision($databank_change_up['close_price'], 2); ?>
                    </td>

                    <td class="numeric">
                        <?php echo $this->Number->precision($databank_change_up['total_volume'], 0); ?>
                    </td>


                </tr>
            <?php } ?>

            </tbody>
        </table>
    </div>
</div>
<div class="tab-pane" id="tab_6_3">
    <div class="table-scrollable table-scrollable-borderless">
        <h3 class="block-head">By volume</h3>
        <table class="table table-hover flip-content">
            <thead class="flip-content">
            <tr>
                <th>
                    Code
                </th>
                <th class="numeric">
                    Price
                </th>
                <th class="numeric">
                    Volume
                </th>
                <th class="numeric">
                    Chg(%)
                </th>
                <th class="numeric">
                    LTP
                </th>
                <th class="numeric">
                    Volume
                </th>


            </tr>
            </thead>
            <tbody>
            <?php

            $databank_change_up_arr = Hash::sort($lastTradeInfo, '{n}.total_volume', 'desc');
            $i = 0;

            foreach ($databank_change_up_arr as $databank_change_up) {
                $instrument_id = $databank_change_up['instrument_id'];
                $change = $databank_change_up['change'];
                $i++;
                if ($i > $table_row_display)
                    break;
                ?>
                <tr>
                    <td>
                        <?php echo $databank_change_up['instrument_code']; ?>
                    </td>
                    <?php echo $this->requestAction("instruments/sparkline_price/$instrument_id/$change", array("return")); ?>
                    <td class="numeric">
                        <?php echo $this->Number->toPercentage($databank_change_up['change_per']); ?>
                    </td>
                    <td class="numeric">
                        <?php echo $this->Number->precision($databank_change_up['close_price'], 2); ?>
                    </td>

                    <td class="success">
                        <?php echo $this->Number->precision($databank_change_up['total_volume'], 0); ?>
                    </td>

                </tr>
            <?php } ?>

            </tbody>
        </table>
    </div>
</div>
<div class="tab-pane" id="tab_6_4">
    <div class="table-scrollable table-scrollable-borderless">
        <h3 class="block-head">Volume gain (%)</h3>
        <table class="table table-hover flip-content">
            <thead class="flip-content">
            <tr>
                <th>
                    Code
                </th>
                <th class="numeric">
                    Price
                </th>
                <th class="numeric">
                    Volume
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

            </tr>
            </thead>
            <tbody>
            <?php

            $databank_change_up_arr = Hash::sort($lastTradeInfo, '{n}.y_total_volume_change_per', 'desc');
            $i = 0;

            foreach ($databank_change_up_arr as $databank_change_up) {
                $instrument_id = $databank_change_up['instrument_id'];
                $change = $databank_change_up['change'];
                $i++;
                if ($i > $table_row_display)
                    break;
                ?>

                <tr>
                    <td>
                        <?php echo $databank_change_up['instrument_code']; ?>
                    </td>
                    <?php echo $this->requestAction("instruments/sparkline_price/$instrument_id/$change", array("return")); ?>
                    <td class="success">
                        <?php echo $this->Number->toPercentage($databank_change_up['y_total_volume_change_per']); ?>
                    </td>
                    <td class="numeric">
                        <?php echo $this->Number->precision($databank_change_up['total_volume'], 0); ?>
                    </td>

                    <td class="numeric">
                        <?php echo $this->Number->precision($databank_change_up['y_total_volume'], 0); ?>
                    </td>


                </tr>
            <?php } ?>

            </tbody>
        </table>
    </div>
</div>
<div class="tab-pane" id="tab_6_5">
    <div class="table-scrollable table-scrollable-borderless">
        <h3 class="block-head">Value Change (%)</h3>
        <table class="table table-hover flip-content">
            <thead class="flip-content">
            <tr>
                <th>
                    Code
                </th>
                <th class="numeric">
                    Price
                </th>
                <th class="numeric">
                    Volume
                </th>
                <th class="numeric">
                    Chg
                </th>
                <th class="numeric">
                    T Value (M)
                </th>
                <th class="numeric">
                    Y value (M)
                </th>

            </tr>
            </thead>
            <tbody>
            <?php

            $databank_change_up_arr = Hash::sort($lastTradeInfo, '{n}.y_public_total_value_change_per', 'desc');
            $i = 0;

            foreach ($databank_change_up_arr as $databank_change_up) {
                $instrument_id = $databank_change_up['instrument_id'];
                $change = $databank_change_up['change'];
                $i++;
                if ($i > $table_row_display)
                    break;
                ?>
                <tr>
                    <td>
                        <?php echo $databank_change_up['instrument_code']; ?>
                    </td>
                    <?php echo $this->requestAction("instruments/sparkline_price/$instrument_id/$change", array("return")); ?>
                    <td class="success">
                        <?php echo $this->Number->toPercentage($databank_change_up['y_public_total_value_change_per']); ?>
                    </td>
                    <td class="numeric">
                        <?php echo $this->Number->precision($databank_change_up['public_total_value'], 2); ?>
                    </td>

                    <td class="numeric">
                        <?php echo $this->Number->precision($databank_change_up['y_public_total_value'], 2); ?>
                    </td>

                </tr>
            <?php } ?>

            </tbody>
        </table>
    </div>
</div>
<div class="tab-pane" id="tab_6_6">
    <div class="table-scrollable table-scrollable-borderless">
        <h3 class="block-head">Top Value</h3>
        <table class="table table-hover flip-content">
            <thead class="flip-content">
            <tr>
                <th>
                    Code
                </th>
                <th class="numeric">
                    Price
                </th>
                <th class="numeric">
                    Volume
                </th>
                <th class="numeric">
                    Chg
                </th>
                <th class="numeric">
                    LTP
                </th>
                <th class="numeric">
                    Value(M)
                </th>


            </tr>
            </thead>
            <tbody>
            <?php

            $databank_change_up_arr = Hash::sort($lastTradeInfo, '{n}.public_total_value', 'desc');
            $i = 0;

            foreach ($databank_change_up_arr as $databank_change_up) {
                $instrument_id = $databank_change_up['instrument_id'];
                $change = $databank_change_up['change'];
                $i++;
                if ($i > $table_row_display)
                    break;
                ?>
                <tr>
                    <td>
                        <?php echo $databank_change_up['instrument_code']; ?>
                    </td>
                    <?php echo $this->requestAction("instruments/sparkline_price/$instrument_id/$change", array("return")); ?>
                    <td class="numeric">
                        <?php echo $this->Number->toPercentage($databank_change_up['change_per']); ?>
                    </td>
                    <td class="numeric">
                        <?php echo $this->Number->precision($databank_change_up['close_price'], 2); ?>
                    </td>

                    <td class="success">
                        <?php echo $this->Number->precision($databank_change_up['public_total_value'], 2); ?>
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
<div class="col-md-6 col-sm-6">
<div class="portlet light ">
<div class="portlet-title">
    <div class="caption caption-md">
        <i class="icon-bar-chart theme-font hide"></i>
        <span class="caption-subject theme-font bold uppercase">Top Looser</span>
        <span class="caption-helper hide">weekly stats...</span>
    </div>
    <div class="actions">
        <div class="btn-group btn-group-devided" data-toggle="buttons">
            <label class="btn btn-transparent grey-salsa btn-circle btn-sm active">
                <input type="radio" name="options" class="toggle" id="option1">Today</label>
            <label class="btn btn-transparent grey-salsa btn-circle btn-sm">
                <input type="radio" name="options" class="toggle" id="option2">Week</label>
            <label class="btn btn-transparent grey-salsa btn-circle btn-sm">
                <input type="radio" name="options" class="toggle" id="option2">Month</label>
        </div>
    </div>
</div>
<div class="portlet-body">


<div class="tabbable-custom ">
<ul class="nav nav-tabs ">
    <li class="active">
        <a href="#tab_7_1" data-toggle="tab">
            By % </a>
    </li>
    <li class="">
        <a href="#tab_7_2" data-toggle="tab">
            By Change </a>
    </li>
    <li class="">
        <a href="#tab_7_3" data-toggle="tab">
            By Volume </a>
    </li>
    <li class="dropdown">
        <a href="#" class="dropdown-toggle" data-toggle="dropdown">
            More <i class="fa fa-angle-down"></i>
        </a>
        <ul class="dropdown-menu" role="menu">
            <li class="">
                <a href="#tab_7_4" data-toggle="tab">
                    Volume Gain (%) </a>
            </li>
            <li class="">
                <a href="#tab_7_5" data-toggle="tab">
                    Value Change(%) </a>
            </li>
            <li class="">
                <a href="#tab_7_6" data-toggle="tab">
                    Top Value </a>
            </li>
        </ul>
    </li>


</ul>
<div class="tab-content">
<div class="tab-pane active" id="tab_7_1">
    <div class="table-scrollable table-scrollable-borderless">
        <!--<table class="table table-hover table-light">-->
        <h3 class="block-head">By price change (%)</h3>
        <table class="table table-hover flip-content">
            <thead class="flip-content">
            <tr>
                <th>
                    Code
                </th>
                <th class="numeric">
                    Price
                </th>
                <th class="numeric">
                    Volume
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


            </tr>
            </thead>
            <tbody>
            <?php

            $databank_change_up_arr = Hash::sort($lastTradeInfo, '{n}.change_per', 'asc');
            $i = 0;
            /*   echo "<pre>";
print_r($databank_change_up_arr);*/
            foreach ($databank_change_up_arr as $databank_change_up) {
                $instrument_id = $databank_change_up['instrument_id'];
                $change = $databank_change_up['change'];
                $i++;
                if ($i > $table_row_display)
                    break;
                ?>
                <tr>
                    <td>
                        <?php echo $databank_change_up['instrument_code']; ?>
                    </td>
                    <?php echo $this->requestAction("instruments/sparkline_price/$instrument_id/$change", array("return")); ?>
                    <td class="success">
                        <?php echo $this->Number->toPercentage($databank_change_up['change_per']); ?>
                    </td>
                    <td class="numeric">
                        <?php echo $this->Number->precision($databank_change_up['close_price'], 2); ?>
                    </td>

                    <td class="numeric">
                        <?php echo $this->Number->precision($databank_change_up['total_volume'], 0); ?>
                    </td>


                </tr>
            <?php } ?>

            </tbody>
        </table>
    </div>
</div>
<div class="tab-pane" id="tab_7_2">
    <div class="table-scrollable table-scrollable-borderless">
        <h3 class="block-head">By Price Change</h3>
        <table class="table table-hover flip-content">
            <thead class="flip-content">
            <tr>
                <th>
                    Code
                </th>
                <th class="numeric">
                    Price
                </th>
                <th class="numeric">
                    Volume
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
            </tr>
            </thead>
            <tbody>
            <?php

            $databank_change_up_arr = Hash::sort($lastTradeInfo, '{n}.change', 'asc');
            $i = 0;

            foreach ($databank_change_up_arr as $databank_change_up) {
                $instrument_id = $databank_change_up['instrument_id'];
                $change = $databank_change_up['change'];
                $i++;
                if ($i > $table_row_display)
                    break;
                ?>
                <tr>
                    <td>
                        <?php echo $databank_change_up['instrument_code']; ?>
                    </td>
                    <?php echo $this->requestAction("instruments/sparkline_price/$instrument_id/$change", array("return")); ?>
                    <td class="success">
                        <?php echo $this->Number->precision($databank_change_up['change'], 2); ?>
                    </td>
                    <td class="numeric">
                        <?php echo $this->Number->precision($databank_change_up['close_price'], 2); ?>
                    </td>

                    <td class="numeric">
                        <?php echo $this->Number->precision($databank_change_up['total_volume'], 0); ?>
                    </td>

                </tr>
            <?php } ?>

            </tbody>
        </table>
    </div>
</div>
<div class="tab-pane" id="tab_7_3">
    <div class="table-scrollable table-scrollable-borderless">
        <h3 class="block-head">By volume</h3>
        <table class="table table-hover flip-content">
            <thead class="flip-content">
            <tr>
                <th>
                    Code
                </th>
                <th class="numeric">
                    Price
                </th>
                <th class="numeric">
                    Volume
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
            </tr>
            </thead>
            <tbody>
            <?php

            $databank_change_up_arr = Hash::sort($lastTradeInfo, '{n}.y_total_volume_change_per', 'asc');
            $i = 0;

            foreach ($databank_change_up_arr as $databank_change_up) {
                $instrument_id = $databank_change_up['instrument_id'];
                $change = $databank_change_up['change'];
                $i++;
                if ($i > $table_row_display)
                    break;
                ?>
                <tr>
                    <td>
                        <?php echo $databank_change_up['instrument_code']; ?>
                    </td>
                    <?php echo $this->requestAction("instruments/sparkline_price/$instrument_id/$change", array("return")); ?>
                    <td class="success">
                        <?php echo $this->Number->toPercentage($databank_change_up['y_total_volume_change_per']); ?>
                    </td>
                    <td class="numeric">
                        <?php echo $this->Number->precision($databank_change_up['total_volume'], 0); ?>
                    </td>

                    <td class="numeric">
                        <?php echo $this->Number->precision($databank_change_up['y_total_volume'], 0); ?>
                    </td>


                </tr>
            <?php } ?>

            </tbody>
        </table>
    </div>
</div>
<div class="tab-pane" id="tab_7_4">
    <div class="table-scrollable table-scrollable-borderless">
        <h3 class="block-head">Volume gain (%)</h3>

    </div>
</div>
<div class="tab-pane" id="tab_7_5">
    <div class="table-scrollable table-scrollable-borderless">
        <h3 class="block-head">Value Change (%)</h3>
        <table class="table table-hover flip-content">
            <thead class="flip-content">
            <tr>
                <th>
                    Code
                </th>
                <th class="numeric">
                    Price
                </th>
                <th class="numeric">
                    Volume
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


            </tr>
            </thead>
            <tbody>
            <?php

            $databank_change_up_arr = Hash::sort($lastTradeInfo, '{n}.y_public_total_value_change_per', 'asc');
            $i = 0;

            foreach ($databank_change_up_arr as $databank_change_up) {
                $instrument_id = $databank_change_up['instrument_id'];
                $change = $databank_change_up['change'];
                $i++;
                if ($i > $table_row_display)
                    break;
                ?>
                <tr>
                    <td>
                        <?php echo $databank_change_up['instrument_code']; ?>
                    </td>
                    <?php echo $this->requestAction("instruments/sparkline_price/$instrument_id/$change", array("return")); ?>
                    <td class="success">
                        <?php echo $this->Number->toPercentage($databank_change_up['y_public_total_value_change_per']); ?>
                    </td>
                    <td class="numeric">
                        <?php echo $this->Number->precision($databank_change_up['public_total_value'], 2); ?>
                    </td>

                    <td class="numeric">
                        <?php echo $this->Number->precision($databank_change_up['y_public_total_value'], 2); ?>
                    </td>
                    <td>
                        <!--<a class="btn default btn-xs blue-stripe" href="#">View</a>-->

                        <div class="task-config">
                            <div class="task-config-btn btn-group">
                                <a class="btn btn-xs default" href="#" data-toggle="dropdown" data-hover="dropdown"
                                   data-close-others="true">
                                    <i class="fa fa-cog"></i><i class="fa fa-angle-down"></i>
                                </a>
                                <ul class="dropdown-menu pull-right">
                                    <li>
                                        <a href="#">
                                            <i class="fa fa-check"></i> Complete </a>
                                    </li>
                                    <li>
                                        <a href="#">
                                            <i class="fa fa-pencil"></i> Edit </a>
                                    </li>
                                    <li>
                                        <a href="#">
                                            <i class="fa fa-trash-o"></i> Cancel </a>
                                    </li>
                                </ul>
                            </div>
                        </div>
                    </td>

                </tr>
            <?php } ?>

            </tbody>
        </table>
    </div>
</div>
<div class="tab-pane" id="tab_7_6">
    <div class="table-scrollable table-scrollable-borderless">
        <h3 class="block-head">Top Value</h3>
        <table class="table table-hover flip-content">
            <thead class="flip-content">
            <tr>
                <th>
                    Code
                </th>
                <th class="numeric">
                    Price
                </th>
                <th class="numeric">
                    Volume
                </th>
                <th class="numeric">
                    Chg
                </th>
                <th class="numeric">
                    LTP
                </th>
                <th class="numeric">
                    Value(M)
                </th>


            </tr>
            </thead>
            <tbody>
            <?php

            $databank_change_up_arr = Hash::sort($lastTradeInfo, '{n}.public_total_value', 'desc');
            $i = 0;

            foreach ($databank_change_up_arr as $databank_change_up) {
                $instrument_id = $databank_change_up['instrument_id'];
                $change = $databank_change_up['change'];
                $i++;
                if ($i > $table_row_display)
                    break;
                ?>
                <tr>
                    <td>
                        <?php echo $databank_change_up['instrument_code']; ?>
                    </td>
                    <?php echo $this->requestAction("instruments/sparkline_price/$instrument_id/$change", array("return")); ?>
                    <td class="numeric">
                        <?php echo $this->Number->toPercentage($databank_change_up['change_per']); ?>
                    </td>
                    <td class="numeric">
                        <?php echo $this->Number->precision($databank_change_up['close_price'], 2); ?>
                    </td>

                    <td class="success">
                        <?php echo $this->Number->precision($databank_change_up['public_total_value'], 2); ?>
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
</div>

</div>
<!--Main content end-->

<!--Right Sidebar starts-->
<div class="col-md-2">
    <?php

    $adsArr=Configure::read('ads');
    foreach($adsArr as $ads)
    {
        $img=$ads['img'];
        $link=$ads['link'];
        $height=$ads['height'];
    ?>
    <div>
        <a href="<?php echo $link; ?>" class="thumbnail">
            <img src="<?php echo Router::url('/', true)?><?php echo $img; ?>" alt="ads" style="height: <?php echo $height; ?>px; width: 100%; display: block;">
        </a>
    </div>

    <?php }?>



</div>
<!--Right sidebar end-->


</div>
<div class="clearfix"></div>

<div class="col-md-12">
<div class="row">
<div class="portlet light">
<div class="portlet-body">
<div class="row">
<div class="col-md-12 news-page">
<h1 style="margin-top:0">Recent News</h1>
<div class="row">
<div class="col-md-5">
    <div id="myCarousel" class="carousel image-carousel">
        <div class="carousel-inner">

            <div class="active item">
                <img src="<?php echo $allnews[0]['thmbnail']?>" class="img-responsive" alt="">
                <div class="carousel-caption">
                    <h4>
                        <a href="<?php echo $guid; ?>">
                            <?php echo $allnews[0]['post_title']?> </a>
                    </h4>
                    <p>
                        <?php $post_content=$this->Text->excerpt($allnews[0]['post_content'], 'method', 200, '...');
                        $post_content=strip_tags($post_content);
                       // echo $post_content;
                        ?>


                    </p>
                </div>
            </div>
            <div class="item">
                <img src="<?php echo $allnews[1]['thmbnail']?>" class="img-responsive" alt="">
                <div class="carousel-caption">
                    <h4>
                        <a href="<?php echo $guid; ?>">
                            <?php echo $allnews[1]['post_title']?> </a>
                    </h4>
                    <p>
                        <?php $post_content=$this->Text->excerpt($allnews[1]['post_content'], 'method', 200, '...');
                        $post_content=strip_tags($post_content);
                       // echo $post_content;
                        ?>


                    </p>
                </div>
            </div>
            <div class="item">
                <img src="<?php echo $allnews[2]['thmbnail']?>" class="img-responsive" alt="">
                <div class="carousel-caption">
                    <h4>
                        <a href="<?php echo $guid; ?>">
                            <?php echo $allnews[2]['post_title']?> </a>
                    </h4>
                    <p>
                        <?php $post_content=$this->Text->excerpt($allnews[2]['post_content'], 'method', 200, '...');
                        $post_content=strip_tags($post_content);
                       // echo $post_content;
                        ?>


                    </p>
                </div>
            </div>


           <!-- <div class="item">
                <img src="../../assets/admin/pages/media/gallery/image2.jpg" class="img-responsive" alt="">
                <div class="carousel-caption">
                    <h4>
                        <a href="<?php echo $guid; ?>">
                            Second Thumbnail label </a>
                    </h4>
                    <p>
                        Cras justo odio, dapibus ac facilisis in, egestas eget quam.
                    </p>
                </div>
            </div>
            <div class="item">
                <img src="../../assets/admin/pages/media/gallery/image1.jpg" class="img-responsive" alt="">
                <div class="carousel-caption">
                    <h4>
                        <a href="<?php echo $guid; ?>">
                            Third Thumbnail label </a>
                    </h4>
                    <p>
                        Cras justo odio, dapibus ac facilisis in, egestas eget quam.
                    </p>
                </div>
            </div>-->
        </div>
        <!-- Carousel nav -->
        <a class="carousel-control left" href="#myCarousel" data-slide="prev">
            <i class="m-icon-big-swapleft m-icon-white"></i>
        </a>
        <a class="carousel-control right" href="#myCarousel" data-slide="next">
            <i class="m-icon-big-swapright m-icon-white"></i>
        </a>
        <ol class="carousel-indicators">
            <li data-target="#myCarousel" data-slide-to="0" class="active">
            </li>
            <li data-target="#myCarousel" data-slide-to="1">
            </li>
            <li data-target="#myCarousel" data-slide-to="2">
            </li>
        </ol>
    </div>
    <div class="top-news margin-top-10">
        <a href="#" class="btn blue">
										<span>
										লাইভ নিউজ </span>
            <em>
                <i class="fa fa-tags"></i>
                DSE, CSE, BSEC </em>
            <i class="fa fa- icon-bullhorn top-news-icon"></i>
        </a>
    </div>
    <?php
    foreach ($allnews as $news)
    {
       $title=$news['post_title'];
        $guid=$news['guid'];
       $post_date=$news['post_date'];
        $post_date=$this->Time->timeAgoInWords($post_date);
       $post_content=$news['post_content'];
       $thmbnail=$news['thmbnail'];
       $taxonomy=$news['taxonomy'];
        $taxonomy = $this->Text->toList($taxonomy,'এবং');

        $imgurl=explode('.',$thmbnail);
        $full_imgurl=$imgurl[0].'.'.$imgurl[1].'.'.$imgurl[2].'-75x75'.'.'.$imgurl[3];

        $post_content = $this->Text->excerpt($post_content, 'method', 500, '...');

        $post_content=strip_tags($post_content);
       // -150x150

    ?>
    <div class="news-blocks">
        <h3>
            <a href="<?php echo $guid; ?>">
               <?php echo $title; ?></a>
        </h3>
        <div class="news-block-tags">
            <strong><?php echo $taxonomy; ?></strong>
            <em><?php echo $post_date;?></em>
        </div>
        <p>
            <img class="news-block-img pull-right" src="<?php echo $full_imgurl; ?>" alt="">
            <?php echo $post_content; ?>
        </p>
        <a href="<?php echo $guid; ?>" class="news-block-btn">
            Read more <i class="m-icon-swapright m-icon-black"></i>
        </a>
    </div>
    <?php
    }
    ?>

</div>
<!--end col-md-5-->
<div class="col-md-4">
    <div class="top-news">
        <a href="#" class="btn red">
										<span>
										সাক্ষাৎকার </span>
            <em>
                <i class="fa fa-tags"></i>
                Icon in market </em>
            <i class="fa fa-globe top-news-icon"></i>
        </a>
    </div>
    <?php
    foreach ($interviewArr as $news)
    {
        $title=$news['post_title'];
        $guid=$news['guid'];
        $post_date=$news['post_date'];
        $post_date=$this->Time->timeAgoInWords($post_date);
        $post_content=$news['post_content'];
        $thmbnail=$news['thmbnail'];
        $taxonomy=$news['taxonomy'];
        $taxonomy = $this->Text->toList($taxonomy,'এবং');

        $imgurl=explode('.',$thmbnail);
        $full_imgurl=$imgurl[0].'.'.$imgurl[1].'.'.$imgurl[2].'-75x75'.'.'.$imgurl[3];

        $post_content = $this->Text->excerpt($post_content, 'method', 300, '...');

        $post_content=strip_tags($post_content);
        // -150x150

        ?>
        <div class="news-blocks">
            <h3>
                <a href="<?php echo $guid; ?>">
                    <?php echo $title; ?></a>
            </h3>
            <div class="news-block-tags">
                <strong><?php echo $taxonomy; ?></strong>
                <em><?php echo $post_date;?></em>
            </div>
            <p>
                <img class="news-block-img pull-right" src="<?php echo $full_imgurl; ?>" alt="">
                <?php echo $post_content; ?>
            </p>
            <a href="<?php echo $guid; ?>" class="news-block-btn">
                Read more <i class="m-icon-swapright m-icon-black"></i>
            </a>
        </div>
    <?php
    }
    ?>

    <div class="top-news">
        <a href="#" class="btn green">
										<span>
										আই পি ও </span>
            <em>
                <i class="fa fa-tags"></i>
                IPO</em>
            <i class="fa fa-briefcase top-news-icon"></i>
        </a>
    </div>
    <?php
    foreach ($ipo as $news)
    {
        $title=$news['post_title'];
        $guid=$news['guid'];
        $post_date=$news['post_date'];
        $post_date=$this->Time->timeAgoInWords($post_date);
        $post_content=$news['post_content'];
        $thmbnail=$news['thmbnail'];
        $taxonomy=$news['taxonomy'];
        $taxonomy = $this->Text->toList($taxonomy,'এবং');

        $imgurl=explode('.',$thmbnail);
        $full_imgurl=$imgurl[0].'.'.$imgurl[1].'.'.$imgurl[2].'-75x75'.'.'.$imgurl[3];

        $post_content = $this->Text->excerpt($post_content, 'method', 300, '...');

        $post_content=strip_tags($post_content);
        // -150x150

        ?>
        <div class="news-blocks">
            <h3>
                <a href="<?php echo $guid; ?>">
                    <?php echo $title; ?></a>
            </h3>
            <div class="news-block-tags">
                <strong><?php echo $taxonomy; ?></strong>
                <em><?php echo $post_date;?></em>
            </div>
            <p>
                <img class="news-block-img pull-right" src="<?php echo $full_imgurl; ?>" alt="">
                <?php echo $post_content; ?>
            </p>
            <a href="<?php echo $guid; ?>" class="news-block-btn">
                Read more <i class="m-icon-swapright m-icon-black"></i>
            </a>
        </div>
    <?php
    }
    ?>
</div>
<!--end col-md-4-->
<div class="col-md-3">
    <div class="top-news">
        <a href="#" class="btn purple">
										<span>
										এজিএম/ইজিএম </span>
            <em>
                <i class="fa fa-tags"></i>
                AGM, EGM</em>
            <i class="fa fa-beaker top-news-icon"></i>
        </a>
    </div>
    <?php
    foreach ($agm as $news)
    {
        $title=$news['post_title'];
        $guid=$news['guid'];
        $post_date=$news['post_date'];
        $post_date=$this->Time->timeAgoInWords($post_date);
        $post_content=$news['post_content'];
        $thmbnail=$news['thmbnail'];
        $taxonomy=$news['taxonomy'];
        $taxonomy = $this->Text->toList($taxonomy,'এবং');

        $imgurl=explode('.',$thmbnail);
        $full_imgurl=$imgurl[0].'.'.$imgurl[1].'.'.$imgurl[2].'-75x75'.'.'.$imgurl[3];

        $post_content = $this->Text->excerpt($post_content, 'method', 300, '...');

        $post_content=strip_tags($post_content);
        // -150x150

        ?>
        <div class="news-blocks">
            <h3>
                <a href="<?php echo $guid; ?>">
                    <?php echo $title; ?></a>
            </h3>
            <div class="news-block-tags">
                <strong><?php echo $taxonomy; ?></strong>
                <em><?php echo $post_date;?></em>
            </div>
            <p>
                <img class="news-block-img pull-right" src="<?php echo $full_imgurl; ?>" alt="">
                <?php echo $post_content; ?>
            </p>
            <a href="<?php echo $guid; ?>" class="news-block-btn">
                Read more <i class="m-icon-swapright m-icon-black"></i>
            </a>
        </div>
    <?php
    }
    ?>
    <div class="top-news">
        <a href="#" class="btn yellow">
										<span>
										বাজার প্রতিদিন </span>
            <em>
                <i class="fa fa-tags"></i>
                Market analysis</em>
            <i class="fa fa-trophy top-news-icon"></i>
        </a>
    </div>
    <?php
    foreach ($marketAnalysis as $news)
    {
        $title=$news['post_title'];
        $guid=$news['guid'];
        $post_date=$news['post_date'];
        $post_date=$this->Time->timeAgoInWords($post_date);
        $post_content=$news['post_content'];
        $thmbnail=$news['thmbnail'];
        $taxonomy=$news['taxonomy'];
        $taxonomy = $this->Text->toList($taxonomy,'এবং');

        $imgurl=explode('.',$thmbnail);
        $full_imgurl=$imgurl[0].'.'.$imgurl[1].'.'.$imgurl[2].'-75x75'.'.'.$imgurl[3];

        $post_content = $this->Text->excerpt($post_content, 'method', 300, '...');

        $post_content=strip_tags($post_content);
        // -150x150

        ?>
        <div class="news-blocks">
            <h3>
                <a href="<?php echo $guid; ?>">
                    <?php echo $title; ?></a>
            </h3>
            <div class="news-block-tags">
                <strong><?php echo $taxonomy; ?></strong>
                <em><?php echo $post_date;?></em>
            </div>
            <p>
                <img class="news-block-img pull-right" src="<?php echo $full_imgurl; ?>" alt="">
                <?php echo $post_content; ?>
            </p>
            <a href="<?php echo $guid; ?>" class="news-block-btn">
                Read more <i class="m-icon-swapright m-icon-black"></i>
            </a>
        </div>
    <?php
    }
    ?>
</div>
<!--end col-md-3-->
</div>

</div>
</div>
</div>
</div>
</div>
</div>

<script type="text/javascript">

    $(function () {
        $('.inlinesparkline').sparkline('html', {
            enableTagOptions: true,
            disableHiddenCheck: true,
            height: '20px'
            //width: '100px'
        });


        if (!jQuery().fullCalendar) {
            return;
        }

        var date = new Date();
        var d = date.getDate();
        var m = date.getMonth();
        var y = date.getFullYear();

        var h = {};

        if ($('#calendar').width() <= 400) {
            $('#calendar').addClass("mobile");
            h = {
                left: 'title, prev, next',
                center: '',
                right: 'today,month,agendaWeek,agendaDay'
            };
        } else {
            $('#calendar').removeClass("mobile");
            if (Metronic.isRTL()) {
                h = {
                    right: 'title',
                    center: '',
                    left: 'prev,next,today,month,agendaWeek,agendaDay'
                };
            } else {
                h = {
                    left: 'title',
                    center: '',
                    right: 'prev,next,today,month,agendaWeek,agendaDay'
                };
            }
        }

        $('#calendar').fullCalendar('destroy'); // destroy the calendar
        $('#calendar').fullCalendar({ //re-initialize the calendar
            disableDragging: false,
            header: h,
            editable: true,
            events: [{
                title: 'All Day Event',
                start: new Date(y, m, 1),
                backgroundColor: Metronic.getBrandColor('yellow')
            }, {
                title: 'Long Event',
                start: new Date(y, m, d - 5),
                end: new Date(y, m, d - 2),
                backgroundColor: Metronic.getBrandColor('blue')
            }, {
                title: 'Repeating Event',
                start: new Date(y, m, d - 3, 16, 0),
                allDay: false,
                backgroundColor: Metronic.getBrandColor('red')
            }, {
                title: 'Repeating Event',
                start: new Date(y, m, d + 4, 16, 0),
                allDay: false,
                backgroundColor: Metronic.getBrandColor('green')
            }, {
                title: 'Repeating Event2',
                start: new Date(y, m, d + 4, 16, 0),
                allDay: false,
                backgroundColor: Metronic.getBrandColor('green')
            }, {
                title: 'Repeating Event3',
                start: new Date(y, m, d + 4, 16, 0),
                allDay: false,
                backgroundColor: Metronic.getBrandColor('green')
            }, {
                title: 'Meeting',
                start: new Date(y, m, d, 10, 30),
                allDay: false
            }, {
                title: 'Lunch',
                start: new Date(y, m, d, 12, 0),
                end: new Date(y, m, d, 14, 0),
                backgroundColor: Metronic.getBrandColor('grey'),
                allDay: false
            }, {
                title: 'Birthday Party',
                start: new Date(y, m, d + 1, 19, 0),
                end: new Date(y, m, d + 1, 22, 30),
                backgroundColor: Metronic.getBrandColor('purple'),
                allDay: false
            }, {
                title: 'Click for Google',
                start: new Date(y, m, 28),
                end: new Date(y, m, 29),
                backgroundColor: Metronic.getBrandColor('yellow'),
                url: 'http://google.com/'
            }]
        });


    });
</script>

<?php $this->start('script_inside_doc_ready'); ?>
Custom.init();

$('body').on('shown.bs.tab', function (e) {

var target = $(e.target).attr("href") // activated tab
//alert(target);
})
//$('.inlinesparkline').sparkline('html', { enableTagOptions: true,disableHiddenCheck: true });
//$('#accordion').accordion();
//$('#accordion2').accordion();
$('#tabs').tabs();


<?php $this->end(); ?>

