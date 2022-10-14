<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\NotificationCategory;

class NotificationCategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $category_1 = new NotificationCategory();
        $category_1->name = "Incapacidades enfermedad común";
        $category_1->save();

        $category_2 = new NotificationCategory();
        $category_2->name = "Incapacidades de Accidentes laborales";
        $category_2->save();

        $category_3 = new NotificationCategory();
        $category_3->name = "Licencias no remuneradas";
        $category_3->save();

        $category_4 = new NotificationCategory();
        $category_4->name = "Otras licencias";
        $category_4->save();

        $category_5 = new NotificationCategory();
        $category_5->name = "Retiro";
        $category_5->save();

        $category_6 = new NotificationCategory();
        $category_6->name = "Ingreso";
        $category_6->save();

        $category_7 = new NotificationCategory();
        $category_7->name = "Pagos extras";
        $category_7->save();

        $category_8 = new NotificationCategory();
        $category_8->name = "Licencias Remuneradas";
        $category_8->save();

        $category_9 = new NotificationCategory();
        $category_9->name = "Vacaciones";
        $category_9->save();

    }
}
