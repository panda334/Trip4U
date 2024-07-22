<?php

namespace App\Filament\Resources;

use Filament\Forms;
use Filament\Tables;
use App\Models\DayPlan;
use Filament\Forms\Form;
use Filament\Tables\Table;
use Filament\Resources\Resource;
use Filament\Forms\Components\TextInput;
use Illuminate\Database\Eloquent\Builder;
use App\Filament\Resources\DayPlanResource\Pages;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use App\Filament\Resources\DayPlanResource\RelationManagers;
use Filament\Tables\Columns\TextColumn;

class DayPlanResource extends Resource
{
    protected static ?string $model = DayPlan::class;

    protected static ?string $navigationParentItem = 'Trips';

    protected static ?string $navigationGroup = 'Trips';

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                TextInput::make('day_plan')
                ->columnSpanFull()
                ->minLength(1)
                ->maxLength(1000),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('day_plan'),
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
            'index' => Pages\ListDayPlans::route('/'),
            'create' => Pages\CreateDayPlan::route('/create'),
            'edit' => Pages\EditDayPlan::route('/{record}/edit'),
        ];
    }
}
