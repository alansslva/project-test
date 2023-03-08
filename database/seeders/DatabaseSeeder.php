<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use App\Infra\Application\User\Models\User;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the Application's database.
     */
    public function run(): void
    {

        // \App\Models\User::factory(10)->create();

        User::create([
            'name' => 'Test User',
            'email' => 'test@example.com',
            'document' => '1',
            'value' => 120,
            'type' => 'fisica',
            'password' => base64_encode(1)
        ]);

        User::create([
            'name' => 'Test User 2',
            'email' => 'test@example2.com',
            'document' => '2',
            'value' => 1230,
            'type' => 'juridica',
            'password' => base64_encode(1)
        ]);

        User::create([
            'name' => 'Test User 3',
            'email' => 'test@example3.com',
            'document' => '3',
            'value' => 30,
            'type' => 'juridica',
            'password' => base64_encode(1)
        ]);

        User::create([
            'name' => 'Test User 4',
            'email' => 'test@example4.com',
            'document' => '4',
            'value' => 30,
            'type' => 'fisica',
            'password' => base64_encode(1)
        ]);

        User::create([
            'name' => 'Test User 5',
            'email' => 'test@example5.com',
            'document' => '5',
            'value' => 330,
            'type' => 'fisica',
            'password' => base64_encode(1)
        ]);

        User::create([
            'name' => 'Test User 6',
            'email' => 'test@example6.com',
            'document' => '6',
            'value' => 3360,
            'type' => 'fisica',
            'password' => base64_encode(1)
        ]);

        User::create([
            'name' => 'Test User 7',
            'email' => 'test@example7.com',
            'document' => '7',
            'value' => 10,
            'type' => 'fisica',
            'password' => base64_encode(1)
        ]);

        User::create([
            'name' => 'Test User 8',
            'email' => 'test@example8.com',
            'document' => '8',
            'value' => 120,
            'type' => 'fisica',
            'password' => base64_encode(1)
        ]);


        User::create([
            'name' => 'Test User 9',
            'email' => 'test@example79.com',
            'document' => '9',
            'value' => 109,
            'type' => 'fisica',
            'password' => base64_encode(1)
        ]);


        User::create([
            'name' => 'Test User 10',
            'email' => 'test@example10.com',
            'document' => '10',
            'value' => 1203,
            'type' => 'fisica',
            'password' => base64_encode(1)
        ]);



    }
}
