<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

/* Models */



class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */


    
 
    public function run()
    {
        
        $this->call(IdentificationTypesSeeder::class);
        $this->call(centerCostsSeeder::class);
        $this->call(ProfileSeeder::class);
        $this->call(UserSeeder::class);
        

    }
}
