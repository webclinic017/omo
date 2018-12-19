<?php
//$this->Html->addCrumb('Market Home', '/markets');
$this->Html->addCrumb('Market Home', array('controller' => 'markets', 'action' => 'home'));
?>

<div class="row">
<div class="col-md-12">
<div class="portlet light bordered " id="chart_portlet">
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
        <a href="#portlet_tab2" data-toggle="tab" id="portlet_tab2_company"
           data-error-display="toastr"
           data-url="<?php echo Router::url(array('controller'=>'TechnicalAnalysis','action'=>'company_details'));?>/DESCO">
            Company details
        </a>
    </li>
    <li style="float:left;">
        <a href="#portlet_tab1" id="portlet_tab1_market_depth" data-toggle="tab"  data-url="<?php echo Router::url(array('controller'=>'TechnicalAnalysis','action'=>'market_depth'));?>/DESCO">
            Market Depth
        </a>

    </li>
</ul>
<div class="tab-content">
    <div class="tab-pane" id="portlet_tab1">


    </div>
    <div class="tab-pane" id="portlet_tab2">

    </div>
    <div class="tab-pane active" id="portlet_tab3">
        <div class="col-md-10">
            <div id="chartContainer" class="chartcontent"><?php echo $viewer->renderHTML()?></div>
            <div class="chart-loading">
                Loading...
            </div>
        </div>
        <div class="col-md-2">
            <div class="row">

                <form id="Form1">
                    <div class="form-group">
                        <div id="reportrange" class="btn default" data-range="2010-10-25|2013-04-25">
                            <i class="fa fa-calendar"></i>
                            &nbsp;
												<span>
												</span>
                            <b class="fa fa-angle-down"></b>
                        </div>
                    </div>

                    <div class="form-group">
                        <!--<select id="adj" class="bs-select form-control" data-style="btn-primary">-->
                            <select id="adj" class="bs-select form-control" data-style="btn-primary">
                            <option value="1" selected>Adjusted Data</option>
                            <option value="0" >Non Adjusted Data</option>
                        </select>
                    </div>



                    <div class="form-group">
                        <?php echo $this->
                        StockBangladesh->getInstrumentBootstrapSelect($instrumentList,'shareList');
                        ?>

                    </div>
                  <!--  <div class="form-group">
                        <?php /*echo $this->
                        StockBangladesh->getInstrumentBootstrapSelect($instrumentList,'comparewith');
                        */?>

                    </div>-->

                    <div class="form-group">
                        <select id="Indicators" class="bs-select form-control" multiple  title='Choose indicators' data-live-search="true">
                            <option value="None">None</option>
                            <option value="AccDist" title="A/D">Accu/Dist</option>
                            <option value="AroonOsc" title="ArnOsc">Aroon Oscillator</option>
                            <option value="Aroon" title="Aroon">Aroon Up/Down</option>
                            <option value="ADX" title="ADX">Avg Directional Index</option>
                            <option value="ATR" title="ATR">Avg True Range</option>
                            <option value="BBW" title="BBW">Bollinger Band Width</option>
                            <option value="CMF" title="CMF">Chaikin Money Flow</option>
                            <option value="COscillator" title="COsc">Chaikin Oscillator</option>
                            <option value="CVolatility" title="CVol">Chaikin Volatility</option>
                            <option value="CLV" title="CLV">Close Location Value</option>
                            <option value="CCI" title="CCI">CCI</option>
                            <option value="DPO" title="DPO">Detrended Price Osc</option>
                            <option value="DCW" title="DCW">Donchian Channel</option>
                            <option value="EMV" title="EMV">Ease of Movement</option>
                            <option value="FStoch" title="FStoch">Fast Stochastic</option>
                            <option value="MACD" title="MACD" selected="">MACD</option>
                            <option value="MDX" title="MDX">Mass Index</option>
                            <option value="Momentum" title="Momentum">Momentum</option>
                            <option value="MFI" title="MFI">Money Flow Index</option>
                            <option value="NVI" title="NVI">Neg Volume Index</option>
                            <option value="OBV" title="OBV">On Balance Volume</option>
                            <option value="Performance" title="Perfornamce">Performance</option>
                            <option value="PPO" title="PPO">% Price Oscillator</option>
                            <option value="PVO" title="PVO">% Volume Oscillator</option>
                            <option value="PVI" title="PVI">Pos Volume Index</option>
                            <option value="PVT" title="PVT">Price Volume Trend</option>
                            <option value="ROC" title="ROC">Rate of Change</option>
                            <option value="RSI" selected="" title="RSI">RSI</option>
                            <option value="SStoch" title="SStoch">Slow Stochastic</option>
                            <option value="StochRSI" title="StochRSI">StochRSI</option>
                            <option value="TRIX" title="TRIX">TRIX</option>
                            <option value="UO" title="UO">Ultimate Oscillator</option>
                            <option value="Vol" title="VOL">Volume</option>
                            <option value="WilliamR" title="WilliamR">William's %R</option>
                        </select>
                    </div>

                    <div class="form-group">
                        <select id="configure" class="bs-select form-control" multiple>
                            <option value="VOLBAR" title="VOLBAR" selected="">Show volume bar</option>
                            <option value="PSAR" title="PSAR">Parabolic SAR</option>
                            <option value="LOG" title="LOG">Log Scale</option>
                            <option value="PSCALE" title="PSCALE">Percentage Scale</option>
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
                    <div>
                        <button id="Button2" name="Button1" type="button" class="btn green btn-block"><i class="fa fa-signal"></i>
                            Update Chart
                        </button>

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
                                <input id="touchspin_demo1" type="text" value="13" name="demo1" class="form-control">
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
                                <input id="touchspin_demo2" type="text" value="19" name="demo1" class="form-control">
                            </div>
                        </div>
                    </div>
                    <div>
                       <button id="Button1" name="Button1" type="button" class="btn green btn-block"><i class="fa fa-check"></i>
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
WRITE SCRIPT TO ADD AT THE END OF DEFAULT LAYOUT WHERE $this->fetch('view_script'); IS CALLED
*/
$this->start('script_inside_doc_ready');
?>
Custom.init();
SbChart.init();
$("#touchspin_demo1").TouchSpin({
buttondown_class: 'btn blue',
buttonup_class: 'btn blue',
min: 1,
max: 300,
stepinterval: 1,
maxboostedstep: 10000000

});

$("#touchspin_demo2").TouchSpin({
buttondown_class: 'btn blue',
buttonup_class: 'btn blue',
min: 1,
max: 300,
stepinterval: 1,
maxboostedstep: 10000000

});

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

<?php $this->end(); ?>


<?php $this->start('script_at_page_end'); ?>

<script>


    // switching portlet style
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
                $('#reportrange').attr("data-range",chartRange);
            }
    );
    $('#reportrange span').html(moment().subtract('days', 120).format('MMM, YY') + ' - ' + moment().format('MMM, YY'));
    chartRange=moment().subtract('days', 120).format('YYYY-MM-DD') + '|' + moment().format('YYYY-MM-DD');
    $('#reportrange').attr("data-range",chartRange);


</script>

<?php $this->end(); ?>




