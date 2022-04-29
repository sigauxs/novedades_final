<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

use App\Models\IdentificationType;

class IdentificationTypesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $type_1 = new IdentificationType();
        $type_1->name = "cedula de ciudadania";
        $type_1->abbreviation = "C.C";
        $type_1->save();


        $type_3 = new IdentificationType();
        $type_3->name = "Pasaporte";
        $type_3->abbreviation = "PA";
        $type_3->save();


    }
}
