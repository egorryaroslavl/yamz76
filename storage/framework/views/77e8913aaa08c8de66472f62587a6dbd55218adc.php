<?php if($hasChild): ?>

<li <?php echo $attributes; ?>>
    <a href="#" >
        <?php echo $icon; ?>

        <span><?php echo $title; ?></span>
        <span class="pull-right-container">
            <i class="fa fa-angle-left pull-right"></i>
        </span>
    </a>

    <ul class="treeview-menu">
        <?php foreach($pages as $page): ?>
           <?php echo $page->render(); ?>

        <?php endforeach; ?>
    </ul>
</li>
<?php else: ?>
<li <?php echo $attributes; ?>>
    <a href="<?php echo e($url); ?>">
        <?php echo $icon; ?>

        <span><?php echo $title; ?></span>
        <span class="pull-right-container">
            <?php /*  <?php echo $badge; ?>*/ ?>
        </span>
    </a>
</li>
<?php endif; ?>
