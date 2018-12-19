<!-- BEGIN SIDEBAR -->
<div class="page-sidebar-wrapper">
<!-- DOC: Set data-auto-scroll="false" to disable the sidebar from auto scrolling/focusing -->
<!-- DOC: Change data-auto-speed="200" to adjust the sub menu slide up/down speed -->
<div class="page-sidebar navbar-collapse collapse">
<!-- BEGIN SIDEBAR MENU -->
<!-- DOC: Apply "page-sidebar-menu-light" class right after "page-sidebar-menu" to enable light sidebar menu style(without borders) -->
<!-- DOC: Apply "page-sidebar-menu-hover-submenu" class right after "page-sidebar-menu" to enable hoverable(hover vs accordion) sub menu mode -->
<!-- DOC: Apply "page-sidebar-menu-closed" class right after "page-sidebar-menu" to collapse("page-sidebar-closed" class must be applied to the body element) the sidebar sub menu mode -->
<!-- DOC: Set data-auto-scroll="false" to disable the sidebar from auto scrolling/focusing -->
<!-- DOC: Set data-keep-expand="true" to keep the submenues expanded -->
<!-- DOC: Set data-auto-speed="200" to adjust the sub menu slide up/down speed -->
<ul class="page-sidebar-menu page-sidebar-menu-hover-submenu " data-keep-expanded="false" data-auto-scroll="true" data-slide-speed="200">
<li class="start ">
    <a href="<?php echo Router::url('/', true);?>Dashboards/trade">
        <i class="icon-home"></i>
        <span class="title">Dashboard</span>
    </a>
</li>



<?php foreach ($menu as $main_menu) {
    $id = strtolower($main_menu['url']['controller']) . '_' . strtolower($main_menu['url']['action']);
    $ajax_class='';
    if($main_menu['ajax'])
        $ajax_class='class="ajaxify"';
    ?>
    <li id='<?php echo $id; ?>' >
        <a <?php echo $ajax_class; ?> href="<?php echo Router::url('/', true);?><?php echo $main_menu['url']['controller']; ?>/<?php echo $main_menu['url']['action']; ?>">
            <i class="<?php echo $main_menu['icon'] ?>"></i>
            <span class="title"><?php echo $main_menu['title'] ?> </span>
            <span class="arrow "></span>
        </a>

        <?php
        if (isset($main_menu['submenu'])) {
            ?>
        <ul class="sub-menu">
                <?php foreach ($main_menu['submenu'] as $submenu) {
                    $sid = strtolower($submenu['url']['controller']) . '_' . strtolower($submenu['url']['action']);
                    $ajax_class='';
                    if($main_menu['ajax'])
                        $ajax_class='class="ajaxify"';

                    ?>
                    <li id='<?php echo $sid; ?>'>
                        <a <?php echo $ajax_class; ?> href="<?php echo Router::url('/', true);?><?php echo $submenu['url']['controller']; ?>/<?php echo $submenu['url']['action']; ?>">
                            <i class="<?php echo $submenu['icon'] ?>"></i>
                            <?php echo $submenu['title'] ?></a>
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
    <li>
        <a  class="ajaxify" href="<?php echo Router::url('/', true);?>admin/acl/acos">
            <i class="icon-home"></i>
            <span class="title">Admin</span>
        </a>
    </li>
    <li>
        <a  href="<?php echo Router::url(array('controller' => 'users', 'action' => 'login')); ?>">
            <i class="icon-home"></i>
            <span class="title">Login</span>
        </a>
    </li>


</ul>
<!-- END SIDEBAR MENU -->
</div>
</div>
<!-- END SIDEBAR -->