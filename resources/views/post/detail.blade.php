@extends('templates.layout')

@section('content')
<div class="row justify-content-center">
	<div class="col-md-8 mb-3">
		<h3 class="mb-3">Detail Post</h3>
		<a href="{{ url('post') }}" class="btn btn-secondary btn-sm">Back To Posts</a>
		@if($post->user_id == auth()->user()->id)
		<a href="{{ url('post/'. $post->id .'/edit') }}" class="btn btn-warning text-white btn-sm">Edit</a>
		<form action="{{ url('post/'. $post->id) }}" method="post" class="d-inline-block" onsubmit="return confirm('Are you sure ? ')">
			@csrf
			@method('delete')
			<button type="submit" name="submit" class="btn btn-danger btn-sm">Delete</button>
		</form>
		@endif
	</div>
	<div class="col-md-8">
		@if($post->image)
		<img src="{{ asset('storage/'. $post->image) }}" class="w-100 img-fluid mb-3" alt="...">
		@endif
		<h3>{{ $post->title }}</h3>
		<p class="text-muted"><a href="{{ url('/?category='. $post->category->id) }}" class="text-decoration-none">{{ $post->category->name }}</a></p>
		<p class="text-muted"><a href="{{ url('/?user='. $post->user_id) }}" class="text-decoration-none">{{ $post->user->name }}</a> / {{ $post->created_at->diffForHumans() }}</p>
		<div class="mb-5">
			{!! $post->body !!}
		</div>
	</div>
</div>
@endsection