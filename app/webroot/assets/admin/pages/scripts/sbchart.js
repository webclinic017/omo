var SbChart = function () {

    var content = $('.chartcontent');
    var loading = $('.chart-loading');
    var listListing = '';

    var loadChart = function (el) {
        var chartRange = $('#reportrange').attr("data-range");
        //var chartRange='2012-10-25|2013-04-25';
        var url = "http://localhost/omo/TechnicalAnalysis/chart_img_trac2/";
       // var comparewith=$('#comparewith').val();
        var comparewith='null';
        if ($('#shareList').val() == "") {
            sharelist = "DSEX";
        } else {
            sharelist = $('#shareList').val();
        }
        touchspin_demo1
        url = url + chartRange + "/" + sharelist + "/" + comparewith + "/" + $('#Indicators').val() + "/" + $('#configure').val() + "/" + $('#charttype').val() + "/" + $('#overlay').val() + "/" + $('#mov1').val() + "/" + $('#touchspin_demo1').val()+ "/"+ $('#mov2').val() + "/" + $('#touchspin_demo2').val()+ "/" + $('#adj').val();

var companyDetailsUrl='http://localhost/omo/TechnicalAnalysis/company_details/'+sharelist
var marketDepthUrl='http://localhost/omo/TechnicalAnalysis/market_depth/'+sharelist

        $('#portlet_tab2_company').attr("data-url",companyDetailsUrl);
        $('#portlet_tab1_market_depth').attr("data-url",marketDepthUrl);
        //var url = 'http://localhost/omo/TechnicalAnalysis/chart_img_trac2/2012-10-25|2013-04-25';
        //  var url = 'http://localhost/omo/TechnicalAnalysis/chart_img_trac2/'+chartRange;
        //  var title = $('.inbox-nav > li.' + name + ' a').attr('data-title');
        //  listListing = name;

        loading.show();
        content.html('');
        //toggleButton(el);

        $.ajax({
            type: "GET",
            cache: false,
            url: url,
            dataType: "html",
            success: function (res) {
                //toggleButton(el);

//                $('.inbox-nav > li.active').removeClass('active');
//                $('.inbox-nav > li.' + name).addClass('active');
//                $('.inbox-header > h1').text(title);

                loading.hide();
                content.html(res);


          //      Metronic.fixContentHeight();
                Metronic.initUniform();
            },
            error: function (xhr, ajaxOptions, thrownError) {
//                toggleButton(el);
            },
            async: false
        });


    }


    var toggleButton = function (el) {
        if (typeof el == 'undefined') {
            return;
        }
        if (el.attr("disabled")) {
            el.attr("disabled", false);
        } else {
            el.attr("disabled", true);
        }
    }

    return {
        //main function to initiate the module
        init: function () {

            $("#shareList")
                .on("change", function () {
                    loadChart($(this));
                })
            $("#Button1")
                .on("click", function () {
                    loadChart($(this));
                })
            $("#Button2")
                .on("click", function () {
                    loadChart($(this));
                })
      //      loadChart($(this));

        }

    };

}();