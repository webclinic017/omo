/**
 Custom module for you to write your own javascript functions
 **/
var Indicator = function () {

    // private functions & variables

    var myFunc = function (text) {
        alert(text);
    }

    var updateSMAIndicator = function () {
        $('.colorpicker-default').colorpicker({
            format: 'hex'
        });


        jQuery('body').on('click', '#idADLIndicator_update', function (e) {
            if (Indicator.configIdADLIndicator($("#idADLIndicatorChart_color").val()))
                chart.applySettingsChanges(); // If settinggs are valid - Apply changes.
        });


        $('#amaPeriodSpinner').spinner({value:10, step: 1, min: 0, max: 200});
        $('#amaFastPeriodSpinner').spinner({value:2, step: 1, min: 0, max: 200});
        $('#amaSlowPeriodSpinner').spinner({value:30, step: 1, min: 0, max: 200});
        jQuery('body').on('click', '#idAMAIndicator_update', function (e) {
            if (Indicator.configIdAMAIndicator($("#amaPeriod").val(),$("#amaFastPeriod").val(),$("#amaSlowPeriod").val(),$("#idAMAIndicator_color").val()))
                chart.applySettingsChanges(); // If settinggs are valid - Apply changes.
        });


        $('#aroonPeriodSpinner').spinner({value:25, step: 1, min: 0, max: 200});
        jQuery('body').on('click', '#idAroonIndicatorChart_update', function (e) {
            if (Indicator.configIdAroonIndicatorChart($("#aroonPeriod").val(),$("#idAroonIndicatorChart_color").val()))
                chart.applySettingsChanges(); // If settinggs are valid - Apply changes.
        });

        $('#atrPeriodSpinner').spinner({value:20, step: 1, min: 0, max: 200});
        jQuery('body').on('click', '#idATRIndicatorChart_update', function (e) {
            if (Indicator.configIdATRIndicatorChart($("#atrPeriod").val(),$("#idATRIndicatorChart_color").val()))
                chart.applySettingsChanges(); // If settinggs are valid - Apply changes.
        });

        $('#bBandsPeriodSpinner').spinner({value:20, step: 1, min: 0, max: 200});
        $('#bBandsDeviationSpinner').spinner({value:2, step: 0.1, min: 0, max: 20});
        jQuery('body').on('click', '#idBBandsIndicator_update', function (e) {
            if (Indicator.configBollingerBandsIndicator($("#bBandsPeriod").val(), $("#bBandsDeviation").val()))
                chart.applySettingsChanges(); // If settinggs are valid - apply changes.
        });

        $('#bBandsbPeriodSpinner').spinner({value:20, step: 1, min: 0, max: 200});
        $('#bBandsbDeviationSpinner').spinner({value:2, step: 0.1, min: 0, max: 20});
        jQuery('body').on('click', '#idBBandsBIndicatorChart_update', function (e) {
            if (Indicator.configBollingerBandsBIndicator($("#bBandsbPeriod").val(), $("#bBandsbDeviation").val()))
                chart.applySettingsChanges(); // If settinggs are valid - apply changes.
        });

        $('#bBandsWidthPeriodSpinner').spinner({value:20, step: 1, min: 0, max: 200});
        $('#bBandsWidthDeviationSpinner').spinner({value:2.0, step: 0.1, min: 0, max: 20});
        jQuery('body').on('click', '#idBBandsWidthIndicatorChart_update', function (e) {
            if (Indicator.configBollingerBandsWidthIndicator($("#bBandsWidthPeriod").val(), $("#bBandsWidthDeviation").val()))
                chart.applySettingsChanges(); // If settinggs are valid - apply changes.
        });


        $('#cciPeriodSpinner').spinner({value:20, step: 1, min: 0, max: 200});
        jQuery('body').on('click', '#idCCIIndicatorChart_update', function (e) {
            if (Indicator.configIdCCIIndicatorChart($("#cciPeriod").val(),$("#idCCIIndicatorChart_color").val()))
                chart.applySettingsChanges(); // If settinggs are valid - Apply changes.
        });





        //$("#smaPeriod").TouchSpin({ });
        $('#smaPeriodSpinner').spinner({value:20, step: 1, min: 0, max: 200});
        jQuery('body').on('click', '#smaUpdate', function (e) {
            if (Indicator.configSMA($("#smaPeriod").val(),$("#smaColor").val()))
                chart.applySettingsChanges(); // If settinggs are valid - Apply changes.
        });

        jQuery('body').on('click', '#updateAma', function (e) {
            if (Indicator.configSMA($("#smaPeriod").val()))
                chart.applySettingsChanges(); // If settinggs are valid - Apply changes.
        });




    }


    // public functions
    return {

        //main function
        init: function () {
            //initialize here something.
            updateSMAIndicator();
        },

        //some helper function
        doSomeStuff: function () {
            myFunc();
        },

        configSMA: function (period,smacolor) {
            if (isNaN(period)) return false; // if period is NaN - settings are invalid
            //if (isNaN(smacolor)) return false; // if period is NaN - settings are invalid
            // Get indicator object from chart objectModel.
            var smaIndicator = chart.getTechIndicatorById("idMainChart", "idSMAIndicator");
            // Setting new period value.
            smaIndicator.smaIndicator.period = period;
            // Changing series name to fit new period setting.
            smaIndicator.smaIndicator.series.name = "SMA(" + period + ")";
            smaIndicator.smaIndicator.series.color = smacolor;

            return true;
        },
        configIdADLIndicator: function (color) {
            var idADLIndicator = chart.getTechIndicatorById("idADLIndicatorChart", "idADLIndicator");

            //idADLIndicatorChart.adlIndicator.series.color = color;
            idADLIndicator.adlIndicator.series.color = color;
            return true;
        },
        configIdAMAIndicator: function (period,fastPeriod,slowPeriod,color) {
            if (isNaN(period) || isNaN(fastPeriod) || isNaN(slowPeriod)) return false; //Validation
            var idAMAIndicator = chart.getTechIndicatorById("idMainChart", "idAMAIndicator");

            //idADLIndicatorChart.adlIndicator.series.color = color;
            idAMAIndicator.amaIndicator.period = period;
            idAMAIndicator.amaIndicator.fast_period = fastPeriod;
            idAMAIndicator.amaIndicator.slow_period = slowPeriod;
            idAMAIndicator.amaIndicator.series.color = color;
            idAMAIndicator.amaIndicator.series.name = "AMA(" + period +","+ fastPeriod +","+ slowPeriod + ")";
            return true;
        },
        configIdAroonIndicatorChart: function (period,color) {
            if (isNaN(period)) return false; // if period is NaN - settings are invalid
            var idAroonIndicatorChart = chart.getTechIndicatorById("idAroonIndicatorChart", "idAroonIndicator");

            //idADLIndicatorChart.adlIndicator.series.color = color;
            idAroonIndicatorChart.aroonIndicator.period = period;
            idAroonIndicatorChart.aroonIndicator.upSeries.name = "Aroon(" + period  + ")";;
            //idAroonIndicatorChart.aroonIndicator.series.color = color;
            return true;
        },
        configIdATRIndicatorChart: function (period,color) {
            if (isNaN(period)) return false; // if period is NaN - settings are invalid
            var idATRIndicatorChart = chart.getTechIndicatorById("idATRIndicatorChart", "idATRIndicator");

            //idADLIndicatorChart.adlIndicator.series.color = color;
            idATRIndicatorChart.atrIndicator.period = period;
            idATRIndicatorChart.atrIndicator.series.color = color;
            idATRIndicatorChart.atrIndicator.series.name = "Average True Range (" + period  + ")";
            //idAroonIndicatorChart.aroonIndicator.series.color = color;
            return true;
        },
        configBollingerBandsIndicator: function (period, deviation) {
             if (isNaN(period) || isNaN(deviation)) return false; // Validation


            // Get indicator object from chart object model.
            var bBandsIndicator = chart.getTechIndicatorById("idMainChart", "idBBandsIndicator");

            // Setting new indicator parameters.
            bBandsIndicator.bbandsIndicator.period = period;
            bBandsIndicator.bbandsIndicator.deviation = deviation;

            // Change the name of upper series.
            bBandsIndicator.bbandsIndicator.upperSeries.name = "BBands(" + period + "," + deviation + ")";

            return true;
        },
        configBollingerBandsBIndicator: function (period, deviation) {
             if (isNaN(period) || isNaN(deviation)) return false; // Validation

            // Get indicator object from chart object model.
            var idBBandsBIndicatorChart = chart.getTechIndicatorById("idBBandsBIndicatorChart", "idBBandsBIndicator");

            // Setting new indicator parameters.
            idBBandsBIndicatorChart.bbandsBIndicator.period = period;
            idBBandsBIndicatorChart.bbandsBIndicator.deviation = deviation;
            idBBandsBIndicatorChart.bbandsBIndicator.series.name = "BBands %B(" + period + "," + deviation + ")";

            return true;
        },
        configBollingerBandsWidthIndicator: function (period, deviation) {
             if (isNaN(period) || isNaN(deviation)) return false; // Validation

            // Get indicator object from chart object model.
            var idBBandsWidthIndicatorChart = chart.getTechIndicatorById("idBBandsWidthIndicatorChart", "idBBandsWidthIndicator");

            // Setting new indicator parameters.
            idBBandsWidthIndicatorChart.bbandsWidthIndicator.period = period;
            idBBandsWidthIndicatorChart.bbandsWidthIndicator.deviation = deviation;
            idBBandsWidthIndicatorChart.bbandsWidthIndicator.series.name = "BBands Width(" + period + "," + deviation + ")";

            return true;
        },configIdCCIIndicatorChart: function (period,color) {
            if (isNaN(period)) return false; // if period is NaN - settings are invalid
            var idATRIndicatorChart = chart.getTechIndicatorById("idCCIIndicatorChart", "idCCIIndicator");

            //idADLIndicatorChart.adlIndicator.series.color = color;
            idATRIndicatorChart.cciIndicator.period = period;
            idATRIndicatorChart.cciIndicator.series.color = color;
            idATRIndicatorChart.cciIndicator.series.name = "CCI (" + period  + ")";
            //idAroonIndicatorChart.aroonIndicator.series.color = color;
            return true;
        }

    };

}();

/***
 Usage
 ***/
//Indicator.init();
//Custom.doSomeStuff();