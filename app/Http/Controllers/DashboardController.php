<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;
use LaravelDaily\LaravelCharts\Classes\LaravelChart;

class DashboardController extends Controller
{

    /**
     * @throws \Exception
     */
    public function index()
    {
        $user = auth()->user();
        $totalNumberOfContracts = $user->allContracts()->count();
        $totalAmountReceived = $user->receivedContracts()
            ->notPending()
            ->sum('amount');
        $currentActiveContract = $user->allContracts()
            ->latest()
            ->pending()
            ->first()
            ?->load('status');
        $totalAmountSent = $user->contracts()
            ->notPending()
            ->sum('amount');
        return view('dashboard.index',[
            'totalNumberOfContracts' => $totalNumberOfContracts,
            'totalAmountReceived' => $totalAmountReceived,
            'currentActiveContract' => $currentActiveContract,
            'totalAmountSent' => $totalAmountSent,
            'chart1' => $this->getCart1(),
            'chart2' => $this->getCart2()
        ]);
    }

    /**
     * @throws \Exception
     */
    public function getCart1(): LaravelChart
    {
        $chart_options = [
            'chart_title' => 'Users by months',
            'report_type' => 'group_by_date',
            'model' => 'App\Models\User',
            'group_by_field' => 'created_at',
            'group_by_period' => 'month',
            'chart_type' => 'bar',
            'filter_field' => 'created_at',
            'filter_days' => 30, // show only last 30 days
        ];
        return new LaravelChart($chart_options);
    }

    /**
     * @throws \Exception
     */
    public function getCart2(): LaravelChart
    {
        $chart_options = [
            'chart_title' => 'Users by names',
            'report_type' => 'group_by_string',
            'model' => 'App\Models\User',
            'group_by_field' => 'name',
            'chart_type' => 'line',
            'filter_field' => 'created_at',
            'filter_period' => 'month', // show users only registered this month
        ];
        return new LaravelChart($chart_options);
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
       $products = Product::query()->approved()->get();
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
