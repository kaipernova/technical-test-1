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
        Schema::table('notes', function (Blueprint $table) {
            $table->dropColumn('model_type');
            $table->dropColumn('model_id');

            $table->string('notable_type', 50)->after('id');
            $table->unsignedBigInteger('notable_id')->after('notable_type');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('notes', function (Blueprint $table) {
            $table->dropColumn('notable_type');
            $table->dropColumn('notable_id');

            $table->string('model_type', 50);
            $table->unsignedBigInteger('model_id');
        });
    }
};
