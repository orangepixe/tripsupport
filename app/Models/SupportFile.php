<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SupportFile extends Model
{
    use HasFactory;

    protected $fillable=[
        'support_id',
        'reply_id',
        'files',
        'parent_id',
    ];
}
