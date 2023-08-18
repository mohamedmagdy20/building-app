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
                'name_en'=>'Home',
                'name_ar'=>'بيت',
                'type'=>'residential'
            ],
            [
                'name_en'=>'Apartment',
                'name_ar'=>'شقه',
                'type'=>'residential'

            ],

            [
                'name_en'=>'Architecture',
                'name_ar'=>'عماره',
                'type'=>'residential'
            ],
            
            [
                'name_en'=>'Farm',
                'name_ar'=>'مزارع',
                'type'=>'residential'
            ],
            [
                'name_en'=>'Chalet',
                'name_ar'=>'شاليه',
                'type'=>'residential'
            ],


            [
                'name_en'=>'Home',
                'name_ar'=>'بيت',
                'type'=>'residential'
            ],
            [
                'name_en'=>'Apartment',
                'name_ar'=>'شقه',
                'type'=>'residential'

            ],

            [
                'name_en'=>'Architecture',
                'name_ar'=>'عماره',
                'type'=>'residential'
            ],
            
            [
                'name_en'=>'Farm',
                'name_ar'=>'مزارع',
                'type'=>'residential'
            ],
            [
                'name_en'=>'Chalet',
                'name_ar'=>'شاليه',
                'type'=>'residential'
            ],


            [
                'name_en'=>'Office',
                'name_ar'=>'مكتب',
                'type'=>'commercial'
            ],

            
            [
                'name_en'=>'Clinic',
                'name_ar'=>'عياده',
                'type'=>'commercial'
            ],

            [
                'name_en'=>'Shop',
                'name_ar'=>'محل',
                'type'=>'commercial'
            ],

            
            [
                'name_en'=>'Exhibition',
                'name_ar'=>'معرض',
                'type'=>'commercial'
            ],

            
            [
                'name_en'=>'Store',
                'name_ar'=>'مخزن',
                'type'=>'commercial'
            ],

            
            [
                'name_en'=>'Complex',
                'name_ar'=>'مجمع',
                'type'=>'commercial'
            ],

            [
                'name_en'=>'Restaurant',
                'name_ar'=>'مطعم او كافيه',
                'type'=>'commercial'
            ],

            [
                'name_en'=>'Factory',
                'name_ar'=>'مصنع',
                'type'=>'commercial'
            ],

            [
                'name_en'=>'Hotel',
                'name_ar'=>'فندق',
                'type'=>'commercial'
            ],

            [
                'name_en'=>'Residential',
                'name_ar'=>'سكنيه',
                'type'=>'lands'
            ],

            [
                'name_en'=>'Agricultural',
                'name_ar'=>'زراعيه',
                'type'=>'lands'
            ],

            [
                'name_en'=>'Investments',
                'name_ar'=>'استثماري',
                'type'=>'lands'
            ],

            
            [
                'name_en'=>'Commercial',
                'name_ar'=>'تجاري',
                'type'=>'lands'
            ],            
            [
                'name_en'=>'Industrial',
                'name_ar'=>'صناعي',
                'type'=>'lands'
            ],
        ];




        foreach($data as $d)
        {
            Category::firstOrCreate($d);
        }
    }
}
