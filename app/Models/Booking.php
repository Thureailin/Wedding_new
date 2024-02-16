<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Booking extends Model
{
    use HasFactory;
    protected $guarded=[];

    public function condition()
    {
        return $this->hasMany(Condition::class,'date');
    }
}

