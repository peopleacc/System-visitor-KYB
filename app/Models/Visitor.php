<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Support\Facades\Crypt;

class Visitor extends Model
{
    protected $fillable = [
        'tanggal',
        'email',
        'full_name',
        'institution',
        'no_hp',
        'card_id',
        'no_kendaraan',
        'yang_ditemui',
        'urusan',
        'jumlah',
        'jam_pertemuan',
        'check_in_at',
        'check_out_at',
        'batch',
        'user_id'
    ];





    public function transaction_1(): BelongsTo
    {
        return $this->belongsTo(transaction::class);
    }

    public function notifikasi_1(): HasMany
    {
        return $this->hasMany(Notifikasi::class);
    }

}
