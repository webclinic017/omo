<div class="col-md-12" id="summery_table_div">

        <div class="portlet-title">
            <div class="caption">
                <i class="icon-puzzle font-red-flamingo"></i>
                                            <span class="caption-subject bold font-red-flamingo uppercase"> </span>
                <span class="caption-helper hidden-xs"></span>
            </div>
        </div>
            <table class="table table-striped table-bordered table-advance table-hover" id="deposit_summery_table">
                <thead>
                    <tr>
                        <th>

                            <i class="fa fa-sliders"></i> Introducer
                        </th>

                        <th>

                            <i class="fa fa-sliders"></i> Introduced
                        </th>

                    </tr>
                </thead>
                <tbody id="">

                   <?php  foreach($introducedList as $key=>$introduced ){ ?>
                    <?php foreach($introduced as $introducedClient ){ ?>
                       <tr>
                          <td>
                             <?=$key?>
                          </td>
                          <td>
                          <?=$introducedClient['User']['internal_ref_no']?>:= <?=$introducedClient['User']['broker_fee']?>
                          </td>

                      </tr>
                       <?php  }?>
                    <?php  }?>

                </tbody>
            </table>

</div>



<div class="col-md-12" id="summery_table_div">
          <div class="portlet-title">
            <div class="caption">
                <i class="icon-puzzle font-red-flamingo"></i>
                                            <span class="caption-subject bold font-red-flamingo uppercase"> </span>
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

                    <i class="fa fa-sliders"></i> Full Name
                </th>

                <th>
                    <i class="fa fa-sliders"></i> Total Buy
                </th>
                <th>
                    <i class="fa fa-sliders"></i> Total Buy Commission
                </th>
                <th>
                    <i class="fa fa-sliders"></i> Total Sell
                </th>
                <th>
                    <i class="fa fa-sliders"></i> Total Sell Commission
                </th>
                <th>
                    <i class="fa fa-sliders"></i> Total Earned Commission
                </th>
            </tr>

            </thead>
            <tbody id="">

               <?php $i=1; foreach($totalAmountforIntroducer as $key=>$introducerAmount ){ ?>
                       <tr>

                          <td>
                          <?=$introducerAmount['IntroducerInfo'][0]['User']['internal_ref_no']?>
                          </td>
                           <td>
                          <?=$introducerAmount['IntroducerInfo'][0]['User']['first_name']?>
                          </td>
                          <td>
                          <?=$introducerAmount['buy']?>
                          </td>
                          <td>
                          <?=$introducerAmount['buyCommission']?>
                          </td>
                          <td>
                          <?=$introducerAmount['sell']?>
                          </td>
                          <td>
                          <?=$introducerAmount['sellCommission']?>
                          </td>
                           <td>
                          <?=$introducerAmount['totalCommission']?>
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
                      <?=$totalMonthlyBuy?>
                      </td>
                      <td>
                      <?=$totalMonthlyBuyCommission?>
                      </td>
                      <td>
                      <?=$totalMonthlySell?>
                      </td>
                      <td>
                      <?=$totalMonthlySellCommission?>
                      </td>
                      <td>
                      <?=$totalMonthlyEarnedCommission?>
                      </td>
                    </tr>

            </tbody>
        </table>

</div>
