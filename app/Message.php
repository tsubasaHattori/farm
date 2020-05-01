<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Message extends Model
{
    protected $table = 'messages';

    protected $dates = [
        'created_at', 'deleted_at',
    ];

    public function getTableName()
    {
        return 'messages';
    }

    public function findExcludeDeactiveUsers()
    {
        return $this
            ->select('*')
            ->from('messages as m')
            ->join('users as u', 'm.user_id', '=', 'u.id')
            ->where('u.status', '!=', 9)
            ->orderby('m.created_at', 'asc')
            ->get();
    }
}
