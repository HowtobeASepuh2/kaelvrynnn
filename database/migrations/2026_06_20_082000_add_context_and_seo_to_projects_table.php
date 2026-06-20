<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('projects', function (Blueprint $table) {
            $table->string('project_status')->nullable()->after('objective');
            $table->string('role')->nullable()->after('project_status');
            $table->string('duration')->nullable()->after('role');
            $table->text('impact')->nullable()->after('duration');
            $table->string('seo_title')->nullable()->after('demo_link');
            $table->text('seo_description')->nullable()->after('seo_title');
            $table->string('seo_keywords')->nullable()->after('seo_description');
        });
    }

    public function down(): void
    {
        Schema::table('projects', function (Blueprint $table) {
            $table->dropColumn([
                'project_status',
                'role',
                'duration',
                'impact',
                'seo_title',
                'seo_description',
                'seo_keywords',
            ]);
        });
    }
};
