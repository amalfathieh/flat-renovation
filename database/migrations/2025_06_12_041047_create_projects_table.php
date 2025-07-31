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
        Schema::create('projects', function (Blueprint $table) {
            $table->id();
            $table->foreignId('company_id')->constrained()->cascadeOnDelete();
            $table->string('customer_name')->nullable();
            $table->foreignId('order_id')->constrained()->onDelete('cascade');
            $table->foreignId('employee_id')->constrained()->onDelete('cascade');
            $table->string('project_name');
            $table->date('start_date');
            $table->date('end_date')->nullable();
            $table->enum('status', ['finished', 'In progress', 'Preparing'])->default('Preparing');
            $table->text('description')->nullable();
            $table->double('final_cost')->nullable();
            $table->boolean('is_publish')->default(false);
            $table->string('file')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('projects');
    }
};
