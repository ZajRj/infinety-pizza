<?php

namespace App\Observers;

use Illuminate\Support\Facades\Cache;

class MenuCacheObserver
{
    /**
     * Handle the "saved" event.
     */
    public function saved(): void
    {
        $this->invalidate();
    }

    /**
     * Handle the "deleted" event.
     */
    public function deleted(): void
    {
        $this->invalidate();
    }

    /**
     * Invalidate the menu cache by updating the version.
     */
    protected function invalidate(): void
    {
        Cache::forever('menu_cache_version', time());
    }
}
