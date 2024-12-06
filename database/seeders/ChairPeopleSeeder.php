<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ChairPeopleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $chairPeople = [
            [
                'study_board_id' => 1,
                'emp_no' => 8116,
                'start_date' => '2024-10-25',
                'end_date' => null,
                'appointment_type_id' => 15,
                'active_status' => 1,
            ],
            [
                'study_board_id' => 2,
                'emp_no' => 5210,
                'start_date' => '2024-10-25',
                'end_date' => null,
                'appointment_type_id' => 15,
                'active_status' => 1,
            ],
            [
                'study_board_id' => 3,
                'emp_no' => 8623,
                'start_date' => '2024-10-25',
                'end_date' => null,
                'appointment_type_id' => 15,
                'active_status' => 1,

            ],
            [
                'study_board_id' => 4,
                'emp_no' => 3354,
                'start_date' => '2024-10-25',
                'end_date' => null,
                'appointment_type_id' => 15,
                'active_status' => 1,
            ],
            [
                'study_board_id' => 5,
                'emp_no' => 1959,
                'start_date' => '2024-10-25',
                'end_date' => null,
                'appointment_type_id' => 15,
                'active_status' => 1,
            ],
            [
                'study_board_id' => 6,
                'emp_no' => 3752,
                'start_date' => '2024-10-25',
                'end_date' => null,
                'appointment_type_id' => 15,
                'active_status' => 1,
            ],
            [
                'study_board_id' => 7,
                'emp_no' => 6548,
                'start_date' => '2024-10-25',
                'end_date' => null,
                'appointment_type_id' => 15,
                'active_status' => 1,
            ],
            [
                'study_board_id' => 8,
                'emp_no' => 10585,
                'start_date' => '2024-10-25',
                'end_date' => null,
                'appointment_type_id' => 15,
                'active_status' => 1,
            ],
            [
                'study_board_id' => 9,
                'emp_no' => 9915,
                'start_date' => '2024-10-25',
                'end_date' => null,
                'appointment_type_id' => 15,
                'active_status' => 1,
            ]
        ];

        DB::table('chair_people')->insert($chairPeople);
    }
}
