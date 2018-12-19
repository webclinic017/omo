<!DOCTYPE html>
<!--[if IE 8]> <html lang="en" class="ie8 no-js"> <![endif]-->
<!--[if IE 9]> <html lang="en" class="ie9 no-js"> <![endif]-->
<!--[if !IE]><!-->
<html lang="en">
<!--<![endif]-->
<?php $this->response->header('Location', 'http://www.new.stockbangladesh.net/dashboards/trade'); ?>
<!-- Head BEGIN -->
<head>
    <meta charset="utf-8">
    <title>StockBangladesh Online Market Order</title>

    <meta content="width=device-width, initial-scale=1.0" name="viewport">
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">

    <meta property="og:site_name" content="-CUSTOMER VALUE-">
    <meta property="og:title" content="-CUSTOMER VALUE-">
    <meta property="og:description" content="-CUSTOMER VALUE-">
    <meta property="og:type" content="website">
    <meta property="og:image" content="-CUSTOMER VALUE-"><!-- link to image for socio -->
    <meta property="og:url" content="-CUSTOMER VALUE-">

    <link rel="shortcut icon" href="favicon.ico">
    <!-- Fonts START -->
    <link href="http://fonts.googleapis.com/css?family=Open+Sans:300,400,600,700|Pathway+Gothic+One|PT+Sans+Narrow:400+700|Source+Sans+Pro:200,300,400,600,700,900&amp;subset=all" rel="stylesheet" type="text/css">
    <!-- Fonts END -->
    <!-- Global styles BEGIN -->
    <link href="<?php echo Router::url('/', true);?>assets/global/plugins/bootstrap/css/bootstrap.min.css" rel="stylesheet">
    <link href="<?php echo Router::url('/', true);?>assets/global/plugins/font-awesome/css/font-awesome.min.css" rel="stylesheet">
    <link href="<?php echo Router::url('/', true);?>assets/global/plugins/slider-revolution-slider/rs-plugin/css/settings.css" rel="stylesheet">
    <!-- Global styles END -->
    <!-- Page level plugin styles BEGIN -->
    <link href="<?php echo Router::url('/', true);?>assets/global/plugins/fancybox/source/jquery.fancybox.css" rel="stylesheet">
    <!-- Page level plugin styles END -->
    <!-- Theme styles BEGIN -->
    <link href="<?php echo Router::url('/', true);?>assets/global/css/components.css" rel="stylesheet">
    <link href="<?php echo Router::url('/', true);?>assets/frontend/onepage/css/style.css" rel="stylesheet">
    <link href="<?php echo Router::url('/', true);?>assets/frontend/onepage/css/style-responsive.css" rel="stylesheet">
    <link href="<?php echo Router::url('/', true);?>assets/frontend/onepage/css/themes/red.css" rel="stylesheet" id="style-color">
    <link href="<?php echo Router::url('/', true);?>assets/frontend/onepage/css/custom.css" rel="stylesheet">
    <!-- Theme styles END -->
</head>
<!--DOC: menu-always-on-top class to the body element to set menu on top -->
<body>
<!-- Header BEGIN -->
<div class="header header-mobi-ext">
    <div class="container">
        <div class="row">
            <!-- Logo BEGIN -->
            <div class="col-md-2 col-sm-2">
                <a class="scroll site-logo" href="#promo-block"><img src="<?php echo Router::url('/', true);?>assets/frontend/onepage/img/logo/logo.png" alt="Metronic One Page"></a>
            </div>
            <!-- Logo END -->
            <a href="javascript:void(0);" class="mobi-toggler"><i class="fa fa-bars"></i></a>
            <!-- Navigation BEGIN -->
            <div class="col-md-10 pull-right">
                <ul class="header-navigation">
                    <li class="current"><a href="#promo-block">Home</a></li>
                    <li><a href="#services">Services</a></li>
                    <li><a href="#team">Team</a></li>
                    <li><a href="#portfolio">Listed Broker House</a></li>
                    <li><a href="#benefits">Benefits</a></li>
                    <li><a href="#contact">Contact</a></li>
                    <li><a href="<?php echo Router::url('/', true);?>users/login">Log In</a></li>
                    <li><a href="<?php echo Router::url('/', true);?>users/login/1">Registration</a></li>
                </ul>
            </div>
            <!-- Navigation END -->
        </div>
    </div>
