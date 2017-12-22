<section class="sidebar">

	<?php echo $__env->yieldContent('sidebar.top'); ?>

	<ul class="sidebar-menu">
		<?php echo $__env->yieldContent('sidebar.ul.top'); ?>

		<?php echo app('sleeping_owl.navigation')->render(); ?>


		<?php echo $__env->yieldContent('sidebar.ul.bottom'); ?>
	</ul>

	<?php echo $__env->yieldContent('sidebar.bottom'); ?>
</section>