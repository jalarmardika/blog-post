@extends('templates.layout')

@section('content')
<div class="row justify-content-center">
	<div class="col-md-8 mb-3">
		<h3 class="mb-3">Detail Post</h3>
		<a href="{{ url('/') }}" class="text-decoration-none">Back To Home</a>
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