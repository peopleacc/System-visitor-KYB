<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class otp extends Model
{
    protected $table = 'otp_codes';
    protected $fillable = [
        'code',
        'expired_at',
        'is_used',
    ];


    public function otp()
    {
        return $this->hasOne(Visitor::class, 'otp_id');
    }

}
