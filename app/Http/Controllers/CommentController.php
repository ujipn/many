<?php

namespace App\Http\Controllers;

use App\Models\Comment;
use App\Models\Order;
use Illuminate\Http\Request;


/**
 * Display a listing of the resource.
 */
class CommentController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index($order_id)
    {
        $order = Order::find($order_id);
        $comments = Comment::where('order_id', $order_id)->get();

        return view('comments.index', compact('order', 'comments'));
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
    public function store(Request $request, Order $order)
    {
        $request->validate([
            'content' => 'required',
        ]);

        $comment = new Comment($request->all());
        $comment->user_id = $request->user()->id;
        $order->comments()->save($comment);

        return back();
    }

    /**
     * Display the specified resource.
     */
    public function show(Comment $comment)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Comment $comment)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Comment $comment)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Comment $comment)
    {
        $comment->delete();

        return back();
    }
}
