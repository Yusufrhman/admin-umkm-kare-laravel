<?php

namespace App\Filament\Admin\Resources\ProductAdminResource\Pages;

use App\Filament\Admin\Resources\ProductAdminResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditAdminProduct extends EditRecord
{
    protected static string $resource = ProductAdminResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }
}
