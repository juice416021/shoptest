@extends('layouts.backend-layout')

@section('CssPart')
    <style>
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
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <div class="container">
            <div class="row justify-content-center mt-3">
                <div class="col-md-12">
                    <div class="card">
                        <div class="card-header">
                            <h1 class="text-center mb-4 title mt-3 pageTitle">管理商品</h1>
                        </div>
                        <div class="text-center">
                            <a href="{{ route('products.create') }}" class="btn btn-secondary mt-3">新增商品</a>
                        </div>
                        <div class="card-body"  style="overflow: auto;min-height: 70vh">
                            <form method="GET" action="{{ route('backend-products.index') }}">
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
                                    <div class="col">
                                        <select name="state" class="form-control">
                                            <option value="">狀態</option>
                                            <option value="published" {{ $state == 'published' ? 'selected' : '' }}>上架中</option>
                                            <option value="draft" {{ $state == 'draft' ? 'selected' : '' }}>已下架</option>
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


                            <table class="table table-bordered">
                                <thead>
                                <tr>
                                    <th style="width: 5vw">ID</th>
                                    <th style="width: 5vw">商品名稱</th>
                                    <th style="width: 10vw">照片</th>
                                    <th style="width: 5vw">商品分類</th>
                                    <th style="width: 5vw">商品數量</th>
                                    <th style="width: 15vw">商品說明</th>
                                    <th style="width: 5vw">價錢</th>
                                    <th style="width: 5vw">狀態</th>
                                    <th style="width: 5vw">新增日期</th>
                                    <th style="width: 5vw">更新日期</th>
                                    <th style="width: 5vw">操作</th>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach($products as $product)
                                    <tr>
                                        <td>{{ $product->id }}</td>
                                        <td>{{ $product->name}}</td>
                                        <td>
                                            <img src="{{ asset('storage/'.$product->images->first()->path) }}" style="width: 100%;height: 15vh; float:left">
                                        </td>
                                        <td>{{ $product->category->name}}</td>
                                        <td>{{ $product->quantity }}</td>
                                        <td>{{ Str::limit($product->description, 300, '...') }}</td>
                                        <td>{{ $product->price }}</td>
                                        <td style="text-align: center;">
                                            <div style="display: flex; justify-content: center; align-items: center; flex-direction: column;">
                                                @if ($product->state == 'published')
                                                    <svg color="green" xmlns="http://www.w3.org/2000/svg" width="30" height="30" fill="currentColor" class="bi bi-check-circle" viewBox="0 0 16 16">
                                                        <path d="M8 15A7 7 0 1 1 8 1a7 7 0 0 1 0 14zm0 1A8 8 0 1 0 8 0a8 8 0 0 0 0 16z"/>
                                                        <path d="M10.97 4.97a.235.235 0 0 0-.02.022L7.477 9.417 5.384 7.323a.75.75 0 0 0-1.06 1.06L6.97 11.03a.75.75 0 0 0 1.079-.02l3.992-4.99a.75.75 0 0 0-1.071-1.05z"/>
                                                    </svg>
{{--                                                    <p style="margin: 0;">上架中</p>--}}
                                                @elseif ($product->state == 'draft')
                                                    <svg color="red" xmlns="http://www.w3.org/2000/svg" width="30" height="30"  fill="currentColor" class="bi bi-x-circle" viewBox="0 0 16 16">
                                                        <path d="M8 15A7 7 0 1 1 8 1a7 7 0 0 1 0 14zm0 1A8 8 0 1 0 8 0a8 8 0 0 0 0 16z"/>
                                                        <path d="M4.646 4.646a.5.5 0 0 1 .708 0L8 7.293l2.646-2.647a.5.5 0 0 1 .708.708L8.707 8l2.647 2.646a.5.5 0 0 1-.708.708L8 8.707l-2.646 2.647a.5.5 0 0 1-.708-.708L7.293 8 4.646 5.354a.5.5 0 0 1 0-.708z"/>
                                                    </svg>
{{--                                                    <p style="margin: 0;">已下架</p>--}}
                                                @endif
                                            </div>
                                        </td>
                                        <td>{{ $product->created_at }}</td>
                                        <td>{{ $product->updated_at }}</td>
                                        <td><a href="{{route('products.edit',$product->id)}}"  class="btn btn-info">編輯</a></td>
                                    </tr>
                                @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
     <div class="d-flex justify-content-center mb-4 mt-3">
         {{ $products->links() }}
     </div>
@endsection

@section('JavaScriptPart')
    <script>
        $('input[name="keyword"]').on('keyup', function() {
            var keyword = $(this).val();
            $.ajax({
                url: '{{ route("products.search") }}',
                type: 'POST', // 指定使用 POST 方法
                data: {
                    keyword: keyword
                },
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                success: function(response) {
                    var names = response;
                    var html = '';
                    for (var i = 0; i < names.length; i++) {
                        html += '<div class="search-option">' + names[i] + '</div>';
                    }
                    $('#search-results').html(html)
                }
            });
        });


        // 點擊搜尋結果選項時
        $(document).on('click', '.search-option', function() {
            // 將選中的搜尋結果設置為搜尋欄的值
            $('input[name="keyword"]').val($(this).text());
            // 提交表單
            $('form').submit();
        });

    </script>
@endsection



