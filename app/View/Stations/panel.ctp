<div class="row">

    <div class="col-md-12 ">
        <div class="modal fade" id="basic" tabindex="-1" role="basic" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-hidden="true"></button>
                    </div>
                    <div class="modal-body">
                        <!-- <div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">
                             <a class="dashboard-stat dashboard-stat-light blue-soft" href="#">
                                 <div class="visual">
                                     <i class="fa fa-comments"></i>
                                 </div>
                                 <div class="details">
                                     <div class="number">
                                         1349
                                     </div>
                                     <div class="desc">
                                         New Feedbacks
                                     </div>
                                 </div>
                             </a>
                         </div>-->
                        <div class="row">

                            <div class="col-md-6 ">
                                <div class="dashboard-stat green">
                                    <div class="visual">
                                        <i class="fa fa-comments"></i>
                                    </div>
                                    <div class="details">
                                        <div class="number" id="order_type">
                                            BUY
                                        </div>

                                    </div>

                                </div>
                            </div>
                            <div class="col-md-6 ">
                                <div class="dashboard-stat green">
                                    <div class="visual">
                                        <i class="fa fa-comments"></i>
                                    </div>
                                    <div class="details">
                                        <div class="number" id="instrument">

                                        </div>

                                    </div>

                                </div>
                            </div>
                        </div>
                        <div class="row">

                            <div class="col-md-12">
                                <div class="dashboard-stat green">
                                    <div class="visual">
                                        <i class="fa fa-comments"></i>
                                    </div>
                                    <div class="details">
                                        <div class="number" id="bocode">
                                            70350
                                        </div>

                                    </div>

                                </div>
                            </div>

                        </div>
                        <div class="row">


                            <div class="col-md-6 ">
                                <div class="dashboard-stat green">
                                    <div class="visual">
                                        <i class="fa fa-comments"></i>
                                    </div>
                                    <div class="details">
                                        <div class="number" id="amount_txt">

                                        </div>
                                        <div class="desc">
                                            Quantity
                                        </div>
                                    </div>

                                </div>
                            </div>
                            <div class="col-md-6 ">
                                <div class="dashboard-stat green">
                                    <div class="visual">
                                        <i class="fa fa-comments"></i>
                                    </div>
                                    <div class="details">
                                        <div class="number" id="rate_txt">

                                        </div>
                                        <div class="desc">
                                            Price
                                        </div>

                                    </div>

                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <form id="Form1" action="javascript:updateChart()"
                                  class="form-horizontal form-row-seperated">
                                <div class="form-body">


                                    <div class="col-md-6 ">
                                        <div class="form-group">


                                            <div class="col-md-12">
                                                <input type="number" class="form-control" id="amount"
                                                       name="amount" required/>
                                            </div>
                                        </div>

                                    </div>
                                    <div class="col-md-6 ">

                                        <div class="form-group">


                                            <div class="col-md-12">
                                                <input type="number" class="form-control" id="rate"
                                                       name="rate" required/>
                                            </div>
                                        </div>

                                    </div>
                                    <div class="hide"><input type="number" class="form-control" name="orderid"
                                                             id="orderid"></div>
                                </div>
                            </form>


                        </div>
                    </div>


                    <div class="modal-footer">
                        <button type="button" class="btn default" data-dismiss="modal">Cancel</button>
                        <button type="button" class="btn blue-steel" id="execute_btn">Executed</button>
                        <button type="button" class="btn blue-hoki" id="lock_btn">Lock</button>
                    </div>
                </div>
                <!-- /.modal-content -->
            </div>
            <!-- /.modal-dialog -->
        </div>
    </div>


