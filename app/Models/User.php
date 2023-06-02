<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;
    // public $timestamps = ["created_at","updated_at"];

    public $timestamps=true;
    const UPDATED_AT = 'updated_at';
    const CREATED_AT = 'created_at';

    // protected $table = 'tutors';

    protected $fillable = [
        'email',
        'username',
        'password',
        'phone',
        'country_code',
        'last_ip',
        'is_bolt_user',
        'user_profile_img',
        'job',
        'linkedin_link',
        'facebook_link',
        'twitter_link',
        'instagram_link',
        'user_role',
        'created_at',
        'updated_at'
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array
     */
    protected $hidden = [
        'password',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array
     */
    protected $casts = [
        'email' => 'string',
        'username' => 'string',
        'password' => 'string',
        'phone' => 'string',
        'country_code' => 'string',
        'is_bolt_user' => 'boolean',
        'last_ip' => 'string',
        'user_profile_img' => 'string',
        'job' => 'string',
        'linkedin_link' => 'string',
        'facebook_link' => 'string',
        'twitter_link' => 'string',
        'instagram_link' => 'string',
        'user_role' => 'integer',
        'created_at' => 'timestamp',
        'updated_at' => 'timestamp'
    ];

    public function question(){
        return $this->hasMany(Question::class);
    }

    public function answer(){
        return $this->hasMany(Answer::class);
    }

    public function reaction(){
        return $this->hasMany(Reaction::class);
    }
}
