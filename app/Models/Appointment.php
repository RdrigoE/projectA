<?php

namespace App\Models;

use App\Rules\AfterStartDate;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Validation\Rule;

class Appointment extends Model
{
    use HasFactory;

    protected $fillable = ['job_id', 'client_id', 'start', 'end', 'date'];

    public $timestamps = true;
    protected $casts = [
        'date' => 'datetime',
        'start' => 'datetime',
        'end' => 'datetime',
    ];

    public $with = [
        'client', 'job'
    ];


    public static function create_and_update()
    {
        return [
            'client_id' => [Rule::exists('clients', 'id')->where(function ($query) {
                return $query->where('user_id', auth()->id());
            })],
            'job_id' => [Rule::exists('jobs', 'id')->where(function ($query) {
                return $query->where('user_id', auth()->id());
            })],
            'date' => ['required', 'date'],
            'start' => ['required',],
            'end' => ['required', 'after:start'],
        ];
    }

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }
    public function job(): BelongsTo
    {
        return $this->belongsTo(Job::class);
    }
    public function client(): BelongsTo
    {
        return $this->belongsTo(Client::class);
    }
}
