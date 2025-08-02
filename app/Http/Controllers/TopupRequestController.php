<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class TopupRequestController extends Controller
{


    public function adminInfo()
    {
        $admin = User::role('admin')->first();

        if (!$admin) {
            return response()->json(['error' => 'لم يتم العثور على الأدمن'], 404);
        }

        return response()->json([
            'admin_name' => $admin->name,
            'admin_phone' => $admin->phone,
            'instructions' => 'يرجى التحويل إلى حساب الأدمن ثم رفع صورة الوصل',
        ]);











    }










}
