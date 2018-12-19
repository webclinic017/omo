<?php
$activeMenuId='active_'.$this->params['controller'].'_'.$this->params['action'];
/**
ADDING CSS BY ELEMENT ( THAT IS PREVIOUSLY GROUPED SOME CSS ) TO DEFAULT LAYOUT.
IT WILL BE ADDED WHERE echo $this->fetch('css') IS CALLED IN DEFAULT LAYOUT.
*/
echo $this->element('css_element/global2');
echo $this->element('css_element/pagelevel2');
echo $this->element('css_element/theme2');

/**
ADDING DIRECTLY A CSS FROM VIEW TO DEFAULT LAYOUT CSS BLOCK. NO ECHO NEEDED. INLINE FALSE MUST BE SET.
*/

$this->Html->css('assets/css/style-metronic', null, array('inline' => false));
$this->Html->css('assets/css/pages/coming-soon', null, array('inline' => false));
$this->Html->css('assets/plugins/bootstrap-modal/css/bootstrap-modal-bs3patch', null, array('inline' => false));
$this->Html->css('assets/plugins/bootstrap-modal/css/bootstrap-modal', null, array('inline' => false));
$this->Html->css('assets/plugins/bootstrap-markdown/css/bootstrap-markdown.min', null, array('inline' => false));

?>
<?php
$this->start('countdown');
?>
<div class="col-md-5 hidden-xs hidden-sm col-md-offset-2 navbar-left">
    <button type="button" class="btn btn-lg green"><?php echo __($remainingText);?></button>
                <span class="coming-soon-countdown">
                   <span id="defaultCountdown"></span>
                </span>
</div>
<?php $this->end(); ?>

<!-- TODO: ITS ALWAYS ADDING MENUE TO THE TOP.ITS WORKING LIKE PREPEND BUT APPEND IS NOT WORKING. FIND OUT A SOLUTION -->

<?php
echo $this->element('layout_element/side_bar2');
?>

<!-- TODO: ADS MANAGEMENT FROM ADMIN SHOULD BE IMPLEMENTED -->
<!-- BEGIN TOP ADS BLOCK-->
<div class="row">
    <div class="col-md-12 hidden-xs hidden-sm">
        
    </div>

</div>
<!--/////////////////////////////////////////////////////////////////////////////-->





<div class="row">
    <div class="col-md-6 col-md-offset-3">
        <?php echo $this->element('register') ?>
    </div>
</div>



<!--/////////////////////////////////////////////////////////////////////////////////-->


<?php
/**
ADDING JS BY ELEMENT ( THAT IS PREVIOUSLY GROUPED SOME JS ) TO DEFAULT LAYOUT.
IT WILL BE ADDED WHERE echo $this->fetch('scipt') IS CALLED IN DEFAULT LAYOUT.
*/

echo $this->element('script_element/core_script2');

/**
ADDING DIRECTLY PAGE LEVEL SCRIPT FROM VIEW TO DEFAULT LAYOUT SCRIPT BLOCK. NO ECHO NEEDED. INLINE FALSE MUST BE SET.
*/

$this->Html->script('assets/plugins/select2/select2.min.js',array('inline' => false));
$this->Html->script('assets/plugins/bootstrap/js/bootstrap2-typeahead.min.js',array('inline' => false));
$this->Html->script('assets/plugins/countdown/jquery.countdown.js',array('inline' => false));

$this->Html->script('assets/plugins/bootstrap-modal/js/bootstrap-modalmanager.js',array('inline' => false));
$this->Html->script('assets/plugins/bootstrap-modal/js/bootstrap-modal.js',array('inline' => false));

$this->Html->script('assets/plugins/jquery-validation/dist/jquery.validate.min.js',array('inline' => false));
$this->Html->script('assets/plugins/jquery.metadata/jquery.metadata.min.js',array('inline' => false));
$this->Html->script('assets/plugins/bootstrap-markdown/js/bootstrap-markdown.js',array('inline' => false));
$this->Html->script('assets/plugins/jquery.pwstrength.bootstrap/src/pwstrength.js',array('inline' => false));
$this->Html->script('assets/plugins/jquery-inputmask/jquery.inputmask.bundle.min.js',array('inline' => false));

$this->Html->script('assets/scripts/jquery.vticker.min.js',array('inline' => false));
$this->Html->script('assets/scripts/app.js',array('inline' => false));
$this->Html->script('assets/scripts/custom.js',array('inline' => false));
?>

<?php
/**
WRITE SCRIPT TO ADD AT THE END OF DEFAULT LAYOUT WHERE $this->fetch('view_script'); IS CALLED
*/

$this->start('view_script');
?>
<script>
    jQuery(document).ready(function () {
        App.init();
        //FormComponents.init();
        //UIExtendedModals.init();
        Custom.init();
        // Index.init();

        //Index.initCalendar(); // init index page's custom scripts
        $('.page-sidebar .ajaxify.start').click() // load the content for the dashboard page.


        $("#UserRegisterForm").validate({
            errorElement: 'span', //default input error message container
            errorClass: 'help-block', // default input error message class
            focusInvalid: false, // do not focus the last invalid input
            ignore: "",
            rules: {

                'data[User][password]': {
                    required: true,
                    minlength: 5
                },
                'data[User][contact_no]': {
                    required: true,
                    minlength: 11
                },
                rpassword: {
                    required: true,
                    minlength: 5,
                    equalTo: "#UserPassword"
                },
                tnc: {
                    required: true
                }

            },
            messages: {

                'data[User][password]': {
                    required: "Please provide a password",
                    minlength: "Your password must be at least 5 characters long"
                },
                'data[User][contact_no]': {
                    required: "Valid phone number",
                    minlength: "Valid Phone number should be 11 digit like 0155 1234567"
                },
                rpassword: {
                    required: "Please provide a password",
                    minlength: "Your password must be at least 5 characters long",
                    equalTo: "Please enter the same password as above"
                },
                tnc: {
                    required: "Please accept TNC first."
                }
            },
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
                if (element.attr("name") == "tnc") { // insert checkbox errors after the container
                    error.insertAfter($('#register_tnc_error'));
                } else if (element.closest('.input-icon').size() === 1) {
                    error.insertAfter(element.closest('.input-icon'));
                }else if (element.attr("name") == "recaptcha_response_field") {
                    error.insertAfter($('#recaptcha_response_field_error'));
                } else {
                    error.insertAfter(element);
                }
            }
        });

    })

</script>
<script type="text/javascript">
    var RecaptchaOptions = {
        theme : 'custom',
        custom_theme_widget: 'recaptcha_widget'
    };
</script>
<script type="text/javascript" src="https://www.google.com/recaptcha/api/challenge?k=6LfEFO4SAAAAAHiqFJ2c0rcZ7qdlvzxQWnMQ741u"></script>
<?php $this->end(); ?>

