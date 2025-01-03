<?php

namespace App\Filament\Resources\HotelResource\RelationManagers;

use App\Models\Amenities;
use Filament\Forms;
use Filament\Forms\Components\CheckboxList;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Toggle;
use Filament\Forms\Form;
use Filament\Forms\Get;
use Filament\Resources\RelationManagers\RelationManager;
use Filament\Tables;
use Filament\Tables\Actions\AttachAction;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class AmenitiesRelationManager extends RelationManager
{
    protected static string $relationship = 'amenities';
    protected static ?string $icon =  'heroicon-o-ticket';


    public function form(Form $form): Form
    {
        return $form
            ->columns(1)
            ->schema([

                TextInput::make('title')
                    ->label('Amenity Title')
                    ->required(),

                Toggle::make('is_free')
                    ->label('Is Free')
                    ->inline(false)
                    ->live(),


                TextInput::make('price')
                    ->label('Price')
                    ->visible(fn($get) => !$get('is_free'))
                    ->required(fn($get) => !$get('is_free')),




                Textarea::make('description')
                    ->label('Amenity Description'),



                Select::make('room_id')
                    ->relationship('room', 'code')
                    ->label('Assign to Room')
                    ->searchable()
                    ->preload()
                    ->placeholder('Select a Room'),

                /*
                Select::make('type')
                    ->label('Amenity Type')
                    ->options([
                        'Instant' => 'Instant',
                        'Internet' => 'Internet',
                        'Kitchen' => 'Kitchen',
                        'Bedroom' => 'Bedroom',
                        'Living Area' => 'Living Area',
                        'Media and Technology' => 'Media and Technology',
                    ])
                    ->required(),

                Select::make('status')
                    ->label('Amenity Status')
                    ->options([
                        'Active' => 'Active',
                        'Draft' => 'Draft',
                        'Published' => 'Published',
                    ])
                    ->required(),
                    */
            ]);
    }

    public function table(Table $table): Table
    {
        return $table
            ->recordTitleAttribute('title')
            ->columns([
                TextColumn::make('title')
                    ->label('Title'),


                TextColumn::make('type')
                    ->label('Type')
                    ->searchable()
                    ->badge()
                    ->color(fn(string $state): string => match ($state) {
                        'Instant' => 'info',
                        'Internet' => 'warning',
                        'Kitchen' => 'success',
                        'Bedroom' => 'danger',
                        'Living Area' => 'danger',
                        'Media and Technology' => 'primary'
                    })
                    ->sortable(),

                TextColumn::make('price')
                    ->label('Price')
                    ->getStateUsing(
                        function ($record) {
                            if ($record->pivot['is_free'] !== null) {
                                if ($record->pivot['is_free'] == true) {
                                    return 'Free';
                                } else {
                                    return $record->pivot['price'] . 'TND';
                                }
                            }
                        }
                    ),

                TextColumn::make('room.code')
                    ->label('Room Code'),


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
            ->headerActions([
                Tables\Actions\AttachAction::make()
                    ->preloadRecordSelect()
                    ->form(fn(AttachAction $action): array => [
                        $action->getRecordSelect()
                            ->native(false),

                        Toggle::make('is_free')
                            ->inline(false)
                            ->label('Is free')
                            ->required()
                            ->live(),
                        TextInput::make('price')
                            ->numeric()
                            ->visible(function (Get $get) {
                                if ($get('is_free')) {
                                    return false;
                                }

                                return true;
                            })->minValue(0)
                            ->required(function (Get $get) {
                                if ($get('is_free')) {
                                    return false;
                                }

                                return true;
                            }),

                        Select::make('room_id')
                            ->relationship('room', 'code')
                            ->label('Assign to Room')
                            ->searchable()
                            ->preload()
                            ->placeholder('Select a Room')
                            ->nullable(),
                    ])
            ])
            ->actions([
                Tables\Actions\EditAction::make()->action(function ($data, $record) {
                    $record->update($data);
                    session()->flash('success', 'Amenity updated successfully.');
                }),
                Tables\Actions\DetachAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
                ]),
            ]);
    }
}
