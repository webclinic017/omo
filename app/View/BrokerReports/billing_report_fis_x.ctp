
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
                        <i class="fa fa-sliders"></i> symbol
                    </th>
                     <th>
                        <i class="fa fa-sliders"></i> side
                    </th>

                     <th>
                        <i class="fa fa-sliders"></i> execute_qty
                    </th>

                     <th>
                        <i class="fa fa-sliders"></i> execute_price
                    </th>

                     <th>
                        <i class="fa fa-sliders"></i> Total
                    </th>

                     <th>
                        <i class="fa fa-sliders"></i> execute_time
                    </th>

                     <th>
                        <i class="fa fa-sliders"></i> execution_id
                    </th>

                     <th>
                        <i class="fa fa-sliders"></i> order_id
                    </th>


                </tr>
                </thead>
                <tbody id="">

                    <?php
                    $i=1;
                    $grandTotal=0;
                    foreach($report as $trans_groupby_client_ac ){
                    foreach($trans_groupby_client_ac as $trans ){
                        ?>
                           <tr>
                               <td>
                                    <?=$i?>
                                 </td>
                               <td> <?=$trans['client_ac']?> </td>
                               <td> <?=$trans['symbol']?> </td>
                               <td> <?=$trans['side']?> </td>
                               <td> <?=$trans['execute_qty']?> </td>
                               <td> <?=$trans['execute_price']?> </td>
                               <td> <?php echo $trans['execute_qty']*$trans['execute_price']; ?> </td>
                               <td> <?=$trans['execute_time']?> </td>
                               <td> <?=$trans['execution_id']?> </td>
                               <td> <?=$trans['order_id']?> </td>

                          </tr>
                    <?php
                        $i++;
                        $grandTotal+=$trans['execute_qty']*$trans['execute_price'];
                    }
                    }
                    ?>

                </tbody>
            </table>

    <h2>Grand Total= <?=$grandTotal?></h2>

</div>


