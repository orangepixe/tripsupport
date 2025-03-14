<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Support extends Model
{
    protected $fillable = [
        'support_id',
        'client',
        'headline',
        'assignment',
        'importance',
        'stage',
        'category',
        'created_id',
        'parent_id',
        'summary',
    ];

    public static $importance = [
        'low' => 'Low',
        'medium' => 'Medium',
        'high' => 'High',
        'critical' => 'Critical',
        'emergency' => 'Emergency',
    ];
    public static $stage = [
        'pending' => 'Pending',
        'open' => 'Open',
        'assigned' => 'Assigned',
        'in_progress' => 'In Progress',
        'on_hold' => 'On Hold',
        'resolved' => 'Resolved',
        'close' => 'Close',
        'reopened' => 'Reopened',
    ];

    public function createdUser()
    {
        return $this->hasOne('App\Models\user', 'id', 'created_id');
    }

    public function assignments()
    {
        return $this->hasOne('App\Models\user', 'id', 'assignment');
    }
    public function clients()
    {
        return $this->hasOne('App\Models\user', 'id', 'client');
    }

    public function reply()
    {
        return $this->hasMany('App\Models\SupportReply', 'support_id', 'id');
    }

    public function categories()
    {
        return $this->hasOne('App\Models\Category', 'id', 'category');
    }

    public function files()
    {
        return $this->hasMany('App\Models\SupportFile','support_id','id')->where('reply_id',0);
    }
}
