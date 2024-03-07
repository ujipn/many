<?php

namespace App\Http\Controllers;
use App\Models\Asset;
use Illuminate\Http\Request;

class WelcomeController extends Controller
{
    public function index()
    {
        $assets = Asset::all();
        return view('welcome', ['assets' => $assets]);
    }

}

//このWelcomeControllerのindexメソッドでは、Asset::all()を使用してデータベースからすべてのアセットを取得しています。そして、取得したアセットをwelcomeビューに渡しています。
//return view('welcome', ['assets' => $assets]);の部分では、welcomeビューを表示するとともに、$assetsという変数をビューに渡しています。この$assets変数は、ビュー内で使用でき、アセットのリストを表示するために使用されます。
