<?php $__env->startSection('title', 'Dashboard'); ?>

<?php $__env->startSection('content'); ?>

    <ul class="breadcrumb">
        <li><a href="<?php echo e(url('/')); ?>"> Dashboard</a></li>
    </ul>

    <div class="row">
        <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('view_staff')): ?>
            <div class="col-lg-3 col-xs-6">
                <!-- small box -->
                <div class="small-box bg-green">
                    <div class="inner">
                        <h3><?php echo e($staffActive); ?></h3>
                        <p>Staff Active</p>
                    </div>
                    <div class="icon">
                        <i class="fa fa-fw fa-user "></i>
                    </div>
                    <a href="<?php echo e(route('report.index')); ?>" class="small-box-footer">More Info <i class="fa fa-arrow-circle-right"></i>
                    </a>
                </div>
            </div>
            <!-- ./col -->
        <?php endif; ?>

        <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('view_resign')): ?>
            <div class="col-lg-3 col-xs-6">
                <!-- small box -->
                <div class="small-box bg-red">
                    <div class="inner">
                        <h3><?php echo e($endContract); ?></h3>
                        <p>Staff End Contract</p>
                    </div>
                    <div class="icon">
                        <i class="fa fa-fw fa-user-times"></i>
                    </div>
                    <a href="<?php echo e(route('report.index')); ?>" class="small-box-footer">More Info  <i class="fa fa-arrow-circle-right "></i></a>
                </div>
            </div>
            <!-- ./col -->
        <?php endif; ?>

        <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('view_staff_movement')): ?>
            <div class="col-lg-3 col-xs-6">
                <!-- small box -->
                <div class="small-box bg-yellow">
                    <div class="inner">
                        <h3><?php echo e($movement); ?></h3>
                        <p>Staff Movement</p>
                    </div>
                    <div class="icon">
                        <i class="fa fa-fw fa-exchange"></i>
                    </div>
                    <a href="<?php echo e(route('report.index')); ?>" class="small-box-footer">More Info <i class="fa fa-arrow-circle-right "></i></a>
                </div>
            </div>
            <!-- ./col -->
        <?php endif; ?>

    </div>

<?php $__env->stopSection(); ?>

<?php $__env->startSection('css'); ?>
    <style>
        .small-box .icon {
            top: 10px;
            font-size: 60px
        }
        .small-box:hover .icon {
            /*top: 15px;*/
            font-size: 70px;
        }
    </style>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('adminlte::page', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>