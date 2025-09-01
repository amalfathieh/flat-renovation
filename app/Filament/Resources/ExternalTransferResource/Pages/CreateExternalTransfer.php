<?php

namespace App\Filament\Resources\ExternalTransferResource\Pages;

use App\Filament\Resources\ExternalTransferResource;
use Filament\Actions;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\Hidden;
use Filament\Forms\Components\TextInput;
use Filament\Resources\Pages\CreateRecord;

class CreateExternalTransfer extends CreateRecord
{
    protected static string $resource = ExternalTransferResource::class;


}
