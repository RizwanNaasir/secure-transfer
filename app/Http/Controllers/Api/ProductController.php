<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;

class ProductController extends Controller
{

    public function allProducts()
    {
        return $this->success([
            'products' => Product::search(\request()->get('search'))->get()
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

    public function productDetail(Product $product)
    {
        return $this->success([
            'product' => $product
        ]);
    }

    public function updateProduct(Request $request)
    {
        $data = $request->validate([
            'name' => 'required',
            'price' => 'required',
            'image' => 'required',
            'description' => 'required',
        ]);
        if (filled($data)) {
            $products = Product::query()->find($request->input('id'));
            if (filled($products)) {
                $products->image = $request->file('image')->store('public');
                $products->user_id = $request->user()->id;
                $products->name = $request->input('name');
                $products->price = $request->input('price');
                $products->description = $request->input('description');
                $products->update();
                return $this->success(message: 'Product Updated Successfully');
            } else {
                return $this->notFound([]);
            }
        }
    }

    public function destroy(Product $product)
    {
        $product->delete();

        return $this->success(message: 'Product Deleted Successfully');
    }

    public function search_product(Request $request)
    {
        $product = $request->input('name');
        $product_search = Product::query()->where('name', 'LIKE', "%$product%")->get();
        if ($product_search->isNotEmpty()) {
            return $this->success(
                data: [
                    'product' => $product_search
                ]
            );
        } else {
            return $this->notFound(
                data: [
                    'product' => []
                ],
                message: 'Product Not Found',
            );
        }

    }

    public function myProducts()
    {
        return $this->success([
            'product' => auth()->user()->products
        ]);
    }

    protected function addProduct(Request $request)
    {
        $data = $request->validate([
            'name' => 'required',
            'price' => 'required',
            'image' => 'required',
            'description' => 'required',
        ]);

        if (filled($data)) {

            $products = new Product();

            if ($request->hasFile('image')) {
                $products->image = $request->file('image')->store('public');
                $products->user_id = $request->user()->id;
                $products->name = $request->input('name');
                $products->price = $request->input('price');
                $products->description = $request->input('description');
                $products->save();

                return $this->success(message: 'Product Added Successfully');
            }
        }
    }


}
