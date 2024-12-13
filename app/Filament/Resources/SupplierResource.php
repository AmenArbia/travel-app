<?php

namespace App\Filament\Resources;

use App\Filament\Resources\SupplierResource\Pages;
use App\Filament\Resources\SupplierResource\RelationManagers;
use App\Models\Supplier;
use Filament\Forms;
use Filament\Forms\Components\DatePicker;
use Filament\Forms\Components\Radio;
use Filament\Forms\Components\Repeater;
use Filament\Forms\Components\Section;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Form;
use Filament\Forms\Get;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class SupplierResource extends Resource
{
    protected static ?string $model = Supplier::class;

    protected static ?string $navigationIcon = 'heroicon-o-shopping-cart';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Section::make('Suppliers')
                    ->schema([

                        Section::make()
                            ->schema([
                                TextInput::make('name')
                                    ->label('Supplier Name')
                                    ->required(),

                                TextInput::make('email')
                                    ->label('Supplier email')
                                    ->email()
                                    ->required(),
                                TextInput::make('phone')
                                    ->label('Supplier phone')
                                    ->tel()
                                    ->required(),
                                Select::make('hotel')
                                    ->label('Hotel')
                                    ->relationship('hotels', 'name')
                                    ->preload()
                                    ->multiple()
                                    ->searchable()
                                    ->native(false)
                                    ->required(),

                                Select::make('service_type')
                                    ->label('Service Type')
                                    ->options([
                                        'food supplies' => 'Food supplies',
                                        'beverage' => 'Beverage',
                                        'Cleaning' => 'Cleaning',
                                        'transportation' => 'Transportation'
                                    ])->preload()
                                    ->searchable()
                                    ->required(),

                            ])->columns(2),




                        Radio::make('supplier_type')
                            ->label('Supplier Type')
                            ->options([
                                'direct' => 'Direct',
                                'external' => 'External',
                            ])
                            ->required()
                            ->live()
                            ->inline(),


                        Section::make('Contract Details')
                            ->schema([
                                DatePicker::make('contract_start_date')
                                    ->label('Contract Start Date')
                                    ->live()
                                    ->before(
                                        function (Get $get) {
                                            return $get('contract_end_date');
                                        }
                                    )
                                    ->required(),

                                DatePicker::make('contract_end_date')
                                    ->label('Contract End Date')
                                    ->live()
                                    ->required(),
                            ])
                            ->columns(2)
                            ->visible(fn($get) => $get('supplier_type') === 'external'),

                    ])
                    ->columnSpanFull(),
            ]);
    }


    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('name')
                    ->searchable(),
                Tables\Columns\TextColumn::make('email')
                    ->searchable(),
                Tables\Columns\TextColumn::make('phone')
                    ->searchable(),
                Tables\Columns\TextColumn::make('service_type')
                    ->searchable()
                    ->label('Service Type')
                    ->badge()
                    ->colors([
                        'success' => 'food supplies',
                        'primary' => 'beverage',
                        'warning' => 'Cleaning',
                        'danger' => 'transportation',
                    ]),

                Tables\Columns\TextColumn::make('supplier_type')
                    ->searchable()
                    ->badge()
                    ->label('Supplier Type')
                    ->colors([
                        'success' => 'direct',
                        'danger' => 'external',
                    ]),
                Tables\Columns\TextColumn::make('contract_start_date')
                    ->date()
                    ->sortable(),
                Tables\Columns\TextColumn::make('contract_end_date')
                    ->date()
                    ->sortable(),
                Tables\Columns\TextColumn::make('created_at')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
                Tables\Columns\TextColumn::make('updated_at')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
            ])
            ->filters([
                //
            ])
            ->actions([
                Tables\Actions\ActionGroup::make([
                    Tables\Actions\ViewAction::make(),
                    Tables\Actions\EditAction::make(),
                    Tables\Actions\DeleteAction::make(),
                ])
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

    public static function getNavigationBadge(): ?string
    {
        return static::getModel()::count();
    }

    public static function getNavigationBadgeColor(): ?string
    {
        return static::getModel()::count() > 10 ? 'success' : 'success';
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListSuppliers::route('/'),
            'create' => Pages\CreateSupplier::route('/create'),
            'edit' => Pages\EditSupplier::route('/{record}/edit'),
        ];
    }
}