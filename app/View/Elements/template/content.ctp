<!-- BEGIN CONTAINER -->
<div class="page-container">
<!-- BEGIN SIDEBAR -->
    <?php
    // user is logged in
    if ($this->Session->read('Auth.User')) {
        echo $this->element('template/menu');
    }else {

        echo $this->element('template/menu');

    }
    ?>
<!-- END SIDEBAR -->
<!-- BEGIN CONTENT -->
<div class="page-content-wrapper">
    <div class="page-content">

        <!-- BEGIN PAGE HEADER-->
        <h3 class="page-title">
            <?php echo $pageTitleMain; ?> <span class="hidden-xs"><small><?php echo $pageTitleSmall; ?></small></span>
        </h3>

        <div class="page-bar">
            <ul class="page-breadcrumb hidden-xs">
                <li>
                    <i class="fa fa-home"></i>
                    <a href="<?php echo Router::url('/', true)?>">Home</a>
                    <i class="fa fa-angle-right"></i>
                </li>
                <li>
                    <a href="<?php echo Router::url('/', true)?><?php echo strtolower($this->params['controller']);?>/<?php echo strtolower($this->params['action']);?>"><?php echo strtolower($this->params['action']);?></a>
                </li>

            </ul>
            <div class="page-toolbar">
                <div class="tooltips btn btn-fit-height btn-sm btn-dashboard-daterange" data-container="body" data-placement="left" data-original-title="You can submit order now">


                </div>
                <div id="accepting_order" class="tooltips btn btn-fit-height btn-sm green btn-dashboard-daterange hide" data-container="body" data-placement="left" data-original-title="You can submit order now">
                    Order is accepting &nbsp;&nbsp;&nbsp;<i class="icon-check"></i>

                </div>

                <div id="not_accepting_order" class="tooltips btn btn-fit-height btn-sm red-flamingo btn-dashboard-daterange" data-container="body" data-placement="left" data-original-title="Currently we are not accepting order. Please try later">
                    Order is not accepting &nbsp;&nbsp;&nbsp;<i class="icon-close"></i>

                </div>
            </div>
        </div>
        <!-- END PAGE HEADER-->
        <!-- BEGIN PAGE CONTENT-->
        <div class="row">
            <div class="col-md-12">
                <div class="page-content-body">
                    <!-- HERE WILL BE LOADED AN AJAX CONTENT -->
                    <?php echo $this->Session->flash('flash', array('element' => 'flashmsg'));; ?>


                    <?php echo $this->fetch('content'); ?>
                </div>

            </div>
        </div>
        <!-- END PAGE CONTENT-->
    </div>
</div>
<!-- END CONTENT -->
<!-- BEGIN QUICK SIDEBAR -->
<!--Cooming Soon...-->
<!-- END QUICK SIDEBAR -->
