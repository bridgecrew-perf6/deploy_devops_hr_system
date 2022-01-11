<?php $__env->startSection('title', 'Branch And Department'); ?>

<?php $__env->startSection('content'); ?>

<?php echo $__env->make('partials.breadcrumb', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>

<?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('add_branch_department')): ?>
<div class="row">
    <div class="col-sm-12 col-md-12">
        <div class="breadcrumb">
            <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('add_setting')): ?>
            <a class="btn btn-sm btn-success " href="<?php echo e(url('/branch-and-department/create')); ?>"> CREATE BRANCH OR DEPARTMENT</a>
            <?php endif; ?>
        </div>
    </div>
</div>
<?php endif; ?>

<div class="panel panel-default">
    <div class="panel-heading"><i class="fa fa-filter"></i> <label for="">Filter</label></div>
    <div class="panel-body">
        <form action="<?php echo e(route('branch_department.index')); ?>" role="form" method="get" id="filter-form">
            <?php echo e(csrf_field()); ?>

            <input type="hidden" name="company" value="<?php echo e(request('company')); ?>"/>
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
    <div class="panel-heading">
        <label for="">Branch Or Department</label>
    </div>
    <div class="panel-body" style="overflow-x:auto;">
        <table class="table table-bordered">
            <tr>
                <th width="150px">Action</th>
                <th>Code</th>
                <th>Short name</th>
                <th>Name EN</th>
                <th>Name KH</th>
                <th>Company</th>
            </tr>
            <?php $__currentLoopData = $branchesDepartments; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
            <tr>
                <td>
                    <form id="form_delete" action="<?php echo e(url('/branch-and-department/'.$item->id.'/delete')); ?>" method="POST">
                        <?php echo e(Form::token()); ?>

                        <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('view_branch_department')): ?>
                        <a class="" href="<?php echo e(url('/branch-and-department/'.$item->id.'/show')); ?>"><i class="fa fa-eye-slash"></i></a>
                        <?php endif; ?>
                        <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('edit_branch_department')): ?>
                        <a class="" style="margin-left: 5px" href="<?php echo e(url('/branch-and-department/'.$item->id.'/edit')); ?>"><i class="fa fa-pencil"></i></a>
                        <?php endif; ?>
                        <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('delete_branch_department')): ?>
                        <a href="javascript:void(0);">
                            <button onclick="var x = confirm('Are you sure?');if(x){this.form.submit();} else return false;" style="border: 0;background: none" class=""><i class="fa fa-trash"></i></button>
                        </a>
                        <?php endif; ?>
                    </form>
                </td>
                <td><?php echo e($item->code); ?></td>
                <td><?php echo e($item->short_name); ?></td>
                <td><?php echo e($item->name_en); ?></td>
                <td><?php echo e($item->name_km); ?></td>
                <td>
                    <?php if($item->company): ?>
                    <a href="<?php echo e(url('/company/'.$item->company->id.'/show')); ?>"><?php echo e($item->company->name_kh); ?>(<?php echo e($item->company_code); ?>)</a>
                    <?php endif; ?>
                </td>
            </tr>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        </table>
        <?php echo $branchesDepartments->appends(request()->query())->links(); ?>

    </div>
</div> <!-- .panel-default -->

<?php $__env->stopSection(); ?>

<div class="modal fade in" id="advanceSearch">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">×</span></button>
                <h4 class="modal-title">Advance Search</h4>
            </div>
            <div class="modal-body">
                <form action="<?php echo e(route('branch_department.index')); ?>" method="get">
                    <input type="hidden"
                           name="keyword"
                           class="form-control"
                           placeholder="Specific keyword"
                           value="<?php echo e(request()->get('keyword')); ?>"
                    >

                    <?php echo e(Form::token()); ?>

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