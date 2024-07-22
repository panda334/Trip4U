<?php

namespace App\Filament\Resources\DayPlanResource\Pages;

use App\Filament\Resources\DayPlanResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListDayPlans extends ListRecords
{
    protected static string $resource = DayPlanResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
