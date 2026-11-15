<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Comment extends Model
{
    use HasFactory;

    protected $table = 'forum_comments';

    protected $fillable = [
        'topic_id',
        'user_id',
        'isi',
    ];

    public function topic(): BelongsTo
    {
        return $this->belongsTo(Topic::class, 'topic_id');
    }

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function getPenulisAttribute(): ?string
    {
        return $this->user?->name;
    }

    public function getPenulisAvatarAttribute(): ?string
    {
        return $this->user?->avatar;
    }
}
