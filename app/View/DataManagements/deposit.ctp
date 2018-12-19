
<div class="col-md-6">

<div class="portlet light bg-inverse">
            <div class="modal-header" >
              <div class="caption">
                     <i class="icon-puzzle font-red-flamingo"></i>
                        <span class="caption-subject bold font-red-flamingo uppercase">Deposit Form </span>
                     <span class="caption-helper hidden-xs"></span>
                 </div>
                 <div class="tools">
                     <a href="" class="collapse" data-original-title="" title="">
                     </a>

                 </div>
            </div>
            <div class="modal-body">
                <form class="form-horizontal" role="form"  action="<?php echo Router::url('/', true)?>DataManagements/deposit" method="post" enctype="multipart/form-data" id='depositSubmissionForm'>
                        <div class="form-body">


                             <div class="form-group">
                                <label class="control-label col-md-3">Deposit Amount</label>
                                    <div class="col-md-9">
                                       <input class="form-control" id="depositAmount" name="depositAmount"  value=""  >
                                    </div>
                                </div>
                            </div>

                           <div class="form-group">
                               <label class="col-md-3 control-label">Bank Name</label>
                               <div class="col-md-9">
                                   <input class="form-control" id="bankName" name="bankName"   value=""  >
                               </div>
                           </div>

                            <div class="form-group">
                                <label class="col-md-3 control-label">Branch Name</label>
                                <div class="col-md-9">
                                    <input class="form-control" id="branchName" name="branchName"  value=""  >
                                </div>
                            </div>
                            <div class="form-group">
                               <label class="col-md-3 control-label">Deposit Date</label>
                               <div class="col-md-9">
                                    <input id="depositDate" name="depositDate" class="form-control form-control-inline input-medium date-picker" type="text" value="<?php echo date('Y-m-d');?>">
                               </div>
                           </div>

                            <div class="form-group">
                                  <label class="col-md-3 control-label">Deposit Type</label>
                                  <div class="col-md-9">
                                  <div class="row">
                                   <input type="radio" name="pay" value="Cheque" checked>Cheque
                                   <input type="radio" name="pay" value="Cash">Cash

                            </div>

                             <div class="form-group">
                                   <div class="col-md-9">
                                      <input type="file" id="depositSlip"  name="depositSlip">
                                       <label>

                                              (In case of cheque only )
                                              Supported File format: jpg, jpeg, bmp, png, gif,pdf
                                              Max File Size: 1MB
                                       </label>
                                   </div>
                               </div>


                       </div>
                        <div class="form-actions right1">

                             <button class="btn green btn-primary" type="submit" id='depositSubmit' >Submit <i class="m-icon-swapright m-icon-white"> </i></button>
                        </div>
                </form>

           </div>

    </div>
 </div>



</div>



<div id="showImage" class="" >
deposit slip
<img id="imagePlot" src="" alt="no slip" height="200" width="420">

</div>

<!------------------------------------------------------------------summery table-------------------------------------------------------------------------------------------------------->


<div class="col-md-12" id="summery_table_div">
 <div class="portlet-title">
                    <div class="caption">
                        <i class="icon-puzzle font-red-flamingo"></i>
        											<span class="caption-subject bold font-red-flamingo uppercase">Deposit Details </span>
                        <span class="caption-helper hidden-xs"></span>
                    </div>
          </div>
 <table class="table table-striped table-bordered table-advance table-hover" id="deposit_summery_table">
                            <thead>
                            <tr>
                              <!---  <th>
                                    ID
                                </th> --->


                                <th>

                                    <i class="fa fa-sliders"></i> Deposit Amount
                                </th>

                                <th>
                                    <i class="fa fa-sliders"></i> Payment Type
                                </th>
                                 <th>
                                    <i class="fa fa-sliders"></i> Bank Name
                                </th>


                                 <th>
                                    <i class="icon-grid"></i> Branch Name
                                </th>

                                  <th>
                                        <i class="fa fa-sliders"></i> Deposit Date
                                    </th>

                                     <th>
                                        <i class="fa fa-sliders"></i> Deposit Slip
                                    </th>
                            </tr>
                            </thead>
                            <tbody id="">

                                   <?php foreach($depositList as $key=>$deposits ){ ?>
                                                           <tr>
                                                               <td>
                                                                 <?=$deposits['UserDeposits']['amount']?>
                                                              </td>
                                                              <td>
                                                              <?=$deposits['UserDeposits']['payment_type']?>
                                                              </td>
                                                               <td>
                                                               <?=$deposits['UserDeposits']['bank']?>
                                                               </td>
                                                                <td>
                                                              <?=$deposits['UserDeposits']['branch']?>
                                                                </td>
                                                               <td>
                                                              <?=$deposits['UserDeposits']['ddate']?>

                                                              </td>


                                                                   <td>
                                                                        <a id="iLink<?=$key?>" href="#showImage" i_src="<?php echo Router::url('/', true)?>/files/uploads/deposit/<?=$deposits['UserDeposits']['cheque_ref']?>"> view slip</a>
                                                               <!-----  <img src="<?php echo Router::url('/', true)?>/files/uploads/deposit/<?=$deposits['UserDeposits']['cheque_ref']?>" alt="no slip" height="100" width="100">---->

                                                                   </td>
                                                            
                                                          </tr>
                                                     <?php }?>


                            </tbody>
                        </table>



</div>



<!------------------------------------------------------------------------------------scripts----------------------------------------------------------------------------------------------------->



<script>

    $(function () {

      $('.date-picker').datepicker({
            rtl: Metronic.isRTL(),
            orientation: "left",
            startDate:"+0d",
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


/*
             $("#depositSubmissionForm").on("submit", function (event)
                {

                     // alert("reached");

                         event.preventDefault();

                 var sendUrl='<?php echo Router::url('/', true)?>DataManagements/deposit';

                    $.ajax({
                         type: "POST",
                         dataType: 'html',
                         url: sendUrl,
                        // data:$(this).serialize(),
                         async: true

                     }).done(function (data) {

                          alert(data);
                          // summeryFunction(userId);

                     });


                });*/


                         //$("a[id^=iLink]").on('click',function(){

                        $("#deposit_summery_table").on('click',"a[id^=iLink]",function(){

                                        //$("#buyShareForm").trigger( "reset" );

                                        var imagePath = $(this).attr('i_src');
                                       // alert(imagePath);
                                        $("#imagePlot").attr('src',imagePath);
                                        //var imagePath1 = $('#imagePlot').attr('src');
                                        //alert(imagePath1);
                            });

                     // var summeryTable = $('#deposit_summery_table').DataTable();
                       $('#deposit_summery_table').DataTable();


                      // $("#showImage").fadeOut();

    });




</script>
