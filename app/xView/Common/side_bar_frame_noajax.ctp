<div class="page-sidebar nav-collapse collapse">
    <!-- BEGIN SIDEBAR MENU1 -->
    <ul class="page-sidebar-menu">
        <li>
            <!-- BEGIN SIDEBAR TOGGLER BUTTON -->
            <div class="sidebar-toggler hidden-phone"></div>
            <!-- BEGIN SIDEBAR TOGGLER BUTTON -->
        </li>
        <li>
            <!-- BEGIN RESPONSIVE QUICK SEARCH FORM -->
            <form class="sidebar-search">
                <div class="input-box">
                    <a href="javascript:;" class="remove"></a>
                    <input type="text" placeholder="Search..." />
                    <input type="button" class="submit" value=" " />
                </div>
            </form>
            <!-- END RESPONSIVE QUICK SEARCH FORM -->
        </li>
        <li class="start ">
            <a href="<?php echo $this->webroot; ?>posts/dashboard">
                <i class="icon-home"></i>
                <span class="title">Dashboard</span>
            </a>
        </li>
        <?php echo $this->fetch('submenu1'); ?>
        <?php echo $this->fetch('submenu2'); ?>
        <?php echo $this->fetch('submenu3'); ?>

    </ul>
    <!-- END SIDEBAR MENU1 -->
</div>