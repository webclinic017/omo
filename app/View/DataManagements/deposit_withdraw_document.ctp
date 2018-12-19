

<div class="col-md-12">
		<div class="portlet box blue tabbable">
			<div class="portlet-title">
				<div class="caption">
					<i class="fa fa-gift"></i>Deposit/withdraw Procedure
				</div>
			</div>
			<div class="portlet-body">
				<div class="tabbable portlet-tabs">
					<ul class="nav nav-tabs">
						<!--<li>
							<a href="#portlet_tab_3" data-toggle="tab">
							How to deposit </a>
						</li>-->
						<li>
							<a href="#portlet_tab_2" data-toggle="tab">
							How to withdraw </a>
						</li>

						<li>
							<a href="#portlet_tab_4" data-toggle="tab">
							Bank Account Details to Deposit </a>
						</li>

						<li>
							<a href="#portlet_tab_5" data-toggle="tab">
								IPO Application Form </a>
						</li>

					</ul>
					<div class="tab-content">

						<div class="tab-pane" id="portlet_tab_2">

							 <p><a href="<?php echo Router::url('/', true)?>DataManagements/downloadWithdrawForm">Click Here</a>to download the withdraw form</p>
							 <p>Fill up this form appropriately </p>
							 <p>Scan or take a clear photo of your deposit slip</p>
							 <p>Email the scanned copy at <a href="https://mail.google.com/mail">mail@stockbangladesh.com</a></p>



						</div>


						<div class="tab-pane" id="portlet_tab_3">

									<?php echo $this->requestAction("DataManagements/deposit", array("return")); ?>
						</div>

						<div class="tab-pane" id="portlet_tab_4">

							<?php if($broker_id==$brokerIdApex)
								 echo $this->requestAction("DataManagements/accountInfo", array("return"));
							 if($broker_id==$brokerIdHac)
							    echo $this->requestAction("DataManagements/accountInfo_hac", array("return"));
                            if($broker_id==$brokerIdSharp)
                                 echo $this->requestAction("DataManagements/accountInfo_sharp", array("return")); ?>
						</div>

						<div class="tab-pane" id="portlet_tab_5">
							<p><a href="<?php echo Router::url('/', true)?>DataManagements/downloadIPOForm">Click Here</a> to download IPO Application form</p>

						</div>


					</div>
				</div>
			</div>
		</div>
	</div>