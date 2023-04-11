<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Product;
use Illuminate\Http\Request;
use App\Models\ProductImage;
use Illuminate\Support\Facades\Storage;
use Intervention\Image\Facades\Image;

class ProductsController extends Controller
{
    //保護功能 只有登入才能進行新增修改 沒登入的話只能進首頁和查看
    public function __construct(){
        $this->middleware('auth')->except(['index','show','search']);
    }

    public function index(Request $request){

        $categories=Category::all();
        $products = Product::query();
        $keyword = $request->input('keyword', null);
        $category_id = $request->input('category_id', null);
        $state = $request->input('state', null);
        $startDate = $request->input('start_date', null);
        $endDate = $request->input('end_date', null);


        if (! is_null($keyword)) {
            $products = $products->where(function ($query) use ($keyword) {
                $query->where('name', 'LIKE', '%' . $keyword . '%')
                    ->orWhere('description', 'LIKE', '%' . $keyword . '%')
                    ->orWhere('id', $keyword);
            });
        }

        if (! is_null($category_id)) {
            $products = $products->where('category_id', $category_id );
        }

        if (! is_null($startDate)) {
            $products = $products->whereDate('created_at', '>=', $startDate);
        }
        if (! is_null($state)) {
            if ($state == 'published') {
                $products = $products->where('state', 'published' );
            } elseif ($state == 'draft') {
                $products = $products->where('state', 'draft' );
            }
        }

        if (! is_null($endDate)) {
            $products = $products->whereDate('created_at', '<=', $endDate);
        }

        $products = $products->with('category')->paginate(30);


        return view('products.products-page', compact('products', 'keyword','state','startDate', 'endDate','categories'));
    }

    public function show($id){
        $product = Product::with('category')->find($id);
        return view('products.show',['product'=>$product]);
    }

    public function create(){
        $categories=Category::all();

        return view('products.create',['categories'=>$categories]);
    }

    public function store(Request $request){
        //validate拿來判斷前面拿回來的值 並且只取title和content
        $validatedData = $request->validate([
            'name' => 'required|string|max:255',
            'category_id'=>'required',
            'price' => 'required|numeric|min:0',
            'quantity' => 'required|integer|min:0',
            'description' => 'required|string',
            'image.*' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048'
        ]);

        $product=auth()->user()->products()->create($validatedData);

        if ($request->hasfile('image')) {
            foreach ($request->file('image') as $image) {
                $filename = $image->getClientOriginalName();

                $path = $image->store('product-photos', 'public');

                // 使用 Image Intervention library 處理圖片
                $img = Image::make(public_path("storage/{$path}"));
                $img->fit(450, 450);
                $img->encode('jpg', 80);
                $img->save();

                $product->images()->create([
                    'path' => $path
                ]);
            }
        }

        return redirect()->route('backend-products.index')->with('notice','商品新增成功!');
    }



    public function edit($id){

        $product = auth()->user()->products()->with('category')->find($id);
        $categories=Category::all();

        return view('products.edit',['product'=>$product,'categories'=>$categories]);
    }

    public function update(Request $request,$id){
        $product = auth()->user()->products()->find($id);

        // 刪除圖片
        $deleteImageIds = $request->input('delete_image');
        if ($deleteImageIds) {
            foreach ($product->images as $image) {
                if (in_array($image->id, $deleteImageIds)) {
                    Storage::delete($image->path);
                    $image->delete();
                }
            }
        }


        $content = $request ->validate([
            'name'=>'required',
            'description'=>'required|min:10',
            'category_id'=>'required',
            'price'=>'required',
            'state'=>'required',
            'quantity'=>'required',
            'image.*' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048'
        ]);
        $product->update($content);


        if ($request->hasfile('image')) {
            foreach ($request->file('image') as $image) {
                $filename = $image->getClientOriginalName();
                $path = $image->store('product-photos', 'public');
                // 使用 Image Intervention library 處理圖片
                $img = Image::make(public_path("storage/{$path}"));
                $img->fit(450, 450);
                $img->encode('jpg', 80);
                $img->save();
                $product->images()->create([
                    'path' => $path
                ]);
            }
        }


        return redirect()->route('backend-products.index')->with('notice','商品更新成功!');
    }

    public function destroy($id){
        $product = auth()->user()->products()->find($id);
        $product->delete();
        return redirect()->route('products.index')->with('notice','商品刪除成功!');
    }


    public function search(Request $request)
    {
        $keyword = $request->input('keyword');
        $searchProducts = Product::where('name', 'LIKE', "%$keyword%")->take(30)->pluck('name');
        return response()->json($searchProducts);
    }

}
