<!-- BEGIN PRE-FOOTER -->
<div class="page-prefooter">
    <div class="container">
        <div class="row">
            <div class="col-md-3 col-sm-6 col-xs-12 footer-block">
                <h2>About</h2>
                <p>
                    Lorem ipsum dolor sit amet, consectetuer adipiscing elit, sed diam dolore.
                </p>
            </div>
            <div class="col-md-3 col-sm-6 col-xs12 footer-block">
                <h2>Subscribe Email</h2>
                <div class="subscribe-form">
                    <form action="#">
                        <div class="input-group">
                            <input type="text" placeholder="mail@email.com" class="form-control">
							<span class="input-group-btn">
							<button class="btn" type="submit">Submit</button>
							</span>
                        </div>
                    </form>
                </div>
            </div>
            <div class="col-md-3 col-sm-6 col-xs-12 footer-block">
                <h2>Follow Us On</h2>
                <ul class="social-icons">
                    <li>
                        <a href="#" data-original-title="rss" class="rss"></a>
                    </li>
                    <li>
                        <a href="#" data-original-title="facebook" class="facebook"></a>
                    </li>
                    <li>
                        <a href="#" data-original-title="twitter" class="twitter"></a>
                    </li>
                    <li>
                        <a href="#" data-original-title="googleplus" class="googleplus"></a>
                    </li>
                    <li>
                        <a href="#" data-original-title="linkedin" class="linkedin"></a>
                    </li>
                    <li>
                        <a href="#" data-original-title="youtube" class="youtube"></a>
                    </li>
                    <li>
                        <a href="#" data-original-title="vimeo" class="vimeo"></a>
                    </li>
                </ul>
            </div>
            <div class="col-md-3 col-sm-6 col-xs-12 footer-block">
                <h2>Contacts</h2>
                <address class="margin-bottom-40">
                    Phone: 01552573043<br>
                    Email: <a href="mailto:info@stockbangladesh.com">info@stockbangladesh.com</a>
                </address>
            </div>
        </div>
    </div>
</div>
<!-- END PRE-FOOTER -->
<!-- BEGIN FOOTER -->
<div class="page-footer">
    <div class="container-fluid">
        2014 &copy; StockBangladesh Ltd. All Rights Reserved.
    </div>
</div>
<div class="scroll-to-top">
    <i class="icon-arrow-up"></i>
</div>
<!-- END FOOTER -->



<!-- BEGIN JAVASCRIPTS(Load javascripts at bottom, this will reduce page load time) -->
<!-- BEGIN CORE PLUGINS -->
<!--[if lt IE 9]>
    <?php echo $this->Html->script('assets/global/plugins/respond.min.js', array('inline' => true));?>
    <?php echo $this->Html->script('assets/global/plugins/excanvas.min.js', array('inline' => true));?>
<![endif]-->
<?php
$activeMenuId = strtolower($this->params['controller']) . '_' . strtolower($this->params['action']);
if(!$js_asset_compression_enable) {
    foreach ($allScripts as $js) {
        echo $this->Html->script($js, array('inline' => true));
    }
    echo $this->Html->script('assets/admin/layout3/scripts/layout.js', array('inline' => true));
    echo $this->Html->script('assets/admin/layout3/scripts/demo.js', array('inline' => true));
    echo $this->Html->script('assets/admin/pages/scripts/login.js', array('inline' => true));
    echo $this->Html->script('assets/admin/layout3/scripts/collection.js', array('inline' => false));
}else {
    $activeMenuId = strtolower($this->params['controller']) . '_' . strtolower($this->params['action']);
    echo $this->AssetCompress->script('global');
    echo $this->AssetCompress->script($activeMenuId);
}



echo $this->fetch('script');

?>

<script>(function($,d){$.each(readyQ,function(i,f){$(f)});$.each(bindReadyQ,function(i,f){$(d).bind("ready",f)})})(jQuery,document)</script>
<script>
    jQuery(document).ready(function() {

        Metronic.init(); // init metronic core components
        Layout.init(); // init current layout
        Demo.init();

        // setting activemenu css here
        var subMenuContainer = $('#<?php echo $activeMenuId; ?>');
        subMenuContainer.parents('li').each(function () {
            subMenuContainer.addClass('active');
            subMenuContainer.children('a > span.arrow').addClass('open');
        });
        subMenuContainer.parents('li').addClass('active');
        subMenuContainer.addClass('active');

        // Fetch js from view here
        <?php echo $this->fetch('script_inside_doc_ready'); ?>
    });
</script>
<script>

    //Start Fix MegaNavbar on scroll page
    var navHeight = $('#main_navbar').offset().top;
    FixMegaNavbar(navHeight);
    $(window).bind('scroll', function() {FixMegaNavbar(navHeight);});

    function FixMegaNavbar(navHeight) {
        if (!$('#main_navbar').hasClass('navbar-fixed-bottom')) {
            if ($(window).scrollTop() > navHeight) {
                $('#main_navbar').addClass('navbar-fixed-top')
                $('body').css({'margin-top': $('#main_navbar').height()+'px'});
                if ($('#main_navbar').parent('div').hasClass('container')) $('#main_navbar').children('div').addClass('container').removeClass('container-fluid');
                else if ($('#main_navbar').parent('div').hasClass('container-fluid')) $('#main_navbar').children('div').addClass('container-fluid').removeClass('container');
            }
            else {
                $('#main_navbar').removeClass('navbar-fixed-top');
                $('#main_navbar').children('div').addClass('container-fluid').removeClass('container');
                $('body').css({'margin-top': ''});
            }
        }
    }
    //Start Fix MegaNavbar on scroll page

    //Next code used to prevent unexpected menu close when using some components (like accordion, tabs, forms, etc), please add the next JavaScript to your page
    $( window ).load(function() {
        $(document).on('click', '.navbar .dropdown-menu', function(e) {e.stopPropagation();});
    });

</script>
<!-- END JAVASCRIPTS -->

<?php echo $this->fetch('script_at_page_end'); ?>
</body>
<?php //echo $this->Facebook->init(); ?>
<!-- END BODY -->
</html>