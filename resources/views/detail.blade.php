<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('施設詳細') }}
        </h2>
        <button type="submit" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline">予約手続きへ</button>
        <button type="submit" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline">施設に相談</button>
        <button type="submit" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline">候補に追加</button>

    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">
                    <a href="{{ route('assets.index') }}" class="text-blue-500 hover:text-blue-700 mr-2">一覧に戻る</a>
                    <p class="text-gray-800 dark:text-gray-300 text-lg">{{ $asset->asset }}</p>
                    @if ($asset->image)
                    <img src="{{ Storage::url($asset->image) }}" alt="Asset Image" class="mt-2 rounded"> <!-- 画像を表示 -->
                    @endif
                    <h1>！タイトル100文字以内</h1>
                    <h2 class="text-gray-600 dark:text-gray-400 text-sm">！利用者評価：＊＊点</h2>
                    <h2 class="text-gray-600 dark:text-gray-400 text-sm">！利用者レビュー：＊＊件</h2>
                    <a href="{{ route('profile.edit') }}" class="text-blue-500 hover:text-blue-700 mr-2">！施設オーナー：{{ $asset->user->name }}さん</a>
                    <p class="text-gray-600 dark:text-gray-400 text-sm">施設名: {{ $asset->asset_name }}</p>
                    <p class="text-gray-600 dark:text-gray-400 text-sm">所在地: {{ $asset->asset_area }}</p>
                    <p class="text-gray-600 dark:text-gray-400 text-sm">所要人数: {{ $asset->asset_number }}</p>
                    <p class="text-gray-600 dark:text-gray-400 text-sm">金額: {{ $asset->asset_amount }}円</p>
                    <div class="text-gray-600 dark:text-gray-400 text-sm">
                        <p>投稿日時: {{ $asset->created_at->format('Y-m-d H:i') }}</p>
                        <p>更新日時: {{ $asset->updated_at->format('Y-m-d H:i') }}</p>
                    </div>
                    @if (auth()->id() == $asset->user_id)
                    <div class="flex mt-4">
                        <a href="{{ route('assets.edit', $asset) }}" class="text-blue-500 hover:text-blue-700 mr-2">編集</a>
                        <form action="{{ route('assets.destroy', $asset) }}" method="POST" onsubmit="return confirm('本当に削除しますか？');">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="text-red-500 hover:text-red-700">削除</button>
                        </form>
                    </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
</x-app-layout>