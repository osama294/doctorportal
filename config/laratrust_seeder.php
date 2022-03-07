<?php

return [
    /**
     * Control if the seeder should create a user per role while seeding the data.
     */
    'create_users' => false,

    /**
     * Control if all the laratrust tables should be truncated before running the seeder.
     */
    'truncate_tables' => true,

    'roles_structure' => [

        'superadministrator' => [
            'dashboard'    => 'r',
            'users'        => 'c,r,u,a',
            'role'         => 'c,r,u,a',
            'permission'   => 'r',
            'category'     => 'c,r,u,d,s',
            'sub-category' => 'c,r,u,d,s',
            'illness'      => 'c,r,u,d,s',
            'symptoms'     => 'c,r,u,d,s',
            'doctor'       => 'c,r,u,d,s,v',
            'patient'      => 'c,r,u,d,s,v',
            'appointment'  => 'r,d,s,a',
        ],
        'administrator' => [
            'dashboard'    => 'r',
            'users'        => 'c,r,u,a',
            'role'         => 'c,r,u,a',
            'permission'   => 'r',
            'category'     => 'c,r,u,d,s',
            'sub-category' => 'c,r,u,d,s',
            'illness'      => 'c,r,u,d,s',
            'symptoms'     => 'c,r,u,d,s',
            'doctor'       => 'c,r,u,d,s,v',
            'patient'      => 'c,r,u,d,s,v',
            'appointment'  => 'r,d,s,a',
        ],
        // 'doctor' => [
        //     'dashboard'    => 'r',
        //     'users'        => 'c,r,u,a',
        //     'role'         => 'c,r,u,a',
        //     'permission'   => 'r',
        //     'category'     => 'c,r,u,d,s',
        //     'sub-category' => 'c,r,u,d,s',
        //     'illness'      => 'c,r,u,d,s',
        //     'symptoms'     => 'c,r,u,d,s',
        //     'doctor'       => 'c,r,u,d,s,v',
        //     'patient'      => 'c,r,u,d,s,v',
        //     'appointment'  => 'r,d,s,a',
        // ]

    ],

    'permissions_map' => [
        'c' => 'create',
        'r' => 'read',
        'u' => 'update',
        'd' => 'delete',
        's' => 'status',
        'v' => 'view',
        'a' => 'assign'
    ]
];
