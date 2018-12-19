<div id="parentdiv">
<div class="row">
<div class="col-md-6 ">
    <!-- BEGIN Portlet PORTLET-->
    <div class="portlet light bg-inverse">
        <div class="portlet-title">
            <div class="caption">
                <i class="icon-puzzle font-red-flamingo"></i>
											<span class="caption-subject bold font-red-flamingo uppercase">Share update </span>
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

<!--------------------------------------------------------------------------------------Share Add form--------------------------------------------------------------------------------->
<div class="row">
    <div class="col-md-6">

    <div class="portlet light bg-inverse">
            <div class="modal-header" >
              <div class="caption">
                     <i class="icon-puzzle font-red-flamingo"></i>
                        <span class="caption-subject bold font-red-flamingo uppercase">Share Add Form </span>
                     <span class="caption-helper hidden-xs"></span>
                 </div>
                 <div class="tools">
                     <a href="" class="collapse" data-original-title="" title="">
                     </a>

                 </div>
            </div>
            <div class="modal-body">
                <form class="form-horizontal" role="form"  action="" method="post" id='addShareForm'>
                        <div class="form-body">

                            <input  class="form-control" type="hidden" id="portfolioId" name="portfolioId"  value="" >

                             <div class="form-group">
                                <label class="control-label col-md-3">Instrument Id</label>

                                <div class="col-md-7">

                                   <!-- <?php echo $this->StockBangladesh->getInstrumentBootstrapSelect2($instruments, 'instrumentList', 'instrumentList'); ?> ----------->

                                     <div>
                                        <select class="form-control input-xxlarge"  id="instruments" name="instruments" >
                                            <option>--------select an Item------------</option>
                                            <?php foreach($instruments as $val=>$ins){?>
                                            <option value="<?=$val?>"><?=$ins?></option>
                                            <?php }?>
                                        </select>

                                   </div>

                                </div>
                            </div>

                           <div class="form-group">
                               <label class="col-md-3 control-label">Quantity</label>
                               <div class="col-md-9">
                                   <input class="form-control" id="quantity" name="quantity"   value=""  >
                               </div>
                           </div>

                            <div class="form-group">
                                <label class="col-md-3 control-label">Rate</label>
                                <div class="col-md-9">
                                    <input class="form-control" id="rate" name="rate"  value=""  >
                                </div>
                            </div>
                            <div class="form-group">
                               <label class="col-md-3 control-label">Transaction Time</label>
                               <div class="col-md-9">

                                    <input id="transactionTime"  name="transactionTime" class="form-control form-control-inline input-medium date-picker" type="text" value="<?php echo date('Y-m-d');?>">
                               </div>
                           </div>
                            <div class="form-group">
                               <label class="col-md-3 control-label">Transaction Type</label>
                               <div class="col-md-9">

                                   <div>
                                       <select class="form-control input-xxlarge"  id="transaction_type" name="transaction_type" >
                                               <option value="1">Buy</option>
                                               <option value="4">Bonus/Right</option>
                                               <option value="14">IPO</option>
                                       </select>

                                   </div>
                               </div>
                           </div>

                            <div class="form-group">

                                  <div class="col-md-9">
                                   <input type="checkbox" id="effect" name="effect" value="">Add share without effect on balance<br>
                                  </div>
                              </div>


                       </div>
                        <div class="form-actions right1">

                             <button class="btn green btn-primary" type="submit" id='addConfirm' >ADD </button>
                        </div>
                </form>

           </div>
        </div>
    </div>

<!------------------------------------------------------------------------------------share remove form--------------------------------------------------------------------------------->

<div class="col-md-6">

