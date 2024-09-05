<input type="hidden" name="_http_referrer" value=<?php echo e(old('_http_referrer') ?? \URL::previous() ?? url($crud->route)); ?>>


<?php if($crud->tabsEnabled() && count($crud->getTabs())): ?>
    <?php echo $__env->make($crud->getFirstFieldView('relationship.inc.show_tabbed_fields'), \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
    <input type="hidden" name="_current_tab" value="<?php echo e(Str::slug($crud->getTabs()[0], "")); ?>" />
<?php else: ?>
  <div class="card">
    <div class="card-body row">
      <?php echo $__env->make($crud->getFirstFieldView('relationship.inc.show_fields'), ['fields' => $crud->fields()], \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
    </div>
  </div>
<?php endif; ?>

<?php $__currentLoopData = app('widgets')->toArray(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $currentWidget): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
<?php
    $currentWidget = \Backpack\CRUD\app\Library\Widget::add($currentWidget);
?>
    <?php if($currentWidget->getAttribute('inline')): ?>
        <?php echo $__env->make($currentWidget->getFinalViewPath(), ['widget' => $currentWidget->toArray()], \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
    <?php endif; ?>
<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>


<?php /**PATH C:\laragon\www\instantscripts-new\vendor\backpack\pro/resources/views/fields/relationship/inc/form_content.blade.php ENDPATH**/ ?>