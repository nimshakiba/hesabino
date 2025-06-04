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
        Schema::table('categories', function (Blueprint $table) {
            if (!Schema::hasColumn('categories', 'image')) {
                $table->string('image')->nullable();
            }
            if (!Schema::hasColumn('categories', 'description')) {
                $table->string('description')->nullable();
            }
            if (!Schema::hasColumn('categories', 'full_description')) {
                $table->text('full_description')->nullable();
            }
            if (!Schema::hasColumn('categories', 'created_at')) {
                $table->date('created_at')->nullable();
            }
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('categories', function (Blueprint $table) {
            $table->dropColumn(['image', 'description', 'full_description', 'created_at']);
        });
    }
};
