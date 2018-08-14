<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        // $this->call(UsersTableSeeder::class);
        $this->call(clubs::class);
        $this->call(Grade::class);
        $this->call(Section::class);
        $this->call(surveyseed::class);
        $this->call(candidatePosition::class);
        $this->call(UserPosition::class);
        $this->call(DefaultUser::class);
    }
}
