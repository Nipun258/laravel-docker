<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class IncomeTypeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $datas =
            [
                ['pay_income_type_code' => 1, 'income_type_name' => 'Application Fees'],
                ['pay_income_type_code' => 2, 'income_type_name' => 'Registration Fees'],
                ['pay_income_type_code' => 3, 'income_type_name' => 'Course Fee - First Instalment'],
                ['pay_income_type_code' => 4, 'income_type_name' => 'Course Fee - Second Instalment'],
                ['pay_income_type_code' => 6, 'income_type_name' => 'Registration Renewal Fees'],
                ['pay_income_type_code' => 7, 'income_type_name' => 'Record Book Charges'],
                ['pay_income_type_code' => 8, 'income_type_name' => 'Libray Deposits'],
                ['pay_income_type_code' => 9, 'income_type_name' => 'Libray Fees'],
                ['pay_income_type_code' => 10, 'income_type_name' => 'Convorcation Fees'],
                ['pay_income_type_code' => 11, 'income_type_name' => 'Certificate Fees'],
                ['pay_income_type_code' => 15, 'income_type_name' => 'Examination Fees'],
                ['pay_income_type_code' => 32, 'income_type_name' => 'Repeat Examination Fee'],
                ['pay_income_type_code' => 35, 'income_type_name' => 'Penalty Fees'],
                ['pay_income_type_code' => 37, 'income_type_name' => 'Department Fees'],
                ['pay_income_type_code' => 39, 'income_type_name' => 'Other'],
                ['pay_income_type_code' => 42, 'income_type_name' => 'Supervition Fees'],
                ['pay_income_type_code' => 53, 'income_type_name' => 'Course Fees'],
                ['pay_income_type_code' => 54, 'income_type_name' => 'Refundable Cloak Fees'],
            ];

        foreach($datas as $data){
                DB::table('income_types')->insert($data);
        }
    }
}
