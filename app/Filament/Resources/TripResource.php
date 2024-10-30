<?php

namespace App\Filament\Resources;

use App\Models\Trip;
use Filament\Tables;
use Filament\Forms\Form;
use Filament\Tables\Table;
use Filament\Facades\Filament;
use Illuminate\Support\Carbon;
use Filament\Resources\Resource;
use function Laravel\Prompts\text;

use Filament\Forms\Components\Select;
use Filament\Forms\Components\Section;
use function Laravel\Prompts\textarea;
use Filament\Tables\Columns\TextColumn;
use Filament\Forms\Components\TextInput;

use Filament\Forms\Components\CheckboxList;
use Filament\Support\Facades\FilamentColor;
use Filament\Forms\Components\DateTimePicker;
use App\Filament\Resources\TripResource\Pages;
use Filament\Forms\Components\SpatieMediaLibraryFileUpload;
use Filament\Tables\Columns\SpatieMediaLibraryImageColumn;

class TripResource extends Resource
{
    protected static ?string $model = Trip::class;

    public static function getNavigationBadge(): ?string
    {
        return static::getModel()::count();
    }

    protected static ?string $navigationGroup = 'Trips';

    protected static ?string $navigationIcon = 'heroicon-o-rocket-launch';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Section::make("User")
                    ->schema([
                        TextInput::make("name")
                            ->string()
                            ->minLength(3)
                            ->maxLength(20)
                            ->required(),

                        TextInput::make('adult_price')
                            ->numeric()
                            ->inputMode('decimal')
                            ->minValue(1)
                            ->maxValue(10000000),

                        TextInput::make('children_price')
                            ->numeric()
                            ->inputMode('decimal')
                            ->minValue(1)
                            ->maxValue(10000000),

                        TextInput::make('infant_price')
                            ->numeric()
                            ->inputMode('decimal')
                            ->minValue(1)->maxValue(10000000)
                    ])
                    ->columns(2),


                Section::make('About The Trip')
                    ->schema([
                        TextInput::make('description')
                            ->columnSpanFull()
                            ->minLength(1)
                            ->maxLength(1000),

                        TextInput::make('type')
                            ->required()
                            ->string(),

                        DateTimePicker::make('date')
                            ->required()
                            ->date()
                            ->native()
                            ->minDate(now()),

                        DateTimePicker::make('first_date')
                            ->label('Start date')
                            ->required()
                            ->date()
                            ->minDate(now()),

                        DateTimePicker::make('end_date')
                            ->required()
                            ->date()
                            ->minDate(now())
                            ->weekStartsOnSunday(),

                        TextInput::make('duration')
                            ->numeric()
                            ->reactive()
                            ->default(0)
                            ->readOnly(),




                        Select::make('destination_id')
                            ->label('Destination')
                            ->required()
                            ->relationship('destination', 'name'),


                        TextInput::make('avibality')
                            ->numeric()
                            ->required()
                            ->minValue(1),

                        SpatieMediaLibraryFileUpload::make('avatar')
                            ->collection('avatars')
                            ->multiple()
                            ->responsiveImages(),

                            SpatieMediaLibraryFileUpload::make('trip_profile')
                            ->collection('trip_profile')
                            ->label('Profile Image')
                            ->responsiveImages()
                    ])->columns(2),


                    


                Section::make('Features')
                    ->schema([
                        CheckboxList::make('features')
                            ->relationship('features', 'features')
                            ->bulkToggleable()

                    ])->collapsible(),

                Section::make('Day Plans')
                    ->schema([
                        CheckboxList::make('day_plans')
                            ->relationship('day_plans', 'day_plan')
                            ->bulkToggleable()

                    ])->collapsible(),

                Section::make('Price Advantages')
                    ->schema([
                        CheckboxList::make('Price Include')
                            ->label('Price Include')
                            ->relationship('advantages', 'price_include')
                            ->bulkToggleable(),

                        CheckboxList::make('Price_Uninclude')
                            ->label('Price Uninclude')
                            ->relationship('advantages', 'price_uninclude')
                            ->bulkToggleable()
                    ])
                    ->columns(2)

                    ->collapsible()


            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('name')
                    ->toggleable()
                    ->searchable(),

                TextColumn::make('adult_price')
                    ->toggleable()
                    ->money('syr')
                    ->formatStateUsing(function ($state) {
                        // Convert to float to remove trailing zeros
                        return 'SYR ' .number_format((float) $state, 0, '.' );
                    }),

                    SpatieMediaLibraryImageColumn::make('trip_profile')
                          ->collection('trip_profile')
                    ,

                TextColumn::make('children_price')
                    ->toggleable()
                    ->money('syr')
                    ->formatStateUsing(function ($state) {
                        // Convert to float to remove trailing zeros
                        return 'SYR ' .number_format((float) $state, 0, '.' );
                    }),

                TextColumn::make('infant_price')
                    ->toggleable()
                    ->money('syr')
                    ->formatStateUsing(function ($state) {
                        // Convert to float to remove trailing zeros
                        return 'SYR ' .number_format((float) $state, 0, '.' );
                    }),
                

                TextColumn::make('date')
                    ->toggleable()
                    ->date(),

                TextColumn::make('first_date')
                    ->date(),
                TextColumn::make('end_date')
                    ->date(),
                TextColumn::make('avibality')
                    ->toggleable()
                    ->color('success'),

                TextColumn::make('duration')
                    ->toggleable(),
            ])
            ->filters([
                //
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

    public static function getRelations(): array
    {
        return [
            //
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListTrips::route('/'),
            'create' => Pages\CreateTrip::route('/create'),
            'edit' => Pages\EditTrip::route('/{record}/edit'),
        ];
    }
}