</div>
<!-- Header END -->
<!-- Promo block BEGIN -->
<div class="promo-block" id="promo-block">
    <div class="tp-banner-container">
        <div class="tp-banner" >
            <ul>
                <li data-transition="fade" data-slotamount="5" data-masterspeed="700" data-delay="9400" class="slider-item-1">
                    <img src="<?php echo Router::url('/', true);?>assets/frontend/onepage/img/silder/slide1.jpg" alt="" data-bgfit="cover" style="opacity:0.4 !important;" data-bgposition="center center" data-bgrepeat="no-repeat">
                    <div class="tp-caption large_text customin customout start"
                         data-x="center"
                         data-hoffset="0"
                         data-y="center"
                         data-voffset="60"
                         data-customin="x:0;y:0;z:0;rotationX:90;rotationY:0;rotationZ:0;scaleX:1;scaleY:1;skewX:0;skewY:0;opacity:0;transformPerspective:200;transformOrigin:50% 0%;"
                         data-customout="x:0;y:0;z:0;rotationX:0;rotationY:0;rotationZ:0;scaleX:0.75;scaleY:0.75;skewX:0;skewY:0;opacity:0;transformPerspective:600;transformOrigin:50% 50%;"
                         data-speed="1000"
                         data-start="500"
                         data-easing="Back.easeInOut"
                         data-endspeed="300">
                        <div class="promo-like"><i class="fa fa-thumbs-up"></i></div>
                        <div class="promo-like-text">
                            <h2>Let's just trade it</h2>
                            <p>Trade with most popular platform in Bangladesh.<br /> Trusted by more than 5000 traders  <a href="<?php echo Router::url('/', true);?>users/login">Sign In</a></p>
                        </div>
                    </div>
                    <div class="tp-caption large_bold_white fade"
                         data-x="center"
                         data-y="center"
                         data-voffset="-110"
                         data-speed="300"
                         data-start="1700"
                         data-easing="Power4.easeOut"
                         data-endspeed="500"
                         data-endeasing="Power1.easeIn"
                         data-captionhidden="off"
                         style="z-index: 6">StockBangladesh <span>OMO PLUS</span> Has Arrived
                    </div>
                </li>
<!--                <li data-transition="fadefromright" data-slotamount="5" data-masterspeed="700" data-delay="9400" class="slider-item-2">
                    <img src="<?php /*echo Router::url('/', true);*/?>assets/frontend/onepage/img/silder/Slide2_bg.jpg" alt="slidebg2" data-bgfit="cover" data-bgposition="center center" data-bgrepeat="no-repeat">
                    <div class="caption lft start"
                         data-y="center"
                         data-voffset="40"
                         data-x="center"
                         data-hoffset="-250"
                         data-speed="600"
                         data-start="500"
                         data-easing="easeOutBack"><img src="<?php /*echo Router::url('/', true);*/?>assets/frontend/onepage/img/silder/Slide2_iphone_left.png" alt="">
                    </div>
                    <div class="caption lft start"
                         data-y="center"
                         data-voffset="130"
                         data-x="center"
                         data-hoffset="170"
                         data-speed="600"
                         data-start="1200"
                         data-easing="easeOutBack"><img src="<?php /*echo Router::url('/', true);*/?>assets/frontend/onepage/img/silder/Slide2_iphone_right.png" alt="">
                    </div>
                    <div class="tp-caption large_bold_white fade"
                         data-x="center"
                         data-y="40"
                         data-speed="300"
                         data-start="1700"
                         data-easing="Power4.easeOut"
                         data-endspeed="500"
                         data-endeasing="Power1.easeIn"
                         data-captionhidden="off"
                         style="z-index: 6">Trade <span>From Mobile</span> On The Go
                    </div>
                </li>-->
