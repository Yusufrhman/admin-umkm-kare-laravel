<?php

namespace App\Filament\Admin\Resources\UMKMAdminResource\Pages;

use App\Filament\Admin\Resources\UMKMAdminResource;
use Filament\Resources\Pages\CreateRecord;

class CreateAdminUMKM extends CreateRecord
{
    protected static string $resource = UMKMAdminResource::class;
    protected function mutateFormDataBeforeCreate(array $data): array
    {
        $data['user_id'] = auth()->id();

        return $data;
    }
}
