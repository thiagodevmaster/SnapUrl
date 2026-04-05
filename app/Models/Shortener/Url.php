<?php

namespace App\Models\Shortener;

use App\Models\Identity\User;
use Illuminate\Database\Eloquent\Attributes\Fillable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

#[Fillable(['title', 'description', 'url', 'status'])]
class Url extends Model
{
    public function __toString(): string
    {
        return $this->short_code;
    }

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }
}
