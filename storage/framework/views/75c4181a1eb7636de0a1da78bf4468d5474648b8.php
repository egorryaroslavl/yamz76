<?php $__env->startSection('content'); ?>
	<div class="wrapper">
		<header class="main-header">
			<?php echo $__env->make(AdminTemplate::getViewPath('_partials.header'), array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
		</header>

		<aside class="main-sidebar">
			<?php echo $__env->make(AdminTemplate::getViewPath('_partials.navigation'), array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
		</aside>

		<div class="content-wrapper">
			<?php echo AdminTemplate::renderBreadcrumbs($breadcrumbKey); ?>


			<div class="content-header">
				<h1>
					<?php echo e($title); ?>

				</h1>
			</div>

			<div class="content body">
				<?php if($successMessage): ?>
				<div class="alert alert-success alert-message">
					<button type="button" class="close" data-dismiss="alert" aria-label="Close">
						<span aria-hidden="true">&times;</span>
					</button>
					<?php echo $successMessage; ?>

				</div>
				<?php endif; ?>

				<?php echo $content; ?>

			</div>
		</div>
	</div>
<?php $__env->stopSection(); ?>
<?php echo $__env->make(AdminTemplate::getViewPath('_layout.base'), array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>