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
            Actions\CreateAction::make(),
        ];
    }
//    protected function getHeaderActions(): array
//    {
//
//        return [
//            Action::make('createProject')
//                ->label('إضافة مشروع')
//                ->icon('heroicon-m-plus')
//                ->action(function () {
//                    $company = \Filament\Facades\Filament::getTenant();
//
//                    if (! $company->canCreateProject()) {
//                        Notification::make()
//                            ->title('لا يمكنك إضافة مشروع')
//                            ->body('يرجى الاشتراك في باقة أو التأكد من توفر مشاريع متاحة داخل باقتك.')
//                            ->danger()
//                            ->persistent()
//                            ->send();
//
//                        return;
//                    }
//
//                    return redirect(static::getResource()::getUrl('create'));
//                }),
//        ];
//    }
}
