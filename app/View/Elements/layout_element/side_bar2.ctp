<?php
$this->start('side_bar2');
?>

<div class="page-sidebar navbar-collapse collapse">
    <!-- BEGIN SIDEBAR MENU1 -->
    <ul class="page-sidebar-menu">
        <li>
            <!-- BEGIN SIDEBAR TOGGLER BUTTON -->
            <div class="sidebar-toggler hidden-xs"></div>
            <!-- BEGIN SIDEBAR TOGGLER BUTTON -->
        </li>
        <li>
            <!-- BEGIN RESPONSIVE QUICK SEARCH FORM -->
            <form class="sidebar-search" action="extra_search.html" method="POST">
                <div class="form-container">
                    <div class="input-box">
                        <a href="javascript:;" class="remove"></a>
                        <!--<input type="text" placeholder="Search..."/>-->
                        <input type="text" placeholder="Search..." data-provide="typeahead" data-items="4" data-source="[&quot;Alabama&quot;,&quot; Support <support@demo.com> &quot;,&quot;Arizona&quot;,&quot;Arkansas&quot;,&quot;California&quot;,&quot;Colorado&quot;,&quot;Connecticut&quot;,&quot;Delaware&quot;,&quot;Florida&quot;,&quot;Georgia&quot;,&quot;Hawaii&quot;,&quot;Idaho&quot;,&quot;Illinois&quot;,&quot;Indiana&quot;,&quot;Iowa&quot;,&quot;Kansas&quot;,&quot;Kentucky&quot;,&quot;Louisiana&quot;,&quot;Maine&quot;,&quot;Maryland&quot;,&quot;Massachusetts&quot;,&quot;Michigan&quot;,&quot;Minnesota&quot;,&quot;Mississippi&quot;,&quot;Missouri&quot;,&quot;Montana&quot;,&quot;Nebraska&quot;,&quot;Nevada&quot;,&quot;New Hampshire&quot;,&quot;New Jersey&quot;,&quot;New Mexico&quot;,&quot;New York&quot;,&quot;North Dakota&quot;,&quot;North Carolina&quot;,&quot;Ohio&quot;,&quot;Oklahoma&quot;,&quot;Oregon&quot;,&quot;Pennsylvania&quot;,&quot;Rhode Island&quot;,&quot;South Carolina&quot;,&quot;South Dakota&quot;,&quot;Tennessee&quot;,&quot;Texas&quot;,&quot;Utah&quot;,&quot;Vermont&quot;,&quot;Virginia&quot;,&quot;Washington&quot;,&quot;West Virginia&quot;,&quot;Wisconsin&quot;,&quot;Wyoming&quot;]" />
                        <input type="button" class="submit" value=" "/>
                    </div>
                </div>
            </form>
            <!-- END RESPONSIVE QUICK SEARCH FORM -->
        </li>
        <li class="start">
            <a href="<?php echo $this->webroot; ?>posts/dashboard">
                <i class="fa fa-home"></i>
                <span class="title">Dashboard</span>
                <span class="selected"></span>
            </a>
        </li>

        <li>
            <a href="javascript:;">
                <i class="fa fa-cogs"></i>
                <span class="title">Ajax Submenu 1-F</span>
                <span class="selected"></span>
                <span class="arrow open"></span>
            </a>
            <ul class="sub-menu">
                <li id='active_markets_home'>
                    <?php
                    echo $this->Html->link('Market Home', '/markets/home');
                    ?>
                </li>
                <li id='active_markets_test'>
                    <?php
                    echo $this->Html->link('Sidebar Menu From View', '/markets/test');
                    ?>
                </li>
                <li id='active_TechnicalAnalysis_chart'>
                    <?php
                    echo $this->Html->link('Chart', '/TechnicalAnalysis/chart');
                    ?>
                </li>

                <?php //echo $this->fetch('side_bar_menu_1'); ?>
            </ul>
        </li>

        <li>
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
                <li
                <?php echo (!empty($this->params['action']) && ($this->params['action']=='dashboard') )?'class="active"':'' ?>
                >

                <?php
                        echo $this->Html->link('Not Ajax Link Sample 2', '/posts/dashboard');
                //echo $this->requestAction('posts/dashboard');
                ?>
        </li>
    </ul>
    </li>
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

    </ul>
    <!-- END SIDEBAR MENU1 -->
</div>

<?php
$this->end();
?>
