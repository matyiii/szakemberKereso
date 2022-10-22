<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Profession extends Model
{
    use HasFactory;
    public $timestamps = false;

    protected $fillable=['name'];

    public function tradespersonProfession(){
        //return $this->belongsToMany(Tradesperson::class);
        return $this->belongsToMany(Tradesperson::class,'tradesperson_professions','tradesperson_id','profession_id');
    }
}