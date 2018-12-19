<!-- Inline false must be set.
$this->Html->css('assets/plugins/select2/select2_metro',null,array('rel' => "stylesheet")); will not work.
No echo needed.
-->
<!-- BEGIN PAGE LEVEL STYLES -->
<?php
    $this->Html->css('assets/plugins/select2/select2',null,array('rel' => "stylesheet",'inline' => false));
    $this->Html->css('assets/plugins/select2/select2-metronic',null,array('rel' => "stylesheet",'inline' => false));

?>
<!-- END PAGE LEVEL STYLES -->

