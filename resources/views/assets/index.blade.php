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
          <div class="-m-4">
            @foreach ($assets as $asset)
            <div class="flex">
              <!-- asset情報 -->
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
                <div class="flex">
                  <a href="{{ route('assets.show', $asset) }}" class="text-blue-500 hover:text-blue-700 mr-2">詳細を見る</a>
                  @if (auth()->id() == $asset->user_id)
                  
                    <a href="{{ route('assets.edit', $asset) }}" class="text-blue-500 hover:text-blue-700 mr-2">編集</a>
                    <form action="{{ route('assets.destroy', $asset) }}" method="POST" onsubmit="return confirm('本当に削除しますか？');">
                      @csrf
                      @method('DELETE')
                      <button type="submit" class="text-red-500 hover:text-red-700">削除</button>
                    </form>
                  
                  @endif
                </div>


              </div>
              <!-- 募集状況 -->
              <div class="p-4">
                <h1>募集状況:<a href="{{ route('calendars.create', ['asset_id' => $asset->id]) }}" class="text-blue-500 hover:text-blue-700 mr-2">募集する</a></h1>
                @foreach ($asset->calendars as $calendar)
                <div class="mb-4 p-4 bg-gray-100 dark:bg-gray-700 rounded-lg">
                  <p>募集ID: {{ $calendar->id }} 募集人数: {{ $calendar->reserve_number }}</p>
                  <p>募集日: {{ $calendar->start_date }} 終了日: {{ $calendar->end_date }}</p>
                  <p></p>
                  <div class="flex ">
                    <a href="{{ route('calendars.edit', ['asset_id' => $asset->id,'calendar_id' => $calendar->id]) }}" class="text-blue-500 hover:text-blue-700 mr-2">編集</a>
                    <form action="{{ route('calendars.destroy', $calendar) }}" method="POST" onsubmit="return confirm('本当に削除しますか？');">
                      @csrf
                      @method('DELETE')
                      <button type="submit" class="text-red-500 hover:text-red-700">削除</button>
                    </form>
                  </div>
                </div>



                @endforeach
              </div>
            </div>
            @endforeach
          </div>
        </div>
      </div>
    </div>
  </div>

</x-app-layout>