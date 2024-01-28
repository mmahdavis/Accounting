<?php

namespace App\Filament\Resources;

use App\Filament\Resources\BankCheckResource\Pages;
use App\Filament\Resources\BankCheckResource\RelationManagers;
use App\Models\BankCheck;
use Filament\Forms;
use Filament\Forms\Components\DatePicker;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Form;
use Filament\Resources\Concerns\Translatable;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use Illuminate\Support\Facades\Date;

class BankCheckResource extends Resource
{
    protected static ?string $model = BankCheck::class;

    protected static ?string $navigationLabel = 'چک ها';

    protected static ?string $navigationIcon = 'heroicon-o-chat-bubble-bottom-center-text';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Select::make('account_id')
                    ->relationship('account', 'name')
                    ->searchable()
                    ->preload()
                    ->createOptionForm([
                        TextInput::make('name')
                            ->required()
                            ->maxLength(255)
                            ->label(__('name')),
                        Select::make('type')
                            ->options([
                                'مشتری' => 'مشتری',
                                'تولید کننده' => 'تولید کننده',
                                'کارمند' => 'کارمند',
                                'صاحبان سهام' => 'صاحبان سهام',
                            ])
                            ->required()
                            ->label(__('type'))
                    ])
                    ->required()
                    ->label(__('account')),
                Select::make('bank_id')
                    ->relationship('bank', 'bank_name')
                    ->searchable()
                    ->preload()
                    ->createOptionForm([
                        TextInput::make('bank_name')
                            ->required()
                            ->maxLength(255)
                            ->label(__('bank')),
                        TextInput::make('balance')
                            ->numeric()
                            ->required()
                            ->label(__('balance'))
                    ])
                    ->required()
                    ->label(__('bank')),
                Select::make('type')
                    ->options([
                        'واریز' => 'واریز',
                        'برداشت' => 'برداشت'
                    ])
                    ->default('برداشت')
                    ->required()
                    ->label(__('type')),
                TextInput::make('check_number')
                    ->numeric()
                    ->required()
                    ->label(__('check_number')),
                TextInput::make('amount')
                    ->numeric()
                    ->required()
                    ->label(__('amount')),
                DatePicker::make('pay_date')
                    ->jalali()
                    ->required()
                    ->maxDate(now())
                    ->label(__('pay_date')),
                Textarea::make('description')
                    ->autosize()
                    ->columnSpan('full')
                    ->label(__('description'))
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
