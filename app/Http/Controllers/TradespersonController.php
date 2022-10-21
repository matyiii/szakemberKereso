<?php

namespace App\Http\Controllers;

use App\Models\Tradesperson;
use Illuminate\Http\Request;

class TradespersonController extends Controller
{
    public function index(){
        $tradespersons = Tradesperson::all();
        //dd($tradespersons);
        return view('home')->with('tradespersons',$tradespersons);
    }
}
