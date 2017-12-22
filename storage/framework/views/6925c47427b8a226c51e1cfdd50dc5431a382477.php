<section style="margin: 20px 0;padding-right: 26px ">
	<form name="searchFormTwo" action="/catalog_search" method="post">
		<div class="input-group">
			<input type="text" name="search" class="form-control" placeholder="Поиск по каталогу..." aria-describedby="basic-addon2">

			 <input  type="hidden" name="_token" value="<?php echo csrf_token(); ?>"/>
			<span class="input-group-addon"  onclick="document.getElementsByName('searchFormTwo')[0].submit();" style="background:#286090;border: 1px #646464 solid;cursor: pointer;border-left: 0"><i class="fa fa-search" style="color: #fff"></i></span>

		</div><?php if($errors->any()): ?>
			<h4 style="color: red"><?php echo e($errors->first()); ?></h4>
		<?php endif; ?>
	</form>
</section>