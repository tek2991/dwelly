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
        Schema::create('properties', function (Blueprint $table) {
            $table->id();
            // Basics
            $table->string('code')->unique();
            $table->foreignId('bhk_id')->constrained();
            $table->integer('floor_space');
            $table->foreignId('property_type_id')->constrained();
            $table->foreignId('flooring_id')->constrained();
            $table->foreignId('furnishing_id')->constrained();

            // Floors
            $table->integer('floors');
            $table->integer('total_floors');

            // Descriptives
            $table->string('address');
            $table->string('building_name');
            $table->string('landmark')->nullable();
            $table->foreignId('locality_id')->constrained();
            
            // Coordinates
            $table->string('latitude');
            $table->string('longitude');

            // Rent
            $table->integer('rent_in_cents');
            $table->integer('security_deposit_in_cents');
            $table->integer('society_fee_in_cents')->nullable();
            $table->integer('booking_amount_in_cents')->nullable();

            // Is promoted
            $table->boolean('is_promoted')->default(false);

            // Availability
            $table->date('available_from')->nullable();
            $table->boolean('is_available')->default(true);

            // Created by
            $table->foreignId('created_by')->constrained('users');

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
        Schema::dropIfExists('properties');
    }
};
