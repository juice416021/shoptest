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
    <h1 class="text-center mb-4 title mt-3 pageTitle">新增管理員</h1>
    <form action="{{ route('backend-users.store') }}" method="post">
        @csrf
        <table>
            <tr>
                <th>身分</th>
                <td>
                    <select name="role">
                        <option value="admin">Admin</option>
                        <option value="user">User</option>
                    </select>
                </td>
            </tr>
            <tr>
                <th>姓名</th>
                <td><input type="text" name="name" value=""></td>
            </tr>
            <tr>
                <th>信箱</th>
                <td><input type="email" name="email" value=""></td>
            </tr>
            <tr>
                <th>密碼</th>
                <td><input type="password" name="password" value=""></td>
            </tr>
        </table>
        <div class="d-flex justify-content-center mb-4 mt-3">
            <button type="" class="btn btn-secondary">新增</button>
        </div>
    </form>


@endsection



