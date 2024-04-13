<!-- resources/views/assets/show.blade.php -->
<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Many団体さんいらっしゃい') }}</title>

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

    <!-- 全体：企画募集の詳細が出る部分 -->
    <div class="flex flex-col md:flex-row bg-gray-100">
        <!-- 左側部分 -->
        <div class="text-gray-700 px-4 py-4 w-full md:w-1/2">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg  mb-4">
                    <div class="p-6 text-black dark:text-gray-300">

                        <p class="text-gray-600 dark:text-gray-400 text-sm font-medium">団体名: {{ $order->group_name }}</p>
                        <p class="text-gray-600 dark:text-gray-400 text-sm">旅の目的: {{ $order->order_purpose }}</p>
                        <p class="text-gray-600 dark:text-gray-400 text-sm">出発日: {{ $order->start_date }}</p>
                        <p class="text-gray-600 dark:text-gray-400 text-sm">終了日: {{ $order->end_date }}</p>
                        <p class="text-gray-600 dark:text-gray-400 text-sm">人数: {{ number_format($order->order_number) }}人</p>
                        <p class="text-gray-600 dark:text-gray-400 text-sm">予算: {{ number_format($order->order_budget) }}円 (1人あたり{{ number_format($order->order_budget / $order->order_number) }}円)</p>
                        <p class="text-gray-600 dark:text-gray-400 text-sm">希望エリア: {{ $order->order_area }}</p>
                        <p class="text-gray-600 dark:text-gray-400 text-sm font-medium">募集内容: {{ $order->order_content }}</p>
                        <div class="text-gray-600 dark:text-gray-400 text-sm flex">
                            <p>投稿日時: {{ $order->created_at->format('Y-m-d H:i') }}</p>
                            <p>更新日時: {{ $order->updated_at->format('Y-m-d H:i') }}</p>
                        </div>

                        @if (auth()->id() == $order->user_id)
                        <div class="flex">
                            <a href="{{ route('orders.edit', $order) }}" class="mr-2">
                                <i class="fas fa-edit text-blue-500 hover:text-blue-700"></i>
                            </a>
                            <form action="{{ route('orders.destroy', $order) }}" method="comment" onsubmit="return confirm('本当に削除しますか？');">
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
                <!--左側エリア[状況]-->
                <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                    <div class="p-4">
                        @if (auth()->id() == $order->user_id)
                        <form id="itinerary-form" action="{{ route('orders.update', $order) }}" method="POST">
                            @csrf
                            @method('PUT')
                            <div class="mb-4">
                                <label class="block text-gray-700 dark:text-gray-300 text-sm font-bold mb-2">
                                    宿泊先
                                </label>
                                <select name="accommodation_status" class="block appearance-none w-full bg-gray-100 border border-gray-200 text-gray-700 py-3 px-4 pr-8 rounded leading-tight focus:outline-none focus:bg-white focus:border-gray-500">
                                    <option value="confirmed" {{ $order->accommodation_status == 'confirmed' ? 'selected' : '' }}>確定済</option>
                                    <option value="unconfirmed" {{ $order->accommodation_status == 'unconfirmed' ? 'selected' : '' }}>未定</option>
                                </select>
                            </div>
                            <div class="mb-4">
                                <label class="block text-gray-700 dark:text-gray-300 text-sm font-bold mb-2">
                                    近隣のアクティビティ
                                </label>
                                <select name="activity_status" class="block appearance-none w-full bg-gray-100 border border-gray-200 text-gray-700 py-3 px-4 pr-8 rounded leading-tight focus:outline-none focus:bg-white focus:border-gray-500">
                                    <option value="confirmed" {{ $order->activity_status == 'confirmed' ? 'selected' : '' }}>確定済</option>
                                    <option value="unconfirmed" {{ $order->activity_status == 'unconfirmed' ? 'selected' : '' }}>未定</option>
                                </select>
                            </div>
                            <div class="mb-4">
                                <label class="block text-gray-700 dark:text-gray-300 text-sm font-bold mb-2">
                                    滞在中のコンテンツ
                                </label>
                                <select name="content_status" class="block appearance-none w-full bg-gray-100 border border-gray-200 text-gray-700 py-3 px-4 pr-8 rounded leading-tight focus:outline-none focus:bg-white focus:border-gray-500">
                                    <option value="confirmed" {{ $order->content_status == 'confirmed' ? 'selected' : '' }}>確定済</option>
                                    <option value="unconfirmed" {{ $order->content_status == 'unconfirmed' ? 'selected' : '' }}>未定</option>
                                </select>
                            </div>
                            <div class="flex items-center justify-between">
                                <button class="bg-pink-500 hover:bg-pink-700 text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline" type="submit">
                                    更新
                                </button>
                            </div>
                        </form>
                        @else
                        <div>
                            <p>【宿泊先】 {{ $order->accommodation_status == 'confirmed' ? '確定済' : '未定' }}</p>
                            <p>【近隣のアクティビティ】 {{ $order->activity_status == 'confirmed' ? '確定済' : '未定' }}</p>
                            <p>【滞在中のコンテンツ】 {{ $order->content_status == 'confirmed' ? '確定済' : '未定' }}</p>
                        </div>
                        @endif
                    </div>
                </div>
            </div>

        </div>
        <!--右側エリア[START]-->
        <div class="text-gray-700 px-4 py-4 w-full md:w-1/2">
            <div class="py-2">
                <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                    <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">


                        <div class="p-2 text-black text-gray-600 dark:text-gray-400 text-sm font-medium">提案一覧</div>

                        @foreach ($comments as $comment)
                        <div class="flex justify-start items-center mb-4 p-4 border-b dark:border-gray-700 px-4">
                            @if (auth()->id() == $comment->user_id)
                            <form action="{{ route('comments.destroy', $comment) }}" method="POST" onsubmit="return confirm('本当に削除しますか？');">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="text-red-500 hover:text-red-700 mr-2">
                                    <i class="fas fa-trash"></i>
                                </button>
                            </form>
                            @endif
                            <p class="text-gray-600 dark:text-gray-400 text-sm flex-grow">投稿者: {{ $comment->user->name }} 投稿内容：{{ $comment->content }}</p>

                        </div>

                        @endforeach

                        <form method="POST" action="{{ route('comments.store', ['order' => $order->id]) }}">
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
                        </form>
                    </div>
                </div>
            </div>


        </div>
        <!--右側エリア[END]-->


    </div>
</body>

</html>