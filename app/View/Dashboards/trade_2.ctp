<?php if($broker_id==$brokerIdSharp){?>

    <div class="panel panel-success">
        <div class="panel-heading">
            <h4 class="panel-title">
                <a href="#accordion2_3" data-parent="#accordion2" data-toggle="collapse" class="accordion-toggle">
                    For Any information Call to
                </a>
            </h4>
        </div>
        <div class="panel-collapse collapse" id="accordion2_3">


            <div class="panel-body">
                <p>
                    Shajib
                    Mobile: +88 01929912875
                </p>
                <p>
                    Monir
                    Mobile: +88 01678038338
                </p>
            </div>

        </div>
    </div>
<?php   }
else{
    ?>

  

    <div class="panel panel-success">
        <div class="panel-heading">
            <h4 class="panel-title">
                <a href="#accordion2_3" data-parent="#accordion2" data-toggle="collapse" class="accordion-toggle">
                    For Phone Trade Call to
                </a>
            </h4>
        </div>
        <div class="panel-collapse collapse" id="accordion2_3">

            <?php if($broker_id==$brokerIdApex){?>
                <div class="panel-body">
                    <p>
                        Phone: 02 8189295-8 Ext:103
                    </p>
                    <p>
                        Mobile: +88 01721992384
                    </p>
                </div>
            <?php   }?>

            <?php if($broker_id==$brokerIdHac){?>
                <div class="panel-body">
                    <p>
                        Phone: 02 8189295-8 Ext:117
                    </p>
                    <p>
                        Mobile: +88 01929912872
                    </p>
                </div>
            <?php   }?>


        </div>
    </div>
<?php }?>


