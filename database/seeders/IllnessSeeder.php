<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Carbon\Carbon;

class IllnessSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        \App\Models\Illness::insert(array (
            0 => 
            array (
                'id' => 1,
                'name' => 'Migraine',
                'status' => 'Active',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ),
            1 => 
            array (
                'id' => 2,
                'name' => 'Asthama',
                'status' => 'Active',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ),
            2 => 
            array (
                'id' => 3,
                'name' => 'Low Blood Sugar',
                'status' => 'Active',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ),
            3 => 
            array (
                'id' => 4,
                'name' => 'High Blood',
                'status' => 'Active',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ),
            4 => 
            array (
                'id' => 5,
                'name' => 'Temprature',
                'status' => 'Active',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ),
        ));
    }
}