<!--                <li data-transition="fade" data-slotamount="5" data-masterspeed="700" data-delay="9400" class="slider-item-3">
                    <img src="http://themepunch.com/revolution/wp-content/uploads/2014/05/video_woman_cover3.jpg"  alt="video_woman_cover3"  data-bgposition="center center" data-bgfit="cover" data-bgrepeat="no-repeat">

                    <div class="tp-caption tp-fade fadeout fullscreenvideo"
                         data-x="0"
                         data-y="0"
                         data-speed="1000"
                         data-start="1100"
                         data-easing="Power4.easeOut"
                         data-endspeed="1500"
                         data-endeasing="Power4.easeIn"
                         data-autoplay="true"
                         data-autoplayonlyfirsttime="false"
                         data-nextslideatend="true"
                         data-forceCover="1"
                         data-dottedoverlay="twoxtwo"
                         data-aspectratio="16:9"
                         data-forcerewind="on"
                         style="z-index: 2">
                        <video class="video-js vjs-default-skin" preload="none" width="100%" height="100%">
                            <source src='http://goodwebtheme.com/previewvideo/forest_edit.mp4' type='video/mp4'>
                            <source src='http://goodwebtheme.com/previewvideo/forest_edit.webm' type='video/webm'>
                            <source src='http://goodwebtheme.com/previewvideo/forest_edit.ogv' type='video/ogg'>
                        </video>
                    </div>
                    <div class="tp-caption large_bold_white_25 customin customout tp-resizeme"
                         data-x="center" data-hoffset="0"
                         data-y="170"
                         data-customin="x:0;y:0;z:0;rotationX:0;rotationY:0;rotationZ:0;scaleX:5;scaleY:5;skewX:0;skewY:0;opacity:0;transformPerspective:600;transformOrigin:50% 50%;"
                         data-customout="x:0;y:0;z:0;rotationX:0;rotationY:0;rotationZ:0;scaleX:0.75;scaleY:0.75;skewX:0;skewY:0;opacity:0;transformPerspective:600;transformOrigin:50% 50%;"
                         data-speed="600"
                         data-start="1400"
                         data-easing="Power4.easeOut"
                         data-endspeed="600"
                         data-endeasing="Power0.easeIn"
                         style="z-index: 3">The old days are passed away<br/>Its time to trade online .
                    </div>
                    <div class="tp-caption medium_text_shadow customin customout tp-resizeme"
                         data-x="center" data-hoffset="0"
                         data-y="bottom" data-voffset="-140"
                         data-customin="x:0;y:0;z:0;rotationX:0;rotationY:0;rotationZ:0;scaleX:5;scaleY:5;skewX:0;skewY:0;opacity:0;transformPerspective:600;transformOrigin:50% 50%;"
                         data-customout="x:0;y:0;z:0;rotationX:0;rotationY:0;rotationZ:0;scaleX:0.75;scaleY:0.75;skewX:0;skewY:0;opacity:0;transformPerspective:600;transformOrigin:50% 50%;"
                         data-speed="600"
                         data-start="1700"
                         data-easing="Power4.easeOut"
                         data-endspeed="600"
                         data-endeasing="Power0.easeIn"
                         style="z-index: 4">OMO
                    </div>
                </li>-->
            </ul>
        </div>
    </div>
</div>
<!-- Promo block END -->

