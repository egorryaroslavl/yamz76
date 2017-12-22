<?php if(count($data)>0): ?>
		<?php echo Widget::SearchBox(); ?>

		<aside class="services-sidebar">
			<ul class="services-menu">
				<?php foreach($data as $item): ?>
					<?php $active = strpos( $_SERVER[ 'REQUEST_URI' ], $item->alias ) > 0 ? ' class="active"' : '' ?><li><div class="h4"><a href="/category/<?php echo e($item->alias); ?>"<?php echo $active; ?>><?php echo e($item->name); ?></a></div><?php if(count( $subCats = \App\Model\YamzCategory::get_children($item->alias)) > 0 ): ?><ul class="services-submenu"><?php foreach($subCats as $item_): ?><li><a href="/category/<?php echo e($item_->alias); ?>"><?php echo e($item_->name); ?></a></li><?php endforeach; ?></ul><?php endif; ?></li><?php endforeach; ?></ul></aside> <?php endif; ?>

