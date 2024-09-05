<?php
  $error_number ??= 400;
?>

<?php $__env->startSection('title'); ?>
  <?php echo e(trans('backpack::base.error_page.'.$error_number)); ?>

<?php $__env->stopSection(); ?>

<?php $__env->startSection('description'); ?>
  <?php echo $exception?->getMessage() ? e($exception->getMessage()) : trans('backpack::base.error_page.message_4xx', [
    'href_back' => 'href="javascript:history.back()"',
    'href_homepage' => 'href="'.url('').'"',
  ]); ?>

<?php $__env->stopSection(); ?>

<?php echo $__env->make(backpack_view('errors.layout'), \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\laragon\www\instantscripts-new\vendor\backpack\crud\src\resources\views\ui/errors/4xx.blade.php ENDPATH**/ ?>