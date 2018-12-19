<?php
//$this->Html->addCrumb('Market Home', '/markets');
$this->Html->addCrumb('Market Home', array('controller' => 'markets', 'action' => 'home'));
?>

<!-- FEEDBACK MODAL HERE STARTS -->
<div class="row">

    <?php echo $this->element('indicators_modal'); ?>

</div>
<!-- FEEDBACK MODAL HERE ENDS -->

    <div class="clearfix"></div>

    <div class="row">
        <div class="col-md-12">
            <!-- BEGIN Portlet PORTLET-->
            <div class="portlet light bordered">
                <div class="portlet-title">
                    <div class="caption">
                        <i class="icon-graph font-yellow-casablanca"></i>
								<span class="caption-subject bold font-yellow-casablanca uppercase">
								Indicators </span>
                        <span class="caption-helper">Add/Remove and configure indicators</span>
                    </div>
                    <div class="tools">
                        <a href="" class="expand">
                        </a>

                        </a>
                        <a href="" class="reload">
                        </a>
                        <a href="" class="remove">
                        </a>
                    </div>

                </div>
                <div class="portlet-body display-hide">
                <div class="row">
                <div class="col-md-3">
                <div class="table-responsive">
                    <table class="table table-striped table-bordered table-advance table-hover table-condensed">
                        <thead>
                        <tr>
                            <th>
                                <i class="fa fa-power-off"></i>
                            </th>
                            <th class="hidden-xs">
                                <i class="fa fa-briefcase"></i> Indicator
                            </th>
                            <th>
                                <i class="fa fa-wrench"></i>
                            </th>

                        </tr>
                        </thead>
                        <tbody>
                        <tr>
                            <td class="highlight">

                                <input type="checkbox" id="idADLIndicatorChart" overlay="false" class="make-switch" data-size="mini"
                                       autocomplete="off" autocomplete="off">

                            </td>
                            <td class="hidden-xs">
                                A/D
                            </td>
                            <td>
                                <a href="#idADLIndicatorChart_param" disabled="disabled" id="idADLIndicatorChart_edit"
                                   class="btn default btn-xs blue" data-toggle="modal">
                                    <i class="fa fa-edit"></i>
                                </a>

                            </td>

                        </tr>
                        <tr>
                            <td class="highlight">

                                <input type="checkbox" id="idAMAIndicator" overlay=true class="make-switch" data-size="mini"
                                       autocomplete="off">

                            </td>
                            <td class="hidden-xs">
                                Adaptive MA
                            </td>
                            <td>
                                <a href="#idAMAIndicator_param" disabled="disabled" id="idAMAIndicator_edit"
                                   class="btn default btn-xs blue" data-toggle="modal">
                                    <i class="fa fa-edit"></i>
                                </a>
                            </td>

                        </tr>
                        <tr>
                            <td class="highlight">

                                <input type="checkbox" id="idAroonIndicatorChart" overlay="false" class="make-switch"
                                       data-size="mini" autocomplete="off">

                            </td>
                            <td class="hidden-xs">
                                Aroon
                            </td>
                            <td>

                                <a href="#idAroonIndicatorChart_param" disabled="disabled" id="idAroonIndicatorChart_edit"
                                   class="btn default btn-xs blue" data-toggle="modal">
                                    <i class="fa fa-edit"></i>
                                </a>
                            </td>

                        </tr>
                        <tr>
                            <td class="highlight">

                                <input type="checkbox" id="idATRIndicatorChart" overlay="false" class="make-switch" data-size="mini"
                                       autocomplete="off">

                            </td>
                            <td class="hidden-xs">
                                ATR
                            </td>
                            <td>
                                <a href="#idATRIndicatorChart_param" disabled="disabled" id="idATRIndicatorChart_edit"
                                   class="btn default btn-xs blue" data-toggle="modal">
                                    <i class="fa fa-edit"></i>
                                </a>
                            </td>

                        </tr>
                        <tr>
                            <td class="highlight">

                                <input type="checkbox" id="idBBandsIndicator" overlay="true" class="make-switch" data-size="mini"
                                       autocomplete="off">

                            </td>
                            <td class="hidden-xs">
                                Bollinger Bands
                            </td>
                            <td>
                                <a href="#idBBandsIndicator_param" id="idBBandsIndicator_edit" disabled="disabled"
                                   class="btn default btn-xs blue" data-toggle="modal">
                                    <i class="fa fa-edit"></i>
                                </a>
                            </td>

                        </tr>
                        <tr>
                            <td class="highlight">

                                <input type="checkbox" id="idBBandsBIndicatorChart" overlay="false" class="make-switch"
                                       data-size="mini" autocomplete="off">

                            </td>
                            <td class="hidden-xs">
                                BBands %B
                            </td>
                            <td>

                                <a href="#idBBandsBIndicatorChart_param" id="idBBandsBIndicatorChart_edit" disabled="disabled"
                                   class="btn default btn-xs blue" data-toggle="modal">
                                    <i class="fa fa-edit"></i>
                                </a>
                            </td>

                        </tr>
                        <tr>
                            <td class="highlight">

                                <input type="checkbox" id="idBBandsWidthIndicatorChart" overlay="false" class="make-switch"
                                       data-size="mini" autocomplete="off">

                            </td>
                            <td class="hidden-xs">
                                BBands Width
                            </td>
                            <td>
                                <a href="#idBBandsWidthIndicatorChart_param" id="idBBandsWidthIndicatorChart_edit"
                                   disabled="disabled" class="btn default btn-xs blue" data-toggle="modal">
                                    <i class="fa fa-edit"></i>
                                </a>
                            </td>

                        </tr>
                        <tr>
                            <td class="highlight">

                                <input type="checkbox" id="idCCIIndicatorChart" overlay="false" class="make-switch" data-size="mini"
                                       autocomplete="off">

                            </td>
                            <td class="hidden-xs">
                                CCI
                            </td>
                            <td>
                                <a href="#idCCIIndicatorChart_param" id="idCCIIndicatorChart_edit" disabled="disabled"
                                   class="btn default btn-xs blue" data-toggle="modal">
                                    <i class="fa fa-edit"></i>
                                </a>
                            </td>

                        </tr>
                        <tr>
                            <td class="highlight">

                                <input type="checkbox" id="idChaikinOscillatorIndicatorChart" overlay="false" class="make-switch"
                                       data-size="mini" autocomplete="off">

                            </td>
                            <td class="hidden-xs">
                                Chaikin Oscillator
                            </td>
                            <td>
                                <a href="#a" class="btn default btn-xs blue">
                                    <i class="fa fa-edit"></i>
                                </a>
                            </td>

                        </tr>
                        <tr>
                            <td class="highlight">

                                <input type="checkbox" id="idCMFIndicatorChart" overlay="false" class="make-switch" data-size="mini"
                                       autocomplete="off">

                            </td>
                            <td class="hidden-xs">
                                Chaikin Money Fl
                            </td>
                            <td>
                                <a href="#a" class="btn default btn-xs blue">
                                    <i class="fa fa-edit"></i>
                                </a>
                            </td>

                        </tr>
                        </tbody>
                    </table>
                </div>
                </div>
                <div class="col-md-3">
                    <div class="table-responsive">
                        <table class="table table-striped table-bordered table-advance table-hover table-condensed">
                            <thead>
                            <tr>
                                <th>
                                    <i class="fa fa-briefcase"></i>
                                </th>
                                <th class="hidden-xs">
                                    <i class="fa fa-user"></i> Indicator
                                </th>
                                <th>
                                    <i class="fa fa-wrench"></i>
                                </th>

                            </tr>
                            </thead>
                            <tbody>
                            <tr>
                                <td class="highlight">

                                    <input type="checkbox" id="idCHVIndicatorChart" overlay="false" class="make-switch" data-size="mini"
                                           autocomplete="off" data-on="success" data-off="danger">

                                </td>
                                <td class="hidden-xs">
                                    Chaikin Volatility
                                </td>
                                <td>
                                    <a href="#a" class="btn default btn-xs blue">
                                        <i class="fa fa-edit"></i>
                                    </a>
                                </td>

                            </tr>
                            <tr>
                                <td class="highlight">

                                    <input type="checkbox" id="idDMIIndicatorChart" overlay="false" class="make-switch" data-size="mini"
                                           autocomplete="off" data-on="success" data-off="danger">

                                </td>
                                <td class="hidden-xs">
                                    DMI
                                </td>
                                <td>
                                    <a href="#a" class="btn default btn-xs blue">
                                        <i class="fa fa-edit"></i>
                                    </a>
                                </td>

                            </tr>
                            <tr>
                                <td class="highlight">

                                    <input type="checkbox" id="idEMAIndicator" overlay="true" class="make-switch" data-size="mini"
                                           autocomplete="off" data-on="success" data-off="danger">

                                </td>
                                <td class="hidden-xs">
                                    EMA
                                </td>
                                <td>
                                    <a href="#a" class="btn default btn-xs blue">
                                        <i class="fa fa-edit"></i>
                                    </a>
                                </td>

                            </tr>
                            <tr>
                                <td class="highlight">

                                    <input type="checkbox" id="idKeltnerChannelsIndicator" overlay="true" class="make-switch"
                                           data-size="mini" autocomplete="off" data-on="success" data-off="danger">

                                </td>
                                <td class="hidden-xs">
                                    Keltner Channels
                                </td>
                                <td>
                                    <a href="#a" class="btn default btn-xs blue">
                                        <i class="fa fa-edit"></i>
                                    </a>
                                </td>

                            </tr>
                            <tr>
                                <td class="highlight">

                                    <input type="checkbox" id="idMMAIndicator" overlay="true" class="make-switch" data-size="mini"
                                           autocomplete="off" data-on="success" data-off="danger">

                                </td>
                                <td class="hidden-xs">
                                    MMA
                                </td>
                                <td>
                                    <a href="#a" class="btn default btn-xs blue">
                                        <i class="fa fa-edit"></i>
                                    </a>
                                </td>

                            </tr>
                            <tr>
                                <td class="highlight">

                                    <input type="checkbox" id="idMfiIndicatorChart" overlay="false" class="make-switch" data-size="mini"
                                           autocomplete="off" data-on="success" data-off="danger">

                                </td>
                                <td class="hidden-xs">
                                    MFI
                                </td>
                                <td>
                                    <a href="#a" class="btn default btn-xs blue">
                                        <i class="fa fa-edit"></i>
                                    </a>
                                </td>

                            </tr>
                            <tr>
                                <td class="highlight">

                                    <input type="checkbox" id="idMomentumIndicatorChart" overlay="false" class="make-switch"
                                           data-size="mini" autocomplete="off" data-on="success" data-off="danger">

                                </td>
                                <td class="hidden-xs">
                                    Momentum
                                </td>
                                <td>
                                    <a href="#a" class="btn default btn-xs blue">
                                        <i class="fa fa-edit"></i>
                                    </a>
                                </td>

                            </tr>
                            <tr>
                                <td class="highlight">

                                    <input type="checkbox" checked id="idMacdIndicatorChart" overlay="false" class="make-switch"
                                           data-size="mini" autocomplete="off" data-on="success" data-off="danger">

                                </td>
                                <td class="hidden-xs">
                                    MACD
                                </td>
                                <td>
                                    <a href="#a" class="btn default btn-xs blue">
                                        <i class="fa fa-edit"></i>
                                    </a>
                                </td>

                            </tr>
                            <tr>
                                <td class="highlight">

                                    <input type="checkbox" id="idMAEnvelopesIndicator" overlay="false" class="make-switch"
                                           data-size="mini" autocomplete="off" data-on="success" data-off="danger">

                                </td>
                                <td class="hidden-xs">
                                    MA Envelopes
                                </td>
                                <td>
                                    <a href="#a" class="btn default btn-xs blue">
                                        <i class="fa fa-edit"></i>
                                    </a>
                                </td>

                            </tr>
                            <tr>
                                <td class="highlight">

                                    <input type="checkbox" id="idOBVIndicatorChart" overlay="false" class="make-switch" data-size="mini"
                                           autocomplete="off">

                                </td>
                                <td class="hidden-xs">
                                    OBV
                                </td>
                                <td>
                                    <a href="#a" class="btn default btn-xs blue">
                                        <i class="fa fa-edit"></i>
                                    </a>
                                </td>

                            </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="table-responsive">
                        <table class="table table-striped table-bordered table-advance table-hover table-condensed">
                            <thead>
                            <tr>
                                <th>
                                    <i class="fa fa-briefcase"></i>
                                </th>
                                <th class="hidden-xs">
                                    <i class="fa fa-user"></i> Indicator
                                </th>
                                <th>
                                    <i class="fa fa-wrench"></i>
                                </th>

                            </tr>
                            </thead>
                            <tbody>

                            <tr>
                                <td class="highlight">

                                    <input type="checkbox" id="idPSARIndicator" overlay="true" class="make-switch" data-size="mini"
                                           autocomplete="off">

                                </td>
                                <td class="hidden-xs">
                                    Parabolic SAR
                                </td>
                                <td>
                                    <a href="#a" class="btn default btn-xs blue">
                                        <i class="fa fa-edit"></i>
                                    </a>
                                </td>

                            </tr>
                            <tr>
                                <td class="highlight">

                                    <input type="checkbox" id="idPriceChannelsIndicator" overlay="true" class="make-switch"
                                           data-size="mini" autocomplete="off">

                                </td>
                                <td class="hidden-xs">
                                    Price Channels
                                </td>
                                <td>
                                    <a href="#a" class="btn default btn-xs blue">
                                        <i class="fa fa-edit"></i>
                                    </a>
                                </td>

                            </tr>
                            <tr>
                                <td class="highlight">

                                    <input type="checkbox" id="idROCIndicatorChart" overlay="false" class="make-switch" data-size="mini"
                                           autocomplete="off">

                                </td>
                                <td class="hidden-xs">
                                    ROC
                                </td>
                                <td>
                                    <a href="#a" class="btn default btn-xs blue">
                                        <i class="fa fa-edit"></i>
                                    </a>
                                </td>

                            </tr>
                            <tr>
                                <td class="highlight">

                                    <input type="checkbox" id="idRSIIndicatorChart" overlay="false" class="make-switch" data-size="mini"
                                           autocomplete="off">

                                </td>
                                <td class="hidden-xs">
                                    RSI
                                </td>
                                <td>
                                    <a href="#a" class="btn default btn-xs blue">
                                        <i class="fa fa-edit"></i>
                                    </a>
                                </td>

                            </tr>
                            <tr>
                                <td class="highlight">

                                    <input type="checkbox" checked id="idSMAIndicator" overlay="true" class="make-switch"
                                           data-size="mini" autocomplete="off">

                                </td>
                                <td class="hidden-xs">
                                    SMA
                                </td>
                                <td>
                                    <a href="#idSMAIndicator_param" id="idSMAIndicator_edit" class="btn default btn-xs blue"
                                       data-toggle="modal">
                                        <i class="fa fa-edit"></i>
                                    </a>
                                </td>

                            </tr>
                            <tr>
                                <td class="highlight">

                                    <input type="checkbox" checked id="idStochasticIndicatorChart" overlay="false" class="make-switch"
                                           data-size="mini" autocomplete="off">

                                </td>
                                <td class="hidden-xs">
                                    Stochastic
                                </td>
                                <td>
                                    <a href="#a" class="btn default btn-xs blue">
                                        <i class="fa fa-edit"></i>
                                    </a>
                                </td>

                            </tr>
                            <tr>
                                <td class="highlight">

                                    <input type="checkbox" id="idTRIXIndicatorChart" overlay="false" class="make-switch"
                                           data-size="mini" autocomplete="off">

                                </td>
                                <td class="hidden-xs">
                                    TRIX
                                </td>
                                <td>
                                    <a href="#a" class="btn default btn-xs blue">
                                        <i class="fa fa-edit"></i>
                                    </a>
                                </td>

                            </tr>
                            <tr>
                                <td class="highlight">

                                    <input type="checkbox" checked id="idVolumeIndicatorChart" overlay="false" class="make-switch"
                                           data-size="mini" autocomplete="off">

                                </td>
                                <td class="hidden-xs">
                                    Volume
                                </td>
                                <td>
                                    <a href="#a" class="btn default btn-xs blue">
                                        <i class="fa fa-edit"></i>
                                    </a>
                                </td>

                            </tr>
                            <tr>
                                <td class="highlight">

                                    <input type="checkbox" id="idVolumeMAIndicatorChart" overlay="false" class="make-switch"
                                           data-size="mini" autocomplete="off">

                                </td>
                                <td class="hidden-xs">
                                    Volume + MA
                                </td>
                                <td>
                                    <a href="#a" class="btn default btn-xs blue">
                                        <i class="fa fa-edit"></i>
                                    </a>
                                </td>

                            </tr>
                            <tr>
                                <td class="highlight">

                                    <input type="checkbox" id="idWilliamsRIndicatorChart" overlay="false" class="make-switch"
                                           data-size="mini" autocomplete="off" data-on="success" data-off="danger">

                                </td>
                                <td class="hidden-xs">
                                    Williams %R
                                </td>
                                <td>
                                    <a href="#a" class="btn default btn-xs blue">
                                        <i class="fa fa-edit"></i>
                                    </a>
                                </td>

                            </tr>
                            </tbody>
                        </table>
                    </div>
                </div>

                </div>
                </div>
            </div>
            <!-- END Portlet PORTLET-->
        </div>
    </div>
