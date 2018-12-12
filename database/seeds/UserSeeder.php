<?php

use Illuminate\Database\Seeder;
use ProntuarioEletronico\User;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
      $userOne = User::firstOrCreate([
          'name' => 'Administrador',
          'email' => 'admin@admin.com',
          'password' => bcrypt('123456')
      ]);
    }
}
