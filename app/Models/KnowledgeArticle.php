<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class KnowledgeArticle extends Model
{
    use HasFactory;
    protected $fillable=[
        'title',
        'category',
        'description',
        'parent_id',
        'status',
    ];

    public function categories()
    {
        return $this->hasOne('App\Models\Category','id','category');
    }
}
