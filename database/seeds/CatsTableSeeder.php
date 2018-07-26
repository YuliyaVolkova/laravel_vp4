<?php

use Illuminate\Database\Seeder;
//use Illuminate\Database\Eloquent\Model;

class CatsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        factory(App\Cat::class, 7)->create();
    }
}
