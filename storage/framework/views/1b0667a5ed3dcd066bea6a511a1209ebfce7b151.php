<div class="col-md-4">
	<?php echo e(Widget::AddAnchor('position', $position)); ?>

	<div class="input-group mb-5">
		<input
			type="text"
			name="parta"
			class="form-control mb-5"
			id="part<?php echo e($position); ?>"
			value="<?php echo e(old('parta')); ?>"
			placeholder="Часть <?php echo e(strtoupper($position)); ?>">
		<span class="input-group-btn">
        <button
	        class="btn btn-default part_button"
	        id="parta_button"
	        data-position="<?php echo e($position); ?>"
	        type="button">OK</button>
      </span>
	</div><!-- /input-group -->
	<div id="part<?php echo e($position); ?>_select"></div>
</div>