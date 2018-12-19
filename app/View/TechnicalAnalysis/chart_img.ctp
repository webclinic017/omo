<?php
$activeMenuId='active_'.$this->params['controller'].'_'.$this->params['action'];
/**
IT WILL BE ADDED WHERE echo $this->fetch('css') IS CALLED IN DEFAULT LAYOUT.
*/
echo $this->element('css_element/all');

/**
ADDING DIRECTLY A CSS FROM VIEW TO DEFAULT LAYOUT CSS BLOCK. NO ECHO NEEDED. INLINE FALSE MUST BE SET.
EXAMPLE : $this->Html->css('assets/css/style-metronic', null, array('inline' => false));
*/
$this->Html->css('assets/plugins/jstree/dist/themes/default/style.min', null, array('inline' => false));
$this->Html->css('assets/plugins/bootstrap-colorpicker/css/colorpicker', null, array('inline' => false));
$this->Html->css('assets/plugins/bootstrap-switch3/css/bootstrap-switch.min', null, array('inline' => false));
$this->Html->css('assets/plugins/bootstrap-select/bootstrap-select.min', null, array('inline' => false));
$this->Html->css('assets/plugins/bootstrap-editable/bootstrap-editable/css/bootstrap-editable', null, array('inline' => false));
$this->Html->css('assets/plugins/bootstrap-editable/inputs-ext/address/address', null, array('inline' => false));
$this->Html->css('assets/plugins/select2/select2', null, array('inline' => false));
$this->Html->css('assets/plugins/select2/select2-metronic', null, array('inline' => false));
$this->Html->css('assets/plugins/jquery-multi-select/css/multi-select', null, array('inline' => false));
$this->Html->css('assets/css/animate', null, array('inline' => false));
$this->Html->css('assets/plugins/bootstrap-daterangepicker/daterangepicker-bs3', null, array('inline' => false));

?>

<!-- TODO: ITS ALWAYS ADDING MENUE TO THE TOP.ITS WORKING LIKE PREPEND BUT APPEND IS NOT WORKING. FIND OUT A SOLUTION -->

<?php
echo $this->element('layout_element/side_bar2');
?>

<div class="clearfix"></div>

<!-- BEGIN PAGE HEADER-->
<div class="row">
    <!-- BEGIN PAGE TITLE & BREADCRUMB-->
    <div class="col-md-12">
        <ul class="page-breadcrumb breadcrumb">
            <!-- <li class="btn-group">
                 <button type="button" class="btn green">
                     <i class="fa fa-calendar"></i><span><?php echo $this->Time->nice($lastTradeInfo['IndexValue'][0]['date_time']);?></span>
                 </button>
             </li>-->
            <li>
                <i class="fa fa-home"></i>
                <?php  echo $this->Html->link(__('Home'),'/'); ?>
                <i class="fa fa-angle-right"></i>
            </li>
            <li><?php  echo $this->Html->link(__('Dashboard'),'/markets/home'); ?></li>

        </ul>
        <!-- END PAGE TITLE & BREADCRUMB-->
    </div>
</div>

<div class="row">
<div class="col-md-12">
<div class="portlet box grey tabbable " id="chart_portlet">
<div class="portlet-title">
    <div class="tools">
        <a href="index_chart" data-toggle="modal" class="feedback"></a>
    </div>
</div>
<div class="portlet-body">
<div class="row">
<div class="col-md-12">


<div class="tabbable portlet-tabs">
<ul class="nav nav-tabs" style="margin-left: 5px;">
    <li class="active" style="float:left;">
        <a href="#portlet_tab3" data-toggle="tab">
            Chart
        </a>
    </li>
    <li style="float:left;">
        <!--<a href="#portlet_tab2" data-toggle="tab" id="portlet_tab2_anim">-->
        <a href="#portlet_tab2" data-toggle="tab" id="portlet_tab2_anim"
           data-error-display="toastr"
           data-url="<?php echo Router::url(array('controller'=>'TechnicalAnalysis','action'=>'company_details'));?>">
            Company details
        </a>
    </li>
    <li style="float:left;">
        <a href="#portlet_tab1" data-toggle="tab">
            Fundamental
        </a>
    </li>
