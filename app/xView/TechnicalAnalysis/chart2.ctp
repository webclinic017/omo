<?php
$activeMenuId='active_'.$this->params['controller'].'_'.$this->params['action'];
/**
IT WILL BE ADDED WHERE echo $this->fetch('css') IS CALLED IN DEFAULT LAYOUT.
*/
echo $this->element('css_element/all');

/**
ADDING DIRECTLY A CSS FROM VIEW TO DEFAULT LAYOUT CSS BLOCK. NO ECHO NEEDED. INLINE FALSE MUST BE SET.
EXAMPLE : $this->Html->css('assets/css/style-metronic', null, array('inline' => false));
*/
$this->Html->css('assets/plugins/jstree/dist/themes/default/style.min', null, array('inline' => false));
$this->Html->css('assets/plugins/bootstrap-switch/css/bootstrap-switch.min', null, array('inline' => false));
?>

<!-- TODO: ITS ALWAYS ADDING MENUE TO THE TOP.ITS WORKING LIKE PREPEND BUT APPEND IS NOT WORKING. FIND OUT A SOLUTION -->



<!--/////////////////////////////////////////////////////////////////////////////////-->


<?php
/**
IT WILL BE ADDED WHERE echo $this->fetch('scipt') IS CALLED IN DEFAULT LAYOUT.
*/

echo $this->element('script_element/all');

/**
ADDING DIRECTLY PAGE LEVEL SCRIPT FROM VIEW TO DEFAULT LAYOUT SCRIPT BLOCK. NO ECHO NEEDED. INLINE FALSE MUST BE SET.
EXAMPLE: $this->Html->script('assets/scripts/portlet-draggable.js',array('inline' => false));
*/

$this->Html->script('assets/plugins/jstree/dist/jstree.min.js',array('inline' => false));
$this->Html->script('assets/scripts/custom/ui-tree.js',array('inline' => false));
$this->Html->script('assets/scripts/custom/portlet-draggable.js',array('inline' => false));
$this->Html->script('assets/plugins/bootstrap-switch/js/bootstrap-switch.min.js',array('inline' => false));
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

    })

</script>

<?php $this->end(); ?>

