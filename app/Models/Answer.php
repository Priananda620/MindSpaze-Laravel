<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Answer extends Model
{
    use HasFactory;
    public $timestamps=true;
    const UPDATED_AT = 'updated_at';
    const CREATED_AT = 'created_at';


    protected $fillable = [
        'answer_synopsis',
        'attached_img',
        'created_at',
        'updated_at',
        'ai_classification_status',
        'moderated_as',
        'isDeleted',
        'question_id',
        'user_id'
    ];

    protected $casts = [
        'answer_synopsis' => 'string',
        'attached_img' => 'string',
        'created_at' => 'timestamp',
        'updated_at' => 'timestamp',
        'ai_classification_status' => 'boolean',
        'moderated_as' => 'boolean',
        'isDeleted' => 'boolean',
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
