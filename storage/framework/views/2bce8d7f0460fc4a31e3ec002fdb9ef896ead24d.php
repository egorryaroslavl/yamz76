<!DOCTYPE html>
<html lang="en">
<?php echo $__env->make('head.head', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
<body class="home-page">
<?php if($_SERVER['REQUEST_URI'] =='/'): ?>
	<?php /*<?php echo $__env->make('header.headermain', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>*/ ?>
	<?php echo $__env->make('header.main_menu_bar.main_header', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
<?php else: ?>
	<?php /*<?php echo $__env->make('header.header', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>*/ ?>
	<?php echo $__env->make('header.main_menu_bar.main_header', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
<?php endif; ?>
<main>
	<?php echo $__env->yieldContent('content'); ?>
</main>
<?php echo $__env->make('footer.footer', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
<input type="hidden" name="_token" id="_token" value="<?php echo e(csrf_token()); ?>"/>
<?php echo $__env->make('scripts', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
<?php if(  Request::has( 'chart' )  ){
$data = Request::get( 'chart', 'empty' );
?>
<?php /*<div class="shoping-cart-place"><i class="fa fa-shopping-basket" title="Ваш заказ"></i></div>*/ ?>
<?php } ?>
</body>
</html>


