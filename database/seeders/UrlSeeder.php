<?php

namespace Database\Seeders;

use App\Models\Url;
use App\Models\User;
use Illuminate\Database\Seeder;

class UrlSeeder extends Seeder
{
    public function run(): void
    {
        $users = User::all();

        foreach ($users as $user) {
            Url::factory()
                ->count(5)
                ->create([
                    'user_id' => $user->id
                ]);
        }
    }
}
