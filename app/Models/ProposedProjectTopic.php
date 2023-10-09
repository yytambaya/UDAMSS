<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;


class ProposedProjectTopic extends Model
{
    use HasFactory;

    
    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'student_id',
        'topic_1',
        'topic_2',
        'topic_3',
        'approved_topic',
        'session',
    ];

    /**
     * Get the Author/Student of Topics.
     *
     */
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class, 'student_id');
    }

    /**
     * Get the Owner of Topics.
     *
     */
    public function supervisee(): BelongsTo
    {
        return $this->belongsTo(Supervisee::class, 'student_id','student_id');
    }
    
    public function getApprovedTopic(): String
    {
        $approved = "topic_" . $this->approved_topic;
        return $this->$approved;
    }

    public function getApprovedTopics()
    {
        return [$this->$topic_1,$this->$topic_2,$this->$topic_2,];
    }

}
