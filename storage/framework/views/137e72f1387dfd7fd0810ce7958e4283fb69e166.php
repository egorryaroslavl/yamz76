<?php $__env->startSection('content'); ?>
	<section id="services" class="section">
		<header class="section__header">
			<div class="section__title">
				<h1><?php echo "Результаты поиска [<small style='color:#FF4500'>".$word."</small>]"; ?></h1>
			</div>
			<div class="section__icon">
				<span class="fa fa-cogs"></span>
			</div>
		</header>
		<div class="container">
			<div class="blog-content pull-right">
				<div class="blog-post-wrapper">
					<article id="post-2" class="blog-post">
						<?php /* если не найдено */ ?>
						<?php if( $count == 0 ): ?>
							<h4>Поиск не дал результатов...</h4>
							<?php if(!empty(\App\Model\Contact::phone())): ?>
								<p>Но это не означает, что мы не сможем вам помочь.<br><strong style="color:#207e00">Позвоните нам:<br><?php echo \App\Model\Contact::phone(); ?> </strong>
								</p>
							<?php endif; ?>
						<?php endif; ?>
						<?php /* \если не найдено */ ?>
						<?php /* если найдено */ ?>
						<?php if( $count > 0 ): ?>
							<div style="max-height:1200px;overflow:scroll;overflow-x:hidden;">
								<div class="container-fluid">
									<?php foreach($data as $item): ?>
										<div class="row" style="background: #dddddd;margin-bottom: 3px">
											<div class="col-md-9 col-sm-12"
											     style="vertical-align: middle;padding-left: 0">
												<button
													id="product<?php echo e($item->id); ?>"
													class="btn btn-primary btn-xs get-order"
													data-product_id="<?php echo e($item->id); ?>"
													data-price="<?php echo e($item->price); ?>"
													<?php /*data-category_id="<?php echo e($data->parent_id); ?>"*/ ?>
													data-token="<?php echo e(csrf_token()); ?>"
													title="Заказать"
													type="button"><i class="fa fa-shopping-basket"></i> <?php /*Заказать*/ ?>
												</button>
												<a href="/product/<?php echo e($item->alias); ?>-<?php echo e($item->id); ?>"> <?php echo \App\Http\Controllers\UtilsController::highlight($word,$item->name,$item->articul); ?></a>
											</div>
											<div class="col-md-3 col-sm-12">
												<span style="float:right;display: inline-block"> <?php echo number_format( $item->price , 2, ',', ' '); ?>

													руб. </span>
											</div>
										</div>
									<?php endforeach; ?>
								</div>
							</div>
						<?php endif; ?>
						<?php /* \если найдено */ ?>
					</article>
				</div>
			</div>
			<aside class="sidebar pull-left visible-md-block visible-lg-block">
				<?php echo Widget::Categories(); ?>

			</aside>
		</div>
	</section>
	<style>
		.search-highlight{background: #fff200!important;}
	</style>
<?php $__env->stopSection(); ?>
<?php $__env->startSection('breadcrumb'); ?>
	<ol class="breadcrumb">
		<li><a href="/">Главная</a></li>
		<li><a href="/categories">Каталог</a></li>
	</ol>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.index', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>