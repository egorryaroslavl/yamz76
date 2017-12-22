<div class="input-group mb-5">
	<select class="form-control partsSelect position_<?php echo e($position); ?>" id="partsSelect<?php echo e($rand = rand(1111,9999)); ?>">
		<option  data-position="<?php echo e($position); ?>" value="0" id="opt<?php echo e(isset($item->id) ? $item->id : "0"); ?>" > -= Выбрать =- </option>
		<?php if(count($data)>0): ?>
			<?php foreach( $data as $item ): ?>
				<option data-position="<?php echo e($position); ?>" id="opt<?php echo e($item->id); ?>" value="<?php echo e($item->id); ?>"
				        <?php if(isset($part_id) && $part_id == $item->id): ?>) selected <?php endif; ?>><?php echo e($item->part); ?></option>
			<?php endforeach; ?>
		<?php endif; ?>
	</select>
	<span class="input-group-btn">
        <button
	        class="btn btn-default part_del_button"
	        data-part_id="<?php echo e($part_id); ?>"
	        data-position="<?php echo e($position); ?>"
	        data-parts-select-id="partsSelect<?php echo e($rand); ?>"
	        type="button"><i class="fa fa-trash"></i></button>
      </span>
</div><!-- /input-group -->



