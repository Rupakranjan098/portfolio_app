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
            if (!Schema::hasColumn('projects', 'github_url')) {
                $table->string('github_url')->nullable()->after('project_url');
            }
            if (!Schema::hasColumn('projects', 'is_featured')) {
                $table->boolean('is_featured')->default(false)->after('id');
            }
            if (!Schema::hasColumn('projects', 'subtitle')) {
                $table->string('subtitle')->nullable()->after('title');
            }
            if (!Schema::hasColumn('projects', 'features')) {
                $table->text('features')->nullable()->after('description');
            }
            if (!Schema::hasColumn('projects', 'tech_stack')) {
                $table->text('tech_stack')->nullable()->after('features');
            }
            if (!Schema::hasColumn('projects', 'stats')) {
                $table->text('stats')->nullable()->after('tech_stack');
            }
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('projects', function (Blueprint $table) {
            $columns = [];
            if (Schema::hasColumn('projects', 'github_url')) $columns[] = 'github_url';
            if (Schema::hasColumn('projects', 'is_featured')) $columns[] = 'is_featured';
            if (Schema::hasColumn('projects', 'subtitle')) $columns[] = 'subtitle';
            if (Schema::hasColumn('projects', 'features')) $columns[] = 'features';
            if (Schema::hasColumn('projects', 'tech_stack')) $columns[] = 'tech_stack';
            if (Schema::hasColumn('projects', 'stats')) $columns[] = 'stats';
            
            if (!empty($columns)) {
                $table->dropColumn($columns);
            }
        });
    }
};
