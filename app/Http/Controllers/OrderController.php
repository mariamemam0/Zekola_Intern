<?php

namespace App\Http\Controllers;

use App\Http\Requests\OrderRequest;
use App\Http\Resources\OrderCollection;
use App\Http\Resources\OrderResource;
use App\Models\Order;
use App\Models\Product;
use Illuminate\Http\Request;

class OrderController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $orders = Order::with('user', 'product')->paginate($this->paginate);
        if ($orders->isEmpty()) {
            return apiResponse(404, 'No Orders Found');
        }
        return apiResponse(200, 'Success', new OrderCollection($orders));
    }



    /**
     * Store a newly created resource in storage.
     */
    public function store(OrderRequest $request)
    {
        $product = Product::find($request->product_id);
        $order = Order::create([
            'user_id'     => $request->user_id,
            'product_id'  => $request->product_id,
            'quantity'    => $request->quantity,
        ]);

        return apiResponse(201, 'Order Created Successfully',
            new OrderResource($order->load('user', 'product'))
        );
    }

    /**
     * Display the specified resource.
     */
    public function show(Order $order)
    {
        return apiResponse(200, 'Success',
            new OrderResource($order->load('user', 'product'))
        );
    }


    /**
     * Update the specified resource in storage.
     */
    public function update(OrderRequest $request, Order $order)
    {
        $order->update([
            'quantity'    => $request->quantity,
        ]);
        return apiResponse(200, 'Updated Successfully',
            new OrderResource($order->load('user', 'product'))
        );
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Order $order)
    {
        $order->delete();
        return apiResponse(200, 'Deleted Successfully');
    }
}
