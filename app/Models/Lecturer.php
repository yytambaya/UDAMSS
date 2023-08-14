<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Lecturer extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'user_id',
        'staff_id',
        'title',
        'rank',
    ];

    /**
     * Get the lecturer as a user.
     *
     */
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }
}