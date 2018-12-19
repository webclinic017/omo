<td>
<?php if($change<0){ ?>
<span class="inlinesparkline"  sparklineColor ="red"><?php echo $this->Text->toList($chartData,','); ?></span>
<?php } else {?>

<span class="inlinesparkline"  sparklineColor ="green"><?php echo $this->Text->toList($chartData,','); ?></span>

<?php }?>
</td>

<td>
<?php if($change<0){ ?>
<span class="inlinesparkline"  sparkType="bar" sparkBarColor="red"><?php echo $this->Text->toList($chartDataV,','); ?></span>
<?php } else {?>

<span class="inlinesparkline"  sparkType="bar" sparkBarColor="green"><?php echo $this->Text->toList($chartDataV,','); ?></span>

<?php }?>
</td>