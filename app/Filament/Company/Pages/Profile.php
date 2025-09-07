<?php


namespace App\Filament\Company\Pages;

use Filament\Forms\Concerns\InteractsWithForms;
use Filament\Forms\Contracts\HasForms;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Form;
use Filament\Pages\Page;
use Filament\Forms\Components\SpatieMediaLibraryFileUpload;
use Filament\Support\Enums\Alignment;
use Filament\Support\Enums\MaxWidth;


class Profile extends Page implements HasForms
{
    use InteractsWithForms;

    protected static ?string $navigationIcon = 'heroicon-o-user-circle';
    protected static string $view = 'filament.company.pages.profile';
    protected static ?string $title = "الملف الشخصي";

    public ?array $data = [];

    public function getHeading(): string
    {
        return 'الملف الشخصي';
    }

    public function mount(): void
    {
        $user = auth()->user();

        // تعبئة البيانات داخل الـ form
        $this->form->fill([
            'name' => $user->name,
            'email' => $user->email,
            'balance' => $user->balance,
            'company_name' => $user->role === 'company' ? ($user->company?->name ?? '') : null,
            'employee_position' => $user->role === 'employee' ? ($user->employee?->position ?? '') : null,
        ]);
    }

    public function form(Form $form): Form
    {
        $user = auth()->user();

        $schema = [
            TextInput::make('name')
                ->label('اسم المستخدم')
                ->disabled(),

            TextInput::make('email')
                ->label('البريد الإلكتروني')
                ->disabled(),

            TextInput::make('balance')
                ->label('balance')
                ->disabled(),
        ];

        if ($user->role === 'company') {
            $schema[] = TextInput::make('company_name')
                ->label('اسم الشركة')
                ->disabled();

            $schema[] = \Filament\Forms\Components\FileUpload::make('company_logo')
                ->label('شعار الشركة')
                ->image()
                ->disabled()
                ->getUploadedFileNameForStorageUsing(function ($file) {
                    return $file->getClientOriginalName();
                });
        }

        if ($user->role === 'employee') {
            $schema[] = TextInput::make('employee_position')
                ->label('الوظيفة')
                ->disabled();
        }

        return $form
            ->schema($schema)
            ->statePath('data');
    }
}
