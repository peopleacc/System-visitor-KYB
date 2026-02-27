<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Barcode extends Model
{
    protected $fillable = ['code', 'nama_barcode', 'status'];

    public function visitor_acc()
    {
        return $this->belongsTo(Visitor_acc::class);
    }
}