<div class="clearfix"></div>

    <div class="row">
        <div class="col-md-12">
            <!-- BEGIN Portlet PORTLET-->
            <div class="portlet light bordered">
                <div class="portlet-title">
                    <div class="caption">
                        <i class="icon-graph font-yellow-casablanca"></i>
								<span class="caption-subject bold font-yellow-casablanca uppercase">
								Flash Technical Chart </span>
                        <span class="caption-helper">User friendly technical chart ( flash required )</span>
                    </div>
                    <div class="tools">
                        <a href="" class="collapse">
                        </a>

                        </a>
                        <a href="" class="reload">
                        </a>
                        <a href="" class="remove">
                        </a>
                    </div>

                </div>
                <div class="portlet-body">
                <div class="row">
                    <div class="col-md-10">
                        <div class="btn-group">
                            <button type="button" class="btn btn-default"><i class="fa  fa-signal"></i></button>
                            <button type="button" class="btn btn-default"><i class="fa fa-cogs"></i> </button>
                            <button type="button" class="btn btn-default"><i class="fa fa-bullhorn"></i> </button>
                            <div class="btn-group">
                                <button type="button" class="btn btn-default dropdown-toggle" data-toggle="dropdown">
                                    <i class="fa fa-ellipsis-horizontal"></i> More <i class="fa fa-angle-down"></i>
                                </button>
                                <ul class="dropdown-menu">
                                    <li>
                                        <a href="#">
                                            Dropdown link
                                        </a>
                                    </li>
                                    <li>
                                        <a href="#">
                                            Dropdown link
                                        </a>
                                    </li>
                                </ul>
                            </div>
                        </div>
                        <div class="btn-group btn-group btn-group-solid">
                            <button type="button" class="btn red"><i class="fa  fa-signal"></i></button>
                            <button type="button" class="btn green"><i class="fa  fa-cogs"></i></button>
                            <button type="button" class="btn blue"><i class="fa  fa-bullhorn"></i></button>
                        </div>

                        <div id="chartContainer"><!-- Chart Container --></div>
                    </div>
                    <div class="col-md-2">
                        <div>
                            <!-- <input class="form-control" id="plugins4_q"  type="text">-->
                            <div class="form-group">
                                <?php echo $this->
                                StockBangladesh->getInstrumentSelect2Html($instrumentList,'shareList'); ?>

                            </div>
                        </div>

                        <div id="html1">
                            <?php echo $this->StockBangladesh->getInstrumentTreeHtml($instrumentList,'fa fa-list icon-success','fa fa-sign-in icon-warning'); ?>
                        </div>

                    </div>

                </div>
                </div>
            </div>
            <!-- END Portlet PORTLET-->
        </div>
    </div>




