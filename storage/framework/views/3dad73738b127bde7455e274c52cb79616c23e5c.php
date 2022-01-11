<?php $__env->startSection('title', 'List all staff'); ?>

<?php $__env->startSection('content'); ?>
    <?php echo $__env->make('partials.breadcrumb', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>

    <div class="row">
        <div class="col-sm-12 col-md-12">
            <div class="breadcrumb">
                <a href="<?php echo e(route('staff-personal-info.create')); ?>#personal_info" class="btn btn-success btn-sm"><i class="fa fa-user-plus"></i> CREATE</a>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-sm-12 col-md-12">
            <div class="panel panel-default">
                <div class="panel-heading"><i class="fa fa-filter"></i> Filter</div>
                <div class="panel-body">
                    <form action="<?php echo e(route('staff.filter')); ?>" role="form" method="get" id="filter-form">
                        <?php echo e(csrf_field()); ?>

                        <div class="row">
                            <div class="form-group col-sm-6 col-md-4">
                                <input type="text" name="key_word" class="form-control" placeholder="Keyword" value="<?php echo e(request('key_word')); ?>">
                            </div>
                            <div class="form-group col-sm-6 col-md-4">
                                <select name="gender" id="gender" class="form-control js-select2-single">
                                    <option value=""> << <?php echo e(__("label.gender")); ?> >></option>
                                    <?php $__currentLoopData = GENDER; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $value): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                        <option value="<?php echo e($key); ?>" <?php echo e($key.'' == request('gender') ? 'selected' : ''); ?>><?php echo e($value); ?></option>
                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                </select>
                            </div>

                            <div class="form-group col-sm-6 col-md-4">
                                <button type="submit" class="btn btn-default margin-r-5"><i class="fa fa-search"></i> Search</button>
                                <button type="submit" class="btn btn-danger margin-r-5" id="btn-clear"><i class="fa fa-remove"></i> Clear Filter</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div> <!-- /.panel -->
            <div style="overflow-x: auto;">
                <table class="table table-striped">
                    <tr>
                        <th>#</th>
                        <th>Staff ID</th>
                        <th>Full Name KH</th>
                        <th>Full Name EN</th>
                        <th>D.O.E</th>
                        <th>Date Of Birth</th>
                        <th>Place Of Birth</th>
                        <th>Phone Number</th>
                        <th>Action</th>
                    </tr>
                    <?php $__currentLoopData = $staffs; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $staff): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <?php $i++ ?>
                        <?php ($enableDelete = !isset($staff->contract)); ?>
                        <tr>
                            <td><?php echo e($i); ?></td>
                            <td><?php echo e(@$staff->staff_id ?? 'N/A'); ?></td>
                            <td><?php echo e($staff->last_name_kh.' '.$staff->first_name_kh); ?></td>
                            <td><?php echo e($staff->last_name_en.' '.$staff->first_name_en); ?></td>
                            <td>
                                <?php echo e(@$staff->firstContract->start_date ? date('d-M-Y', strtotime(@$staff->firstContract->start_date)) : 'N/A'); ?>

                            </td>
                            <td><?php echo e(isset($staff->dob) ? date_readable($staff->dob) : 'N/A'); ?></td>
                            <td><?php echo e($staff->pob ?? 'N/A'); ?></td>
                            <td><?php echo e($staff->phone); ?></td>
                            <td>
                                <a title="Show" href="<?php echo e(route('staff-personal-info.show', encrypt($staff->id))); ?>" class="btn btn-info btn-xs margin-r-5"><i class="fa fa-eye"></i></a>
                                <a title="Edit" href="<?php echo e(route('staff-personal-info.edit', encrypt($staff->id))); ?>" class="btn btn-primary btn-xs margin-r-5"><i class="fa fa-edit"></i></a>
                                <?php if($enableDelete): ?>
                                    <a title="Delete" href="javascript:void(0);" class="btn btn-danger btn-xs btn-delete margin-r-5" data-delete="<?php echo e(encrypt($staff->id)); ?>"><i class="fa fa-trash"></i></a>
                                <?php endif; ?>
                                
                            </td>
                        </tr>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                </table>
            </div>

            <?php echo e($staffs->appends($param)->links()); ?>

        </div>
    </div>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('js'); ?>
    <script type="text/javascript" src="<?php echo e(asset('js/staff/index.js')); ?>"></script>
    <script>
        $(document).ready(function (e) {
            $("#btn-clear").on('click', function (e) {
                e.preventDefault();
                $("form#filter-form").find(":input").val("");
                $("form#filter-form").submit();
            })
        });
    </script>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('adminlte::page', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>