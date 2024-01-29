<?php

namespace App\Filament\Resources;

use App\Filament\Resources\AccountsResource\Pages;
use App\Filament\Resources\AccountsResource\RelationManagers;
use App\Models\Accounts;
use Filament\Forms;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Form;
use Filament\Resources\Concerns\Translatable;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Filters\SelectFilter;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class AccountsResource extends Resource
{

    protected static ?string $model = Accounts::class;

    protected static ?string $navigationLabel = 'اشخاص';

    protected static ?string $navigationIcon = 'heroicon-o-user';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                TextInput::make('name')
                    ->required()
                    ->maxLength(255)
                    ->label(__('name')),
                Select::make('type')
                    ->multiple()
                    ->options([
                        'مشتری' => 'مشتری',
                        'تولید کننده' => 'تولید کننده',
                        'کارمند' => 'کارمند',
                        'صاحبان سهام' => 'صاحبان سهام',
                        'هزینه' => 'هزینه',

                    ])
                    ->required()
                    ->label(__('type'))
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('name')
                    ->searchable()
                    ->label(__('name')),
                TextColumn::make('type')
                    ->label(__('type')),
            ])
            ->filters([
                SelectFilter::make('type')
                    ->options([
                        'مشتری' => 'مشتری',
                        'تولید کننده' => 'تولید کننده',
                        'کارمند' => 'کارمند',
                        'صاحبان سهام' => 'صاحبان سهام',
                        'هزینه' => 'هزینه',
                    ])
                    ->label(__('type')),
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
            'index' => Pages\ListAccounts::route('/'),
            'create' => Pages\CreateAccounts::route('/create'),
            'edit' => Pages\EditAccounts::route('/{record}/edit'),
        ];
    }
}