<div class="row">
    <div class="col-md-12 hidden-xs">
        <div class="portlet light bg-inverse">
            <div class="portlet-title">
                <div class="caption font-green-sharp">
                    <i class="icon-speech font-green-sharp"></i>
                    <span class="caption-subject bold uppercase">DSE AND CSE </span>
                    <span class="caption-helper">buyer seller list...</span>
                </div>
                <div class="tools">
                    <a href="" class="expand" data-original-title="" title="">
                    </a>
                    <a href="" class="remove" data-original-title="" title="">
                    </a>
                    <a href="javascript:;" class="fullscreen" data-original-title="" title="">
                    </a>

                    <!-- <a href="#" id="dse" data-url="<?php /*echo Router::url(array('controller'=>'Dashboards','action'=>'getDseMarketDepth'));*/ ?>/79" class="reload" data-original-title="" title="">
            </a>-->
                </div>
            </div>
            <div class="portlet-body display-hide">
                <div class="row">

                    <div class="col-md-6">
                        <h4>DSE</h4>

                        <div id="market_depth">

                        </div>
                    </div>
                    <div class="col-md-6">
                        <h4>CSE</h4>

                        <div id="market_depth_cse">

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<div id="bootstrap_alerts_demo">
</div>
<div class="row">

    <div class="col-md-12 ">
        <!-- BEGIN Portlet PORTLET-->
        <div class="portlet light">
            <div class="portlet-title tabbable-line">
                <!-- <div class="caption">
                     <i class="icon-pin font-yellow-lemon"></i>
                                             <span class="caption-subject bold font-yellow-lemon uppercase">
                                             Tabs </span>
                     <span class="caption-helper">more samples...</span>
                 </div>-->
                <ul class="nav nav-tabs nav-justified">
                    <li class="active">
                        <a href="#portlet_tab1" data-toggle="tab" aria-expanded="false">
                            SUBMIT </a>
                    </li>
                    <li class="">
                        <a href="#portlet_tab2" data-toggle="tab" aria-expanded="false">
                            ACTIVE <span id="new_active_table"></span> </a>
                    </li>
                    <li class="">
                        <a href="#portlet_tab3" data-toggle="tab" aria-expanded="false">
                            LOCKED <span id="new_locked_table"></span> </a>
                    </li>
                    <li class="">
                        <a href="#portlet_tab4" data-toggle="tab" aria-expanded="false">
                            EXECUTED <span id="new_executed_table"></span> </a>
                    </li>
                    <li class="">
                        <a href="#portlet_tab5" data-toggle="tab" aria-expanded="false">
                            ADVANCE <span id="new_advance_table"></span> </a>
                    </li>
                    <li class="">
                        <a href="#portlet_tab6" data-toggle="tab" aria-expanded="true">
                            DELETED <span id="new_delete_table"></span> </a>
                    </li>
                    <li class="">
                        <a href="#portlet_tab7" data-toggle="tab" aria-expanded="true">
                            WITHDRAW <span id="new_withdraw_table"></span></a>
                    </li>
                    <li class="">
                        <a href="#portlet_tab8" data-toggle="tab" aria-expanded="true">
                            ALL <span id="new_all_table"></span></a>
                    </li>
                    <li class="">
                        <a href="#portlet_tab9" data-toggle="tab" aria-expanded="true" id="portfolio">
                            PORTFOLIO</a>
                    </li>
                </ul>
            </div>
            <div class="portlet-body">
                <div class="tab-content">
                    <div class="tab-pane active" id="portlet_tab1">


                        <div class="row">
                            <div class="col-md-6 ">
                                <div id="market_depthxx">

                                </div>
                            </div>
                            <div class="col-md-6 ">
                                <div id="market_depth_csexx">

                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6 col-sm-6">
                                <!-- BEGIN Portlet PORTLET-->
                                <div class="portlet light bg-inverse">
                                    <div class="portlet-title">
                                        <div class="caption">
                                            <i class="icon-puzzle font-red-flamingo"></i>
											<span class="caption-subject bold font-red-flamingo uppercase">
											Order panel </span>
                                            <span class="caption-helper hidden-xs">Submit your order...</span>
                                        </div>
                                        <div class="tools">
                                            <a href="" class="collapse" data-original-title="" title="">
                                            </a>
                                            <a href="" class="remove" data-original-title="" title="">
                                            </a>
                                            <a href="javascript:;" class="fullscreen" data-original-title="" title="">
                                            </a>
                                        </div>
                                    </div>
                                    <div class="portlet-body">


                                        <form id="Form1" action="javascript:updateChart()" class="form-horizontal form-row-seperated">
                                            <div class="form-body">
                                                <div class="form-group">
                                                    <label class="control-label col-md-3">Advance order</label>

                                                    <div class="col-md-7">
                                                        <div class="input-group">
                                                            <div class="icheck-inline">
                                                                <label>
                                                                    <input id="advance_order_enable" type="checkbox" class="icheck"
                                                                           data-checkbox="icheckbox_flat-grey">

                                                                </label>
                                                                <!--   <span class="help-block hide" id="market_price_help">
                                                           Takes Current Market Price <code>instantly</code>
                                                           </span>-->


                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="form-group hide" id="order_date_div">
                                                    <label class="control-label col-md-3">Order date</label>

                                                    <div class="col-md-7">

                                                        <input id="order_date"  class="form-control form-control-inline input-medium date-picker" type="text" value="<?php echo date('Y-m-d h:i:s');?>" >

												<span class="help-block">
												Future date will be treated as <code> advance order </code> </span>
                                                    </div>
                                                </div>
                                                <div class="form-group">
                                                    <label class="control-label col-md-3">Buy/Sell</label>

                                                    <div class="col-md-7">
                                                        <select id="buyorsell" class="bs-select form-control">
                                                            <option value="1" selected="">Buy</option>
                                                            <option value="2">Sell</option>
                                                        </select>
                                                    </div>
                                                </div>
                                                <div class="form-group">
                                                    <label class="control-label col-md-3">Select</label>

                                                    <div class="col-md-7">
                                                        <?php echo $this->StockBangladesh->getInstrumentBootstrapSelect2($instrumentList, 'allShareList');
                                                        ?>
                                                        <?php echo $this->StockBangladesh->getInstrumentBootstrapSelect2($sellInstrumentList, 'sellShareList');
                                                        ?>
                                                    </div>
                                                </div>
                                                <div class="form-group">
                                                    <label class="control-label col-md-3">Order type</label>

                                                    <div class="col-md-7">
                                                        <div class="input-group">
                                                            <div class="icheck-inline">
                                                                <label>
                                                                    <input id="fixed" type="radio" name="radio2" checked class="icheck"
                                                                           data-radio="iradio_line-blue" data-label="Fixed">
                                                                </label>
                                                                <label>
                                                                    <input id="range" type="radio" name="radio2" class="icheck"
                                                                           data-radio="iradio_line-blue" data-label="Range">
                                                                </label>

                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="form-group">
                                                    <label class="control-label col-md-3">Execute</label>

                                                    <div class="col-md-7">
                                                        <div class="input-group">
                                                            <div class="icheck-inline">
                                                                <label>
                                                                    <input id="market_price" type="checkbox" class="icheck"
                                                                           data-checkbox="icheckbox_flat-grey"> At market price

                                                                </label>
                                                        <span class="help-block hide" id="market_price_help">
												Takes Current Market Price <code>instantly</code>
												</span>


                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>


                                                <div class="form-group" id="fixed_price">
                                                    <label class="control-label col-md-3">Price</label>

                                                    <div class="col-md-7">
                                                        <input type="number" step=".1" class="form-control" placeholder="price"
                                                               id="fixed_price_input"
                                                               value="1" name="fixed_price_input" required/>
                                                    </div>
                                                </div>
                                                <div class="form-group hide" id="range_price">
                                                    <label class="control-label col-md-3">Price</label>

                                                    <div class="col-md-4">
                                                        <input type="number" class="form-control" placeholder="start price"
                                                               id="range_price_input_start" name="range_price_input_start" required/>
                                                    </div>
                                                    <div class="col-md-3">
                                                        <input type="number" class="form-control" placeholder="end price" id="range_price_input_end"
                                                               name="range_price_input_end" required/>
                                                    </div>
                                                </div>
                                                <div class="form-group">
                                                    <label class="control-label col-md-3"></label>

                                                    <div class="col-md-7">
                                                        <div class="noUi-control noUi-info" id="slider_1">
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="form-group">
                                                    <label class="control-label col-md-3">Buy/Sell Quantity</label>

                                                    <div class="col-md-7">
                                                        <input id="qty" min="1" name="qty" type="number" class="form-control" placeholder="Quantity"
                                                               required/>
                                                    </div>
                                                </div>
                                                <div class="form-group">
                                                    <label class="control-label col-md-3">Drip</label>

                                                    <div class="col-md-7">
                                                        <input type="number" class="form-control" placeholder="drip" id="drip_quantity"
                                                               name="drip_quantity"/>
                                                    </div>
                                                </div>
                                                <div>
                                                    <button type="button" data-loading-text="sending..."
                                                            class="demo-loading-btn btn btn-primary btn-block">
                                                        Send order
                                                    </button>

                                                    <!--   <button id="Button1" name="Button1" type="submit" class="btn primary btn-block"><i class="fa fa-check"></i>
                                                           Send order
                                                       </button>-->

                                                </div>
                                            </div>

                                        </form>


                                    </div>
                                </div>
                                <!-- END GRID PORTLET-->
                            </div>
                            <div class="col-md-6 col-sm-6">
                                <!-- BEGIN Portlet PORTLET-->
                                <div class="portlet light bg-inverse">
                                    <div class="portlet-title">
                                        <div class="caption font-green-sharp">
                                            <i class="icon-speech font-green-sharp"></i>
                                            <span class="caption-subject bold uppercase" id="instrument_code"> </span>
                                            <span class="caption-helper">trade info...</span>
                                        </div>
                                        <div class="tools">
                                            <a href="" class="collapse" data-original-title="" title="">
                                            </a>
                                            <a href="" class="remove" data-original-title="" title="">
                                            </a>
                                            <a href="javascript:;" class="fullscreen" data-original-title="" title="">
                                            </a>
                                        </div>
                                    </div>
                                    <div class="portlet-body">
                                        <div id="buyinfo">
                                            <div class="row list-separated profile-stat">
                                                <div class="col-md-4 col-sm-4 col-xs-6">
                                                    <div class="uppercase profile-stat-title" id="balance">
                                                        <?php echo $balance - $lastUsed; ?>
                                                    </div>
                                                    <div class="uppercase profile-stat-text">
                                                        Purchase power
                                                    </div>
                                                </div>
                                                <div class="col-md-4 col-sm-4 col-xs-6">
                                                    <div class="uppercase profile-stat-title" id="ltp">
                                                        0
                                                    </div>
                                                    <div class="uppercase profile-stat-text">
                                                        Last trade price
                                                    </div>
                                                </div>
                                                <div class="col-md-4 col-sm-4 col-xs-6">
                                                    <div class="uppercase profile-stat-title" id="category">
                                                        A
                                                    </div>
                                                    <div class="uppercase profile-stat-text">
                                                        Category
                                                    </div>
                                                </div>
                                            </div>
                                            <table class="table table-striped table-bordered table-advance table-hover">

                                                <tbody>

                                                <tr>
                                                    <td>
                                                        <a href="#">
                                                            High </a>
                                                    </td>
                                                    <td class="hidden-xs" id="high">


                                                    </td>

                                                </tr>
                                                <tr>
                                                    <td>
                                                        <a href="#">
                                                            Low </a>
                                                    </td>
                                                    <td class="hidden-xs" id="low">

                                                    </td>

                                                </tr>
                                                <tr>
                                                    <td>
                                                        <a href="#">
                                                            Commision </a>
                                                    </td>
                                                    <td class="hidden-xs" id="commission">

                                                    </td>

                                                </tr>
                                                <tr>
                                                    <td>
                                                        <a href="#">
                                                            Total </a>
                                                    </td>
                                                    <td class="hidden-xs" id="total">

                                                    </td>

                                                </tr>
                                                </tbody>
                                            </table>
                                        </div>
                                        <div class="hide" id="sellinfo">

                                            <div class="row list-separated profile-stat">
                                                <div class="col-md-4 col-sm-4 col-xs-6">
                                                    <div class="uppercase profile-stat-title" id="saleAbleShares">

                                                    </div>
                                                    <div class="uppercase profile-stat-text">
                                                        Saleable Quantity
                                                    </div>
                                                </div>
                                                <div class="col-md-4 col-sm-4 col-xs-6">
                                                    <div class="uppercase profile-stat-title" id="totalQuantity">

                                                    </div>
                                                    <div class="uppercase profile-stat-text">
                                                        Total Quantity
                                                    </div>
                                                </div>
                                                <div class="col-md-4 col-sm-4 col-xs-6">
                                                    <div class="uppercase profile-stat-title" id="sale_ltp">

                                                    </div>
                                                    <div class="uppercase profile-stat-text">
                                                        Last trade price
                                                    </div>
                                                </div>

                                            </div>
                                            <table class="table table-striped table-bordered table-advance table-hover">

                                                <tbody>

                                                <tr>
                                                    <td>
                                                        <a href="#">
                                                            Avg buy cost </a>
                                                    </td>
                                                    <td class="hidden-xs" id="avgCost">


                                                    </td>

                                                </tr>
                                                <tr>
                                                    <td>
                                                        <a href="#">
                                                            Category </a>
                                                    </td>
                                                    <td class="hidden-xs" id="sale_category">


                                                    </td>

                                                </tr>
                                                <tr>
                                                    <td>
                                                        <a href="#">
                                                            High </a>
                                                    </td>
                                                    <td class="hidden-xs" id="sale_high">


                                                    </td>

                                                </tr>
                                                <tr>
                                                    <td>
                                                        <a href="#">
                                                            Low </a>
                                                    </td>
                                                    <td class="hidden-xs" id="sale_low">

                                                    </td>

                                                </tr>
                                                <tr>
                                                    <td>
                                                        <a href="#">
                                                            Commision </a>
                                                    </td>
                                                    <td class="hidden-xs" id="sale_commission">

                                                    </td>

                                                </tr>
                                                <tr>
                                                    <td>
                                                        <a href="#">
                                                            Total </a>
                                                    </td>
                                                    <td class="hidden-xs" id="sale_total">

                                                    </td>

                                                </tr>
                                                </tbody>
                                            </table>

                                        </div>


                                        <!-- <button type="button" class="btn btn-circle blue-madison">Buyer seller list</button>
                                         <button type="button" class="btn btn-circle green-meadow">Update purchase power</button>-->

                                    </div>
                                </div>
                                <!-- END GRID PORTLET-->
                                <div class="portlet light bg-inverse">
                                    <div class="portlet-title">
                                        <div class="caption font-green-sharp">
                                            <i class="icon-speech font-green-sharp"></i>
                                            <span class="caption-subject bold uppercase">DSE AND CSE </span>
                                            <span class="caption-helper">buyer seller list...</span>
                                        </div>
                                        <div class="tools">
                                            <a href="" class="collapse" data-original-title="" title="">
                                            </a>
                                            <a href="" class="remove" data-original-title="" title="">
                                            </a>
                                            <a href="javascript:;" class="fullscreen" data-original-title="" title="">
                                            </a>

                                            <!-- <a href="#" id="dse" data-url="<?php /*echo Router::url(array('controller'=>'Dashboards','action'=>'getDseMarketDepth'));*/ ?>/79" class="reload" data-original-title="" title="">
            </a>-->
                                        </div>
                                    </div>
                                    <div class="portlet-body">
                                        <div class="row">

                                            <div class="col-md-6">
                                                <h4>DSE</h4>

                                                <div id="market_depth2">

                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <h4>CSE</h4>

                                                <div id="market_depth_cse2">

                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                            </div>
                        </div>


                    </div>
                    <div class="tab-pane" id="portlet_tab2">

                        <table class="table table-striped table-bordered table-advance table-hover" id="active_table">
                            <thead>
                            <tr>
                                <th>
                                    ID
                                </th>
                                <th class="hidden-xs">
                                    <i class="icon-user"></i> BO Code
                                </th>
                                <th>
                                    <i class="icon-bag"></i> Type
                                </th>
                                <th>
                                    <i class="fa fa-unlink"></i> Symbol
                                </th>
                                <th>
                                    <i class="fa fa-sliders"></i> Qty
                                </th>
                                <th>
                                    <i class="icon-arrow-right"></i> Start Range
                                </th>
                                <th>
                                    <i class="icon-arrow-left"></i> End Range
                                </th>
                                <th>
                                    <i class="icon-calendar"></i> Order Time
                                </th>
                                <th>
                                    <i class="icon-note"></i> Drip
                                </th>
                                <th>
                                    <i class="icon-layers"></i> Status
                                </th>
                                <th>
                                    <i class="icon-grid"></i> CMD
                                </th>
                            </tr>
                            </thead>
                            <tbody id="active_order">

                            </tbody>
                        </table>

                    </div>
                    <div class="tab-pane" id="portlet_tab3">
                        <table class="table table-striped table-bordered table-advance table-hover" id="locked_table">
                            <thead>
                            <tr>
                                <th>
                                    ID
                                </th>
                                <th class="hidden-xs">
                                    <i class="icon-user"></i> BO Code
                                </th>
                                <th>
                                    <i class="icon-bag"></i> Type
                                </th>
                                <th>
                                    <i class="fa fa-unlink"></i> Symbol
                                </th>
                                <th>
                                    <i class="fa fa-sliders"></i> Qty
                                </th>
                                <th>
                                    <i class="icon-arrow-right"></i> Start Range
                                </th>
                                <th>
                                    <i class="icon-arrow-left"></i> End Range
                                </th>
                                <th>
                                    <i class="icon-calendar"></i> Order Time
                                </th>
                                <th>
                                    <i class="icon-note"></i> Drip
                                </th>
                                <th>
                                    <i class="icon-layers"></i> Status
                                </th>
                                <th>
                                    <i class="icon-grid"></i> CMD
                                </th>
                            </tr>
                            </thead>
                            <tbody id="locked_order">

                            </tbody>
                        </table>
                    </div>
                    <div class="tab-pane" id="portlet_tab4">
                        <table class="table table-striped table-bordered table-advance table-hover" id="executed_table">
                            <thead>
                            <tr>
                                <th>
                                    ID
                                </th>
                                <th class="hidden-xs">
                                    <i class="icon-user"></i> BO Code
                                </th>
                                <th>
                                    <i class="icon-bag"></i> Type
                                </th>
                                <th>
                                    <i class="fa fa-unlink"></i> Symbol
                                </th>
                                <th>
                                    <i class="fa fa-sliders"></i> Qty
                                </th>
                                <th>
                                    <i class="icon-arrow-right"></i> Start Range
                                </th>
                                <th>
                                    <i class="icon-arrow-left"></i> End Range
                                </th>
                                <th>
                                    <i class="icon-calendar"></i> Order Time
                                </th>
                                <th>
                                    <i class="icon-note"></i> Drip
                                </th>
                                <th>
                                    <i class="icon-layers"></i> Status
                                </th>
                                <th>
                                    <i class="icon-grid"></i> CMD
                                </th>
                            </tr>
                            </thead>
                            <tbody id="executed_order">

                            </tbody>
                        </table>
                    </div>
                    <div class="tab-pane" id="portlet_tab5">
                        <table class="table table-striped table-bordered table-advance table-hover" id="advance_table">
                            <thead>
                            <tr>
                                <th>
                                    ID
                                </th>
                                <th class="hidden-xs">
                                    <i class="icon-user"></i> BO Code
                                </th>
                                <th>
                                    <i class="icon-bag"></i> Type
                                </th>
                                <th>
                                    <i class="fa fa-unlink"></i> Symbol
                                </th>
                                <th>
                                    <i class="fa fa-sliders"></i> Qty
                                </th>
                                <th>
                                    <i class="icon-arrow-right"></i> Start Range
                                </th>
                                <th>
                                    <i class="icon-arrow-left"></i> End Range
                                </th>
                                <th>
                                    <i class="icon-calendar"></i> Order Time
                                </th>
                                <th>
                                    <i class="icon-note"></i> Drip
                                </th>
                                <th>
                                    <i class="icon-layers"></i> Status
                                </th>
                                <th>
                                    <i class="icon-grid"></i> CMD
                                </th>
                            </tr>
                            </thead>
                            <tbody id="advance_order">

                            </tbody>
                        </table>
                    </div>
                    <div class="tab-pane" id="portlet_tab6">
                        <table class="table table-striped table-bordered table-advance table-hover" id="delete_table">
                            <thead>
                            <tr>
                                <th>
                                    ID
                                </th>
                                <th class="hidden-xs">
                                    <i class="icon-user"></i> BO Code
                                </th>
                                <th>
                                    <i class="icon-bag"></i> Type
                                </th>
                                <th>
                                    <i class="fa fa-unlink"></i> Symbol
                                </th>
                                <th>
                                    <i class="fa fa-sliders"></i> Qty
                                </th>
                                <th>
                                    <i class="icon-arrow-right"></i> Start Range
                                </th>
                                <th>
                                    <i class="icon-arrow-left"></i> End Range
                                </th>
                                <th>
                                    <i class="icon-calendar"></i> Order Time
                                </th>
                                <th>
                                    <i class="icon-note"></i> Drip
                                </th>
                                <th>
                                    <i class="icon-layers"></i> Status
                                </th>
                                <th>
                                    <i class="icon-grid"></i> CMD
                                </th>
                            </tr>
                            </thead>
                            <tbody id="delete_order">

                            </tbody>
                        </table>
                    </div>
                    <div class="tab-pane" id="portlet_tab7">
                        <table class="table table-striped table-bordered table-advance table-hover" id="withdraw_table">
                            <thead>
                            <tr>
                                <th>
                                    ID
                                </th>
                                <th class="hidden-xs">
                                    <i class="icon-user"></i> BO Code
                                </th>
                                <th>
                                    <i class="icon-bag"></i> Type
                                </th>
                                <th>
                                    <i class="fa fa-unlink"></i> Symbol
                                </th>
                                <th>
                                    <i class="fa fa-sliders"></i> Qty
                                </th>
                                <th>
                                    <i class="icon-arrow-right"></i> Start Range
                                </th>
                                <th>
                                    <i class="icon-arrow-left"></i> End Range
                                </th>
                                <th>
                                    <i class="icon-calendar"></i> Order Time
                                </th>
                                <th>
                                    <i class="icon-note"></i> Drip
                                </th>
                                <th>
                                    <i class="icon-layers"></i> Status
                                </th>
                                <th>
                                    <i class="icon-grid"></i> CMD
                                </th>
                            </tr>
                            </thead>
                            <tbody>

                            </tbody>
                        </table>
                    </div>
                    <div class="tab-pane" id="portlet_tab8">
                        <table class="table table-striped table-bordered table-advance table-hover" id="all_table">
                            <thead>
                            <tr>
                                <th>
                                    ID
                                </th>
                                <th class="hidden-xs">
                                    <i class="icon-user"></i> BO Code
                                </th>
                                <th>
                                    <i class="icon-bag"></i> Type
                                </th>
                                <th>
                                    <i class="fa fa-unlink"></i> Symbol
                                </th>
                                <th>
                                    <i class="fa fa-sliders"></i> Qty
                                </th>
                                <th>
                                    <i class="icon-arrow-right"></i> Start Range
                                </th>
                                <th>
                                    <i class="icon-arrow-left"></i> End Range
                                </th>
                                <th>
                                    <i class="icon-calendar"></i> Order Time
                                </th>
                                <th>
                                    <i class="icon-note"></i> Drip
                                </th>
                                <th>
                                    <i class="icon-layers"></i> Status
                                </th>
                                <th>
                                    <i class="icon-grid"></i> CMD
                                </th>
                            </tr>
                            </thead>
                            <tbody>

                            </tbody>
                        </table>
                    </div>
                    <div class="tab-pane" id="portlet_tab9">
                        <div id="portfolio_body">

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<div class="row">
    <div class="col-md-12 hidden-xs">

        <div class="portlet box blue">
            <div class="portlet-title">
                <div class="caption">
                    <i class="fa fa-gift"></i>Multiple Portfolio Management List
                </div>
                <div class="tools">
                    <a href="javascript:;" class="collapse" data-original-title="" title="">
                    </a>
                    <a href="#portlet-config" data-toggle="modal" class="config" data-original-title="" title="">
                    </a>
                    <a href="javascript:;" class="reload" data-original-title="" title="">
                    </a>
                    <a href="javascript:;" class="remove" data-original-title="" title="">
                    </a>
                </div>
            </div>
            <div class="portlet-body">

                <?php foreach ($userListInfo as $user) {
                    $userId = $user['User']['id'];
                    $username = $user['User']['username'];
                    $internal_ref_no = $user['User']['internal_ref_no']; ?>
                    <a href="<?php echo Router::url('/', true) ?>Users/multi_access/<?php echo $userId; ?>"
                       class="icon-btn">
                        <i class="fa fa-bar-chart-o"></i>

                        <div>
                            <?php echo $username; ?>
                        </div>
                        <span class="badge badge-success"><?php echo $internal_ref_no; ?></span>
                    </a>
                <?php } ?>

            </div>
        </div>
    </div>
