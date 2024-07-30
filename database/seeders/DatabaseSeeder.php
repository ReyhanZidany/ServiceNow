<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // \App\Models\User::factory(10)->create();


        \App\Models\User::factory()->create([
            'name' => 'servicedesk',
            'email' => 'panjul@gmail.com',
            'password' => Hash::make('password'),
            'role' => 'servicedesk'
        ]);

        \App\Models\User::factory()->create([
            'name' => 'APPS 1',
            'email' => 'rehan@gmail.com',
            'password' => Hash::make('password'),
            'role' => 'APPS 1'
        ]);

        \App\Models\User::factory()->create([
            'name' => 'APPS 2',
            'email' => 'yamal@gmail.com',
            'password' => Hash::make('password'),
            'role' => 'APPS 2'
        ]);

        \App\Models\User::factory()->create([
            'name' => 'INFRA 2',
            'email' => 'abc@gmail.com',
            'password' => Hash::make('password'),
            'role' => 'INFRA 2'
        ]);

        \App\Models\User::factory()->create([
            'name' => 'INFRA 2',
            'email' => 'kaka@gmail.com',
            'password' => Hash::make('password'),
            'role' => 'INFRA 2'
        ]);

        \App\Models\Ticket::factory()->create();
    }
}
