<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Product;
use App\Models\User;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class ProductController extends Controller
{
    public function allProducts()
    {
        $products = Product::select('id', 'name', 'image', 'price', 'description')->get();
        return $this->success([
            'products' => $products
        ]);
    }

    public function product(Request $request)
    {
        $data = $request->user()->products()->select('name', 'image', 'price', 'description')->get();
        return $this->success([
            'product' => $data->each(function ($product) {
                return $product;
            })
        ]);

    }

    public function productDetail(Request $request, $id)
    {
        if (Product::query()->where('id', $id)->exists()) {
            $proDetail = Product::whereId($id)->first();
            return $this->success(
                $proDetail
            );

        } else {
            response(status: 404);
            return [
                'status' => 404,
                'data' => 'product does not exist'
            ];

        }

    }

    public function updateProduct(Request $request)
    {
//        dd($request->input('product_id'));
        $product = Product::query()->findOrFail($request->input('product_id'));
        $data = $request->validate([
            'name' => 'required',
            'price' => 'required',
            'image' => 'required',
            'description' => 'required',
        ]);
        if (filled($data)) {
            $product->update([
                'name' => $request->input('name'),
                'price' => $request->input('price'),
                'image' => '/products/' . $request->input('filepond'),
                'description' => $request->input('description'),
            ]);

            return $this->success(message: 'product updated successfully');
        }
    }

    public function edit($id)
    {
        //
    }

    public function update(Request $request, $id)
    {
        //
    }

    public function destroy($id)
    {
        //
    }
}
