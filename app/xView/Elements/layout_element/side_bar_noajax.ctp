<?php
$this->extend('/Common/side_bar_frame_noajax');
?>
<?php
$this->start('submenu1');
?>
<li >
    <a href="javascript:;">
        <i class="icon-cogs"></i>
        <span class="title">Ajax Submenu 1</span>
        <span class="selected"></span>
        <span class="arrow open"></span>
    </a>
    <ul class="sub-menu">
        <li>
            <?php
                        echo $this->Html->link('Ajax Link Sample 1', '/posts/test', array('class' => 'ajaxify'));
            ?>
        </li>
        <li>
            <!-- <a class="ajaxify" href="layout_ajax_content_3.html">
                 Ajax Link Sample 2
             </a>-->
            <?php
                        echo $this->Html->link('Ajax Link Sample 2', '/posts/test2', array('class' => 'ajaxify'));
            ?>
        </li>
        <li>
            <a class="ajaxify" href="layout_ajax_content_2.html">
                Ajax Link Sample 3
            </a>
        </li>
        <li>
            <?php
                        echo $this->Html->link('Ajax Link Sample 2', '/posts/index');
            ?>
        </li>
    </ul>
</li>

<li class="active ">
    <a href="javascript:;">
        <i class="icon-cogs"></i>
        <span class="title">Layouts</span>
        <span class="selected"></span>
        <span class="arrow open"></span>
    </a>
    <ul class="sub-menu">
        <li >
            <a href="layout_language_bar.html">
                <span class="badge badge-roundless badge-important">new</span>Language Switch Bar</a>
        </li>
        <li >
            <a href="layout_horizontal_sidebar_menu.html">
                Horizontal & Sidebar Menu</a>
        </li>
        <li >
            <a href="layout_horizontal_menu1.html">
                Horizontal Menu 1</a>
        </li>
        <li >
            <a href="layout_horizontal_menu2.html">
                Horizontal Menu 2</a>
        </li>
        <li >
            <a href="layout_promo.html">
                Promo Page</a>
        </li>
        <li >
            <a href="layout_email.html">
                Email Templates</a>
        </li>
        <li >
            <a href="layout_ajax.html">
                Content Loading via Ajax</a>
        </li>
        <li >
            <a href="layout_sidebar_closed.html">
                Sidebar Closed Page</a>
        </li>
        <li class="active">
            <a href="layout_blank_page.html">
                Blank Page</a>
        </li>
        <li >
            <a href="layout_boxed_page.html">
                Boxed Page</a>
        </li>
        <li >
            <a href="layout_boxed_not_responsive.html">
                Non-Responsive Boxed Layout</a>
        </li>
    </ul>
</li>
<?php
$this->end();
?>

<?php
$this->start('submenu2');
?>
<li >
    <a href="javascript:;">
        <i class="icon-cogs"></i>
        <span class="title">Ajax Submenu 2</span>
        <span class="selected"></span>
        <span class="arrow"></span>
    </a>
    <ul class="sub-menu">
        <li>
            <a class="ajaxify" href="layout_ajax_content_2.html">
                Ajax Link Sample 1
            </a>
        </li>
        <li>
            <a class="ajaxify" href="layout_ajax_content_3.html">
                Ajax Link Sample 2
            </a>
        </li>
        <li>
            <a class="ajaxify" href="layout_ajax_content_2.html">
                Ajax Link Sample 3
            </a>
        </li>
        <li>
            <a class="ajaxify" href="layout_ajax_content_3.html">
                Ajax Link Sample 4
            </a>
        </li>
    </ul>
</li>
<?php
$this->end();
?>
<?php
$this->start('submenu3');
?>
<li class="last">
    <a href="javascript:;">
        <i class="icon-cogs"></i>
        <span class="title">Ajax Submenu 3</span>
        <span class="selected"></span>
        <span class="arrow"></span>
    </a>
    <ul class="sub-menu">
        <li>
            <a class="ajaxify" href="layout_ajax_content_2.html">
                Ajax Link Sample 1
            </a>
        </li>
        <li>
            <a class="ajaxify" href="layout_ajax_content_3.html">
                Ajax Link Sample 2
            </a>
        </li>
        <li>
            <a class="ajaxify" href="layout_ajax_content_2.html">
                Ajax Link Sample 3
            </a>
        </li>
        <li>
            <a class="ajaxify" href="layout_ajax_content_3.html">
                Ajax Link Sample 4
            </a>
        </li>
    </ul>
</li>
<?php
$this->end();
?>
