<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Str;

class Article extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'title',
        'slug',
        'excerpt',
        'content',
        'featured_image',
        'category',
        'tags',
        'author_id',
        'status',
        'views',
        'published_at',
    ];

    protected $casts = [
        'tags' => 'array',
        'published_at' => 'datetime',
    ];

    /**
     * Boot method to generate slug
     */
    protected static function boot()
    {
        parent::boot();

        static::creating(function ($article) {
            if (!$article->slug) {
                $article->slug = Str::slug($article->title);
            }
        });
    }

    /**
     * Get the author of the article.
     */
    public function author()
    {
        return $this->belongsTo(User::class, 'author_id');
    }

    /**
     * Scope for published articles
     */
    public function scopePublished($query)
    {
        return $query->where('status', 'published')
                     ->where('published_at', '<=', now());
    }

    /**
     * Scope for draft articles
     */
    public function scopeDraft($query)
    {
        return $query->where('status', 'draft');
    }

    /**
     * Increment views
     */
    public function incrementViews(): void
    {
        $this->increment('views');
    }

    /**
     * Get reading time estimate
     */
    public function getReadingTimeAttribute(): string
    {
        $words = str_word_count(strip_tags($this->content));
        $minutes = ceil($words / 200);
        return $minutes . ' menit baca';
    }

    /**
     * Get status badge color
     */
    public function getStatusColorAttribute(): string
    {
        return match($this->status) {
            'draft' => 'yellow',
            'published' => 'green',
            'archived' => 'gray',
            default => 'gray',
        };
    }

    /**
     * Categories list
     */
    public static function categories(): array
    {
        return [
            'health_tips' => 'Tips Kesehatan',
            'disease_info' => 'Info Penyakit',
            'medicine_info' => 'Info Obat',
            'nutrition' => 'Nutrisi & Gizi',
            'mental_health' => 'Kesehatan Mental',
            'fitness' => 'Kebugaran',
            'lifestyle' => 'Gaya Hidup Sehat',
            'news' => 'Berita Kesehatan',
        ];
    }
}
