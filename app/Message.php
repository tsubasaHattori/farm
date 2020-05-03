<?php

namespace App;

use Carbon\Carbon;
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
            ->select('m.*')
            ->from('messages as m')
            ->join('users as u', 'm.user_id', '=', 'u.id')
            ->where('u.status', '!=', 9)
            ->orderby('m.created_at', 'asc')
            ->get()
            ->toArray();
    }

    public function deleteMessage($message_id)
    {
        $now = Carbon::now();

        $this->from('messages as m')
            ->where('m.id', $message_id)
            ->update([
                'is_deleted' => true,
                'deleted_at' => $now,
            ]);
    }
}
