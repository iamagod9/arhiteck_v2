<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class EstateTypeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('estate_types')->insert(['name' => "Новостройка", 'slug' => Str::slug('Новостройка', '-', 'ru')]);
        DB::table('estate_types')->insert(['name' => "Вторичное", 'slug' => Str::slug('Вторичное', '-', 'ru')]);
        DB::table('estate_types')->insert(['name' => "Дом, дача", 'slug' => Str::slug('Дом, дача', '-', 'ru')]);
        DB::table('estate_types')->insert(['name' => "Участок", 'slug' => Str::slug('Участок', '-', 'ru')]);
    }
}
