{{--<!doctype html>--}}
{{--<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">--}}
{{--<head>--}}
{{--    <meta charset="UTF-8">--}}
{{--    <meta name="viewport"--}}
{{--          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">--}}
{{--    <meta http-equiv="X-UA-Compatible" content="ie=edge">--}}
{{--    <style>--}}
{{--        --}}
{{--        --}}
{{--    </style>--}}
{{--    <title>首頁</title>--}}
{{--</head>--}}
{{--<body>--}}
{{--    <div>--}}

{{--    </div>--}}
{{--    <div>--}}
{{--        @if (Route::has('login'))--}}
{{--            <div class="hidden fixed top-0 right-0 px-6 py-4 sm:block">--}}
{{--                @auth--}}
{{--                    <a href="{{ url('/dashboard') }}" class="text-sm text-gray-700 dark:text-gray-500 underline">Dashboard</a>--}}
{{--                @else--}}
{{--                    <a href="{{ route('login') }}" class="text-sm text-gray-700 dark:text-gray-500 underline">登入</a>--}}

{{--                    @if (Route::has('register'))--}}
{{--                        <a href="{{ route('register') }}" class="ml-4 text-sm text-gray-700 dark:text-gray-500 underline">註冊</a>--}}
{{--                    @endif--}}
{{--                @endauth--}}
{{--            </div>--}}
{{--        @endif--}}
{{--    </div>--}}



{{--</body>--}}
{{--</html>--}}

    <!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <title>Responsive Layout</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="{{ asset('css/bootstrap.css') }}" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('css/app.css') }}">
    <script src="{{ asset('js/app.js') }}" defer></script>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

    @yield('headPart')


    <style>
        .layoutTitle{
            font-size: 32px;
            margin-left: 20px;
        }
        .pageTitle{
            font-size: 32px;
        }

        body {
            margin: 0;
            padding: 0;
            font-family: "思源黑體", sans-serif;
            background: #f5f5f5;
        }

        /*header {*/
        /*    display: flex;*/
        /*    background-color: #333;*/
        /*    color: #fff;*/
        /*    padding: 20px;*/
        /*     text-align: center;*/
        /*   !* 水平置中 *!*/
        /*    justify-content: center;*/
        /*    !* 垂直置中 *!*/
        /*    align-items: center;*/
        /*}*/
        header {
            position: fixed;
            top: 0;
            left: 0;
            right: 0;
            background-color: #333;
            color: #fff;
            display: flex;
            padding: 20px;
            text-align: center;
            /* 水平置中 */
            justify-content: center;
            /* 垂直置中 */
            align-items: center;
            z-index: 100;
        }


        .header-left {
            flex-basis: 33.33%;
            text-align: left;
        }

        .header-middle {
            flex-basis: 33.33%;
            text-align: center;
            display: flex;
            justify-content: space-between;
            align-items: center;
            padding: 0 10px;
        }

        .header-right {
            flex-basis: 33.33%;
            text-align: right;
            justify-content: flex-end;
        }
        .header-a{
            color: white;
        }


        /*nav {*/
        /*    display: flex;*/
        /*    background-color: #ccc;*/
        /*    padding: 10px;*/
        /*    text-align: center;*/
        /*}*/

        nav a {
            display: block;
            padding: 10px;
            color: #333;
            text-decoration: none;
        }

        main {
            padding: 20px;
            text-align: center;
        }

        section {
            display: flex;
            flex-wrap: wrap;
            justify-content: center;
            align-items: center;
            padding: 20px;
        }

        section div {
            flex-basis: calc(33.33% - 20px);
            margin: 10px;
            padding: 20px;
            background-color: #eee;
            text-align: center;
            border: 1px solid #ccc;
            box-sizing: border-box;
        }

        footer {
            display: flex;
            justify-content: center;
            align-items: center;
            background-color: #333;
            color: #fff;
            padding: 0px;
            text-align: center;
        }


        .footer-content {
            width: 62%;
        }

        .footer-text{
            display: flex;
            /* 水平置中 */
            justify-content: left;
            margin-bottom: 0;
        }

        .footer-text h5 {
            margin: 10px;
            margin-left: 0px;
        }

        .footer-text a{
            color: white;
            margin-right: 10px;
        }



        @media screen and (max-width: 768px) {
            section div {
                flex-basis: calc(50% - 20px);
            }
        }

        @media screen and (max-width: 480px) {
            section div {
                flex-basis: calc(100% - 20px);
            }
        }
    </style>
    @yield('CssPart')
</head>
<body >
<header>
    <div class="header-left ">
        <div class="layoutTitle"><a href="{{route('admin.index')}}">ShopTest後台管理</a></div>
    </div>
    <div class="header-middle">
        <a href="{{route('root')}}">前台</a>

        <a href="{{route('backend-users.index') }}">管理會員</a>

        <a href="{{route('backend-products.index')}}">管理商品</a>

        <a href="{{route('backend-categories.index')}}">管理商品分類</a>

        <a href="{{route('transactions.index')}}">交易紀錄</a>

        <a href="{{route('backend-announcements.index')}}">管理公告</a>
    </div>
    <div class="header-right flex justify-end">
        @if (Route::has('login'))
            @auth
                {{--                <a href="{{ url('/dashboard') }}" class="header-a text-sm text-gray-700 dark:text-gray-500 underline">Dashboard</a>--}}
                <div class="ml-3 relative flex items-center">
                    <x-jet-dropdown align="right" width="48">
                        <x-slot name="trigger">
                            @if (Laravel\Jetstream\Jetstream::managesProfilePhotos())
                                <button class="flex text-sm border-2 border-transparent rounded-full focus:outline-none focus:border-gray-300 transition">
                                    <img class="h-8 w-8 rounded-full object-cover" src="{{ Auth::user()->profile_photo_url }}" alt="{{ Auth::user()->name }}" />
                                </button>
                            @else
                                <span class="inline-flex rounded-md">
                                    <button type="button" class="inline-flex items-center px-3 py-2 border border-transparent text-sm leading-4 font-medium rounded-md text-gray-500 bg-white hover:text-gray-700 focus:outline-none transition">
                                        {{ Auth::user()->name }}

                                        <svg class="ml-2 -mr-0.5 h-4 w-4" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor">
                                            <path fill-rule="evenodd" d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z" clip-rule="evenodd" />
                                        </svg>
                                    </button>
                                </span>
                            @endif
                        </x-slot>

                        <x-slot name="content">
                            <!-- Account Management -->
                            <div class="block px-4 py-2 text-xs text-gray-400">
                                {{ __('管理帳號') }}
                            </div>

                            <x-jet-dropdown-link href="{{ route('profile.show') }}">
                                {{ __('個人檔案') }}
                            </x-jet-dropdown-link>

                            @if (Laravel\Jetstream\Jetstream::hasApiFeatures())
                                <x-jet-dropdown-link href="{{ route('api-tokens.index') }}">
                                    {{ __('API Tokens') }}
                                </x-jet-dropdown-link>
                            @endif

                            <div class="border-t border-gray-100"></div>

                            <!-- Authentication -->
                            <form method="POST" action="{{ route('logout') }}" x-data>
                                @csrf

                                <x-jet-dropdown-link href="{{ route('logout') }}"
                                                     @click.prevent="$root.submit();">
                                    {{ __('登出') }}
                                </x-jet-dropdown-link>
                            </form>
                        </x-slot>
                    </x-jet-dropdown>
                </div>
            @else
                <a href="{{ route('login') }}" class="header-a ml-4 text-sm text-gray-700 dark:text-gray-500 underline">登入</a>

                @if (Route::has('register'))
                    <a href="{{ route('register') }}" class="header-a ml-4 text-sm text-gray-700 dark:text-gray-500 underline">註冊</a>
                @endif
            @endauth
        @endif
    </div>
</header>
<div  style="height: 10vh"></div>

<div style="min-height: 83vh">
    @yield('body')
</div>
<footer>
    <div class="footer-content">
        <div class="footer-text">
            <a href=""><h5>繁體中文</h5></a>
            <a href=""><h5>English</h5></a>
        </div>
        <hr>
        <div class="footer-text">
            <h5>ShopTest©2023</h5>
        </div>
        <div class="footer-text">
        </div>
    </div>
</footer>
</body>
</html>
<script>
    var cart = @json(session('cart', []));
    var total = @json(session('total'));
    console.log(cart,total);


    function showAlert(message) {
        alert(message);
    }

    @if(session()->has('notice'))
    showAlert("{{ session('notice') }}");
    @endif
</script>
@yield('JavaScriptPart')



