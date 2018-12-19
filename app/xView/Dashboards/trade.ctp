<div class="row">
    <div class="col-md-3">
        <div class="portlet light profile-sidebar-portlet">
            <!-- SIDEBAR USERPIC -->
            <div class="profile-userpic">
                <img src="<?php echo Router::url('/', true);?>assets/admin/pages/media/profile/profile_user.jpg" class="img-responsive" alt="">
            </div>
            <!-- END SIDEBAR USERPIC -->
            <!-- SIDEBAR USER TITLE -->
            <div class="profile-usertitle">
                <div class="profile-usertitle-name">
                    Marcus Doe
                </div>
                <div class="profile-usertitle-job">
                    Internal Reference ID: H230
                </div>
                <div class="profile-usertitle-job">
                    BO ID: XXXXXXXXXXXX8034
                </div>
            </div>
            <!-- END SIDEBAR USER TITLE -->
            <!-- SIDEBAR BUTTONS -->
            <div class="profile-userbuttons">
                <button type="button" class="btn btn-circle green-haze btn-sm">Follow</button>
                <button type="button" class="btn btn-circle btn-danger btn-sm">Message</button>
            </div>
            <!-- END SIDEBAR BUTTONS -->

        </div>

    </div>

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
                <ul class="nav nav-tabs">
                    <li class="">
                        <a href="#portlet_tab1" data-toggle="tab" aria-expanded="false">
                            SUBMIT ORDER </a>
                    </li>
                    <li class="">
                        <a href="#portlet_tab2" data-toggle="tab" aria-expanded="false">
                            ACTIVE ORDER </a>
                    </li>
                    <li class="">
                        <a href="#portlet_tab3" data-toggle="tab" aria-expanded="false">
                            LOCKED ORDER </a>
                    </li>
                    <li class="">
                        <a href="#portlet_tab4" data-toggle="tab" aria-expanded="false">
                            EXECUTED ORDER </a>
                    </li>
                    <li class="">
                        <a href="#portlet_tab5" data-toggle="tab" aria-expanded="false">
                           ADVANCE ORDER </a>
                    </li>
                    <li class="active">
                        <a href="#portlet_tab6" data-toggle="tab" aria-expanded="true">
                            DELETED ORDER </a>
                    </li>
                </ul>
            </div>
            <div class="portlet-body">
                <div class="tab-content">
                    <div class="tab-pane active" id="portlet_tab1">


                        <div class="row">
                            <div class="col-md-6 ">
                                <!-- BEGIN Portlet PORTLET-->
                                <div class="portlet light bg-inverse">
                                    <div class="portlet-title">
                                        <div class="caption">
                                            <i class="icon-puzzle font-red-flamingo"></i>
											<span class="caption-subject bold font-red-flamingo uppercase">
											Order panel </span>
                                            <span class="caption-helper">Submit your order...</span>
                                        </div>
                                        <div class="tools">
                                            <a href="" class="collapse" data-original-title="" title="">
                                            </a>
                                            <a href="#portlet-config" data-toggle="modal" class="config" data-original-title="" title="">
                                            </a>
                                            <a href="" class="reload" data-original-title="" title="">
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
                                        <label class="control-label col-md-3">Buy/Sell</label>
                                        <div class="col-md-7">
                                            <select id="buyorsell" class="bs-select form-control">
                                                <option value="buy" selected="">Buy</option>
                                                <option value="sell">Sell</option>
                                            </select>
                                        </div>
                                    </div>
                                        <div class="form-group">
                                        <label class="control-label col-md-3">Default</label>
                                        <div class="col-md-7">
                                            <?php echo $this->StockBangladesh->getInstrumentBootstrapSelect2($instrumentList,'allShareList');
                                            ?>
                                            <?php echo $this->StockBangladesh->getInstrumentBootstrapSelect2($sellInstrumentList,'sellShareList');
                                            ?>
                                        </div>
                                    </div>
                                        <div class="form-group">
                                            <label class="control-label col-md-3">Order type</label>
                                            <div class="col-md-7">
                                                <div class="input-group">
                                                    <div class="icheck-inline">
                                                        <label>
                                                            <input id="fixed" type="radio" name="radio2" checked class="icheck" data-radio="iradio_line-blue" data-label="Fixed">
                                                        </label>
                                                        <label>
                                                            <input id="ranged" type="radio" name="radio2"  class="icheck" data-radio="iradio_line-blue" data-label="Range">
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
                                                            <input id="market_price" type="checkbox" class="icheck" data-checkbox="icheckbox_flat-grey"> At market price

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
                                                <input type="text" class="form-control" placeholder="price" id="fixed_price_input">
                                            </div>
                                        </div>
                                        <div class="form-group hide" id="range_price">
                                            <label class="control-label col-md-3">Price</label>
                                            <div class="col-md-4">
                                                <input type="text" class="form-control" placeholder="start price" id="range_price_input_start">
                                            </div>
                                            <div class="col-md-3">
                                                <input type="text" class="form-control" placeholder="end price" id="range_price_input_end">
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label class="control-label col-md-3">Buy/Sell Quantity</label>
                                            <div class="col-md-7">
                                                <input type="text" class="form-control" placeholder="Quantity">
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label class="control-label col-md-3">Drip Quantity</label>
                                            <div class="col-md-7">
                                                <input type="text" class="form-control" placeholder="drip">
                                            </div>
                                        </div>
                                        <div>
                                            <button type="button" data-loading-text="sending..." class="demo-loading-btn btn btn-primary btn-block">
                                                Send order </button>

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
                            <div class="col-md-6 ">
                                <!-- BEGIN Portlet PORTLET-->
                                <div class="portlet light bg-inverse">
                                    <div class="portlet-title">
                                        <div class="caption font-green-sharp">
                                            <i class="icon-speech font-green-sharp"></i>
                                            <span class="caption-subject bold uppercase"> Information</span>
                                            <span class="caption-helper">trade info...</span>
                                        </div>
                                        <div class="tools">
                                            <a href="" class="collapse" data-original-title="" title="">
                                            </a>
                                            <a href="#portlet-config" data-toggle="modal" class="config" data-original-title="" title="">
                                            </a>
                                            <a href="" class="reload" data-original-title="" title="">
                                            </a>
                                            <a href="" class="remove" data-original-title="" title="">
                                            </a>
                                            <a href="javascript:;" class="fullscreen" data-original-title="" title="">
                                            </a>
                                        </div>
                                    </div>
                                    <div class="portlet-body">

                                        <table class="table table-striped table-bordered table-advance table-hover">

                                            <tbody>
                                            <tr>
                                                <td>
                                                    <a href="#1">
                                                        Purchase Power </a>
                                                </td>
                                                <td class="hidden-xs">
                                                    8826.52
                                                </td>

                                            </tr>
                                            <tr>
                                                <td>
                                                    <a href="#">
                                                        Category </a>
                                                </td>
                                                <td class="hidden-xs">
                                                    A
                                                </td>

                                            </tr>
                                            <tr>
                                                <td>
                                                    <a href="#">
                                                        Last Trade Price </a>
                                                </td>
                                                <td class="hidden-xs" id="ltp">
                                                    95.6
                                                </td>

                                            </tr>
                                            <tr>
                                                <td >
                                                    <a href="#">
                                                        High </a>
                                                </td>
                                                <td class="hidden-xs" id="high">
                                                   95.8
                                                </td>

                                            </tr>
                                            <tr>
                                                <td>
                                                    <a href="#">
                                                        Low </a>
                                                </td>
                                                <td class="hidden-xs" id="low">
                                                   95.8
                                                </td>

                                            </tr>
                                            <tr>
                                                <td>
                                                    <a href="#">
                                                        Commision </a>
                                                </td>
                                                <td class="hidden-xs">
                                                    95.8
                                                </td>

                                            </tr>
                                            <tr>
                                                <td>
                                                    <a href="#">
                                                        Total </a>
                                                </td>
                                                <td class="hidden-xs">
                                                    95.8
                                                </td>

                                            </tr>
                                            </tbody>
                                        </table>

                                    </div>
                                </div>
                                <!-- END GRID PORTLET-->
                            </div>
                        </div>






                    </div>
                    <div class="tab-pane" id="portlet_tab2">

                        <table class="table table-striped table-bordered table-advance table-hover">
                            <thead>
                            <tr>
                                <th>
                                    <i class="fa fa-briefcase"></i> Order ID
                                </th>
                                <th class="hidden-xs">
                                    <i class="fa fa-question"></i> BO Code
                                </th>
                                <th>
                                    <i class="fa fa-bookmark"></i> Type
                                </th>
                                <th>
                                    <i class="fa fa-bookmark"></i> Symbol ID
                                </th>
                                <th>
                                    <i class="fa fa-bookmark"></i> No of Share
                                </th>
                                <th>
                                    <i class="fa fa-bookmark"></i> Start Range
                                </th>
                                <th>
                                    <i class="fa fa-bookmark"></i> End Range
                                </th>
                                <th>
                                    <i class="fa fa-bookmark"></i> Order Time
                                </th>
                                <th>
                                    <i class="fa fa-bookmark"></i> Status
                                </th>
                                <th>
                                    Change
                                </th>
                            </tr>
                            </thead>
                            <tbody>
                            <tr>
                                <td>
                                    <a href="#">
                                        Pixel Ltd </a>
                                </td>
                                <td class="hidden-xs">

                                </td>
                                <td>
                                    5555
                                </td>
                                <td>
                                    5555
                                </td>
                                <td>
                                    5555
                                </td>
                                <td>
                                    5555
                                </td>
                                <td>
                                    5555
                                </td>
                                <td>
                                    5555
                                </td>
                                <td>
                                    5555
                                </td>
                                <td>
                                    <a class="btn default btn-xs green-stripe" href="#">
                                        View </a>
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    <a href="#">
                                        Pixel Ltd </a>
                                </td>
                                <td class="hidden-xs">

                                </td>
                                <td>
                                    5555
                                </td>
                                <td>
                                    5555
                                </td>
                                <td>
                                    5555
                                </td>
                                <td>
                                    5555
                                </td>
                                <td>
                                    5555
                                </td>
                                <td>
                                    5555
                                </td>
                                <td>
                                    5555
                                </td>
                                <td>
                                    <a class="btn default btn-xs green-stripe" href="#">
                                        View </a>
                                </td>
                            </tr>

                            </tbody>
                        </table>

                    </div>
                    <div class="tab-pane" id="portlet_tab3">
