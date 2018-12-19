
<!-- Accunulation dristribution MODAL HERE STARTS -->

<div id="idADLIndicatorChart_param" class="modal fade" tabindex="-1" data-width="400">
<div class="modal-dialog">
    <div class="modal-content">
    <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-hidden="true"></button>
        <h4 class="modal-title">Accunulation dristribution</h4>
    </div>
    <div class="modal-body">
        <form action="#" class="form-horizontal form-bordered">
            <div class="form-body">
                <div class="form-group last">
                    <label class="control-label col-md-3">Color</label>

                    <div class="col-md-5">
                        <div class="input-group color colorpicker-default" data-color="#3865a8"
                             data-color-format="rgba">
                            <input type="text" class="form-control" value="#3865a8" id="idADLIndicatorChart_color">
															<span class="input-group-btn">
																<button class="btn default" type="button"><i
                                                                        style="background-color: #3865a8;"></i>&nbsp;
                                                                </button>
															</span>
                        </div>
                        <!-- /input-group -->
                    </div>
                </div>

            </div>

        </form>
    </div>

    <div class="modal-footer">
        <button type="button" data-dismiss="modal" class="btn btn-default">Close</button>
        <button id="idADLIndicator_update" class="btn blue">Update <i class="m-icon-swapright m-icon-white"></i></button>
        <script>
            $('.colorpicker-default').colorpicker({
                format: 'hex'
            });
        </script>
    </div>
</div>
</div>
</div>

<!--<div class="modal fade" id="idADLIndicatorChart_param" tabindex="-1" role="basic" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true"></button>
                <h4 class="modal-title">Modal Title</h4>
            </div>
            <div class="modal-body">
                Modal body goes here
            </div>
            <div class="modal-footer">
                <button type="button" class="btn default" data-dismiss="modal">Close</button>
                <button type="button" class="btn blue">Save changes</button>
            </div>
        </div>
        &lt;!&ndash; /.modal-content &ndash;&gt;
    </div>
    &lt;!&ndash; /.modal-dialog &ndash;&gt;
</div>-->
<!-- Accunulation dristribution MODAL HERE END -->

<!-- Adaptive Moving Average MODAL HERE STARTS -->
<!--
<div class="modal-dialog">
    <div class="modal-content">

    </div>
</div>
-->

<div id="idAMAIndicator_param" class="modal fade" tabindex="-1" data-width="400">


    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true"></button>
                <h4 class="modal-title">Adaptive Moving Average</h4>
            </div>
            <div class="modal-body">
                <form action="#" class="form-horizontal form-bordered">
                    <div class="form-group">
                        <label class="control-label col-md-4">Period</label>
                        <div class="col-md-5">
                            <div id="amaPeriodSpinner">
                                <div class="input-group input-small">
                                    <input id=amaPeriod type="text" class="spinner-input form-control" maxlength="3" >
                                    <div class="spinner-buttons input-group-btn btn-group-vertical">
                                        <button type="button" class="btn spinner-up btn-xs blue">
                                            <i class="fa fa-angle-up"></i>
                                        </button>
                                        <button type="button" class="btn spinner-down btn-xs blue">
                                            <i class="fa fa-angle-down"></i>
                                        </button>
                                    </div>
                                </div>
                            </div>

                        </div>
                    </div>
                    <div class="form-group">
                        <label class="control-label col-md-4">Fast Period</label>
                        <div class="col-md-5">
                            <div id="amaFastPeriodSpinner">
                                <div class="input-group input-small">
                                    <input id=amaFastPeriod type="text" class="spinner-input form-control" maxlength="3" >
                                    <div class="spinner-buttons input-group-btn btn-group-vertical">
                                        <button type="button" class="btn spinner-up btn-xs blue">
                                            <i class="fa fa-angle-up"></i>
                                        </button>
                                        <button type="button" class="btn spinner-down btn-xs blue">
                                            <i class="fa fa-angle-down"></i>
                                        </button>
                                    </div>
                                </div>
                            </div>

                        </div>
                    </div>
                    <div class="form-group">
                        <label class="control-label col-md-4">Slow Period</label>
                        <div class="col-md-5">
                            <div id="amaSlowPeriodSpinner">
                                <div class="input-group input-small">
                                    <input id=amaSlowPeriod type="text" class="spinner-input form-control" maxlength="3" >
                                    <div class="spinner-buttons input-group-btn btn-group-vertical">
                                        <button type="button" class="btn spinner-up btn-xs blue">
                                            <i class="fa fa-angle-up"></i>
                                        </button>
                                        <button type="button" class="btn spinner-down btn-xs blue">
                                            <i class="fa fa-angle-down"></i>
                                        </button>
                                    </div>
                                </div>
                            </div>

                        </div>
                    </div>
                    <div class="form-body">
                        <div class="form-group last">
                            <label class="control-label col-md-4">Color</label>

                            <div class="col-md-5">
                                <div class="input-group color colorpicker-default" data-color="#3865a8"
                                     data-color-format="rgba">
                                    <input type="text" class="form-control" value="#3865a8" id="idAMAIndicator_color">
															<span class="input-group-btn">
																<button class="btn default" type="button"><i
                                                                        style="background-color: #3865a8;"></i>&nbsp;
                                                                </button>
															</span>
                                </div>
                                <!-- /input-group -->
                            </div>
                        </div>

                    </div>
                </form>

            </div>
            <div class="modal-footer">
                <button type="button" data-dismiss="modal" class="btn btn-default">Close</button>
                <button id="idAMAIndicator_update" class="btn blue">Update <i class="m-icon-swapright m-icon-white"></i></button>
                <script>
                    $('#amaPeriodSpinner').spinner({value:10, step: 1, min: 0, max: 200});
                    $('#amaFastPeriodSpinner').spinner({value:2, step: 1, min: 0, max: 200});
                    $('#amaSlowPeriodSpinner').spinner({value:30, step: 1, min: 0, max: 200});
                    $('.colorpicker-default').colorpicker({
                        format: 'hex'
                    });
                </script>
            </div>

        </div>
    </div>



