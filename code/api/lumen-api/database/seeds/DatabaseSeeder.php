<?php

use Illuminate\Database\Seeder;

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
        Model::reguard();
    }
}
