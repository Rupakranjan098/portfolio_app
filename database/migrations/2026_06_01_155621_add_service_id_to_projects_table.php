<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::table('projects', function (Blueprint $table) {
            $table->foreignId('service_id')->nullable()->constrained('services')->nullOnDelete();
        });

        // Auto-associate existing projects to services based on category mapping
        try {
            $services = DB::table('services')->get();
            foreach ($services as $service) {
                DB::table('projects')
                    ->where('category', $service->title)
                    ->update(['service_id' => $service->id]);
            }
            
            // For hybrid categories like "UI/UX & Development", match them specifically
            $uiuxId = DB::table('services')->where('title', 'UI/UX Design')->value('id');
            if ($uiuxId) {
                DB::table('projects')
                    ->whereNull('service_id')
                    ->where('category', 'like', '%UI/UX%')
                    ->update(['service_id' => $uiuxId]);
            }

            $frontendId = DB::table('services')->where('title', 'Frontend Development')->value('id');
            if ($frontendId) {
                DB::table('projects')
                    ->whereNull('service_id')
                    ->where('category', 'like', '%Development%')
                    ->update(['service_id' => $frontendId]);
            }
        } catch (\Exception $e) {
            // Silence if tables or records don't exist
        }
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('projects', function (Blueprint $table) {
            $table->dropForeign(['service_id']);
            $table->dropColumn('service_id');
        });
    }
};
