<?php

namespace App\Http\Controllers;

use App\Models\Calendar;
use Illuminate\Http\Request;

class CalendarController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
        return view('calendar');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $calendar = new Calendar;
        $calendar->user_id = auth()->id(); // 認証済みユーザーのIDを設定
        $calendar->asset_id = $request->asset_id; // リクエストからasset_idを取得
        $calendar->start_date = $request->start_date;
        $calendar->end_date = $request->end_date;
        $calendar->save();

        // 入力ページにリダイレクト
        return redirect()->route('assets.show', ['asset' => $request->asset_id]);
    }

    /**
     * Display the specified resource.
     */
    public function show(Calendar $calendar)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Calendar $calendar)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Calendar $calendar)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Calendar $calendar)
    {
        //
    }

    public function getEvents($asset_id)
    {
        // アセットIDに基づいてカレンダーをフィルタリング
        $calendars = Calendar::with('user')->where('asset_id', $asset_id)->get();

        // カレンダーエントリを適切な形式に変換
        $events = $calendars->map(function ($calendar) {
            return [
                'title' => $calendar->user->name, // ユーザー名をタイトルとして使用
                'start' => $calendar->start_date,
                'end' => $calendar->end_date,
                // [
                //     'title' => 'ディオ家',
                //     'description' => '人気の美容室予約取れた',
                //     'start' => '2024-03-10',
                //     'end'   => '2024-03-10',
                // ],
                // [
                //     'title' => 'ぽん家',
                //     'description' => '人気の旅館の予約が取れた',
                //     'start' => '2024-03-20 10:00:00',
                //     'end'   => '2024-03-22 18:00:00',
                //     'url'   => 'https://admin.juno-blog.site',
                // ],
                // [
                //     'title' => '団体',
                //     'start' => '2024-03-30',
                //     'color' => '#ff44cc',
                // ],
            ];
        });
        // 変換したイベントデータを返す
        return $events;
    }
}
