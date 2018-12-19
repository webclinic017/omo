<div class="container-fluid">
<!--<nav class="navbar navbar-inverse" id="main_navbar" role="navigation">-->
<nav class="navbar navbar-inverse-light dropdown-onhover no-border no-border-radius" id="main_navbar" role="navigation">
<div class="container-fluid">
<!-- Brand and toggle get grouped for better mobile display -->
<div class="navbar-header">
    <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#navbar-collapse-1">
        <span class="sr-only">Toggle navigation</span>
        <span class="icon-bar"></span><span class="icon-bar"></span><span class="icon-bar"></span>
    </button>
</div>
<!-- Collect the nav links, forms, and other content for toggling -->
<div class="collapse navbar-collapse" id="navbar-collapse-1">

<ul class="nav navbar-nav navbar-left">
<?php foreach ($menu as $main_menu) {
    $id = strtolower($main_menu['url']['controller']) . '_' . strtolower($main_menu['url']['action']);
if (isset($main_menu['submenu'])) {  // If it has drop down
        ?>
        <li class="dropdown-short" id='<?php echo $id; ?>'>

            <!--<a data-toggle="dropdown" href="javascript:void(0);" class="dropdown-toggle"><i class="fa fa-bars"></i>&nbsp;<span class="hidden-sm hidden-md reverse">Short</span><span class="caret"></span></a>-->


            <a data-toggle="dropdown" class="dropdown-toggle"
               href="<?php echo Router::url(array('controller' => $main_menu['url']['controller'], 'action' => $main_menu['url']['action'])); ?>">
                <i class="<?php echo $main_menu['icon'] ?>"></i>&nbsp;<span
                    class="hidden-sm"><?php echo $main_menu['title'] ?></span><?php if (isset($main_menu['submenu'])) { ?>
                    <span class="caret"></span> <?php } ?>

            </a>

                <ul class="dropdown-menu">
                    <?php foreach ($main_menu['submenu'] as $submenu) {
                        $sid = strtolower($submenu['url']['controller']) . '_' . strtolower($submenu['url']['action']);
                        ?>
                        <li id='<?php echo $sid; ?>'>
                            <a href="<?php echo Router::url(array('controller' => $submenu['url']['controller'], 'action' => $submenu['url']['action'])); ?>"
                               class="iconify">
                                <i class="<?php echo $submenu['icon'] ?>"></i>
                                <?php echo $submenu['title'] ?>
                                <span class="desc">Monitor minute wise movement</span>
                            </a>

                        </li>
                        <li class="divider"></li>
                    <?php
                    }
                    ?>
                </ul>

        </li>
        <li class="divider"></li>
    <?php
    } else // It is single menu. We will set text link here
{
    ?>

    <a class="navbar-link navbar-left" href="<?php echo Router::url(array('controller' => $main_menu['url']['controller'], 'action' => $main_menu['url']['action'])); ?>">
        <i class="<?php echo $main_menu['icon'] ?>"></i>&nbsp;<span
            class="hidden-sm"><?php echo $main_menu['title'] ?></span><?php if (isset($main_menu['submenu'])) { ?>
            <span class="caret"></span> <?php } ?>

    </a>

    <li class="divider"></li>
<?php
}
}
?>
</ul>



<ul class="nav navbar-nav navbar-right">

<!-- search form -->
<form class="navbar-form-expanded navbar-form navbar-left visible-lg-block visible-md-block visible-xs-block"
      role="search">
    <div class="input-group">
        <input type="text" class="form-control" data-width="80px" data-width-expanded="170px" placeholder="Search..."
               name="query">
        <span class="input-group-btn"><button class="btn btn-default" type="submit"><i class="fa fa-search"></i>&nbsp;
            </button></span>
    </div>
</form>
<li class="dropdown-grid visible-sm-block">
    <a data-toggle="dropdown" href="javascript:;" class="dropdown-toggle"><i class="fa fa-search"></i> Search</a>

    <div class="dropdown-grid-wrapper" role="menu">
        <ul class="dropdown-menu col-sm-6">
            <li>
                <form class="no-margin">
                    <div class="input-group">
                        <input type="text" class="form-control">
                        <span class="input-group-btn"><button class="btn btn-default" type="button">&nbsp;<i
                                    class="fa fa-search"></i></button></span>
                    </div>
                </form>
            </li>
        </ul>
    </div>
