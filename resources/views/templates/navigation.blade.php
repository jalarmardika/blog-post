<nav class="navbar navbar-expand-lg navbar-light bg-white shadow mb-5">
  <div class="container">
    <a class="navbar-brand" href="{{ url('/') }}">Blog Posts</a>
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarNav">
      @auth
      <ul class="navbar-nav">
        <li class="nav-item">
          <a class="nav-link {{ Request::is('/') ? 'active' : '' }}" href="{{ url('/') }}">Home</a>
        </li>
        @can('admin')
        <li class="nav-item">
          <a class="nav-link {{ Request::is('category') ? 'active' : '' }}" href="{{ url('category') }}">Categories</a>
        </li>
        <li class="nav-item">
          <a class="nav-link {{ Request::is('user') ? 'active' : '' }}" href="{{ url('user') }}">Users</a>
        </li>
        @endcan
        <li class="nav-item">
          <a class="nav-link {{ Request::is('post') ? 'active' : '' }}" href="{{ url('post') }}">{{ (auth()->user()->is_admin) ? 'All Posts' : 'My Posts' }}</a>
        </li>
      </ul>
      @endauth
      <ul class="navbar-nav ml-auto">
        @guest
        <li class="nav-item">
          <a class="nav-link" href="{{ url('register') }}">Register</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="{{ url('login') }}">Login</a>
        </li>
        @else
        <li class="nav-item dropdown">
          <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-expanded="false">
            {{ auth()->user()->name }}
          </a>
          <ul class="dropdown-menu" aria-labelledby="navbarDropdown">
            <li><a class="dropdown-item" href="{{ url('profile') }}">Edit Profile</a></li>
            <li><a href="{{ url('logout') }}" class="dropdown-item" onclick="return confirm('Are you sure ?')">Logout</a></li>
          </ul>
        </li>
        @endguest
      </ul>
    </div>
  </div>
</nav>