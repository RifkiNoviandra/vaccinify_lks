<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Auth\User as Authenticatable;

class Society extends Authenticatable
{
    use HasFactory;

    protected $guarded = [];
    public $timestamps = false;

    function regional(){
        return $this->belongsTo(regional::class);
    }
}
