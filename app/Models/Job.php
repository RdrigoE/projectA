<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class Job extends Model
{
    use HasFactory;

    public static function createAndStore()
    {
        return [
            'title' => ['required', 'max:50', Rule::unique('jobs', 'title')->where(function ($query) {
                return $query->where('user_id', auth()->id());
            })]
        ];
    }

    protected $guarded = [];

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function appointments(): HasMany
    {
        return $this->hasMany(Appointment::class);
    }
}