</div>
<!-- Adaptive Moving Average MODAL HERE ENDS -->
<!-- Aroon MODAL HERE STARTS -->
<div id="idAroonIndicatorChart_param" class="modal fade" tabindex="-1" data-width="400">

    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true"></button>
                <h4 class="modal-title">Adaptive Moving Average</h4>
            </div>
            <div class="modal-body">
                <form action="#" class="form-horizontal form-bordered">
                    <div class="form-group">
                        <label class="control-label col-md-4">Period</label>
                        <div class="col-md-5">
                            <div id="aroonPeriodSpinner">
                                <div class="input-group input-small">
                                    <input id=aroonPeriod type="text" class="spinner-input form-control" maxlength="3" >
                                    <div class="spinner-buttons input-group-btn btn-group-vertical">
                                        <button type="button" class="btn spinner-up btn-xs blue">
                                            <i class="fa fa-angle-up"></i>
                                        </button>
                                        <button type="button" class="btn spinner-down btn-xs blue">
                                            <i class="fa fa-angle-down"></i>
                                        </button>
                                    </div>
                                </div>
                            </div>

                        </div>
                    </div>


                    <div class="form-group last">
                        <label class="control-label col-md-4">Color</label>

                        <div class="col-md-5">
                            <div class="input-group color colorpicker-default" data-color="#3865a8"
                                 data-color-format="rgba">
                                <input type="text" class="form-control" value="#3865a8" id="idAroonIndicatorChart_color">
															<span class="input-group-btn">
																<button class="btn default" type="button"><i
                                                                        style="background-color: #3865a8;"></i>&nbsp;
                                                                </button>
															</span>
                            </div>
                            <!-- /input-group -->
                        </div>
                    </div>


                </form>

            </div>
            <div class="modal-footer">
                <button type="button" data-dismiss="modal" class="btn btn-default">Close</button>
                <button id="idAroonIndicatorChart_update" class="btn blue">Update <i class="m-icon-swapright m-icon-white"></i></button>
                <script>
                    $('#aroonPeriodSpinner').spinner({value:25, step: 1, min: 0, max: 200});

                    $('.colorpicker-default').colorpicker({
                        format: 'hex'
                    });
                </script>
            </div>
        </div>
    </div>

