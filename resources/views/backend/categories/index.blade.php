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


        .category-link {
            text-decoration: underline;
            text-decoration-color: black;
            text-decoration-opacity: 0.5;
        }
        tr:hover {
            background-color: #f5f5f5;
        }
    </style>
@endsection

@section('body')
    <div class="container">
        <div class="row justify-content-center mt-3">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <h1 class="text-center mb-4 title mt-3 pageTitle">管理商品分類</h1>
                    </div>
                    <div class="text-center">
                        <a href="{{ route('backend-categories.create') }}" class="btn btn-secondary mt-3">新增商品分類</a>
                    </div>
                    <div class="card-body"  style="overflow: auto;">
                        <form method="GET" action="{{ route('backend-users.index') }}">
                            <div class="row mb-3">
                                <div class="col">
                                    <input type="text" name="keyword" class="form-control" placeholder="分類ID、名稱" value="{{ old('keyword', $keyword) }}">
                                </div>
                                <div class="col-auto">
                                    <button type="submit" class="btn btn-outline-secondary">搜尋</button>
                                </div>
                            </div>
                        </form>


                        <table class="table table-bordered">
                            <thead>
                            <tr>
                                <th style="width: 10vw">ID</th>
                                <th style="width: 10vw">分類照片</th>
                                <th style="width: 10vw">分類名稱</th>
                                <th style="width: 10vw">新增日期</th>
                                <th style="width: 10vw">更新日期</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($categories as $category)
                                <tr>
                                    <td>{{ $category->id }}</td>
                                    <td><img src="{{ asset('storage/'.$category->photo_path)  }}" style="width: 100%;height: 15vh;"></td>
                                    <td><a href="{{route('backend-categories.edit',$category->id)}}" class="category-link link-body-emphasis link-offset-2 link-underline-opacity-25 link-underline-opacity-75-hover">{{ $category->name }}</a></td>
                                    <td>{{ $category->created_at }}</td>
                                    <td>{{ $category->updated_at }}</td>
                                </tr>
                            @endforeach
                            </tbody>
                        </table>


                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="mt-3 mb-5">
        {{ $categories->links() }}
    </div>
@endsection



