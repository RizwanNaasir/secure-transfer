<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;

class DashboardController extends Controller
{

    public function index()
    {
        return view('dashboard.index');
    }


    public function history()
    {
        return view('history.index');
    }

    public function historyDetail()
    {
        return view('history.detail');
    }

    public function cardDetail()
    {
        return view(view: 'card.index');
    }

    public function approvePayment()
    {
        return view(view: 'payment.approve');
    }

    public function description()
    {
        return view(view: 'reason.index');
    }

    public function marketingView()
    {
       $products = Product::all();
        return view( 'marketing.index',['products'=>$products]);
    }

    public function marketProduct($id)
    {
        $product = Product::find($id);
        return view('marketing.details',['product'=>$product]);
    }
    public function successPayment()
    {
        return view(view: 'success.index');
    }

    public function starRating()
    {
        return view(view: 'rating.index');
    }

}
