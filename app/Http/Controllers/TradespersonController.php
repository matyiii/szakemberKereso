<?php

namespace App\Http\Controllers;

use App\Models\Profession;
use App\Models\Tradesperson;
use App\Models\Address;
use App\Models\Picture;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class TradespersonController extends Controller
{
    public function index()
    {
        $tradespersons = Tradesperson::all()->take(10);
        return view('home')->with('tradespersons', $tradespersons);
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
            'profilePic' => 'nullable',
            'references.*' => 'nullable'
        ]);

        $tradesperson = new Tradesperson();
        $address = new Address();
        $profession = new Profession();
        $pictures = new Picture();

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
            $profIDs = [Profession::where('name',$validatedData['trade'])->pluck('id')->first()];
        }
        
        $tradesperson = Tradesperson::create([
            'firstname' => $validatedData['firstname'],
            'lastname' => $validatedData['lastname'],
            //'addressId' => $tradesperson->addressTp()->save($address),
            'addressId' => Address::where('zipcode', $validatedData['zip'])->where('city', $validatedData['city'])->pluck('id')->first(),
            'introduction' =>$validatedData['introduction'],
            'highlighted' => is_null($request->input('highlighted')) ? '0' : '1',
        ]);

        if(!is_null($request->input('profilePic'))){
            Picture::firstOrCreate([
                'tradesperson_id' => Tradesperson::where('firstname', $validatedData['firstname'])->where('lastname', $validatedData['lastname'])->pluck('id')->first(),
                'file' => $validatedData['profilePic'],
                'isItProfilePicture' => 1
            ]);
        }
        
        if(!is_null($request->input('references')[0])){
            foreach($request->input('references') as $pic){
                $pictures = Picture::firstOrCreate([
                    //'tradesperson_id' => $tradesperson->pictureTp()->save($tradesperson),
                    'tradesperson_id' => Tradesperson::where('firstname', $validatedData['firstname'])->where('lastname', $validatedData['lastname'])->pluck('id')->first(),
                    'file' => $pic,
                ]);
            }
        }

        foreach($profIDs as $id){
            $tradesperson->professionsTp()->attach([$tradesperson->id => ['profession_id' => $id]]);
        }
        //dd([$tradesperson, $address, $profession]);
        return redirect()->back()->with('tpAdded','Tradesperson added successfully');
    }
}
