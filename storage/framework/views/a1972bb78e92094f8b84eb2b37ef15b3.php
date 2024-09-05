
<?php echo $__env->renderWhen(!empty($widget['wrapper']), backpack_view('widgets.inc.wrapper_start'), \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path'])); ?>
	
	<?php echo $__env->make($widget['view'], ['widget' => $widget], \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>

<?php echo $__env->renderWhen(!empty($widget['wrapper']), backpack_view('widgets.inc.wrapper_end'), \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path'])); ?><?php /**PATH C:\laragon\www\instantscripts-new\vendor\backpack\crud\src\resources\views\ui/widgets/view.blade.php ENDPATH**/ ?>