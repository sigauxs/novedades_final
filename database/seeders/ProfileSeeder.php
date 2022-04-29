<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Profile;

class ProfileSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $profile_1 = new Profile();
        $profile_1->name = "admin";
        $profile_1->save();

        $profile_2 = new Profile();
        $profile_2->name = "editor";
        $profile_2->save();

        $profile_3 = new Profile();
        $profile_3->name = "subcriptor";
        $profile_3->save();
    }
}