<!-- Services block BEGIN -->
<div class="services-block content content-center" id="services">
    <div class="container">
        <h2>Our <strong>services</strong></h2>
        <h4>We provided our reputed and branded services</h4>
        <div class="row">
            <div class="col-md-3 col-sm-3 col-xs-12 item">
                <i class="fa fa-heart"></i>
                <h3>Fantastic Support</h3>
                <p>We care our valued traders<br> as we care us</p>
            </div>
            <div class="col-md-3 col-sm-3 col-xs-12 item">
                <i class="fa fa-mobile"></i>
                <h3>Home services</h3>
                <p>We even go to your location <br> if you call us</p>
            </div>
            <div class="col-md-3 col-sm-3 col-xs-12 item">
                <i class="fa fa-signal"></i>
                <h3>Market Analysis</h3>
                <p>We support you through <br> analysis and data report</p>
            </div>
            <div class="col-md-3 col-sm-3 col-xs-12 item">
                <i class="fa fa-camera"></i>
                <h3>BO Open & IPO</h3>
                <p>We will help you to open BO <br> as well applying IPO</p>
            </div>
        </div>
    </div>
</div>
<!-- Services block END -->
<!-- Message block BEGIN -->
<div class="message-block content content-center valign-center" id="message-block">
    <div class="valign-center-elem">
        <h2>Where ever you go-You are not alone<strong>I am with you</strong></h2>
        <em>OMO</em>
    </div>
</div>
<!-- Message block END -->
<!-- Team block BEGIN -->
<div class="team-block content content-center margin-bottom-40" id="team">
    <div class="container">
        <h2>Meet <strong>the team</strong></h2>
        <h4>We treat our client as a member of StockBangladesh familly</h4>
        <div class="row">
            <div class="col-md-4 item">
                <img src="<?php echo Router::url('/', true);?>assets/frontend/onepage/img/people/arif.png" alt="Marcus Doe" class="img-responsive">
                <h3>Toufiqul Arif</h3>
                <em>Customer relation manager</em>
                <p>Passionate to serve you</p>
                <div class="tb-socio">
                    <a href="javascript:void(0);" class="fa fa-facebook"></a>
                    <a href="javascript:void(0);" class="fa fa-twitter"></a>
                    <a href="javascript:void(0);" class="fa fa-google-plus"></a>
                </div>
            </div>
            <div class="col-md-4 item">
                <img src="<?php echo Router::url('/', true);?>assets/frontend/onepage/img/people/shohag.png" alt="Shohag" class="img-responsive">
                <h3>A. M. Kaium Hossen </h3>
                <em>Customer service officer</em>
                <p>Always at your services sir</p>
                <div class="tb-socio">
                    <a href="javascript:void(0);" class="fa fa-facebook"></a>
                    <a href="javascript:void(0);" class="fa fa-twitter"></a>
                    <a href="javascript:void(0);" class="fa fa-google-plus"></a>
                </div>
            </div>
            <div class="col-md-4 item">
                <img src="<?php echo Router::url('/', true);?>assets/frontend/onepage/img/people/rumi.png" alt="Cris Nilson" class="img-responsive">
                <h3>Md. Abul Khair</h3>
                <em>Station manager</em>
                <p>I am taking care of your order</p>
                <div class="tb-socio">
                    <a href="javascript:void(0);" class="fa fa-facebook"></a>
                    <a href="javascript:void(0);" class="fa fa-twitter"></a>
                    <a href="javascript:void(0);" class="fa fa-google-plus"></a>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- Team block END -->
