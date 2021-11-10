<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Str;
use Faker\Factory as Faker;

class JobSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $faker = Faker::create();
        foreach(range(1,20) as $value) {

            DB::table('employeejobs')->insert([
             'title'=>$faker->title,
             'description'=>$faker->name,
             'min_salary'=>rand(1000,3000),
             'mas_salary'=>rand(1000,3000),

            ]);
        }
    }
}
