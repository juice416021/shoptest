<?php

namespace App\Http\Controllers;

use App\Models\Announcement;
use App\Models\Article;
use App\Models\Category;
use App\Models\Product;
use App\Models\User;
use Illuminate\Support\Facades\Route;
use Illuminate\Http\Request;
use App\Jobs\SendAnnouncementEmails;
use Illuminate\Support\Facades\Redis;

class BackendAnnouncementController extends Controller
{
            //保護功能 只有登入才能進行新增修改 沒登入的話只能進首頁和查看
    public function __construct(){
        $this->middleware('auth')->except(['index','show']);
    }

    public function index(Request $request)
    {
        $announcements = Announcement::with('user')->paginate(20);

        return view('backend.announcements.index', compact('announcements'));
    }

    public function create(Request $request){

        return view('backend.announcements.create');
    }

    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'title' => 'required',
            'content' => 'required',
        ]);

        $announcement = auth()->user()->announcements()->create($validatedData);

        // 分發作業
        dispatch(new SendAnnouncementEmails($announcement));


        return redirect()->route('backend-announcements.index')->with('notice', '公告新增成功!');
    }




}