</li>

<!-- media -->
<!--<li class="dropdown-grid">
    <a data-toggle="dropdown" href="javascript:;" class="dropdown-toggle"><i class="fa fa-tasks"></i>&nbsp;<span
            class="hidden-sm">Media</span><span class="caret"></span></a>

    <div class="dropdown-grid-wrapper" role="menu">
        <ul class="dropdown-menu col-xs-12 col-sm-10 col-md-8 col-lg-7">
            <li>
                <div id="carousel-example-generic" class="carousel slide">
                    <div class="row">
                        <div class="col-lg-3 col-md-3 col-sm-3 col-xs-3 divided">
                            <ol class="carousel-indicators navbar-carousel-indicators h-divided">
                                <li data-target="#carousel-example-generic" data-slide-to="0" class="active"><a href="#"
                                                                                                                class=""><i
                                            class="fa fa-camera"></i> Image<span
                                            class="hidden-xs desc">Add images</span></a></li>
                                <li data-target="#carousel-example-generic" data-slide-to="1" class=""><a href="#"
                                                                                                          class=""><i
                                            class="fa fa-youtube-play"></i> Video<span
                                            class="hidden-xs desc">Add videos</span></a></li>
                                <li data-target="#carousel-example-generic" data-slide-to="2" class=""><a href="#"
                                                                                                          class=""><i
                                            class="fa fa-envelope"></i> Contact us<span
                                            class="hidden-xs desc">Add forms</span></a></li>
                                <li data-target="#carousel-example-generic" data-slide-to="3" class=""><a href="#"
                                                                                                          class=""><i
                                            class="fa fa-map-marker"></i> Show on map<span class="hidden-xs desc">Add Google maps&reg;</span></a>
                                </li>
                                <li data-target="#carousel-example-generic" data-slide-to="4" class=""><a href="#"
                                                                                                          class=""><i
                                            class="fa fa-globe"></i> Street view<span class="hidden-xs desc">Add Street view&reg;</span></a>
                                </li>
                            </ol>
                        </div>
                        <div class="col-lg-9 col-md-9 col-sm-9 col-xs-9">
                            <div class="carousel-inner">
                                <div class="item active">
                                    <div class="embed-responsive embed-responsive-16by9">
                                        <img class="embed-responsive-item" src="images/cars.jpg">
                                    </div>
                                </div>
                                <div class="item">
                                    <div class="embed-responsive embed-responsive-16by9">

                                    </div>
                                </div>
                                <div class="item">
                                    <div class="embed-responsive embed-responsive-16by9">
                                        <div class="embed-responsive-item">
                                            <h4 class="text-right"
                                                style="padding-top:0px; border-bottom: 1px solid #555; ">Contact us</h4>
                                            <br>

                                            <form id="contact" method="post" class="form " role="form">
                                                <div class="row">
                                                    <div class="col-xs-6 col-md-6 form-group">
                                                        <input class="form-control" id="name" name="name"
                                                               placeholder="Name" type="text" required="" autofocus="">
                                                    </div>
                                                    <div class="col-xs-6 col-md-6 form-group">
                                                        <input class="form-control" id="email" name="email"
                                                               placeholder="Email" type="email" required="">
                                                    </div>
                                                </div>
                                                <textarea class="form-control" id="message" name="message"
                                                          placeholder="Message" rows="4"></textarea>
                                                <br>

                                                <div class="row">
                                                    <div class="col-xs-9 col-md-9 form-group">
                                                        <a href="#" data-target="#carousel-example-generic"
                                                           data-slide-to="3" class=""><i class="fa fa-map-marker"></i>
                                                            Show on map</a><br>
                                                        <a href="#" data-target="#carousel-example-generic"
                                                           data-slide-to="4" class=""><i class="fa fa-map-marker"></i>
                                                            Show on street view</a>
                                                    </div>
                                                    <div class="col-xs-3 col-md-3 form-group">
                                                        <button class="btn btn-default pull-right" type="submit">
                                                            Submit
                                                        </button>
                                                    </div>
                                                </div>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                                <div class="item">
                                    <div class="embed-responsive embed-responsive-16by9">

                                    </div>
                                </div>
                                <div class="item">
                                    <div class="embed-responsive embed-responsive-16by9">

                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </li>
        </ul>
    </div>
