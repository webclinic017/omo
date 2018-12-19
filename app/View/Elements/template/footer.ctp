<!-- BEGIN FOOTER -->
<div class="page-footer">
    <div class="page-footer-inner">
        <?php echo date('Y');?> &copy; StockBangladesh Ltd.
    </div>
    <div class="scroll-to-top">
        <i class="icon-arrow-up"></i>
    </div>
</div>
<!-- END FOOTER -->
</div>



<!-- BEGIN JAVASCRIPTS(Load javascripts at bottom, this will reduce page load time) -->
<!-- BEGIN CORE PLUGINS -->
<!--[if lt IE 9]>
    <?php echo $this->Html->script('assets/global/plugins/respond.min.js', array('inline' => true));?>
    <?php echo $this->Html->script('assets/global/plugins/excanvas.min.js', array('inline' => true));?>
<![endif]-->
<?php
$activeMenuId = strtolower($this->params['controller']) . '_' . strtolower($this->params['action']);
if(!$js_asset_compression_enable) {
    foreach ($allScripts as $js) {
        echo $this->Html->script($js, array('inline' => true));
    }
    echo $this->Html->script('assets/admin/layout2/scripts/layout.js', array('inline' => true));
    echo $this->Html->script('assets/admin/layout2/scripts/demo.js', array('inline' => true));
    echo $this->Html->script('assets/admin/pages/scripts/login.js', array('inline' => true));

}else {
    $activeMenuId = strtolower($this->params['controller']) . '_' . strtolower($this->params['action']);
    echo $this->AssetCompress->script('global');
    echo $this->AssetCompress->script($activeMenuId);
}



echo $this->fetch('script');

?>

<script>(function($,d){$.each(readyQ,function(i,f){$(f)});$.each(bindReadyQ,function(i,f){$(d).bind("ready",f)})})(jQuery,document)</script>
<script>
    jQuery(document).ready(function() {

        Metronic.init(); // init metronic core components
        Layout.init(); // init current layout
        Demo.init();
        $('.page-sidebar .ajaxify.start').click()
        // setting activemenu css here
        var subMenuContainer = $('#<?php echo $activeMenuId; ?>');
        subMenuContainer.parents('li').each(function () {
            subMenuContainer.addClass('active');
            subMenuContainer.children('a > span.arrow').addClass('open');
        });
        subMenuContainer.parents('li').addClass('active');
        subMenuContainer.addClass('active');
        $('#flipcountdownbox1').flipcountdown({size:'xs',am:true});
        // Fetch js from view here
        <?php echo $this->fetch('script_inside_doc_ready'); ?>
    });
</script>

<!-- END JAVASCRIPTS -->

<?php echo $this->fetch('script_at_page_end'); ?>
</body>
<?php //echo $this->Facebook->init(); ?>
<!-- END BODY -->
</html>