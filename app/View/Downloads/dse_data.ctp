<div class="clearfix"></div>
<div class="row">
<div class="col-md-6">
<!-- BEGIN Portlet PORTLET-->
<div class="portlet light bordered">
<div class="portlet-title">
    <div class="caption">
        <i class="icon-paper-clip font-yellow-casablanca"></i>
								<span class="caption-subject bold font-yellow-casablanca uppercase">
								Download Data</span>
        <span class="caption-helper">Daily data of Dhaka Stock Exchange (DSE)</span>
    </div>
    <div class="tools">
        <a href="" class="collapse">
        </a>

        </a>
        <a href="" class="reload">
        </a>
        <a href="" class="remove">
        </a>
        <a href="javascript:;" class="fullscreen" data-original-title="" title="">
        </a>
    </div>

</div>
<div class="portlet-body">

    <div class="row">
        <div class="col-md-3">
        </div>
        <div class="col-md-6">
            <form id="Form1" action="adjusted_data" method="post">
                <div class="form-group">
                    <div id="reportrange" class="btn default" data-range="2010-10-25|2013-04-25">
                        <i class="fa fa-calendar"></i>
                        &nbsp;
												<span>
												</span>
                        <b class="fa fa-angle-down"></b>
                        <input type="hidden" id="from" name="from">
                        <input type="hidden" id="to" name="to">
                    </div>
                </div>

                <div class="form-group">
                    <!--<select id="adj" class="bs-select form-control" data-style="btn-primary">-->
                    <select id="adj" class="bs-select form-control" data-style="btn-default" name="adjusted">
                        <option value="1" selected>Adjusted Data</option>
                        <option value="0" >Non Adjusted Data</option>
                    </select>
                </div>



                <div class="form-group">
                    <?php echo $this->
                    StockBangladesh->getInstrumentBootstrapSelect($instrumentList,'shareList');
                    ?>

                </div>


                <div>
                    <button id="Button1" name="Button1" type="submit" class="btn green btn-block"><i class="fa fa-check"></i>
                        Download data
                    </button>

                </div>

            </form>
        </div>
        <div class="col-md-3">
        </div>

    </div>



</div>
</div>
<!-- END Portlet PORTLET-->

    <!-- BEGIN Portlet PORTLET-->
    <div class="portlet light bordered">
        <div class="portlet-title">
            <div class="caption">
                <i class="icon-paper-clip font-yellow-casablanca"></i>
								<span class="caption-subject bold font-yellow-casablanca uppercase">
								Day Data</span>
                <span class="caption-helper"></span>
            </div>
            <div class="tools">
                <a href="" class="collapse">
                </a>

                </a>
                <a href="" class="reload">
                </a>
                <a href="" class="remove">
                </a>
                <a href="javascript:;" class="fullscreen" data-original-title="" title="">
                </a>
            </div>

        </div>
        <div class="portlet-body">

            <div class="row">
                <div class="col-md-3">
                </div>
                <div class="col-md-6">
                    <a href="<?php echo Router::url(array('controller' => 'Downloads', 'action' => 'all_data_lastday')); ?>/1" class="btn default btn-block">
                        Last day data (adjusted) </a>
                    <a href="<?php echo Router::url(array('controller' => 'Downloads', 'action' => 'all_data_lastday')); ?>/0" class="btn default btn-block">
                        Last day data (Non adjusted) </a>
                </div>
                <div class="col-md-3">
                </div>

            </div>



        </div>
    </div>
    <!-- END Portlet PORTLET-->
</div>
<div class="col-md-6">
<!-- BEGIN Portlet PORTLET-->
<div class="portlet light bordered">
<div class="portlet-title">
    <div class="caption">
        <i class="icon-paper-clip font-yellow-casablanca"></i>
								<span class="caption-subject bold font-yellow-casablanca uppercase">
								All Together Adjusted Data</span>
        <span class="caption-helper"></span>
    </div>
    <div class="tools">
        <a href="" class="collapse">
        </a>

        </a>
        <a href="" class="reload">
        </a>
        <a href="" class="remove">
        </a>
        <a href="javascript:;" class="fullscreen" data-original-title="" title="">
        </a>
    </div>

