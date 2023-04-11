@extends('layouts.mylayout')

@section('CssPart')

@endsection

@section('body')
{{--<nav>--}}
{{--    <a href="#">Link 1</a>--}}
{{--    <a href="#">Link 2</a>--}}
{{--    <a href="#">Link 3</a>--}}
{{--</nav>--}}

<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div>
                <h1 class="text-center mb-4 title mt-3 pageTitle">文章專區</h1>
            </div>
            <div class="text-center mb-2">
                <a href="{{route('articles.create')}}" class="btn btn-sm btn-primary small">新增文章</a>
            </div>

            @foreach($articles as $article)
                <div class="card mb-3">
                    <div class="card-header d-flex justify-content-between align-items-center">
                        <h2 class="mb-0 font-weight-bold">
                            <a href="{{route('articles.show',$article)}}" class="text-decoration-none text-dark">{{$article->title}}</a>
                        </h2>
                        @if($article->user_id === auth()->id())
                            <div>

                                <a href="{{ route('articles.edit',['article'=>$article->id]) }}" class="btn btn-sm btn-outline-primary">編輯</a>
                                <form action="{{ route('articles.destroy',$article) }}" method="post" class="d-inline">
                                    @csrf
                                    @method('delete')
                                    <button type="submit" class="btn btn-sm btn-outline-danger">刪除</button>
                                </form>
                            </div>
                        @endif
                    </div>
                    <div class="card-body">
                        <p class="card-text">{{$article->created_at}}由 @if($article->user){{$article->user->name}}@endif 分享</p>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
</div>



<div class="d-flex justify-content-center mb-4">
{{ $articles->links() }}
</div>


@endsection

<script>
    function showAlert(message) {
        alert(message);
    }

    @if(session()->has('notice'))
    showAlert("{{ session('notice') }}");
    @endif





</script>
