<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Http\Resources\ConversationResource;
use App\Models\Conversation;
use App\Models\Company;
use App\Models\Customer;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ConversationController extends Controller
{

    public function index(Request $request)
    {
        $user = Auth::user();


        if ($user->employee) {
           $employee = $user->employee;
            $conversations = Conversation::where('employee_id', $employee->id)
                ->with(['customer.user', 'messages' => function($q){ $q->latest()->limit(1); }])
                ->latest()
                ->paginate(20);

            return response()->json($conversations);
        }


        if ($user->customerProfile) {
            $customer = $user->customerProfile;
            $conversations = Conversation::where('customer_id', $customer->id)
                ->with(['employee', 'messages' => function($q){ $q->latest()->limit(1); }])
                ->latest()
                ->paginate(20);

            return response()->json($conversations);
        }

        return response()->json(['message' => 'No conversations found'], 404);
    }


    public function store(Request $request)
    {
        $user = Auth::user();
//        dd($user, $user->customerProfile);
        if ($user->customerProfile) {
            $data = $request->validate([
                'employee_id' => 'required|exists:employees,id',
            ]);

            $customerId = $user->customerProfile->id;
            $employeeId = $data['employee_id'];
        } else {
            return response()->json([
                'message' => 'المستخدم الحالي ليس زبون'
            ], 403);
        }

        $conversation = Conversation::firstOrCreate([
            'customer_id' => $customerId,
            'employee_id' => $employeeId,
        ]);

        return new ConversationResource($conversation->load('customer.user', 'employee'));
    }



    // جلب المحادثة مع كل الرسائل (صفحة)
    public function show(Request $request, Conversation $conversation)
    {
        $user = Auth::user();

        if (! $this->userCanAccess($user, $conversation)) {
            return response()->json(['message' => 'Forbidden'], 403);
        }

        $messages = $conversation->messages()->with('sender')->latest()->paginate(50);

        return response()->json([
            'conversation' => $conversation->load('customer.user', 'company'),
            'messages' => $messages,
        ]);
    }

    protected function userCanAccess($user, Conversation $conversation): bool
    {
        if ($user->hasRole('company')) {
            return $user->company && $user->company->id == $conversation->company_id;
        }

        if ($user->customerProfile) {
            return $user->customerProfile->id == $conversation->customer_id;
        }

        return false;
    }
}
