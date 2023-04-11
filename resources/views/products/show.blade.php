@extends('layouts.mylayout')

@section('CssPart')
    <style>
        .selected {
            border: 2px solid red;
        }
    </style>

@endsection

@section('body')
{{--    <h1>{{$product->name}}</h1>--}}
{{--    <h3>價錢{{$product->price}}</h3>--}}
{{--    <h3>數量{{$product->quantity}}</h3>--}}
{{--    <h3>狀態{{$product->state}}</h3>--}}
{{--    <h3>上架時間{{$product->created_at}}</h3>--}}
{{--    <p>--}}
{{--        {{$product->description}}--}}
{{--    </p>--}}

{{--    <form action="{{route('orders.addToCart',$product->id)}}" method="post">--}}
{{--        @csrf--}}
{{--        <div class="field mt-2">--}}
{{--            <label for="">數量</label>--}}
{{--            <input type="number" id="quantity" name="quantity" min="1" max="{{ $product->quantity }}" required value="1">--}}
{{--        </div>--}}
{{--        <div class="action mt-2 mb-4">--}}
{{--            <button type="submit" class="px-3 py-1 rounded bg-gray-200 hover:bg-gray-700">加入購物車</button>--}}
{{--        </div>--}}
{{--    </form>--}}
{{--    <a href="{{route('root')}}">回到首頁</a>--}}

    <form action="{{route('orders.addToCart',$product->id)}}" method="post">
        @csrf
    <div class="container mt-5">
        <div class="row justify-content-center">
{{--            <div class="col-4"  style="background-color: white;padding: 0px">--}}
{{--                <img src="{{asset('storage/'.$product->images->first()->path)}}"   class="w-100" style="height:40vh;">--}}
{{--                @foreach($product->images as $image)--}}
{{--                    <img src="{{asset('storage/'.$image->path)}}" class="w-25 d-inline-block" style="height:10vh;">--}}
{{--                @endforeach--}}
{{--            </div>--}}
            <div class="col-4" style="background-color: white;padding: 0px">
                <img src="{{asset('storage/'.$product->images->first()->path)}}" class="w-100 large-image" style="height:40vh;">
                @foreach($product->images as $image)
                    <img src="{{asset('storage/'.$image->path)}}" class="w-20 d-inline-block small-image" data-large-image="{{asset('storage/'.$image->path)}}">
                @endforeach
            </div>





            <div class="col-6"  style="background-color: white">
                <div>
                    <span style="font-size: 60px">{{$product->name}}</span>
                </div>
                <div style="background-color:#f5f5f5">
                    <span style="font-size: 45px;">${{$product->price}}</span><br />
                </div>
                <div>
                    <span>物品說明 : </span>{{$product->description}}<br />
                </div>

                <br><br><br><br><br><br><br>
                <div>
                    <span>物品數量 : </span>{{$product->quantity}}<br />
                </div>
                <hr>
                <div style="text-align: left;" class="mt-2">
                    @if($product->user_id === auth()->id())
                        <a style="font-size:18px" class="px-3 py-1 rounded bg-gray-200 hover:bg-gray-700" href="{{ route('products.edit',['product'=>$product->id]) }}">編輯商品</a>
                    @else
                        <div class="field mt-2 d-flex align-items-center">
                            <label for="">數量</label>
                            <input type="number" id="quantity" name="quantity" min="1" max="{{ $product->quantity }}" required value="1" class="ml-2">
                            <button type="submit" style="font-size:18px" class="px-3 py-1 rounded bg-gray-200 hover:bg-gray-700 ml-2">加入購物車</button>
                        </div>
                    @endif
                </div>

            </div>



            <div class="col-4 mt-2 mb-3">
                <span style="font-weight:bold;">上架時間{{$product->created_at}}</span><br />
{{--                <span style="font-weight:bold;">物品分類 : {{$categoryArr[$post->categories-1]->name}}</span><br />--}}
                <span style="font-weight:bold;"><a href="">物品分類 : {{$product->category->name}}</a></span>
                <br />
            </div>
            <div class="col-6"><br></div>
        </div>
    </div>
    </form>


@endsection

@section('JavaScriptPart')
    <script>
        // 數量上限限制
        var quantityInput = document.getElementById("quantity");

        if (quantityInput) {
            quantityInput.addEventListener("input", function() {
                if (parseInt(quantityInput.value) > parseInt(quantityInput.max)) {
                    quantityInput.value = quantityInput.max;
                }
            });
        }



        //圖片
        // 取得所有小圖片元素
        var smallImages = document.querySelectorAll('.small-image');
        smallImages.forEach(function(smallImage) {
            // 當滑鼠移入小圖片時
            smallImage.addEventListener('mouseenter', function() {
                // 取得目前選取的小圖片元素
                var currentSmallImage = document.querySelector('.small-image.selected');
                // 如果有目前選取的小圖片元素，就移除 selected class
                if (currentSmallImage) {
                    currentSmallImage.classList.remove('selected');
                }
                // 將滑入的小圖片元素加上 selected class
                smallImage.classList.add('selected');
                // 取得大圖片元素和圖片路徑
                var largeImage = document.querySelector('.large-image');
                var largeImagePath = smallImage.dataset.largeImage;
                // 更換大圖片路徑
                largeImage.src = largeImagePath;
            });
            // 當滑鼠移出小圖片時
            smallImage.addEventListener('mouseleave', function() {
                // 將滑出的小圖片元素移除 selected class
                smallImage.classList.remove('selected');
            });
        });






        function showAlert(message) {
            alert(message);
        }
        @if(session()->has('notice'))
        showAlert("{{ session('notice') }}");
        @endif
    </script>
@endsection


