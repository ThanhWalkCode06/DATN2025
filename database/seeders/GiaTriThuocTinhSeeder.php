<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class GiaTriThuocTinhSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        for ($i=1; $i <=5; $i++) { 
            DB::table('gia_tri_thuoc_tinhs')->insert([
              
                'id'=> "$i",
                'thuoc_tinh_id'=>7,
                'gia_tri'=>"L",
                'created_at' => now(),
                'updated_at' => now(),
               
            ]);
        }
    }
}
