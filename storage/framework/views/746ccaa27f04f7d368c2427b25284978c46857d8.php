<?php if($errors->any()): ?>
    <?php $html = '<ul class="text-left text-danger">'; ?>
    <?php $__currentLoopData = $errors->all(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $error): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
        <?php $html .= '<li>'. $error .'</li>'; ?>
    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
    <?php $html .= '</ul>'; ?>

    <script>
        var htmlError = '<?= $html ?>';
        Swal.fire({
            title: 'Warning!',
            html: htmlError,
            type: 'warning',
            showCloseButton: true,
            showConfirmButton: false,
        })
    </script>
<?php endif; ?>