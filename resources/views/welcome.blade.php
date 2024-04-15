<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>団体さんいらっしゃい</title>
    <!-- Bootstrap CSS -->
    <!-- <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" rel="stylesheet"> -->
    <!-- jQuery -->
    <!-- <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js"></script> -->
    <!-- Bootstrap JS -->
    <!-- <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.bundle.min.js"></script>
    <script src='https://cdn.jsdelivr.net/npm/fullcalendar@6.1.11/index.global.min.js'></script> -->
    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,600&display=swap" rel="stylesheet" />
    <script src="https://kit.fontawesome.com/9c33f0ed37.js" crossorigin="anonymous"></script>

    @vite(['resources/css/app.css', 'resources/js/app.js'])


</head>

<body class="antialiased">

    @include('layouts.top')
    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
        <div class="">
            <div class="flex flex-col sm:flex-row p-4 text-gray-900 dark:text-gray-100">
                <form method="GET" action="{{ route('home') }}" class="flex flex-col sm:flex-row w-full">
                    <input type="text" name="search" placeholder="キーワードを入力" class="shadow appearance-none border rounded w-full sm:w-1/4 py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline mb-2 sm:mb-0">
                    <div class="flex justify-between sm:justify-start ml-0 sm:ml-4 w-full sm:w-auto">
                        <button type="submit" class="inline-block px-2 py-2 text-black text-center rounded ml-2">
                            <i class="fas fa-search"></i> 検索
                        </button>
                        <a href="{{ route('home') }}" class="inline-block px-2 py-2 bg-white-500 text-black text-center rounded ml-2">
                            <i class="fas fa-times"></i> クリア
                        </a>
                    </div>
                </form>
            </div>
        </div>
    </div>


    <!-- 施設情報を以下に掲載 -->
    <div class="py-2">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800  shadow-sm sm:rounded-lg ">
                <div class="p-4 text-gray-900 dark:text-gray-100">
                    <div class="flex flex-wrap -mx-4">
                        <!-- 全体のコンテナにflexとflex-wrapクラスを追加して、子要素がフレックスボックスのアイテムとして動作し、必要に応じて折り返すようにしています。 -->
                        @foreach ($assets as $asset)
                        <div class="p-4 w-full sm:w-1/2 md:w-1/3 lg:w-1/3 xl:w-1/3">
                            <div class="bg-gray-100 dark:bg-gray-700 rounded-lg overflow-hidden">
                                <p class="text-gray-800 dark:text-gray-300">{{ $asset->asset }}</p>
                                @if ($asset->image)
                                <img src="{{ Storage::url($asset->image) }}" alt="Asset Image" class="mt-2 w-full h-40 object-cover"> <!-- 画像を表示 -->
                                @endif
                                <div class="p-4">
                                    <h1 class="text-gray-600 dark:text-gray-400 text-sm font-medium">{{ $asset->asset_title }}</h1>
                                    <p class="text-gray-600 dark:text-gray-400 text-sm font-medium">施設名: {{ $asset->asset_name }}</p>
                                    <p class="text-gray-600 dark:text-gray-400 text-sm ">所在地: {{ $asset->asset_area }}</p>
                                    <p class="text-gray-600 dark:text-gray-400 text-sm">収容人数: {{ number_format($asset->asset_number) }}人</p>
                                    <p class="text-gray-600 dark:text-gray-400 text-sm">金額: {{ number_format($asset->asset_amount) }}円(1人あたり{{ number_format($asset->asset_amount / $asset->asset_number) }}円)</p>
                                    <div class="text-left">
                                        <a href="{{ route('assets.show', $asset) }}" class="inline-block px-4 py-2 bg-pink-500 text-white text-center rounded">詳細を見る</a>
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