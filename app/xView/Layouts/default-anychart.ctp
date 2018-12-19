<!DOCTYPE html>
<!--[if IE 8]>
<html lang="en" class="ie8 no-js"> <![endif]-->
<!--[if IE 9]>
<html lang="en" class="ie9 no-js"> <![endif]-->
<!--[if !IE]><!-->
<html lang="en" class="no-js"> <!--<![endif]-->
<!-- BEGIN HEAD -->
<head>
    <meta charset="utf-8"/>
    <title>Metronic | Layouts - Content Loading via Ajax</title>
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta content="width=device-width, initial-scale=1.0" name="viewport"/>
    <meta content="" name="description"/>
    <meta content="" name="author"/>
    <meta name="MobileOptimized" content="320">
    <link rel="shortcut icon" href="favicon.ico"/>

    <?php
    echo $this->fetch('meta');
    echo $this->fetch('css');
    ?>

</head>
<!-- BEGIN BODY -->
<body class="page-footer-fixed">
<!--
<div id="preloader">
    <div id="status">&lt;!&ndash;<i class="fa fa-spinner fa-spin">&ndash;&gt;</i><img style="" src="<?php echo Router::url('/', true);?>/assets/img/loading-spinner-grey.gif" align=""></div>
</div>
-->

<!-- BEGIN HEADER -->
<div class="header navbar navbar-inverse navbar-static-top">

    <!-- BEGIN TOP NAVIGATION BAR -->
    <div class="navbar-inner">
        <div class="container-fluid">
            <!-- BEGIN LOGO -->
            <?php
            echo $this->Html->link(
            $this->Html->image('assets/img/logo.gif', array('alt' => 'logo', 'border' => '0', 'class' =>
            'img-responsive')),
            '/',
            array('class' => 'navbar-brand', 'escape' => false)
            );
            ?>
            <!-- END LOGO -->
            <!-- BEGIN COUNTDOWN BLOCK -->
            <?php echo $this->fetch('countdown'); ?>

            <!-- END COUNTDOWN BLOCK -->
            <!-- BEGIN TOP NAVIGATION MENU -->
            <ul class="nav navbar-nav pull-right">
                <!-- BEGIN UNREGISTER PANEL BUTTON -->
                <?php //echo $this->fetch('unregistered'); ?>
                <!-- END UNREGISTER PANEL BUTTON -->


                <!-- BEGIN REGISTER PANEL BUTTON -->
                <?php //echo $this->fetch('registered'); ?>
                <!-- END REGISTER PANEL BUTTON -->
            </ul>
            <!-- END TOP NAVIGATION MENU -->
        </div>
    </div>


    <!-- END TOP NAVIGATION BAR -->
