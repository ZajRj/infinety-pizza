<?php

namespace App\Traits;

trait RedirectsToIndex
{
    protected function getRedirectUrl(): string
    {
        /** @var \Filament\Resources\Pages\ListRecords $this */
        return $this->getResource()::getUrl('index');
    }
}
