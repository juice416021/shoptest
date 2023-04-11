<?php

namespace App\Http\Controllers;

use App\Models\Article;
use App\Models\Product;
use App\Models\User;
use Illuminate\Http\Request;
use App\Models\Category;
use Intervention\Image\Facades\Image;
use Illuminate\Support\Facades\Storage;
class BackendCategoryController extends Controller
{
    //保護功能 只有登入才能進行新增修改 沒登入的話只能進首頁和查看
    public function __construct(){
        $this->middleware('auth')->except(['index','show']);
    }

    public function index(Request $request)
    {
        $categories = Category::query();
        $keyword = $request->input('keyword', null);
        if (! is_null($keyword)) {
            $categories = $categories->where(function ($query) use ($keyword) {
                $query->where('name', 'LIKE', '%' . $keyword . '%')
                    ->orWhere('id', $keyword);
            });
        }

        $categories=$categories->paginate(20);

        return view('backend.categories.index',compact('categories','keyword'));
    }

    public function create(){
        return view('backend.categories.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'photo' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);

        $imageName = time() . '.' . $request->photo->extension();
        $image = Image::make($request->photo->getRealPath());
        $image->fit(450, 450);

        $path = 'public/categories/' . $imageName;
        Storage::put($path, (string) $image->encode());

        $category = Category::create([
            'name' => $request->name,
            'photo_path' => 'categories/' . $imageName,
        ]);

        return redirect()->route('backend-categories.index')->with('notice', '商品分類已成功新增');
    }


    public function edit($id){
        $category= Category::find($id);

        return view('backend.categories.edit',['category'=>$category]);
    }


    public function update(Request $request,$id)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'photo' => 'sometimes|nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);

        $category=Category::find($id);

        $data = [
            'name' => $request->name,
        ];

        if ($request->hasFile('photo')) {
            $imageName = time() . '.' . $request->photo->extension();
            $image = Image::make($request->photo->getRealPath());
            $image->fit(450, 450);

            $path = 'public/categories/' . $imageName;
            Storage::put($path, (string) $image->encode());

            // 删舊照片
            if ($category->photo_path) {
                Storage::delete('public/' . $category->photo_path);
            }

            $data['photo_path'] = 'categories/' . $imageName;
        }


        $category->update($data);

        return redirect()->route('backend-categories.index')->with('notice', '商品分類已成功更新');
    }


}
