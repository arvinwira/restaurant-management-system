@extends('layouts.app')

@section('content')

<!-- Hero -->
<section class="hero-header bg-dark py-5 mb-5" style="margin-top:-25px;">
  <div class="container text-center my-5 pt-5 pb-4">
    <h1 class="display-3 text-white mb-3 animated slideInDown">Login</h1>
    <nav aria-label="breadcrumb">
      <ol class="breadcrumb justify-content-center text-uppercase">
        <li class="breadcrumb-item"><a href="#" class="text-light">Home</a></li>
        <li class="breadcrumb-item active text-light" aria-current="page">Login</li>
      </ol>
    </nav>
  </div>
</section>

<!-- Login Form -->
<section class="py-5 bg-dark">
  <div class="container">
    <div class="row justify-content-center">
      <!-- Full width on mobile, narrower on larger screens -->
      <div class="col-12 col-md-10 col-lg-6">
        <div class="p-4 p-md-5 rounded-4 shadow-lg bg-body wow fadeInUp" data-wow-delay="0.2s">
          <div class="mb-4 text-center">
            <h5 class="section-title ff-secondary text-primary fw-normal mb-2">Login</h5>
            <h1 class="mb-0">Welcome back</h1>
          </div>

          <form method="POST" action="{{ route('login') }}" novalidate>
            @csrf
            <div class="row g-3">
              <!-- Email -->
              <div class="col-12">
                <div class="form-floating">
                  <input
                    id="email"
                    type="email"
                    class="form-control form-control-lg @error('email') is-invalid @enderror"
                    name="email"
                    value="{{ old('email') }}"
                    required
                    autocomplete="email"
                    inputmode="email"
                    placeholder="name@example.com"
                    autofocus>
                  <label for="email">Email</label>
                  @error('email')
                    <span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>
                  @enderror
                </div>
              </div>

              <!-- Password -->
              <div class="col-12">
                <div class="form-floating">
                  <input
                    id="password"
                    type="password"
                    class="form-control form-control-lg @error('password') is-invalid @enderror"
                    name="password"
                    required
                    autocomplete="current-password"
                    placeholder="••••••••">
                  <label for="password">Password</label>
                  @error('password')
                    <span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>
                  @enderror
                </div>
              </div>

              <!-- Extras -->
              <div class="col-12 d-flex flex-column flex-sm-row justify-content-between align-items-start align-items-sm-center gap-2">
                <div class="form-check">
                  <input class="form-check-input" type="checkbox" name="remember" id="remember" {{ old('remember') ? 'checked' : '' }}>
                  <label class="form-check-label" for="remember">Remember me</label>
                </div>
                @if (Route::has('password.request'))
                  <a class="small text-decoration-none" href="{{ route('password.request') }}">Forgot your password?</a>
                @endif
              </div>

              <!-- Submit -->
              <div class="col-12">
                <button class="btn btn-primary btn-lg w-100 py-3" type="submit" name="submit">
                  Login
                </button>
              </div>
            </div>
          </form>

        </div>
      </div>
    </div>
  </div>
</section>

        <!-- Service End -->


<!-- <div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Login') }}</div>

                <div class="card-body">
                    <form method="POST" action="{{ route('login') }}">
                        @csrf

                        <div class="row mb-3">
                            <label for="email" class="col-md-4 col-form-label text-md-end">{{ __('Email Address') }}</label>

                            <div class="col-md-6">
                                <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email" autofocus>

                                @error('email')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="row mb-3">
                            <label for="password" class="col-md-4 col-form-label text-md-end">{{ __('Password') }}</label>

                            <div class="col-md-6">
                                <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="current-password">

                                @error('password')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="row mb-3">
                            <div class="col-md-6 offset-md-4">
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" name="remember" id="remember" {{ old('remember') ? 'checked' : '' }}>

                                    <label class="form-check-label" for="remember">
                                        {{ __('Remember Me') }}
                                    </label>
                                </div>
                            </div>
                        </div>

                        <div class="row mb-0">
                            <div class="col-md-8 offset-md-4">
                                <button type="submit" class="btn btn-primary">
                                    {{ __('Login') }}
                                </button>

                                @if (Route::has('password.request'))
                                    <a class="btn btn-link" href="{{ route('password.request') }}">
                                        {{ __('Forgot Your Password?') }}
                                    </a>
                                @endif
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div> -->
@endsection
