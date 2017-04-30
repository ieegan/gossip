<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Gossip extends Model
{
	protected $fillable = [
        'body',
        'anonymous',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
