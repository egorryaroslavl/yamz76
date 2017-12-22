<!DOCTYPE html>
<html>
<?php echo $__env->make('admin.inspinia.head.head', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
<body>
<div id="wrapper">
	<?php echo $__env->make('admin.inspinia.navigation.mainmenu', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
	<div id="page-wrapper" class="gray-bg">
		<?php echo $__env->make('admin.inspinia.navigation.navbar_top', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
		<?php echo $__env->yieldContent('content'); ?>
		<?php echo $__env->make('admin.inspinia.footer', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
	</div>
</div>
<div id="placeModal"></div>
<input type="hidden" name="_token" id="_token" value="<?php echo e(csrf_token()); ?>"/>
<?php echo $__env->make('admin.inspinia.scripts', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
</body>
</html>
