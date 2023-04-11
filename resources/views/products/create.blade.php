@extends('layouts.mylayout')

@section('CssPart')
<style>
    #image_preview {
        display: flex;
        flex-wrap: wrap;
        max-width: 200px;
        margin: 0 auto;
    }
    .preview-image {
        flex-basis: 200px;
        flex-grow: 1;
        margin: 10px;
    }

</style>
@endsection

@section('head')

@endsection

@section('body')
{{--    <h1>商品專區>新增商品</h1>--}}

{{--    @if($errors->any())--}}
{{--        <div class="errors p-3 bg-red-500 text-red-100 font-thin rounded">--}}
{{--            <ul>--}}
{{--                @foreach($errors->all() as $errors)--}}
{{--                    <li>{{$errors}}</li>--}}
{{--                @endforeach--}}
{{--            </ul>--}}
{{--        </div>--}}
{{--    @endif--}}

{{--    <form action="{{route('products.store')}}" method="post">--}}
{{--        @csrf--}}
{{--        <div class="field mt-2">--}}
{{--            <label for="">名稱</label>--}}
{{--            <input type="text" name="name" value="{{old('name')}}" class="border border-gray-300 p-2">--}}
{{--        </div>--}}
{{--        <div class="field mt-2">--}}
{{--            <label for="">價錢</label>--}}
{{--            <input type="text" name="price" value="{{old('price')}}" class="border border-gray-300 p-2">--}}
{{--        </div>--}}
{{--        <div class="field mt-2">--}}
{{--            <label for="">數量</label>--}}
{{--            <input type="text" name="quantity" value="{{old('quantity')}}" class="border border-gray-300 p-2">--}}
{{--        </div>--}}
{{--        <input type="hidden" name="state" value="published">--}}

{{--        --}}{{--        <select required name="states">--}}
{{--            <option value="published">上架</option>--}}
{{--            <option value="draft">下架</option>--}}
{{--        </select>--}}
{{--        <div class="field mt-2">--}}
{{--            <label for="">描述</label>--}}
{{--            <textarea name="description" cols="30" rows="10" class="border border-gray-300 p-2">{{old('description')}}</textarea>--}}
{{--        </div>--}}

{{--        <div class="action mt-2 mb-4">--}}
{{--            <button type="submit" class="px-3 py-1 rounded bg-gray-200 hover:bg-gray-700">新增商品</button>--}}
{{--        </div>--}}
{{--    </form>--}}


<div class="container text-center">
    <h1 class="mb-4 title mt-3 pageTitle">新增商品</h1>
    @if($errors->any())
        <div class="errors p-3 bg-red-500 text-red-100 font-thin rounded">
            <ul>
                @foreach($errors->all() as $error)
                    <li>{{$error}}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <div class="d-inline-block">
        <form action="{{route('products.store')}}" method="post" enctype="multipart/form-data">
            @csrf
            <div class="form-group">
                <label for="name">名稱</label>
                <input type="text" name="name" value="{{old('name')}}" class="form-control">
            </div>
            <div class="form-group">
                <label for="category_id">分類</label>
                <select name="category_id" class="form-control" id="category_id">
                    <option value="">選擇分類</option>
                    @foreach($categories as $category)
                        <option value="{{ $category->id }}" {{ old('category_id') == $category->id ? 'selected' : '' }}>{{ $category->name }}</option>
                    @endforeach
                </select>
            </div>

            <div class="form-group">
                <label for="price">價錢</label>
                <input type="text" name="price" value="{{old('price')}}" class="form-control">
            </div>
            <div class="form-group">
                <label for="quantity">數量</label>
                <input type="text" name="quantity" value="{{old('quantity')}}" class="form-control">
            </div>
            <div class="form-group">
                <label for="description">描述</label>
                <textarea name="description" cols="30" rows="10" class="form-control">{{old('description')}}</textarea>
            </div>
            <div class="form-group">
                <label for="image">圖片</label>
                <input type="file" name="image[]" class="form-control"  accept="image/png, image/jpeg" multiple>
            </div>
            <div class="form-group">
                <div class="row" id="image_preview"></div>
            </div>
            <button type="submit" class="btn btn-sm btn-outline-secondary px-4 mt-2 mb-4">提交</button>
        </form>
    </div>
</div>

@endsection

@section('JavaScriptPart')
<script>
    // 預覽圖片
    function previewImages(input, target) {
        if (input.files) {
            for (var i = 0; i < input.files.length; i++) {
                var reader = new FileReader();
                reader.onload = function(e) {
                    var image = $("<img>").attr("src", e.target.result).addClass("preview-image");
                    $(target).append(image);
                };
                reader.readAsDataURL(input.files[i]);
            }
        }
    }

    $(document).ready(function() {
        // 選擇圖片時觸發預覽圖片函數
        $("input[name='image[]']").on("change", function() {
            $("#image_preview").empty();
            previewImages(this, "#image_preview");
        });
    });

</script>

@endsection
