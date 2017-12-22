<?php $__env->startSection('content'); ?>
	<section id="services" class="section">
		<header class="section__header" style="background: transparent">
			<ol class="breadcrumb">
				<?php /*<li><a href="/">Главная</a></li>*/ ?>
				<li><a href="/categories">Каталог</a></li>
				<li class="active"><?php echo e($data->parent_name); ?></li>
			</ol>
		</header>
		<header class="section__header">
			<div class="section__title">
				<h1><?php echo e($data->parent_name); ?></h1>
			</div>
			<div class="section__icon">
				<span class="fa fa-cogs"></span>
			</div>
		</header>
		<div class="container">
			<div class="blog-content pull-right">
				<div class="blog-post-wrapper">
					<article id="post-2" class="blog-post">
						<?php if( count($data->products) > 0 ): ?>
							<div class="container-fluid">
								<?php foreach($data->products as $item): ?>
									<div class="row" style="background: #dddddd;margin-bottom: 3px">
										<div class="col-md-9 col-sm-12"
										     style="vertical-align: middle;padding-left: 0">
											<button
												id="product<?php echo e($item->id); ?>"
												class="btn btn-primary btn-xs get-order"
												data-product_id="<?php echo e($item->id); ?>"
												data-price="<?php echo e($item->price); ?>"
												data-category_id="<?php echo e($data->parent_id); ?>"
												data-token="<?php echo e(csrf_token()); ?>"
												data-toggle="popover"
												data-content="Позиция добавлена в заказ"
												data-trigger="focus"
												title="Заказать"
												onclick="yaCounter41168344.reachGoal ('zakaz-kategoria'); return true;"
												type="button"><i class="fa fa-shopping-basket"></i> <?php /*Заказать*/ ?>
											</button> <span style="display: none" class="label label-success" id="appaend<?php echo e($item->id); ?>">Добавлено в заказ!</span>
											<a href="/product/<?php echo e($item->alias); ?>-<?php echo e($item->id); ?>"> <?php echo e($item->name); ?><?php echo e(!empty($item->articul) ? ' ('. $item->articul .')' :''); ?></a>
										</div>
										<div class="col-md-3 col-sm-12">
												<span style="float:right;display: inline-block"> <?php echo number_format( $item->price , 2, ',', ' '); ?> руб. </span>
										</div>
									</div>
								<?php endforeach; ?>
							</div>


							<?php echo \App\Http\Controllers\UtilsController::pageOneClear($data->products->render()); ?>


							
						<?php endif; ?>
						
						<?php if( count( $data ) > 0 ): ?>
							<ul class="services-menu" style="padding: 0">
								<?php foreach( $data as $item ): ?>
									<li style="background: #f2f2f2;margin-bottom: 2px;padding: 2px 10px">
										<a href="/category/<?php echo e($item->alias); ?>" style="font-size: 1.5rem"><?php echo e($item->name); ?></a>
									</li>
								<?php endforeach; ?>
							</ul>

								<?php if(isset($data->parent_text) && !empty($data->parent_text)): ?>
									<?php if(!isset($_REQUEST['page']) || (int)$_REQUEST['page'] == 1 ): ?>
										<article><?php echo $data->parent_text; ?></article>
									<?php endif; ?>
								<?php endif; ?>
						<?php endif; ?>
							
							<?php if(isset($data->parent_text) && !empty($data->parent_text)): ?>
								
								<?php if(!isset($_REQUEST['page']) || (int)$_REQUEST['page'] == 1 ): ?>
									
									<?php echo $data->parent_text; ?>

								
								<?php endif; ?>
							
							<?php endif; ?>
					</article>
				</div>
			</div>
			<aside class="sidebar pull-left visible-md-block visible-lg-block">
		 				<?php echo Widget::Categories(); ?>

			</aside>
		</div>
	</section>
 
	<script>
	//	$('body').popover(options);
	</script>
<?php $__env->stopSection(); ?>
<?php $__env->startSection('breadcrumb'); ?>
	<ol class="breadcrumb">
		<li><a href="/">Главная</a></li>
		<li><a href="/categories">Каталог</a></li>
		<li class="active"><?php echo e($data->parent_name); ?></li>
	</ol>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.index', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>