</div>
<div class="portlet-body">

    <div class="row">
      <!--  <div class="col-md-3">
        </div>-->
        <div class="col-md-12">
            <form id="Form1" action="data_all" method="post">
                <div class="form-group">
                    <?php  $from=date('Y-m-d'); ?>
                    <a href="<?php echo Router::url(array('controller'=>'Downloads','action'=>'all_data'));?>/<?php echo $from; ?>/1" class="icon-btn">
                        <i class="fa fa-calendar"></i>
                        <div><?php echo date('F'); ?> </div>
                        <span class="badge badge-success"><?php echo date('y'); ?></span>
                    </a>


                    <?php
                    for($i=1;$i<24;$i++)
                    {

                    $from=date('Y-m-d', strtotime("-$i month"));?>
                    <a href="<?php echo Router::url(array('controller'=>'Downloads','action'=>'all_data'));?>/<?php echo $from; ?>" class="icon-btn">
                    <i class="fa fa-calendar"></i>
                        <div><?php echo date('F', strtotime("-$i month")); ?> </div>
                        <span class="badge badge-success"><?php echo date('y', strtotime("-$i month")); ?></span>
                    </a>
<?php } ?>



                </div>



            </form>
        </div>
        <!--<div class="col-md-3">
        </div>-->

    </div>

</div>
</div>
<!-- END Portlet PORTLET-->

    <!-- BEGIN Portlet PORTLET-->
    <div class="portlet light bordered">
        <div class="portlet-title">
            <div class="caption">
                <i class="icon-paper-clip font-yellow-casablanca"></i>
								<span class="caption-subject bold font-yellow-casablanca uppercase">
								All Together Non Adjusted Data</span>
                <span class="caption-helper"></span>
            </div>
            <div class="tools">
                <a href="" class="collapse">
                </a>

                </a>
                <a href="" class="reload">
                </a>
                <a href="" class="remove">
                </a>
                <a href="javascript:;" class="fullscreen" data-original-title="" title="">
                </a>
            </div>

        </div>
        <div class="portlet-body">

            <div class="row">
                <!--  <div class="col-md-3">
                  </div>-->
                <div class="col-md-12">
                    <form id="Form1" action="data_all" method="post">
                        <div class="form-group">
                            <?php  $from=date('Y-m-d'); ?>
                            <a href="<?php echo Router::url(array('controller'=>'Downloads','action'=>'all_data'));?>/<?php echo $from; ?>/0" class="icon-btn">
                                <i class="fa fa-calendar"></i>
                                <div><?php echo date('F'); ?> </div>
                                <span class="badge badge-primary"><?php echo date('y'); ?></span>
                            </a>


                            <?php
                            for($i=1;$i<24;$i++)
                            {

                                $from=date('Y-m-d', strtotime("-$i month"));?>
                                <a href="<?php echo Router::url(array('controller'=>'Downloads','action'=>'all_data'));?>/<?php echo $from; ?>/0" class="icon-btn">
                                    <i class="fa fa-calendar"></i>
                                    <div><?php echo date('F', strtotime("-$i month")); ?> </div>
                                    <span class="badge badge-primary"><?php echo date('y', strtotime("-$i month")); ?></span>
                                </a>
                            <?php } ?>



                        </div>



                    </form>
                </div>
                <!--<div class="col-md-3">
                </div>-->

            </div>

        </div>
    </div>
    <!-- END Portlet PORTLET-->
</div>
</div>


