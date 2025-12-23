<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Faq extends Model
{
    use HasFactory;

    protected $fillable = [
        'question',
        'answer',
        'category',
        'order',
        'is_active',
        'views',
        'helpful_count',
    ];

    protected $casts = [
        'is_active' => 'boolean',
    ];

    /**
     * Scope for active FAQs
     */
    public function scopeActive($query)
    {
        return $query->where('is_active', true);
    }

    /**
     * Scope for ordering by position
     */
    public function scopeOrdered($query)
    {
        return $query->orderBy('order')->orderBy('id');
    }

    /**
     * Increment views
     */
    public function incrementViews(): void
    {
        $this->increment('views');
    }

    /**
     * Increment helpful count
     */
    public function markHelpful(): void
    {
        $this->increment('helpful_count');
    }

    /**
     * Categories list
     */
    public static function categories(): array
    {
        return [
            'general' => 'Umum',
            'orders' => 'Pesanan',
            'payment' => 'Pembayaran',
            'shipping' => 'Pengiriman',
            'account' => 'Akun',
            'products' => 'Produk',
            'consultation' => 'Konsultasi',
            'refund' => 'Pengembalian',
        ];
    }
}
