<?php

use Illuminate\Database\Seeder;

class clubs extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        DB::table('clubs')->insert([
        	[
        		'clubs' => 'Filipino',
        		'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s'),
        	],
        	[
        		'clubs' => 'Science',
        		'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s'),
        	],
        	[
        		'clubs' => 'English',
        		'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s'),
        	],
        	[
        		'clubs' => 'Mathematics',
        		'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s'),
        	],
        	[
        		'clubs' => 'Aralin Panlipunan',
        		'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s'),
        	],
        	[
        		'clubs' => 'Home Economics',
        		'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s'),
        	],
        	[
        		'clubs' => 'Edukasyon sa Pagpapakatao',
        		'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s'),
        	],
        	[
        		'clubs' => 'Information Communication',
        		'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s'),
        	],
        ]);
    }
}
