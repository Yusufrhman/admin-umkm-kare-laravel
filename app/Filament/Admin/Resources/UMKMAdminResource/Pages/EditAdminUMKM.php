<?php

namespace App\Filament\Admin\Resources\UMKMAdminResource\Pages;

use App\Filament\Admin\Resources\UMKMAdminResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditAdminUMKM extends EditRecord
{
    protected static string $resource = UMKMAdminResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make()
                ->label("Hapus UMKM")

        ];
    }
}
