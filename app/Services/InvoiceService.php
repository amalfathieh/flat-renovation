<?php

namespace App\Services;

use App\Models\TransactionsAll;

class InvoiceService
{


    public function generateInvoiceNumber(): string
    {
        do {
            $number = str_pad(mt_rand(1, 99999), 5, '0', STR_PAD_LEFT);
        } while (TransactionsAll::where('invoice_number', $number)->exists());

        return $number;
    }
}
