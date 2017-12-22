<?php $__env->startSection('content'); ?>
	<?php 
		
		$cat='';
	 
		
		
	 if(isset( $alias ))
	 {
	 $cat = \App\Model\YamzCategory::category( $alias );
	 $parentData = \App\Model\YamzCategory::get_parent( $alias, true );
	 $parent = "<a href=\"/admin/category/" . $parentData->alias . "subcategory\">" . $parentData->name . "</a>";
	 }
	
	
	 ?>
	<div class="row wrapper border-bottom white-bg page-heading">
		<div class="col-lg-12">
			<h2>Продукция в категории </h2>
			<ol class="breadcrumb">
				<li>
					<a href="/admin">Главная</a>
				</li>
				<li class="active">
					<strong><a href="/admin/product/categories">Продукция</a></strong>
				</li>
				<li>
				 Детей - <?php echo e($childCount); ?> ; Продукции <?php echo e($productsCount); ?>

				</li>
				
				<li>
					<?php echo $parent; ?>

				</li>
				<?php if(!empty($cat->name)): ?>
					<li>
						<strong><a href="/admin/category/<?php echo e($cat->alias); ?>/subcategory"><?php echo e($cat->name); ?></a></strong>
					</li>
				<?php endif; ?>
			</ol>
		</div>
	</div>
	<div class="wrapper wrapper-content animated fadeInRight">
		<div class="row">
			<div class="col-lg-12">
				<div class="ibox">
					<h5>Категории продукции</h5>
					<a href="/admin/category/productions/create" class="btn btn-primary"><i class="fa fa-plus"></i>
						Добавить запись</a><br><br>
					<div class="ibox-content">
						<?php echo $data; ?>

					</div>
				</div>
			</div>
		</div>
	</div>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.admin.index', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>