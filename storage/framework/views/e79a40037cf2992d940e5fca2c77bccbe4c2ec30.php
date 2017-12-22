<a href="<?php echo e(url(config('sleeping_owl.url_prefix'))); ?>" class="logo">
	<span class="logo-lg"><?php echo AdminTemplate::getLogo(); ?></span>
	<span class="logo-mini"><?php echo AdminTemplate::getLogoMini(); ?></span>
</a>

<nav class="navbar navbar-static-top" role="navigation">
	<!-- Sidebar toggle button-->
	<a href="#" class="sidebar-toggle" data-toggle="offcanvas" role="button">
		<span class="sr-only">Toggle navigation</span>
	</a>

	<ul class="nav navbar-nav">
		<?php echo $__env->yieldContent('navbar'); ?>
	</ul>

	<ul class="nav navbar-nav navbar-right" style="margin-right: 30px">
        <li><a href="/">На сайт</a></li>
		<?php echo $__env->yieldContent('navbar.right'); ?>
	</ul>
</nav>