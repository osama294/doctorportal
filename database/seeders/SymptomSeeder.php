<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Carbon\Carbon;

class SymptomSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        \App\Models\Symptom::insert(array (
            0 => 
            array (
                'id' => 1,
                'name' => 'Fatigue',
                'status' => 'Active',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ),
            1 => 
            array (
                'id' => 2,
                'name' => 'Dry cough',
                'status' => 'Active',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ),
            2 => 
            array (
                'id' => 3,
                'name' => 'Nausea',
                'status' => 'Active',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ),
            3 => 
            array (
                'id' => 4,
                'name' => 'Fatigue One',
                'status' => 'Active',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ),
            4 => 
            array (
                'id' => 5,
                'name' => 'Nausea One',
                'status' => 'Active',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ),
        ));
    }
}
