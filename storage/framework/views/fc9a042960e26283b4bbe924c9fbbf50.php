
<li class="nav-item"><a class="nav-link" href="<?php echo e(backpack_url('dashboard')); ?>"><i class="la la-home nav-icon"></i> <?php echo e(trans('backpack::base.dashboard')); ?></a></li>

<?php if (isset($component)) { $__componentOriginalead85e76a923e64d9eae23947232cf9a = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginalead85e76a923e64d9eae23947232cf9a = $attributes; } ?>
<?php $component = Backpack\CRUD\app\View\Components\MenuItem::resolve(['title' => 'Scripts','icon' => 'la la-question','link' => backpack_url('script')] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? (array) $attributes->getIterator() : [])); ?>
<?php $component->withName('backpack::menu-item'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag && $constructor = (new ReflectionClass(Backpack\CRUD\app\View\Components\MenuItem::class))->getConstructor()): ?>
<?php $attributes = $attributes->except(collect($constructor->getParameters())->map->getName()->all()); ?>
<?php endif; ?>
<?php $component->withAttributes([]); ?>
<?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginalead85e76a923e64d9eae23947232cf9a)): ?>
<?php $attributes = $__attributesOriginalead85e76a923e64d9eae23947232cf9a; ?>
<?php unset($__attributesOriginalead85e76a923e64d9eae23947232cf9a); ?>
<?php endif; ?>
<?php if (isset($__componentOriginalead85e76a923e64d9eae23947232cf9a)): ?>
<?php $component = $__componentOriginalead85e76a923e64d9eae23947232cf9a; ?>
<?php unset($__componentOriginalead85e76a923e64d9eae23947232cf9a); ?>
<?php endif; ?>
<?php if (isset($component)) { $__componentOriginalead85e76a923e64d9eae23947232cf9a = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginalead85e76a923e64d9eae23947232cf9a = $attributes; } ?>
<?php $component = Backpack\CRUD\app\View\Components\MenuItem::resolve(['title' => 'Patients','icon' => 'la la-question','link' => backpack_url('patient')] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? (array) $attributes->getIterator() : [])); ?>
<?php $component->withName('backpack::menu-item'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag && $constructor = (new ReflectionClass(Backpack\CRUD\app\View\Components\MenuItem::class))->getConstructor()): ?>
<?php $attributes = $attributes->except(collect($constructor->getParameters())->map->getName()->all()); ?>
<?php endif; ?>
<?php $component->withAttributes([]); ?>
<?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginalead85e76a923e64d9eae23947232cf9a)): ?>
<?php $attributes = $__attributesOriginalead85e76a923e64d9eae23947232cf9a; ?>
<?php unset($__attributesOriginalead85e76a923e64d9eae23947232cf9a); ?>
<?php endif; ?>
<?php if (isset($__componentOriginalead85e76a923e64d9eae23947232cf9a)): ?>
<?php $component = $__componentOriginalead85e76a923e64d9eae23947232cf9a; ?>
<?php unset($__componentOriginalead85e76a923e64d9eae23947232cf9a); ?>
<?php endif; ?>


<?php if (isset($component)) { $__componentOriginalead85e76a923e64d9eae23947232cf9a = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginalead85e76a923e64d9eae23947232cf9a = $attributes; } ?>
<?php $component = Backpack\CRUD\app\View\Components\MenuItem::resolve(['title' => 'Medicine categories','icon' => 'la la-question','link' => backpack_url('medicine-category')] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? (array) $attributes->getIterator() : [])); ?>
<?php $component->withName('backpack::menu-item'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag && $constructor = (new ReflectionClass(Backpack\CRUD\app\View\Components\MenuItem::class))->getConstructor()): ?>
<?php $attributes = $attributes->except(collect($constructor->getParameters())->map->getName()->all()); ?>
<?php endif; ?>
<?php $component->withAttributes([]); ?>
<?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginalead85e76a923e64d9eae23947232cf9a)): ?>
<?php $attributes = $__attributesOriginalead85e76a923e64d9eae23947232cf9a; ?>
<?php unset($__attributesOriginalead85e76a923e64d9eae23947232cf9a); ?>
<?php endif; ?>
<?php if (isset($__componentOriginalead85e76a923e64d9eae23947232cf9a)): ?>
<?php $component = $__componentOriginalead85e76a923e64d9eae23947232cf9a; ?>
<?php unset($__componentOriginalead85e76a923e64d9eae23947232cf9a); ?>
<?php endif; ?>



