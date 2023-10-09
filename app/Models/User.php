<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

use Illuminate\Support\Str;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'usertype',
        'first_name',
        'middle_name',
        'last_name',
        'gender',
        'role',
        'email',
        'phone',
        'other_phone',
        'state',
        'password',
    ];
    
    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];
    
    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
        'password' => 'hashed',
    ];
    
    /**
     * Get the user as a lecturer.
     *
     */
    public function lecturer(): HasOne
    {
        return $this->hasOne(Lecturer::class);
    }
    
    /**
     * Get the user as a student.
     *
     */
    public function student(): HasOne
    {
        return $this->hasOne(Student::class);
    }
    
    
    /**
     * Get the user as a student.
     *
     */
    public function supervisory_interaction(): HasMany
    {
        return $this->hasMany(SupervisoryInteraction::class);
    }
    
    /**
     * Get the User/Lecturer as Supervisor.
     *
     */
    public function supervisor(): HasMany
    {
        return $this->hasMany(Supervisor::class, 'lecturer_id');
    }
    
    /**
     * Get the User/Student as Supervisee.
     *
     */
    public function supervisee(): HasMany
    {
        return $this->hasMany(Supervisee::class, 'student_id');
    }
    
    /**
     * Get the user posted announcements.
     *
     */
    public function announcement(): HasMany
    {
        return $this->hasMany(Announcement::class);
    }
    
    /**
     * Get the user fullname Name.
     *
     */
    public function getFullName(): String
    {
        $fname = Str::ucfirst($this->first_name);
        $mname = Str::ucfirst($this->middle_name);
        $lname = Str::ucfirst($this->last_name);
        $name = "";
        
        if( $this->isLecturer() ){
            $title = Str::ucfirst($this->lecturer->title).'.';
            $name = "$title $fname $mname, $lname";
        }
        else if( $this->isStudent() ){
            $name = "$lname, $mname $fname";
        }
        return $name;
    }

    /**
     * Get the user formatted Name.
     *
     */
    public function getFormattedName(): String
    {
        $fname = Str::ucfirst($this->first_name);
        $mname = Str::ucfirst($this->middle_name);
        $lname = Str::upper($this->last_name);
        $name = "";
        
        if( $this->isLecturer() ){
            $title = Str::ucfirst($this->lecturer->title).'.';
            $fname = Str::upper($fname[0].'.');
            $mname = Str::upper((!empty($mname))?' '.$mname[0].'.':'');
            $lname = Str::ucfirst($this->last_name);
            $name = "$title $fname$mname, $lname";
        }
        else if( $this->isStudent() ){
            $mname = Str::upper((!empty($mname))?''.$mname[0].'. ':'');
            $name = "$lname, $mname$fname";
        }
        return $name;
    }
    
    /**
     * Get the user formatted Role.
     *
     */
    public function getFormattedRole(): String
    {
        $role = Str::title($this->role);

        if( Str::of($role)->contains(['hod','Hod'])) {
            $role = Str::upper($role);
        }
        else if( Str::of($role)->contains(['siwes','Siwes']) ) {
            $role = Str::of($role)->replace(['siwes','Siwes'], Str::upper('siwes'));
        }
        else if( Str::of($role)->contains(['assistant']) ) {
            $role = Str::of($role)->replace(['assistant'], Str::upper('assit.'));
        }
        return $role;
    }
    
    /**
     * Check if user is a lecturer.
     *
     */
    public function isLecturer(): bool
    {
        return Str::lower($this->usertype) === 'lecturer';
    }
    
    /**
     * Check if user is a lecturer.
     *
     */
    public function isProjectCoordinator(): bool
    {
        return  $this->isLecturer() && Str::lower($this->role) === 'siwes/project coordinator';
    }
    
    /**
     * Check if user is a lecturer.
     *
     */
    public function isSupervisor(): bool
    {
        if( $this->isLecturer() ){
            $supervisor = SupervisoryGroup::where([
                ['supervisor_id', $this->id],
                ['session', config('global.session')],
            ])->get();
            return $supervisor->isNotEmpty();
        }
        return false;
    }

    public function isSupervisee(): bool
    {
        if( $this->isStudent() ){
            $student_id = $this->id;
            $supervisee = ($this->supervisee)?$this->supervisee:[];
            $supervisory_groups = SupervisoryGroup::where([
                ['session', config('global.session')],
                ['supervision_type', 'project'],
            ])->get()->all();
            
            // get all current supervisory groups
            foreach($supervisory_groups as $supervisory_group){
                $supervisees = ($supervisory_group->supervisee)?
                $supervisory_group->supervisee:[];
                // get their supervicess and check for this student
                foreach($supervisees as $supervisee){
                    if ($student_id == $supervisee->student_id){
                        return true;
                    }
                }
            }

        }
        return false;
    }
    
    /**
     * Check for class rep.
     *
     */
    public function isClassRep(): bool
    {
        return Str::lower($this->role) === 'class representative';
    }
    
    /**
     * Check for assit. class rep.
     *
     */
    public function isAsstClassRep(): bool
    {
        return Str::lower($this->role) === 'assistant class representative';
    }
    
    /**
     * Check if user is a student.
     *
     */
    public function isStudent(): bool
    {
        return Str::lower($this->usertype) === 'student';
    }

}