</li>-->


<!-- divider -->
<li class="divider"></li>

<!-- account -->
<li class="dropdown-grid">
<a data-toggle="dropdown" href="javascript:;" class="dropdown-toggle"><i class="fa fa-lock"></i>&nbsp;<span
        class="hidden-sm">Account</span><span class="caret"></span></a>

<div class="dropdown-grid-wrapper" role="menu">
<ul class="dropdown-menu col-xs-12 col-sm-10 col-md-8 col-lg-7">
<li>
<div id="carousel-example-account" class="carousel slide">
<div class="row">
<div class="col-lg-8 col-md-8 col-sm-8">
<div class="carousel-inner">
<div class="item active">
    <h3 class="text-right" style="padding-top:0px; border-bottom: 1px solid #555;"><i
            class="fa fa-lock"></i> Sign in</h3>
    <br>

        <form class="form-horizontal login-form menu" role="form" action="<?php echo Router::url('/', true);?>users/login" id="UserLoginForm" method="post">
        <div class="form-group">
            <label for="inputEmail3" class="col-sm-3 control-label">Username</label>

            <div class="col-sm-9"><input class="form-control placeholder-no-fix" type="text" id="UserUsername" autocomplete="off" placeholder="Username" name="data[User][username]"/></div>
        </div>
        <div class="form-group">
            <label for="inputPassword3" class="col-sm-3 control-label">Password</label>

            <div class="col-sm-9"><input class="form-control placeholder-no-fix" type="password" id="UserPassword" autocomplete="off" placeholder="Password" name="data[User][password]"/></div>
        </div>
      <!--  <div class="form-group">
            <label for="inputPassword3" class="col-sm-3 control-label">Remember Me.</label>

            <div class="col-sm-9"><input type="checkbox" name="data[User][remember_me]"  value="1" id="UserRememberMe"/></div>
        </div>-->

            <div class="form-group">
                <div class="col-sm-offset-3 col-sm-5">
                    <div class="checkbox"><label><input type="checkbox" name="data[User][remember_me]"  value="1" id="UserRememberMe" > Remember me</label></div>
                </div>
                <div class="col-sm-4"><button type="submit" class="btn btn-default pull-right"><i
                            class="fa fa-unlock-alt"></i>Sign in</button></div>
            </div>


    </form>
    <p class="text-primary" style="cursor: pointer;"
       data-target="#carousel-example-account" data-slide-to="1">
        <small>Don’t have a account? Sign up for FREE</small>
    </p>
    <p class="text-primary" style="cursor: pointer;"
       data-target="#carousel-example-account" data-slide-to="2">
        <small>Lost Your Username?</small>
    </p>
    <p class="text-primary" style="cursor: pointer;"
       data-target="#carousel-example-account" data-slide-to="3">
        <small>Lost Your Password?</small>
    </p>
