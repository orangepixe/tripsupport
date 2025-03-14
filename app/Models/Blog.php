<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Blog extends Model
{
    use HasFactory;
    protected $fillable=[
        'title',
        'description',
        'thumbnail',
        'status',
        'category',
        'parent_id',
    ];

    public static $status=[
        1=>'Active',
        0=>'In active',
    ];

    public function categories()
    {
        return $this->hasOne('App\Models\Category','id','category');
    }
}
