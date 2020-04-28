<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Message extends Model
{
    protected $dates = [
        'created_at', 'deleted_at',
    ];
}