</div>
<!-- Aroon Moving Average MODAL HERE ENDS -->
<!-- Average True Range (ATR) MODAL HERE STARTS -->
<div id="idATRIndicatorChart_param" class="modal fade" tabindex="-1" data-width="400">

    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true"></button>
                <h4 class="modal-title">Average True Range (ATR)</h4>
            </div>
            <div class="modal-body">
                <form action="#" class="form-horizontal form-bordered">
                    <div class="form-group">
                        <label class="control-label col-md-4">Period</label>
                        <div class="col-md-5">
                            <div id="atrPeriodSpinner">
                                <div class="input-group input-small">
                                    <input id=atrPeriod type="text" class="spinner-input form-control" maxlength="3" >
                                    <div class="spinner-buttons input-group-btn btn-group-vertical">
                                        <button type="button" class="btn spinner-up btn-xs blue">
                                            <i class="fa fa-angle-up"></i>
                                        </button>
                                        <button type="button" class="btn spinner-down btn-xs blue">
                                            <i class="fa fa-angle-down"></i>
                                        </button>
                                    </div>
                                </div>
                            </div>

                        </div>
                    </div>


                    <div class="form-group last">
                        <label class="control-label col-md-4">Color</label>

                        <div class="col-md-5">
                            <div class="input-group color colorpicker-default" data-color="#3865a8"
                                 data-color-format="rgba">
                                <input type="text" class="form-control" value="#3865a8" id="idATRIndicatorChart_color">
															<span class="input-group-btn">
																<button class="btn default" type="button"><i
                                                                        style="background-color: #3865a8;"></i>&nbsp;
                                                                </button>
															</span>
                            </div>
                            <!-- /input-group -->
                        </div>
                    </div>


                </form>

            </div>
            <div class="modal-footer">
                <button type="button" data-dismiss="modal" class="btn btn-default">Close</button>
                <button id="idATRIndicatorChart_update" class="btn blue">Update <i class="m-icon-swapright m-icon-white"></i></button>
                <script>
                    $('#atrPeriodSpinner').spinner({value:20, step: 1, min: 0, max: 200});

                    $('.colorpicker-default').colorpicker({
                        format: 'hex'
                    });
                </script>
            </div>
        </div>
    </div>

</div>
<!-- Average True Range (ATR) MODAL HERE ENDS -->



<!-- Bollinger Bands MODAL HERE STARTS -->
<div id="idBBandsIndicator_param" class="modal fade" tabindex="-1" data-width="400">

    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true"></button>
                <h4 class="modal-title">Bollinger Bands (BBands)</h4>
            </div>
            <div class="modal-body">
                <form action="#" class="form-horizontal form-bordered">
                    <div class="form-body">
                        <div class="form-group">
                            <label class="control-label col-md-6">BBands Period</label>
                            <div class="col-md-5">
                                <div id="bBandsPeriodSpinner">
                                    <div class="input-group input-small">
                                        <input id=bBandsPeriod type="text" class="spinner-input form-control" maxlength="3" >
                                        <div class="spinner-buttons input-group-btn btn-group-vertical">
                                            <button type="button" class="btn spinner-up btn-xs blue">
                                                <i class="fa fa-angle-up"></i>
                                            </button>
                                            <button type="button" class="btn spinner-down btn-xs blue">
                                                <i class="fa fa-angle-down"></i>
                                            </button>
                                        </div>
                                    </div>
                                </div>

                            </div>
                        </div>
                        <div class="form-group">
                            <label class="control-label col-md-6">BBands Deviation</label>
                            <div class="col-md-5">
                                <div id="bBandsDeviationSpinner">
                                    <div class="input-group input-small">
                                        <input id=bBandsDeviation type="text" class="spinner-input form-control" maxlength="3" >
                                        <div class="spinner-buttons input-group-btn btn-group-vertical">
                                            <button type="button" class="btn spinner-up btn-xs blue">
                                                <i class="fa fa-angle-up"></i>
                                            </button>
                                            <button type="button" class="btn spinner-down btn-xs blue">
                                                <i class="fa fa-angle-down"></i>
                                            </button>
                                        </div>
                                    </div>
                                </div>

                            </div>
                        </div>
                    </div>
                </form>

            </div>
            <div class="modal-footer">
                <button type="button" data-dismiss="modal" class="btn btn-default">Close</button>
                <button id="idBBandsIndicator_update" class="btn blue">Update <i class="m-icon-swapright m-icon-white"></i></button>
                <script>
                    $('#bBandsPeriodSpinner').spinner({value:20, step: 1, min: 0, max: 200});
                    $('#bBandsDeviationSpinner').spinner({value:2.0, step: 0.1, min: 0, max: 20});

                </script>
            </div>
        </div>
    </div>

</div>
<!-- Bollinger Bands MODAL HERE ENDS -->



