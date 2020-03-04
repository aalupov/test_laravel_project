 <?php $__env->startSection('content'); ?>
<div class="container">
	<div class="row justify-content-center">
		<div class="col-md-12">
			<div class="card">
				<div class="card-header">Users</div>
				<?php echo $__env->make('includes.error', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?> <?php echo $__env->make('includes.success', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>

				<table class="table">
					<thead class="thead-dark">
						<tr>
							<th scope="col">#</th>
							<th scope="col">Name</th>
							<th scope="col">Email</th>
							<th scope="col">Date</th>
							<th scope="col"></th>
							<th scope="col"></th>
						</tr>
					</thead>
					<tbody>
						<?php $__currentLoopData = $users; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $user): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
						<tr>
							<th scope="row"><?php echo e($user->id); ?></th>
							<td><?php echo e($user->name); ?></td>
							<td><?php echo e($user->email); ?></td>
							<td><?php echo e($user->updated_at); ?></td>
							<td data-th="user_edit"><a
								href="<?php echo e(route( 'users.edit', $user->id )); ?>">
									<button type="submit" class="btn btn-secondary">Edit</button>
							</a></td>
							<td data-th="user_remove">
								<form action="<?php echo e(route( 'users.destroy', $user->id )); ?>"
									method="POST">
									<?php echo csrf_field(); ?> <?php echo e(method_field('DELETE')); ?>

									<button type="submit" class="btn btn-danger"
										onclick="return confirm('Are you sure?')">Remove</button>
								</form>
							</td>
						</tr>
						<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
					</tbody>
				</table>
				<table id="add_user" class="table table-hover table-condensed">
					<tfoot>
						<tr>
							<td><a href="<?php echo e(route('users.create')); ?>"><button type="button"
										class="btn btn-success btn-lg">Add User</button></a></td>
							<td colspan="4" class="hidden-xs"></td>
						</tr>
					</tfoot>
				</table>
				<?php echo e($users->links()); ?>

			</div>
		</div>
	</div>
</div>
</div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/paymentgw/data/www/api.ptzhost.net/test/resources/views/users.blade.php ENDPATH**/ ?>