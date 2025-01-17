<?php

namespace App\Filament\Admin\Resources\AdminCategoryResource\Pages;

use App\Filament\Admin\Resources\AdminCategoryResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListAdminCategories extends ListRecords
{
    protected static string $resource = AdminCategoryResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