</div>
<div class="item">
    <h3 class="text-right" style="padding-top:0px; border-bottom: 1px solid #555;"><i
            class="fa fa-user"></i> Create new account</h3>
    <br>

    <form class="form-horizontal register-form menu" id="UserRegisterForm" action="<?php echo Router::url('/', true);?>users/register" method="post" role="form">
        <div class="form-group">
            <label for="inputEmail3" class="col-sm-5 control-label">Email</label>

            <div class="col-sm-7"><input class="input-sm form-control" id="UserEmail" type="text" value="<?php if(isset($this->data['User']['email'])) echo $this->data['User']['email']?>" placeholder="Email" name="data[User][email]"/></div>
        </div>
        <div class="form-group">
            <label for="inputUsername" class="col-sm-5 control-label">Username</label>

            <div class="col-sm-7"><input class="input-sm form-control" type="text" value="<?php if(isset($this->data['User']['username'])) echo $this->data['User']['username']?>" autocomplete="off" id="UserUsername2" placeholder="Username" name="data[User][username]"/></div>
        </div>
        <div class="form-group">
            <label for="inputPassword3" class="col-sm-5 control-label">Password</label>

            <div class="col-sm-7"> <input class="input-sm form-control" type="password" autocomplete="off" id="UserPassword2" placeholder="Password" name="data[User][password]"/></div>
        </div>
        <div class="form-group">
            <label for="inputPassword3" class="col-sm-5 control-label">Re-type password</label>

            <div class="col-sm-7"> <input class="input-sm form-control" type="password" autocomplete="off" placeholder="Re-type Your Password" name="rpassword"/></div>
        </div>

        <div class="form-group">
            <label for="inputPassword3" class="col-sm-5 control-label"></label>
            <div class="col-sm-7">
            <div id="recaptcha_widget" class="form-recaptcha">
                <div class="form-recaptcha-img">
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

            </div></div>

        </div>

        <div class="form-group">
            <div class="col-sm-offset-5 col-sm-7">
                <button class="btn btn-default pull-right" type="submit"><i
                        class="fa fa-save"></i> Create an account
                </button>
            </div>
        </div>
    </form>
</div>
<!-- Forgot your username -->
<div class="item">
    <h3 class="text-right" style="padding-top:0px; border-bottom: 1px solid #555;"><i
            class="fa fa-warning"></i> Forgotten your Username?</h3>
    <br>

    <p class="text-justify">Enter your email address, you signed up with (or entered in
        your settings), and we'll send you an email with your username.</p>
    <br>

    <form class="forget-form" action="<?php echo Router::url('/', true);?>users/forgotten_username" method="post" role="form">
        <div class="input-group">
            <input class="form-control" type="text" autocomplete="off" placeholder="Email" name="email" />
                                  <span class="input-group-btn">
                                  <button class="btn btn-default" type="button"><i class="fa fa-envelope"></i> Send it
                                      to me!
                                  </button>
                                  </span>
        </div>
    </form>
    <br><br>

    <p class="text-justify">
        <small><i>If you've forgotten your username and password, you must first
                retrieve your username (using your email address) and then reset your
                password using those details.</i></small>
    </p>
</div>
<!-- Forgot your password -->
<div class="item">
    <h3 class="text-right" style="padding-top:0px; border-bottom: 1px solid #555;"><i
            class="fa fa-warning"></i> Forgot your password?</h3>
    <br>

    <p class="text-justify">Enter your username, and we'll send you an email with a link
        and instructions to reset your password.
        If you signed up without an email address (or removed it from settings), visit
        the FAQ.
    </p>
    <br>

    <!--<form id="lost_password" method="post" class="form" role="form">-->
        <form class="forget-form" action="<?php echo Router::url('/', true);?>users/forgotten_password" method="post" role="form">
        <div class="input-group">
            <input class="form-control" type="text" autocomplete="off" placeholder="Email" name="email" />
                                  <span class="input-group-btn">
                                 <!-- <button class="btn btn-default" type="submit"><i class="fa fa-envelope"></i> Send it
                                      to me!
                                  </button>-->
                                       <button type="submit" class="btn green pull-right">
                                           Submit <i class="m-icon-swapright m-icon-white"></i>
                                       </button>
                                  </span>
        </div>
    </form>
    <br>

    <p class="text-justify">
        <small><i>If you've forgotten your username and password, you must first <span
                    class="text-primary" style="cursor: pointer;"
                    data-target="#carousel-example-account" data-slide-to="2">retrieve your username</span>
                (using your email address) and then reset your password using those
                details.</i></small>
    </p>
