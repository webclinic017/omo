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
$this->Html->css('assets/plugins/bootstrap-modal/css/bootstrap-modal-bs3patch', null, array('inline' => false));
$this->Html->css('assets/plugins/bootstrap-modal/css/bootstrap-modal', null, array('inline' => false));
$this->Html->css('assets/plugins/bootstrap-markdown/css/bootstrap-markdown.min', null, array('inline' => false));

$this->Html->css('assets/plugins/select2/select2-metronic',null,array('rel' => "stylesheet",'inline' => false));

$this->Html->css('assets/css/style-metronic',null,array('rel' => "stylesheet",'inline' => false));
$this->Html->css('assets/css/style',null,array('rel' => "stylesheet",'inline' => false));
$this->Html->css('assets/css/style-responsive',null,array('rel' => "stylesheet",'inline' => false));
$this->Html->css('assets/css/plugins',null,array('rel' => "stylesheet",'inline' => false));
$this->Html->css('assets/css/themes/default',null,array('rel' => "stylesheet",'inline' => false,'id' => "style_color"));
$this->Html->css('assets/css/custom',null,array('rel' => "stylesheet",'inline' => false));
?>
<!-- END GLOBAL MANDATORY STYLES -->
