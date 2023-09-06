<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;

class PermissionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        $data = [
            [
                'name'=>'Show_Admins',
                'guard_name'=>'admin'
            ],
            [
                'name'=>'Add_Admins',
                'guard_name'=>'admin'
            ],
            [
                'name'=>'Edit_Admins',
                'guard_name'=>'admin'
            ],
            [
                'name'=>'Delete_Admins',
                'guard_name'=>'admin'
            ],
            [
                'name'=>'Show_Roles',
                'guard_name'=>'admin'
            ],
            [
                'name'=>'Show_Permission',
                'guard_name'=>'admin'
            ],

            [
                'name'=>'Edit_Permission',
                'guard_name'=>'admin'
            ],

            [
                'name'=>'Show_Users',
                'guard_name'=>'admin'
            ],
            [
                'name'=>'Delete_User',
                'guard_name'=>'admin'
            ],

            [
                'name'=>'Show_Advertises',
                'guard_name'=>'admin'
            ],
            [
                'name'=>'Add_Advertises',
                'guard_name'=>'admin'
            ],
            [
                'name'=>'Edit_Advertises',
                'guard_name'=>'admin'
            ],
            [
                'name'=>'Delete_Advertises',
                'guard_name'=>'admin'
            ],

            [
                'name'=>'Show_Advertisments',
                'guard_name'=>'admin'
            ],
            [
                'name'=>'Accept_Advertisments',
                'guard_name'=>'admin'
            ],
            [
                'name'=>'Block_Advertisments',
                'guard_name'=>'admin'
            ],
            [
                'name'=>'Show_Plans',
                'guard_name'=>'admin'
            ],
            [
                'name'=>'Add_Plans',
                'guard_name'=>'admin'
            ],
            [
                'name'=>'Edit_Plans',
                'guard_name'=>'admin'
            ],
            [
                'name'=>'Delete_Plans',
                'guard_name'=>'admin'
            ],

            [
                'name'=>'Show_Settings',
                'guard_name'=>'admin'
            ],
            [
                'name'=>'Edit_Settings',
                'guard_name'=>'admin'
            ],

            [
                'name'=>'Show_Search_History',
                'guard_name'=>'admin'
            ],

            [
                'name'=>'Edit_Users',
                'guard_name'=>'admin'
            ],
            [
                'name'=>'Show_Statictics',
                'guard_name'=>'admin'                
            ],
            [
                'name'=>'Show_Areas',
                'guard_name'=>'admin'
            ],
            [
                'name'=>'Add_Areas',
                'guard_name'=>'admin'
            ],
            [
                'name'=>'Edit_Areas',
                'guard_name'=>'admin'
            ],
            [
                'name'=>'Delete_Areas',
                'guard_name'=>'admin'
            ],

            [
                'name'=>'Show_Category',
                'guard_name'=>'admin'
            ],
            [
                'name'=>'Add_Category',
                'guard_name'=>'admin'
            ],
            [
                'name'=>'Edit_Category',
                'guard_name'=>'admin'
            ],
            [
                'name'=>'Delete_Category',
                'guard_name'=>'admin'
            ],
        ];

        foreach($data as $d)
        {
            Permission::firstOrCreate($d);
        }
    }
}
