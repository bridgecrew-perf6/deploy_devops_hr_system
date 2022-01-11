<?php $__env->startSection('title', 'Position'); ?>

<?php $__env->startSection('content'); ?>

<?php echo $__env->make('partials.breadcrumb', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>

<?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('add_position')): ?>
<div class="row">
    <div class="col-sm-12 col-md-12">
        <div class="breadcrumb"><a class="btn btn-sm btn-success" href="<?php echo e(url('/position/create')); ?>"> CREATE POSITION</a></div>
    </div>
</div>
<?php endif; ?>

<div class="panel panel-default">
    <div class="panel-heading"><i class="fa fa-filter"></i> <label for="">Filter</label></div>
    <div class="panel-body">
        <form action="<?php echo e(route('position.index')); ?>" role="form" method="get" id="filter-form">
            <?php echo e(csrf_field()); ?>

            <input type="hidden" name="company" value="<?php echo e(request()->get('company')); ?>"/>
            <div class="row">
                <div class="form-group col-sm-6 col-md-6">
                    <input type="text" name="keyword" id="keyword" class="form-control" placeholder="Keyword" value="<?php echo e(request('keyword')); ?>">
                </div>

                <div class="form-group col-sm-6 col-md-6">
                    <button type="submit" class="btn btn-primary margin-r-5"><i class="fa fa-search"></i> Search</button>
                    <button type="button" class="btn btn-danger margin-r-5" id="btn-clear"><i class="fa fa-remove"></i> Clear</button>
                    <button type="button" class="btn btn-primary margin-r-5" data-toggle="modal" data-target="#advanceSearch"><i class="fa fa-filter"></i> Advance Search</button>
                </div>
            </div>
        </form>
    </div>
</div>

<div class="panel panel-default">
    <div class="panel-heading"><label for="">Position</label></div>
    <div class="panel-body" style="overflow-x:auto;">
        <table class="table table-bordered">
            <tr>
                <th width="150px">Action</th>
                <th>Short Name</th>
                <th>Level</th>
                <th>Name EN</th>
                <th>Name KH</th>
                <th>Salary Range</th>
                <th>Company</th>
            </tr>
            <?php $__currentLoopData = $position; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
            <tr>
                <td>
                    <form id="form_delete" action="<?php echo e(url('/position/'.$item->id.'/delete')); ?>" method="POST" role="form">
                        <?php echo e(Form::token()); ?>

                        <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('view_position')): ?>
                        <a class="" href="<?php echo e(url('/position/'.$item->id.'/show')); ?>"><i class="fa fa-eye-slash"></i></a>
                        <?php endif; ?>

                        <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('edit_position')): ?>
                        <a class="" style="margin-left: 5px" href="<?php echo e(url('/position/'.$item->id.'/edit')); ?>"><i class="fa fa-pencil"></i></a>
                        <?php endif; ?>

                        <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('delete_position')): ?>
                        <a href="javascript:void(0);">
                            <button onclick="var x = confirm('Are you sure?'); if(x){this.form.submit();} else return false;" style="border: 0;background: none" class=""><i class="fa fa-trash"></i>
                            </button>
                        </a>
                        <?php endif; ?>
                    </form>
                </td>
                <td><?php echo e($item->short_name); ?></td>
                <td><?php echo e($item->group_level); ?></td>
                <td><?php echo e($item->name_en); ?></td>
                <td><?php echo e($item->name_kh); ?></td>
                <td><?php echo e($item->range); ?></td>
                <td><?php echo e($item->company->name_kh ?? 'N/A'); ?>(<?php echo e(@$item->company_code); ?>)</td>
            </tr>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        </table>

        <?php echo $position->appends(request()->query())->links(); ?>

    </div>
</div> <!-- .panel-default -->


<div class="modal fade in" id="advanceSearch">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">×</span></button>
                <h4 class="modal-title">Advance Search</h4>
            </div>
            <div class="modal-body">
                <form action="<?php echo e(route('position.index')); ?>" method="get">
                    <?php echo e(Form::token()); ?>

                    <input type="hidden" name="keyword" value="<?php echo e(request()->get('keyword')); ?>"/>
                    <div class="form-group">
                        <select name="company" id="company" class="form-control">
                            <option value=""> << Select Company >> </option>
                            <?php $__currentLoopData = $companies; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $value): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <option value="<?php echo e($value->company_code); ?>" <?php echo e((request()->get('company') == $value->company_code) ? 'selected' : ''); ?>>
                                    <?php echo e($value->company_code ." - ". $value->name_kh); ?>

                                </option>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        </select>
                    </div>
                    <div class="form-group">
                        <select name="level" id="level" class="form-control">
                            <option value=""> << Select Level >> </option>
                            <?php $__currentLoopData = $position_level; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $value): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <option value="<?php echo e($value->group_level); ?>" <?php echo e((request()->get('level') == $value->group_level) ? 'selected' : ''); ?>>
                                    <?php echo e($value->group_level); ?>

                                </option>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        </select>
                    </div>
                    <div class="form-group">
                        <div>
                            <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                            <button type="submit" class="btn btn-primary pull-right">Search</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
        <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
</div>

<?php $__env->stopSection(); ?>

<?php $__env->startSection('js'); ?>

<script type="text/javascript">
    $(document).ready(function() {
        $('#btn-clear').click(function(e) {
            e.preventDefault();
            $("#keyword").val(null);
            $("#filter-form").submit();
        });

    });
</script>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('adminlte::page', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>