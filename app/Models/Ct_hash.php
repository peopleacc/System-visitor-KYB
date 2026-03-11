<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Ct_hash extends Model
{
    protected $connection = 'mysql_second';

    protected $table = 'ct_users_hash';

    protected $fillable = [
        'npk',
        'dept',
    ];
}
