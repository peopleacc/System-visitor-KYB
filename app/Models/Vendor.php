<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Vendor extends Model
{
    protected $table = 'vendors';

    protected $fillable = [
        'nama_pt',
        'nama_perusahaan',
        'area_pekerjaan',
        'email',
        'tanggal_masuk',
        'no_police',
        'pic',
        'jumlah_mp',
        'safety_officer_nama',
        'safety_officer_hp',
    ];

    public function transactions(): HasMany
    {
        return $this->hasMany(Transaction::class, 'vendor_id');
    }

    public function notifikasis(): HasMany
    {
        return $this->hasMany(Notifikasi::class, 'vendor_id');
    }
}
