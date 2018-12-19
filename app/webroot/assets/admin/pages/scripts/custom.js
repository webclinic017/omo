/**
 Custom module for you to write your own javascript functions
 **/

var Custom = function () {

    // private functions & variables

    var myFunc = function (text) {
        alert(text);
        //alert(testjs);
    }

    var handleSelect2 = function () {
        function movieFormatResult(share) {

            /*var markup='<table class="table table-bordered table-striped table-condensed flip-content">'+
             '<thead class="flip-content">'+
             '<tr> <th>Code</th><th class="numeric"> Price </th> <th class="numeric">Change</th><th class="numeric">High </th> <th class="numeric"> Low </th></tr>'+
             '</thead>'+
             '<tbody>'+
             '<tr> <td>'+share.instrument_code+'</td><td class="numeric">$1.38</td><td class="numeric"> -0.01</td> <td class="numeric">$1.39</td><td class="numeric"></td></tr>'+
             '</tbody>'+
             '</table>';*/
            var css = "bg-red";
            var icon = "glyphicon glyphicon-arrow-down";
            if (share.change > 0) {
                css = "bg-green";
                icon = "glyphicon glyphicon-arrow-up";
            }
            if (share.change == 0) {
                css = "bg-blue";
                icon = "glyphicon glyphicon-resize-horizontal";
            }

            //css='';

            var markup = '<a href="#" class="list-group-item active ' + css + '">' +
                '<h4 class="list-group-item-share_heading"><i class="' + icon + '"></i> ' + share.instrument_code + ' ' + share.close_price + ' [' + share.change_per + '%]</h4>' +
                '<p class="list-group-item-text"><i class="fa fa-hand-o-right"></i> Last traded price: ' + share.pub_last_traded_price + '<i class="fa fa-hand-o-right"></i> Close price: ' + share.close_price + '             <i class="fa fa-hand-o-up"></i> high: ' + share.high_price + '             <i class="fa fa-hand-o-down"></i> low: ' + share.low_price + '             <i class="fa fa-thumb-tack"></i>  open: ' + share.open_price + '             <i class="glyphicon glyphicon-stats"></i>  volume: ' + share.total_volume + '</p>' +
                '</a>';
            /*var markup='<div class="note note-success">'+
             '<h4 class="block">Success! Some Header Goes Here</h4>'+
             '<p>Duis mollis, est non commodo luctus, nisi erat mattis consectetur purus sit amet porttitor ligula</p>'+
             '</div>';*/
            /*var markup='<div class="top-news"><a href="#" class="btn green">'+
             '<span>Top Week </span>'+
             '<em>Posted on: April 15, 2013</em>'+
             '<em><i class="fa fa-tags"></i>Internet, Music, People </em>'+
             '<i class="fa fa-music top-news-icon"></i>'+
             '</a></div>';*/
            return markup;
        }

        function movieFormatSelection(share) {
            return share.instrument_code;
        }

        function movieformatInputTooShort(input, min) {

            var n = min - input.length;

            return "Please enter " + n + " more character" + (n == 1 ? "" : "s");

        }

        /*
         * @TODO CHANGE THE URL WHEN IN PRODUCTION MODE
         * */
        $("#select2_sample6").select2({
            placeholder: "Search for a share",
            minimumInputLength: 2,
            ajax: { // instead of writing the function to execute the request we use Select2's convenient helper
                url: "http://localhost/omo/markets/search_result",
                dataType: 'json',
                data: function (term, page) {
                    return {
                        q: term, // search term
                        page_limit: 10,
                        apikey: "ju6z9mjyajq2djue3gbvv26t" // please do not use so this example keeps working
                    };
                },
                results: function (data, page) { // parse the results into the format expected by Select2.
                    // since we are using custom formatting functions we do not need to alter remote JSON data
                    return {
                        //results: data.movies
                        results: data
                    };
                }
            },
            /*  initSelection: function (element, callback) {
             // the input tag has a value attribute preloaded that points to a preselected movie's id
             // this function resolves that id attribute to an object that select2 can render
             // using its formatResult renderer - that way the movie name is shown preselected

             var id = $(element).val();
             if (id !== "") {
             $.ajax("http://api.rottentomatoes.com/api/public/v1.0/movies/" + id + ".json", {
             data: {
             apikey: "ju6z9mjyajq2djue3gbvv26t"
             },
             dataType: "jsonp"
             }).done(function (data) {
             callback(data);
             });
             }
             },*/
            formatResult: movieFormatResult, // omitted for brevity, see the source of this page
            formatSelection: movieFormatSelection, // omitted for brevity, see the source of this page
            formatInputTooShort: movieformatInputTooShort, // omitted for brevity, see the source of this page
            // dropdownCssClass: "bigdrop", // apply css that makes the dropdown taller
            escapeMarkup: function (m) {
                return m;
            } // we do not want to escape markup since we are displaying html in results
        });
    }


    var handleUsernameAvailabilityChecker2 = function () {
        var input = $("#UserUsername");

        input.change(function (e) {
            var pop = $(this);

            if (input.val() === "") {
                input.closest('.form-group').removeClass('has-success').addClass('has-error');

                pop.popover('destroy');
                pop.popover({
                    'placement': (Metronic.isRTL() ? 'left' : 'right'),
                    'html': true,
                    'container': 'body',
                    'content': 'Please enter a username to check its availability.'
                });
                // add error class to the popover
                pop.data('bs.popover').tip().addClass('error');
                // set last poped popover to be closed on click(see Metronic.js => handlePopovers function)
                Metronic.setLastPopedPopover(pop);
                pop.popover('show');
                e.stopPropagation(); // prevent closing the popover

                return;
            }

            var btn = $(this);

            btn.attr('disabled', true);

            input.attr("readonly", true).
                attr("disabled", true).
                addClass("spinner");

            $.post('http://localhost/omo/users/check_username', {
                username: input.val()
            }, function (res) {
                btn.attr('disabled', false);

                input.attr("readonly", false).
                    attr("disabled", false).
                    removeClass("spinner");

                if (res.status == 'OK') {
                    input.closest('.form-group').removeClass('has-error').addClass('has-success');

                    pop.popover('destroy');
                    pop.popover({
                        'html': true,
                        'placement': (Metronic.isRTL() ? 'left' : 'right'),
                        'container': 'body',
                        'content': res.message
                    });
                    pop.popover('show');
                    pop.data('bs.popover').tip().removeClass('error').addClass('success');
                } else {
                    input.closest('.form-group').removeClass('has-success').addClass('has-error');

                    pop.popover('destroy');
                    pop.popover({
                        'html': true,
                        'placement': (Metronic.isRTL() ? 'left' : 'right'),
                        'container': 'body',
                        'content': res.message
                    });
                    pop.popover('show');
                    pop.data('bs.popover').tip().removeClass('success').addClass('error');
                    Metronic.setLastPopedPopover(pop);
                }

            }, 'json');

        });
    }
    var handleTabs = function () {
        // fix content height on tab click
        $('body').on('shown.bs.tab', function (e) {
            // var el = jQuery(this).closest(".portlet").children(".portlet-body");

            var url = $(e.target).attr("data-url");
            var target_loc = $(e.target).attr("href"); // activated tab
            var error = $(e.target).attr("data-error-display");
            el = target_loc;
            if (url) {
                Metronic.blockUI({target: el, iconOnly: true});
                $.ajax({
                    type: "GET",
                    cache: false,
                    url: url,
                    dataType: "html",
                    success: function (res) {
                        Metronic.unblockUI(el);
                        //el.html(res);
                        $(target_loc).html(res);
                    },
                    error: function (xhr, ajaxOptions, thrownError) {
                        Metronic.unblockUI(el);
                        var msg = 'Error on reloading the content. Please check your connection and try again.';
                        if (error == "toastr" && toastr) {
                            toastr.error(msg);
                        } else if (error == "notific8" && $.notific8) {
                            $.notific8('zindex', 11500);
                            $.notific8(msg, {theme: 'ruby', life: 3000});
                        } else {
                            alert(msg);
                        }
                    }
                });
            }


        })
        /* $('body').on('shown.bs.tab', '.nav.nav-tabs', function () {
         handleSidebarAndContentHeight();
         });*/

        //activate tab if tab id provided in the URL
        /* if (location.hash) {
         var tabid = location.hash.substr(1);
         $('a[href="#' + tabid + '"]').parents('.tab-pane:hidden').each(function () {
         var tabid = $(this).attr("id");
         $('a[href="#' + tabid + '"]').click();
         });
         $('a[href="#' + tabid + '"]').click();
         }*/
    }

    var handlePasswordStrengthChecker = function () {
        var initialized = false;
        var input = $("#UserPassword");

        input.keydown(function () {
            if (initialized === false) {
                // set base options
                input.pwstrength({
                    raisePower: 1.4,
                    minChar: 8,
                    verdicts: ["Weak", "Normal", "Medium", "Strong", "Very Strong"],
                    scores: [17, 26, 40, 50, 60]
                });

                // add your own rule to calculate the password strength
                input.pwstrength("addRule", "demoRule", function (options, word, score) {
                    return word.match(/[a-z].[0-9]/) && score;
                }, 10, true);

                // set as initialized
                initialized = true;
            }
        });
    }


    // public functions
    // Handles portlet tools & actions
    var handlePortletTools = function () {
        /*        jQuery('body').on('click', '.portlet > .portlet-title > .tools > a.reload', function (e) {
         e.preventDefault();
         var el = jQuery(this).closest(".portlet").children(".portlet-body");

         Metronic.blockUI({target: el, boxed: true});

         // alert($(this).attr("href"));
         var ajaxUrl=$(this).attr("href");
         var str = $(this).attr("href");
         var res = str.split("/");
         res.reverse();

         var updateBlock='marketshome';
         updateBlock=res[1]+res[0];
         $.post(ajaxUrl,
         {
         name:"Donald Duck",
         city:"Duckburg"
         },
         function(data,status){
         //alert("Data: " + data + "\nStatus: " + status);
         //alert("\nStatus: " + status);
         //alert(updateBlock+"=marketshome");
         //$(".portlet > .portlet-body").text("Hello world!"+updateBlock);
         $("#"+updateBlock).html(data);
         //$("#"+updateBlock).append(data);
         Metronic.unblockUI(el);

         });

         });*/


        //Feedback Modal:
        var $modal = $('#responsive');


        var elf = jQuery('body').on('click', '.portlet > .portlet-title > .tools > a.feedback', function (e) {
            $("#target")[0].reset();
            $('.alert').hide();
            var whichPortlet = $(this).attr("href");
            //$("#toolname").html(whichPortlet);
            $('#toolsin').val(whichPortlet);
            $('body').modalmanager('loading');
            $("#responsive").modal();

        });


        $('#target').validate({
            errorElement: 'span', //default input error message container
            errorClass: 'help-block', // default input error message class
            focusInvalid: false, // do not focus the last invalid input
            /* rules: {
             'data[Feedback][feedback_user_email]': {
             required: true
             },
             'data[Feedback][feedback_user_contact]': {
             required: true
             }
             },

             messages: {
             feedback_user_email: {
             required: "Username is required."
             },
             feedback_user_contact: {
             required: "Password is required."
             }
             },*/

            invalidHandler: function (event, validator) { //display error alert on form submit
                $('.alert-danger', $('#target')).show();

            },

            highlight: function (element) { // hightlight error inputs
                $(element)
                    .closest('.form-group').addClass('has-error'); // set error class to the control group
            },

            success: function (label) {
                label.closest('.form-group').removeClass('has-error');
                label.remove();
            },

            errorPlacement: function (error, element) {
                error.insertAfter(element.closest('.input-icon'));
            },

            /*
             * @TODO CHANGE THE URL WHEN IN PRODUCTION MODE
             * */
            submitHandler: function (form) {
                //form.submit(); // form validation success, call ajax form submit
                var ajaxUrl = 'http://localhost/omo/feedbacks/send_feedback';
                //Metronic.blockUI($modal);
                Metronic.blockUI({
                    target: $modal,
                    boxed: true,
                    message: 'Sending...'
                });
                var btn = $('.demo-loading-btn');
                btn.button('loading');

                $.ajax({
                    url: ajaxUrl,
                    type: 'POST',
                    dataType: 'html',
                    data: $("form").serialize(),
                    success: function (e) {
                        Metronic.unblockUI($modal);
                        btn.button('reset');
                        $("#target")[0].reset();
                        $modal
                            //.modal('loading')
                            .find('.modal-body')
                            /*.prepend('<div class="alert alert-info fade in">' +
                             'Your valued feedback submitted!<button type="button" class="close" data-dismiss="alert">&times;</button>' +
                             '</div>')*/
                            .prepend(e)
                    }
                });
            }
        });


    }

    var funcPortfolioTable = function (childRowData) {

        var table = $('#sample_3');
        var table_heading = $('#sample_heading');

        /* Formatting function for row details */
        function fnFormatDetails(oTable, nTr, childRowData) {
            var aData = oTable.fnGetData(nTr);
            var key = aData[1];
            key = key.trim();
            // alert(key);
            /*  var sOut = '<table>';
             sOut += '<tr><td>Platform(s):</td><td>' + childRowData[key]['ltp'] + '</td></tr>';
             sOut += '<tr><td>Engine version:</td><td>' + childRowData[key]['low'] + '</td></tr>';
             sOut += '<tr><td>CSS grade:</td><td>' + childRowData[key]['high'] + '</td></tr>';
             sOut += '<tr><td>Others:</td><td>Could provide a link here</td></tr>';
             sOut += '</table>';*/

            //var sOut = '<table class="table table-striped table-bordered table-hover">';
            /* var sOut = '<table class="table table-striped table-condensed table-hover">';
             //var sOut = '';
             // var sOut = '<table cellpadding="5" cellspacing="0" border="0" style="padding-left:50px;">';
             sOut += '<tr>' +
             '<td>Gain/Loss</td>' +
             '<td>Share</td>' +
             '<td>Buy Price</td>' +
             '<td>Purchase Date</td>' +
             '<td>Buy Commission</td>' +
             '<td>Total Purchase</td>' +
             '<td> 	Gain/Loss </td>' +
             '<td>%Change</td>' +
             '<td>Sell Value</td>' +
             '</tr>';
             sOut += '<tr>' +
             '<td>3%</td>' +
             '<td>1000</td>' +
             '<td>30.5</td>' +
             '<td>15/12/2014</td>' +
             '<td>40.5</td>' +
             '<td>25000</td>' +
             '<td>1025</td>' +
             '<td>2.5%</td>' +
             '<td>27000</td>' +
             '</tr>';
             sOut += '<tr>' +
             '<td>3%</td>' +
             '<td>1000</td>' +
             '<td>30.5</td>' +
             '<td>15/12/2014</td>' +
             '<td>40.5</td>' +
             '<td>25000</td>' +
             '<td>1025</td>' +
             '<td>2.5%</td>' +
             '<td>27000</td>' +
             '</tr>';
             sOut += '</table>';*/

            //return sOut;
            return childRowData[key];
        }

        /*
         * Insert a 'details' column to the table
         */
        var nCloneTh = document.createElement('th');
        nCloneTh.className = "table-checkbox";

        var nCloneTd = document.createElement('td');
        var nCloneTd2 = document.createElement('td');


        nCloneTd.innerHTML = '<span class="row-details row-details-close"></span>';
        nCloneTd2.innerHTML = '';

        //if( key in childRowData )
        table.find('thead tr').each(function () {
            this.insertBefore(nCloneTh, this.childNodes[0]);

            // v=$(this).find("td:last").html();
            //v=$(this).find("td").eq(2).html();
            // alert(v);
        });
        table.find('tfoot tr').each(function () {
            this.insertBefore(nCloneTh, this.childNodes[0]);

            // v=$(this).find("td:last").html();
            //v=$(this).find("td").eq(2).html();
            // alert(v);
        });

        table.find('tbody tr').each(function () {
            key = $(this).find("td").eq(0).text();
            key = key.trim();
            //alert(key+childRowData[key]);


            if (typeof childRowData[key] != "undefined") {
                this.insertBefore(nCloneTd.cloneNode(true), this.childNodes[0]);
            } else {
                this.insertBefore(nCloneTd2.cloneNode(true), this.childNodes[0]);
            }
        });

        /*
         * Initialize DataTables, with no sorting on the 'details' column
         */
        /* var oTable = table.dataTable({
         "columnDefs": [
         {
         "orderable": false,
         "targets": [0]
         }
         ],
         "order": [
         [1, 'desc']
         ],
         "lengthMenu": [
         [5, 15, 20, -1],
         [5, 15, 20, "All"] // change per page values here
         ],
         // set the initial value
         "pageLength": 10
         });*/

        var oTable=table.dataTable({
            "paging":   false,
            "bFilter" : false,
            "info":     false,
            "ordering": false
            /* "order": [
             [1, 'desc']
             ]*/

        });
//  var tableWrapper = $('#sample_3_wrapper'); // datatable creates the table wrapper by adding with id {your_table_jd}_wrapper

//  tableWrapper.find('.dataTables_length select').select2(); // initialize select2 dropdown

        /* Add event listener for opening and closing details
         * Note that the indicator for showing which row is open is not controlled by DataTables,
         * rather it is done here
         */
        table.on('click', ' tbody td .row-details', function () {
            var nTr = $(this).parents('tr')[0];
            // alert(nTr);
            if (oTable.fnIsOpen(nTr)) {
                /* This row is already open - close it */
                $(this).addClass("row-details-close").removeClass("row-details-open");
                oTable.fnClose(nTr);
            } else {
                /* Open this row */
                $(this).addClass("row-details-open").removeClass("row-details-close");

                oTable.fnOpen(nTr, fnFormatDetails(oTable, nTr, childRowData));

            }
        });

    }

    return {

        //main function
        init: function () {
            //initialize here something.
            handlePortletTools();
            handleSelect2();
            handleTabs();
            //handleUsernameAvailabilityChecker2();
            // handlePasswordStrengthChecker();

        },

        //some helper function
        doSomeStuff: function (x) {
            myFunc(x);
        },
        //some helper function
        initPortfolioTable: function (childRowData) {
            funcPortfolioTable(childRowData);
        },

        startAnim: function (x) {
            $('#animationSandbox').removeClass().addClass(x + ' animated').one('webkitAnimationEnd mozAnimationEnd MSAnimationEnd oanimationend animationend', function () {
                $(this).removeClass();
            });
        },
        // wrapper function to  block element(indicate loading)
        /* blockUI: function (el, centerY) {
         var el = jQuery(el);
         if (el.height() <= 400) {
         centerY = true;
         }
         el.block({
         message: '<img src="http://localhost/omo/assets/img/ajax-loading.gif" align="">',
         centerY: centerY != undefined ? centerY : true,
         css: {
         top: '10%',
         border: 'none',
         padding: '2px',
         backgroundColor: 'none'
         },
         overlayCSS: {
         backgroundColor: '#000',
         opacity: 0.05,
         cursor: 'wait'
         }
         });
         }*/


        blockUI: function (options) {
            alert('from custom');
            var options = $.extend(true, {}, options);
            var html = '';
            if (options.iconOnly) {
                html = '<div class="loading-message ' + (options.boxed ? 'loading-message-boxed' : '') + '"><img style="" src="http://localhost/omo/assets/img/loading-spinner-grey.gif" align=""></div>';
            } else if (options.textOnly) {
                html = '<div class="loading-message ' + (options.boxed ? 'loading-message-boxed' : '') + '"><span>&nbsp;&nbsp;' + (options.message ? options.message : 'LOADING...') + '</span></div>';
            } else {
                html = '<div class="loading-message ' + (options.boxed ? 'loading-message-boxed' : '') + '"><img style="" src="http://localhost/omo/assets/img/loading-spinner-grey.gif" align=""><span>&nbsp;&nbsp;' + (options.message ? options.message : 'LOADING...') + '</span></div>';
            }

            if (options.target) { // element blocking
                var el = jQuery(options.target);
                if (el.height() <= ($(window).height())) {
                    options.cenrerY = true;
                }
                el.block({
                    message: html,
                    baseZ: options.zIndex ? options.zIndex : 1000,
                    centerY: options.cenrerY != undefined ? options.cenrerY : false,
                    css: {
                        top: '10%',
                        border: '0',
                        padding: '0',
                        backgroundColor: 'none'
                    },
                    overlayCSS: {
                        backgroundColor: options.overlayColor ? options.overlayColor : '#000',
                        opacity: options.boxed ? 0.05 : 0.1,
                        cursor: 'wait'
                    }
                });
            } else { // page blocking
                $.blockUI({
                    message: html,
                    baseZ: options.zIndex ? options.zIndex : 1000,
                    css: {
                        border: '0',
                        padding: '0',
                        backgroundColor: 'none'
                    },
                    overlayCSS: {
                        backgroundColor: options.overlayColor ? options.overlayColor : '#000',
                        opacity: options.boxed ? 0.05 : 0.1,
                        cursor: 'wait'
                    }
                });
            }
        }


    };

}();

/***
 Usage
 ***/
//Custom.init();
//Custom.doSomeStuff();

