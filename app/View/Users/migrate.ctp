<div class="row">

    <div class="col-md-12 hidden-xs">
        <div class="portlet light bg-inverse">
            <div class="portlet-title">
                <div class="caption font-green-sharp">
                    <i class="icon-speech font-green-sharp"></i>
                    <span class="caption-subject bold uppercase">Migration Form </span>
                    <span class="caption-helper"></span>
                </div>
                <div class="tools">
                    <a href="javascript:;" class="fullscreen" data-original-title="" title="">
                    </a>
                </div>
            </div>
            <div class="portlet-body">
                <div class="row">

                    <div class="col-md-3">

                    </div>
                    <div class="col-md-6">
                        <form id="UserPasswordResetForm" action="<?php echo Router::url('/', true);?>users/migrate/" method="post">
                            <div class="form-group">
                                <label class="control-label">Your Migration Code to Migrate</label>
                                <input name="data[User][activation_code]" value="<?echo $activation_code; ?>" type="text" class="form-control" readonly/>
                            </div>
                            <div class="form-group">
                                <label class="control-label">New Password For OMO Plus</label>
                                <!--<input type="password" class="form-control"/>-->
                                <input class="form-control placeholder-no-fix" type="password" autocomplete="off" id="UserPasswordRe" placeholder="Password" name="data[User][password]"/>
                            </div>
                            <div class="form-group">
                                <label class="control-label">Re-type New Password</label>
                                <!--<input type="password" class="form-control"/>-->
                                <input class="form-control placeholder-no-fix" type="password" autocomplete="off" placeholder="Re-type Your Password" name="rpassword"/>
                            </div>
                            <div class="margin-top-10">
                                <!--  <a href="#" class="btn green">
                                      Change Password </a>
                                  <a href="#" class="btn default">
                                      Cancel </a>-->

                                <button type="submit" id="register-submit-btn" class="btn green">
                                    Change Password <i class="m-icon-swapright m-icon-white"></i>
                                </button>

                            </div>
                        </form>


                    </div>
                    <div class="col-md-3">

                    </div>
                </div>
            </div>
        </div>
    </div>
</div>





<script type="text/javascript">

    $(function () {



        $('#UserPasswordResetForm').validate({
            errorElement: 'span', //default input error message container
            errorClass: 'help-block', // default input error message class
            focusInvalid: false, // do not focus the last invalid input
            ignore: "",
            rules: {

                'data[User][password]': {
                    required: true,
                    minlength: 5
                },
                rpassword: {
                    equalTo: "#UserPasswordRe"
                }
            },
            /* messages: {

             'data[User][password]': {
             required: "Please provide a password",
             minlength: "Your password must be at least 5 characters long"
             },
             rpassword: {
             equalTo: "Please enter the same password as above"
             }
             },*/
            invalidHandler: function (event, validator) { //display error alert on form submit

            },

            highlight: function (element) { // hightlight error inputs
                $(element).closest('.form-group').addClass('has-error'); // set error class to the control group

            },

            success: function (label) {
                label.closest('.form-group').removeClass('has-error');
                label.remove();
            },

            errorPlacement: function (error, element) {
                if (element.closest('.input-icon').size() === 1) {
                    error.insertAfter(element.closest('.input-icon'));
                } else {
                    error.insertAfter(element);
                }
            }/*,
             submitHandler: function (form) {
             form.submit();
             }*/
        });



    });

</script>