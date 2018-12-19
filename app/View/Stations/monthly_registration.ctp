
<div class="modal-body">
    <form class="form-horizontal" role="form"  action="<?php echo Router::url('/', true)?>Stations/monthlyReg" method="post" id='reportSubmissionForm'>
        <div class="form-body">

            <div class="form-group">

                <label class="col-md-3 control-label">From</label>
                <div class="col-md-9">
                    <input id="dateFrom" name="dateFrom" class="form-control form-control-inline input-medium date-picker" type="text" value="">
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


/*

        $("#reportSubmissionForm").on('submit',function(event){

            event.preventDefault();
            var param=Array();
            param['dateFrom']= $("#dateFrom").attr('value');
            param['dateTo']= $("#dateTo").attr('value');
            param['brokerHouse']= $("#brokerHouse").attr('value');
            //param['billName']= $("#billName").attr('value');


            $('#show').load("<?php echo Router::url('/', true)?>Stations/monthlyReg/"+param['dateFrom']+","+param['dateTo']+","+param['brokerHouse']+"");


        });
*/


    });


</script>

