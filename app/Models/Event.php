<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Event extends Model
{
    use HasFactory;

    protected $fillable = [
        'judul',
        'slug',
        'deskripsi',
        'lokasi',
        'tanggal',
        'banner',
        'created_by',
    ];

    protected function casts(): array
    {
        return [
            'tanggal' => 'datetime',
        ];
    }

    public function creator(): BelongsTo
    {
        return $this->belongsTo(User::class, 'created_by');
    }

    public function participants(): BelongsToMany
    {
        return $this->belongsToMany(User::class, 'event_registrations', 'event_id', 'user_id')
            ->withTimestamps();
    }

    public function scopeUpcoming($query, int $limit = 0)
    {
        $q = $query->withCount('participants as peserta')
            ->where('tanggal', '>=', now())
            ->orderBy('tanggal', 'asc');

        if ($limit > 0) {
            $q->limit($limit);
        }

        return $q;
    }

    public function scopePast($query, int $limit = 12)
    {
        return $query->withCount('participants as peserta')
            ->where('tanggal', '<', now())
            ->orderBy('tanggal', 'desc')
            ->limit($limit);
    }

    public function isRegisteredBy(?User $user): bool
    {
        if (!$user) {
            return false;
        }
        return $this->participants()->where('user_id', $user->id)->exists();
    }
}
