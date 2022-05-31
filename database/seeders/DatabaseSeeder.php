<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\Menu;
use App\Models\Town;
use App\Models\Space;
use App\Models\Promote;
use App\Models\Booking;
use App\Models\Recommendation;

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
        Promote::factory(4)->create();
        Space::factory(11)->create();
        Menu::factory(25)->create();
        Recommendation::factory(50)->create();

        /*
         * Hotels
         * Restaurant
         *
         * Booking::factory(100)->create();
        */
    }
}
