<?php $__env->startSection('adminlte_css'); ?>


    <?php echo $__env->yieldContent('css'); ?>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('body_class', 'login-page'); ?>

<?php $__env->startSection('body'); ?>
    <div class="login-box" style="margin: 0 auto; padding-top: 7%;">
        <!-- <div class="login-logo">
           <?php if(env("APP_ENV") == "testing"): ?>
               <h1 class="text-danger">For Developer Only</h1>
           <?php endif; ?>
           <?php if(env("APP_ENV") == "uat"): ?>
               <h1 class="text-danger">UAT (For User)</h1>
           <?php endif; ?>
        </div> -->
        <!-- /.login-logo -->
        <div class="login-box-body">
            <div class="text-center">
                <a href="<?php echo e(url('/')); ?>">
                    <!-- <img src="<?php echo e(asset('images/stsk_logo.png')); ?>" alt="STSK Logo"> -->
                </a>
            </div>
            <p class="login-box-msg"><b>HRMS/LOGIN</b></p>
            <form action="<?php echo e(url(config('adminlte.login_url', 'login'))); ?>" method="post">
                <?php echo csrf_field(); ?>


                <div class="form-group has-feedback <?php echo e($errors->has('username') ? 'has-error' : ''); ?>">
                    <input type="text" name="username" class="form-control" value="<?php echo e(old('username')); ?>"
                           placeholder="<?php echo e(trans('auth.username')); ?>">
                    <span class="glyphicon glyphicon-user form-control-feedback"></span>
                    <?php if($errors->has('username')): ?>
                        <span class="help-block">
                            <strong><?php echo e($errors->first('username')); ?></strong>
                        </span>
                    <?php endif; ?>
                </div>
                <div class="form-group has-feedback <?php echo e($errors->has('password') ? 'has-error' : ''); ?>">
                    <input type="password" name="password" class="form-control"
                           placeholder="<?php echo e(trans('adminlte::adminlte.password')); ?>">
                    <span class="glyphicon glyphicon-lock form-control-feedback"></span>
                    <?php if($errors->has('password')): ?>
                        <span class="help-block">
                            <strong><?php echo e($errors->first('password')); ?></strong>
                        </span>
                    <?php endif; ?>
                </div>
                <div class="row">
                    <div class="col-xs-8">
                        
                    </div>
                    <!-- /.col -->
                    <div class="col-xs-4">
                        <button type="submit"
                                class="btn btn-secondary btn-block btn-flat"><?php echo e(trans('adminlte::adminlte.sign_in')); ?></button>
                    </div>
                    <!-- /.col -->
                </div>
            </form>
            
        </div>
        <!-- /.login-box-body -->
    </div><!-- /.login-box -->
<?php $__env->stopSection(); ?>

<?php $__env->startSection('adminlte_js'); ?>










    <?php echo $__env->yieldContent('js'); ?>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('adminlte::master', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>