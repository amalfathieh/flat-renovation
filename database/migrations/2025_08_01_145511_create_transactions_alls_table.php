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
        Schema::create('transactions_alls', function (Blueprint $table) {
            $table->id();


            // الطرف الذي قام بالدفع (قد يكون زبون أو شركة)
            $table->nullableMorphs('payer'); // payer_type, payer_id

            // الطرف الذي استلم (قد يكون شركة أو أدمن)
            $table->nullableMorphs('receiver'); // receiver_type, receiver_id

            $table->enum('source', [
                'user_manual_topup',        // شحن يدوي من الزبون
                'user_refund',              // استرجاع من شركة بعد رفض
                'user_order_payment',       // دفع طلب كشف
                'user_stage_payment',       // دفع مرحلة مشروع

                'company_manual_topup',     // شحن يدوي من الشركة
                'company_subscription',     // دفع باقة اشتراك
                'company_deduction_refund', // خصم بسبب رفض كشف

                'admin_monthly_clearance',  // تحويل شهرية للشركات
            ]);

            $table->decimal('amount', 10, 2);
            $table->text('note')->nullable(); // وصل الدفع أو ملاحظات

            $table->nullableMorphs('related'); // related_type, related_id

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('transactions_alls');
    }
};
