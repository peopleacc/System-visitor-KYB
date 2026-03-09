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

    
}
