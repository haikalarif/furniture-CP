<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class Product extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'slug',
        'category',
        'description',
        'image',
        'gallery',
        'price',
        'promo_price',
        'discount_percentage',
        'promo_start_date',
        'promo_end_date',
        'material',
        'dimensions',
        'is_featured',
        'is_promo',
        'is_active',
        'order',
    ];

    protected $casts = [
        'gallery' => 'array',
        'is_featured' => 'boolean',
        'is_promo' => 'boolean',
        'is_active' => 'boolean',
        'price' => 'decimal:2',
        'promo_price' => 'decimal:2',
        'promo_start_date' => 'date',
        'promo_end_date' => 'date',
    ];

    protected static function boot()
    {
        parent::boot();

        static::creating(function ($product) {
            if (empty($product->slug)) {
                $product->slug = Str::slug($product->name);
            }
        });
    }

    public function scopeActive($query)
    {
        return $query->where('is_active', true);
    }

    public function scopeFeatured($query)
    {
        return $query->where('is_featured', true);
    }

    public function scopeOrdered($query)
    {
        return $query->orderBy('order')->orderBy('created_at', 'desc');
    }

    public function scopePromo($query)
    {
        return $query->where('is_promo', true)
            ->where(function($q) {
                $q->whereNull('promo_start_date')
                  ->orWhere('promo_start_date', '<=', now());
            })
            ->where(function($q) {
                $q->whereNull('promo_end_date')
                  ->orWhere('promo_end_date', '>=', now());
            });
    }

    public function isPromoActive()
    {
        if (!$this->is_promo) {
            return false;
        }

        $now = now();

        if ($this->promo_start_date && $now->lt($this->promo_start_date)) {
            return false;
        }

        if ($this->promo_end_date && $now->gt($this->promo_end_date)) {
            return false;
        }

        return true;
    }

    public function getEffectivePrice()
    {
        if ($this->isPromoActive() && $this->promo_price) {
            return $this->promo_price;
        }

        return $this->price;
    }

    public function getDiscountAmount()
    {
        if ($this->isPromoActive() && $this->price && $this->promo_price) {
            return $this->price - $this->promo_price;
        }

        return 0;
    }
}
