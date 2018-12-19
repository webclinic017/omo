<div class="clearfix">
<div class="row">
    <div class="col-md-12">
        <!-- BEGIN Portlet PORTLET-->
        <div class="portlet light bg-inverse">
            <div class="portlet-title">
                <div class="caption caption-md"><i class="icon-bar-chart theme-font hide"></i> <span
                        class="caption-subject theme-font bold uppercase">Data Matrix</span> <span
                        class="caption-helper">easy searching and sorting...</span></div>

            </div>

            <div class="portlet-body">
                <div class="slimScrollDiv" style="position: relative; overflow: hidden; width: auto; height: 650px;">
                    <div class="scroller" style="overflow: hidden; width: auto; height: 650px;" data-always-visible="1" data-rail-visible="1" data-rail-color="red" data-handle-color="green" data-initialized="1">

                        <table class="home_grid"  border="0" cellspacing="1" cellpadding="0"  style="height:auto; width:100%;float:left;">
                            <tr>
                                <td class="last">
                                    <div id="binding-example"></div>
                                    <div id="gridpanel"></div>
                                </td>
                            </tr>
                        </table>

                    </div><div class="slimScrollBar" style="width: 7px; position: absolute; top: 0px; opacity: 0.4; border-top-left-radius: 7px; border-top-right-radius: 7px; border-bottom-right-radius: 7px; border-bottom-left-radius: 7px; z-index: 99; right: 1px; height: 115.606936416185px; display: block; background: green;"></div><div class="slimScrollRail" style="width: 7px; height: 100%; position: absolute; top: 0px; display: block; border-top-left-radius: 7px; border-top-right-radius: 7px; border-bottom-right-radius: 7px; border-bottom-left-radius: 7px; opacity: 0.2; z-index: 90; right: 1px; background: red;"></div></div>
            </div>
        </div>
        <!-- END Portlet PORTLET-->
    </div>
</div>
</div>



<!--
<div class="row">
    <div class="col-md-12">
        <table class="home_grid"  border="0" cellspacing="1" cellpadding="0"  style="height:auto; width:100%;float:left;">
            <tr>
                <td class="last">
                    <div id="binding-example"></div>
                    <div id="gridpanel"></div>
                </td>
            </tr>
        </table>

    </div>
</div>-->

<?php $this->start('script_at_page_end'); ?>
<script src="<?php echo Router::url('/', true);?>assets/extjs/stockscreener/all-classes.php" type="text/javascript"></script>
<script src="<?php echo Router::url('/', true);?>assets/extjs/stockscreener/gridpanel.js" type="text/javascript"></script>
<?php $this->end(); ?>