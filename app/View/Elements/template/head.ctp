<!DOCTYPE html>
<!--[if IE 8]> <html lang="en" class="ie8 no-js"> <![endif]-->
<!--[if IE 9]> <html lang="en" class="ie9 no-js"> <![endif]-->
<!--[if !IE]><!-->
<?php //echo $this->Facebook->html(); ?>
<!--<![endif]-->
<!-- BEGIN HEAD -->
<head>
    <meta charset="utf-8"/>
    <title>Online Trading Platform For Dhaka Stock Exchange-Bangladesh</title>
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta content="width=device-width, initial-scale=1.0" name="viewport"/>
    <meta content="" name="description"/>
    <meta content="" name="author"/>
    <script>(function(w,d,u){w.readyQ=[];w.bindReadyQ=[];function p(x,y){if(x=="ready"){w.bindReadyQ.push(y);}else{w.readyQ.push(x);}};var a={ready:p,bind:p};w.$=w.jQuery=function(f){if(f===d||f===u){return a}else{p(f)}}})(window,document)</script>

    <link href="http://fonts.googleapis.com/css?family=Open+Sans:400,300,600,700&subset=all" rel="stylesheet" type="text/css">
    <?php
/* if asset compression is not enable. Default is true. set $this->set('asset_compression_enable', false); in controller action to disable it*/
    if(!$css_asset_compression_enable) {
        foreach ($allCss as $css) {
            echo $this->Html->css("$css", null, array('inline' => false));
        }
        echo $this->Html->css('assets/admin/layout2/css/layout', null, array('inline' => false));
        echo $this->Html->css('assets/admin/layout2/css/themes/default', null, array('inline' => false, 'id' => 'style_color'));

    }
    else {

        echo $this->Html->css('assets/global/plugins/font-awesome/css/font-awesome.min.css', null, array('inline' => false));
        echo $this->Html->css('assets/global/plugins/simple-line-icons/simple-line-icons.min.css', null, array('inline' => false));
        $controller_action = strtolower($this->params['controller']) . '_' . strtolower($this->params['action']);
        echo $this->AssetCompress->css('global');
        echo $this->AssetCompress->css($controller_action);
    }
    //FETCHING STYLE
    echo $this->fetch('css');

    ?>
  <!--  <link href="../../assets/admin/layout3/css/layout.css" rel="stylesheet" type="text/css">
    <link href="../../assets/admin/layout3/css/themes/default.css" rel="stylesheet" type="text/css" id="style_color">
    <link href="../../assets/admin/layout3/css/custom.css" rel="stylesheet" type="text/css">-->

    <link rel="shortcut icon" href="favicon.ico"/>

</head>
<!-- END HEAD -->
