<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\Api\ProductContractRequest;
use App\Models\Product;
use App\Services\ContractService;
use Illuminate\Http\Request;
use Spatie\MediaLibrary\MediaCollections\Exceptions\FileDoesNotExist;
use Spatie\MediaLibrary\MediaCollections\Exceptions\FileIsTooBig;

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
            try {
                $product->addMedia($request->file('image'))
                    ->toMediaCollection(Product::IMAGE_COLLECTION);
            } catch (FileDoesNotExist|FileIsTooBig $e) {
                return $this->error($e->getMessage(), 422);
            }
        }

        $product->save();

        return $this->success(message: 'Product Updated Successfully');
    }

    public function destroy(Product $product)
    {
        try {
            $product->clearMediaCollection(Product::IMAGE_COLLECTION);
            $product->delete();
        } catch (\Exception $e) {
            return $this->error('This product cannot be Deleted!', 422);
        }

        return $this->success(message: 'Product Deleted Successfully');
    }

    public function search_product(Request $request)
    {
        $product = $request->input('name');
        $product_search = Product::query()->where('name', 'LIKE', "%$product%")->get();
        return $product_search->isNotEmpty()
            ? $this->success(
                data: [
                    'product' => $product_search
                ]
            ) : $this->notFound(
                data: [
                    'product' => []
                ],
                message: 'Product Not Found',
            );

    }

    public function myProducts()
    {
        return $this->success([
            'product' => auth()->user()->products
        ]);
    }

    public function makeContract(ProductContractRequest $request)
    {
        $product = Product::query()->findOrFail($request->validated('product_id'));
        $QRCode = ContractService::create(
            $this->getFormattedData($product, $request),
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

    public function getFormattedData($product, $request): array
    {
        return [
            'email' => $product->user->email,
            'amount' => $product->price,
            'description' => $product->description,
            'file' => $product->image,
            'preferred_payment_method' => $request->validated('preferred_payment_method'),
        ];
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
