<!-- Inline false must be set.
$this->Html->script('assets/plugins/select2/select2_metro',null,array('rel' => "stylesheet")); will not work.
No echo needed.
-->
<!-- BEGIN CORE PLUGINS -->
<?php
$this->Html->script('assets/plugins/jquery-1.10.2.min.js',array('inline' => false));
$this->Html->script('assets/plugins/jquery-migrate-1.2.1.min.js',array('inline' => false));
//<!-- IMPORTANT! Load jquery-ui-1.10.3.custom.min.js before bootstrap.min.js to fix bootstrap tooltip conflict with jquery ui tooltip -->
$this->Html->script('assets/plugins/jquery-ui/jquery-ui-1.10.3.custom.min.js',array('inline' => false));
$this->Html->script('assets/plugins/bootstrap/js/bootstrap.min.js',array('inline' => false));
$this->Html->script('assets/plugins/bootstrap-hover-dropdown/bootstrap-hover-dropdown.min.js',array('inline' => false));
$this->Html->script('assets/plugins/jquery-slimscroll/jquery.slimscroll.min.js',array('inline' => false));
$this->Html->script('assets/plugins/jquery.blockui.min.js',array('inline' => false));
$this->Html->script('assets/plugins/jquery.cokie.min.js',array('inline' => false));
$this->Html->script('assets/plugins/uniform/jquery.uniform.min.js',array('inline' => false));
?>

<!-- END CORE PLUGINS -->
