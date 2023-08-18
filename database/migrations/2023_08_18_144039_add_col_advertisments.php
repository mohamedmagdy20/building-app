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
        Schema::table('advertisments', function (Blueprint $table) {
            $table->string('num_of_rooms')->nullable();
            $table->string('num_of_lounges')->nullable();
            $table->string('num_of_bath')->nullable();
            $table->string('num_of_apartments')->nullable();
            $table->string('num_of_floor')->nullable();            
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('advertisments', function (Blueprint $table) {
            //
        });
    }
};