</ul>
<div class="tab-content">
    <div class="tab-pane" id="portlet_tab1">
        Fundamental
    </div>
    <div class="tab-pane" id="portlet_tab2">
        <p>
            Lorem ipsum dolor sit amet, consetetur sadipscing elitr, sed diam nonumy eirmod
            tempor invidunt ut labore et dolore magna aliquyam erat, sed diam voluptua. At
            vero eos et accusam et justo duo dolores et ea rebum. Stet clita kasd gubergren,
            no sea takimata sanctus est Lorem ipsum dolor sit amet. Lorem ipsum dolor sit
            amet, consetetur sadipscing elitr, sed diam nonumy eirmod tempor invidunt ut
            labore et dolore magna aliquyam erat, sed diam voluptua. At vero eos et accusam
            et justo.
        </p>
                                    <span id="animationSandbox" style="display: block;"><h1 class="site__title mega">
                                        Animate.css</h1></span>
    </div>
    <div class="tab-pane active" id="portlet_tab3">
        <div class="col-md-10">
            <div id="chartContaixcner"><img id="ChartImage" align="top" border="0" class="img-responsive"></div>
        </div>
        <div class="col-md-2">
            <div class="row">

                <form id="Form1" action="javascript:updateChart()">
                    <div class="form-group">
                        <div id="reportrange" class="btn default">
                            <i class="fa fa-calendar"></i>
                            &nbsp;
												<span>
												</span>
                            <b class="fa fa-angle-down"></b>
                        </div>
                    </div>

                    <div class="form-group">
                        <?php echo $this->
                        StockBangladesh->getInstrumentSelect2Html($instrumentList,'shareList');
                        ?>

                    </div>
                    <div class="form-group">
                        <?php echo $this->
                        StockBangladesh->getInstrumentBootstrapSelect($instrumentList,'comparewith');
                        ?>

                    </div>

                    <div class="form-group">
                        <select id="Indicators" class="bs-select form-control" multiple data-selected-text-format="count" title='Choose indicators' data-live-search="true">
                            <option value="None">None</option>
                            <option value="AccDist">Accu/Dist</option>
                            <option value="AroonOsc">Aroon Oscillator</option>
                            <option value="Aroon">Aroon Up/Down</option>
                            <option value="ADX">Avg Directional Index</option>
                            <option value="ATR">Avg True Range</option>
                            <option value="BBW">Bollinger Band Width</option>
                            <option value="CMF">Chaikin Money Flow</option>
                            <option value="COscillator">Chaikin Oscillator</option>
                            <option value="CVolatility">Chaikin Volatility</option>
                            <option value="CLV">Close Location Value</option>
                            <option value="CCI">CCI</option>
                            <option value="DPO">Detrended Price Osc</option>
                            <option value="DCW">Donchian Channel</option>
                            <option value="EMV">Ease of Movement</option>
                            <option value="FStoch">Fast Stochastic</option>
                            <option value="MACD">MACD</option>
                            <option value="MDX">Mass Index</option>
                            <option value="Momentum">Momentum</option>
                            <option value="MFI">Money Flow Index</option>
                            <option value="NVI">Neg Volume Index</option>
                            <option value="OBV">On Balance Volume</option>
                            <option value="Performance">Performance</option>
                            <option value="PPO">% Price Oscillator</option>
                            <option value="PVO">% Volume Oscillator</option>
                            <option value="PVI">Pos Volume Index</option>
                            <option value="PVT">Price Volume Trend</option>
                            <option value="ROC">Rate of Change</option>
                            <option value="RSI" selected="">RSI</option>
                            <option value="SStoch">Slow Stochastic</option>
                            <option value="StochRSI">StochRSI</option>
                            <option value="TRIX">TRIX</option>
                            <option value="UO">Ultimate Oscillator</option>
                            <option value="Vol">Volume</option>
                            <option value="WilliamR">William's %R</option>
                        </select>
                    </div>

                    <div class="form-group">
                        <select id="configure" class="bs-select form-control" multiple>
                            <option>Show volume bar</option>
                            <option>Parabolic SAR</option>
                            <option>Log Scale</option>
                            <option>Percentage Scale</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <select id="charttype" class="bs-select form-control">
                            <option value="CandleStick" selected="">CandleStick</option>
                            <option value="Close">Closing Price</option>
                            <option value="Median">Median Price</option>
                            <option value="OHLC">OHLC</option>
                            <option value="TP">Typical Price</option>
                            <option value="WC">Weighted Close</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <select id="overlay" class="bs-select form-control">
                            <option value="BB" selected="">Bollinger Band</option>
                            <option value="DC">Donchian Channel</option>
                            <option value="Envelop">Envelop (SMA 20 +/- 10%)</option>
                        </select>
                    </div>

                    <div class="panel panel-success">
                        <div class="panel-heading">
                            <h3 class="panel-title">Moving Avg 1</h3>
                        </div>
                        <div class="panel-body">
                            <div class="form-group">
                                <select id="mov1" class="bs-select form-control">
                                    <option value="SMA" selected="">Simple</option>
                                    <option value="EMA">Exponential</option>
                                    <option value="TMA">Triangular</option>
                                    <option value="WMA">Weighted</option>
                                </select>
                            </div>
                            <div class="form-group">
                                <input id="touchspin_demo1" type="text" value="55" name="demo1" class="form-control">
                            </div>
                        </div>
                    </div>

                    <div class="panel panel-success">
                        <div class="panel-heading">
                            <h3 class="panel-title">Moving avg2</h3>
                        </div>
                        <div class="panel-body">
                            <div class="form-group">
                                <select id="mov2" class="bs-select form-control">
                                    <option value="SMA" selected="">Simple</option>
                                    <option value="EMA">Exponential</option>
                                    <option value="TMA">Triangular</option>
                                    <option value="WMA">Weighted</option>
                                </select>
                            </div>
                            <div class="form-group">
                                <input id="touchspin_demo2" type="text" value="55" name="demo1" class="form-control">
                            </div>
                        </div>
                    </div>
                    <div>
                       <button id="Button1" name="Button1" type="submit" class="btn blue btn-block"><i class="fa fa-check"></i>
                            Update Chart
                        </button>

                    </div>

                </form>


            </div>


            <!--                                        <div class="tabbable-custom nav-justified">
                                                        <ul class="nav nav-tabs nav-justified">
                                                            <li class="active"><a href="#tab_1_1_1" data-toggle="tab">Scrips</a></li>
                                                            <li><a href="#tab_1_1_2" data-toggle="tab">Settings</a></li>
                                                        </ul>
                                                        <div class="tab-content">
                                                            <div class="tab-pane active" id="tab_1_1_1">

                                                                <div id="html1">
                                                                    <?php echo $this->StockBangladesh->getInstrumentTreeHtml($instrumentList,'fa fa-list icon-success','fa fa-sign-in icon-warning'); ?>
                                                                </div>
                                                            </div>
                                                            <div class="tab-pane" id="tab_1_1_2">
                                                                <div class="form-group ">
                                                                    &lt;!&ndash;<label class="control-label col-md-3">Advance Date Ranges</label>&ndash;&gt;
                                                        <div class="col-md-12">
                                                            <div id="reportrange" class="btn default">
                                                                <i class="fa fa-calendar"></i>
                                                                &nbsp;
												<span>
												</span>
                                                                <b class="fa fa-angle-down"></b>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>-->


        </div>
    </div>
