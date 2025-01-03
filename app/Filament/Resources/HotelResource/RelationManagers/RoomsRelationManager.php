<?php

namespace App\Filament\Resources\HotelResource\RelationManagers;

use App\Models\Room;
use Filament\Forms;
use Filament\Forms\Components\Section;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Toggle;
use Filament\Forms\Form;
use Filament\Resources\RelationManagers\RelationManager;
use Filament\Tables;
use Filament\Tables\Actions\AttachAction;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

use function Pest\Laravel\options;

class RoomsRelationManager extends RelationManager
{
    protected static string $relationship = 'room';

    public function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Select::make('code')
                    ->options(Room::query()->pluck('code', 'id')->toArray())
                    ->searchable()
                    ->required()
                    ->preload()
                    ->live()
                    ->reactive()
                    ->afterStateUpdated(function (callable $set, $state) {
                        if ($state) {

                            $room = Room::find($state);

                            if ($room) {

                                $set('description', $room->description);
                                $set('pax_capacity', [
                                    'pax_min' => $room->pax_min ?? 1,
                                    'pax_max' => $room->pax_max ?? 3,
                                ]);
                                $set('adult_capacity', [
                                    'adult_min' => $room->adult_min ?? 1,
                                    'adult_max' => $room->adult_max ?? 3,
                                ]);
                                $set('children_capacity', [
                                    'children_max' => $room->children_max ?? 3,
                                ]);
                                $set('infants_capacity', [
                                    'infants_max' => $room->infants_max ?? 2,
                                ]);
                                $set('extra_capacity', [
                                    'extra_bed_max' => $room->extra_bed_max ?? 1,
                                    'extra_children_max' => $room->extra_children_max ?? 1,
                                    'extra_cots_max' => $room->extra_cots_max ?? 1,
                                ]);
                            }
                        }
                    }),

                TextInput::make('description')
                    ->disabled(),

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
                                } else {
                                    $set('pax_capacity', []);
                                    $set('adult_capacity', []);
                                    $set('children_capacity', []);
                                    $set('infants_capacity', []);
                                    $set('extra_capacity', []);
                                }
                            }),


                        Section::make('Pax capacity')
                            ->columnSpan(2)
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
                            ->columnSpan(2)
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
                            ->columnSpan(2)
                            ->schema([
                                TextInput::make('children_capacity.children_max')
                                    ->label('Max Children Capacity')
                                    ->placeholder('max')
                                    ->numeric()
                                    ->required(),


                            ]),




                        Section::make('Infants Capacity')
                            ->columnSpan(2)
                            ->schema([

                                TextInput::make('infants_capacity.infants_max')
                                    ->label('Max Infants Capacity')
                                    ->placeholder('max')

                                    ->numeric()
                                    ->required(),

                            ]),





                        Section::make('Extra capacity')
                            ->columnSpan(2)
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


                    ]),


            ]);
    }

    public function table(Table $table): Table
    {
        return $table
            ->recordTitleAttribute('code')
            ->columns([
                Tables\Columns\TextColumn::make('room_id')
                    ->label('Room ID ')
                    ->sortable()
                    ->searchable(),
                Tables\Columns\TextColumn::make('hotel_id')
                    ->label('Hotel Id'),
                /*
                Tables\Columns\TextColumn::make('room.code')
                    ->label('Room Code')
                    ->sortable()
                    ->searchable(),

                TextColumn::make('pax_capicity')
                    ->label('Pax Capacity'),
*/
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
                /*Tables\Actions\AttachAction::make()

                    ->preloadRecordSelect()
                    ->form(fn(AttachAction $action): array => [
                        $action->getRecordSelect()->native(false),

                    ]),*/
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
