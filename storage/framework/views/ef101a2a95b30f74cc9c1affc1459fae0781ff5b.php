<div class="row">
    <div class="col-xs-4">
        <?php echo e(Form::label('price','Цена')); ?>

        <?php echo e(Form::text('price',$data->price,['class'=>'form-control','id'=>'price' ])); ?>

    </div>
    <div class="col-xs-4">
    </div>
</div>