<?php

namespace App\Filament\User\Resources\UMKMResource\Pages;

use App\Filament\User\Resources\UMKMResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditUMKM extends EditRecord
{
    protected static string $resource = UMKMResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make()
                ->label("Hapus UMKM")

        ];
    }
}
