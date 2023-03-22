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
            $table->boolean('property')->default(false);
            $table->boolean('owner')->default(false);
            $table->boolean('amenities')->default(false);
            $table->boolean('rooms')->default(false);
            $table->boolean('furnitures')->default(false);
            $table->boolean('completed')->default(false);
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
