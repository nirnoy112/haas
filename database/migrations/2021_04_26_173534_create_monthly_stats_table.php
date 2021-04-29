<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMonthlyStatsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('monthly_stats', function (Blueprint $table) {
            $table->id();
            $table->integer('year');
            $table->integer('month_id');
            $table->integer('zodiac_sign_id');
            $table->integer('total_score');
            $table->decimal('score_per_day', 5, 4);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('monthly_stats');
    }
}
