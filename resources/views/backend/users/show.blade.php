@extends('layouts.backend-layout')

@section('CssPart')
    <style>
        table {
            border-collapse: collapse;
            width: 100%;
            max-width: 600px;
            margin: auto;
            margin-top: 20px;
            border: 2px solid #ddd;
        }
        th, td {
            text-align: left;
            padding: 8px;
            border-bottom: 1px solid #ddd;
        }
        th {
            background-color: #f2f2f2;
            text-align: center;
            vertical-align: middle;

        }
        tr:hover {
            background-color: #f5f5f5;
        }
    </style>
@endsection

@section('body')
    <h1 class="text-center mb-4 title mt-3 pageTitle">會員資料</h1>
    <table>
        <tr>
            <th>相片</th>
            @if($user->profile_photo_path)
                <td><img src="{{ asset('storage/'.$user->profile_photo_path) }}"></td>
            @else
                <td></td>
            @endif

        </tr>
        <tr>
            <th>ID</th>
            <td>{{ $user->id }}</td>
        </tr>
        <tr>
            <th>姓名</th>
            <td>{{ $user->name }}</td>
        </tr>
        <tr>
            <th>身分</th>
            <td>{{ $user->role }}</td>
        </tr>
        <tr>
            <th>信箱</th>
            <td>{{ $user->email }}</td>
        </tr>
        <tr>
            <th>信箱認證日期</th>
            <td>{{ $user->email_verified_at }}</td>
        </tr>
        <tr>
            <th>Facebook ID</th>
            <td>{{ $user->facebook_id }}</td>
        </tr>
        <tr>
            <th>創建日期</th>
            <td>{{ $user->created_at }}</td>
        </tr>
        <tr>
            <th>更新日期</th>
            <td>{{ $user->updated_at }}</td>
        </tr>
    </table>
    <div class="d-flex justify-content-center mb-4 mt-3">
        <a href="{{ route('backend-users.edit', $user->id) }}" class="btn btn-secondary">編輯</a>
    </div>

@endsection



