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
        'is_ai_verified'
    ];

    protected $casts = [
        'answer_synopsis' => 'string',
        'attached_img' => 'string',
        'created_at' => 'datetime',
        'is_ai_verified' => 'boolean'
    ];

    public function question()
    {
        return $this->belongsTo(Question::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
