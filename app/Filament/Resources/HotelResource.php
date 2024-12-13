<?php

namespace App\Filament\Resources;

use App\Filament\Resources\HotelResource\Pages;
use App\Filament\Resources\HotelResource\RelationManagers;
use App\Filament\Resources\HotelResource\RelationManagers\AmenitiesRelationManager;
use App\Filament\Resources\HotelResource\RelationManagers\RoomsRelationManager;
use App\Filament\Resources\PhotoRelationManagerResource\RelationManagers\PhotoRelationManager;
use App\Filament\Resources\RoomTypeRelationManagerResource\RelationManagers\TypeRoomRelationManager;
use App\Models\Hotel;
use Filament\Forms;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\Grid;
use Filament\Forms\Components\Group;
use Filament\Forms\Components\MarkdownEditor;
use Filament\Forms\Components\Radio;
use Filament\Forms\Components\Repeater;
use Filament\Forms\Components\Section;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\Tabs;
use Filament\Forms\Components\Tabs\Tab;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Form;
use Filament\Forms\Set;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Filters\SelectFilter;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use Illuminate\Support\Str;


class HotelResource extends Resource
{
    protected static ?string $model = Hotel::class;

    protected static ?string $navigationIcon = 'heroicon-o-building-office';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Tabs::make('Hotel Tabs')
                    ->tabs([
                        Tabs\Tab::make('General Information')
                            ->schema([
                                Section::make('Hotel Information')
                                    ->schema([
                                        TextInput::make('name')
                                            ->label('Hotel name')
                                            ->maxLength(255)
                                            ->live(true)
                                            ->required()
                                            ->afterStateUpdated(fn(Set $set, ?string $state) => $set('slug', Str::slug($state))),
                                        TextInput::make('slug')
                                            ->label('Hotel slug')
                                            ->maxLength(255)
                                            ->dehydrated()
                                            ->unique(Hotel::class, 'slug', ignoreRecord: true)
                                            ->required(),
                                        MarkdownEditor::make('description')
                                            ->label('Hotel description')
                                            ->fileAttachmentsDirectory('hotels'),

                                        FileUpload::make('image_cover')
                                            ->label('Hotel cover image')
                                            ->image()
                                            ->directory('hotels')

                                    ])

                            ]),

                        Tabs\Tab::make('Contact Details')
                            ->schema([
                                Repeater::make('contact')
                                    ->schema([
                                        TextInput::make('nom')
                                            ->label('Contact name')
                                            ->maxLength(255)
                                            ->required(),
                                        TextInput::make('tel')
                                            ->label('Contact phone')
                                            ->required(),
                                    ]),
                                TextInput::make('emails')
                                    ->label('Email')
                                    ->email()
                                    ->required(),

                            ]),

                        Tabs\Tab::make('Additional Details')
                            ->schema([

                                Radio::make('status')
                                    ->label('Status')
                                    ->options([
                                        'actif' => 'Active',
                                        'en maintenance' => 'On repair',
                                        'fermé' => 'Closed',
                                    ])
                                    ->default('actif')
                                    ->required(),
                                Select::make('type_hotel')
                                    ->label('Hotel type')
                                    ->options([
                                        'Hotel' => 'Hotel',
                                        'Guest House' => 'Guest House',
                                        'Resort' => 'Resort',
                                    ])
                                    ->default('Hotel'),
                            ]),


                        Tabs\Tab::make('References')
                            ->schema([
                                Select::make('country_id')
                                    ->label('Hotel country')
                                    ->relationship('country', 'name')
                                    ->preload()
                                    ->searchable()
                                    ->required(),
                                Select::make('city_id')
                                    ->label('Hotel city')
                                    ->relationship('city', 'name')
                                    ->required(),
                                Select::make('chaine_id')
                                    ->label('Hotel chaine')
                                    ->relationship('chaine', 'name')
                                    ->preload()
                                    ->searchable()
                                    ->required(),
                            ])

                    ])
                    ->columnSpanFull()
            ]);
    }




    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('name')
                    ->searchable(),
                Tables\Columns\TextColumn::make('slug')
                    ->searchable(),
                Tables\Columns\TextColumn::make('status')
                    ->searchable()
                    ->badge()
                    ->sortable()
                    ->colors([
                        'success' => 'actif',
                        'secondary' => 'fermé',
                        'primary' => 'en maintenance',
                    ])
                    ->icons([
                        'heroicon-o-check-circle'  => 'actif',
                        'heroicon-o-x-circle'  => 'fermé',
                        'heroicon-o-clock'  => 'en maintenance',
                    ])
                    ->default('gray'),

                Tables\Columns\TextColumn::make('type_hotel')
                    ->searchable()
                    ->sortable()
                    ->badge()
                    ->colors([
                        'Hotel' => 'success',
                        'Resort' => 'info',
                        'Guest House' => 'warning',
                    ])
                    ->default('gray'),

                Tables\Columns\TextColumn::make('chaine.name')
                    ->sortable(),
                Tables\Columns\TextColumn::make('country.name')
                    ->sortable(),
                Tables\Columns\TextColumn::make('city.name')
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
                SelectFilter::make('status')
                    ->options([
                        'actif' => 'Active',
                        'en maintenance' => 'On repair',
                        'fermé' => 'Closed',
                    ]),
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
            AmenitiesRelationManager::class,
            // RoomsRelationManager::class,
            PhotoRelationManager::class,
            TypeRoomRelationManager::class


        ];
    }

    public static function getNavigationBadge(): ?string
    {
        return static::getModel()::count();
    }

    public static function getNavigationBadgeColor(): ?string
    {
        return static::getModel()::count() > 10 ? 'success' : 'danger';
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListHotels::route('/'),
            'create' => Pages\CreateHotel::route('/create'),
            'edit' => Pages\EditHotel::route('/{record}/edit'),
        ];
    }
}