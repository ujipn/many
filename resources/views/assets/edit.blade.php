<x-app-layout>
  <x-slot name="header">
    <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
      {{ __('施設編集') }}
    </h2>
  </x-slot>

  <div class="py-12">
    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
      <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
        <div class="p-6 text-gray-900 dark:text-gray-100">
          <a href="{{ route('assets.index', $asset) }}" class="inline-flex items-center px-4 py-2 bg-gray-800 dark:bg-gray-200 border border-transparent rounded-md font-semibold text-xs text-white dark:text-gray-800 uppercase tracking-widest hover:bg-gray-700 dark:hover:bg-white focus:bg-gray-700 dark:focus:bg-white active:bg-gray-900 dark:active:bg-gray-300 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 dark:focus:ring-offset-gray-800 transition ease-in-out duration-150">一覧に戻る</a>
          <form method="POST" action="{{ route('assets.update', $asset) }}" enctype="multipart/form-data">
            @csrf
            @method('PUT')
            <div class="mb-4">
              <p class="text-gray-600 dark:text-gray-400 text-sm">施設オーナー: {{ $asset->user->name }}</p>
              <!-- <label class="block text-gray-700 dark:text-gray-300 text-sm font-bold mb-2">画像</label> -->
              @if($asset->image)
              <img src="{{ Storage::url($asset->image) }}" alt="Asset Image" class="mb-4">
              @endif

              <input type="file" name="image" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 dark:text-gray-300 dark:bg-gray-700 leading-tight focus:outline-none focus:shadow-outline  mb-2">
              <label class="block text-gray-700 dark:text-gray-300 text-sm font-bold mb-2">タイトル</label>
              <input type="text" name="asset_title" value="{{ $asset->asset_title }}" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 dark:text-gray-300 dark:bg-gray-700 leading-tight focus:outline-none focus:shadow-outline  mb-2">

              <label class="block text-gray-700 dark:text-gray-300 text-sm font-bold mb-2">施設名</label>
              <input type="text" name="asset_name" value="{{ $asset->asset_name }}" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 dark:text-gray-300 dark:bg-gray-700 leading-tight focus:outline-none focus:shadow-outline  mb-2">
              <label class="block text-gray-700 dark:text-gray-300 text-sm font-bold mb-2">所在地</label>

              <input type="text" name="asset_area" value="{{ $asset->asset_area }}" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 dark:text-gray-300 dark:bg-gray-700 leading-tight focus:outline-none focus:shadow-outline  mb-2">
              <label class="block text-gray-700 dark:text-gray-300 text-sm font-bold mb-2">収容人数</label>

              <input type="text" name="asset_number" value="{{ $asset->asset_number }}" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 dark:text-gray-300 dark:bg-gray-700 leading-tight focus:outline-none focus:shadow-outline  mb-2">
              <label class="block text-gray-700 dark:text-gray-300 text-sm font-bold mb-2">値段</label>

              <input type="text" name="asset_amount" value="{{ $asset->asset_amount }}" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 dark:text-gray-300 dark:bg-gray-700 leading-tight focus:outline-none focus:shadow-outline  mb-2">
              <label class="block text-gray-700 dark:text-gray-300 text-sm font-bold mb-2">施設情報（任意）</label>
              <textarea name="introduction" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 dark:text-gray-300 dark:bg-gray-700 leading-tight focus:outline-none focus:shadow-outline  mb-2">{{ $asset->introduction }}</textarea>

              @error('asset')
              <span class="text-red-500 text-xs italic">{{ $message }}</span>
              @enderror
            </div>
            <button type="submit" class="inline-flex items-center px-4 py-2 bg-gray-800 dark:bg-gray-200 border border-transparent rounded-md font-semibold text-xs text-white dark:text-gray-800 uppercase tracking-widest hover:bg-gray-700 dark:hover:bg-white focus:bg-gray-700 dark:focus:bg-white active:bg-gray-900 dark:active:bg-gray-300 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 dark:focus:ring-offset-gray-800 transition ease-in-out duration-150">更新する</button>
          </form>
        </div>
      </div>
    </div>
  </div>
</x-app-layout>