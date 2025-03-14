<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Faq extends Model
{
    use HasFactory;

    protected $fillable=[
        'title',
        'description',
        'parent_id',
        'status',
    ];

    public static $status=[
        1=>'Active',
        0=>'In active',
    ];
}
