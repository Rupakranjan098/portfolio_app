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
        Schema::table('profiles', function (Blueprint $table) {
            $table->string('about_title')->nullable();
            $table->text('about_description')->nullable();
            $table->string('experience_years')->default('3+');
            $table->string('projects_completed')->default('50+');
            $table->string('happy_clients')->default('30+');
            $table->string('awards_received')->default('10+');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('profiles', function (Blueprint $table) {
            //
        });
    }
};
