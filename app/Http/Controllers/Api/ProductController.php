<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Product;
use App\Models\User;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Validator;
use Symfony\Component\HttpFoundation\Response;
use function Symfony\Component\String\s;

class ProductController extends Controller
{

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

    public function allProducts()
    {
        $products = Product::select('id', 'name', 'image', 'price', 'description')->get();

        return $this->success([
            'products' => $products
        ]);
    }

    public
    function product(Request $request)
    {
        $data = $request->user()->products()->select('name', 'image', 'price', 'description')->get();
        return $this->success([
            'product' => $data->each(function ($product) {
                return $product;
            })
        ]);

    }

    public
    function productDetail(Request $request, $id)
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

    public
    function updateProduct(Request $request)
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


    public function destroy(Request $request, $id)
    {
        $products = Product::findOrFail($id);
        if ($products->image) {
            $path = '/' . $products->image;
            if (File::exists($path)) {
                File::delete($path);
            }
        }
        $products->delete();

        return $this->success(message: 'Product Deleted Successfully');
    }

    public function search_product(Request $request)
    {
        $product = $request->input('name');
        $product_search = Product::query()->where('name','LIKE',"%$product%")->get();
        if($product_search->isNotEmpty()){
        return $this->success(
            data: [
                'product' => $product_search
            ]
        );
        }
        else{
            return $this->notFound(
                data: [
                    'product' => []
                ],
                message: 'Product Not Found',
            );
        }

    }


}
