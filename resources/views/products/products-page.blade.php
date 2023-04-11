@extends('layouts.mylayout')

@section('CssPart')
<style>
    .productInfo {
        width: fit-content;
    }

    .productInfo:hover {
        border: 2px solid black;
    }

    table {;
        width: 100%;
    }

    th, td {
        text-align: center;
        vertical-align: middle;
        padding: 8px;
        border: 1px solid #ddd;
    }
    tr:hover {
        background-color: #f5f5f5;
    }

    #search-container {
        position: relative;
        width: 100%;
    }


    #search-results {
        position: absolute;
        top: 100%;
        left: 0;
        z-index: 9999;
        background-color: white;
        border-top: none;
        overflow-y: auto;
        width: 100%;
    }

    input[name="keyword"] {
        position: relative;
    }

    .search-option {
        padding: 5px;
        cursor: pointer;
    }

    .search-option:hover {
        background-color: lightgray;
    }

</style>
@endsection

@section('body')


    @if($products)
        <meta name="csrf-token" content="{{ csrf_token() }}">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-md-8">
                    <div>
                        <h1 class="text-center mb-4 title mt-3 pageTitle">商品專區</h1>
                    </div>

                    <form method="GET" action="{{ route('products.index') }}" id="searchForm">
                        <div class="row mb-3">
                            <div class="col">
                                <div id="search-container">
                                    <input type="text" name="keyword" class="form-control" placeholder="商品ID、名稱、說明" value="{{ old('keyword', $keyword) }}">
                                    <div id="search-suggestions">
                                        <div id="search-results"></div>
                                    </div>
                                </div>
                            </div>
                            <div class="col">
                                <select name="category_id" class="form-control" id="category_id">
                                    <option value="">選擇分類</option>
                                    @foreach($categories as $category)
                                        <option value="{{ $category->id }}" {{ old('category_id') == $category->id ? 'selected' : '' }}>{{ $category->name }}</option>
                                    @endforeach
                                </select>
                            </div>
{{--                            <div class="col">--}}
{{--                                <select name="state" class="form-control">--}}
{{--                                    <option value="">狀態</option>--}}
{{--                                    <option value="published" {{ $state == 'published' ? 'selected' : '' }}>上架中</option>--}}
{{--                                    <option value="draft" {{ $state == 'draft' ? 'selected' : '' }}>已下架</option>--}}
{{--                                </select>--}}
{{--                            </div>--}}
{{--                            <div class="col">--}}
{{--                                <input type="date" name="start_date" class="form-control" value="{{ old('start_date', $startDate) }}">--}}
{{--                            </div>--}}
{{--                            <div class="col">--}}
{{--                                <input type="date" name="end_date" class="form-control" value="{{ old('end_date', $endDate) }}">--}}
{{--                            </div>--}}
                            <div class="col-auto">
                                <button type="submit" class="btn btn-outline-secondary">搜尋</button>
                            </div>
                        </div>
                    </form>
                    {{--                <div class="text-center mb-2">--}}
                    {{--                    <a href="{{route('products.create')}}" class="btn btn-sm btn-primary small">新增商品</a>--}}
                    {{--                </div>--}}
                    <div class="row row-cols-2 row-cols-lg-6 g-2 g-lg-3">
                        {{--style="background-color:#f5f5f5--}}
                        @foreach($products as $product)
                            <div class="col productInfo">
                                <a href="{{route('products.show',$product)}}"  style="text-decoration:none;color: black">
                                    <img  src="{{ asset('storage/'.$product->images->first()->path) }}" style="width: 100%;height: 15vh; float:left" >

                                    {{--                                <img src="{{ asset('storage/'.$product->images->first()->path) }}" style="width: 100%;height: 15vh; float:left">--}}
                                    <div class="p-3 bg-white">
                                        <span>{{$product->name}}</span><br>
                                        <span>數量:{{$product->quantity}}</span><br>
                                        <span>${{$product->price}}</span>
                                        @if($product->user_id === auth()->id())
                                            <div>

                                                <a href="{{ route('products.edit',['product'=>$product->id]) }}" class="btn btn-sm btn-outline-primary">編輯</a>
                                                <form action="{{ route('products.destroy',$product) }}" method="post" class="d-inline">
                                                    @csrf
                                                    @method('delete')
                                                    <button type="submit" class="btn btn-sm btn-outline-danger">刪除</button>
                                                </form>
                                            </div>
                                        @endif
                                    </div>
                                </a>
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>



        <div class="d-flex justify-content-center mb-4 mt-3">
            {{ $products->links() }}
        </div>



    @endif




@endsection

@section('JavaScriptPart')
    <script>


        $('input[name="keyword"]').on('keyup click', function() {
            $.post('{{ route("products.search") }}', {
                keyword: $(this).val(),
                _token: $('meta[name="csrf-token"]').attr('content')
            }, function(response) {
                var names = response;
                var html = '';
                for (var i = 0; i < names.length; i++) {
                    html += '<div class="search-option">' + names[i] + '</div>';
                }
                $('#search-results').html(html)
            });
        });


        {{--$('input[name="keyword"]').on('click', function() {--}}
        {{--    var keyword = $(this).val();--}}
        {{--    $.ajax({--}}
        {{--        url: '{{ route("products.search") }}',--}}
        {{--        type: 'POST', // 指定使用 POST 方法--}}
        {{--        data: {--}}
        {{--            keyword: keyword--}}
        {{--        },--}}
        {{--        headers: {--}}
        {{--            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')--}}
        {{--        },--}}
        {{--        success: function(response) {--}}
        {{--            var names = response;--}}
        {{--            var html = '';--}}
        {{--            for (var i = 0; i < names.length; i++) {--}}
        {{--                html += '<div class="search-option">' + names[i] + '</div>';--}}
        {{--            }--}}
        {{--            $('#search-results').html(html)--}}
        {{--        }--}}
        {{--    });--}}
        {{--});--}}

        {{--$('input[name="keyword"]').on('keyup', function() {--}}
        {{--    var keyword = $(this).val();--}}
        {{--    $.ajax({--}}
        {{--        url: '{{ route("products.search") }}',--}}
        {{--        type: 'POST', // 指定使用 POST 方法--}}
        {{--        data: {--}}
        {{--            keyword: keyword--}}
        {{--        },--}}
        {{--        headers: {--}}
        {{--            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')--}}
        {{--        },--}}
        {{--        success: function(response) {--}}
        {{--            var names = response;--}}
        {{--            var html = '';--}}
        {{--            for (var i = 0; i < names.length; i++) {--}}
        {{--                html += '<div class="search-option">' + names[i] + '</div>';--}}
        {{--            }--}}
        {{--            $('#search-results').html(html)--}}
        {{--        }--}}
        {{--    });--}}
        {{--});--}}

        // 點擊搜尋結果選項時
        $(document).on('click', '.search-option', function() {
            // 將選中的搜尋結果設置為搜尋欄的值
            $('input[name="keyword"]').val($(this).text());
            // 提交表單
            $('#searchForm').submit();
        });



        function showAlert(message) {
            alert(message);
        }

        @if(session()->has('notice'))
        showAlert("{{ session('notice') }}");
        @endif
    </script>
@endsection
