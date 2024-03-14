<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Order;
use App\Models\OrderDetail;
use App\Models\Product;
use Auth;
use Illuminate\Http\Request;

class OrderController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $order = Order::all();
        $orderdetail = OrderDetail::all();
        if (!is_null($order)) {
            return response()->json([
                'Status' => true,
                'Order' => $order,
                'OrderDetail' => $orderdetail,

                'message' => 'Order Found'
            ], 200);
        } else {
            return response()->json(['message' => 'Order Not Found'], 400);
        }
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
        if ($request != null) {
            $user = Auth::id();
            $order = new Order();
            $order->user_id = $user;
            $order->fname = $request->fname;
            $order->lname = $request->lname;
            $order->email = $request->email;
            $order->address = $request->address;
            $order->country = $request->country;


            $product = $request->product_id;

            if ($order->save()) {
                $order_id = $order->id;
                $orderdetail = new OrderDetail;
                $orderdetail->order_id = $order_id;
                $orderdetail->product_id = $product;
                $orderdetail->quantity = $request->quantity;
                $orderdetail->price = $request->price;

                if ($orderdetail->save()) {
                    return response()->json([
                        'success' => true,
                        'order' => $order,
                        'orderdetail' => $orderdetail,
                        'message' => 'order added'
                    ], 200);
                } else {
                    return response()->json([
                        'success' => false,
                        'message' => 'something went wrong'
                    ], 200);
                }
            } else {
                return response()->json(['error' => 'order did not save'], 404);
            }
        }
    }


    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
