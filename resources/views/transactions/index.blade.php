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

    <!-- Scripts -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body class="font-sans antialiased">
    <!--ナビゲーションが出る部分  -->
    <nav x-data="{ open: false }" class="bg-white dark:bg-gray-800 border-b border-gray-100 dark:border-gray-700">
        <!-- Primary Navigation Menu -->
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex justify-between h-16">
                <div class="flex">
                    <!-- Logo -->
                    <div class="shrink-0 flex items-center">
                        <a href="{{ route('home') }}">
                            <x-application-logo class="block h-9 w-auto fill-current text-gray-800 dark:text-gray-200" />
                        </a>
                    </div>

                    <!-- Navigation Links -->
                    <div class="hidden space-x-8 sm:-my-px sm:ms-10 sm:flex">

                        <x-nav-link :href="route('home')" :active="request()->routeIs('home')">
                            {{ __('TOPへ') }}
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
                            <x-dropdown-link :href="route('profile.edit')">
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
    </nav>

    <div class="flex flex-col sm:flex-row bg-gray-100">
        <!-- Left side -->
        <div class="text-gray-700 px-4 py-4 w-full sm:w-1/3">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                    <div class="p-6 text-gray-900 dark:text-gray-100">
                        <h1>取引情報</h1>

                        <p class="text-gray-600 dark:text-gray-400 text-sm">施設名: {{ $asset->asset_name }}</p>
                        <p class="text-gray-600 dark:text-gray-400 text-sm">予約希望日: {{ $calendar->start_date }}</p>
                        <div class="text-gray-600 dark:text-gray-400 text-sm">
                            <p>予約登録日: {{ $transaction->created_at->format('Y-m-d') }}</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Right side -->
        <div class="text-gray-700 px-4 py-4 w-full sm:w-2/3">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                    <!-- Status -->
                    <div class="p-6 bg-white border-b border-gray-200 dark:border-gray-700">
                        現在のステータスは、
                        @switch($transaction->status)
                        @case('pending')
                        予約手続き中
                        @break

                        @case('completed')
                        予約完了
                        @break

                        @case('cancelled')
                        キャンセル
                        @break

                        @default
                        不明なステータス
                        @endswitch
                        です。
                    </div>

                    <!-- 施設オーナー情報を掲載 -->
                    <div class="p-6 bg-white border-b border-gray-200 dark:border-gray-700">
                        施設オーナー：{{ $calendar->user->name }}さん
                    </div>
                    <!-- 予約者情報を掲載 -->
                    <div class="p-6 bg-white border-b border-gray-200 dark:border-gray-700">
                        予約者： {{ $transaction->user->name }}さん
                    </div>


                </div>
            </div>
        </div>
    </div>
    <!-- Messages -->
    <div class="p-6 bg-white border-b border-gray-200 dark:border-gray-700">
        メッセージ

        @foreach ($posts as $post)
        <div class="mb-4 p-4 bg-gray-100 dark:bg-gray-700 rounded-lg">
            <p class="text-gray-800 dark:text-gray-300">{{ $post->content }}</p>
            <p class="text-gray-600 dark:text-gray-400 text-sm">投稿者: {{ $post->user->name }}</p>
            @if (auth()->id() == $post->user_id)
                            
                <form action="{{ route('posts.destroy', $post) }}" method="POST" onsubmit="return confirm('本当に削除しますか？');">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="text-red-500 hover:text-red-700">削除</button>
                </form>
       
            @endif
        </div>

        @endforeach

        <form method="POST" action="{{ route('post.store', ['transaction_id' => $transaction->id]) }}">
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
                <button type="submit" class="bg-pink-500 text-white px-4 py-2 rounded font-medium">投稿</button>
            </div>
        </form>
    </div>

</body>

</html>