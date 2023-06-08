<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DownVote extends Model
{
    use HasFactory;
    const UPDATED_AT = null;
    const CREATED_AT = null;

    protected $table = 'downvotes';

    protected $fillable = [
        'answer_id',
        'user_id',
    ];

    protected $casts = [
        'answer_id' => 'integer',
        'user_id' => 'integer',
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
