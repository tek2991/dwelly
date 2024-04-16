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
        Schema::table('onboardings', function (Blueprint $table) {
            $table->foreignId('audit_id')->nullable()->constrained('audits');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('onboardings', function (Blueprint $table) {
            $table->dropForeign(['audit_id']);
            $table->dropColumn('audit_id');
        });
    }
};
