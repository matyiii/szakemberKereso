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

        $profIDs = []; 
        if(Profession::where('name',))
        if(!empty($validatedData['trade3'])){
            $profession = Profession::upsert([
                ['name' => $validatedData['trade']],['name' => $validatedData['trade2']],['name' => $validatedData['trade3']]],
                ['name']
            );
            $profIDs = [Profession::where('name',$validatedData['trade'])->pluck('id')->first(),
                        Profession::where('name',$validatedData['trade2'])->pluck('id')->first(),
                        Profession::where('name',$validatedData['trade3'])->pluck('id')->first()];
        }
        elseif(!empty($validatedData['trade2'])){
            $profession = Profession::upsert([
                ['name' => $validatedData['trade']],
                ['name' => $validatedData['trade2']]],
                ['name']
            );
            $profIDs = [Profession::where('name',$validatedData['trade'])->pluck('id')->first(),
                        Profession::where('name',$validatedData['trade2'])->pluck('id')->first()];
        }
        else{
            $profession = Profession::firstOrCreate([
                'name' => $validatedData['trade']
            ]);
        }
        
        $tradesperson = Tradesperson::create([
            'firstname' => $validatedData['firstname'],
            'lastname' => $validatedData['lastname'],
            //'addressId' => $tradesperson->addressTp()->save($address),
            'addressId' => Address::where('zipcode', $validatedData['zip'])->where('city', $validatedData['city'])->pluck('id')->first(),
            'introduction' =>$validatedData['introduction'],
            'highlighted' => is_null($request->input('highlighted')) ? '0' : '1',
        ]);

        foreach($profIDs as $id){
            $tradesperson->professionsTp()->attach([$tradesperson->id => ['profession_id' => $id]]);
        }
        dd([$tradesperson, $address, $profession]);
    }

    public function listHighlightedTps()
    {
        $data = Tradesperson::all()->where('highlighted', 1);

        return $data;
    }
}
