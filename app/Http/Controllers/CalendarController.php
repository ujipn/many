<?php

namespace App\Http\Controllers;

use App\Models\Calendar;
use Illuminate\Http\Request;
use App\Models\Asset;

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
    public function create($asset_id)
    {
        // アセットIDに基づいてアセットを取得
        $asset = Asset::find($asset_id);
        //
        return view('calendars.create', compact('asset'));//compact('asset')は、'asset' => $assetと同等で、$asset変数をビューに渡すための短縮形です。ビューでは、このデータを使用してユーザーに表示する内容を生成します。
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
        $calendar->reserve_number = $request->reserve_number;
        $calendar->save();

        // 入力ページにリダイレクト
        return redirect()->route('assets.index', ['asset' => $request->asset_id]);
    }

    /**
     * Display the specified resource.
     */
    public function show($calendar_id)//$calendar_idは、表示するカレンダーのIDを指定するためのパラメータ
    {
        
        $calendar = Calendar::find($calendar_id);// 指定されたIDを持つカレンダーをデータベースから検索し、その結果を$calendar変数に格納しています。
        $asset = Asset::find($calendar->asset_id); // $calendarオブジェクトのasset_idプロパティを使用して、関連するアセット（施設）をデータベースから検索し、その結果を$asset変数に格納しています。
  
        return view('calendars.show', ['calendar' => $calendar, 'asset' => $asset]); // ビューに渡す
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($asset_id, $calendar_id)
    {
        // アセットIDに基づいてアセットを取得
        $asset = Asset::find($asset_id);
        // カレンダーIDに基づいてカレンダーを取得
        $calendar = Calendar::find($calendar_id);
        return view('calendars.edit', compact('asset', 'calendar'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request,  $asset_id, $calendar_id)
    {
        // アセットIDとカレンダーIDに基づいてカレンダーを取得
        $calendar = Calendar::where('asset_id', $asset_id)->where('id', $calendar_id)->first();

        // リクエストデータでカレンダーを更新
        $calendar->start_date = $request->input('start_date');
        $calendar->end_date = $request->input('end_date');
        $calendar->reserve_number = $request->input('reserve_number');
        $calendar->save();

        return redirect()->route('assets.index', $asset_id);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Calendar $calendar)
    {
        //
        $calendar->delete();       //追加
        return redirect()->route('assets.index');
    }

    public function getEvents($asset_id)
    {   //イベントデータを取得する
        // アセットIDに基づいてカレンダーをフィルタリング
        $calendars = Calendar::with('user')->where('asset_id', $asset_id)->get();

        // カレンダーエントリを適切な形式に変換
        $events = $calendars->map(function ($calendar) {
            return [
                'title' => '空き◎',
                //$calendar->user->name, // ユーザー名をタイトルとして使用する場合
                'start' => $calendar->start_date,
                'end' => $calendar->end_date,
                'reserve_number' => $calendar->reserve_number,
                'calendarId' => $calendar->id, // カレンダーIDを追加
                'created_at' =>  $calendar->created_at->format('Y-m-d H:i:s'),
                'url'   =>  url('calendar/show/' . $calendar->id), // 予約のIDを持たせたURLを追加

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
