<?php

namespace App\Http\Controllers;

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
        $pics = [
          'img' => asset('assets/images/1.png'),
          'img1' => asset('assets/images/2.png'),
          'img2' => asset('assets/images/3.png'),
          'img3' => asset('assets/images/4.png'),
          'img4' => asset('assets/images/camera.png'),
          'img5' => asset('assets/images/laptop.png'),
          'img6' => asset('assets/images/3.png'),
        ];
        return view( 'marketing.index',['pics'=>$pics]);
    }

    public function marketProduct()
    {
        return view(view: 'marketing.details');
    }
    public function successPayment()
    {
        return view(view: 'success.index');
    }

}