</div>


<!--/////////////////////////////////////////////////////////////////////////////////-->



<?php
/**
WRITE SCRIPT TO ADD AT THE END OF DEFAULT LAYOUT WHERE $this->fetch('view_script'); IS CALLED
*/

$this->start('script_inside_doc_ready');
?>

        //FormComponents.init();
        //UIExtendedModals.init();
        Custom.init();
        // Index.init();

       // UITree.init();

        /*  $('.colorpicker-default').colorpicker({
         format: 'hex'
         });
         $('.colorpicker-rgba').colorpicker();*/

        $("#touchspin_demo1").TouchSpin({
            buttondown_class: 'btn green',
            buttonup_class: 'btn green',
            min: -1000000000,
            max: 1000000000,
            stepinterval: 50,
            maxboostedstep: 10000000,
            prefix: '$'
        });

        $("#touchspin_demo2").TouchSpin({
            buttondown_class: 'btn blue',
            buttonup_class: 'btn blue',
            min: 0,
            max: 100,
            step: 0.1,
            decimals: 2,
            boostat: 5,
            maxboostedstep: 10,
            postfix: '%'
        });

        $("#touchspin_demo3").TouchSpin({
            buttondown_class: 'btn green',
            buttonup_class: 'btn green',
            prefix: "$",
            postfix: "%"
        });
        //$("#smaPeriod").TouchSpin({ });
        // $('#html1').jstree();
        $("#html1").jstree({
            "core": {
                "themes": {
                    "responsive": false
                },
                // so that create works
                "check_callback": true
            },
            "search": { "show_only_matches": true, "fuzzy": false},
            "plugins": [ "contextmenu", "dnd", "state", "types", "search" ]
        });
        var to = false;
        $('#plugins4_q').keyup(function () {
            if (to) {
                clearTimeout(to);
            }
            to = setTimeout(function () {
                var v = $('#plugins4_q').val();
                $('#html1').jstree(true).search(v);
            }, 250);
        });
        $('#html1')
            // listen for event
                .on('changed.jstree', function (e, data) {
                    //alert(data.instance.get_node(data.selected[0]).text);
                    updateChart(data.instance.get_node(data.selected[0]).text);
                })


        //Index.initCalendar(); // init index page's custom scripts
        $('.page-sidebar .ajaxify.start').click() // load the content for the dashboard page.
        // $.fn.editable.defaults.mode = 'inline';


        /*    $('#idADLIndicatorChart').on('switchChange', function (e, data) {
         setIndicator(false,'idADLIndicatorChart');

         }); */

        $('.make-switch').on('switchChange.bootstrapSwitch', function (e, data) {
            if ($(this).attr("overlay") == 'true') {
                overlay = true;
            }
            else {
                overlay = false;
            }

            setIndicator(overlay, $(this).attr("id"));


            // alert($(this).attr("id"));
        });

        $('#shareList').select2({
            placeholder: "Select a Share",
            allowClear: true
        });

        $("#shareList")
            //.on("change", function(e) { alert("change "+JSON.stringify({val:e.val, added:e.added, removed:e.removed})); })
                .on("change", function () {
                    //alert("Selected value is: "+$("#shareList").select2("val"));
                    updateChart($("#shareList").select2("val"));
                })

        // switching portlet style
        $('body').on('shown.bs.tab', function (e) {
            var target_loc = $(e.target).attr("href"); // activated tab

            if(target_loc=='#portlet_tab3')
            {
                $("#chart_portlet").removeClass("box");
                $("#chart_portlet").addClass("solid");
            }else
            {
                $("#chart_portlet").removeClass("solid");
                $("#chart_portlet").addClass("box");
            }
        });

