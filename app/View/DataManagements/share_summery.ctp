<div id="parentdiv">
<div class="row">
<div class="col-md-6 ">
    <!-- BEGIN Portlet PORTLET-->
    <div class="portlet light bg-inverse">
        <div class="portlet-title">
            <div class="caption">
                <i class="icon-puzzle font-red-flamingo"></i>
											<span class="caption-subject bold font-red-flamingo uppercase">Share Summery </span>
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
          <form id="Form1" action="javascript:updateChart()" class="form-horizontal form-row-seperated">
                <div class="form-body">

                    <div class="form-group">
                        <label class="control-label col-md-3">Portfolio Id</label>

                        <div class="col-md-7">
                            <?php echo $this->StockBangladesh->getInstrumentBootstrapSelect2($userForDropDown,'userlist1');
                            ?>

                        </div>
                    </div>

                </div>

            </form>


        </div>
    </div>


    <div class="row list-separated profile-stat">
        <div class="col-md-4 col-sm-4 col-xs-6">
            <div class="uppercase profile-stat-title" id="balance">
                0
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

    <!-- END GRID PORTLET-->
</div>

<!------------------------------------------------------------------summery table-------------------------------------------------------------------------------------------------------->
<div class="col-md-6 id="summery_table_div">
 <table class="table table-striped table-bordered table-advance table-hover" id="summery_table">
                            <thead>
                            <tr>
                              <!---  <th>
                                    ID
                                </th> --->


                                <th>

                                    <i class="fa fa-sliders"></i> Instrument
                                </th>

                                <th>
                                    <i class="fa fa-sliders"></i> Quantity
                                </th>
                                 <th>
                                    <i class="fa fa-sliders"></i> Matured Quantity
                                </th>
                                 <th>
                                    <i class="fa fa-sliders"></i> Average Cost
                                 </th>


                            <!--    <th>
                                    <i class="icon-grid"></i> Action column
                                </th> -->
                            </tr>
                            </thead>
                            <tbody id="">

                            </tbody>
                        </table>



</div>

</div>



<!------------------------------------------------------------------------------------scripts----------------------------------------------------------------------------------------------------->



<script>

    $(function () {

      $('.date-picker').datepicker({
            rtl: Metronic.isRTL(),
            orientation: "left",
           // startDate:"+0d",
            format:"yyyy-mm-dd",
             //format:"unixtime",
           // dateFormat: "yy-mm-dd",
           // timeFormat:  "HH:mm:ss",
            daysOfWeekDisabled: '5,6',
            autoclose: true
        });

        $('.bs-select').selectpicker({
            iconBase: 'fa',
            tickIcon: 'fa-check'
        });




            function summeryFunction(userId){

                //alert("called");
                // alert(userId);

                  var ajaxUrl = '<?php echo Router::url('/', true)?>DataManagements/adjustShare';

                  $.ajax({
                      type: "POST",
                      dataType: 'json',
                      url: ajaxUrl,
                      data: {userId: userId},
                      async: true

                  }).done(function (data) {

                       //AddRow(data);
                        // addOrder(allorders.pending,'active_table','basic');


                          var summeryTable = $('#summery_table').DataTable().clear().draw();
                            $('#wonInstruments >option').remove();


                          $.each(data, function (index, element){

                           var rowNode2 = summeryTable.row.add([

                                      element.ins_code,
                                      element.totalAmount,
                                      element.saleAbleShares,
                                      element.avgCost


                                  ]).draw().node();

                                    //alert(index);
                               $('#wonInstruments').append( $('<option></option>').val(index).html( element.ins_code));


                            });




                  });

            }




        $("#wonInstruments").on("change",function ()
                {

                  //  alert('reached');
                    var shareInstrument=$("#wonInstruments").selectpicker("val");
                     var portfolioId = $("#userlist1").selectpicker("val");
                   // alert(shareInstrument);

                     //alert(data['summery'][shareInstrument]['totalAmount']);

                       $.ajax({
                             type: "POST",
                             dataType: 'json',
                             url: '<?php echo Router::url('/', true)?>DataManagements/removeShare',
                             data: {portfolioId: portfolioId,shareInstrument: shareInstrument},
                             async: true

                         }).done(function (data) {
                               // alert('heloo');
                            //  alert(data);
                              $("#quantity_r").attr('value',data);

                         });



                });






     $("#userlist1").on("change",function ()
        {
            var userId = $("#userlist1").selectpicker("val");

             summeryFunction(userId);


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

        //parentdiv

        $("#removeShareForm").on("submit", function (event)
                        {
                             //  alert("reached");
                             event.preventDefault();

                             if($("#effect_r").prop('checked') == true){
                                $("#effect_r").attr('value',1);
                             }
                             else
                             {
                              $("#effect_r").attr('value',0);
                             }

                            var userId = $("#userlist1").selectpicker("val");
                            var sendUrl='<?php echo Router::url('/', true)?>DataManagements/removeShare';

                             $("#portfolioId_r").attr('value',userId);
                             // alert(userId);


                          //  var testId = 12;


                                            $.ajax({
                                                type: "POST",
                                                dataType: 'html',
                                                url: sendUrl,
                                                data:$(this).serialize(),
                                                async: true

                                            }).done(function (returndata) {

                                                 alert(returndata);
                                                //alert("done");

                                               // $("#removeShareForm").trigger( "reset" );

                                              //   summeryFunction(userId);

                                              location.reload(true);


                                });

                         });




       $("#refreshForm").on("click", function (event)
                 {// var userId = $("#userlist1").selectpicker("val");
                     // summeryFunction(userId);
                      location.reload(true);
                  });





         $("#addShareForm").on("submit", function (event)
                {
                     //  alert("reached");
                     event.preventDefault();

                     if($("#effect").prop('checked') == true){

                      $("#effect").attr('value',1);

                     }
                     else
                     {
                      $("#effect").attr('value',0);
                     }


                    var sendUrl='<?php echo Router::url('/', true)?>DataManagements/addShare';
                    var userId = $("#userlist1").selectpicker("val");
                     $("#portfolioId").attr('value',userId);
                     // alert(userId);


                  //  var testId = 12;


                                    $.ajax({
                                        type: "POST",
                                        dataType: 'html',
                                        url: sendUrl,
                                        data:$(this).serialize(),
                                        async: true

                                    }).done(function (data) {

                                         alert(data);
                                         $("#addShareForm").trigger( "reset" );
                                          summeryFunction(userId);

                                    });


                 });





  });

</script>