<!-- BEGIN SAMPLE PORTLET CONFIGURATION MODAL FORM-->
<div class="modal fade" data-width="200" id="share_select" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true"></button>
                <h4 class="modal-title">Change Share</h4>
            </div>
            <div class="modal-body">
                <div class="form-group">
                    <?php echo $this->
                        StockBangladesh->getInstrumentBootstrapSelect2($instrumentList, 'shareList');
                    ?>

                </div>
            </div>
            <div class="modal-footer">
                <button type="button" id="button1" class="btn blue">Save changes</button>
                <button type="button" class="btn default" data-dismiss="modal">Close</button>
            </div>
        </div>
        <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
</div>
<!-- /.modal -->
<!-- END SAMPLE PORTLET CONFIGURATION MODAL FORM-->


<div class="row" id="sortable_portlets">
<div class="col-md-4 column sortable">
    <!-- BEGIN Portlet PORTLET-->
    <div class="portlet portlet-sortable" id="box1">
        <div class="portlet-title">
            <div class="caption font-green-sharp">
                <i class="icon-pin font-green-sharp"></i>
                <span class="caption-subject uppercase"> <?php echo $chartData['title']; ?></span>
                <!--<span class="caption-helper">details...</span>-->
            </div>
            <div class="tools">
                <a href="" class="collapse">
                </a>
                <a href="#"
                   data-url="<?php echo Router::url(array('controller' => 'instruments', 'action' => 'market_monitor_chart')); ?>"
                   class="reload"></a>
                <a href="#share_select" data-toggle="modal" class="config">
                </a>
                <a href="" class="remove">
                </a>
            </div>
        </div>
        <div style="display: block;" class="portlet-body">

            <?php echo $this->requestAction("instruments/market_monitor_chart/79", array("return")); ?>
        </div>
    </div>
    <!-- END Portlet PORTLET-->
    <!-- BEGIN Portlet PORTLET-->
    <div class="portlet portlet-sortable bg-inverse" id="box2">
        <div class="portlet-title">
            <div class="caption font-green-sharp">
                <i class="icon-pin font-green-sharp"></i>
                <span class="caption-subject uppercase"> <?php echo $chartData['title']; ?></span>
                <!--<span class="caption-helper">details...</span>-->
            </div>
            <div class="tools">
                <a href="" class="collapse">
                </a>
                <a href="#"
                   data-url="<?php echo Router::url(array('controller' => 'instruments', 'action' => 'market_monitor_chart')); ?>"
                   class="reload"></a>
                <a href="#share_select" data-toggle="modal" class="config">
                </a>
                <a href="" class="remove">
                </a>
            </div>
        </div>
        <div style="display: block;" class="portlet-body">
            <?php echo $this->requestAction("instruments/market_monitor_chart/12", array("return")); ?>
        </div>
    </div>
    <!-- END Portlet PORTLET-->
    <!-- BEGIN Portlet PORTLET-->
    <div class="portlet portlet-sortable  bg-inverse" id="box3">
        <div class="portlet-title">
            <div class="caption font-green-sharp">
                <i class="icon-pin font-green-sharp"></i>
                <span class="caption-subject uppercase"> <?php echo $chartData['title']; ?></span>
                <!--<span class="caption-helper">details...</span>-->
            </div>
            <div class="tools">
                <a href="" class="collapse">
                </a>
                <a href="#"
                   data-url="<?php echo Router::url(array('controller' => 'instruments', 'action' => 'market_monitor_chart')); ?>"
                   class="reload"></a>
                </a>
                <a href="#share_select" data-toggle="modal" class="config">
                </a>
                <a href="" class="remove">
                </a>
            </div>
        </div>
        <div style="display: block;" class="portlet-body">
            <?php echo $this->requestAction("instruments/market_monitor_chart/78", array("return")); ?>
        </div>
    </div>
    <!-- END Portlet PORTLET-->

