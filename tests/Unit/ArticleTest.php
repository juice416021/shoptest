<?php

namespace Tests\Unit;

use App\Models\Article;
use Tests\TestCase;
use App\Models\User;
use Illuminate\Foundation\Testing\WithFaker;

class ArticleTest extends TestCase
{
    use WithFaker;

    public function testCreateArticle()
    {
        $data = [
            'title' => 'Test Article',
            'content' => 'This is a test article'
        ];

        $user = User::factory()->create(); // 建立一個已經登入的用戶
        $response = $this->actingAs($user)->post('/articles', $data); // 使用actingAs方法模擬登入
        $response->assertStatus(302); // 確認頁面跳轉正常

        $article = Article::where('title', $data['title'])->first();
        $this->assertNotNull($article); // 確認文章被新增
        $this->assertEquals($data['title'], $article->title); // 確認文章標題正確
        $this->assertEquals($data['content'], $article->content); // 確認文章內容正確
    }

    public function testEditArticle()
    {
        // 建立測試用的文章和使用者
        $user = User::factory()->create();
        $article = Article::factory()->create(['user_id' => $user->id]);

        // 模擬登入並訪問編輯文章的頁面
        $response = $this->actingAs($user)->get('/articles/'.$article->id.'/edit');
        $response->assertStatus(200);

        // 修改文章標題和內容
        $data = [
            'title' => 'New Title',
            'content' => 'New Content'
        ];
        $response = $this->actingAs($user)->put('/articles/'.$article->id, $data);
        $response->assertStatus(302);

        // 確認文章修改成功
        $article = Article::find($article->id);
        $this->assertEquals($data['title'], $article->title);
        $this->assertEquals($data['content'], $article->content);
    }

    public function testViewArticle()
    {
        // 建立測試用的文章和使用者
        $user = User::factory()->create();
        $article = Article::factory()->create(['user_id' => $user->id]);

        // 模擬訪問文章詳情頁面
        $response = $this->get('/articles/'.$article->id);
        $response->assertStatus(200);

        // 確認頁面是否正確顯示文章標題和內容
        $response->assertSee($article->title);
        $response->assertSee($article->content);
    }

    public function testDeleteArticle()
    {
        // 建立測試用的文章和使用者
        $user = User::factory()->create();
        $article = Article::factory()->create(['user_id' => $user->id]);

        // 模擬登入並訪問刪除文章的路由
        $response = $this->actingAs($user)->delete('/articles/'.$article->id);
        $response->assertStatus(302);

        // 確認文章是否被刪除
        $this->assertNull(Article::find($article->id));
    }



}
