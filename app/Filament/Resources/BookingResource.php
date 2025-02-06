<?php

namespace App\Filament\Resources;

use App\Filament\Resources\BookingResource\Pages;
use App\Filament\Resources\BookingResource\RelationManagers;
use App\Filament\Resources\BookingResource\RelationManagers\AmenitiesRelationManager;

use App\Models\Amenities;
use App\Models\Country;
use App\Models\City;
use App\Models\Booking;
use App\Models\Hotel;
use App\Models\Room;
use App\Models\TypeRoom;
use Filament\Forms\Components\Group;
use App\Mail\BookingStatusUpdated;
use Illuminate\Support\Facades\Mail;



use Filament\Forms;
use Filament\Forms\Components\CheckboxList;
use Filament\Forms\Components\DatePicker;
use Filament\Forms\Components\Grid;
use Filament\Forms\Components\Section;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Form;
use Filament\Forms\Get;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Filament\Forms\Components\Tabs;
use Filament\Forms\Components\Tabs\Tab;
use Illuminate\Support\Collection;
use Filament\Tables\Filters\SelectFilter;

use Filament\Infolists\Components\Grid as InfolistGrid;
use Filament\Infolists\Components\Section as InfolistSection;
use Filament\Infolists\Components\TextEntry;
use Filament\Infolists\Components\Group as InfolistGroup;
use Filament\Infolists\Components\ImageEntry;
use Filament\Infolists\Components\ListEntry as InfolistListEntry;
use Filament\Infolists\Components\KeyValueEntry;
use Filament\Infolists\Components\BooleanEntry;
use Filament\Infolists\Infolist;


class BookingResource extends Resource
{
    protected static ?string $model = Booking::class;

    protected static ?string $navigationIcon = 'heroicon-o-document-check';


