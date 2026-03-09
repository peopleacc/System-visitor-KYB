<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
class User_Lembur extends Authenticatable
{
    protected $connection = 'mysql_second';
    protected $table = 'ct_users_hash';

    protected $primaryKey = 'id';

    protected $fillable = [
        'full_name',
        'pwd',
        'approved',
        'dept',
        'sect',
    ];

    public function getAuthPassword()
    {
        return $this->pwd;
    }

}
