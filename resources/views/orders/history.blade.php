@extends('layouts.mylayout')

@section('CssPart')
    <style>
        table {
            border-collapse: collapse;
            width: 100%;
        }

        th, td {
            text-align: left;
            padding: 8px;
            border: 1px solid #ddd;
        }

        th {
            background-color: #f2f2f2;
        }
    </style>
@endsection

@section('body')
{{--    <div class="container">--}}
{{--        <div class="row">--}}
{{--            <div class="col-md-12">--}}
{{--                <h1>我的購買紀錄</h1>--}}
{{--                <table class="table">--}}
{{--                    <thead>--}}
{{--                    <tr>--}}
{{--                        <th>訂單編號</th>--}}
{{--                        <th>商品名稱</th>--}}
{{--                        <th>單價</th>--}}
{{--                        <th>數量</th>--}}
{{--                        <th>小計</th>--}}
{{--                        <th>總價</th>--}}
{{--                    </tr>--}}
{{--                    </thead>--}}
{{--                    <tbody>--}}
{{--                    @foreach($orders as $order)--}}
{{--                        @foreach($order->products as $product)--}}
{{--                            <tr>--}}
{{--                                @if($loop->first)--}}
{{--                                    <td rowspan="{{ $order->products->count() }}">{{ $order->order_number }}</td>--}}
{{--                                @endif--}}
{{--                                <td>{{ $product->name }}</td>--}}
{{--                                <td>{{ $product->price }}</td>--}}
{{--                                <td>{{ $product->pivot->quantity }}</td>--}}
{{--                                <td>{{ $product->pivot->quantity * $product->price }}</td>--}}
{{--                                    @if($loop->first)--}}
{{--                                        <td rowspan="{{ $order->products->count() }}">{{ $order->total_amount }}</td>--}}
{{--                                    @endif--}}
{{--                            </tr>--}}
{{--                        @endforeach--}}

{{--                    @endforeach--}}
{{--                    </tbody>--}}
{{--                </table>--}}
{{--            </div>--}}
{{--        </div>--}}
{{--    </div>--}}

{{--    <a href="{{route('root')}}">回到首頁</a>--}}


<div class="container">
    <h1 class="text-center mb-4 title mt-3 pageTitle">購買紀錄</h1>
    @if ($orders->isEmpty())
        <p class="text-center">查無購買紀錄。</p>
    @else
        <form method="GET" action="{{ route('orders.history') }}">
            <div class="row mb-3">
                <div class="col">
                    <input type="text" name="keyword" class="form-control" placeholder="訂單編號、商品名稱" value="{{ old('keyword', $keyword) }}">
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
            <table class="table table-bordered table-light">
                <thead>
                <tr>
                    <th>日期</th>
                    <th>訂單編號</th>
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
                        <tr>
                            <td>{{ $product->created_at }}</td>
                            @if($loop->first)
                                <td rowspan="{{ $order->products->count() }}">{{ $order->order_number }}</td>
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
{{--<div class="text-center">--}}
{{--    <a href="{{route('root')}}" class="btn btn-sm btn-secondary mt-3">回到首頁</a>--}}
{{--</div>--}}


<div class="d-flex justify-content-center mb-4 mt-2">
    {{ $orders->links() }}
</div>

@endsection
