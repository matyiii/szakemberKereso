<?php

namespace App\Http\Controllers;

use App\Models\Profession;
use App\Models\Tradesperson;
use App\Models\Address;
use Illuminate\Http\Request;

class TradespersonController extends Controller
{
    public function index(){
        $tradespersons = Tradesperson::all()->take(10);
        //dd($tradespersons);
        $highlightedTradespersons = $this->listHighlightedTps();
        return view('home')->with('tradespersons',$tradespersons)->with('highlighted',$highlightedTradespersons);
    }

    public function addTradesperson(Request $request){
        $validatedData = $request->validate([
            'firstname' => 'required',
            'lastname' => 'required',
            'zip' => 'required|min_digits:4',
            'city' => 'required',
            'trade' => 'required',
        ]);
        //dd($validatedData);
        $tradespersons = new Tradesperson();
        $addresses = new Address();
        $professions = new Profession();

        $tradespersons->firstname = $validatedData['firstname'];
        $tradespersons->lastname = $validatedData['lastname'];
        $tradespersons->highlighted = is_null($request->input('highlighted')) ? '0':'1';
        $tradespersons->save();

        $professions->name = $validatedData['trade'];
        $tradespersons->professionsTp()->save($professions);

        $addresses->zipcode = $validatedData['zip'];
        $addresses->city = $validatedData['city'];
        $tradespersons->addressTp()->save($addresses);
    }

    public function listHighlightedTps(){
        $data = Tradesperson::all()->where('highlighted',1);

        return $data;
    }
}
