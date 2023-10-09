<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;



class Supervisor extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'lecturer_id',
        'session',
    ];

    /**
     * Get the Lecturer as Supervisor.
     *
     */
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class,'lecturer_id');
    }

    /**
     * Get the SupervisoryGroups Supervisor.
     *
     */
    public function supervisory_group(): HasMany
    {
        return $this->hasMany(SupervisoryGroup::class, 'supervisor_id','lecturer_id');
    }

    public function getFormattedName(): String
    {
        return $this->user->getFormattedName();
    }

}
