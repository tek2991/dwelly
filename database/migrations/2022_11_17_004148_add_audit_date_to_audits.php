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
        Schema::table('audits', function (Blueprint $table) {
            // Check if db is sqlite
            if (DB::connection()->getPdo()->getAttribute(PDO::ATTR_DRIVER_NAME) === 'sqlite') {
                $table->date('audit_date')->nullable()->after('id');
            } else {
                $table->date('audit_date')->after('id');
            }
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('audits', function (Blueprint $table) {
            $table->dropColumn('audit_date');
        });
    }
};
