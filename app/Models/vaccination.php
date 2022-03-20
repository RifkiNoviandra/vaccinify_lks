<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class vaccination extends Model
{
    use HasFactory;

    protected $guarded = [];
    public $timestamps = false;

    function spot(){
        return $this->belongsTo(spot::class);
    }
    function vaccine(){
        return $this->belongsTo(vaccine::class);
    }
    function medical(){
        return $this->belongsTo(medical::class , 'doctor_id');
    }

    function user(){
        return $this->belongsTo(User::class , 'doctor_id');
    }

    function society(){
        return $this->belongsTo(Society::class);
    }
}
