<?php

namespace App\Models;


use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;

class SupervisoryInteraction extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'supervisory_group_id',
        'user_id',
        'publicity',
        'status',
        'content',
        'likes',
        'comments',
    ];

    /**
     * .
     *
     */
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    /**
     * .
     *
     */
    public function supervisory_group(): BelongsTo
    {
        return $this->belongsTo(SupervisoryGroup::class, 'supervisory_group_id');
    }

    /**
     * Get the formatted posted date.
     *
     */
    public function getPostedDate(): String
    {
        // $this->created_at; toDayDateTimeString()
        return Carbon::createFromDate($this->created_at)->format('D, M j, h:i A');
    }

        
    public function getSupervisor(): Supervisor
    {
        return ($this->supervisory_group)?$this->supervisory_group->getSupervisor():null;
    }

        
    public function getContent(): String
    {
        return $this->content;
    }

    /**
     * Check post ownership.
     *
     */
    public function isPostAuthor($id): bool
    {
        return $this->user_id == $id;
    }

    /**
     * .
     *
     */
    public function getAuthorId(): bool
    {
        return $this->user_id;
    }

    /**
     * .
     *
     */
    public function getAuthor(): User
    {
        return $this->user;
    }

    /**
     * .
     *
     */
    public function isSupervisor(): bool
    {
        return $this->user->isSupervisor();
    }

}
