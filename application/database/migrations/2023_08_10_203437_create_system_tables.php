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
    public function up(): void
    {
        Schema::create('country_data', function (Blueprint $table) {
            $table->id();
            $table->string('country_code', 10)->unique()->nullable(false);
            $table->json('json_data');
            $table->timestamps();
            $table->comment('Countries data');
        });

        Schema::create('country_data_pivot', function (Blueprint $table) {
            $table->id();
            $table->integer('current_country_id')->unsigned()->nullable(false);
            $table->integer('neighbour_country_id')->unsigned()->nullable(false);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down(): void
    {
        Schema::dropIfExists('country_data_pivot');
        Schema::dropIfExists('country_data');
    }
};
