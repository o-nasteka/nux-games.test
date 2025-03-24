<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class LuckyGame extends Model
{
    use HasFactory;
    protected $fillable = ['access_link_id', 'number', 'is_win', 'win_amount'];

    public function accessLink()
    {
        return $this->belongsTo(AccessLink::class);
    }
}
