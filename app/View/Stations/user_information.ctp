<div class="col-md-12">
    <div class="portlet box blue tabbable">
        <div class="portlet-title">
            <div class="caption">
                <i class="fa fa-users"></i>User's Details
            </div>
        </div>
        <div class="portlet-body">
            <div class="tabbable portlet-tabs">
                <ul class="nav nav-tabs">
                    <li>
                        <a href="<?php echo Router::url('/', true)?>stations/activate_users" >
                           All Users </a>
                    </li>
                    <li>
                        <a href="#portlet_tab_2" data-toggle="tab">
                            Active Users</a>
                    </li>

                    <li>
                        <a href="#portlet_tab_3" data-toggle="tab">
                           Inactive Users</a>
                    </li>

                    <li>
                        <a href="#portlet_tab_4" data-toggle="tab">
                           Monthly Registrations</a>
                    </li>

                </ul>
                <div class="tab-content">

                    <div class="tab-pane" id="portlet_tab_1">
                        <?php echo $this->requestAction("stations/activate_users", array("return")); ?>


                    </div>


                    <div class="tab-pane" id="portlet_tab_2">

                        <?php echo $this->requestAction("DataManagements/deposit", array("return")); ?>
                    </div>

                    <div class="tab-pane" id="portlet_tab_3">

                        <?php if($broker_id==$brokerIdApex)
                            echo $this->requestAction("DataManagements/accountInfo", array("return"));
                        if($broker_id==$brokerIdHac)
                            echo $this->requestAction("DataManagements/accountInfo_hac", array("return")); ?>
                    </div>

                    <div class="tab-pane" id="portlet_tab_4">
                        <p><a href="<?php echo Router::url('/', true)?>DataManagements/downloadIPOForm">Click Here</a> to download IPO Application form</p>

                    </div>


                </div>
            </div>
        </div>
    </div>
</div>


<script>

$(function () {



    $('#new_active_table').on('click', function (e) {
        $('#portlet_tab2').load("/new.stockbangladesh.net/Stations/activate_user",function( ) {


        });

    });



});

</script>
