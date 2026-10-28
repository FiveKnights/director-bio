<?php // ...create_projects_table.php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('projects', function (Blueprint $table) {
            $table->id();
            $table->string('code', 20)->unique();
            $table->string('title', 150);
            $table->string('status', 40)->default('IN PROGRESS');
            $table->text('short_desc');
            $table->text('full_desc');
            $table->json('tags')->nullable();
            $table->json('highlights')->nullable();
            $table->string('image')->nullable();
            $table->string('github_url')->nullable();
            $table->string('demo_url')->nullable();
            $table->unsignedSmallInteger('sort_order')->default(0);
            $table->boolean('is_visible')->default(true);
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('projects');
    }
};