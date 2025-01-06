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
use Mokhosh\FilamentRating\Columns\RatingColumn;
use Mokhosh\FilamentRating\Components\Rating;
use Cheesegrits\FilamentGoogleMaps\Columns\MapColumn;
use Filament\Resources\Concerns\Translatable;
use Mokhosh\FilamentRating\RatingTheme;
use Cheesegrits\FilamentGoogleMaps\Fields\Map;


class HotelResource extends Resource
{
    use Translatable;

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
                                            ->afterStateUpdated(function (Set $set, ?string $state, ?string $operation) {
                                                $set('slug', $state);
                                            }),
                                        TextInput::make('slug')
                                            ->label('Hotel slug')
                                            ->maxLength(255)
                                            ->dehydrated()
                                            ->live()
                                            ->unique(Hotel::class, 'slug->en' . 'slug->ar', ignoreRecord: true)
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
                                    ->preload()
                                    ->searchable()
                                    ->default('Hotel'),
                            ]),

                        Tabs\Tab::make('References')
                            ->schema([
                                Grid::make(3)
                                    ->schema([
                                        TextInput::make('address')
                                            ->label('Hotel address')
                                            ->columnSpanFull(),
                                        Map::make('location')
                                            ->mapControls([
                                                'mapTypeControl' => true,
                                                'scaleControl' => true,
                                                'streetViewControl' => true,
                                                'rotateControl' => true,
                                                'fullscreenControl' => true,
                                                'zoomControl' => true,
                                            ])
                                            ->columnSpanFull()
                                            ->reactive()
                                            ->afterStateUpdated(function ($state, callable $get, callable $set) {
                                                $set('latitude', $state['lat']);
                                                $set('longitude', $state['lng']);
                                            })->lazy()
                                            ->debug()
                                            ->geolocate()
                                            ->autocomplete('address', ['establishment'])
                                            ->autocompleteReverse(true)
                                            ->reverseGeocode([
                                                'street' => '%n %S',
                                                'city' => '%L',
                                                'state' => '%A1',
                                            ])->debug(),
                                        TextInput::make('street')
                                            ->label('Street'),
                                        TextInput::make('latitude')
                                            ->label('Latitude')
                                            ->readOnly(),
                                        TextInput::make('longitude')
                                            ->label('Longitude')
                                            ->readOnly(),
                                        Select::make('country_id')
                                            ->label('Hotel country')
                                            ->relationship('country', 'name')
                                            ->preload()
                                            ->searchable()
                                            ->required(),
                                        Select::make('city_id')
                                            ->label('Hotel city')
                                            ->relationship('city', 'name')
                                            ->preload()
                                            ->searchable()
                                            ->required(),
                                        Select::make('chaine_id')
                                            ->label('Hotel chaine')
                                            ->relationship('chaine', 'name')
                                            ->preload()
                                            ->searchable()
                                            ->required(),
                                    ]),
                            ]),


                        Tab::make('Rating')
                            ->schema([
                                Rating::make('rating')
                                    ->label('Rating')
                                    ->theme(RatingTheme::HalfStars),
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
                    ->label('Name ')
                    ->searchable(),

                Tables\Columns\TextColumn::make('slug')
                    ->label('Slug ')
                    ->searchable(),

                Tables\Columns\TextColumn::make('status')
                    ->searchable()
                    ->badge()
                    ->sortable()
                    ->colors([
                        'success' => 'actif',
                        'danger' => 'fermé',
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
                RatingColumn::make('rating')
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
            ->headerActions([
                Tables\Actions\LocaleSwitcher::make(),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
                ]),
            ]);
    }

    public static function getTranslatableLocales(): array
    {
        return ['en', 'ar'];
    }

    public static function getRelations(): array
    {
        return [
            AmenitiesRelationManager::class,
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