</div>
<div class="item">
    <h3 class="text-right" style="padding-top:0px; border-bottom: 1px solid #555;"><i
            class="fa fa-envelope"></i> Subscribe to our mailing list</h3>
    <br>

    <p class="text-justify"><i>
            <small>Get the freebies from us and latest updates about YourApp! We hate
                spam as much as you do, trust us we won't give your details away to
                other people.
            </small>
        </i></p>
    <br>

    <form class="form-horizontal" role="form">
        <div class="form-group">
            <label for="inputEmail" class="col-sm-5 control-label">Your email
                address</label>

            <div class="col-sm-7"><input type="text" class="input-sm form-control"
                                         id="inputEmail" name="inputEmail"
                                         placeholder="Your email address"></div>
        </div>
        <div class="form-group">
            <label for="inputName" class="col-sm-5 control-label">Your Name</label>

            <div class="col-sm-7"><input type="text" class="input-sm form-control"
                                         id="inputName" name="inputName"
                                         placeholder="Your Name"></div>
        </div>
        <br>

        <div class="form-group">
            <div class="col-sm-offset-5 col-sm-7">
                <button class="btn btn-default pull-right" type="submit"><i
                        class="fa fa-envelope-o"></i> Subscribe
                </button>
            </div>
        </div>
    </form>
</div>
<div class="item">
    <h3 class="text-right" style="padding-top:0px; border-bottom: 1px solid #555;"><i
            class="fa fa-envelope"></i> Contact us</h3>
    <br>

    <div class="row">
        <form class="" role="form">
            <div class="col-xs-6 col-md-6 ">
                <div class="form-group">
                    <input type="text" class="input-sm form-control" id="inputName"
                           name="inputName" placeholder="Enter your name">
                </div>
            </div>
            <div class="col-xs-6 col-md-6 ">
                <div class="form-group">
                    <input type="password" class="input-sm form-control" id="inputEmail"
                           name="inputEmail" placeholder="Enter your email address">
                </div>
            </div>
            <div class="col-xs-12 col-md-12 ">
                <div class="form-group">
                    <input type="password" class="input-sm form-control"
                           id="inputSubject" name="inputSubject"
                           placeholder="Subject ...">
                </div>
            </div>
            <div class="col-xs-12 col-md-12 ">
                <div class="form-group">
                    <textarea style="resize: none;" class="form-control"
                              id="inputMessage" name="inputMessage"
                              placeholder="Message" rows="3"></textarea>
                </div>
            </div>
            <div class="form-group col-sm-offset-3 col-sm-9">
                <button class="btn btn-default pull-right" type="submit"><i
                        class="fa fa-chevron-circle-right"></i> Submit
                </button>
            </div>
        </form>
    </div>
</div>
</div>
</div>
<div class="col-lg-4 col-md-4 col-sm-4" style="border-left: 1px solid #555;">
    <ol class="carousel-indicators navbar-carousel-indicators" style="">
        <li data-target="#carousel-example-account" data-slide-to="0" class="active"><a href="#"
                                                                                        class="">Sign
                In<span class="desc">Already have an account? Log in</span></a></li>
        <li data-target="#carousel-example-account" data-slide-to="1" class=""><a href="#"
                                                                                  class="">Sign
                Up<span class="desc">Create new account</span></a></li>
        <li data-target="#carousel-example-account" data-slide-to="2" class=""><a href="#"
                                                                                  class="">Forgot
                username?<span class="desc">No problem, we can remind you by email</span></a>
        </li>
        <li data-target="#carousel-example-account" data-slide-to="3" class=""><a href="#"
                                                                                  class="">Forgot
                password?<span class="desc">Don't worry, it happens!</span></a></li>
        <li data-target="#carousel-example-account" data-slide-to="4" class=""><a href="#"
                                                                                  class="">Subscribe<span
                    class="desc">Subscribe to our Newsletters</span></a></li>
        <li data-target="#carousel-example-account" data-slide-to="5" class=""><a href="#"
                                                                                  class="">Contact
                us<span class="desc">If you have any questions ...</span></a></li>
    </ol>
</div>
</div>
</div>
</li>
</ul>
</div>
</li>
</ul>
</div>
</div>
</nav>
</div>

<script>

    $(function () {

        Login.init();
    });

</script>

<script type="text/javascript">
    var RecaptchaOptions = {
        theme : 'custom',
        custom_theme_widget: 'recaptcha_widget'
    };
</script>
<script type="text/javascript" src="https://www.google.com/recaptcha/api/challenge?k=6LfEFO4SAAAAAHiqFJ2c0rcZ7qdlvzxQWnMQ741u"></script>
