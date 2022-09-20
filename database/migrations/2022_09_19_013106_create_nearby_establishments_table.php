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
        Schema::create('nearby_establishments', function (Blueprint $table) {
            $table->foreignId('establishment_type_id')->constrained();
            $table->foreignId('property_id')->constrained();
            $table->string('description')->nullable();
            $table->integer('distance_in_kms')->nullable();
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
        Schema::dropIfExists('nearby_establishments');
    }
};
