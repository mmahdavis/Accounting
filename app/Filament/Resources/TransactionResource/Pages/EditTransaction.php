<?php

namespace App\Filament\Resources\TransactionResource\Pages;

use App\Filament\Resources\TransactionResource;
use App\Models\Bank;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;
use Illuminate\Database\Eloquent\Model;

class EditTransaction extends EditRecord
{

    protected static string $resource = TransactionResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }
    protected function handleRecordUpdate(Model $record, array $data): Model
    {
        $oldAmount = $record->amount + $record->tax;

        $record->update($data);

        $newAmount = $record->amount + $record->tax;

        $totalAmount = $newAmount - $oldAmount;
        if ($totalAmount > 0) {
            if ($data['type'] == 'برداشت') {
                Bank::where('id', $data['bank_id'])->decrement('balance', $totalAmount);
            } else {
                Bank::where('id', $data['bank_id'])->increment('balance', $totalAmount);
            }
        } elseif ($totalAmount < 0) {
            if ($data['type'] == 'برداشت') {
                Bank::where('id', $data['bank_id'])->increment('balance', $totalAmount);
            } else {
                Bank::where('id', $data['bank_id'])->decrement('balance', $totalAmount);
            }
        }

        return $record;
    }
}
