<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('person_categories', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->timestamps();
        });

        // افزودن ستون دسته‌بندی به جدول اشخاص (در صورت نیاز)
        Schema::table('persons', function (Blueprint $table) {
            $table->unsignedBigInteger('person_category_id')->nullable()->after('id');
            $table->foreign('person_category_id')->references('id')->on('person_categories');
        });
    }

    public function down(): void
    {
        Schema::table('persons', function (Blueprint $table) {
            $table->dropForeign(['person_category_id']);
            $table->dropColumn('person_category_id');
        });
        Schema::dropIfExists('person_categories');
    }
};
