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
        Schema::create('furniture', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('icon_path')->nullable()->comment('Path to the icon of the furniture in storage/app/uploads/icons');
            $table->boolean('show')->default(false)->comment('Whether to show the furniture in the frontend');
            $table->boolean('is_primary')->default(True);
            $table->foreignId('primary_furniture_id')->nullable();
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
        Schema::dropIfExists('furniture');
    }
};
