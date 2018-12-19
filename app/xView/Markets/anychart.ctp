<?php
$activeMenuId='active_'.$this->params['controller'].'_'.$this->params['action'];
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

$this->Html->css('assets/css/style-metronic', null, array('inline' => false));
$this->Html->css('assets/css/pages/coming-soon', null, array('inline' => false));
$this->Html->css('assets/plugins/bootstrap-modal/css/bootstrap-modal-bs3patch', null, array('inline' => false));
$this->Html->css('assets/plugins/bootstrap-modal/css/bootstrap-modal', null, array('inline' => false));
$this->Html->css('assets/plugins/bootstrap-markdown/css/bootstrap-markdown.min', null, array('inline' => false));

?>
<?php
$this->start('countdown');
?>

<div class="col-md-5 hidden-xs hidden-sm col-md-offset-2 navbar-left">
    <button type="button" class="btn btn-lg green"><?php echo __($remainingText);?></button>
                <span class="coming-soon-countdown">
                   <span id="defaultCountdown"></span>
                </span>
</div>
<?php $this->end(); ?>

<!-- TODO: ITS ALWAYS ADDING MENUE TO THE TOP.ITS WORKING LIKE PREPEND BUT APPEND IS NOT WORKING. FIND OUT A SOLUTION -->

<?php
echo $this->element('layout_element/side_bar2');
?>

<!-- TODO: ADS MANAGEMENT FROM ADMIN SHOULD BE IMPLEMENTED -->
<!-- BEGIN TOP ADS BLOCK-->
<div class="row">
    <div class="col-md-12 hidden-xs hidden-sm">
        <?php echo $this->Html->image('assets/img/stock_bangladesh_vat_center.gif', array('class' => 'middle-footer-widget img-responsive'));?>
    </div>

</div>
<!--/////////////////////////////////////////////////////////////////////////////-->





<div class="row">
    <div id="chartContainer"><!-- Chart Container --></div>
</div>



<!--/////////////////////////////////////////////////////////////////////////////////-->


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
$this->Html->script('assets/plugins/countdown/jquery.countdown.js',array('inline' => false));

$this->Html->script('assets/plugins/bootstrap-modal/js/bootstrap-modalmanager.js',array('inline' => false));
$this->Html->script('assets/plugins/bootstrap-modal/js/bootstrap-modal.js',array('inline' => false));

$this->Html->script('assets/plugins/jquery-validation/dist/jquery.validate.min.js',array('inline' => false));
$this->Html->script('assets/plugins/jquery.metadata/jquery.metadata.min.js',array('inline' => false));
$this->Html->script('assets/plugins/bootstrap-markdown/js/bootstrap-markdown.js',array('inline' => false));
$this->Html->script('assets/plugins/jquery.pwstrength.bootstrap/src/pwstrength.js',array('inline' => false));
$this->Html->script('assets/plugins/jquery-inputmask/jquery.inputmask.bundle.min.js',array('inline' => false));

$this->Html->script('assets/scripts/jquery.vticker.min.js',array('inline' => false));
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
        //FormComponents.init();
        //UIExtendedModals.init();
        Custom.init();
        // Index.init();

        //Index.initCalendar(); // init index page's custom scripts
        $('.page-sidebar .ajaxify.start').click() // load the content for the dashboard page.


    })

</script>

<script type="text/javascript" language="javascript" src="<?php echo Router::url('/', true);?>js/AnyChartStock.js?v=1.0.0r7416"></script>
<!--<?php echo $this->Html->script('assets/scripts/AnyChartStock.js',array('inline' => false)); ?>-->

<script type="text/javascript" language="javascript">
    // Creating new chart object.
    /*var chart = new AnyChartStock("<?php echo Router::url('/', true);?>assets/swf/AnyChartStock.swf?v=1.0.0r7416", "<?php echo Router::url('/', true);?>assets/swf/Preloader.swf?v=1.0.0r7416");*/
    var chart = new AnyChartStock("<?php echo Router::url('/', true);?>swf/AnyChartStock.swf?v=1.0.0r7416", "<?php echo Router::url('/', true);?>swf/Preloader.swf?v=1.0.0r7416");
    // Setting XML config file.
    chart.setXMLFile("<?php echo Router::url('/', true);?>config.xml");
    // Writing the flash object into the page DOM.
    chart.write("chartContainer");
</script>
<?php $this->end(); ?>

