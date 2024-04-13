<?php

namespace App\Http\Controllers;

use App\Models\Talk;
use App\Models\Asset;
use Illuminate\Http\Request;

class TalkController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index($asset_id)
    {
        $asset = Asset::find($asset_id);
        $talks = Talk::where('asset_id', $asset_id)->get();

        return view('talks.index', compact('asset', 'talks'));
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
    public function store(Request $request, Asset $asset)
    {
        $request->validate([
            'content' => 'required',
        ]);

        $talk = new Talk($request->all());
        $talk->user_id = $request->user()->id;
        $asset->talks()->save($talk);

        return back();
    }


    /**
     * Display the specified resource.
     */
    public function show(Talk $talk)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Talk $talk)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Talk $talk)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Talk $talk)
    {
        $talk->delete();

        return back();
    }
}
