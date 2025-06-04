<?php


namespace App\Services;


use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Spatie\Permission\Models\Role;

class UserServices
{
    public function register(array $request): array
    {
        // إنشاء المستخدم الجديد
        $user = User::create([
            'name' => $request['name'],
            'email' => $request['email'],
            'password' => Hash::make($request['password'])
        ]);

        // تعيين دور العميل للمستخدم
        $clientRole = Role::where('name', 'client')->first();
        $user->assignRole($clientRole);

        // منح صلاحيات الدور للمستخدم
        $permissions = $clientRole->permissions()->pluck('name')->toArray();
        $user->givePermissionTo($permissions);

        // تحميل العلاقات وإعداد البيانات
        $user->load(['roles', 'permissions']);
        $user = User::with(['roles', 'permissions'])->find($user->id);
        $this->appendRolesAndPermissions($user);

        // إنشاء توكن الوصول
        $token = $user->createToken('auth_token')->plainTextToken;

        return [
            'user' => $user,
            'message' => 'تم إنشاء المستخدم بنجاح',
            'token' => $token
        ];
    }
    public function login($request): array
    {
        $user = User::query()
            ->where('email', $request['email'])
            ->first();

        if (!is_null($user)) {
            if (!Auth::attempt($request->only(['email', 'password']))) {
                $message = 'User email & password does not match with our record.';
                $code = 401;
            } else {
                $user = $this->appendRolesAndPermissions($user);
                $user['token'] = $user->createToken("token")->plainTextToken;
                $message = 'User logged in successfully';
                $code = 200;
            }
        } else {
            $message = 'User not found';
            $code = 404;
        }

        return ['user' => $user, 'message' => $message, 'code' => $code];
    }
    public function logout(): array
    {
        $user = Auth::user();
        if (!is_null(Auth::user())) {
            Auth::user()->currentAccessToken()->delete();
            $message = 'User logged out successfully';
            $code = 200;
        } else {
            $message = 'Invalid token';
            $code = 404;
        }
        return ['message' => $message, 'code' => $code];
    }
    private function appendRolesAndPermissions(User $user)
    {
        // معالجة الأدوار
        $roles = $user->roles->pluck('name')->toArray();
        unset($user['roles']);
        $user['roles'] = $roles;

        // معالجة الصلاحيات
        $permissions = $user->permissions->pluck('name')->toArray();
        unset($user['permissions']);
        $user['permissions'] = $permissions;

        return $user;
    }

    }
