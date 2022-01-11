<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <link rel="shortcut icon" type="image/x-icon" href="<?php echo e(asset('images/favicon.ico')); ?>"/>
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="csrf-token" content="<?php echo e(csrf_token()); ?>">
    <title><?php echo $__env->yieldContent('title_prefix', config('adminlte.title_prefix', '')); ?>
    <?php echo $__env->yieldContent('title', config('adminlte.title', 'HR-MIS')); ?>
    <?php echo $__env->yieldContent('title_postfix', config('adminlte.title_postfix', '')); ?></title>
    <!-- Tell the browser to be responsive to screen width -->
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">

    <!-- Bootstrap 3.3.7 -->
    <link rel="stylesheet" href="<?php echo e(asset('css/bootstrap.css')); ?>">

    <!-- Google Font -->
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,600,700,300italic,400italic,600italic">

    <!-- Font Awesome -->
    <link rel="stylesheet" href="<?php echo e(asset('css/font-awesome.css')); ?>">

    <!-- Ionicons -->
    <link rel="stylesheet" href="<?php echo e(asset('css/ionicons.css')); ?>">

    <?php if(config('adminlte.plugins.select2')): ?>
        <!-- Select2 -->
        <link href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.10/css/select2.min.css" rel="stylesheet" />
    <?php endif; ?>

    <!-- Theme style -->
    <link rel="stylesheet" href="<?php echo e(asset('css/AdminLTE.css')); ?>">

    <?php if(config('adminlte.plugins.datatables')): ?>
        <!-- DataTables with bootstrap 3 style -->
        <link rel="stylesheet" href="//cdn.datatables.net/v/bs/dt-1.10.18/datatables.min.css">
    <?php endif; ?>

    <!-- Sweet alert 2 -->
    <link rel="stylesheet" href="<?php echo e(asset('css/sweetalert2.css')); ?>">

    <!-- Google Khmer font -->
    <link href="https://fonts.googleapis.com/css?family=Nokora:400,700&amp;subset=khmer" rel="stylesheet">

    <?php echo $__env->yieldContent('adminlte_css'); ?>

    <style>
        body {
            font-family: 'Source Sans Pro','Helvetica Neue',Helvetica,Arial,sans-serif,'Nokora';
        }
        .swal2-popup {
            font-size: 1.6rem !important;
        }
    </style>

    <!--[if lt IE 9]>
    <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
    <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->

</head>
<body class="hold-transition <?php echo $__env->yieldContent('body_class'); ?>">
<div id="app1">
    <?php echo $__env->yieldContent('body'); ?>
</div>

<script type="text/javascript">
    window.Laravel = {
        csrfToken: "<?php echo e(csrf_token()); ?>",
        jsPermissions: <?php echo auth()->check()?auth()->user()->jsPermissions():null; ?>

    }
</script>

<script src="<?php echo e(asset('vendor/adminlte/vendor/jquery/dist/jquery.min.js')); ?>"></script>
<script src="<?php echo e(asset('vendor/adminlte/vendor/jquery/dist/jquery.slimscroll.min.js')); ?>"></script>

<?php if(config('adminlte.plugins.select2')): ?>
    <!-- Select2 -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.8/js/select2.min.js" defer></script>
<?php endif; ?>
<?php if(config('adminlte.plugins.datatables')): ?>
    <!-- DataTables with bootstrap 3 renderer -->
    <script src="<?php echo e(asset('js/datatables/datatables.min.js')); ?>"></script>
<?php endif; ?>
<?php if(config('adminlte.plugins.chartjs')): ?>
    <!-- ChartJS -->
    <script src="<?php echo e(asset('js/Chart/Chart.bundle.min.js')); ?>"></script>
<?php endif; ?>
<script src="<?php echo e(asset('/sweet_alert2/sweetalert2.all.min.js')); ?>"></script>

<?php echo $__env->yieldContent('adminlte_js'); ?>

<?php echo $__env->make('layouts.error', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
<?php echo $__env->make('layouts.success', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
</body>
</html>
