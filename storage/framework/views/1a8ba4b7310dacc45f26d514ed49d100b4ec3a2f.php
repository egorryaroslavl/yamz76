<?php $__env->startSection('content'); ?>
    <?php if(Session::has('message')): ?>
        <div class="alert alert-info"><?php echo Session::get('message'); ?>   </div>
        <div class="alert alert-danger"><?php echo Session::get('flash_message'); ?>   </div>
    <?php endif; ?>
    <?php echo e(Form::open( [ 'action' =>'Productions\ProductionsController@'. $data->act,'enctype'=>'multipart/form-data' ] )); ?>

    <?php if( isset( $data->id ) ){ ?> <?php echo e(Form::hidden('id',$data->id )); ?> <?php } ?>
    <input type="hidden" name="icon" id="icon" value="<?php echo e($data->icon); ?>"/>
    <div class="tabs-container">
        <ul class="nav nav-tabs">
            <li class="active"><a data-toggle="tab" href="#tab-1" onclick="return false">Основные данные</a>
            </li>
            <li class=""><a data-toggle="tab" href="#tab-2" onclick="return false">SEO</a></li>
        </ul>
        <div class="tab-content">
            <div id="tab-1" class="tab-pane active">
                <div class="panel-body">
                    <?php if( count($errors->all()) > 0 ): ?>
                        <?php foreach($errors->all() as $error): ?>
                            <div class="alert alert-danger">Ошибка! <?php echo e($error); ?></div>
                        <?php endforeach; ?>
                    <?php endif; ?>
                    <?php echo $__env->make('admin.common.name_alias_articul', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
                    <div class="hr-line-dashed"></div>
                    <?php echo $__env->make('admin.common.description_short_description', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
                    <div class="hr-line-dashed"></div>
                    <?php echo $__env->make('admin.common.price', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
                    <div class="hr-line-dashed"></div>
                    <?php echo $__env->make('admin.common.public_anons_hit', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
                    <div class="hr-line-dashed"></div>
                </div>
            </div>
            <div id="tab-2" class="tab-pane">
                <div class="panel-body">
                    <?php echo $__env->make('admin.common.metatag_title_metatag_description_metatag_keywords', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
                </div>
            </div>
        </div>
    </div>
    <div class="hr-line-dashed"></div>
    <div class="row">
        <div class="col-xs-6">
            <?php echo Form::submit('Готово!',['class'=>'btn btn-primary','style'=>'padding:3px  50px;font-size:1.5rem']); ?>

            <?php echo Form::close(); ?>

        </div>
    </div>
<?php $__env->stopSection(); ?>


<?php $__env->startSection('ibox_title'); ?>

    <?php if( $data->act == 'update'): ?>
        [
        <a href="/admin/category/<?php echo e($data->category->id); ?>/productions"><?php echo e($data->category->name); ?></a> ] > <?php echo e($data->name); ?>  <?php if(!empty($data->articul)): ?>
            <small>( артикул - <?php echo e($data->articul); ?> )</small><?php endif; ?>
    <?php else: ?>
        [
        <a href="/admin/category/<?php echo e($data->category->id); ?>/productions"><?php echo e($data->category->name); ?></a> ] > Новая запись
    <?php endif; ?>

<?php $__env->stopSection(); ?>
<?php $__env->startSection('title'); ?>

    <?php if(  $data->act == 'update' ): ?>
        <h2> [ <a href="/admin/category/<?php echo e($data->category->id); ?>/productions"><?php echo e($data->category->name); ?></a> ]
             > <?php echo e($data->name,''); ?> <?php if(!empty($data->articul)): ?>
                <small>( артикул - <?php echo e($data->articul); ?> )</small><?php endif; ?></h2>
    <?php else: ?>
        <h2> [ <a href="/admin/category/<?php echo e($data->category->id); ?>/productions"><?php echo e($data->category->name); ?></a> ]
             > Новая запись </h2>

    <?php endif; ?>
<?php $__env->stopSection(); ?>


<?php $__env->startSection('breadcrumb'); ?>
    <?php if(isset($data->id)): ?>
        <ol class="breadcrumb">
            <li>
                <a href="/admin">Главная</a>
            </li>

            <li>
                <strong>Категория [ <a
                            href="/admin/category/<?php echo e($data->category->id); ?>/productions"><?php echo e($data->category->name); ?></a>
                        ]</strong>
            </li>

            <li>
                <strong> Продукция</strong>
            </li>
            <li>
                <strong><?php echo e($data->name); ?> <?php if(!empty($data->articul)): ?>
                        <small>( артикул - <?php echo e($data->articul); ?> )</small><?php endif; ?></strong>
            </li>

        </ol>
    <?php endif; ?>
    <style>
        label {
            margin-top: 15px;
            }

        .nav-tabs li a {
            /* font-size: 18px !important;*/
            font-weight: bold !important;
            color:       rgba(64, 80, 187, 0.7) !important;
            }
    </style>
<?php $__env->stopSection(); ?>


<?php echo $__env->make('layouts.admin.form', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>