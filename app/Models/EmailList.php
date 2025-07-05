<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class EmailList extends Model
{
    protected $fillable = [
        'user_id',
        'name',
        'created_at',
    ];

    public function subscribers()
    {
        return $this->hasMany(EmailListSubscriber::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}