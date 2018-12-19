<!DOCTYPE html>
<!--[if IE 8]> <html lang="en" class="ie8 no-js"> <![endif]-->
<!--[if IE 9]> <html lang="en" class="ie9 no-js"> <![endif]-->
<!--[if !IE]><!-->
<!--<html lang="en" >-->
<?php echo $this->Facebook->html(); ?>
<!--<![endif]-->
<!-- BEGIN HEAD -->
<head>
    <meta charset="utf-8"/>
    <title>Metronic | Page Layouts - Blank Page</title>
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta content="width=device-width, initial-scale=1.0" name="viewport"/>
    <meta content="" name="description"/>
    <meta content="" name="author"/>
    <script>(function(w,d,u){w.readyQ=[];w.bindReadyQ=[];function p(x,y){if(x=="ready"){w.bindReadyQ.push(y);}else{w.readyQ.push(x);}};var a={ready:p,bind:p};w.$=w.jQuery=function(f){if(f===d||f===u){return a}else{p(f)}}})(window,document)</script>

    <link href="http://fonts.googleapis.com/css?family=Open+Sans:400,300,600,700&subset=all" rel="stylesheet" type="text/css"/>
    <?php

    foreach($allCss as $css)
    {
        echo $this->Html->css("$css", null, array('inline' => false));
    }
    ?>

    <?php
    //FETCHING STYLE
    echo $this->fetch('css');
    ?>

    <link rel="shortcut icon" href="favicon.ico"/>

</head>
<!-- END HEAD -->

<!-- BEGIN BODY -->
<!-- DOC: Apply "page-header-fixed-mobile" and "page-footer-fixed-mobile" class to body element to force fixed header or footer in mobile devices -->
<!-- DOC: Apply "page-sidebar-closed" class to the body and "page-sidebar-menu-closed" class to the sidebar menu element to hide the sidebar by default -->
<!-- DOC: Apply "page-sidebar-hide" class to the body to make the sidebar completely hidden on toggle -->
<!-- DOC: Apply "page-sidebar-closed-hide-logo" class to the body element to make the logo hidden on sidebar toggle -->
<!-- DOC: Apply "page-sidebar-hide" class to body element to completely hide the sidebar on sidebar toggle -->
<!-- DOC: Apply "page-sidebar-fixed" class to have fixed sidebar -->
<!-- DOC: Apply "page-footer-fixed" class to the body element to have fixed footer -->
<!-- DOC: Apply "page-sidebar-reversed" class to put the sidebar on the right side -->
<!-- DOC: Apply "page-full-width" class to the body element to have full width page without the sidebar menu -->
<body class="login">

<!-- BEGIN LOGO -->
<div class="logo">
    <a href="index.html">
        <!--<img src="../../assets/admin/layout/img/logo-big.png" alt=""/>-->
    </a>
</div>
<!-- END LOGO -->
<!-- BEGIN SIDEBAR TOGGLER BUTTON -->
<div class="menu-toggler sidebar-toggler">
</div>

<!-- BEGIN CONTENT -->
<div class="content">
    <?php

    echo $this->Session->flash('auth', array('params' => array('class' => 'alert alert-danger display-block')));
    ?>

    <?php echo $this->Session->flash('flash', array('params' => array('class' => 'alert alert-danger display-block'))); ?>

    <?php echo $this->fetch('content'); ?>
</div>

<!-- END CONTENT -->


<!-- BEGIN FOOTER -->
<!-- BEGIN COPYRIGHT -->
<div class="copyright">
    2014 &copy; StockBangladesh Ltd.
</div>
<!-- END COPYRIGHT -->

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
    echo $this->fetch('script');
}
echo $this->Html->script('assets/admin/layout/scripts/quick-sidebar.js', array('inline' => true));
echo $this->Html->script('assets/admin/layout/scripts/layout.js', array('inline' => true));
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
<!-- END FOOTER -->
