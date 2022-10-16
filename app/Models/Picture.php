<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pictures extends Model
{
    use HasFactory;

    protected $fillable=['file','isItProfilePicture'];

    public function tradespersonPicture(){
        return $this->hasOne(Tradesperson::class);
    }
}