$('#portlet_tab2_anim').click(function(){
Custom.startAnim('bounce');
});


<?php $this->end(); ?>


<?php $this->start('script_at_page_end'); ?>

<script type="text/javascript" language="javascript">
    // Creating new chart object.
    /*var chart = new AnyChartStock("<?php echo Router::url('/', true);?>assets/swf/AnyChartStock.swf?v=1.0.0r7416", "<?php echo Router::url('/', true);?>assets/swf/Preloader.swf?v=1.0.0r7416");*/
    var chart = new AnyChartStock("<?php echo Router::url('/', true);?>swf/AnyChartStock.swf?v=1.0.0r7416", "<?php echo Router::url('/', true);?>swf/Preloader.swf?v=1.0.0r7416");
    // Setting XML config file.
    chart.needConfig = true;
    Indicator.init();
    chart.setXMLFile("<?php echo Router::url('/', true);?>config.xml");
    // Writing the flash object into the page DOM.
    chart.write("chartContainer");

    function updateChart(code) {

        var url = "<?php echo Router::url(array('controller'=>'TechnicalAnalysis','action'=>'chart_data'));?>/" + code;
        // Setting new data source address
        chart.objectModel.data.dataSets[0].sourceUrl = url;
        // Changing chart title
        chart.objectModel.settings.labels[0].format = code + ": Historical Prices";
        // Changing series title
        chart.getSeriesById("idMainChart", "idMainSeries").name = code;
        // Applying all changes made to the object model
        chart.applyConfigChanges();
    }

    function setIndicator(idMainChart, indi) {

        //alert('here');
        if (idMainChart) {
            currentIndicatorObject = chart.getTechIndicatorById("idMainChart", indi); // get link to SMA

        } else {
            currentIndicatorObject = chart.getChartById(indi);
        }
        currentIndicatorObject.enabled = document.getElementById(indi).checked;
        chart.applySettingsChanges();

        if (document.getElementById(indi).checked)
            $("#" + indi + "_edit").removeAttr("disabled");
        else
            $("#" + indi + "_edit").attr("disabled", "disabled");

    }


</script>


<?php $this->end(); ?>