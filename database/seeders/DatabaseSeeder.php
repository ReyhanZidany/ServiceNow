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
            'name' => 'PIC 1',
            'email' => 'rehan@gmail.com',
            'password' => Hash::make('password'),
            'role' => 'PIC 1'
        ]);

        \App\Models\User::factory()->create([
            'name' => 'PIC 2',
            'email' => 'yamal@gmail.com',
            'password' => Hash::make('password'),
            'role' => 'PIC 2'
        ]);

        \App\Models\User::factory()->create([
            'name' => 'PIC 3',
            'email' => 'abc@gmail.com',
            'password' => Hash::make('password'),
            'role' => 'PIC 3'
        ]);

        // ini_set('memory_limit', '3G');
        // \App\Models\Ticket::factory(500000)->create();
    }
}
