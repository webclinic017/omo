<!--
<div class="row">
    <div class="col-lg-12 col-md-12 col-sm-6 col-xs-12">
        <div id="value_div"></div>
    </div>
</div>
<?php echo $this->HighCharts->render('value Chart'); ?>-->

<?php echo $this->element($this->params['action']); ?>
<?php echo $this->HighCharts->render('value Chart'); ?>