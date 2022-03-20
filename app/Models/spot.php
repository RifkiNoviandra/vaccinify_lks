<?php

namespace App\Models;

use http\Env\Request;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class spot extends Model
{
    use HasFactory;
    protected $guarded = [];
    public $timestamps = false;

    function vaccine(){
        return $this->belongsToMany( vaccine::class , 'spot_vaccines');
    }

    function vaccination(){
        return $this->hasMany(vaccination::class , 'spot_id');
    }
    function regional(){
        return $this->belongsTo(regional::class);
    }
}
