<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class EmailListSubscriber extends Model
{
    protected $fillable = [
        'email_list_id',
        'email',
        'created_at',
    ];

    public function emailList()
    {
        return $this->belongsTo(EmailList::class);
    }
}