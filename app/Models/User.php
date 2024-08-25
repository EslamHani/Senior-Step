<?php

namespace App\Models;

use Illuminate\Notifications\Notifiable;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use Notifiable, Followable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 
        'email', 
        'password', 
        'permission', 
        'image', 
        'bio', 
        'address', 
        'country', 
        'verified', 
        'level'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function verification(){
        return $this->hasOne('App\Models\Verification');
    }

    public function courses(){
        return $this->belongsToMany(Course::class, 'test_results');
    }

    public function test(){
        return $this->hasMany(TestResult::class);
    }

    public function courses_user(){
        return $this->belongsToMany(Course::class, 'user_courses')->where('permission', 1);
    }

    public function discussions(){
        return $this->hasMany(Discussion::class);
    }

    public function DiscussionReplies(){
        return $this->hasMany(DiscussionReply::class);
    }

    public function discussionlikes(){
        return $this->belongsToMany(Discussion::class, 'discussion_likes', 'user_id', 'discussion_id');
    }

    public function replylikes(){
        return $this->belongsToMany(DiscussionReply::class, 'reply_likes', 'user_id', 'reply_id');
    }

    public function path($append = ""){
        $path = route('userprofile', $this->id);
        return $append ? "{$path}/{$append}" : $path;
    }

    public function todos()
    {
        return $this->hasMany(Todo::class);
    }
}
