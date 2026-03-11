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
        'alamat',
        'full_name',
        'institution',
        'no_hp',
        'no_kendaraan',
        'yang_ditemui',
        'urusan',
        'jumlah',
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