<?php if (isset($component)) { $__componentOriginalead85e76a923e64d9eae23947232cf9a = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginalead85e76a923e64d9eae23947232cf9a = $attributes; } ?>
<?php $component = Backpack\CRUD\app\View\Components\MenuItem::resolve(['title' => 'Nurses','icon' => 'la la-question','link' => backpack_url('nurse')] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? (array) $attributes->getIterator() : [])); ?>
<?php $component->withName('backpack::menu-item'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag && $constructor = (new ReflectionClass(Backpack\CRUD\app\View\Components\MenuItem::class))->getConstructor()): ?>
<?php $attributes = $attributes->except(collect($constructor->getParameters())->map->getName()->all()); ?>
<?php endif; ?>
<?php $component->withAttributes([]); ?>
<?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginalead85e76a923e64d9eae23947232cf9a)): ?>
<?php $attributes = $__attributesOriginalead85e76a923e64d9eae23947232cf9a; ?>
<?php unset($__attributesOriginalead85e76a923e64d9eae23947232cf9a); ?>
<?php endif; ?>
<?php if (isset($__componentOriginalead85e76a923e64d9eae23947232cf9a)): ?>
<?php $component = $__componentOriginalead85e76a923e64d9eae23947232cf9a; ?>
<?php unset($__componentOriginalead85e76a923e64d9eae23947232cf9a); ?>
<?php endif; ?>
<?php if (isset($component)) { $__componentOriginal3304fc1ec27516a666a2f68d6da76d86 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal3304fc1ec27516a666a2f68d6da76d86 = $attributes; } ?>
<?php $component = Backpack\CRUD\app\View\Components\MenuDropdown::resolve(['title' => 'Doctor Approval','icon' => 'la la-patient'] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? (array) $attributes->getIterator() : [])); ?>
<?php $component->withName('backpack::menu-dropdown'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag && $constructor = (new ReflectionClass(Backpack\CRUD\app\View\Components\MenuDropdown::class))->getConstructor()): ?>
<?php $attributes = $attributes->except(collect($constructor->getParameters())->map->getName()->all()); ?>
<?php endif; ?>
<?php $component->withAttributes([]); ?>
<?php if (isset($component)) { $__componentOriginalead85e76a923e64d9eae23947232cf9a = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginalead85e76a923e64d9eae23947232cf9a = $attributes; } ?>
<?php $component = Backpack\CRUD\app\View\Components\MenuItem::resolve(['title' => 'Doctor Waiting for Approval','icon' => 'la la-pati ent','link' => route('doctor-approval')] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? (array) $attributes->getIterator() : [])); ?>
<?php $component->withName('backpack::menu-item'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag && $constructor = (new ReflectionClass(Backpack\CRUD\app\View\Components\MenuItem::class))->getConstructor()): ?>
<?php $attributes = $attributes->except(collect($constructor->getParameters())->map->getName()->all()); ?>
<?php endif; ?>
<?php $component->withAttributes([]); ?>
<?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginalead85e76a923e64d9eae23947232cf9a)): ?>
<?php $attributes = $__attributesOriginalead85e76a923e64d9eae23947232cf9a; ?>
<?php unset($__attributesOriginalead85e76a923e64d9eae23947232cf9a); ?>
<?php endif; ?>
<?php if (isset($__componentOriginalead85e76a923e64d9eae23947232cf9a)): ?>
<?php $component = $__componentOriginalead85e76a923e64d9eae23947232cf9a; ?>
<?php unset($__componentOriginalead85e76a923e64d9eae23947232cf9a); ?>
<?php endif; ?>
<?php if (isset($component)) { $__componentOriginalead85e76a923e64d9eae23947232cf9a = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginalead85e76a923e64d9eae23947232cf9a = $attributes; } ?>
<?php $component = Backpack\CRUD\app\View\Components\MenuItem::resolve(['title' => 'Approved Scripts','icon' => 'la la-patient','link' => route('doctor-approval')] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? (array) $attributes->getIterator() : [])); ?>
<?php $component->withName('backpack::menu-item'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag && $constructor = (new ReflectionClass(Backpack\CRUD\app\View\Components\MenuItem::class))->getConstructor()): ?>
<?php $attributes = $attributes->except(collect($constructor->getParameters())->map->getName()->all()); ?>
<?php endif; ?>
<?php $component->withAttributes([]); ?>
<?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginalead85e76a923e64d9eae23947232cf9a)): ?>
<?php $attributes = $__attributesOriginalead85e76a923e64d9eae23947232cf9a; ?>
<?php unset($__attributesOriginalead85e76a923e64d9eae23947232cf9a); ?>
<?php endif; ?>
<?php if (isset($__componentOriginalead85e76a923e64d9eae23947232cf9a)): ?>
<?php $component = $__componentOriginalead85e76a923e64d9eae23947232cf9a; ?>
<?php unset($__componentOriginalead85e76a923e64d9eae23947232cf9a); ?>
<?php endif; ?>
<?php if (isset($component)) { $__componentOriginalead85e76a923e64d9eae23947232cf9a = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginalead85e76a923e64d9eae23947232cf9a = $attributes; } ?>
<?php $component = Backpack\CRUD\app\View\Components\MenuItem::resolve(['title' => 'Rejected Scripts','icon' => 'la la-patient','link' => route('doctor-approval')] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? (array) $attributes->getIterator() : [])); ?>
<?php $component->withName('backpack::menu-item'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag && $constructor = (new ReflectionClass(Backpack\CRUD\app\View\Components\MenuItem::class))->getConstructor()): ?>
<?php $attributes = $attributes->except(collect($constructor->getParameters())->map->getName()->all()); ?>
<?php endif; ?>
<?php $component->withAttributes([]); ?>
<?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginalead85e76a923e64d9eae23947232cf9a)): ?>
<?php $attributes = $__attributesOriginalead85e76a923e64d9eae23947232cf9a; ?>
<?php unset($__attributesOriginalead85e76a923e64d9eae23947232cf9a); ?>
<?php endif; ?>
<?php if (isset($__componentOriginalead85e76a923e64d9eae23947232cf9a)): ?>
<?php $component = $__componentOriginalead85e76a923e64d9eae23947232cf9a; ?>
<?php unset($__componentOriginalead85e76a923e64d9eae23947232cf9a); ?>
<?php endif; ?>
 <?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginal3304fc1ec27516a666a2f68d6da76d86)): ?>
