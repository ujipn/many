<x-app-layout>
  <x-slot name="header">
    <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
      {{ __('募集作成') }}
    </h2>
  </x-slot>

            <div class="py-4">
                <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                    <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                        <div class="p-6 text-gray-900 dark:text-gray-100">
                            <!-- アセットのIDを紐付けた状態で、データストアにPOST -->
                            <form method="POST" action="{{ route('calendars.store', ['asset_id' => $asset->id]) }}">
                                @csrf

                                <input type="hidden" name="asset_id" value="{{ $asset->id }}">
                                <div class="mb-4">
                                    <!-- 募集日 -->
                                    <label class="block text-gray-700 dark:text-gray-300 text-sm font-bold mb-2">募集日</label>
                                    <input type="date" name="start_date" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 dark:text-gray-300 dark:bg-gray-700 leading-tight focus:outline-none focus:shadow-outline">
                                </div>
                                <!-- <div class="mb-4"> -->
                                    <!-- 募集終了日 -->
                                    <!-- <label class="block text-gray-700 dark:text-gray-300 text-sm font-bold mb-2">募集終了日</label>
                                    <input type="date" name="end_date" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 dark:text-gray-300 dark:bg-gray-700 leading-tight focus:outline-none focus:shadow-outline"> -->
                                <!-- </div> -->
                                     <!-- 募集人数 -->
                                <div class="mb-4">
                                    <label class="block text-gray-700 dark:text-gray-300 text-sm font-bold mb-2">募集人数</label>
                                    <input type="text" name="reserve_number" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 dark:text-gray-300 dark:bg-gray-700 leading-tight focus:outline-none focus:shadow-outline">
                                </div>



                                <button type="submit" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline">募集する</button>

                            </form>
                        </div>
                    </div>
                </div>
            </div>

</x-app-layout>
