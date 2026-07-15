<?php

namespace App\Models\System;

use App\Models\Identity\User;
use Illuminate\Database\Eloquent\Model;

class SystemError extends Model
{
    protected $fillable = [
        'user_id',
        'exception_class',
        'message',
        'file',
        'line',
        'trace',
        'context',
        'resolved_at',
    ];

    protected function casts(): array
    {
        return [
            'context' => 'array',
            'resolved_at' => 'datetime',
        ];
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function scopeUnresolved($query)
    {
        return $query->whereNull('resolved_at');
    }

    public function resolve(): void
    {
        $this->update([
            'resolved_at' => now(),
        ]);
    }

    public function isResolved(): bool
    {
        return $this->resolved_at !== null;
    }
}
