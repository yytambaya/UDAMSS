<?php

namespace App\Models;


use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;


class Announcement extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'user_id',
        'publicity',
        'status',
        'content',
        'likes',
        'comments',
    ];

    /**
     * Get the owner of an announcement.
     *
     */
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    /**
     * Get the formatted posted date.
     *
     */
    public function postedDate(): String
    {
        // $this->created_at; toDayDateTimeString()
        return Carbon::createFromDate($this->created_at)->format('D, M j, h:i A');
    }

    /**
     * Check post ownership.
     *
     */
    public function isPostAuthour(): bool
    {
        return $this->user_id == Auth::id();
    }
}