</div>
<div class="col-md-4 column sortable">
    <!-- BEGIN Portlet PORTLET-->
    <div class="portlet portlet-sortable  bg-inverse" id="box4">
        <div class="portlet-title">
            <div class="caption font-green-sharp">
                <i class="icon-pin font-green-sharp"></i>
                <span class="caption-subject uppercase"> <?php echo $chartData['title']; ?></span>
                <!--<span class="caption-helper">details...</span>-->
            </div>
            <div class="tools">
                <a href="" class="collapse">
                </a>
                <a href="#"
                   data-url="<?php echo Router::url(array('controller' => 'instruments', 'action' => 'market_monitor_chart')); ?>"
                   class="reload"></a>
                <a href="#share_select" data-toggle="modal" class="config">
                </a>
                <a href="" class="remove">
                </a>
            </div>
        </div>
        <div style="display: block;" class="portlet-body">
            <?php echo $this->requestAction("instruments/market_monitor_chart/12", array("return")); ?>
        </div>
    </div>
    <!-- END Portlet PORTLET-->
    <!-- BEGIN Portlet PORTLET-->
    <div class="portlet portlet-sortable  bg-inverse" id="box5">
        <div class="portlet-title">
            <div class="caption font-green-sharp">
                <i class="icon-pin font-green-sharp"></i>
                <span class="caption-subject uppercase"> <?php echo $chartData['title']; ?></span>
                <!--<span class="caption-helper">details...</span>-->
            </div>
            <div class="tools">
                <a href="" class="collapse">
                </a>
                <a href="#"
                   data-url="<?php echo Router::url(array('controller' => 'instruments', 'action' => 'market_monitor_chart')); ?>"
                   class="reload"></a>
                <a href="#share_select" data-toggle="modal" class="config">
                </a>
                <a href="" class="remove">
                </a>
            </div>
        </div>
        <div style="display: block;" class="portlet-body">
            <?php echo $this->requestAction("instruments/market_monitor_chart/12", array("return")); ?>
        </div>
    </div>
    <!-- END Portlet PORTLET-->
    <!-- BEGIN Portlet PORTLET-->
    <div class="portlet portlet-sortable  bg-inverse" id="box6">
        <div class="portlet-title">
            <div class="caption font-green-sharp">
                <i class="icon-pin font-green-sharp"></i>
                <span class="caption-subject uppercase"> <?php echo $chartData['title']; ?></span>
                <!--<span class="caption-helper">details...</span>-->
            </div>
            <div class="tools">
                <a href="" class="collapse">
                </a>
                <a href="#"
                   data-url="<?php echo Router::url(array('controller' => 'instruments', 'action' => 'market_monitor_chart')); ?>"
                   class="reload"></a>
                <a href="#share_select" data-toggle="modal" class="config">
                </a>
                <a href="" class="remove">
                </a>
            </div>
        </div>
        <div style="display: block;" class="portlet-body">
            <?php echo $this->requestAction("instruments/market_monitor_chart/12", array("return")); ?>
        </div>
    </div>
    <!-- END Portlet PORTLET-->

