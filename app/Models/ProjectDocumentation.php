<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class ProjectDocumentation extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'supervisee_id',
        'version',
        'chapter_no',
        'status',
        'type',
        'filename',
        'comment',
        'session',
    ];


    /**
     * Get the SupervisoryGroup of Supervisee.
     *
     */
    public function supervisee(): BelongsTo
    {
        return $this->belongsTo(Supervisee::class, 'supervisee_id','id');
    }







}
