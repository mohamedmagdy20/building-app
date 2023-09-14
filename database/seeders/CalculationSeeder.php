<?php

namespace Database\Seeders;

use App\Models\Calculation;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class CalculationSeeder extends Seeder
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
                'key'=>'Land',
            ],
            [
                'key'=>'Building',
            ],
            
            [
                'key'=>'375 m',
            ],
            
            
            [
                'key'=>'375 m',
            ],
            [
                'key'=>'400 m',
            ],
            [
                'key'=>'450 m',
            ],
            [
                'key'=>'500 m',
            ],
            [
                'key'=>'550 m',
            ],
            [
                'key'=>'600 m',
            ],
            [
                'key'=>'650 m',
            ],
            [
                'key'=>'700 m',
            ],
            [
                'key'=>'750 m',
            ],
            [
                'key'=>'800 m',
            ],
            [
                'key'=>'850 m',
            ],
            [
                'key'=>'900 m',
            ],
            [
                'key'=>'950 m',
            ],
            [
                'key'=>'1000 m',
            ],
            [
                'key'=>'One Street',
            ],
            [
                'key'=>'Two Street With Front and Back',
            ],
            [
                'key'=>'Two Street With Angle',
            ],
            [
                'key'=>'Three Street',
            ],

            [
                'key'=>'Internal',
            ],
            [
                'key'=>'Main Internal',
            ],

            [
                'key'=>'Main Between Two Pices',
            ],
            [
                'key'=>'Genral Main Line',
            ],
            [
                'key'=>'North Direction',
            ],
            [
                'key'=>'South Direction',
            ],
            [
                'key'=>'Eastern Direction',
            ],
            [
                'key'=>'Western Direction',
            ],

            [
                'key'=>'Less Than 3m',
            ],
            [
                'key'=>'Between 3 and 5 m',
            ],    
            [
                'key'=>'Between 6 and 9 m',
            ],
            
            [
                'key'=>'Between 10 and 14 m',
            ],
            
            [
                'key'=>'Between 15 and 20 m',
            ],
            
            [
                'key'=>'Between 31 and 40 m',
            ],
            [
                'key'=>'Between 41 and 50 m',
            ],    
            [
                'key'=>'More Than 50',
            ],

            [
                'key'=>'Has a bus station',
            ],
            
            [
                'key'=>'Has a lighting pole',
            ],

            
            [
                'key'=>'Has common rebound',
            ],
            [
                'key'=>'Has Road',
            ],
            [
                'key'=>'Has rail',
            ],
            [
                'key'=>'Has Wide rail',
            ],
            [
                'key'=>'Has Wide rail',
            ],  
        ];

        foreach($data as $d)
        {
            Calculation::firstOrCreate($d);
        }
    }
}
