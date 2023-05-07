<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class QuestionCategory extends Model
{
    use HasFactory;
    const UPDATED_AT = null;
    const CREATED_AT = null;

    protected $fillable = [
        'question_id',
        'category_id',
    ];

    protected $casts = [
        'question_id' => 'integer',
        'category_id' => 'integer',
    ];

    public function question()
    {
        return $this->belongsTo(Question::class);
    }

    public function category()
    {
        return $this->belongsTo(Category::class);
    }
}
