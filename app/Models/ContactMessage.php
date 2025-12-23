<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ContactMessage extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'email',
        'phone',
        'subject',
        'message',
        'status',
        'priority',
        'admin_notes',
        'reply',
        'replied_by',
        'replied_at',
    ];

    protected $casts = [
        'replied_at' => 'datetime',
    ];

    /**
     * Get the admin who replied.
     */
    public function repliedByUser()
    {
        return $this->belongsTo(User::class, 'replied_by');
    }

    /**
     * Scope for unread messages
     */
    public function scopeUnread($query)
    {
        return $query->where('status', 'unread');
    }

    /**
     * Scope for high priority messages
     */
    public function scopeHighPriority($query)
    {
        return $query->whereIn('priority', ['high', 'urgent']);
    }

    /**
     * Get status badge color
     */
    public function getStatusColorAttribute(): string
    {
        return match($this->status) {
            'unread' => 'red',
            'read' => 'yellow',
            'replied' => 'green',
            'archived' => 'gray',
            default => 'gray',
        };
    }

    /**
     * Get priority badge color
     */
    public function getPriorityColorAttribute(): string
    {
        return match($this->priority) {
            'low' => 'gray',
            'medium' => 'blue',
            'high' => 'yellow',
            'urgent' => 'red',
            default => 'gray',
        };
    }

    /**
     * Mark as read
     */
    public function markAsRead(): void
    {
        $this->update(['status' => 'read']);
    }

    /**
     * Status labels
     */
    public static function statuses(): array
    {
        return [
            'unread' => 'Belum Dibaca',
            'read' => 'Sudah Dibaca',
            'replied' => 'Sudah Dibalas',
            'archived' => 'Diarsipkan',
        ];
    }

    /**
     * Priority labels
     */
    public static function priorities(): array
    {
        return [
            'low' => 'Rendah',
            'medium' => 'Normal',
            'high' => 'Tinggi',
            'urgent' => 'Mendesak',
        ];
    }
}
