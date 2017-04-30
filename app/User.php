<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;

use App\Gossip;

class User extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    public function gossips()
    {
        return $this->hasMany(Gossip::class);
    }

    public function publish(Gossip $gossip){
        $this->gossips()->save($gossip);
    }

    public function socialaccounts()
    {
        return $this->hasMany(SocialAccount::class);
    }
}
