<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>Blog</title>
	<link rel="stylesheet" type="text/css" href="{{ url('css/bootstrap.min.css') }}">
	<link rel="stylesheet" type="text/css" href="{{ url('css/style.css') }}">
	<link rel="stylesheet" type="text/css" href="{{ url('DataTables/datatables.min.css') }}">
	<script src="{{ url('js/jquery.js') }}"></script>
	<script src="{{ url('js/bootstrap.js') }}"></script>
	<script src="{{ url('DataTables/datatables.min.js') }}"></script>
	<script src="{{ url('ckeditor/ckeditor.js') }}"></script>
</head>
<body>
	
	@include('templates.navigation')

	<div class="container">
		@yield('content')
	</div>

	<script type="text/javascript">
		$(document).ready(function(){
			$('#table').DataTable()
		})
	</script>
</body>
</html>