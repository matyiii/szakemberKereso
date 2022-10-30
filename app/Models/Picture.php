<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Picture extends Model
{
    use HasFactory;

    protected $guarded = [];

    public $timestamps = false;

    public function tradespersonPicture(){
        return $this->hasOne(Tradesperson::class,'id');
    }
}