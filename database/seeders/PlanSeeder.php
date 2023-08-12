<?php

namespace Database\Seeders;

use App\Models\Plan;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class PlanSeeder extends Seeder
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
                'num_ads'=>'1',
                'num_days'=>'30',
                'price'=>'3',
                'is_permium'=>false,
            ],
            [
                'num_ads'=>'3',
                'num_days'=>'30',
                'price'=>'9',
                'is_permium'=>false,
            ],
            [
                'num_ads'=>'10',
                'num_days'=>'30',
                'price'=>'25',
                'is_permium'=>false,
            ],
            [
                'num_ads'=>'30',
                'num_days'=>'30',
                'price'=>'75',
                'is_permium'=>false,
            ],
            [
                'num_days'=>'30',
                'price'=>'5',
                'is_permium'=>true,
            ],
        ];

        foreach($data as $d)
        {
            Plan::firstOrCreate($d);
        }
    }
}
