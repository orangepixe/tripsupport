<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    use HasFactory;
    protected $fillable=[
        'category',
        'parent_id',
    ];

    public function totalTicket()
    {
        return $this->hasMany('App\Models\Support','category','id')->count();
    }
    public function totalBlog()
    {
        return $this->hasMany('App\Models\Blog','category','id')->count();
    }
    public function totalArticle()
    {
        return $this->hasMany('App\Models\KnowledgeArticle','category','id')->count();
    }
}
