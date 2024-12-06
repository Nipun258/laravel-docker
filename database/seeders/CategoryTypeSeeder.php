<?php

namespace Database\Seeders;

use App\Models\CategoryType;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CategoryTypeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $datas =
            [
                ['name' => 'Permission Group', 'slug' => 'permission group'],
                ['name' => 'Appointment Type', 'slug' => 'appointment type'],
                ['name' => 'Course Medium', 'slug' => 'course medium'],
                ['name' => 'Course Type', 'slug' => 'course type'],
                ['name' => 'Course Type Extension', 'slug' => 'course type extension'],
                ['name' => 'Course Category', 'slug' => 'course category'],
                ['name' => 'Course Application Calling Method', 'slug' => 'course application calling method'],
            ];

        foreach($datas as $data){
                DB::table('category_types')->insert($data);
        }
    }
}
