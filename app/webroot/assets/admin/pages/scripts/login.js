var Login = function() {

	var handleLogin = function() {

		$('.login-form').validate({
	            errorElement: 'span', //default input error message container
	            errorClass: 'help-block', // default input error message class
	            focusInvalid: false, // do not focus the last invalid input
	            rules: {
                    'data[User][username]': {
	                    required: true
	                },
                    'data[User][password]': {
	                    required: true
	                },
	                remember: {
	                    required: false
	                }
	            },

	            messages: {
                    'data[User][username]': {
	                    required: "Username is required."
	                },
	                'data[User][password]': {
	                    required: "Password is required."
	                }
	            },

	            invalidHandler: function (event, validator) { //display error alert on form submit
	                $('.alert-danger', $('.login-form')).show();
	            },

            highlight: function(element) { // hightlight error inputs
                $(element)
                    .closest('.form-group').addClass('has-error'); // set error class to the control group
            },

            success: function(label) {
                label.closest('.form-group').removeClass('has-error');
                label.remove();
            },

            errorPlacement: function(error, element) {
                error.insertAfter(element.closest('.input-icon'));
            },

            submitHandler: function(form) {
                form.submit(); // form validation success, call ajax form submit
            }
        });

        $('.login-form input').keypress(function(e) {
            if (e.which == 13) {
                if ($('.login-form').validate().form()) {
                    $('.login-form').submit(); //form validation success, call ajax form submit
                }
                return false;
            }
        });
    }

    var handleForgetPassword = function() {
        $('.forget-form').validate({
            errorElement: 'span', //default input error message container
            errorClass: 'help-block', // default input error message class
            focusInvalid: false, // do not focus the last invalid input
            ignore: "",
            rules: {
                email: {
                    required: true,
                    email: true
                }
            },

            messages: {
                email: {
                    required: "Email is required."
                }
            },

            invalidHandler: function(event, validator) { //display error alert on form submit   

            },

            highlight: function(element) { // hightlight error inputs
                $(element)
                    .closest('.form-group').addClass('has-error'); // set error class to the control group
            },

            success: function(label) {
                label.closest('.form-group').removeClass('has-error');
                label.remove();
            },

            errorPlacement: function(error, element) {
                error.insertAfter(element.closest('.input-icon'));
            },

            submitHandler: function(form) {
                form.submit();
            }
        });

        $('.forget-form input').keypress(function(e) {
            if (e.which == 13) {
                if ($('.forget-form').validate().form()) {
                    $('.forget-form').submit();
                }
                return false;
            }
        });

        jQuery('#forget-password').click(function() {
            jQuery('.login-form').hide();
            jQuery('.forget-form').show();
        });

        jQuery('#back-btn').click(function() {
            jQuery('.login-form').show();
            jQuery('.forget-form').hide();
        });

    }

    var handleRegister = function() {

        function format(state) {
            if (!state.id) return state.text; // optgroup
            return "<img class='flag' src='../../assets/global/img/flags/" + state.id.toLowerCase() + ".png'/>&nbsp;&nbsp;" + state.text;
        }

        if (jQuery().select2) {
            $("#select2_sample4").select2({
                placeholder: '<i class="fa fa-map-marker"></i>&nbsp;Select a Country',
                allowClear: true,
                formatResult: format,
                formatSelection: format,
                escapeMarkup: function (m) {
                    return m;
                }
            });


            $('#select2_sample4').change(function () {
                $('.register-form').validate().element($(this)); //revalidate the chosen dropdown value and show error or success message for the input
            });
        }

        $('.register-form').validate({
            errorElement: 'span', //default input error message container
            errorClass: 'help-block', // default input error message class
            focusInvalid: false, // do not focus the last invalid input
            ignore: "",
            rules: {

                'data[User][first_name]': {
                    required: true
                },
                'data[User][email]': {
                    email: true,
                    required: true

                },
                'data[User][mobile_no]': {
                    required: true

                },
                'data[User][internal_ref_no]': {
                    required: true
                },
                'data[User][broker_id]': {
                    required: true
                },

                'data[User][username]': {
                    required: true
                },
                'data[User][password]': {
                    required: true
                },
                rpassword: {
                    equalTo: "#UserPassword2",
                    required: true
                },

                tnc: {
                    required: true
                }
            },

            messages: { // custom messages for radio buttons and checkboxes
                tnc: {
                    required: "Please accept TNC first."
                }
            },

            invalidHandler: function (event, validator) { //display error alert on form submit

            },

            highlight: function (element) { // hightlight error inputs
                $(element)
                    .closest('.form-group').addClass('has-error'); // set error class to the control group
            },

            success: function (label) {
                label.closest('.form-group').removeClass('has-error');
                label.remove();
            },

            errorPlacement: function (error, element) {
                if (element.attr("name") == "tnc") { // insert checkbox errors after the container                  
                    error.insertAfter($('#register_tnc_error'));
                } else if (element.closest('.input-icon').size() === 1) {
                    error.insertAfter(element.closest('.input-icon'));
                } else {
                    error.insertAfter(element);
                }
            },

            submitHandler: function (form) {
                form.submit();
            }
        });

        $('.register-form input').keypress(function (e) {
            if (e.which == 13) {
                if ($('.register-form').validate().form()) {
                    $('.register-form').submit();
                }
                return false;
            }
        });

        jQuery('#register-btn').click(function () {
            jQuery('.login-form').hide();
            jQuery('.register-form').show();
        });

        jQuery('#register-back-btn').click(function () {
            jQuery('.login-form').show();
            jQuery('.register-form').hide();
        });
    }

    var handleUsernameAvailabilityChecker = function () {
        $("#UserUsername2").change(function () {
            var input = $(this);

            if (input.val() === "") {
                return;
            }

            input.attr("readonly", true).
                attr("disabled", true).
                addClass("spinner");

            $.post('http://www.new.stockbangladesh.net/users/check_username', {
                username: input.val()
            }, function (res) {
                input.attr("readonly", false).
                    attr("disabled", false).
                    removeClass("spinner");

                // change popover font color based on the result
                if (res.status == 'OK') {
                    input.closest('.form-group').removeClass('has-error').addClass('has-success');
                    $('.icon-exclamation-sign', input.closest('.form-group')).remove();
                    input.before('<i class="icon-ok"></i>');
                    input.data('bs.popover').tip().removeClass('error').addClass('success');
                } else {
                    input.closest('.form-group').removeClass('has-success').addClass('has-error');
                    $('.icon-ok', input.closest('.form-group')).remove();
                    input.before('<i class="icon-exclamation-sign"></i>');

                    input.popover('destroy');
                    input.popover({
                        'html': true,
                        'placement': (Metronic.isRTL() ? 'left' : 'right'),
                        'container': 'body',
                        'content': res.message
                    });
                    input.popover('show');
                    input.data('bs.popover').tip().removeClass('success').addClass('error');
                    input.val('');
                    Metronic.setLastPopedPopover(input);
                }

            }, 'json');

        });
    }

    var handleInternalRefNoAvailabilityChecker2 = function () {
        $("#InternalRefNo").change(function () {
            var input = $(this);

            if (input.val() === "") {
                return;
            }

            input.attr("readonly", true).
                attr("disabled", true).
                addClass("spinner");

            $.post('http://www.new.stockbangladesh.net/users/check_intRefNo', {
                irn: input.val()
            }, function (res) {
                input.attr("readonly", false).
                    attr("disabled", false).
                    removeClass("spinner");

                // change popover font color based on the result
                if (res.status == 'OK') {
                    input.closest('.form-group').removeClass('has-error').addClass('has-success');
                    $('.icon-exclamation-sign', input.closest('.form-group')).remove();
                    input.before('<i class="icon-ok"></i>');
                    input.data('bs.popover').tip().removeClass('error').addClass('success');
                } else {
                    input.closest('.form-group').removeClass('has-success').addClass('has-error');
                    $('.icon-ok', input.closest('.form-group')).remove();
                    input.before('<i class="icon-exclamation-sign"></i>');

                    input.popover('destroy');
                    input.popover({
                        'html': true,
                        'placement': (Metronic.isRTL() ? 'left' : 'right'),
                        'container': 'body',
                        'content': res.message
                    });
                    input.popover('show');
                    input.data('bs.popover').tip().removeClass('success').addClass('error');
                    input.val('');
                    Metronic.setLastPopedPopover(input);
                }

            }, 'json');

        });
    }

/*
    var handleEmailAvailabilityChecker = function () {
        $("#UserEmail").change(function () {
            var input = $(this);

            if (input.val() === "") {
                return;
            }

            input.attr("readonly", true).
                attr("disabled", true).
                addClass("spinner");

            $.post('http://www.new.stockbangladesh.net/users/check_email', {
                email: input.val()
            }, function (res) {
                input.attr("readonly", false).
                    attr("disabled", false).
                    removeClass("spinner");

                // change popover font color based on the result
                if (res.status == 'OK') {
                    input.closest('.form-group').removeClass('has-error').addClass('has-success');
                    $('.icon-exclamation-sign', input.closest('.form-group')).remove();
                    input.before('<i class="icon-ok"></i>');
                    input.data('bs.popover').tip().removeClass('error').addClass('success');
                } else {
                    input.closest('.form-group').removeClass('has-success').addClass('has-error');
                    $('.icon-ok', input.closest('.form-group')).remove();
                    input.before('<i class="icon-exclamation-sign"></i>');

                    input.popover('destroy');
                    input.popover({
                        'html': true,
                        'placement': (Metronic.isRTL() ? 'left' : 'right'),
                        'container': 'body',
                        'content': res.message
                    });
                    input.popover('show');
                    input.data('bs.popover').tip().removeClass('success').addClass('error');
                    input.val('');
                    Metronic.setLastPopedPopover(input);
                }

            }, 'json');

        });
    }*/

    return {
        //main function to initiate the module
        init: function () {

            handleLogin();
            handleForgetPassword();
            handleRegister();
            handleInternalRefNoAvailabilityChecker2();
            handleUsernameAvailabilityChecker();
           // handleEmailAvailabilityChecker();

        }

    };

}();