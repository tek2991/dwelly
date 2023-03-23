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
        Schema::create('onboardings', function (Blueprint $table) {
            $table->id();
            $table->foreignId('property_id')->constrained();
            $table->boolean('property_data')->default(false);
            $table->boolean('owner_data')->default(false);
            $table->boolean('amenities_data')->default(false);
            $table->boolean('rooms_data')->default(false);
            $table->boolean('furnitures_data')->default(false);
            $table->boolean('completed_data')->default(false);
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
        Schema::dropIfExists('onboardings');
    }
};
