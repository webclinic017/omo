<!DOCTYPE html>
<!--[if IE 8]> <html lang="en" class="ie8 no-js"> <![endif]-->
<!--[if IE 9]> <html lang="en" class="ie9 no-js"> <![endif]-->
<!--[if !IE]><!--> <html lang="en" class="no-js"> <!--<![endif]-->
<!-- BEGIN HEAD -->
<head>
    <meta charset="utf-8" />
    <title>Metronic | Layouts - Content Loading via Ajax</title>
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta content="width=device-width, initial-scale=1.0" name="viewport" />
    <meta content="" name="description" />
    <meta content="" name="author" />
    <meta name="MobileOptimized" content="320">
    <!-- BEGIN GLOBAL MANDATORY STYLES -->
    <?php
    echo $this->element('css_element/global2');
    echo $this->element('css_element/pagelevel2');
    echo $this->element('css_element/theme2');

    /**
    ADDING DIRECTLY A CSS FROM VIEW TO DEFAULT LAYOUT CSS BLOCK. NO ECHO NEEDED. INLINE FALSE MUST BE SET.
    */

    $this->Html->css('assets/css/style-metronic', null, array('inline' => false));
    $this->Html->css('assets/css/pages/coming-soon', null, array('inline' => false));
    $this->Html->css('assets/plugins/bootstrap-modal/css/bootstrap-modal-bs3patch', null, array('inline' => false));
    $this->Html->css('assets/plugins/bootstrap-modal/css/bootstrap-modal', null, array('inline' => false));
    $this->Html->css('assets/plugins/bootstrap-markdown/css/bootstrap-markdown.min', null, array('inline' => false));

    ?>

    <link rel="shortcut icon" href="favicon.ico" />
    <?php
    echo $this->fetch('meta');
    echo $this->fetch('css');
    ?>
</head>
<!-- BEGIN BODY -->
<body class="page-footer-fixed">

<!-- BEGIN HEADER -->
<div class="header navbar navbar-inverse navbar-static-top">
<!-- BEGIN TOP NAVIGATION BAR -->
    <?php
    echo $this->element('layout_element/top_navigation_bar');
    ?>
<!-- END TOP NAVIGATION BAR -->
</div>
<!-- END HEADER -->
<div class="clearfix"></div>
<!-- BEGIN CONTAINER -->
<div class="page-container">
    <!-- BEGIN SAMPLE PORTLET CONFIGURATION MODAL FORM-->
    <div class="modal fade" id="portlet-config" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true"></button>
                    <h4 class="modal-title">Modal title</h4>
                </div>
                <div class="modal-body">
                    Widget settings form goes here
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn blue">Save changes</button>
                    <button type="button" class="btn default" data-dismiss="modal">Close</button>
                </div>
            </div>
            <!-- /.modal-content -->
        </div>
        <!-- /.modal-dialog -->
    </div>
    <!-- /.modal -->
    <!-- END SAMPLE PORTLET CONFIGURATION MODAL FORM-->

    <!-- BEGIN SIDEBAR1 -->
    <?php
    echo $this->element('layout_element/side_bar');
    ?>
    <!-- END SIDEBAR1 -->
    <!-- BEGIN PAGE -->
    <div class="page-content">
        <!-- BEGIN STYLE CUSTOMIZER -->
        <div class="theme-panel hidden-xs hidden-sm">
            <div class="toggler"></div>
            <div class="toggler-close"></div>
            <div class="theme-options">
                <div class="theme-option theme-colors clearfix">
                    <span>THEME COLOR</span>
                    <ul>
                        <li class="color-black current color-default" data-style="default"></li>
                        <li class="color-blue" data-style="blue"></li>
                        <li class="color-brown" data-style="brown"></li>
                        <li class="color-purple" data-style="purple"></li>
                        <li class="color-grey" data-style="grey"></li>
                        <li class="color-white color-light" data-style="light"></li>
                    </ul>
                </div>
                <div class="theme-option">
                    <span>Layout</span>
                    <select class="layout-option form-control input-small">
                        <option value="fluid" selected="selected">Fluid</option>
                        <option value="boxed">Boxed</option>
                    </select>
                </div>
                <div class="theme-option">
                    <span>Header</span>
                    <select class="header-option form-control input-small">
                        <option value="fixed" selected="selected">Fixed</option>
                        <option value="default">Default</option>
                    </select>
                </div>
                <div class="theme-option">
                    <span>Sidebar</span>
                    <select class="sidebar-option form-control input-small">
                        <option value="fixed">Fixed</option>
                        <option value="default" selected="selected">Default</option>
                    </select>
                </div>
                <div class="theme-option">
                    <span>Footer</span>
                    <select class="footer-option form-control input-small">
                        <option value="fixed">Fixed</option>
                        <option value="default" selected="selected">Default</option>
                    </select>
                </div>
            </div>
        </div>
        <!-- END BEGIN STYLE CUSTOMIZER -->

        <div class="page-content-body">
            <?php echo $this->Session->flash(); ?>

            <?php echo $this->fetch('content'); ?>
            <!-- HERE WILL BE LOADED AN AJAX CONTENT -->
        </div>

    </div>
    <!-- BEGIN PAGE -->
