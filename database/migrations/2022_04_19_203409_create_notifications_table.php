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
        Schema::create('notifications', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('type_identification_id');
            $table->unsignedBigInteger('employee_id');
            $table->unsignedBigInteger('center_cost_id');
            $table->unsignedBigInteger('boss_id');
            $table->unsignedBigInteger('notifications_type_id');
            $table->unsignedBigInteger('user_id');
            $table->dateTime('started_date');
            $table->datetime('finish_date');
            $table->integer('total_days');
            $table->decimal('total_hours');
            $table->text('observation')->nullable();
            $table->timestamps();

            $table->foreign('type_identification_id')
            ->references('id')->on('identification_types');

            $table->foreign('user_id')
            ->references('id')->on('users');

            $table->foreign('employee_id')
            ->references('id')->on('employees');


            $table->foreign('center_cost_id')
            ->references('id')->on('center_costs');

            $table->foreign('boss_id')
            ->references('id')->on('bosses');

            $table->foreign('notifications_type_id')
            ->references('id')->on('notifications_types');
        });
    }

 
    public function down()
    {
        Schema::dropIfExists('notifications');
    }
};