</div>
<div class="row">

    <div class="col-md-12 ">
        <div class="modal fade" id="basic_modal2" tabindex="-1" role="basic_modal2" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-hidden="true"></button>
                        <h3 class="modal-title" ><span class="label label-info" id="instrument_modal2"> </span><span class="label label-success" id="bocode_modal2">success </span> </h3>
                    </div>
                    <div class="modal-body">


                        <form id="Form1_modal2" action="#1" class="form-horizontal form-row-seperated">
                            <div class="form-body">
                                <div class="row">

                                    <div class="col-md-6 ">
                                        <div class="form-group" id="fixed_price">

                                            <div class="col-md-12">
                                                <label>Quantity</label>
                                                <input type="number" class="form-control" placeholder="Quantity"
                                                       id="amount_modal2"
                                                       name="amount_modal2" required/>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-6 ">
                                        <div class="form-group" id="fixed_price">

                                            <div class="col-md-12">
                                                <label>Price</label>
                                                <input type="number" class="form-control" placeholder="Price"
                                                       id="rate_modal2"
                                                       name="rate_modal2" required/>
                                            </div>
                                        </div>
                                    </div>

                                </div>
                                <div class="hide"><input type="number" class="form-control" name="orderid_modal2"
                                                         id="orderid_modal2"></div>


                            </div>

                        </form>


                    </div>


                    <div class="modal-footer">
                        <button type="button" class="btn default" data-dismiss="modal">Cancel</button>
                        <button type="button" class="btn blue-madison" id="delete_btn_modal2">Delete</button>
                        <button type="button" class="btn green-meadow" id="pending_btn_modal2">Pending</button>
                        <button type="button" class="btn blue-hoki" id="lock_btn_modal2">Lock</button>
                        <button type="button" class="btn blue-steel" id="executed_btn_modal2">Executed</button>
                    </div>
                </div>
                <!-- /.modal-content -->
            </div>
            <!-- /.modal-dialog -->
        </div>
    </div>


</div>
<div class="row">

    <div class="col-md-3">
        <input type="checkbox" id="accept_order_check" class="icheck" data-checkbox="icheckbox_line-blue" data-label="Accept Order">
    </div>
    <div class="col-md-3">
        <input type="checkbox" id="circuit_breaker_check" class="icheck" data-checkbox="icheckbox_line-blue" data-label="Circuit Breaker">
    </div>
    <div class="col-md-3">
        <input type="checkbox" id="" class="icheck" data-checkbox="icheckbox_line-blue" data-label="Anouncement">
    </div>
    <div class="col-md-3">
        <input type="checkbox" id="" class="icheck" data-checkbox="icheckbox_line-blue" data-label="Stop alert">
    </div>
 <!--   <div class="col-md-3">
        <input type="checkbox" id="" class="icheck" data-checkbox="icheckbox_line-blue" data-label="Others">
    </div>
-->

</div>
<div class="clearfix">
</div>

