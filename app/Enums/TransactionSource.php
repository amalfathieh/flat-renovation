<?php

namespace App\Enums;

enum TransactionSource: string {
case UserManualTopUp = 'user_manual_topup';
case UserRefund = 'user_refund';
case UserOrderPayment = 'user_order_payment';
case UserStagePayment = 'user_stage_payment';
case CompanyManualTopUp = 'company_manual_topup';
case CompanySubscription = 'company_subscription';
case CompanyDeductionRefund = 'company_deduction_refund';
case AdminMonthlyClearance = 'admin_monthly_clearance';
}
