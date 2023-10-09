<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Support\Str;


class SupervisoryGroup extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'supervisor_id',
        'supervision_limit',
        'supervision_type',
        'session',
    ];

    /**
     * Get the Student as Supervisee.
     *
     */
    public function supervisor(): BelongsTo
    {
        return $this->belongsTo(Supervisor::class, 'supervisor_id','lecturer_id');
    }


    /**
     * Get the SupervisoryGroup Supervisee.
     *
     */
    public function supervisee(): HasMany
    {
        return $this->hasMany(Supervisee::class, 'supervisory_group_id');
    }

    /**
     * .
     *
     */
    public function supervisory_interaction(): HasMany
    {
        return $this->hasMany(SupervisoryInteraction::class, 'supervisory_group_id');
    }
    
    public function getSupervisor(): Supervisor
    {
        return ($this->supervisor)?$this->supervisor->get()->first():null;
    }

}
