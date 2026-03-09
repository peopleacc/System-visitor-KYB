<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Handphone extends Model
{
    protected $connection = 'mysql_third';

    protected $table = 'hp';

    protected $fillable = [
        'npk',
        'no_hp',
    ];

    public function visitor_1(): BelongsTo
    {
        return $this->belongsTo(Visitor::class,'visitor_id');
    }
}
