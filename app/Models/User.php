<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Relations\HasOne;
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
     * Get the user formatted Name.
     *
     */
    public function getFormattedName(): String
    {
        $this->usertype;
        $fname = Str::ucfirst($this->first_name);
        $mname = Str::ucfirst($this->middle_name);
        $lname = Str::upper($this->last_name);
        $name = "";

        if( $this->usertype === 'lecturer' ){
            $title = Str::ucfirst($this->lecturer->title).'.';
            $fname = Str::upper($fname[0].'.');
            $mname = Str::upper((!empty($mname))?' '.$mname[0].'.':'');
            $name = "$title $fname$mname, $lname";
        }
        else if( $this->usertype === 'student' ){
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
        return $role;
    }
}