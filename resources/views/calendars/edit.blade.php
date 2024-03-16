<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('募集編集') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">
                    <a href="{{ route('assets.index', $asset) }}" class="text-blue-500 hover:text-blue-700 mr-2">一覧に戻る</a>
                    <form method="POST" action="{{ route('calendars.update', ['asset_id' => $asset->id, 'calendar_id' => $calendar->id]) }}">
                        @csrf
                        @method('PUT')
                        <div class="mb-4">
                            <input type="hidden" name="asset_id" value="{{ $asset->id }}">
                            <!-- 募集日 -->
                            <div class="mb-4">
                                <label class="block text-gray-700 dark:text-gray-300 text-sm font-bold mb-2">募集日</label>
                                <input type="date" name="start_date" value="{{ $calendar->start_date }}" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 dark:text-gray-300 dark:bg-gray-700 leading-tight focus:outline-none focus:shadow-outline">
                            </div>
                            <!-- 募集終了日 -->
                            <div class="mb-4">
                                <label class="block text-gray-700 dark:text-gray-300 text-sm font-bold mb-2">募集終了日</label>
                                <input type="date" name="end_date" value="{{ $calendar->end_date }}" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 dark:text-gray-300 dark:bg-gray-700 leading-tight focus:outline-none focus:shadow-outline">
                            </div>
                            <!-- 募集人数 -->
                            <div class="mb-4">
                                <label class="block text-gray-700 dark:text-gray-300 text-sm font-bold mb-2">募集人数</label>
                                <input type="text" name="reserve_number" value="{{ $calendar->reserve_number }}" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 dark:text-gray-300 dark:bg-gray-700 leading-tight focus:outline-none focus:shadow-outline">
                            </div>

                            @error('asset')
                            <span class="text-red-500 text-xs italic">{{ $message }}</span>
                            @enderror
                        </div>
                        <button type="submit" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline">更新する</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>