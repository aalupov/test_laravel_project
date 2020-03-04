@extends('layouts.app') @section('content')
<div class="container">
	<div class="row justify-content-center">
		<div class="col-md-12">
			<div class="card">
				<div class="card-header">Users</div>
				@include('includes.error') @include('includes.success')

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
						@foreach($users as $user)
						<tr>
							<th scope="row">{{ $user->id }}</th>
							<td>{{ $user->name }}</td>
							<td>{{ $user->email }}</td>
							<td>{{ $user->updated_at }}</td>
							<td data-th="user_edit"><a
								href="{{ route( 'users.edit', $user->id ) }}">
									<button type="submit" class="btn btn-secondary">Edit</button>
							</a></td>
							<td data-th="user_remove">
								<form action="{{ route( 'users.destroy', $user->id ) }}"
									method="POST">
									@csrf {{ method_field('DELETE') }}
									<button type="submit" class="btn btn-danger"
										onclick="return confirm('Are you sure?')">Remove</button>
								</form>
							</td>
						</tr>
						@endforeach
					</tbody>
				</table>
				<table id="add_user" class="table table-hover table-condensed">
					<tfoot>
						<tr>
							<td><a href="{{ route('users.create') }}"><button type="button"
										class="btn btn-success btn-lg">Add User</button></a></td>
							<td colspan="4" class="hidden-xs"></td>
						</tr>
					</tfoot>
				</table>
				{{ $users->links() }}
			</div>
		</div>
	</div>
</div>
</div>
@endsection
