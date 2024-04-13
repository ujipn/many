<!-- resources/views/assets/show.blade.php -->
<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />
    <script src="https://kit.fontawesome.com/9c33f0ed37.js" crossorigin="anonymous"></script>
    <!-- Scripts -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body class="font-sans antialiased">
    <!--ナビゲーションが出る部分  -->
    <nav x-data="{ open: false }" class="bg-white dark:bg-gray-800 border-b border-gray-100 dark:border-gray-700">
        <!-- Primary Navigation Menu -->
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex justify-between h-16">
                <div class="flex items-center justify-between">

                    <!-- Logo -->
                    <div class="shrink-0 flex items-center">
                        <a href="{{ route('home') }}">
                            <x-application-logo class="block h-9 w-auto fill-current text-gray-800 dark:text-gray-200" />
                        </a>
                    </div>

                    <!-- ハンバーガーメニュー -->
                    <div class="ml-auto sm:hidden">
                        <button @click="open = ! open" class="inline-flex items-center justify-center p-2 rounded-md text-gray-400 dark:text-gray-500 hover:text-gray-500 dark:hover:text-gray-400 hover:bg-gray-100 dark:hover:bg-gray-900 focus:outline-none focus:bg-gray-100 dark:focus:bg-gray-900 focus:text-gray-500 dark:focus:text-gray-400 transition duration-150 ease-in-out">
                            <svg class="h-6 w-6" stroke="currentColor" fill="none" viewBox="0 0 24 24">
                                <path :class="{'hidden': open, 'inline-flex': ! open }" class="inline-flex" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16" />
                                <path :class="{'hidden': ! open, 'inline-flex': open }" class="hidden" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                            </svg>
                        </button>
                    </div>

                    <!-- Navigation Links -->
                    <div class="hidden space-x-8 sm:-my-px sm:ms-10 sm:flex">

                        <x-nav-link :href="route('home')" :active="request()->routeIs('home')">
                            {{ __('施設一覧へ') }}
                        </x-nav-link>
                        <x-nav-link :href="route('orders.index')" :active="request()->routeIs('orders.index')">
                            {{ __('企画募集一覧へ') }}
                        </x-nav-link>
                    </div>
                </div>

                <!-- Settings Dropdown -->
                <div class="hidden sm:flex sm:items-center sm:ms-6">
                    <x-dropdown align="right" width="48">
                        <x-slot name="trigger">
                            <button class="inline-flex items-center px-3 py-2 border border-transparent text-sm leading-4 font-medium rounded-md text-gray-500 dark:text-gray-400 bg-white dark:bg-gray-800 hover:text-gray-700 dark:hover:text-gray-300 focus:outline-none transition ease-in-out duration-150">
                                <div>{{ Auth::user() ? Auth::user()->name : 'Guest' }}</div>

                                <div class="ms-1">
                                    <svg class="fill-current h-4 w-4" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20">
                                        <path fill-rule="evenodd" d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z" clip-rule="evenodd" />
                                    </svg>
                                </div>
                            </button>
                        </x-slot>

                        <x-slot name="content">
                            @if (Auth::check() && Auth::user()->is_admin)
                            <x-dropdown-link :href="url('/dashboard')">
                                {{ __('オーナーモードへ') }}
                            </x-dropdown-link>
                            @endif
                            @if (Auth::check())
                            <x-dropdown-link :href="route('profile.show', Auth::user()->id)">
                                {{ __('Profile') }}
                            </x-dropdown-link>

                            <x-dropdown-link :href="route('orders.create')">
                                {{ __('企画を依頼する') }}
                            </x-dropdown-link>

                            <!-- Authentication -->
                            <form method="POST" action="{{ route('logout') }}">
                                @csrf

                                <x-dropdown-link :href="route('logout')" onclick="event.preventDefault();
                                                this.closest('form').submit();">
                                    {{ __('Log Out') }}
                                </x-dropdown-link>
                            </form>
                            @else
                            <x-dropdown-link :href="route('login')">
                                {{ __('ログインしてください') }}
                            </x-dropdown-link>
                            @endif
                        </x-slot>
                    </x-dropdown>
                </div>

            </div>
        </div>

        <!-- Responsive Navigation Menu -->
        <div :class="{'block': open, 'hidden': ! open}" class="hidden sm:hidden">
            <div class="pt-2 pb-3 space-y-1">
                <x-nav-link :href="route('home')" :active="request()->routeIs('home')">
                    {{ __('施設一覧へ') }}
                </x-nav-link>
                <x-nav-link :href="route('orders.index')" :active="request()->routeIs('orders.index')">
                    {{ __('企画募集一覧へ') }}
                </x-nav-link>
            </div>

            <!-- Responsive Settings Options -->
            <div class="pt-4 pb-1 border-t border-gray-200 dark:border-gray-600">
                <div class="px-4">
                    <div class="font-medium text-base text-gray-800 dark:text-gray-200">{{ Auth::user() ? Auth::user()->name : 'Guest' }}</div>
                    <div class="font-medium text-sm text-gray-500">{{ Auth::user() ? Auth::user()->email : 'Guest' }}</div>
                </div>

                <div class="mt-3 space-y-1">
                    <x-responsive-nav-link :href="route('profile.show', Auth::user()->id)">
                        {{ __('Profile') }}
                    </x-responsive-nav-link>

                    <!-- Authentication -->
                    <form method="POST" action="{{ route('logout') }}">
                        @csrf

                        <x-responsive-nav-link :href="route('logout')" onclick="event.preventDefault();
                                        this.closest('form').submit();">
                            {{ __('Log Out') }}
                        </x-responsive-nav-link>
                    </form>
                </div>
            </div>
        </div>
    </nav>

    <header class="bg-white dark:bg-gray-800 shadow">
        <div class="max-w-7xl mx-auto py-6 px-4 sm:px-6 lg:px-8">
            <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
                {{ __('企画募集一覧') }}
            </h2>
        </div>
    </header>

    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
        <div class="">
            <div class="flex flex-col sm:flex-row p-4 text-gray-900 dark:text-gray-100">
                <form method="GET" action="{{ route('orders.index') }}" class="flex flex-col sm:flex-row w-full">
                    <input type="text" name="search" placeholder="キーワードを入力" class="shadow appearance-none border rounded w-full sm:w-1/4 py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline mb-2 sm:mb-0">
                    <div class="flex justify-between sm:justify-start ml-0 sm:ml-4 w-full sm:w-auto">
                        <button type="submit" class="inline-block px-2 py-2 text-black text-center rounded ml-2">
                            <i class="fas fa-search"></i> 検索
                        </button>
                        <a href="{{ route('orders.index') }}" class="inline-block px-2 py-2 bg-white-500 text-black text-center rounded ml-2">
                            <i class="fas fa-times"></i> クリア
                        </a>
                    </div>
                </form>
            </div>
        </div>
    </div>


    <!-- オーダーを掲載する部分 -->
    <div class="py-2">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800  shadow-sm sm:rounded-lg ">
                <div class="p-4 text-gray-900 dark:text-gray-100">
                    <div class="flex flex-wrap -mx-4">
                        @foreach ($orders as $order)
                        <div class="p-4 w-full sm:w-1/2 md:w-1/3 lg:w-1/3 xl:w-1/3">
                            <div class="bg-gray-100 dark:bg-gray-700 rounded-lg overflow-hidden">
                                <p class="text-gray-800 dark:text-gray-300 font-medium">団体名：{{ $order->group_name }}</p>
                                <div class="p-4">
                                    <p class="text-gray-600 dark:text-gray-400 text-sm font-medium">目的: {{ $order->order_purpose }}</p>
                                    <p class="text-gray-600 dark:text-gray-400 text-sm ">出発日: {{ \Carbon\Carbon::parse($order->start_date)->format('Y-m-d') }}</p>
                                    <p class="text-gray-600 dark:text-gray-400 text-sm ">終了日: {{ \Carbon\Carbon::parse($order->end_date)->format('Y-m-d') }}</p>
                                    <p class="text-gray-600 dark:text-gray-400 text-sm">人数: {{ number_format($order->order_number) }}人</p>
                                    <p class="text-gray-600 dark:text-gray-400 text-sm">予算: {{ number_format($order->order_budget) }}円(1人あたり{{ number_format($order->order_budget / $order->order_number) }}円)</p>
                                    <p class="text-gray-600 dark:text-gray-400 text-sm">エリア: {{ $order->order_area }}</p>
                                    <!-- <p class="text-gray-600 dark:text-gray-400 text-sm">内容: {{ $order->order_content }}</p> -->
                                    <div class="text-left">
                                        <a href="{{ route('orders.show', $order) }}" class="inline-block px-4 py-2 bg-pink-500 text-white text-center rounded">詳細を見る</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    </div>


</body>

</html>