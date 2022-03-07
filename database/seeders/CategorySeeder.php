<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Carbon\Carbon;

class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        \App\Models\Category::insert(array (
            0 => 
            array (
                'id' => 1,
                'name' => 'Dental',
                'image' => '1640691711.png',
                'url' => '/image/category/1640691711.png',
                'status' => 'Active',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ),
            1 => 
            array (
                'id' => 2,
                'name' => 'Oftalmology',
                'image' => '1640691745.png',
                'url' => '/image/category/1640691745.png',
                'status' => 'Active',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ),
            2 => 
            array (
                'id' => 3,
                'name' => 'Pulmonology',
                'image' => '1640691777.png',
                'url' => '/image/category/1640691777.png',
                'status' => 'Active',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ),
            3 => 
            array (
                'id' => 4,
                'name' => 'Obstetrician',
                'image' => '1640691815.png',
                'url' => '/image/category/1640691815.png',
                'status' => 'Active',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ),
            4 => 
            array (
                'id' => 5,
                'name' => 'Orthopedia',
                'image' => '1640691835.png',
                'url' => '/image/category/1640691835.png',
                'status' => 'Active',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ),
            5 => 
            array (
                'id' => 6,
                'name' => 'Counseling',
                'image' => '1640691856.png',
                'url' => '/image/category/1640691856.png',
                'status' => 'Active',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ),
            6 => 
            array (
                'id' => 7,
                'name' => 'Dermathology',
                'image' => '7 (3).png',
                'url' => '/image/category/7 (3).png',
                'status' => 'Active',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ),
            7 => 
            array (
                'id' => 8,
                'name' => 'Pediatrician',
                'image' => '1640691932.png',
                'url' => '/image/category/1640691932.png',
                'status' => 'Active',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ),
            8 => 
            array (
                'id' => 9,
                'name' => 'GP',
                'image' => '1640691944.png',
                'url' => '/image/category/1640691944.png',
                'status' => 'Active',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ),
        ));
    }
}
