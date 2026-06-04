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
        Schema::table('projects', function (Blueprint $table) {
            $table->string('card_theme')->default('purple')->after('category');
            $table->string('card_icon')->default('fa-solid fa-cube')->after('card_theme');
            $table->string('card_tag')->default('Dev')->after('card_icon');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('projects', function (Blueprint $table) {
            $table->dropColumn(['card_theme', 'card_icon', 'card_tag']);
        });
    }
};
