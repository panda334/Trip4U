<?php

namespace App\Filament\Resources;

use filament;
use components;
use Filament\Forms;
use Filament\Tables;
use App\Models\Country;
use Filament\Forms\Form;
use Filament\Tables\Table;
use App\Models\Destination;
use Filament\Resources\Resource;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\Section;
use Filament\Forms\Components\Checkbox;
use Filament\Tables\Columns\TextColumn;
use Filament\Forms\Components\TextInput;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use App\Filament\Resources\DestinationResource\Pages;
use App\Filament\Resources\DestinationResource\RelationManagers;
use ArberMustafa\FilamentLocationPickrField\Forms\Components\LocationPickr;

class DestinationResource extends Resource
{
    protected static ?string $model = Destination::class;

    protected static ?string $navigationIcon = 'heroicon-o-map-pin';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                TextInput::make('name')->maxLength(3)->maxLength(20),
                Select::make('country_id')
                 ->label('Country')
                 ->required()
                 ->relationship('country' , 'name'),

                 TextInput::make('latitude')
                  ->numeric(),
                 TextInput::make('longitude')
                  ->numeric(), 
                
            ]);

    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('name')
                 ->toggleable(),
                 
                TextColumn::make('country_id')
                 ->label('Country')
                 ->sortable()
                 ->searchable()
                 ->toggleable()
                 ->getStateUsing(function(Destination $destination){
                    return $destination->country()->pluck('name');
                 }) ,

               
            ])
            ->filters([
                //
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
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
            'index' => Pages\ListDestinations::route('/'),
            'create' => Pages\CreateDestination::route('/create'),
            'edit' => Pages\EditDestination::route('/{record}/edit'),
        ];
    }
}
