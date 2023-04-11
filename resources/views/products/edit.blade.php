@extends('layouts.backend-layout')

@section('CssPart')
    <style>
        #image_preview {
            display: flex;
            flex-wrap: wrap;
            max-width: 30vw;
            margin: 0 auto;
        }
        .preview-image {
            flex-basis: 200px;
            flex-grow: 1;
            margin: 10px;
        }
        .delete-image {
            position: absolute;
            top: 0;
            right: 0;
            background-color: #ffffffcc;
            padding: 3px;
            cursor: pointer;
        }

    </style>
@endsection

@section('head')

@endsection

@section('body')

    <div class="container text-center">
        <h1 class="mb-4 title mt-3 pageTitle">編輯商品</h1>
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
            <form action="{{route('products.update',$product->id)}}" method="post" enctype="multipart/form-data">
                @csrf
                @method('PUT')
                <div class="form-group">
                    <label for="name">名稱</label>
                    <input type="text" name="name" value="{{old('name', $product->name)}}" class="form-control">
                </div>
                <div class="form-group">
                    <label for="category_id">分類</label>
                    <select name="category_id" class="form-control" id="category_id">
                        <option value="">選擇分類</option>
                        @foreach($categories as $category)
                            <option value="{{ $category->id }}" {{ old('category_id', $product->category_id) == $category->id ? 'selected' : '' }}>{{ $category->name }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="form-group">
                    <label for="state">狀態</label>
                    <select name="state" class="form-control" id="state">
                        <option value="published" {{ $product->state == 'published' ? 'selected' : '' }}>上架</option>
                        <option value="draft" {{ $product->state == 'draft' ? 'selected' : '' }}>下架</option>
                    </select>
                </div>

                <div class="form-group">
                    <label for="price">價錢</label>
                    <input type="text" name="price" value="{{old('price', $product->price)}}" class="form-control">
                </div>
                <div class="form-group">
                    <label for="quantity">數量</label>
                    <input type="text" name="quantity" value="{{old('quantity', $product->quantity)}}" class="form-control">
                </div>
                <div class="form-group">
                    <label for="description">描述</label>
                    <textarea name="description" cols="30" rows="10" class="form-control">{{old('description', $product->description)}}</textarea>
                </div>
                <div class="form-group">
                    <label for="image">圖片</label>
                    <input type="file" name="image[]" class="form-control"  accept="image/png, image/jpeg" multiple>
                </div>
                <div class="form-group" style="max-width: 800px; margin: 0 auto;">
                    <div class="row" id="image_preview" style="display: flex; flex-wrap: wrap;">
                        @foreach($product->images as $image)
                            <div class="col-md-4 preview-image" style="flex-basis: 33.3%; flex-grow: 1; margin: 10px;">
                                <img src="{{ asset('storage/'.$image->path) }}" class="img-fluid" style="width: 15vw;height: 20vh">
                                <div class="text-center">
                                    <input type="checkbox" name="delete_image[]" value="{{ $image->id }}">
                                    <label>刪除</label>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>
                <button type="submit" class="btn btn-sm btn-outline-secondary px-4 mt-2 mb-4">提交</button>
            </form>
        </div>
    </div>


@endsection

@section('JavaScriptPart')
    <script>
        $(document).ready(function () {
            $('.preview-image').click(function () {
                $(this).toggleClass('selected');
                if ($(this).find('input[type="checkbox"]').prop('checked')) {
                    $(this).find('input[type="checkbox"]').prop('checked', false);
                } else {
                    $(this).find('input[type="checkbox"]').prop('checked', true);
                }
            });
        });
    </script>
@endsection

