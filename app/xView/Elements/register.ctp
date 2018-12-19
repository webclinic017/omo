<!-- BEGIN REGISTRATION FORM -->
<!--<form class="register-form" action="index.html" method="post">-->
<!--<?php echo $this->Form->create('User');?>-->

<?php echo $this->Form->create('User', array(
'class' => 'register-form',
'inputDefaults' => array(
'format' => array('before', 'label', 'between', 'input', 'error', 'after'),
'div' => array('class' => 'form-group'),
'label' => array('class' => 'control-label visible-ie8 visible-ie9'),
'between' => '<div class="input-icon"><i class="fa fa-font"></i>',
    'after' => '</div>',
'error' => array('attributes' => array('wrap' => 'span', 'class' => 'help-block')),
)));?>


<h3 >Sign Up</h3>
<?php
echo $this->Session->flash('flash', array('params' => array('class' => 'alert alert-danger display-block')));
?>
<p>Enter your personal details below:</p>
               <?php echo $this->Form->input('first_name', array('class' => 'form-control placeholder-no-fix','placeholder' => 'Name','required' => true,'between' => '<div class="input-icon"><i class="fa fa-font"></i>')); ?>
               <?php echo $this->Form->input('email', array('class' => 'form-control placeholder-no-fix','placeholder' => 'Email','between' => '<div class="input-icon"><i class="fa fa-font"></i>')); ?>
               <?php echo $this->Form->input('contact_no', array('class' => 'form-control placeholder-no-fix','placeholder' => 'Mobile no','between' => '<div class="input-icon"><i class="fa fa-phone"></i>')); ?>
               <?php echo $this->Form->input('city', array('class' => 'form-control placeholder-no-fix','placeholder' => 'City','between' => '<div class="input-icon"><i class="fa fa-envelope"></i>')); ?>

<p>Enter your account details below:</p>
                <?php echo $this->Form->input('username', array('class' => 'form-control placeholder-no-fix','placeholder' => 'Username','between' => '<div class="input-icon"><i class="fa fa-phone"></i>')); ?>
                <?php echo $this->Form->input('password', array('class' => 'form-control placeholder-no-fix','placeholder' => 'Password','type' => 'password','between' => '<div class="input-icon"><i class="fa fa-phone"></i>')); ?>
<div class="form-group">
    <label class="control-label visible-ie8 visible-ie9">Re-type Your Password</label>
    <div class="controls">
        <div class="input-icon">
            <i class="fa fa-check"></i>
            <input class="form-control placeholder-no-fix" type="password" autocomplete="off" placeholder="Re-type Your Password" name="rpassword"/>
        </div>
    </div>
</div>
                        <div class="form-group">
                        <div id="recaptcha_widget" class="form-recaptcha">
                            <div class="form-recaptcha-img" style="width: 325px">
                                <a id="recaptcha_image" href="#"></a>
                                <div class="recaptcha_only_if_incorrect_sol" style="color:red">Incorrect please try again</div>
                            </div>
                            <div class="input-group" style="width: 325px">
                                <input type="text" class="form-control" id="recaptcha_response_field" name="recaptcha_response_field" required="">
                                <div class="input-group-btn">
                                    <a class="btn default" href="javascript:Recaptcha.reload()"><i class="fa fa-refresh"></i></a>
                                    <a class="btn default recaptcha_only_if_image" href="javascript:Recaptcha.switch_type('audio')"><i title="Get an audio CAPTCHA" class="fa fa-headphones"></i></a>
                                    <a class="btn default recaptcha_only_if_audio" href="javascript:Recaptcha.switch_type('image')"><i title="Get an image CAPTCHA" class="fa fa-picture"></i></a>
                                    <a class="btn default" href="javascript:Recaptcha.showhelp()"><i class="fa fa-question-circle"></i></a>
                                </div>
                            </div>
                            <div id="recaptcha_response_field_error"></div>
                            <!--<p class="help-block">
                                <span class="recaptcha_only_if_image">Enter the words above</span>
                                <span class="recaptcha_only_if_audio">Enter the numbers you hear</span>
                            </p>-->
                        </div>
                        </div>
<div class="form-group">
    <label>
        <input type="checkbox" name="tnc"/> I agree to the <a href="#">Terms of Service</a> and <a href="#">Privacy Policy</a>
    </label>
    <div id="register_tnc_error"></div>
</div>
<div class="form-actions">
    <button type="submit" id="register-submit-btn" class="btn green pull-right">
        Sign Up <i class="m-icon-swapright m-icon-white"></i>
    </button>
</div>
</form>
<!-- END REGISTRATION FORM -->
