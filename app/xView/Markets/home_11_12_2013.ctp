<?php
/**
ADDING CSS BY ELEMENT ( THAT IS PREVIOUSLY GROUPED SOME CSS ) TO DEFAULT LAYOUT.
IT WILL BE ADDED WHERE echo $this->fetch('css') IS CALLED IN DEFAULT LAYOUT.
*/
echo $this->element('css_element/global2');
echo $this->element('css_element/pagelevel2');
echo $this->element('css_element/theme2');

/**
ADDING DIRECTLY A CSS FROM VIEW TO DEFAULT LAYOUT CSS BLOCK. NO ECHO NEEDED. INLINE FALSE MUST BE SET.
*/

//$this->Html->css('assets/plugins/bootstrap/css/bootstrap.min', null, array('inline' => false));
?>
<!-- TODO: ITS ALWAYS ADDING MENUE TO THE TOP.ITS WORKING LIKE PREPEND BUT APPEND IS NOT WORKING. FIND OUT A SOLUTION -->
<?php
/**
ADDING A SIDEBAR MENU TO THE side_bar_menu_1 BLOCK.
NOTE THAT SERIAL OF THESE 3 ARE IMPORTANT. 1ST APPEND MENUE 2ND MENUE BLOCK THIRD SIDEBAR2 BLOCK
TODO:      ITS ALWAYS ADDING MENUE TO THE TOP.ITS WORKING LIKE PREPEND BUT APPEND IS NOT WORKING. FIND OUT A SOLUTION (ABOVE FORM OF TODO IS FOR STORMPHP TODO SYNTEX)
*/

$this->append('side_bar_menu_1');
?>
<li>
    <?php
    echo $this->Html->link('Sidebar Menu From View', '/posts/index');
    ?>
</li>
<?php
    $this->end();
?>

<?php
echo $this->element('layout_element/side_bar_menu_1');
echo $this->element('layout_element/side_bar2');
?>
<div class="row">
<div class="col-md-12 center-block">
    <?php echo $this->Html->image('assets/img/stock_bangladesh_vat_center.gif', array('class' => 'middle-footer-widget img-responsive'));?>
</div>
</div>
<!-- BEGIN PAGE HEADER-->
<div class="row">
    <div class="col-md-12">
        <!-- BEGIN PAGE TITLE & BREADCRUMB-->
        <!--<h3 class="page-title">
            Dhaka Stock Exchange
            <small>statistics and more</small>
        </h3>-->
        <ul class="page-breadcrumb breadcrumb">
            <li class="btn-group">
                <button type="button" class="btn green">
                    <i class="fa fa-calendar"></i><span>25 NOV 2013 10:30AM</span>
                </button>

            </li>
            <li>
                <i class="fa fa-home"></i>
                <a href="index.html">Home</a>
                <i class="fa fa-angle-right"></i>
            </li>
            <li><a href="#">Dashboard</a></li>

        </ul>
        <!-- END PAGE TITLE & BREADCRUMB-->
    </div>
</div>
<!-- END PAGE HEADER-->

<div class="clearfix"></div>
<!-- BEGIN DASHBOARD STATS -->

<!-- BEGIN Portlet PORTLET-->
<div class="portlet">
    <div class="portlet-title">
        <div class="caption"><i class="fa fa-reorder"></i>Market Summary</div>
        <div class="tools">
            <a href="javascript:;" class="collapse"></a>
            <a href="#portlet-config" data-toggle="modal" class="config"></a>
            <a href="javascript:;" class="reload"></a>
            <a href="javascript:;" class="remove"></a>
        </div>
    </div>
    <div class="portlet-body">
        <div class="row">
            <div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">
                <div class="dashboard-stat blue">
                    <div class="visual">
                        <i class="fa fa-bar-chart-o"></i>
                    </div>
                    <div class="details">
                        <div class="number">
                            4270.9
                        </div>
                        <div class="desc">
                            <div><i class="fa fa-level-up"></i><span class="label label-sm">DSEX 4027.5 (4.56%)</span></div>
                            <div><i class="fa fa-level-up"></i><span class="label label-sm">DSEGEN 4500 (4.56%)</span></div>
                        </div>
                    </div>
                    <a class="more" href="#">
                        View more <i class="m-icon-swapright m-icon-white"></i>
                    </a>
                </div>
            </div>
            <div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">
                <div class="dashboard-stat yellow">
                    <div class="visual">
                        <i class="fa fa-money"></i>
                    </div>
                    <div class="details">
                        <div class="number">1133.17</div>
                        <div class="desc">
                            Total Trade (MN)
                        </div>
                    </div>
                    <a class="more" href="#">
                        View more <i class="m-icon-swapright m-icon-white"></i>
                    </a>
                </div>
            </div>
            <div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">
                <div class="dashboard-stat green">
                    <div class="visual">
                        <i class="glyphicon glyphicon-arrow-up"></i>
                    </div>
                    <div class="details">
                        <div class="number">150</div>
                        <div class="desc">
                            <div><i class="fa fa-level-up"></i><span class="label label-sm">ABBANK. (4.56%)</span></div>
                            <div><i class="fa fa-level-up"></i><span class="label label-sm">ABBANK. (4.56%)</span></div>
                        </div>
                    </div>
                    <a class="more" href="#">
                        View more <i class="m-icon-swapright m-icon-white"></i>
                    </a>
                </div>
            </div>
            <div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">
                <div class="dashboard-stat red">
                    <div class="visual">
                        <i class="glyphicon glyphicon-arrow-down"></i>
                    </div>
                    <div class="details">
                        <div class="number">100</div>
                        <div class="desc">
                            <div><i class="fa fa-level-down"></i><span class="label label-sm">ABBANK. (4.56%)</span></div>
                            <div><i class="fa fa-level-down"></i><span class="label label-sm">ABBANK. (4.56%)</span></div>
                        </div>
                    </div>
                    <a class="more" href="#">
                        View more <i class="m-icon-swapright m-icon-white"></i>
                    </a>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- END Portlet PORTLET-->