<div class="row">

    <div class="col-md-12 ">
        <!-- BEGIN Portlet PORTLET-->
        <div class="portlet light bordered">
            <div class="portlet-title tabbable-line">
                <!-- <div class="caption">
                     <i class="icon-pin font-yellow-lemon"></i>
                                             <span class="caption-subject bold font-yellow-lemon uppercase">
                                             Tabs </span>
                     <span class="caption-helper">more samples...</span>
                 </div>-->
                <ul class="nav nav-tabs nav-justified">
                    <li class="active">
                        <a href="#portlet_tab2" data-toggle="tab" aria-expanded="false">
                            ACTIVE ORDER <span id="new_active_table"></span> </a>
                    </li>
                    <li class="">
                        <a href="#portlet_tab3" data-toggle="tab" aria-expanded="false">
                            LOCKED ORDER <span id="new_locked_table"></span> </a>
                    </li>
                    <li class="">
                        <a href="#portlet_tab4" data-toggle="tab" aria-expanded="false">
                            EXECUTED ORDER <span id="new_executed_table"></span> </a>
                    </li>
                    <li class="">
                        <a href="#portlet_tab5" data-toggle="tab" aria-expanded="false">
                            ADVANCE ORDER <span id="new_advance_table"></span></a>
                    </li>
                    <li class="">
                        <a href="#portlet_tab6" data-toggle="tab" aria-expanded="true">
                            DELETED ORDER <span id="new_delete_table"></span></a>
                    </li>
                    <li class="">
                        <a href="#portlet_tab7" data-toggle="tab" aria-expanded="true">
                            WITHDRAW ORDER <span id="new_withdraw_table"></span></a>
                    </li>
                    <li class="">
                        <a href="#portlet_tab8" data-toggle="tab" aria-expanded="true">
                            ALL ORDER <span id="new_all_table"></span></a>
                    </li>

               <!--  <li class="">
                        <a href="#portlet_tab9" data-toggle="tab" aria-expanded="true">
                           ORDER HISTORY <span id="history_table"></span></a>
                 </li> -->
                </ul>
            </div>
            <div class="portlet-body">
                <div class="tab-content">

                    <div class="tab-pane active" id="portlet_tab2">

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
                                    <i class="icon-grid"></i> Action column
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
                                    <i class="icon-grid"></i> Action column
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
                                    <i class="icon-grid"></i> Action column
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
                                    <i class="icon-grid"></i> Action column
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
                                    <i class="icon-grid"></i> Action column
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
                                    <i class="icon-grid"></i> Action column
                                </th>
                            </tr>
                            </thead>
                            <tbody id="withdraw_order">

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
                                    <i class="icon-grid"></i> Action column
                                </th>
                            </tr>
                            </thead>
                            <tbody id="all_order">

                            </tbody>
                        </table>
                    </div>


                   <!-- <div class="tab-pane" id="portlet_tab9">
                        <table class="table table-striped table-bordered table-advance table-hover" id="history_table">
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
                                    <i class="icon-grid"></i> Massage Sent
                                </th>
                            </tr>
                            </thead>
                            <tbody id="all_order">

                            </tbody>
                        </table>
                    </div>-->

                </div>
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


    var broker_id=<?php echo $broker_id; ?>;
    var accepting_order =<?php echo $accepting_order;?>;
    var circuit_breaker =<?php echo $circuit_breaker;?>;



    //for accept order checkBox

    if(accepting_order)
        $("#accept_order_check").iCheck('check');
    else
        $("#accept_order_check").iCheck('uncheck');

    function acceptOrderAjax(flag)
    {
        var ajaxUrl = '<?php echo Router::url('/', true)?>stations/updateAcceptOrder/';

        $.ajax({
            type: "POST",
            dataType: 'html',
            url: ajaxUrl,
            data: {
                broker_id: broker_id,
                flag: flag

            }

        }).done(function (data) {

            toastr.info("Accept order status changed successfuly", "Accept order status");
           // toastr.info(data);

        });
    }
    $("#accept_order_check").on('ifChecked', function (event) {

        acceptOrderAjax(1);

    });

    $("#accept_order_check").on('ifUnchecked', function (event) {
        acceptOrderAjax(0);
    });




     //for circuit breaker checkBox

    if(circuit_breaker)
        $("#circuit_breaker_check").iCheck('check');
    else
        $("#circuit_breaker_check").iCheck('uncheck');

    function circuitBreakerAjax(flag)
    {
        var ajaxUrl = '<?php echo Router::url('/', true)?>stations/updateCircuitBreaker/';

        $.ajax({
            type: "POST",
            dataType: 'html',
            url: ajaxUrl,
            data: {
                broker_id: broker_id,
                flag: flag

            }

        }).done(function (data1) {

            toastr.info("Circuit Breaker status changed successfuly", "Circuit Breaker status");
           // toastr.info(data1);

        });
    }
    $("#circuit_breaker_check").on('ifChecked', function (event) {

        circuitBreakerAjax(1);

    });

    $("#circuit_breaker_check").on('ifUnchecked', function (event) {
        circuitBreakerAjax(0);
    });




    $('#delete_btn_modal2').click(function(){
        var ord = $("#orderid_modal2").val();
        var amnt = $("#amount_modal2").val();
        var price = $("#rate_modal2").val();


        if ($("#Form1_modal2").valid()) {
            var btn = $(this);
            btn.button('loading');


            var ajaxUrl = '<?php echo Router::url('/', true)?>Orders/deleteOrder/';

            $.ajax({
                type: "POST",
                dataType: 'html',
                url: ajaxUrl,
                data: {
                    orderId: ord,
                    amount: amnt,
                    rate: price
                }

            }).done(function (data) {

                btn.button('reset');
                $('#basic_modal2').modal('hide')
                toastr.success("Order moved to delete tab", "Delete Order");

            });

        }
    });


    $('#lock_btn_modal2')
        .click(function () {
            var ord = $("#orderid_modal2").val();
            var amnt = $("#amount_modal2").val();
            var price = $("#rate_modal2").val();


            if ($("#Form1_modal2").valid()) {
                var btn = $(this);
                btn.button('loading');


                var ajaxUrl = '<?php echo Router::url('/', true)?>Orders/lockOrder/';

                $.ajax({
                    type: "POST",
                    dataType: 'html',
                    url: ajaxUrl,
                    data: {
                        orderId: ord,
                        amount: amnt,
                        rate: price
                    }

                }).done(function (data) {

                    btn.button('reset');
                    $('#basic_modal2').modal('hide')
                    toastr.success("Order moved to locked tab", "Locked Order");

                });

            }


        });

    $('#executed_btn_modal2')
        .click(function () {
            var ord = $("#orderid_modal2").val();
            var amnt = $("#amount_modal2").val();
            var price = $("#rate_modal2").val();


            if ($("#Form1_modal2").valid()) {
                var btn = $(this);
                btn.button('loading');


                var ajaxUrl = '<?php echo Router::url('/', true)?>Orders/executeOrder/';

                $.ajax({
                    type: "POST",
                    dataType: 'html',
                    url: ajaxUrl,
                    data: {
                        orderId: ord,
                        amount: amnt,
                        rate: price
                    }

                }).done(function (data) {

                    btn.button('reset');
                    $('#basic_modal2').modal('hide')
                    toastr.success("Order moved to executed tab", "Executed Order");

                });

            }


        });
    $('#pending_btn_modal2')
        .click(function () {
            var ord = $("#orderid_modal2").val();
            var amnt = $("#amount_modal2").val();
            var price = $("#rate_modal2").val();


            if ($("#Form1_modal2").valid()) {
                var btn = $(this);
                btn.button('loading');


                var ajaxUrl = '<?php echo Router::url('/', true)?>Orders/pendingOrder/';

                $.ajax({
                    type: "POST",
                    dataType: 'html',
                    url: ajaxUrl,
                    data: {
                        orderId: ord,
                        amount: amnt,
                        rate: price
                    }

                }).done(function (data) {

                    btn.button('reset');
                    $('#basic_modal2').modal('hide')

                    toastr.success("Order moved to active tab", "Status changed");

                });

            }


        });



    $('#lock_btn')
        .click(function () {
            var ord = $("#orderid").val();
            var amnt = $("#amount").val();
            var price = $("#rate").val();


            if ($("#Form1").valid()) {
                var btn = $(this);
                btn.button('loading');


                var ajaxUrl = '<?php echo Router::url('/', true)?>Orders/lockOrder/';

                $.ajax({
                    type: "POST",
                    dataType: 'html',
                    url: ajaxUrl,
                    data: {
                        orderId: ord,
                        amount: amnt,
                        rate: price
                    }

                }).done(function (data) {

                    btn.button('reset');
                    $('#basic').modal('hide')
                    toastr.success("Order moved to lock tab", "Lock");

                });

            }


        });
    $('#execute_btn')
        .click(function () {
            var ord = $("#orderid").val();
            var amnt = $("#amount").val();
            var price = $("#rate").val();


            if ($("#Form1").valid()) {
                var btn = $(this);
                btn.button('loading');


                var ajaxUrl = '<?php echo Router::url('/', true)?>Orders/executeOrder/';

                $.ajax({
                    type: "POST",
                    dataType: 'html',
                    url: ajaxUrl,
                    data: {
                        orderId: ord,
                        amount: amnt,
                        rate: price
                    }

                }).done(function (data) {

                    btn.button('reset');
                    $('#basic').modal('hide')
                    toastr.success("Order moved to executed tab", "Executed");

                });

            }


        });

    $('#basic').on('show.bs.modal', function (event) {
        var button = $(event.relatedTarget) // Button that triggered the modal
        var instrument = button.data('instrument') // Extract info from data-* attributes
        var amount = button.data('amount') // Extract info from data-* attributes
        var rate = button.data('rate') // Extract info from data-* attributes
        var market_price = button.data('market_price') // Extract info from data-* attributes
        var bocode = button.data('bocode') // Extract info from data-* attributes
        var type = button.data('type') // Extract info from data-* attributes
        var orderid = button.data('orderid') // Extract info from data-* attributes
        // If necessary, you could initiate an AJAX request here (and then do the updating in a callback).
        // Update the modal's content. We'll use jQuery here, but you could use a data binding library or other methods instead.



        var modal = $(this)

        if (type == 1) {
            $('.dashboard-stat').removeClass('red');
            $('.dashboard-stat').addClass('green');
            modal.find('#order_type').text('Buy');

        } else {

            $('.dashboard-stat').removeClass('green');
            $('.dashboard-stat').addClass('red');
            modal.find('#order_type').text('Sell');
        }



        modal.find('#amount').val(amount)
        modal.find('#rate').val(rate)
        modal.find('#instrument').text(instrument)
        modal.find('#bocode').text(bocode)
        modal.find('#amount_txt').text(amount)
        if(market_price==1) {
            modal.find('#rate_txt').text('Market price')
        }else
        {
        modal.find('#rate_txt').text(rate)
        }
        modal.find('#orderid').val(orderid)
    })
    $('#basic_modal2').on('show.bs.modal', function (event) {
        var button = $(event.relatedTarget) // Button that triggered the modal
        var instrument = button.data('instrument') // Extract info from data-* attributes
        var amount = button.data('amount') // Extract info from data-* attributes
        var rate = button.data('rate') // Extract info from data-* attributes
        var bocode = button.data('bocode') // Extract info from data-* attributes
        var type = button.data('type') // Extract info from data-* attributes
        var orderid = button.data('orderid') // Extract info from data-* attributes
        // If necessary, you could initiate an AJAX request here (and then do the updating in a callback).
        // Update the modal's content. We'll use jQuery here, but you could use a data binding library or other methods instead.



        var modal = $(this)

        modal.find('#amount_modal2').val(amount)
        modal.find('#rate_modal2').val(rate)
        modal.find('#instrument_modal2').text(instrument)
        modal.find('#bocode_modal2').text(bocode)
        modal.find('#orderid_modal2').val(orderid)
    })
    function isFloat(n) {
        return n === +n && n !== (n|0);
    }

    /* initialize new order counter in global variable --start*/
    var current_orders = {active_table: 0, locked_table: 0, executed_table: 0, advance_table: 0, delete_table: 0, withdraw_table: 0, all_table: 0};
    var new_orders = {active_table: 0, locked_table: 0, executed_table: 0, advance_table: 0, delete_table: 0, withdraw_table: 0, all_table: 0};


    /* initialize new order counter in global variable --end*/

    function addOrder(orders,table_id,modal_name)
    {

        /* calculating new order*/
        oldrowcount=current_orders[table_id];
        ajaxrowcount=orders.length;
        no_of_new_order=ajaxrowcount-oldrowcount;
        if (no_of_new_order > 0)
            total_new_order = new_orders[table_id] + no_of_new_order;
        else
            total_new_order = new_orders[table_id];
        new_orders[table_id]=total_new_order;
        current_orders[table_id]=orders.length;


        /*updating span*/
        new_span_id='new_'+table_id;
        if (total_new_order > 0)   // if there is new order exist
            $('#'+new_span_id).html('(' + total_new_order + ')');


        var table = $('#'+table_id).DataTable().clear().draw();   // reset datatable

        for (i = 0; i < orders.length; ++i) {
            datarow = orders[i];




            if (datarow.order_type == 1) {
                orderStr = 'Buy';
                viewbtn = '<a data-toggle="modal" data-target="#' + modal_name + '" data-instrument="' + datarow.instrument_id + '" data-bocode="' + datarow.internal_ref_no + '" data-amount="' + datarow.amount + '" data-rate="' + datarow.rate_start_range+ '" data-market_price="' + datarow.execute_at_market_price + '" data-type="' + datarow.order_type + '" data-orderid="' + datarow.id + '" class="btn default btn-xs green-stripe"' + '" href="#' + modal_name + '"> View </a>';
            }
            else {
                orderStr = 'Sell';
                viewbtn = '<a data-toggle="modal" data-target="#' + modal_name + '" data-instrument="' + datarow.instrument_id + '" data-bocode="' + datarow.internal_ref_no + '" data-amount="' + datarow.amount + '" data-rate="' + datarow.rate_start_range + '" data-market_price="' + datarow.execute_at_market_price + '" data-type="' + datarow.order_type + '" data-orderid="' + datarow.id + '" class="btn default btn-xs red-stripe"' + '" href="#' + modal_name + '"> View </a>';
            }
            deletebtn = '<a data-toggle="confirmation" data-instrument="' + datarow.instrument_id + '" data-bocode="' + datarow.internal_ref_no + '" data-amount="' + datarow.amount + '" data-rate="' + datarow.rate_start_range + '" data-market_price="' + datarow.execute_at_market_price +  '" data-type="' + datarow.order_type + '" data-orderid="' + datarow.id + '" class="btn default btn-xs blue-stripe"' + '" href="#delete_modal"> Delete </a>';

            statustxt = datarow.order_status;
            if (datarow.cancel_status == 1) {
                statustxt = 'del req';
            }
            if(datarow.execute_at_market_price==1)
            {
                datarow.rate_end_range='Market Price';
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
                viewbtn + deletebtn,

            ]).draw().node();

            if (datarow.cancel_status == 1) {
                $(rowNode).addClass('danger');
            } else {

                if (datarow.order_type == 1) {
                    $(rowNode).addClass('info');//success
                }
                if (datarow.order_type == 2) {
                    $(rowNode).addClass('warning');//warning
                }

            }


        }


    }


