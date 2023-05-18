<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Answer extends Model
{
    use HasFactory;
    public $timestamps = ["created_at"];
    const UPDATED_AT = null;
    const CREATED_AT = 'created_at';


    protected $fillable = [
        'answer_synopsis',
        'attached_img',
        'created_at',
        'is_ai_verified',
        'question_id',
        'user_id'
    ];

    protected $casts = [
        'answer_synopsis' => 'string',
        'attached_img' => 'string',
        'created_at' => 'datetime',
        'is_ai_verified' => 'boolean',
        'question_id' => 'integer',
        'user_id' => 'integer'
    ];

    public function question()
    {
        return $this->belongsTo(Question::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function upvote(){
        return $this->hasMany(UpVote::class);
    }

    public function downvote(){
        return $this->hasMany(DownVote::class);
    }

    public function reaction(){
        return $this->hasMany(Reaction::class);
    }
}
