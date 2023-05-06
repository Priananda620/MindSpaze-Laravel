<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Question extends Model
{
    use HasFactory;
    public $timestamps = ["created_at"];
    const UPDATED_AT = null;
    const CREATED_AT = 'created_at';


    protected $fillable = [
        'title',
        'question_synopsis',
        'created_at',
        'attached_img',
        'user_id'
    ];

    protected $casts = [
        'title' => 'string',
        'question_synopsis' => 'string',
        'created_at' => 'datetime',
        'attached_img' => 'string',
        'user_id' => 'integer'
    ];


    public function user(){
        return $this->belongsTo(User::class);
    }

    public function answer(){
        return $this->hasMany(Answer::class);
    }
}
