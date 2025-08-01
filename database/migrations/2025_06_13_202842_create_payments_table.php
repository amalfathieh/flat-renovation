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
        Schema::create('payments', function (Blueprint $table) {
            $table->id();
            $table->foreignId('project_id')->constrained()->onDelete('cascade');
            $table->string('cost');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migratio
     * ns.
     */
    public function down(): void
    {
        Schema::dropIfExists('payments');
    }
};
