<?php

namespace LaravelersAcademy\ZoomMeeting\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Meeting extends Model
{
    
    use HasFactory;

    protected $table = 'zoom_meetings';

    protected $fillable = [
        'payload',
        'account_id'
    ];

    protected $casts = [
        'payload' => 'json'
    ];

    public function account()
    {
        return $this->belongsTo('LaravelersAcademy\ZoomMeeting\Models\Account', 'account_id');
    }

}