</div>
<!-- END HEADER -->
<div class="clearfix"></div>
<!-- BEGIN CONTAINER -->
<div class="page-container">
    <!-- BEGIN SAMPLE PORTLET CONFIGURATION MODAL FORM-->
    <div class="modal fade" id="portlet-config" tabindex="-1" role="dialog" aria-labelledby="myModalLabel"
         aria-hidden="true">
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

    <!-- FEEDBACK MODAL HERE STARTS -->
    <div class="row">

            <div id="responsive" class="modal fade" tabindex="-1" data-width="500">
                <!-- <div class="modal-header">
                     <button type="button" class="close" data-dismiss="modal" aria-hidden="true"></button>
                     <h4 class="modal-title">Responsive Sohail</h4>
                 </div>-->
                <div class="modal-body">
                    <form id="target" action="#" class="form-horizontal">
                        <div class="alert alert-danger display-hide">
                            <button class="close" data-close="alert"></button>
			<span>
				 Please enter required information
			</span>
                        </div>
                        <div class="form-body">
                            <div class="form-group">
                                <label class="control-label visible-ie8 visible-ie9">Name</label>

                                <div class="input-icon">
                                    <i class="fa fa-font"></i>
                                    <input class="form-control placeholder-no-fix" placeholder="Full Name"
                                           name="data[Feedback][feedback_user_name]" type="text" required />
                                </div>
                            </div>
                            <div class="form-group">
                                <!--<label class="control-label col-md-3">Suggestion</label>-->
                                <div>
                                    <div class="input-icon">
                                        <i class="fa fa-font"></i>
                                        <textarea name="data[Feedback][feedback]" placeholder="Your suggestions pls"
                                                  data-provide="markdown" rows="3" type="text" required></textarea>
                                    </div>
                                </div>

                            </div>
                            <div class="form-group">
                                <label class="control-label visible-ie8 visible-ie9">Email Address</label>

                                <div>
                                    <div class="input-icon">
                                        <i class="fa fa-envelope"></i>
                                        <input type="email" name="data[Feedback][feedback_user_email]"
                                               class="form-control" placeholder="Email Address" required>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="control-label visible-ie8 visible-ie9">Contact No.</label>

                                <div>
                                    <div class="input-icon">
                                        <i class="fa fa-phone"></i>
                                        <input type="number" name="data[Feedback][feeback_user_contact]"
                                               class="form-control" placeholder="Contact No">
                                    </div>
                                </div>
                            </div>
                            <input type="hidden" class="toolsinput" id="toolsin" name="data[Feedback][apps_code]">
                        </div>
                        <div class="modal-footer">
                            <button type="button" data-dismiss="modal" class="btn btn-default pull-right">Close</button>
                            <button type="submit" data-loading-text="Sending your feed back. Please wait" class="demo-loading-btn btn blue pull-right">
                                Send Feedback <i class="m-icon-swapright m-icon-white"></i>
                            </button>
                            <!--<button type="button" data-loading-text="Loading..." class="demo-loading-btn btn btn-primary">
                                Loading state </button>-->
                        </div>

                    </form>


                </div>
                <!-- <div class="modal-footer">
                     <button type="button" data-dismiss="modal" class="btn btn-default">Close</button>
                     <button id="send" class="btn blue">Send <i class="m-icon-swapright m-icon-white"></i></button>
                 </div>-->
            </div>

    </div>
    <!-- FEEDBACK MODAL HERE ENDS -->


    <!-- BEGIN SIDEBAR1 -->
    <?php echo $this->fetch('side_bar2'); ?>
    <!-- END SIDEBAR1 -->
    <!-- BEGIN PAGE -->
    <div class="page-content">
        <!-- BEGIN STYLE CUSTOMIZER -->
        <div class="theme-panel hidden-xs hidden-sm">
            <div class="toggler"></div>
            <div class="toggler-close"></div>
            <div class="theme-options">


                <div class="theme-option">
                    <span>Share</span>
                    <select class="form-control input-small select2me" data-placeholder="Select...">
                        <option value=""></option>
                        <option value="AL">Alabama</option>
                        <option value="WY">Wyoming</option>
                    </select>
                </div>
                <div class="theme-option theme-colors clearfix">

                    <ul>
                        <!--<li class="color-black current color-default" data-style="default"></li>
                        <li class="color-blue" data-style="blue"></li>
                        <li class="color-brown" data-style="brown"></li>
                        <li class="color-purple" data-style="purple"></li>
                        <li class="color-grey" data-style="grey"></li>
                        <li class="color-white color-light" data-style="light"></li>-->
                        <a href="#" class="btn btn-sm red">FA Chart <!--<i class="fa fa-edit"></i>--></a>
                        <a href="#" class="btn btn-sm blue"><!--<i class="fa fa-file-o"></i>--> TA Chart</a>
                        <a href="#" class="btn btn-sm green">Min Chart<!-- <i class="fa fa-font"></i>--></a>
                    </ul>
                </div>
            </div>
        </div>
        <!-- END BEGIN STYLE CUSTOMIZER -->

        <div class="page-content-body">
            <div class="row">
                <div class="col-md-12">
                    <?php echo $this->Session->flash(); ?>

                    <?php echo $this->fetch('content'); ?>
                    <!-- HERE WILL BE LOADED AN AJAX CONTENT -->
                </div>
        </div>
        </div>

    </div>
    <!-- BEGIN PAGE -->
</div>
<!-- END CONTAINER -->

<!-- BEGIN FOOTER -->
<div class="footer">
    <div class="footer-inner">
        2014 &copy; Stock Bangladesh Ltd.
    </div>
    <div class="footer-tools">
			<span class="go-top">
			<i class="fa fa-angle-up"></i>
			</span>
    </div>
</div>
<!-- END FOOTER -->


<!-- BEGIN JAVASCRIPTS(Load javascripts at bottom, this will reduce page load time) -->
<!--[if lt IE 9]>
<?php
echo $this->Html->script('assets/plugins/respond.min.js');
echo $this->Html->script('assets/plugins/excanvas.min.js');
?>
<![endif]-->
<?php echo $this->fetch('script'); ?>

<!-- START SCRIPT FROM VIEW -->
<?php echo $this->fetch('view_script'); ?>

<!-- END SCRIPT FROM VIEW -->

<script>
   /* jQuery(window).load(function() {

        // Page Preloader
        jQuery('#status').fadeOut();
        jQuery('#preloader').delay(350).fadeOut(function(){
            jQuery('body').delay(350).css({'overflow':'visible'});
        });
    });*/
    var subMenuContainer = $('#<?php echo $activeMenuId; ?>');
    subMenuContainer.parents('li').each(function () {
        subMenuContainer.addClass('active');
        subMenuContainer.children('a > span.arrow').addClass('open');
    });
    subMenuContainer.parents('li').addClass('active');
</script>

<!-- END JAVASCRIPTS -->

</body>
<!-- END BODY -->
</html>

