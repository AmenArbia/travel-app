<?php

namespace App\Filament\Resources;

use App\Filament\Resources\AmenitiesResource\Pages;
use App\Filament\Resources\AmenitiesResource\RelationManagers;
use App\Models\Amenities;
use Filament\Forms;
use Filament\Forms\Components\MarkdownEditor;
use Filament\Forms\Components\Radio;
use Filament\Forms\Components\Section;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\Split;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Support\Markdown;
use Filament\Tables;
use Filament\Tables\Filters\SelectFilter;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class AmenitiesResource extends Resource
{
    protected static ?string $model = Amenities::class;

    protected static ?string $navigationIcon = 'heroicon-o-ticket';

    public static function form(Form $form): Form
    {
        return $form
            ->columns(3)
            ->schema([

                Section::make('General Amenities')
                    ->schema([
                        TextInput::make('title')
                            ->maxLength(255)
                            ->required(),
                        Select::make('type')
                            ->preload()
                            ->searchable()
                            ->live()
                            ->native(false)
                            ->options([
                                'Instant'  => 'Instant',
                                'Internet' => 'Internet',
                                'Kitchen' => 'Kitchen',
                                'Bedroom' => 'Bedroom',
                                'Living Area' => 'Living Area',
                                'Media and Technology' => 'Media and Technology'
                            ]),

                        MarkdownEditor::make('description')
                            ->maxLength(255)
                            ->required(),
                    ])->columnSpan(2),
                Section::make('Options')
                    ->schema([
                        Radio::make('status')

                            ->options([
                                'Active' => 'Active',
                                'Draft' => 'Draft',
                                'Published' => 'Published',

                            ])
                    ])->columnSpan(1)
                    ->grow(false),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('title')
                    ->searchable(),
                Tables\Columns\TextColumn::make('description')
                    ->searchable(),
                Tables\Columns\TextColumn::make('type')
                    ->searchable()
                    ->label('Amenities Type')
                    ->badge()
                    ->colors([
                        'success' => 'Instant',
                        'primary' => 'Internet',
                        'warning' => 'Cleaning',
                        'danger' => 'Bedroom',
                        'info' => 'Living',
                    ]),
                Tables\Columns\TextColumn::make('status')
                    ->searchable()
                    ->label('Amenities Status')
                    ->badge()
                    ->colors([
                        'success' => 'Active',
                        'info' => 'Draft',
                        'warning' => 'Published',
                    ]),
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

                SelectFilter::make('type')
                    ->options([
                        'Instant' => 'Instant',
                        'Internet' => 'Internet',
                        'Kitchen' => 'Kitchen',
                        'Bedroom' => 'Bedroom',
                        'Living Area' => 'Living Area',
                        'Media and Technology' => 'Media and Technology'
                    ]),
            ])
            ->actions([
                Tables\Actions\ViewAction::make()
                    ->color('info'),
                Tables\Actions\ActionGroup::make([
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

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListAmenities::route('/'),
            'create' => Pages\CreateAmenities::route('/create'),
            'edit' => Pages\EditAmenities::route('/{record}/edit'),
        ];
    }
}