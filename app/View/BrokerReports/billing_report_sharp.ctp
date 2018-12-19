
<div class="col-md-12" id="summery_table_div">
                <div class="portlet-title">
                    <div class="caption">
                        <i class="icon-puzzle font-red-flamingo"></i>
                                                    <span class="caption-subject bold font-red-flamingo uppercase">date Wise Trade Volume</span>
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

                        <i class="fa fa-sliders"></i> Date
                    </th>

                    <th>
                        <i class="fa fa-sliders"></i> Total Volume
                    </th>
                     <th>
                        <i class="fa fa-sliders"></i> Commission
                    </th>


                </tr>
                </thead>
                <tbody id="">

                    <?php $i=1; foreach($dataPerDay as $key=>$day ){ ?>
                           <tr>
                               <td>
                                    <?=$i?>
                                 </td>
                               <td>
                                 <?=$day['date']?>
                              </td>
                              <td>
                              <?=$day['tradeAmountcode']?>
                              </td>
                               <td>
                               <?=$day['commissioncode']?>
                               </td>

                          </tr>
                    <?php  $i++; }?>

                        <tr>
                           <td>
                                ######
                             </td>
                           <td>
                             Total:
                          </td>
                          <td>
                          <?=$dataTotalForDays['totalTradeSummationcode']?>
                          </td>
                           <td>
                           <?=$dataTotalForDays['totalCommissionSummationcode']?>
                           </td>

                      </tr>

                </tbody>
            </table>

</div>





<div class="col-md-12" id="summery_table_div">

                    <div class="portlet-title">
                                <div class="caption">
                                    <i class="icon-puzzle font-red-flamingo"></i>
                                                                <span class="caption-subject bold font-red-flamingo uppercase">Client Wise Trade Volume</span>
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

                                    <i class="fa fa-sliders"></i> Client
                                </th>

                                <th>
                                    <i class="fa fa-sliders"></i> Total Volume
                                </th>
                                <th>
                                    <i class="fa fa-sliders"></i> Total Commission
                                </th>
                                <th>
                                    <i class="fa fa-sliders"></i> Commission Percentage
                                </th>



                            </tr>
                            </thead>
                            <tbody id="">

                                    <?php $i=1; foreach($dataPerClient as $key=>$client ){ ?>
                                       <tr>
                                           <td>
                                                <?=$i?>
                                             </td>
                                           <td>
                                             <?=$client['client']?>
                                          </td>
                                          <td>
                                          <?=$client['tradeAmountcode']?>
                                          </td>
                                          <td>
                                          <?=$client['commissioncode']?>
                                          </td>
                                          <td>
                                          <?=$client['commissionPer']?>
                                          </td>


                                      </tr>

                                     <?php $i++; }  ?>

                                    <tr>
                                           <td>
                                                ######
                                             </td>
                                           <td>
                                             Total:
                                          </td>
                                          <td>
                                          <?=$dataTotalForClient['totalTradeSummationcode']?>
                                          </td>
                                          <td>
                                          <?=$dataTotalForClient['totalCommissionSummationcode']?>
                                          </td>


                                      </tr>

                            </tbody>
                        </table>
</div>

<!--------------


<?php foreach($clientDetailsData as $unique=>$uniqClient ){ ?>


<div class="col-md-12" id="summery_table_div">
 <div class="portlet-title">
                    <div class="caption">
                        <i class="icon-puzzle font-red-flamingo"></i>
        											<span class="caption-subject bold font-red-flamingo uppercase"><?=$unique?> Client Details Trade Volume </span>
                        <span class="caption-helper hidden-xs"></span>
                    </div>
          </div>
 <table class="table table-striped table-bordered table-advance table-hover" id="deposit_summery_table">
                            <thead>
                            <tr>


                             	<th>

									<i class="fa fa-sliders"></i> Code
								</th>

                                <th>

                                    <i class="fa fa-sliders"></i> Date
                                </th>

                                <th>
                                    <i class="fa fa-sliders"></i> Instrument
                                </th>
                                <th>
                                    <i class="fa fa-sliders"></i> trade_time
                                </th>
                                <th>
                                    <i class="fa fa-sliders"></i> bought
                                </th>

                                <th>
                                    <i class="fa fa-sliders"></i> sold
                                </th>
                                <th>
                                    <i class="fa fa-sliders"></i> price
                                </th>
                                <th>
                                    <i class="fa fa-sliders"></i> broker_order_ref_no
                                </th>
                                <th>
                                    <i class="fa fa-sliders"></i> Total trade
                                </th>




                            </tr>
                            </thead>
                            <tbody id="">

                                   <?php foreach($clientDetailsData[$unique] as $key=>$clientData ){ ?>
                                                           <tr>

                                                              <td>
                                                                 <?=$clientData['code']?>
                                                              </td>
                                                              <td>
                                                              <?=$clientData['date']?>
                                                              </td>
                                                               <td>
                                                              <?=$clientData['instrument']?>
                                                              </td>
                                                              <td>
                                                              <?=$clientData['trade_time']?>
                                                              </td>

                                                              <?php if(strtolower($clientData['trade_type'])=="buy"){ ?>
                                                               <td>
                                                              <?=$clientData['quantity']?>
                                                              </td>
                                                              <td>
                                                              0
                                                              </td>
                                                               <?php }?>

                                                              <?php if(strtolower($clientData['trade_type'])=="sell"){ ?>
                                                               <td>
                                                              0
                                                              </td>
                                                              <td>
                                                              <?=$clientData['quantity']?>
                                                              </td>
                                                               <?php }?>

                                                              <td>
                                                              <?=$clientData['price']?>
                                                              </td>
                                                              <td>
                                                              <?=$clientData['order_ref_no']?>
                                                              </td>
															  <td>
															  <?=$clientData['total_trade']?>
															  </td>


                                                          </tr>
                                                     <?php }?>



                            </tbody>
                        </table>






</div>

  <?php }?>


------------------->