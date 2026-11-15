<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Topic extends Model
{
    use HasFactory;

    protected $table = 'forum_topics';

    protected $fillable = [
        'user_id',
        'judul',
        'isi',
    ];

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function comments(): HasMany
    {
        return $this->hasMany(Comment::class, 'topic_id')->orderBy('created_at', 'asc');
    }

    // Aliases for compatibility
    public function getPenulisAttribute(): ?string
    {
        return $this->user?->name;
    }

    public function getPenulisAvatarAttribute(): ?string
    {
        return $this->user?->avatar;
    }

    public function getKomentarAttribute(): int
    {
        return $this->comments()->count();
    }
}
