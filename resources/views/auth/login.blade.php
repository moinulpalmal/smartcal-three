@extends('layouts.common.login-master')

@section('body')
    <div id="wrap" class="animsition">
        <div class="page page-core page-login">
            <div class="text-center"><h3 class="text-light text-white"><span class="text-lightred">Smart</span> Cal Three</h3></div>
            <div class="container w-420 p-15 bg-white mt-40 text-center">
                <h2 class="text-light text-greensea">{{ __('Login') }}</h2>
                <div class="row">
                    <div class="col-md-12">
                        <div class="alert alert-warning">
                            <strong>Merchandiser Login Info!</strong><br><br>
                            <ul>
                                <li class="text-left"><strong>Email: </strong>merchandising.lpd_3@palmalgarments.com</li>
                                <li class="text-left"><strong>Password: </strong>123456789</li>
                            </ul>
                        </div>
                    </div>
                </div>
                @if (session()->has('message'))
                    <div class="row">
                        <div class="col-md-12">
                            <div class="alert alert-danger">
                                <strong>Whoops!</strong> There were some problems with your input.<br><br>
                                <ul>
                                    <li>{{ session()->get('message') }}</li>
                                </ul>
                            </div>
                        </div>
                    </div>
                @endif
                <form method="POST" action="{{ route('login') }}">
                    @csrf
                    <div class="form-group">
                        <input id="email" type="email" placeholder="Email" class="form-control underline-input @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email" autofocus>
                        @error('email')
                        <span class="invalid-feedback text-left text-danger" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                        @enderror
                    </div>
                    <div class="form-group">
                        <input id="password" type="password" placeholder="Password" class="form-control underline-input @error('password') is-invalid @enderror" name="password" required autocomplete="current-password">
                        @error('password')
                        <span class="invalid-feedback text-left text-danger" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                        @enderror
                    </div>
                    <div class="form-group text-left mt-20">
                        <button type="submit" class="btn btn-greensea b-0 br-2 mr-5">
                            {{ __('Login') }}
                        </button>
                        {{-- <label class="checkbox checkbox-custom-alt checkbox-custom-sm inline-block">
                             <input type="checkbox" name="remember" id="remember" {{ old('remember') ? 'checked' : '' }}><i></i> Remember me
                         </label>--}}
                        {{-- @if (Route::has('password.request'))
                             <a class="pull-right mt-10" href="{{ route('password.request') }}">
                                 {{ __('Forgot Your Password?') }}
                             </a>
                         @endif--}}
                    </div>
                </form>
                <div class="bg-slategray lt wrap-reset mt-40">
                    <p class="m-0">
                        <strong>&copy; </strong><a href="http://palmalgarments.com/" target="_blank" class="text-uppercase">Palmal Group of Industries</a>
                    </p>
                </div>
            </div>
        </div>
    </div>
@endsection


{{--@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Login') }}</div>

                <div class="card-body">
                    <form method="POST" action="{{ route('login') }}">
                        @csrf

                        <div class="form-group row">
                            <label for="email" class="col-md-4 col-form-label text-md-right">{{ __('E-Mail Address') }}</label>

                            <div class="col-md-6">
                                <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email" autofocus>

                                @error('email')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="password" class="col-md-4 col-form-label text-md-right">{{ __('Password') }}</label>

                            <div class="col-md-6">
                                <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="current-password">

                                @error('password')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <div class="col-md-6 offset-md-4">
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" name="remember" id="remember" {{ old('remember') ? 'checked' : '' }}>

                                    <label class="form-check-label" for="remember">
                                        {{ __('Remember Me') }}
                                    </label>
                                </div>
                            </div>
                        </div>

                        <div class="form-group row mb-0">
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
</div>
@endsection--}}
