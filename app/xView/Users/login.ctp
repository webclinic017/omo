<!-- BEGIN LOGIN FORM -->
<form class="login-form" action="<?php echo Router::url('/', true);?>users/login" id="UserLoginForm" method="post">
    <h3 class="form-title">Login to your account</h3>
    <div class="alert alert-danger display-hide">
        <button class="close" data-close="alert"></button>
        <span>Enter any username and password.</span>
    </div>
    <div class="form-group">
        <!--ie8, ie9 does not support html5 placeholder, so we just show field title for that-->
        <label class="control-label visible-ie8 visible-ie9">Username</label>
        <div class="input-icon">
            <i class="fa fa-user"></i>
            <input class="form-control placeholder-no-fix" type="text" id="UserUsername" autocomplete="off" placeholder="Username" name="data[User][username]"/>
            <!--<input class="form-control placeholder-no-fix" type="text" autocomplete="off" placeholder="Username" name="username"/>-->
        </div>
    </div>
    <div class="form-group">
        <label class="control-label visible-ie8 visible-ie9">Password</label>
        <div class="input-icon">
            <i class="fa fa-lock"></i>
            <input class="form-control placeholder-no-fix" type="password" id="UserPassword" autocomplete="off" placeholder="Password" name="data[User][password]"/>
            <!--<input class="form-control placeholder-no-fix" type="password" autocomplete="off" placeholder="Password" name="password"/>-->
        </div>
    </div>
    <div class="form-actions">
        <label class="checkbox">
            <!--<input type="checkbox" name="data[User][auto_login]" id="auto_login" value="1"/> Remember me-->
            <!--<input type="hidden" name="data[User][remember_me]" id="UserRememberMe_" value="0"/>-->
            <input type="checkbox" name="data[User][remember_me]"  value="1" id="UserRememberMe"/> Remember me
        </label>
        <button type="submit" class="btn green pull-right">
            Login <i class="m-icon-swapright m-icon-white"></i>
        </button>

    </div>
    <div class="login-options">
        <h4>Or login with</h4>
        <ul class="social-icons">
            <li>
                <a class="facebook" id="fblogin" data-original-title="facebook" href="#">
                </a>


            </li>
            <li>
                <a class="twitter" data-original-title="Twitter" href="#">
                </a>
            </li>
            <li>
                <a class="googleplus" data-original-title="Goole Plus" href="#">
                </a>
            </li>
            <li>
                <a class="linkedin" data-original-title="Linkedin" href="#">
                </a>
            </li>
        </ul>
    </div>
    <div class="forget-password">
        <h4>Forgot your password ?</h4>
        <p>
            no worries, click <a href="javascript:;"  id="forget-password">here</a>
            to reset your password.
        </p>
    </div>
   <!-- <div class="create-account">
        <p>
            Don't have an account yet ?&nbsp;
            <a href="<?php /*echo Router::url('/', true);*/?>users/register/" >Create an account</a>
        </p>
    </div>-->
    <div class="create-account">
        <p>
            Don't have an account yet ?&nbsp; <a href="javascript:;" id="register-btn">
                Create an account </a>
        </p>
    </div>
</form>
<!-- END LOGIN FORM -->
<!-- BEGIN FORGOT PASSWORD FORM -->

<form class="forget-form" action="<?php echo Router::url('/', true);?>users/forgotten_password" method="post">
    <h3 >Forget Password ?</h3>
    <p>Enter your e-mail address below to reset your password.</p>
    <div class="form-group">
        <div class="input-icon">
            <i class="fa fa-envelope"></i>
            <input class="form-control placeholder-no-fix" type="text" autocomplete="off" placeholder="Email" name="email" />
        </div>
    </div>
    <div class="form-actions">
        <button type="button" id="back-btn" class="btn">
            <i class="m-icon-swapleft"></i> Back
        </button>
        <button type="submit" class="btn green pull-right">
            Submit <i class="m-icon-swapright m-icon-white"></i>
        </button>
    </div>
</form>
<!-- END FORGOT PASSWORD FORM -->
<!-- BEGIN REGISTRATION FORM -->
<form class="register-form" id="UserRegisterForm" action="<?php echo Router::url('/', true);?>users/register" method="post">

<h3>Sign Up</h3>
<p>
    Enter your personal details below:
</p>

<div class="form-group">
    <!--ie8, ie9 does not support html5 placeholder, so we just show field title for that-->
    <label class="control-label visible-ie8 visible-ie9">Email</label>
    <div class="input-icon">
        <i class="fa fa-envelope"></i>
        <input class="form-control placeholder-no-fix" id="UserEmail" type="text" value="<?php if(isset($this->data['User']['email'])) echo $this->data['User']['email']?>" placeholder="Email" name="data[User][email]"/>
    </div>
</div>
<p>
    Enter your account details below:
</p>
<div class="form-group">
    <label class="control-label visible-ie8 visible-ie9">Username</label>
    <div class="input-icon">
        <i class="fa fa-user"></i>
        <input class="form-control placeholder-no-fix" type="text" value="<?php if(isset($this->data['User']['username'])) echo $this->data['User']['username']?>" autocomplete="off" id="UserUsername2" placeholder="Username" name="data[User][username]"/>
    </div>
</div>
<div class="form-group">
    <label class="control-label visible-ie8 visible-ie9">Password</label>
    <div class="input-icon">
        <i class="fa fa-lock"></i>
        <input class="form-control placeholder-no-fix" type="password" autocomplete="off" id="UserPassword2" placeholder="Password" name="data[User][password]"/>
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
    <div class="form-group">
        <div id="recaptcha_widget" class="form-recaptcha">
            <div class="form-recaptcha-img" style="width: 316px">
                <a id="recaptcha_image" href="#"></a>
                <div class="recaptcha_only_if_incorrect_sol" style="color:red">Incorrect please try again</div>
            </div>
            <div class="input-group" style="width: 316px">
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

<div class="form-actions">
    <button id="register-back-btn" type="button" class="btn">
        <i class="m-icon-swapleft"></i> Back </button>
    <button type="submit" id="register-submit-btn" class="btn green pull-right">
        Sign Up <i class="m-icon-swapright m-icon-white"></i>
    </button>
</div>
</form>

<!--<div class="login-options">
    <h4>Or Register with</h4>
    <ul class="social-icons">
        <li>
            <a class="facebook" id="fblogin" data-original-title="facebook" href="#">
            </a>


        </li>
        <li>
            <a class="twitter" data-original-title="Twitter" href="#">
            </a>
        </li>
        <li>
            <a class="googleplus" data-original-title="Goole Plus" href="#">
            </a>
        </li>
        <li>
            <a class="linkedin" data-original-title="Linkedin" href="#">
            </a>
        </li>
    </ul>
</div>-->
<!-- END REGISTRATION FORM -->

<?php $this->start('script_inside_doc_ready'); ?>
Login.init();
<?php if($loadRegisterForm){?>
jQuery('.login-form').hide();
jQuery('.register-form').show();
<?php }?>
<?php $this->end(); ?>


<script type="text/javascript">
    var RecaptchaOptions = {
        theme : 'custom',
        custom_theme_widget: 'recaptcha_widget'
    };
</script>
<script type="text/javascript" src="https://www.google.com/recaptcha/api/challenge?k=6LfEFO4SAAAAAHiqFJ2c0rcZ7qdlvzxQWnMQ741u"></script>
