<?php

namespace Database\Seeders;

use App\Models\ApiToken;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ApiTokenSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $token = 'reklamfaresi-zikirmatik-projesi';
        ApiToken::query()->create(['token' => hash('sha256',$token)]);
    }
}
