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
        Schema::table('tenants', function (Blueprint $table) {
            $table->string('beneficiary_name')->nullable();
            $table->string('bank_name')->nullable();
            $table->string('ifsc')->nullable();
            $table->string('account_number')->nullable();
        });

        Schema::table('owners', function (Blueprint $table) {
            $table->string('beneficiary_name')->nullable();
            $table->string('bank_name')->nullable();
            $table->string('ifsc')->nullable();
            $table->string('account_number')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('tenants', function (Blueprint $table) {
            $table->dropColumn('beneficiary_name');
            $table->dropColumn('bank_name');
            $table->dropColumn('ifsc');
            $table->dropColumn('account_number');
        });

        Schema::table('owners', function (Blueprint $table) {
            $table->dropColumn('beneficiary_name');
            $table->dropColumn('bank_name');
            $table->dropColumn('ifsc');
            $table->dropColumn('account_number');
        });
    }
};
