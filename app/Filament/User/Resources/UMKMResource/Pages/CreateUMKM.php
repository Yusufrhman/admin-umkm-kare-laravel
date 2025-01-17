<?php

namespace App\Filament\User\Resources\UMKMResource\Pages;

use App\Filament\User\Resources\UMKMResource;
use Filament\Actions;
use Filament\Resources\Pages\CreateRecord;

class CreateUMKM extends CreateRecord
{
    protected static string $resource = UMKMResource::class;
    protected function mutateFormDataBeforeCreate(array $data): array
    {
        $data['user_id'] = auth()->id();

        return $data;
    }
}
