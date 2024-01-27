<?php

namespace App\Filament\Resources\BankCheckResource\Pages;

use App\Filament\Resources\BankCheckResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditBankCheck extends EditRecord
{

    protected static string $resource = BankCheckResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }
}