var firstLoad=true;

    /* addrow function starts  */

    function AddRow(allorders) {
        total_current_order=current_orders['active_table']+current_orders['locked_table']+current_orders['executed_table']+current_orders['delete_table']+current_orders['withdraw_table']+current_orders['advance_table'];

        addOrder(allorders.pending,'active_table','basic');
        addOrder(allorders.locked,'locked_table','basic_modal2');
        addOrder(allorders.executed,'executed_table','basic_modal2');
        addOrder(allorders.delete,'delete_table','basic_modal2');
        addOrder(allorders.cancel,'withdraw_table','basic_modal2'); //cancel= withdraw
        addOrder(allorders.advance,'advance_table','basic_modal2');

        var allArr = allorders.pending.concat(allorders.locked);
        allArr = allArr.concat(allorders.executed);
        allArr = allArr.concat(allorders.delete);
        allArr = allArr.concat(allorders.cancel);
        allArr = allArr.concat(allorders.advance);

        if(!firstLoad) {
            //new_order_msg = allArr.length - current_orders['all_table']

            new_order_msg = allArr.length - total_current_order;

            for (i = 0; i < new_order_msg; i++) {

                toastr.info("New order arrived", "NEW ORDER", {timeOut: 50000});
            }

        }
        firstLoad=false;
       // addOrder(allArr,'all_table','basic_modal2');

     // addOrder(allorders.historyOrder,'history_table','basic_modal2');





        /* delet confirmation processing */

        $('[data-toggle="confirmation"]').confirmation({
            onConfirm: function () {
                var oid = $(this).attr("data-orderid");

                var ajaxUrl = '<?php echo Router::url('/', true)?>Orders/deleteOrder/';

                $.ajax({
                    type: "POST",
                    dataType: 'html',
                    async: true,
                    url: ajaxUrl,
                    data: {
                        orderId: oid
                    }

                }).done(function (data) {

                    toastr.info('Your order submitted successfully');
                    toastr.warning("Our operator are working. We appreciate your patient", "Wait until executed");

                });

            }
        });
    }


    /* addrow function end  */


    /*
     *   reset counter when clicked on tab --start
     * */
    $('body').on('shown.bs.tab', function (e) {
        var target = $(e.target).attr("href") // activated tab

        if (target == '#portlet_tab2') {
            new_orders['active_table']=0;
            $('#new_active_table').html('');
        }
        if (target == '#portlet_tab3') {
            new_orders['locked_table']=0;
            $('#new_locked_table').html('');
        }
        if (target == '#portlet_tab4') {
            new_orders['executed_table']=0;
            $('#new_executed_table').html('');
        }
        if (target == '#portlet_tab5') {
            new_orders['advance_table']=0;
            $('#new_advance_table').html('');
        }
        if (target == '#portlet_tab6') {
            new_orders['delete_table']=0;
            $('#new_delete_table').html('');
        }
        if (target == '#portlet_tab7') {
            new_orders['withdraw_table']=0;
            $('#new_withdraw_table').html('');
        }
        if (target == '#portlet_tab8') {
            new_orders['all_table']=0;
            $('#new_all_table').html('');
        }
       /* if (target == '#portlet_tab9') {
            new_orders['all_table']=0;
            $('#history_table').html('');
        }*/


    })

    /*reset counter when clicked on tab --- end*/



    function setAcceptOrder()
    {
        if(accepting_order)
        {
            $('#accepting_order').removeClass('hide');
            $('#not_accepting_order').addClass('hide');

        }else
        {
            $('#not_accepting_order').removeClass('hide');
            $('#accepting_order').addClass('hide');
        }
    }

    setAcceptOrder();



    /* =================================call infine ajax call -end======================================== */

    function fetch_order() {

        var ajaxUrl = '<?php echo Router::url('/', true)?>Orders/fetch_broker_order/';
        var feedback = $.ajax({
            type: "POST",
            dataType: 'json',
            url: ajaxUrl,
            async: true,
            error: function(xhr, textStatus, errorThrown){

                toastr.error("Request failed", "NOT LOGGED IN");
                window.location.replace("http://www.new.stockbangladesh.net/Users/login");
            }
        }).done(function (data) {

            AddRow(data); // update tabs
            accepting_order=parseFloat(data.accepting_order);
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
