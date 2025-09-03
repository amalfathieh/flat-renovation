<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;

class BroadcastServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap any application broadcasting services.
     */
    public function boot(): void
    {
        // بما إنك تستخدم Public Channels فقط،
        // ما في داعي لا Broadcast::routes() ولا authorization rules

        // لكن إذا بدك مستقبلاً تضيف Private/Presence Channels،
        // بس رجّع السطر الجاي:
        // Broadcast::routes();

        // ما في داعي تجيب ملف routes/channels.php حالياً
        // require base_path('routes/channels.php');
    }
}
