<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class ThuocTinhSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        for ($i=1; $i <=5; $i++) { 
            DB::table('thuoc_tinhs')->insert([
              
                'id'=> "$i",
                'ten_thuoc_tinh'=>"S",
               
            ]);
        }
    }
}
