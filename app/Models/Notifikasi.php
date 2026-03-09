<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Notifikasi extends Model
{
    protected $table = "notifikasis";
    protected $fillable = [
        'visitor_id', 
        'no_hp',
        'message',
    ];

    public function visitor_1()
    {
        return $this->belongsTo(User::class);
    }
}