<?php $attributes = $__attributesOriginal3304fc1ec27516a666a2f68d6da76d86; ?>
<?php unset($__attributesOriginal3304fc1ec27516a666a2f68d6da76d86); ?>
<?php endif; ?>
<?php if (isset($__componentOriginal3304fc1ec27516a666a2f68d6da76d86)): ?>
<?php $component = $__componentOriginal3304fc1ec27516a666a2f68d6da76d86; ?>
<?php unset($__componentOriginal3304fc1ec27516a666a2f68d6da76d86); ?>
<?php endif; ?>
<?php if (isset($component)) { $__componentOriginalead85e76a923e64d9eae23947232cf9a = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginalead85e76a923e64d9eae23947232cf9a = $attributes; } ?>
<?php $component = Backpack\CRUD\app\View\Components\MenuItem::resolve(['title' => 'Locations','icon' => 'la la-question','link' => backpack_url('locations')] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? (array) $attributes->getIterator() : [])); ?>
<?php $component->withName('backpack::menu-item'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag && $constructor = (new ReflectionClass(Backpack\CRUD\app\View\Components\MenuItem::class))->getConstructor()): ?>
<?php $attributes = $attributes->except(collect($constructor->getParameters())->map->getName()->all()); ?>
<?php endif; ?>
<?php $component->withAttributes([]); ?>
<?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginalead85e76a923e64d9eae23947232cf9a)): ?>
<?php $attributes = $__attributesOriginalead85e76a923e64d9eae23947232cf9a; ?>
<?php unset($__attributesOriginalead85e76a923e64d9eae23947232cf9a); ?>
<?php endif; ?>
<?php if (isset($__componentOriginalead85e76a923e64d9eae23947232cf9a)): ?>
<?php $component = $__componentOriginalead85e76a923e64d9eae23947232cf9a; ?>
<?php unset($__componentOriginalead85e76a923e64d9eae23947232cf9a); ?>
<?php endif; ?>


