<!-- BEGIN MEGA MENU -->
<!-- DOC: Apply "hor-menu-light" class after the "hor-menu" class below to have a horizontal menu with white background -->
<!-- DOC: Remove data-hover="dropdown" and data-close-others="true" attributes below to disable the dropdown opening on mouse hover -->
<div class="hor-menu ">
    <ul class="nav navbar-nav">
        <li>
            <a href="<?php echo Router::url(array('controller' => 'markets', 'action' =>'home')); ?>">Dashboard</a>
        </li>



        <?php foreach ($menu as $main_menu) {
            $id = strtolower($main_menu['url']['controller']) . '_' . strtolower($main_menu['url']['action']);
            ?>
            <li class="menu-dropdown mega-menu-dropdown active" id='<?php echo $id; ?>'>
                <a data-hover="megamenu-dropdown" data-close-others="true" data-toggle="dropdown"
                   href="<?php echo Router::url(array('controller' => $main_menu['url']['controller'], 'action' => $main_menu['url']['action'])); ?>"
                   class="dropdown-toggle">
                    <?php echo $main_menu['title'] ?> <i class="<?php echo $main_menu['icon'] ?>"></i>
                </a>


                <?php
                if (isset($main_menu['submenu'])) {
                    ?>
                    <ul class="dropdown-menu" style="min-width: 710px">
                        <?php foreach ($main_menu['submenu'] as $submenu) {
                            $sid = strtolower($submenu['url']['controller']) . '_' . strtolower($submenu['url']['action']);
                            ?>
                            <li id='<?php echo $sid; ?>'>
                                <div class="mega-menu-content">
                                    <div class="row">

                                        <div class="col-md-4">
                                            <ul class="mega-menu-submenu">
                                                <li>
                                                    <h3>eCommerce</h3>
                                                </li>
                                                <li>
                                                    <a href="<?php echo Router::url(array('controller' => $submenu['url']['controller'], 'action' => $submenu['url']['action'])); ?>" class="iconify">
                                                        <i class="<?php echo $submenu['icon'] ?>"></i>
                                                        <?php echo $submenu['title'] ?>
                                                    </a>
                                                </li>

                                            </ul>
                                        </div>
                                    </div>
                                </div>
                            </li>
                        <?php
                        }
                        ?>
                    </ul>
                <?php
                }
                ?>


            </li>
        <?php
        }
        ?>




    </ul>
</div>
<!-- END MEGA MENU -->