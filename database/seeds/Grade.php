<?php

use Illuminate\Database\Seeder;

class Grade extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        DB::table('grade')->insert([
        	[
        		'grade' => 'Grade 7 (Year I)',
        		'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s'),
        	],
        	[
        		'grade' => 'Grade 8 (Year II)',
        		'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s'),
        	],
        	[
        		'grade' => 'Grade 9 (Year III)',
        		'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s'),
        	],
        	[
        		'grade' => 'Grade 10 (Year IV)',
        		'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s'),
        	],
        	[
        		'grade' => 'Grade 11 (Year V)',
        		'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s'),
        	],
        	[
        		'grade' => 'Grade 12 (Year VI)',
        		'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s'),
        	],
        ]);
    }
}
