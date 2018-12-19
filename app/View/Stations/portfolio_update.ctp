<?php
//$userPerSlot=15;
$slot=$totalUser/$userPerSlot;
for($i=0;$i<$slot;++$i)
{
    $fromUser=$i*$userPerSlot;
    $toUser=$fromUser+$userPerSlot;
?>
<a target="_blank" href="<?php echo Router::url('/', true)?>Stations/portfolio_update_script/<?php echo $fromUser; ?>/<?php echo $toUser; ?>">Update portfolio from <?php echo $fromUser; ?> to <?php echo $toUser; ?> </a><br />

<?php }?>