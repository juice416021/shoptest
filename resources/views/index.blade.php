@extends('layouts.mylayout')

@section('CssPart')

@endsection

@section('body')
    <div class="container">
        <div class="row">
            <div class="col-md-3">
                <h2>商品分類</h2>
                <ul>
                    <li><a href="#">電腦周邊</a></li>
                    <li><a href="#">手機平板</a></li>
                    <li><a href="#">家用電器</a></li>
                    <li><a href="#">食品飲料</a></li>
                </ul>
            </div>
            <div class="col-md-9">
                <h2>最新商品</h2>
                <div class="row">
                    <div class="col-md-4">
                        <div class="thumbnail">
                            <img src="http://placehold.it/350x200" alt="...">
                            <div class="caption">
                                <h3>商品名稱</h3>
                                <p>商品描述</p>
                                <p><a href="#" class="btn btn-primary" role="button">立即購買</a></p>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="thumbnail">
                            <img src="http://placehold.it/350x200" alt="...">
                            <div class="caption">
                                <h3>商品名稱</h3>
                                <p>商品描述</p>
                                <p><a href="#" class="btn btn-primary" role="button">立即購買</a></p>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="thumbnail">
                            <img src="http://placehold.it/350x200" alt="...">
                            <div class="caption">
                                <h3>商品名稱</h3>
                                <p>商品描述</p>
                                <p><a href="#" class="btn btn-primary" role="button">立即購買</a></p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection

<script>
    function showAlert(message) {
        alert(message);
    }

    @if(session()->has('notice'))
    showAlert("{{ session('notice') }}");
    @endif

</script>
