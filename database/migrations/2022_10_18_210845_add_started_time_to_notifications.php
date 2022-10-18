<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */

     
    public function up()
    {
        Schema::table('notifications', function (Blueprint $table) {
            $table->after('finish_date', function ($table) {
                $table->string('started_time')->nullable();
                $table->string('finish_time')->nullable();
            });
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('notifications', function (Blueprint $table) {
            $table->dropColumn('started_time');
            $table->dropColumn('finish_time');
        });
    }
};
