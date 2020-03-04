 <?php $__env->startSection('content'); ?>
<div class="container">
	<div class="row justify-content-center">
		<div class="col-md-12">
			<div class="card">
				<div class="card-header">Sections</div>
				<?php echo $__env->make('includes.error', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?> <?php echo $__env->make('includes.success', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>

				<table class="table">
					<thead class="thead-dark">
						<tr>
							<th scope="col">#</th>
							<th scope="col"></th>
							<th scope="col">Name</th>
							<th scope="col">Users</th>
							<th scope="col"></th>
							<th scope="col"></th>
						</tr>
					</thead>
					<tbody>
						<?php $__currentLoopData = $sections; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $section): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
						<tr>
							<th scope="row"><?php echo e($section->id); ?></th>
							<td>
							   <?php if(isset($section->logo)): ?>
                                <img src="storage/logo/<?php echo e($section->logo); ?>" width="50" height="50">
                               <?php else: ?>
                                <td></td>  
                               <?php endif; ?> 
							</td>
							<td><strong><?php echo e($section->name); ?></strong><br>
							  <?php echo e($section->description); ?>							  
							</td>
							<td>
							  <?php $__currentLoopData = $section->users_section; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $user): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>							    
							     <li><?php echo e($user->name); ?></li>
							  <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>  
							</td>
							<td data-th="section_edit"><a
								href="<?php echo e(route( 'sections.edit', $section->id )); ?>">
									<button type="submit" class="btn btn-secondary">Edit</button>
							</a></td>
							<td data-th="section_remove">
								<form action="<?php echo e(route( 'sections.destroy', $section->id )); ?>"
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
				<table id="add_section" class="table table-hover table-condensed">
					<tfoot>
						<tr>
							<td><a href="<?php echo e(route('sections.create')); ?>"><button type="button"
										class="btn btn-success btn-lg">Add Section</button></a></td>
							<td colspan="4" class="hidden-xs"></td>
						</tr>
					</tfoot>
				</table>
				<?php echo e($sections->links()); ?>

			</div>
		</div>
	</div>
</div>
</div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/paymentgw/data/www/api.ptzhost.net/test/resources/views/sections.blade.php ENDPATH**/ ?>