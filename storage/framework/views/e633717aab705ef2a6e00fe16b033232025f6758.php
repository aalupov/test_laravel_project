 <?php $__env->startSection('content'); ?>
<div class="container">
	<div class="row justify-content-center">
		<div class="col-md-12">
			<div class="card">
				<div class="card-header">Edit User</div>
				<?php echo $__env->make('includes.error', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?> <?php echo $__env->make('includes.success', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>

				<form method="post" action="<?php echo e(route('users.update', $id)); ?>"
					enctype="multipart/form-data">
					<?php echo csrf_field(); ?> <?php echo e(method_field('PUT')); ?>

					<div class="form-group row">
						<label for="name" class="col-md-4 col-form-label text-md-right"><?php echo e(__('User Name *')); ?></label>

						<div class="col-md-6">
							<?php if($errors->any()): ?> <input id="name" type="text"
								class="form-control <?php $__errorArgs = ['name'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>"
								name="name" value="<?php echo e(old('name')); ?>" required
								autocomplete="name" autofocus> <?php else: ?> <input id="name"
								type="text"
								class="form-control <?php $__errorArgs = ['name'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>"
								name="name" value="<?php echo e($userInfo->name); ?>" required
								autocomplete="name" autofocus> <?php endif; ?> <?php $__errorArgs = ['name'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> <span
								class="invalid-feedback" role="alert"> <strong><?php echo e($message); ?></strong>
							</span> <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
						</div>
					</div>

					<div class="form-group row">
						<label for="email" class="col-md-4 col-form-label text-md-right"><?php echo e(__('E-Mail *')); ?></label>

						<div class="col-md-6">
							<?php if($errors->any()): ?> <input id="email" type="email"
								class="form-control <?php $__errorArgs = ['email'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>"
								name="email" value="<?php echo e(old('email')); ?>" required
								autocomplete="email"> <?php else: ?> <input id="email" type="email"
								class="form-control <?php $__errorArgs = ['email'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>"
								name="email" value="<?php echo e($userInfo->email); ?>" required
								autocomplete="email"> <?php endif; ?> <?php $__errorArgs = ['email'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> <span
								class="invalid-feedback" role="alert"> <strong><?php echo e($message); ?></strong>
							</span> <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
						</div>
					</div>

					<div class="form-group row">
						<label for="password"
							class="col-md-4 col-form-label text-md-right"><?php echo e(__('Password')); ?></label>

						<div class="col-md-6">
							<input id="password" type="password"
								class="form-control <?php $__errorArgs = ['password'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>"
								name="password" value="<?php echo e(old('password')); ?>"
								autocomplete="new-password"> <?php $__errorArgs = ['password'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> <span
								class="invalid-feedback" role="alert"> <strong><?php echo e($message); ?></strong>
							</span> <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
						</div>
					</div>

					<div class="form-group row">
						<label for="password-confirm"
							class="col-md-4 col-form-label text-md-right"><?php echo e(__('Confirm
							Password')); ?></label>

						<div class="col-md-6">
							<input id="password-confirm" type="password" class="form-control"
								name="password_confirmation"
								value="<?php echo e(old('password_confirmation')); ?>"
								autocomplete="new-password">
						</div>
					</div>

					<div class="form-group row mb-0">
						<div class="col-md-6 offset-md-4">
							<button type="submit" class="btn btn-primary btn-block"><?php echo e(__('Save')); ?></button>
						</div>
					</div>
					<br>
					<div class="form-group row mb-0">
						<div class="col-md-6 offset-md-4">
							<a href="<?php echo e(route('users.index')); ?>">
								<button type="button" class="btn btn-secondary btn-block"><?php echo e(__('Cancel')); ?></button>
							</a>
						</div>
					</div>
				</form>
			</div>
		</div>
	</div>
</div>
</div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/paymentgw/data/www/api.ptzhost.net/test/resources/views/user/edit.blade.php ENDPATH**/ ?>