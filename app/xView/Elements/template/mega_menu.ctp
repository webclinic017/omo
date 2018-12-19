<div class="container-fluid">
<!--<nav class="navbar navbar-inverse" id="main_navbar" role="navigation">-->
<nav class="navbar navbar-inverse-light dropdown-onhover no-border-radius" id="main_navbar" role="navigation">
<div class="container-fluid">
<!-- Brand and toggle get grouped for better mobile display -->
<div class="navbar-header">
    <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#navbar-collapse-1">
        <span class="sr-only">Toggle navigation</span>
        <span class="icon-bar"></span><span class="icon-bar"></span><span class="icon-bar"></span>
    </button>
    <a class="navbar-brand" href="<?php echo Router::url(array('controller' => 'users', 'action' => 'home')); ?>"><i
            class="fa fa-home"></i> Market</a>
</div>
<!-- Collect the nav links, forms, and other content for toggling -->
<div class="collapse navbar-collapse" id="navbar-collapse-1">

<ul class="nav navbar-nav navbar-left">

    <!-- dropdown default -->
    <li class="dropdown-short">
        <a data-toggle="dropdown" href="javascript:;" class="dropdown-toggle">Today Markets<span
                class="caret"></span></a>
        <ul class="dropdown-menu">
            <li class="dropdown-header">Monitoring</li>
            <li>
                <a href="<?php echo Router::url(array('controller' => 'instruments', 'action' => 'market_monitor')); ?>">Market
                    Monitor<span class="desc">Monitor minute wise movement</span></a></li>
            <li><a href="<?php echo Router::url(array('controller' => 'markets', 'action' => 'market_composition')); ?>"
                   class="">Markets Composition<span class="desc">See how market formed today</span></a></li>
            <li>
                <a href="<?php echo Router::url(array('controller' => 'instruments', 'action' => 'market_depth_monitor')); ?>"
                   class="">Market Depth Monitor<span class="desc">See how buyer seller formed</span></a></li>
            <li class="divider"></li>
            <li class="dropdown-right-onhover no-fix">
                <!-- Menu item with submenu -->
                <a data-toggle="collapse" data-target="#id_1234567890" class="dropdown-toggle collapsed"><i
                        class="fa fa-bars"></i>Company<span class="desc">Comany information</span></a>
                <!-- start submenu -->
                <ul class="dropdown-menu collapse" id="id_1234567890">
                    <li class="dropdown-header">Submenu header</li>
                    <li class="divider"></li>
                    <li>
                        <a href="<?php echo Router::url(array('controller' => 'instruments', 'action' => 'details')); ?>"
                           class="">Company details<span class="desc">Master page of a company</span></a></li>
                    <li>
                        <a href="<?php echo Router::url(array('controller' => 'instruments', 'action' => 'data_matrix')); ?>"
                           class="">Data Matrix<span class="desc">Popular data matrix</span></a></li>
                    <li class="divider"></li>
                    <li><p><a href=#"><i class="fa fa-link"></i> Regular link<span
                                    class="desc">Regular link description</span></a></p></li>
                    <li class="divider"></li>
                    <li><a href="#">Separated link</a></li>
                </ul>
                <!-- end submenu -->
            </li>
            <li class="divider"></li>
            <li><p><a href=#">Regular link</a></p></li>
            <li class="divider"></li>
            <li>
                <form class="navbar-form navbar-right" role="search" style="margin-left: -15px;">
                    <div class="input-group"><input type="text" placeholder="input" class="form-control"><span
                            class="input-group-btn"><button class="btn btn-default" type="button"><i
                                    class="fa fa-search"></i>&nbsp;</button></span></div>
                </form>
            </li>
        </ul>
    </li>

    <!-- divider -->
    <li class="divider"></li>

    <li class="dropdown-short active">
        <a data-toggle="dropdown" href="javascript:;" class="dropdown-toggle">Chart<span
                class="caret"></span></a>
        <ul class="dropdown-menu">
            <li class="dropdown-header">TA Chart</li>
            <li>
                <a href="<?php echo Router::url(array('controller' => 'TechnicalAnalysis', 'action' => 'chart')); ?>">Flash Chart<span class="desc">Flash based interactive chart</span></a></li>
            <li class="divider"></li>

            <li class="active" id=""><a href="<?php echo Router::url(array('controller' => 'TechnicalAnalysis', 'action' => 'chart_img_trac')); ?>"
                   class="">Image Chart<span class="desc">Same old but popular chart</span></a></li>
            <li class="divider"></li>
            <li>
                <a href="<?php echo Router::url(array('controller' => 'instruments', 'action' => 'minute_chart')); ?>"
                   class="">Minute chart<span class="desc">Minute chart of single company</span></a></li>
            <li class="divider"></li>
        </ul>
    </li>

    <!-- divider -->
    <li class="divider"></li>

    <!-- wide -->
    <li class="dropdown-wide">
        <a data-toggle="dropdown" href="javascript:;" class="dropdown-toggle"><i class="fa fa-check-square-o"></i>
            Wide<span class="caret"></span></a>
        <ul class="dropdown-menu">
            <li class="col-xs-6 col-sm-4 col-md-4 col-lg-3">
                <address>
                    <br>
                    <strong>MegaNavbar, Inc.</strong><br>
                    123 Folsom Ave, Suite 456<br>
                    San Francisco, CA 987654<br>
                    <abbr title="Phone">P:</abbr> (123) 456-7890
                </address>
                <address>
                    <strong>Full Name</strong><br>
                    <a href="mailto:#">first.last@example.com</a>
                </address>
            </li>
            <li class="col-xs-6 col-sm-8 col-md-4 col-lg-5">
                <form role="form">
                    <div class="form-group">
                        <label for="exampleInputEmail1">Email address</label>
                        <input type="email" class="form-control" id="exampleInputEmail1" placeholder="Enter email">
                    </div>
                    <div class="form-group">
                        <label for="exampleInputPassword1">Password</label>
                        <input type="password" class="form-control" id="exampleInputPassword1" placeholder="Password">
                    </div>
                    <div class="form-group">
                        <div class="col-sm-8">
                            <div class="checkbox"><label><input type="checkbox"> Remember me</label></div>
                        </div>
                        <div class="col-sm-4">
                            <button type="submit" class="pull-right btn btn-default">Submit</button>
                        </div>
                    </div>
                </form>
            </li>
            <li class="col-xs-12 col-sm-12 col-md-4 col-lg-4">
                <div class="embed-responsive embed-responsive-16by9">
                    <iframe class="embed-responsive-item"
                            src="http://mapsurl.appspot.com/google/iframe.html#01L-sstHl9h2O"></iframe>
                </div>
            </li>
        </ul>
    </li>
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
<li class="dropdown-grid">
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
                                        <iframe class="embed-responsive-item"
                                                src="http://www.youtube.com/embed/wzqdVJK5rCY?rel=0"
                                                allowfullscreen=""></iframe>
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
                                        <iframe class="embed-responsive-item"
                                                src="http://mapsurl.appspot.com/google/iframe.html#01L-sstHl9h2O"></iframe>
                                    </div>
                                </div>
                                <div class="item">
                                    <div class="embed-responsive embed-responsive-16by9">
                                        <iframe class="embed-responsive-item"
                                                src="http://maps.google.com/maps?layer=c&amp;cbll=38.889154,-77.048787&amp;cbp=12,-80,,0,0&amp;output=svembed&amp;ll=33.4513,-112.0372"></iframe>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </li>
        </ul>
    </div>
