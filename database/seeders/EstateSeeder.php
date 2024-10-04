<?php

namespace Database\Seeders;

use App\Models\Estate;
use App\Models\EstateImage;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class EstateSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Estate::factory()
            ->count(10)
            ->hasImages(8)
            ->forUser()
            ->create();
    }
}
