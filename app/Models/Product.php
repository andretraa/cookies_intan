<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'category',
        'description',
        'price',
        'price_unit',
        'badge',
        'image',
        'is_active',
        'sort_order',
    ];

    protected $casts = [
        'price' => 'decimal:2',
        'is_active' => 'boolean',
        'sort_order' => 'integer',
    ];

    /**
     * Get formatted rupiah price.
     */
    public function getFormattedPriceAttribute(): string
    {
        return 'Rp' . number_format((float)$this->price, 0, ',', '.');
    }

    /**
     * Get full image URL with sensible fallbacks.
     */
    public function getImageUrlAttribute(): string
    {
        if (empty($this->image)) {
            return asset('images/cookies.jpg');
        }

        if (str_starts_with($this->image, 'http://') || str_starts_with($this->image, 'https://') || str_starts_with($this->image, 'data:')) {
            return $this->image;
        }

        if (str_starts_with($this->image, 'images/') || str_starts_with($this->image, 'uploads/')) {
            return asset($this->image);
        }

        return asset('uploads/products/' . $this->image);
    }
}