<!-- Bollinger Bands %B (BBands %B) MODAL HERE STARTS -->
<div id="idBBandsBIndicatorChart_param" class="modal fade" tabindex="-1" data-width="400">

    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true"></button>
                <h4 class="modal-title">Bollinger Bands %B (BBands %B)</h4>
            </div>
            <div class="modal-body">
                <form action="#" class="form-horizontal form-bordered">
                    <div class="form-body">
                        <div class="form-group">
                            <label class="control-label col-md-6">BBands Period</label>
                            <div class="col-md-5">
                                <div id="bBandsbPeriodSpinner">
                                    <div class="input-group input-small">
                                        <input id=bBandsbPeriod type="text" class="spinner-input form-control" maxlength="3" >
                                        <div class="spinner-buttons input-group-btn btn-group-vertical">
                                            <button type="button" class="btn spinner-up btn-xs blue">
                                                <i class="fa fa-angle-up"></i>
                                            </button>
                                            <button type="button" class="btn spinner-down btn-xs blue">
                                                <i class="fa fa-angle-down"></i>
                                            </button>
                                        </div>
                                    </div>
                                </div>

                            </div>
                        </div>
                        <div class="form-group">
                            <label class="control-label col-md-6">BBands Deviation</label>
                            <div class="col-md-5">
                                <div id="bBandsbDeviationSpinner">
                                    <div class="input-group input-small">
                                        <input id=bBandsbDeviation type="text" class="spinner-input form-control" maxlength="3" >
                                        <div class="spinner-buttons input-group-btn btn-group-vertical">
                                            <button type="button" class="btn spinner-up btn-xs blue">
                                                <i class="fa fa-angle-up"></i>
                                            </button>
                                            <button type="button" class="btn spinner-down btn-xs blue">
                                                <i class="fa fa-angle-down"></i>
                                            </button>
                                        </div>
                                    </div>
                                </div>

                            </div>
                        </div>
                    </div>
                </form>

            </div>
            <div class="modal-footer">
                <button type="button" data-dismiss="modal" class="btn btn-default">Close</button>
                <button id="idBBandsBIndicatorChart_update" class="btn blue">Update <i class="m-icon-swapright m-icon-white"></i></button>
                <script>
                    $('#bBandsbPeriodSpinner').spinner({value:20, step: 1, min: 0, max: 200});
                    $('#bBandsbDeviationSpinner').spinner({value:2.0, step: 0.1, min: 0, max: 20});

                </script>
            </div>
        </div>
    </div>

</div>
<!-- Bollinger Bands %B (BBands %B) MODAL HERE ENDS -->


<!-- Bollinger Bands Width MODAL HERE STARTS -->
<div id="idBBandsWidthIndicatorChart_param" class="modal fade" tabindex="-1" data-width="400">

    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true"></button>
                <h4 class="modal-title">Bollinger Bands Width</h4>
            </div>
            <div class="modal-body">
                <form action="#" class="form-horizontal form-bordered">
                    <div class="form-body">
                        <div class="form-group">
                            <label class="control-label col-md-6">BBands Period</label>
                            <div class="col-md-5">
                                <div id="bBandsWidthPeriodSpinner">
                                    <div class="input-group input-small">
                                        <input id=bBandsWidthPeriod type="text" class="spinner-input form-control" maxlength="3" >
                                        <div class="spinner-buttons input-group-btn btn-group-vertical">
                                            <button type="button" class="btn spinner-up btn-xs blue">
                                                <i class="fa fa-angle-up"></i>
                                            </button>
                                            <button type="button" class="btn spinner-down btn-xs blue">
                                                <i class="fa fa-angle-down"></i>
                                            </button>
                                        </div>
                                    </div>
                                </div>

                            </div>
                        </div>
                        <div class="form-group">
                            <label class="control-label col-md-6">BBands Deviation</label>
                            <div class="col-md-5">
                                <div id="bBandsWidthDeviationSpinner">
                                    <div class="input-group input-small">
                                        <input id=bBandsWidthDeviation type="text" class="spinner-input form-control" maxlength="3" >
                                        <div class="spinner-buttons input-group-btn btn-group-vertical">
                                            <button type="button" class="btn spinner-up btn-xs blue">
                                                <i class="fa fa-angle-up"></i>
                                            </button>
                                            <button type="button" class="btn spinner-down btn-xs blue">
                                                <i class="fa fa-angle-down"></i>
                                            </button>
                                        </div>
                                    </div>
                                </div>

                            </div>
                        </div>
                    </div>
                </form>

            </div>
            <div class="modal-footer">
                <button type="button" data-dismiss="modal" class="btn btn-default">Close</button>
                <button id="idBBandsWidthIndicatorChart_update" class="btn blue">Update <i class="m-icon-swapright m-icon-white"></i></button>
                <script>
                    $('#bBandsWidthPeriodSpinner').spinner({value:20, step: 1, min: 0, max: 200});
                    $('#bBandsWidthDeviationSpinner').spinner({value:2.0, step: 0.1, min: 0, max: 20});

                </script>
            </div>
        </div>
    </div>

</div>
<!-- Bollinger Bands Width MODAL HERE ENDS -->



