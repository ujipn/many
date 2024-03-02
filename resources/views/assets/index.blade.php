<x-app-layout>
  <x-slot name="header">
    <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
      {{ __('施設一覧') }}
    </h2>
  </x-slot>

  <div class="py-12">
    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
      <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
        <div class="p-6 text-gray-900 dark:text-gray-100">
          @foreach ($assets as $asset)
          <div class="mb-4 p-4 bg-gray-100 dark:bg-gray-700 rounded-lg">
            <p class="text-gray-800 dark:text-gray-300">{{ $asset->asset }}</p>
            @if ($asset->image)
            <img src="{{ Storage::url($asset->image) }}" alt="Asset Image" class="mt-2 rounded" style="max-width: 300px; max-height: 200px; object-fit: cover;"> <!-- 画像を表示 -->
            @endif
            <!-- <p class="text-gray-600 dark:text-gray-400 text-sm">施設オーナー: {{ $asset->user->name }}</p> -->
            <p class="text-gray-600 dark:text-gray-400 text-sm">施設名: {{ $asset->asset_name }}</p>
            <p class="text-gray-600 dark:text-gray-400 text-sm">所在地: {{ $asset->asset_area }}</p>
            <p class="text-gray-600 dark:text-gray-400 text-sm">収容人数: {{ $asset->asset_number }}人</p>
            <p class="text-gray-600 dark:text-gray-400 text-sm">金額: {{ $asset->asset_amount }}円</p>

            <a href="{{ route('assets.show', $asset) }}" class="text-blue-500 hover:text-blue-700">詳細を見る</a>
          </div>
          @endforeach
        </div>
      </div>
    </div>
  </div>

</x-app-layout>