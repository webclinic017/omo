<!-- Inline false must be set.
$this->Html->css('assets/plugins/select2/select2_metro',null,array('rel' => "stylesheet")); will not work.
No echo needed.
-->
<!-- BEGIN THEME STYLES -->
<?php
$this->Html->css('assets/css/style-metronic',null,array('rel' => "stylesheet",'inline' => false));
$this->Html->css('assets/css/style',null,array('rel' => "stylesheet",'inline' => false));
$this->Html->css('assets/css/style-responsive',null,array('rel' => "stylesheet",'inline' => false));
$this->Html->css('assets/css/plugins',null,array('rel' => "stylesheet",'inline' => false));
$this->Html->css('assets/css/themes/default',null,array('rel' => "stylesheet",'inline' => false,'id' => "style_color"));
$this->Html->css('assets/css/custom',null,array('rel' => "stylesheet",'inline' => false));
?>
<!-- END THEME STYLES -->