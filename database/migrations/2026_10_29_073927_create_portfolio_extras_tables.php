<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('skill_categories', function (Blueprint $table) {
            $table->id();
            $table->string('slug', 40)->unique();
            $table->string('label', 60);
            $table->unsignedSmallInteger('sort_order')->default(0);
            $table->timestamps();
        });

        Schema::create('project_statuses', function (Blueprint $table) {
            $table->id();
            $table->string('name', 40)->unique();
            $table->string('color', 20)->default('amber');
            $table->unsignedSmallInteger('sort_order')->default(0);
            $table->timestamps();
        });

        Schema::create('experiences', function (Blueprint $table) {
            $table->id();
            $table->string('type', 40);
            $table->string('icon', 60)->default('fa-solid fa-briefcase');
            $table->string('period', 40);
            $table->string('title', 150);
            $table->string('org', 150)->nullable();
            $table->text('description')->nullable();
            $table->json('tags')->nullable();
            $table->boolean('is_current')->default(false);
            $table->unsignedSmallInteger('sort_order')->default(0);
            $table->boolean('is_visible')->default(true);
            $table->timestamps();
        });

        Schema::create('social_links', function (Blueprint $table) {
            $table->id();
            $table->string('name', 40);
            $table->string('handle', 100);
            $table->string('icon', 60)->default('fa-solid fa-link');
            $table->string('description', 255)->nullable();
            $table->string('url', 255);
            $table->unsignedSmallInteger('sort_order')->default(0);
            $table->boolean('is_visible')->default(true);
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('social_links');
        Schema::dropIfExists('experiences');
        Schema::dropIfExists('project_statuses');
        Schema::dropIfExists('skill_categories');
    }
};