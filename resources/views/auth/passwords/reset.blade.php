@extends('Frontend.layouts.master')

@section('content')
    <div class="nav-info">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-8">
                    <h3>Art Kit</h3>
                    <nav class="breadcrumbs">
                        <a href="{{ route('home') }}">home</a>
                        <span class="divider">/</span>
                        Reset Password
                    </nav>
                </div>

            </div>
        </div>
    </div>

    <section class="login-body">
        <div class="container">
            <div class="login" style="background:url(../Asset/Uploads/Products/aaa.jpg) 0% 0% no-repeat;background-size: 38% 100%;background-color: #fff;">
                <i class="fa fa-sign-in" aria-hidden="true"></i>
                <strong>Reset Password</strong>
                @if ($errors->any())
                    <div class="alert alert-danger col-md-12">
                        <ul>
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif

                <form method="POST" class="login-form mt-3" action="{{ route('password.update') }}"
                    aria-label="{{ __('Login') }}">
                    @csrf
                    <input type="hidden" name="token" value="{{ $token }}">
                    <fieldset>
                        <div class="form">
                            <div class="form-row">
                                <label class="form-label" for="input">Email Address</label>
                                <input id="email" type="email" class="form-text @error('email') is-invalid @enderror"
                                    name="email" value="{{ $email ?? old('email') }}" required autocomplete="off"
                                    autofocus>
                                @error('email')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                            <div class="form-row">
                                <label class="form-label" for="input">Password</label>
                                <input type="password"
                                    class="form-text @error('password') is-invalid @enderror" name="password" required>
                                @error('password')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                            <div class="form-row">
                                <label class="form-label" for="input">Confirm Password</label>
                                <input type="password" class="form-text" name="password_confirmation"
                                    required>

                            </div>
                 
                            <div class="form-row button-login">
                                <button class="btn btn-login form-control">Reset Password
                                </button>
                            </div>
                        </div>

                    </fieldset>
                </form>

            </div>
        </div>
    </section>

@endsection
