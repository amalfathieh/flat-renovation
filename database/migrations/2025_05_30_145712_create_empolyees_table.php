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
        Schema::create('empolyees', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')
                ->constrained('users')
                ->cascadeOnDelete();
            $table->foreignId('company_id')
                ->constrained('companies')
                ->cascadeOnDelete();
            $table->string('first_name');
            $table->string('last_name');
            $table->enum('gender', ['male', 'female'])->nullable();
            $table->string('phone');
            $table->date('starting_date');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('empolyees');
    }
};
