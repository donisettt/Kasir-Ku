@extends('layouts.main',['title'=>'Log In','login'=>true])
@section('content')

<body class="hold-transition login-page" background="/images/bg.jpg">
    <div class="card">
        <div class="card-body card login-card-body">
            <div class="login-logo h1">
                <span><a href="/"><b>{{ config('app.name') }}</b></a></span>
            </div>
            <p class="login-box-msg">Masuk untuk memulai sesi anda!</p>
            <form action="{{ route('login') }}" method="post">
                @csrf
                <div class="input-group">
                    <input name="username" class="form-control @error('username') is-invalid @enderror"
                        placeholder="Username">
                    <div class="input-group-append">
                        <div class="input-group-text">
                            <span class="fas fa-user"></span>
                        </div>
                    </div>
                </div>
                @error('username')
                <div class="invalid-feedback d-block">{{ $message }}</div>
                @enderror
                <div class="input-group mt-3">
                    <input name="password" type="password" class="form-control @error('password') is-invalid @enderror"
                        placeholder="Password">
                    <div class="input-group-append">
                        <div class="input-group-text">
                            <span class="fas fa-lock"></span>
                        </div>
                    </div>
                </div>
                @error('password')
                <div class="invalid-feedback d-block">{{ $message }}</div>
                @enderror
                <div class="row mt-3">
                    <div class="col-8">
                        <div class="icheck-primary">
                            <input type="checkbox" id="remember" name="remember">
                            <label for="remember">Remember Me</label>
                        </div>
                    </div>
                    <div class="col-4">
                        <button type="submit" class="btn btn-primary btn-block">Sign In</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</body>
@endsection