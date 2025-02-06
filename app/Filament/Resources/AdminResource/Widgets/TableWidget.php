<?php

namespace App\Filament\Resources\AdminResource\Widgets;

use App\Filament\Resources\BookingResource;
use App\Models\Booking;
use Filament\Actions\CreateAction;
use Filament\Actions\ViewAction;
use Filament\Tables;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;
use Filament\Widgets\TableWidget as BaseWidget;
use GuzzleHttp\Promise\Create;

class TableWidget extends BaseWidget
{
    protected int|string|array $columnSpan = 'full';
    protected static ?int $sort = 2;

    public function getTableHeading(): string
    {
        return 'Recent Bookings';
    }
    public function table(Table $table): Table
    {
        return $table
            ->query(BookingResource::getEloquentQuery())
            ->defaultPaginationPageOption(4)
            ->defaultSort('created_at', 'desc')
            ->recordUrl(
                fn(Booking $record) => BookingResource::getUrl('index')
            )
            ->columns([
                TextColumn::make('name')
                    ->searchable()
                    ->label('Fullname'),
                TextColumn::make('email')
                    ->searchable()
                    ->label('Email'),
                TextColumn::make('hotel.name')
                    ->searchable()
                    ->label('Hotel'),
                TextColumn::make('roomtype.room.type')
                    ->searchable()
                    ->badge()
                    ->colors([
                        'Standard ' => 'success',
                        'Deluxe ' => 'primary',
                        'Suite ' => 'warning',
                    ])
                    ->label('Room Type'),
                TextColumn::make('check_in_date')
                    ->sortable()
                    ->searchable()
                    ->label('Check_in_date'),
                TextColumn::make('check_out_date')
                    ->sortable()
                    ->searchable()
                    ->label('Check_out_date'),
                TextColumn::make('total_price')
                    ->numeric()
                    ->money('TND')
                    ->sortable()
                    ->searchable()
                    ->label('Total Price'),

                TextColumn::make('booking_status')
                    ->sortable()
                    ->searchable()
                    ->badge()
                    ->colors([
                        'success' => 'approved',
                        'danger' => 'cancelled',
                        'warning' => 'pending',
                    ])
                    ->label('Booking Status'),
                /*TextColumn::make('is_confirmed')
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
                    ->label('Confirmation'),*/
            ]);

    }
}