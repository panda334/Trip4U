<?php

namespace App\Filament\Resources\DayPlanResource\Pages;

use App\Filament\Resources\DayPlanResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditDayPlan extends EditRecord
{
    protected static string $resource = DayPlanResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }
}