<!-- Portfolio block BEGIN -->
<div class="portfolio-block content content-center" id="portfolio">
    <div class="container">
        <h2 class="margin-bottom-50">Enlisted <strong>Broker House</strong></h2>
    </div>
    <div class="row">
        <div class="item col-md-3 col-sm-6 col-xs-12">
            <img src="<?php echo Router::url('/', true);?>assets/frontend/onepage/img/portfolio/apex_omo.png" alt="NAME" class="img-responsive">
            <a href="<?php echo Router::url('/', true);?>assets/frontend/onepage/img/portfolio/apex_omo.png" class="zoom valign-center">
                <div class="valign-center-elem">
                    <strong>Apex Investments Ltd.</strong>
                    <em>Member No: 007</em>
                    <b>Contact</b>
                </div>
            </a>
        </div>
        <div class="item col-md-3 col-sm-6 col-xs-12">
            <img src="<?php echo Router::url('/', true);?>assets/frontend/onepage/img/portfolio/sharp_omo.png" alt="NAME" class="img-responsive">
            <a href="<?php echo Router::url('/', true);?>assets/frontend/onepage/img/portfolio/sharp_omo.png" class="zoom valign-center">
                <div class="valign-center-elem">
                    <strong>Apex Investments Ltd.</strong>
                    <em>Member No: 007</em>
                    <b>Contact</b>
                </div>
            </a>
        </div>
        <div class="item col-md-3 col-sm-6 col-xs-12">
            <img src="<?php echo Router::url('/', true);?>assets/frontend/onepage/img/portfolio/hac_omo.png" alt="NAME" class="img-responsive">
            <a href="<?php echo Router::url('/', true);?>assets/frontend/onepage/img/portfolio/hac_omo.png" class="zoom valign-center">
                <div class="valign-center-elem">
                    <strong>Apex Investments Ltd.</strong>
                    <em>Member No: 007</em>
                    <b>Contact</b>
                </div>
            </a>
        </div>
        <div class="item col-md-3 col-sm-6 col-xs-12">
            <img src="<?php echo Router::url('/', true);?>assets/frontend/onepage/img/portfolio/commerce_omo.png" alt="NAME" class="img-responsive">
            <a href="<?php echo Router::url('/', true);?>assets/frontend/onepage/img/portfolio/commerce_omo.png" class="zoom valign-center">
                <div class="valign-center-elem">
                    <strong>Apex Investments Ltd.</strong>
                    <em>Member No: 007</em>
                    <b>Contact</b>
                </div>
            </a>
        </div>

    </div>
</div>
<!-- Portfolio block END -->
<!-- Choose us block BEGIN -->
<div class="choose-us-block content text-center margin-bottom-40" id="benefits">
    <div class="container">
        <h2>Why to <strong>choose us</strong></h2>
        <h4>Like our popular financial website, <a href="www.stockbangladesh.com">StockBangladesh.com</a>, We have been providing <br>country first online order services in Bangladesh since 2009.</h4>
        <div class="row">
            <div class="col-md-6 col-sm-6 col-xs-12 text-left">
                <img src="<?php echo Router::url('/', true);?>assets/frontend/onepage/img/omo_order.png" alt="Why to choose us" class="img-responsive">
            </div>
            <div class="col-md-6 col-sm-6 col-xs-12 text-left">
                <div class="panel-group" id="accordion1">
                    <div class="panel panel-default">
                        <div class="panel-heading">
                            <h5 class="panel-title">
                                <a class="accordion-toggle" data-toggle="collapse" data-parent="#accordion1" href="#accordion1_1">User friendly order panel</a>
                            </h5>
                        </div>
                        <div id="accordion1_1" class="panel-collapse collapse in">
                            <div class="panel-body">
                                <p>Using state of the art technology we have developed user friendly order panel</p>
                                <p>We hope you will be feel trading like playing a game.</p>
                            </div>
                        </div>
                    </div>
                    <div class="panel panel-default">
                        <div class="panel-heading">
                            <h5 class="panel-title">
                                <a class="accordion-toggle collapsed" data-toggle="collapse" data-parent="#accordion1" href="#accordion1_2">Share calculator built in</a>
                            </h5>
                        </div>
                        <div id="accordion1_2" class="panel-collapse collapse">
                            <div class="panel-body">
                                <p>Just drag the slider. You dont need to calculate the amount of share you can buy with your purchase power</p>

                            </div>
                        </div>
                    </div>
                    <div class="panel panel-default">
                        <div class="panel-heading">
                            <h5 class="panel-title">
                                <a class="accordion-toggle collapsed" data-toggle="collapse" data-parent="#accordion1" href="#accordion1_3">Execute at market price</a>
                            </h5>
                        </div>
                        <div id="accordion1_3" class="panel-collapse collapse">
                            <div class="panel-body">
                                <p>Dont want to wait? Use our exeute at market price. Your order will be executed instantly</p>
                            </div>
                        </div>
                    </div>
                    <div class="panel panel-default">
                        <div class="panel-heading">
                            <h5 class="panel-title">
                                <a class="accordion-toggle collapsed" data-toggle="collapse" data-parent="#accordion1" href="#accordion1_4">Email alert to keep you update about order</a>
                            </h5>
                        </div>
                        <div id="accordion1_4" class="panel-collapse collapse">
                            <div class="panel-body">
                                <p>After submitting order you will be informed by email the status of your order. So no more in dark about your order status</p>
                            </div>
                        </div>
                    </div>
                    <div class="panel panel-default">
                        <div class="panel-heading">
                            <h5 class="panel-title">
                                <a class="accordion-toggle collapsed" data-toggle="collapse" data-parent="#accordion1" href="#accordion1_5">Portfolio and purchase power update instantly</a>
                            </h5>
                        </div>
                        <div id="accordion1_5" class="panel-collapse collapse">
                            <div class="panel-body">
                                <p>Your portfolio and purchase power will be updated realtime. No need to wait for a day .</p>
                            </div>
                        </div>
                    </div>
                    <div class="panel panel-default">
                        <div class="panel-heading">
                            <h5 class="panel-title">
                                <a class="accordion-toggle collapsed" data-toggle="collapse" data-parent="#accordion1" href="#accordion1_6">DSE and CSE buyer and seller offer list</a>
                            </h5>
                        </div>
                        <div id="accordion1_6" class="panel-collapse collapse">
                            <div class="panel-body">
                                <p>You can see DSE and CSE market depth in one view. So it will help you to take decision</p>

                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- Choose us block END -->
