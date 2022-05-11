<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\Town;
use App\Models\Space;
use App\Models\Menu;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        User::factory(10)->create();
        Town::factory(60)->create();
        Space::factory(11)->create();
        Menu::factory(25)->create();
    }
}
