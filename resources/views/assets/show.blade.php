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

    <!-- 全体：施設が出る部分 -->
    <div class="flex flex-col md:flex-row bg-gray-100">
        <!-- 左側部分 -->
        <div class="text-gray-700 px-4 py-4 w-full md:w-1/2">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                    <div class="p-6 text-black dark:text-gray-300">

                        <p class="text-black dark:text-gray-300 text-lg">{{ $asset->asset }}</p>
                        @if ($asset->image)
                        <img src="{{ Storage::url($asset->image) }}" alt="Asset Image" class="mt-2 rounded"> <!-- 画像を表示 -->
                        @endif

                        <!-- <h2 class="text-gray-600 dark:text-gray-400 text-sm">！利用者評価：＊＊点</h2>
                        <h2 class="text-gray-600 dark:text-gray-400 text-sm">！利用者レビュー：＊＊件</h2> -->
                        <h1>{{ $asset->asset_title }}</h1>
                        <p class="text-gray-600 dark:text-gray-400 text-sm font-medium">施設名: {{ $asset->asset_name }}</p>
                        <p class="text-gray-600 dark:text-gray-400 text-sm">所在地: {{ $asset->asset_area }}</p>
                        <p class="text-gray-600 dark:text-gray-400 text-sm">所要人数: {{ number_format($asset->asset_number) }}人</p>
                        <p class="text-gray-600 dark:text-gray-400 text-sm">金額: {{ number_format($asset->asset_amount) }}円(1人あたり{{ number_format($asset->asset_amount / $asset->asset_number) }}円)</p>
                        <p class="text-gray-600 dark:text-gray-400 text-sm">施設オーナー：
                            <a href="{{ route('profile.show', $asset->user->id) }}" class="text-blue-500 hover:text-blue-700">
                                {{ $asset->user->name }}さん
                            </a>
                        </p>
                        <div class="text-gray-600 dark:text-gray-400 text-sm flex">
                            <p>投稿日時: {{ $asset->created_at->format('Y-m-d H:i') }}</p>
                            <p>更新日時: {{ $asset->updated_at->format('Y-m-d H:i') }}</p>
                        </div>
                        <div class="">
                            <p class="text-gray-600 dark:text-gray-400 text-sm font-medium">【施設情報】</p>
                            <p class="text-gray-600 dark:text-gray-400 text-sm bg-gray-100 dark:bg-gray-700 rounded-lg overflow-hidden">{!! nl2br(e($asset->introduction)) !!}</p>
                        </div>


                        @if (auth()->id() == $asset->user_id)
                        <div class="flex">
                            <a href="{{ route('assets.edit', $asset) }}" class="mr-2">
                                <i class="fas fa-edit text-blue-500 hover:text-blue-700"></i>
                            </a>
                            <form action="{{ route('assets.destroy', $asset) }}" method="POST" onsubmit="return confirm('本当に削除しますか？');">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="text-red-500 hover:text-red-700">
                                    <i class="fas fa-trash"></i>
                                </button>
                            </form>
                        </div>
                        @endif
                    </div>
                </div>
            </div>
        </div>

        <!--右側エリア[START]-->
        <div class="text-gray-700 px-4 py-4 w-full md:w-1/2">
            <div class="py-4">
                <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                    <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                        @include('layouts.calendar')
                    </div>
                </div>
            </div>

            <!--投稿する場所-->
            <div class="py-2">
                <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                    <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">


                        <div class="p-2 text-black text-gray-600 dark:text-gray-400 text-sm font-medium">オーナーと会話をしましょう</div>

                        @foreach ($talks as $talk)
                        <div class="flex justify-start items-start mb-4 p-2 border-b dark:border-gray-700 px-4">
                            @if (auth()->id() == $talk->user_id)
                            <form action="{{ route('talks.destroy', $talk) }}" method="POST" onsubmit="return confirm('本当に削除しますか？');">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="text-red-500 hover:text-red-700 mr-2">
                                    <i class="fas fa-trash"></i>
                                </button>
                            </form>
                            @endif
                            <p class="text-gray-600 dark:text-gray-400 text-sm flex-grow">投稿者: {{ $talk->user->name }} 投稿内容：{{ $talk->content }}</p>

                        </div>

                        @endforeach

                        <form method="POST" action="{{ route('talks.store', ['asset' => $asset->id]) }}">
                            @csrf
                            <div class="mb-4">
                                <label for="content" class="sr-only">メッセージ</label>
                                <textarea name="content" id="content" cols="30" rows="4" class="bg-gray-100 dark:bg-gray-700 border-2 w-full p-4 rounded-lg @error('content') border-red-500 @enderror" placeholder="メッセージを入力してください"></textarea>
                                @error('content')
                                <div class="text-red-500 mt-2 text-sm">
                                    {{ $message }}
                                </div>
                                @enderror
                            </div>
                            <div>
                                <button type="submit" class="bg-pink-500 hover:bg-pink-700 text-white px-4 py-2 rounded font-medium">投稿</button>



                            </div>

                    </div>

</body>

</html>