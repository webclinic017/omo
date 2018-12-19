 <div class="modal-content">
                            <div class="modal-header" >
                                <button type="button" class="close" data-dismiss="modal" aria-hidden="true"></button>
                                <h3 class="head" id="header_buy" min-height= 2px></h3>
                            </div>
                            <div class="modal-body">
                                <form class="form-horizontal" role="form"  action="" method="post" id='addShareForm'>
                                        <div class="form-body">



                                            <div class="form-group">
                                               <label class="control-label col-md-3">Portfolio Id</label>

                                               <div class="col-md-7">

                                                  <?php echo $this->StockBangladesh->getInstrumentBootstrapSelect2($userForDropDown, 'userlist1');
                                                                            ?>
                                               </div>
                                           </div>
                                             <div class="form-group">
                                                <label class="control-label col-md-3">Instrument Id</label>

                                                <div class="col-md-7">

                                                    <?php echo $this->StockBangladesh->getInstrumentBootstrapSelect2($instruments, 'userlist2');
                                                                                                                               ?>

                                                </div>
                                            </div>

                                              <div class="form-group">
                                                 <label class="control-label col-md-3">Transaction Type</label>

                                                 <div class="col-md-7">

                                                      <select class="form-control input-xxlarge"  id="instruments" contestId=contestId portfolioId=portfolioId>
                                                          <option>---</option>
                                                            <option>Buy</option>
                                                              <option>Sell</option>

                                                      </select>


                                                 </div>
                                             </div>


                                           <div class="form-group">
                                               <label class="col-md-3 control-label">Amount</label>
                                               <div class="col-md-9">
                                                   <input class="form-control" id="LastTradePrice" name="LastTradePrice"   value=""  >
                                               </div>
                                           </div>

                                            <div class="form-group">
                                                <label class="col-md-3 control-label">Rate</label>
                                                <div class="col-md-9">
                                                    <input class="form-control" id="MarketLot" name="MarketLot"  value=""  >
                                                </div>
                                            </div>
                                            <div class="form-group">
                                               <label class="col-md-3 control-label">Transaction Time</label>
                                               <div class="col-md-9">
                                                   <input class="form-control form-control-inline input-medium date-picker" id="MaximumSharesYouCanBuy" name="MaximumSharesYouCanBuy"   value=""   >
                                               </div>
                                           </div>
                                           <div class="form-group">
                                               <label class="col-md-3 control-label">Commission</strong></label>
                                               <div class="col-md-9">
                                                   <input class="form-control" id="MarketPrice" name="MarketPrice"   value="" >
                                               </div>
                                           </div>

                                           <div class="form-group">
                                               <label class="col-md-3 control-label">Parent Id*</label>
                                               <div class="col-md-9">
                                                   <input class="form-control" id="BuyQuantity" name="BuyQuantity"  value="" >
                                               </div>
                                           </div>

                                            <div class="form-group">
                                              <label class="col-md-3 control-label">Dse Order Id</label>
                                              <div class="col-md-9">
                                                  <input class="form-control" id="BuyQuantity" name="BuyQuantity"  value="" >
                                              </div>
                                          </div>

                                           <div class="form-group">
                                             <label class="col-md-3 control-label">*Buy Dse Execution Id</label>
                                             <div class="col-md-9">
                                                 <input class="form-control" id="BuyQuantity" name="BuyQuantity"  value="" >
                                             </div>
                                         </div>

                                          <div class="form-group">
                                            <label class="col-md-3 control-label">*Buy Omo Order Id*</label>
                                            <div class="col-md-9">
                                                <input class="form-control" id="BuyQuantity" name="BuyQuantity"  value="" >
                                            </div>
                                        </div>

                                         <div class="form-group">
                                           <label class="col-md-3 control-label">*Buy Updated*</label>
                                           <div class="col-md-9">
                                               <input class="form-control" id="BuyQuantity" name="BuyQuantity"  value="" >
                                           </div>
                                       </div>



                                       </div>
                                        <div class="form-actions right1">
                                             <button class="btn" data-dismiss="modal" aria-hidden="true">Close</button>
                                             <button class="btn green btn-primary" type="submit" id='buyConfirm' >ADD (confirm)</button>
                                        </div>
                                </form>

                           </div>
                        </div>



 <script>
  $(function () {

  $("#addShareForm").on("submit", function ()
         {
          event.preventDefault();

                 var ajaxUrl = '<?php echo Router::url('/', true)?>DataManagements/addShare/';

                 $.ajax({
                     type: "POST",
                     dataType: 'json',
                     url: ajaxUrl,
                     data: $(this).serialize(),
                     async: true

                 }).done(function (returnData) {

                     if(returnData=='created')
                     {
                         alert('successful');
                         $("#addShareForm").trigger( "reset" );
                     }

                 });


         });

});

  </script>