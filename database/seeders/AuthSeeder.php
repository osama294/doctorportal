<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use Carbon\Carbon;

class AuthSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // $data = array(
        //     'name' => "Health Hub",
        //     'email' => 'admin@admin.com',
        //     'password' => bcrypt('password'),
        //     'type' => 'Admin',
        // );
        // User::create($data);
        $data = User::create([
            'name' => 'Doctor Uk',
                'email' => 'admin@admin.com',
                'password' => bcrypt('password'),
                'contact' => '03140000000',
                'gender' => 'Male',
                'address' => 'I8 Markaz Isamabad',
                'date_of_birth' => '10/3/1997',
                'medical_record' => 'None',
                'type' => 'Admin',
                'status' => 'Active',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
        ]);
        $data->syncRoles([1]);

        // \App\Models\User::insert(array (
        //     0 => 
        //     array (
        //         'id' => 1,
        //         'name' => 'Health Hub',
        //         'email' => 'admin@admin.com',
        //         'password' => bcrypt('password'),
        //         'contact' => '03140000000',
        //         'gender' => 'Male',
        //         'address' => 'I8 Markaz Isamabad',
        //         'date_of_birth' => '10/3/1997',
        //         'medical_record' => 'None',
        //         'type' => 'Admin',
        //         'status' => 'Active',
        //         'created_at' => Carbon::now(),
        //         'updated_at' => Carbon::now()
        //     ),
        //     1 => 
        //     array (
        //         'id' => 2,
        //         'name' => 'Patient One',
        //         'email' => 'patientone@admin.com',
        //         'password' => bcrypt('password'),
        //         'contact' => '03140000000',
        //         'gender' => 'Male',
        //         'address' => 'I8 Markaz Isamabad',
        //         'date_of_birth' => '10/3/1997',
        //         'medical_record' => 'None',
        //         'type' => 'Patient',
        //         'status' => 'Active',
        //         'created_at' => Carbon::now(),
        //         'updated_at' => Carbon::now()
        //     ),
        //     2 => 
        //     array (
        //         'id' => 3,
        //         'name' => 'Patient Two',
        //         'email' => 'patienttwo@admin.com',
        //         'password' => bcrypt('password'),
        //         'contact' => '03140000000',
        //         'gender' => 'Male',
        //         'address' => 'I8 Markaz Isamabad',
        //         'date_of_birth' => '10/3/1997',
        //         'medical_record' => 'None',
        //         'type' => 'Patient',
        //         'status' => 'Active',
        //         'created_at' => Carbon::now(),
        //         'updated_at' => Carbon::now()
        //     ),
        //     3 => 
        //     array (
        //         'id' => 4,
        //         'name' => 'Patient Three',
        //         'email' => 'patientthree@admin.com',
        //         'password' => bcrypt('password'),
        //         'contact' => '03140000000',
        //         'gender' => 'Male',
        //         'address' => 'I8 Markaz Isamabad',
        //         'date_of_birth' => '10/3/1997',
        //         'medical_record' => 'None',
        //         'type' => 'Patient',
        //         'status' => 'Active',
        //         'created_at' => Carbon::now(),
        //         'updated_at' => Carbon::now()
        //     ),
        //     4 => 
        //     array (
        //         'id' => 5,
        //         'name' => 'Doctor',
        //         'email' => 'doctorone@admin.com',
        //         'password' => bcrypt('password'),
        //         'contact' => '03140000000',
        //         'gender' => 'Male',
        //         'address' => 'I8 Markaz Isamabad',
        //         'date_of_birth' => '10/3/1997',
        //         'medical_record' => 'None',
        //         'type' => 'Doctor',

        //         'status' => 'Active',
        //         'created_at' => Carbon::now(),
        //         'updated_at' => Carbon::now()
        //     ),
        //     5 => 
        //     array (
        //         'id' => 6,
        //         'name' => 'Doctor Two',
        //         'email' => 'doctortwo@admin.com',
        //         'password' => bcrypt('password'),
        //         'contact' => '03140000000',
        //         'gender' => 'Male',
        //         'address' => 'I8 Markaz Isamabad',
        //         'date_of_birth' => '10/3/1997',
        //         'medical_record' => 'None',
        //         'type' => 'Doctor',
         
        //         'status' => 'Active',
        //         'created_at' => Carbon::now(),
        //         'updated_at' => Carbon::now()
        //     ),
        //     6 => 
        //     array (
        //         'id' => 7,
        //         'name' => 'Doctor Three',
        //         'email' => 'doctorthree@admin.com',
        //         'password' => bcrypt('password'),
        //         'contact' => '03140000000',
        //         'gender' => 'Male',
        //         'address' => 'I8 Markaz Isamabad',
        //         'date_of_birth' => '10/3/1997',
        //         'medical_record' => 'None',
        //         'type' => 'Doctor',
           
        //         'status' => 'Active',
        //         'created_at' => Carbon::now(),
        //         'updated_at' => Carbon::now()
        //     ),
            // 7 => 
            // array (
            //     'id' => 8,
            //     'name' => 'Pediatrician',
            //     'image' => '1640691932.png',
            //     'url' => '/image/category/1640691932.png',
            //     'status' => 'Active',
            //     'created_at' => Carbon::now(),
            //     'updated_at' => Carbon::now()
            // ),
            // 8 => 
            // array (
            //     'id' => 9,
            //     'name' => 'GP',
            //     'image' => '1640691944.png',
            //     'url' => '/image/category/1640691944.png',
            //     'status' => 'Active',
            //     'created_at' => Carbon::now(),
            //     'updated_at' => Carbon::now()
            // ),
        // ));
    }

    
}
