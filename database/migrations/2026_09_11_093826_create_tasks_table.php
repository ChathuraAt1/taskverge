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
        Schema::create('tasks', function (Blueprint $table) {
            $table->id();
            $table->foreignId('workflow_id')->constrained('workflows')->cascadeOnDelete();
            $table->foreignId('stage_id')->constrained('workflow_stages')->cascadeOnDelete();
            $table->string('task_number')->index();
            $table->string('title');
            $table->longText('description')->nullable();
            $table->string('priority')->default('medium'); // low, medium, high, critical
            $table->string('status')->default('pending'); // pending, active, blocked, completed
            $table->dateTime('deadline')->nullable();
            $table->foreignId('assigned_to')->nullable()->constrained('users')->nullOnDelete();
            $table->foreignId('created_by')->nullable()->constrained('users')->nullOnDelete();
            $table->text('blocked_reason')->nullable();
            $table->decimal('estimated_hours', 6, 2)->nullable();
            $table->decimal('actual_hours', 6, 2)->default(0);
            $table->json('tags')->nullable();
            $table->unsignedInteger('order_column')->default(0);
            $table->timestamps();

            $table->index(['workflow_id', 'status']);
            $table->index(['workflow_id', 'priority']);
            $table->index(['assigned_to', 'status']);
            $table->index('deadline');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tasks');
    }
};
