<div class="row">
    <div class="col-lg-12 col-md-12 col-sm-6 col-xs-12">
        <div id="<?php echo $chartData['div'];?>"></div>
    </div>
</div>
<?php echo $this->element('hchart/minute_chart_template',array('chartData' => $chartData)); ?>
