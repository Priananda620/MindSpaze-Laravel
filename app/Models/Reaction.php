<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Reaction extends Model
{
    use HasFactory;
    const UPDATED_AT = null;

    protected $fillable = [
        'user_id',
        'answer_id',
        'reaction_emoji',
    ];

    protected $casts = [
        'user_id' => 'integer',
        'answer_id' => 'integer',
        'reaction_emoji' => 'string',
    ];

    public function answer()
    {
        return $this->belongsTo(Answer::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
