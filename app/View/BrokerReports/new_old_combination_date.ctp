
<div class="col-md-12" id="summery_table_div">

    <div class="portlet-title">
        <div class="caption">
            <i class="icon-puzzle font-red-flamingo"></i>
            <span class="caption-subject bold font-red-flamingo uppercase">Client Wise Trade Volume </span>
            <span class="caption-helper hidden-xs"></span>
        </div>
    </div>

    <table class="table table-striped table-bordered table-advance table-hover" id="deposit_summery_table">
        <thead>
        <tr>


            <th>

                <i class="fa fa-sliders"></i> Client
            </th>

            <th>
                <i class="fa fa-sliders"></i> Total Volume
            </th>





        </tr>
        </thead>
        <tbody id="">

        <?php $i=1; foreach($array_data_old_transaction as $key=>$trans ){ ?>
            <tr>
                <td>
                    <?=$key?>
                </td>
                <td>
                    <?=$trans?>
                </td>



            </tr>

            <?php $i++; }  ?>

        <tr>
            <td>
            Total:
            </td>
            <td>
                <?= $totaltrade?>
            </td>


        </tr>

        </tbody>
    </table>
</div>


<div class="col-md-12" id="summery_table_div">

    <div class="portlet-title">
        <div class="caption">
            <i class="icon-puzzle font-red-flamingo"></i>
            <span class="caption-subject bold font-red-flamingo uppercase">Client Wise Commission Volume </span>
            <span class="caption-helper hidden-xs"></span>
        </div>
    </div>

    <table class="table table-striped table-bordered table-advance table-hover" id="deposit_summery_table">
        <thead>
        <tr>


            <th>

                <i class="fa fa-sliders"></i> Client
            </th>

            <th>
                <i class="fa fa-sliders"></i> Total Volume
            </th>





        </tr>
        </thead>
        <tbody id="">

        <?php $i=1; foreach($array_data_old_commission as $key=>$com ){ ?>
            <tr>
                <td>
                    <?=$key?>
                </td>
                <td>
                    <?=$com?>
                </td>



            </tr>

            <?php $i++; }  ?>

        <tr>
            <td>
            Total:
            </td>
            <td>
                <?= $totalcom?>
            </td>


        </tr>

        </tbody>
    </table>
</div>
