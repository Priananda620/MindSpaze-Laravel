<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class QuestionTag extends Model
{
    use HasFactory;
    const UPDATED_AT = null;
    const CREATED_AT = null;

    protected $fillable = [
        'question_id',
        'tag_id',
    ];

    protected $casts = [
        'question_id' => 'integer',
        'tag_id' => 'integer',
    ];

    public function question()
    {
        return $this->belongsTo(Question::class);
    }

    public function tag()
    {
        return $this->belongsTo(Tag::class);
    }
}
