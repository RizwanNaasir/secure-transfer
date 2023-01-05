<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\Api\ProductContractRequest;
use App\Models\Product;
use App\Models\User;
use App\Services\ContractService;
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

        $product = Product::findOrFail($request->input('product_id'));

        if (filled($request->input('name'))) {
            $product->name = $request->input('name');
        }
        if (filled($request->input('price'))) {
            $product->price = $request->input('price');
        }
        if (filled($request->input('description'))) {
            $product->description = $request->input('description');
        }
        if ($request->hasFile('image')) {
            $product->image = $request->file('image')->store('public');
        }

        $product->save();

        return $this->success(message: 'Product Updated Successfully');
    }

    public function destroy(Product $product)
    {
        $deleted = $product->delete();
        info($deleted);

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

    public function makeContract(ProductContractRequest $request)
    {
        $product = Product::query()->findOrFail($request->validated('product_id'));
        $QRCode = ContractService::create(
            $this->getFormattedData($product,$request),
            \request()->user(),
            $product
        );
        try {
            return $this->success(
                data: [
                    'qr_code' => $QRCode->toHtml()
                ],
                message: 'Contract sent successfully'
            );
        } catch (\Exception $e) {
            return $this->error($e->getMessage(), 400);
        }
    }
    public function getFormattedData($product,$request): array
    {
        return [
            'email' => $product->user->email,
            'amount' => $product->price,
            'description' => $product->description,
            'file' => $product->image,
            'preferred_payment_method' => $request->validated('preferred_payment_method'),
        ];
    }

}
