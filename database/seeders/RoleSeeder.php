<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;

class RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        $data =  [
            [
                'name'=>'SuperAdmin',
                'guard_name'=>'admin'
            ],
            [
                'name'=>'admin',
                'guard_name'=>'admin'
            ],
        ];

        foreach($data as $d)
        {
            Role::firstOrCreate($d);
        }
    }
}
