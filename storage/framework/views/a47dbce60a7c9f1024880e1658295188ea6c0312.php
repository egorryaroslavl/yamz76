<?php
$data        = \App\Model\YamzCategory::where( 'parent_id', null )->where( 'public', 1 )->orderBy( 'lft' )->get();

?>
    <section id="shop" class="section">
        <header class="section__header">
            <div class="section__title">
                <div class="h1">Каталог</div>
               <?php /* <small><?php echo e(count($data)); ?> категорий</small>*/ ?>
            </div>
            <div class="section__icon">
                <span class="fa fa-cogs"></span>
            </div>
        </header>

        <div class="container">
            <div class="row">
                <div  class="">
                    <?php if(count($data)==0): ?>
                        <p>Пусто...</p>
                    <?php else: ?>
                        <?php $n = 0; ?>
                        <?php foreach($data as $item): ?>
                            <div id="shop-item-<?php echo e($n); ?>" class="shop-item col-md-2 col-sm-4 col-xs-6 " style="margin-bottom: 20px">
                                <div class="shop-item__header">
                                    <a href="/category/<?php echo e($item->alias); ?>">
                                   <img class="shop-item__image" src="<?php echo e($item->icon); ?>" alt=""/>
                                    </a>
                                </div>
                                <div class="shop-item__body" style="height: 150px">
                                    <h3 style="height:4.0rem;vertical-align: bottom"><a href="/category/<?php echo e($item->alias); ?>"
                                           class="shop-item__title"><?php echo e($item->name); ?></a>
                                    </h3>
                                    <span class="shop-item__price">
                                        <?php echo e($item->short_description); ?>

                                    </span>
                                    <?php /*<span class="shop-item__rating">
                                        Подкатегорий - <?php echo e(\App\Http\Controllers\YamzCategoryController::childCount($item->alias)); ?>

                                    </span>*/ ?>
                                </div>
                            </div>
                            <?php $n++; ?>
                        <?php endforeach; ?>

                    <?php endif; ?>

                </div>
            </div>
        </div>
    </section>
<div class="section__icon">
	<span style="color: #3a3d3f" class="fa fa-window-minimize"></span>
</div>