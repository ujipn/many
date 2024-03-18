<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Illuminate\Http\Request;
use App\Models\Transaction;

class PostController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index($transaction_id)
    {
        $transaction = Transaction::find($transaction_id);
        $posts = Post::where('transaction_id', $transaction_id)->get();
    
        return view('posts.index', compact('transaction', 'posts'));

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
    public function store(Request $request, $transaction_id)
    {
        $request->validate([
            'content' => 'required',
        ]);
    
        $post = new Post;
        $post->user_id = auth()->id();
        $post->transaction_id = $transaction_id;
        $post->content = $request->content;
        $post->save();
    
        return back();
    }

    /**
     * Display the specified resource.
     */
    public function show(Post $post)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Post $post)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Post $post)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Post $post)
    {
        $calendar_id = $post->transaction->calendar_id;
        $post->delete();       
        return redirect()->route('transaction.index', ['calendar_id' => $calendar_id]);
    }
}
