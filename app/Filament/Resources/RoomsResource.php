<?php

namespace App\Filament\Resources;

use App\Filament\Resources\RoomsResource\Pages;
use App\Filament\Resources\RoomsResource\RelationManagers;
use App\Models\Room;
use App\Models\Rooms;
use Filament\Forms;
use Filament\Forms\Components\Fieldset;
use Filament\Forms\Components\Grid;
use Filament\Forms\Components\Group;
use Filament\Forms\Components\MarkdownEditor;
use Filament\Forms\Components\Repeater;
use Filament\Forms\Components\Section;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Toggle;
use Filament\Forms\Form;
use Filament\Forms\Set;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use Illuminate\Support\Str;
use Mokhosh\FilamentRating\Columns\RatingColumn;
use Mokhosh\FilamentRating\Components\Rating;
use Mokhosh\FilamentRating\RatingTheme;


class RoomsResource extends Resource
{

    protected static ?string $model = Room::class;

    protected static ?string $navigationIcon = 'heroicon-o-building-storefront';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Section::make()
                    ->schema([
                        TextInput::make('code')
                            ->label('Code')
                            ->required()
                            ->columnSpan(1),

                        Select::make('type')
                            ->label('Room type')
                            ->preload()
                            ->required()
                            ->options([
                                'Standard ' =>  'Standard',
                                'Deluxe ' => 'Deluxe',
                                'Suite ' => 'Suite',
                            ])
                            ->default('Standard')

                            ->columnSpan(1),

                    ])->columns(2),


                MarkdownEditor::make('description')
                    ->label('Description')
                    ->columnSpan('full'),

                Section::make('Occupancy')
                    ->columns(6)
                    ->schema([
                        Toggle::make('is_default')
                            ->label('Set as Default')
                            ->reactive()
                            ->columnSpan(1)
                            ->afterStateUpdated(function (callable $set, $state) {
                                if ($state) {
                                    $set('pax_capacity', [
                                        ['pax_min' => 1, 'pax_max' => 3],
                                    ]);
                                    $set('adult_capacity', [
                                        ['adult_min' => 1, 'adult_max' => 3],
                                    ]);
                                    $set('children_capacity', [
                                        ['children_max' => 3],
                                    ]);
                                    $set('infants_capacity', [
                                        ['infants_max' => 2],
                                    ]);
                                    $set('extra_capacity', [
                                        [
                                            'extra_bed_max' => 1,
                                            'extra_children_max' => 1,
                                            'extra_cots_max' => 1,
                                        ],
                                    ]);
                                }
                            }),


                        Section::make('Pax capacity')
                            ->columnSpan(1)
                            ->schema([
                                TextInput::make('pax_capacity.pax_min')
                                    ->label('Min Pax Capacity')
                                    ->placeholder('min')
                                    ->numeric()
                                    ->required(),
                                TextInput::make('pax_capacity.pax_max')
                                    ->label('Max Pax Capacity')
                                    ->placeholder('max')

                                    ->numeric()
                                    ->required(),

                            ]),





                        Section::make('Adult capacity')
                            ->columnSpan(1)
                            ->schema([
                                TextInput::make('adult_capacity.adult_min')
                                    ->label('Min Adult Capacity')
                                    ->placeholder('min')

                                    ->numeric()
                                    ->required(),
                                TextInput::make('adult_capacity.adult_max')
                                    ->label('Max Adult Capacity')
                                    ->placeholder('max')

                                    ->numeric()
                                    ->required(),


                            ]),


                        Section::make('Children Capacity')
                            ->columnSpan(1)
                            ->schema([
                                TextInput::make('children_capacity.children_max')
                                    ->label('Max Children Capacity')
                                    ->placeholder('max')
                                    ->numeric()
                                    ->required(),

                            ]),


                        Section::make('Infants Capacity')
                            ->columnSpan(1)
                            ->schema([

                                TextInput::make('infants_capacity.infants_max')
                                    ->label('Max Infants Capacity')
                                    ->placeholder('max')

                                    ->numeric()
                                    ->required(),

                            ]),


                        Section::make('Extra capacity')
                            ->columnSpan(1)
                            ->schema([

                                TextInput::make('extra_capacity.extra_bed_max')
                                    ->label('Max Extra Beds')
                                    ->placeholder('Max Extra Beds')

                                    ->numeric()
                                    ->required(),
                                TextInput::make('extra_capacity.extra_children_max')
                                    ->label('Max Extra Children')
                                    ->placeholder('Max Extra Beds')

                                    ->numeric()
                                    ->required(),
                                TextInput::make('extra_capacity.extra_cots_max')
                                    ->label('Max Extra Cots')
                                    ->placeholder('Max Extra Beds')

                                    ->numeric()
                                    ->required(),

                            ]),

                        Section::make('Rating')
                            ->schema([
                                Rating::make('rating')
                                    ->color('warning')
                                    ->theme(RatingTheme::HalfStars),
                            ]),


                    ]),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('code')
                    ->numeric()
                    ->sortable(),
                TextColumn::make('description')
                    ->searchable(),

                TextColumn::make('type')
                    ->searchable()
                    ->badge()
                    ->colors([
                        'success' =>  'Standard ',
                        'primary' => 'Deluxe ',
                        'warning' => 'Suite ',
                    ]),
                RatingColumn::make('rating')
                    ->color('warning')
                    ->theme(RatingTheme::HalfStars),
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

    public static function getNavigationBadge(): ?string
    {
        return static::getModel()::count();
    }

    public static function getNavigationBadgeColor(): ?string
    {
        return static::getModel()::count() > 10 ? 'success' : 'primary';
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListRooms::route('/'),
            'create' => Pages\CreateRooms::route('/create'),
            'edit' => Pages\EditRooms::route('/{record}/edit'),
        ];
    }
}