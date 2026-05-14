<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CategorySeeder extends Seeder
{
    public function run(): void
    {
        $now = now();

        DB::table('categories')->insert([
            ['name' => 'Website',   'slug' => 'website',   'created_at' => $now, 'updated_at' => $now],
            ['name' => 'Mobile', 'slug' => 'mobile', 'created_at' => $now, 'updated_at' => $now]
        ]);
    }
}
