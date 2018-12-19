</div>
<!-- END CONTAINER -->
<!-- BEGIN FOOTER -->
<div class="page-footer">
    <div class="page-footer-inner">
        2014 &copy; StockBangladesh Ltd.
    </div>
    <div class="page-footer-tools">
		<span class="go-top">
		<i class="fa fa-angle-up"></i>
		</span>
    </div>
</div>
<!-- END FOOTER -->
<!-- BEGIN JAVASCRIPTS(Load javascripts at bottom, this will reduce page load time) -->
<!-- BEGIN CORE PLUGINS -->
<!--[if lt IE 9]>
<script src="../../assets/global/plugins/respond.min.js"></script>
<script src="../../assets/global/plugins/excanvas.min.js"></script>
<![endif]-->
<?php
foreach($allScripts as $js)
{
//echo $this->Html->script($js);
echo $this->Html->script($js, array('inline' => true));

}
echo $this->Html->script('assets/admin/layout/scripts/layout.js', array('inline' => true));
echo $this->Html->script('assets/admin/layout/scripts/quick-sidebar.js', array('inline' => true));
echo $this->fetch('script');
$activeMenuId = strtolower($this->params['controller']).'_'.strtolower($this->params['action']);
?>
<script>(function($,d){$.each(readyQ,function(i,f){$(f)});$.each(bindReadyQ,function(i,f){$(d).bind("ready",f)})})(jQuery,document)</script>
<script>
    jQuery(document).ready(function() {

        Metronic.init(); // init metronic core components
        Layout.init(); // init current layout
        QuickSidebar.init() // init quick sidebar

        // setting activemenu css here
        var subMenuContainer = $('#<?php echo $activeMenuId; ?>');
        subMenuContainer.parents('li').each(function () {
            subMenuContainer.addClass('active');
            subMenuContainer.children('a > span.arrow').addClass('open');
        });
        subMenuContainer.parents('li').addClass('active');
        subMenuContainer.addClass('active');

        // Fetch js from view here
        <?php echo $this->fetch('script_inside_doc_ready'); ?>
    });
</script>
<!-- END JAVASCRIPTS -->

<?php echo $this->fetch('script_at_page_end'); ?>
</body>
<?php echo $this->Facebook->init(); ?>
<!-- END BODY -->
</html>