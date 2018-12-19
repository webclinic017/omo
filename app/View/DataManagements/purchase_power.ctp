<div class="row">
<div class="col-md-6 ">
    <!-- BEGIN Portlet PORTLET-->
    <div class="portlet light bg-inverse">
        <div class="portlet-title">
            <div class="caption">
                <i class="icon-puzzle font-red-flamingo"></i>
											<span class="caption-subject bold font-red-flamingo uppercase">
											Purchase power update </span>
                <span class="caption-helper hidden-xs"></span>
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
            <div class="row list-separated profile-stat">
                <div class="col-md-4 col-sm-4 col-xs-6">
                    <div class="uppercase profile-stat-title" id="balance">
                        dfgfd
                    </div>
                    <div class="uppercase profile-stat-text">
                        Purchase power
                    </div>
                </div>
                <div class="col-md-4 col-sm-4 col-xs-6">
                    <div class="uppercase profile-stat-title" id="used_amount">
                        0
                    </div>
                    <div class="uppercase profile-stat-text">
                        Used amount
                    </div>
                </div>
                <!--<div class="col-md-4 col-sm-4 col-xs-6">
                    <div class="uppercase profile-stat-title" id="category">
                        A
                    </div>
                    <div class="uppercase profile-stat-text">
                        Category
                    </div>
                </div>-->
            </div>

            <form id="Form1" action="javascript:updateChart()" class="form-horizontal form-row-seperated">
                <div class="form-body">

                    <div class="form-group">
                        <label class="control-label col-md-3">Select</label>

                        <div class="col-md-7">
                            <?php echo $this->StockBangladesh->getInstrumentBootstrapSelect2($userForDropDown, 'userlist');
                            ?>

                        </div>
                    </div>

                    <div class="form-group" >
                        <label class="control-label col-md-3">Add balance</label>

                        <div class="col-md-7">
                            <input type="number" step=".1" class="form-control" placeholder="price"
                                   id="add"
                                   value="0" name="add" required/>
                        </div>
                    </div>
                    <div class="form-group" >
                        <label class="control-label col-md-3">Deduct balance</label>

                        <div class="col-md-7">
                            <input type="number" step=".1" class="form-control" placeholder="price"
                                   id="deduct"
                                   value="0" name="deduct" required/>
                        </div>
                    </div>
                    <div class="form-group" >
                        <label class="control-label col-md-3">Total</label>

                        <div class="col-md-7">
                            <input type="number" step=".1" class="form-control" placeholder="price"
                                   id="total"
                                   value="0" name="total" required/>
                        </div>
                    </div>

                    <div>
                        <button type="button" data-loading-text="sending..."
                                class="demo-loading-btn btn btn-primary btn-block">
                            Update Balance
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
</div>



<script>

    $(function () {

        $('.bs-select').selectpicker({
            iconBase: 'fa',
            tickIcon: 'fa-check'
        });


        $("#userlist")
            .on("change", function () {

                var userId = $("#userlist").selectpicker("val");


                var ajaxUrl = '<?php echo Router::url('/', true)?>DataManagements/purchase_power_stats/';

                $.ajax({
                    type: "POST",
                    dataType: 'json',
                    url: ajaxUrl,
                    data: {userId: userId}

                }).done(function (data) {
                    $("#balance").html(data.balance);
                    $("#used_amount").html(data.balanceUsed);


                });


            });

        $("#add")
            .on("change", function () {
                $("#total").val(0);
                $("#deduct").val(0);
            });

        $("#total")
            .on("change", function () {
                $("#add").val(0);
                $("#deduct").val(0);
            });

        $("#deduct")
            .on("change", function () {
                $("#add").val(0);
                $("#total").val(0);
            });



        $('.demo-loading-btn')
            .click(function () {


                if ($("#Form1").valid()) {


                    var btn = $(this);
                    btn.button('loading');

                    var userId = $("#userlist").selectpicker("val");
                    var add = $("#add").val();
                    var total = $("#total").val();
                    var deduct = $("#deduct").val();


                    var ajaxUrl = '<?php echo Router::url('/', true)?>DataManagements/updatePurchasePower/';

                    $.ajax({
                        type: "POST",
                        dataType: 'json',
                        url: ajaxUrl,
                        data: {
                            add: add,
                            total: total,
                            deduct: deduct,
                            userId: userId

                        }

                    }).done(function (data) {

                        btn.button('reset');
                        toastr.success(data.msg, "Updated successfully");
                        $("#balance").html(data.balance);

                    });

                }
            });




    });




</script>