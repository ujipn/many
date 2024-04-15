<?php

namespace App\Http\Controllers;

use App\Models\Asset;
use Illuminate\Http\Request;

class AssetController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //Assetの一覧を表示する。全件を新しい順に取得するために latest メソッドを使用する．また，asset に関連するユーザ情報を取得するために with メソッドを使用する
        $assets = Asset::with('user', 'calendars')->where('user_id', auth()->id())->latest()->get();
        return view('assets.index', compact('assets'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
        return view('assets.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
        $request->validate([
            'asset_title' => 'required|min:1|max:255',
            'asset_name' => 'required|min:1|max:255',
            'asset_area' => 'required|min:1|max:100',
            'asset_number' => 'required | min:1 | max:20',
            'asset_amount' => 'required',
            'introduction' => 'nullable|max:1000', // 施設情報のバリデーションルールを追加
            'image' => 'nullable|image', // 画像のバリデーションルールを追加
        ]);

        // 画像をストレージに保存し、そのパスを取得
        $imagePath = null;
        if ($request->hasFile('image')) {
            $imagePath = $request->file('image')->store('images', 'public');
        }
        // Eloquentモデル
        $assets = new Asset;
        $assets->user_id = auth()->id();
        $assets->asset_title   = $request->asset_title;
        $assets->asset_name   = $request->asset_name;
        $assets->asset_area   = $request->asset_area;
        $assets->asset_number = $request->asset_number;
        $assets->asset_amount = $request->asset_amount;
        $assets->image = $imagePath; // 画像のパスを保存
        $assets->introduction = $request->introduction; // 施設情報を保存
        $assets->save();

        return redirect()->route('assets.index');
    }

    /**
     * Display the specified resource.
     */
    public function show(Asset $asset)
    {

        $talks = $asset->talks; // talksを取得
        return view('assets.show', compact('asset', 'talks')); // talksをビューに渡す
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Asset $asset)
    {
        //
        return view('assets.edit', compact('asset'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Asset $asset)
    {
        if ($asset->user_id != auth()->id()) {
            return redirect()->route('assets.index');
        }

        $request->validate([
            'asset_title' => 'required|min:1|max:255',
            'asset_name' => 'required|min:1|max:255',
            'asset_area' => 'required|min:1|max:100',
            'asset_number' => 'required | min:1 | max:20',
            'asset_amount' => 'required',
            'introduction' => 'nullable|max:1000',
            'image' => 'nullable|image',
        ]);

        if ($request->hasFile('image')) {
            $imagePath = $request->file('image')->store('images', 'public');
            $asset->image = $imagePath;
        }

        $asset->introduction = $request->introduction;

        $asset->update($request->only('asset_title', 'asset_name', 'asset_area', 'asset_number', 'asset_amount'));

        $asset->save(); 

        return redirect()->route('assets.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Asset $asset)
    {
        //
        $asset->delete();       //追加
        return redirect()->route('assets.index');
    }
}
