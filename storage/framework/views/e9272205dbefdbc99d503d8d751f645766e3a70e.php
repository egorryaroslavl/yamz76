<?php if(count($data)>0): ?>
	<ul class="dropdown-menu drop-menu-1" id="panels">
			<?php foreach($data as $item): ?>
			<?php $active = strpos($_SERVER['REQUEST_URI'],$item->alias)> 0 ? ' class="active"' :'' ?>
				<li>
			<a href="/category/<?php echo e($item->alias); ?>"<?php echo $active; ?>><?php echo e($item->name); ?></a>

				</li>
			<?php endforeach; ?>
		</ul>
<?php endif; ?>

