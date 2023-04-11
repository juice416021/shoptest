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
                        <h1 class="text-center mb-4 title mt-3 pageTitle">管理公告</h1>
                    </div>
                    <div class="text-center">
                        <a href="{{ route('backend-announcements.create') }}" class="btn btn-secondary mt-3">新增公告</a>
                    </div>
                    <div class="card-body"  style="overflow: auto;">
                        <table class="table table-bordered">
                            <thead>
                            <tr>
                                <th style="width: 10vw">ID</th>
                                <th style="width: 10vw">公告標題</th>
                                <th style="width: 10vw">公告內容</th>
                                <th style="width: 10vw">新增日期</th>
                                <th style="width: 10vw">更新日期</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($announcements as $announcement)
                                <tr>
                                    <td>{{ $announcement->id }}</td>
                                    <td>{{$announcement->title}}</td>
{{--                                    <td><a href="{{route('backend-categories.edit',$category->id)}}" class="category-link link-body-emphasis link-offset-2 link-underline-opacity-25 link-underline-opacity-75-hover">{{ $category->name }}</a></td>--}}
                                    <td>{{$announcement->content}}</td>
                                    <td>{{ $announcement->created_at }}</td>
                                    <td>{{ $announcement->updated_at }}</td>
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
        {{ $announcements->links() }}
    </div>
@endsection



