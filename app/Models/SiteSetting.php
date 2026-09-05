<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Cache;

class SiteSetting extends Model
{
    use HasFactory;

    protected $fillable = [
        'key',
        'value',
        'group',
    ];

    protected static $cachedSettings = null;

    /**
     * Dapatkan nilai setting berdasarkan key dengan fallback default value.
     */
    public static function get(string $key, ?string $default = null): ?string
    {
        if (self::$cachedSettings === null) {
            try {
                self::$cachedSettings = Cache::remember('site_settings_all', 3600, function () {
                    return self::pluck('value', 'key')->toArray();
                });
            } catch (\Exception $e) {
                // Fallback jika database belum dimigrasi atau error
                return $default;
            }
        }

        if (array_key_exists($key, self::$cachedSettings) && self::$cachedSettings[$key] !== null && self::$cachedSettings[$key] !== '') {
            return self::$cachedSettings[$key];
        }

        return $default;
    }

    /**
     * Simpan / perbarui setting.
     */
    public static function set(string $key, ?string $value, string $group = 'general'): self
    {
        $setting = self::updateOrCreate(
            ['key' => $key],
            ['value' => $value, 'group' => $group]
        );

        self::clearCache();

        return $setting;
    }

    /**
     * Dapatkan URL gambar setting dengan fallback default path.
     */
    public static function getImageUrl(string $key, string $defaultPath = 'images/cookies.jpg'): string
    {
        $val = self::get($key);

        if (empty($val)) {
            return asset($defaultPath);
        }

        if (str_starts_with($val, 'http://') || str_starts_with($val, 'https://')) {
            return $val;
        }

        return asset($val);
    }

    /**
     * Hapus cache setting.
     */
    public static function clearCache(): void
    {
        self::$cachedSettings = null;
        try {
            Cache::forget('site_settings_all');
        } catch (\Exception $e) {
            // Ignore cache exceptions
        }
    }
}
