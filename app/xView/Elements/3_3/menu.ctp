<!-- BEGIN MEGA MENU -->
<!-- DOC: Apply "hor-menu-light" class after the "hor-menu" class below to have a horizontal menu with white background -->
<!-- DOC: Remove data-hover="dropdown" and data-close-others="true" attributes below to disable the dropdown opening on mouse hover -->
<div class="hor-menu ">
<ul class="nav navbar-nav">
<li>
    <a href="<?php echo Router::url(array('controller' => 'users', 'action' => 'home')); ?>"><i class="icon-home"></i>
        Dashboard</a>
</li>



<li class="menu-dropdown mega-menu-dropdown mega-menu-full ">
<a data-hover="megamenu-dropdown" data-close-others="true" data-toggle="dropdown" href="javascript:;"
   class="dropdown-toggle">
    Markets <i class="fa fa-angle-down"></i>
</a>

<ul class="dropdown-menu">
<li>
<div class="mega-menu-content">
<div class="row">
<div class="col-md-3">
    <ul class="mega-menu-submenu">
        <li>
            <h3>Today Markets</h3>
        </li>
        <li>
            <a href="<?php echo Router::url(array('controller' => 'markets', 'action' => 'home')); ?>">
                <i class="fa fa-angle-right"></i>
                Market Home </a>
        </li>
        <li>
            <a href="<?php echo Router::url(array('controller' => 'instruments', 'action' => 'market_monitor')); ?>">
                <i class="fa fa-angle-right"></i>
                Market Monitor </a>
        </li>
        <li>
            <a href="<?php echo Router::url(array('controller' => 'markets', 'action' => 'market_composition')); ?>">
                <i class="fa fa-angle-right"></i>
                Markets Composition </a>
        </li>

    </ul>
</div>
<div class="col-md-3">
    <ul class="mega-menu-submenu">
        <li>
            <h3>Company</h3>
        </li>
        <li>
            <a href="<?php echo Router::url(array('controller' => 'instruments', 'action' => 'details')); ?>">
                <i class="fa fa-angle-right"></i>
                Company details </a>
        </li>
        <li>
            <a href="<?php echo Router::url(array('controller' => 'instruments', 'action' => 'market_depth_monitor')); ?>">
                <i class="fa fa-angle-right"></i>
                Market Depth Monitor <span class="badge badge-roundless badge-danger">new</span></a>
        </li>
        <li>
            <a href="<?php echo Router::url(array('controller' => 'instruments', 'action' => 'data_matrix')); ?>">
                <i class="fa fa-angle-right"></i>
                Data Matrix </a>
        </li>

    </ul>
</div>
<div class="col-md-3">
    <ul class="mega-menu-submenu">
        <li>
            <h3>Chart</h3>
        </li>
        <li>
            <a href="<?php echo Router::url(array('controller' => 'TechnicalAnalysis', 'action' => 'chart')); ?>">
                <i class="fa fa-angle-right"></i>
                Flash Chart </a>
        </li>
        <li>
            <a href="<?php echo Router::url(array('controller' => 'TechnicalAnalysis', 'action' => 'chart_img_trac')); ?>">
                <i class="fa fa-angle-right"></i>
                Image Chart </a>
        </li>
        <li>
            <a href="<?php echo Router::url(array('controller' => 'instruments', 'action' => 'minute_chart')); ?>">
                <i class="fa fa-angle-right"></i>
                Minute Chart <span class="badge badge-roundless badge-success">new</span></a>
        </li>

    </ul>
</div>
<div class="col-md-3">
    <ul class="mega-menu-submenu">
        <li>
            <h3>Form Components</h3>
        </li>
        <li>
            <a href="components_pickers.html">
                <i class="fa fa-angle-right"></i>
                Pickers </a>
        </li>
        <li>
            <a href="components_dropdowns.html">
                <i class="fa fa-angle-right"></i>
                Custom Dropdowns </a>
        </li>

    </ul>
</div>
</div>
</div>
</li>
</ul>
</li>


</ul>
</div>
<!-- END MEGA MENU -->