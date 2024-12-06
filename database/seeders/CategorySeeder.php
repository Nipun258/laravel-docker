<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $datas =
            [
                ['category_type_id' => 1, 'category_name' => 'Profile', 'display_name' => '','category_code'=> 1 ,'sorting_order' => 1],
                ['category_type_id' => 1, 'category_name' => 'User', 'display_name' => '','category_code'=> 2 ,'sorting_order' => 2],
                ['category_type_id' => 1, 'category_name' => 'Role', 'display_name' => '','category_code'=> 3 ,'sorting_order' => 3],
                ['category_type_id' => 1, 'category_name' => 'Permission', 'display_name' => '','category_code'=> 4 ,'sorting_order' => 4],
                ['category_type_id' => 1, 'category_name' => 'Category Type', 'display_name' => '','category_code'=> 5 ,'sorting_order' => 5],
                ['category_type_id' => 1, 'category_name' => 'Category', 'display_name' => '','category_code'=> 6 ,'sorting_order' => 6],
                ['category_type_id' => 1, 'category_name' => 'Site Setting', 'display_name' => '','category_code'=> 7 ,'sorting_order' => 7],
                ['category_type_id' => 1, 'category_name' => 'Study Board', 'display_name' => '','category_code'=> 8 ,'sorting_order' => 8],
                ['category_type_id' => 1, 'category_name' => 'Study Board Subject', 'display_name' => '','category_code'=> 9 ,'sorting_order' => 9],
                ['category_type_id' => 1, 'category_name' => 'Study Board Chair Person', 'display_name' => '','category_code'=> 10 ,'sorting_order' => 10],
                ['category_type_id' => 1, 'category_name' => 'Course', 'display_name' => '','category_code'=> 11 ,'sorting_order' => 11],
                ['category_type_id' => 1, 'category_name' => 'Income Type', 'display_name' => '','category_code'=> 12 ,'sorting_order' => 12],
                ['category_type_id' => 1, 'category_name' => 'Course Fee', 'display_name' => '','category_code'=> 13 ,'sorting_order' => 13],
                ['category_type_id' => 1, 'category_name' => 'Course Coordinator', 'display_name' => '','category_code'=> 14 ,'sorting_order' => 14],

                ['category_type_id' => 2, 'category_name' => 'Acting', 'display_name' => '','category_code'=> 1 ,'sorting_order' => 1],
                ['category_type_id' => 2, 'category_name' => 'Fixed Term', 'display_name' => '','category_code'=> 2 ,'sorting_order' => 2],

                ['category_type_id' => 3, 'category_name' => 'English', 'display_name' => '','category_code'=> 1 ,'sorting_order' => 1],
                ['category_type_id' => 3, 'category_name' => 'Sinhala', 'display_name' => '','category_code'=> 2 ,'sorting_order' => 2],

                ['category_type_id' => 4, 'category_name' => 'PhD Programs', 'display_name' => '','category_code'=> 1 ,'sorting_order' => 1],
                ['category_type_id' => 4, 'category_name' => 'MPhil Programs', 'display_name' => '','category_code'=> 1 ,'sorting_order' => 2],
                ['category_type_id' => 4, 'category_name' => 'Masters Degrees Programs', 'display_name' => '','category_code'=> 0 ,'sorting_order' => 3],
                ['category_type_id' => 4, 'category_name' => 'Masters/Postgraduate Diploma Programs', 'display_name' => '','category_code'=> 0 ,'sorting_order' => 4],
                ['category_type_id' => 4, 'category_name' => 'Postgraduate Diploma Programs', 'display_name' => '','category_code'=> 0 ,'sorting_order' => 5],
                ['category_type_id' => 4, 'category_name' => 'Postgraduate Certificate Programs', 'display_name' => '','category_code'=> 0 ,'sorting_order' => 6],

                ['category_type_id' => 5, 'category_name' => 'Ph.D.', 'display_name' => '','category_code'=> 1 ,'sorting_order' => 1],
                ['category_type_id' => 5, 'category_name' => 'M.Phil.', 'display_name' => '','category_code'=> 1 ,'sorting_order' => 2],
                ['category_type_id' => 5, 'category_name' => 'Master of', 'display_name' => '','category_code'=> 0 ,'sorting_order' => 3],
                ['category_type_id' => 5, 'category_name' => 'M.Sc. in', 'display_name' => '','category_code'=> 0 ,'sorting_order' => 4],
                ['category_type_id' => 5, 'category_name' => 'M.Sc./PGD in', 'display_name' => '','category_code'=> 0 ,'sorting_order' => 5],
                ['category_type_id' => 5, 'category_name' => 'MBA/M.Sc. in', 'display_name' => '','category_code'=> 0 ,'sorting_order' => 6],
                ['category_type_id' => 5, 'category_name' => 'MAT', 'display_name' => '','category_code'=> 1 ,'sorting_order' => 7],
                ['category_type_id' => 5, 'category_name' => 'MAR', 'display_name' => '','category_code'=> 1 ,'sorting_order' => 8],
                ['category_type_id' => 5, 'category_name' => 'MAQ', 'display_name' => '','category_code'=> 1 ,'sorting_order' => 9],
                ['category_type_id' => 5, 'category_name' => 'Postgraduate Diploma in', 'display_name' => '','category_code'=> 0 ,'sorting_order' => 10],
                ['category_type_id' => 5, 'category_name' => 'Postgraduate Course in', 'display_name' => '','category_code'=> 0 ,'sorting_order' => 11],
                ['category_type_id' => 5, 'category_name' => 'Postgraduate Certificate in', 'display_name' => '','category_code'=> 0 ,'sorting_order' => 12],

                ['category_type_id' => 6, 'category_name' => 'Taught Course', 'display_name' => '','category_code'=> 1 ,'sorting_order' => 1],
                ['category_type_id' => 6, 'category_name' => 'Research Course', 'display_name' => '','category_code'=> 2 ,'sorting_order' => 2],

                ['category_type_id' => 7, 'category_name' => 'Always Open', 'display_name' => '','category_code'=> 1 ,'sorting_order' => 1],
                ['category_type_id' => 7, 'category_name' => 'Regular Time Interval Open', 'display_name' => '','category_code'=> 2 ,'sorting_order' => 2],

            ];

            foreach($datas as $data){
                DB::table('categories')->insert($data);
            }
    }
}
