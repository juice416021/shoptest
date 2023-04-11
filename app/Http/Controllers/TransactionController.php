<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Order;

class TransactionController extends Controller
{
    public function index(Request $request)
    {
        $keyword = $request->input('keyword', null);
        $isPaid = $request->input('is_paid', null);
        $startDate = $request->input('start_date', null);
        $endDate = $request->input('end_date', null);
        $sort = $request->input('sort', 'desc'); //預設以日期新到舊排序


        $orders = Order::orderBy('created_at', $sort)->with(['products', 'user']);



        if (! is_null($keyword)) {
            $orders = $orders->where(function ($query) use ($keyword) {
                $query->where('order_number', 'like', "%{$keyword}%")
                    ->orWhereHas('products', function ($query) use ($keyword) {
                        $query->where('name', 'like', "%{$keyword}%");
                    })
                    ->orWhereHas('user', function ($query) use ($keyword) {
                        $query->where('name', 'like', "%{$keyword}%");
                    });
            });
        }

        if (! is_null($isPaid)) {
            $orders = $orders->where('is_paid', $isPaid);
        }

        if (! is_null($startDate)) {
            $orders = $orders->whereDate('created_at', '>=', $startDate);
        }

        if (! is_null($endDate)) {
            $orders = $orders->whereDate('created_at', '<=', $endDate);
        }

        $orders = $orders->paginate(10);

        return view('backend.transactions.index', compact('orders', 'keyword', 'isPaid', 'startDate', 'endDate'));
    }


    public function show(Order $order)
    {
        return view('backend.transactions.show', compact('order'));
    }
}
