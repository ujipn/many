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
          <div class="flex flex-wrap -mx-4 mb-8 border-b">

            <!-- asset情報 -->
            <div class="mb-4 p-4 md:w-1/2 lg:w-1/3 xl:w-1/4 px-4">
              <div class="bg-gray-100 dark:bg-gray-700 rounded-lg overflow-hidden">
                <p class="text-gray-800 dark:text-gray-300">{{ $asset->asset }}</p>
                @if ($asset->image)
                <img src="{{ Storage::url($asset->image) }}" alt="Asset Image" class="mt-2 w-full h-40 object-cover"> <!-- 画像を表示 -->
                @endif
                <p class="text-gray-600 dark:text-gray-400 text-sm">施設名: {{ $asset->asset_name }}</p>
                <p class="text-gray-600 dark:text-gray-400 text-sm">所在地: {{ $asset->asset_area }}</p>
                <p class="text-gray-600 dark:text-gray-400 text-sm">収容人数: {{ number_format($asset->asset_number) }}人</p>
                <p class="text-gray-600 dark:text-gray-400 text-sm">金額: {{ number_format($asset->asset_amount) }}円</p>

                <div class="flex justify-between items-center mt-4 mr-2">
                  <a href="{{ route('assets.show', $asset) }}" class="inline-flex items-center px-4 py-2 bg-pink-500 dark:bg-pink-700 border border-transparent rounded-md font-semibold text-xs text-white dark:text-gray-800 uppercase tracking-widest hover:bg-pink-400 dark:hover:bg-pink-600 focus:bg-pink-400 dark:focus:bg-pink-600 active:bg-pink-600 dark:active:bg-pink-800 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 dark:focus:ring-offset-gray-800 transition ease-in-out duration-150">詳細を見る</a>
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

            <!-- 募集状況 -->
            <div class="p-4 md:w-1/2 lg:w-2/3 xl:w-3/4 px-4 border-b">
              <div class="bg-gray-100 dark:bg-gray-700 rounded-lg overflow-hidden ">
                <h1 class="px-3 py-2 text-lg leading-6 font-medium text-gray-900 dark:text-gray-100">募集状況</h1>
                @foreach ($asset->calendars as $calendar)
                <div class="mb-4 p-4">
                  <p class="text-sm text-gray-600 dark:text-gray-400">募集ID: {{ $calendar->id }} 募集人数: {{ $calendar->reserve_number }}</p>
                  <p class="text-sm text-gray-600 dark:text-gray-400">募集日: {{ \Carbon\Carbon::parse($calendar->start_date)->format('Y-m-d') }}</p>
                  <div class="flex justify-start mt-4">
                    <a href="{{ route('calendars.edit', ['asset_id' => $asset->id,'calendar_id' => $calendar->id]) }}" class="mr-2">
                      <i class="fas fa-edit text-blue-500 hover:text-blue-700"></i>
                    </a>
                    <form action="{{ route('calendars.destroy', $calendar) }}" method="POST" onsubmit="return confirm('本当に削除しますか？');">
                      @csrf
                      @method('DELETE')
                      <button type="submit" class="text-red-500 hover:text-red-700">
                        <i class="fas fa-trash"></i>
                      </button>
                    </form>
                  </div>

                </div>
                @endforeach

              </div>
              <div class="mt-4">
                <a href="{{ route('calendars.create', ['asset_id' => $asset->id]) }}" class="inline-flex items-center px-4 py-2 bg-gray-800 dark:bg-gray-200 border border-transparent rounded-md font-semibold text-xs text-white dark:text-gray-800 uppercase tracking-widest hover:bg-gray-700 dark:hover:bg-white focus:bg-gray-700 dark:focus:bg-white active:bg-gray-900 dark:active:bg-gray-300 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 dark:focus:ring-offset-gray-800 transition ease-in-out duration-150">募集する</a>
              </div>
            </div>

          </div>
          @endforeach
        </div>
      </div>
    </div>
  </div>


</x-app-layout>