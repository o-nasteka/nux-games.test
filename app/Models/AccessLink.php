<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class AccessLink extends Model
{
    protected $fillable = [
        'username',
        'phone',
        'token',
        'expires_at',
    ];

    public function luckyGames()
    {
        return $this->hasMany(LuckyGame::class,'','');
    }

}
