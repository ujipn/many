<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\Comment;
use Illuminate\Http\Request;

class OrderController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $query = Order::with('user')->latest();

        if ($request->has('search')) {
            $search = $request->get('search');
            $query->where('group_name', 'like', '%' . $search . '%')
                ->orWhere('order_purpose', 'like', '%' . $search . '%')
                ->orWhere('start_date', 'like', '%' . $search . '%')
                ->orWhere('end_date', 'like', '%' . $search . '%')
                ->orWhere('order_number', 'like', '%' . $search . '%')
                ->orWhere('order_budget', 'like', '%' . $search . '%')
                ->orWhere('order_area', 'like', '%' . $search . '%')
                ->orWhere('order_content', 'like', '%' . $search . '%');
        }

        $orders = $query->get();

        return view('orders.index', compact('orders'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('orders.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'group_name' => 'required|min:1|max:255',
            'order_purpose' => 'required|min:1|max:255',
            'start_date' => 'required',
            'end_date' => 'required',
            'order_number' => 'required | min:1 | max:20',
            'order_budget' => 'required',
            'order_area' => 'required|min:1|max:100',
            'order_content' => 'nullable|max:255',
        ]);

        $order = new Order;
        $order->user_id = auth()->id();
        $order->group_name = $request->group_name;
        $order->order_purpose = $request->order_purpose;
        $order->start_date = $request->start_date;
        $order->end_date = $request->end_date;
        $order->order_number = $request->order_number;
        $order->order_budget = $request->order_budget;
        $order->order_area = $request->order_area;
        $order->order_content = $request->order_content;
        $order->save();
        return redirect()->route('orders.index');
    }

    /**
     * Display the specified resource.
     */
    public function show(Order $order)
    {
        $comments = Comment::where('order_id', $order->id)->get();

        return view('orders.show', compact('order', 'comments'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Order $order)
    {
        return view('orders.edit', compact('order'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Order $order)
    {
        $request->validate([
            'accommodation_status' => 'required|in:confirmed,unconfirmed',
            'activity_status' => 'required|in:confirmed,unconfirmed',
            'content_status' => 'required|in:confirmed,unconfirmed',
        ]);

        $order->accommodation_status = $request->accommodation_status;
        $order->activity_status = $request->activity_status;
        $order->content_status = $request->content_status;
        $order->save();

        return redirect()->route('orders.show', $order);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Request $request)
    {
        //
    }

    public function updateDetails(Request $request, Order $order)
    {
        $request->validate([
            'group_name' => 'required|min:1|max:255',
            'order_purpose' => 'required|min:1|max:255',
            'start_date' => 'required',
            'end_date' => 'required',
            'order_number' => 'required | min:1 | max:20',
            'order_budget' => 'required',
            'order_area' => 'required|min:1|max:100',
            'order_content' => 'nullable|max:255',
        ]);

        $order->group_name = $request->group_name;
        $order->order_purpose = $request->order_purpose;
        $order->start_date = $request->start_date;
        $order->end_date = $request->end_date;
        $order->order_number = $request->order_number;
        $order->order_budget = $request->order_budget;
        $order->order_area = $request->order_area;
        $order->order_content = $request->order_content;
        $order->save();

        return redirect()->route('orders.show', $order);
    }
}
