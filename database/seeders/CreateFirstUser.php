<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class CreateFirstUser extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        User::factory()->count(1000)->create();

        User::create([
            'name'     => 'Vera',
            'email'    => 'verazakia@gmail.com',
            'password' => Hash::make('Cianjur17'),
        ]);
    }
}