<script type="text/javascript">

    $(function () {

        $('.bs-select').selectpicker({
            iconBase: 'fa',
            tickIcon: 'fa-check'
        });


        var chartRange;
        $('#reportrange').daterangepicker({
                opens: (Metronic.isRTL() ? 'left' : 'right'),
                startDate: moment().subtract('days', 252),
                endDate: moment(),
                minDate: '01/01/1999',
                maxDate: moment(),
                dateLimit: {
                    days: 3000
                },
                showDropdowns: true,
                showWeekNumbers: true,
                timePicker: false,
                timePickerIncrement: 1,
                timePicker12Hour: true,
                ranges: {
                    //  'Last 7 Days': [moment().subtract('days', 6), moment()],
                    //  'Last 30 Days': [moment().subtract('days', 29), moment()],
                    //  'This Month': [moment().startOf('month'), moment().endOf('month')],
                    //  'Last Month': [moment().subtract('month', 1).startOf('month'), moment().subtract('month', 1).endOf('month')],
                    '4 months': [moment().subtract('month', 4), moment()],
                    '6 months': [moment().subtract('month', 6), moment()],
                    '1 year': [moment().subtract('year', 1), moment()],
                    '2 year': [moment().subtract('year', 2), moment()],
                    '4 year': [moment().subtract('year', 4), moment()],
                    '5 year': [moment().subtract('year', 5), moment()],
                    '7 year': [moment().subtract('year', 7), moment()]
                },
                buttonClasses: ['btn'],
                applyClass: 'green',
                cancelClass: 'default',
                format: 'MM/DD/YYYY',
                separator: ' to ',
                locale: {
                    applyLabel: 'Apply',
                    fromLabel: 'From',
                    toLabel: 'To',
                    customRangeLabel: 'Custom Range',
                    daysOfWeek: ['Su', 'Mo', 'Tu', 'We', 'Th', 'Fr', 'Sa'],
                    monthNames: ['January', 'February', 'March', 'April', 'May', 'June', 'July', 'August', 'September', 'October', 'November', 'December'],
                    firstDay: 1
                }
            },
            function (start, end) {
                console.log("Callback has been called!");
                $('#reportrange span').html(start.format('MMM, YY') + ' - ' + end.format('MMM, YY'));
                chartRange=start.format('YYYY-MM-DD')+'|'+end.format('YYYY-MM-DD');
                $('#reportrange').attr("data-range",chartRange);
                $('#from').val(start.format('YYYY-MM-DD'));
                $('#to').val(end.format('YYYY-MM-DD'));

            }
        );
        $('#reportrange span').html(moment().subtract('days', 730).format('MMM, YY') + ' - ' + moment().format('MMM, YY'));
        chartRange=moment().subtract('days', 730).format('YYYY-MM-DD') + '|' + moment().format('YYYY-MM-DD');
        $('#reportrange').attr("data-range",chartRange);


        var chartRange2;
        $('#reportrange2').daterangepicker({
                opens: (Metronic.isRTL() ? 'left' : 'right'),
                startDate: moment().subtract('days', 252),
                endDate: moment(),
                minDate: '01/01/1999',
                maxDate: moment(),
                dateLimit: {
                    days: 3000
                },
                showDropdowns: true,
                showWeekNumbers: true,
                timePicker: false,
                timePickerIncrement: 1,
                timePicker12Hour: true,
                ranges: {
                    //  'Last 7 Days': [moment().subtract('days', 6), moment()],
                    //  'Last 30 Days': [moment().subtract('days', 29), moment()],
                    //  'This Month': [moment().startOf('month'), moment().endOf('month')],
                    //  'Last Month': [moment().subtract('month', 1).startOf('month'), moment().subtract('month', 1).endOf('month')],
                    '4 months': [moment().subtract('month', 4), moment()],
                    '6 months': [moment().subtract('month', 6), moment()],
                    '1 year': [moment().subtract('year', 1), moment()],
                    '2 year': [moment().subtract('year', 2), moment()],
                    '4 year': [moment().subtract('year', 4), moment()],
                    '5 year': [moment().subtract('year', 5), moment()],
                    '7 year': [moment().subtract('year', 7), moment()]
                },
                buttonClasses: ['btn'],
                applyClass: 'green',
                cancelClass: 'default',
                format: 'MM/DD/YYYY',
                separator: ' to ',
                locale: {
                    applyLabel: 'Apply',
                    fromLabel: 'From',
                    toLabel: 'To',
                    customRangeLabel: 'Custom Range',
                    daysOfWeek: ['Su', 'Mo', 'Tu', 'We', 'Th', 'Fr', 'Sa'],
                    monthNames: ['January', 'February', 'March', 'April', 'May', 'June', 'July', 'August', 'September', 'October', 'November', 'December'],
                    firstDay: 1
                }
            },
            function (start, end) {
                console.log("Callback has been called!");
                $('#reportrange2 span').html(start.format('MMM, YY') + ' - ' + end.format('MMM, YY'));
                chartRange2=start.format('YYYY-MM-DD')+'|'+end.format('YYYY-MM-DD');
                $('#reportrange2').attr("data-range",chartRange2);
                $('#from2').val(start.format('YYYY-MM-DD'));
                $('#to2').val(end.format('YYYY-MM-DD'));

            }
        );
        $('#reportrange2 span').html(moment().subtract('days', 730).format('MMM, YY') + ' - ' + moment().format('MMM, YY'));
        chartRange2=moment().subtract('days', 730).format('YYYY-MM-DD') + '|' + moment().format('YYYY-MM-DD');
        $('#reportrange2').attr("data-range",chartRange2);




    });

</script>