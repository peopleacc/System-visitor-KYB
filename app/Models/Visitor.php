<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Support\Facades\Crypt;

class Visitor extends Model
{
    protected $fillable = ['email', 'name_tamu', 'Alamat', 'no_telp', 'no_police', 'user_meeting', 'keperluan', 'jumlah_pengunjung', 'tanggal_masuk', 'user_id'];


    public function cast(): array
    {
        return [
            'name_tamu' => 'encrypted:string',
        ];
    }

    public function getNameTamuDecryptedAttribute()
    {
        try {
            return Crypt::decryptString($this->attributes['name_tamu']);
        } catch (\Exception $e) {
            return $this->attributes['name_tamu'];
        }
    }


    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function visitorAccs(): HasMany
    {
        return $this->hasMany(Visitor_acc::class, 'visitor_id');
    }
}