</div>
</div>


</div>
</div>
</div>
</div>


</div>
</div>

</div>


<!--/////////////////////////////////////////////////////////////////////////////////-->


<?php
/**
IT WILL BE ADDED WHERE echo $this->fetch('scipt') IS CALLED IN DEFAULT LAYOUT.
*/

echo $this->element('script_element/all');

/**
ADDING DIRECTLY PAGE LEVEL SCRIPT FROM VIEW TO DEFAULT LAYOUT SCRIPT BLOCK. NO ECHO NEEDED. INLINE FALSE MUST BE SET.
EXAMPLE: $this->Html->script('assets/scripts/portlet-draggable.js',array('inline' => false));
*/

$this->Html->script('assets/plugins/jstree/dist/jstree.min.js',array('inline' => false));
$this->Html->script('assets/plugins/bootstrap-touchspin/bootstrap.touchspin.js',array('inline' => false));
$this->Html->script('assets/plugins/fuelux/js/spinner.min.js',array('inline' => false));
$this->Html->script('assets/plugins/bootstrap-colorpicker/js/bootstrap-colorpicker.js',array('inline' => false));
$this->Html->script('assets/scripts/custom/ui-tree.js',array('inline' => false));
$this->Html->script('assets/scripts/custom/portlet-draggable.js',array('inline' => false));
$this->Html->script('assets/plugins/bootstrap-switch3/js/bootstrap-switch.min.js',array('inline' => false));
$this->Html->script('assets/plugins/bootstrap-select/bootstrap-select.min.js',array('inline' => false));
$this->Html->script('assets/plugins/bootstrap-editable/bootstrap-editable/js/bootstrap-editable.min.js',array('inline' => false));
$this->Html->script('assets/plugins/bootstrap-editable/inputs-ext/address/address.js',array('inline' => false));
$this->Html->script('assets/plugins/jquery-multi-select/js/jquery.multi-select.js',array('inline' => false));
$this->Html->script('assets/plugins/bootstrap-daterangepicker/moment.min.js',array('inline' => false));
$this->Html->script('assets/plugins/bootstrap-daterangepicker/daterangepicker.js',array('inline' => false));

