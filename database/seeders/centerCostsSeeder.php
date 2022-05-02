<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\CenterCost;

class centerCostsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $center = new CenterCost();
        $center->name = "Operaciones Y Fidelización";
        $center->abbreviation = "N.N";
        $center->code = 1;
        $center->save();

        $center_1 = new CenterCost();
        $center_1->name = "Mercadeo";
        $center_1->abbreviation = "N.N";
        $center_1->code = 2;
        $center_1->save();

        $center_2 = new CenterCost();
        $center_2->name = "TSA";
        $center_2->abbreviation = "N.N";
        $center_2->code = 3;
        $center_2->save();

        $center_3 = new CenterCost();
        $center_3->name = "Drummond LTD";
        $center_3->abbreviation = "N.N";
        $center_3->code = 4;
        $center_3->save();

        $center_4 = new CenterCost();
        $center_4->name = "Promigas";
        $center_4->abbreviation = "N.N";
        $center_4->code = 5;
        $center_4->save();

        $center_5 = new CenterCost();
        $center_5->name = "Administrativo";
        $center_5->abbreviation = "N.N";
        $center_5->code = 6;
        $center_5->save();

        $center_6 = new CenterCost();
        $center_6->name = "Gerencia";
        $center_6->abbreviation = "N.N";
        $center_6->code = 7;
        $center_6->save();

        $center_7 = new CenterCost();
        $center_7->name = "Desarrollo Organizacional";
        $center_7->abbreviation = "N.N";
        $center_7->code = 8;
        $center_7->save();

        $center_8 = new CenterCost();
        $center_8->name = "admin";
        $center_8->abbreviation = "N.N";
        $center_8->code = 9;
        $center_8->save();

    }
}