<!-- END DASHBOARD STATS -->
<div class="clearfix"></div>
<div class="row">
    <div class="col-md-6 col-sm-6">
        <div class="portlet">
            <div class="portlet-title">
                <!--<div class="caption"><i class="fa fa-reorder"></i>Index Chart</div>-->
                <div class="tools">
                    <a href="javascript:;" class="collapse"></a>
                    <a href="#portlet-config" data-toggle="modal" class="config"></a>
                </div>
            </div>
            <div class="portlet-body">
                <div class="tabbable-custom nav-justified">
                    <ul class="nav nav-tabs nav-justified">
                        <li class="active"><a href="#tab_1_1_1" data-toggle="tab">DSEX</a></li>
                        <li><a href="#tab_1_1_2" data-toggle="tab">DSE30</a></li>
                        <li><a href="#tab_1_1_3" data-toggle="tab">CSE</a></li>
                    </ul>
                    <div class="tab-content">
                        <div class="tab-pane active" id="tab_1_1_1">
                            <div id="areasplinewrapper"></div>
                        </div>
                        <div class="tab-pane" id="tab_1_1_2">
                            <p>Howdy, I'm in Section 2.</p>
                            <p>
                                Ut wisi enim ad minim veniam, quis nostrud exerci tation ullamcorper suscipit lobortis nisl ut aliquip ex ea commodo consequat. Duis autem vel eum iriure dolor in hendrerit in vulputate velit esse molestie consequat. Ut wisi enim ad minim veniam, quis nostrud exerci tation.
                            </p>
                            <p>
                                <a class="btn green" href="ui_tabs_accordions_navs.html#tab_1_1_2" target="_blank">Activate this tab via URL</a>
                            </p>
                        </div>
                        <div class="tab-pane" id="tab_1_1_3">
                            <p>Howdy, I'm in Section 3.</p>
                            <p>
                                Duis autem vel eum iriure dolor in hendrerit in vulputate.
                                Ut wisi enim ad minim veniam, quis nostrud exerci tation ullamcorper suscipit lobortis nisl ut aliquip ex ea commodo consequat. Duis autem vel eum iriure dolor in hendrerit in vulputate velit esse molestie consequat
                            </p>
                            <p>
                                <a class="btn yellow" href="ui_tabs_accordions_navs.html#tab_1_1_3" target="_blank">Activate this tab via URL</a>
                            </p>
                        </div>
                    </div>
                </div>

            </div>
        </div>

    </div>
    <div class="col-md-6 col-sm-6">
        <!-- BEGIN PORTLET-->
        <div class="portlet">
            <div class="portlet-title">
                <div class="caption"><i class="fa fa-reorder"></i>Volume chart</div>
                <div class="tools">
                    <a href="javascript:;" class="collapse"></a>
                    <a href="#portlet-config" data-toggle="modal" class="config"></a>
                    <a href="javascript:;" class="reload"></a>
                    <a href="javascript:;" class="remove"></a>
                </div>
            </div>

            <div class="portlet-body">

                    <!--<div id="areasplinewrapper"></div>-->


            </div>
        </div> <div class="portlet">
            <div class="portlet-title">
                <div class="caption"><i class="fa fa-reorder"></i>Trade chart</div>
                <div class="tools">
                    <a href="javascript:;" class="collapse"></a>
                    <a href="#portlet-config" data-toggle="modal" class="config"></a>
                    <a href="javascript:;" class="reload"></a>
                    <a href="javascript:;" class="remove"></a>
                </div>
            </div>

            <div class="portlet-body">

                    <!--<div id="areasplinewrapper"></div>-->


            </div>
        </div>
        <!-- END PORTLET-->
    </div>

</div>

