<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Product extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'name',
        'sku',
        'description',
        'category',
        'price',
        'cost_price',
        'stock',
        'min_stock',
        'unit',
        'image',
        'is_active',
        'requires_prescription',
        'manufacturer',
        'expiry_date',
    ];

    protected $casts = [
        'price' => 'decimal:2',
        'cost_price' => 'decimal:2',
        'is_active' => 'boolean',
        'requires_prescription' => 'boolean',
        'expiry_date' => 'date',
    ];

    /**
     * Get the order items for the product.
     */
    public function orderItems()
    {
        return $this->hasMany(OrderItem::class);
    }

    /**
     * Check if product is low on stock
     */
    public function isLowStock(): bool
    {
        return $this->stock <= $this->min_stock;
    }

    /**
     * Check if product is out of stock
     */
    public function isOutOfStock(): bool
    {
        return $this->stock <= 0;
    }

    /**
     * Scope for active products
     */
    public function scopeActive($query)
    {
        return $query->where('is_active', true);
    }

    /**
     * Scope for low stock products
     */
    public function scopeLowStock($query)
    {
        return $query->whereColumn('stock', '<=', 'min_stock');
    }

    /**
     * Get formatted price
     */
    public function getFormattedPriceAttribute(): string
    {
        return 'Rp ' . number_format($this->price, 0, ',', '.');
    }

    /**
     * Categories list
     */
    public static function categories(): array
    {
        return [
            'medicine' => 'Obat-obatan',
            'supplement' => 'Suplemen',
            'medical_device' => 'Alat Kesehatan',
            'personal_care' => 'Perawatan Pribadi',
            'baby_care' => 'Perlengkapan Bayi',
            'first_aid' => 'P3K',
            'skincare' => 'Perawatan Kulit',
            'other' => 'Lainnya',
        ];
    }
}
