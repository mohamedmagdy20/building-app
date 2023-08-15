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
            $table->unsignedBigInteger('city_id')->after('category_id');
            $table->foreign('city_id')->references('id')->on('cities')->onDelete('cascade');
            $table->double('price')->default(0);
            $table->enum('type',['rent','sale'])->nullable();
            $table->boolean('abroved')->default(false);

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
