<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Notifikasi extends Model
{
    protected $table = "notifikasis";
    protected $fillable = [
        'user_meeting',
        'visitor_id',
        'vendor_id',
        'no_hp',
        'message',
    ];

    public function visitors_1()
    {
        return $this->belongsTo(Notifikasis::class);
    }
    public function vendors_1()
    {
        return $this->belongsTo(Notifikasis::class);
    }
}