</div>
<div class="col-md-4 column sortable">
    <!-- BEGIN Portlet PORTLET-->
    <div class="portlet portlet-sortable  bg-inverse" id="box7">
        <div class="portlet-title">
            <div class="caption font-green-sharp">
                <i class="icon-pin font-green-sharp"></i>
                <span class="caption-subject uppercase"> <?php echo $chartData['title']; ?></span>
                <!--<span class="caption-helper">details...</span>-->
            </div>
            <div class="tools">
                <a href="" class="collapse">
                </a>
                <a href="#"
                   data-url="<?php echo Router::url(array('controller' => 'instruments', 'action' => 'market_monitor_chart')); ?>"
                   class="reload"></a>
                <a href="#share_select" data-toggle="modal" class="config">
                </a>
                <a href="" class="remove">
                </a>
            </div>
        </div>
        <div style="display: block;" class="portlet-body">
            <?php echo $this->requestAction("instruments/market_monitor_chart/12", array("return")); ?>
        </div>
    </div>
    <!-- END Portlet PORTLET-->
    <!-- BEGIN Portlet PORTLET-->
    <div class="portlet portlet-sortable  bg-inverse" id="box8">
        <div class="portlet-title">
            <div class="caption font-green-sharp">
                <i class="icon-pin font-green-sharp"></i>
                <span class="caption-subject uppercase"> <?php echo $chartData['title']; ?></span>
                <!--<span class="caption-helper">details...</span>-->
            </div>
            <div class="tools">
                <a href="" class="collapse">
                </a>
                <a href="#"
                   data-url="<?php echo Router::url(array('controller' => 'instruments', 'action' => 'market_monitor_chart')); ?>"
                   class="reload"></a>
                <a href="#share_select" data-toggle="modal" class="config">
                </a>
                <a href="" class="remove">
                </a>
            </div>
        </div>
        <div style="display: block;" class="portlet-body">
            <?php echo $this->requestAction("instruments/market_monitor_chart/12", array("return")); ?>
        </div>
    </div>
    <!-- END Portlet PORTLET-->
    <!-- BEGIN Portlet PORTLET-->
    <div class="portlet portlet-sortable  bg-inverse" id="box9">
        <div class="portlet-title">
            <div class="caption font-green-sharp">
                <i class="icon-pin font-green-sharp"></i>
                <span class="caption-subject uppercase"> <?php echo $chartData['title']; ?></span>
                <!--<span class="caption-helper">details...</span>-->
            </div>
            <div class="tools">
                <a href="" class="collapse">
                </a>
                <a href="#"
                   data-url="<?php echo Router::url(array('controller' => 'instruments', 'action' => 'market_monitor_chart')); ?>"
                   class="reload"></a>
                <a href="#share_select" data-toggle="modal" class="config">
                </a>
                <a href="" class="remove">
                </a>
            </div>
        </div>
        <div style="display: block;" class="portlet-body">
            <?php echo $this->requestAction("instruments/market_monitor_chart/12", array("return")); ?>
        </div>
    </div>
    <!-- END Portlet PORTLET-->

</div>
<div class="col-md-4 column sortable" style="margin-bottom:20px;">
</div>

<div>
    <button type="button" id="updateall" class="btn blue">Update All</button>

</div>
<span id="compositebar">4,6,7,7,9,3,2,1,4</span>
<?php echo $this->element('hchart/market_monitor_template', array('chartData' => $chartData)); ?>


<?php $this->start('script_inside_doc_ready'); ?>
$('.bs-select').selectpicker({
iconBase: 'fa',
tickIcon: 'fa-check'
});
PortletDraggable.init();

$('#compositebar').sparkline([40,6,7,7,90,3,2,1,4], { type: 'bar', barColor: '#aaf' });
$('#compositebar').sparkline([4,6,7,7,9,3,2,1,4],{ composite: true, fillColor: false, lineColor: 'red' });



<?php $this->end(); ?>

<script>

    $(function () {


        var elf = jQuery('body').on('click', '.portlet > .portlet-title > .tools > a.config', function (e) {

            var box = jQuery(this).parents(".portlet").attr("id");
            //   alert(removable);
            ///  alert(box);

            $("#button1")
                .on("click", function () {

                    if ($('#shareList').val() == "") {
                        sharelist = "null";
                    } else {
                        sharelist = $('#shareList').val();
                    }
                    var boxname = '#' + box + ' .portlet-title .reload';
                    $(boxname).attr("data-url", "<?php echo Router::url(array('controller'=>'instruments','action'=>'market_monitor_chart'));?>/" + sharelist); // change URL
                    $(boxname).click(); // trigger click event and reload content


                    $('#button1').unbind('click');  // unbind it or it will update all box done before (remember history)

                })


        });

        $("#updateall").on("click", function () {
            $(".portlet > .portlet-title > .tools > a.reload").each(function (index, element) {
                $(this).click();
            });
        });

        function autoUpdate() {
            $(".portlet > .portlet-title > .tools > a.reload").each(function (index, element) {
                $(this).click();
            });
        }

        var refreshId = setInterval(autoUpdate, 60000);


    });

</script>
