<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Tradesperson extends Model
{
    use HasFactory;

    protected $table='tradespersons';

    protected $fillable=[
        'firstname',
        'lastname',
        'addressId',
        'introduction',
        'highlighted',
    ];

    public function professionsTp(){
        //return $this->belongsToMany(Profession::class);
        return $this->belongsToMany(Tradesperson::class,'Tradesperson_professions','profession_id','tradesperson_id');
    }

    public function addressTp(){
        return $this->hasOne(Address::class,'id');
    }

    public function pictureTp(){
        return $this->hasMany(Picture::class);
    }
}