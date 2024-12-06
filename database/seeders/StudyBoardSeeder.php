<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class StudyBoardSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $datas =
            [
                ['name' => 'Humanities', 'short_name' => 'HU', 'active_status' => 1],
                ['name' => 'Social Sciences', 'short_name' => 'SS', 'active_status' => 1],
                ['name' => 'Life Science', 'short_name' => 'LS', 'active_status' => 1],
                ['name' => 'Physical Sciences', 'short_name' => 'PS', 'active_status' => 1],
                ['name' => 'Management Studies & Commerce', 'short_name' => 'FM', 'active_status' => 1],
                ['name' => 'Medical Sciences', 'short_name' => 'MS', 'active_status' => 1],
                ['name' => 'Multidisciplinary Studies', 'short_name' => 'MD', 'active_status' => 1],
                ['name' => 'Technology', 'short_name' => 'TE', 'active_status' => 1],
                ['name' => 'Engineering', 'short_name' => 'EN', 'active_status' => 1],
            ];

        foreach($datas as $data){
                DB::table('study_boards')->insert($data);
        }
    }
}
