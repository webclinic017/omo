<!-- Inline false must be set.
$this->Html->css('assets/plugins/select2/select2_metro',null,array('rel' => "stylesheet")); will not work.
No echo needed.
-->
<!-- BEGIN GLOBAL MANDATORY STYLES -->
<link href="http://fonts.googleapis.com/css?family=Open+Sans:400,300,600,700&subset=all" rel="stylesheet" type="text/css"/>
<?php
$this->Html->css('assets/plugins/font-awesome/css/font-awesome.min',null,array('rel' => 'stylesheet','inline' => false));
$this->Html->css('assets/plugins/bootstrap/css/bootstrap.min',null,array('rel' => 'stylesheet','inline' => false));
$this->Html->css('assets/plugins/uniform/css/uniform.default',null,array('rel' => 'stylesheet','inline' => false));
?>
<!-- END GLOBAL MANDATORY STYLES -->
