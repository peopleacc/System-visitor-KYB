<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Visitor_acc extends Model
{
    protected $table = 'visitor_accs';

    protected $fillable = [
        'name',
        'no_hp',
        'status',
        'user_meeting',
        'visitor_id',
        'contractor_id',
        'barcode_id',
        'barcode',
        'supply_id',
        'user_id',
        'date',
        'check_in',
        'check_out',
        'purpose',
        'type',
        'signature_path'
    ];

    public function visitor(): BelongsTo
    {
        return $this->belongsTo(Visitor::class);
    }

    public function contractor(): BelongsTo
    {
        return $this->belongsTo(Contractor::class, 'contractor_id');
    }
    public function suppliers(): BelongsTo
    {
        return $this->belongsTo(Supplyer::class, 'supply_id');
    }

    public function barcode(): BelongsTo
    {
        return $this->belongsTo(Barcode::class, 'barcode_id');
    }
}
