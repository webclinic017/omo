<div class="navbar-inner">
<div class="container-fluid">
<!-- BEGIN LOGO -->
<?php
    echo $this->Html->link(
$this->Html->image('assets/img/logo.gif', array('alt' => 'logo', 'border' => '0', 'class' => 'img-responsive')),
'/',
array('class' => 'navbar-brand', 'escape' => false)
);
?>
<!-- END LOGO -->
<div class="col-md-5 hidden-xs hidden-sm col-md-offset-2 navbar-left">
    <button type="button" class="btn btn-lg green"><?php echo $remainingText;?></button>
    <span class="coming-soon-countdown">
           <span id="defaultCountdown"></span>
        </span>


</div>

<!-- BEGIN TOP NAVIGATION MENU -->
<ul class="nav navbar-nav pull-right">
<!-- BEGIN UNREGISTER PANEL BUTTON -->
<?php //echo $this->fetch('unregistered'); ?>
<!-- END UNREGISTER PANEL BUTTON -->


<!-- BEGIN REGISTER PANEL BUTTON -->
<?php echo $this->fetch('registered'); ?>
<!-- END REGISTER PANEL BUTTON -->




</ul>
<!-- END TOP NAVIGATION MENU -->
</div>
</div>