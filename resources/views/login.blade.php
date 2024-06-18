<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <link rel="stylesheet" type="text/css" href="{{url('css/bootstrap.min.css')}}">
    <script type="text/javascript" src="{{ url('js/jquery.min.js') }}"></script>
    <script type="text/javascript" src="{{ url('js/bootstrap.js') }}"></script>
</head>
<body>
    <nav class="navbar navbar-expand-lg navbar-light bg-white shadow mb-5">
      <div class="container">
        <a class="navbar-brand" href="#">Blog Posts</a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
          <span class="navbar-toggler-icon"></span>
      </button>
      <div class="collapse navbar-collapse" id="navbarNav">
          <ul class="navbar-nav ml-auto">
            <li class="nav-item">
              <a href="{{ url('/') }}" class="nav-link">Home</a>
          </li>
      </ul>
  </div>
</div>
</nav>

<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-5">
            @if(session()->has('success'))
            <div class="alert alert-success mt-3">
                <button type="button" class="close pull-right" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
                {{ session('success') }}
            </div>
            @elseif(session()->has('error'))
            <div class="alert alert-danger mt-3">
                <button type="button" class="close pull-right" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
                {{ session('error') }}
            </div>
            @endif
            <div class="card shadow mt-3">
                <div class="card-body">
                    <h4 class="text-center mb-3">Form Login</h4>
                    <form action="{{url('login')}}" method="post">
                        @csrf
                        <div class="form-group">
                            <label for="email">Email</label>
                            <input type="text" id="email" name="email" class="form-control @error('email') is-invalid @enderror" autofocus value="{{ old('email') }}">
                            @error('email')
                            <div class="invalid-feedback">
                                {{$message}}
                            </div>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="pass">Password</label>
                            <input type="password" id="pass" name="password" class="form-control @error('password') is-invalid @enderror">
                            @error('password')
                            <div class="invalid-feedback">
                                {{$message}}
                            </div>
                            @enderror
                        </div>
                        <button type="submit"class="btn btn-primary btn-sm mt-3 float-right">Login</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
</body>
</html>