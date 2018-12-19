<div class="container-fluid">
<!--<nav class="navbar navbar-inverse" id="main_navbar" role="navigation">-->
    <nav class="navbar navbar-inverse-light dropdown-onhover no-border no-border-radius" id="main_navbar" role="navigation">
<div class="container-fluid">
<!-- Brand and toggle get grouped for better mobile display -->
<div class="navbar-header">
    <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#navbar-collapse-1">
        <span class="sr-only">Toggle navigation</span>
        <span class="icon-bar"></span><span class="icon-bar"></span><span class="icon-bar"></span>
    </button>
</div>
<!-- Collect the nav links, forms, and other content for toggling -->
<div class="collapse navbar-collapse" id="navbar-collapse-1">

    <ul class="nav navbar-nav navbar-left">
        <?php foreach ($menu as $main_menu) {
            $id = strtolower($main_menu['url']['controller']) . '_' . strtolower($main_menu['url']['action']);
            if (isset($main_menu['submenu'])) {  // If it has drop down
                ?>
                <li class="dropdown-short" id='<?php echo $id; ?>'>

                    <!--<a data-toggle="dropdown" href="javascript:void(0);" class="dropdown-toggle"><i class="fa fa-bars"></i>&nbsp;<span class="hidden-sm hidden-md reverse">Short</span><span class="caret"></span></a>-->


                    <a data-toggle="dropdown" class="dropdown-toggle"
                       href="<?php echo Router::url(array('controller' => $main_menu['url']['controller'], 'action' => $main_menu['url']['action'])); ?>">
                        <i class="<?php echo $main_menu['icon'] ?>"></i>&nbsp;<span
                            class="hidden-sm"><?php echo $main_menu['title'] ?></span><?php if (isset($main_menu['submenu'])) { ?>
                            <span class="caret"></span> <?php } ?>

                    </a>

                    <ul class="dropdown-menu">
                        <?php foreach ($main_menu['submenu'] as $submenu) {
                            $sid = strtolower($submenu['url']['controller']) . '_' . strtolower($submenu['url']['action']);
                            ?>
                            <li id='<?php echo $sid; ?>'>
                                <a href="<?php echo Router::url(array('controller' => $submenu['url']['controller'], 'action' => $submenu['url']['action'])); ?>"
                                   class="iconify">
                                    <i class="<?php echo $submenu['icon'] ?>"></i>
                                    <?php echo $submenu['title'] ?>
                                    <span class="desc">Monitor minute wise movement</span>
                                </a>

                            </li>
                            <li class="divider"></li>
                        <?php
                        }
                        ?>
                    </ul>

                </li>
                <li class="divider"></li>
            <?php
            } else // It is single menu. We will set text link here
            {
                ?>

                <a class="navbar-link navbar-left" href="<?php echo Router::url(array('controller' => $main_menu['url']['controller'], 'action' => $main_menu['url']['action'])); ?>">
                    <i class="<?php echo $main_menu['icon'] ?>"></i>&nbsp;<span
                        class="hidden-sm"><?php echo $main_menu['title'] ?></span><?php if (isset($main_menu['submenu'])) { ?>
                        <span class="caret"></span> <?php } ?>

                </a>

                <li class="divider"></li>
            <?php
            }
        }
        ?>
    </ul>



<ul class="nav navbar-nav navbar-right">

<!-- search form -->
<form class="navbar-form-expanded navbar-form navbar-left visible-lg-block visible-md-block visible-xs-block"
      role="search">
    <div class="input-group">
        <input type="text" class="form-control" data-width="80px" data-width-expanded="170px" placeholder="Search..."
               name="query">
        <span class="input-group-btn"><button class="btn btn-default" type="submit"><i class="fa fa-search"></i>&nbsp;
            </button></span>
    </div>
</form>
<li class="dropdown-grid visible-sm-block">
    <a data-toggle="dropdown" href="javascript:;" class="dropdown-toggle"><i class="fa fa-search"></i> Search</a>

    <div class="dropdown-grid-wrapper" role="menu">
        <ul class="dropdown-menu col-sm-6">
            <li>
                <form class="no-margin">
                    <div class="input-group">
                        <input type="text" class="form-control">
                        <span class="input-group-btn"><button class="btn btn-default" type="button">&nbsp;<i
                                    class="fa fa-search"></i></button></span>
                    </div>
                </form>
            </li>
        </ul>
    </div>
</li>


<!-- divider -->
    <li class="divider"></li>
    <a href="<?php echo Router::url(array('controller' => 'users', 'action' =>'logout')); ?>" class="navbar-link navbar-right"><i class="fa fa-link"></i>&nbsp;<span class="hidden-sm hidden-md">Logout</span></a>
<li class="divider"></li>

</ul>
</div>
</div>
</nav>
</div>