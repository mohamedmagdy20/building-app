<?php

namespace Database\Seeders;

use App\Models\Setting;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class SettingSeeder extends Seeder
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
                'key'=>'logo',
                'value'=>'logo.png'
            ],
            [
                'key'=>'splach',
                'value'=>'splach.png'
            ]
        ];

        foreach($data as $d)
        {
            Setting::firstOrCreate($d);
        }

        
    }
}
