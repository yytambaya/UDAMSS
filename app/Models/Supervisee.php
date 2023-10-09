<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;


class Supervisee extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'student_id',
        'supervisory_group_id',
        'assignment_type',
        'assignment_action',
        'session',
    ];

    /**
     * .
     *
     */
    public function proposed_project_topic(): HasMany
    {
        return $this->hasMany( ProposedProjectTopic::class, 'student_id', 'student_id' );
    }

    /**
     * .
     *
     */
    public function project_documentation(): HasMany
    {
        return $this->hasMany( ProjectDocumentation::class, 'supervisee_id','id' );
    }

    /**
     * Get the SupervisoryGroup of Supervisee.
     *
     */
    public function supervisory_group(): BelongsTo
    {
        return $this->belongsTo(SupervisoryGroup::class, 'supervisory_group_id');
    }

    /**
     * Get the Student as Supervisee.
     *
     */
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class,'student_id');
    }

    /**
     * Get the Supervisee's Supervisor.
     *
     */
    public function getSupervisor(): Supervisor
    {
        return $this->supervisory_group->supervisor;
    }
   
    public function getFullName(): String
    {
        return $this->user->getFullName();
    }
   
    public function getFormattedName(): String
    {
        return $this->user->getFormattedName();
    }

    public function getRegno(): String
    {
        return $this->user->student->getRegno();
    }

    public function getCapRegno(): String
    {
        return $this->user->student->getCapRegno();
    }

    public function getProjectTopic(): String
    {
        if($this->hasPojectTopic())
            return (($this->proposed_project_topic)->first())?
            ($this->proposed_project_topic)->first()->getApprovedTopic():'';
        return "";
    }

    public function getProjectTopics()
    {
        if($this->hasPojectTopic())
            return $this->proposed_project_topic->getApprovedTopics();
        return "";
    }

    private function hasPojectTopic()
    {
        return $this->proposed_project_topic !== null;
    }
}
