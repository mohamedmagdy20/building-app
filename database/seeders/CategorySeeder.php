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
        // $data = [
        //     [
        //         'name_en'=>'Home',
        //         'name_ar'=>'بيت',
        //         'type'=>'residential'
        //     ],
        //     [
        //         'name_en'=>'Apartment',
        //         'name_ar'=>'شقه',
        //         'type'=>'residential'

        //     ],

        //     [
        //         'name_en'=>'Architecture',
        //         'name_ar'=>'عماره',
        //         'type'=>'residential'
        //     ],
            
        //     [
        //         'name_en'=>'Farm',
        //         'name_ar'=>'مزارع',
        //         'type'=>'residential'
        //     ],
        //     [
        //         'name_en'=>'Chalet',
        //         'name_ar'=>'شاليه',
        //         'type'=>'residential'
        //     ],


        //     [
        //         'name_en'=>'Home',
        //         'name_ar'=>'بيت',
        //         'type'=>'residential'
        //     ],
        //     [
        //         'name_en'=>'Apartment',
        //         'name_ar'=>'شقه',
        //         'type'=>'residential'

        //     ],

        //     [
        //         'name_en'=>'Architecture',
        //         'name_ar'=>'عماره',
        //         'type'=>'residential'
        //     ],
            
        //     [
        //         'name_en'=>'Farm',
        //         'name_ar'=>'مزارع',
        //         'type'=>'residential'
        //     ],
        //     [
        //         'name_en'=>'Chalet',
        //         'name_ar'=>'شاليه',
        //         'type'=>'residential'
        //     ],


        //     [
        //         'name_en'=>'Office',
        //         'name_ar'=>'مكتب',
        //         'type'=>'commercial'
        //     ],

            
        //     [
        //         'name_en'=>'Clinic',
        //         'name_ar'=>'عياده',
        //         'type'=>'commercial'
        //     ],

        //     [
        //         'name_en'=>'Shop',
        //         'name_ar'=>'محل',
        //         'type'=>'commercial'
        //     ],

            
        //     [
        //         'name_en'=>'Exhibition',
        //         'name_ar'=>'معرض',
        //         'type'=>'commercial'
        //     ],

            
        //     [
        //         'name_en'=>'Store',
        //         'name_ar'=>'مخزن',
        //         'type'=>'commercial'
        //     ],

            
        //     [
        //         'name_en'=>'Complex',
        //         'name_ar'=>'مجمع',
        //         'type'=>'commercial'
        //     ],

        //     [
        //         'name_en'=>'Restaurant',
        //         'name_ar'=>'مطعم او كافيه',
        //         'type'=>'commercial'
        //     ],

        //     [
        //         'name_en'=>'Factory',
        //         'name_ar'=>'مصنع',
        //         'type'=>'commercial'
        //     ],

        //     [
        //         'name_en'=>'Hotel',
        //         'name_ar'=>'فندق',
        //         'type'=>'commercial'
        //     ],

        //     [
        //         'name_en'=>'Residential',
        //         'name_ar'=>'سكنيه',
        //         'type'=>'lands'
        //     ],

        //     [
        //         'name_en'=>'Agricultural',
        //         'name_ar'=>'زراعيه',
        //         'type'=>'lands'
        //     ],

        //     [
        //         'name_en'=>'Investments',
        //         'name_ar'=>'استثماري',
        //         'type'=>'lands'
        //     ],

            
        //     [
        //         'name_en'=>'Commercial',
        //         'name_ar'=>'تجاري',
        //         'type'=>'lands'
        //     ],            
        //     [
        //         'name_en'=>'Industrial',
        //         'name_ar'=>'صناعي',
        //         'type'=>'lands'
        //     ],
        // ];

        $data = [
            [
                'name_en'=>'Private House',
                'name_ar'=>'سكن خاص',
                'type'=>'residential'
            ],
            [
                'name_en'=>'Investment Housing',
                'name_ar'=>'سكن استثماري',
                'type'=>'residential'
            ],        
            [
                'name_en'=>'Offices',
                'name_ar'=>'مكاتب',
                'type'=>'commercial_units'
            ],
            [
                'name_en'=>'Clinics',
                'name_ar'=>'عيادات',
                'type'=>'commercial_units'
            ],
            [
                'name_en'=>'Shops',
                'name_ar'=>'محلات',
                'type'=>'commercial_units'
            ],

            
            [
                'name_en'=>'Hotels',
                'name_ar'=>'فنادق',
                'type'=>'commercial'
            ],

            [
                'name_en'=>'Mall',
                'name_ar'=>'مجمع تجاري',
                'type'=>'commercial'
            ],  

            [
                'name_en'=>'Apartments',
                'name_ar'=>'شقق',
                'type'=>'investment'
            ],
            [
                'name_en'=>'Architecture',
                'name_ar'=>'عماير',
                'type'=>'investment'
            ],

            [
                'name_en'=>'Stores',
                'name_ar'=>'مخازن',
                'type'=>'industrial'
            ],

            [
                'name_en'=>'Industrial real estate',
                'name_ar'=>'عقارات صناعي',
                'type'=>'industrial'
            ],
            [
                'name_en'=>'State property',
                'name_ar'=>'املاك دوله',
                'type'=>'chalet'
            ],

            [
                'name_en'=>'Private property',
                'name_ar'=>'املاك خاصة',
                'type'=>'chalet'
            ],

            [
                'name_en'=>'Agricultural',
                'name_ar'=>'زراعي',
                'type'=>'farm'
            ],
            
            [
                'name_en'=>'Companies',
                'name_ar'=>'شركات',
                'type'=>'farm'
            ],

            
            [
                'name_en'=>'Animal',
                'name_ar'=>'حيواني',
                'type'=>'farm'
            ],

            [
                'name_en'=>'Jawakher',
                'name_ar'=>'جواخير',
                'type'=>'break'
            ],
            [
                'name_en'=>'Stables',
                'name_ar'=>'استبلاط',
                'type'=>'break'
            ],

            [
                'name_en'=>'residential',
                'name_ar'=>'سكني',
                'type'=>'lands'
            ],
            [
                'name_en'=>'industrial',
                'name_ar'=>'صناعي',
                'type'=>'lands'
            ],
            [
                'name_en'=>'commercial',
                'name_ar'=>'تجاري',
                'type'=>'lands'
            ],

            
            [
                'name_en'=>'Nautical',
                'name_ar'=>'بجري',
                'type'=>'lands'
            ],


            [
                'name_en'=>'Investment',
                'name_ar'=>'استثماري',
                'type'=>'lands'
            ],
            [
                'name_en'=>'Breaks',
                'name_ar'=>'استراحات',
                'type'=>'lands'
            ],     
            
            [
                'name_en'=>'licenses',
                'name_ar'=>'تراخيص',
                'type'=>'commercial_units'
            ],     
        ];




        foreach($data as $d)
        {
            Category::firstOrCreate($d);
        }
    }
}
