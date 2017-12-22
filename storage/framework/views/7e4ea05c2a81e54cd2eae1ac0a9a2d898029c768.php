<div class="row">
    <div class="col-xs-3">
        <?php echo $__env->make('admin.common.icon', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
    </div>
    <div class="col-xs-9">
        <div class="form-group">
            <?php echo e(Form::label('description','Описание')); ?>

            <?php echo e(Form::textarea('description',$data->description,['class'=>'form-control','id'=>'description' ])); ?>


            <?php echo e(Form::label('short_description','Краткое Описание')); ?>

            <?php echo e(Form::textarea('short_description',$data->short_description,['class'=>'form-control','id'=>'short_description','rows'=>'3'])); ?>

        </div>
    </div>
</div>