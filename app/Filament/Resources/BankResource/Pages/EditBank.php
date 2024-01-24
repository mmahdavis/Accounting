<?php

namespace App\Filament\Resources\BankResource\Pages;

use App\Filament\Resources\BankResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditBank extends EditRecord
{
    use EditRecord\Concerns\Translatable;

    protected static string $resource = BankResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }
}
