@extends('layouts.backend-layout')

@section('CssPart')
    <style>
        table {;
            border: 3px solid;
            width: 100%;
        }

        th, td {
            text-align: center;
            vertical-align: middle;
            padding: 8px;
            border: 1px solid #ddd;
        }

        th {
            background-color: #f2f2f2;
        }

        tr{

        }
    </style>
@endsection

@section('body')
    <div class="container">
        <h1 class="text-center mb-4 title mt-3 pageTitle">交易紀錄</h1>
        @if ($orders->isEmpty())
            <p class="text-center">目前沒有交易紀錄。</p>
{{--            <button type="submit" class="btn btn-sm btn-outline-secondary px-4">新增</button>--}}
        @else
            <form method="GET" action="{{ route('transactions.index') }}">
                <div class="row mb-3">
                    <div class="col">
                        <input type="text" name="keyword" class="form-control" placeholder="訂單編號、商品名稱、買家" value="{{ old('keyword', $keyword) }}">
                    </div>
                    <div class="col">
                        <select name="is_paid" class="form-control">
                            <option value="">付款狀態</option>
                            <option value="1" {{ old('is_paid', $isPaid) == '1' ? 'selected' : '' }}>已付款</option>
                            <option value="0" {{ old('is_paid', $isPaid) == '0' ? 'selected' : '' }}>未付款</option>
                        </select>
                    </div>
                    <div class="col">
                        <input type="date" name="start_date" class="form-control" value="{{ old('start_date', $startDate) }}">
                    </div>
                    <div class="col">
                        <input type="date" name="end_date" class="form-control" value="{{ old('end_date', $endDate) }}">
                    </div>
                    <div class="col-auto">
                        <button type="submit" class="btn btn-outline-secondary">搜尋</button>
                    </div>
                </div>
            </form>



            <div class="row">
                <div class="col-md-12">
                    <table class="table">
                        <thead>
                        <tr>
                            <th><a href="{{ route('transactions.index', ['sort' => 'created_at', 'direction' => 'asc']) }}">日期</a></th>
                            <th><a href="{{ route('transactions.index', ['sort' => 'order_number', 'direction' => 'asc']) }}">訂單編號</a></th>
                            <th>買家</th>
                            <th>商品名稱</th>
                            <th>單價</th>
                            <th>數量</th>
                            <th>小計</th>
                            <th>總價</th>
                            <th>付款狀態</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($orders as $order)
                            @foreach($order->products as $product)
                                <tr >
                                    @if($loop->first)
                                        <td rowspan="{{ $order->products->count() }}">{{ $order->user->created_at }}</td>
                                        <td rowspan="{{ $order->products->count() }}">{{ $order->order_number }}</td>
                                        <td rowspan="{{ $order->products->count() }}">{{ $order->user->name }}</td>
                                    @endif
                                    <td>{{ $product->name }}</td>
                                    <td>{{ $product->pivot->price }}</td>
                                    <td>{{ $product->pivot->quantity }}</td>
                                    <td>{{ $product->pivot->quantity * $product->pivot->price}}</td>
                                    @if($loop->first)
                                        <td rowspan="{{ $order->products->count() }}">{{ $order->total_amount }}</td>
                                        <td rowspan="{{ $order->products->count() }}" style="{{ $order->is_paid ? '' : 'color: red;' }}">
                                            {{ $order->is_paid ? '已付款' : '未付款' }}
                                        </td>
                                    @endif


                                </tr>
                            @endforeach
                        @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        @endif
    </div>

    <div class="d-flex justify-content-center mb-4 mt-2">
        {{ $orders->links() }}
    </div>

@endsection
