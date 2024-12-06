<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;

class RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Role::create(['name' => 'Super-Admin']);
        Role::create(['name' => 'Admin']);
        Role::create(['name' => 'Chair-Person']);
        Role::create(['name' => 'Course-Coordinator']);
        Role::create(['name' => 'Admin-Officer']);
        Role::create(['name' => 'Dean']);
        Role::create(['name' => 'Bursar']);
        Role::create(['name' => 'Subject-Clerk']);
        Role::create(['name' => 'Subject-Assistant']);
        Role::create(['name' => 'Student']);
        Role::create(['name' => 'User']);
    }
}
