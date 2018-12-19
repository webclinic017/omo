<body class="page-header-fixed page-container-bg-solid page-sidebar-closed-hide-logo page-footer-fixed1">
<!-- BEGIN HEADER -->
<div class="page-header navbar navbar-fixed-top">
<!-- BEGIN HEADER INNER -->
<div class="page-header-inner">
<!-- BEGIN LOGO -->
<div class="page-logo">

    <a href="index.html">
        <img src="<?php echo Router::url('/', true);?>assets/admin/layout2/img/logo-default.png" alt="logo" class="logo-default"/><!-- logo font felix titling-->
    </a>
    <div class="menu-toggler sidebar-toggler">
        <!-- DOC: Remove the above "hide" to enable the sidebar toggler button on header -->
    </div>
</div>
<!-- END LOGO -->
<!-- BEGIN RESPONSIVE MENU TOGGLER -->
<a href="javascript:;" class="menu-toggler responsive-toggler" data-toggle="collapse" data-target=".navbar-collapse">
</a>
<!-- END RESPONSIVE MENU TOGGLER -->
<!-- BEGIN PAGE TOP -->
<div class="page-top">
<!-- BEGIN HEADER SEARCH BOX -->
<!-- DOC: Apply "search-form-expanded" right after the "search-form" class to have half expanded search box -->
<!--<form class="search-form search-form-expanded" action="extra_search.html" method="GET">
    <div class="input-group">
        <input type="text" class="form-control" placeholder="Search..." name="query">
					<span class="input-group-btn">
					<a href="javascript:;" class="btn submit"><i class="icon-magnifier"></i></a>
					</span>

    </div>
</form>
-->
<!-- END HEADER SEARCH BOX -->
<div class="top-menu">
<ul class="nav navbar-nav pull-right">
    <!--<div id="flipcountdownbox1"></div>-->
    <li class="dropdown dropdown-user">

        <a href="#" class="dropdown-toggle" data-toggle="dropdown" data-hover="dropdown" data-close-others="true">
            <!--<div id="flipcountdownbox1"></div>-->
            <span id="flipcountdownbox1" class="username"> </span>

        </a>

    </li>
    <li class="dropdown dropdown-user">
        <a href="#" class="dropdown-toggle" data-toggle="dropdown" data-hover="dropdown" data-close-others="true">
            <img alt="" class="img-circle username-hide-on-mobile" src="../../assets/admin/layout2/img/user_icon.png"/>
						<span class="username">
						<?php  echo $this->Session->read('Auth.User.username'); ?> ( <?php  echo $this->Session->read('Auth.User.internal_ref_no'); ?> )</span>
            <i class="fa fa-angle-down"></i>
        </a>
        <ul class="dropdown-menu dropdown-menu-default">
            <li>
                <a href="<?php echo Router::url('/', true);?>users/home">
                    <i class="icon-user"></i> My Profile </a>
            </li>
            <li class="divider">
            </li>
           <!-- <li>
                <a href="extra_lock.html">
                    <i class="icon-lock"></i> Lock Screen </a>
            </li>-->
            <li>
                <a href="<?php echo Router::url('/', true);?>users/logout">
                    <i class="icon-key"></i> Log Out </a>
            </li>
        </ul>

    </li>
</ul>
</div>
</div>
<!-- END PAGE TOP -->
</div>
<!-- END HEADER INNER -->
</div>
<!-- END HEADER -->
<div class="clearfix">
</div>