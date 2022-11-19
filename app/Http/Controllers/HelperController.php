<?php

namespace App\Http\Controllers;

use App\Models\Profession;
use App\Models\Tradesperson_profession;
use Illuminate\Http\Request;
use Illuminate\Support\Arr;

class HelperController extends Controller
{
    public function AddTradesToPersons($persons)
    {
        //Collect trades
        $tradesIdArr = [];
        foreach ($persons as $person) {
           $ids = Tradesperson_profession::select('profession_id')
              ->where('tradesperson_id', $person->id)
              ->get('profession_id')->pluck('profession_id')->toArray();
  
           $tradesIdArr = Arr::add($tradesIdArr, $person->id, $ids);
        }
        //Add trades to person
        foreach ($persons as $person) {
           $person->tradeName = Profession::select('name')->whereIn('id', $tradesIdArr[$person->id])->get()->pluck('name');
        }
    }
}
