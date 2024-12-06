<?php

namespace App\Filament\Resources;

use App\Filament\Resources\ChaineResource\Pages;
use App\Filament\Resources\ChaineResource\RelationManagers;
use App\Models\Chaine;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Forms\Set;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use Illuminate\Support\Str;

class ChaineResource extends Resource
{
    protected static ?string $model = Chaine::class;

    protected static ?string $navigationIcon = 'heroicon-o-building-library';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\TextInput::make('name')
                    ->required()
                    ->maxLength(255)
                    ->live(true)
                    ->afterStateUpdated(fn(Set $set, ?string $state) => $set('slug', Str::slug($state))),
                Forms\Components\TextInput::make('slug')
                    ->required()
                    ->maxLength(255)
                    ->dehydrated()
                    ->unique(Chaine::class, 'slug', ignoreRecord: true),
                Forms\Components\MarkdownEditor::make('description')
                    ->required()
                    ->maxLength(255)
                    ->columnSpanFull()
                    ->fileAttachmentsDirectory('chaines'),
                Forms\Components\FileUpload::make('image')
                    ->image()
                    ->directory('chaines')
                    ->multiple(10)
                    ->reorderable()
                    ->columnSpan(2),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([

                Tables\Columns\ImageColumn::make('image')
                    ->circular(),
                Tables\Columns\TextColumn::make('name')
                    ->searchable(),
                Tables\Columns\TextColumn::make('slug')
                    ->searchable()
                    ->sortable(),
                Tables\Columns\TextColumn::make('description')
                    ->searchable(),


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

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListChaines::route('/'),
            //'create' => Pages\CreateChaine::route('/create'),
            //'edit' => Pages\EditChaine::route('/{record}/edit'),
        ];
    }
}
