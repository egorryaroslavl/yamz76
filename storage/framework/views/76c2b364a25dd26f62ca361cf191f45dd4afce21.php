<?php $__env->startSection('content'); ?>
	<?php 
		
		 ?>
	<div class="row wrapper border-bottom white-bg page-heading">
		<div class="col-lg-12">
			<h2>Продукция в категории [ <a href="/admin/category/<?php echo e($data->category->id); ?>/productions"><?php echo e($data->category->name); ?></a> ]</h2>
			<ol class="breadcrumb">
				<li>
					<a href="/admin">Главная</a>
				</li>
				<li class="active">
					<strong><a href="/admin/product/categories">Продукция</a></strong>
				</li>
			</ol>
		</div>
	</div>
	
	<?php /*  page header  */ ?>
	<div class="wrapper wrapper-content animated fadeInRight">
		<div class="row">
			<div class="col-lg-12">
				<div class="ibox">
					<h5>Продукция в категории [ <a href="/admin/category/<?php echo e($data->category->id); ?>/productions"><?php echo e($data->category->name); ?></a> ]</h5>
					<a href="/admin/category/<?php echo e($data->category->id); ?>/productions/create" class="btn btn-primary"><i
							class="fa fa-plus"></i> Добавить запись</a><br><br>
					<div class="ibox-content">
						<?php echo e($data->render()); ?>

						
						<table
							class="footable table table-stripped toggle-arrow-tiny default breakpoint footable-loaded"
							data-page-size="15">
							<thead>
							<tr>
								<th style="width: 20px"><i class="fa fa-random"></i></th>
								<th>Имя (артикул)</th>
								<th style="text-align: left">
									<div class="row">
										<div class="col-lg-7">
											
											<div class="input-group">
      <span class="input-group-addon">
         <input
	         id="checkAll"
	         name="checkall"
	         class="checkall"
	         type="checkbox"
	         style="margin-right: 6px;border: 1px #000 solid">
      </span>
												<span class="input-group-addon">Цена</span>
												<span class="input-group-btn"> <button
														type="button"
														id="change-all-prices"
														data-category-id="<?php echo e($data->category->id); ?>"
														data-table="products"
														class="btn btn-info btn-xl change-all-prices">Изменить отмеченое</button></span>
											</div>
										</div>
									</div>
								</th>
								
								<th>Статус</th>
								<th class="text-right" data-sort-ignore="true">Actions</th>
							
							</tr>
							</thead>
							<tbody id="sortable"
							       data-table="<?php if( isset( $data->table ) && !empty( $data->table ) ) echo $data->table ?>">
							
							<?php if( count( $data ) > 0): ?>
								
								<?php foreach( $data as $item ): ?>
									<?php $item->table = $data->table ?>
									<tr class="ui-state-default" id="id_<?php echo e($item->id); ?>">
										<td class="reorder"><i class="fa fa-ellipsis-v"></i> <i
												class="fa fa-ellipsis-v"></i>
										</td>
										<td class="<?php if( $item->public == 0 ) echo 'shadow' ?>"
										    id="name_public_<?php echo $item->id ?>"
										    style="max-width:30.0rem;overflow: hidden">
											<a href="/admin/productions/<?php echo e($item->id); ?>/edit">
												<?php echo e($item->name); ?><?php if(!empty($item->articul)): ?>
													<small>( <?php echo e($item->articul); ?> )</small><?php endif; ?>
											</a>
										</td>
										<td>
											<div class="row">
												<div class="col-lg-6">
													<div class="input-group" id="price-group<?php echo e($item->id); ?>">

             <span class="input-group-addon">
        <input
	        name="price[]"
	        class="change-price-checkbox"
	        id="change-price-checkbox<?php echo e($item->id); ?>"
	        data-id="<?php echo e($item->id); ?>"
	        data-price="<?php echo e($item->price); ?>"
	        data-table="products"
	        type="checkbox">
      </span>
														<input type="text"
														       class="form-control"
														       id="price-input<?php echo e($item->id); ?>"
														       placeholder="Цена"
														       style="max-width:12.0rem"
														       value="<?php echo e($item->price); ?>">
														
														<span class="input-group-btn">
        <button
	        type="button"
	        class="btn btn-info change-price"
	        id="change-price-btn<?php echo e($item->id); ?>"
	        data-id="<?php echo e($item->id); ?>"
	        data-table="products"
        >OK</button>
      </span>
													</div><!-- /input-group -->
												</div><!-- /.col-lg-6 -->
											</div><!-- /.row -->
										
										</td>
										<td style="min-width:10.0rem">
											<?php echo \App\Http\Controllers\AdminController::status_buttons_set($item); ?>

										</td>
										<td class="text-right" style="min-width:10.0rem">
											<div class="btn-group">
												<a href="/admin/productions/<?php echo e($item->id); ?>/edit"
												   class="btn-info btn btn-xs"
												   title="Редактировать"
												   style="color: #fff"><i class="fa fa-edit"></i></a>
												
												<a href="#"
												   class="btn-danger btn btn-xs del"
												   data-id="<?php echo e($item->id); ?>"
												   data-table="products"
												   title="Удалить"
												   onclick="return false"
												   style="color: #fff"><i class="fa fa-trash"></i></a>
											
											</div>
										</td>
									</tr>
								<?php endforeach; ?>
							<?php endif; ?>
							</tbody>
							<tfoot>
							<tr>
								<td colspan="6">
									<?php echo e($data->render()); ?>

								</td>
							</tr>
							</tfoot>
						</table>
					</div>
				</div>
			</div>
		</div>
	</div>
	<div id="placeModal"></div>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.admin.index', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>