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
        Schema::create('companies', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained('users')->cascadeOnDelete();
//            $table->foreignId('current_subscription_id')
//                ->nullable()
//                ->constrained('company_subscriptions')
//                ->nullOnDelete();
            $table->string('name');
            $table->string('email')->nullable();
            $table->string('slug');
            $table->string('location');
            $table->string('phone')->nullable();
            $table->text('cost_of_examination')->nullable();
            $table->text('about')->nullable();
            $table->string('logo')->nullable();
            $table->decimal('balance', 10, 2)->default(0);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('companies');
    }
};
