<div class="row">
    <div class="col-md-6 ">
        <!-- BEGIN Portlet PORTLET-->
        <div class="portlet light bg-inverse">
            <div class="portlet-title">
                <div class="caption">
                    <i class="icon-puzzle font-red-flamingo"></i>
											<span class="caption-subject bold font-red-flamingo uppercase">
											Portfolio manager assign  </span>
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
                    <div class="col-md-12 col-sm-12 col-xs-12">
                        <div class="uppercase profile-stat-title" id="user">

                        </div>
                        <div class="uppercase profile-stat-text">
                            User List
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
                            <label class="control-label col-md-3">Portfolio Manager</label>

                            <div class="col-md-7">
                                <?php echo $this->StockBangladesh->getInstrumentBootstrapSelect2($userForDropDown, 'manager');
                                ?>

                            </div>
                        </div>
                        <div class="form-group">
                            <label class="control-label col-md-3">Assign users</label>

                            <div class="col-md-7">
                                <?php echo $this->StockBangladesh->getInstrumentBootstrapMultiSelect($userForDropDown, 'userlist');
                                ?>

                            </div>
                        </div>



                        <div>
                            <button type="button" data-loading-text="sending..."
                                    class="demo-loading-btn btn btn-primary btn-block">
                               Assign Users
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



        $("#manager")
            .on("change", function () {

                var userId = $("#manager").selectpicker("val");


                var ajaxUrl = '<?php echo Router::url('/', true)?>DataManagements/manager_list/';

                $.ajax({
                    type: "POST",
                    dataType: 'html',
                    url: ajaxUrl,
                    data: {userId: userId}

                }).done(function (data) {
                    $("#user").html(data);
                 //   $("#used_amount").html(data.balanceUsed);


                });


            });


        $('.demo-loading-btn')
            .click(function () {


                if ($("#Form1").valid()) {


                    var btn = $(this);
                    btn.button('loading');

                    var userId = $("#manager").selectpicker("val");
                    var userList = $("#userlist").selectpicker("val");



                    var ajaxUrl = '<?php echo Router::url('/', true)?>DataManagements/updatePortfolioManager/';

                    $.ajax({
                        type: "POST",
                        dataType: 'html',
                        url: ajaxUrl,
                        data: {
                            userList: userList,
                            userId: userId

                        }

                    }).done(function (data) {

                        btn.button('reset');
                        toastr.success(data.msg, "Updated successfully");
                        //$("#balance").html(data.balance);

                    });

                }
            });




    });




</script>