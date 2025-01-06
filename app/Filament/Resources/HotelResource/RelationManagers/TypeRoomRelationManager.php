<?php

namespace App\Filament\Resources\RoomTypeRelationManagerResource\RelationManagers;

use App\Models\Room;
use Filament\Forms;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\MarkdownEditor;
use Filament\Forms\Components\Section;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Form;
use Filament\Resources\RelationManagers\RelationManager;
use Filament\Tables;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use Mokhosh\FilamentRating\Columns\RatingColumn;
use Mokhosh\FilamentRating\Components\Rating;
use Mokhosh\FilamentRating\RatingTheme;

class TypeRoomRelationManager extends RelationManager
{
    protected static string $relationship = 'roomtype';
    protected static ?string $title = 'Room Type';
    protected static ?string $icon =  'heroicon-o-building-storefront';


    public function form(Form $form): Form
    {
        return $form
            ->schema([
                Section::make('General Information')
                    ->schema([
                        TextInput::make('name')
                            ->label('Room name')
                            ->maxLength(50)
                            ->required(),

                        Select::make('room_id')
                            ->label('Room Code')
                            ->relationship('room', 'code')
                            ->required()
                            ->live(true)
                            ->preload()
                            ->reactive()
                            ->searchable()
                            ->afterStateUpdated(
                                function ($state,   $set) {
                                    $room = null;
                                    if ($state) {
                                        $room = Room::find($state);
                                    }
                                    if ($room) {
                                        $set('pax_capacity', $room->pax_capacity);
                                        $set('adult_capacity', $room->adult_capacity);
                                        $set('children_capacity', $room->children_capacity);
                                        $set('infants_capacity', $room->infants_capacity);
                                        $set('room_highlights', $room->description);
                                        $set('room_type', $room->type);
                                        $set('price', $room->price);
                                        $set('photos', $room->photos);
                                        $set('rating', $room->rating);
                                    };
                                }
                            ),
                        Select::make('room_type')
                            ->label('Room Type')
                            ->preload()
                            ->live(true)
                            ->searchable(),
                    ])
                    ->columns(3),
                Section::make()
                    ->schema([
                        TextInput::make('room_capacity')
                            ->label('Capacity')
                            ->numeric()
                            ->required()
                            ->columnSpanFull(),

                        TextInput::make('price')
                            ->required()
                            ->numeric()
                            ->prefix('TND'),
                    ]),



                Section::make('Capacity Details')
                    ->schema([
                        Section::make('Pax capcity')->schema([
                            TextInput::make('pax_capacity.pax_min')
                                ->label('Min Pax Capacity')
                                ->numeric()
                                ->placeholder('min')
                                ->numeric()
                                ->required(),
                            TextInput::make('pax_capacity.pax_max')
                                ->label('Max Pax Capacity')
                                ->placeholder('max')
                                ->required(),
                        ])->columnSpan(1),

                        Section::make('Adult capacity')->schema([
                            TextInput::make('adult_capacity.adult_min')
                                ->label('Min Pax Capacity')
                                ->numeric()
                                ->placeholder('min')
                                ->numeric()
                                ->required(),
                            TextInput::make('adult_capacity.adult_max')
                                ->label('Max Pax Capacity')
                                ->placeholder('max')
                                ->numeric()
                                ->required(),
                        ])->columnSpan(1),

                        Section::make('Children capacity')->schema([
                            TextInput::make('children_capacity.children_max')
                                ->label('Max Pax Capacity')
                                ->placeholder('max')
                                ->numeric()
                                ->required(),
                        ])->columnSpan(1),

                        Section::make('Infants capacity')->schema([
                            TextInput::make('infants_capacity.infants_max')
                                ->label('Max Pax Capacity')
                                ->placeholder('max')
                                ->numeric()
                                ->required(),
                        ])->columnSpan(1),
                    ])
                    ->columns(2),

                Section::make('Highlights')
                    ->schema([
                        Textarea::make('room_highlights')
                            ->label('Room highlights')
                            ->live(true)
                            ->maxLength(100),

                        MarkdownEditor::make('description')
                            ->label('Description')
                            ->maxlength(255)
                    ]),

                Section::make('Rating')
                    ->schema([
                        Rating::make('rating')
                            ->color('warning')
                            ->theme(RatingTheme::HalfStars),
                    ]),

                FileUpload::make('photos')
                    ->label('Photos')
                    ->directory('type_rooms')
                    ->image()
                    ->multiple()
                    ->columnSpanFull(),


            ]);
    }

    public function table(Table $table): Table
    {
        return $table
            ->recordTitleAttribute('id')
            ->columns([
                Tables\Columns\TextColumn::make('name')->label('Room Name')
                    ->searchable(),
                Tables\Columns\TextColumn::make('room.code')->label('Room Code')
                    ->searchable(),
                Tables\Columns\TextColumn::make('hotel.name')->label('Hotel Name')
                    ->searchable(),
                Tables\Columns\TextColumn::make('room.type')->label('Room Type')
                    ->searchable()
                    ->badge()
                    ->colors([
                        'success' =>  'Standard ',
                        'primary' => 'Deluxe ',
                        'warning' => 'Suite ',
                    ]),



                TextColumn::make('price')
                    ->money('TND')
                    ->searchable()
                    ->sortable(),
                RatingColumn::make('room.rating')
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
            ->headerActions([
                Tables\Actions\CreateAction::make(),
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
                Tables\Actions\DeleteAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
                ]),
            ]);
    }
}