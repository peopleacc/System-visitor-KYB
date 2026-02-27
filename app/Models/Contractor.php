<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Contractor extends Model
{
    protected $table = 'contractors';

    protected $fillable = ['tanggal', 'nama_pt', 'nama_pekerjaan', 'area_pekerjaan', 'tanggal_masuk', 'pic', 'user_id', 'jumlah_mp', 'safety_officer_nama', 'safety_officer_hp'];

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function visitorAccs(): HasMany
    {
        return $this->hasMany(Visitor_acc::class, 'contractor_id');
    }
}