?>

<?php
/**
WRITE SCRIPT TO ADD AT THE END OF DEFAULT LAYOUT WHERE $this->fetch('view_script'); IS CALLED
*/

$this->start('view_script');
?>
<script>
    jQuery(document).ready(function () {
        App.init();
        //FormComponents.init();
        //UIExtendedModals.init();
        Custom.init();
        // Index.init();
        //PortletDraggable.init();
        UITree.init();

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
            maxboostedstep: 10000000

        });

        $("#touchspin_demo2").TouchSpin({
            buttondown_class: 'btn blue',
            buttonup_class: 'btn blue',
            min: 0,
            max: 100,
            step: 0.1,
            decimals: 2,
            boostat: 5,
            maxboostedstep: 10

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

        $('.make-switch').on('switchChange', function (e, data) {
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

        $('#shareList2').select2({
            placeholder: "Compare with",
            allowClear: true
        });

        $("#shareList")
            //.on("change", function(e) { alert("change "+JSON.stringify({val:e.val, added:e.added, removed:e.removed})); })
                .on("change", function () {
                    //alert("Selected value is: "+$("#shareList").select2("val"));
                    updateChart($("#shareList").select2("val"));
                })




        $('.bs-select').selectpicker({
            iconBase: 'fa',
            tickIcon: 'fa-check'
        });

        $('#indicator').selectpicker({
            selectAllValue: 'multiselect-all',
            enableCaseInsensitiveFiltering: true,
            enableFiltering: true,
            maxHeight: '300',
            buttonWidth: '235',
            onChange: function(element, checked) {
                var brands = $('#indicator option:selected');
                var selected = [];
                $(brands).each(function(index, brand){
                    selected.push([$(this).val()]);
                });

                console.log(selected);
            }
        });

    })

</script>

<script>


    // switching portlet style
    var chartRange;
    $('#reportrange').daterangepicker({
                opens: (App.isRTL() ? 'left' : 'right'),
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
                    'Last 7 Days': [moment().subtract('days', 6), moment()],
                    'Last 30 Days': [moment().subtract('days', 29), moment()],
                    'This Month': [moment().startOf('month'), moment().endOf('month')],
                    'Last Month': [moment().subtract('month', 1).startOf('month'), moment().subtract('month', 1).endOf('month')],
                    '6 months': [moment().subtract('month', 6), moment()],
                    '1 year': [moment().subtract('year', 1), moment()],
                    '2 year': [moment().subtract('year', 2), moment()],
                    '3 year': [moment().subtract('year', 3), moment()],
                    '4 year': [moment().subtract('year', 4), moment()],
                    '5 year': [moment().subtract('year', 5), moment()],
                    '6 year': [moment().subtract('year', 6), moment()],
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

            }
    );
    $('#reportrange span').html(moment().subtract('days', 29).format('MMM, YY') + ' - ' + moment().format('MMM, YY'));
    chartRange=moment().subtract('days', 29).format('YYYY-MM-DD') + '|' + moment().format('YYYY-MM-DD');

    function getObject(id) {
        //alert($('#Indicators').val());


        if (document.getElementById)
        //IE 5.x or NS 6.x or above
            return document.getElementById(id);
        else if (document.all)
        //IE 4.x
            return document.all[id];
        else
        //Netscape 4.x
            return document[id];
    }

    function updateChart() {
        //
        //we encode the values of all form elements as query parameters
        //
        //var elements = getObject("Form1").elements;
        var url = "chart_img_data/";
       /* for (var i = 0; i < elements.length; ++i) {
            var e = elements[i];
            if (e.type == "checkbox")
                url = url + e.id + "=" + (e.checked ? "1" : "0") + "&";
            else
                url = url + e.id + "=" + escape(e.value) + "&";
        }*/

      //  alert($('#shareList').val());
       // alert($('#Indicators').val());
       // alert($('#overlay').val());
        url = url +chartRange+ "/"+$('#shareList').val()+ "/"+$('#comparewith').val()+ "/"+$('#Indicators').val()+ "/"+$('#configure').val()+ "/"+$('#charttype').val()+ "/"+$('#overlay').val()+ "/"+$('#mov1').val()+ "/"+$('#mov2').val();


        //Now we update the URL of the image to update the chart
        getObject("ChartImage").src = url;
    }


    $(document).ready(function () {
        $('#portlet_tab2_anim').click(function () {
            //var anim = $('.js--animations').val();
            //alert('hy');
            Custom.startAnim('bounce');
        });


    });

</script>

<?php $this->end(); ?>

