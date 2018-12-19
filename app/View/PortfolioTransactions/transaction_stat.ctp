<div class="portlet light">
    <div class="portlet-body">
        <div class="row">
            <div class="col-md-12">
                <table class="table table-striped table-bordered table-advance table-hover" id="ptable">
                    <thead>
<?php echo $this->Html->tableHeaders($tableHead);?>
                    </thead>
<?php echo $this->Html->tableCells($allTransactions);?>
                 </table>
            </div>
        </div>
    </div>
</div>

<script>
$(function () {


    $('#ptable').DataTable();

});

</script>
