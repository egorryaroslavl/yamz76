<!DOCTYPE html>
<html>
<?php echo $__env->make('admin.inspinia.head.head', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
<body>
<div id="wrapper">
    <?php echo $__env->make('admin.inspinia.navigation.mainmenu', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
    <div id="page-wrapper" class="gray-bg">
        <?php echo $__env->make('admin.inspinia.navigation.navbar_top', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
        <div class="row wrapper border-bottom white-bg page-heading">
            <div class="col-lg-10">
                <?php echo $__env->yieldContent('title'); ?>
                <?php echo $__env->yieldContent('breadcrumb'); ?>
            </div>
            <div class="col-lg-2">
            </div>
        </div>
        <div class="wrapper wrapper-content animated fadeInRight">
            <div class="row">
                <div class="col-lg-12">
                    <div class="ibox float-e-margins">
                        <div class="ibox-title">
                            <h5><?php echo $__env->yieldContent('ibox_title'); ?> </h5>
                           <div class="ibox-tools">
                                <a class="collapse-link">
                                    <i class="fa fa-chevron-up"></i>
                                </a>
                            </div>
                        </div>
                        <div class="ibox-content">
                            <?php echo $__env->yieldContent('content'); ?>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <?php echo $__env->make('admin.inspinia.footer', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
    </div>
</div>
<input type="hidden" name="_token" id="_token" value="<?php echo e(csrf_token()); ?>"/>
<?php echo $__env->make('admin.inspinia.scripts', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
</body>
</html>
