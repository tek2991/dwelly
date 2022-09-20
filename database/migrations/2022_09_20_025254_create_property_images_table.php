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
        Schema::create('property_images', function (Blueprint $table) {
            $table->id();
            $table->foreignId('property_id')->constrained();
            $table->string('image_path')->comment('Path to the image in storage/app/uploads/properties');
            $table->integer('order')->default(0)->comment('Order of the image');
            $table->boolean('is_cover')->default(false)->comment('Whether the image is the cover image of the property');
            $table->boolean('show')->default(false)->comment('Whether to show the image in the frontend');
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
        Schema::dropIfExists('property_images');
    }
};
