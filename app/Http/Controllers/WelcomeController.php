<?php

namespace App\Http\Controllers;
use App\Models\Asset;
use Illuminate\Http\Request;

class WelcomeController extends Controller
{
    public function index(Request $request)
{
    $search = $request->input('search');

    $assets = Asset::query()
        ->where('asset_name', 'LIKE', "%{$search}%")
        ->orWhere('asset_area', 'LIKE', "%{$search}%")
        ->get();

    return view('welcome', ['assets' => $assets]);
}

}

//このWelcomeControllerのindexメソッドでは、Asset::all()を使用してデータベースからすべてのアセットを取得しています。そして、取得したアセットをwelcomeビューに渡しています。
//return view('welcome', ['assets' => $assets]);の部分では、welcomeビューを表示するとともに、$assetsという変数をビューに渡しています。この$assets変数は、ビュー内で使用でき、アセットのリストを表示するために使用されます。

//検索フォームから送信されたキーワードを使用して、asset_nameまたはasset_areaがキーワードを含むAssetモデルのインスタンス（施設）を検索します。検索結果は、welcomeビューに渡され、そのビューで表示されます。