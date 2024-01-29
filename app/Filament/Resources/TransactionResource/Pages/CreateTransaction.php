<?php

namespace App\Filament\Resources\TransactionResource\Pages;

use App\Filament\Resources\TransactionResource;
use App\Models\Bank;
use Filament\Actions;
use Filament\Resources\Pages\CreateRecord;
use Illuminate\Database\Eloquent\Model;

class CreateTransaction extends CreateRecord
{
    protected static string $resource = TransactionResource::class;

    // protected function mutateFormDataBeforeCreate(array $data): array
    // {

    //     return $data;
    // }

    protected function handleRecordCreation(array $data): Model
    {
        $totalAmount = $data['amount'] + $data['tax'];
        if ($data['type'] == 'برداشت') {
            Bank::where('id', $data['bank_id'])->decrement('balance', $totalAmount);
        } else {
            Bank::where('id', $data['bank_id'])->increment('balance', $totalAmount);
        }
        return static::getModel()::create($data);
    }

    protected function getRedirectUrl(): string
    {
        return $this->previousUrl ?? $this->getResource()::getUrl('index');
    }
}
