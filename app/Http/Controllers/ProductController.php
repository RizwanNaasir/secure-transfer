<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\TemporaryFile;
use App\Models\User;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    public function index()
    {
        return view('products.index');
    }

    public function addProduct(Request $request)
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
                $file = $request->file('image');
                $extension = $file->getClientOriginalExtension();
                $filename = time() . '.' . $extension;
                $file->move(public_path('/'), $filename);
                $products->image = $filename;

                $products->user_id = $request->user()->id;
                $products->name = $request->input('name');
                $products->price = $request->input('price');
                $products->description = $request->input('description');
                $products->save();

            }
        }
        return redirect(route('all.products'));

    }

    public function productList()
    {
        return view('products.productlist');
    }

    public function editProduct(Request $request)
    {
        $product = Product::find($request->get('product'));
        return view('products.edit', compact('product'));
    }

    public function updateProduct(Request $request)
    {
        auth()->user()->products()->update([
            'name' => $request->input('name'),
            'price' => $request->input('price'),
            'image' => '/' . $request->input('filepond'),
            'description' => $request->input('description'),
        ]);
        return view('products.productlist');
    }

    public function tmpUpload($id, Request $request)
    {
        if ($request->hasFile('filepond')) {
            $image = $request->file('filepond');
            $file_name = $image->getClientOriginalName();
            $image->store(public_path('/' . $file_name));

            User::find($id)->temporaryFile()->create([
                'file' => $file_name,
            ]);
            return $file_name;
        }
    }
}
