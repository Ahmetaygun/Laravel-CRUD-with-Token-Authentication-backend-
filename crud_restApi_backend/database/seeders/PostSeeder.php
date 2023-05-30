<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Faker\Factory as Faker;
use Illuminate\Support\Facades\DB;

class PostSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $faker = Faker::create();
        foreach(range(1, 5) as $value){
            DB::table('posts')->insert([
                'name' => $faker->name(),
                'mail' => $faker->mail(),
                'explanation' => $faker->explanation(),
                'admin_id' =>1
            ]);
        }
    }
}
