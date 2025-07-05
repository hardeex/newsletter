<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class EmailBatch extends Model
{
    protected $fillable = [
        'user_id',
        'email_list_id',
        'subject',
        'content',
        'total_emails',
        'sent_emails',
        'failed_emails',
        'status',
        'scheduled_at',
        'completed_at',
    ];

    protected $casts = [
        'scheduled_at' => 'datetime',
        'completed_at' => 'datetime',
    ];

    public function emailList()
    {
        return $this->belongsTo(EmailList::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}