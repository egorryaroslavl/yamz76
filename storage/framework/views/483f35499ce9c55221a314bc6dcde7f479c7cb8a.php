<div style="width:100%;height:1px;margin: 0;">
	<?php if(isset($prev[0])): ?>
		<div class="prev"><a href="/product/<?php echo e($prev[0]->alias); ?>-<?php echo e($prev[0]->id); ?>" title="<?php echo e($prev[0]->name); ?><?php echo e(!empty($prev[0]->articul) ? ' ('. $prev[0]->articul .')' :''); ?>"><i class="fa fa-chevron-left"></i> </a></div>
		<?php else: ?>
		<div class="prev"><a href="#" style="opacity:.5;cursor: not-allowed"> <i class="fa fa-chevron-left"></i> </a></div>
	<?php endif; ?>
	<?php if(isset($next[0])): ?>
		<div class="next"><a href="/product/<?php echo e($next[0]->alias); ?>-<?php echo e($next[0]->id); ?>" title="<?php echo e($next[0]->name); ?><?php echo e(!empty($next[0]->articul) ? ' ('. $next[0]->articul .')' :''); ?>"> <i class="fa fa-chevron-right"></i> </a></div>
		<?php else: ?>
			<div class="next"><a href="#" style="opacity:.5;cursor: not-allowed"> <i class="fa fa-chevron-right"></i> </a></div>
	<?php endif; ?>
</div>
<style>
	.prev {
		float: left;
		vertical-align: middle;
		}

	.next {
		float: right;
		vertical-align: middle;
		}
</style>

