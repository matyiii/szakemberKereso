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
        ]);
        //dd($validatedData);

        $tradesperson = new Tradesperson();
        $address = new Address();
        $profession = new Profession();

        $address = Address::firstOrCreate([
            'zipcode' => $validatedData['zip'],
            'city' => $validatedData['city'],
        ]);

        $tradesperson = Tradesperson::create([
            'firstname' => $validatedData['firstname'],
            'lastname' => $validatedData['lastname'],
            //'addressId' => $tradesperson->addressTp()->save($address),
            'addressId' => Address::where('zipcode', $validatedData['zip'])->where('city', $validatedData['city'])->pluck('id')->first(),
            'highlighted' => is_null($request->input('highlighted')) ? '0' : '1',
        ]);

        $profession = Profession::create([
            'name' => $validatedData['trade'],
        ]);
        dd([$tradesperson, $address, $profession]);
    }

    public function listHighlightedTps()
    {
        $data = Tradesperson::all()->where('highlighted', 1);

        return $data;
    }
}
