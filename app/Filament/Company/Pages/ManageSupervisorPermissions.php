<?php

namespace App\Filament\Company\Pages;

use Filament\Forms;
use Filament\Forms\Form;
use Filament\Pages\Page;
use Spatie\Permission\Models\Role;

class ManageSupervisorPermissions extends Page implements Forms\Contracts\HasForms
{
    use Forms\Concerns\InteractsWithForms;

    protected static ?string $navigationIcon = 'heroicon-o-shield-check';
    protected static string $view = 'filament.company.pages.manage-supervisor-permissions';
    protected static ?string $title = 'إدارة صلاحيات المشرف';

    public array $permissions = [];

    public function mount(): void
    {
        $supervisor = Role::where('name', 'supervisor')->first();
        $this->permissions = $supervisor->permissions->pluck('name')->toArray();
    }

    public function form(Form $form): Form
    {
        $companyRole = Role::where('name', 'company')->first();
        $companyPermissions = $companyRole->permissions->pluck('name', 'name')->toArray();

        return $form->schema([
            Forms\Components\CheckboxList::make('permissions')
                ->label('صلاحيات المشرف')
                ->options($companyPermissions)
                ->columns(3),
        ])->statePath('permissions');
    }

    public function save(): void
    {
        $supervisor = Role::where('name', 'supervisor')->first();
        $supervisor->syncPermissions($this->permissions);

        $this->notify('success', 'تم تحديث صلاحيات المشرف بنجاح ✅');
    }
}
