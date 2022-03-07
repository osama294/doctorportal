<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Carbon\Carbon;

class SubcategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        \App\Models\Subcategory::insert(array (
            0 => 
            array (
                'id' => 1,
                'cat_id' => 1,
                'image' => '1640691711.png',
                'url' => '/image/category/1640691711.png',
                'name' => 'Dental One',
                'status' => 'Active',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ),
            1 => 
            array (
                'id' => 2,
                'cat_id' => 2,
                'image' => '1640691711.png',
                'url' => '/image/category/1640691711.png',
                'name' => 'Dental Two',
                'status' => 'Active',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ),
            2 => 
            array (
                'id' => 3,
                'cat_id' => 1,
                'image' => '1640691711.png',
                'url' => '/image/category/1640691711.png',
                'name' => 'Dental Three',
                'status' => 'Active',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ),
            3 => 
            array (
                'id' => 4,
                'cat_id' => 1,
                'image' => '1640691711.png',
                'url' => '/image/category/1640691711.png',
                'name' => 'Dental Four',
                'status' => 'Active',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ),
            4 => 
            array (
                'id' => 5,
                'cat_id' => 2,
                'image' => '1640691711.png',
                'url' => '/image/category/1640691711.png',
                'name' => 'Oftalmology One',
                'status' => 'Active',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ),
            5 => 
            array (
                'id' => 6,
                'cat_id' => 2,
                'image' => '1640691711.png',
                'url' => '/image/category/1640691711.png',
                'name' => 'Oftalmology Two',
                'status' => 'Active',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ),
            6 => 
            array (
                'id' => 7,
                'cat_id' => 2,
                'image' => '1640691711.png',
                'url' => '/image/category/1640691711.png',
                'name' => 'Oftalmology Three',
                'status' => 'Active',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ),
            7 => 
            array (
                'id' => 8,
                'cat_id' => 3,
                'image' => '1640691711.png',
                'url' => '/image/category/1640691711.png',
                'name' => 'Oftalmology Four',
                'status' => 'Active',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ),
            8 => 
            array (
                'id' => 9,
                'cat_id' => 3,
                'image' => '1640691711.png',
                'url' => '/image/category/1640691711.png',
                'name' => 'Pulmonology One',
                'status' => 'Active',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ),
        ));
    }
}
