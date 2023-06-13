<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Question extends Model
{
    use HasFactory, SoftDeletes;
    public $timestamps = true;
    const UPDATED_AT = 'updated_at';
    const CREATED_AT = 'created_at';


    protected $fillable = [
        'title',
        'question_synopsis',
        'created_at',
        'updated_at',
        'attached_img',
        'isHotThread',
        // 'isDeleted',
        'user_id'
    ];

    protected $casts = [
        'title' => 'string',
        'question_synopsis' => 'string',
        'created_at' => 'timestamp',
        'updated_at' => 'timestamp',
        'attached_img' => 'string',
        'isHotThread' => 'boolean',
        // 'isDeleted' => 'boolean',
        'user_id' => 'integer'
    ];


    public function user(){
        return $this->belongsTo(User::class);
    }

    public function answer(){
        return $this->hasMany(Answer::class);
    }

    public function questiontag(){
        return $this->hasMany(QuestionTag::class);
    }
}
