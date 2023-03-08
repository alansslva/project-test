<?php

namespace Database\Seeders;

use App\Infra\Application\User\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class UserSeed extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $user = new User();
        $user->name = 'John 1';
        $user->email = '111@111.com';
        $user->type = 'fisica';
        $user->document = '1';
        $user->value = 150;
        $user->save();

    }
}
