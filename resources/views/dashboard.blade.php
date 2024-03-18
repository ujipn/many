<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
        ようこそ、{{ Auth::user()->name }}さん！
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100 border-b">
                ►掲載中の施設は、{{ Auth::user()->assets()->count() }}件です。
                </div>
                <div class="p-6 text-gray-900 dark:text-gray-100 border-b">
                ►予約募集中の案件は、{{ Auth::user()->calendars()->count() }}件です。
                </div>
                <div class="p-6 text-gray-900 dark:text-gray-100">
                ►予約手続き中の案件は、{{ Auth::user()->transactions()->count() }}件です。
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
