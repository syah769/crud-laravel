<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class EmployeeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //this command to deploy fake db ke phpmyadmin. 'employees' adalah nama table. So, kita nak masukkan fake db ke dlm table employees
        //name, gender dan phoneno adalah nama column dlm table employees. Make sure nama column sama ye
        DB::table('employees')->insert([
            'name' => 'Syahril Ashraf',
            'gender' => 'man',
            'phoneno' => '0135077314',
        ]);
    }
}