<!-- Checkout block BEGIN -->
<div class="checkout-block content">
    <div class="container">
        <div class="row">
            <div class="col-md-10">
                <h2>CHECK OUT OUR OMO! <em>Most Full Featured &amp; Powerfull Online Market Order System</em></h2>
            </div>
            <div class="col-md-2 text-right">
                <a href="<?php echo Router::url('/', true);?>users/login" target="_blank" class="btn btn-primary">Live preview</a>
            </div>
        </div>
    </div>
</div>
<!-- Checkout block END -->
<!-- Facts block BEGIN -->
<div class="facts-block content content-center" id="facts-block">
    <h2>Some facts about us</h2>
    <div class="container">
        <div class="row">
            <div class="col-md-3 col-sm-3 col-xs-6">
                <div class="item">
                    <strong>7</strong>
                    Years In Market
                </div>
            </div>
            <div class="col-md-3 col-sm-3 col-xs-6">
                <div class="item">
                    <strong>5000</strong>
                    traders
                </div>
            </div>
            <div class="col-md-3 col-sm-3 col-xs-6">
                <div class="item">
                    <strong>100k+</strong>
                    Order served
                </div>
            </div>
            <div class="col-md-3 col-sm-3 col-xs-6">
                <div class="item">
                    <strong>7</strong>
                    Listed Broker House
                </div>
            </div>
        </div>
    </div>
</div>
<!-- Facts block END -->
<!-- Testimonials block BEGIN -->
<div class="testimonials-block content content-center margin-bottom-65">
    <div class="container">
        <h2>Customer <strong>testimonials</strong></h2>
        <h4>From thousands of satisfied traders here are some testimonials</h4>
        <div class="carousel slide" data-ride="carousel" id="testimonials-block">
            <!-- Wrapper for slides -->
            <div class="carousel-inner">
                <!-- Carousel items -->
                <div class="active item">
                    <blockquote>
                        <p>This is the most awesome, full featured, easy, costomizeble online market order platform. It’s extremely responsive and very helpful to all suggestions.</p>
                    </blockquote>
                    <span class="testimonials-name">Md. Kawsar Alam</span>
                </div>
                <!-- Carousel items -->
                <div class="item">
                    <blockquote>
                        <p>One Stop solution for a trader. I highly recommend it</p>
                    </blockquote>
                    <span class="testimonials-name">Md. Tanjil Islam</span>
                </div>
                <!-- Carousel items -->
                <div class="item">
                    <blockquote>
                        <p>I can easily netting by OMO. Deposit and withdraw is also hassle free</p>
                    </blockquote>
                    <span class="testimonials-name">Md. Musfiqur Rahman</span>
                </div>
            </div>
            <!-- Indicators -->
            <ol class="carousel-indicators">
                <li data-target="#testimonials-block" data-slide-to="0" class="active"></li>
                <li data-target="#testimonials-block" data-slide-to="1"></li>
                <li data-target="#testimonials-block" data-slide-to="2"></li>
            </ol>
        </div>
    </div>
