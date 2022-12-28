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
        Schema::create('tenants', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained();
            $table->foreignId('property_id')->constrained();
            $table->dateTime('moved_in_at')->nullable();
            $table->dateTime('moved_out_at')->nullable();

            $table->string('beneficiary_name')->nullable();
            $table->string('bank_name')->nullable();
            $table->string('ifsc')->nullable();
            $table->string('account_number')->nullable();

            $table->boolean('is_primary')->default(false);
            $table->foreignId('primary_tenant_id')->nullable()->constrained('tenants');
            
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
        Schema::dropIfExists('tenants');
    }
};
