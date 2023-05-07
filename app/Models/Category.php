<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use QuestionCategories;

class Category extends Model
{
    use HasFactory;
    const UPDATED_AT = null;
    const CREATED_AT = null;


    protected $fillable = [
        'category_name'
    ];

    protected $casts = [
        'category_name' => 'string'
    ];

    public function questioncategory(){
        return $this->hasMany(QuestionCategory::class);
    }
}
