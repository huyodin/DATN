<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class AreasTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('areas')->insert([
            ['name' => 'Hà Nội', 'thumbnail' => 'img/ha_noi.jpg'],
            ['name' => 'TP. Hồ Chí Minh', 'thumbnail' => 'img/ho_chi_minh.jpg'],
            ['name' => 'Đà Nẵng', 'thumbnail' => 'img/da_nang.jpg'],
            ['name' => 'Hội An', 'thumbnail' => 'img/hoi_an.jpg'],
            ['name' => 'Huế', 'thumbnail' => 'img/hue.jpg'],
            ['name' => 'Nha Trang', 'thumbnail' => 'img/nha_trang.jpg'],
            ['name' => 'Hà Giang', 'thumbnail' => 'img/ha_giang.jpg'],
            ['name' => 'Phú Quốc', 'thumbnail' => 'img/phu_quoc.jpg'],
            ['name' => 'Sa Pa', 'thumbnail' => 'img/sapa.jpg'],
            ['name' => 'Hạ Long', 'thumbnail' => 'img/quang_ninh.jpg'],
        ]);
    }
}
