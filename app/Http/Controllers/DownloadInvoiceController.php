<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use function Spatie\LaravelPdf\Support\pdf;

class DownloadInvoiceController extends Controller
{
    /**
     * Handle the incoming request.
     */
    public function __invoke(Request $request)
    {

        return pdf('pdf.pdf')
            ->format('a4')
            ->name('invoice.pdf');
    }

}
