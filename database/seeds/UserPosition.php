<?php

use Illuminate\Database\Seeder;

class UserPosition extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        DB::table('user_position')->insert([
        	[
        		'position' => 'admin',
        		'created_at' => date('Y-m-d H:i:s'),
        		'updated_at' => date('Y-m-d H:i:s'),
        	],
        	[
        		'position' => 'principal',
        		'created_at' => date('Y-m-d H:i:s'),
        		'updated_at' => date('Y-m-d H:i:s'),
        	],
        	[
        		'position' => 'student',
        		'created_at' => date('Y-m-d H:i:s'),
        		'updated_at' => date('Y-m-d H:i:s'),
        	],
        	[
        		'position' => 'club adviser',
        		'created_at' => date('Y-m-d H:i:s'),
        		'updated_at' => date('Y-m-d H:i:s'),
        	],
        	[
        		'position' => 'maintenance',
        		'created_at' => date('Y-m-d H:i:s'),
        		'updated_at' => date('Y-m-d H:i:s'),
        	],
        ]);
    }
}
