<?php
echo $this->Session->flash('flash', array('params' => array('class' => 'alert alert-danger display-block')));
?>

<div class="row">
    <div class="col-md-6 col-md-offset-3">
        <form id="UserPasswordResetForm" action="<?php echo Router::url('/', true);?>users/password_reset/<?php echo $reset_key; ?>" method="post">

        <h3 >Password Reset</h3>

        <div class="form-group">
            <label class="control-label visible-ie8 visible-ie9">Password</label>
            <div class="input-icon">
                <i class="fa fa-lock"></i>
                <input class="form-control placeholder-no-fix" type="password" autocomplete="off" id="UserPasswordRe" placeholder="Password" name="data[User][password]"/>
            </div>
        </div>
        <div class="form-group">
            <label class="control-label visible-ie8 visible-ie9">Re-type Your Password</label>
            <div class="controls">
                <div class="input-icon">
                    <i class="fa fa-check"></i>
                    <input class="form-control placeholder-no-fix" type="password" autocomplete="off" placeholder="Re-type Your Password" name="rpassword"/>
                </div>
            </div>
        </div>

            <div class="form-actions">
                <button type="submit" id="register-submit-btn" class="btn green pull-right">
                    Reset <i class="m-icon-swapright m-icon-white"></i>
                </button>
            </div>
        </form>
        <!-- END REGISTRATION FORM -->



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