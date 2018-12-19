
<div class="col-md-12" id="summery_table_div">
                <div class="portlet-title">
                    <div class="caption">
                        <i class="icon-puzzle font-red-flamingo"></i>
                                                    <span class="caption-subject bold font-red-flamingo uppercase">Total Trade Report </span>
                        <span class="caption-helper hidden-xs"></span>
                    </div>
                </div>

              <table class="table table-striped table-bordered table-advance table-hover" id="deposit_summery_table">
                <thead>
                <tr>
                    <th>

                        <i class="fa fa-sliders"></i> SL No.
                    </th>

                    <th>

                        <i class="fa fa-sliders"></i> client_ac
                    </th>

                    <th>
                        <i class="fa fa-sliders"></i> Total Trade
                    </th>
                     <th>
                        <i class="fa fa-sliders"></i> Total commission
                    </th>

                </tr>
                </thead>
                <tbody id="">

                    <?php
                    $i=1;
                    $grandTotal=0;
                    $grandCom=0;
                    foreach($report as $client=>$data ){

                        ?>
                           <tr>
                               <td>
                                    <?=$i?>
                                 </td>
                               <td> <?= $client?> </td>
                               <td> <?= $data['total_trade']?> </td>
                               <td> <?= $data['commission']?> </td>

                          </tr>
                    <?php
                        $i++;
                        $grandTotal+= $data['total_trade'];
                        $grandCom+= $data['commission'];

                    }
                    ?>

                </tbody>
            </table>

    <h2>Grand Total trade= <?=$grandTotal?> | Total Commission= <?= $grandCom ?></h2>

</div>


