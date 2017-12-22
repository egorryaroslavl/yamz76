<?php $__env->startSection('content'); ?>
	
	<section class="section section--bottom-space-large">
		<header class="section__header" style="background: transparent">
			<ol class="breadcrumb">
				<li><a href="/categories">Каталог</a></li>
				<li><a href="/category/<?php echo e($data->category->alias); ?>"><?php echo e($data->category->name); ?></a></li>
			</ol>
		</header>
		<div class="section__header">
			<div class="section__title">
				<h1><?php echo e($data->name); ?><?php echo e(!empty($data->articul) ? ' ('. $data->articul .')' :''); ?><?php /*Запчасти [ <?php echo e($data->category->name); ?> ]*/ ?></h1>
			</div>
			<div class="section__icon">
				<span class="fa fa fa-cogs"></span>
			</div>
		</div>
		<div class="container">
			<div class="blog-content pull-right">
				<div class="blog-post-wrapper">
					<div itemscope itemtype="http://schema.org/Product">
						<article id="post-2" class="blog-post">
							<?php echo e(Widget::NextPrevProduct('data', $data )); ?>

							<div itemprop="name"
							     class="h2 highlight">
								<?php echo e($data->name); ?><?php echo e(!empty($data->articul) ? ' ('. $data->articul .')' :''); ?>

							</div>
		 
							<?php if(!empty($data->icon) && file_exists(public_path().$data->icon)): ?>
								<img
									src="<?php echo e($data->icon); ?>"
									style="width:240px;margin-bottom: 10px"
									class="img-responsive img-thumbnail"
									alt="<?php echo e($data->articul); ?>"
								>
							<?php endif; ?>
							<header class="post-header">
								
								<button
									id="product<?php echo e($data->id); ?>"
									class="btn btn-primary get-order"
									data-product_id="<?php echo e($data->id); ?>"
									data-price="<?php echo e($data->price); ?>"
									data-category_id="<?php echo e($data->category->id); ?>"
									data-token="<?php echo e(csrf_token()); ?>"
									title="Заказать"
									onclick="yaCounter41168344.reachGoal ('zakaz-tovar'); return true;"
									type="button"><i class="fa fa-cart-arrow-down"></i> Заказать
								</button>
								<span style="display: none" class="label label-success" id="appaend<?php echo e(isset($data->id) ? $data->id : ''); ?>">Добавлено в заказ!</span>
							</header>
							
							<?php if(!empty($data->price)): ?>
								<div itemprop="offers" itemscope itemtype="http://schema.org/Offer">
									<meta itemprop="price" content="<?php echo number_format( $data->price , 2, ',', ' '); ?>">
									<meta itemprop="priceCurrency" content="RUB">
									<h4>Цена: <span style="color-rendering: #286090"><?php echo number_format( $data->price , 2, ',', ' '); ?>

											руб.</span></h4>
								</div>
							<?php endif; ?>
							<hr class="hr-line-dashed">
							<div
								itemprop="description"><?php echo str_replace(["<br>","ДВИГ"],[" ","ДВИГАТЕЛЬ"],$data->description); ?></div>
						</article>
					</div>
				
				</div>
			</div>
			<aside class="sidebar pull-left visible-md-block visible-lg-block">
				<?php echo Widget::Categories(); ?>

			</aside>
		</div>
	</section>
<?php $__env->stopSection(); ?>
<?php $__env->startSection('breadcrumb'); ?>
	<ol class="breadcrumb">
		<li><a href="/">Главная</a></li>
		<li><a href="/categories">Каталог</a></li>
		<li><a href="/category/<?php echo e($data->category->alias); ?>"><?php echo e($data->category->name); ?></a></li>
	</ol>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.index', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>