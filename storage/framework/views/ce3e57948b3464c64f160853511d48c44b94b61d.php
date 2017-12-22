<?php $__env->startSection('content'); ?>
	<?php echo $__env->make('start_page.categories', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
	<?php /*    <?php echo $__env->make('start_page.services', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>*/ ?>
	<?php echo $__env->make('start_page.about', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
	<?php /* <?php echo $__env->make('start_page.reviews', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>*/ ?>
	<?php /* <?php echo $__env->make('start_page.clients', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>*/ ?>
	<?php /*    <?php echo $__env->make('start_page.shop', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>*/ ?>
	<?php echo $__env->make('start_page.contacts', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.index', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>