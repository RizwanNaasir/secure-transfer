<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\TemporaryFile;
use App\Models\User;
use Filament\Notifications\Notification;
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
            $products->image = $request->file('image')->store('public');
            $products->user_id = $request->user()->id;
            $products->name = $request->input('name');
            $products->price = $request->input('price');
            $products->description = $request->input('description');
            $products->save();
        }
        Notification::make()->title('Added')->body('Product Added Successfully')->success()->send();
        return redirect(route('all.products'));

    }

    public function productList()
    {
        return view('products.productlist');
    }

    public function editProduct(Request $request, $product)
    {
        $product = Product::find($product);
        return view('products.edit', compact('product'));
    }

    public function updateProduct(Request $request, $id)
    {
//        auth()->user()->products()->update([
//            'name' => $request->input('name'),
//            'price' => $request->input('price'),
//            'image' => '/' . $request->input('filepond'),
//            'description' => $request->input('description'),
//        ]);

        $products = Product::find($id);
        $products->image = $request->file('image')->store('public');
        $products->user_id = $request->user()->id;
        $products->name = $request->input('name');
        $products->price = $request->input('price');
        $products->description = $request->input('description');
        $products->update();
        Notification::make()->title('Updated')->body('Product Updated Successfully')->success()->send();
        return redirect(route('all.products'));
    }

    public function deleteProduct(Request $request, $product)
    {
        $product = Product::find($product);
        $product->delete();
        Notification::make()->title('Deleted')->body('Product Deleted Successfully')->success()->send();
        return redirect(route('all.products'));


    }
}
