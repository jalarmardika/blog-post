@extends('templates.layout')

@section('content')
<div class="row justify-content-center">
	<div class="col-md-8">
		<h3 class="mb-5">{{ $title }}</h3>
	</div>
	<div class="col-md-8 mb-3">
		<a href="{{ url('/') }}" class="btn btn-category btn-sm mb-3">All Posts</a>

		@foreach($categories as $category)
		<a href="{{ url('/?category='. $category->id) }}" class="btn btn-category btn-sm mb-3">{{ $category->name }}</a>
		@endforeach
	</div>
	<div class="col-md-8">
		<form action="{{ url('/') }}" method="get" class="d-flex mb-5">
			@csrf
			<input type="text" name="keyword" class="form-control" value="{{ request('keyword') }}" placeholder="Search here ...">
			<button type="submit" name="submit" value="search" class="btn btn-sm btn-primary">Search</button>
		</form>
	</div>
	@if($posts->count())
	@foreach($posts as $post)
	<div class="col-md-8">
		@if($post->image !== "")
			<img src="{{ url('storage/'. $post->image) }}" class="w-100 img-fluid mb-3">
		@endif
		<h3>{{ $post->title }}</h3>
		
		<!-- link category -->
		<p class="text-muted"><a href="{{ url('/?category='. $post->category->id) }}" class="text-decoration-none">{{ $post->category->name }}</a></p>
		<!-- end link category -->

		<!-- link user -->
		<p class="text-muted">By <a href="{{ url('/?user='. $post->user_id) }}" class="text-decoration-none">{{ $post->user->name }}</a> / {{ $post->created_at->diffForHumans() }}</p>
		<!-- end link user -->
		<div class="mb-5">
			@if(strlen($post->body) > 250)
			{!! substr($post->body, 0, 250) !!} <a href="{{ url('home/post/'. $post->id) }}" class="text-decoration-none">Read More ...</a>
			@else
			{!! $post->body !!}
			@endif
		</div>
	</div>
	@endforeach
	@else
	<div class="col-md-8">
		<p class="text-center">Posts Not Found</p>
	</div>
	@endif
</div>

<div class="d-flex justify-content-center mb-5">
	{{ $posts->links() }}
</div>
@endsection