    /*public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Grid::make(2)
                    ->schema([

                        Section::make('User Information')
                            ->columns(2)
                            ->schema([
                                TextInput::make('name')
                                    ->label('Full Name')
                                    ->required()
                                    ->maxLength(255),
                                TextInput::make('email')
                                    ->label('Email')
                                    ->email()
                                    ->required()
                                    ->maxLength(255),
                                TextInput::make('phone')
                                    ->label('Phone')
                                    ->tel()
                                    ->required()
                                    ->maxLength(255),

                                Group::make()
                                    ->columns(3)
                                    ->schema([
                                        TextInput::make('address')
                                            ->label('Address')
                                            ->required()
                                            ->maxLength(255)
                                            ->reactive()
                                            ->disabled()
                                            ->formatStateUsing(fn($state) => str_replace(['{', '}'], '', $state)),
                                        Select::make('country_id')
                                            ->label('country')
                                            ->relationship('country', 'name')
                                            ->searchable()
                                            ->preload()
                                            ->required()
                                            ->reactive()
                                            ->afterStateUpdated(function (?string $state, callable $set, callable $get) {
                                                $country = Country::find($get('country_id'))?->name ?? '';
                                                $city = City::find($state)?->name ?? '';

                                                $set('address', "{$country}" . ($city ? ", {$city}" : ""));
                                            }),

                                        Select::make('city_id')
                                            ->label('city')
                                            ->relationship('city', 'name')
                                            ->searchable()
                                            ->preload()
                                            ->reactive()
                                            ->required()
                                            ->afterStateUpdated(function (?string $state, callable $set, callable $get) {
                                                $country = Country::find($get('country_id'))?->name ?? '';
                                                $city = City::find($state)?->name ?? '';

                                                $set('address', "{$country}" . ($city ? ", {$city}" : ""));
                                            }),

                                    ]),
                                TextInput::make('coupon_code')
                                    ->label('Coupon Code')
                                    ->maxLength(255)
                                    ->reactive()
                                    ->afterStateUpdated(function (?string $state, callable $set, callable $get) {
                                        if ($state) {
                                            $set('discount', self::calculateDiscount($state));
                                        }
                                    })->hidden(),
                            ]),
                        Section::make('Booking Details')
                            ->schema([
                                DatePicker::make('check_in_date')
                                    ->label('Reservation Start Date')
                                    ->live()
                                    ->before(
                                        function (Get $get) {
                                            return $get('check_out_date');
                                        }
                                    )
                                    ->afterStateUpdated(function ($state, $set, $get) {
                                        self::updateTotalPrice($set, $get);
                                    })
                                    ->required(),

                                DatePicker::make('check_out_date')
                                    ->label('Reservation End Date')
                                    ->live()
                                    ->afterStateUpdated(function ($state, $set, $get) {
                                        self::updateTotalPrice($set, $get);
                                    })
                                    ->required(),

                                Section::make('Guests')
                                    ->columns(3)
                                    ->schema([

                                        Select::make('roomtype_id')
                                            ->label('Room Name')
                                            ->relationship('roomtype', 'name')
                                            ->required()
                                            ->live(true)
                                            ->reactive()
                                            ->searchable()
                                            ->preload()
                                            ->afterStateUpdated(function ($state, $set) {
                                                $roomType = TypeRoom::find($state);
                                                $room = Room::find($roomType->room_id);

                                                if ($roomType) {
                                                    $set('price_per_night', $roomType->price ?? 0);
                                                    $set('hotel_id', $roomType->hotel_id);
                                                    $set('code', $roomType->room->code);
                                                    $set('capacity', $roomType->room_capacity);
                                                    $set('adults', $roomType->adult_capacity);
                                                    $set('children', $roomType->children_capacity);
                                                    $set('infants', $roomType->infants_capacity);
                                                }
                                            }),

                                        TextInput::make('room_id.code')
                                            ->label('Room Code')
                                            ->placeholder('Room Code')

                                            ->required()
                                            ->reactive(),

                                        TextInput::make('capacity')
                                            ->label('Room Capacity')
                                            ->numeric()
                                            ->required()
                                            ->reactive(),

                                        TextInput::make('adults')
                                            ->label('Adult Capacity')
                                            ->placeholder('Adult Capacity')
                                            ->numeric()
                                            ->required()
                                            ->reactive(),

                                        TextInput::make('children')
                                            ->label('Children Capacity')
                                            ->placeholder('Children Capacity')
                                            ->numeric()
                                            ->required()
                                            ->reactive(),

                                        TextInput::make('infants')
                                            ->label('Infant Capacity')
                                            ->placeholder('Infant Capacity')
                                            ->numeric()
                                            ->required()
                                            ->reactive(),
                                    ]),

                                Section::make('Price')
                                    ->columns(3)
                                    ->schema([
                                        TextInput::make('price_per_night')
                                            ->label('Room Price Per Night')
                                            ->placeholder('Price Per Night')
                                            ->numeric()
                                            ->afterStateUpdated(function ($state, $set, $get) {
                                                self::updateTotalPrice($set, $get);
                                            })
                                            ->reactive()
                                            ->prefix('TND'),

                                        TextInput::make('total_price')
                                            ->label('Total Price for Reservation')
                                            ->placeholder('Total Price')
                                            ->numeric()
                                            ->reactive()
                                            ->prefix('TND'),
                                    ]),

                                Section::make('Options')
                                    ->columns(2)
                                    ->schema([
                                        Select::make('hotel_id')
                                            ->label('Hotel Name')
                                            ->relationship('hotel', 'name->en')
                                            ->required()
                                            ->live(true)
                                            ->reactive()
                                            ->options(fn() => Hotel::all()->mapWithKeys(function ($hotel) {

                                                $hotelName = $hotel->getTranslation('name', 'en');
                                                return [$hotel->id => $hotelName];
                                            })),
                                        CheckboxList::make('amenity_ids')
                                            ->label('Amenities')
                                            ->options(function (callable $get) {
                                                $hotelId = $get('hotel_id');
                                                return Amenities::query()
                                                    ->whereHas('hotels', function ($query) use ($hotelId) {
                                                        $query->where('hotels.id', $hotelId);
                                                    })
                                                    ->pluck('title', 'id')
                                                    ->toArray();
                                            })
                                            ->reactive()

                                            ->afterStateUpdated(fn($state, callable $set, callable $get) => static::updateTotalPrice($set, $get)),
                                    ]),

                            ])
                            ->columns(2),

                    ]),

            ]);
    }*/
    public static function infolist(Infolist $infolist): Infolist
    {
        return $infolist
            ->schema([
                InfolistSection::make('User Information')
                    ->columns(2)
                    ->schema([
                        TextEntry::make('name')->label('Full Name'),
                        TextEntry::make('email')->label('Email'),
                        TextEntry::make('phone')->label('Phone'),
                        InfolistGroup::make()
                            ->columns(3)
                            ->schema([
                                //TextEntry::make('address.street')->label('Street Address'),
                                TextEntry::make('country.name')->label('Country'),
                                TextEntry::make('city.name')->label('City'),
                            ]),
                    ]),
                InfolistSection::make('Booking Details')
                    ->schema([
                        TextEntry::make('check_in_date')->label('Reservation Start Date'),
                        TextEntry::make('check_out_date')->label('Reservation End Date'),
                        InfolistSection::make('Guests')
                            ->columns(3)
                            ->schema([
                                TextEntry::make('roomtype.name')->label('Room Name'),
                                TextEntry::make('room.code')->label('Room Code'),
                                TextEntry::make('capacity')->label('Room Capacity'),
                                TextEntry::make('adults')->label('Adult Capacity'),
                                TextEntry::make('children')->label('Children Capacity'),
                                TextEntry::make('infants')->label('Infant Capacity'),
                            ]),
                        InfolistSection::make('Price')
                            ->columns(3)
                            ->schema([
                                TextEntry::make('price_per_night')->label('Room Price Per Night')->prefix(' TND '),
                                TextEntry::make('total_price')->label('Total Price for Reservation')->prefix(' TND '),
                            ]),

                    ])
                    ->columns(2),
            ]);
    }


