<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <title>@yield('title','Admin Panel')</title>
  <meta name="viewport" content="width=device-width, initial-scale=1">

  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css">

  <link rel="stylesheet" href="{{ asset('assets/styles/style.css') }}">

</head>
<body>
<div id="wrapper">
  <nav class="navbar header-top fixed-top navbar-expand-lg navbar-dark bg-dark">
    <div class="container-fluid">
      <a class="navbar-brand" href="{{ route('admins.dashboard') }}">Admin Dashboard</a>

      <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarText"
              aria-controls="navbarText" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>

      <div class="collapse navbar-collapse" id="navbarText">
        <ul class="navbar-nav side-nav">
          <li class="nav-item">
            <a class="nav-link {{ request()->routeIs('admins.dashboard') ? 'active' : '' }}"
               href="{{ route('admins.dashboard') }}">
              Home <span class="sr-only">(current)</span>
            </a>
          </li>

          <a class="nav-link {{ request()->routeIs('admin.foods.*') ? 'active' : '' }}" href="{{ route('admins.foods.index') }}">Foods</a>
          <a class="nav-link" href=" # "> Orders</a>
          <a class="nav-link {{ request()->routeIs('admin.bookings.*') ? 'active' : '' }}" href="{{ route('admins.bookings.index') }}">Bookings</a>

        </ul>

        <ul class="navbar-nav ml-md-auto d-md-flex">
          @auth('admin')
            <li class="nav-item dropdown">
              <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button"
                 data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                {{ Auth::guard('admin')->user()->name }}
              </a>
              <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
                <a class="dropdown-item" href="{{ route('admins.dashboard') }}">Dashboard</a>
                <div class="dropdown-divider"></div>
                <a class="dropdown-item" href="{{ route('admins.logout') }}"
                   onclick="event.preventDefault(); document.getElementById('admin-logout-form').submit();">
                  Logout
                </a>
                <form id="admin-logout-form" action="{{ route('admins.logout') }}" method="POST" class="d-none">
                  @csrf
                </form>
              </div>
            </li>
          @else
            <li class="nav-item">
              <a class="nav-link" href="{{ route('view.login') }}">Login</a>
            </li>
          @endauth
        </ul>
      </div>
    </div>
  </nav>

  <main class="py-4">
    @yield('content')
  </main>
</div>

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"></script>
@stack('scripts')
</body>
</html>