</div>
<!-- END CONTAINER -->

<!-- BEGIN FOOTER -->
<div class="footer">
    <div class="footer-inner">
        2013 &copy; Metronic by keenthemes.
    </div>
    <div class="footer-tools">
			<span class="go-top">
			<i class="fa fa-angle-up"></i>
			</span>
    </div>
</div>
<!-- END FOOTER -->


<!-- BEGIN JAVASCRIPTS(Load javascripts at bottom, this will reduce page load time) -->
<!-- BEGIN CORE PLUGINS -->
<!--[if lt IE 9]>
<?php
echo $this->Html->script('assets/plugins/respond.min.js');
echo $this->Html->script('assets/plugins/excanvas.min.js');
?>
<![endif]-->
<?php

echo $this->element('script_element/core_script2');

/**
ADDING DIRECTLY PAGE LEVEL SCRIPT FROM VIEW TO DEFAULT LAYOUT SCRIPT BLOCK. NO ECHO NEEDED. INLINE FALSE MUST BE SET.
*/

$this->Html->script('assets/plugins/select2/select2.min.js',array('inline' => false));
$this->Html->script('assets/plugins/bootstrap/js/bootstrap2-typeahead.min.js',array('inline' => false));
$this->Html->script('assets/plugins/countdown/jquery.countdown.js',array('inline' => false));

$this->Html->script('assets/plugins/bootstrap-modal/js/bootstrap-modalmanager.js',array('inline' => false));
$this->Html->script('assets/plugins/bootstrap-modal/js/bootstrap-modal.js',array('inline' => false));

$this->Html->script('assets/plugins/jquery-validation/dist/jquery.validate.min.js',array('inline' => false));
$this->Html->script('assets/plugins/bootstrap-markdown/js/bootstrap-markdown.js',array('inline' => false));

$this->Html->script('assets/scripts/custom/jquery.vticker.min.js',array('inline' => false));
$this->Html->script('assets/scripts/core/app.js',array('inline' => false));
$this->Html->script('assets/scripts/custom/custom.js',array('inline' => false));

?>

<!-- END CORE PLUGINS -->
<?php

echo $this->fetch('script');
?>
<script>
    jQuery(document).ready(function() {
        App.init();
      //  Index.init();
        //Index.initCalendar(); // init index page's custom scripts
        $('.page-sidebar .ajaxify.start').click() // load the content for the dashboard page.
    });
</script>
<!-- END JAVASCRIPTS -->
<script>
    $(document).ready(function(){
        $.ajax({
            dataType: "html",
            type: "POST",
            evalScripts: true,
            url: "<?php echo Router::url(array('controller'=>'fundamentals','action'=>'index'));?>",
            data: ({dutylocation:'dloc',dutytype:'dtype'}),
            success: function (data, textStatus){
                $("#UserInfoDiv").html(data);

            }
        });

    });
</script>

</body>
<!-- END BODY -->
</html>

