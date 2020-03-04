@extends('layouts.app') @section('content')
<div class="container">
	<div class="row justify-content-center">
		<div class="col-md-12">
			<div class="card">
				<div class="card-header">Sections</div>
				@include('includes.error') @include('includes.success')

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
						@foreach($sections as $section)
						<tr>
							<th scope="row">{{ $section->id }}</th>
							<td>
							   @if(isset($section->logo))
                                <img src="storage/logo/{{ $section->logo }}" width="50" height="50">
                               @else
                                <td></td>  
                               @endif 
							</td>
							<td><strong>{{ $section->name }}</strong><br>
							  {{ $section->description }}							  
							</td>
							<td>
							  @foreach($section->users_section as $user)							    
							     <li>{{ $user->name }}</li>
							  @endforeach  
							</td>
							<td data-th="section_edit"><a
								href="{{ route( 'sections.edit', $section->id ) }}">
									<button type="submit" class="btn btn-secondary">Edit</button>
							</a></td>
							<td data-th="section_remove">
								<form action="{{ route( 'sections.destroy', $section->id ) }}"
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
				<table id="add_section" class="table table-hover table-condensed">
					<tfoot>
						<tr>
							<td><a href="{{ route('sections.create') }}"><button type="button"
										class="btn btn-success btn-lg">Add Section</button></a></td>
							<td colspan="4" class="hidden-xs"></td>
						</tr>
					</tfoot>
				</table>
				{{ $sections->links() }}
			</div>
		</div>
	</div>
</div>
</div>
@endsection
