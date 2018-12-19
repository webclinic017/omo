
 <div class="modal-body">
	<form class="form-horizontal" role="form"  action="" method="post" id='reportSubmissionForm'>
			<div class="form-body">

				 <div class="form-group">

				   <label class="col-md-3 control-label">From</label>
				   <div class="col-md-9">
						<input id="dateForm" name="dateForm" class="form-control form-control-inline input-medium date-picker" type="text" value="">
				   </div>
			   	</div>

			   	 <div class="form-group">

				   <label class="col-md-3 control-label">To</label>
				   <div class="col-md-9">
						<input id="dateTo" name="dateTo" class="form-control form-control-inline input-medium date-picker" type="text" value="">
				   </div>
				</div>

				 <div class="form-group">
					<label class="control-label col-md-3">Broker House</label>

					<div class="col-md-7">

					   <div>
							 <input class="form-control" id="brokerHouse" name="brokerHouse" value="<?=$brokers[0]['Broker']['id']?>" readonly>
					   </div>

					</div>
				</div>

				 <div class="form-group">
					<label class="control-label col-md-3">Report Type</label>

					<div class="col-md-7">

						  <div>
							<select class="form-control input-xxlarge"  id="billName" name="billName" >
								<option>--------select a type------------</option>
								<?php if($brokers[0]['Broker']['id']==11){?>
								<option value="1">Apex Billing Report </option>
								<option value="2">Introducer Agent Report</option>
								<?php }?>
								<?php if($brokers[0]['Broker']['id']==5){?>
								<option value="3">Hac Billing Report </option>
								<?php }?>
								<?php if($brokers[0]['Broker']['id']==6){?>
								<option value="4">Sharp Billing Report </option>
								<?php }?>
                                <?php if($brokers[0]['Broker']['id']==12){?>
                                    <option value="12">Commerce Billing Report </option>
                                <?php }?>
                                <?php if($brokers[0]['Broker']['id']==3){?>
                                    <option value="3">Sharp KawranBazar Billing Report </option>
                                <?php }?>
                                <?php if($brokers[0]['Broker']['id']==9){?>
                                    <option value="9">Fakhrul Islam Billing Report </option>
                                <?php }?>

							</select>

					   </div>

					</div>
				</div>

		   </div>
			<div class="form-actions right1">

				 <button class="btn green btn-primary" type="submit" name="submit" id='reportSubmit' >Show<i class="m-icon-swapright m-icon-white"> </i></button>
			</div>
	</form>

</div>


<div id="show">
</div>

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



 $("#reportSubmissionForm").on('submit',function(event){

        event.preventDefault();
        var param=Array();
        param['dateForm']= $("#dateForm").attr('value');
        param['dateTo']= $("#dateTo").attr('value');
        param['brokerHouse']= $("#brokerHouse").attr('value');
        param['billName']= $("#billName").attr('value');


       if(param['billName']==1 &&  param['brokerHouse']==11)
        {

         $('#show').load("<?php echo Router::url('/', true)?>BrokerReports/billingReport/"+param['dateForm']+","+param['dateTo']+","+param['brokerHouse']+"");

        }


        if(param['billName']==2 && param['brokerHouse']==11)
        {

         $('#show').load("<?php echo Router::url('/', true)?>BrokerReports/introducerAgentReport/"+param['dateForm']+","+param['dateTo']+","+param['brokerHouse']+"");

        }

        if(param['billName']==3 &&  param['brokerHouse']==5)
		{

		 $('#show').load("<?php echo Router::url('/', true)?>BrokerReports/billingReportHac/"+param['dateForm']+","+param['dateTo']+","+param['brokerHouse']+"");

		}

		if(param['billName']==4 &&  param['brokerHouse']==6)
		{

		 $('#show').load("<?php echo Router::url('/', true)?>BrokerReports/billingReportSharp/"+param['dateForm']+","+param['dateTo']+","+param['brokerHouse']+"");

		}

         if(param['brokerHouse']==12)
         {

             $('#show').load("<?php echo Router::url('/', true)?>BrokerReports/billingReportCommerce/"+param['dateForm']+","+param['dateTo']+","+param['brokerHouse']+"");

         }
         if(param['brokerHouse']==3)
         {

             $('#show').load("<?php echo Router::url('/', true)?>BrokerReports/billingReportSbsharp/"+param['dateForm']+","+param['dateTo']+","+param['brokerHouse']+"");

         }
     if(param['brokerHouse']==9)
     {

         $('#show').load("<?php echo Router::url('/', true)?>BrokerReports/billingReportFis/"+param['dateForm']+","+param['dateTo']+","+param['brokerHouse']+"");

     }


   });


});


	</script>

