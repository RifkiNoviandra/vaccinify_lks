<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Consultation extends Model
{
    use HasFactory;

    protected $guarded = [];
    public $timestamps = false;

    function society(){
        return $this->belongsTo(Society::class);
    }

    function medical(){
        return $this->belongsTo(medical::class);
    }

    function user(){
        return $this->belongsTo(User::class , 'doctor_id');
    }
}
