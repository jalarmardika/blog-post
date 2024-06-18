@extends('templates.layout')

@section('content')
<div class="row">
	<div class="col-md-12">
		@if(session()->has('success'))
		<div class="alert alert-success">
			<button type="button" class="close pull-right" data-dismiss="alert" aria-label="Close">
				<span aria-hidden="true">&times;</span>
			</button>
			{{ session('success') }}
		</div>
		@elseif(session()->has('failed'))
		<div class="alert alert-danger">
			<button type="button" class="close pull-right" data-dismiss="alert" aria-label="Close">
				<span aria-hidden="true">&times;</span>
			</button>
			{{ session('failed') }}
		</div>
		@endif
		<div class="card mb-5">
			<div class="card-header">
				Data Categories
			</div>
			<div class="card-body">
				<a href="#" data-toggle="modal" data-target="#modalAdd" class="btn btn-primary btn-sm mb-3">Add Category</a>
				<table id="table" class="table table-bordered table-hover table-responsive-md">
					<thead>
						<tr>
							<th width="1%">No</th>
							<th>Category Name</th>
							<th>Actions</th>
						</tr>
					</thead>
					<tbody>
						@foreach($categories as $category)
						<tr>
							<td>{{ $loop->iteration }}</td>
							<td>{{ $category->name }}</td>
							<td>
								<a href="{{ url('/?category='. $category->id) }}" class="btn btn-outline-success btn-sm">List Posts</a>
								<a href="#" data-toggle="modal" data-target="#modalEdit{{ $category->id }}" class="btn btn-outline-warning btn-sm">Edit</a>
								<form action="{{ url('category/' . $category->id) }}" method="post" class="d-inline-block" onsubmit="return confirm('Are you sure ?')">
									@csrf
									@method('delete')
									<button type="submit" name="submit" class="btn btn-outline-danger btn-sm">Delete</button>
								</form>
							</td>
						</tr>

						<div class="modal" tabindex="-1" id="modalEdit{{ $category->id }}">
							<div class="modal-dialog">
								<div class="modal-content">
									<div class="modal-header">
										<h5 class="modal-title">Edit Category</h5>
										<button type="button" class="close" data-dismiss="modal">&times;</button>
									</div>
									<div class="modal-body">
										<form action="{{ url('category/'. $category->id) }}" method="post">
											@csrf
											@method('put')
											<div class="form-group">
												<label>Name</label>
												<input type="text" name="name" class="form-control" value="{{ $category->name }}" maxlength="255" autocomplete="off" required>
											</div>
											<button type="submit" name="submit" class="btn btn-primary float-right btn-sm">Update</button>
										</form>
									</div>
								</div>
							</div>
						</div>
						@endforeach
					</tbody>
				</table>
			</div>
		</div>
	</div>
</div>
<!-- modal add -->
<div class="modal" tabindex="-1" id="modalAdd">
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-header">
				<h5 class="modal-title">Add Category</h5>
				<button type="button" class="close" data-dismiss="modal">&times;</button>
			</div>
			<div class="modal-body">
				<form action="{{ url('category') }}" method="post">
					@csrf
					<div class="form-group">
						<label>Name</label>
						<input type="text" name="name" class="form-control" maxlength="255" autocomplete="off" required>
					</div>
					<button type="submit" name="submit" class="btn btn-primary float-right btn-sm">Save</button>
				</form>
			</div>
		</div>
	</div>
</div>
@endsection