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

        $tradesperson = new Tradesperson();
        $address = new Address();
        $profession = new Profession();

        $tradesperson = Tradesperson::create([
            'firstname' =>$validatedData['firstname'],
            'lastname' => $validatedData['lastname'],
            //'addressId' => '1',
            'highlighted' => is_null($request->input('highlighted')) ? '0':'1',
        ]);

        $address = Address::firstOrCreate([
            'zipcode' => $validatedData['zip'],
            'city' => $validatedData['city'],
            //'tradesperson_id' => $tradesperson->addressTp()->save($address)
        ]);

        $profession = Profession::create([
            'name' => $validatedData['trade'],
        ]);
        dd([$tradesperson,$address,$profession]);

/*         $tradesperson->firstname = $validatedData['firstname'];
        $tradesperson->lastname = $validatedData['lastname'];
        $tradesperson->highlighted = is_null($request->input('highlighted')) ? '0':'1';
        $tradesperson->save();

        $profession->name = $validatedData['trade'];
        $tradesperson->professionsTp()->save($profession);

        $address->zipcode = $validatedData['zip'];
        $address->city = $validatedData['city'];
        $tradesperson->addressTp()->save($address);
        dd($address); */
    }

    public function listHighlightedTps(){
        $data = Tradesperson::all()->where('highlighted',1);

        return $data;
    }
}
