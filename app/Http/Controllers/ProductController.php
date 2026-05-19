<?php

namespace App\Http\Controllers;

use App\Http\Requests\ProductRequest;
use App\Http\Resources\ProductCollection;
use App\Http\Resources\ProductResource;
use App\Models\Product;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $products = Product::select('id', 'name', 'price', 'description')
            ->paginate($this->paginate);
        if ($products->isEmpty()) {
            return apiResponse(404, 'No Products Found');
        }
        return apiResponse(200, 'Success', new ProductCollection($products));
    }



    /**
     * Store a newly created resource in storage.
     */

    public function store(ProductRequest $request)
    {
        $product = Product::create($request->validated());
        if (!$product) {
            return apiResponse(400, 'Try Again');
        }
        return apiResponse(201, 'Created Successfully', new ProductResource($product));
    }

    /**
     * Display the specified resource.
     */
    public function show(Product $product)
    {
        return apiResponse(200, 'Success', new ProductResource($product));
    }


    /**
     * Update the specified resource in storage.
     */
    public function update(ProductRequest $request, Product $product)
    {
        $product->update($request->validated());
        return apiResponse(200, 'Updated Successfully', new ProductResource($product));
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Product $product)
    {
        $product->delete();
        return apiResponse(200, 'Deleted Successfully');
    }
}
