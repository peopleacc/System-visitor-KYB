<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasOne;

class Card extends Model
{
    protected $table = 'cards';
    protected $fillable = ['code', 'rfid_code', 'tipe', 'status'];

    public function transaction_qr(): HasOne
    {
        return $this->hasOne(Transaction::class, 'card_id');
    }
}
