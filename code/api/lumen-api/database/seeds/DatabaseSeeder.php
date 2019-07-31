<?php

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Faker\Factory as Faker;

class DatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // $this->call('UsersTableSeeder');
        Model::unguard();
        // Register the user seeder
        $this->call(factory(App\User::class, 10)->create());


        $faker = Faker::create();
        foreach (range(1, 20) as $increment) {
            DB::table('ads')->insert([
                'name' => $faker->word,
                'brand' => $faker->words($nb = 8, $asText = true),
                'price' => $faker->randomFloat($nbMaxDecimals = 2, $min = 1, $max = 1000),
                'description' => $faker->text($maxNbChars = 300),
                'tag' => $faker->words($nb = 3, $asText = true),
                'create_at' => $faker->dateTimeInInterval($startDate = 'now', $interval = '- 30 days', $timezone = null),
                'end_at' => $faker->dateTimeInInterval($startDate = 'now', $interval = '+ 30 days', $timezone = null),
                'id_user' => random_int(1, 10)
            ]);
        }

        Model::reguard();
    }
}
