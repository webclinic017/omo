var PortfolioTableEditable = function () {
    var handleTable = function (portfolioCommission, shareList, cakeToJsArr) {

        var urlRoot = cakeToJsArr['url'];

        function restoreRow(oTable, nRow) {
            // alert('restore');
            var aData = oTable.fnGetData(nRow);
            var jqTds = $('>td', nRow);

            for (var i = 0, iLen = jqTds.length; i < iLen; i++) {
                oTable.fnUpdate(aData[i], nRow, i, false);
            }

            oTable.fnDraw();
        }

        function editRow(oTable, nRow) {
            var aData = oTable.fnGetData(nRow);
            var jqTds = $('>td', nRow);


            //jqTds[0].innerHTML = '<h4>'+ aData[0] + '</h4>';
            //jqTds[0].innerHTML = '<input type="text" class="form-control input-small" value="' + aData[0] + '">';
            jqTds[1].innerHTML = '<input type="text" class="form-control input-small" value="' + aData[1] + '">';
            jqTds[2].innerHTML = '<input type="text" class="form-control input-small" value="' + aData[2] + '">';
            //  jqTds[3].innerHTML = '<input type="text" class="form-control input-small" value="' + aData[3] + '">';
            //jqTds[4].innerHTML = '<input type="text" class="form-control input-small" value="' + aData[4] + '"><p class="help-block">Sell Date:</p>';
            jqTds[4].innerHTML = '<input class="form-control form-control-inline input-medium date-picker" data-date-format="yyyy/mm/dd"  data-date="' + aData[4] + '" size="16" value="' + aData[4] + '" type="text" >';
            //jqTds[5].innerHTML = '<a class="edit" href="">Save</a>';
            jqTds[5].innerHTML = '<a class="sell" href="">Sell</a>';
            jqTds[6].innerHTML = '<button type="button" class="btn edit blue btn-xs">Save</button>';
            jqTds[7].innerHTML = '<a class="cancel" href="">Cancel</a>';
            $('.date-picker').datepicker({
                rtl: Metronic.isRTL(),
                orientation: "left",
                autoclose: true
            });
        }

        function addRow(oTable, nRow) {
            var aData = oTable.fnGetData(nRow);
            var jqTds = $('>td', nRow);

            var selectHtml = '<select id="sharelist" class="form-control input-small select2me" data-placeholder="Select..."><option value=0>Select</option>';
            $.each(shareList, function (index, element) {
//                alert(element+index);
                selectHtml += '<option value="' + element + '">' + element + '</option>'
            });
            selectHtml += '</select>';
            //jqTds[0].innerHTML = '<h4>'+ aData[0] + '</h4>';
            //jqTds[0].innerHTML = '<input type="text" class="form-control input-small" value="' + aData[0] + '">';
            jqTds[0].innerHTML = selectHtml;
            jqTds[1].innerHTML = '<input type="text" class="form-control input-small" value="' + aData[1] + '">';
            jqTds[2].innerHTML = '<input type="text" class="form-control input-small" value="' + aData[2] + '">';
            jqTds[3].innerHTML = '<input type="text" class="form-control input-small" value="' + portfolioCommission + '">';
            //jqTds[4].innerHTML = '<input type="text" class="form-control input-small" value="' + aData[4] + '"><p class="help-block">Sell Date:</p>';
            jqTds[4].innerHTML = '<input class="form-control form-control-inline input-medium date-picker" data-date-format="yyyy/mm/dd"  data-date="' + aData[4] + '" size="16" value="' + aData[4] + '" type="text" >';
            //jqTds[5].innerHTML = '<a class="edit" href="">Save</a>';
            jqTds[5].innerHTML = '';
            jqTds[6].innerHTML = '<button type="button" class="btn add green btn-xs">Save</button>';
            jqTds[7].innerHTML = '<a class="cancel" href="">Cancel</a>';
            $('.date-picker').datepicker({
                rtl: Metronic.isRTL(),
                orientation: "left",
                autoclose: true
            });
            $('#sharelist').select2({
                placeholder: "Select an option",
                allowClear: true,
                sortResults: function (results, container, query) {
                    if (query.term) {
                        // use the built in javascript sort function
                        return results.sort();
                    }
                    return results;
                }
            });
        }

        function sellRow(oTable, nRow) {
            var aData = oTable.fnGetData(nRow);
            var jqTds = $('>td', nRow);

            var date1 = new Date(aData[4]);
            var date2 = new Date();
            var timeDiff = Math.abs(date2.getTime() - date1.getTime());
            var diffDays = Math.ceil(timeDiff / (1000 * 3600 * 24)) - 3;


            //jqTds[0].innerHTML = '<h4>'+ aData[0] + '</h4>';
            //jqTds[0].innerHTML = '<input type="text" class="form-control input-small" value="' + aData[0] + '">';
            jqTds[1].innerHTML = '<input type="text" class="form-control input-small" value="' + aData[1] + '"><p class="help-block">Shares Sold:</p>';
            jqTds[2].innerHTML = '<input type="text" class="form-control input-small" value="' + aData[2] + '"><p class="help-block">Price Sold:</p>';
            jqTds[3].innerHTML = '<input type="text" class="form-control input-small" value="' + aData[3] + '"><p class="help-block">Sell Commission:</p>';
            //jqTds[4].innerHTML = '<input type="text" class="form-control input-small" value="' + aData[4] + '"><p class="help-block">Sell Date:</p>';
            jqTds[4].innerHTML = '<input class="form-control form-control-inline input-medium date-picker" data-date-format="yyyy/mm/dd" data-date-start-date="-' + diffDays + 'd" data-date="' + aData[4] + '" size="16" value="' + aData[4] + '" type="text" ><p class="help-block">Sell Date:</p>';
            //jqTds[5].innerHTML = '<a class="edit" href="">Save</a>';
            jqTds[5].innerHTML = '<button type="button" class="btn sell green btn-xs">Save</button>';
            jqTds[6].innerHTML = '<a class="edit" href="">Edit</a>';
            jqTds[7].innerHTML = '<a class="cancel" href="">Cancel</a>';
            $('.date-picker').datepicker({
                rtl: Metronic.isRTL(),
                orientation: "left",
                autoclose: true
            });
        }

        function saveRow(oTable, nRow) {

            var valid = true;
            var aData = oTable.fnGetData(nRow);
            var jqInputs = $('input', nRow);
            // var tid = $('transaction_id', nRow);
            // alert(tid[0].value);
            var pid = $('#portfolio_editable').attr("portfolio_id");
            //var jqselect = $('select', nRow);
            // alert(jqInputs[0].value);
            // alert(jqInputs[1].value);
            //alert(jqInputs[2].value);

            if (!jqInputs[4].value) {
                alert("Enter a sell date");
                oTable.fnUpdate(aData[1], nRow, 1, false);
                oTable.fnUpdate(aData[2], nRow, 2, false);
                oTable.fnUpdate(aData[3], nRow, 3, false);
                oTable.fnUpdate(aData[4], nRow, 4, false);
                oTable.fnUpdate('<a class="sell" href="">Sell</a>', nRow, 5, false);
                oTable.fnUpdate('<a class="edit" href="">Edit</a>', nRow, 6, false);
                oTable.fnUpdate('<a class="delete" href="">Delete</a>', nRow, 7, false);
                oTable.fnDraw();
                valid = false;
            }

            if (jqInputs[2].value < 1) {
                alert("Please enter non zero value");
                valid = false;

                oTable.fnUpdate(aData[1], nRow, 1, false);
                oTable.fnUpdate(aData[2], nRow, 2, false);
                oTable.fnUpdate(aData[3], nRow, 3, false);
                oTable.fnUpdate(aData[4], nRow, 4, false);
                oTable.fnUpdate('<a class="sell" href="">Sell</a>', nRow, 5, false);
                oTable.fnUpdate('<a class="edit" href="">Edit</a>', nRow, 6, false);
                oTable.fnUpdate('<a class="delete" href="">Delete</a>', nRow, 7, false);
                oTable.fnDraw();
                valid = false;

            }

            //   oTable.fnUpdate(jqselect[0].value, nRow, 0, false);


            //var ajaxUrl = 'http://localhost/omo/PortfolioTransactions/edit_row';
            var ajaxUrl = urlRoot + 'PortfolioTransactions/edit_row';
            if (valid) {
                //var qtyChange = jqInputs[2].value - aData[1];
                //var rateChange = jqInputs[3].value - aData[2];
                // alert(jqInputs[4].value);
                $.ajax({
                    type: "POST",
                    url: ajaxUrl,
                    data: { pid: pid, tid: jqInputs[0].value, instrumentId: jqInputs[1].value
                        //,amount: jqInputs[2].value
                        , amount: jqInputs[2].value, initialQuantity: aData[1], rate: jqInputs[3].value, initialRate: aData[2], commission: aData[3], transaction_time: jqInputs[4].value
                    }

                })
                    .done(function (msg) {
                        alert("" + msg);


                        //alert('old='+aData[1]+' sold='+jqInputs[2].value+' remain='+remaining);

                        oTable.fnUpdate(jqInputs[2].value, nRow, 1, false);
                        oTable.fnUpdate(jqInputs[3].value, nRow, 2, false);
                        oTable.fnUpdate(aData[3].value, nRow, 3, false);
                        oTable.fnUpdate(jqInputs[4].value, nRow, 4, false);
                        oTable.fnUpdate('<a class="sell" href="">Sell</a>', nRow, 5, false);
                        oTable.fnUpdate('<a class="edit" href="">Edit</a>', nRow, 6, false);
                        oTable.fnUpdate('<a class="delete" href="">Delete</a>', nRow, 7, false);
                        oTable.fnDraw();

                    });

            }


        }

        function addNewRow(oTable, nRow) {
            //   alert('new');
            var selectHtml = '<select id="sharelist" class="form-control input-small select2me" data-placeholder="Select..."><option value=0>Select</option>';
            $.each(shareList, function (index, element) {
//                alert(element+index);
                selectHtml += '<option value="' + element + '">' + element + '</option>'
            });
            selectHtml += '</select>';
            //jqTds[0].innerHTML = '<h4>'+ aData[0] + '</h4>';
            //jqTds[0].innerHTML = '<input type="text" class="form-control input-small" value="' + aData[0] + '">';


            var valid = true;
            var aData = oTable.fnGetData(nRow);
            var jqInputs = $('input', nRow);
            var jqSelect = $('select', nRow);
            var pid = $('#portfolio_editable').attr("portfolio_id");
            // var tid = $('transaction_id', nRow);
            // alert(tid[0].value);
            // alert(jqSelect[0].value);


            /*
             alert(jqSelect[0].value);
             alert(jqInputs[0].value+'index= 0');
             alert(jqInputs[1].value+'index= 1');
             alert(jqInputs[2].value+'index= 2');
             alert(jqInputs[3].value+'index= 3');
             alert(jqInputs[4].value+'index= 4');*/
            // var todaysDate = new Date();
            // alert(todaysDate);
            // alert(jqInputs[4].value);
            if (!jqInputs[4].value) {
                alert("Enter a sell date");

                valid = false;
                /* oTable.fnUpdate(selectHtml, nRow, 0, false);
                 oTable.fnUpdate(aData[1], nRow, 1, false);
                 oTable.fnUpdate(aData[2], nRow, 2, false);
                 oTable.fnUpdate(aData[3], nRow, 3, false);
                 oTable.fnUpdate(aData[4], nRow, 4, false);
                 oTable.fnUpdate('', nRow, 5, false);
                 oTable.fnUpdate('<button type="button" class="btn add blue btn-xs">Save</button>', nRow, 6, false);
                 oTable.fnUpdate('<a class="delete" href="">Delete</a>', nRow, 7, false);
                 oTable.fnDraw();


                 $('#sharelist').select2({
                 placeholder: "Select an option",
                 allowClear: true,
                 sortResults: function(results, container, query) {
                 if (query.term) {
                 // use the built in javascript sort function
                 return results.sort();
                 }
                 return results;
                 }
                 });*/
                return;
                //valid = false;
            }

            if (jqInputs[2].value < 1) {
                alert("Please enter non zero value");
                valid = false;

                /*   oTable.fnUpdate(selectHtml, nRow, 0, false);
                 oTable.fnUpdate(jqInputs[1].value, nRow, 1, false);
                 oTable.fnUpdate(jqInputs[2].value, nRow, 2, false);
                 oTable.fnUpdate(aData[3], nRow, 3, false);
                 oTable.fnUpdate(aData[4], nRow, 4, false);
                 oTable.fnUpdate('', nRow, 5, false);
                 oTable.fnUpdate('<button type="button" class="btn add blue btn-xs">Save</button>', nRow, 6, false);
                 oTable.fnUpdate('<a class="delete" href="">Delete</a>', nRow, 7, false);
                 oTable.fnDraw();
                 valid = false;

                 $('#sharelist').select2({
                 placeholder: "Select an option",
                 allowClear: true,
                 sortResults: function(results, container, query) {
                 if (query.term) {
                 // use the built in javascript sort function
                 return results.sort();
                 }
                 return results;
                 }
                 });*/

                return;

            }

            if (jqSelect[0].value == 0) {
                valid = false;
                alert('Select a share')
            }

            if (!valid) {
                $('#sharelist').select2({
                    placeholder: "Select an option",
                    allowClear: true,
                    sortResults: function (results, container, query) {
                        if (query.term) {
                            // use the built in javascript sort function
                            return results.sort();
                        }
                        return results;
                    }
                });
            }

            //   oTable.fnUpdate(jqselect[0].value, nRow, 0, false);


            //var ajaxUrl = 'http://localhost/omo/PortfolioTransactions/add_row';
            var ajaxUrl = urlRoot + 'PortfolioTransactions/add_row';
            if (valid) {
                var qtyChange = jqInputs[2].value - aData[1];
                $.ajax({
                    type: "POST",
                    url: ajaxUrl,
                    data: { pid: pid, instrumentId: jqSelect[0].value, amount: jqInputs[1].value, rate: jqInputs[2].value, commission: jqInputs[3].value, transaction_time: jqInputs[4].value
                    }

                })
                    .done(function (msg) {
                        alert("" + msg);


                        var res = msg.split(":");
                        var tid = res[1];
                        tid = tid.trim();
                        var instrumentId = res[2];
                        instrumentId = instrumentId.trim();
                        //alert('old='+aData[1]+' sold='+jqInputs[2].value+' remain='+remaining);

                        /* oTable.fnUpdate(jqInputs[2].value, nRow, 1, false);
                         oTable.fnUpdate(jqInputs[3].value, nRow, 2, false);
                         oTable.fnUpdate(jqInputs[4].value, nRow, 3, false);
                         oTable.fnUpdate(jqInputs[5].value, nRow, 4, false);
                         oTable.fnUpdate('<a class="sell" href="">Sell</a>', nRow, 5, false);
                         oTable.fnUpdate('<a class="edit" href="">Edit</a>', nRow, 6, false);
                         oTable.fnUpdate('<a class="delete" href="">Delete</a>', nRow, 7, false);
                         oTable.fnDraw();*/
                        oTable.fnUpdate(jqSelect[0].value + '<input value=' + tid + ' type="hidden">' + '<input value=' + instrumentId + ' type="hidden">', nRow, 0, false);
                        oTable.fnUpdate(jqInputs[1].value, nRow, 1, false);
                        oTable.fnUpdate(jqInputs[2].value, nRow, 2, false);
                        oTable.fnUpdate(jqInputs[3].value, nRow, 3, false);
                        oTable.fnUpdate(jqInputs[4].value, nRow, 4, false);
                        oTable.fnUpdate('<a class="sell" href="">Sell</a>', nRow, 5, false);
                        oTable.fnUpdate('<a class="edit" href="">Edit</a>', nRow, 6, false);
                        oTable.fnUpdate('<a class="delete"href="">Delete</a>', nRow, 7, false);
                        oTable.fnDraw();

                    });

            }

        }

        function saveSellRow(oTable, nRow) {
            var valid = true;
            var aData = oTable.fnGetData(nRow);
            var jqInputs = $('input', nRow);
            // var tid = $('transaction_id', nRow);
            // alert(tid[0].value);
            var pid = $('#portfolio_editable').attr("portfolio_id");
            //var jqselect = $('select', nRow);
            // alert(jqInputs[0].value);
            // alert(jqInputs[1].value);
            //alert(jqInputs[2].value);

            if (!jqInputs[5].value) {
                alert("Enter a sell date");
                valid = false;
            }
            if (jqInputs[2].value > aData[1].value) {
                alert("You are trying to sell" + jqInputs[2].value + " shares but you have " + aData[1] + " shares");
                valid = false;

                oTable.fnUpdate(aData[1], nRow, 1, false);
                oTable.fnUpdate(aData[2], nRow, 2, false);
                oTable.fnUpdate(aData[3], nRow, 3, false);
                oTable.fnUpdate(aData[4], nRow, 4, false);
                oTable.fnUpdate('<a class="sell" href="">Sell</a>', nRow, 5, false);
                oTable.fnUpdate('<a class="edit" href="">Edit</a>', nRow, 6, false);
                oTable.fnUpdate('<a class="delete" href="">Delete</a>', nRow, 7, false);
                oTable.fnDraw();

            }

            //   oTable.fnUpdate(jqselect[0].value, nRow, 0, false);


            var ajaxUrl = urlRoot + 'PortfolioTransactions/sell';
            if (valid) {

                $.ajax({
                    type: "POST",
                    url: ajaxUrl,
                    data: { pid: pid, tid: jqInputs[0].value, instrumentId: jqInputs[1].value, amount: jqInputs[2].value, rate: jqInputs[3].value, commission: jqInputs[4].value, transaction_time: jqInputs[5].value
                    }

                })
                    .done(function (msg) {
                        alert("" + msg);

                        var remaining = aData[1] - jqInputs[2].value;
                        //alert('old='+aData[1]+' sold='+jqInputs[2].value+' remain='+remaining);
                        if (remaining) {
                            oTable.fnUpdate(remaining, nRow, 1, false);
                            oTable.fnUpdate(aData[2], nRow, 2, false);
                            oTable.fnUpdate(aData[3], nRow, 3, false);
                            oTable.fnUpdate(aData[4], nRow, 4, false);
                            oTable.fnUpdate('<a class="sell" href="">Sell</a>', nRow, 5, false);
                            oTable.fnUpdate('<a class="edit" href="">Edit</a>', nRow, 6, false);
                            oTable.fnUpdate('<a class="delete" href="">Delete</a>', nRow, 7, false);
                            oTable.fnDraw();
                        } else {
                            oTable.fnDeleteRow(nRow);
                        }
                    });

            }


        }

        function cancelEditRow(oTable, nRow) {
            var jqInputs = $('input', nRow);
            oTable.fnUpdate(jqInputs[0].value, nRow, 0, false);
            oTable.fnUpdate(jqInputs[1].value, nRow, 1, false);
            oTable.fnUpdate(jqInputs[2].value, nRow, 2, false);
            oTable.fnUpdate(jqInputs[3].value, nRow, 3, false);
            oTable.fnUpdate('<a class="edit" href="">Edit</a>', nRow, 4, false);
            oTable.fnDraw();
        }

        var table = $('#portfolio_editable');

        var oTable = table.dataTable({
            "lengthMenu": [
                [5, 15, 20, -1],
                [5, 15, 20, "All"] // change per page values here
            ],
            // set the initial value
            "pageLength": 10,

            "language": {
                "lengthMenu": " _MENU_ records"
            },
            "columnDefs": [
                { // set default column settings
                    'orderable': true,
                    'targets': [0]
                },
                {
                    "searchable": true,
                    "targets": [0]
                }
            ],
            "order": [
                [0, "asc"]
            ] // set first column as a default sort by asc
        });

        var tableWrapper = $("#sample_editable_1_wrapper");

        tableWrapper.find(".dataTables_length select").select2({
            showSearchInput: false //hide search box with special css class
        }); // initialize select2 dropdown

        var nEditing = null;
        var nNew = false;

        $('#sample_editable_11_new').click(function (e) {
            e.preventDefault();

            if (nNew && nEditing) {
                if (confirm("Previous row not saved. Do you want to save it ?")) {
                    saveRow(oTable, nEditing); // save
                    $(nEditing).find("td:first").html("Untitled");
                    nEditing = null;
                    nNew = false;

                } else {
                    oTable.fnDeleteRow(nEditing); // cancel
                    nEditing = null;
                    nNew = false;

                    return;
                }
            }

            var aiNew = oTable.fnAddData(['', '', '', '', '', '', '', '']);
            var nRow = oTable.fnGetNodes(aiNew[0]);
            addRow(oTable, nRow);
            nEditing = nRow;
            nNew = true;
        });

        table.on('click', '.delete', function (e) {
            e.preventDefault();

            if (confirm("Are you sure to delete this row ?") == false) {
                return;
            }
            var nRow = $(this).parents('tr')[0];
            var jqInputs = $('input', nRow);
            var aData = oTable.fnGetData(nRow);
            var pid = $('#portfolio_editable').attr("portfolio_id");

            var ajaxUrl = urlRoot + 'PortfolioTransactions/delete_row';

            var qtyChange = aData[1];
            var jqSelect = $('select', nRow);

            $.ajax({
                type: "POST",
                url: ajaxUrl,
                data: { pid: pid, tid: jqInputs[0].value, instrumentId: jqInputs[1].value
                    //,amount: jqInputs[2].value
                    , amount: aData[1], rate: aData[2], commission: aData[3], transaction_time: aData[4]

                }

            })
                .done(function (msg) {
                    alert("" + msg);

                    oTable.fnDeleteRow(nRow);

                });


        });

        table.on('click', '.cancel', function (e) {
            e.preventDefault();
            if (nNew) {
                oTable.fnDeleteRow(nEditing);
                nNew = false;
                nEditing = null;
            } else {
                restoreRow(oTable, nEditing);
                nEditing = null;
            }
        });

        table.on('click', '.edit', function (e) {
            e.preventDefault();

            /* Get the row as a parent of the link that was clicked on */
            var nRow = $(this).parents('tr')[0];

            if (nEditing !== null && nEditing != nRow) {
                /* Currently editing - but not this row - restore the old before continuing to edit mode */
                if (!nNew) {
                    restoreRow(oTable, nEditing);
                } else {
                    oTable.fnDeleteRow(nEditing);
                    nNew = false;
                    nEditing = null;
                }
                restoreRow(oTable, nEditing);
                editRow(oTable, nRow);
                $('.date-picker').datepicker({
                    rtl: Metronic.isRTL(),
                    orientation: "left",
                    autoclose: true
                });
                nEditing = nRow;
            } else if (nEditing == nRow && this.innerHTML == "Save") {
                /* Editing this row and want to save it */
                saveRow(oTable, nEditing);
                nEditing = null;
                //alert("Updated! Do not forget to do some ajax to sync with backend :)");
            } else {
                /* No edit in progress - let's start one */
                editRow(oTable, nRow);
                $('.date-picker').datepicker({
                    rtl: Metronic.isRTL(),
                    orientation: "left",
                    autoclose: true
                });
                nEditing = nRow;
            }
        });
        table.on('click', '.add', function (e) {
            e.preventDefault();

            /* Get the row as a parent of the link that was clicked on */
            var nRow = $(this).parents('tr')[0];

            if (nEditing !== null && nEditing != nRow) {
                /* Currently editing - but not this row - restore the old before continuing to edit mode */
                if (!nNew) {
                    restoreRow(oTable, nEditing);
                } else {
                    oTable.fnDeleteRow(nEditing);
                    nNew = false;
                    nEditing = null;
                }
                restoreRow(oTable, nEditing);
                editRow(oTable, nRow);
                //alert("add func upper");
                $('.date-picker').datepicker({
                    rtl: Metronic.isRTL(),
                    orientation: "left",
                    autoclose: true
                });
                nEditing = nRow;
            } else if (nEditing == nRow && this.innerHTML == "Save") {
                /* Editing this row and want to save it */
                // alert("add func middle");
                addNewRow(oTable, nEditing);
                nEditing = null;

            } else {
                /* No edit in progress - let's start one */
                // alert("add func lower");
                addRow(oTable, nRow);
                $('.date-picker').datepicker({
                    rtl: Metronic.isRTL(),
                    orientation: "left",
                    autoclose: true
                });
                nEditing = nRow;
            }
        });
        table.on('click', '.sell', function (e) {
            e.preventDefault();


            /* Get the row as a parent of the link that was clicked on */
            var nRow = $(this).parents('tr')[0];


            if (nEditing !== null && nEditing != nRow) {
                /* Currently editing - but not this row - restore the old before continuing to edit mode */
                if (!nNew) {
                    restoreRow(oTable, nEditing);
                } else {
                    oTable.fnDeleteRow(nEditing);
                    nNew = false;
                    nEditing = null;
                }
                sellRow(oTable, nRow);
                /*  $('.date-picker').datepicker({
                 rtl: Metronic.isRTL(),
                 orientation: "left",
                 autoclose: true
                 });*/
                nEditing = nRow;
            } else if (nEditing == nRow && this.innerHTML == "Save") {
                /* Editing this row and want to save it */
                saveSellRow(oTable, nEditing);
                nEditing = null;
                // alert("Updated! Do not forget to do some ajax to sync with backend :)");
            }
            else {
                /* edit in progress - let's start one */
                sellRow(oTable, nRow);
                /* $('.date-picker').datepicker({
                 rtl: Metronic.isRTL(),
                 orientation: "left",
                 autoclose: true
                 });*/

                nEditing = nRow;
            }
        });
    }

    return {

        //main function to initiate the module
        init: function () {
            // handleTable();
        },
        initPortfolioEdit: function (portfolioCommission, shareList, cakeToJsArr) {
            handleTable(portfolioCommission, shareList, cakeToJsArr);
        }

    };

}();