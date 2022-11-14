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
            $table->boolean('is_primary')->default(false);
            $table->foreignId('primary_tenant_id')->nullable()->constrained('tenants');
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
            $table->dropColumn('is_primary');
            $table->dropForeign(['primary_tenant_id']);
            $table->dropColumn('primary_tenant_id');
        });
    }
};
