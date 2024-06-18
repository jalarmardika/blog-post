@extends('templates.layout')

@section('content')
<div class="row justify-content-center">
	<div class="col-md-6">
		@if(session()->has('success'))
		<div class="alert alert-success">
			<button type="button" class="close pull-right" data-dismiss="alert" aria-label="Close">
				<span aria-hidden="true">&times;</span>
			</button>
			{{ session('success') }}
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
				Edit Profile
			</div>
			<div class="card-body">
				<form action="{{ url('profile/'. auth()->user()->id) }}" method="post">
					@csrf
					@method('put')
					<div class="form-group">
						<label>Name</label>
						<input type="text" name="name" class="form-control" value="{{ old('name', auth()->user()->name) }}">
					</div>
					<div class="form-group">
						<label>Email</label>
						<input type="text" name="email" class="form-control"autocomplete="off" value="{{ old('email', auth()->user()->email) }}">
					</div>
					<div class="form-group">
						<label>Password</label>
						<input type="password" name="password" class="form-control" placeholder="Fill in if you want to change the password">
					</div>
					<button type="submit" name="submit" class="btn btn-primary float-right btn-sm">Save Changes</button>
				</form>
			</div>
		</div>
	</div>
</div>
@endsection