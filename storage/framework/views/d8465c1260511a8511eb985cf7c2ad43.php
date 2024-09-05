
<?php if(backpack_auth()->check()): ?>
    <ul class="nav navbar-nav d-md-down-none">
        
        <?php echo $__env->make(backpack_view('inc.topbar_left_content'), \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
    </ul>
<?php endif; ?>


<ul class="nav navbar-nav d-flex flex-row flex-shrink-0 <?php if(backpack_theme_config('html_direction') == 'rtl'): ?> me-0 <?php endif; ?>">
    <?php if(backpack_auth()->guest()): ?>
        <li class="nav-item">
            <a class="nav-link" href="<?php echo e(route('backpack.auth.login')); ?>"><?php echo e(trans('backpack::base.login')); ?></a>
        </li>
        <?php if(config('backpack.base.registration_open')): ?>
            <li class="nav-item">
                <a class="nav-link" href="<?php echo e(route('backpack.auth.register')); ?>"><?php echo e(trans('backpack::base.register')); ?></a>
            </li>
        <?php endif; ?>
    <?php else: ?>
        
        <li class="nav-item">
            <?php echo $__env->renderWhen(backpack_theme_config('options.showColorModeSwitcher'), backpack_view('layouts.partials.switch_theme'), \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path'])); ?>
        </li>
        <?php echo $__env->make(backpack_view('inc.topbar_right_content'), \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
        <?php echo $__env->make(backpack_view('inc.menu_user_dropdown'), \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
    <?php endif; ?>
</ul>
<?php /**PATH C:\laragon\www\instantscripts-new\vendor/backpack/theme-tabler/resources/views/inc/menu.blade.php ENDPATH**/ ?>