</li>


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

    <form class="form-horizontal" role="form">
        <div class="form-group">
            <label for="inputEmail3" class="col-sm-3 control-label">Email</label>

            <div class="col-sm-9"><input type="text" class="input-sm form-control"
                                         id="inputEmail3" placeholder="Email"
                                         autocomplete="off"></div>
        </div>
        <div class="form-group">
            <label for="inputPassword3" class="col-sm-3 control-label">Password</label>

            <div class="col-sm-9"><input type="password" class="input-sm form-control"
                                         id="inputPassword3" placeholder="Password"
                                         autocomplete="off"></div>
        </div>
        <div class="form-group">
            <div class="col-sm-offset-3 col-sm-9">
                <button class="btn btn-default pull-right" type="submit"><i
                        class="fa fa-unlock-alt"></i> Sign in
                </button>
            </div>
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

    <form class="form-horizontal" role="form">
        <div class="form-group">
            <label for="inputEmail3" class="col-sm-5 control-label">Email</label>

            <div class="col-sm-7"><input type="text" class="input-sm form-control"
                                         id="inputEmail3"
                                         placeholder="Enter your email address"
                                         autocomplete="off"></div>
        </div>
        <div class="form-group">
            <label for="inputPassword3" class="col-sm-5 control-label">Password</label>

            <div class="col-sm-7"><input type="password" class="input-sm form-control"
                                         id="inputPassword3"
                                         placeholder="Enter password"
                                         autocomplete="off"></div>
        </div>
        <div class="form-group">
            <label for="inputPassword3" class="col-sm-5 control-label">Confirm
                password</label>

            <div class="col-sm-7"><input type="password" class="input-sm form-control"
                                         id="inputPassword3"
                                         placeholder="Enter confirm password"
                                         autocomplete="off"></div>
        </div>
        <div class="form-group">
            <div class="col-sm-12">
                <div class="checkbox">
                    <label>
                        <input type="checkbox">
                        <small>I have read and agree to our <a href="#">Terms of use</a>
                            and <a href="#">Privacy Policy</a>.
                        </small>
                    </label>
                </div>
            </div>
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

    <form id="lost_password" method="post" class="form" role="form">
        <div class="input-group">
            <input type="text" class="form-control" placeholder="Enter your username"
                   autocomplete="off">
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

    <form id="lost_password" method="post" class="form" role="form">
        <div class="input-group">
            <input type="text" class="form-control" placeholder="Enter your username"
                   autocomplete="off">
                                  <span class="input-group-btn">
                                  <button class="btn btn-default" type="button"><i class="fa fa-envelope"></i> Send it
                                      to me!
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