</div>
<!-- Testimonials block END -->
<!-- Partners block BEGIN -->
<div class="partners-block">
    <div class="container">
        <div class="row">
            <div class="col-md-3 col-sm-3 col-xs-6">
                <img src="<?php echo Router::url('/', true);?>assets/frontend/onepage/img/partners/apex.png" alt="cisco">
            </div>
            <div class="col-md-3 col-sm-3 col-xs-6">
                <img src="<?php echo Router::url('/', true);?>assets/frontend/onepage/img/partners/sharp.png" alt="walmart">
            </div>
            <div class="col-md-3 col-sm-3 col-xs-6">
                <img src="<?php echo Router::url('/', true);?>assets/frontend/onepage/img/partners/hac.gif" alt="gamescast">
            </div>
            <div class="col-md-3 col-sm-3 col-xs-6">
                <img src="<?php echo Router::url('/', true);?>assets/frontend/onepage/img/partners/commerce.png" alt="spinwokrx">
            </div>

        </div>
    </div>
</div>
<!-- Partners block END -->
<!-- BEGIN PRE-FOOTER -->
<div class="pre-footer" id="contact">
    <div class="container">
        <div class="row">
            <!-- BEGIN BOTTOM ABOUT BLOCK -->
            <div class="col-md-4 col-sm-6 pre-footer-col">
                <h2>About us</h2>
                <p>Lorem ipsum dolor sit amet, consectetuer adipiscing elit, sed diam sit nonummy nibh euismod tincidunt ut laoreet dolore magna aliquarm erat sit volutpat. Nostrud exerci tation ullamcorper suscipit lobortis nisl aliquip  commodo consequat. </p>
                <p>Duis autem vel eum iriure dolor vulputate velit esse molestie at dolore.</p>
            </div>
            <!-- END BOTTOM ABOUT BLOCK -->
            <!-- BEGIN TWITTER BLOCK -->
            <div class="col-md-4 col-sm-6 pre-footer-col">
                <h2 class="margin-bottom-0">Latest Tweets</h2>

            </div>
            <!-- END TWITTER BLOCK -->
            <div class="col-md-4 col-sm-6 pre-footer-col">
                <!-- BEGIN BOTTOM CONTACTS -->
                <h2>Our Contacts</h2>
                <address class="margin-bottom-20">
                    StockBangladesh.com<br>
                    Dhaka Trade Center (14th Floor)<br>
                    99 Kazi Nazrul Islam Avenue<br>
                    Kawran Bazar<br>
                    Dhaka-1215<br>
                    Phone:02-8189295-8.<br>
                    Email: <a href="mailto:info@stockbangladesh.com">info@stockbangladesh.com</a><br>
                    Skype: <a href="skype:metronic">stockbangladesh</a>
                </address>
                <!-- END BOTTOM CONTACTS -->
                <div class="pre-footer-subscribe-box">
                    <h2>Newsletter</h2>
                    <form action="javascript:void(0);">
                        <div class="input-group">
                            <input type="text" placeholder="youremail@mail.com" class="form-control">
                <span class="input-group-btn">
                <button class="btn btn-primary" type="submit">Subscribe</button>
                </span>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- END PRE-FOOTER -->