</div>

<div class="row">
    <div class="col-md-12 hidden-xs">

        <div class="portlet box blue">
            <div class="portlet-title">
                <div class="caption">
                    <i class="fa fa-gift"></i>User(s) Introduced By You
                </div>
                <div class="tools">
                    <a href="javascript:;" class="collapse" data-original-title="" title="">
                    </a>
                    <a href="#portlet-config" data-toggle="modal" class="config" data-original-title="" title="">
                    </a>
                    <a href="javascript:;" class="reload" data-original-title="" title="">
                    </a>
                    <a href="javascript:;" class="remove" data-original-title="" title="">
                    </a>
                </div>
            </div>
            <div class="portlet-body">

                <?php foreach ($introducedUserList as $user) {
                   // $userId = $user['User']['id'];
                    $username = $user['User']['username'];
                    $internal_ref_no = $user['User']['internal_ref_no']; ?>
                    <a href=""
                       class="icon-btn">
                        <i class="fa fa-bar-chart-o"></i>

                        <div>
                            <?php echo $username; ?>
                        </div>
                        <span class="badge badge-success"><?php echo $internal_ref_no; ?></span>
                    </a>
                <?php } ?>

            </div>
        </div>
    </div>
</div>

<script>

    $(function () {

        toastr.options = {
            "closeButton": true,
            "debug": false,
            "positionClass": "toast-top-right",
            "onclick": null,
            "showDuration": "1000",
            "hideDuration": "1000",
            "timeOut": "5000",
            "extendedTimeOut": "1000",
            "showEasing": "swing",
            "hideEasing": "linear",
            "showMethod": "fadeIn",
            "hideMethod": "fadeOut"
        }

        $('.date-picker').datepicker({
            rtl: Metronic.isRTL(),
            orientation: "left",
            startDate:"+0d",
            format:"yyyy-mm-dd",
            daysOfWeekDisabled: '5,6',
            autoclose: true
        });

        $('.bs-select').selectpicker({
            iconBase: 'fa',
            tickIcon: 'fa-check'
        });


        $("#sellShareList").selectpicker('hide');
        $("#buyorsell")
            .on("change", function () {
                /* 1=buy  2=sell*/
                var bOrS = $("#buyorsell").selectpicker("val");
                if (bOrS == 1) {
                    $("#allShareList").selectpicker('show');
                    $("#sellShareList").selectpicker('hide');
                    $('#buyinfo').removeClass('hide');
                    $('#sellinfo').addClass('hide');
                } else {
                    $("#allShareList").selectpicker('hide');
                    $("#sellShareList").selectpicker('show');
                    $('#sellinfo').removeClass('hide');
                    $('#buyinfo').addClass('hide');
                }
            })

        var priceType = 'fixed';

        $("#fixed").on('ifChecked', function (event) {
            //  alert(event.type + ' callback');
            priceType = 'fixed';
            $('#fixed_price').removeClass('hide');
            $('#range_price').addClass('hide');
        });

        $("#fixed").on('ifUnchecked', function (event) {
            priceType = 'range';
            $('#fixed_price').addClass('hide');
            $('#range_price').removeClass('hide');
        });

        var execute_at_market_price = 0;
        $("#market_price").on('ifChecked', function (event) {
            execute_at_market_price = 1;
            $('#market_price_help').removeClass('hide');
            $('#fixed_price_input').prop('disabled', true);
            $('#range_price_input_start').prop('disabled', true);
            $('#range_price_input_end').prop('disabled', true);

        });
        $("#market_price").on('ifUnchecked', function (event) {
            execute_at_market_price = 0;
            $('#market_price_help').addClass('hide');
            $('#fixed_price_input').prop('disabled', false);
            $('#range_price_input_start').prop('disabled', false);
            $('#range_price_input_end').prop('disabled', false);


        });

        var advance_order_enable = 0;
        $("#advance_order_enable").on('ifChecked', function (event) {
            advance_order_enable = 1;
            $('#order_date_div').removeClass('hide');

        });
        $("#advance_order_enable").on('ifUnchecked', function (event) {
            advance_order_enable = 0;
            $('#order_date_div').addClass('hide');

        });

        var buyprice = 0;
        var initialBalance =<?php echo $balance; ?>;
        var portfolio_id =<?php echo $portfolio_id; ?>;
        var broker_fee =<?php echo $broker_fee;?>;
        var lastUsed =<?php echo $lastUsed;?>;
        var accepting_order =<?php echo $accepting_order;?>;
        var circuit_breaker =<?php echo $circuit_breaker;?>;
        var circuitList =JSON.parse( '<?php echo json_encode($circuitList) ?>' );


        var saleAbleShares = 0;

        function updateBalance() {
            balance = parseFloat(initialBalance) - parseFloat(lastUsed);
            //  alert('bala= '+balance+' initialBalance= '+initialBalance+' lastUsed= '+lastUsed);
        }

        updateBalance();
        function setSlider(buyprice) {

            var com = (broker_fee / 100) * buyprice;
            buypriceWithCom = parseFloat(com) + parseFloat(buyprice);
            //alert('bala= '+balance+' buyprice= '+buyprice+' lastused= '+lastUsed);
            var max = parseFloat(balance) / parseFloat(buypriceWithCom);

            max = Math.floor(max);


            $('#slider_1').noUiSlider({
                start: 0,
                step: 1,
                connect: "lower",

                format: wNumb({
                    decimals: 0


                }),
                range: {
                    'min': 1,
                    'max': max
                }
            }, true);
            $('#slider_1').Link('lower').to($('#qty'));
            $('#slider_1').val(1);

            $("#slider_1").on({
                slide: function () {
                    var sliderQty = $("#slider_1").val();
                    var usedAmount = buyprice * sliderQty;
                    com = (broker_fee / 100) * usedAmount;
                    totalCostWithCom = usedAmount + com

                    var leftAmount = balance - usedAmount - com;
                    //leftAmount.toFixed(2);
                    $("#balance").html(leftAmount.toFixed(2));
                    $("#commission").html(com.toFixed(2));
                    $("#total").html(totalCostWithCom.toFixed(2));
                }
            });
        }

        function setSliderForSell(max) {
            min = 1;
            //  alert('bala= '+balance+' buyprice= '+buyprice+' lastused= '+lastUsed);
            if (max < 1)
                min = 0;

            $('#slider_1').noUiSlider({
                start: 0,
                step: 1,
                connect: "lower",

                format: wNumb({
                    decimals: 0


                }),
                range: {
                    'min': min,
                    'max': max
                }
            }, true);
            $('#slider_1').Link('lower').to($('#qty'));
            $('#slider_1').val(min);

            $("#slider_1").on({
                slide: function () {
                    var sliderQty = $("#slider_1").val();

                    var leftSaleAbleShares = saleAbleShares - sliderQty;
                    sellPrice = $("#fixed_price_input").val();


                    var usedAmount = sellPrice * sliderQty;
                    com = (broker_fee / 100) * usedAmount;
                    totalCostWithCom = usedAmount - com
                    //leftAmount.toFixed(2);
                    $("#saleAbleShares").html(leftSaleAbleShares);
                    $("#sale_commission").html(com.toFixed(2));
                    $("#sale_total").html(totalCostWithCom.toFixed(2));
                }
            });
        }


        $("#fixed_price_input")
            .on("change", function () {

                var buyprice = $("#fixed_price_input").val();
                var sliderQty = 1;
                var usedAmount = buyprice * sliderQty;
                var bOrS = $("#buyorsell").selectpicker("val");
                if (bOrS == 1) {
                    setSlider(buyprice);
                } else {

                }

                com = (broker_fee / 100) * usedAmount;
                totalCostWithCom = usedAmount + com

                var leftAmount = balance - usedAmount - com;
                //leftAmount.toFixed(2);
                $("#balance").html(leftAmount.toFixed(2));
                $("#range_price_input_start").val(buyprice);
                $("#range_price_input_end").val(buyprice);
                $("#commission").html(com.toFixed(2));
                $("#total").html(totalCostWithCom.toFixed(2));

            });
        $("#range_price_input_start")
            .on("change", function () {

                var buyprice = $("#range_price_input_start").val();
                var sliderQty = 1;
                var usedAmount = buyprice * sliderQty;
                setSlider(buyprice);
                com = (broker_fee / 100) * usedAmount;
                totalCostWithCom = usedAmount + com

                var leftAmount = balance - usedAmount - com;
                //leftAmount.toFixed(2);
                $("#balance").html(leftAmount.toFixed(2));
                $("#fixed_price_input").val(buyprice);
                //   $("#range_price_input_end").val(buyprice);
                $("#commission").html(com.toFixed(2));
                $("#total").html(totalCostWithCom.toFixed(2));

            });

        $("#qty")
            .on("change", function () {
                var buyprice = $("#fixed_price_input").val();
                var sliderQty = $("#qty").val();


                var bOrS = $("#buyorsell").selectpicker("val");
                if (bOrS == 1) {
                    var usedAmount = buyprice * sliderQty;

                    com = (broker_fee / 100) * usedAmount;
                    totalCostWithCom = usedAmount + com

                    var leftAmount = balance - usedAmount - com;
                    //leftAmount.toFixed(2);
                    $("#balance").html(leftAmount.toFixed(2));
                    $("#commission").html(com.toFixed(2));
                    $("#total").html(totalCostWithCom.toFixed(2));
                } else {

                    var leftSaleAbleShares = saleAbleShares - sliderQty;
                    sellPrice = $("#fixed_price_input").val();


                    var usedAmount = sellPrice * sliderQty;
                    com = (broker_fee / 100) * usedAmount;
                    totalCostWithCom = usedAmount - com
                    //leftAmount.toFixed(2);
                    $("#saleAbleShares").html(leftSaleAbleShares);
                    $("#sale_commission").html(com.toFixed(2));
                    $("#sale_total").html(totalCostWithCom.toFixed(2));

                }


            });


        /* when any share select from buy dropdown --start*/

        $("#allShareList")
            .on("change", function () {

                var instrumentId = $("#allShareList").selectpicker("val");
                var instrument_code = $("#allShareList option:selected").text();


                var ajaxUrl = '<?php echo Router::url('/', true)?>Dashboards/getPrice/';

                $.ajax({
                    type: "POST",
                    dataType: 'json',
                    url: ajaxUrl,
                    data: {instrumentId: instrumentId}

                }).done(function (data) {
                    if(data.spot_last_traded_price!=0)
                    {
                        $("#ltp").html(data.spot_last_traded_price);
                        $("#fixed_price_input").val(data.spot_last_traded_price);
                        $("#range_price_input_start").val(data.spot_last_traded_price);
                        $("#range_price_input_end").val(data.spot_last_traded_price);
                    }
                    else
                    {
                        $("#ltp").html(data.pub_last_traded_price);
                        $("#fixed_price_input").val(data.pub_last_traded_price);
                        $("#range_price_input_start").val(data.pub_last_traded_price);
                        $("#range_price_input_end").val(data.pub_last_traded_price);
                    }
                    $("#high").html(data.high_price);
                    $("#low").html(data.low_price);
                    $("#instrument_code").html(instrument_code);
                    $("#category").html(data.category);


                    //$("#balance").html(data.balance);
                    initialBalance = data.balance;
                    updateBalance();
                    //balance=data.balance;

                    setSlider(data.pub_last_traded_price);

                });

                var getDseMarketDepthUrl = '<?php echo Router::url('/', true)?>Dashboards/getDseMarketDepth/' + instrumentId;
                $.ajax({
                    type: "POST",
                    dataType: 'html',
                    url: getDseMarketDepthUrl,
                    async: true,
                    data: {instrumentId: instrumentId}

                }).done(function (data) {

                    $("#market_depth").html(data);
                    $("#market_depth2").html(data);
                    $('#dse').attr("data-url", getDseMarketDepthUrl);

                });
                var getCseMarketDepthUrl = '<?php echo Router::url('/', true)?>Dashboards/getCseMarketDepth/+instrumentId';
                $.ajax({
                    type: "POST",
                    dataType: 'html',
                    url: getCseMarketDepthUrl,
                    async: true,
                    data: {instrumentId: instrumentId}

                }).done(function (data) {
                    $("#market_depth_cse").html(data);
                    $("#market_depth_cse2").html(data);
                    $('#dse').attr("data-url", getCseMarketDepthUrl);

                });


            });
        /* when any share select from buy dropdown --end*/


        /* when any share select from sell dropdown --start*/

        $("#sellShareList")
            .on("change", function () {

                var instrumentId = $("#sellShareList").selectpicker("val");
                var instrument_code = $("#sellShareList option:selected").text();

                var ajaxUrl = '<?php echo Router::url('/', true)?>Dashboards/getSellPrice/';

                $.ajax({
                    type: "POST",
                    dataType: 'json',
                    url: ajaxUrl,
                    data: {instrumentId: instrumentId}

                }).done(function (data) {
                    $("#sale_ltp").html(data.pub_last_traded_price);
                    $("#sale_category").html(data.category);
                    $("#fixed_price_input").val(data.pub_last_traded_price);
                    $("#range_price_input_start").val(data.pub_last_traded_price);
                    $("#range_price_input_end").val(data.pub_last_traded_price);
                    $("#sale_high").html(data.high_price);
                    $("#sale_low").html(data.low_price);
                    $("#saleAbleShares").html(data.saleAbleShares);
                    $("#totalQuantity").html(data.totalQuantity);
                    $("#avgCost").html(data.avgCost);
                    $("#instrument_code").html(instrument_code);
                    //$("#balance").html(data.balance);
                    //      $("#market_depth2").html(data.market_depth);
                    //     $("#market_depth_cse2").html(data.market_depth_cse);
                    saleAbleShares = data.saleAbleShares;

                    setSliderForSell(saleAbleShares);

                });

                var getDseMarketDepthUrl = '<?php echo Router::url('/', true)?>Dashboards/getDseMarketDepth/' + instrumentId;
                $.ajax({
                    type: "POST",
                    dataType: 'html',
                    url: getDseMarketDepthUrl,
                    async: true,
                    data: {instrumentId: instrumentId}

                }).done(function (data) {

                    $("#market_depth").html(data);
                    $("#market_depth2").html(data);
                    $('#dse').attr("data-url", getDseMarketDepthUrl);

                });
                var getCseMarketDepthUrl = '<?php echo Router::url('/', true)?>Dashboards/getCseMarketDepth/+instrumentId';
                $.ajax({
                    type: "POST",
                    dataType: 'html',
                    url: getCseMarketDepthUrl,
                    async: true,
                    data: {instrumentId: instrumentId}

                }).done(function (data) {
                    $("#market_depth_cse").html(data);
                    $("#market_depth_cse2").html(data);
                    $('#dse').attr("data-url", getCseMarketDepthUrl);

                });


            });

        /* when any share select from sell dropdown --end*/


        $('.demo-loading-btn')
            .click(function () {

                //$("#form1").valid();

                if(!advance_order_enable) {
                    if (!accepting_order) {
                        toastr.warning("Currently we are not accepting order. Please try later", "TRY LATER");
                        return;
                    }
                }

                if ($("#Form1").valid()) {

                    var temp_rate = parseFloat($("#fixed_price_input").val());
                    var temp_rate_start_range =parseFloat($("#range_price_input_start").val()) ;
                    var temp_rate_end_range =parseFloat( $("#range_price_input_end").val());
                    var orderType = $("#buyorsell").selectpicker("val");


                    if (orderType == 1)
                    {
                        var instrumentId = $("#allShareList").selectpicker("val");
                        var instrumentName = $("#allShareList option:selected").text();
                    }

                    else
                    {
                        var instrumentId = $("#sellShareList").selectpicker("val");
                        var instrumentName = $("#sellShareList option:selected").text();
                    }


                    if (instrumentId == 0) {
                        toastr.error("You must select a share", "Select share");
                        return;
                    }
                    var btn = $(this);
                    btn.button('loading');

                    if(circuit_breaker) {

                        var lower_limit=parseFloat(circuitList[instrumentName]['lower_limit']);
                        var upper_limit=parseFloat(circuitList[instrumentName]['upper_limit']);

                        if (typeof circuitList[instrumentName] === 'undefined' )
                        {

                            toastr.info("no circuit breaker");
                            var rate=temp_rate;
                            var rate_start_range=temp_rate_start_range;
                            var rate_end_range=temp_rate_end_range;

                        }
                        else{

                            /* if(circuitList[instrumentName]['lower_limit']<=temp_rate && temp_rate<=circuitList[instrumentName]['upper_limit'])
                             {
                             // toastr.info("rate ok for fixed");
                             var rate=temp_rate;
                             var rate_start_range=temp_rate_start_range;
                             var rate_end_range=temp_rate_end_range;
                             }*/

                            if(lower_limit<=temp_rate_start_range && temp_rate_start_range<=upper_limit && lower_limit<=temp_rate_end_range && temp_rate_end_range<=upper_limit)
                            {
                                //toastr.info("rate ok");
                                var rate=temp_rate;
                                var rate_start_range=temp_rate_start_range;
                                var rate_end_range=temp_rate_end_range;
                            }
                            else
                            {
                                toastr.error("You have to buy sell "+instrumentName+" within the price limit of "+circuitList[instrumentName]['lower_limit']+" to "+circuitList[instrumentName]['upper_limit']);
                                var rate=0;
                                var rate_start_range=0;
                                var rate_end_range=0;
                                // alert(circuitList[instrumentName]['lower_limit']);
                                // alert(circuitList[instrumentName]['upper_limit']);
                                btn.button('reset');
                                return;
                            }

                        }


                    }

                    else
                    {
                        var rate=temp_rate;
                        var rate_start_range=temp_rate_start_range;
                        var rate_end_range=temp_rate_end_range;
                    }


                    var amount = $("#qty").val();
                    var drip_quantity = $("#drip_quantity").val();
                    var order_date = $("#order_date").val();
                    var ajaxUrl = '<?php echo Router::url('/', true)?>Orders/submitOrder/';

                    $.ajax({
                        type: "POST",
                        dataType: 'json',
                        url: ajaxUrl,
                        data: {
                            instrumentId: instrumentId,
                            orderType: orderType,
                            amount: amount,
                            priceType: priceType,
                            rate: rate,
                            rate_start_range: rate_start_range,
                            rate_end_range: rate_end_range,
                            execute_at_market_price: execute_at_market_price,
                            drip_quantity: drip_quantity,
                            broker_fee: broker_fee,
                            order_date: order_date
                        }

                    }).done(function (data) {

                        btn.button('reset');


                        if (data.toFixed(2)) {

                            if (orderType == 1) {
                                lastUsed = lastUsed + data;
                                // alert('bala= '+balance+' sasads= '+data+' lastUsed= '+lastUsed);
                                updateBalance();
                                setSlider($("#fixed_price_input").val());
                            }

                            if (orderType == 2) {

                                saleAbleShares = saleAbleShares - $("#qty").val();
                                setSliderForSell(saleAbleShares);

                            }
                            if(advance_order_enable) {
                                toastr.info("Your order has been submitted as advance order", "Advance order");

                                Metronic.alert({
                                    type: 'info',  // alert's type
                                    message: 'Info : Your order will be placed according to your order date if it pass by following conditions <br> 1. At order date you have sufficient purchase power <br> 2. At order date you have mature share in case of sale order <br /> Otherwise you will found this order in delete tab ',  // alert's message
                                    close: true // make alert closable
                                });



                            }else
                            {
                                toastr.success("Our operator are working. We appreciate your patient", "Your order submitted successfully");
                            }
                        }
                    });

                }
            });


        /* initialize new order counter in global variable --start*/
        var current_orders = {
            active_table: 0,
            locked_table: 0,
            executed_table: 0,
            advance_table: 0,
            delete_table: 0,
            withdraw_table: 0,
            all_table: 0
        };
        var new_orders = {
            active_table: 0,
            locked_table: 0,
            executed_table: 0,
            advance_table: 0,
            delete_table: 0,
            withdraw_table: 0,
            all_table: 0
        };


        /* initialize new order counter in global variable --end*/

        function addOrder(orders, table_id, modal_name) {

            /* calculating new order*/
            oldrowcount = current_orders[table_id];
            ajaxrowcount = orders.length;
            no_of_new_order = ajaxrowcount - oldrowcount;
            if (no_of_new_order > 0)
                total_new_order = new_orders[table_id] + no_of_new_order;
            else
                total_new_order = new_orders[table_id];
            new_orders[table_id] = total_new_order;
            current_orders[table_id] = orders.length;


            /*updating span*/
            new_span_id = 'new_' + table_id;
            if (total_new_order > 0)   // if there is new order exist
                $('#' + new_span_id).html('(' + total_new_order + ')');


            var table = $('#' + table_id).DataTable().clear().draw();

            for (i = 0; i < orders.length; ++i) {
                datarow = orders[i];

                if (datarow.order_type == 1)
                    orderStr = 'Buy';
                else
                    orderStr = 'Sell';

                modalbtn='';
                statustxt = datarow.order_status;
                if (datarow.cancel_status == 1) {
                    //statustxt=datarow.order_status+' (Cancel requested... )';
                    statustxt = 'del req';
                    modalbtn = '';
                }
                if (datarow.order_status == 'pending') {
                    modalbtn = '<a data-toggle="confirmation" data-order_status="' + datarow.order_status + '" data-bocode="' + datarow.internal_ref_no + '" data-amount="' + datarow.amount + '" data-rate="' + datarow.rate_start_range + '" data-type="' + datarow.order_type + '" data-orderid="' + datarow.id + '" class="btn default btn-xs red-stripe"' + '" href="#' + modal_name + '"> Delete </a>';
                }
                if (datarow.order_status == 'advance') {
                    modalbtn = '<a data-toggle="confirmation" data-order_status="' + datarow.order_status + '" data-bocode="' + datarow.internal_ref_no + '" data-amount="' + datarow.amount + '" data-rate="' + datarow.rate_start_range + '" data-type="' + datarow.order_type + '" data-orderid="' + datarow.id + '" class="btn default btn-xs red-stripe"' + '" href="#' + modal_name + '"> Delete </a>';
                }
                if (datarow.order_status == 'locked') {
                    modalbtn = '<a data-toggle="confirmation" data-order_status="' + datarow.order_status + '" data-bocode="' + datarow.internal_ref_no + '" data-amount="' + datarow.amount + '" data-rate="' + datarow.rate_start_range + '" data-type="' + datarow.order_type + '" data-orderid="' + datarow.id + '" class="btn default btn-xs red-stripe"' + '" href="#' + modal_name + '"> Withdraw </a>';
                }
                if(datarow.execute_at_market_price==1)
                {
                    datarow.rate_start_range='Market Price';
                }
                var rowNode = table.row.add([
                    datarow.id,
                    datarow.internal_ref_no,
                    orderStr,
                    datarow.instrument_id,
                    datarow.amount,
                    datarow.rate_start_range,
                    datarow.rate_end_range,
                    datarow.created,
                    datarow.drip_quantity,
                    statustxt,
                    modalbtn
                ]).draw().node();

                if (datarow.cancel_status == 1) {
                    $(rowNode).addClass('danger');
                }


            }
        }


        /* addrow function starts  */

        function AddRow(allorders) {

            addOrder(allorders.pending, 'active_table', 'delete_modal');
            addOrder(allorders.locked, 'locked_table', 'delete_modal');
            addOrder(allorders.executed, 'executed_table', 'delete_modal');
            addOrder(allorders.delete, 'delete_table', 'delete_modal');
            addOrder(allorders.cancel, 'withdraw_table', 'delete_modal');  //cancel= withdraw
            addOrder(allorders.advance, 'advance_table', 'delete_modal');

            var allArr = allorders.pending.concat(allorders.locked);
            allArr = allArr.concat(allorders.executed);
            allArr = allArr.concat(allorders.delete);
            allArr = allArr.concat(allorders.cancel);
            allArr = allArr.concat(allorders.advance);
            addOrder(allArr, 'all_table', 'delete_modal');


            /* delet confirmation processing */

            $('[data-toggle="confirmation"]').confirmation({
                onConfirm: function () {
                    var oid = $(this).attr("data-orderid");
                    var order_status = $(this).attr("data-order_status");

                    if (order_status == 'locked') {
                        var ajaxUrl = '<?php echo Router::url('/', true)?>Orders/withdrawOrderReq/';

                    }
                    if (order_status == 'pending') {
                        var ajaxUrl = '<?php echo Router::url('/', true)?>Orders/deleteOrderReq/';

                    }
                    if (order_status == 'advance') {
                        var ajaxUrl = '<?php echo Router::url('/', true)?>Orders/deleteAdvanceOrder/';

                    }

                    $.ajax({
                        type: "POST",
                        dataType: 'html',
                        async: true,
                        url: ajaxUrl,
                        data: {
                            orderId: oid
                        }

                    }).done(function (data) {
                        toastr.success(data, "REQUEST SUBMITTED");
                        if (order_status == 'locked') {
                            Metronic.alert({
                                type: 'info',  // alert's type
                                message: 'Note that you may find your order both in locked tab and withdraw tab (so purchase power may be deducted twice - It will be added when withdrawn completed)<br/>If you submit withdraw for same order, your purchase power will be deducted again. PLEASE DONT WITHDRAW SAME ORDER AGAIN',  // alert's message
                                close: true // make alert closable
                            });
                        }

                    });

                }
            });
        }


        /*
         *   reset counter when clicked on tab --start
         * */
        $('body').on('shown.bs.tab', function (e) {
            var target = $(e.target).attr("href") // activated tab

            if (target == '#portlet_tab2') {
                new_orders['active_table'] = 0;
                $('#new_active_table').html('');
            }
            if (target == '#portlet_tab3') {
                new_orders['locked_table'] = 0;
                $('#new_locked_table').html('');
            }
            if (target == '#portlet_tab4') {
                new_orders['executed_table'] = 0;
                $('#new_executed_table').html('');
            }
            if (target == '#portlet_tab5') {
                new_orders['advance_table'] = 0;
                $('#new_advance_table').html('');
            }
            if (target == '#portlet_tab6') {
                new_orders['delete_table'] = 0;
                $('#new_delete_table').html('');
            }
            if (target == '#portlet_tab7') {
                new_orders['withdraw_table'] = 0;
                $('#new_withdraw_table').html('');
            }
            if (target == '#portlet_tab8') {
                new_orders['all_table'] = 0;
                $('#new_all_table').html('');
            }
            if (target == '#portlet_tab9') {

            }

        })

        /*reset counter when clicked on tab --- end*/

        $('#portfolio')
            .click(function () {
                Metronic.blockUI({
                    target: '#portfolio_body',
                    animate: true
                });
                var ajaxUrl = '<?php echo Router::url('/', true)?>Portfolios/performance/';
                $.ajax({
                    type: "POST",
                    dataType: 'html',
                    async: true,
                    url: ajaxUrl


                }).done(function (data) {
                    $('#portfolio_body').html(data);
                    Metronic.unblockUI('#portfolio_body');

                });

            })

        function setAcceptOrder() {
            if (accepting_order) {
                $('#accepting_order').removeClass('hide');
                $('#not_accepting_order').addClass('hide');

            } else {
                $('#not_accepting_order').removeClass('hide');
                $('#accepting_order').addClass('hide');
            }
        }

        setAcceptOrder();

        /* =================================call infine ajax call -end======================================== */

        function fetch_order() {

            var ajaxUrl = '<?php echo Router::url('/', true)?>Orders/fetch_order/';
            var feedback = $.ajax({
                type: "POST",
                dataType: 'json',
                url: ajaxUrl,
                data: {
                    portfolio_id: portfolio_id
                },
                async: true,
                error: function(xhr, textStatus, errorThrown){

                    toastr.error("Request failed, trying to reload", "MAY BE A PROBLEM");
                    window.location.replace("http://www.new.stockbangladesh.net/Users/login");
                }
            }).done(function (data) {
                currentbalanceUsed = parseFloat(data.balanceUsed);
                currentAjaxBalance = parseFloat(data.ajaxBalance);
                pid = parseInt(data.pid);
                if(pid!=portfolio_id)
                {
                    toastr.error("This user is not logged in", "NOT LOGGED IN");
                    window.location.replace("http://www.new.stockbangladesh.net/Users/login");
                }
                if (currentbalanceUsed != lastUsed) {
                    lastUsed = currentbalanceUsed;
                    updateBalance();
                    setSlider($("#fixed_price_input").val());
                    $("#balance").html(balance.toFixed(2));

                }
                if (currentAjaxBalance != initialBalance) {
                    initialBalance = currentAjaxBalance;
                    updateBalance();
                    setSlider($("#fixed_price_input").val());
                    $("#balance").html(balance.toFixed(2));

                }
                AddRow(data); // update tabs
                accepting_order = parseFloat(data.accepting_order);
                circuit_breaker = parseFloat(data.circuit_breaker);
                setAcceptOrder();
                setTimeout(function () {
                    fetch_order();
                }, 5000);
            });


        }

        fetch_order();
        /* =================================call infine ajax call -start======================================== */


    });

</script>
