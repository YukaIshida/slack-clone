@extends('layouts.app')

@section('content')
<div class="flex flex-col h-screen">
    <header class="flex justify-between p-4 border-b items-center">
        <h1 class="font-semibold text-xl leading-tight">Slack Clone</h1>
        <button class="py-1 px-4 border-2 border-green-800 rounded">
            <a href="{{ route('register') }}">ユーザー登録</a>
        </button>
    </header>
    <div class="bg-gray-100 flex-auto">
        <div class="flex justify-center mt-16">
            <div class="w-2/5 border bg-white">
                <div class="my-12 text-center">
                    <h2 class="text-4xl font-bold">ログイン</h2>
                    <p class="my-4">
                        <span class="font-semibold">メールアドレス</span>と
                        <span class="font-semibold">パスワード</span>を入力してください。
                    </p>

                    <form method="POST" action="{{ route('login') }}">
                        @csrf
                        <div class="mb-2">
                            <input
                                id="email" 
                                type="email"
                                name="email"
                                placeholder="you@example.com"
                                class="text-xl w-3/5 p-3 border rounded @error('email') border-red-600 @enderror"
                                value="{{ old('email') }}" required autocomplete="email" autofocus
                            />

                            @error('email')
                                <br>
                                <span class="text-red-600 text-xs" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>

                        <div class="mb-2">
                            <input
                                id="password" 
                                type="password"
                                name="password"
                                class="text-xl w-3/5 p-3 border rounded @error('password') border-red-600 @enderror"
                                placeholder="パスワード"
                                required autocomplete="current-password"
                            />

                            @error('password')
                                <br>
                                <span class="text-red-600 text-xs" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>

                        <div class="mb-2">
                            <input class="form-check-input" type="checkbox" name="remember" id="remember" {{ old('remember') ? 'checked' : '' }}>

                            <label for="remember">
                                {{ __('Remember Me') }}
                            </label>
                        </div>
                        
                        <button type="submit" class="text-xl w-3/5 bg-green-800 text-white py-2 rounded">ログイン</button>

                        @if (Route::has('password.request'))
                            <div class="mt-2">
                                <a class="btn btn-link" href="{{ route('password.request') }}">
                                    {{ __('Forgot Your Password?') }}
                                </a>
                            </div>
                        @endif
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- <div class="container">
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
</div> -->
@endsection
