<!-- BEGIN SIDEBAR -->
<div class="page-sidebar-wrapper">
<!-- DOC: Set data-auto-scroll="false" to disable the sidebar from auto scrolling/focusing -->
<!-- DOC: Change data-auto-speed="200" to adjust the sub menu slide up/down speed -->
<div class="page-sidebar navbar-collapse collapse">
<!-- BEGIN SIDEBAR MENU -->
<ul class="page-sidebar-menu" data-auto-scroll="true" data-slide-speed="200">
<!-- DOC: To remove the sidebar toggler from the sidebar you just need to completely remove the below "sidebar-toggler-wrapper" LI element -->
<li class="sidebar-toggler-wrapper">
    <!-- BEGIN SIDEBAR TOGGLER BUTTON -->
    <div class="sidebar-toggler">
    </div>
    <!-- END SIDEBAR TOGGLER BUTTON -->
</li>
<!-- DOC: To remove the search box from the sidebar you just need to completely remove the below "sidebar-search-wrapper" LI element -->

<li class="start" id='users_home'>
    <a href="<?php echo Router::url(array('controller'=>'users','action'=>'home'));?>">
        <i class="fa fa-tachometer"></i>
        <span class="title">Dashboard-</span>
    </a>

</li>

<?php foreach ($menu as $main_menu) {
    $id=strtolower($main_menu['url']['controller']).'_'.strtolower($main_menu['url']['action']);
    ?>
    <li id='<?php echo $id;?>'>
    <a href="<?php echo Router::url(array('controller' => $main_menu['url']['controller'], 'action' => $main_menu['url']['action'])); ?>">
        <i class="<?php echo $main_menu['icon'] ?>"></i>
        <span class="title"><?php echo $main_menu['title'] ?></span>
        <?php
        if (isset($main_menu['submenu']))
            echo '<span class="arrow "></span>';
        ?>
    </a>

    <?php
    if (isset($main_menu['submenu'])) {
        ?>
        <ul class="sub-menu">
        <?php foreach ($main_menu['submenu'] as $submenu) {
            $sid=strtolower($submenu['url']['controller']).'_'.strtolower($submenu['url']['action']);
            ?>
            <li id='<?php echo $sid;?>' >
                <a href="<?php echo Router::url(array('controller' => $submenu['url']['controller'], 'action' => $submenu['url']['action'])); ?>">
                    <i class="<?php echo $submenu['icon'] ?>"></i>
                    <span class="title"><?php echo $submenu['title'] ?></span>

                </a>
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

<?php
// user is logged in
if ($this->Session->read('Auth.User')) {  ?>

    <li class="last" id='users_logout'>
        <!-- <a href="<?php /*echo Router::url(array('controller'=>'users','action'=>'home'));*/?>">
            <i class="icon-home"></i>
            <span class="title">Dashboard</span>
        </a>-->
        <?php echo $this->Facebook->logout(array('label' => 'Logout','id' => 'fblogout', 'redirect' => array('controller' => 'users', 'action' => 'logout'))); ?>

    </li>
<?php
}?>


</ul>
<!-- END SIDEBAR MENU -->
</div>
</div>
<!-- END SIDEBAR -->