@extends('layouts.app')

@section('content')


<!-- Hero Section -->
<div class="hero-header bg-dark py-5 mb-5" style="margin-top: -25px;">
  <div class="container text-center my-5 pt-5 pb-4">
    <h1 class="display-3 text-white mb-3 animated slideInDown">Registration</h1>
    <nav aria-label="breadcrumb">
      <ol class="breadcrumb justify-content-center text-uppercase">
        <li class="breadcrumb-item"><a href="#" class="text-light">Home</a></li>
        <li class="breadcrumb-item text-light active" aria-current="page">Register</li>
      </ol>
    </nav>
  </div>
</div>


<!-- Register Section -->
<section class="py-5 bg-dark">
  <div class="container">
    <div class="row justify-content-center">
      <!-- Limit width on large screens, full width on mobile -->
      <div class="col-12 col-md-10 col-lg-8">
        <div class="p-4 p-md-5 rounded-4 shadow-lg bg-body">
          <div class="mb-4 text-center">
            <h5 class="section-title ff-secondary text-primary fw-normal mb-2">Register</h5>
            <h1 class="mb-0">Create your account</h1>
          </div>

          <form method="POST" action="{{ route('register') }}" novalidate>
            @csrf

            <div class="row g-3">
              <!-- Name -->
              <div class="col-12 col-md-6">
                <div class="form-floating">
                  <input
                    id="name"
                    type="text"
                    class="form-control form-control-lg @error('name') is-invalid @enderror"
                    name="name"
                    value="{{ old('name') }}"
                    required
                    autocomplete="name"
                    autofocus
                    placeholder="John Doe">
                  <label for="name">Name</label>
                  @error('name')
                    <span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>
                  @enderror
                </div>
              </div>

              <!-- Email -->
              <div class="col-12 col-md-6">
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
                    placeholder="name@example.com">
                  <label for="email">Email</label>
                  @error('email')
                    <span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>
                  @enderror
                </div>
              </div>

              <!-- Password -->
              <div class="col-12 col-md-6">
                <div class="form-floating">
                  <input
                    id="password"
                    type="password"
                    class="form-control form-control-lg @error('password') is-invalid @enderror"
                    name="password"
                    required
                    autocomplete="new-password"
                    placeholder="••••••••">
                  <label for="password">Password</label>
                  @error('password')
                    <span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>
                  @enderror
                </div>
              </div>

              <!-- Confirm Password -->
              <div class="col-12 col-md-6">
                <div class="form-floating">
                  <input
                    id="password-confirm"
                    type="password"
                    class="form-control form-control-lg"
                    name="password_confirmation"
                    required
                    autocomplete="new-password"
                    placeholder="••••••••">
                  <label for="password-confirm">Confirm Password</label>
                </div>
              </div>

              <!-- Submit -->
              <div class="col-12">
                <button class="btn btn-primary btn-lg w-100 py-3" type="submit" name="submit">
                  Register
                </button>
              </div>
            </div>

          </form>
        </div>
        <!-- /card -->
      </div>
    </div>
  </div>
</section>


<!-- <div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Register') }}</div>

                <div class="card-body">
                    <form method="POST" action="{{ route('register') }}">
                        @csrf

                        <div class="row mb-3">
                            <label for="name" class="col-md-4 col-form-label text-md-end">{{ __('Name') }}</label>

                            <div class="col-md-6">
                                <input id="name" type="text" class="form-control @error('name') is-invalid @enderror" name="name" value="{{ old('name') }}" required autocomplete="name" autofocus>

                                @error('name')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="row mb-3">
                            <label for="email" class="col-md-4 col-form-label text-md-end">{{ __('Email Address') }}</label>

                            <div class="col-md-6">
                                <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email">

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
                                <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="new-password">

                                @error('password')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="row mb-3">
                            <label for="password-confirm" class="col-md-4 col-form-label text-md-end">{{ __('Confirm Password') }}</label>

                            <div class="col-md-6">
                                <input id="password-confirm" type="password" class="form-control" name="password_confirmation" required autocomplete="new-password">
                            </div>
                        </div>

                        <div class="row mb-0">
                            <div class="col-md-6 offset-md-4">
                                <button type="submit" class="btn btn-primary">
                                    {{ __('Register') }}
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div> -->
@endsection
