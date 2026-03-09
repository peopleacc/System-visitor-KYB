<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

use App\Models\Visitor;
use App\Models\Vendor;
use App\Models\Card;

class Transaction extends Model
{
    protected $fillable = [
        'name',
        'no_hp',
        'dept',
        'user_meeting',
        'visitor_id',
        'vendor_id',
        'card_id',
        'status',
        'date',
        'check_in',
        'check_out',
        'purpose',
        'type',
        'barcode'
    ];
    public function visitor_1(): BelongsTo
    {
        return $this->belongsTo(Visitor::class, 'visitor_id');
    }

    public function vendors_1(): BelongsTo
    {
        return $this->belongsTo(Vendor::class, 'vendor_id');
    }


    // public function barcode(): BelongsTo
    // {
    //     return $this->belongsTo(Barcode::class, 'barcode_id');
    // }

    public function card_qr(): BelongsTo
    {
        return $this->belongsTo(Card::class, 'card_id');
    }
}
