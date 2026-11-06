<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('scholarships', function (Blueprint $table) {
            $table->id();
            $table->string('slug', 120)->unique();
            $table->string('title', 200);
            $table->string('provider', 200);
            $table->string('type', 40);
            $table->json('levels');
            $table->string('tags', 500)->nullable();
            $table->text('summary');
            $table->text('benefits')->nullable();
            $table->text('eligibility')->nullable();
            $table->json('requirements')->nullable();
            $table->date('opens')->nullable();
            $table->date('deadline')->nullable();
            $table->string('link', 500)->nullable();
            $table->string('application_link', 500)->nullable();
            $table->boolean('is_published')->default(false);
            $table->foreignId('created_by')->nullable()->constrained('users')->nullOnDelete();
            $table->timestamps();

            $table->index('is_published');
            $table->index('type');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('scholarships');
    }
};
