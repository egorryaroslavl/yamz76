<?php $__env->startSection('content'); ?>
	<div class="row wrapper border-bottom white-bg page-heading">
		<div class="col-lg-12">
			<h2>Генератор текстов</h2>
			<ol class="breadcrumb">
				<li>
					<a href="/admin">Главная</a>
				</li>
				<li class="active">
					<strong><a href="#">Генератор текстов</a></strong>
				</li>
			</ol>
		</div>
	</div>
	<?php /*  page header  */ ?>
	<div class="wrapper wrapper-content animated fadeInRight">
		<div class="row border4 mb-10 p10 block-wrap">
			<h2>Предложение <select
					class="form-group sentence"
					id="sentence"
					size="1"
					name="sentence">
					<option id="sentence0" value="0">?</option>
					<option id="sentence1" value="1">1</option>
					<option id="sentence2" value="2">2</option>
					<option id="sentence3" value="3">3</option>
					<option id="sentence4" value="4">4</option>
				</select></h2>


			<h5>Выберите категорию к которой вы планируете привязать текст</h5>
			<?php echo $__env->make('admin.common.categories_select', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>

			<hr>

			<?php echo e(Widget::PartsBlock('position', 'a')); ?>

			<?php echo e(Widget::PartsBlock('position', 'b')); ?>

			<?php echo e(Widget::PartsBlock('position', 'c')); ?>


			<hr style="display: block;clear: both;margin:30px 0">
			<h4 style="border-bottom:1px #ccc solid;color:#0a568c;cursor: pointer;padding: 0 20px"
			    onclick="$(this).next().slideToggle()">Сразу много  <small>Вводить построчно</small></h4>

			<div style="display: none;">
				<div class="col-md-4">
					<?php echo e(Widget::AddAnchor('position', '_a')); ?>

					<textarea name="parta[]" id="part_a" class="form-control" rows="10" placeholder="Часть A"></textarea>
				</div>
				<div class="col-md-4">
					<?php echo e(Widget::AddAnchor('position', '_b')); ?>

					<textarea name="partb[]" id="part_b" class="form-control" rows="10"placeholder="Часть B"></textarea>
				</div>
				<div class="col-md-4">
					<?php echo e(Widget::AddAnchor('position', '_c')); ?>

					<textarea name="partc[]" id="part_c" class="form-control" rows="10"placeholder="Часть C"></textarea>
				</div><hr style="display:block;clear:both;margin:30px 0">
				<input type="button" id="many_once" class="btn btn-info btn-block mt-10 many_once" value="ГОТОВО">
			</div>
			<input type="hidden" name="_token" id="_token" value="<?php echo e(csrf_token()); ?>">


		</div>
		<?php /*<?php echo $__env->make('admin.text_generator.sentences_html_list', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>*/ ?>
	</div>
	</div>

<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.admin.index', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>