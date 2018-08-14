<?php

use Illuminate\Database\Seeder;

class DefaultUser extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        DB::table('users')->insert([
        	[
        		'name' => 'kyle',
        		'idNumber' => '1',
        		'grade' => '1',
        		'section' => '1',
        		'clubs' => '1',
        		'position' => '1',
        		'password' => '$2y$10$Ip4E/1XjQn4HDZQvXe0qOuzucXevImH6jGtAJMeqW3jg.pPWfr1j.',
        		'firstname' => 'Kyle Martin',
        		'middlename' => 'Admin',
        		'lastname' => 'Famero',
        		'gender' => 'male',
        		'created_at' => date('Y-m-d H:i:s'),
        		'updated_at' => date('Y-m-d H:i:s'),
        	],
        ]);
    }
}
