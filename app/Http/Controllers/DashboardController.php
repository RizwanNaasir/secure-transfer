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
        return view(view: 'marketing.index');
    }

    public function successPayment()
    {
        return view(view: 'success.index');
    }
}