<div class="clearfix"></div>
<div class="row ">
    <div class="col-md-4 col-sm-4">
        <div class="portlet box blue">
            <div class="portlet-title">
                <div class="caption"><i class="fa fa-calendar"></i>Index Stats</div>
                <div class="tools">
                    <a href="" class="collapse"></a>
                    <a href="#portlet-config" data-toggle="modal" class="config"></a>
                    <a href="http://localhost/omo/posts/test2" class="reload"></a>
                    <a href="" class="remove"></a>
                </div>
            </div>
            <div class="portlet-body" id="poststest2">
                <div class="row">
                    <div class="col-md-4">
                        <div id="piewrapper" style="display: block; float: left; width:90%; margin-bottom: 20px;"></div>
                    </div>
                    <div class="margin-bottom-10 visible-sm"></div>
                    <div class="col-md-4">
                        <div class="sparkline-chart">
                            <div class="number" id="sparkline_bar72"></div>
                            <a class="title" href="#">CPU Load <i class="m-icon-swapright"></i></a>
                        </div>
                    </div>
                    <div class="margin-bottom-10 visible-sm"></div>
                    <div class="col-md-4">
                        <div class="sparkline-chart">
                            <div class="number" id="sparkline_lineg"></div>
                            <a class="title" href="#">Load Rate <i class="m-icon-swapright"></i></a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="col-md-4 col-sm-4">
        <div class="portlet box blue">
            <div class="portlet-title">
                <div class="caption"><i class="fa fa-calendar"></i>Sector Stats</div>
                <div class="tools">
                    <a href="" class="collapse"></a>
                    <a href="#portlet-config" data-toggle="modal" class="config"></a>
