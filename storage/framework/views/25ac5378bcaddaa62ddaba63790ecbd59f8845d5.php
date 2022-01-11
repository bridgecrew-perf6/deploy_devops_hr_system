<ul class="breadcrumb">
    <li>
        <a href="<?php echo e(url('/')); ?>"> Dashboard</a>
    </li>
    <?php $link = url('/'); ?>
    <?php for($i = 1; $i <= count(Request::segments()); $i++): ?>
        <li>
            <?php if($i < count(Request::segments()) & $i > 0): ?>
                <?php if(strlen(Request::segment($i)) > 100): ?>
                    <?php continue; ?>
                <?php endif; ?>
                <?php $link .= "/" . Request::segment($i); ?>
                <a class="text-capitalize" href="<?= $link ?>"><?php echo e(Request::segment($i)); ?></a>
            <?php else: ?>
                <a href="javascript:void(0)" class="text-capitalize text-black"><?php echo e(Request::segment($i)); ?></a>
            <?php endif; ?>
        </li>
    <?php endfor; ?>
</ul>

<?php $__env->startSection('css'); ?>
    <style>
        .breadcrumb {
            background-color: #ffffff;
        }
    </style>
<?php $__env->stopSection(); ?>