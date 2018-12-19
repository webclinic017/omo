<!-- BEGIN HEADER -->
<div class="page-header navbar navbar-fixed-top">
<!-- BEGIN HEADER INNER -->
<div class="page-header-inner">
<!-- BEGIN LOGO -->
<div class="page-logo">
    <?php
            echo $this->Html->link(
    $this->Html->image('assets/img/logo.png', array('alt' => 'logo', 'border' => '0', 'class' =>
    'img-responsive')),
    '/',
    array('class' => 'navbar-brand', 'escape' => false)
    );
    ?>
    <div class="menu-toggler sidebar-toggler hide">
        <!-- DOC: Remove the above "hide" to enable the sidebar toggler button on header -->
    </div>
</div>
<!-- END LOGO -->
    <!-- BEGIN HEADER SEARCH BOX -->
    <form class="search-form" action="extra_search.html" method="GET">
        <div class="input-group">
            <input type="text" class="form-control" placeholder="Search..." name="query">
				<span class="input-group-btn">
				<a href="javascript:;" class="btn submit"><i class="icon-magnifier"></i></a>
				</span>
        </div>
    </form>
    <!-- END HEADER SEARCH BOX -->
<!-- BEGIN RESPONSIVE MENU TOGGLER -->
<a href="javascript:;" class="menu-toggler responsive-toggler" data-toggle="collapse" data-target=".navbar-collapse">
</a>
<!-- END RESPONSIVE MENU TOGGLER -->
    <?php
    echo $this->element('top_navigation');
    ?>


</div>
<!-- END HEADER INNER -->
</div>
<!-- END HEADER -->
<div class="clearfix">
</div>
<div class="page-container">