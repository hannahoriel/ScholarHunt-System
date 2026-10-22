<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('scholarship_applications', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained()->cascadeOnDelete();
            $table->string('scholarship_id', 120);
            $table->string('scholarship_title', 200);
            $table->string('provider', 200)->nullable();
            $table->string('scholarship_type', 80)->nullable();
            $table->date('applied_at');
            $table->string('application_reference', 150)->nullable();
            $table->text('notes')->nullable();
            $table->enum('status', ['applied', 'passed', 'failed'])->default('applied');
            $table->timestamps();
            $table->unique(['user_id', 'scholarship_id']);
            $table->index(['user_id', 'status']);
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('scholarship_applications');
    }
};
