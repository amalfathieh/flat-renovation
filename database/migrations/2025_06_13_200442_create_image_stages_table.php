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
        Schema::create('image_stages', function (Blueprint $table) {
            $table->id();
            $table->foreignId('project_stage_id')->constrained()->onDelete('cascade');
            $table->text('image');
            $table->text('description')->nullable(); // الحقل الجديد
            $table->date('stage_date')->nullable(); // <-- حقل التاريخ
            $table->timestamps();
        });
    }


    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('image_stages');
    }
};
