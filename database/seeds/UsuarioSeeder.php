<?php

use App\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UsuarioSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        User::insert([
            'email' => 'douglaswillamis@audax.mobi',
            'senha' => Hash::make('senha'),
            'nome' => 'Douglas Willamis'
        ]);
    }
}
