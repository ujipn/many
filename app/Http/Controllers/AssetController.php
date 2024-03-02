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
        $assets = Asset::with('user')->where('user_id', auth()->id())->latest()->get();
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
            'asset_name' => 'required|min:1|max:255',
            'asset_area' => 'required|min:1|max:10',
            'asset_number' => 'required | min:1 | max:20',
            'asset_amount' => 'required',
            'published'   => 'required',
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
        $assets->asset_name   = $request->asset_name;
        $assets->asset_area   = $request->asset_area;
        $assets->asset_number = $request->asset_number;
        $assets->asset_amount = $request->asset_amount;
        $assets->published   = $request->published;
        $assets->image = $imagePath; // 画像のパスを保存
        $assets->save();

        return redirect()->route('assets.index');
    }

    /**
     * Display the specified resource.
     */
    public function show(Asset $asset)
    {
        return view('assets.show', compact('asset'));
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
        //
        if ($asset->user_id != auth()->id()) {
            // このAssetは現在認証されているユーザーのものではないため、更新を許可しない
            return redirect()->route('assets.index');
        }
        //
        $request->validate([
            'asset_name' => 'required|min:1|max:255',
            'asset_area' => 'required|min:1|max:10',
            'asset_number' => 'required | min:1 | max:20',
            'asset_amount' => 'required',
            'published'   => 'required',
            'image' => 'nullable|image', // 画像のバリデーションルールを追加
        ]);

        // 画像がアップロードされた場合のみ、新しい画像を保存
        if ($request->hasFile('image')) {
            $imagePath = $request->file('image')->store('images', 'public');
            $asset->image = $imagePath;
        } else {
            $imagePath = $asset->image;
        }

        $asset->update($request->only('asset_name', 'asset_area', 'asset_number', 'asset_amount', 'published'));

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
