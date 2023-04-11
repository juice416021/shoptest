@extends('layouts.mylayout')

@section('CssPart')

@endsection

@section('body')
    <div>
        <h1 class="text-center mb-4 title mt-3 pageTitle">新增文章</h1>
    </div>
    <div class="d-flex justify-content-center">
        <div class="col-md-6">
            @if($errors->any())
                <div class="errors p-3 bg-red-500 text-red-100 font-thin rounded">
                    <ul>
                        @foreach($errors->all() as $errors)
                            <li>{{$errors}}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <form action="{{route('articles.store')}}" method="post">
                @csrf
                <div class="field mt-2">
                    <label for="">標題</label>
                    <input type="text" name="title" value="{{old('title')}}" class="form-control">
                </div>

                <div class="field mt-2">
                    <label for="">內文</label>
                    <textarea name="content" cols="30" rows="10" class="form-control">{{old('content')}}</textarea>
                </div>

                <div class="action mt-2 mb-4 d-flex justify-content-center">
                    <button type="submit" class="btn btn-sm btn-outline-secondary px-4">新增</button>
                </div>
            </form>
        </div>
    </div>




{{--    <h1>新增文章</h1>--}}

{{--    @if($errors->any())--}}
{{--        <div class="errors p-3 bg-red-500 text-red-100 font-thin rounded">--}}
{{--            <ul>--}}
{{--                @foreach($errors->all() as $errors)--}}
{{--                    <li>{{$errors}}</li>--}}
{{--                @endforeach--}}
{{--            </ul>--}}
{{--        </div>--}}
{{--    @endif--}}

{{--    <form action="{{route('articles.store')}}" method="post">--}}
{{--        @csrf--}}
{{--        <div class="field mt-2">--}}
{{--            <label for="">標題</label>--}}
{{--            <input type="text" name="title" value="{{old('title')}}" class="border border-gray-300 p-2">--}}
{{--        </div>--}}

{{--        <div class="field mt-2">--}}
{{--            <label for="">內文</label>--}}
{{--            <textarea name="content" cols="30" rows="10" class="border border-gray-300 p-2">{{old('content')}}</textarea>--}}
{{--        </div>--}}

{{--        <div class="action mt-2 mb-4">--}}
{{--            <button type="submit" class="px-3 py-1 rounded bg-gray-200 hover:bg-gray-700">新增文章</button>--}}
{{--        </div>--}}
{{--    </form>--}}

@endsection
