<?php

namespace App\Http\Controllers;

use App\Models\Profession;
use App\Models\Tradesperson;
use App\Models\Address;
use Illuminate\Http\Request;

class TradespersonController extends Controller
{
    public function index()
    {
        $tradespersons = Tradesperson::all()->take(10);
        //dd($tradespersons);
        $highlightedTradespersons = $this->listHighlightedTps();
        return view('home')->with('tradespersons', $tradespersons)->with('highlighted', $highlightedTradespersons);
    }

    public function addTradesperson(Request $request)
    {
        $validatedData = $request->validate([
            'firstname' => 'required',
            'lastname' => 'required',
            'zip' => 'required|min_digits:4|max_digits:5',
            'city' => 'required',
            'trade' => 'required',
            'trade2' => 'sometimes|required',
            'trade3' => 'sometimes|required',
            'introduction' => '',
        ]);

        $tradesperson = new Tradesperson();
        $address = new Address();
        $profession = new Profession();

        $address = Address::firstOrCreate([
            'zipcode' => $validatedData['zip'],
            'city' => $validatedData['city'],
        ]);
        //TODO check is any trade exists in db before updateOrCreate/upsert
        if(!empty($validatedData['trade3'])){
            $profession = Profession::updateOrCreate([ //upsert
                ['name' => $validatedData['trade']],['name' => $validatedData['trade2']],['name' => $validatedData['trade3']]],
                ['name']
            );
        }
        elseif(!empty($validatedData['trade2'])){
            $profession = Profession::updateOrCreate([
                ['name' => $validatedData['trade']],['name' => $validatedData['trade2']]],
                ['name']
            );
        }
        else{
            $profession = Profession::updateOrCreate([
                ['name' => $validatedData['trade']]],
                ['name']
            );
        }

        //$profession->tradespersonProfession()->attach([1 => ['profession_id' => $profession->id]]);
        
        $tradesperson = Tradesperson::create([
            'firstname' => $validatedData['firstname'],
            'lastname' => $validatedData['lastname'],
            //'addressId' => $tradesperson->addressTp()->save($address),
            'addressId' => Address::where('zipcode', $validatedData['zip'])->where('city', $validatedData['city'])->pluck('id')->first(),
            'introduction' =>$validatedData['introduction'],
            'highlighted' => is_null($request->input('highlighted')) ? '0' : '1',
        ]);
        //$tradesperson->professionsTp()->attach('tradesperson_id');
        $tradesperson->professionsTp()->attach([1 => ['tradesperson_id' => $tradesperson->id]]);
        
        dd([$tradesperson, $address, $profession]);
    }

    public function listHighlightedTps()
    {
        $data = Tradesperson::all()->where('highlighted', 1);

        return $data;
    }
}
