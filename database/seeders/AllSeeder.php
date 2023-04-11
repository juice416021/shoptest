<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class AllSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('users')->insert([
            [
                'id' => 1,
                'name' => 'admin測試',
                'email' => 'admintest@gmail.com',
                'email_verified_at' => '2023-04-04 02:08:12',
                'password' => '$2y$10$sOXEZYiXdNitO/CVkDEJsOwnqG19GYr.XUz84vB7qYBq14qPV7uBi',
                'facebook_id' => NULL,
                'two_factor_secret' => NULL,
                'two_factor_recovery_codes' => NULL,
                'two_factor_confirmed_at' => NULL,
                'remember_token' => NULL,
                'current_team_id' => NULL,
                'profile_photo_path' => NULL,
                'role' => 'admin',
                'created_at' => '2023-04-10 16:14:34',
                'updated_at' => '2023-04-10 16:14:34',
            ],
            [
                'id' => 2,
                'name' => 'user測試',
                'email' => 'usertest@gmail.com',
                'email_verified_at' => '2023-04-04 02:08:12',
                'password' => '$2y$10$odK0atpPUy48FiljONEmw.U7Mgm2x00uemcMNBhpjOmeLcDh4rnCa',
                'facebook_id' => NULL,
                'two_factor_secret' => NULL,
                'two_factor_recovery_codes' => NULL,
                'two_factor_confirmed_at' => NULL,
                'remember_token' => NULL,
                'current_team_id' => NULL,
                'profile_photo_path' => NULL,
                'role' => 'user',
                'created_at' => '2023-04-10 16:14:34',
                'updated_at' => '2023-04-10 16:14:34',
            ]
        ]);


        DB::table('categories')->insert([
            [
                'name' => '書籍',
                'photo_path' => 'categories/1680583937.jpg',
                'created_at' => '2023-04-04 04:18:49',
                'updated_at' => '2023-04-04 04:52:17',
            ],
            [
                'name' => '汽車/機車',
                'photo_path' => 'categories/1680581946.jpg',
                'created_at' => '2023-04-04 04:19:06',
                'updated_at' => '2023-04-04 16:06:43',
            ],
            [
                'name' => '電腦/筆電',
                'photo_path' => 'categories/1680581962.jpg',
                'created_at' => '2023-04-04 04:19:22',
                'updated_at' => '2023-04-04 04:19:22',
            ],
            [
                'name' => '3C周邊',
                'photo_path' => 'categories/1680581976.jpg',
                'created_at' => '2023-04-04 04:19:36',
                'updated_at' => '2023-04-04 04:19:36',
            ],
            [
                'name' => '玩具',
                'photo_path' => 'categories/1680581998.jpg',
                'created_at' => '2023-04-04 04:19:59',
                'updated_at' => '2023-04-04 04:19:59',
            ],
            [
                'name' => '衣服',
                'photo_path' => 'categories/1680582008.jpg',
                'created_at' => '2023-04-04 04:20:09',
                'updated_at' => '2023-04-04 04:20:09',
            ],
            [
                'name' => '鞋子',
                'photo_path' => 'categories/1680582020.jpg',
                'created_at' => '2023-04-04 04:20:20',
                'updated_at' => '2023-04-04 04:20:20',
            ],
            [
                'name' => '家具',
                'photo_path' => 'categories/1680582042.jpg',
                'created_at' => '2023-04-04 04:20:42',
                'updated_at' => '2023-04-04 04:20:42',
            ],
            [
                'name' => '零食',
                'photo_path' => 'categories/1680582056.jpg',
                'created_at' => '2023-04-04 04:20:57',
                'updated_at' => '2023-04-04 04:20:57',
            ],
            [
                'name' => '其他',
                'photo_path' => 'categories/1680582065.png',
                'created_at' => '2023-04-04 04:21:05',
                'updated_at' => '2023-04-04 04:21:05',
            ]
        ]);

        DB::table('products')->insert([
            [
                'user_id' => 1,
                'category_id' => 3,
                'name' => '筆電',
                'description' => '筆電是一種便攜式的電腦。',
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
                'description' => '腳踏車是一種交通工具。',
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
                'description' => '餅乾是一種小吃點心。',
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
                'description' => '書是一種印刷品。',
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
                'description' => '手錶是一種計時器。',
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
                'description' => '手機是一種便攜式的通訊設備，除了基本的通訊功能外，還可以通過應用程式與網路連線，享受多媒體、遊戲、攝影等豐富的功能。',
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
                'description' => '滑鼠是一種計算機輸入設備，用於移動指標、選取和操作電腦中的文字、圖像等元素。',
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
                'description' => '椅子是一種坐具，由座面、靠背和腳架等組件組成。椅子的價值不僅在於提供坐姿舒適的支撐，還可以影響空間的風格和氛圍。',
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
                'description' => '耳機是一種個人音響裝置，用於聆聽音樂、通話等。',
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
                'description' => '音響是一種電子設備，用於播放音樂、電影等。',
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
                'description' => '電視是一種家庭娛樂設備，用於觀看電視節目、電影等。',
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
                'description' => '跑步鞋是一種專門用於跑步運動的鞋子。',
                'price' => 2000.00,
                'state' => 'published',
                'quantity' => 30,
                'created_at' => '2023-04-10 16:05:10',
                'updated_at' => '2023-04-10 16:05:10'
            ]
        ]);

        DB::table('product_images')->insert([
            [
                'id' => 1,
                'product_id' => 1,
                'path' => 'product-photos/VpqD5xtSEjsGVm1sY7DrcFAIzSitA7LFh6rKIv5H.jpg',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'id' => 2,
                'product_id' => 2,
                'path' => 'product-photos/dfIGYRQoOTPqKCxyA5moKTaAFjsizdKgvyL2qq1i.jpg',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'id' => 3,
                'product_id' => 3,
                'path' => 'product-photos/425cp38lOnd7oc6hix30u6zg9pNC25hcv5PsHz6X.jpg',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'id' => 4,
                'product_id' => 4,
                'path' => 'product-photos/dU1O5fU2vttRsKs5anOFhETOwxoH2MXkRzrsu3A2.jpg',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'id' => 5,
                'product_id' => 5,
                'path' => 'product-photos/q7SUuHDyHn6WaKvme5aaKNALMoM0WHSIjFrPl4Pb.jpg',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'id' => 6,
                'product_id' => 6,
                'path' => 'product-photos/9KeI9Fih55ZMDriFYm2kVwHuUt1Pp9xxhWJVpcQE.jpg',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'id' => 7,
                'product_id' => 7,
                'path' => 'product-photos/FtAyWv0xjyAUP0lFszxeGfoUd5CPwqdsgRLSh57L.jpg',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'id' => 8,
                'product_id' => 8,
                'path' => 'product-photos/juyi9ML8LesOdEmGRBFcWVDC15ZKlTN8wEdkRE1Q.jpg',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [   'id' => 9,
                'product_id' => 9,
                'path' => 'product-photos/WDNHdAC94jFvNbIj8SknPVKdM9JYqweZqEFQGPVY.jpg',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'id' => 10,
                'product_id' => 10,
                'path' => 'product-photos/9C3BWO1GiAgFTFbfwxYfEUnOa9u2aP9OjFAp8V9w.jpg',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'id' => 11,
                'product_id' => 11,
                'path' => 'product-photos/BmZJVeeA9W0BHkZrN9VgusmgoywYI8kuk7HWisKx.jpg',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'id' => 12,
                'product_id' => 12,
                'path' => 'product-photos/jcrRkTRTTMaUdieC4GLHJQDgNqLmlFt0KpRjUZyN.jpg',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'id' => 13,
                'product_id' => 12,
                'path' => 'product-photos/Ff3raukpU0THYbhmXgXCaV9EbeNLysEi8WvghY0a.jpg',
                'created_at' => now(),
                'updated_at' => now(),
            ]
        ]);


    }
}