<?php
/**
                    HREF OF class="reload" WILL BE CONSIDERED AS AJAX URL.
                    ID OF class="portlet-body" DIV MUST BE NAMED BY CONTROLLER+ACTION WITHOUT SPACE
*/
?>
                    <a href="http://localhost/omo/markets/home" class="reload"></a>
                    <a href="" class="remove"></a>
                </div>
            </div>
            <div class="portlet-body" id="marketshome">
                <div class="row">
                    <div class="col-md-4">
                        <div class="sparkline-chart">
                            <div class="number" id="sparkline_bar"></div>
                            <a class="title" href="#">Network <i class="m-icon-swapright"></i></a>
                        </div>
                    </div>
                    <div class="margin-bottom-10 visible-sm"></div>
                    <div class="col-md-4">
                        <div class="sparkline-chart">
                            <div class="number" id="sparkline_bar2"></div>
                            <a class="title" href="#">CPU Load <i class="m-icon-swapright"></i></a>
                        </div>
                    </div>
                    <div class="margin-bottom-10 visible-sm"></div>
                    <div class="col-md-4">
                        <div class="sparkline-chart">
                            <div class="number" id="sparkline_line"></div>
                            <a class="title" href="#">Load Rate <i class="m-icon-swapright"></i></a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="col-md-4 col-sm-4">
        <!--<div id="myCarousel" class="carousel image-carousel slide">
            <div class="carousel-inner">
                <div class="active item">
                    <div class="new_html_code">

                        <div class="portlet box red">
                            <div class="portlet-title">
                                <div class="caption"><i class="fa fa-reorder"></i>Default Tabs</div>
                                <div class="tools">
                                    <a href="javascript:;" class="collapse"></a>
                                    <a href="#portlet-config" data-toggle="modal" class="config"></a>
                                </div>
                            </div>
                            <div class="portlet-body">
                                <ul  class="nav nav-tabs">
                                    <li class="active"><a href="#tab_1_1" data-toggle="tab">Home</a></li>
                                    <li class=""><a href="#tab_1_2" data-toggle="tab">Profile</a></li>
                                    <li class="dropdown">
                                        <a href="#"  class="dropdown-toggle" data-toggle="dropdown">Dropdown <i class="fa fa-angle-down"></i></a>
                                        <ul class="dropdown-menu" role="menu">
                                            <li><a href="#tab_1_3" tabindex="-1" data-toggle="tab">Option 1</a></li>
                                            <li><a href="#tab_1_4" tabindex="-1" data-toggle="tab">Option 2</a></li>
                                            <li><a href="#tab_1_3" tabindex="-1" data-toggle="tab">Option 3</a></li>
                                            <li><a href="#tab_1_4" tabindex="-1" data-toggle="tab">Option 4</a></li>
                                        </ul>
                                    </li>
                                </ul>
                                <div  class="tab-content">
                                    <div class="tab-pane fade active in" id="tab_1_1">
                                        <p>Raw denim you probably haven't heard of them jean shorts Austin. Nesciunt tofu stumptown aliqua, retro synth master cleanse. Mustache cliche tempor, williamsburg carles vegan helvetica. Reprehenderit butcher retro keffiyeh dreamcatcher synth. Cosby sweater eu banh mi, qui irure terry richardson ex squid. Aliquip placeat salvia cillum iphone. Seitan aliquip quis cardigan american apparel, butcher voluptate nisi qui.</p>
                                    </div>
                                    <div class="tab-pane fade" id="tab_1_2">
                                        <p>Food truck fixie locavore, accusamus mcsweeney's marfa nulla single-origin coffee squid. Exercitation +1 labore velit, blog sartorial PBR leggings next level wes anderson artisan four loko farm-to-table craft beer twee. Qui photo booth letterpress, commodo enim craft beer mlkshk aliquip jean shorts ullamco ad vinyl cillum PBR. Homo nostrud organic, assumenda labore aesthetic magna delectus mollit. Keytar helvetica VHS salvia yr, vero magna velit sapiente labore stumptown. Vegan fanny pack odio cillum wes anderson 8-bit, sustainable jean shorts beard ut DIY ethical culpa terry richardson biodiesel. Art party scenester stumptown, tumblr butcher vero sint qui sapiente accusamus tattooed echo park.</p>
                                    </div>
                                    <div class="tab-pane fade" id="tab_1_3">
                                        <p>Etsy mixtape wayfarers, ethical wes anderson tofu before they sold out mcsweeney's organic lomo retro fanny pack lo-fi farm-to-table readymade. Messenger bag gentrify pitchfork tattooed craft beer, iphone skateboard locavore carles etsy salvia banksy hoodie helvetica. DIY synth PBR banksy irony. Leggings gentrify squid 8-bit cred pitchfork. Williamsburg banh mi whatever gluten-free, carles pitchfork biodiesel fixie etsy retro mlkshk vice blog. Scenester cred you probably haven't heard of them, vinyl craft beer blog stumptown. Pitchfork sustainable tofu synth chambray yr.</p>
                                    </div>
                                    <div class="tab-pane fade" id="tab_1_4">
                                        <p>Trust fund seitan letterpress, keytar raw denim keffiyeh etsy art party before they sold out master cleanse gluten-free squid scenester freegan cosby sweater. Fanny pack portland seitan DIY, art party locavore wolf cliche high life echo park Austin. Cred vinyl keffiyeh DIY salvia PBR, banh mi before they sold out farm-to-table VHS viral locavore cosby sweater. Lomo wolf viral, mustache readymade thundercats keffiyeh craft beer marfa ethical. Wolf salvia freegan, sartorial keffiyeh echo park vegan.</p>
                                    </div>
                                </div>
                            </div>
                        </div></div>
                    <div class="carousel-caption">
                        <h4><a href="page_news_item.html">First Thumbnail label</a></h4>
                        <p>Cras justo odio, dapibus ac facilisis in, egestas eget quam.</p>
                    </div>
                </div>
                <div class="item">
                    <div class="new_html_code">

                        <div class="portlet box green">
                        <div class="portlet-title">
                            <div class="caption"><i class="fa fa-reorder"></i>Default Tabs</div>
                            <div class="tools">
                                <a href="javascript:;" class="collapse"></a>
                                <a href="#portlet-config" data-toggle="modal" class="config"></a>
                            </div>
                        </div>
                        <div class="portlet-body">
                            <ul  class="nav nav-tabs">
                                <li class="active"><a href="#tab_1_1" data-toggle="tab">Home</a></li>
                                <li class=""><a href="#tab_1_2" data-toggle="tab">Profile</a></li>
                                <li class="dropdown">
                                    <a href="#"  class="dropdown-toggle" data-toggle="dropdown">Dropdown <i class="fa fa-angle-down"></i></a>
                                    <ul class="dropdown-menu" role="menu">
                                        <li><a href="#tab_1_3" tabindex="-1" data-toggle="tab">Option 1</a></li>
                                        <li><a href="#tab_1_4" tabindex="-1" data-toggle="tab">Option 2</a></li>
                                        <li><a href="#tab_1_3" tabindex="-1" data-toggle="tab">Option 3</a></li>
                                        <li><a href="#tab_1_4" tabindex="-1" data-toggle="tab">Option 4</a></li>
                                    </ul>
                                </li>
                            </ul>
                            <div  class="tab-content">
                                <div class="tab-pane fade active in" id="tab_1_1">
                                    <p>Raw denim you probably haven't heard of them jean shorts Austin. Nesciunt tofu stumptown aliqua, retro synth master cleanse. Mustache cliche tempor, williamsburg carles vegan helvetica. Reprehenderit butcher retro keffiyeh dreamcatcher synth. Cosby sweater eu banh mi, qui irure terry richardson ex squid. Aliquip placeat salvia cillum iphone. Seitan aliquip quis cardigan american apparel, butcher voluptate nisi qui.</p>
                                </div>
                                <div class="tab-pane fade" id="tab_1_2">
                                    <p>Food truck fixie locavore, accusamus mcsweeney's marfa nulla single-origin coffee squid. Exercitation +1 labore velit, blog sartorial PBR leggings next level wes anderson artisan four loko farm-to-table craft beer twee. Qui photo booth letterpress, commodo enim craft beer mlkshk aliquip jean shorts ullamco ad vinyl cillum PBR. Homo nostrud organic, assumenda labore aesthetic magna delectus mollit. Keytar helvetica VHS salvia yr, vero magna velit sapiente labore stumptown. Vegan fanny pack odio cillum wes anderson 8-bit, sustainable jean shorts beard ut DIY ethical culpa terry richardson biodiesel. Art party scenester stumptown, tumblr butcher vero sint qui sapiente accusamus tattooed echo park.</p>
                                </div>
                                <div class="tab-pane fade" id="tab_1_3">
                                    <p>Etsy mixtape wayfarers, ethical wes anderson tofu before they sold out mcsweeney's organic lomo retro fanny pack lo-fi farm-to-table readymade. Messenger bag gentrify pitchfork tattooed craft beer, iphone skateboard locavore carles etsy salvia banksy hoodie helvetica. DIY synth PBR banksy irony. Leggings gentrify squid 8-bit cred pitchfork. Williamsburg banh mi whatever gluten-free, carles pitchfork biodiesel fixie etsy retro mlkshk vice blog. Scenester cred you probably haven't heard of them, vinyl craft beer blog stumptown. Pitchfork sustainable tofu synth chambray yr.</p>
                                </div>
                                <div class="tab-pane fade" id="tab_1_4">
                                    <p>Trust fund seitan letterpress, keytar raw denim keffiyeh etsy art party before they sold out master cleanse gluten-free squid scenester freegan cosby sweater. Fanny pack portland seitan DIY, art party locavore wolf cliche high life echo park Austin. Cred vinyl keffiyeh DIY salvia PBR, banh mi before they sold out farm-to-table VHS viral locavore cosby sweater. Lomo wolf viral, mustache readymade thundercats keffiyeh craft beer marfa ethical. Wolf salvia freegan, sartorial keffiyeh echo park vegan.</p>
                                </div>
                            </div>
                        </div>
                    </div></div>
                    <div class="carousel-caption">
                        <h4><a href="page_news_item.html">Second Thumbnail label</a></h4>
                        <p>Cras justo odio, dapibus ac facilisis in, egestas eget quam.</p>
                    </div>
                </div>
                <div class="item">
                    &lt;!&ndash;<img src="assets/img/gallery/image1.jpg" class="img-responsive" alt="">&ndash;&gt;
                    <div class="new_html_code">					<div class="portlet box blue">
                        <div class="portlet-title">
                            <div class="caption"><i class="fa fa-reorder"></i>Styled Tabs(justified)</div>
                            <div class="tools">
                                <a href="javascript:;" class="collapse"></a>
                                <a href="#portlet-config" data-toggle="modal" class="config"></a>
                            </div>
                        </div>
                        <div class="portlet-body">
                            <div class="tabbable-custom nav-justified">
                                <ul class="nav nav-tabs nav-justified">
                                    <li class="active"><a href="#tab_1_1_1" data-toggle="tab">Section 1</a></li>
                                    <li><a href="#tab_1_1_2" data-toggle="tab">Section 2</a></li>
                                    <li><a href="#tab_1_1_3" data-toggle="tab">Section 3</a></li>
                                </ul>
                                <div class="tab-content">
                                    <div class="tab-pane active" id="tab_1_1_1">
                                        <p>I'm in Section 1.</p>
                                        <p>
                                            Duis autem vel eum iriure dolor in hendrerit in vulputate velit esse molestie consequat.
                                            Ut wisi enim ad minim veniam, quis nostrud exerci tation ullamcorper suscipit lobortis nisl ut aliquip ex ea commodo consequat. Duis autem vel eum iriure dolor in hendrerit in vulputate velit esse molestie consequat.
                                            Duis autem vel eum iriure dolor in hendrerit in vulputate velit esse molestie consequat.
                                        </p>
                                    </div>
                                    <div class="tab-pane" id="tab_1_1_2">
                                        <p>Howdy, I'm in Section 2.</p>
                                        <p>
                                            Ut wisi enim ad minim veniam, quis nostrud exerci tation ullamcorper suscipit lobortis nisl ut aliquip ex ea commodo consequat. Duis autem vel eum iriure dolor in hendrerit in vulputate velit esse molestie consequat. Ut wisi enim ad minim veniam, quis nostrud exerci tation.
                                        </p>
                                        <p>
                                            <a class="btn green" href="ui_tabs_accordions_navs.html#tab_1_1_2" target="_blank">Activate this tab via URL</a>
                                        </p>
                                    </div>
                                    <div class="tab-pane" id="tab_1_1_3">
                                        <p>Howdy, I'm in Section 3.</p>
                                        <p>
                                            Duis autem vel eum iriure dolor in hendrerit in vulputate.
                                            Ut wisi enim ad minim veniam, quis nostrud exerci tation ullamcorper suscipit lobortis nisl ut aliquip ex ea commodo consequat. Duis autem vel eum iriure dolor in hendrerit in vulputate velit esse molestie consequat
                                        </p>
                                        <p>
                                            <a class="btn yellow" href="ui_tabs_accordions_navs.html#tab_1_1_3" target="_blank">Activate this tab via URL</a>
                                        </p>
                                    </div>
                                </div>
                            </div>
                            <div class="tabbable-custom tabs-below nav-justified">
                                <div class="tab-content">
                                    <div class="tab-pane active" id="tab_17_1">
                                        <p>I'm in Section 1.</p>
                                        <p>
                                            Ut wisi enim ad minim veniam, quis nostrud exerci tation ullamcorper suscipit lobortis nisl ut aliquip ex ea commodo consequat. Duis autem vel eum iriure dolor in hendrerit in vulputate velit esse molestie consequat.
                                        </p>
                                        <p>
                                            Ut wisi enim ad minim veniam, quis nostrud exerci tation ullamcorper suscipit lobortis nisl ut aliquip ex ea commodo consequat. Duis autem vel eum iriure dolor in hendrerit in vulputate velit esse molestie consequat  dolor in hendrerit in vulputate velit esse molestie consequat.
                                        </p>
                                    </div>
                                    <div class="tab-pane" id="tab_17_2">
                                        <p>Howdy, I'm in Section 2.</p>
                                        <p>
                                            Duis autem vel eum iriure dolor in hendrerit in vulputate.
                                            Ut wisi enim ad minim veniam, quis nostrud exerci tation ullamcorper suscipit lobortis nisl ut aliquip ex ea commodo consequat. Duis autem vel eum iriure dolor in hendrerit in vulputate velit esse molestie consequat.
                                        </p>
                                        <p>
                                            <a class="btn yellow" href="ui_tabs_accordions_navs.html#tab_17_2" target="_blank">Activate this tab via URL</a>
                                        </p>
                                    </div>
                                    <div class="tab-pane" id="tab_17_3">
                                        <p>Howdy, I'm in Section 3.</p>
                                        <p>
                                            Ut wisi enim ad minim veniam, quis nostrud exerci tation ullamcorper suscipit lobortis nisl ut aliquip ex ea commodo consequat. Duis autem vel eum iriure dolor in hendrerit in vulputate velit esse molestie consequat. Duis autem vel eum iriure dolor in hendrerit in vulputate.
                                        </p>
                                        <p>
                                            <a  class="btn purple" href="ui_tabs_accordions_navs.html#tab_17_3" target="_blank">Activate this tab via URL</a>
                                        </p>
                                    </div>
                                </div>
                                <ul class="nav nav-tabs nav-justified">
                                    <li class="active"><a href="#tab_17_1" data-toggle="tab">Section 1</a></li>
                                    <li><a href="#tab_17_2" data-toggle="tab">Section 2</a></li>
                                    <li><a href="#tab_17_3" data-toggle="tab">Section 3</a></li>
                                </ul>
                            </div>
                        </div>
                    </div></div>
                    <div class="carousel-caption">
                        <h4><a href="page_news_item.html">Third Thumbnail label</a></h4>
                        <p>Cras justo odio, dapibus ac facilisis in, egestas eget quam.</p>
                    </div>
                </div>
            </div>
            &lt;!&ndash; Carousel nav &ndash;&gt;
            <a class="carousel-control left" href="#myCarousel" data-slide="prev">
                <i class="m-icon-big-swapleft m-icon-white"></i>
            </a>
            <a class="carousel-control right" href="#myCarousel" data-slide="next">
                <i class="m-icon-big-swapright m-icon-white"></i>
            </a>
            <ol class="carousel-indicators">
                <li data-target="#myCarousel" data-slide-to="0" class="active"></li>
                <li data-target="#myCarousel" data-slide-to="1"></li>
                <li data-target="#myCarousel" data-slide-to="2"></li>
            </ol>
        </div>-->
        <div class="block-carousel">
            <div id="promo_carousel" class="carousel slide">
                <div class="container">
                    <div class="carousel-inner">
                        <div class="active item">
                            <div class="portlet box green">
                                <div class="portlet-title">
                                    <div class="caption"><i class="fa fa-reorder"></i>Default Tabs</div>
                                    <div class="tools">
                                        <a href="javascript:;" class="collapse"></a>
                                        <a href="#portlet-config" data-toggle="modal" class="config"></a>
                                    </div>
                                </div>
                                <div class="portlet-body">
                                    <ul  class="nav nav-tabs">
                                        <li class="active"><a href="#tab_1_1" data-toggle="tab">Home</a></li>
                                        <li class=""><a href="#tab_1_2" data-toggle="tab">Profile</a></li>
                                        <li class="dropdown">
                                            <a href="#"  class="dropdown-toggle" data-toggle="dropdown">Dropdown <i class="fa fa-angle-down"></i></a>
                                            <ul class="dropdown-menu" role="menu">
                                                <li><a href="#tab_1_3" tabindex="-1" data-toggle="tab">Option 1</a></li>
                                                <li><a href="#tab_1_4" tabindex="-1" data-toggle="tab">Option 2</a></li>
                                                <li><a href="#tab_1_3" tabindex="-1" data-toggle="tab">Option 3</a></li>
                                                <li><a href="#tab_1_4" tabindex="-1" data-toggle="tab">Option 4</a></li>
                                            </ul>
                                        </li>
                                    </ul>
                                    <div  class="tab-content">
                                        <div class="tab-pane fade active in" id="tab_1_1">
                                            <p>Raw denim you probably haven't heard of them jean shorts Austin. Nesciunt tofu stumptown aliqua, retro synth master cleanse. Mustache cliche tempor, williamsburg carles vegan helvetica. Reprehenderit butcher retro keffiyeh dreamcatcher synth. Cosby sweater eu banh mi, qui irure terry richardson ex squid. Aliquip placeat salvia cillum iphone. Seitan aliquip quis cardigan american apparel, butcher voluptate nisi qui.</p>
                                        </div>
                                        <div class="tab-pane fade" id="tab_1_2">
                                            <p>Food truck fixie locavore, accusamus mcsweeney's marfa nulla single-origin coffee squid. Exercitation +1 labore velit, blog sartorial PBR leggings next level wes anderson artisan four loko farm-to-table craft beer twee. Qui photo booth letterpress, commodo enim craft beer mlkshk aliquip jean shorts ullamco ad vinyl cillum PBR. Homo nostrud organic, assumenda labore aesthetic magna delectus mollit. Keytar helvetica VHS salvia yr, vero magna velit sapiente labore stumptown. Vegan fanny pack odio cillum wes anderson 8-bit, sustainable jean shorts beard ut DIY ethical culpa terry richardson biodiesel. Art party scenester stumptown, tumblr butcher vero sint qui sapiente accusamus tattooed echo park.</p>
                                        </div>
                                        <div class="tab-pane fade" id="tab_1_3">
                                            <p>Etsy mixtape wayfarers, ethical wes anderson tofu before they sold out mcsweeney's organic lomo retro fanny pack lo-fi farm-to-table readymade. Messenger bag gentrify pitchfork tattooed craft beer, iphone skateboard locavore carles etsy salvia banksy hoodie helvetica. DIY synth PBR banksy irony. Leggings gentrify squid 8-bit cred pitchfork. Williamsburg banh mi whatever gluten-free, carles pitchfork biodiesel fixie etsy retro mlkshk vice blog. Scenester cred you probably haven't heard of them, vinyl craft beer blog stumptown. Pitchfork sustainable tofu synth chambray yr.</p>
                                        </div>
                                        <div class="tab-pane fade" id="tab_1_4">
                                            <p>Trust fund seitan letterpress, keytar raw denim keffiyeh etsy art party before they sold out master cleanse gluten-free squid scenester freegan cosby sweater. Fanny pack portland seitan DIY, art party locavore wolf cliche high life echo park Austin. Cred vinyl keffiyeh DIY salvia PBR, banh mi before they sold out farm-to-table VHS viral locavore cosby sweater. Lomo wolf viral, mustache readymade thundercats keffiyeh craft beer marfa ethical. Wolf salvia freegan, sartorial keffiyeh echo park vegan.</p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="item">
                            <div class="portlet box blue">
                                <div class="portlet-title">
                                    <div class="caption"><i class="fa fa-reorder"></i>Default Tabs</div>
                                    <div class="tools">
                                        <a href="javascript:;" class="collapse"></a>
                                        <a href="#portlet-config" data-toggle="modal" class="config"></a>
                                    </div>
                                </div>
                                <div class="portlet-body">
                                    <ul  class="nav nav-tabs">
                                        <li class="active"><a href="#tab_1_1" data-toggle="tab">Home</a></li>
                                        <li class=""><a href="#tab_1_2" data-toggle="tab">Profile</a></li>
                                        <li class="dropdown">
                                            <a href="#"  class="dropdown-toggle" data-toggle="dropdown">Dropdown <i class="fa fa-angle-down"></i></a>
                                            <ul class="dropdown-menu" role="menu">
                                                <li><a href="#tab_1_3" tabindex="-1" data-toggle="tab">Option 1</a></li>
                                                <li><a href="#tab_1_4" tabindex="-1" data-toggle="tab">Option 2</a></li>
                                                <li><a href="#tab_1_3" tabindex="-1" data-toggle="tab">Option 3</a></li>
                                                <li><a href="#tab_1_4" tabindex="-1" data-toggle="tab">Option 4</a></li>
                                            </ul>
                                        </li>
                                    </ul>
                                    <div  class="tab-content">
                                        <div class="tab-pane fade active in" id="tab_1_1">
                                            <p>Raw denim you probably haven't heard of them jean shorts Austin. Nesciunt tofu stumptown aliqua, retro synth master cleanse. Mustache cliche tempor, williamsburg carles vegan helvetica. Reprehenderit butcher retro keffiyeh dreamcatcher synth. Cosby sweater eu banh mi, qui irure terry richardson ex squid. Aliquip placeat salvia cillum iphone. Seitan aliquip quis cardigan american apparel, butcher voluptate nisi qui.</p>
                                        </div>
                                        <div class="tab-pane fade" id="tab_1_2">
                                            <p>Food truck fixie locavore, accusamus mcsweeney's marfa nulla single-origin coffee squid. Exercitation +1 labore velit, blog sartorial PBR leggings next level wes anderson artisan four loko farm-to-table craft beer twee. Qui photo booth letterpress, commodo enim craft beer mlkshk aliquip jean shorts ullamco ad vinyl cillum PBR. Homo nostrud organic, assumenda labore aesthetic magna delectus mollit. Keytar helvetica VHS salvia yr, vero magna velit sapiente labore stumptown. Vegan fanny pack odio cillum wes anderson 8-bit, sustainable jean shorts beard ut DIY ethical culpa terry richardson biodiesel. Art party scenester stumptown, tumblr butcher vero sint qui sapiente accusamus tattooed echo park.</p>
                                        </div>
                                        <div class="tab-pane fade" id="tab_1_3">
                                            <p>Etsy mixtape wayfarers, ethical wes anderson tofu before they sold out mcsweeney's organic lomo retro fanny pack lo-fi farm-to-table readymade. Messenger bag gentrify pitchfork tattooed craft beer, iphone skateboard locavore carles etsy salvia banksy hoodie helvetica. DIY synth PBR banksy irony. Leggings gentrify squid 8-bit cred pitchfork. Williamsburg banh mi whatever gluten-free, carles pitchfork biodiesel fixie etsy retro mlkshk vice blog. Scenester cred you probably haven't heard of them, vinyl craft beer blog stumptown. Pitchfork sustainable tofu synth chambray yr.</p>
                                        </div>
                                        <div class="tab-pane fade" id="tab_1_4">
                                            <p>Trust fund seitan letterpress, keytar raw denim keffiyeh etsy art party before they sold out master cleanse gluten-free squid scenester freegan cosby sweater. Fanny pack portland seitan DIY, art party locavore wolf cliche high life echo park Austin. Cred vinyl keffiyeh DIY salvia PBR, banh mi before they sold out farm-to-table VHS viral locavore cosby sweater. Lomo wolf viral, mustache readymade thundercats keffiyeh craft beer marfa ethical. Wolf salvia freegan, sartorial keffiyeh echo park vegan.</p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <a class="carousel-control left" href="#promo_carousel" data-slide="prev">
                        <i class="m-icon-big-swapleft"></i>
                    </a>
                    <a class="carousel-control right" href="#promo_carousel" data-slide="next">
                        <i class="m-icon-big-swapright"></i>
                    </a>
                    <!-- Indicators -->
                    <ol class="carousel-indicators">
                        <li data-target="#promo_carousel" data-slide-to="0" class="active"></li>
                        <li data-target="#promo_carousel" data-slide-to="1"></li>
                    </ol>
                </div>
            </div>
        </div>
    </div>