    protected static function updateTotalPrice($set, $get)
    {
        $checkIn = $get('check_in_date');
        $checkOut = $get('check_out_date');
        $pricePerNight = $get('price_per_night');
        $amenityIds = $get('amenity_ids');
        $amenityPrice = 0;
        //$couponCode = $get('coupon_code');
        $discountPercentage = 0;


        if (!$pricePerNight) {
            $pricePerNight = 0;
        }

        if ($amenityIds && is_array($amenityIds)) {
            $amenities = Amenities::whereIn('id', $amenityIds)
                ->with('hotels')
                ->get();

            foreach ($amenities as $amenity) {
                foreach ($amenity->hotels as $hotel) {
                    if ($hotel->pivot->is_free === false) {
                        $amenityPrice += $hotel->pivot->price ?? 0;
                    }
                }
            }
        }

        /*$coupons = [
            'DISCOUNT10' => 10, // 10% discount
            'DISCOUNT20' => 20, // 20% discount
            'SUMMER50' => 50,   // 50% discount
        ];*/

        /*if ($couponCode && isset($coupons[$couponCode])) {
            $discountPercentage = $coupons[$couponCode];
        }*/

        if ($checkIn && $checkOut && $pricePerNight) {
            $checkInDate = new \DateTime($checkIn);
            $checkOutDate = new \DateTime($checkOut);
            $interval = $checkInDate->diff($checkOutDate);
            $nights = $interval->days;


            $subtotal = ($nights * $pricePerNight) + $amenityPrice;
            $discount = ($discountPercentage / 100) * $subtotal;
            $totalPrice = $subtotal - $discount;
            $set('total_price', $totalPrice);
        } else {
            $set('total_price', null);
        }
    }

    /*protected static function calculateDiscount(?string $couponCode): float
    {
        $coupons = [
            'DISCOUNT10' => 10,
            'DISCOUNT20' => 20,
            'SUMMER50' => 50,
        ];

        return $couponCode && isset($coupons[$couponCode]) ? $coupons[$couponCode] : 0;
    }*/

