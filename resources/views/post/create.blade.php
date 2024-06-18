@extends('templates.layout')

@section('content')
<div class="row justify-content-center">
	<div class="col-md-8">
		<div class="card mb-5">
			<div class="card-header">
				Add Post
			</div>
			<div class="card-body">
				<form action="{{ url('post') }}" method="post" enctype="multipart/form-data">
					@csrf
					<div class="form-group">
						<label>Post Image (Optional)</label>
						<img class="img-fluid d-none img-preview w-100 mb-3">
						<input type="file" name="image" class="form-control @error('image') is-invalid @enderror">
						@error('image')
						<div class="invalid-feedback">
							{{ $message }}
						</div>
						@enderror
					</div>
					<div class="form-group">
						<label>Title</label>
						<input type="text" name="title" class="form-control @error('title') is-invalid @enderror" value="{{ old('title') }}" autocomplete="off">
						@error('title')
						<div class="invalid-feedback">
							{{ $message }}
						</div>
						@enderror
					</div>
					<div class="form-group">
						<label>Category</label>
						<select name="category_id" class="form-control @error('category_id') is-invalid @enderror">
							<option value="">-- Choose Category --</option>
							@foreach($categories as $category)
							@if($category->id == old('category_id'))
							<option value="{{ $category->id }}" selected>{{ $category->name }}</option>
							@else
							<option value="{{ $category->id }}">{{ $category->name }}</option>
							@endif
							@endforeach
						</select>
						@error('category_id')
						<div class="invalid-feedback">
							{{ $message }}
						</div>
						@enderror
					</div>
					<div class="form-group">
						<label>Body</label>
						@error('body')
						<p class="text-danger">{{ $message }}</p>
						@enderror
						<textarea name="body" id="body" class="form-control @error('body') is-invalid @enderror">{!! old('body') !!}</textarea>
					</div>
					<button type="submit" name="submit" class="btn btn-primary btn-sm float-right">Save Post</button>
				</form>
			</div>
		</div>
	</div>
</div>
<script type="text/javascript">
	const inputImage = document.querySelector('input[name=image]')
	const imgPreview = document.querySelector('.img-preview')
	inputImage.addEventListener('change', function(){
		imgPreview.classList.replace('d-none', 'd-block')

		const oFReader = new FileReader();
		oFReader.readAsDataURL(inputImage.files[0])
		oFReader.onload = function(event){
			imgPreview.src = event.target.result
		}
	})

	CKEDITOR.replace('body',
	{
		enterMode : CKEDITOR.ENTER_BR,
	}
	);
</script>
@endsection