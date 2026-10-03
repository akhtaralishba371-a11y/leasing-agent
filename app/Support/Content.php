<?php

namespace App\Support;

use App\Models\SiteContent;
use Illuminate\Support\Facades\Schema;

class Content
{
    /** @var array<string, string|null>|null */
    protected static ?array $cache = null;

    /**
     * Return the stored value for a key, falling back to the given default
     * (used until an admin overrides it, or if the row is missing/blank).
     */
    public static function get(string $key, string $default = ''): string
    {
        if (static::$cache === null) {
            static::$cache = static::load();
        }

        $value = static::$cache[$key] ?? null;

        return ($value === null || $value === '') ? $default : $value;
    }

    /**
     * @return array<string, string|null>
     */
    protected static function load(): array
    {
        // Avoid blowing up before the table exists (e.g. during migrate).
        if (! Schema::hasTable('site_contents')) {
            return [];
        }

        return SiteContent::pluck('value', 'key')->all();
    }

    public static function flush(): void
    {
        static::$cache = null;
    }
}
