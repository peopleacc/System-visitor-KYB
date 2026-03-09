<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class dapaterment extends Model
{
    protected $table = 'dapaterments';

    protected $fillable = [
        'dpt_id',
        'division_id',
        'department',
        'level',
        'parent',
        'alloc',
        'status'

        ];
}
