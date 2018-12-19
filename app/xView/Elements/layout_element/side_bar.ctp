<?php
$this->extend('/Common/side_bar_frame');

$url = $this->Html->url('dashboard') ;
$active = $this->request->here == $url? 'class="active"': '';

?>
<?php
$this->start('submenu1');
?>
<li >
    <a href="javascript:;">
        <i class="fa fa-cogs"></i>
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
<?php
$this->end();
?>

<?php
$this->start('submenu2');
?>
<li class="active">
    <a href="javascript:;">
        <i class="fa fa-cogs"></i>
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
        <li <?php echo (!empty($this->params['action']) && ($this->params['action']=='dashboard') )?'class="active"' :'' ?>>

            <?php
                        echo $this->Html->link('Not Ajax Link Sample 2', '/posts/dashboard');
        //echo $this->requestAction('posts/dashboard');
            ?>
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
        <i class="fa fa-cogs"></i>
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
