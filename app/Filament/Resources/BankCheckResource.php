<?php

namespace App\Filament\Resources;

use App\Filament\Resources\BankCheckResource\Pages;
use App\Filament\Resources\BankCheckResource\RelationManagers;
use App\Models\BankCheck;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Concerns\Translatable;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class BankCheckResource extends Resource
{
    use Translatable;

    protected static ?string $model = BankCheck::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                //
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('account.name'),
                TextColumn::make('bank.bank_name'),
                TextColumn::make('amount'),
                TextColumn::make('pey_date'),
                TextColumn::make('description'),
                TextColumn::make('check_number'),
                TextColumn::make('type'),

            ])
            ->filters([
                //
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
                ]),
            ]);
    }

    public static function getRelations(): array
    {
        return [
            //
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListBankChecks::route('/'),
            'create' => Pages\CreateBankCheck::route('/create'),
            'edit' => Pages\EditBankCheck::route('/{record}/edit'),
        ];
    }
}
