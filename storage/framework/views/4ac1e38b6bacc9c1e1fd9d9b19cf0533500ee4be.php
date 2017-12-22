<?php if(count($data)>0): ?>
	<aside class="services-sidebar">
		<select name="yamz_categories" class="form-control col-md-2 chosen-select" id="yamz_categories">
			<option value="0"> -= Выбрать =-</option>
				<?php foreach($data as $item): ?>
				
				<optgroup label="<?php echo e($item->name); ?>">
					<option value="<?php echo e($item->id); ?>"><?php echo e($item->name); ?></option>
				 	<?php if(count( $subCats = \App\Model\YamzCategory::get_children($item->alias)) > 0 ): ?>
					 
							<?php foreach($subCats as $item_): ?>
							<option value="<?php echo e($item_->id); ?>"> <?php echo e($item->name); ?>  &rarr; <?php echo e($item_->name); ?></option>
							<?php endforeach; ?>
					 
					<?php endif; ?>
				</optgroup>
			<?php endforeach; ?>
		</select>
	</aside>
<?php endif; ?>