<?php
$this->start('side_bar_menu_1');
?>


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

<?php
$this->end();
?>
