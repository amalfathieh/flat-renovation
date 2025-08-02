<?php

namespace App\Filament\Company\Resources\ProjectResource\Pages;

use App\Filament\Company\Resources\ProjectResource;
use Filament\Facades\Filament;
use Filament\Pages\Actions\Action;
use Filament\Resources\Pages\ListRecords;
use Filament\Notifications\Notification;

use Filament\Actions;

class ListProjects extends ListRecords
{
    protected static string $resource = ProjectResource::class;

    protected function getHeaderActions(): array
    {

        return [
            Action::make('createProject')
                ->label('إضافة مشروع')
                ->icon('heroicon-m-plus')
                ->action(function () {
                    $company = \Filament\Facades\Filament::getTenant();

                    if (! $company->canCreateProject()) {
                        Notification::make()
                            ->title('لا يمكنك إضافة مشروع')
                            ->body('يرجى الاشتراك في باقة أو التأكد من توفر مشاريع متاحة داخل باقتك.')
                            ->danger()
                            ->persistent()
                            ->send();

                        return;
                    }

                    return redirect(static::getResource()::getUrl('create'));
                }),
        ];
    }

    /*protected function beforeCreate(): void
    {
        if (! auth()->user()->team->subscribed()) {
            Notification::make()
                ->warning()
                ->title('You don\'t have an active subscription!')
                ->body('Choose a plan to continue.')
                ->persistent()
                ->actions([
                    Action::make('subscribe')
                        ->button()
                        ->url(route('subscribe'), shouldOpenInNewTab: true),
                ])
                ->send();

            $this->halt();
        }
    }*/


    /*  return [
            Action::make('createProject')
                ->label('إضافة مشروع')
                ->icon('heroicon-o-plus')
                ->action(function (Action $action) {
                    $company = Filament::getTenant();

                    if (! $company->canCreateProject()) {
                        $action->failure(); // ضروري لتشغيل failure message
                        $action->halt();    // يوقف الإجراء ولا يعمل redirect
                        return;
                    }

                    return redirect(ProjectResource::getUrl('create'));
                })
                ->requiresConfirmation(false) // لا مودال تأكيد افتراضي
                ->failureNotificationTitle('لا يمكنك إنشاء مشروع جديد')
                ->failureNotificationBody('لقد استهلكت كل المشاريع المسموح بها في باقتك الحالية أو ليس لديك اشتراك فعّال.')
                ->failureNotificationDuration(5000) // إظهار الرسالة 5 ثواني
                ->color('primary'),
        ];*/
    /* return [
         Action::make('createProject')
             ->label('إضافة مشروع')
             ->icon('heroicon-m-plus')
             ->action(function (Action $action) {
                 $company = Filament::getTenant();

                 if (! $company->canCreateProject()) {
                     $action->halt(); // يمنع الانتقال ويوقف هنا
                     return;
                 }

                 return redirect(static::getResource()::getUrl('create'));
             })
             // فقط يظهر المودال لما يكون غير قادر على إنشاء مشروع
             ->visible(function () {
                 return true; // الزر دايمًا ظاهر
             })
             ->requiresConfirmation(false) // نوقف مودال التأكيد الافتراضي
             ->modalHeading('لا يمكنك إنشاء مشروع جديد')
             ->modalDescription('لقد استهلكت كل المشاريع المسموح بها في باقتك الحالية أو ليس لديك اشتراك فعّال.')
             ->modalSubmitActionLabel('حسنًا')
             ->modalCancelAction(false) // نخفي زر "إلغاء"
             ->hidden(fn () => false), // دايمًا ظاهر
         // لكن المودال ما بيفتح إلا إذا action توقف بـ ->halt()
     ];*/

    /*return [
        Action::make('createProject')
            ->label('إضافة مشروع')
            ->icon('heroicon-m-plus')
            ->action(function (Action $action) {
                $company = Filament::getTenant();

                if (! $company->canCreateProject()) {
                    $action->halt(); // يمنع المتابعة ويفتح المودال
                }

                return redirect(static::getResource()::getUrl('create'));
            })
            ->modalHeading('لا يمكنك إنشاء مشروع جديد')
            ->modalDescription('لقد انتهى عدد المشاريع المسموح بها في الباقة الحالية أو لا يوجد اشتراك فعّال.')
            ->modalSubmitActionLabel('موافق')
            ->requiresConfirmation(), // هذا اللي بفعّل الـ Modal
    ];*/
}
