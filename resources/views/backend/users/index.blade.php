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
        .user-link {
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
                            <h1 class="text-center mb-4 title mt-3 pageTitle">管理會員</h1>
                        </div>
                        <div class="text-center">
                            <a href="{{ route('backend-users.create') }}" class="btn btn-secondary mt-3">新增管理員</a>
                        </div>
                        <div class="card-body"  style="overflow: auto;">
                            <form method="GET" action="{{ route('backend-users.index') }}">
                                <div class="row mb-3">
                                    <div class="col">
                                        <input type="text" name="keyword" class="form-control" placeholder="會員ID、姓名、信箱" value="{{ old('keyword', $keyword) }}">
                                    </div>
                                    <div class="col">
                                        <select name="verified" class="form-control">
                                            <option value="">全部</option>
                                            <option value="1" {{ $isVerified === 1 ? 'selected' : '' }}>已驗證</option>
                                            <option value="0" {{ $isVerified === 0 ? 'selected' : '' }}>未驗證</option>
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
                                    <th style="width: 5vw">照片</th>
                                    <th style="width: 5vw">姓名</th>
                                    <th style="width: 5vw">身分</th>
                                    <th style="width: 15vw">信箱</th>
                                    <th style="width: 5vw">信箱驗證</th>
                                    <th style="width: 10vw">創建日期</th>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach($users as $user)
                                    <tr>
                                        <td>{{ $user->id }}</td>
                                        <td class="user-photo"><img src="{{ $user->profile_photo_url }}" style="width: 100%;height: 15vh; float:left"></td>
                                        <td><a href="{{ route('backend-users.show', $user->id) }}" class="user-link link-body-emphasis link-offset-2 link-underline-opacity-25 link-underline-opacity-75-hover">{{ $user->name }}</a></td>
                                        <td>{{ $user->role }}</td>
                                        <td>{{ $user->email }}</td>
                                        <td>{{ $user->email_verified_at ? '已驗證' : '未驗證' }}</td>
                                        <td>{{ $user->created_at }}</td>
                                    </tr>
                                @endforeach
                                </tbody>
                            </table>

                            <div class="mt-3">
                                {{ $users->links() }}
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
@endsection



