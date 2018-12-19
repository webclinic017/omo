    <div class="clearfix"></div>

    <div class="row">
        <div class="col-md-12">
            <!-- BEGIN Portlet PORTLET-->
            <div class="portlet light bordered">
                <div class="portlet-title">
                    <div class="caption">
                        <i class="icon-graph font-yellow-casablanca"></i>
								<span class="caption-subject bold font-yellow-casablanca uppercase">
								Advance TA Chart </span>
                        <span class="caption-helper">Heavily customizable chart</span>
                    </div>
                    <div class="tools">
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
                    <div id="tv_chart_container"></div>

                </div>
                </div>
            </div>
            <!-- END Portlet PORTLET-->
        </div>
    </div>






<!--/////////////////////////////////////////////////////////////////////////////////-->



<?php
$this->start('script_inside_doc_ready');
?>
    TradingView.onready(function()
    {
    var widget = new TradingView.widget({
    width: '100%',
    height: '500px',
    symbol: 'DSEX',
    interval: 'D',
    toolbar_bg: '#f4f7f9',
    allow_symbol_change: true,
    container_id: "tv_chart_container",
    //	BEWARE: no trailing slash is expected in feed URL
    datafeed: new Datafeeds.UDFCompatibleDatafeed("http://localhost/omo/TechnicalAnalysis"),
    library_path: "/assets/tradingview/charting_library/",
    locale: "en",

    //	Regression Trend-related functionality is not implemented yet, so it's hidden for a while
    disabled_drawings: ["Regression Trend"]
    });

    widget.onChartReady(function() {

    });
    })

<?php $this->end(); ?>


<?php $this->start('script_at_page_end'); ?>

<?php $this->end(); ?>


    <script type="text/javascript">

        $(function () {



        });
    </script>