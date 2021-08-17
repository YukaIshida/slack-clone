@extends('layouts.app')

@section('content')
<div class="flex flex-col h-screen">
    <header class="flex justify-between p-4 border-b items-center">
        <h1 class="font-semibold text-xl leading-tight">Slack Clone</h1>
        <a class="py-1 px-4 border-2 border-green-800 rounded" href="{{ route('login') }}">ログイン</a>
    </header>

    <div class="bg-gray-100 flex-auto">
        <div class="flex justify-center mt-16">
            <div class="w-2/5 border bg-white">
                <div class="my-12 text-center">
                    
                    <h2 class="text-4xl font-bold">ユーザの登録</h2>
                    <p class="my-4">
                        <span class="font-semibold">メールアドレス</span>と
                        <span class="font-semibold">パスワード</span>を入力してください。
                    </p>

                    <form method="POST" action="{{ route('register') }}">
                        @csrf

                        <div class="mb-2">
                            <input id="name" placeholder="your name" type="text" class="text-xl w-3/5 p-3 border rounded @error('name') border-red-600 @enderror" name="name" value="{{ old('name') }}" required autocomplete="name" autofocus>

                            @error('name')
                                <span class="text-red-600 text-xs" role="alert">
                                    <br>
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>

                        <div class="mb-2">
                            <input id="email" type="email" placeholder="you@example.com" class="text-xl w-3/5 p-3 border rounded @error('email') border-red-600 @enderror" name="email" value="{{ old('email') }}" required autocomplete="email">

                            @error('email')
                                <span class="text-red-600 text-xs" role="alert">
                                    <br>
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>

                        <div class="mb-2">
                            <input id="password" type="password" placeholder="password" class="text-xl w-3/5 p-3 border rounded @error('password') border-red-600 @enderror" name="password" required autocomplete="new-password">

                            @error('password')
                                <span class="text-red-600 text-xs" role="alert">
                                    <br>
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>

                        <div class="mb-2">
                            <input id="password-confirm" placeholder="password-confirm" type="password" class="text-xl w-3/5 p-3 border rounded" name="password_confirmation" required autocomplete="new-password">
                        </div>

                        <button type="submit" class="text-xl w-3/5 bg-green-800 text-white py-2 rounded">
                            登録
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
