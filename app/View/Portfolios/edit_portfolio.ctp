<div class="table-toolbar">
    <div class="btn-group">
        <button id="sample_editable_11_new" class="btn green">
            Add New <i class="fa fa-plus"></i>
        </button>
    </div>
    <div class="btn-group pull-right">
        <button class="btn dropdown-toggle" data-toggle="dropdown">Tools <i class="fa fa-angle-down"></i>
        </button>
        <ul class="dropdown-menu pull-right">
            <li>
                <a href="#">
                    Print </a>
            </li>
            <li>
                <a href="#">
                    Save as PDF </a>
            </li>
            <li>
                <a href="#">
                    Export to Excel </a>
            </li>
        </ul>
    </div>
</div>
<table class="table table-striped table-hover table-bordered" id="portfolio_editable" portfolio_id="<?php echo $portfolioInfo['Portfolio']['id']?>">
    <thead>
    <tr>
        <th>
            Symbol
        </th>
        <th>
            Shares
        </th>
        <th>
            Price per share
        </th>
        <th>
            Commission%
        </th>
        <th>
            Date(yyyy/mm/dd)
        </th>
        <th>
            Sell
        </th>
        <th>
            Edit
        </th>
        <th>
            Delete
        </th>
    </tr>
    </thead>
    <tbody>
    <?php foreach ($portfolioHoldingsTransaction as $instrumentId=>$row){

    foreach ($row['transactions'] as $transaction){
    ?>
    <tr>
        <td >
            <?php echo $instrumentInfo[$instrumentId]['Instrument']['instrument_code'];?>
            <input type="hidden" value="<?php echo $transaction['id'];?>">
            <input type="hidden" value="<?php echo $instrumentId;?>">
        </td>
        <td>
            <?php echo $transaction['amount'];?>
        </td>
        <td>
            <?php echo $transaction['rate'];?>
        </td>
        <td class="center">
            <?php  echo $this->Portfolio->getCommission($transaction,$portfolioCommission);?>
        </td>
        <td class="center">
            <?php echo $this->Time->format($transaction['transaction_time'], '%d/%m/%y');?>
        </td>
        <td>
            <a class="sell" href="javascript:;">
                Sell </a>
        </td>
        <td>
            <a class="edit" href="javascript:;">
                Edit </a>
        </td>
        <td>
            <a class="delete" href="javascript:;">
                Delete </a>


        </td>
    </tr>

    <?php }
}
?>
    </tbody>
</table>



<script>

    $(function () {
        var sharelist=<?php echo $instrumentList; ?>;
        var portfolioCommission=<?php echo $portfolioCommission; ?>;
        var cakeToJsArr=<?php echo $cakeToJsArr; ?>;
        PortfolioTableEditable.initPortfolioEdit(portfolioCommission,sharelist,cakeToJsArr);

    });

</script>

