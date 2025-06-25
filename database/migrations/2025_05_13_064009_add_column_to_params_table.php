<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::table('params', function (Blueprint $table) {
            $table->foreignId('param_groups_id')->index()->constrained('param_groups');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('params', function (Blueprint $table) {
            $table->dropColumn('param_groups_id');
        });
    }
};
