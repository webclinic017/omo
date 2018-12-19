<table class="table table-striped table-bordered table-hover" id="sample_3" >
<thead>
<tr>
    <th colspan="3">
        <i class="fa fa-briefcase"></i>
    </th>
    <th colspan="3">
        <i class="fa fa-user"></i> Today
    </th>
    <th colspan="3">

    </th>
    <th colspan="6">
        <i class="fa fa-shopping-cart"></i> Since Purchased
    </th>
</tr>
<tr>
    <th>

    </th>
    <th>

    </th>
    <th>

    </th>

    <th>

    </th>
    <th>

    </th>
    <th>

    </th>
    <th>

    </th>
    <th>

    </th>
    <th>

    </th>
    <th>

    </th>
    <th>

    </th>
    <th>

    </th>
    <th>

    </th>
    <th>

    </th>
</tr>
<!--<tr class="info">
    <th>
        Company Code
    </th>
    <th>
        Market
    </th>
    <th>
        Last Trade Price
    </th>

    <th>
        Change
    </th>
    <th>
        Gain/Loss
    </th>
    <th>
        Shares
    </th>
    <th>
        Buy Price
    </th>
    <th>
        Purchase Date
    </th>
    <th>
        Buy Commission
    </th>
    <th>
        Total Purchase
    </th>
    <th>
        Gain/Loss
    </th>
    <th>
        %Change
    </th>
    <th>
        %Portfolio
    </th>
    <th>
        Sell Value
    </th>
</tr>-->
</thead>
<tbody>
<tr class="info">

    <td class="highlight">
        Company Code
    </td>
    <td class="hidden-xs">
        Market
    </td>
    <td>
        Last Trade Price
    </td>

    <td>
        Change
    </td>
    <td>
        Gain/Loss
    </td>
    <td>
        Shares
    </td>
    <td>
        Buy Price
    </td>
    <td>
        Purchase Date
    </td>
    <td>
        Buy Commission
    </td>
    <td>
        Total Purchase
    </td>
    <td>
        Gain/Loss
    </td>
    <td>
        %Change
    </td>
    <td>
        %P
    </td>
    <td>
        Sell Value
    </td>
</tr>
<?php foreach($portfolioHoldingsTransaction as $instrumentId=>$scripArr ) {?>
<tr>
    <td class="highlight">


        <?php echo $instrumentInfo[$instrumentId]['Instrument']['instrument_code'];?>
    </td>
    <td class="hidden-xs">
        <?php echo $instrumentInfo[$instrumentId]['Exchange']['name'];?>
    </td>
    <td>
        <?php echo $this->StockBangladesh->getLastTradePrice($scripArr['lastTradeInfo']); ?>
    </td>

    <td>
        <?php echo $this->Portfolio->getPriceChange($scripArr); ?>

    </td>
    <td>
        <?php  echo $this->Portfolio->calculateTodayGainLoss($scripArr,$this->StockBangladesh->getPriceChange($scripArr['lastTradeInfo']));?>
    </td>
    <td>
        <?php echo $scripArr['totalQuantity'];?>
    </td>
    <td>
        <?php  echo $this->StockBangladesh->niceNumber($scripArr['avgCost']);     ?>
    </td>
    <td>
        <?php  echo $this->Portfolio->getPurchaseDate($scripArr);?>
    </td>
    <td>
        <?php  echo $this->Portfolio->calculateCommission($scripArr,$portfolioCommission);?>
    </td>
    <td>
        <?php  echo $this->Portfolio->calculateTotalPurchase($scripArr,$portfolioCommission);?>
    </td>
    <td>
        <?php  echo $this->Portfolio->calculateGainLossSincePurchase($scripArr,$portfolioCommission);?>

    </td>
    <td>
        <?php  echo $this->Portfolio->calculateGainLossChangeSincePurchase($scripArr,$portfolioCommission);?>
    </td>
    <td>

        <?php  echo $this->Portfolio->calculatePortfolioPer($portfolioHoldingsTransaction,$balance,$portfolioCommission,$instrumentId);?>
    </td>
    <td>
        <?php  echo $this->Portfolio->calculateTotalSaleValue($scripArr,$portfolioCommission);?>
    </td>
</tr>
<?php } ?>
<tr class="info">
    <td class="highlight">
        Cash

    </td>
    <td class="hidden-xs">

    </td>
    <td>

    </td>

    <td>


    </td>
    <td>

    </td>
    <td>

    </td>
    <td>

    </td>
    <td>

    </td>
    <td>

    </td>
    <td>

    </td>
    <td>


    </td>
    <td>

    </td>
    <td>
        <?php  echo $this->Portfolio->calculatePortfolioPer($portfolioHoldingsTransaction,$balance,$portfolioCommission);?>

    </td>
    <td>
        <?php echo $balance; ?>
    </td>
</tr>
<tr>
    <td class="highlight">
        Total

    </td>
    <td class="hidden-xs">

    </td>
    <td>

    </td>

    <td>


    </td>
    <td>
        <?php  echo $this->Portfolio->calculateTodayTotalGainLoss($portfolioHoldingsTransaction);?>
    </td>
    <td>

    </td>
    <td>

    </td>
    <td>

    </td>
    <td>

    </td>
    <td>
        <?php  echo $this->Portfolio->calculateGrandTotalPurchase($portfolioHoldingsTransaction,$portfolioCommission);?>
    </td>
    <td>
        <?php  echo $this->Portfolio->calculateTotalGainLossSincePurchase($portfolioHoldingsTransaction,$portfolioCommission);?>

    </td>
    <td>
        <?php  echo $this->Portfolio->calculateChangeSincePurchase($portfolioHoldingsTransaction,$portfolioCommission,$balance);?>
    </td>
    <td>
        100%

    </td>
    <td>
        <?php  echo $this->Portfolio->calculateGrandTotalSaleValue($portfolioHoldingsTransaction,$portfolioCommission,$balance);?>
    </td>
</tr>
</tbody>


</table>


<?php   $temp=$this->Portfolio->generateChildRowArr($portfolioHoldingsTransaction,$portfolioCommission,$balance,$instrumentInfo);
//pr($portfolioHoldingsTransaction);
?>


<script>

    $(function () {
        var childRowData=<?php echo $temp; ?>;
        Custom.initPortfolioTable(childRowData);

    });

</script>

