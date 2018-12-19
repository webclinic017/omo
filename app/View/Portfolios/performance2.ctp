<?php
$GrandTotalSaleValue=$this->Portfolio->calculateGrandTotalSaleValue($portfolioHoldingsTransaction,$portfolioCommission,$balance,0);
$unrealizedGainLoss=$this->Portfolio->calculateTotalGainLossSincePurchase($portfolioHoldingsTransaction,$portfolioCommission,0);
$remainingInvestment=$total_deposit-$total_withdraw;

$realizedGainLoss=$GrandTotalSaleValue-$remainingInvestment;
$realizedGainLoss=$realizedGainLoss-$unrealizedGainLoss;
?>
<div class="row">

    <div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">
        <a class="dashboard-stat dashboard-stat-light blue-soft" href="#">
            <div class="visual">
                <i class="fa fa-comments"></i>
            </div>
            <div class="details">
                <div class="number">
                    <?php echo $this->Number->currency($total_deposit, ''); ?>
                </div>
                <div class="desc">
                    Total Deposit
                </div>
                <div class="desc">
                   <td> Trade Commission :</td><td> <?php echo $broker_fee .tk; ?></td>
                </div>
            </div>
        </a>
     <span class="help-block" id="market_price_help">
												<code>update: <?php echo $this->Time->niceShort($total_stats_updated); ?></code>
												</span>
    </div>
    <div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">
        <a class="dashboard-stat dashboard-stat-light red-soft" href="#">
            <div class="visual">
                <i class="fa fa-trophy"></i>
            </div>
            <div class="details">
                <div class="number">
                    <?php echo $this->Number->currency($total_withdraw, ''); ?>
                </div>
                <div class="desc">
                    Total Withdraw
                </div>
            </div>
        </a>
       <span class="help-block" id="market_price_help">
												<code>update: <?php echo $this->Time->niceShort($total_stats_updated); ?></code>
												</span>
    </div>
    <!--<a href="#" class="tooltips" data-original-title="Very long toolips Very long toolips Very long toolips Very long toolips">
        you probably </a>-->
    <div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">
        <a class="dashboard-stat dashboard-stat-light green-soft" href="#" data-original-title="Very long toolips Very long toolips Very long toolips Very long toolips">
            <div class="visual">
                <i class="fa fa-shopping-cart"></i>
            </div>
            <div class="details">
                <div class="number">
                    <?php echo $this->Number->currency($total_realized, ''); ?>
                </div>
                <div class="desc">
                    Realized Gain/Loss
                </div>
            </div>
        </a>
        <span class="help-block" id="market_price_help">
												<code>update: <?php echo $this->Time->niceShort($total_stats_updated); ?></code>
												</span>
    </div>
    <div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">
        <a class="dashboard-stat dashboard-stat-light purple-soft" href="#">
            <div class="visual">
                <i class="fa fa-globe"></i>
            </div>
            <div class="details">
                <div class="number">
                    <?php echo $this->Number->currency($unrealizedGainLoss, ''); ?>
                </div>
                <div class="desc">
                    Unrealized Gain/Loss
                </div>
            </div>
        </a>
        <span class="help-block" id="market_price_help">
												<code>Calculated realtime</code>
												</span>
    </div>
</div>


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
    <th colspan="7">
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
        Code
    </td>
    <td class="hidden-xs">
        Market
    </td>
    <td>
        ltp
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
        Matured
    </td>
    <td>
        Buy Price
    </td>
    <td>
        Purchase Date
    </td>
    <td>
        Buy Com
    </td>
    <td>
        Total Purchase
    </td>
    <td>
        Gain/Loss
    </td>
    <td>
        %Chng
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
            <?php echo $scripArr['saleAbleShares'];?>
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
//pr($temp);
?>


<script>

    $(function () {
        var childRowData=<?php echo $temp; ?>;
        Custom.initPortfolioTable(childRowData);  //from custom.js

    });

</script>

