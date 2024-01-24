<?php

namespace App\Filament\Resources\AccountsResource\Pages;

use App\Filament\Resources\AccountsResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditAccounts extends EditRecord
{
    use EditRecord\Concerns\Translatable;

    protected static string $resource = AccountsResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
            Actions\LocaleSwitcher::make(),
        ];
    }
}
