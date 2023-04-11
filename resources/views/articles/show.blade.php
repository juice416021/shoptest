@extends('layouts.mylayout')

@section('CssPart')

@endsection

@section('body')
{{--    <h1>{{$article->title}}</h1>--}}
{{--    <p>--}}
{{--        {{$article->content}}--}}
{{--    </p>--}}

{{--    <a href="{{route('root')}}">回到首頁</a>--}}

<div class="container">
    <h1 class="text-center mb-4 title mt-3 pageTitle">{{$article->title}}</h1>

    <div class="col-md-12 mx-auto mb-4 w-50">
        <div>
            {!! nl2br($article->content) !!}
        </div>
        <div class="d-flex justify-content-center">
            <a href="{{ route('articles.index') }}" class="btn btn-sm btn-primary mt-2">返回文章列表</a>
        </div>
    </div>
</div>



@endsection
