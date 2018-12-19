<style>
    .Highlighted a{
        background-color : Green !important;
        background-image :none !important;
        color: White !important;
        font-weight:bold !important;
        font-size: 12pt;
    }
</style>


<button type="button" id="updateall" class="btn blue">Update All</button>
<div class="clearfix"></div>
<div class="row ">
    <div class="col-md-12 col-sm-12">
        <!-- BEGIN PORTLET-->
        <div class="portlet light calendar">
            <div class="portlet-title">
                <div class="caption">
                    <i class="fa fa-calendar"></i>Calendar
                </div>
            </div>
            <div class="portlet-body">
                <!--<ul id="demos-list">
                    <li class="demo full-row">
                        <h3>Full year</h3>
                        <div id="full-year" class="box"></div>

                    </li>

                </ul>-->
                <div id="full-year" class="box"></div>
                <button class="btn popovers" data-container="body" data-trigger="hover" data-placement="top" data-content="Popover body goes here! Popover body goes here!" data-original-title="Popover in top">Top</button>
            </div>
        </div>
        <!-- END PORTLET-->
    </div>

</div>

<script type="text/javascript">



    $(function () {



        var eventDate= <?php echo $eventDate;?>;
        var SelectedDates = {};
        var SeletedText = {};


        $.each(eventDate, function(key, value) {

            SelectedDates[new Date(key)] = new Date(key);
            SeletedText[new Date(key)] = value;
        });

        var today = new Date();
        var y = today.getFullYear();

        $('#full-year').datepicker({
            numberOfMonths: [6,2],
            defaultDate: '1/1/'+y,
            beforeShowDay: function(date) {
                var Highlight = SelectedDates[date];
                var HighlighText = SeletedText[date];
                if (Highlight) {
                    return [true, "Highlighted", HighlighText];
                }
                else {
                    return [true, '', ''];
                }
            }
        });




        $("#updateall").on("click", function () {
          //  alert(1);
            $('#full-year').datepicker("destroy");
        });



    });
</script>


