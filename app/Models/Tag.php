<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\QuestionTag;

class Tag extends Model
{
    use HasFactory;
    const UPDATED_AT = null;
    const CREATED_AT = null;


    protected $fillable = [
        'tag_name'
    ];

    protected $casts = [
        'tag_name' => 'string'
    ];

    public function questiontag(){
        return $this->hasMany(QuestionTag::class);
    }
}
