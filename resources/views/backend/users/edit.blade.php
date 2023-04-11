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
    <form action="{{ route('backend-users.update', $users) }}" method="post">
        @csrf
        @method('patch')
        <table>
            <tr>
                <th>相片</th>
                <td><img src="{{ asset('storage/'.$users->profile_photo_path) }}"></td>
            </tr>
            <tr>
                <th>ID</th>
                <td>{{ $users->id }}</td>
            </tr>
            <tr>
                <th>身分</th>
                <td>
                    <select name="role">
                        <option value="admin" @if ($users->role === 'admin') selected @endif>Admin</option>
                        <option value="user" @if ($users->role === 'user') selected @endif>User</option>
                    </select>
                </td>
            </tr>
            <tr>
                <th>姓名</th>
                <td><input type="text" name="name" value="{{ $users->name }}"></td>
            </tr>
            <tr>
                <th>信箱</th>
                <td><input type="email" name="email" value="{{ $users->email }}"></td>
            </tr>

            <tr>
                <th>信箱認證日期</th>
                <td>{{ $users->email_verified_at }}</td>
            </tr>
            <tr>
                <th>Facebook ID</th>
                <td>{{ $users->facebook_id }}</td>
            </tr>

            <tr>
                <th>創建日期</th>
                <td>{{ $users->created_at }}</td>
            </tr>
            <tr>
                <th>更新日期</th>
                <td>{{ $users->updated_at }}</td>
            </tr>
        </table>
        <div class="d-flex justify-content-center mb-4 mt-3">
            <button type="" class="btn btn-secondary">儲存</button>
        </div>
    </form>


@endsection



