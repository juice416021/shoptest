<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ProductsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('products')->insert([
            [
                'user_id' => 1,
                'category_id' => 3,
                'name' => '筆電',
                'description' => '筆電是一種便攜式的個人電腦，因為其方便攜帶和使用而受到廣泛的歡迎。筆電可以在無需外接電源的情況下運行，並且通常具有內置的鍵盤、觸控板、顯示屏等設備，使其可以像桌面電腦一樣完成各種任務，例如瀏覽網頁、處理文檔、娛樂和遊戲等。',
                'price' => 23999.00,
                'state' => 'published',
                'quantity' => 11,
                'created_at' => '2023-04-02 13:25:35',
                'updated_at' => '2023-04-10 16:02:25'
            ],
            [
                'user_id' => 1,
                'category_id' => 10,
                'name' => '腳踏車',
                'description' => '腳踏車是一種兩輪運動工具，由車架、兩個輪子、車把、座墊、鏈條、踏板等部件組成。腳踏車是一種人力運動工具，通過人力踩動踏板來驅動鏈條帶動車輪轉動，從而實現運動或交通工具的功能。。',
                'price' => 1000.00,
                'state' => 'published',
                'quantity' => 70,
                'created_at' => '2023-04-02 13:35:22',
                'updated_at' => '2023-04-06 13:53:10'
            ],
            [
                'user_id' => 1,
                'category_id' => 9,
                'name' => '餅乾',
                'description' => '餅乾是一種小巧、甜味的烘焙食品，通常由麵粉、糖、牛油、蛋等原料製成。餅乾的製作過程通常是先將麵粉、糖、牛油、蛋等原料混合在一起，然後再烘焙在烤箱中。',
                'price' => 100.00,
                'state' => 'published',
                'quantity' => 10,
                'created_at' => '2023-04-02 13:36:17',
                'updated_at' => '2023-04-06 13:53:20'
            ],
            [
                'user_id' => 1,
                'category_id' => 1,
                'name' => '書',
                'description' => '書是一種印刷品，通常由紙張和墨水製成，用來傳遞知識、故事、想法和觀點等。書是人類文化傳承和知識积累的重要途徑之一，是一種非常重要的文化遺產。',
                'price' => 250.00,
                'state' => 'published',
                'quantity' => 29,
                'created_at' => '2023-04-02 13:37:39',
                'updated_at' => '2023-04-09 12:57:04'
            ],
            [
                'user_id' => 1,
                'category_id' => 10,
                'name' => '手錶',
                'description' => '手錶是一種戴在手腕上的計時裝置，通常由錶盤、錶帶和時針等組件組成。手錶可以通過機械、電子或者光學的方式進行計時，其功能也可以包括報時、計時、計步、心率監測等。',
                'price' => 2000.00,
                'state' => 'published',
                'quantity' => 49,
                'created_at' => '2023-04-02 13:38:17',
                'updated_at' => '2023-04-09 12:54:53'
            ],
            [
                'user_id' => 1,
                'category_id' => 4,
                'name' => '手機',
                'description' => '手機是一種便攜式的通訊設備，通過無線電訊號實現語音通話、短信、視頻通話等功能。手機也稱為智能手機，因為它除了傳統的通訊功能外，還可以通過應用程序、網絡、傳感器等技術實現更多的功能，例如社交媒體、地圖導航、音樂播放、攝影和影像錄制等。',
                'price' => 10000.00,
                'state' => 'published',
                'quantity' => 50,
                'created_at' => '2023-04-02 13:39:39',
                'updated_at' => '2023-04-06 13:53:47'
            ],
            [
                'user_id' => 1,
                'category_id' => 4,
                'name' => '滑鼠',
                'description' => '滑鼠是一種計算機輸入設備，通過在桌面或墊子上滑動移動滑鼠器體，可以在計算機屏幕上移動鼠標游標。滑鼠通常具有左右鍵和滾輪，可以通過單擊或雙擊左鍵來執行不同的操作，例如打開應用程序、選擇菜單項目、編輯文本等。右鍵通常用於顯示上下文菜單，其中包含與鼠標游標位置相關的操作。滾輪通常用於瀏覽文檔或網頁，可以垂直或水平滾動文本或圖像。',
                'price' => 500.00,
                'state' => 'published',
                'quantity' => 50,
                'created_at' => '2023-04-02 13:40:26',
                'updated_at' => '2023-04-02 13:40:26'
            ],
            [
                'user_id' => 1,
                'category_id' => 8,
                'name' => '椅子',
                'description' => '椅子是一種坐具，由座面、靠背和腳架等組件組成。椅子是人類日常生活中必不可少的家居裝飾品，除了作為坐具之外，還具有美學和藝術價值。',
                'price' => 400.00,
                'state' => 'published',
                'quantity' => 50,
                'created_at' => '2023-04-02 13:42:18',
                'updated_at' => '2023-04-06 13:53:56'
            ],
            [
                'user_id' => 1,
                'category_id' => 4,
                'name' => '耳機',
                'description' => '耳機是一種可以戴在耳朵上聆聽音樂、收聽廣播和接聽電話的裝置。耳機由聲音單元、連接線、耳機外殼等部分組成，通過將聲音單元放置在耳朵上，使人們能夠輕鬆地收聽音樂和聲音。',
                'price' => 1500.00,
                'state' => 'published',
                'quantity' => 19,
                'created_at' => '2023-04-02 13:44:03',
                'updated_at' => '2023-04-09 12:54:53'
            ],
            [
                'user_id' => 1,
                'category_id' => 4,
                'name' => '音響',
                'description' => '音響是一種將電子信號轉換為聲音的設備，主要由音頻放大器、揚聲器和音源等部分組成。音響通常用於音樂播放、電影院、演唱會等場合，旨在提供高質量、高保真的音效體驗。',
                'price' => 3000.00,
                'state' => 'published',
                'quantity' => 50,
                'created_at' => '2023-04-02 13:44:46',
                'updated_at' => '2023-04-06 13:54:18'
            ],
            [
                'user_id' => 1,
                'category_id' => 8,
                'name' => '電視',
                'description' => '電視是一種通過電波或者網絡傳輸影像和聲音的設備，用於播放電視節目、電影、新聞、體育賽事等多種內容。電視主要由顯示屏、機身、揚聲器和遙控器等組件組成。',
                'price' => 10000.00,
                'state' => 'published',
                'quantity' => 49,
                'created_at' => '2023-04-02 13:48:37',
                'updated_at' => '2023-04-09 12:54:53'
            ],
            [
                'user_id' => 1,
                'category_id' => 7,
                'name' => '跑步鞋',
                'description' => '鞋子是一種穿在腳上保護腳部的物品，通常由鞋面、鞋底和鞋身組成。每種鞋子都有其獨特的用途和風格，並且在不同的文化和地區有著不同的風格和意義。',
                'price' => 2000.00,
                'state' => 'published',
                'quantity' => 30,
                'created_at' => '2023-04-10 16:05:10',
                'updated_at' => '2023-04-10 16:05:10'
            ]
        ]);
    }
}