<!-- Commodity Channel Index (CCI) MODAL HERE STARTS -->
<div id="idCCIIndicatorChart_param" class="modal fade" tabindex="-1" data-width="400">

    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true"></button>
                <h4 class="modal-title">Commodity Channel Index</h4>
            </div>
            <div class="modal-body">
                <form action="#" class="form-horizontal form-bordered">
                    <div class="form-body">
                        <div class="form-group">
                            <label class="control-label col-md-6">CCI Period</label>
                            <div class="col-md-5">
                                <div id="cciPeriodSpinner">
                                    <div class="input-group input-small">
                                        <input id=cciPeriod type="text" class="spinner-input form-control" maxlength="3" >
                                        <div class="spinner-buttons input-group-btn btn-group-vertical">
                                            <button type="button" class="btn spinner-up btn-xs blue">
                                                <i class="fa fa-angle-up"></i>
                                            </button>
                                            <button type="button" class="btn spinner-down btn-xs blue">
                                                <i class="fa fa-angle-down"></i>
                                            </button>
                                        </div>
                                    </div>
                                </div>

                            </div>
                        </div>
                        <div class="form-group last">
                            <label class="control-label col-md-6">Color</label>

                            <div class="col-md-5">
                                <div class="input-group color colorpicker-default" data-color="#3865a8"
                                     data-color-format="rgba">
                                    <input type="text" class="form-control" value="#3865a8" id="idCCIIndicatorChart_color">
															<span class="input-group-btn">
																<button class="btn default" type="button"><i
                                                                        style="background-color: #3865a8;"></i>&nbsp;
                                                                </button>
															</span>
                                </div>
                                <!-- /input-group -->
                            </div>
                        </div>
                    </div>
                </form>

            </div>
            <div class="modal-footer">
                <button type="button" data-dismiss="modal" class="btn btn-default">Close</button>
                <button id="idCCIIndicatorChart_update" class="btn blue">Update <i class="m-icon-swapright m-icon-white"></i></button>
                <script>
                    $('#cciPeriodSpinner').spinner({value:20, step: 1, min: 0, max: 200});
                </script>
            </div>
        </div>
    </div>

</div>
<!-- Commodity Channel Index (CCI) MODAL HERE ENDS -->


<!-- SMA MODAL HERE STARTS -->
<div id="idSMAIndicator_param" class="modal fade" tabindex="-1" data-width="400">

    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true"></button>
                <h4 class="modal-title">Simple Moving Average</h4>
            </div>
            <div class="modal-body">
                <form action="#" class="form-horizontal form-bordered">
                    <div class="form-body">
                        <!--                <div class="form-group">
                                            <label class="control-label col-md-3">Period</label>

                                            <div class="col-md-9">
                                                <div class="input-inline input-medium">
                                                    <input id="smaPeriod" type="text" value="20" name="demo1sma" class="form-control">
                                                </div>

                                            </div>
                                        </div>-->

                        <div class="form-group">
                            <label class="control-label col-md-3">Period</label>
                            <div class="col-md-5">
                                <div id="smaPeriodSpinner">
                                    <div class="input-group input-small">
                                        <input id=smaPeriod type="text" class="spinner-input form-control" maxlength="3" >
                                        <div class="spinner-buttons input-group-btn btn-group-vertical">
                                            <button type="button" class="btn spinner-up btn-xs blue">
                                                <i class="fa fa-angle-up"></i>
                                            </button>
                                            <button type="button" class="btn spinner-down btn-xs blue">
                                                <i class="fa fa-angle-down"></i>
                                            </button>
                                        </div>
                                    </div>
                                </div>

                            </div>
                        </div>

                        <div class="form-group last">
                            <label class="control-label col-md-3">Color</label>

                            <div class="col-md-5">
                                <div class="input-group color colorpicker-default" data-color="#3865a8"
                                     data-color-format="rgba">
                                    <input type="text" class="form-control" value="#3865a8" id="smaColor">
															<span class="input-group-btn">
																<button class="btn default" type="button"><i
                                                                        style="background-color: #3865a8;"></i>&nbsp;
                                                                </button>
															</span>
                                </div>
                                <!-- /input-group -->
                            </div>
                        </div>

                    </div>
                </form>

            </div>
            <div class="modal-footer">
                <button type="button" data-dismiss="modal" class="btn btn-default">Close</button>
                <button id="smaUpdate" class="btn blue">Update <i class="m-icon-swapright m-icon-white"></i></button>
                <script>
                    $('#smaPeriodSpinner').spinner({value:20, step: 1, min: 0, max: 200});
                    $('.colorpicker-default').colorpicker({
                        format: 'hex'
                    });
                </script>
            </div>
        </div>
    </div>

</div>
<!-- SMA MODAL HERE ENDS -->


