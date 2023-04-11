@extends('layouts.mylayout')

@section('CssPart')

@endsection

@section('body')
{{--    <h1>購物車</h1>--}}

{{--    <a href="{{ route('orders.clearCart') }}">清空購物車</a>--}}

{{--    @if (empty($cartItems))--}}
{{--        <p>您的購物車目前沒有任何商品。</p>--}}
{{--    @else--}}
{{--        <table>--}}
{{--            <thead>--}}
{{--            <tr>--}}
{{--                <th>商品名稱</th>--}}
{{--                <th>單價</th>--}}
{{--                <th>數量</th>--}}
{{--                <th>小計</th>--}}
{{--            </tr>--}}
{{--            </thead>--}}
{{--            <tbody>--}}
{{--            @foreach ($cartItems as $item)--}}
{{--                <tr>--}}
{{--                    <td>商品名稱:{{ $item['product']->name }}</td>--}}
{{--                    <td>價錢:{{ $item['product']->price }}</td>--}}
{{--                    <td>數量:{{ $item['quantity'] }}</td>--}}
{{--                    <td>總價:{{ $item['subtotal']}}</td>--}}
{{--                </tr>--}}
{{--            @endforeach--}}
{{--            <tr>--}}
{{--                <td colspan="3">全部總計{{$total}}</td>--}}
{{--                <td>{{ $total }}</td>--}}
{{--            </tr>--}}
{{--            </tbody>--}}
{{--        </table>--}}
{{--        <a href="{{ route('orders.checkout') }}">結帳</a>--}}
{{--    @endif--}}

{{--    <a href="{{route('root')}}">回到首頁</a>--}}

<h1 class="text-center mb-4 title mt-3 pageTitle">購物車</h1>
<div class="text-center mb-4">
    <a href="{{ route('orders.clearCart') }}" class="btn btn-sm btn-danger">清空購物車</a>
</div>
@if ($cartItems->isEmpty())
    <p class="text-center">您的購物車目前沒有任何商品。</p>
@else
    <div class="table-responsive">
        <table class="table table-bordered" style="width: 80%; margin: 0 auto;">
            <thead>
            <tr>
                <th>商品名稱</th>
                <th>單價</th>
                <th>數量</th>
                <th>小計</th>
            </tr>
            </thead>
            <tbody>
            @foreach ($cartItems as $item)
                <tr>
                    <td>{{ $item['product']->name }}</td>
                    <td>{{ $item['product']->price }}</td>
                    <td>{{ $item['quantity'] }}</td>
                    <td>{{ $item['product']->price*$item['quantity']}}</td>
                </tr>
            @endforeach
            <tr>
                <td colspan="3" class="text-right font-weight-bold">全部總計</td>
                <td class="font-weight-bold">${{ $total }}</td>
            </tr>
            </tbody>
        </table>
    </div>
    <div class="text-center mb-4">
        <a href="{{ route('orders.checkout') }}" class="btn btn-sm btn-primary mt-3">結帳</a>
    </div>
@endif

<div class="text-center">
    <a href="{{route('root')}}" class="btn btn-sm btn-secondary mt-3">回到首頁</a>
</div>

@endsection



