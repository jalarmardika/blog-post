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

		@if($errors->any())
		<div class="alert alert-danger">
			<button type="button" class="close pull-right" data-dismiss="alert" aria-label="Close">
				<span aria-hidden="true">&times;</span>
			</button>
			<ul>
				@foreach($errors->all() as $error)
				<li>{{ $error }}</li>
				@endforeach
			</ul>
		</div>
		@endif
		<div class="card mb-5">
			<div class="card-header">
				Data Users
			</div>
			<div class="card-body">
				<a href="#" data-toggle="modal" data-target="#modalAdd" class="btn btn-primary btn-sm mb-3">Add User</a>
				<table id="table" class="table table-bordered table-hover table-responsive-md">
					<thead>
						<tr>
							<th>No</th>
							<th>Name</th>
							<th>Email</th>
							<th>Role</th>
							<th width="20%">Actions</th>
						</tr>
					</thead>
					<tbody>
						@foreach($users as $user)
						<tr>
							<td>{{ $loop->iteration }}</td>
							<td>{{ $user->name }}</td>
							<td>{{ $user->email }}</td>
							<td>
								@if($user->is_admin)
								Admin
								@else
								User
								@endif
							</td>
							<td>
								<a href="{{ url('/?user='. $user->id) }}" class="btn btn-outline-success btn-sm">List Posts</a>
								<a href="#" data-toggle="modal" data-target="#modalEdit{{ $user->id }}" class="btn btn-outline-warning btn-sm">Edit</a>
								<form action="{{ url('user/'. $user->id) }}" method="post" class="d-inline-block" onsubmit="return confirm('Are you sure ?')">
									@csrf
									@method('delete')
									<button type="submit" name="submit" class="btn btn-outline-danger btn-sm">Delete</button>
								</form>
							</td>
						</tr>

						<div class="modal" tabindex="-1" id="modalEdit{{ $user->id }}">
							<div class="modal-dialog">
								<div class="modal-content">
									<div class="modal-header">
										<h5 class="modal-title">Edit User</h5>
										<button type="button" class="close" data-dismiss="modal">&times;</button>
									</div>
									<div class="modal-body">
										<form action="{{ url('user/'. $user->id) }}" method="post">
											@csrf
											@method('put')
											<div class="form-group">
												<label>Name</label>
												<input type="text" name="name" class="form-control " value="{{ old('name', $user->name) }}" autocomplete="off">
											</div>
											<div class="form-group">
												<label>Email</label>
												<input type="text" name="email" class="form-control" value="{{ old('email', $user->email) }}"autocomplete="off">
											</div>
											<div class="form-group">
												<label>Password</label>
												<input type="password" name="password" class="form-control" placeholder="Fill in if you want to change the password">
											</div>
											<div class="form-group">
												<label><input type="checkbox" name="is_admin" @if($user->is_admin) checked @endif > Is Admin</label>
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
				<h5 class="modal-title">Add User</h5>
				<button type="button" class="close" data-dismiss="modal">&times;</button>
			</div>
			<div class="modal-body">
				<form action="{{ url('user') }}" method="post">
					@csrf
					<div class="form-group">
						<label>Name</label>
						<input type="text" name="name" class="form-control" value="{{ old('name') }}">
					</div>
					<div class="form-group">
						<label>Email</label>
						<input type="text" name="email" class="form-control"autocomplete="off" value="{{ old('email') }}">
					</div>
					<div class="form-group">
						<label>Password</label>
						<input type="password" name="password" class="form-control">
					</div>
					<div class="form-group">
						<label><input type="checkbox" name="is_admin"> Is Admin</label>
					</div>
					<button type="submit" name="submit" class="btn btn-primary float-right btn-sm">Save</button>
				</form>
			</div>
		</div>
	</div>
</div>
@endsection