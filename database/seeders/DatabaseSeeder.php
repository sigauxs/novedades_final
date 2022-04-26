<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {

        $user = New User();
        $user->name = "Jorge Salgado Echeverria";
        $user->email = "sistemas@sigpeconsultores.com.co";
        $user->password = Hash::make('123456');
        $user->save();

        $user_1 = New User();
        $user_1->name = "Sajille Chedraui Daza";
        $user_1->email = "jefeoperativo@sigpeconsultores.com.co";
        $user_1->password = Hash::make('123456');
        $user_1->save();

        $user_2 = New User();
        $user_2->name = "Breidy Lamby";
        $user_2->email = "blamby@sigpeconsultores.com.co";
        $user_2->password = Hash::make('123456');
        $user_2->save();

        $user_3 = New User();
        $user_3->name = "Ariel Vidal";
        $user_3->email = "avidal@sigpeconsultores.com.co";
        $user_3->password = Hash::make('123456');
        $user_3->save();

        $user_4 = New User();
        $user_4->name = "Liseth Johana Camacho Perez";
        $user_4->email = "liderproyecto@sigpeconsultores.com.co";
        $user_4->password = Hash::make('123456');
        $user_4->save();

        $user_5 = New User();
        $user_5->name = "Marly Torregrosa Dominguez";
        $user_5->email = "jefeadmon@sigpeconsultores.com.co";
        $user_5->password = Hash::make('123456');
        $user_5->save();

        $user_6 = New User();
        $user_6->name = "Karen Blanco Welman";
        $user_6->email = "gerencia@sigpeconsultores.com.co";
        $user_6->password = Hash::make('123456');
        $user_6->save();

        $user_7 = New User();
        $user_7->name = "Nathalie Builes";
        $user_7->email = "seleccion@sigpeconsultores.com.co";
        $user_7->password = Hash::make('123456');
        $user_7->save();



        $this->call(IdentificationTypesSeeder::class);
        $this->call(centerCostsSeeder::class);

    }
}
