<?php

namespace App\Services\Auth;

use App\Models\Customer;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;

class CustomerProfileService
{
    public function show($user)
    {
        $profile = $user->customerProfile;

        return [
            'id' => $user->id,
            'name' => $user->name,
            'email' => $user->email,
            'phone' => $profile?->phone,
            'image' => $profile?->image ? basename($profile->image) : null,
            'age' => $profile?->age,
            'gender' => $profile?->gender,
            'role' => $user->getRoleNames(),
        ];
    }

    public function update(Request $request, $user)
    {
        $validated = $request->validate([
            'name' => 'sometimes|required|string',
            'phone' => 'nullable|string',
            'image' => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
            'age' => 'nullable|integer|min:1',
            'gender' => 'nullable|in:male,female',
        ]);

        $profile = $user->customerProfile;

        if (!$profile) {
            // إذا ما كان عنده بروفايل، ننشئ واحد
            $profile = new Customer(['user_id' => $user->id]);
        }

        // تحديث صورة
        if ($request->hasFile('image')) {
            if ($profile->image && Storage::disk('public')->exists($profile->image)) {
                Storage::disk('public')->delete($profile->image);
            }
            $profile->image = $request->file('image')->store('users', 'public');
        }

        // تحديث بيانات البروفايل
        $profile->phone = $validated['phone'] ?? $profile->phone;
        $profile->age = $validated['age'] ?? $profile->age;
        $profile->gender = $validated['gender'] ?? $profile->gender;
        $profile->save();

        // تحديث الاسم في جدول المستخدمين (users)
        if (isset($validated['name'])) {
            $user->name = $validated['name'];
            $user->save();
        }

        return $this->show($user);
    }

    public function changePassword(Request $request, $user)
    {
        $validated = $request->validate([
            'current_password' => 'required',
            'new_password' => 'required|min:6|confirmed',
        ]);

        if (!Hash::check($validated['current_password'], $user->password)) {
            return ['error' => 'The current password is incorrect.'];
        }

        $user->update([
            'password' => bcrypt($validated['new_password']),
        ]);

        return ['message' => 'Password changed successfully'];
    }
}
