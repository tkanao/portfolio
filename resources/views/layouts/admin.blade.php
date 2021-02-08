<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">
        
        <title>@yield('title')</title>
        <!--Laravelで標準で用意されているJavascriptを読み込む-->
        <script src="{{ secure_asset('js/app.js') }}" defer></script>
        
        <!--Fonts-->
        <link rel="dns-prefetch" href="https://fonts.gstatic.com">
        <link href="https://fonts.googleapis.com/css?family=Raleway:300,400,600" rel="stylesheet" type="text/css">
        
        <!--Styles-->
        <!--laravel標準で使用されているCSSの読み込み-->
        <link href="{{ secure_asset('css/app.css') }}" rel="stylesheet">
        <!--作成したCSSの読み込み-->
        <link href="{{ secure_asset('css/admin.css') }}" rel="stylesheet">
        <!--bootstrapの読み込み-->
        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
    </head>
    
    <body>
        <div id="app">
            <!--ナビゲーションバー-->
            <nav class="navbar navbar-expand-md sticky-top navbar-dark bg-info navbar-laravel">
                <div class="container">
                    <!--後で直す-->
                    <!--<a class="navbar-brand" href="{{ url('/') }}">-->
                    <!--    {{ config('app.name', 'Laravel') }}-->
                    <!--</a>-->
                    <button class="navbar-toggler" type="buton" data-toggle="collapse" data-target="#navbarNav4" aria-controls="navbarNav4" aria-expanded="false" aria-label="Toggle navigation">
                        <span class="navbar-toggler-icon"></span>
                    </button>
                    <a class="navbar-brand" href="#">家計簿</a>
                    <div class="collapse navbar-collapse justify-content-end">
                        <ul class="navbar-nav ml-auto">
                            <li class="nav-item">
                                <a class="nav-link" href="#">編集画面へ</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="#">一覧へ</a>
                            </li>
                            @guest
                                <li><a class="nav-link" href="{{ route('login') }}">{{ __('messages.Login') }}</a></li>
                            {{-- ログインしていたらユーザー名とログアウトボタンを表示 --}}
                            @else
                                <li class="nav-item dropdown">
                                    <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                                        {{ Auth::user()->name }} <span class="caret"></span>
                                    </a>
    
                                    <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                                        <a class="dropdown-item" href="{{ route('logout') }}"
                                           onclick="event.preventDefault();
                                                         document.getElementById('logout-form').submit();">
                                            {{ __('messages.Logout') }}
                                        </a>
    
                                        <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                            @csrf
                                        </form>
                                    </div>
                                </li>
                                @endguest
                        </ul>
                    </div>
                </div>
            </nav>
            
            <main class="py-4">
                @yield('content')
            </main>
        </div>
    </body>
</html>