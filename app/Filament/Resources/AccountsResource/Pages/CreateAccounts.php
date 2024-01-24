<?php

namespace App\Filament\Resources\AccountsResource\Pages;

use App\Filament\Resources\AccountsResource;
use Filament\Actions;
use Filament\Resources\Pages\CreateRecord;

class CreateAccounts extends CreateRecord
{
    protected static string $resource = AccountsResource::class;

    use CreateRecord\Concerns\Translatable;

    protected function getHeaderActions(): array
    {
        return [
            Actions\LocaleSwitcher::make(),
            // ...
        ];
    }
}
