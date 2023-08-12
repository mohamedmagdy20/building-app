<?php

namespace Database\Seeders;

use App\Models\Category;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class CategorySeeder extends Seeder
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
                'name_en'=>'Villa',
                'name_ar'=>'فيلا'
            ],
            [
                'name_en'=>'Apartment',
                'name_ar'=>'شقه'
            ],

            [
                'name_en'=>'Land',
                'name_ar'=>'ارض'
            ],
            
            [
                'name_en'=>'House',
                'name_ar'=>'منزل'
            ],
             
            [
                'name_en'=>'Architecture',
                'name_ar'=>'عماره'
            ],
        ];

        foreach($data as $d)
        {
            Category::firstOrCreate($d);
        }
    }
}
