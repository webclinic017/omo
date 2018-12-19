<div class="table-toolbar">
    <div class="btn-group">
        <button id="sample_editable_11_new" class="btn green">
            Add New <i class="fa fa-plus"></i>
        </button>
    </div>

</div>
<form id="shareEditForm">
<table class="table table-striped table-hover table-bordered" id="portfolio_editable">
    <thead>
    <tr>
        <th>
            Investor Code
        </th>
        <th>
            Instrument
        </th>
        <th>
            Free Qty
        </th>
        <th>
            Um Qty
        </th>
        <th>
            Tot Qty
        </th>
        <th>
            avg Price
        </th>
        <th>
            Edit
        </th>
        <th>
            Delete
        </th>
    </tr>
    </thead>
    <tbody>



    </tbody>
</table>
</form>
<div>
    <button class="demo-loading-btn btn btn-primary btn-block" data-loading-text="updating..." type="button" id="portfolioUpdateButton">
        Update Shares in Portfolio <i class="fa fa-check"></i>
    </button>

    <!--   <button id="Button1" name="Button1" type="submit" class="btn primary btn-block"><i class="fa fa-check"></i>
           Send order
       </button>-->

</div>

<script>

    $(function () {

        var sharelist=<?php echo $instrumentList; ?>;
        var userlist=<?php echo $userForDropDown; ?>;


        var PortfolioTableEditable = function () {
            var handleTable = function (shareList,userList) {


                //edited
                function restoreRow(oTable, nRow) {
                    // alert('restore');
                    var aData = oTable.fnGetData(nRow);
                    var jqTds = $('>td', nRow);

                    for (var i = 0, iLen = jqTds.length; i < iLen; i++) {
                        oTable.fnUpdate(aData[i], nRow, i, false);
                    }

                    oTable.fnDraw();
                }

                //edited
                function editRow(oTable, nRow) {
                    var aData = oTable.fnGetData(nRow);
                    var jqTds = $('>td', nRow);


                    jqTds[2].innerHTML = '<input type="text" class="form-control input-small" value="' + aData[2] + '">';
                    jqTds[3].innerHTML = '<input type="text" class="form-control input-small" value="' + aData[3] + '">';
                    jqTds[4].innerHTML = '<input type="text" class="form-control input-small" value="' + aData[4] + '">';
                    jqTds[5].innerHTML = '<input type="text" class="form-control input-small" value="' + aData[5] + '">';
                    jqTds[6].innerHTML = '<button type="button" class="btn edit blue btn-xs">Save</button>';
                    jqTds[7].innerHTML = '<a class="cancel" href="">Cancel</a>';

                }


                //edited
                function addRow(oTable, nRow) {
                    var aData = oTable.fnGetData(nRow);


                    var jqTds = $('>td', nRow);

                    var selectHtmlUser = '<select id="userlist" class="form-control input-small select2me" data-placeholder="Select..."><option value=0>Select</option>';
                    $.each(userList, function (index, element) {

                        selectHtmlUser += '<option value="' + element.internal_ref_no + '">' + element.internal_ref_no + '</option>'
                    });
                    selectHtmlUser += '</select>';

                    var selectHtml = '<select id="sharelist" class="form-control input-small select2me" data-placeholder="Select..."><option value=0>Select</option>';
                    $.each(shareList, function (index, element) {
//                alert(element+index);
                        selectHtml += '<option value="' + element + '">' + element + '</option>'
                    });
                    selectHtml += '</select>';


                    jqTds[0].innerHTML = selectHtmlUser;
                    jqTds[1].innerHTML = selectHtml;
                    jqTds[2].innerHTML = '<input type="text" class="form-control input-small" value="' + aData[0] + '">';
                    jqTds[3].innerHTML = '<input type="text" class="form-control input-small" value="' + aData[1] + '">';
                    jqTds[4].innerHTML = '<input type="text" class="form-control input-small" value="' + aData[2] + '">';
                    jqTds[5].innerHTML = '<input type="text" class="form-control input-small" value="' + aData[3] + '">';
                    jqTds[6].innerHTML = '<button type="button" class="btn add green btn-xs">Confirm</button>';
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

                    $('#userlist').select2({
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


                //edited
                function saveRow(oTable, nRow) {

                    var valid = true;
                    var aData = oTable.fnGetData(nRow);
                    var jqInputs = $('input', nRow);



                    oTable.fnUpdate(jqInputs[0].value, nRow, 2, false);
                    oTable.fnUpdate(jqInputs[1].value, nRow, 3, false);
                    oTable.fnUpdate(jqInputs[2].value, nRow, 4, false);
                    oTable.fnUpdate(jqInputs[3].value, nRow, 5, false);
                    oTable.fnUpdate('<a class="edit" href="">Edit</a>', nRow, 6, false);
                    oTable.fnUpdate('<a class="delete" href="">Delete</a>', nRow, 7, false);
                    oTable.fnDraw();


                }


                //edited
                function addNewRow(oTable, nRow) {
                    //   alert('new');
                    var selectHtml = '<select id="sharelist" class="form-control input-small select2me" data-placeholder="Select..."><option value=0>Select</option>';
                    $.each(shareList, function (index, element) {
//                alert(element+index);
                        selectHtml += '<option value="' + element + '">' + element + '</option>'
                    });
                    selectHtml += '</select>';

                    var selectHtmlUser = '<select id="userlist" class="form-control input-small select2me" data-placeholder="Select..."><option value=0>Select</option>';
                    $.each(userList, function (index, element) {
//                alert(element+index);
                        selectHtmlUser += '<option value="' +index+ '">' + element + '</option>'
                    });
                    selectHtmlUser += '</select>';

                    var valid = true;
                    var aData = oTable.fnGetData(nRow);
                    var jqInputs = $('input', nRow);
                    var jqSelect = $('select', nRow);
                    var pid = $('#portfolio_editable').attr("portfolio_id");


                    /* alert(jqSelect[0].value+'Sindex= 0');
                     alert(jqSelect[1].value+'Sindex= 1');
                     alert(jqInputs[2].value+'index= 2');
                     alert(jqInputs[3].value+'index= 3');
                     alert(jqInputs[4].value+'index= 4');
                     alert(jqInputs[5].value+'index= 5');
                     */

                    if (valid) {

                       // var irn = $("#userlist option:selected").text();
                      //  var p_id = $("#userlist option:selected").val();
                        //alert(jqSelect[0].value);

                        oTable.fnUpdate(jqSelect[0].value, nRow, 0, false);
                        oTable.fnUpdate(jqSelect[1].value, nRow, 1, false);
                        oTable.fnUpdate(jqInputs[2].value, nRow, 2, false);
                        oTable.fnUpdate(jqInputs[3].value, nRow, 3, false);
                        oTable.fnUpdate(jqInputs[4].value, nRow, 4, false);
                        oTable.fnUpdate(jqInputs[5].value, nRow, 5, false);
                        oTable.fnUpdate('<a class="edit" href="">Edit</a>', nRow, 6, false);
                        oTable.fnUpdate('<a class="delete"href="">Delete</a>', nRow, 7, false);
                        oTable.fnDraw();

                        nNew = false;

                    }

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
                            'orderable': false,
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

                //edited
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


                //edited
                table.on('click', '.delete', function (e) {
                    e.preventDefault();

                    if (confirm("Are you sure to delete this row ?") == false) {
                        return;
                    }
                    var nRow = $(this).parents('tr')[0];

                    oTable.fnDeleteRow(nRow);

                });

                //edited
                table.on('click', '.cancel', function (e) {
                    e.preventDefault();
                    if (nNew) {

                        alert('if');
                        oTable.fnDeleteRow(nEditing);
                        nNew = false;
                        nEditing = null;
                    } else {

                        alert('else');
                        restoreRow(oTable, nEditing);
                        nEditing = null;
                    }
                });

                //edited
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
                        nEditing = nRow;
                    } else if (nEditing == nRow && this.innerHTML == "Save") {
                        /* Editing this row and want to save it */
                        saveRow(oTable, nEditing);
                        nEditing = null;
                        //alert("Updated! Do not forget to do some ajax to sync with backend :)");
                    } else {
                        /* No edit in progress - let's start one */
                        editRow(oTable, nRow);

                        nEditing = nRow;
                    }
                });

                //edited
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
                    } else if (nEditing == nRow && this.innerHTML == "Confirm") {
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

                $("#portfolioUpdateButton").on('click', function () {

                    var dataToPass = oTable.fnGetData();

                    var dataArray =[];
                    //optionArr={"product": [{"id":1, "name":"abc"},{"name":"value"}]}
                    // var i=0;
                    $.each(dataToPass, function (index, element) {

                        var res = element[0].split("e=");
                        alert(res);
                        dataArray[index]={"irn": element[0],"itemCode": element[1],"freeQty": element[2],"UmQty": element[3],"totalQty": element[4],"avgPrice": element[5]};
                       // dataArray[index][0]=element[0];
                      //   dataArray[index,0]=element[1];
                      //   dataArray[index,1]=element[2];
                       //  dataArray[index]['UmQty']=element[3];
                       //  dataArray[index]['totalQty']=element[4];
                        // dataArray[index]['avgPrice']=element[5];

                    });


                   var ajaxUrl='<?php echo Router::url('/', true)?>Portfolios/portfolio_update_script_manually';

                     $.ajax({
                     type: "POST",
                     url: ajaxUrl,
                     data: {shareData: dataArray}

                     })
                     .done(function (msg) {

                     // var res = msg.split(":");


                     });
                });

            }
            return {

                //main function to initiate the module
                init: function () {
                    // handleTable();
                },
                initPortfolioEdit: function (sharelist,userlist) {
                    handleTable(sharelist,userlist);
                }

            };

        }();


        PortfolioTableEditable.initPortfolioEdit(sharelist,userlist);

    });

</script>

