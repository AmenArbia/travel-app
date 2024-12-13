<?php

namespace App\Filament\Resources\PhotoRelationManagerResource\RelationManagers;

use Filament\Forms;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\MarkdownEditor;
use Filament\Forms\Components\Select;
use Filament\Forms\Form;
use Filament\Resources\RelationManagers\RelationManager;
use Filament\Tables;
use Filament\Tables\Columns\ImageColumn;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class PhotoRelationManager extends RelationManager
{
    protected static ?string $icon =  'heroicon-o-photo';

    protected static string $relationship = 'photo';


    public function form(Form $form): Form
    {
        return $form
            ->schema([
                FileUpload::make('photos')
                    ->label('Photos')
                    ->image()
                    ->multiple()
                    ->directory('photos')
                    ->required(),
                Select::make('type')
                    ->label('Hotel Type')
                    ->options([
                        'Hotel' => 'Hotel',
                        'Resort' => 'Resort',
                        'Guest House' => 'Guest House',
                    ])
                    ->default('Standard')
                    ->required(),
                MarkdownEditor::make('caption')
                    ->label('Caption'),
            ]);
    }

    public function table(Table $table): Table
    {
        return $table
            ->recordTitleAttribute('id')
            ->columns([

                TextColumn::make('type')
                    ->label('Hotel Type')
                    ->sortable()
                    ->searchable()
                    ->badge()
                    ->colors([
                        'success'  => 'Hotel',
                        'info'  =>  'Resort',
                        'warning'  =>  'Guest House',
                    ])
                    ->default('gray'),
                TextColumn::make('caption')
                    ->label('Caption')
                    ->sortable()
                    ->searchable(),
                ImageColumn::make('photos')
                    ->label('Photos')
                    ->size(50),
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