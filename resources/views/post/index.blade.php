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
		@endif
		<div class="card mb-5">
			<div class="card-header">
				{{ (auth()->user()->is_admin) ? 'All Posts Data' : 'My Posts Data' }}
			</div>
			<div class="card-body">
				<a href="{{ url('post/create') }}" class="btn btn-primary btn-sm mb-3">Add Post</a>
				<table id="table" class="table table-bordered table-hover table-responsive-md">
					<thead>
						<tr>
							<th>No</th>
							<th>Title</th>
							<th>Category</th>
							@if(auth()->user()->is_admin)
							<th>Author</th>
							@endif
							<th>Body</th>
							<th width="18%">Actions</th>
						</tr>
					</thead>
					<tbody>
						@foreach($posts as $post)
						<tr>
							<td>{{ $loop->iteration }}</td>
							<td>{{ $post->title }}</td>
							<td>{{ $post->category->name }}</td>
							@if(auth()->user()->is_admin)
							<td>{{ $post->user->name }}</td>
							@endif
							<td>
								@if(strlen($post->body) > 100)
								{!! substr($post->body, 0, 100) !!} ...
								@else
								{!! $post->body !!}
								@endif
							</td>
							<td>
								<a href="{{ url('post/'. $post->id) }}" class="btn btn-outline-success btn-sm">Detail</a>
								@if($post->user_id == auth()->user()->id)
									<a href="{{ url('post/'. $post->id .'/edit') }}" class="btn btn-outline-warning btn-sm">Edit</a>
									<form action="{{ url('post/'. $post->id) }}" method="post" class="d-inline-block" onsubmit="return confirm('Are you sure ?')">
										@csrf
										@method('delete')
										<button type="submit" name="submit" class="btn btn-outline-danger btn-sm">Delete</button>
									</form>
								@endif
							</td>
						</tr>
						@endforeach
					</tbody>
				</table>
			</div>
		</div>
	</div>
</div>
@endsection