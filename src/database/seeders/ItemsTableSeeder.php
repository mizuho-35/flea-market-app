<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ItemsTableSeeder extends Seeder
{
    public function run(){
        DB::table('items')->insert([
            [
                'user_id' => 1,
                'item_name' => '腕時計',
                'brand' => 'Rolax',
                'price' => 15000,
                'description' => 'スタイリッシュなデザインのメンズ時計',
                'condition' => '良好',
                'item_image' => 'Armani+Mens+Clock.jpg'
            ],
            [
                'user_id' => 2,
                'item_name' => 'HDD',
                'brand' => '西芝',
                'price' => 5000,
                'description' => '高速で信頼性の高いハードディスク',
                'condition' => '目立った傷や汚れなし',
                'item_image' => 'HDD+Hard+Disk.jpg'
            ],
            [
                'user_id' => 3,
                'item_name' => '玉ねぎ3束',
                'brand' => 'なし',
                'price' => 300,
                'description' => '新鮮な玉ねぎ3束のセット',
                'condition' => 'やや傷や汚れあり',
                'item_image' => 'iLoveIMG+d.jpg'
            ],
            [
                'user_id' => 4,
                'item_name' => '革靴',
                'brand' => '',
                'price' => 4000,
                'description' => 'クラシックなデザインの革靴',
                'condition' => '状態が悪い',
                'item_image' => 'Leather+Shoes+Product+Photo.jpg'
            ],
            [
                'user_id' => 5,
                'item_name' => 'ノートPC',
                'brand' => '',
                'price' => 45000,
                'description' => '高性能なノートパソコン',
                'condition' => '良好',
                'item_image' => 'Living+Room+Laptop.jpg'
            ],
            [
                'user_id' => 6,
                'item_name' => 'マイク',
                'brand' => 'なし',
                'price' => 8000,
                'description' => '高音質のレコーディング用マイク',
                'condition' => '目立った傷や汚れなし',
                'item_image' => 'Music+Mic+4632231.jpg'
            ],
            [
                'user_id' => 7,
                'item_name' => 'ショルダーバッグ',
                'brand' => '',
                'price' => 3500,
                'description' => 'おしゃれなショルダーバッグ',
                'condition' => 'やや汚れや傷あり',
                'item_image' => 'Purse+fashion+pocket.jpg'
            ],
            [
                'user_id' => 8,
                'item_name' => 'タンブラー',
                'brand' => 'なし',
                'price' => 500,
                'description' => '使いやすいタンブラー',
                'condition' => '状態が悪い',
                'item_image' => 'Tumbler+souvenir.jpg'
            ],
            [
                'user_id' => 9,
                'item_name' => 'コーヒーミル',
                'brand' => 'Starbacks',
                'price' => 4000,
                'description' => '手動のコーヒーミル',
                'condition' => '良好',
                'item_image' => 'Waitress+with+Coffee+Grinder.jpg'
            ],
            [
                'user_id' => 10,
                'item_name' => 'メイクセット',
                'brand' => '',
                'price' => 2500,
                'description' => '便利なメイクアップセット',
                'condition' => '目立った傷や汚れなし',
                'item_image' => '外出メイクアップセット.jpg'
            ],
        ]);
    }
}
