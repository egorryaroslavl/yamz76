<table
	class="footable table table-stripped toggle-arrow-tiny default breakpoint footable-loaded"
	data-page-size="15">
	<thead>
	<tr>
		<td colspan="6">
			<?php echo e($data->render()); ?>

		</td>
	</tr>
	
	<tr>
		<th style="width: 20px"><i class="fa fa-random"></i></th>
		<th>Имя</th>
		<th>Изменить цены</th>
		<th>Статус</th>
		<th class="text-right" data-sort-ignore="true">Actions</th>
	</tr>
	</thead>
	<?php if(count($data)>0): ?>
		<tbody id="sortable"
		       data-table="<?php if( isset( $data->table ) && !empty( $data->table ) ) echo $data->table ?>">
		 
		<?php foreach( $data as $item ): ?>
			<?php 
			 
				$childrenCount    = \App\Model\YamzCategory::childCount( $item->alias );
				$productsCount = \App\Model\YamzCategory::productsInCategoryCount( $item->id);
					
					
					$lnk = $childrenCount > 0 ? 'subcategory' :'productions';
					$pt = $childrenCount > 0 ? $item->alias :$item->id;
					$href ='/admin/category/'. $pt . '/' . $lnk;
					$hrefCat ='/admin/category/'. $item->id . '/edit';
			
			if( $childrenCount > 0 && $productsCount > 0 ){
			
			
			}
			
			 ?>
			
			<tr class="ui-state-default" id="id_<?php echo e($item->id); ?>">
				<td class="reorder"><i class="fa fa-ellipsis-v"></i> <i
						class="fa fa-ellipsis-v"></i>
				</td>
				
				<td class="<?php if( $item->public == 0 ) echo 'shadow' ?>"
				    id="name_public_<?php echo $item->id ?>"
				    style="max-width:30.0rem;overflow: hidden">
					<a href="<?php echo e($href); ?>" title="Дочерних категорий - <?php echo e($childrenCount); ?>; Продукции - <?php echo e($productsCount); ?>">
						<?php echo e($item->name); ?><?php if(!empty($item->articul)): ?>
							<small>( <?php echo e($item->articul); ?> )</small><?php endif; ?>
					</a>
				
				
				</td>
				<td>
					<span class="input-group-btn">
        <button
	        type="button"
	        class="btn btn-info change-category-prices"
	        id="change-category-prices-btn<?php echo e($item->id); ?>"
	        data-category-id="<?php echo e($item->id); ?>"
	        data-table="<?php echo e($item->table); ?>"
        >OK</button>
</span>
				</td>
				<td style="min-width:10.0rem">
					<?php echo \App\Http\Controllers\AdminController::status_buttons_set($item); ?>

				</td>
				<td class="text-right" style="min-width:10.0rem">
					<div class="btn-group">
						<a href="<?php echo e($hrefCat); ?>"
						   class="btn-info btn btn-xs"
						   title="Редактировать"
						   style="color: #fff"><i class="fa fa-edit"></i></a>
						
						<a href="/admin/productions/<?php echo e($item->id); ?>/del"
						   class="btn-danger btn btn-xs"
						   title="Удалить"
						   style="color: #fff"><i class="fa fa-trash"></i></a>
					
					</div>
				</td>
			
			
			</tr>
		<?php endforeach; ?>
		</tbody>
	
	<?php endif; ?>
	
	<tfoot>
	<tr>
		<td colspan="6">
			<?php echo e($data->render()); ?>

		</td>
	</tr>
	</tfoot>
</table>