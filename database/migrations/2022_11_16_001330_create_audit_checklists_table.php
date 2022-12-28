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
        Schema::create('audit_checklists', function (Blueprint $table) {
            $table->id();
            $table->foreignId('audit_id')->constrained();
            $table->morphs('checklistable');
            $table->boolean('is_primary')->default(false);
            $table->foreignId('primary_checklist_id')->nullable()->constrained('audit_checklists');
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
        Schema::dropIfExists('audit_checklists');
    }
};
