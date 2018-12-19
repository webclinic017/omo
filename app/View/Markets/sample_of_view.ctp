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

$this->Html->css('assets/plugins/bootstrap/css/bootstrap.min', null, array('inline' => false));
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


<!-- BEGIN PAGE HEADER-->
<div class="row">
    <div class="col-md-12">
        <!-- BEGIN PAGE TITLE & BREADCRUMB-->
        <h3 class="page-title">
            Dashboard
            <small>statistics and more</small>
        </h3>
        <ul class="page-breadcrumb breadcrumb">
            <li>
                <i class="fa fa-home"></i>
                <a href="index.html">Home</a>
                <i class="fa fa-angle-right"></i>
            </li>
            <li><a href="#">Dashboard</a></li>
            <li class="pull-right">
                <div id="dashboard-report-range" class="dashboard-date-range tooltips" data-placement="top"
                     data-original-title="Change dashboard date range">
                    <i class="fa fa-calendar"></i>
                    <span></span>
                    <i class="fa fa-angle-down"></i>
                </div>
            </li>
        </ul>
        <!-- END PAGE TITLE & BREADCRUMB-->
    </div>
</div>
<!-- END PAGE HEADER-->

<h2><?php echo __('Posts'); ?></h2>


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
$this->Html->script('assets/scripts/app.js',array('inline' => false));

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
        Index.init();
        Index.initCalendar(); // init index page's custom scripts
        $('.page-sidebar .ajaxify.start').click() // load the content for the dashboard page.
    });
</script>


<?php $this->end(); ?>

