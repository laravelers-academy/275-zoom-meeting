<?php

namespace LaravelersAcademy\ZoomMeeting\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Account extends Model
{
    
    use HasFactory;

    protected $table = 'zoom_accounts';

    protected $fillable = [
        'account',
        'client',
        'secret',
        'owner_id'
    ];

    public function owner()
    {
        return $this->belongsTo(config('zoom.related_owner'), 'owner_id');
    }

    public function meetings()
    {
        return $this->hasMany('LaravelersAcademy\ZoomMeeting\Meeting');
    }

}