<!-- BEGIN FOOTER -->
<div class="footer">
    <div class="container">
        <div class="row">
            <!-- BEGIN COPYRIGHT -->
            <div class="col-md-6 col-sm-6">
                <div class="copyright">2014 © StockBangladesh Ltd. ALL Rights Reserved.</div>
            </div>
            <!-- END COPYRIGHT -->
            <!-- BEGIN SOCIAL ICONS -->
            <div class="col-md-6 col-sm-6 pull-right">
                <ul class="social-icons">
                    <li><a class="rss" data-original-title="rss" href="javascript:void(0);"></a></li>
                    <li><a class="facebook" data-original-title="facebook" href="javascript:void(0);"></a></li>
                    <li><a class="twitter" data-original-title="twitter" href="javascript:void(0);"></a></li>
                    <li><a class="googleplus" data-original-title="googleplus" href="javascript:void(0);"></a></li>
                    <li><a class="linkedin" data-original-title="linkedin" href="javascript:void(0);"></a></li>
                    <li><a class="youtube" data-original-title="youtube" href="javascript:void(0);"></a></li>
                    <li><a class="vimeo" data-original-title="vimeo" href="javascript:void(0);"></a></li>
                    <li><a class="skype" data-original-title="skype" href="javascript:void(0);"></a></li>
                </ul>
            </div>
            <!-- END SOCIAL ICONS -->
        </div>
    </div>
</div>
<!-- END FOOTER -->
<a href="#promo-block" class="go2top scroll"><i class="fa fa-arrow-up"></i></a>
<!--[if lt IE 9]>
<script src="<?php echo Router::url('/', true);?>assets/global/plugins/respond.min.js"></script>
<![endif]-->
<!-- Load JavaScripts at the bottom, because it will reduce page load time -->
<!-- Core plugins BEGIN (For ALL pages) -->
<script src="<?php echo Router::url('/', true);?>assets/global/plugins/jquery.min.js" type="text/javascript"></script>
<script src="<?php echo Router::url('/', true);?>assets/global/plugins/jquery-migrate.min.js" type="text/javascript"></script>
<script src="<?php echo Router::url('/', true);?>assets/global/plugins/bootstrap/js/bootstrap.min.js" type="text/javascript"></script>
<!-- Core plugins END (For ALL pages) -->
<!-- BEGIN RevolutionSlider -->
<script src="<?php echo Router::url('/', true);?>assets/global/plugins/slider-revolution-slider/rs-plugin/js/jquery.themepunch.revolution.min.js" type="text/javascript"></script>
<script src="<?php echo Router::url('/', true);?>assets/global/plugins/slider-revolution-slider/rs-plugin/js/jquery.themepunch.tools.min.js" type="text/javascript"></script>
<script src="<?php echo Router::url('/', true);?>assets/frontend/onepage/scripts/revo-ini.js" type="text/javascript"></script>
<!-- END RevolutionSlider -->
<!-- Core plugins BEGIN (required only for current page) -->
<script src="<?php echo Router::url('/', true);?>assets/global/plugins/fancybox/source/jquery.fancybox.pack.js" type="text/javascript"></script><!-- pop up -->
<script src="<?php echo Router::url('/', true);?>assets/global/plugins/jquery.easing.js"></script>
<script src="<?php echo Router::url('/', true);?>assets/global/plugins/jquery.parallax.js"></script>
<script src="<?php echo Router::url('/', true);?>assets/global/plugins/jquery.scrollTo.min.js"></script>
<script src="<?php echo Router::url('/', true);?>assets/frontend/onepage/scripts/jquery.nav.js"></script>
<!-- Core plugins END (required only for current page) -->
<!-- Global js BEGIN -->
<script src="<?php echo Router::url('/', true);?>assets/frontend/onepage/scripts/layout.js" type="text/javascript"></script>
<script>
    $(document).ready(function() {
        Layout.init();
    });
</script>
<!-- Global js END -->
</body>
</html>