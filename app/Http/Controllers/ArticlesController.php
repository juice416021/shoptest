<?php

namespace App\Http\Controllers;

use App\Models\Article;
use Illuminate\Http\Request;
use function Sodium\randombytes_uniform;

class ArticlesController extends Controller
{
    //保護功能 只有登入才能進行新增修改 沒登入的話只能進首頁和查看
    public function __construct(){
        $this->middleware('auth')->except(['index','show','GetArticles']);
    }

    public function index(){
        $articles = Article::orderBy('id', 'desc')->paginate(5);
        return view('articles.articles-page',['articles'=>$articles]);
    }

    public function show($id){
        $article = Article::find($id);
//        dd($article);
        return view('articles.show',['article'=>$article]);
    }

    public function create(){
        return view('articles.create');
    }

    public function store(Request $request){
        //validate拿來判斷前面拿回來的值 並且只取title和content
        $content = $request ->validate([
            'title'=>'required',
            'content'=>'required',
        ]);

        auth()->user()->articles()->create($content);

        return redirect()->route('root')->with('notice','文章新增成功!');
    }

    public function edit($id){
        $article = auth()->user()->articles()->find($id);

        return view('articles.edit',['article'=>$article]);
    }

    public function update(Request $request,$id){
        $article = auth()->user()->articles()->find($id);

        $content = $request ->validate([
            'title'=>'required',
            'content'=>'required|min:10',
        ]);

        $article->update($content);

        return redirect()->route('root')->with('notice','文章更新成功!');
    }

    public function destroy($id){
        $article = auth()->user()->articles()->find($id);
        $article->delete();
        return redirect()->route('root')->with('notice','文章已刪除');
    }


    //拿所有文章的api  json格式
    public function GetArticles(){
        $article=Article::all();

        return response()->json($article);
    }

}
