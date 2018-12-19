<!-- FEEDBACK MODAL HERE STARTS -->
<a id="test-demo" href="ihartdsfdsf"></a>
<div class="row">
    <div id="responsive" class="modal fade" tabindex="-1" data-width="500">
        <!-- <div class="modal-header">
             <button type="button" class="close" data-dismiss="modal" aria-hidden="true"></button>
             <h4 class="modal-title">Responsive Sohail</h4>
         </div>-->
        <div class="modal-body">
            <form id="target" action="#" class="form-horizontal">
                <div class="alert alert-danger display-hide">
                    <button class="close" data-close="alert"></button>
			<span>
				 Please enter required information
			</span>
                </div>
                <div class="form-body">
                    <div class="form-group">
                        <label class="control-label visible-ie8 visible-ie9">Name</label>

                        <div class="input-icon">
                            <i class="fa fa-font"></i>
                            <input class="form-control placeholder-no-fix" placeholder="Full Name"
                                   name="data[Feedback][feedback_user_name]" type="text" required />
                        </div>
                    </div>
                    <div class="form-group">
                        <!--<label class="control-label col-md-3">Suggestion</label>-->
                        <div>
                            <div class="input-icon">
                                <i class="fa fa-font"></i>
                                <textarea name="data[Feedback][feedback]" placeholder="Your suggestions pls"
                                          data-provide="markdown" rows="3" type="text" required></textarea>
                            </div>
                        </div>

                    </div>
                    <div class="form-group">
                        <label class="control-label visible-ie8 visible-ie9">Email Address</label>

                        <div>
                            <div class="input-icon">
                                <i class="fa fa-envelope"></i>
                                <input type="email" name="data[Feedback][feedback_user_email]"
                                       class="form-control" placeholder="Email Address" required>
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="control-label visible-ie8 visible-ie9">Contact No.</label>

                        <div>
                            <div class="input-icon">
                                <i class="fa fa-phone"></i>
                                <input type="number" name="data[Feedback][feeback_user_contact]"
                                       class="form-control" placeholder="Contact No">
                            </div>
                        </div>
                    </div>
                    <input type="hidden" class="toolsinput" id="toolsin" name="data[Feedback][apps_code]">
                </div>
                <div class="modal-footer">
                    <button type="button" data-dismiss="modal" class="btn btn-default pull-right">Close</button>
                    <button type="submit" data-loading-text="Sending your feed back. Please wait" class="demo-loading-btn btn blue pull-right">
                        Send Feedback <i class="m-icon-swapright m-icon-white"></i>
                    </button>
                    <!--<button type="button" data-loading-text="Loading..." class="demo-loading-btn btn btn-primary">
                        Loading state </button>-->
                </div>

            </form>


        </div>
        <!-- <div class="modal-footer">
             <button type="button" data-dismiss="modal" class="btn btn-default">Close</button>
             <button id="send" class="btn blue">Send <i class="m-icon-swapright m-icon-white"></i></button>
         </div>-->
    </div>

</div>
<!-- FEEDBACK MODAL HERE ENDS -->