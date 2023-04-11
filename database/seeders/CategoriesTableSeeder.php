<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CategoriesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
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
    }
}
