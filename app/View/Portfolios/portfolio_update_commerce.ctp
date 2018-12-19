<?php
//$userPerSlot=15;
$slot=$totalUser/$userPerSlot;
$irnArr=array_keys($brokerUsers);
for($i=0;$i<$slot;++$i)
{

    $fromUser=$i*$userPerSlot;
    $toUser=$fromUser+$userPerSlot;

    $output = array_slice($irnArr, $fromUser, $userPerSlot);
    $codestr= $this->Text->toList($output);
    //echo "$codestr";
?>
    <a target="_blank" href="<?php echo Router::url('/', true)?>Portfolios/portfolio_update_script_commerce/<?php echo $fromUser; ?>/<?php echo $toUser; ?>">Update portfolio from <?php echo $fromUser; ?> to <?php echo $toUser; ?> </a>   <?php echo $codestr;?><br />

<?php

}?>