</div>


<h2><?php echo __('Posts'); ?></h2>
<?php //pr($lastTradeInfo); ?>


<?php
/**
ADDING JS BY ELEMENT ( THAT IS PREVIOUSLY GROUPED SOME JS ) TO DEFAULT LAYOUT.
IT WILL BE ADDED WHERE echo $this->fetch('scipt') IS CALLED IN DEFAULT LAYOUT.
*/

echo $this->element('script_element/core_script2');

/**
ADDING DIRECTLY PAGE LEVEL SCRIPT FROM VIEW TO DEFAULT LAYOUT SCRIPT BLOCK. NO ECHO NEEDED. INLINE FALSE MUST BE SET.
*/

$this->Html->script('assets/plugins/select2/select2.min.js',array('inline' => false));
$this->Html->script('assets/plugins/bootstrap/js/bootstrap2-typeahead.min.js',array('inline' => false));
$this->Html->script('assets/scripts/app.js',array('inline' => false));
$this->Html->script('assets/scripts/custom.js',array('inline' => false));

?>

<?php
/**
WRITE SCRIPT TO ADD AT THE END OF DEFAULT LAYOUT WHERE $this->fetch('view_script'); IS CALLED
*/

$this->start('view_script');
?>
<script>
    jQuery(document).ready(function () {
        App.init();
        Custom.init();
       // Index.init();

        //Index.initCalendar(); // init index page's custom scripts
        $('.page-sidebar .ajaxify.start').click() // load the content for the dashboard page.


        $( ".page-breadcrumb> .btn-group" ).on({
            click: function() {
                alert( 'page title here' );
            }
        });

       /* $(".portlet > .portlet-title > .tools > a.reload").click(function(e){
            e.preventDefault();
            alert($(this).attr("href"));
            var ajaxUrl=$(this).attr("href");
            var str = $(this).attr("href");
            var res = str.split("/");
            res.reverse();

            var updateBlock='marketshome';
            updateBlock=res[1]+res[0];
            $.post(ajaxUrl,
                    {
                        name:"Donald Duck",
                        city:"Duckburg"
                    },
                    function(data,status){
                        //alert("Data: " + data + "\nStatus: " + status);
                        alert(updateBlock+"=marketshome");
                        //$(".portlet > .portlet-body").text("Hello world!"+updateBlock);
                        $("#"+updateBlock).text("Hello world!"+updateBlock);

                    });
        });*/


    });

</script>

<?php echo $this->HighCharts->render('Pie Chart'); ?>
<?php echo $this->HighCharts->render('AreaSpline Chart'); ?>
<?php $this->end(); ?>

