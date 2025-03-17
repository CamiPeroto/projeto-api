<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        if(!User::where('email', 'camila@gmail.com.br')->first()){
            User::create([
                'name' => 'Camila',
                'email' => 'camila@gmail.com.br',
                'password' => Hash::make('123456a', ['round' =>12]), //12 saltos de encriptação0
            ]);
        }

        if(!User::where('email', 'rafael@gmail.com.br')->first()){
            User::create([
                'name' => 'Rafael',
                'email' => 'rafael@gmail.com.br',
                'password' => Hash::make('123456a', ['round' =>12]), //12 saltos de encriptação0
            ]);
        }
        if(!User::where('email', 'kelly@gmail.com.br')->first()){
            User::create([
                'name' => 'Kelly',
                'email' => 'kelly@gmail.com.br',
                'password' => Hash::make('123456a', ['round' =>12]), //12 saltos de encriptação0
            ]);
        }
        if(!User::where('email', 'ana@gmail.com.br')->first()){
            User::create([
                'name' => 'Ana',
                'email' => 'ana@gmail.com.br',
                'password' => Hash::make('123456a', ['round' =>12]), //12 saltos de encriptação0
            ]);
        }
        if(!User::where('email', 'jheni@gmail.com.br')->first()){
            User::create([
                'name' => 'Jheni',
                'email' => 'jheni@gmail.com.br',
                'password' => Hash::make('123456a', ['round' =>12]), //12 saltos de encriptação0
            ]);
        }
    }
}
