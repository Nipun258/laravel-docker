<?php

namespace Database\Seeders;

use App\Models\StudyBoard;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class StudyBoardSubjectSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $studyBoardSubjects = [
            'Humanities' => [
                'Buddhist Civilization', 'Buddhist Philosophy', 'Cultural Studies', 'Dance', 'Drama and Theatre',
                'English', 'English Literature', 'Hindi', 'Linguistics and Teaching English as a Second language',
                'Mass Communication', 'Music (Eastern)', 'Pali', 'Philosophy', 'Psychology', 'Sanskrit', 'Sinhala',
                'Western Music (Ethnomusicology)'
            ],
            'Social Sciences' => [
                'Anthropology', 'Archeology', 'Criminology', 'Economics', 'Geography', 'History', 'Political Science',
                'Sociology'
            ],
            'Life Science' => [
                'Botany', 'Chemistry', 'Food Science & Technology', 'Forestry & Environmental Sciences', 'Zoology'
            ],
            'Physical Sciences' => [
                'Chemistry', 'Computer Science', 'Information System', 'Mathematics', 'Physics', 'Statistics',
                'Data Science & Artificial Intelligence'
            ],
            'Management Studies & Commerce' => [
                'Applied Finance', 'Business Administration', 'Business Economics', 'Entrepreneurship', 'Marketing Management',
                'Professional Accounting', 'Public Management', 'Real Estate Management and Valuation'
            ],
            'Medical Sciences' => [
                'Anatomy', 'Biochemistry', 'Clinical Medicine', 'Community Medicine', 'Food and Nutrition', 'Forensic Medicine',
                'Health Science', 'Immunology', 'Medical Education', 'Microbiology', 'Obstetrics & Gynecology', 'Parasitology',
                'Pediatrics', 'Pharmacology', 'Physiology'
            ],
            'Multidisciplinary Studies' => [
                'GIS & Remote Sensing', 'Multidisciplinary studies'
            ],
            'Engineering' => [
                'Civil Engineering', 'Computer Engineering', 'Electrical and Electronic Engineering', 'Mechanical Engineering'
            ],
            'Technology' => [
                'Biosystems Technology', 'Civil and Environmental Technology', 'Information & Communication Technology',
                'Materials and Mechanical Technology', 'Science for Technology'
            ]
        ];

        foreach ($studyBoardSubjects as $boardName => $subjects) {
            // Retrieve the study board by name
            $studyBoard = StudyBoard::where('name', $boardName)->first();

            if ($studyBoard) {
                foreach ($subjects as $subject) {
                    DB::table('study_board_subjects')->insert([
                        'name' => $subject,
                        'study_board_id' => $studyBoard->id,
                        'active_status' => 1
                    ]);
                }
            }
        }
    }
}
