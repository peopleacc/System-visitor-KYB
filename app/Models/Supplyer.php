<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Supplyer extends Model
{
	protected $table = 'suppliers';

	protected $fillable = ['name_perushaan', 'nomor_police', 'sopir', 'user_id', 'paraf'];

	public function user(): BelongsTo
	{
		return $this->belongsTo(User::class);
	}

	 public function visitorAccs(): HasMany
    {
        return $this->hasMany(Visitor_acc::class, 'supplyer_id');
    }
}
