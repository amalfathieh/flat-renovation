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
        Schema::create('top_up_requests', function (Blueprint $table) {
            $table->id();

            $table->morphs('requester'); // customer or company
            $table->decimal('amount', 10, 2);
            $table->string('receipt_image');
            $table->enum('status', ['pending', 'approved', 'rejected'])->default('pending');
            $table->text('admin_note')->nullable();
            $table->text('Invoice_number')->nullable();
            $table->foreignId('payment_method_id')->nullable()->constrained('payment_methods')->nullOnDelete();

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('top_up_requests');
    }
};
