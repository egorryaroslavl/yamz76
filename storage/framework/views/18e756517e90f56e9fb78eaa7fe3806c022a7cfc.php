<?php if(  count($data) > 0 ): ?>
	<div style="float:right"><i class="fa fa-times"  title="Закрыть результаты поиска" style="cursor: pointer;"onclick="$('#searchResLoad').empty()"></i></div>
	<table
		class="footable table table-stripped toggle-arrow-tiny default breakpoint footable-loaded"
		data-page-size="15">
		<caption><h3>Результаты поиска [<span style='color:#FF4500'> <?php echo e($word); ?> </span>] </h3></caption>
		<thead>
 	
		<tr>
			<th>Имя</th>
			<th class="text-right" data-sort-ignore="true">Actions</th>
		</tr>
		</thead>
		<?php foreach($data as  $item): ?>
			<tr>
				<td>
					<a href="/admin/productions/<?php echo e($item->id); ?>/edit">
						<?php echo \App\Http\Controllers\UtilsController::highlight($word,$item->name,$item->articul); ?>

						<small>( <?php echo e($item->articul); ?> )</small>
					</a>
				</td>
				<td class="text-right" style="min-width:10.0rem">
					<div class="btn-group">
						<a href="/admin/productions/<?php echo e($item->id); ?>/edit"
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
		
	</table>
<?php else: ?>
	<div style="float:right"><i class="fa fa-times"  title="Закрыть" style="cursor: pointer;"onclick="$('#searchResLoad').empty()"></i></div>
 <h4>Поиск не дал результатов...</h4>
<?php endif; ?>
<style>
	.search-highlight {
		background: #fff200 !important;
		font-weight: bold;
		text-transform: capitalize ;
		}
</style>