    public static function formatAddress(?string $country, ?string $city): string
    {
        return trim(($country ? $country : '') . ($city ? ', ' . $city : ''));
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('hotel.name')
                    ->numeric()
                    ->searchable(),
                Tables\Columns\TextColumn::make('roomtype.name')
                    ->label('Room Name')
                    ->searchable(),
                Tables\Columns\TextColumn::make('roomtype.room.type')
                    ->label('Room Type')
                    ->badge()
                    ->colors([
                        'Standard ' => 'success',
                        'Deluxe ' => 'primary',
                        'Suite ' => 'warning',
                    ])
                    ->searchable(),


                Tables\Columns\TextColumn::make('amenities.title')
                    ->label(' Amenities added')
                    ->searchable()
                    ->badge()
                    ->sortable()
                    ->placeholder('Nothing'),



                Tables\Columns\TextColumn::make('check_in_date')
                    ->date()
                    ->sortable(),
                Tables\Columns\TextColumn::make('check_out_date')
                    ->date()
                    ->sortable(),
                /*Tables\Columns\TextColumn::make('capacity')
                    ->numeric()
                    ->sortable(),*/


                Tables\Columns\TextColumn::make('total_price')
                    ->numeric()
                    ->money('TND')
                    ->sortable(),

                Tables\Columns\TextColumn::make('booking_status')
                    ->label('Booking Status')
                    ->sortable()
                    ->badge()
                    ->colors([
                        'success' => 'approved',
                        'danger' => 'cancelled',
                        'warning' => 'pending',
                    ])
                    ->label('Booking Status'),

                Tables\Columns\TextColumn::make('is_confirmed')
                    ->sortable()
                    ->searchable()
                    ->badge()
                    ->formatStateUsing(
                        fn($state, $record) =>
                        $record->booking_status === 'approved' ? 'Confirmed' : 'Not Confirmed'
                    )
                    ->colors([
                        'success' => fn($state, $record): bool => $record->booking_status === 'approved',
                        'danger' => fn($state, $record): bool => $record->booking_status === 'pending',
                    ])
                    ->label('Confirmation'),
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
                SelectFilter::make('booking_status')
                    ->multiple()
                    ->options([
                        'pending' => 'Pending',
                        'approved' => 'Approved',
                        'cancelled' => 'Cancelled',
                    ]),
            ])
            ->actions([
                Tables\Actions\ActionGroup::make([
                    Tables\Actions\ViewAction::make()
                        ->modal()
                        ->label('View Booking')
                        ->icon('heroicon-o-eye')
                        ->color('primary'),

                    Tables\Actions\DeleteAction::make(),
                    Tables\Actions\Action::make('approve')
                        ->label('Approve')
                        ->action(function (Booking $record) {
                            $record->update(['booking_status' => 'approved']);

                            Mail::to($record->email)->send(new BookingStatusUpdated($record));

                        })
                        ->hidden(function ($record) {
                            return $record->booking_status == 'approved';
                        })
                        ->color('success')
                        ->icon('heroicon-s-check-circle')
                        ->modalIcon('heroicon-o-check-circle')
                        ->requiresConfirmation(),

                    Tables\Actions\Action::make('cancel')
                        ->label('Cancel')
                        ->action(function (Booking $record) {
                            $record->update(['booking_status' => 'cancelled']);
                            Mail::to($record->email)->send(new BookingStatusUpdated($record));

                        })
                        ->hidden(function ($record) {
                            return $record->booking_status == 'cancelled';
                        })
                        ->color('danger')
                        ->icon('heroicon-s-x-circle')
                        ->modalIcon('heroicon-o-x-circle')
                        ->modal()
                        ->requiresConfirmation(),
                ]),


            ])

            ->bulkActions([
                Tables\Actions\BulkAction::make('approve')
                    ->label('Approve')
                    ->action(function (Collection $records) {
                        foreach ($records as $record) {
                            $record->update(['booking_status' => 'approved']);
                        }
                    })

                    ->color('success'),

                Tables\Actions\BulkAction::make('cancel')
                    ->label('Cancel')
                    ->action(function (Collection $records) {
                        foreach ($records as $record) {
                            $record->update(['booking_status' => 'cancelled']);
                        }
                    })
                    ->color('danger'),

                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),


                ])
            ]);
    }

    public static function getNavigationBadge(): ?string
    {
        return static::getModel()::count();
    }

    public static function getNavigationBadgeColor(): ?string
    {
        return static::getModel()::count() > 10 ? 'success' : 'danger';
    }


    public static function getRelations(): array
    {
        return [
            AmenitiesRelationManager::class,
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListBookings::route('/'),
            //'create' => Pages\CreateBooking::route('/create'),
        ];
    }
}