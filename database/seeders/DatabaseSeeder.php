<?php

namespace Database\Seeders;

use App\Models\Person;
use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    use WithoutModelEvents;

    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        User::updateOrCreate(['email' => 'admin@hubla.local'], ['name' => 'Hubla Admin', 'password' => 'password', 'is_admin' => true]);
        Person::updateOrCreate(['name' => 'Andi Pratama'], ['position' => 'Koordinator Lapangan']);
        Person::updateOrCreate(['name' => 'Citra Lestari'], ['position' => 'Dokumentasi']);
    }
}