<div class="portlet light bg-inverse">
        <div class="modal-header" >
          <div class="caption">
                 <i class="icon-puzzle font-red-flamingo"></i>
                    <span class="caption-subject bold font-red-flamingo uppercase">Share Remove Form </span>
                 <span class="caption-helper hidden-xs"></span>
             </div>
             <div class="tools">
                 <a href="" class="collapse" data-original-title="" title="">
                 </a>

             </div>
        </div>
        <!--<div class="modal-body" id="removeFormDiv">
            <form class="form-horizontal" role="form"  action="" method="post" id='removeShareForm'>
                    <div class="form-body">

                         <input  class="form-control" type="hidden" id="portfolioId_r" name="portfolioId_r"  value="" >

                         <div class="form-group">
                            <label class="control-label col-md-3">Share</label>

                            <div class="col-md-7">

                                  <div>
                                    <select class="form-control input-xxlarge"  id="wonInstruments" name="wonInstruments" >
                                        <option>--------select an Item------------</option>

                                    </select>

                               </div>

                            </div>
                        </div>




                       <div class="form-group">
                           <label class="col-md-3 control-label">Quantity</label>
                           <div class="col-md-9">
                               <input class="form-control" id="quantity_r" name="quantity_r"   value=""  >
                           </div>
                       </div>


                     <div class="form-group">

                         <div class="col-md-9">
                          <input type="checkbox" id="effect_r" name="effect_r" value="">Remove share without effect on balance<br>
                         </div>
                     </div>

                   </div>
                    <div class="form-actions right1">


                         <button class="btn green btn-primary" type="submit" id='removeConfirm' >REMOVE </button>
                    </div>
            </form>

       </div>-->
    </div>

  </div>
 </div>

<div class="row">
    <div class="col-md-12">

        <div class="portlet light bg-inverse">
            <div class="modal-header" >
                <div class="caption">
                    <i class="icon-puzzle font-red-flamingo"></i>
                    <span class="caption-subject bold font-red-flamingo uppercase">Share Edit Form </span>
                    <span class="caption-helper hidden-xs"></span>
                </div>
                <div class="tools">
                    <a href="" class="collapse" data-original-title="" title="">
                    </a>

                </div>
            </div>
            <div class="modal-body">

                <table class="table table-striped table-bordered table-advance table-hover" id="edit_table">
                    <thead>
                    <tr>
                        <!---  <th>
                              ID
                          </th> --->
                        <th>

                            <i class="fa fa-sliders"></i> ID
                        </th>

                        <th>

                            <i class="fa fa-sliders"></i> Instrument
                        </th>

                        <th>
                            <i class="fa fa-sliders"></i> Quantity
                        </th>
                        <th>
                            <i class="fa fa-sliders"></i> Cost
                        </th>
                        <th>
                            <i class="fa fa-sliders"></i> Type
                        </th>
                        <th>
                            <i class="fa fa-sliders"></i> Buy date
                        </th>

                        <th>
                            <i class="icon-grid"></i> Action column
                        </th>
                    </tr>
                    </thead>
                    <tbody id="">
                    <tr>
                        <td>
                        </td>

                        <td>
                        </td>

                        <td>
                        </td>

                        <td>
                        </td>

                        <td>
                        </td>

                        <td>
                        </td>

                    </tr>

                    </tbody>
                </table>
<div id="portfolio_empty"></div>

            </div>
        </div>
    </div>


</div>
  <button class="btn" id='refreshForm'>Refresh</button>
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


                          $.each(data.summary, function (index, element){

                           var rowNode2 = summeryTable.row.add([
                                      element.ins_code,
                                      element.totalAmount,
                                      element.saleAbleShares,
                                      element.avgCost

                                  ]).draw().node();

                                    //alert(index);
                               $('#wonInstruments').append( $('<option></option>').val(index).html( element.ins_code));


                            });



                      var editTable = $('#edit_table').DataTable().clear().draw();

                          $.each(data.edit, function (index, element){
                              var code=element.ins_code;

                              if(element.transactions!=null)
                           $.each(element.transactions, function (index, trans){

                               var share_type='';
                               if(trans.transaction_type_id==1)
                               {
                                   share_type='Buy';
                               }
                               if(trans.transaction_type_id==4)
                               {
                                   share_type='Bonus/Right';
                               }
                               if(trans.transaction_type_id==14)
                               {
                                   share_type='IPO';
                               }

                           var rowNode2 = editTable.row.add([
                               trans.id,
                               code,
                               trans.amount,
                               trans.rate,
                               share_type,
                               trans.transaction_time,
                               '<a href="http://www.new.stockbangladesh.net/DataManagements/editShare/e/'+trans.id+'" target="_blank">Edit</a> | <a href="http://www.new.stockbangladesh.net/DataManagements/editShare/d/'+trans.id+'" target="_blank">Delete</a>| <a href="http://www.new.stockbangladesh.net/DataManagements/changeDate/d/'+trans.id+'" target="_blank">Change Date</a>',

                                  ]).draw().node();

                              });


                            });

                     $('#portfolio_empty').html('<a href="http://www.new.stockbangladesh.net/DataManagements/emptyPortfolio/'+userId+'" target="_blank" class="btn green btn-primary" >Empty Portfolio </a>');
                     


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