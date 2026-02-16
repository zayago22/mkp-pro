<?php

namespace App\Traits;

trait Translatable
{
    /**
     * Get translated value for a field.
     * Tries current locale first, falls back to 'en', then original field.
     */
    public function t(string $field): ?string
    {
        $locale = app()->getLocale();
        $localized = $field . '_' . $locale;

        if (!empty($this->{$localized})) {
            return $this->{$localized};
        }

        $fallback = $field . '_en';
        if (!empty($this->{$fallback})) {
            return $this->{$fallback};
        }

        return $this->{$field} ?? null;
    }
}
