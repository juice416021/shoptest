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
    <h1 class="text-center mb-4 title mt-3 pageTitle">公告</h1>
    <table>
        <tr>
            <th>標題</th>
            <td>{{ $announcement->id }}</td>
        </tr>
        <tr>
            <th>內文</th>
            <td>{{ $announcement->name }}</td>
        </tr>
    </table>
    <div class="d-flex justify-content-center mb-4 mt-3">
        <a href="{{ route('backend-announcements.edit', $announcement->id) }}" class="btn btn-secondary">編輯</a>
    </div>

@endsection



