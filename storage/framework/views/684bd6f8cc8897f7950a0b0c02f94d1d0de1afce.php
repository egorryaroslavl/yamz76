<?php $__env->startSection('content'); ?>
	<?php /*  page header  */ ?>
	<div class="row wrapper border-bottom white-bg page-heading">
		<div class="col-lg-12">
			<h2>Категории </h2>
			<ol class="breadcrumb">
				<li>
					<a href="/admin">Главная</a>
				</li>
				<li class="active">
					<strong>Продукция</strong>
				</li>
			</ol>
		</div>
	</div>
	
	<?php /*  page header  */ ?>
	<div class="wrapper wrapper-content animated fadeInRight">
		<div class="row">
			<div class="col-lg-12">
				<div class="ibox">
					<h5>Категории продукции</h5>
					<div class="ibox-content">
	 
						<?php echo $__env->make('admin.common.table', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
 
					</div>
				</div>
			</div>
		</div>
	</div>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.admin.index', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>