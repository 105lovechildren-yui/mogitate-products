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
        $products = [
            [
                'name' => 'キウイ',
                'price' => 800,
                'image' => 'kiwi.png', //素材のファイル名
                'description' => 'キウイは甘みと酸味のバランスが絶妙なフルーツです。ビタミンCなどの栄養素も豊富のため、美肌効果や疲労回復効果も期待できます。もぎたてフルーツのスムージーをお召し上がりください！',
                'seasons' => [3, 4], //秋と冬
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'ストロベリー',
                'price' => 1200,
                'image' => 'strawberry.png', //素材のファイル名
                'description' => '大人から子どもまで大人気のストロベリー。当店では新鮮抜群の完熟いちごを使用しています。ビタミンCはもちろん食物繊維も豊富なため、腸内環境の改善も期待できます。もぎたてフルーツのスムージーをお召し上がりください!',
                'seasons' => [1], //春
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'オレンジ',
                'price' => 850,
                'image' => 'orange.png', //素材のファイル名
                'description' => '当店では酸味と甘みのバランスが抜群のネーブルオレンジを使用しています。酸味は控えめで、甘さと濃厚な果汁が魅力の商品です。もぎたてフルーツのスムージーをお召し上がりください!',
                'seasons' => [4], //冬
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'スイカ',
                'price' => 700,
                'image' => 'watermelon.png', //素材のファイル名
                'description' => '甘くてシャリシャリ食感が魅力のスイカ。全体の90％が水分のため、暑い日の水分補給や熱中症予防、カロリーが気になるかたにもおすすめの商品です。もぎたてフルーツのスムージーをお召し上がりください!',
                'seasons' => [2], //夏
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'ピーチ',
                'price' => 1000,
                'image' => 'peach.png', //素材のファイル名
                'description' => '豊潤な香りととろけるような甘さが魅力のピーチ。美味しさはもちろん見た目の可愛さも抜群の商品です。ビタミンEが豊富なため、生活習慣病の予防にもおすすめです。もぎたてフルーツのスムージーをお召し上がりください！',
                'seasons' => [2], //夏
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'シャインマスカット',
                'price' => 1400,
                'image' => 'muscat.png', //素材のファイル名
                'description' => '爽やかな香りと上品な甘みが特長的なシャインマスカットは大人から子どもまで大人気のフルーツです。疲れた脳や体のエネルギー補給にも最適の商品です。もぎたてフルーツのスムージーをお召し上がりください！',
                'seasons' => [2, 3], //夏と秋
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'パイナップル',
                'price' => 800,
                'image' => 'pineapple.png', //素材のファイル名
                'description' => '甘酸っぱさとトロピカルな香りが特徴のパイナップル。当店では甘さと酸味のバランスが絶妙な国産のパイナップルを使用しています。もぎたてフルーツのスムージをお召し上がりください！',
                'seasons' => [1, 2], //春と夏
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'ブドウ',
                'price' => 1100,
                'image' => 'grapes.png', //素材のファイル名
                'description' => 'ブドウの中でも人気の高い国産の「巨峰」を使用しています。高い糖度と適度な酸味が魅力で、鮮やかなパープルで見た目も可愛い商品です。もぎたてフルーツのスムージーをお召し上がりください！',
                'seasons' => [2, 3], //夏と秋
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'バナナ',
                'price' => 600,
                'image' => 'banana.png', //素材のファイル名
                'description' => '低カロリーでありながら栄養満点のため、ダイエット中の方にもおすすめの商品です。1杯でバナナの濃厚な甘みを存分に堪能できます。もぎたてフルーツのスムージーをお召し上がりください！',
                'seasons' => [2], //夏
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'メロン',
                'price' => 900,
                'image' => 'melon.png', //素材のファイル名
                'description' => '香りがよくジューシーで品のある甘さが人気のメロンスムージー。カリウムが多く含まれているためむくみ解消効果も抜群です。もぎたてフルーツのスムージーをお召し上がりください！',
                'seasons' => [1, 2], //春と夏
                'created_at' => now(),
                'updated_at' => now(),
            ]
        ];

        foreach ($products as $item) {
            //商品テーブルに商品を登録(ID取得のため)
            $productId = DB::table('products')->insertGetId([
                'name' => $item['name'],
                'price' => $item['price'],
                'image' => $item['image'],
                'description' => $item['description'],
                'created_at' => now(),
                'updated_at' => now(),
            ]);

            //商品と季節の紐付け
            $seasonData = [];
            foreach ($item['seasons'] as $seasonId) {
                $seasonData[] = [
                    'product_id' => $productId,
                    'season_id' => $seasonId,
                    'created_at' => now(),
                    'updated_at' => now(),
                ];
            }
            DB::table('product_season')->insert($seasonData);
        }
    }
}