SDFFD
                    </div>
                    <div class="tab-pane" id="portlet_tab4">

                    </div>
                    <div class="tab-pane" id="portlet_tab5">

                    </div>
                    <div class="tab-pane" id="portlet_tab6">

                    </div>
                </div>
            </div>
        </div>
    </div>
</div>


<script>

    $(function () {
        $('.bs-select').selectpicker({
            iconBase: 'fa',
            tickIcon: 'fa-check'
        });

        $("#sellShareList").selectpicker('hide');
        $("#buyorsell")
            .on("change", function () {

                var bOrS=$("#buyorsell").selectpicker("val");
                if(bOrS=='buy') {
                    $("#allShareList").selectpicker('show');
                    $("#sellShareList").selectpicker('hide');
                }else
                {
                    $("#allShareList").selectpicker('hide');
                    $("#sellShareList").selectpicker('show');
                }
            })

        $("#fixed").on('ifChecked', function(event){
          //  alert(event.type + ' callback');
            $('#fixed_price').removeClass('hide');
            $('#range_price').addClass('hide');
        });

        $("#fixed").on('ifUnchecked', function(event){
         //   alert(event.type + ' callback');
            $('#fixed_price').addClass('hide');
            $('#range_price').removeClass('hide');
        });
        $("#market_price").on('ifChecked', function(event){
            $('#market_price_help').removeClass('hide');
            $('#fixed_price_input').prop('disabled', true);
            $('#range_price_input_start').prop('disabled', true);
            $('#range_price_input_end').prop('disabled', true);

        });
        $("#market_price").on('ifUnchecked', function(event){
            $('#market_price_help').addClass('hide');
            $('#fixed_price_input').prop('disabled', false);
            $('#range_price_input_start').prop('disabled', false);
            $('#range_price_input_end').prop('disabled', false);


        });




        $("#allShareList")
            .on("change", function () {

                var instrumentId=$("#allShareList").selectpicker("val");


                var ajaxUrl ='<?php echo Router::url('/', true)?>Dashboards/getPrice/';

                $.ajax({
                    type: "POST",
                    dataType: 'json',
                    url: ajaxUrl,
                    data: { instrumentId:instrumentId }

                }).done(function (data) {
                    $("#ltp").html(data.close_price);
                    $("#high").html(data.high_price);
                    $("#low").html(data.low_price);

alert(data.close_price);
                });






            })














        $('.demo-loading-btn')
            .click(function () {
                var btn = $(this)
                btn.button('loading')
                setTimeout(function () {
                    btn.button('reset')
                    toastr.info('Your order has been submitted');
                    toastr.warning("Our operator are working. We appreciate your patient", "Wait until executed")
                }, 3000)


            });






    });

</script>
