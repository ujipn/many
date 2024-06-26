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
                    <h1 class="ml-4 text-gray-600 text-center text-lg sm:text-xl font-semibold">団体で過ごすならMany</h1>
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

        </div>
    </div>

    <!-- Responsive Navigation Menu -->
    </div>

    <!-- Settings Dropdown -->
    <div class="hidden sm:flex sm:items-center sm:ms-6">
        <!-- ログイン完了後のモード対応 -->
        @if (Route::has('login'))
        <div class="sm:fixed sm:top-0 sm:right-0 p-6 text-right z-10">
            @auth
            <x-dropdown align="right" width="48">
                <x-slot name="trigger">
                    <button class="inline-flex items-center px-3 py-2 border border-transparent text-sm leading-4 font-medium rounded-md font-semibold text-gray-600 hover:text-gray-900 dark:text-gray-400 dark:hover:text-white focus:outline focus:outline-2 focus:rounded-sm  transition ease-in-out duration-150">
                        <div>{{ Auth::user()->name }}</div>
                        <div class="ml-1">
                            <svg class="fill-current h-4 w-4" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20">
                                <path fill-rule="evenodd" d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z" clip-rule="evenodd" />
                            </svg>
                        </div>
                    </button>
                </x-slot>

                <x-slot name="content">
                    @if (Auth::user()->is_admin)
                    <x-dropdown-link :href="url('/dashboard')">
                        {{ __('オーナーモードへ') }}
                    </x-dropdown-link>
                    @endif
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
                </x-slot>
            </x-dropdown>
            @else
            <a href="{{ route('login') }}" class="font-semibold text-gray-600 hover:text-gray-900 dark:text-gray-400 dark:hover:text-white focus:outline focus:outline-2 focus:rounded-sm focus:outline-red-500">Log in</a>

            @if (Route::has('register'))
            <a href="{{ route('register') }}" class="ml-4 font-semibold text-gray-600 hover:text-gray-900 dark:text-gray-400 dark:hover:text-white focus:outline focus:outline-2 focus:rounded-sm focus:outline-red-500">ユーザー登録</a>
            @endif

            @if (Route::has('admin.register')) <!-- 管理者登録ルートが存在する場合 -->
            <a href="{{ route('admin.register') }}" class="ml-4 font-semibold text-gray-600 hover:text-gray-900 dark:text-gray-400 dark:hover:text-white focus:outline focus:outline-2 focus:rounded-sm focus:outline-red-500">団体さんに施設を掲載</a> <!-- 管理者登録リンクを追加 -->
            @endif
            @endauth
        </div>
        @endif
    </div>




    </div>
    </div>

    <!-- Responsive Navigation Menu -->
    <div :class="{'block': open, 'hidden': ! open}" class="hidden sm:hidden">


        <!-- ドロップダウンメニュー -->
        <div class="fixed top-0 left-0 mt-2 w-full bg-white border rounded shadow-lg z-50 overflow-y-auto" x-show="open" x-on:click.away="open = false">
            <div class="py-2">
                <a href="{{ route('home') }}" class="block px-4 py-2 text-gray-800 hover:bg-indigo-500 hover:text-white">{{ __('施設一覧へ') }}</a>
                <a href="{{ route('orders.index') }}" class="block px-4 py-2 text-gray-800 hover:bg-indigo-500 hover:text-white">{{ __('企画募集一覧へ') }}</a>
                @auth
                <a href="{{ route('profile.show', Auth::user()->id) }}" class="block px-4 py-2 text-gray-800 hover:bg-indigo-500 hover:text-white">Profile</a>
                @if (Auth::user()->is_admin)
                <a href="{{ url('/dashboard') }}" class="block px-4 py-2 text-gray-800 hover:bg-indigo-500 hover:text-white">オーナーモードへ</a>
                @endif
                <a href="{{ route('logout') }}" onclick="event.preventDefault(); document.getElementById('logout-form').submit();" class="block px-4 py-2 text-gray-800 hover:bg-indigo-500 hover:text-white">Log Out</a>
                <a href="{{ route('orders.create') }}" class="block px-4 py-2 text-gray-800 hover:bg-indigo-500 hover:text-white">企画を依頼する</a>
                <form id="logout-form" action="{{ route('logout') }}" method="POST" class="hidden">
                    @csrf
                </form>
                @else
                <a href="{{ route('login') }}" class="block px-4 py-2 text-gray-800 hover:bg-indigo-500 hover:text-white">Log in</a>
                <a href="{{ route('register') }}" class="block px-4 py-2 text-gray-800 hover:bg-indigo-500 hover:text-white">ユーザー登録</a>
                <a href="{{ route('admin.register') }}" class="block px-4 py-2 text-gray-800 hover:bg-indigo-500 hover:text-white">団体さんに施設を掲載</a>
                @endauth
            </div>
        </div>

    </div>
</nav>