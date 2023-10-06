<?php

namespace Database\Seeders;

use App\Models\AdsType;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class AdsTypeSeeder extends Seeder
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
                'name'=>'normal',
                'point'=>'5'
            ],
            [
                'name'=>'fixed',
                'point'=>'10'
            ],
            [
                'name'=>'special',
                'point'=>'15'
            ],
        ];
        foreach($data as $d)
        {
            AdsType::create($d);
        }
    }
}