<?php if (isset($component)) { $__componentOriginal3304fc1ec27516a666a2f68d6da76d86 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal3304fc1ec27516a666a2f68d6da76d86 = $attributes; } ?>
<?php $component = Backpack\CRUD\app\View\Components\MenuDropdown::resolve(['title' => 'Products','icon' => 'la la-question','link' => backpack_url('product')] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? (array) $attributes->getIterator() : [])); ?>
<?php $component->withName('backpack::menu-dropdown'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag && $constructor = (new ReflectionClass(Backpack\CRUD\app\View\Components\MenuDropdown::class))->getConstructor()): ?>
<?php $attributes = $attributes->except(collect($constructor->getParameters())->map->getName()->all()); ?>
<?php endif; ?>
<?php $component->withAttributes([]); ?>
    <?php if (isset($component)) { $__componentOriginalead85e76a923e64d9eae23947232cf9a = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginalead85e76a923e64d9eae23947232cf9a = $attributes; } ?>
<?php $component = Backpack\CRUD\app\View\Components\MenuItem::resolve(['title' => 'Products','icon' => 'la la-product','link' => backpack_url('product')] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? (array) $attributes->getIterator() : [])); ?>
<?php $component->withName('backpack::menu-item'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag && $constructor = (new ReflectionClass(Backpack\CRUD\app\View\Components\MenuItem::class))->getConstructor()): ?>
<?php $attributes = $attributes->except(collect($constructor->getParameters())->map->getName()->all()); ?>
<?php endif; ?>
<?php $component->withAttributes([]); ?>
<?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginalead85e76a923e64d9eae23947232cf9a)): ?>
<?php $attributes = $__attributesOriginalead85e76a923e64d9eae23947232cf9a; ?>
<?php unset($__attributesOriginalead85e76a923e64d9eae23947232cf9a); ?>
<?php endif; ?>
<?php if (isset($__componentOriginalead85e76a923e64d9eae23947232cf9a)): ?>
<?php $component = $__componentOriginalead85e76a923e64d9eae23947232cf9a; ?>
<?php unset($__componentOriginalead85e76a923e64d9eae23947232cf9a); ?>
<?php endif; ?>
    <?php if (isset($component)) { $__componentOriginalead85e76a923e64d9eae23947232cf9a = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginalead85e76a923e64d9eae23947232cf9a = $attributes; } ?>
<?php $component = Backpack\CRUD\app\View\Components\MenuItem::resolve(['title' => 'Areas','icon' => 'la la-question','link' => backpack_url('area')] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? (array) $attributes->getIterator() : [])); ?>
<?php $component->withName('backpack::menu-item'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag && $constructor = (new ReflectionClass(Backpack\CRUD\app\View\Components\MenuItem::class))->getConstructor()): ?>
<?php $attributes = $attributes->except(collect($constructor->getParameters())->map->getName()->all()); ?>
<?php endif; ?>
<?php $component->withAttributes([]); ?>
<?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginalead85e76a923e64d9eae23947232cf9a)): ?>
<?php $attributes = $__attributesOriginalead85e76a923e64d9eae23947232cf9a; ?>
<?php unset($__attributesOriginalead85e76a923e64d9eae23947232cf9a); ?>
<?php endif; ?>
<?php if (isset($__componentOriginalead85e76a923e64d9eae23947232cf9a)): ?>
<?php $component = $__componentOriginalead85e76a923e64d9eae23947232cf9a; ?>
<?php unset($__componentOriginalead85e76a923e64d9eae23947232cf9a); ?>
<?php endif; ?>
 <?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginal3304fc1ec27516a666a2f68d6da76d86)): ?>
<?php $attributes = $__attributesOriginal3304fc1ec27516a666a2f68d6da76d86; ?>
<?php unset($__attributesOriginal3304fc1ec27516a666a2f68d6da76d86); ?>
<?php endif; ?>
<?php if (isset($__componentOriginal3304fc1ec27516a666a2f68d6da76d86)): ?>
<?php $component = $__componentOriginal3304fc1ec27516a666a2f68d6da76d86; ?>
<?php unset($__componentOriginal3304fc1ec27516a666a2f68d6da76d86); ?>
<?php endif; ?>



<?php /**PATH C:\laragon\www\instantscripts-new\resources\views/vendor/backpack/ui/inc/menu_items.blade.php ENDPATH**/ ?>